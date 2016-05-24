<?php
/**
 * Logos module.
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

require_once plugin_dir_path( __FILE__ ) . 'includes/class-mod-logos.php';

if ( ! function_exists( 'presscore_mod_logos' ) ) {

	function presscore_mod_logos() {
		return Presscore_Mod_Logos::instance();
	}
	presscore_mod_logos();

}
