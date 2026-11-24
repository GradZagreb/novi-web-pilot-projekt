<?php

namespace gradZagrebWeb2024\repositories;

use WP_Post;
use gradZagrebWeb2024\lib\core\ACFProvider;
use gradZagrebWeb2024\postTypes\taxonomies\DirectoryCategoryTaxonomy;
use gradZagrebWeb2024\postTypes\types\DirectoryPostType;
use WP_Query;

class DirectoryRepository extends AbstractRepository {

	private $acf_provider;

	public function __construct() {
		$this->acf_provider = ACFProvider::get_instance();
	}

	public function get_post_type(): string {
		return DirectoryPostType::SLUG;
	}

	public function get_model( ?WP_Post $post = null ): array {
		return array(
			'id'    => $post->ID,
			'title' => get_the_title( $post->ID ),
			'items' => $this->acf_provider->get_field( 'items', $post->ID ),
		);
	}

	public function find_automated_contacts( $categories ) {
		$args = array(
			'post_type'      => $this->get_post_type(),
			'posts_per_page' => -1,
			'tax_query'      => array(
				'relation' => 'OR',
				array(
					'taxonomy' => DirectoryCategoryTaxonomy::SLUG,
					'field'    => 'slug',
					'terms'    => $categories,
				),
			),
		);

		$query = new WP_Query( $args );

		return $this->to_model( $query->posts );
	}
}
