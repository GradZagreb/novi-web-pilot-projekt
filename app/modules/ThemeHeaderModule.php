<?php

namespace gradZagrebWeb2024\modules;

use gradZagrebWeb2024\interfaces\ControllerInterface;
use gradZagrebWeb2024\traits\GetActionsTrait;
use gradZagrebWeb2024\traits\GetImageTrait;

class ThemeHeaderModule implements ControllerInterface {

	use GetActionsTrait;
	use GetImageTrait;

	private $module = array();

	private $data = array(
		'settings' => array(),
		'title'    => '',
		'image'    => '',
		'text'     => '',
		'actions'  => '',
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
		$this->data['image']   = $this->get_large_header_image( $this->module['image'] );
		$this->data['text']    = $this->module['text'];
		$this->data['actions'] = $this->get_actions( $this->module['actions'] );

		return get_partial( 'modules/theme-header-module', $this->data, true );
	}
}
