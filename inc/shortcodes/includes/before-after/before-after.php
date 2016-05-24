<?php
/**
 * Before / After shortcode.
 *
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! class_exists( 'DT_Shortcode_Before_After', false ) ) {

	class DT_Shortcode_Before_After extends DT_Shortcode {

		static protected $instance;

		protected $shortcode_name = 'dt_before_after';
		protected $atts = array();

		public static function get_instance() {
			if ( !self::$instance ) {
				self::$instance = new DT_Shortcode_Before_After();
			}
			return self::$instance;
		}

		protected function __construct() {
			add_shortcode( $this->shortcode_name, array( $this, 'shortcode' ) );
		}

		public function shortcode( $atts, $content = null ) {
			$this->atts = $this->sanitize_attributes( $atts );
			return $this->get_html();
		}

		protected function sanitize_attributes( &$atts ) {
			$clean_atts = shortcode_atts( array(
				'image_1' => '',
				'image_2' => '',
				'orientation' => 'horizontal',
				'navigation' => 'drag',
				'offset' => '50',
				'el_class' => ''
			), $atts );

			$clean_atts['orientation'] = sanitize_key( $clean_atts['orientation'] );
			$clean_atts['navigation'] = sanitize_key( $clean_atts['navigation'] );

			$clean_atts['image_1'] = absint( $clean_atts['image_1'] );
			$clean_atts['image_2'] = absint( $clean_atts['image_2'] );

			$clean_atts['offset'] = absint( $clean_atts['offset'] );
			$clean_atts['el_class'] = esc_attr( $clean_atts['el_class'] );

			return $clean_atts;
		}

		protected function get_html() {
			$output = '';

			$output .= '<div class="twentytwenty-container"' . $this->get_data_atts() . '>';

				$output .= $this->get_image_html( $this->atts['image_1'] );
				$output .= $this->get_image_html( $this->atts['image_2'] );

			$output .= '</div>';

			return $output;
		}

		protected function get_data_atts() {
			$data_atts = array(
				'orientation' => $this->atts['orientation'],
				'offset' => sprintf( '%1.1f', $this->atts['offset'] / 100 )
			);

			if ( 'move' == $this->atts['navigation'] ) {
				$data_atts['navigation'] = 'move';
			}

			return ' ' . presscore_get_inlide_data_attr( $data_atts );
		}

		protected function get_image_html( $image_id ) {
			$image_html = '';

			if ( wp_attachment_is_image( $image_id ) ) {

				$image_src = wp_get_attachment_image_src( $image_id, 'full' );
				$image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );

				if ( presscore_image_title_enabled( $image_id ) ) {
					$image_title = ' title="' . esc_attr( get_the_title( $image_id ) ) . '"';
				} else {
					$image_title = '';
				}

				$image_html = '<img class="preload-me" src="' . $image_src[0] . '" ' . image_hwstring( $image_src[1], $image_src[2] ) . $image_title . ' alt="' . esc_attr( $image_alt ) . '">';

			}

			return $image_html;
		}

	}

	// create shortcode
	DT_Shortcode_Before_After::get_instance();

}
