<?php
/**
 * Page title helpers
 * 
 * @package vogue
 * @since 1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! function_exists( 'presscore_get_page_title' ) ) :

	function presscore_get_page_title() {
		$title = '';

		if ( is_page() || is_single() ) {
			$title = get_the_title();

		} else if ( is_search() ) {
			$title = sprintf( __( 'Search Results for: %s', 'the7mk2' ), '<span>' . get_search_query() . '</span>' );

		} else if ( is_archive() ) {

			if ( is_category() ) {
				$title = sprintf( __( 'Category Archives: %s', 'the7mk2' ), '<span>' . single_cat_title( '', false ) . '</span>' );

			} elseif ( is_tag() ) {
				$title = sprintf( __( 'Tag Archives: %s', 'the7mk2' ), '<span>' . single_tag_title( '', false ) . '</span>' );

			} elseif ( is_author() ) {
				the_post();
				$title = sprintf( __( 'Author Archives: %s', 'the7mk2' ), '<span class="vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( "ID" ) ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' );
				rewind_posts();

			} elseif ( is_day() ) {
				$title = sprintf( __( 'Daily Archives: %s', 'the7mk2' ), '<span>' . get_the_date() . '</span>' );

			} elseif ( is_month() ) {
				$title = sprintf( __( 'Monthly Archives: %s', 'the7mk2' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );

			} elseif ( is_year() ) {
				$title = sprintf( __( 'Yearly Archives: %s', 'the7mk2' ), '<span>' . get_the_date( 'Y' ) . '</span>' );

			} else {
				$title = __( 'Archives:', 'the7mk2' );

			}

		} elseif ( is_404() ) {
			$title = __( 'Page not found', 'the7mk2' );

		} else {
			$title = __( 'Blog', 'the7mk2' );

		}

		return apply_filters( 'presscore_get_page_title', $title );
	}

endif;

if ( ! function_exists( 'presscore_get_page_title_html_class' ) ) :

	function presscore_get_page_title_html_class( $class = array() ) {
		$config = Presscore_Config::get_instance();
		$output = array( presscore_get_font_size_class( $config->get( 'page_title.font.size' ) ) );

		if ( is_single() ) {
			$output[] = 'entry-title';
		}

		//////////////
		// Output //
		//////////////

		if ( $class && ! is_array( $class ) ) {
			$class = explode( ' ', $class );
		}

		$output = apply_filters( 'presscore_get_page_title_html_class', array_merge( $class, $output ) );

		return $output ? sprintf( 'class="%s"', presscore_esc_implode( ' ', array_unique( $output ) ) ) : '';
	}

endif;

if ( ! function_exists( 'presscore_get_page_title_wrap_html_class' ) ) :

	function presscore_get_page_title_wrap_html_class( $class = array() ) {
		$config = presscore_config();
		$output = array();

		switch( $config->get( 'page_title.align' ) ) {
			case 'right' :
				$output[] = 'title-right';
				break;
			case 'left' :
				$output[] = 'title-left';
				break;
			case 'all_right' :
				$output[] = 'content-right';
				break;
			case 'all_left' :
				$output[] = 'content-left';
				break;
			default:
				$output[] = 'title-center';
		}

		$title_bg_mode_class = presscore_get_page_title_bg_mode_html_class();
		if ( $title_bg_mode_class ) {
			$output[] = $title_bg_mode_class;
		}

		if ( ! $config->get( 'page_title.breadcrumbs.enabled' ) ) {
			$output[] = 'breadcrumbs-off';
		}

		if ( $config->get( 'page_title.background.parallax_speed' ) ) {
			$output[] = 'page-title-parallax-bg';
		}

		if ( 'background' === $config->get( 'page_title.background.mode' ) && 'outline' === $config->get( 'page_title.decoration' ) ) {
			$output[] = 'title-outline-decoration';
		}

		//////////////
		// Output //
		//////////////

		if ( $class && ! is_array( $class ) ) {
			$class = explode( ' ', $class );
		}

		$output = apply_filters( 'presscore_get_page_title_wrap_html_class', array_merge( $class, $output ) );

		return $output ? sprintf( 'class="%s"', presscore_esc_implode( ' ', array_unique( $output ) ) ) : '';
	}

endif;

if ( ! function_exists( 'presscore_get_page_title_breadcrumbs' ) ) :

	function presscore_get_page_title_breadcrumbs( $args = array() ) {
		$config = Presscore_Config::get_instance();
		$breadcrumbs_class = 'breadcrumbs text-small';

		switch ( $config->get( 'page_title.breadcrumbs.background.mode' ) ) {
			case 'black':
				$breadcrumbs_class .= ' bg-dark breadcrumbs-bg';
				break;
			case 'white':
				$breadcrumbs_class .= ' bg-light breadcrumbs-bg';
				break;
		}

		$default_args = array(
			'beforeBreadcrumbs' => '<div class="wf-td">',
			'afterBreadcrumbs' => '</div>',
			'listAttr' => ' class="' . $breadcrumbs_class . '"'
		);

		$args = wp_parse_args( $args, $default_args );

		return presscore_get_breadcrumbs( $args );
	}

endif;

if ( ! function_exists( 'presscore_get_page_title_bg_mode_html_class' ) ) :

	/**
	 * Returns class based on title_bg_mode value
	 *
	 * @since 1.0.0
	 * @return string class
	 */
	function presscore_get_page_title_bg_mode_html_class() {
		switch ( presscore_config()->get( 'page_title.background.mode' ) ) {
			case 'background':
				$class = 'solid-bg';
				break;
			case 'gradient':
				$class = 'gradient-bg';
				break;
			case 'fullwidth_line':
				$class = 'full-width-line';
				break;
			case 'disabled':
				$class = 'disabled-bg';
				break;
			default:
				$class = '';
		}
		return $class;
	}


endif;
