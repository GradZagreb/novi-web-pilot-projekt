<?php

namespace gradZagrebWeb2024\modules;

use gradZagrebWeb2024\interfaces\ControllerInterface;

class OfficeStatisticsModule implements ControllerInterface {

	private $module = array();

	private $data = array(
		'settings' => array(),
		'title'    => '',
		'link'     => array(),
		'groups'   => '',
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

		$this->data['title']  = $this->module['title'];
		$this->data['link']   = $this->module['link'];
		$this->data['groups'] = $this->get_groups( $this->module['groups'] );

		return get_partial( 'modules/office-statistics-module', $this->data, true );
	}

    private function get_groups( array|string $items ): string {
        if ( empty( $items ) ) {
            return '';
        }

        $html = '';

        foreach ( $items as $item ) {
            $html .= get_partial( 'components/cards/office-statistics-card', $item, true );
        }

        return $html;
    }
}
