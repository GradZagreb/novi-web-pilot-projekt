<?php
namespace gradZagrebWeb2024\controllers;

use gradZagrebWeb2024\repositories\ProjectRepository;
use gradZagrebWeb2024\lib\core\ACFProvider;
use gradZagrebWeb2024\traits\GetImageTrait;

class ProjectsHubController {

	use GetImageTrait;

	private $acf_provider;
	private $project_repository;

	public function __construct() {
		$this->acf_provider     = ACFProvider::get_instance();
		$this->project_repository = new ProjectRepository();
	}

	public function get_filtered_projects( array $filters = [] ): array {

		$defaults = [
			'page' => 1,
			'posts_per_page' => 12,
			'office-taxonomy' => [],
			'stage' => [],
			'theme-taxonomy' => [],
			'orderby' => 'newest',
		];

		$filters = array_merge( $defaults, $filters );

		$projects_data = $this->project_repository->find_projects_filtered( $filters );

		$html = '';

		foreach ( $projects_data['posts'] as $project ) {
			$project['image'] = $this->get_image( get_post_thumbnail_id( $project['id'] ) );
			$html .= get_partial( 'components/cards/project-card', $project, true );
		}

		$pagination_html = '';
		if ($projects_data['max_pages'] > 1) {
			$pagination_html = get_partial(
				'layout/pagination',
				array(
					'base_url'     => '#',
					'page_slug'    => 'page',
					'current_page' => $projects_data['current_page'],
					'max_pages'    => $projects_data['max_pages'],
				),
				true
			);
		}

		return [
			'html' => $html,
			'pagination_html' => $pagination_html,
			'current_page' => $projects_data['current_page'],
			'max_pages' => $projects_data['max_pages'],
			'total_posts' => $projects_data['total_posts']
		];
	}
}
