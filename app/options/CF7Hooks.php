<?php

namespace gradZagrebWeb2024\options;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class CF7Hooks {

	public function init(): void {
		if ( ! is_admin() ) {
			add_action(
				'wpcf7_init',
				function () {
					add_filter( 'wpcf7_form_tag', array( $this, 'slim_select_attributes' ), 10, 2 );
					add_filter( 'wpcf7_form_tag', array( $this, 'select_taxonomy_term' ), 10, 2 );
				}
			);
		}
	}

	function slim_select_attributes( $tag, $replace ) {

		if ( ! ( 'select' === $tag['type'] || 'select*' === $tag['type'] ) ) {
			return $tag;
		}

		if ( ! in_array( 'ss-config-enable', (array) $tag['options'] ) ) {
			return $tag;
		}

		if ( ! empty( $replace ) ) {
			return $tag;
		}

		$cf7_options = array();
		$ss_options  = array();

		foreach ( (array) $tag['options'] as $option ) {

			if ( 'ss-config-enable' === $option ) {
				continue;
			}

			if ( 0 === strpos( $option, 'ss-data' ) ) {

				$new_option = str_replace( 'ss-data', 'data', $option );

				if ( false !== strpos( $option, ':' ) ) {
					$ex                   = explode( ':', $new_option );
					$ss_options[ $ex[0] ] = apply_filters( 'wpcf7_option_value', $ex[1], $ex[0] );
				} else {
					$ss_options[ $new_option ] = '';
				}
			} elseif ( 0 === strpos( $option, 'ss-' ) ) {

				$new_option = str_replace( 'ss-', '', $option );

				if ( false !== strpos( $option, ':' ) ) {
					$ex                   = explode( ':', $new_option );
					$ss_options[ $ex[0] ] = apply_filters( 'wpcf7_option_value', $ex[1], $ex[0] );
				}
			} else {
				$cf7_options[] = $option;
			}
		}

		$tag['options'] = $cf7_options;

		$name = $tag['name'];

		add_filter(
			'wpcf7_form_elements',
			function ( $content ) use ( $name, $ss_options ) {
				static $register = array();

				if ( isset( $register[ $name ] ) ) {
					return $content;
				}

				$register[ $name ] = true;

				$attributesHtml = '';

				foreach ( $ss_options as $key => $value ) {
					$attributesHtml .= ' ' . $key;

					if ( is_string( $value ) && strlen( $value ) > 0 ) {
						$attributesHtml .= '="' . $value . '"';
					}
				}

				$content = str_replace( ' name="' . $name . '">', $attributesHtml . ' name="' . $name . '">', $content );

				if ( isset( $ss_options['data-placeholder'] ) ) {
					$content = str_replace( ' name="' . $name . '">', ' name="' . $name . '"><option data-placeholder="true"></option>', $content );
				} elseif ( isset( $ss_options['placeholder'] ) ) {
					$content = str_replace( ' name="' . $name . '">', ' name="' . $name . '"><option data-placeholder="true">' . $ss_options['placeholder'] . '</option>', $content );
				}

				return $content;
			}
		);

		return $tag;
	}

	function select_taxonomy_term( $tag ) {
		if ( ! ( 'select' === $tag['type'] ) && $tag['name'] != 'select-taxonomy' ) {
			return $tag;
		}

        $slug = $tag['options'][0];

        if( empty( $slug ) ) {
            return '';
        }

        $slug = str_replace('slug:', '', $slug);

        $terms = get_terms( array(
            'taxonomy' => $slug,
            'hide_empty' => false,
        ) );

        if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
            foreach ( $terms as $term ) {
                $tag['raw_values'][] = $term->name;
                $tag['values'][]     = $term->slug;
            }
        }

        $tag['labels'] = $tag['raw_values'];
        $tag['values'] = $tag['raw_values'];

        return $tag;
	}
}
