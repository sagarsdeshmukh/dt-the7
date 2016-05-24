<?php
/**
 * List shortcode for Visual Composer.
 *
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! class_exists( 'DT_Shortcode_List_Vc', false ) ) {

	class DT_Shortcode_List_Vc extends DT_Shortcode {

		static protected $instance;
		static protected $atts = array();

		protected $plugin_name = 'dt_mce_plugin_shortcode_list';

		public static function get_instance() {
			if ( !self::$instance ) {
				self::$instance = new DT_Shortcode_List_Vc();
			}
			return self::$instance;
		}

		protected function __construct() {
			add_shortcode( 'dt_vc_list_item', array( $this, 'shortcode_item' ) );
			add_shortcode( 'dt_vc_list', array( $this, 'shortcode_list' ) );
		}

		public function shortcode_list( $atts, $content = null ) {
			extract( shortcode_atts( array(
				'style' => '1',
				'dividers' => 'true',
				'bullet_position' => 'top',
			), $atts ) );

			$style = in_array( $style, array('1', '2', '3') ) ? $style : '1';
			$bullet_position = in_array( $bullet_position, array('top', 'middle') ) ? $bullet_position : 'middle';
			$dividers = apply_filters('dt_sanitize_flag', $dividers);

			$classes = array();
			$tag = 'div';

			switch ( $style ) {
				case '2':
					$classes[] = 'standard-number-list';
					break;
				case '3':
					$classes[] = 'image-arrow';
					break;
				default:
					$classes[] = 'standard-arrow';
			}

			if ( $dividers ) {
				$classes[] = 'list-divider';
			}

			if ( 'top' == $bullet_position ) {
				$classes[] = 'bullet-top';
			}

			$classes = implode( ' ', $classes );

			// store atts
			$atts_backup = self::$atts;
			
			// change atts
			self::$atts = array(
				'style'     => $style,
				'dividers'  => $dividers
			);

			$output = sprintf( '<%1$s class="%2$s">%3$s</%1$s>', $tag, esc_attr( $classes ), presscore_remove_wpautop( $content, true ) );

			// restore atts
			self::$atts = $atts_backup;

			return $output; 
		}

		public function shortcode_item( $atts, $content = null ) {
			extract( shortcode_atts( array(
				'image'         => '',
			), $atts ) );

			$image = esc_url($image);

			if ( isset(self::$atts['style']) && '3' == self::$atts['style'] ) {

				$content = '<div>' . $content . '</div>';

				if ( $image ) {
					$content = sprintf( '<div><img src="%s" class="list-img" alt="" /></div>%s', $image, $content );
				}

				$content = '<div class="wf-table">' . $content . '</div>';
			}

			$output = sprintf( '<li>%s</li>', presscore_remove_wpautop( $content, true ) );

			return $output; 
		}

	}

	// create shortcode
	DT_Shortcode_List_Vc::get_instance();

}
