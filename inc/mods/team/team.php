<?php
/**
 * Team module.
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

require_once plugin_dir_path( __FILE__ ) . 'includes/class-mod-team.php';

if ( ! function_exists( 'presscore_mod_team' ) ) {

	function presscore_mod_team() {
		return Presscore_Mod_Team::instance();
	}
	presscore_mod_team();

}
