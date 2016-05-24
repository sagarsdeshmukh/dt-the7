<?php
// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! class_exists( 'Presscore_Shortcodes_Animation', false ) ) {
	require_once trailingslashit( dirname( __FILE__ ) ) . 'shortcodes-animation.class.php';
}

if ( ! function_exists( 'presscore_get_vc_animation_options' ) ) :

	function presscore_get_vc_animation_options() {
		return Presscore_Shortcodes_Animation::get_animation_options();
	}

endif;

if ( ! function_exists( 'presscore_get_shortcode_animation_html_class' ) ) :

	function presscore_get_shortcode_animation_html_class( $animation ) {
		return Presscore_Shortcodes_Animation::get_html_class( $animation );
	}

endif;

if ( ! function_exists( 'presscore_shortcode_animation_on' ) ) :

	function presscore_shortcode_animation_on( $animation ) {
		return Presscore_Shortcodes_Animation::is_animation_on( $animation );
	}

endif;
