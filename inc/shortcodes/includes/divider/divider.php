<?php
/**
 * Divider shortcode.
 *
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! class_exists( 'DT_Shortcode_Divider', false ) ) {

	class DT_Shortcode_Divider extends DT_Shortcode {

		static protected $instance;

		protected $shortcode_name = 'dt_divider';

		public static function get_instance() {
			if ( !self::$instance ) {
				self::$instance = new DT_Shortcode_Divider();
			}
			return self::$instance;
		}

		protected function __construct() {
			presscore_add_puny_shortcode( $this->shortcode_name, array( $this, 'shortcode' ) );
		}

		public function shortcode( $atts, $content = null ) {
			extract( shortcode_atts( array(
				'style' => 'thin'
			), $atts ) );

			switch( $style ) {
				case 'thick': $class = 'hr-thick'; break;
				default: $class = 'hr-thin';
			}

			$output = '<div class="' . esc_attr( $class ) . '"></div>';

			return $output;
		}

	}

	// create shortcode
	DT_Shortcode_Divider::get_instance();

}
