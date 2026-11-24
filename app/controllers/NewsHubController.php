<?php
namespace gradZagrebWeb2024\controllers;

use gradZagrebWeb2024\repositories\NewsRepository;
use gradZagrebWeb2024\lib\core\ACFProvider;
use gradZagrebWeb2024\traits\GetImageTrait;

class NewsHubController {

	use GetImageTrait;

	private $acf_provider;
	private $news_repository;

	public function __construct() {
		$this->acf_provider               = ACFProvider::get_instance();
		$this->news_repository            = new NewsRepository();
	}

	public function get_filtered_news( array $filters = [] ): array {

		$defaults = [
			'page' => 1,
			'posts_per_page' => 12,
			'office-taxonomy' => [],
			'theme-taxonomy' => [],
			'orderby' => 'newest',
		];

		$filters = array_merge( $defaults, $filters );

		$news_data = $this->news_repository->find_news_filtered( $filters );

		$html = '';

		foreach ( $news_data['posts'] as $article ) {
			$article['image'] = $this->get_image( get_post_thumbnail_id( $article['id'] ) );
			$html .= get_partial( 'components/cards/news-card', $article, true );
		}

		$pagination_html = '';
		if ($news_data['max_pages'] > 1) {
			$pagination_html = get_partial(
				'layout/pagination',
				array(
					'base_url'     => '#',
					'page_slug'    => 'page',
					'current_page' => $news_data['current_page'],
					'max_pages'    => $news_data['max_pages'],
				),
				true
			);
		}

		return [
			'html' => $html,
			'pagination_html' => $pagination_html,
			'current_page' => $news_data['current_page'],
			'max_pages' => $news_data['max_pages'],
			'total_posts' => $news_data['total_posts']
		];
	}
}
