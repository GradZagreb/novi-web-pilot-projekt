<?php

namespace gradZagrebWeb2024\repositories;

use WP_Post;
use WP_Query;
use WP_Term;

abstract class AbstractRepository {

	abstract public function get_post_type(): string;

	abstract public function get_model( null|WP_Post $post = null ): array;

	public function find_one( null|int $post = null, $return = MODEL ): null|array {
		$post = get_post( $post );

		if ( empty( $post ) ) {
			return null;
		}

		if ( $return == MODEL ) {
			return $this->get_model( $post );
		} elseif ( $return == ARRAY_A ) {
			return $post->to_array();
		} elseif ( $return == ARRAY_N ) {
			return $post->to_array();
		} else {
			$data[] = $post;
		}
	}

	public function find_all( $return = MODEL ): array {
		if ( ! empty( $data ) ) {
			return $data;
		}

		$query = new WP_Query(
			array(
				'post_type'      => $this->get_post_type(),
				'posts_per_page' => - 1,
				'post_status'    => 'publish',
			)
		);

		return $this->to_model( $query->posts, $return );
	}

	public function find_all_by( array $params = array(), $return = MODEL ): array {
		$args = array_merge(
			array(
				'post_type'      => $this->get_post_type(),
				'posts_per_page' => - 1,
				'post_status'    => 'publish',
			),
			$params
		);

		$query = new WP_Query( $args );

		return array(
			'items'         => $this->to_model( $query->posts, $return ),
			'max_num_pages' => $query->max_num_pages,
		);
	}

	public function find_filtered( $taxonomies ): array {
		$args = array(
			'post_type'      => $this->get_post_type(),
			'posts_per_page' => -1,
			'post_status'    => 'publish',
		);

		foreach ( $taxonomies as $key => $value ) {
			if ( ! empty( $value ) ) {
				$args['tax_query'][] = array(
					'taxonomy' => $key,
					'field'    => 'id',
					'terms'    => explode( ',', $value ),
				);
			}
		}

		if ( ! empty( $args['tax_query'] ) && count( $args['tax_query'] ) > 1 ) {
			$args['tax_query']['relation'] = 'AND';
		}

		return $this->find_all_by( $args );
	}

	public function find_categories(): array {

		$terms = get_terms(
			array(
				'taxonomy'   => $this->get_term_type(),
				'hide_empty' => false,
			)
		);

		if ( empty( $terms ) || is_wp_error( $terms ) ) {
			return array();
		}

		return $terms;
	}

	protected function get_post_term( int $post_id, string $taxonomy ): ?WP_Term {
		$terms = get_the_terms( $post_id, $taxonomy );

		return ! empty( $terms[0] ) && ! is_wp_error( $terms[0] ) ? $terms[0] : null;
	}

	protected function to_model( $posts, $return = MODEL ): array {
		$data = array();

		foreach ( $posts as $post ) {
			if ( is_string( $return ) && method_exists( $this, $return ) ) {
				$data[ $post->ID ] = $this->$return( $post );
			} elseif ( $return == MODEL ) {
				$data[ $post->ID ] = $this->get_model( $post );
			} elseif ( $return == ARRAY_A ) {
				$data[ $post->ID ] = $post->to_array();
			} elseif ( $return == ARRAY_N ) {
				$data[] = $post->to_array();
			} elseif ( $return == OBJECT ) {
				$data[] = $post;
			} elseif ( $return == OBJECT_K ) {
				$data[ $post->ID ] = $post;
			}
		}

		return $data;
	}
}
