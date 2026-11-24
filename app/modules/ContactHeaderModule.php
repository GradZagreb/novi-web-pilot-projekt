<?php

namespace gradZagrebWeb2024\modules;

use gradZagrebWeb2024\interfaces\ControllerInterface;

class ContactHeaderModule implements ControllerInterface {

	private $module = array();

	private $data = array(
		'settings' => array(),
		'title'    => '',
		'text'     => '',
		'form'     => '',
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
		$this->data['form']  = $this->get_form( $this->module['form'] );

		return get_partial( 'modules/contact-header-module', $this->data, true );
	}

	private function get_form( $form_id ): string {
		if ( empty( $form_id ) ) {
			return '';
		}

		return do_shortcode( '[contact-form-7 id="' . $form_id . '" html_class="c-form"]' );
	}
}
