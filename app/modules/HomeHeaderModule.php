<?php

namespace gradZagrebWeb2024\modules;

use gradZagrebWeb2024\interfaces\ControllerInterface;
use gradZagrebWeb2024\traits\GetImageTrait;

class HomeHeaderModule implements ControllerInterface {

	use GetImageTrait;

	private $module = array();

	private $data = array(
		'settings'       => array(),
		'title'          => '',
		'image'          => '',
	);

	public function __construct( array $module ) {
		$this->module = $module;
	}

	public function get_view(): string {

		if ( empty( $this->module['settings']['show'] ) ) {
			return '';
		}

		if ( ! empty( $this->module['settings'] ) ) {
			$this->data['settings'] = $this->module['settings'];
		}

		$this->data['title'] = $this->module['title'];
		$this->data['image'] = $this->get_large_header_background_image( $this->module['image'] );

		return get_partial( 'modules/home-header-module', $this->data, true );
	}
}
