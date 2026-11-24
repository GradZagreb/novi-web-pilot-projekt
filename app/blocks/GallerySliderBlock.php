<?php

namespace gradZagrebWeb2024\blocks;

use gradZagrebWeb2024\interfaces\BlockInterface;
use gradZagrebWeb2024\traits\GetImageTrait;

class GallerySliderBlock implements BlockInterface {

	use GetImageTrait;

	public function get_settings(): array {
		return array(
			'name'            => 'gallery-slider-block',
			'title'           => 'Gallery Slider Block',
			'description'     => 'Gallery Slider Block',
			'category'        => 'grad-zagreb-blocks',
			'icon'            => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M6 4C6 3.44772 6.44772 3 7 3H21C21.5523 3 22 3.44772 22 4V16C22 16.5523 21.5523 17 21 17H18V20C18 20.5523 17.5523 21 17 21H3C2.44772 21 2 20.5523 2 20V8C2 7.44772 2.44772 7 3 7H6V4ZM8 7H17C17.5523 7 18 7.44772 18 8V15H20V5H8V7ZM16 15.7394V9H4V18.6321L11.4911 11.6404L16 15.7394ZM7 13.5C7.82843 13.5 8.5 12.8284 8.5 12C8.5 11.1716 7.82843 10.5 7 10.5C6.17157 10.5 5.5 11.1716 5.5 12C5.5 12.8284 6.17157 13.5 7 13.5Z"></path></svg>',
			'mode'            => 'edit',
			'keywords'        => array( 'Gallery Slider' ),
			'post_types'      => array( 'project', 'capital-project', 'news', 'page' ),
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

		$arr = array(
			'gallery' => '',
		);

		foreach ( $block['data']['gallery'] as $image ) {
			$arr['gallery'] .= get_partial(
				'blocks/gallery-slider-block/slide',
				array(
					'image' => $this->get_image( (int) $image ),
				),
				true
			);
		}

		get_partial( 'blocks/gallery-slider-block/slider', $arr );
	}
}
