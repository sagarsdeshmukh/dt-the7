<?php
/**
 * Portfolio module.
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

require_once plugin_dir_path( __FILE__ ) . 'includes/class-mod-portfolio.php';

if ( ! function_exists( 'presscore_mod_portfolio' ) ) {

	function presscore_mod_portfolio() {
		return Presscore_Mod_Portfolio::instance();
	}
	presscore_mod_portfolio();

}
