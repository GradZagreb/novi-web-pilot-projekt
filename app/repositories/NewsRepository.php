<?php

namespace gradZagrebWeb2024\repositories;

use WP_Post;
use WP_Query;
use gradZagrebWeb2024\helpers\DateHelper;
use gradZagrebWeb2024\postTypes\taxonomies\OfficeTaxonomy;
use gradZagrebWeb2024\postTypes\taxonomies\ThemeTaxonomy;
use gradZagrebWeb2024\postTypes\types\NewsPostType;

class NewsRepository extends AbstractRepository {

	public function __construct() {
	}

	public function get_post_type(): string {
		return NewsPostType::SLUG;
	}

	public function get_model( ?WP_Post $post = null ): array {
		return array(
			'id'      => $post->ID,
			'title'   => get_the_title( $post->ID ),
			'image'   => get_post_thumbnail_id( $post->ID ),
			'url'     => get_permalink( $post->ID ),
			'date'    => DateHelper::get_date( $post->ID ),
			'content' => bf_content( $post->ID ),
			'link'    => get_permalink( $post->ID ),
			'themes'  => wp_get_post_terms( $post->ID, ThemeTaxonomy::SLUG ),
			'offices' => wp_get_post_terms( $post->ID, OfficeTaxonomy::SLUG ),
		);
	}

	public function find_all_in( array $ids ): array {
		$args = array(
			'post_type'      => $this->get_post_type(),
			'posts_per_page' => -1,
			'post__in'       => $ids,
		);

		$query = new WP_Query( $args );

		return $this->to_model( $query->posts );
	}

	public function get_compact_list( array | string $ids ): array {
        if( empty( $ids ) ) {
            return array();
        }

		$arr = array();

		$data = $this->find_all_in( $ids );

		foreach ( $data as $item ) {
			$arr[] = array(
				'id'    => $item['id'],
				'title' => $item['title'],
				'link'  => $item['link'],
			);
		}

		return $arr;
	}

	public function find_automated_news( $max_items, $themes, $offices ) {
		$args = array(
			'post_type'      => $this->get_post_type(),
			'posts_per_page' => $max_items,
			'tax_query'      => array(
				'relation' => 'OR',
				array(
					'taxonomy' => ThemeTaxonomy::SLUG,
					'field'    => 'slug',
					'terms'    => $themes,
				),
				array(
					'taxonomy' => OfficeTaxonomy::SLUG,
					'field'    => 'slug',
					'terms'    => $offices,
				),
			),
		);

		$query = new WP_Query( $args );

		return $this->to_model( $query->posts );
	}

	public function find_news_filtered( array $filters ): array {
		$args = array(
			'post_type'      => array( $this->get_post_type() ),
			'posts_per_page' => $filters['posts_per_page'],
			'paged'          => $filters['page'],
			'post_status'    => 'publish',
		);

		if ( $filters['orderby'] === 'oldest' ) {
			$args['orderby'] = 'date';
			$args['order'] = 'ASC';
		} else {
			$args['orderby'] = 'date';
			$args['order'] = 'DESC';
		}

		$tax_queries = [];
		if ( ! empty( $filters['office-taxonomy'] ) ) {
			$tax_queries[] = array(
				'taxonomy' => OfficeTaxonomy::SLUG,
				'field'    => 'term_id',
				'terms'    => array_map( 'intval', $filters['office-taxonomy'] ),
				'operator' => 'IN',
				'include_children' => false,
			);
		}

		if ( ! empty( $filters['theme-taxonomy'] ) ) {
			$tax_queries[] = array(
				'taxonomy' => ThemeTaxonomy::SLUG,
				'field'    => 'term_id',
				'terms'    => array_map( 'intval', $filters['theme-taxonomy'] ),
			);
		}

		if ( ! empty( $tax_queries ) ) {
			$args['tax_query'] = array(
				'relation' => 'AND',
			);
			$args['tax_query'] = array_merge( $args['tax_query'], $tax_queries );
		}

		$query = new WP_Query( $args );

		$filtered_posts = array();
		foreach ( $query->posts as $post ) {
			if ( $post->post_type === $this->get_post_type() ) {
				$filtered_posts[] = $post;
			}
		}

		return array(
			'posts' => $this->to_model( $filtered_posts ),
			'current_page' => $filters['page'],
			'max_pages' => $query->max_num_pages,
			'total_posts' => count( $filtered_posts )
		);
	}
}
