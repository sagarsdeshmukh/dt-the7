<?php
/**
 * Testimonials module.
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

require_once plugin_dir_path( __FILE__ ) . 'includes/class-mod-testimonials.php';

if ( ! function_exists( 'presscore_mod_testimonials' ) ) {

	function presscore_mod_testimonials() {
		return Presscore_Mod_Testimonials::instance();
	}
	presscore_mod_testimonials();

}
