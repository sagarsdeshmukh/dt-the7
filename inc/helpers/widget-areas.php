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
