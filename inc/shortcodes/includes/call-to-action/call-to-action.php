<?php
/**
 * Call to action shortcode.
 *
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! class_exists( 'DT_Shortcode_CallToAction', false ) ) {

	class DT_Shortcode_CallToAction extends DT_Shortcode {

		static protected $instance;

		protected $shortcode_name = 'dt_call_to_action';
		protected $atts = array();

		public static function get_instance() {
			if ( !self::$instance ) {
				self::$instance = new DT_Shortcode_CallToAction();
			}
			return self::$instance;
		}

		protected function __construct() {
			add_shortcode( $this->shortcode_name, array( $this, 'shortcode' ) );
		}

		public function shortcode( $atts, $content = null ) {

			$this->sanitize_attributes( $atts );

			$button = $this->strip_first_button_shortcode( $content );

			$output = '';

			$output .= '<section ' . $this->get_container_html_class( 'shortcode-action-box' ) . '>';

				$output .= '<div ' . $this->get_content_html_class( 'shortcode-action-container' ) . '>';

					/**
					 * @see sanitize-functions.php
					 */
					$output .= presscore_remove_wpautop( $content, true );

				$output .= '</div>';

				$output .= $button;

			$output .= '</section>';

			return $output; 
		}

		protected function sanitize_attributes( &$atts ) {
			$clean_atts = shortcode_atts( array(
				'style' => '0',
				'background' => 'no',
				'content_size' => 'big',
				'animation' => 'none',
				'line' => 'false',

				/**
				 * @deprecated Only for backward compatibility
				 */
				'text_align' => 'left',
			), $atts );

			$clean_atts['style'] = sanitize_key( $clean_atts['style'] );
			$clean_atts['background'] = sanitize_key( $clean_atts['background'] );
			$clean_atts['content_size'] = sanitize_key( $clean_atts['content_size'] );

			$clean_atts['line'] = apply_filters( 'dt_sanitize_flag', $clean_atts['line'] );

			/**
			 * @deprecated Only for backward compatibility
			 */
			$clean_atts['text_align'] = sanitize_key( $clean_atts['text_align'] );

			$this->atts = $clean_atts;
		}

		protected function get_container_html_class( $custom_class = '' ) {
			$container_classes = array();

			if ( $custom_class ) {
				$container_classes[] = $custom_class;
			}

			switch ( $this->atts['style'] ) {
				case '1':
					$container_classes[] = 'box-style-table';
					break;
				default:
					$container_classes[] = 'table';
			}

			switch ( $this->atts['background'] ) {
				case 'fancy':
					$container_classes[] = 'shortcode-action-bg';
					$container_classes[] = 'block-style-widget';
					break;
				case 'plain':
					$container_classes[] = 'shortcode-action-bg';
					$container_classes[] = 'plain-bg';
					break;
			}

			/**
			 * @deprecated Only for backward compatibility
			 */
			if ( in_array( $this->atts['text_align'], array( 'center', 'centre' ) ) ) {
				$container_classes[] = 'text-centered';
			}

			if ( ! $this->atts['line'] ) {
				$container_classes[] = 'no-line';
			}

			if ( presscore_shortcode_animation_on( $this->atts['animation'] ) ) {
				$container_classes[] = presscore_get_shortcode_animation_html_class( $this->atts['animation'] );
			}

			return 'class="' . esc_attr( implode( ' ', $container_classes ) ) . '"';
		}

		protected function get_content_html_class( $custom_class = '' ) {
			$content_classes = array();

			if ( $custom_class ) {
				$container_classes[] = $custom_class;
			}

			switch ( $this->atts['content_size'] ) {
				case 'small':
					$content_classes[] = 'text-small';
					break;
				case 'big':
					$content_classes[] = 'text-big';
					break;
			}

			return 'class="' . esc_attr( implode( ' ', $content_classes ) ) . '"';
		}

		protected function strip_first_button_shortcode( &$content = null ) {
			$button = '';

			if ( has_shortcode( $content, 'dt_button' ) && '1' == $this->atts['style'] ) {

				// search button shortcode in content
				if ( preg_match_all( '/' . get_shortcode_regex() . '/s', $content, $matches, PREG_SET_ORDER ) && ! empty( $matches ) ) {

					foreach ( $matches as $shortcode ) {
						if ( 'dt_button' === $shortcode[2] ) {
							$button = do_shortcode_tag( $shortcode );
							$button = '<div class="shortcode-action-container action-button">' . $button . '</div>';
							$content = str_replace( $shortcode[0], '', $content );
							break;
						}
					}

				}

			}

			return $button;
		}
	}

	// create shortcode
	DT_Shortcode_CallToAction::get_instance();

}
