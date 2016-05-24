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
				$this->atts['hd_image'] = '';
				$this->atts['image_alt'] = esc_attr( get_post_meta( $image_id, '_wp_attachment_image_alt', true ) );
				$this->atts['media'] = esc_url( get_post_meta( $image_id, 'dt-video-url', true ) );
				$post_content = get_post_field( 'post_content', $image_id );
				$this->content = $this->sanitize_content( $post_content );

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

			switch ( $this->atts['style'] ) {
				case '3':
					$class[] = 'br-standard';
				case '2':
					$class[] = 'borderframe';
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

			return 'class="' . esc_attr( implode( ' ', $class ) ) . '"';
		}

		protected function get_container_inline_style() {
			$style = array(
				'margin-top' => $this->atts['margin_top'] . 'px',
				'margin-bottom' => $this->atts['margin_bottom'] . 'px',
				'margin-left' => $this->atts['margin_left'] . 'px',
				'margin-right' => $this->atts['margin_right'] . 'px'
			);

			if ( $this->atts['width'] ) {
				$style['width'] = $this->atts['width'] . 'px';
			}

			/**
			 * @see html-helpers.php
			 */
			return ' ' . presscore_get_inline_style_attr( $style );
		}

		protected function render_video_in_lightbox( $args = array() ) {
			$output = '';

			if ( $args['rollover'] ) {
				$output .= '<div class="rollover-video">';
					$output .= $args['image_html'];
					$output .= '<a class="video-icon dt-single-mfp-popup dt-mfp-item mfp-iframe" href="' . $args['href'] . '" title="' . $args['title'] . '" data-dt-img-description="' . $args['description'] . '"></a>';
				$output .= '</div>';
			} else {
				$output .= '<a class="dt-single-mfp-popup dt-mfp-item mfp-iframe" href="' . $args['href'] . '" title="' . $args['title'] . '" data-dt-img-description="' . $args['description'] . '">';
					$output .= $args['image_html'];
				$output .= '</a>';
			}

			return $output;
		}

		protected function render_video( $video_url ) {
			return dt_get_embed( $video_url );
		}

		protected function render_image( $args = array() ) {
			return '<img src="' . $args['src'] . '" alt="' . $args['alt'] . '" />';
		}

		protected function render_image_in_lightbox( $args = array() ) {
			$output = '';

			$output .= '<a class="' . ( $args['rollover'] ? 'rollover rollover-zoom ' : '' ) . 'dt-single-mfp-popup dt-mfp-item mfp-image" href="' . $args['href'] . '" title="' . $args['title'] . '" data-dt-img-description="' . $args['description'] . '">';
				$output .= $args['image_html'];
			$output .= '</a>';

			return $output;
		}

		protected function wrap_media( $media ) {
			$output = '';

			if ( $media ) {

				$style = ( '1' != $this->atts['style'] ? ' style="padding: ' . $this->atts['padding'] . 'px;"' : '' );

				$output .= '<div class="shortcode-single-image"' . $style . '>';
					$output .= '<div class="fancy-media-wrap">';
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
				'style' => '1',
				'image_id' => '',
				'image' => '',
				'image_alt' => '',
				'hd_image' => '',
				'image_hovers' => 'true',
				'media' => '',
				'padding' => '10',
				'lightbox' => '',
				'align' => 'left',
				'animation' => 'none',
				'width' => '270',
				'margin_top' => '0',
				'margin_bottom' => '0',
				'margin_right' => '0',
				'margin_left' => '0',
			), $atts );

			$clear_atts['type'] = sanitize_key( $clear_atts['type'] );
			$clear_atts['style'] = sanitize_key( $clear_atts['style'] );
			$clear_atts['align'] = sanitize_key( $clear_atts['align'] );

			// artificial shortcode attr
			$clear_atts['image_alt'] = $clear_atts['image_title'] = esc_attr( $clear_atts['image_alt'] );

			$clear_atts['image'] = esc_url( $clear_atts['image'] );
			$clear_atts['hd_image'] = esc_url( $clear_atts['hd_image'] );
			$clear_atts['media'] = esc_url( $clear_atts['media'] );

			$clear_atts['lightbox'] = apply_filters( 'dt_sanitize_flag', $clear_atts['lightbox'] );
			$clear_atts['image_hovers'] = apply_filters( 'dt_sanitize_flag', $clear_atts['image_hovers'] );

			$clear_atts['width'] = absint( $clear_atts['width'] );
			$clear_atts['image_id'] = absint( $clear_atts['image_id'] );
			$clear_atts['padding'] = intval( $clear_atts['padding'] );
			$clear_atts['margin_top'] = intval( $clear_atts['margin_top'] );
			$clear_atts['margin_bottom'] = intval( $clear_atts['margin_bottom'] );
			$clear_atts['margin_right'] = intval( $clear_atts['margin_right'] );
			$clear_atts['margin_left'] = intval( $clear_atts['margin_left'] );

			return $clear_atts;
		}

		protected function sanitize_content( &$content ) {
			return strip_shortcodes( $content );
		}

		protected function is_uploaded_image() {
			return ( 'uploaded_image' == $this->atts['type'] );
		}

		protected function choose_src_responsively( $img, $hd_img = '' ) {
			$default_img = $img ? $img : $hd_img;

			if ( dt_retina_on() ) {
				$image_src = dt_is_hd_device() ? $hd_img : $img;
			} else {
				$image_src = $img;
			}

			if ( empty( $image_src ) ) {
				$image_src = $default_img;
			}

			return $image_src;
		}

		protected function get_media() {
			$output = '';
			$video_url = $this->atts['media'];
			$image_src = $this->choose_src_responsively( $this->atts['image'], $this->atts['hd_image'] );
			$image_html = $this->render_image( array( 'src' => $image_src, 'alt' => $this->atts['image_alt'] ) );

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

					$output = $this->render_video( $video_url );

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

				}

			} else if ( $video_url ) {

				$output = $this->render_video( $video_url );

			}

			return $this->wrap_media( $output );
		}

	}

	// create shortcode
	DT_Shortcode_FancyImage::get_instance();

}
