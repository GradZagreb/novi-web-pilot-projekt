<?php

namespace gradZagrebWeb2024\postTypes\types;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use gradZagrebWeb2024\lib\postTypes\BasePostType;
use gradZagrebWeb2024\lib\postTypes\CustomPostTypeInterface;

class ProjectPostType extends BasePostType implements CustomPostTypeInterface {
	public const LABEL        = 'Projekt';
	public const LABEL_PLURAL = 'Projekti';
	public const SLUG         = 'project';

	public function get_post_type_slug(): string {
		return self::SLUG;
	}

	public function get_labels(): array {
		return $this->get_default_labels( self::LABEL, self::LABEL_PLURAL );
	}

	public function get_args(): array {
		$args = $this->get_default_args( $this->get_labels() );
		$args['has_archive']        = false;
		$args['acfe_admin_archive'] = false;
		$args['supports']           = array( 'title', 'thumbnail', 'excerpt', 'editor' );
		$args['menu_icon']          = 'data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAyNCAyNCIgZmlsbD0iY3VycmVudENvbG9yIj48cGF0aCBkPSJNNy45NDEwMSAxOEM3LjY0MzkxIDE2LjcyNzQgNi4zMDQxMiAxNS42ODU3IDUuNzUzOTUgMTQuOTk5MkM0LjY1NjQ1IDEzLjYyOTcgNCAxMS44OTE1IDQgMTBDNCA1LjU4MTcyIDcuNTgxNzIgMiAxMiAyQzE2LjQxODMgMiAyMCA1LjU4MTcyIDIwIDEwQzIwIDExLjg5MjUgMTkuMzQyOCAxMy42MzE1IDE4LjI0NDMgMTUuMDAxNEMxNy42OTQ0IDE1LjY4NyAxNi4zNTU4IDE2LjcyNzYgMTYuMDU5IDE4SDcuOTQxMDFaTTE2IDIwVjIxQzE2IDIyLjEwNDYgMTUuMTA0NiAyMyAxNCAyM0gxMEM4Ljg5NTQzIDIzIDggMjIuMTA0NiA4IDIxVjIwSDE2Wk0xMyAxMC4wMDQ4VjZMOC41IDEyLjAwNDhIMTFWMTYuMDA0OEwxNS41IDEwLjAwNDhIMTNaIj48L3BhdGg+PC9zdmc+';
		$args['rewrite']            = array(
			'slug'       => 'projekt',
			'with_front' => false,
		);

		return $args;
	}
}
