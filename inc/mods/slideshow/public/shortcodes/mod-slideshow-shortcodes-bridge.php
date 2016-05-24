<?php
/**
 * Slideshow shortcodes VC bridge
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Royal Slider.
 */
vc_map( array(
	"weight"   => -1,
	"base"     => "dt_slideshow",
	"name"     => __( "Royal Slider", 'the7mk2' ),
	"category" => __( 'by Dream-Theme', 'the7mk2' ),
	"icon"     => "dt_vc_ico_slideshow",
	"class"    => "dt_vc_sc_slideshow",
	"params"   => array(
		array(
			"heading"     => __( "Display slideshow(s)", 'the7mk2' ),
			"description" => __( "Attention: Do not ignore this setting! Otherwise only one (newest) slideshow will be displayed.", 'the7mk2' ),
			"param_name"  => "posts",
			"type"        => "dt_posttype",
			"posttype"    => "dt_slideshow",
			"admin_label" => true,
		),
		array(
			"heading"    => __( "Proportions: width", 'the7mk2' ),
			"param_name" => "width",
			"type"       => "textfield",
			"value"      => "800",
		),
		array(
			"heading"    => __( "Proportions: height", 'the7mk2' ),
			"param_name" => "height",
			"type"       => "textfield",
			"value"      => "450",
		),
		array(
			"heading"    => __( "On page load slideshow is", 'the7mk2' ),
			"param_name" => "autoplay",
			"type"       => "dropdown",
			"value"      => array(
				'Paused'  => 'false',
				'Playing' => 'true',
			),
		),
		array(
			"heading"    => __( "Autoslide interval (in milliseconds)", 'the7mk2' ),
			"param_name" => "interval",
			"type"       => "textfield",
			"value"      => "5000",
		),
	)
) );
