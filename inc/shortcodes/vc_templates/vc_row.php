<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Shortcode attributes
 * @var $el_id
 * @var $el_class
 * @var $anchor
 * @var $min_height
 * @var $margin_top
 * @var $margin_bottom
 * @var $full_width
 * @var $padding_left
 * @var $padding_right
 * @var $animation
 * @var $type
 * @var $bg_color
 * @var $bg_image
 * @var $bg_position
 * @var $bg_repeat
 * @var $bg_cover
 * @var $bg_attachment
 * @var $padding_top
 * @var $padding_bottom
 * @var $enable_parallax
 * @var $parallax_speed
 * @var $bg_video_src_mp4
 * @var $bg_video_src_ogv
 * @var $bg_video_src_webm
 * @var $content - shortcode content
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Row
 */
$output = $after_output = $before_output = '';
$el_id = $el_class = $anchor = $min_height = $margin_top = $margin_bottom = $full_width = $padding_left = $padding_right = $animation = $type = $bg_color = $bg_image = $bg_position = $bg_repeat = $bg_cover = $bg_attachment = $padding_top = $padding_bottom = $enable_parallax = $parallax_speed = $bg_video_src_mp4 = $bg_video_src_ogv = $bg_video_src_webm = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

wp_enqueue_script( 'wpb_composer_front_js' );

$el_class = $this->getExtraClass( $el_class );

$css_classes = array(
	'vc_row',
	'wpb_row', //deprecated
	'vc_row-fluid',
	$el_class,
);
$wrapper_attributes = array();
$wrapper_style = array();

$anchor = str_replace( '#', '', $anchor );
$anchor = $anchor ? $anchor : '';

if ( ! empty( $full_width ) ) {
	$css_classes[] = 'full-width-wrap';

	$wrapper_style[] = 'padding-left: ' . intval( $padding_left ) . 'px';
	$wrapper_style[] = 'padding-right: ' . intval( $padding_right ) . 'px';
}

if ( $type ) {

	$bg_cover = apply_filters( 'dt_sanitize_flag', $bg_cover );
	$bg_attachment = in_array( $bg_attachment, array( 'false', 'fixed', 'true' ) ) ? $bg_attachment : 'false';

	$stripe_classes = array( 'stripe' );
	$stripe_classes[] = 'stripe-style-' . esc_attr( $type );

	$style = array();

	if ( $bg_color ) {
		$style[] = 'background-color: ' . $bg_color;
	}

	if ( $bg_image && !in_array( $bg_image, array('none') ) ) {
		$style[] = 'background-image: url(' . esc_url($bg_image) . ')';
	}

	if ( $bg_position ) {
		$style[] = 'background-position: ' . $bg_position;
	}

	if ( $bg_repeat ) {
		$style[] = 'background-repeat: ' . $bg_repeat;
	}

	if ( 'false' != $bg_attachment ) {
		$stripe_classes[] = 'bg-fixed';
		$style[] = 'background-attachment: fixed';
	} else {
		$style[] = 'background-attachment: scroll';
	}

	if ( $bg_cover ) {
		$style[] = 'background-size: cover';
	} else {
		$style[] = 'background-size: auto';
	}

	$style[] = 'padding-top: ' . intval( $padding_top ) . 'px';
	$style[] = 'padding-bottom: ' . intval( $padding_bottom ) . 'px';
	$style[] = 'margin-top: ' . intval( $margin_top ) . 'px';
	$style[] = 'margin-bottom: ' . intval( $margin_bottom ) . 'px';

	// ninjaaaa!
	$style = implode(';', $style);

	// video bg
	$bg_video = '';
	$bg_video_args = array();

	if ( $bg_video_src_mp4 ) {
		$bg_video_args['mp4'] = $bg_video_src_mp4;
	}

	if ( $bg_video_src_ogv ) {
		$bg_video_args['ogv'] = $bg_video_src_ogv;
	}

	if ( $bg_video_src_webm ) {
		$bg_video_args['webm'] = $bg_video_src_webm;
	}

	if ( ! empty( $bg_video_args ) ) {
		$attr_strings = array(
			'loop="1"',
			'preload="1"'
		);

		if ( $bg_image && !in_array( $bg_image, array('none') ) ) {

			$attr_strings[] = 'poster="' . esc_url($bg_image) . '"';
		}

		$bg_video .= sprintf( '<video %s controls="controls" class="stripe-video-bg">', join( ' ', $attr_strings ) );

		$source = '<source type="%s" src="%s" />';
		foreach ( $bg_video_args as $video_type=>$video_src ) {

			$video_type = wp_check_filetype( $video_src, wp_get_mime_types() );
			$bg_video .= sprintf( $source, $video_type['type'], esc_url( $video_src ) );

		}

		$bg_video .= '</video>';

		$stripe_classes[] = 'stripe-video-bg';
	}

	if ( $style ) {
		$style = ' style="' . esc_attr($style) . '"';
	}

	$data_attr = '';
	if ( '' != $parallax_speed && $enable_parallax ) {

		$parallax_speed = floatval($parallax_speed);
		if ( false == $parallax_speed ) {
			$parallax_speed = 0.1;
		}

		$stripe_classes[] = 'stripe-parallax-bg';
		$data_attr .= ' data-prlx-speed="' . $parallax_speed . '"';
	}

	if ( $anchor ) {
		$data_attr .= ' data-anchor="#' . esc_attr( $anchor ) . '"';
		$data_attr .= ' id="' . esc_attr( $anchor ) . '"';
	}

	if ( '' !== $min_height ) {
		$data_attr .= ' data-min-height="' . esc_attr( $min_height ) . '"';
	}

	// Ken Burns effect

	// if ( apply_filters( 'dt_sanitize_flag', $enable_kb_effect ) ) {
	// 	$stripe_classes[] = "ken-burns-on";
	// 	$stripe_classes[] = sanitize_html_class( $kb_effect_position );
	// 	$stripe_classes[] = sanitize_html_class( "ken-burns-scale-{$kb_effect_scale}" );
	// }

	$stripe_classes = apply_filters( 'presscore_vc_row_stripe_class', $stripe_classes, $atts );

	$before_output .= '<div class="' . esc_attr(implode(' ', $stripe_classes)) . '"' . $data_attr . $style . '>';
	$before_output .= $bg_video;

	$after_output .= '</div>';
} else {

	$wrapper_style[] = 'margin-top: ' . intval( $margin_top ) . 'px';
	$wrapper_style[] = 'margin-bottom: ' . intval( $margin_bottom ) . 'px';

	if ( $anchor ) {
		$wrapper_attributes[] = 'id="' . esc_attr( $anchor ) . '"';
		$wrapper_attributes[] = 'data-anchor="#' . esc_attr( $anchor ) . '"';
	}

	if ( $min_height ) {
		$wrapper_attributes[] = 'data-min-height="' . esc_attr( $min_height ) . '"';
	}
}

if ( ! empty( $animation ) && 'none' !== $animation ) {
	$css_classes[] = sanitize_html_class( $animation );
	$css_classes[] = 'animate-element';
}

$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );
$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';
$wrapper_attributes[] = 'style="' . esc_attr( implode( ';', $wrapper_style ) ) . '"';

$output .= $before_output;
$output .= '<div ' . implode( ' ', $wrapper_attributes ) . '>';
$output .= wpb_js_remove_wpautop( $content );
$output .= '</div>';
$output .= $after_output;

echo $output;
