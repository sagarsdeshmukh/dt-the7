<?php
/**
 * Animated text shortcode.
 *
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! class_exists( 'DT_Shortcode_AnimatedText', false ) ) {

	class DT_Shortcode_AnimatedText extends DT_Shortcode {

		static protected $instance;

		protected $shortcode_name = 'dt_text';

		public static function get_instance() {
			if ( !self::$instance ) {
				self::$instance = new DT_Shortcode_AnimatedText();
			}
			return self::$instance;
		}

		protected function __construct() {
			add_shortcode( $this->shortcode_name, array($this, 'shortcode') );
		}

		public function shortcode( $atts, $content = null ) {
			$default_atts = array(
				'animation' => 'none',
			);

			extract( shortcode_atts( $default_atts, $atts ) );

			$classes = array();

			if ( presscore_shortcode_animation_on( $animation ) ) {
				$classes[] = presscore_get_shortcode_animation_html_class( $animation );
			}

			// ninjaaaa!
			$classes = implode( ' ', $classes );

			$output = '<div class="' . esc_attr( $classes ) . '">' . presscore_remove_wpautop( $content, true ) . '</div>';

			return $output;
		}

	}

	// create shortcode
	DT_Shortcode_AnimatedText::get_instance();

}
