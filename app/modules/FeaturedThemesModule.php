<?php

namespace gradZagrebWeb2024\modules;

use gradZagrebWeb2024\interfaces\ControllerInterface;
use gradZagrebWeb2024\traits\GetImageTrait;

class FeaturedThemesModule implements ControllerInterface {

	use GetImageTrait;

	private $module = array();

	private $data = array(
		'settings' => array(),
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

		$this->data['links'] = $this->get_theme_links( $this->module['theme_links'] );

		return get_partial( 'modules/featured-themes-module', $this->data, true );
	}

	private function get_theme_links( array|string $items ): string {
		if ( empty( $items ) ) {
			return '';
		}

		$html = '';

		foreach ( $items as $item ) {
			$item['image'] = $this->get_image( $item['image'], 'full' );
			$html         .= get_partial( 'components/cards/featured-theme-card', $item, true );
		}

		return $html;
	}
}
