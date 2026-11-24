<?php
namespace gradZagrebWeb2024\rest\callback;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use gradZagrebWeb2024\postTypes\taxonomies\OfficeTaxonomy;
use gradZagrebWeb2024\postTypes\taxonomies\ServiceLevelTaxonomy;
use gradZagrebWeb2024\postTypes\taxonomies\ServiceUserTaxonomy;
use gradZagrebWeb2024\controllers\ServicesHubController;
use gradZagrebWeb2024\lib\rest\BaseCallback;
use WP_REST_Request;
use WP_REST_Response;

class FilterServicesCallback extends BaseCallback {

	private $controller;

	public function __construct() {
		$this->controller = new ServicesHubController();
	}

	public function rest_endpoint( WP_REST_Request $request ): WP_REST_Response {
		$json_params = $request->get_json_params();
		$filters = array(
			'page' => $json_params['page'] ?? 1,
			'posts_per_page' => $json_params['posts_per_page'] ?? 12,
			'selected-levels' => $json_params['selected-levels'] ?? array(),
			'current-term' => $json_params['current-term'] ?? null,
			'service-user' => $json_params['service-user'] ?? array(),
			'office-taxonomy' => $json_params['office-taxonomy'] ?? array(),
			'e-service' => $json_params['e-service'] ?? false,
			'orderby' => $json_params['orderby'] ?? 'name',
		);
		if ( ! is_array( $filters['selected-levels'] ) ) {
			$filters['selected-levels'] = array();
		}
		if ( ! is_array( $filters['service-user'] ) ) {
			$filters['service-user'] = array();
		}
		if ( ! is_array( $filters['office-taxonomy'] ) ) {
			$filters['office-taxonomy'] = array();
		}

		$response_data = $this->controller->get_filtered_services( $filters );

		return rest_ensure_response( $response_data );
	}

}
