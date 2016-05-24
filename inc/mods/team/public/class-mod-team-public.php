<?php
/**
 * Team public part.
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

class Presscore_Mod_Team_Public {

	public function register_shortcodes() {
		foreach ( array( 'team' ) as $shortcode_name ) {
			include_once plugin_dir_path( __FILE__ ) . "shortcodes/{$shortcode_name}/{$shortcode_name}.php";
		}
	}

	public function load_shortcodes_vc_bridge() {
		include_once plugin_dir_path( __FILE__ ) . "shortcodes/mod-team-shortcodes-bridge.php";
	}

	public function init_widgets() {
		register_widget( 'Presscore_Inc_Widgets_Team' );
	}

	public function init_template_config( $post_type, $template = null ) {
		if ( 'page' == $post_type && 'team' == $template ) {
			presscore_congif_populate_team_vars();
		}
	}

	public function archive_post_content( $html ) {
		if ( ! $html ) {
			ob_start();

			presscore_populate_team_config();
			presscore_get_template_part( 'mod_team', 'team-post' );

			$html = ob_get_contents();
			ob_end_clean();
		}
		return $html;
	}
}
