<?php
// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

add_action( 'presscore_before_shortcode_loop', 'presscore_shortcodes_add_masonry_default_actions', 20 );
add_action( 'presscore_after_shortcode_loop', 'presscore_shortcodes_remove_masonry_default_actions', 20 );

if ( ! function_exists( 'presscore_shortcodes_add_masonry_default_actions' ) ):

	function presscore_shortcodes_add_masonry_default_actions() {
		add_filter( 'dt_paginator_args', 'presscore_shortcodes_masonry_pagination_filter', 20 );
	}

endif;

if ( ! function_exists( 'presscore_shortcodes_remove_masonry_default_actions' ) ):

	function presscore_shortcodes_remove_masonry_default_actions() {
		remove_filter( 'dt_paginator_args', 'presscore_shortcodes_masonry_pagination_filter', 20 );
	}

endif;

if ( ! function_exists( 'presscore_shortcodes_masonry_pagination_filter' ) ):

	function presscore_shortcodes_masonry_pagination_filter( $args = array() ) {
		$args['wrap'] = '<div class="%CLASS%" role="navigation"><div class="page-links">%LIST%</div></div>';
		return $args;
	}

endif;
