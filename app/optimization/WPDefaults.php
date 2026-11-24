<?php

namespace gradZagrebWeb2024\optimization;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use gradZagrebWeb2024\lib\optimization\BaseWPDefaultsOptimization;

class WPDefaults extends BaseWPDefaultsOptimization {
	public function init(): void {
		$this->deactivate_gutenberg_scripts();
		$this->deactivate_wp_comments();
		$this->deactivate_wp_embeds();
		$this->deactivate_wp_emoji();

		if ( ! is_user_logged_in() ) {
			$this->deactivate_wp_js_dependencies(
				array(
					'remove_jquery_migrate'       => true,
					'remove_jquery_migrate_admin' => true,
					'remove_jquery_on_front'      => true,
				)
			);
		}

		$this->deactivate_wp_posts();

		add_action(
			'wp_enqueue_scripts',
			function () {
				wp_dequeue_style( 'classic-theme-styles' );
				wp_dequeue_style( 'global-styles' );
			},
			20
		);

		add_action( 'after_setup_theme', array( $this, 'gutenberg_removals' ) );
	}

	public function gutenberg_removals(): void {
		add_theme_support( 'disable-custom-font-sizes' );
		add_theme_support( 'editor-font-sizes', array() );
		add_theme_support( 'disable-custom-colors' );
		add_theme_support( 'disable-custom-gradients' );
		add_theme_support( 'editor-color-palette', array() );
		add_theme_support( 'editor-gradient-presets', array() );
	}
}
