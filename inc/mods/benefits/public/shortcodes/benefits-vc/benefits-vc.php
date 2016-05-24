<?php
/**
 * Benefits VC shortcode.
 *
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! class_exists( 'DT_Shortcode_Benefits_Vc', false ) ) {

	class DT_Shortcode_Benefits_Vc extends DT_Shortcode {

		static protected $instance;
		static protected $shortcodes_count = 0;

		protected $shortcode_name = 'dt_benefits_vc';
		protected $post_type = 'dt_benefits';
		protected $taxonomy = 'dt_benefits_category';
		protected $atts = array();
		protected $content = '';

		public static function get_instance() {
			if ( !self::$instance ) {
				self::$instance = new DT_Shortcode_Benefits_Vc();
			}
			return self::$instance;
		}

		protected function __construct() {
			add_shortcode( $this->shortcode_name, array( $this, 'shortcode' ) );
		}

		public function shortcode( $atts, $content = null ) {
			$this->sanitize_attributes( $atts );

			// vc inline dummy
			if ( presscore_vc_is_inline() ) {
				$terms_title = _x( 'Display categories', 'vc inline dummy', 'the7mk2' );

				return $this->vc_inline_dummy( array(
					'class' => 'dt_vc-benefits',
					'title' => _x( 'Benefits', 'vc inline dummy', 'the7mk2' ),
					'fields' => array(
						$terms_title => presscore_get_terms_list_by_slug( array( 'slugs' => $this->atts['category'], 'taxonomy' => $this->taxonomy ) )
					)
				) );
			}

			if ( 'dt_benefits' == get_post_type() ) {
				return '';
			}

			self::$shortcodes_count++;

			$output = '';

			$dt_query = $this->get_posts_by_terms( $this->atts );

			if ( $dt_query->have_posts() ) {

				$this->backup_post_object();

				$benefits = '';
				while ( $dt_query->have_posts() ) { $dt_query->the_post();
					$benefit_attr = $this->get_benefit_data();
					$benefit_content = apply_filters( 'the_content', get_the_content('') );

					$benefits .= $this->render_benefit( $benefit_attr, $benefit_content );
				}

				$this->restore_post_object();

				$output .= '<section id="' . $this->get_shortcode_id() . '" ' . $this->get_container_html_class( 'benefits-grid wf-container' ) . $this->get_conatiner_data_attributes() . '>';
					$output .= $this->get_inline_stylesheet();
					$output .= $benefits;
				$output .= '</section>';

			}

			return $output;
		}

		public function render_benefit( $attributes, $content = null ) {

			$image = '';
			if ( $attributes['icon_code'] ) {
				$image = wp_kses( $attributes['icon_code'], array( 'i' => array( 'class' => array() ) ) );
			} else {
				$default_image = null;
				$images = array( $attributes['image'], $attributes['hd_image'] );

				// get default logo
				foreach ( $images as $img ) {
					if ( $img ) { 
						$default_image = $img; break;
					}
				}

				if ( !empty($default_image) ) {
					if ( dt_retina_on() ) {
						$image = dt_is_hd_device() ? $images[1] : $images[0];
					} else {
						$image = $images[0];
					}

					if ( empty($image) ) {
						$image = $default_image;
					}

					// ssl support
					$image = dt_make_image_src_ssl_friendly( $image);

					$image_size = '';
					if ( !empty($attributes['image_size']) ) {
						$image_size = image_hwstring( $attributes['image_size'][0], $attributes['image_size'][1] );
					}

					$image = sprintf( '<img src="%s" %s alt="%s" />', $image, $image_size, esc_attr( $attributes['image_alt'] ) );
				}
			}

			if ( $image ) {

				$image_classes = array( 'benefits-grid-ico' );

				if ( presscore_shortcode_animation_on( $attributes['animation'] ) ) {
					$image_classes[] = presscore_get_shortcode_animation_html_class( $attributes['animation'] );
				}

				// ninjaaaa!
				$image_classes = esc_attr( implode( ' ', $image_classes ) );

				if ( $attributes['image_link'] ) {
					$image = sprintf( '<a href="%s" class="%s"%s>%s</a>', $attributes['image_link'], $image_classes, ($attributes['target_blank'] ? ' target="_blank"' : ''), $image );
				} else {
					$image = sprintf( '<span class="%s">%s</span>', $image_classes, $image );
				}

			}

			$style = empty( $attributes['style'] ) ? '1' : $attributes['style'];

			$title = '';
			if ( $attributes['title'] ) {

				if ( $attributes['image_link'] ) {
					$title = sprintf( '<%1$s class="benefit-title"><a href="%2$s"%3$s>%4$s</a></%1$s>',
						$attributes['header_size'],
						$attributes['image_link'],
						($attributes['target_blank'] ? ' target="_blank"' : ''),
						$attributes['title']
					);
				} else {
					$title = sprintf( '<%1$s>%2$s</%1$s>', $attributes['header_size'], $attributes['title'] );
				}
			}

			$output = '';

			switch( $style ) {

				case '2':
					$output .=	'<div class="wf-cell">'
									. '<div>'
										. '<div class="text-' . $attributes['content_size'] . '">'
											. '<div class="wf-table">'

												. '<div class="wf-td">'
													. $image
												. '</div>'

												. '<div class="wf-td">'
													. $title
												. '</div>'

											. '</div>'
											. $content
										. '</div>'
									. '</div>'
								. '</div>';
					break;

				case '3':
					$output .=	'<div class="wf-cell">'
									. '<div>'
										. '<div class="text-' . $attributes['content_size'] . '">'
											. '<div class="wf-table">'

												. '<div class="wf-td">'
													. $image
												. '</div>'

												. '<div class="wf-td benefits-inner">'
													. $title . $content
												. '</div>'

											. '</div>'
										. '</div>'
									. '</div>'
								. '</div>';
					break;

				default:
					$output .=	'<div class="wf-cell">'
									. '<div>'
										. '<div class="text-' . $attributes['content_size'] . '">'
											. '<div class="benefit-line-decoration">' . $image . $title . '</div>'
											. $content
										. '</div>'
									. '</div>'
								. '</div>';
			}

			return $output;
		}

		protected function sanitize_attributes( &$atts ) {
			$clean_atts = shortcode_atts( array(
				'category' => '',
				'column_width' => '180',
				'columns_number' => '3',
				'style' => '1',
				'image_background' => 'true',
				'image_background_border' => '',
				'image_background_border_radius' => '',
				'image_background_paint' => 'light',
				'image_background_color' => '#222222',
				'image_hover_background_paint' => 'light',
				'image_hover_background_color' => '#444444',
				'image_background_size' => '70',
				'icons_size' => '36',
				'icons_paint' => 'light',
				'icons_color' => '#ffffff',
				'icons_hover_paint' => 'light',
				'icons_hover_color' => '#dddddd',
				'decorative_lines' => 'disabled',
				'header_size' => 'h5',
				'content_size' => 'big',
				'number' => '8',
				'target_blank' => 'false',
				'order' => 'desc',
				'orderby' => 'date',
				'animation' => 'none',
				'animate' => 'one_by_one',
			), $atts );

			$clean_atts['order'] = apply_filters('dt_sanitize_order', $clean_atts['order']);
			$clean_atts['orderby'] = apply_filters('dt_sanitize_orderby', $clean_atts['orderby']);
			$clean_atts['number'] = apply_filters('dt_sanitize_posts_per_page', $clean_atts['number']);

			$clean_atts['image_background'] = apply_filters('dt_sanitize_flag', $clean_atts['image_background']);
			$clean_atts['target_blank'] = apply_filters( 'dt_sanitize_flag', $clean_atts['target_blank'] );

			$clean_atts['image_background_border'] = sanitize_key( $clean_atts['image_background_border'] );
			$clean_atts['image_background_paint'] = sanitize_key( $clean_atts['image_background_paint'] );
			$clean_atts['image_hover_background_paint'] = sanitize_key( $clean_atts['image_hover_background_paint'] );
			$clean_atts['icons_paint'] = sanitize_key( $clean_atts['icons_paint'] );
			$clean_atts['icons_hover_paint'] = sanitize_key( $clean_atts['icons_hover_paint'] );
			$clean_atts['decorative_lines'] = sanitize_key( $clean_atts['decorative_lines'] );
			$clean_atts['header_size'] = sanitize_key( $clean_atts['header_size'] );
			$clean_atts['content_size'] = sanitize_key( $clean_atts['content_size'] );
			$clean_atts['animate'] = sanitize_key( $clean_atts['animate'] );

			$clean_atts['column_width'] = absint( $clean_atts['column_width'] );
			$clean_atts['columns_number'] = absint( $clean_atts['columns_number'] );
			$clean_atts['style'] = absint( $clean_atts['style'] );
			$clean_atts['image_background_border_radius'] = absint( $clean_atts['image_background_border_radius'] );
			$clean_atts['icons_size'] = absint( $clean_atts['icons_size'] );
			$clean_atts['image_background_size'] = absint( $clean_atts['image_background_size'] );

			$clean_atts['image_background_color'] = esc_attr( $clean_atts['image_background_color'] );
			$clean_atts['image_hover_background_color'] = esc_attr( $clean_atts['image_hover_background_color'] );
			$clean_atts['icons_color'] = esc_attr( $clean_atts['icons_color'] );
			$clean_atts['icons_hover_color'] = esc_attr( $clean_atts['icons_hover_color'] );

			if ( $clean_atts['category']) {
				$clean_atts['category'] = presscore_sanitize_explode_string( $clean_atts['category'] );
				$clean_atts['select'] = 'only';
			} else {
				$clean_atts['select'] = 'all';
			}

			$this->atts = $clean_atts;
			return $clean_atts;
		}

		protected function get_shortcode_id() {
			return 'benefits-grid-' . self::$shortcodes_count;
		}

		protected function get_inline_stylesheet() {
			$stylesheet = '';

			$shortcode_unique_id = $this->get_shortcode_id();

			if ( $this->atts['image_background'] ) {

				$inline_style = sprintf( 'height: %1$spx; line-height: %1$spx; width: %1$spx;', $this->atts['image_background_size'] );
				if ( 'custom' == $this->atts['image_background_border'] ) {
					$inline_style .= $this->get_border_radius_style( $this->atts['image_background_border_radius'] );
				}
				$stylesheet .= $this->get_stylesheet_rule( "#{$shortcode_unique_id}.icons-bg .benefits-grid-ico", $inline_style );

				if ( 'custom' == $this->atts['image_background_paint'] ) {
					$stylesheet .= $this->get_stylesheet_rule(
						"#{$shortcode_unique_id}.icons-bg.custom-bg .benefits-grid-ico",
						sprintf( 'background-color: %1$s;', $this->atts['image_background_color'] )
					);
				}

				if ( 'custom' == $this->atts['image_hover_background_paint'] ) {
					$stylesheet .= $this->get_stylesheet_rule(
						"#{$shortcode_unique_id}.custom-hover-bg.icons-bg a.benefits-grid-ico:hover,
						#page #{$shortcode_unique_id}.custom-hover-bg.icons-bg a.benefits-grid-ico:hover",
						sprintf( 'background: %1$s;', $this->atts['image_hover_background_color'] )
					);
				}

				$stylesheet .= $this->get_stylesheet_rule(
					"#{$shortcode_unique_id}.icons-bg .benefits-grid-ico > .fa",
					sprintf( 'font-size: %1$spx; line-height: %2$spx;', $this->atts['icons_size'], $this->atts['image_background_size'] )
				);

			} else {

				$stylesheet .= $this->get_stylesheet_rule(
					"#{$shortcode_unique_id} .benefits-grid-ico > .fa",
					sprintf( 'font-size: %1$spx; line-height: %1$spx;', $this->atts['icons_size'] )
				);

			}

			if ( 'custom' == $this->atts['icons_paint'] ) {
				$stylesheet .= $this->get_stylesheet_rule(
					"#{$shortcode_unique_id}.custom-icon-color .benefits-grid-ico > .fa,
					#{$shortcode_unique_id}.custom-icon-color .benefits-grid-ico > .fa:before",
					sprintf( 'color: %1$s;', $this->atts['icons_color'] )
				);
			}

			if ( 'custom' == $this->atts['icons_hover_paint'] ) {
				$stylesheet .= $this->get_stylesheet_rule(
					"#{$shortcode_unique_id}.custom-icon-hover-color a.benefits-grid-ico:hover > .fa,
					#{$shortcode_unique_id}.custom-icon-hover-color a.benefits-grid-ico:hover > .fa:before",
					sprintf( 'color: %1$s; -webkit-text-fill-color: %1$s;', $this->atts['icons_hover_color'] )
				);
			}

			if ( $stylesheet ) {
				$stylesheet = '<style type="text/css">' . $stylesheet . '</style>';
			}

			return $stylesheet;
		}

		protected function get_border_radius_style( $radius ) {
			return "-webkit-border-radius: {$radius}px;"
				. "-moz-border-radius: {$radius}px;"
				. "-ms-border-radius: {$radius}px;"
				. "-o-border-radius: {$radius}px;"
				. "border-radius: {$radius}px;";
		}

		protected function get_stylesheet_rule( $selector, $style ) {
			$output = '';
			if ( $style ) {
				$output = sprintf( '%1$s { %2$s }', $selector, $style );
			}
			return $output;
		}

		protected function get_container_html_class( $custom_class = '' ) {
			$class = array();

			if ( $custom_class ) {
				$class[] = $custom_class;
			}

			switch ( $this->atts['style'] ) {
				case '2': $class[] = 'benefits-style-one'; break;
				case '3': $class[] = 'benefits-style-two'; break;
			}

			if ( $this->atts['image_background'] ) {
				$class[] = 'icons-bg';
			}

			if ( ! in_array( $this->atts['animation'], array( '', 'none' ) ) && 'at_the_same_time' == $this->atts['animate'] ) {
				$class[] = 'animation-at-the-same-time';
			}

			switch ( $this->atts['image_background_paint'] ) {
				case 'custom':
					$class[] = 'custom-bg';
					break;
				case 'accent':
					$class[] = 'accent-bg';
					break;
				case 'light':
					$class[] = 'light-bg';
					break;
			}

			switch ( $this->atts['image_hover_background_paint'] ) {
				case 'custom':
					$class[] = 'custom-hover-bg';
					break;
				case 'accent':
					$class[] = 'accent-hover-bg';
					break;
				case 'light':
					$class[] = 'light-hover-bg';
					break;
			}

			switch ( $this->atts['icons_paint'] ) {
				case 'custom':
					$class[] = 'custom-icon-color';
					break;
				case 'accent':
					$class[] = 'accent-icon-color';
					break;
				case 'light':
					$class[] = 'light-icon-color';
					break;
			}

			switch ( $this->atts['icons_hover_paint'] ) {
				case 'custom':
					$class[] = 'custom-icon-hover-color';
					break;
				case 'accent':
					$class[] = 'accent-icon-hover-color';
					break;
				case 'light':
					$class[] = 'light-icon-hover-color';
					break;
			}

			switch ( $this->atts['decorative_lines'] ) {
				case 'static':
					$class[] = 'static-line';
					break;
				case 'hover':
					$class[] = 'hover-line';
					break;
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

		protected function get_benefit_data() {
			global $post;
			$meta_prefix = '_dt_benefits_options_';

			$benefit_attr = $this->atts;
			$benefit_attr['icon_code'] = get_post_meta( $post->ID, "{$meta_prefix}icon_code", true );

			if ( ! $benefit_attr['icon_code'] ) {
				$image_id = get_post_thumbnail_id( $post->ID );
				$image_size = array();
				$benefit_image_alt = null;
				$benefit_image_src = '';
				if ( $image_id ) {
					$benefit_image = wp_get_attachment_image_src( $image_id, 'full' );
					if ( $benefit_image ) {
						$benefit_image_src = $benefit_image[0];
						$image_size = array( $benefit_image[1], $benefit_image[2] );
						$benefit_image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
					}
				}

				$benefit_hd_image_src = '';
				$benefit_hd_image_array = get_post_meta( $post->ID, "{$meta_prefix}retina_image", true );
				if ( isset( $benefit_hd_image_array[0] ) ) {
					$image_id = $benefit_hd_image_array[0];
					$benefit_hd_image = wp_get_attachment_image_src( $image_id, 'full' );
					if ( $benefit_hd_image ) {
						$benefit_hd_image_src = $benefit_hd_image[0];
						if ( ! $image_size ) {
							$image_size = array( ceil($benefit_hd_image[1]/2), ceil($benefit_hd_image[2]/2) );
						}
						if ( ! isset( $benefit_image_alt ) ) {
							$benefit_image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
						}
					}
				}

				$benefit_attr['image'] = $benefit_image_src;
				$benefit_attr['hd_image'] = $benefit_hd_image_src;
				$benefit_attr['image_alt'] = $benefit_image_alt;
				$benefit_attr['image_size'] = $image_size;
			}

			$benefit_attr['image_link'] = get_post_meta( $post->ID, "{$meta_prefix}link", true );
			$benefit_attr['title'] = get_the_title( $post->ID );

			return $benefit_attr;
		}
	}

	// create shortcode
	DT_Shortcode_Benefits_Vc::get_instance();

}
