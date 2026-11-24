<?php

namespace gradZagrebWeb2024\traits;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

trait ACFLinkTrait {
	private function link_for_button( $att = array() ): array|null {

		$arr = array(
			'title'    => $att['title'] ?? '',
			'url'      => $att['url'] ?? '#',
			'target'   => $att['target'] ?? '',
			'type'     => $att['type'] ?? 'link',
			'dataset'  => $att['dataset'] ?? '',
			'variant'  => $att['variant'] ?? 'primary',
			'disabled' => $att['disabled'] ?? false,
			'icon'     => $att['icon'] ?? '',
			'classes'  => '',
		);

		if ( ! empty( $att['variant'] ) ) {
			$arr['classes'] .= ' c-button--' . $att['variant'];
		}

		if ( ! empty( $att['disabled'] ) ) {
			$arr['classes'] .= ' is-disabled';
		}

		if ( ! empty( $att['classes'] ) ) {
			$arr['classes'] .= ' ' . $att['classes'];
		}

		if ( $att['variant'] === 'secondary' ) {
			$arr['icon'] = get_partial(
				'components/circle',
				array(
					'icon' => 'arrow-right',
				),
				true
			);
		}

		return $arr;
	}
}
