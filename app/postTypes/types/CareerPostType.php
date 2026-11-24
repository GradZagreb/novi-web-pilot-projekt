<?php

namespace gradZagrebWeb2024\postTypes\types;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use gradZagrebWeb2024\lib\postTypes\BasePostType;
use gradZagrebWeb2024\lib\postTypes\CustomPostTypeInterface;

class CareerPostType extends BasePostType implements CustomPostTypeInterface {
	public const LABEL        = 'Zapošljavanje';
	public const LABEL_PLURAL = 'Zapošljavanja';
	public const SLUG         = 'career';

	public function get_post_type_slug(): string {
		return self::SLUG;
	}

	public function get_labels(): array {
		return $this->get_default_labels( self::LABEL, self::LABEL_PLURAL );
	}

	public function get_args(): array {
		$args = $this->get_default_args( $this->get_labels() );
		$args['publicly_queryable'] = false;
		$args['has_archive']        = false;
		$args['acfe_admin_archive'] = false;
		$args['supports']           = array( 'title' );
		$args['menu_icon']          = 'data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAyNCAyNCIgZmlsbD0iY3VycmVudENvbG9yIj48cGF0aCBkPSJNMTUgM0gyMVYyMUgzVjE1SDdWMTFIMTFWN0gxNVYzWiI+PC9wYXRoPjwvc3ZnPg==';

		return $args;
	}
}
