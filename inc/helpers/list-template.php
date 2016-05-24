<?php

if ( ! function_exists( 'presscore_list_container_data_atts' ) ) :

	/**
	 * [presscore_list_container_data_atts description]
	 *
	 * @since 2.1.0
	 * 
	 * @return satring [description]
	 */
	function presscore_list_container_data_atts( $custom_atts = array() ) {
		$data_atts = array(
			'data-cur-page="' . dt_get_paged_var() . '"'
		);
		$data_atts = array_merge( $data_atts, $custom_atts );

		return ' ' . implode( ' ', $data_atts );
	}

endif;

if ( ! function_exists( 'presscore_list_container_html_class' ) ) :

	/**
	 * @since 1.0.0
	 * 
	 * @param  array  $class
	 * @return string
	 */
	function presscore_list_container_html_class( $custom_class = array() ) {
		$config = presscore_get_config();

		$html_class = array();

		if ( 'dark' == $config->get( 'post.preview.hover.color' ) ) {
			$html_class[] = 'hover-color-static';
		}

		$html_class[] = presscore_tpl_get_load_effect_class( $config->get( 'post.preview.load.effect' ) );

		// ajax class
		if ( !in_array( $config->get( 'load_style' ), array( 'default', false ) ) ) {
			$html_class[] = 'with-ajax';
		}

		// lazy loading
		if ( 'lazy_loading' == $config->get( 'load_style' ) ) {
			$html_class[] = 'lazy-loading-mode';
		}

		//////////////
		// Output //
		//////////////

		if ( $custom_class && ! is_array( $custom_class ) ) {
			$custom_class = explode( ' ', $custom_class );
		}

		$html_class = apply_filters( 'presscore_masonry_container_class', array_merge( $custom_class, $html_class ) );

		return $html_class ? sprintf( 'class="%s"', presscore_esc_implode( ' ', array_unique( $html_class ) ) ) : '';
	}

endif;