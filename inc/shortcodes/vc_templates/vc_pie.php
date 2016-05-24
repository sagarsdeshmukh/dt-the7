<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $appearance
 * @var $title
 * @var $el_class
 * @var $value
 * @var $units
 * @var $color_mode
 * @var $color
 * @var $label_value
 * Shortcode class
 * @var $this WPBakeryShortCode_Vc_Pie
 */
$title = $el_class = $value = $units = $color = $custom_color = $label_value = $css = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

wp_enqueue_script( 'vc_dt_pie' );

$appearance_class = '';
if ( 'counter' === $appearance ) {
	$appearance_class = ' transparent-pie';
}

switch ( $color_mode ) {
	case 'title_like':
		$color = 'dt-title';
		break;
	case 'content_like':
		$color = 'dt-content';
		break;
	case 'accent':
		$color = 'dt-accent';
		break;
	case 'custom':
	default:
		$colors_arr = array(
			"wpb_button",
			"btn-primary",
			"btn-info",
			"btn-success",
			"btn-warning",
			"btn-danger",
			"btn-inverse",
		);

		if ( ! in_array( $color, $colors_arr ) ) {
			$color = ( false !== strpos( $color, 'rgba' ) ? $color : dt_stylesheet_color_hex2rgba( $color, 100 ) );
		}

		if ( ! $color ) {
			$color = 'wpb_button';
		}
}

$class_to_filter = 'vc_pie_chart wpb_content_element';
$class_to_filter .= vc_shortcode_custom_css_class( $css, ' ' ) . $this->getExtraClass( $el_class ) . $appearance_class;
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );

$output = '<div class= "' . esc_attr( $css_class ) . '" data-pie-value="' . esc_attr( $value ) . '" data-pie-label-value="' . esc_attr( $label_value ) . '" data-pie-units="' . esc_attr( $units ) . '" data-pie-color="' . htmlspecialchars( $color ) . '">';
$output .= '<div class="wpb_wrapper">';
$output .= '<div class="vc_pie_wrapper">';
$output .= '<span class="vc_pie_chart_back"></span>';
$output .= '<span class="vc_pie_chart_value"></span>';
$output .= '<canvas width="101" height="101"></canvas>';
$output .= '</div>';

if ( '' !== $title ) {
	$output .= '<h4 class="wpb_heading wpb_pie_chart_heading">' . $title . '</h4>';
}
$output .= '</div>';
$output .= '</div>';

echo $output;
