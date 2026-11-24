<?php

namespace gradZagrebWeb2024\modules;

use gradZagrebWeb2024\interfaces\ControllerInterface;

class SubThemeContentModule implements ControllerInterface {

	private $module = array();

	private $data = array(
		'settings' => array(),
		'title'    => '',
		'content'  => array(),
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

		$this->data['title']   = $this->module['title'];
		$this->data['content'] = is_array( $this->module['content'] ) ? $this->module['content'] : array();

		return get_partial( 'modules/sub-theme-content-module', $this->data, true );
	}
}
