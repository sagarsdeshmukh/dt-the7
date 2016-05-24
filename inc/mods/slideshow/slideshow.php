<?php
/**
 * Slideshow module.
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

require_once plugin_dir_path( __FILE__ ) . 'includes/class-mod-slideshow.php';

if ( ! function_exists( 'presscore_mod_slideshow' ) ) {

	function presscore_mod_slideshow() {
		return Presscore_Mod_Slideshow::instance();
	}
	presscore_mod_slideshow();

}
