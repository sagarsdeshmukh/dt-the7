<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $type
 * @var $css
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Facebook
 */
extract( shortcode_atts( array(
	'type' => 'standard',
	'url'  => '',
	'like' => 'post',
	'css' => '',
	'el_class' => '',
), $atts ) );

if ( empty( $url ) ) {
	if ( isset( $like ) && 'page' === $like && function_exists( 'presscore_config' ) && presscore_config()->get( 'page_id' ) ) {
		$url = get_permalink( presscore_config()->get( 'page_id' ) );
	} else {
		$url = get_permalink();
	}
}

$class_to_filter = 'fb_like wpb_content_element fb_type_' . $type;
$class_to_filter .= vc_shortcode_custom_css_class( $css, ' ' ) . $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );

$output = '<div class="' . esc_attr( $css_class ) . '"><iframe src="//www.facebook.com/plugins/like.php?href='
          . $url . '&amp;layout='
          . $type . '&amp;show_faces=false&amp;action=like&amp;colorscheme=light" scrolling="no" frameborder="0" allowTransparency="true"></iframe></div>';

echo $output;
