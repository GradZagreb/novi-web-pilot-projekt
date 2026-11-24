<?php
namespace gradZagrebWeb2024\rest;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use gradZagrebWeb2024\lib\services\Service;

class CustomRoutes extends Service {
	public function get_namespace(): string {
		return __NAMESPACE__ . '\\routes\\';
	}

	public function get_pattern(): string {
		return trailingslashit( get_stylesheet_directory() ) . 'app/rest/routes';
	}
}
