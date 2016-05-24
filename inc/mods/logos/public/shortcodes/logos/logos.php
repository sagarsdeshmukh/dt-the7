<?php
/**
 * Logos shortcode.
 *
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! class_exists( 'DT_Shortcode_Logos', false ) ) {
	class DT_Shortcode_Logos extends DT_Shortcode {

		static protected $instance;

		protected $shortcode_name = 'dt_logos';
		protected $post_type = 'dt_logos';
		protected $taxonomy = 'dt_logos_category';

		public static function get_instance() {
			if ( !self::$instance ) {
				self::$instance = new DT_Shortcode_Logos();
			}
			return self::$instance;
		}

		protected function __construct() {
			add_shortcode( $this->shortcode_name, array($this, 'shortcode') );
		}

		public function shortcode( $atts, $content = null ) {
			$this->atts = $this->sanitize_attributes( $atts );

			$dt_query = $this->get_posts_by_terms( $this->atts );

			$output = '';
			if ( $dt_query->have_posts() ) {

				$this->backup_post_object();

				$logos = '';
				while ( $dt_query->have_posts() ) { $dt_query->the_post();

					$logos .= '<div class="wf-cell">';
						$logos .= '<div>';
							$logos .= $this->render_logo( $this->atts );
						$logos .= '</div>';
					$logos .= '</div>';

				}

				$this->restore_post_object();

				$output .= '<section ' . $this->get_container_html_class( 'logos-grid wf-container' ) . $this->get_conatiner_data_attributes() . '>';
					$output .= $logos;
				$output .= '</section>';
			}

			return $output;
		}

		public function render_logo( $attributes = array() ) {
			$post_id = get_the_ID();
			
			if ( !$post_id ) {
				return '';
			}

			$html = '';
			$images = array('normal' => null, 'retina' => null);
			$image_classes = array();

			$esc_title = esc_attr( get_the_title() );

			$thumb_id = 0;

			// get featured image       
			if ( has_post_thumbnail( $post_id ) ) {
				$thumb_id = get_post_thumbnail_id( $post_id );
				$images['normal'] = wp_get_attachment_image_src( $thumb_id, 'full' );
			};

			// get retina image
			$retina_logo_id = get_post_meta( $post_id, '_dt_logo_options_retina_logo', true );

			if ( $retina_logo_id ) {
				$images['retina'] = dt_get_uploaded_logo( array( '', $retina_logo_id[0] ), 'retina' );
			}

			// default image
			$default_img = null;
			foreach ( $images as $image ) {
				if ( $image ) { $default_img = $image; break; } 
			}

			if ( !$default_img ) {
				return '';
			}

			if ( presscore_shortcode_animation_on( $attributes['animation'] ) ) {
				$image_classes[] = presscore_get_shortcode_animation_html_class( $attributes['animation'] );
			}

			// ninjaaaa!
			$image_classes = implode( ' ', $image_classes );

			// final image
			if ( presscore_is_srcset_based_retina() ) {
				$image = presscore_get_image_with_srcset( $images['normal'], $images['retina'], $default_img, 'alt="' . $esc_title . '"', esc_attr( $image_classes ) );
			} else {
				$image = dt_get_retina_sensible_image( $images['normal'], $images['retina'], $default_img, 'alt="' . $esc_title . '"', esc_attr( $image_classes ) );
			}

			// if link not empty - wrap image with it
			$link = get_post_meta( $post_id, '_dt_logo_options_link', true );
			if ( $link ) {
				$image_id = ( dt_is_hd_device() && isset($retina_logo_id[0]) ) ? $retina_logo_id[0] : $thumb_id;

				$esc_caption = '';
				$attachment = dt_get_attachment( $image_id );
				if ( $attachment ) {
					$esc_caption = esc_attr($attachment['description']);
				}
				$link = esc_attr( $link );
				$image = '<a href="' . $link . '" target="_blank" title="' . $esc_caption . '" >' . $image . '</a>';
			}

			// get it all togeather
			return $image;
		}

		protected function sanitize_attributes( &$atts ) {
			$clean_atts = shortcode_atts( array(
				'category' => '',
				'order' => 'desc',
				'orderby' => 'date',
				'number' => '12',
				'column_width' => '180',
				'columns_number' => '3',
				'animation' => 'none',
				'animate' => 'one_by_one'
			), $atts );

			$clean_atts['animate'] = sanitize_key( $clean_atts['animate'] );

			$clean_atts['order'] = apply_filters('dt_sanitize_order', $clean_atts['order']);
			$clean_atts['orderby'] = apply_filters('dt_sanitize_orderby', $clean_atts['orderby']);
			$clean_atts['number'] = apply_filters('dt_sanitize_posts_per_page', $clean_atts['number']);

			$clean_atts['column_width'] = absint( $clean_atts['column_width'] );
			$clean_atts['columns_number'] = absint( $clean_atts['columns_number'] );

			if ( $clean_atts['category']) {
				$clean_atts['category'] = explode(',', $clean_atts['category']);
				$clean_atts['category'] = array_map('trim', $clean_atts['category']);
				$clean_atts['select'] = 'only';
			} else {
				$clean_atts['select'] = 'all';
			}

			return $clean_atts;
		}

		protected function get_container_html_class( $custom_class = '' ) {
			$class = array();

			if ( $custom_class ) {
				$class[] = $custom_class;
			}

			if ( ! in_array( $this->atts['animation'], array( '', 'none' ) ) && 'at_the_same_time' == $this->atts['animate'] ) {
				$class[] = 'animation-at-the-same-time';
			}

			return 'class="' . esc_attr( implode( ' ', $class ) ) . '"';
		}

		protected function get_conatiner_data_attributes() {
			$data_atts = array(
				'width' => $this->atts['column_width'] . 'px',
				'columns' => $this->atts['columns_number']
			);

			return ' ' . presscore_get_inlide_data_attr( $data_atts );
		}
	}

	// create shortcode
	DT_Shortcode_Logos::get_instance();

}
