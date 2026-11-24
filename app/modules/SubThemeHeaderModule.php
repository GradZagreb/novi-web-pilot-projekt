<?php

namespace gradZagrebWeb2024\modules;

use gradZagrebWeb2024\interfaces\ControllerInterface;

class SubThemeHeaderModule implements ControllerInterface {

	private $module = array();

	private $data = array(
		'settings' => array(),
		'title'    => '',
		'text'     => '',
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
		$this->data['text']  = $this->module['text'];

		return get_partial( 'modules/sub-theme-header-module', $this->data, true );
	}
}
