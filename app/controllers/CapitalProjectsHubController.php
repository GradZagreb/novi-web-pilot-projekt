<?php
namespace gradZagrebWeb2024\controllers;

use gradZagrebWeb2024\repositories\NewsRepository;
use gradZagrebWeb2024\repositories\CapitalProjectRepository;
use gradZagrebWeb2024\lib\core\ACFProvider;
use gradZagrebWeb2024\traits\GetImageTrait;

class CapitalProjectsHubController {

	use GetImageTrait;

	private $acf_provider;
	private $news_repository;
	private $capital_project_repository;

	public function __construct() {
		$this->acf_provider               = ACFProvider::get_instance();
		$this->news_repository            = new NewsRepository();
		$this->capital_project_repository = new CapitalProjectRepository();
	}

	public function get_header_data( $post_id ): array {
		$project_html = '';
		$news_html    = '';

		$project_data          = $this->capital_project_repository->find_one( $this->acf_provider->get_field( 'capital_project', $post_id ) );
		$project_data['image'] = $this->get_large_header_image( $project_data['image'] );

		$project_html = get_partial(
			'components/cards/capital-project-header-card',
			$project_data,
			true
		);

		$news_data = $this->news_repository->get_compact_list( $this->acf_provider->get_field( 'featured_news', $post_id ) );

		foreach ( $news_data as $item ) {
			$news_html .= get_partial(
				'components/cards/news-card-compact',
				$item,
				true
			);
		}

		return array(
			'title'           => get_the_title( $post_id ),
			'capital_project' => $project_html,
			'featured_news'   => $news_html,
		);
	}

	public function get_project_list(): string {
		$html = '';

		$projects = new CapitalProjectRepository();
		$projects = $projects->find_all();

		foreach ( $projects as $project ) {
			$project['image'] = $this->get_image( get_post_thumbnail_id( $project['id'] ) );
			$html .= get_partial( 'components/cards/capital-project-card', $project, true );
		}

        return $html;
	}

	public function get_filtered_capital_projects( array $filters ): array {
		$projects_data = $this->capital_project_repository->find_capital_projects_filtered( $filters );
		$projects = $projects_data['posts'];
		$html = '';
		foreach ( $projects as $project ) {
			$project['image'] = $this->get_image( get_post_thumbnail_id( $project['id'] ) );
			$html .= get_partial( 'components/cards/capital-project-card', $project, true );
		}

		$pagination_html = '';
		if ( $projects_data['max_pages'] > 1 ) {
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

		return array(
			'html' => $html,
			'pagination_html' => $pagination_html,
			'current_page' => $projects_data['current_page'],
			'max_pages' => $projects_data['max_pages'],
			'total_posts' => $projects_data['total_posts'],
		);
	}
}
