<?php

namespace gradZagrebWeb2024\modules;

use gradZagrebWeb2024\interfaces\ControllerInterface;
use gradZagrebWeb2024\repositories\NotificationRepository;

class NotificationsModule implements ControllerInterface {

	private $module = array();

	private $notification_repository;

	private $data = array(
		'settings'      => array(),
		'notifications' => '',
	);

	public function __construct( array $module ) {
		$this->module                  = $module;
		$this->notification_repository = new NotificationRepository();
	}

	public function get_view(): string {

		if ( empty( $this->module['settings']['show'] ) ) {
			return '';
		}

		if ( ! empty( $this->module['settings'] ) ) {
			$this->data['settings'] = $this->module['settings'];
		}

		if ( $this->data['settings']['automated'] ) {
			$this->data['notifications'] = $this->get_automated_notifications(
				array(
					$this->module['max_items'],
					$this->module['themes'],
					$this->module['offices'],
				)
			);
		} else {
			$this->data['notifications'] = $this->get_manual_notifications( $this->module['notifications'] );
		}

		return get_partial( 'modules/notifications-module', $this->data, true );
	}

	private function get_automated_notifications( array $args ): string {

		$html = '';

		list( $max_items, $themes, $offices ) = $args;

		if ( empty( $themes ) ) {
			$themes      = array();
			$theme_terms = array();
		}

		if ( empty( $offices ) ) {
			$offices      = array();
			$office_terms = array();
		}

		foreach ( $themes as $term_id ) {
			$term          = get_term( $term_id );
			$theme_terms[] = $term->slug;
		}

		foreach ( $offices as $office_id ) {
			$office         = get_term( $office_id );
			$office_terms[] = $office->slug;
		}

		$items = $this->notification_repository->find_automated_notificatons( $max_items, $theme_terms, $office_terms );

		foreach ( $items as $item ) {
			$html .= get_partial( 'components/notification', $item, true );
		}

		return $html;
	}

	private function get_manual_notifications( array|string $items ): string {
		if ( empty( $items ) ) {
			return '';
		}

		$html = '';

		foreach ( $items as $item ) {
			$notification = $this->notification_repository->find_one( $item );
			$html        .= get_partial( 'components/notification', $notification, true );
		}

		return $html;
	}
}
