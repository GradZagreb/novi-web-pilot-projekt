<?php

namespace gradZagrebWeb2024\modules;

use gradZagrebWeb2024\interfaces\ControllerInterface;
use gradZagrebWeb2024\repositories\CareerRepository;

class FeaturedCareersModule implements ControllerInterface {

	private $module = array();

	private $career_repository;

	private $data = array(
		'settings' => array(),
		'title'    => '',
		'link'     => array(),
		'careers'  => '',
	);

	public function __construct( array $module ) {
		$this->module            = $module;
		$this->career_repository = new CareerRepository();
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

		$this->data['careers'] = $this->get_careers( $this->module['careers'] );

		return get_partial( 'modules/featured-careers-module', $this->data, true );
	}

	public function get_careers( $items ) {
		if ( empty( $items ) ) {
			return '';
		}

		$html = '';

		foreach ( $items as $item ) {
			$notification = $this->career_repository->find_one( $item );
			$html        .= get_partial( 'components/cards/career-card', $notification, true );
		}

		return $html;
	}
}
