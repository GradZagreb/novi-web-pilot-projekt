<?php

namespace gradZagrebWeb2024\interfaces;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

interface BlockInterface {
	public function get_settings(): array;

	public function get_view( array $block ): void;
}
