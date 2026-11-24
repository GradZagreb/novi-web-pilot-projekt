<?php

namespace gradZagrebWeb2024\postTypes\types;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use gradZagrebWeb2024\lib\postTypes\BasePostType;
use gradZagrebWeb2024\lib\postTypes\CustomPostTypeInterface;

class OfficePostType extends BasePostType implements CustomPostTypeInterface {
	public const LABEL        = 'Ured';
	public const LABEL_PLURAL = 'Uredi';
	public const SLUG         = 'office';

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
		$args['menu_icon']          = 'data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAyNCAyNCIgZmlsbD0iY3VycmVudENvbG9yIj48cGF0aCBkPSJNMjEgMTlIMjNWMjFIMVYxOUgzVjRDMyAzLjQ0NzcyIDMuNDQ3NzIgMyA0IDNIMTRDMTQuNTUyMyAzIDE1IDMuNDQ3NzIgMTUgNFYxOUgxN1Y5SDIwQzIwLjU1MjMgOSAyMSA5LjQ0NzcyIDIxIDEwVjE5Wk03IDExVjEzSDExVjExSDdaTTcgN1Y5SDExVjdIN1oiPjwvcGF0aD48L3N2Zz4=';
        $args['rewrite']           = array(
            'slug'       => 'ured',
            'with_front' => false,
        );

		return $args;
	}
}
