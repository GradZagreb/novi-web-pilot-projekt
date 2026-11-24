<?php

namespace gradZagrebWeb2024\modules;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use gradZagrebWeb2024\interfaces\ControllerInterface;

final class Modules {
	public static function get_module( array $module, string $module_name = '' ): ControllerInterface {

		if( ! empty( $module['acf_fc_layout'] ) ) {
			$module_name = $module['acf_fc_layout'];
		}

		$class = 'gradZagrebWeb2024\modules\\' . str_replace( '_', '', ucwords( $module_name, '_' ) );

		return new $class( $module );
	}
}
