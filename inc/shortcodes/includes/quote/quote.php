<?php
/**
 * Quote shortcode.
 *
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! class_exists( 'DT_Shortcode_Quote', false ) ) {

	class DT_Shortcode_Quote extends DT_Shortcode {

		static protected $instance;

		public static function get_instance() {
			if ( !self::$instance ) {
				self::$instance = new DT_Shortcode_Quote();
			}
			return self::$instance;
		}

		protected function __construct() {
			add_shortcode( 'dt_quote', array( $this, 'shortcode' ) );
		}

		public function shortcode( $atts, $content = null ) {
			$default_atts = array(
				'type' => 'blockquote',
				'layout' => 'left',
				'font_size' => 'big',
				'size' => '1',
				'animation' => 'none',
				'background' => 'plain'
			);

			extract( shortcode_atts( $default_atts, $atts ) );

			$font_size = sanitize_key( $font_size );
			$type = sanitize_key( $type );
			$layout = sanitize_key( $layout );
			$size = sanitize_key( $size );
			$background = sanitize_key( $background );

			$classes = array();

			$classes[] = presscore_get_font_size_class( $font_size );

			if ( presscore_shortcode_animation_on( $animation ) ) {
				$classes[] = presscore_get_shortcode_animation_html_class( $animation );
			}

			if ( 'blockquote' != $type ) {
				$tag = 'q';
				$autop = false;

				$classes[] = 'shortcode-pullquote';
				$classes[] = 'wf-cell';

				if ( 'right' == $layout ) {
					$classes[] = 'align-right';
				} else {
					$classes[] = 'align-left';
				}

				switch ( $size ) {
					case '2': $classes[] = 'wf-1-2'; break;
					case '3': $classes[] = 'wf-1-3'; break;
					case '4': $classes[] = 'wf-1-4'; break;
					default: $classes[] = 'wf-1';
				}

			} else {
				$tag = 'blockquote';
				$autop = true;
				$classes[] = 'shortcode-blockquote';

				if ( 'fancy' == $background ) {
					$classes[] = 'block-style-widget';
				}
			}

			$classes = implode( ' ', $classes );

			$output = sprintf( '<%1$s class="%2$s">%3$s</%1$s>',
				$tag,
				esc_attr( $classes ),

				/**
				 * @see  sanitize-functions.php
				 */
				presscore_remove_wpautop( $content, $autop )
			);

			return $output; 
		}

	}

	// create shortcode
	DT_Shortcode_Quote::get_instance();

}
