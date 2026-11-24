<?php
namespace gradZagrebWeb2024\postTypes;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use gradZagrebWeb2024\lib\services\Service;

class CustomPostTypes extends Service {
	public function get_namespace(): string {
		return __NAMESPACE__ . '\\types\\';
	}

	public function get_pattern(): string {
		return trailingslashit( get_stylesheet_directory() ) . 'app/postTypes/types';
	}
}
