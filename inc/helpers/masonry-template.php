<?php
/**
 * Masonry templates helpers
 *
 * @package vogue
 * @since 1.0.0
 */

if ( ! function_exists( 'presscore_masonry_container_data_atts' ) ) :

	/**
	 * [presscore_masonry_container_data_atts description]
	 *
	 * @since 1.0.0
	 * 
	 * @return satring [description]
	 */
	function presscore_masonry_container_data_atts( $custom_atts = array() ) {

		$config = Presscore_Config::get_instance();

		$data_atts = array(
			'data-padding="' . intval( $config->get( 'item_padding' ) ) . 'px"',
			'data-cur-page="' . dt_get_paged_var() . '"'
		);
		$data_atts = array_merge( $data_atts, $custom_atts );

		if ( $config->get( 'hide_last_row' ) ) {
			$data_atts[] = 'data-part-row="false"';
		}

		$target_height = $config->get( 'target_height' );
		if ( null !== $target_height ) {
			$data_atts[] = 'data-target-height="' . absint( $target_height ) . 'px"';
		}

		$target_width = $config->get( 'post.preview.width.min' );
		if ( null !== $target_width ) {
			$data_atts[] = 'data-width="' . absint( $target_width ) . 'px"';
		}

		$columns = $config->get( 'template.columns.number' );
		if ( null !== $columns ) {
			$data_atts[] = 'data-columns="' . absint( $columns ) . '"';
		}

		return ' ' . implode( ' ', $data_atts );
	}

endif;

if ( ! function_exists( 'presscore_masonry_container_class' ) ) :

	/**
	 * Returns html class property based on current template settings.
	 * 
	 * @since 1.0.0
	 * @param  array  $custom_class Custom class.
	 * @return string
	 */
	function presscore_masonry_container_class( $custom_class = array() ) {
		$_custom_class = $custom_class;
		if ( ! is_array( $_custom_class ) ) {
			$_custom_class = (string) $_custom_class;
			$_custom_class = explode( ' ', $_custom_class );
		}
		$html_class = $_custom_class;
		$config = presscore_config();

		// ajax class
		if ( !in_array( $config->get( 'load_style' ), array( 'default', false ) ) ) {
			$html_class[] = 'with-ajax';
		}

		// loading effect
		$html_class[] = presscore_tpl_get_load_effect_class( $config->get( 'post.preview.load.effect' ) );

		// lazy loading
		if ( 'lazy_loading' == $config->get( 'load_style' ) ) {
			$html_class[] = 'lazy-loading-mode';
		}

		// layout
		switch ( $config->get( 'layout' ) ) {
			case 'grid': $html_class[] = 'iso-grid'; break;
			case 'masonry': $html_class[] = 'iso-container'; break;
		}

		if ( $config->get( 'justified_grid' ) ) {
			$html_class[] = 'jg-container';
		}

		// post preview background
		if ( $config->get( 'post.preview.background.enabled' ) ) {
			$html_class[] = 'bg-under-post';
		}

		// description style
		$description_style = $config->get( 'post.preview.description.style' );
		if ( 'under_image' == $description_style ) {
			$html_class[] = 'description-under-image';
		} else if ( 'disabled' != $description_style ) {
			$html_class[] = 'description-on-hover';
		}

		// hover classes
		switch ( $description_style ) {

			case 'on_hoover_centered':
				$html_class[] = 'hover-style-two';
				$html_class[] = presscore_tpl_get_hover_anim_class( $config->get( 'post.preview.hover.animation' ) );

				// content align
				$html_class[] = presscore_tpl_get_content_align_class( $config->get( 'post.preview.description.alignment' ) );

				if ( 'dark' == $config->get( 'post.preview.hover.color' ) ) {
					$html_class[] = 'hover-color-static';
				}
				break;

			case 'under_image':

				// content align
				$html_class[] = presscore_tpl_get_content_align_class( $config->get( 'post.preview.description.alignment' ) );

				if ( 'dark' == $config->get( 'post.preview.hover.color' ) ) {
					$html_class[] = 'hover-color-static';
				}
				break;

			case 'on_dark_gradient':
				$html_class[] = 'hover-style-one';

				// content align
				$html_class[] = presscore_tpl_get_content_align_class( $config->get( 'post.preview.description.alignment' ) );

				if ( 'always' == $config->get( 'post.preview.hover.content.visibility' ) ) {
					$html_class[] = 'always-show-info';
				}
				break;

			case 'from_bottom':
				$html_class[] = 'hover-style-three';
				$html_class[] = 'cs-style-3';

				// content align
				$html_class[] = presscore_tpl_get_content_align_class( $config->get( 'post.preview.description.alignment' ) );
				break;

			case 'bg_with_lines':
				$html_class[] = 'hover-style-two';
				$html_class[] = presscore_tpl_get_anim_effect_class( $config->get( 'post.preview.hover.lines.animation' ) );

				if ( 'dark' == $config->get( 'post.preview.hover.color' ) ) {
					$html_class[] = 'hover-color-static';
				}

				if ( 'always' == $config->get( 'post.preview.hover.title.visibility' ) ) {
					$html_class[] = 'always-show-info';
				}
				break;
		}

		// round images
		if ( 'round' == $config->get( 'image_layout' ) ) {
			$html_class[] = 'round-images';
		}

		/**
		 * Masonry container class filter.
		 *
		 * @since 1.0.0
		 * @var array $html_class
		 */
		$html_class = apply_filters( 'presscore_masonry_container_class', $html_class );

		return $html_class ? sprintf( 'class="%s"', presscore_esc_implode( ' ', array_unique( $html_class ) ) ) : '';
	}

endif;

if ( ! function_exists( 'presscore_tpl_get_hover_anim_class' ) ) :

	/**
	 * Returns hover animation html class. By default 'hover-fade'.
	 *
	 * @since 1.0.0
	 * @return string
	 */
	function presscore_tpl_get_hover_anim_class( $animation ) {
		switch ( $animation ) {
			case 'direction_aware': $class = 'hover-grid'; break;
			case 'redirection_aware': $class = 'hover-grid-reverse'; break;
			case 'scale_in': $class = 'hover-scale'; break;
			case 'fade':
			default: $class = 'hover-fade';
		}

		return $class;
	}

endif;

if ( ! function_exists( 'presscore_tpl_get_content_align_class' ) ) :

	/**
	 * Returns content alignment html class. By default 'content-align-centre'.
	 *
	 * @since 3.0.0
	 * @return string
	 */
	function presscore_tpl_get_content_align_class( $alignment ) {
		switch ( $alignment ) {
			case 'left': $class = 'content-align-left'; break;
			case 'bottom': $class = 'content-align-bottom'; break;
			case 'left_top': $class = 'content-align-left-top'; break;
			case 'left_bottom': $class = 'content-align-left-bottom'; break;
			case 'center':
			default: $class = 'content-align-centre';
		}

		return $class;
	}

endif;

if ( ! function_exists( 'presscore_tpl_get_anim_effect_class' ) ) :

	/**
	 * Returns animation effect html class. By default 'effect-layla'.
	 *
	 * @since 3.0.0
	 * @return string
	 */
	function presscore_tpl_get_anim_effect_class( $effect ) {
		switch ( $effect ) {
			case '2': $class = 'effect-bubba'; break;
			case '3': $class = 'effect-sarah'; break;
			case '1':
			default: $class = 'effect-layla';
		}

		return $class;
	}

endif;

if ( ! function_exists( 'presscore_tpl_get_load_effect_class' ) ) :

	/**
	 * Returns sanitized loading effect class.
	 *
	 * @since 1.0.0
	 * @return string
	 */
	function presscore_tpl_get_load_effect_class( $load_effect ) {
		return 'loading-effect-' . sanitize_html_class( str_replace( '_', '-', $load_effect ), 'fade-in' );
	}

endif;
