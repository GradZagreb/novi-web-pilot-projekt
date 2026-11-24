<?php

namespace gradZagrebWeb2024\modules;

use gradZagrebWeb2024\interfaces\ControllerInterface;
use gradZagrebWeb2024\traits\GetActionsTrait;
use gradZagrebWeb2024\traits\GetImageTrait;

class OfficeHeaderModule implements ControllerInterface {

	use GetActionsTrait;

	private $module = array();

	private $data = array(
		'settings'    => array(),
		'title'       => '',
		'description' => '',
		'actions'     => '',
		'infos'       => array(),
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

		$this->data['title']       = $this->module['title'];
		$this->data['description'] = $this->module['description'];
		$this->data['actions']     = $this->get_actions( $this->module['actions'] );
		$this->data['infos']       = $this->module['infos'];

		return get_partial( 'modules/office-header-module', $this->data, true );
	}
}
