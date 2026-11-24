<?php

namespace gradZagrebWeb2024\postTypes\types;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use gradZagrebWeb2024\lib\postTypes\BasePostType;
use gradZagrebWeb2024\lib\postTypes\CustomPostTypeInterface;

class NotificationPostType extends BasePostType implements CustomPostTypeInterface {
	public const LABEL        = 'Obavijest';
	public const LABEL_PLURAL = 'Obavijesti';
	public const SLUG         = 'notification';

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
		$args['menu_icon']          = 'data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAyNCAyNCIgZmlsbD0iY3VycmVudENvbG9yIj48cGF0aCBkPSJNMTMuMzQxNCA0QzEzLjEyMDMgNC42MjU1NiAxMyA1LjI5ODczIDEzIDZDMTMgOS4zMTM3MSAxNS42ODYzIDEyIDE5IDEyQzE5LjcwMTMgMTIgMjAuMzc0NCAxMS44Nzk3IDIxIDExLjY1ODZWMjFDMjEgMjEuNTUyMyAyMC41NTIzIDIyIDIwIDIySDRDMy40NDc3MiAyMiAzIDIxLjU1MjMgMyAyMVY1QzMgNC40NDc3MiAzLjQ0NzcyIDQgNCA0SDEzLjM0MTRaTTE5IDEwQzE2Ljc5MDkgMTAgMTUgOC4yMDkxNCAxNSA2QzE1IDMuNzkwODYgMTYuNzkwOSAyIDE5IDJDMjEuMjA5MSAyIDIzIDMuNzkwODYgMjMgNkMyMyA4LjIwOTE0IDIxLjIwOTEgMTAgMTkgMTBaIj48L3BhdGg+PC9zdmc+';

		return $args;
	}
}
