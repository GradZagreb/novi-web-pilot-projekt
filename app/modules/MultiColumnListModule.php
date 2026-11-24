<?php

namespace gradZagrebWeb2024\modules;

use gradZagrebWeb2024\interfaces\ControllerInterface;

class MultiColumnListModule implements ControllerInterface {

	private $module = array();

	private $data = array(
		'settings' => array(),
		'title'    => '',
		'items'    => array(),
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
		$this->data['items'] = is_array( $this->module['items'] ) ? $this->module['items'] : array();

		return get_partial( 'modules/multi-column-list-module', $this->data, true );
	}
}
