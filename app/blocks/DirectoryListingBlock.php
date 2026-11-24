<?php

namespace gradZagrebWeb2024\blocks;

use gradZagrebWeb2024\interfaces\BlockInterface;
use gradZagrebWeb2024\repositories\DirectoryRepository;

class DirectoryListingBlock implements BlockInterface {
	private $directory_repository;

	public function __construct() {
		$this->directory_repository = new DirectoryRepository();
	}

	public function get_settings(): array {
		return array(
			'name'            => 'directory-listing-block',
			'title'           => 'Directory Listing Block',
			'description'     => 'Directory Listing Block',
			'category'        => 'grad-zagreb-blocks',
			'icon'            => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M20 22H6.5C4.567 22 3 20.433 3 18.5V5C3 3.34315 4.34315 2 6 2H20C20.5523 2 21 2.44772 21 3V21C21 21.5523 20.5523 22 20 22ZM19 20V17H6.5C5.67157 17 5 17.6716 5 18.5C5 19.3284 5.67157 20 6.5 20H19ZM10 4V12L13.5 10L17 12V4H10Z"></path></svg>',
			'mode'            => 'edit',
			'keywords'        => array( 'list' ),
			'post_types'      => array( 'theme' ),
			'example'         => array(
				'attributes' => array(
					'mode' => 'preview',
				),
			),
			'supports'        => array(
				'align'           => false,
				'customClassName' => false,
				'mode'            => false,
			),
			'render_callback' => array( $this, 'get_view' ),
		);
	}

	public function get_view( array $block ): void {
		if ( is_admin() ) {
			return;
		}

		$data = $block['data'];

		$arr = array();

		if ( ! empty( $data['title'] ) ) {
			$arr['title'] = $block['data']['title'];
		}

		if ( ! empty( $data['categories'] ) ) {
			$arr['contacts'] = $this->get_automated_contacts( $data['categories'], $data['show_items'] );
		}

		if ( ! empty( $data['list'] ) ) {
			$arr['contacts'] = $this->get_manual_contacts( $data['list'], $data['show_items'] );
		}

		get_partial(
			'blocks/directory-listing-block/list',
			$arr
		);
	}

	private function get_automated_contacts( array $categories, array $show_items ): string {
		foreach ( $categories as $category_id ) {
			$term             = get_term( $category_id );
			$category_terms[] = $term->slug;
		}

		$html = '';

		$items = $this->directory_repository->find_automated_contacts( $category_terms );

		foreach ( $items as $item ) {
			$item['show_items'] = $show_items;
			$html              .= get_partial(
				'blocks/directory-listing-block/item',
				$item,
				true
			);
		}

		return $html;
	}

	private function get_manual_contacts( array $items, array $show_items ): string {
		if ( empty( $items ) ) {
			return '';
		}

		$html = '';

		foreach ( $items as $item ) {
			$contact               = $this->directory_repository->find_one( $item );
			$contact['show_items'] = $show_items;
			$html                 .= get_partial( 'blocks/directory-listing-block/item', $contact, true );
		}

		return $html;
	}
}
