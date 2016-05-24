<?php
/**
 * SocialIcons shortcode.
 *
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! class_exists( 'DT_Shortcode_SocialIcons', false ) ) {

	class DT_Shortcode_SocialIcons extends DT_Shortcode {

		static protected $instance;
		static protected $atts;

		public static function get_instance() {
			if ( !self::$instance ) {
				self::$instance = new DT_Shortcode_SocialIcons();
			}
			return self::$instance;
		}

		protected function __construct() {
			add_shortcode( 'dt_social_icons', array($this, 'shortcode_icons_content') );
			add_shortcode( 'dt_social_icon', array($this, 'shortcode_icon') );
		}

		public function shortcode_icons_content( $atts, $content = null ) {
			$attributes = shortcode_atts( array(
				'animation'			=> 'none',
				'alignment'			=> 'default'
			), $atts );

			$classes = array( 'soc-ico' );

			if ( 'none' != $attributes['animation'] ) {
				$classes[] = 'animation-builder';
			}

			if ( 'center' == $attributes['alignment'] ) {
				$classes[] = 'text-centered';
			}

			$backup_atts = self::$atts;
			self::$atts = $attributes;

			$output = '<div class="' . esc_attr( implode( ' ', $classes ) ) . '">' . do_shortcode( str_replace( array( "\n" ), '', $content ) ) . '</div>';

			self::$atts = $backup_atts;

			return $output;
		}

		public function shortcode_icon( $atts, $content = null ) {
			extract( shortcode_atts( array(
				'icon'          => '',
				'target_blank'  => '1',
				'link'          => '#'
			), $atts ) );

			static $social_icons = null;

			if ( !$social_icons ) {
				$social_icons = presscore_get_social_icons_data();
			}

			if ( 'deviant' == $icon ) {
				$icon = 'devian';
			} elseif ( 'tumblr' == $icon ) {
				$icon = 'tumbler';
			} elseif ( '500px' == $icon ) {
				$icon = 'px-500';
			} elseif ( in_array( $icon, array( 'youtube', 'YouTube' ) ) ) {
				$icon = 'you-tube';
			} elseif ( in_array( $icon, array( 'tripedvisor', 'tripadvisor' ) ) ) {
				$icon = 'tripedvisor';
			}

			$icon = in_array( $icon, array_keys($social_icons) ) ? $icon : '';

			if ( empty($icon) ) {
				return '';
			}

			$classes = array();

			if ( presscore_shortcode_animation_on( self::$atts['animation'] ) ) {
				$classes[] = presscore_get_shortcode_animation_html_class( self::$atts['animation'] );
			}

			$target_blank = apply_filters( 'dt_sanitize_flag', $target_blank ) ? '_blank' : '';

			$output = presscore_get_social_icon( $icon, $link, $social_icons[ $icon ], $classes, $target_blank );

			return $output; 
		}

	}

	// create shortcode
	DT_Shortcode_SocialIcons::get_instance();

}
