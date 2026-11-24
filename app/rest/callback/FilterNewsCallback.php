<?php
namespace gradZagrebWeb2024\rest\callback;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use gradZagrebWeb2024\postTypes\taxonomies\OfficeTaxonomy;
use gradZagrebWeb2024\postTypes\taxonomies\ThemeTaxonomy;
use gradZagrebWeb2024\controllers\NewsHubController;
use gradZagrebWeb2024\lib\rest\BaseCallback;
use WP_REST_Request;
use WP_REST_Response;

class FilterNewsCallback extends BaseCallback {

	private $controller;

	public function __construct() {
		$this->controller = new NewsHubController();
	}

	public function rest_endpoint( WP_REST_Request $request ): WP_REST_Response {
		$json_params = $request->get_json_params();
		$filters = array(
			'page' => $json_params['page'] ?? 1,
			'posts_per_page' => $json_params['posts_per_page'] ?? 12,
			'office-taxonomy' => $json_params['office-taxonomy'] ?? array(),
			'theme-taxonomy' => $json_params['theme-taxonomy'] ?? array(),
			'orderby' => $json_params['orderby'] ?? 'newest',
		);
		if ( ! is_array( $filters['office-taxonomy'] ) ) {
			$filters['office-taxonomy'] = array();
		}
		if ( ! is_array( $filters['theme-taxonomy'] ) ) {
			$filters['theme-taxonomy'] = array();
		}

		$response_data = $this->controller->get_filtered_news( $filters );

		return rest_ensure_response( $response_data );
	}

}
