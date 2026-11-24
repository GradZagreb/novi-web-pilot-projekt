<?php

namespace gradZagrebWeb2024\helpers;

use gradZagrebWeb2024\lib\core\ACFProvider;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class DateHelper {
	private function __construct() {
	}

	public static function get_date( int $post_id, string $acf_field = null ): string {
		if ( ! $post_id ) {
			return '';
		}

		if ( ! empty( $acf_field ) ) {
			$date = self::get_date_from_acf_field( $acf_field, $post_id );
		} else {
			$date = get_the_date( '', $post_id );
		}

		return $date;
	}

	private static function get_date_from_acf_field( string $field, int $id ): string {
		$acf_date = ACFProvider::get_instance()->get_field( $field, $id );

        if( empty( $acf_date ) ) {
            return '';
        }

		$timestamp = strtotime( $acf_date );
		$date      = wp_date( get_option( 'date_format' ), $timestamp );

		return $date;
	}
}
