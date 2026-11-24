<?php

namespace gradZagrebWeb2024\helpers;

use WP_Post;

use gradZagrebWeb2024\lib\core\ACFProvider;

class BreadcrumbsHelper {

	private $post;
	private $breadcrumbs;
	private $acf;

	public function __construct( WP_Post $post ) {
		$this->post        = $post;
		$this->breadcrumbs = array();
		$this->acf         = ACFProvider::get_instance();
	}

	public function get_theme_breadcrumbs(): string {
		if ( ! is_single( $this->post ) ) {
			return '';
		}

		$this->breadcrumbs[] = array(
			'url'  => home_url(),
			'text' => __( 'Naslovna', TEXT_DOMAIN ),
		);

		$this->add_theme_ancestor_breadcrumbs( $this->post );

		$this->breadcrumbs[] = array(
			'url'  => get_permalink( $this->post ),
			'text' => get_the_title( $this->post ),
		);

		return get_partial(
			'components/breadcrumbs',
			array(
				'breadcrumbs' => $this->breadcrumbs,
			),
			true
		);
	}

	private function add_theme_ancestor_breadcrumbs( $post ) {
		$ancestors = array_reverse( get_post_ancestors( $post ) );

		foreach ( $ancestors as $ancestor_id ) {
			$ancestor = get_post( $ancestor_id );
			if ( $ancestor ) {
				$this->breadcrumbs[] = array(
					'url'  => get_permalink( $ancestor ),
					'text' => get_the_title( $ancestor ),
				);
			}
		}
	}

	public function get_service_breadcrumbs(): string {
		if ( ! is_single( $this->post ) ) {
			return '';
		}

		$this->breadcrumbs[] = array(
			'url'  => $this->acf->get_option_field( 'page_-_services' ),
			'text' => __( 'Katalog usluga', TEXT_DOMAIN ),
		);

		$this->add_service_ancestor_breadcrumbs( $this->post );

		$this->breadcrumbs[] = array(
			'url'  => get_permalink( $this->post ),
			'text' => get_the_title( $this->post ),
		);

		return get_partial(
			'components/breadcrumbs',
			array(
				'breadcrumbs' => $this->breadcrumbs,
			),
			true
		);
	}

	private function add_service_ancestor_breadcrumbs( $post ) {
		$terms = get_the_terms( $post, 'service-level' );

		$query = http_build_query(
			array(
				'term' => $terms[0]->term_id,
			)
		);

		foreach ( $terms as $term ) {
			if ( $term->parent === 0 ) {
				$this->breadcrumbs[] = array(
					'url'  => get_term_link( $term ) . '?' . $query,
					'text' => $term->name,
				);
			}
		}
	}
}
