<?php

namespace gradZagrebWeb2024\repositories;

use WP_Post;
use gradZagrebWeb2024\lib\core\ACFProvider;
use gradZagrebWeb2024\helpers\DateHelper;
use gradZagrebWeb2024\postTypes\taxonomies\OfficeTaxonomy;
use gradZagrebWeb2024\postTypes\taxonomies\ThemeTaxonomy;
use gradZagrebWeb2024\postTypes\types\NotificationPostType;
use WP_Query;

class NotificationRepository extends AbstractRepository {

	private $acf_provider;

	public function __construct() {
		$this->acf_provider = ACFProvider::get_instance();
	}

	public function get_post_type(): string {
		return NotificationPostType::SLUG;
	}

	public function get_model( ?WP_Post $post = null ): array {
		return array(
			'id'     => $post->ID,
			'title'  => get_the_title( $post->ID ),
			'link'   => ACFProvider::get_instance()->get_field( 'link', $post->ID ),
			'date'   => DateHelper::get_date( $post->ID ),
			'themes' => wp_get_post_terms( $post->ID, ThemeTaxonomy::SLUG ),
            'offices' => wp_get_post_terms( $post->ID, OfficeTaxonomy::SLUG ),

		);
	}

	public function find_automated_notificatons( $max_items, $themes, $offices ) {
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
}
