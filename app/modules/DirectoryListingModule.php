<?php

namespace gradZagrebWeb2024\modules;

use gradZagrebWeb2024\interfaces\ControllerInterface;
use gradZagrebWeb2024\repositories\DirectoryRepository;

class DirectoryListingModule implements ControllerInterface {

	private $directory_repository;

	private $module = array();

	private $data = array(
		'settings'   => array(),
		'title'      => '',
		'show_items' => array(),
		'contacts'   => array(),
	);

	public function __construct( array $module ) {
		$this->directory_repository = new DirectoryRepository();
		$this->module               = $module;
	}

	public function get_view(): string {

		if ( empty( $this->module['settings']['show'] ) ) {
			return '';
		}

		if ( ! empty( $this->module['settings'] ) ) {
			$this->data['settings'] = $this->module['settings'];
		}

		$this->data['title']      = $this->module['title'];
		$this->data['show_items'] = $this->module['show_items'];

		if ( $this->module['settings']['automated'] ) {
			$this->data['contacts'] = $this->get_automated_contacts( $this->module['categories'] );
		} else {
			$this->data['contacts'] = $this->get_manual_contacts( $this->module['list'] );
		}

		return get_partial( 'modules/directory-listing-module', $this->data, true );
	}

	private function get_automated_contacts( array|bool $categories ): array {
		if ( empty( $categories ) || ! is_array( $categories ) ) {
			return array();
		}

		foreach ( $categories as $category_id ) {
			$term             = get_term( $category_id );
			$category_terms[] = $term->slug;
		}

		if ( empty( $category_terms ) ) {
			return array();
		}

		$arr   = array();
		$items = $this->directory_repository->find_automated_contacts( $category_terms );
		$arr   = $items;

		return $arr;
	}

	private function get_manual_contacts( array|string $items ): array {
		if ( empty( $items ) ) {
			return array();
		}

		$arr = array();

		foreach ( $items as $item ) {
			$contact = $this->directory_repository->find_one( $item );
			$arr[]   = $contact;
		}

		return $arr;
	}
}
