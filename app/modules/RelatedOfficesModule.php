<?php

namespace gradZagrebWeb2024\modules;

use gradZagrebWeb2024\interfaces\ControllerInterface;
use gradZagrebWeb2024\repositories\OfficeRepository;
use gradZagrebWeb2024\traits\GetImageTrait;

class RelatedOfficesModule implements ControllerInterface {

	use GetImageTrait;

	private $module = array();

	private $office_repository;

	private $data = array(
		'settings' => array(),
		'title'    => '',
		'offices'  => array(),
	);

	public function __construct( array $module ) {
		$this->module            = $module;
		$this->office_repository = new OfficeRepository();
	}

	public function get_view(): string {

		if ( empty( $this->module['settings']['show'] ) ) {
			return '';
		}

		if ( ! empty( $this->module['settings'] ) ) {
			$this->data['settings'] = $this->module['settings'];
		}

		$this->data['title']   = $this->module['title'];
		$this->data['offices'] = $this->get_offices( $this->module['offices'] );

		return get_partial( 'modules/related-offices-module', $this->data, true );
	}

	private function get_offices( array|string $offices ): array {
		if ( empty( $offices ) ) {
			return array();
		}

		$data = array();

		foreach ( $offices as $office ) {
			$data[] = $this->office_repository->find_one( $office );
		}

		return $data;
	}
}
