<?php

namespace gradZagrebWeb2024\modules;

use gradZagrebWeb2024\interfaces\ControllerInterface;
use gradZagrebWeb2024\repositories\TenderRepository;

class FeaturedTendersModule implements ControllerInterface {

	private $module = array();

    private $tender_repository;

	private $data = array(
		'settings' => array(),
		'title'    => '',
		'link'     => array(),
		'tenders'  => '',
	);

	public function __construct( array $module ) {
		$this->module = $module;
        $this->tender_repository = new TenderRepository();
	}

	public function get_view(): string {

		if ( empty( $this->module['settings']['show'] ) ) {
			return '';
		}

		if ( ! empty( $this->module['settings'] ) ) {
			$this->data['settings'] = $this->module['settings'];
		}

        $this->data['title'] = $this->module['title'];
        $this->data['link']  = $this->module['link'];

        $this->data['tenders'] = $this->get_tenders( $this->module['tenders'] );

		return get_partial( 'modules/featured-tenders-module', $this->data, true );
	}

    public function get_tenders( $items ) {
        if ( empty( $items ) ) {
            return '';
        }

        $html = '';

        foreach ( $items as $item ) {
            $tender = $this->tender_repository->find_one( $item );
            $tender['date'] = $this->get_date( $tender['date'] );
            $html        .= get_partial( 'components/cards/tender-card', $tender, true );
        }

        return $html;
    }

	private function get_date( $date ): string {
		if ( empty( $date ) ) {
			return '';
		}

		return get_partial(
			'components/tag',
			array(
				'label'   => $date,
				'classes' => 'c-tag--light-gray',
			),
			true
		);
	}
}
