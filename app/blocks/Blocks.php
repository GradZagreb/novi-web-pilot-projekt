<?php

namespace gradZagrebWeb2024\blocks;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use gradZagrebWeb2024\lib\blocks\BaseBlocks;

final class Blocks extends BaseBlocks {
	public function get_blocks(): array {
		return array(
			'split-image-text-cta-block',
            'gallery-slider-block',
            'directory-listing-block',
		);
	}

	public function get_namespace(): string {
		return 'gradZagrebWeb2024\blocks\\';
	}

	protected function get_default_blocks(): array {
		return array(
			'core/heading',
			'core/paragraph',
			'core/list',
			'core/list-item',
			'core/image',
            'core/table',
		);
	}
}
