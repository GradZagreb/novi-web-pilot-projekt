<?php

namespace gradZagrebWeb2024\repositories;

use WP_Post;
use gradZagrebWeb2024\postTypes\taxonomies\ThemeTaxonomy;
use gradZagrebWeb2024\postTypes\taxonomies\StatusTaxonomy;
use gradZagrebWeb2024\postTypes\types\CareerPostType;
use gradZagrebWeb2024\postTypes\taxonomies\OfficeTaxonomy;
use gradZagrebWeb2024\lib\core\ACFProvider;

class CareerRepository extends AbstractRepository {

	private $acf_provider;

	public function __construct() {
		$this->acf_provider = ACFProvider::get_instance();
	}

	public function get_post_type(): string {
		return CareerPostType::SLUG;
	}

	public function get_model( ?WP_Post $post = null ): array {
		return array(
			'id'            => $post->ID,
			'title'         => get_the_title( $post->ID ),
			'eyebrow'       => $this->acf_provider->get_field( 'eyebrow', $post->ID ),
			'external_link' => $this->acf_provider->get_field( 'external_link', $post->ID ),
			'themes'        => wp_get_post_terms( $post->ID, ThemeTaxonomy::SLUG ),
			'offices'       => wp_get_post_terms( $post->ID, OfficeTaxonomy::SLUG ),
			'status'        => wp_get_post_terms( $post->ID, StatusTaxonomy::SLUG ),
		);
	}
}
