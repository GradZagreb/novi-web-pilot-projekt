<?php

namespace gradZagrebWeb2024\modules;

use gradZagrebWeb2024\interfaces\ControllerInterface;

class FeaturedLinksPrimaryModule implements ControllerInterface {

	private $module = array();

	private $data = array(
		'settings' => array(),
		'title'    => '',
		'links'    => '',
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
		$this->data['links'] = $this->get_link_items( $this->module['links'] );

		return get_partial( 'modules/featured-links-primary-module', $this->data, true );
	}

	public function get_link_items( $links ) {
		$html = '';

		if ( empty( $links ) ) {
			return '';
		}

		foreach ( $links as $link ) {
			$html .= get_partial(
				'components/cards/featured-link-primary-card',
				array(
					'link'  => $link['link'],
					'title' => $link['title'],
					'icon'  => $link['icon'],
				),
				true
			);
		}

		return $html;
	}
}
