<?php

namespace gradZagrebWeb2024\modules;

use gradZagrebWeb2024\interfaces\ControllerInterface;
use gradZagrebWeb2024\traits\GetImageTrait;
use gradZagrebWeb2024\traits\GetLinkTrait;

class SplitImageTextCtaModule implements ControllerInterface {

	use GetImageTrait;

	use GetLinkTrait;

	private $module = array();

	private $data = array(
		'settings' => array(),
		'title'    => '',
		'text'     => '',
		'link'     => '',
		'links'    => array(),
		'image'    => '',
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
		$this->data['link']  = $this->get_link( $this->module['link'] );
		$this->data['links'] = is_array( $this->module['links'] ) ? $this->module['links'] : array();
		$this->data['image'] = $this->get_square_large_image( $this->module['image'] );

		return get_partial( 'modules/split-image-text-cta-module', $this->data, true );
	}
}
