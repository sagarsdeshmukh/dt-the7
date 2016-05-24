<?php
/**
 * Button shortcode.
 *
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! class_exists( 'DT_Shortcode_Button', false ) ) {

	class DT_Shortcode_Button extends DT_Shortcode {

		protected $atts = array();
		protected $content = null;
		protected $config = null;
		protected $color_atts = array();
		protected $button_id = '';
		protected $shortcode_id = 0;
		protected $custom_colors = array();

		public function __construct() {
			$this->config = presscore_config();
		}

		public function shortcode( $atts, $content = null ) {
			// setup button id
			$this->shortcode_id++;
			$this->button_id = esc_attr( 'dt-btn-' . $this->shortcode_id );

			// sanitize attributes
			$this->atts = $this->sanitize_attributes( $atts );

			// store custom colors
			$this->custom_colors = $this->get_custom_colors();

			// store content
			$this->content = trim( preg_replace( '/<\/?p\>/', '', $content ) );

			// return html
			return $this->get_html();
		}

		protected function sanitize_attributes( &$atts ) {
			// filter atts for backward compatibility
			// $atts = $this->compatibility_filter( $atts );

			$attributes = shortcode_atts( array(
				'style'						=> 'default',
				'size'						=> 'small',
				'bg_color_style'			=> 'default',
				'bg_color'					=> '#888888',
				'bg_hover_color_style'		=> 'default',
				'bg_hover_color'			=> '#888888',
				'text_color_style'			=> 'default',
				'text_color'				=> '#888888',
				'text_hover_color_style'	=> 'default',
				'text_hover_color'			=> '#888888',
				'link'						=> '',
				'target_blank'				=> 'false',
				'animation'					=> 'none',
				'icon'						=> '',
				'icon_align'				=> 'left',
				'button_alignment'			=> 'default',
				'smooth_scroll'				=> '',
				'el_class'					=> '',
			), $atts );

			$attributes['style'] = sanitize_key( $attributes['style'] );
			$attributes['size'] = sanitize_key( $attributes['size'] );
			$attributes['icon_align'] = sanitize_key( $attributes['icon_align'] );
			$attributes['button_alignment'] = sanitize_key( $attributes['button_alignment'] );

			$this->color_atts = array(
				'bg_color_style'			=> 'bg_color',
				'bg_hover_color_style'		=> 'bg_hover_color',
				'text_color_style'			=> 'text_color',
				'text_hover_color_style'	=> 'text_hover_color',
			);

			foreach ( $this->color_atts as $color_style=>$color ) {
				$attributes[ $color_style ] = sanitize_key( $attributes[ $color_style ] );
				$attributes[ $color ] = esc_attr( $attributes[ $color ] );
			}

			$attributes['link'] = $attributes['link'] ? esc_url( $attributes['link'] ) : '#';
			$attributes['target_blank'] = apply_filters( 'dt_sanitize_flag', $attributes['target_blank'] );
			$attributes['smooth_scroll'] = apply_filters( 'dt_sanitize_flag', $attributes['smooth_scroll'] );
			$attributes['el_class'] = esc_attr( $attributes['el_class'] );

			if ( $attributes['icon'] ) {

				if ( preg_match( '/^fa\s(fa|icon)-(\w)/', $attributes['icon'] ) ) {
					$attributes['icon'] = '<i class="' . esc_attr( $attributes['icon'] ) . '"></i>';
				} else {
					$attributes['icon'] = wp_kses( rawurldecode( base64_decode( $attributes['icon'] ) ), array( 'i' => array( 'class' => array() ) ) );
				}

			}

			return $attributes;
		}

		protected function get_html() {
			$before_title = $after_title = '';

			// add icon
			$icon = $this->atts['icon'];
			if ( $icon ) {

				if ( 'right' == $this->atts['icon_align'] ) {
					$after_title = $icon;
				} else {
					$before_title = $icon;
				}

			}

			// get button html
			$button_html = presscore_get_button_html( array(
				'before_title'	=> $before_title,
				'after_title'	=> $after_title,
				'href'			=> $this->atts['link'],
				'title'			=> $this->content,
				'target'		=> $this->atts['target_blank'],
				'class'			=> $this->get_html_class(),
				'atts'			=> ' id="' . $this->get_button_id() . '"'
			) );

			// alignment
			if ( 'center' == $this->atts['button_alignment'] ) {
				$button_html = '<div class="text-centered">' . $button_html . '</div>';
			}

			// get inline styleseet tag
			$output = $this->get_inline_style_tag();
			$output .= $button_html;

			return $output;
		}

		protected function get_html_class() {

			// static classes
			$classes = array( 'btn-shortcode' );

			// base classes table
			// contains array( 'attribute' => array( 'value' => 'class' ) )
			$att_value_class_table = array(
				'size' => array(
					'small'		=> 'dt-btn-s',
					'medium'	=> 'dt-btn-m',
					'big'		=> 'dt-btn-l'
				),
				'style' => array(
					'light'				=> 'dt-btn btn-light',
					'outline'			=> 'dt-btn outline-btn',
					'outline_with_bg'	=> 'dt-btn outline-bg-btn',
					'link'				=> 'btn-link',
					'light_with_bg'		=> 'dt-btn light-bg-btn',
					'default'			=> 'dt-btn'
				),
				'text_color_style' => array(
					'context'	=> 'title-btn-color',
					'default'	=> 'default-btn-color',
					'accent'	=> 'accent-btn-color',
					'custom'	=> 'custom-btn-color'
				),
				'text_hover_color_style' => array(
					'context'	=> 'title-btn-hover-color',
					'default'	=> 'default-btn-hover-color',
					'accent'	=> 'accent-btn-hover-color',
					'custom'	=> 'custom-btn-hover-color'
				),
				'bg_color_style' => array(
					'default'	=> 'default-btn-bg-color',
					'accent'	=> 'accent-btn-bg-color'
				),
				'bg_hover_color_style' => array(
					'default'	=> 'default-btn-bg-hover-color',
					'accent'	=> 'accent-btn-bg-hover-color'
				)
			);

			foreach ( $att_value_class_table as $att=>$values ) {

				// if att from table exists - get it's value
				$value = array_key_exists( $att, $this->atts ) ? $this->atts[ $att ] : false;

				// if att value mentioned in table - add class from table
				if ( $value && array_key_exists( $value, $values ) ) {
					$classes[] = $values[ $value ];
				}
			}

			// animation
			if ( presscore_shortcode_animation_on( $this->atts['animation'] ) ) {
				$classes[] = presscore_get_shortcode_animation_html_class( $this->atts['animation'] );
				$classes[] = 'animation-builder';
			}

			// icon alignment
			if ( $this->atts['icon'] && 'right' == $this->atts['icon_align'] ) {
				$classes[] = 'ico-right-side';
			}

			// smooth scroll
			if ( $this->atts['smooth_scroll'] ) {
				$classes[] = 'anchor-link';
			}

			// custom class
			if ( $this->atts['el_class'] ) {
				$classes[] = $this->atts['el_class'];
			}

			return presscore_esc_implode( ' ', $classes );
		}

		protected function get_button_id() {
			return $this->button_id;
		}

		protected function get_inline_style_tag() {
			$style_tag = '';

			// get custom colors
			if ( $this->custom_colors ) {
				$color = 'color: %1$s;';
				$bg_color = 'background: %1$s;';
				$border_color = 'border-color: %1$s;';
				$border_bottom_color = 'border-bottom-color: %1$s;';
				$btn_id = $this->get_button_id();

				switch( $this->atts['style'] ) {
					case 'light_with_bg':
						$style_tag .= $this->prepare_css_rules_block(
							"#{$btn_id}, #{$btn_id} > .text-wrap *",
							// color
							$this->prepare_css_rule( $color, $this->get_custom_color( 'text_color' ) )
						);

						$style_tag .= $this->prepare_css_rules_block(
							"#{$btn_id}:hover",
							// color
							$this->prepare_css_rule( $color, $this->get_custom_color( 'text_hover_color' ) )
							// background color
							. $this->prepare_css_rule( $bg_color, $this->get_custom_color( 'bg_hover_color' ) )
						);

						$style_tag .= $this->prepare_css_rules_block(
							"#{$btn_id}:hover > .text-wrap *",
							// color
							$this->prepare_css_rule( $color, $this->get_custom_color( 'text_hover_color' ) )
						);
						break;
					case 'outline':
						$style_tag .= $this->prepare_css_rules_block(
							"#{$btn_id}",
							// color
							$this->prepare_css_rule( $color, $this->get_custom_color( 'text_color' ) )
							// border color
							. $this->prepare_css_rule( $border_color, $this->get_custom_color( 'bg_color' ) )
						);

						$style_tag .= $this->prepare_css_rules_block(
							"#{$btn_id} > .text-wrap *",
							// color
							$this->prepare_css_rule( $color, $this->get_custom_color( 'text_color' ) )
						);

						$style_tag .= $this->prepare_css_rules_block(
							"#{$btn_id}:hover",
							// color
							$this->prepare_css_rule( $color, $this->get_custom_color( 'text_hover_color' ) )
							// border color
							. $this->prepare_css_rule( $border_color, $this->get_custom_color( 'bg_hover_color' ) )
						);
						$style_tag .= $this->prepare_css_rules_block(
							"#{$btn_id}:hover > .text-wrap *",
							// color
							$this->prepare_css_rule( $color, $this->get_custom_color( 'text_hover_color' ) )
						);
						break;
					case 'outline_with_bg':
						$style_tag .= $this->prepare_css_rules_block(
							"#{$btn_id}",
							// color
							$this->prepare_css_rule( $color, $this->get_custom_color( 'text_color' ) )
							// border color
							. $this->prepare_css_rule( $border_color, $this->get_custom_color( 'bg_color' ) )
						);
						$style_tag .= $this->prepare_css_rules_block(
							"#{$btn_id} > .text-wrap *",
							// color
							$this->prepare_css_rule( $color, $this->get_custom_color( 'text_color' ) )
						);

						$style_tag .= $this->prepare_css_rules_block(
							"#{$btn_id}:hover",
							// color
							$this->prepare_css_rule( $color, $this->get_custom_color( 'text_hover_color' ) )
							// background and border color
							. $this->prepare_css_rule( $bg_color . $border_color, $this->get_custom_color( 'bg_hover_color' ) )
						);
						$style_tag .= $this->prepare_css_rules_block(
							"#{$btn_id}:hover > .text-wrap *",
							// color
							$this->prepare_css_rule( $color, $this->get_custom_color( 'text_hover_color' ) )
						);
						break;
					case 'light':
					case 'link':
						$style_tag .= $this->prepare_css_rules_block(
							"#{$btn_id}, #{$btn_id} > .text-wrap *",
							// color
							$this->prepare_css_rule( $color, $this->get_custom_color( 'text_color' ) )
						);

						$style_tag .= $this->prepare_css_rules_block(
							"#{$btn_id}:hover, #{$btn_id}:hover > .text-wrap *",
							// color
							$this->prepare_css_rule( $color, $this->get_custom_color( 'text_hover_color' ) )
						);
						break;
					case 'default':
						$style_tag .= $this->prepare_css_rules_block(
							"#{$btn_id}",
							// color
							$this->prepare_css_rule( $color, $this->get_custom_color( 'text_color' ) )
							// background color
							. $this->prepare_css_rule( $bg_color, $this->get_custom_color( 'bg_color' ) )
						);
						$style_tag .= $this->prepare_css_rules_block(
							"#{$btn_id} > .text-wrap *",
							// color
							$this->prepare_css_rule( $color, $this->get_custom_color( 'text_color' ) )
						);

						$style_tag .= $this->prepare_css_rules_block(
							"#{$btn_id}:hover",
							// color
							$this->prepare_css_rule( $color, $this->get_custom_color( 'text_hover_color' ) )
							// background color
							. $this->prepare_css_rule( $bg_color, $this->get_custom_color( 'bg_hover_color' ) )
						);
						$style_tag .= $this->prepare_css_rules_block(
							"#{$btn_id}:hover > .text-wrap *",
							// color
							$this->prepare_css_rule( $color, $this->get_custom_color( 'text_hover_color' ) )
						);

						if ( '3d' == $this->config->get( 'buttons.style' ) ) {
							$style_tag .= $this->prepare_css_rules_block(
								".btn-3d #{$btn_id}",
								// background color
								$this->prepare_css_rule( $border_bottom_color, $this->darken_color( $this->get_custom_color( 'bg_color' ) ) )
							);

							$style_tag .= $this->prepare_css_rules_block(
								".btn-3d #{$btn_id}:hover",
								// background color
								$this->prepare_css_rule( $border_bottom_color, $this->darken_color( $this->get_custom_color( 'bg_hover_color' ) ) )
							);
						}
						break;
				}

				// wrap with style tag
				if ( $style_tag ) {
					$style_tag = '<style type="text/css">' . $style_tag .'</style>';
				}
			}
			return $style_tag;
		}

		protected function get_custom_colors() {
			$custom_colors = array();
			foreach ( $this->color_atts as $color_style=>$color ) {
				if ( 'custom' === $this->atts[ $color_style ] ) {
					$custom_colors[ $color ] = $this->atts[ $color ];
				}
			}
			return $custom_colors;
		}

		protected function get_custom_color( $att_name ) {
			if ( array_key_exists( $att_name, $this->custom_colors ) ) {
				return $this->custom_colors[ $att_name ];
			}
			return '';
		}

		protected function prepare_css_rules_block( $selector, $rules ) {
			if ( $rules ) {
				return $selector . ' {' . $rules . '}';
			}
			return '';
		}

		protected function prepare_css_rule( $template ) {
			$args = func_get_args();
			array_shift( $args );
			if ( implode( '', $args ) ) {
				return vsprintf( $template, $args );
			}
			return '';
		}

		protected function darken_color( $color = '', $amount = 18 ) {
			if ( $color ) {
				if ( false !== strpos( $color, 'rgb' ) ) {
					$color_obj = new Color( Color::rgbToHex( $color ) );
				} else {
					$color_obj = new Color( $color );
				}
				return '#' . $color_obj->darken( $amount );
			}
			return '';
		}

		protected function compatibility_filter( &$atts ) {
			if ( isset( $atts['size'] ) && 'link' === $atts['size'] ) {
				$atts['style'] = 'link';
				$atts['size'] = 'medium';
			}

			if ( isset( $atts['color_mode'] ) && ! isset( $atts['bg_color_style'] ) ) {
				switch ( $atts['color_mode'] ) {
					case 'default':
						$atts['bg_color_style'] = 'accent';
						break;
					case 'custom':
						$atts['bg_scolor_tyle'] = 'custom';
						if ( isset( $atts['color'] ) && $atts['color'] ) {
							$atts['bg_color'] = $atts['color'];
						}
						break;
				}
			}

			if ( isset( $atts['style'] ) && 'link_with_bg' == $atts['style'] ) {
				$atts['style'] = 'light_with_bg';
			}

			return $atts;
		}
	}

	add_shortcode( 'dt_button', array( new DT_Shortcode_Button(), 'shortcode' ) );
}
