<?php

namespace gradZagrebWeb2024\repositories;

use WP_Post;
use gradZagrebWeb2024\postTypes\types\EmployeePostType;
use gradZagrebWeb2024\lib\core\ACFProvider;

class EmployeeRepository extends AbstractRepository {

	private $acf_provider;

	public function __construct() {
		$this->acf_provider = ACFProvider::get_instance();
	}

	public function get_post_type(): string {
		return EmployeePostType::SLUG;
	}

	public function get_model( ?WP_Post $post = null ): array {
		return array(
			'id'       => $post->ID,
			'title'    => get_the_title( $post->ID ),
			'image'    => get_post_thumbnail_id( $post->ID ),
			'function' => $this->acf_provider->get_field( 'function', $post->ID ),
			'offices'  => $this->acf_provider->get_field( 'office', $post->ID ),
			'email'    => $this->acf_provider->get_field( 'email', $post->ID ),
			'phone'    => $this->acf_provider->get_field( 'phone', $post->ID ),
		);
	}
}
