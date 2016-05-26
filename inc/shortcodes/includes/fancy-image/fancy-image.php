<?php
/**
 * Fancy image shortcode.
 *
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! class_exists( 'DT_Shortcode_FancyImage', false ) ) {
	class DT_Shortcode_FancyImage extends DT_Shortcode {

		static protected $instance;

		protected $shortcode_name = 'dt_fancy_image';
		protected $atts = array();
		protected $content = null;

		public static function get_instance() {
			if ( !self::$instance ) {
				self::$instance = new DT_Shortcode_FancyImage();
			}
			return self::$instance;
		}

		protected function __construct() {
			add_shortcode( $this->shortcode_name, array( $this, 'shortcode' ) );
		}

		public function shortcode( $atts, $content = null ) {

			$this->content = $this->sanitize_content( $content );
			$this->atts = $this->sanitize_attributes( $atts );

			// override shortcode atts for uploaded image
			if ( $this->is_uploaded_image() ) {

				$image_id = $this->atts['image_id'];
				$image_src = wp_get_attachment_image_src( $image_id, 'full' );

				if ( ! $image_src ) {
					return '';
				}

				if ( get_post_meta( $image_id, 'dt-img-hide-title', true ) ) {
					$this->atts['image_title'] = '';
				} else {
					$this->atts['image_title'] = get_the_title( $image_id );
				}

				$this->atts['image'] = $image_src[0];
				$this->atts['_image_width'] = $image_src[1];
				$this->atts['_image_height'] = $image_src[2];
				$this->atts['hd_image'] = '';
				$this->atts['image_alt'] = esc_attr( get_post_meta( $image_id, '_wp_attachment_image_alt', true ) );
				$this->atts['media'] = esc_url( get_post_meta( $image_id, 'dt-video-url', true ) );
				$post_content = get_post_field( 'post_content', $image_id );
				$this->content = $this->sanitize_content( $post_content );

			} else {

				// Do not use height attribute for images from url.
				$this->atts['height'] = 0;
			}

			$output = '';

			$output .= '<div ' . $this->get_container_html_class( 'shortcode-single-image-wrap' ) . $this->get_container_inline_style() . '>';
				$output .= $this->get_media();
				$output .= $this->get_caption();
			$output .= '</div>';

			return $output; 
		}

		protected function get_container_html_class( $custom_class = '' ) {
			$class = array();

			if ( $custom_class ) {
				$class[] = $custom_class;
			}

			switch ( $this->atts['align'] ) {
				case 'left': $class[] = 'alignleft'; break;
				case 'right': $class[] = 'alignright'; break;
				case 'centre':
				case 'center': $class[] = 'alignnone'; break;
			}

			if ( presscore_shortcode_animation_on( $this->atts['animation'] ) ) {
				$class[] = presscore_get_shortcode_animation_html_class( $this->atts['animation'] );
			}

			if ( $this->content ) {
				$class[] = 'caption-on';
			}

			$image_src = $this->choose_src_responsively( $this->atts['image'], $this->atts['hd_image'] );
			$video_url = $this->atts['media'];
			$lightbox = $this->atts['lightbox'];

			if ( ( $image_src && $video_url && ! $lightbox ) || ( ! $image_src && $video_url ) ) {
				$class[] = 'shortcode-single-video';
			}

			if ( function_exists( 'vc_shortcode_custom_css_class' ) ) {
				$class[] = vc_shortcode_custom_css_class( $this->atts['css'], ' ' );
			}

			return 'class="' . esc_attr( implode( ' ', $class ) ) . '"';
		}

		protected function get_container_inline_style() {
			$style = array();

			if ( $this->is_compatibility_mode() ) {
				$style['margin-top'] = $this->atts['margin_top'] . 'px';
				$style['margin-bottom'] = $this->atts['margin_bottom'] . 'px';
				$style['margin-left'] = $this->atts['margin_left'] . 'px';
				$style['margin-right'] = $this->atts['margin_right'] . 'px';

				if ( $this->atts['width'] ) {
					$style['width'] = $this->atts['width'] . 'px';
				}
			}

			/**
			 * @see html-helpers.php
			 */
			return ' ' . presscore_get_inline_style_attr( $style );
		}

		protected function render_video_in_lightbox( $args = array() ) {
			$output = '';
			$class = '';

			if ( $this->lazy_loading_on() ) {
				$class .= 'layzr-bg ';
			}

			if ( $args['rollover'] ) {
				$output .= '<div class="' . $class . 'rollover-video">';
					$output .= $args['image_html'];
					$output .= '<a class="video-icon dt-single-mfp-popup dt-mfp-item mfp-iframe" href="' . $args['href'] . '" title="' . $args['title'] . '" data-dt-img-description="' . $args['description'] . '"></a>';
				$output .= '</div>';
			} else {
				$output .= '<a class="' . $class . 'dt-single-mfp-popup dt-mfp-item mfp-iframe" href="' . $args['href'] . '" title="' . $args['title'] . '" data-dt-img-description="' . $args['description'] . '">';
					$output .= $args['image_html'];
				$output .= '</a>';
			}

			return $output;
		}

		protected function render_video( $video_url, $width = null, $height = null ) {
			return dt_get_embed( $video_url, $width, $height );
		}

		protected function extract_dimensions( $dimensions ) {
			$dimensions = str_replace( ' ', '', $dimensions );
			$matches = null;

			if ( preg_match( '/(\d+)x(\d+)/', $dimensions, $matches ) ) {
				return array(
					$matches[1],
					$matches[2],
				);
			}

			return false;
		}

		protected function lazy_loading_on() {
			return function_exists( 'presscore_lazy_loading_enabled' ) && presscore_lazy_loading_enabled();
		}

		protected function render_resized_image( $args = array() ) {
			return dt_get_thumb_img( array(
				'wrap' => '<img %IMG_CLASS% %SRC% %SIZE% %CUSTOM% />',
				'img_meta' => array( $args['src'], $args['width'], $args['height'] ),
				'alt' => $args['alt'],
				'echo' => false,
				'options' => ( isset( $args['resize_to'] ) ? $args['resize_to'] : array() ),
			) );
		}

		protected function render_image( $args = array() ) {
			$hwstring = ( $args['width'] && $args['height'] ? image_hwstring( $args['width'], $args['height'] ) : '' );

			if ( $this->lazy_loading_on() ) {
				return presscore_get_lazy_image( array( array( $args['src'], $args['width'], $args['height'] ) ), $args['width'], $args['height'], array( 'alt' => $args['alt'] ) );
			} else {
				return '<img src="' . $args['src'] . '" srcset="' . $args['src'] . ' ' . $args['width'] . 'w" alt="' . $args['alt'] . '" ' . $hwstring . '/>';
			}
		}

		protected function render_image_in_lightbox( $args = array() ) {
			$output = '';

			$output .= '<a class="' . ( $this->lazy_loading_on() ? 'layzr-bg ' : '' ) . ( $args['rollover'] ? 'rollover rollover-zoom ' : '' ) . 'dt-single-mfp-popup dt-mfp-item mfp-image" href="' . $args['href'] . '" title="' . $args['title'] . '" data-dt-img-description="' . $args['description'] . '">';
				$output .= $args['image_html'];
			$output .= '</a>';

			return $output;
		}

		protected function wrap_media( $media, $wrap_class = '' ) {
			$output = '';

			if ( $media ) {

				$style = '';

				$output .= '<div class="shortcode-single-image"' . $style . '>';
					$output .= '<div class="fancy-media-wrap' . ( $wrap_class ? ' ' . $wrap_class : '' ) . '">';
						$output .= $media;
					$output .= '</div>';
				$output .= '</div>';
			}

			return $output;
		}

		protected function get_caption() {
			$caption = '';
			if ( $this->content ) {
				$caption = '<div class="shortcode-single-caption">' . $this->content . '</div>';
			}
			return $caption;
		}

		protected function sanitize_attributes( &$atts ) {
			$clear_atts = shortcode_atts( array(
				'type' => 'uploaded_image',
				'image_id' => '',
				'image' => '',
				'image_alt' => '',
				'image_dimensions' => '',
				'hd_image' => '',
				'image_hovers' => 'true',
				'media' => '',
				'lightbox' => '',
				'align' => 'left',
				'animation' => 'none',
				'width' => '270',
				'height' => '',
				'margin_top' => '0',
				'margin_bottom' => '0',
				'margin_right' => '0',
				'margin_left' => '0',
				'css' => '',
			), $atts );

			$clear_atts['type'] = sanitize_key( $clear_atts['type'] );
			$clear_atts['align'] = sanitize_key( $clear_atts['align'] );

			// artificial shortcode attr
			$clear_atts['image_alt'] = $clear_atts['image_title'] = esc_attr( $clear_atts['image_alt'] );

			$clear_atts['image'] = esc_url( $clear_atts['image'] );
			$clear_atts['hd_image'] = esc_url( $clear_atts['hd_image'] );
			$clear_atts['media'] = esc_url( $clear_atts['media'] );

			$clear_atts['lightbox'] = apply_filters( 'dt_sanitize_flag', $clear_atts['lightbox'] );
			$clear_atts['image_hovers'] = apply_filters( 'dt_sanitize_flag', $clear_atts['image_hovers'] );

			$clear_atts['width'] = absint( $clear_atts['width'] );
			$clear_atts['height'] = absint( $clear_atts['height'] );
			$clear_atts['image_id'] = absint( $clear_atts['image_id'] );
			$clear_atts['margin_top'] = intval( $clear_atts['margin_top'] );
			$clear_atts['margin_bottom'] = intval( $clear_atts['margin_bottom'] );
			$clear_atts['margin_right'] = intval( $clear_atts['margin_right'] );
			$clear_atts['margin_left'] = intval( $clear_atts['margin_left'] );

			$image_dimensions = $this->extract_dimensions( $clear_atts['image_dimensions'] );
			if ( ! $image_dimensions ) {
				$image_dimensions = array( 0, 0 );
			}

			$clear_atts['_image_width'] = ( $image_dimensions[0] ? $image_dimensions[0] : $clear_atts['width'] );
			$clear_atts['_image_height'] = $image_dimensions[1];

			return $clear_atts;
		}

		protected function sanitize_content( &$content ) {
			return strip_shortcodes( $content );
		}

		protected function is_uploaded_image() {
			return ( 'uploaded_image' == $this->atts['type'] );
		}

		protected function is_compatibility_mode() {
			return ( ! $this->atts['css'] );
		}

		protected function choose_src_responsively( $img, $hd_img = '' ) {
			$default_img = $img ? $img : $hd_img;

			$image_src = dt_is_hd_device() ? $hd_img : $img;

			if ( empty( $image_src ) ) {
				$image_src = $default_img;
			}

			return $image_src;
		}

		protected function get_media() {
			$output = '';

			$wrap_class = '';
			$video_url = $this->atts['media'];
			$image_src = $this->choose_src_responsively( $this->atts['image'], $this->atts['hd_image'] );

			if ( $this->is_uploaded_image() ) {
				$image_html = $this->render_resized_image( array(
					'src' => $image_src,
					'alt' => $this->atts['image_alt'],
					'width' => $this->atts['_image_width'],
					'height' => $this->atts['_image_height'],
					'resize_to' => array( 'w' => $this->atts['width'], 'h' => $this->atts['height'] ),
				) );

			} else {
				$image_html = $this->render_image( array(
					'src' => $image_src,
					'alt' => $this->atts['image_alt'],
					'width' => $this->atts['_image_width'],
					'height' => $this->atts['_image_height'],
				) );
			}

			if ( $video_url && $image_src ) {

				if ( $this->atts['lightbox'] ) {

					$output = $this->render_video_in_lightbox( array(
						'image_html' => $image_html,
						'href' => $video_url,
						'title' => $this->atts['image_title'],
						'description' => $this->content,
						'rollover' => $this->atts['image_hovers']
					) );

				} else {

					$output = $this->render_video( $video_url, $this->atts['width'], $this->atts['height'] );

				}

			} else if ( $image_src ) {

				if ( $this->atts['lightbox'] ) {

					$output = $this->render_image_in_lightbox( array(
						'image_html' => $image_html,
						'href' => $image_src,
						'title' => $this->atts['image_title'],
						'description' => $this->content,
						'rollover' => $this->atts['image_hovers']
					) );

				} else {

					$output = $image_html;
					$wrap_class = 'layzr-bg';
				}

			} else if ( $video_url ) {

				$output = $this->render_video( $video_url, $this->atts['width'], $this->atts['height'] );

			}

			return $this->wrap_media( $output, $wrap_class );
		}

	}

	// create shortcode
	DT_Shortcode_FancyImage::get_instance();

}
