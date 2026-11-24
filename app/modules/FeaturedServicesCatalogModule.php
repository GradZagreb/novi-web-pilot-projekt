<?php

namespace gradZagrebWeb2024\modules;

use gradZagrebWeb2024\interfaces\ControllerInterface;
use gradZagrebWeb2024\repositories\ServiceRepository;
use gradZagrebWeb2024\traits\GetLinkTrait;

class FeaturedServicesCatalogModule implements ControllerInterface {

	use GetLinkTrait;

	private $module = array();

	private $service_repository;

	private $data = array(
		'settings' => array(),
		'title'    => '',
		'text'     => '',
		'link'     => '',
		'services' => '',
	);

	public function __construct( array $module ) {
		$this->module             = $module;
		$this->service_repository = new ServiceRepository();
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
		$this->data['link']  = $this->get_primary_link( $this->module['link'] );
        $this->data['services'] = $this->get_services( $this->module['services'] );

		return get_partial( 'modules/featured-services-catalog-module', $this->data, true );
	}

	private function get_services( array|string $services ): string {
		if ( empty( $services ) ) {
			return '';
		}

		$params = array(
			'post__in' => $services,
		);

		$html = '';

		$services = $this->service_repository->find_all_by( $params );

		foreach ( $services['items'] as $service ) {
            $service['variant'] = 'dark';
			$html .= get_partial( 'components/cards/service-card', $service, true );
		}

		return $html;
	}
}
