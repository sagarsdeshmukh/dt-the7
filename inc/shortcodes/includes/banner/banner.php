<?php
/**
 * Banner shortcode.
 *
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! class_exists( 'DT_Shortcode_Banner', false ) ) {

	class DT_Shortcode_Banner extends DT_Shortcode {

		static protected $instance;

		protected $shortcode_name = 'dt_banner';
		protected $atts = array();

		public static function get_instance() {
			if ( !self::$instance ) {
				self::$instance = new DT_Shortcode_Banner();
			}
			return self::$instance;
		}

		protected function __construct() {
			add_shortcode( $this->shortcode_name, array( $this, 'shortcode' ) );
		}

		public function shortcode( $atts, $content = null ) {

			$this->sanitize_attributes( $atts );

			$output = '';

			$output .= '<div ' . $this->get_container_html_class( 'shortcode-banner' ) . ' ' . $this->get_container_inline_style() . $this->get_link() . '>';

				$output .= '<div class="shortcode-banner-bg wf-table" ' . $this->get_bg_inline_style() . '>';

					$output .= '<div ' . $this->get_inner_html_class( 'shortcode-banner-inside wf-table' ) . ' ' . $this->get_inner_inline_style() . '>';

						$output .= '<div>';

							/**
							 * @see sanitize-functions.php
							 */
							$output .= presscore_remove_wpautop( $content, true );

						$output .= '</div>';

					$output .= '</div>';

				$output .= '</div>';

			$output .= '</div>';

			return $output; 
		}

		protected function sanitize_attributes( &$atts ) {
			$clean_atts = shortcode_atts( array(
				'type' => 'uploaded_image',
				'image_id' => '',
				'bg_image' => '',
				'bg_color' => 'rgba(0,0,0,0.4)',
				'text_color' => '#ffffff',
				'text_size' => 'big',
				'border_width' => '3',
				'outer_padding' => '10',
				'inner_padding' => '10',
				'min_height' => '150',
				'link' => '',
				'target_blank' => 'false',
				'animation' => 'none',
			), $atts );

			$clean_atts['text_size'] = sanitize_key( $clean_atts['text_size'] );
			$clean_atts['type'] = sanitize_key( $clean_atts['type'] );

			$clean_atts['bg_image'] = dt_make_image_src_ssl_friendly( esc_url( $clean_atts['bg_image'] ) );
			$clean_atts['bg_color'] = esc_attr( $clean_atts['bg_color'] );
			$clean_atts['text_color'] = esc_attr( $clean_atts['text_color'] );

			$clean_atts['target_blank'] = apply_filters( 'dt_sanitize_flag', $clean_atts['target_blank'] );

			$clean_atts['border_width'] = absint( $clean_atts['border_width'] );
			$clean_atts['outer_padding'] = absint( $clean_atts['outer_padding'] );
			$clean_atts['inner_padding'] = absint( $clean_atts['inner_padding'] );
			$clean_atts['min_height'] = absint( $clean_atts['min_height'] );
			$clean_atts['image_id'] = absint( $clean_atts['image_id'] );

			$clean_atts['link'] = esc_url( $clean_atts['link'] );

			$this->atts = $clean_atts;
		}

		protected function get_container_html_class( $custom_class = '' ) {

			$class = array();

			if ( $custom_class ) {
				$class[] = $custom_class;
			}

			if ( $this->atts['link'] ) {
				$class[] = 'shortcode-banner-link';
			}

			if ( presscore_shortcode_animation_on( $this->atts['animation'] ) ) {
				$class[] = presscore_get_shortcode_animation_html_class( $this->atts['animation'] );
			}

			return 'class="' . esc_attr( implode( ' ', $class ) ) . '"';
		}

		protected function get_inner_html_class( $custom_class = '' ) {
			$class = array();

			if ( $custom_class ) {
				$class[] = $custom_class;
			}

			switch ( $this->atts['text_size'] ) {
				case 'small':
					$class[] = 'text-small';
					break;
				case 'big':
					$class[] = 'text-big';
					break;
				case 'normal':
					$class[] = 'text-normal';
					break;
			}

			return 'class="' . esc_attr( implode( ' ', $class ) ) . '"';
		}

		protected function get_container_inline_style() {
			$banner_style = array();

			$banner_style[] = 'min-height: ' . $this->atts['min_height'] . 'px';

			switch( $this->atts['type'] ) {
				case 'uploaded_image':
					$attachment_src = wp_get_attachment_image_src( $this->atts['image_id'], 'full' );
					if ( $attachment_src ) {
						$banner_style[] = sprintf( 'background-image: url(%s)', $attachment_src[0] );
					}
					break;
				case 'image':
					if ( $this->atts['bg_image'] ) {
						$banner_style[] = sprintf( 'background-image: url(%s)', $this->atts['bg_image'] );
					}
					break;
			}

			return 'style="' . esc_attr( implode( ';', $banner_style ) ) . '"';
		}

		protected function get_inner_inline_style() {
			$banner_inner_style = array();

			if ( $this->atts['bg_color'] ) {

				if ( false !== strpos( $this->atts['bg_color'], 'rgba' ) ) {
					$ie_color = dt_stylesheet_color_rgba2rgb( $this->atts['bg_color'] );
				} else {
					$ie_color = dt_stylesheet_color_hex2rgb( $this->atts['bg_color'] );
				}

				$banner_inner_style[] = 'background-color: ' . $ie_color;
				$banner_inner_style[] = 'background-color: ' . $this->atts['bg_color'];

			}

			$banner_inner_style[] = sprintf( 'border: solid %spx transparent', $this->atts['inner_padding'] );
			$banner_inner_style[] = sprintf( 'outline: solid %spx', $this->atts['border_width'] );

			if ( $this->atts['text_color'] ) {
				$banner_inner_style[] = 'outline-color: ' . $this->atts['text_color'];
			}

			$banner_inner_height = $this->atts['min_height'] - $this->atts['inner_padding'];
			$banner_inner_style[] = 'height: ' . $banner_inner_height . 'px';

			return 'style="' . esc_attr( implode( ';', $banner_inner_style ) ) . '"';
		}

		protected function get_bg_inline_style() {
			$banner_bg_style = array();

			$padding = ( $this->atts['outer_padding'] > $this->atts['border_width'] ? $this->atts['outer_padding'] : $this->atts['border_width'] );
			$banner_bg_style[] = 'padding: ' . $padding . 'px';
			$banner_bg_style[] = 'min-height: ' . $this->atts['min_height'] . 'px';

			return 'style="' . esc_attr( implode( ';', $banner_bg_style ) ) . '"';
		}

		protected function get_link() {
			$link = '';
			if ( $this->atts['link'] ) {

				if ( $this->atts['target_blank'] ) {
					$link = sprintf( ' onclick="window.open(\'%s\');"', $this->atts['link'] );
				} else {
					$link = sprintf( ' onclick="window.location.href=\'%s\';"', $this->atts['link'] );
				}
			}

			return $link;
		}

	}

	// create shortcode
	DT_Shortcode_Banner::get_instance();

}
