<?php

namespace gradZagrebWeb2024\repositories;

use WP_Post;
use gradZagrebWeb2024\postTypes\types\OfficePostType;

class OfficeRepository extends AbstractRepository {

	public function __construct() {
	}

	public function get_post_type(): string {
		return OfficePostType::SLUG;
	}

	public function get_model( ?WP_Post $post = null ): array {
		return array(
			'id'    => $post->ID,
			'image' => get_post_thumbnail_id( $post->ID ),
			'title' => get_the_title( $post->ID ),
			'link'  => get_permalink( $post->ID ),
		);
	}
}
