<?php

namespace gradZagrebWeb2024\traits;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

trait GetLinkTrait {

	use AcfLinkTrait;

	private function get_link( array|string $link ): string {
		if ( empty( $link ) ) {
			return '';
		}

		return get_partial(
			'components/button',
			$this->link_for_button(
				array(
					...$link,
					'type'    => 'link',
					'variant' => 'primary',
					'dataset' => '',
					'classes' => '',
				)
			),
			true
		);
	}

	private function get_primary_link( array|string $link ): string {
		if ( empty( $link ) ) {
			return '';
		}

		return get_partial(
			'components/button',
			$this->link_for_button(
				array(
					...$link,
					'type'    => 'link',
					'variant' => 'primary',
					'dataset' => '',
					'classes' => '',
				)
			),
			true
		);
	}

	private function get_secondary_link( array|string $link ): string {
		if ( empty( $link ) ) {
			return '';
		}

		return get_partial(
			'components/button',
			$this->link_for_button(
				array(
					...$link,
					'type'    => 'link',
					'variant' => 'secondary',
					'dataset' => '',
					'classes' => '',
				)
			),
			true
		);
	}
}
