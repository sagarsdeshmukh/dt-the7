<?php
/**
 * Teaser shortcode.
 *
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! class_exists( 'DT_Shortcode_Teaser', false ) ) {

	class DT_Shortcode_Teaser extends DT_Shortcode {

		static protected $instance;

		protected $shortcode_name = 'dt_teaser';

		public static function get_instance() {
			if ( !self::$instance ) {
				self::$instance = new DT_Shortcode_Teaser();
			}
			return self::$instance;
		}

		protected function __construct() {
			add_shortcode( $this->shortcode_name, array( $this, 'shortcode' ) );
		}

		public function shortcode( $atts, $content = null ) {
			$default_atts = array(
				'type' => 'uploaded_image',
				'style' => '1',
				'image' => '',
				'image_alt' => '',
				'image_id' => '',
				'image_width' => '',
				'image_height' => '',
				'image_hovers' => 'true',
				'misc_link' => '',
				'target' => 'blank',
				'media' => '',
				'background' => 'no',
				'lightbox' => '',
				'content_size' => 'big',
				'text_align' => 'left',
				'animation' => 'none',
			);

			$attributes = shortcode_atts( $default_atts, $atts );

			$attributes['type'] = sanitize_key( $attributes['type'] );
			$attributes['target'] = sanitize_key( $attributes['target'] );
			$attributes['style'] = sanitize_key( $attributes['style'] );
			$attributes['background'] = sanitize_key( $attributes['background'] );
			$attributes['content_size'] = sanitize_key( $attributes['content_size'] );
			$attributes['text_align'] = sanitize_key( $attributes['text_align'] );

			$attributes['image_id'] = absint($attributes['image_id']);
			$attributes['image_alt'] = esc_attr($attributes['image_alt']);
			$attributes['image_width'] = absint($attributes['image_width']);
			$attributes['image_height'] = absint($attributes['image_height']);
			$attributes['image_hovers'] = apply_filters( 'dt_sanitize_flag', $attributes['image_hovers'] );

			$attributes['misc_link'] = esc_url($attributes['misc_link']);
			$attributes['lightbox'] = apply_filters('dt_sanitize_flag', $attributes['lightbox']);

			$attributes['media'] = esc_url($attributes['media']);


			$container_classes = array( 'shortcode-teaser' );
			$content_classes = array( 'shortcode-teaser-content' );
			$media = '';

			// container classes
			if ( '1' == $attributes['style'] ) {
				$container_classes[] = 'img-full';
			}

			switch ( $attributes['background'] ) {
				case 'fancy': $container_classes[] = 'frame-fancy';
				case 'plain': $container_classes[] = 'frame-on';
			}

			if ( in_array( $attributes['text_align'], array('center', 'centre') ) ) {
				$container_classes[] = 'text-centered';
			}

			// content classes
			switch ( $attributes['content_size'] ) {
				case 'small': $content_classes[] = 'text-small'; break;
				case 'normal': $content_classes[] = 'text-normal'; break;
				case 'big':
				default:
					$content_classes[] = 'text-big';
			}

			if ( presscore_shortcode_animation_on( $attributes['animation'] ) ) {
				$container_classes[] = presscore_get_shortcode_animation_html_class( $attributes['animation'] );
			}

			if ( 'uploaded_image' == $attributes['type'] ) {
				$attributes['image'] = $attributes['image_id'];
				$attributes['media'] = '';

			} else if ( 'image' == $attributes['type'] ) {
				$attributes['media'] = '';

			} else if ( 'video' == $attributes['type'] ) {
				$attributes['image'] = '';

			}

			// if media url is set - do some stuff
			if ( $attributes['media'] ) {
				$container_classes[] = 'shortcode-single-video';

				$media = sprintf( '<div class="shortcode-teaser-img"><div class="shortcode-teaser-video">%s</div></div>', dt_get_embed($attributes['media']) );

			// if image is set
			} elseif ( $attributes['image'] ) {

				if ( is_numeric($attributes['image']) ) {
					$image_id = absint($attributes['image']);
					$image_info = wp_get_attachment_image_src( $image_id, 'full' );

					// get image src
					if ( !$image_info ) {
						$image_info = presscore_get_default_image();
					}

					$image_src = $image_info[0];

					// get image alt
					if ( empty($attributes['image_alt']) ) {
						$attributes['image_alt'] = esc_attr( get_post_meta( $image_id, '_wp_attachment_image_alt', true ) );
					}

					// get image dimensions
					$attributes['image_width'] = $image_info[1];
					$attributes['image_height'] = $image_info[2];

				} else {
					$image_src = esc_url($attributes['image']);

				}

				// format image dimesions
				$image_dimension_attrs = '';
				if ( $attributes['image_width'] > 0 && $attributes['image_height'] > 0 ) {
					$image_dimension_attrs .= ' width="' . $attributes['image_width'] . '"';
					$image_dimension_attrs .= ' height="' . $attributes['image_height'] . '"';
				}

				$media = sprintf( '<img src="%s" alt="%s"%s />', $image_src, $attributes['image_alt'], $image_dimension_attrs );

				if ( $attributes['lightbox'] ) {
					$media = sprintf(
						'<a class="%s dt-single-mfp-popup dt-mfp-item mfp-image" href="%s" title="%s" data-dt-img-description="%s">%s</a>',
						$attributes['image_hovers'] ? 'rollover rollover-zoom' : '',
						$image_src,
						esc_attr( $attributes['image_alt'] ),
						'',
						$media
					);

				} else if ( $attributes['misc_link'] ) {
					$media = sprintf(
						'<a %s href="%s"%s>%s</a>',
						$attributes['image_hovers'] ? 'class="rollover"' : '',
						$attributes['misc_link'],
						('blank' == $attributes['target']) ? ' target="_blank"' : '',
						$media
					);

				}

				$media = sprintf( '<div class="shortcode-teaser-img">%s</div>', $media );
			}

			$output = sprintf('<section class="%s">%s<div class="%s">%s</div></section>',
				esc_attr(implode(' ', $container_classes)),
				$media,
				esc_attr(implode(' ', $content_classes)),

				/**
				 * @see sanitize-functions.php
				 */
				presscore_remove_wpautop( $content, true )
			);

			return $output; 
		}

	}

	// create shortcode
	DT_Shortcode_Teaser::get_instance();

}
