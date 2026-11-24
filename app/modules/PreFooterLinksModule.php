<?php

namespace gradZagrebWeb2024\modules;

use gradZagrebWeb2024\interfaces\ControllerInterface;
use gradZagrebWeb2024\lib\core\ACFProvider;

class PreFooterLinksModule implements ControllerInterface {

	private $module = array();

	private $acf_provider;

	private $data = array(
		'settings' => array(),
		'links'    => array(),
	);

	public function __construct( array $module ) {
		$this->module       = $module;
		$this->acf_provider = ACFProvider::get_instance();
	}

	public function get_view(): string {

		if ( empty( $this->module['settings']['show'] ) ) {
			return '';
		}

		if ( ! empty( $this->module['settings'] ) ) {
			$this->data['settings'] = $this->module['settings'];
		}

		if ( ! empty( $this->data['settings']['use_default_data'] ) ) {
			$links = $this->acf_provider->get_option_field( 'pre-footer-links' );
		} else {
			$links = $this->module['links'];
		}
		$this->data['links'] = is_array( $links ) ? $links : array();

		return get_partial( 'modules/pre-footer-links-module', $this->data, true );
	}
}
