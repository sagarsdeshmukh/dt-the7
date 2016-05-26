<?php
/**
 * Widgetareas helpers
 *
 * @package vogue
 * @since 1.0.0
 */

if ( ! function_exists( 'presscore_sidebar_html_class' ) ) :

	/**
	 * Sidebar html classes
	 * 
	 * @param  array  $class Custom html class
	 * @return string        Html class attribute
	 */
	function presscore_sidebar_html_class( $class = array() ) {
		if ( $class ) {
			$output = is_array( $class ) ? $class : explode( ' ', $class );
		} else {
			$output = array();
		}

		switch ( presscore_config()->get( 'sidebar.style' ) ) {
			case 'with_bg':
				$output[] = 'solid-bg';
				break;
			case 'with_widgets_bg':
				$output[] = 'bg-under-widget';
				break;
		}

		if ( in_array( presscore_config()->get( 'sidebar.style' ), array( 'with_bg', 'with_widgets_bg' ) ) ) {
			switch ( presscore_config()->get( 'sidebar.style.background.decoration' ) ) {
				case 'shadow':
					$output[] = 'sidebar-shadow-decoration';
					break;
				case 'outline':
					$output[] = 'sidebar-outline-decoration';
					break;
			}
		}

		$output = apply_filters( 'presscore_sidebar_html_class', $output );

		return $output ? sprintf( 'class="%s"', presscore_esc_implode( ' ', array_unique( $output ) ) ) : '';
	}

endif;

if ( ! function_exists( 'presscore_footer_html_class' ) ) :

	function presscore_footer_html_class( $class = array() ) {
		if ( $class ) {
			$output = is_array( $class ) ? $class : explode( ' ', $class );
		} else {
			$output = array();
		}

		switch( presscore_config()->get( 'template.footer.style' ) ) {
			case 'full_width_line' :
				$output[] = 'full-width-line';
				break;
			case 'solid_background' :
				$output[] = 'solid-bg';
				if ( 'outline' === presscore_config()->get( 'template.footer.decoration' ) ) {
					$output[] = 'footer-outline-decoration';
				}
				break;
			// default - content_width_line
		}

		$output = apply_filters( 'presscore_footer_html_class', $output );

		return $output ? sprintf( 'class="%s"', presscore_esc_implode( ' ', array_unique( $output ) ) ) : '';

	}

endif;

if ( ! function_exists( 'presscore_get_sidebar_layout_parser' ) ) :

	function presscore_get_sidebar_layout_parser( $sidebar_layout ) {
		return new Presscore_Sidebar_Layout_Parser( $sidebar_layout );
	}

endif;

if ( ! function_exists( 'presscore_get_default_sidebar_id' ) ) :

	/**
	 * Function returns default sidebar id.
	 * 
	 * @return string
	 */
	function presscore_get_default_sidebar_id() {
		return apply_filters( 'presscore_default_sidebar', 'sidebar_1' );
	}

endif;

if ( ! function_exists( 'presscore_get_default_footer_sidebar_id' ) ) :

	/**
	 * Function returns default footer widget area id.
	 * 
	 * @return string
	 */
	function presscore_get_default_footer_sidebar_id() {
		return apply_filters( 'presscore_default_footer_sidebar', 'sidebar_2' );
	}

endif;

if ( ! function_exists( 'presscore_validate_sidebar' ) ) :

	/**
	 * If $sidebar_id is not registered sidebar - return default one.
	 * 
	 * @param  string|int $sidebar_id
	 * @return string|int
	 */
	function presscore_validate_sidebar( $sidebar_id ) {
		if ( ! is_registered_sidebar( $sidebar_id ) ) {
			return presscore_get_default_sidebar_id();
		}

		return $sidebar_id;
	}

endif;

if ( ! function_exists( 'presscore_validate_footer_sidebar' ) ) :

	/**
	 * If $sidebar_id is not registered sidebar - return default one for footer.
	 * 
	 * @param  string|int $sidebar_id
	 * @return string|int
	 */
	function presscore_validate_footer_sidebar( $sidebar_id ) {
		if ( ! is_registered_sidebar( $sidebar_id ) ) {
			return presscore_get_default_footer_sidebar_id();
		}

		return $sidebar_id;
	}

endif;
