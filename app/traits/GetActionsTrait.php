<?php
namespace gradZagrebWeb2024\traits;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

trait GetActionsTrait {

	use ACFLinkTrait;

	private function get_actions( $actions ): string {
		if ( empty( $actions ) ) {
			return '';
		}

		$output = '';

		foreach ( $actions as $action ) {
			if ( empty( $action['link'] ) ) {
				continue;
			}

			$output .= get_partial(
				'components/button',
				$this->link_for_button(
					array(
						...$action['link'],
						'type'    => 'link',
						'variant' => $action['variant'],
						'dataset' => '',
						'classes' => '',
					)
				),
				true
			);
		}

		return $output;
	}
}
