<?php

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

require_once trailingslashit( dirname(__FILE__) ) . 'puny-shortcodes.class.php';

if ( ! function_exists( 'presscore_add_puny_shortcode' ) ) :

	function presscore_add_puny_shortcode( $tag, $function ) {
		add_shortcode( $tag, $function );
		Presscore_Puny_Shortcodes::add_puny_shortcode( $tag, $function );
	}

endif;

if ( ! function_exists( 'presscore_get_puny_shortcodes' ) ) :

	function presscore_get_puny_shortcodes() {
		return apply_filters( 'dt_get_puny_shortcodes', Presscore_Puny_Shortcodes::get_puny_shortcodes() );
	}

endif;

if ( ! function_exists( 'presscore_remove_puny_effect_for_vc_inline_editor' ) ) :

	add_action( 'dt_get_puny_shortcodes', 'presscore_remove_puny_effect_for_vc_inline_editor', 90 );

	function presscore_remove_puny_effect_for_vc_inline_editor( $puny_shortcodes = array() ) {
		if ( function_exists('vc_is_inline') && vc_is_inline() ) {
			return array();
		}
		return $puny_shortcodes;
	}

endif;

if ( ! function_exists( 'presscore_add_compat_puny_shortcodes' ) ) :

	add_filter( 'dt_get_puny_shortcodes', 'presscore_add_compat_puny_shortcodes' );

	function presscore_add_compat_puny_shortcodes( $puny_shortcodes = array() ) {

		$puny_shortcodes['dt_code'] = array( DT_Shortcode_Code::get_instance(), 'shortcode_prepare' );
		return $puny_shortcodes;
	}

endif;

if ( ! function_exists( 'presscore_run_puny_shortcodes' ) ) :

	add_filter( 'the_content', 'presscore_run_puny_shortcodes', 7 );

	// some new stuff from https://gist.github.com/bitfade/4555047

	/**
	 * Actual processing of the shortcode happens here.
	 */
	function presscore_run_puny_shortcodes( $content ) {
		global $shortcode_tags;

		$puny_shortcodes = presscore_get_puny_shortcodes();

		if ( is_array( $puny_shortcodes ) && count( $puny_shortcodes ) > 0 ) {

			// Backup current registered shortcodes and clear them all out
			$orig_shortcode_tags = $shortcode_tags;
			remove_all_shortcodes();

			foreach ( $puny_shortcodes as $shortcode=>$callback ) {
				add_shortcode( $shortcode, $callback );
			}

			// Do the shortcode (only the one above is registered)
			$content = do_shortcode( shortcode_unautop( $content ) );

			// Put the original shortcodes back
			$shortcode_tags = $orig_shortcode_tags;

		}

		return $content;
	}

endif;
