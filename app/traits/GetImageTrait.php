<?php

namespace gradZagrebWeb2024\traits;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

trait GetImageTrait {
	private function get_image( $image_id ): string {
		if ( empty( $image_id ) ) {
			return '';
		}

		$args = array(
			'image'           => $image_id,
			'sizes'           => array(
				'widescreen'        => 'image_1920',
				'widescreen_retina' => 'image_2880',
				'desktop'           => 'image_1200',
				'desktop_retina'    => 'image_1440',
				'tablet'            => 'image_800',
				'tablet_retina'     => 'image_900',
				'mobile'            => 'image_600',
				'mobile_retina'     => 'image_700',
			),
			'alt'             => 'Image',
			'aspect_ratio'    => '4-3',
			'object_fit'      => 'cover',
			'object_position' => 'center',
			'is_background'   => false,
			'lazy'            => true,
			'native_lazy'     => false,
			'priority'        => false,
			'animate'         => true,
			'width'           => '',
			'height'          => '',
			'loader_bg'       => '',
			'modifier_class'  => '',
		);

		return get_responsive_image( $args );
	}

	private function get_large_header_background_image( $image_id ): string {
		if ( empty( $image_id ) ) {
			return '';
		}

		$args = array(
			'image'           => $image_id,
			'sizes'           => array(
				'widescreen'        => 'image_1440',
				'widescreen_retina' => 'image_1920',
				'desktop'           => 'image_800',
				'desktop_retina'    => 'image_1440',
				'tablet'            => 'image_800',
				'tablet_retina'     => 'image_1440',
				'mobile'            => 'image_480',
				'mobile_retina'     => 'image_800',
			),
			'alt'             => '',
			'aspect_ratio'    => 'adopt',
			'object_fit'      => 'cover',
			'object_position' => 'center',
			'is_background'   => true,
			'lazy'            => false,
			'native_lazy'     => false,
			'priority'        => true,
			'animate'         => false,
			'width'           => '',
			'height'          => '',
			'loader_bg'       => '',
			'modifier_class'  => '',
		);

		return get_responsive_image( $args );
	}

	private function get_large_header_image( $image_id ): string {
		if ( empty( $image_id ) ) {
			return '';
		}

		$args = array(
			'image'           => $image_id,
			'sizes'           => array(
				'widescreen'        => 'image_1440',
				'widescreen_retina' => 'image_1920',
				'desktop'           => 'image_800',
				'desktop_retina'    => 'image_1440',
				'tablet'            => 'image_800',
				'tablet_retina'     => 'image_1440',
				'mobile'            => 'image_480',
				'mobile_retina'     => 'image_800',
			),
			'alt'             => '',
			'aspect_ratio'    => '5-3',
			'object_fit'      => 'cover',
			'object_position' => 'center',
			'is_background'   => false,
			'lazy'            => false,
			'native_lazy'     => false,
			'priority'        => true,
			'animate'         => false,
			'width'           => '',
			'height'          => '',
			'loader_bg'       => '',
			'modifier_class'  => '',
		);

		return get_responsive_image( $args );
	}

	private function get_card_small_image( $image_id ): string {
		if ( empty( $image_id ) ) {
			return '';
		}

		$args = array(
			'image'           => $image_id,
			'sizes'           => array(
				'widescreen'        => 'image_480',
				'widescreen_retina' => 'image_700',
				'desktop'           => 'image_240',
				'desktop_retina'    => 'image_480',
				'desktop'           => 'image_240',
				'desktop_retina'    => 'image_480',
				'mobile'            => 'image_480',
				'mobile_retina'     => 'image_800',
			),
			'alt'             => '',
			'aspect_ratio'    => '4-3',
			'object_fit'      => 'cover',
			'object_position' => 'center',
			'is_background'   => false,
			'lazy'            => true,
			'native_lazy'     => false,
			'priority'        => false,
			'animate'         => true,
			'width'           => '',
			'height'          => '',
			'loader_bg'       => '',
			'modifier_class'  => '',
		);

		return get_responsive_image( $args );
	}

	private function get_card_small_vertical_image( $image_id ): string {
		if ( empty( $image_id ) ) {
			return '';
		}

		$args = array(
			'image'           => $image_id,
			'sizes'           => array(
				'widescreen'        => 'image_480',
				'widescreen_retina' => 'image_700',
				'desktop'           => 'image_240',
				'desktop_retina'    => 'image_480',
				'desktop'           => 'image_240',
				'desktop_retina'    => 'image_480',
				'mobile'            => 'image_480',
				'mobile_retina'     => 'image_800',
			),
			'alt'             => '',
			'aspect_ratio'    => '3-4',
			'object_fit'      => 'cover',
			'object_position' => 'center',
			'is_background'   => false,
			'lazy'            => true,
			'native_lazy'     => false,
			'priority'        => false,
			'animate'         => true,
			'width'           => '',
			'height'          => '',
			'loader_bg'       => '',
			'modifier_class'  => '',
		);

		return get_responsive_image( $args );
	}

	private function get_card_large_image( $image_id ): string {
		if ( empty( $image_id ) ) {
			return '';
		}

		$args = array(
			'image'           => $image_id,
			'sizes'           => array(
				'widescreen'        => 'image_1440',
				'widescreen_retina' => 'image_1920',
				'desktop'           => 'image_800',
				'desktop_retina'    => 'image_1440',
				'tablet'            => 'image_800',
				'tablet_retina'     => 'image_1440',
				'mobile'            => 'image_480',
				'mobile_retina'     => 'image_800',
			),
			'alt'             => '',
			'aspect_ratio'    => '4-3',
			'object_fit'      => 'cover',
			'object_position' => 'center',
			'is_background'   => false,
			'lazy'            => true,
			'native_lazy'     => false,
			'priority'        => false,
			'animate'         => true,
			'width'           => '',
			'height'          => '',
			'loader_bg'       => '',
			'modifier_class'  => '',
		);

		return get_responsive_image( $args );
	}

	private function get_square_large_image( $image_id ): string {
		if ( empty( $image_id ) ) {
			return '';
		}

		$args = array(
			'image'           => $image_id,
			'sizes'           => array(
				'widescreen'        => 'image_1440',
				'widescreen_retina' => 'image_1920',
				'desktop'           => 'image_800',
				'desktop_retina'    => 'image_1440',
				'tablet'            => 'image_800',
				'tablet_retina'     => 'image_1440',
				'mobile'            => 'image_480',
				'mobile_retina'     => 'image_800',
			),
			'alt'             => '',
			'aspect_ratio'    => '1-1',
			'object_fit'      => 'cover',
			'object_position' => 'center',
			'is_background'   => false,
			'lazy'            => true,
			'native_lazy'     => false,
			'priority'        => false,
			'animate'         => true,
			'width'           => '',
			'height'          => '',
			'loader_bg'       => '',
			'modifier_class'  => '',
		);

		return get_responsive_image( $args );
	}
}
