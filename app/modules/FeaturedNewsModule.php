<?php

namespace gradZagrebWeb2024\modules;

use gradZagrebWeb2024\interfaces\ControllerInterface;
use gradZagrebWeb2024\repositories\NewsRepository;
use gradZagrebWeb2024\traits\GetImageTrait;

class FeaturedNewsModule implements ControllerInterface {

	use GetImageTrait;

	private $module = array();

	private $newsRepository;

	private $max_items = 4;

	private $data = array(
		'settings' => array(),
		'title'    => '',
		'link'     => array(),
		'news'     => '',
	);

	public function __construct( array $module ) {
		$this->module         = $module;
		$this->newsRepository = new NewsRepository();
	}

	public function get_view(): string {

		if ( empty( $this->module['settings']['show'] ) ) {
			return '';
		}

		if ( ! empty( $this->module['settings'] ) ) {
			$this->data['settings'] = $this->module['settings'];
		}

		$this->data['title'] = $this->module['title'];
		$this->data['link']  = $this->module['link'];

		if ( $this->module['settings']['automated'] ) {
			$this->data['news'] = $this->get_automated_news(
				array(
					$this->module['themes'],
					$this->module['offices'],
				)
			);
		} else {
			$this->data['news'] = $this->get_manual_news( $this->module['news'] );
		}

		return get_partial( 'modules/featured-news-module', $this->data, true );
	}

	private function get_automated_news( array $args ): string {

		$html = '';

		list( $themes, $offices ) = $args;

		if ( empty( $themes ) ) {
			$themes      = array();
			$theme_terms = array();
		}

		if ( empty( $offices ) ) {
			$offices      = array();
			$office_terms = array();
		}

		foreach ( $themes as $term_id ) {
			$term          = get_term( $term_id );
			$theme_terms[] = $term->slug;
		}

		foreach ( $offices as $office_id ) {
			$office         = get_term( $office_id );
			$office_terms[] = $office->slug;
		}

		$news = $this->newsRepository->find_automated_news( $this->max_items, $theme_terms, $office_terms );

		foreach ( $news as $item ) {
			$item['image'] = $this->get_card_small_image( $item['image'] );
			$item['link']  = $this->get_link( $item['link'] );
			$item['date']  = $this->get_date( $item['date'] );
			$html         .= get_partial( 'components/cards/news-card', $item, true );
		}

		return $html;
	}

	private function get_manual_news( array|string $items ): string {
		if ( empty( $items ) ) {
			return '';
		}

		$html = '';

		foreach ( $items as $item ) {
			$news          = $this->newsRepository->find_one( $item );
			$news['image'] = $this->get_image( $news['image'] );
			$news['link']  = $this->get_link( $news['link'] );
			$news['date']  = $this->get_date( $news['date'] );
			$html         .= get_partial( 'components/cards/news-card', $news, true );
		}

		return $html;
	}

	private function get_link( $link ): string {
		if ( empty( $link ) ) {
			return '';
		}

		return get_partial(
			'components/button',
			array(
				'type'    => 'link',
				'title'   => '',
				'url'     => $link,
				'classes' => 'c-button--square-icon-white',
				'dataset' => '',
				'icon'    => get_partial(
					'components/circle',
					array(
						'icon'    => 'arrow-right',
						'classes' => 'c-circle--small c-circle--blue',
					),
					true
				),
			),
			true
		);
	}

	private function get_date( $date ): string {
		if ( empty( $date ) ) {
			return '';
		}

		return get_partial(
			'components/tag',
			array(
				'label'   => $date,
				'classes' => 'c-tag--light-gray',
			),
			true
		);
	}
}
