<?php
namespace gradZagrebWeb2024\rest\routes;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use gradZagrebWeb2024\config\Config;
use gradZagrebWeb2024\lib\rest\BaseRoute;
use gradZagrebWeb2024\rest\callback\FilterProjectsCallback;

class FilterProjectsRoute extends BaseRoute {
	public const ROUTE = 'filter-projects';

	public function get_route_slug(): string {
		return self::ROUTE;
	}

	public function get_namespace(): string {
		return Config::get_api_namespace();
	}

	public function get_args(): array {
		return array(
			'methods'             => array( 'POST' ),
			'callback'            => array(
				new FilterProjectsCallback(),
				'rest_endpoint'
			),
			'permission_callback' => '__return_true',
		);
	}
}
