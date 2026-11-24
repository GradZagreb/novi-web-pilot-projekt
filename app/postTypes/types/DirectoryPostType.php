<?php

namespace gradZagrebWeb2024\postTypes\types;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use gradZagrebWeb2024\lib\postTypes\BasePostType;
use gradZagrebWeb2024\lib\postTypes\CustomPostTypeInterface;

class DirectoryPostType extends BasePostType implements CustomPostTypeInterface {
	public const LABEL        = 'Kontakt';
	public const LABEL_PLURAL = 'Kontakti';
	public const SLUG         = 'directory';

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
		$args['publicly_queryable'] = false;
		$args['supports']           = array( 'title' );
		$args['menu_icon']          = 'data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAyNCAyNCIgZmlsbD0iY3VycmVudENvbG9yIj48cGF0aCBkPSJNMjAgMjJINi41QzQuNTY3IDIyIDMgMjAuNDMzIDMgMTguNVY1QzMgMy4zNDMxNSA0LjM0MzE1IDIgNiAySDIwQzIwLjU1MjMgMiAyMSAyLjQ0NzcyIDIxIDNWMjFDMjEgMjEuNTUyMyAyMC41NTIzIDIyIDIwIDIyWk0xOSAyMFYxN0g2LjVDNS42NzE1NyAxNyA1IDE3LjY3MTYgNSAxOC41QzUgMTkuMzI4NCA1LjY3MTU3IDIwIDYuNSAyMEgxOVpNMTAgNFYxMkwxMy41IDEwTDE3IDEyVjRIMTBaIj48L3BhdGg+PC9zdmc+';

		return $args;
	}
}
