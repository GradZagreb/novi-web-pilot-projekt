<?php

namespace gradZagrebWeb2024\config;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class MenuConfig {
	const HEADER_PRIMARY_MENU_LOCATION = 'header-primary-menu';
    const HEADER_SECONDARY_MENU_LOCATION = 'header-secondary-menu';
	const FOOTER_MENU_LOCATION = 'footer-menu';

	public static function get_menus(): array {
		return array(
            self::HEADER_PRIMARY_MENU_LOCATION => 'Header Primary Menu',
            self::HEADER_SECONDARY_MENU_LOCATION => 'Header Secondary Menu',
			self::FOOTER_MENU_LOCATION => 'Footer Menu'
		);
	}
}
