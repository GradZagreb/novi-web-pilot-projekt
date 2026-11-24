<?php

namespace gradZagrebWeb2024\config;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class ACFConfig {
	public static function get_modules() : array {
		return array(
			'test'
		);
	}
}
