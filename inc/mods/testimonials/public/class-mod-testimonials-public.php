<?php
/**
 * Testimonials public part.
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

class Presscore_Mod_Testimonials_Public {

	public function resolve_template_ajax( $response, $data, $template_name ) {
		if ( in_array( $template_name, array( 'template-testimonials.php' ) ) ) {

			$ajax_content = new Presscore_Mod_Testimonials_Ajax_Content_Builder();
			$response = $ajax_content->get_response( $data );

		}
		return $response;
	}

	public function register_shortcodes() {
		foreach ( array( 'testimonials' ) as $shortcode_name ) {
			include_once plugin_dir_path( __FILE__ ) . "shortcodes/{$shortcode_name}/{$shortcode_name}.php";
		}
	}

	public function load_shortcodes_vc_bridge() {
		include_once plugin_dir_path( __FILE__ ) . "shortcodes/mod-testimonials-shortcodes-bridge.php";
	}

	public function init_widgets() {
		register_widget( 'Presscore_Inc_Widgets_TestimonialsList' );
		register_widget( 'Presscore_Inc_Widgets_TestimonialsSlider' );
	}

	public function init_template_config( $post_type, $template = null ) {
		if ( 'page' == $post_type && 'testimonials' == $template ) {
			presscore_congif_populate_testimonials_vars();
		}
	}

	public function archive_post_content( $html ) {
		if ( ! $html ) {
			ob_start();

			get_template_part( 'content', 'testimonials' );

			$html = ob_get_contents();
			ob_end_clean();
		}
		return $html;
	}
}
