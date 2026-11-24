<?php
namespace gradZagrebWeb2024\controllers;

use gradZagrebWeb2024\repositories\ServiceRepository;
use gradZagrebWeb2024\lib\core\ACFProvider;
use gradZagrebWeb2024\traits\GetImageTrait;

class ServicesHubController {

	use GetImageTrait;

	private $acf_provider;
	private $service_repository;

	public function __construct() {
		$this->acf_provider = ACFProvider::get_instance();
		$this->service_repository = new ServiceRepository();
	}

	public function get_filtered_services( array $filters = [] ): array {

		$defaults = [
			'page' => 1,
			'posts_per_page' => 12,
			'selected-levels' => [],
			'current-term' => null,
			'service-user' => [],
			'office-taxonomy' => [],
			'e-service' => false,
			'orderby' => 'name',
		];

		$filters = array_merge( $defaults, $filters );

		$services_data = $this->service_repository->find_services_filtered( $filters );

		$html = '';

		foreach ( $services_data['posts'] as $service ) {
			$html .= get_partial( 'components/cards/service-card', $service, true );
		}

		$pagination_html = '';
		if ($services_data['max_pages'] > 1) {
			$pagination_html = get_partial(
				'layout/pagination',
				array(
					'base_url'     => '#',
					'page_slug'    => 'page',
					'current_page' => $services_data['current_page'],
					'max_pages'    => $services_data['max_pages'],
				),
				true
			);
		}

		return [
			'html' => $html,
			'pagination_html' => $pagination_html,
			'current_page' => $services_data['current_page'],
			'max_pages' => $services_data['max_pages'],
			'total_posts' => $services_data['total_posts']
		];
	}
}
