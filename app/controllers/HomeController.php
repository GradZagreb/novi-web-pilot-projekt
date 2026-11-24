<?php

namespace gradZagrebWeb2024\controllers;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class HomeController {
	private string $template_name;

	public function __construct( string $template_name ) {
		$this->template_name = $template_name;
	}

	public function get_view(): string {
		if ( str_contains( $this->template_name, 'slice' ) ) {
			$template_name = str_replace( '.php', '', $this->template_name );

			return get_partial( $template_name, array(), true, '/' );
		}

		return get_partial( 'page-templates/home', array(), true, '/' );
	}
}
