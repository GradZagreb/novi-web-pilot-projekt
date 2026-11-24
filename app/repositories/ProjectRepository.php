<?php

namespace gradZagrebWeb2024\repositories;

use WP_Post;
use WP_Query;
use gradZagrebWeb2024\postTypes\taxonomies\ThemeTaxonomy;
use gradZagrebWeb2024\postTypes\taxonomies\OfficeTaxonomy;
use gradZagrebWeb2024\postTypes\taxonomies\StatusTaxonomy;
use gradZagrebWeb2024\lib\core\ACFProvider;
use gradZagrebWeb2024\postTypes\types\ProjectPostType;

class ProjectRepository extends AbstractRepository {

	private $acf_provider;

	public function __construct() {
		$this->acf_provider = ACFProvider::get_instance();
	}

	public function get_post_type(): string {
		return ProjectPostType::SLUG;
	}

	public function get_model( ?WP_Post $post = null ): array {
		return array(
			'id'            => $post->ID,
			'image'         => get_post_thumbnail_id( $post->ID ),
			'title'         => get_the_title( $post->ID ),
			'content'       => bf_content( $post->ID ),
			'year'          => $this->acf_provider->get_field( 'year', $post->ID ),
			'link'          => get_permalink( $post->ID ),
			'external_link' => $this->acf_provider->get_field( 'external_link', $post->ID ),
			'value'         => $this->acf_provider->get_field( 'value', $post->ID ),
			'themes'        => wp_get_post_terms( $post->ID, ThemeTaxonomy::SLUG ),
			'offices'       => wp_get_post_terms( $post->ID, OfficeTaxonomy::SLUG ),
			'status'        => wp_get_post_terms( $post->ID, StatusTaxonomy::SLUG ),
		);
	}

	public function find_projects_filtered( array $filters ): array {
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

		if ( ! empty( $filters['stage'] ) ) {
			$tax_queries[] = array(
				'taxonomy' => StatusTaxonomy::SLUG,
				'field'    => 'term_id',
				'terms'    => array_map( 'intval', $filters['stage'] ),
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
