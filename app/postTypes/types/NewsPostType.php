<?php

namespace gradZagrebWeb2024\postTypes\types;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use gradZagrebWeb2024\lib\postTypes\BasePostType;
use gradZagrebWeb2024\lib\postTypes\CustomPostTypeInterface;

class NewsPostType extends BasePostType implements CustomPostTypeInterface {
	public const LABEL        = 'Novost';
	public const LABEL_PLURAL = 'Novosti';
	public const SLUG         = 'news';

	public function get_post_type_slug(): string {
		return self::SLUG;
	}

	public function get_labels(): array {
		return $this->get_default_labels( self::LABEL, self::LABEL_PLURAL, 'gradZagrebWeb2024' );
	}

	public function get_args(): array {
		$args = $this->get_default_args( $this->get_labels() );
		$args['has_archive']        = false;
		$args['acfe_admin_archive'] = false;
		$args['supports']           = array( 'title', 'thumbnail', 'excerpt', 'editor' );
		$args['menu_icon']          = 'data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAyNCAyNCIgZmlsbD0iY3VycmVudENvbG9yIj48cGF0aCBkPSJNMTkgMjJINUMzLjM0MzE1IDIyIDIgMjAuNjU2OSAyIDE5VjNDMiAyLjQ0NzcyIDIuNDQ3NzIgMiAzIDJIMTdDMTcuNTUyMyAyIDE4IDIuNDQ3NzIgMTggM1YxMEgyMlYxOUMyMiAyMC42NTY5IDIwLjY1NjkgMjIgMTkgMjJaTTE4IDEyVjE5QzE4IDE5LjU1MjMgMTguNDQ3NyAyMCAxOSAyMEMxOS41NTIzIDIwIDIwIDE5LjU1MjMgMjAgMTlWMTJIMThaTTUgNlYxMkgxMVY2SDVaTTUgMTNWMTVIMTVWMTNINVpNNSAxNlYxOEgxNVYxNkg1Wk03IDhIOVYxMEg3VjhaIj48L3BhdGg+PC9zdmc+';
        $args['rewrite']           = array(
            'slug'       => 'novost',
            'with_front' => false,
        );

		return $args;
	}
}
