<?php

namespace gradZagrebWeb2024\modules;

use gradZagrebWeb2024\interfaces\ControllerInterface;
use gradZagrebWeb2024\repositories\CapitalProjectRepository;
use gradZagrebWeb2024\traits\GetImageTrait;
use gradZagrebWeb2024\traits\GetLinkTrait;

class FeaturedCapitalProjectsModule implements ControllerInterface {

	use GetLinkTrait;
	use GetImageTrait;

	private $module = array();

	private $capital_project_repository;

	private $max_items = 6;

	private $data = array(
		'settings' => array(),
		'title'    => '',
		'link'     => array(),
		'projects' => '',
	);

	public function __construct( array $module ) {
		$this->module                     = $module;
		$this->capital_project_repository = new CapitalProjectRepository();
	}

	public function get_view(): string {

		if ( empty( $this->module['settings']['show'] ) ) {
			return '';
		}

		if ( ! empty( $this->module['settings'] ) ) {
			$this->data['settings'] = $this->module['settings'];
		}

		$this->data['title'] = $this->module['title'];
		$this->data['link']  = $this->get_primary_link( $this->module['link'] );

		if ( $this->module['settings']['automated'] ) {
			$this->data['projects'] = $this->get_automated_projects(
				array(
					$this->module['themes'],
					$this->module['offices'],
					$this->module['statuses'],
				)
			);
		} else {
			$this->data['projects'] = $this->get_manual_projects( $this->module['capital_projects'] );
		}

		return get_partial( 'modules/featured-capital-projects-module', $this->data, true );
	}

	private function get_automated_projects( array $args ): string {

		$html = '';

		list( $themes, $offices, $statuses ) = $args;

		if ( empty( $themes ) ) {
			$themes      = array();
			$theme_terms = array();
		}

		if ( empty( $offices ) ) {
			$offices      = array();
			$office_terms = array();
		}

		if ( empty( $statuses ) ) {
			$statuses     = array();
			$status_terms = array();
		}

		foreach ( $themes as $term_id ) {
			$term          = get_term( $term_id );
			$theme_terms[] = $term->slug;
		}

		foreach ( $offices as $office_id ) {
			$office         = get_term( $office_id );
			$office_terms[] = $office->slug;
		}

		foreach ( $statuses as $status_id ) {
			$status         = get_term( $status_id );
			$status_terms[] = $status->slug;
		}

		$news = $this->capital_project_repository->find_automated_projects( $this->max_items, $theme_terms, $office_terms, $status_terms );

		foreach ( $news as $item ) {
			$item['image']  = $this->get_image( $item['image'] );
			$html          .= get_partial( 'components/cards/capital-project-card', $item, true );
		}

		return $html;
	}

	private function get_manual_projects( array|string $items ): string {
		if ( empty( $items ) ) {
			return '';
		}

		$html = '';

		foreach ( $items as $item ) {
			$project           = $this->capital_project_repository->find_one( $item );
			$project['image']  = $this->get_card_large_image( $project['image'] );
			$html             .= get_partial( 'components/cards/capital-project-card', $project, true );
		}

		return $html;
	}
}
