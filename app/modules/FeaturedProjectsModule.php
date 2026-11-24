<?php

namespace gradZagrebWeb2024\modules;

use gradZagrebWeb2024\interfaces\ControllerInterface;
use gradZagrebWeb2024\repositories\ProjectRepository;

class FeaturedProjectsModule implements ControllerInterface {

	private $module = array();

    private $project_repository;

	private $data = array(
		'settings' => array(),
		'title'    => '',
		'link'     => array(),
		'projects' => '',
	);

	public function __construct( array $module ) {
		$this->module = $module;
        $this->project_repository = new ProjectRepository();
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

        $this->data['projects'] = $this->get_projects( $this->module['projects'] );

		return get_partial( 'modules/featured-projects-module', $this->data, true );
	}

    public function get_projects( $items ) {
        if ( empty( $items ) ) {
            return '';
        }

        $html = '';

        foreach ( $items as $item ) {
            $notification = $this->project_repository->find_one( $item );
            $html        .= get_partial( 'components/cards/project-card', $notification, true );
        }

        return $html;
    }
}
