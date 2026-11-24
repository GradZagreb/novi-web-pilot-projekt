<?php

namespace gradZagrebWeb2024\bundles;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use gradZagrebWeb2024\lib\bundles\AssetBundle;
use gradZagrebWeb2024\config\Config;

class GradZagrebWeb2024Assets extends AssetBundle {

	public array $js;
	public array $css;

	public function __construct() {
		$this->set_js_data();
		$this->set_css_data();
	}

	public function set_js_data(): void {
		$this->js = array(
			'gradZagrebWeb2024Vendor' => array(
				'path'           => 'dist/vendor.js',
				'version'        => '1.2.9',
				'localize'       => array(
					'object' => 'frontend_rest_object',
					'data'   => $this->get_localize_data(),
				),
				'timestamp_bust' => true,
			),
			'gradZagrebWeb2024Bundle' => array(
				'path'           => 'dist/bundle.js',
				'version'        => '1.2.9',
				'timestamp_bust' => true,
			),
		);
	}

	public function set_css_data(): void {
		$this->css = array(
			'gradZagrebWeb2024MainCSS' => array(
				'path'           => 'dist/style.css',
				'in_footer'      => false,
				'version'        => '1.2.9',
				'timestamp_bust' => true,
			),
		);
	}

	public function get_localize_data(): array {
		return array(
			'rest_url' => trailingslashit( get_rest_url( null, Config::get_api_namespace() ) ),
		);
	}
}
