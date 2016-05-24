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
		$default_logo = '';
		$r_logo = $logos['logo_retina'];
		$logo = $logos['logo'];

		// get default logo
		foreach ( $logos as $logo ) {
			if ( $logo ) { $default_logo = $logo; break; }
		}

		if ( presscore_is_srcset_based_retina() || presscore_is_logos_only_retina() ) {

			$logos = array( '1x' => $logo, '2x' => $r_logo );
			$srcset = array();

			foreach ( $logos as $xx => $_logo ) {
				if ( ! empty( $_logo ) ) {
					$srcset[] = "{$_logo[0]} {$xx}";
				}
			}

			$srcset = implode( ', ', $srcset );
			$logo = $default_logo;
			$logo[0] = $logo_src = $srcset;

		} else {

			if ( $logo && !$r_logo ) { $r_logo = $logo; }
			elseif ( $r_logo && !$logo ) { $logo = $r_logo; }
			elseif ( !$r_logo && !$logo ) { $logo = $r_logo = $default_logo; } 

			if ( dt_retina_on() && dt_is_hd_device() ) {
				$logo = $r_logo;
			}

			$logo_src = isset($logo[0]) ? $logo[0] : '';
		}

		$w = isset( $logo[1] ) ? $logo[1] : '';
		$h = isset( $logo[2] ) ? $logo[2] : '';

		return array( $logo_src, $w, $h );
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

		$alt = esc_attr( get_bloginfo( 'name' ) );

		if ( presscore_is_srcset_based_retina() || presscore_is_logos_only_retina() ) {

			$logo = presscore_get_image_with_srcset(
				$logos['logo'],
				$logos['logo_retina'],
				$default_logo,
				' alt="' . $alt . '"',
				$class
			);

		} else {

			$logo = dt_get_retina_sensible_image(
				$logos['logo'],
				$logos['logo_retina'],
				$default_logo,
				' alt="' . $alt . '"',
				$class
			);

		}

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
