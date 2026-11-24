<?php

namespace gradZagrebWeb2024\modules;

use gradZagrebWeb2024\interfaces\ControllerInterface;
use gradZagrebWeb2024\repositories\EmployeeRepository;
use gradZagrebWeb2024\traits\GetImageTrait;

class EmployeesGridModule implements ControllerInterface {

    use GetImageTrait;

	private $module = array();

    private $employee_repository;

	private $data = array(
		'settings'  => array(),
		'title'     => '',
		'employees' => '',
	);

	public function __construct( array $module ) {
		$this->module = $module;
        $this->employee_repository = new EmployeeRepository();
	}

	public function get_view(): string {

		if ( empty( $this->module['settings']['show'] ) ) {
			return '';
		}

		if ( ! empty( $this->module['settings'] ) ) {
			$this->data['settings'] = $this->module['settings'];
		}

		$this->data['title']     = $this->module['title'];
		$this->data['employees'] = $this->get_employees( $this->module['employees'] );

		return get_partial( 'modules/employees-grid-module', $this->data, true );
	}

	private function get_employees( $employees ): string {
		$html = '';

		if ( ! empty( $employees ) ) {
			foreach ( $employees as $employee ) {
                $employee = $this->employee_repository->find_one( $employee );

                $employee['image'] = $this->get_card_small_vertical_image( $employee['image'] );

				$html .= get_partial(
					'components/cards/employee-card',
					$employee,
					true
				);
			}
		}

		return $html;
	}
}
