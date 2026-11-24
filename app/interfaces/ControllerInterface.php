<?php

namespace gradZagrebWeb2024\interfaces;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

interface ControllerInterface {
	public function get_view(): string;
}
