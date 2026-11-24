<?php

namespace gradZagrebWeb2024\blocks;

use gradZagrebWeb2024\interfaces\BlockInterface;
use gradZagrebWeb2024\traits\ACFLinkTrait;
use gradZagrebWeb2024\traits\GetImageTrait;

class SplitImageTextCtaBlock implements BlockInterface {

	use GetImageTrait;

	use ACFLinkTrait;

	public function get_settings(): array {
		return array(
			'name'            => 'split-image-text-cta-block',
			'title'           => 'Split Image Text CTA Block',
			'description'     => 'Split Image Text CTA Block',
			'category'        => 'grad-zagreb-blocks',
			'icon'            => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M3 6H21V18H3V6ZM2 4C1.44772 4 1 4.44772 1 5V19C1 19.5523 1.44772 20 2 20H22C22.5523 20 23 19.5523 23 19V5C23 4.44772 22.5523 4 22 4H2ZM13 9H19V11H13V9ZM18 13H13V15H18V13ZM6 13H7V16H9V11H6V13ZM9 8H7V10H9V8Z"></path></svg>',
			'mode'            => 'edit',
			'keywords'        => array( 'Split Image Text Cta' ),
			'post_types'      => array( 'theme', 'page' ),
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

		$image = $this->get_card_small_image( $block['data']['image'] );

		$link = get_partial(
			'components/button',
			$this->link_for_button(
				array(
					...$block['data']['link'],
					'type'    => 'button',
					'variant' => 'primary',
				)
			),
			true
		);

		$arr = array(
			...$block['data'],
			'image' => $image,
			'link'  => $link,
		);

		get_partial( 'blocks/split-image-text-cta-block', $arr );
	}
}
