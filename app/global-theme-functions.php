<?php

use gradZagrebWeb2024\lib\core\PartialFinder;
use gradZagrebWeb2024\modules\Modules;
use gradZagrebWeb2024\helpers\ImageHelper;

define( 'MODEL', 'MODEL' );

function bu( $url ) {
	$clean = trim( $url );

	return INCLUDE_URL . "/static/" . $clean;
}

function au( $url ) {
	$clean = trim( $url );

	return get_template_directory() . "/static/" . $clean;
}

function get_partial( $partial, $data = null, $return = false, $folder = PartialFinder::PARTIAL_FOLDER ) {
	return PartialFinder::get_instance()->get_partial( $partial, $data, $return, $folder );
}

function get_slice_partial(string $partial, array $data = array(), bool $return = false) {
	return get_partial($partial, $data, $return, 'slice/partials');
}

function get_icon( string $name ) : string {
	return get_partial( 'icons/icon-' . $name, [], true, 'static' );
}

function bf_content( int $id = null ) {
	global $post;

	if ( empty( $id ) ) {
		$id = $post->ID;
	}

	return apply_filters( 'the_content', get_post_field( 'post_content', $id ) );
}

function get_modules_partial( null|array|bool $modules ): void {
	if ( ! empty( $modules ) && is_array( $modules ) ) {
		foreach ( $modules as $index => $module ) {
			$module['index'] = $index;

			echo Modules::get_module( $module )->get_view();
		}
	}
}

function get_static_modules_partial( null|array|bool $modules ): void {
	if ( ! empty( $modules ) && is_array( $modules ) ) {
		$i = 0;
		foreach ( $modules as $index => $module ) {
			$module['index'] = $i++;
			echo Modules::get_module( $module, $index )->get_view();
		}
	}
}

function get_responsive_image( array $args ): string {
    if ( empty( $args['image'] ) && ! empty( $args['urls'] ) ) {
        return get_partial( 'components/responsive-image', $args, true );
    }

    if ( is_int( $args['image'] ) && ! empty( $args['sizes'] ) ) {
        $image_helper = new ImageHelper();
        $args['urls'] = array();

        foreach ( $args['sizes'] as $key => $size ) {
            if( is_array( $size ) && ! empty( $size[0] ) && ! empty( $size[1] )  ) {
                $args['urls'][ $key ] = $image_helper->get_image_by_size_name( $size[0], $size[1] );
            } else if( is_string( $size ) ) {
                $args['urls'][ $key ] = $image_helper->get_image_by_size_name( $args['image'], $size );
            }
        }

        $args['alt'] = $image_helper->get_attachment_alt_text( $args['image'] );

        return get_partial( 'components/responsive-image', $args, true );
    }

    return '';
}

function get_responsive_video( array $args ): string {

    $defaults = array();

    if( isset( $args['qhd_video_poster'] ) && is_array( $args['qhd_video_poster'] ) && count( $args['qhd_video_poster'] ) == 2 ) {
        $image_helper = new ImageHelper();
        $args['qhd_video_poster'] = $image_helper->get_image_by_size_name( $args['qhd_video_poster'][0], $args['qhd_video_poster'][1] );
    }

    if( isset( $args['fhd_video_poster'] ) && is_array( $args['fhd_video_poster'] ) && count( $args['fhd_video_poster'] ) == 2 ) {
        $image_helper = new ImageHelper();
        $args['fhd_video_poster'] = $image_helper->get_image_by_size_name( $args['fhd_video_poster'][0], $args['fhd_video_poster'][1] );
    }

    if( isset( $args['hd_video_poster'] ) && is_array( $args['hd_video_poster'] ) && count( $args['hd_video_poster'] ) == 2 ) {
        $image_helper = new ImageHelper();
        $args['hd_video_poster'] = $image_helper->get_image_by_size_name( $args['hd_video_poster'][0], $args['hd_video_poster'][1] );
    }

    if( isset( $args['sd_video_poster'] ) && is_array( $args['sd_video_poster'] ) && count( $args['sd_video_poster'] ) == 2 ) {
        $image_helper = new ImageHelper();
        $args['sd_video_poster'] = $image_helper->get_image_by_size_name( $args['sd_video_poster'][0], $args['sd_video_poster'][1] );
    }

    $args = array_merge( $defaults, $args );

    return get_partial( 'components/responsive-video', $args, true );
}
