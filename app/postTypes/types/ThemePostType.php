<?php

namespace gradZagrebWeb2024\postTypes\types;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use gradZagrebWeb2024\lib\postTypes\BasePostType;
use gradZagrebWeb2024\lib\postTypes\CustomPostTypeInterface;

class ThemePostType extends BasePostType implements CustomPostTypeInterface {
	public const LABEL        = 'Tema';
	public const LABEL_PLURAL = 'Teme';
	public const SLUG         = 'theme';

	public function __construct() {
	}

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
		$args['hierarchical']       = true;
		$args['supports']           = array( 'title', 'thumbnail', 'excerpt', 'editor', 'page-attributes' );
		$args['menu_icon']          = 'data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAyNCAyNCIgZmlsbD0iY3VycmVudENvbG9yIj48cGF0aCBkPSJNMiAyMkw3LjI5MTE3IDIwLjgyNDJDOC42OTQ0IDIxLjU3NDYgMTAuMjk3NSAyMiAxMiAyMkMxNy41MjI4IDIyIDIyIDE3LjUyMjggMjIgMTJDMjIgNi40NzcxNSAxNy41MjI4IDIgMTIgMkM2LjQ3NzE1IDIgMiA2LjQ3NzE1IDIgMTJDMiAxMy43MDI1IDIuNDI1NDQgMTUuMzA1NiAzLjE3NTgxIDE2LjcwODhMMiAyMlpNMTUuNDQ4NyA3TDE1LjI3MzcgOS4wMDAyNEgxN1YxMS4wMDAySDE1LjA5ODdMMTQuOTIzNyAxMy4wMDAySDE3VjE1LjAwMDJIMTQuNzQ4OEwxNC41NzM4IDE3SDEyLjU2NjJMMTIuNzQxMSAxNS4wMDAySDEwLjczMzVMMTAuNTU4NSAxN0g4LjU1MDg5TDguNzI1ODQgMTUuMDAwMkg3VjEzLjAwMDJIOC45MDA4Mkw5LjA3NTggMTEuMDAwMkg3VjkuMDAwMjRIOS4yNTA3N0w5LjQyNTc3IDdIMTEuNDMzNEwxMS4yNTg0IDkuMDAwMjRIMTMuMjY2MUwxMy40NDExIDdIMTUuNDQ4N1pNMTEuMDgzNCAxMS4wMDAyTDEwLjkwODUgMTMuMDAwMkgxMi45MTYxTDEzLjA5MTEgMTEuMDAwMkgxMS4wODM0WiI+PC9wYXRoPjwvc3ZnPg==';
        $args['rewrite']           = array(
            'slug'       => 'tema',
            'with_front' => false,
        );

		return $args;
	}

}
