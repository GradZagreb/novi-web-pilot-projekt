<?php

namespace gradZagrebWeb2024\postTypes\types;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use gradZagrebWeb2024\lib\postTypes\BasePostType;
use gradZagrebWeb2024\lib\postTypes\CustomPostTypeInterface;

class TenderPostType extends BasePostType implements CustomPostTypeInterface {
	public const LABEL        = 'Natječaj';
	public const LABEL_PLURAL = 'Natječaji';
	public const SLUG         = 'tender';

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
		$args['menu_icon']          = 'data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAyNCAyNCIgZmlsbD0iY3VycmVudENvbG9yIj48cGF0aCBkPSJNMTQuMDA0OSAyMC4wMDI4VjIyLjAwMjhIMi4wMDQ4OFYyMC4wMDI4SDE0LjAwNDlaTTE0LjU5MDcgMC42ODkwODdMMjIuMzY4OCA4LjQ2NzI2TDIwLjk1NDYgOS44ODE0N0wxOS44OTQgOS41Mjc5MkwxNy40MTkxIDEyLjAwMjhMMjMuMDc2IDE3LjY1OTdMMjEuNjYxNyAxOS4wNzM5TDE2LjAwNDkgMTMuNDE3TDEzLjYwMDcgMTUuODIxMkwxMy44ODM2IDE2Ljk1MjVMMTIuNDY5MyAxOC4zNjY4TDQuNjkxMTcgMTAuNTg4Nkw2LjEwNTM5IDkuMTc0MzdMNy4yMzY3NiA5LjQ1NzIxTDEzLjUzIDMuMTYzOTZMMTMuMTc2NSAyLjEwMzNMMTQuNTkwNyAwLjY4OTA4N1oiPjwvcGF0aD48L3N2Zz4=';

		return $args;
	}
}
