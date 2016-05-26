<?php
/**
 * Logo helpers.
 * @package The7\Helpers
 * @since 3.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! function_exists( 'presscore_get_logo_src' ) ) :

	function presscore_get_logo_src( $logos = array() ) {
		$default_logo = array( '', '', '' );
		$srcset = array();

		foreach ( array( '1x' => $logos['logo'], '2x' => $logos['logo_retina'] ) as $l_type => $logo ) {
			if ( ! $logo ) {
				continue;
			}

			if ( ! $default_logo[0] ) {
				$default_logo = $logo;
			}

			$srcset[] = "{$logo[0]} {$l_type}";
		}

		return array( implode( $srcset, ', ' ), $default_logo['width'], $default_logo['height'] );
	}

endif;

if ( ! function_exists( 'presscore_get_logo_image' ) ) :

	/**
	 * Returns logo <img> tag or empty string if something gone wrong.
	 * @since 3.0.0
	 * @param  array  $logos
	 * @param  string $class
	 * @return string
	 */
	function presscore_get_logo_image( $logos = array(), $class = '' ) {
		$default_logo = null;

		if ( ! is_array( $logos ) ) {
			$logos = array( $logos );
		}

		// get default logo
		foreach ( $logos as $logo ) {
			if ( $logo ) {
				$default_logo = $logo;
				break;
			}
		}

		if ( empty( $default_logo ) ) {
			return '';
		}

		$alt = get_bloginfo( 'name' );

		$logo = presscore_get_image_with_srcset(
			$logos['logo'],
			$logos['logo_retina'],
			array( $default_logo['src'], $default_logo['width'], $default_logo['height'] ),
			' sizes="' . esc_attr( $default_logo['width'] ) . 'px" alt="' . esc_attr(  $alt ) . '"',
			$class
		);

		return $logo;
	}

endif;

if ( ! function_exists( 'presscore_get_the_mobile_logo' ) ) :

	/**
	 * Returns the mobile logo html.
	 * @since 3.0.0
	 * @return string
	 */
	function presscore_get_the_mobile_logo() {
		$config = presscore_config();

		if ( 'mobile' === $config->get( 'header.mobile.logo.first_switch' ) || 'mobile' === $config->get( 'header.mobile.logo.second_switch' ) ) {
			return presscore_get_logo_image( array(
				'logo' 			=> dt_get_uploaded_logo( of_get_option( 'header-style-mobile-logo_regular', array('', 0) ) ),
				'logo_retina'	=> dt_get_uploaded_logo( of_get_option( 'header-style-mobile-logo_hd', array('', 0) ), 'retina' ),
			), 'mobile-logo' );
		}

		return '';
	}

endif;

if ( ! function_exists( 'presscore_get_the_main_logo' ) ) :

	/**
	 * Returns the main logo html.
	 * @since 3.0.0
	 * @return string
	 */
	function presscore_get_the_main_logo() {
		$config = presscore_config();
		if ( presscore_header_is_transparent() && ! presscore_header_layout_is_side() ) {
			$logo = $config->get( 'logo.header.transparent.regular' );
			$hd_logo = $config->get( 'logo.header.transparent.hd' );
		} else {
			$logo = $config->get( 'logo.header.regular' );
			$hd_logo = $config->get( 'logo.header.hd' );
		}

		return presscore_get_logo_image( array(
			'logo' 			=> dt_get_uploaded_logo( $logo ),
			'logo_retina'	=> dt_get_uploaded_logo( $hd_logo, 'retina' ),
		) );
	}

endif;

if ( ! function_exists( 'presscore_get_the_mixed_logo' ) ) :

	/**
	 * Returns the mixed logo html.
	 * @since 3.0.0
	 * @return string
	 */
	function presscore_get_the_mixed_logo() {
		if ( presscore_header_is_transparent() && presscore_mixed_header_with_top_line() ) {
			$config = presscore_config();
			$logo = $config->get( 'logo.header.transparent.regular' );
			$hd_logo = $config->get( 'logo.header.transparent.hd' );
		} else {
			$logo = of_get_option( 'header-style-mixed-logo_regular', array('', 0) );
			$hd_logo = of_get_option( 'header-style-mixed-logo_hd', array('', 0) );
		}

		return presscore_get_logo_image( array(
			'logo' 			=> dt_get_uploaded_logo( $logo ),
			'logo_retina'	=> dt_get_uploaded_logo( $hd_logo, 'retina' ),
		) );
	}

endif;

if ( ! function_exists( 'presscore_get_the_bottom_bar_logo' ) ) :

	/**
	 * Returns the bottom bar logo.
	 * @since 3.0.0
	 * @return string
	 */
	function presscore_get_the_bottom_bar_logo() {
		return presscore_get_logo_image( array(
			'logo' 			=> dt_get_uploaded_logo( of_get_option( 'bottom_bar-logo_regular', array('', 0) ) ),
			'logo_retina'	=> dt_get_uploaded_logo( of_get_option( 'bottom_bar-logo_hd', array('', 0) ), 'retina' ),
		) );
	}

endif;

if ( ! function_exists( 'presscore_get_floating_menu_logos_meta' ) ) :

	/**
	 * Returns the floating logos array.
	 * @since 3.0.0
	 * @return array
	 */
	function presscore_get_floating_menu_logos_meta() {
		$config = presscore_config();
		if ( 'main' === $config->get( 'header.floating_navigation.logo.style' ) ) {
			$logo = $config->get( 'logo.header.regular' );
			$hd_logo = $config->get( 'logo.header.hd' );
		} else {
			$logo = $config->get( 'logo.header.floating.regular' );
			$hd_logo = $config->get( 'logo.header.floating.hd' );
		}

		return array(
			'logo' 			=> dt_get_uploaded_logo( $logo ),
			'logo_retina'	=> dt_get_uploaded_logo( $hd_logo, 'retina' ),
		);
	}

endif;

if ( ! function_exists( 'presscore_display_the_logo' ) ) :

	/**
	 * Display page logo.
	 * @since 3.0.0
	 * @param  string $logo
	 */
	function presscore_display_the_logo( $logo ) {
		global $post;

		if ( ! $logo ) {
			return;
		}

		$url = home_url( '/' );
		if ( presscore_is_microsite() && ( $m_url = get_post_meta( $post->ID, '_dt_microsite_logo_link', true ) ) ) {
			$url = $m_url;
		}

		echo '<a href="' . esc_url( $url ) . '">' . $logo . '</a>';
	}

endif;
