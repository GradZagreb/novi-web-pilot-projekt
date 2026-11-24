<?php

namespace gradZagrebWeb2024\options;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class WordpressHooksAdmin {
	public function init(): void {
		if ( ! defined( 'WP_ENVIRONMENT_TYPE' ) || 'local' === wp_get_environment_type() ) {
			add_filter( 'theme_page_templates', array( $this, 'filter_page_templates' ) );
		}

		add_filter( 'upload_mimes', array( $this, 'enable_upload_mime_type' ) );
	}

	public function filter_page_templates( array $page_templates ): array {
		$pattern   = trailingslashit( get_stylesheet_directory() ) . 'slice/page-templates';
		$templates = glob( $pattern . '/*.php' );

		if ( ! empty( $templates ) ) {
			foreach ( $templates as $template ) {
				$class_name = explode( '/', $template );
				$last_item  = end( $class_name );

				if ( is_file( $template ) ) {
					$template_data = implode( '', file( $template ) );

					if ( preg_match( '|Template Name:(.*)$|mi', $template_data, $name ) ) {
						$template_name = sprintf( __( '%s' ), _cleanup_header_comment( $name[1] ) );
					}
				}

				$page_templates[ 'slice/page-templates/' . $last_item ] = ! empty( $template_name ) ? $template_name : str_replace( '.php', '', $last_item );
			}
		}

		return $page_templates;
	}

	public function enable_upload_mime_type( $mimes ) {
		$mimes['svg'] = 'image/svg+xml';

		return $mimes;
	}
}
