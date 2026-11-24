<?php
namespace gradZagrebWeb2024\rest\callback;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use gradZagrebWeb2024\postTypes\taxonomies\OfficeTaxonomy;
use gradZagrebWeb2024\postTypes\taxonomies\ThemeTaxonomy;
use gradZagrebWeb2024\postTypes\taxonomies\StatusTaxonomy;
use gradZagrebWeb2024\controllers\CapitalProjectsHubController;
use gradZagrebWeb2024\lib\rest\BaseCallback;
use WP_REST_Request;
use WP_REST_Response;

class FilterCapitalProjectsCallback extends BaseCallback {

	private $controller;

	public function __construct() {
		$this->controller = new CapitalProjectsHubController();
	}

	public function rest_endpoint( WP_REST_Request $request ): WP_REST_Response {
		$json_params = $request->get_json_params();
		$filters = array(
			'page' => $json_params['page'] ?? 1,
			'posts_per_page' => $json_params['posts_per_page'] ?? 12,
			'office-taxonomy' => $json_params['office-taxonomy'] ?? array(),
			'theme-taxonomy' => $json_params['theme-taxonomy'] ?? array(),
			'stage' => $json_params['stage'] ?? array(),
			'orderby' => $json_params['orderby'] ?? 'newest',
		);
		if ( ! is_array( $filters['office-taxonomy'] ) ) {
			$filters['office-taxonomy'] = array();
		}
		if ( ! is_array( $filters['theme-taxonomy'] ) ) {
			$filters['theme-taxonomy'] = array();
		}
		if ( ! is_array( $filters['stage'] ) ) {
			$filters['stage'] = array();
		}

		$response_data = $this->controller->get_filtered_capital_projects( $filters );

		return rest_ensure_response( $response_data );
	}
}
