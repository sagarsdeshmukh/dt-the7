<?php
/**
 * Logos shortcodes VC bridge
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

// ! Logos
vc_map( array(
	"weight" => -1,
	"name" => __("Clients", 'the7mk2'),
	"base" => "dt_logos",
	"icon" => "dt_vc_ico_logos",
	"class" => "dt_vc_sc_logos",
	"category" => __('by Dream-Theme', 'the7mk2'),
	"params" => array(
		array(
			"type" => "dt_taxonomy",
			"taxonomy" => "dt_logos_category",
			"class" => "",
			"admin_label" => true,
			"heading" => __("Categories", 'the7mk2'),
			"param_name" => "category",
			"description" => __("Note: By default, all your logotypes will be displayed. <br>If you want to narrow output, select category(s) above. Only selected categories will be displayed.", 'the7mk2')
		),
		// Column min width
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Column minimum width (px)", 'the7mk2'),
			"param_name" => "column_width",
			"value" => "180"
		),

		// Column max width
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Desired columns number", 'the7mk2'),
			"param_name" => "columns_number",
			"value" => "3"
		),

		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Number of logotypes to show", 'the7mk2'),
			"param_name" => "number",
			"value" => "12",
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Order by", 'the7mk2'),
			"param_name" => "orderby",
			"value" => array(
				"Date" => "date",
				"Author" => "author",
				"Title" => "title",
				"Slug" => "name",
				"Date modified" => "modified",
				"ID" => "id",
				"Random" => "rand"
			),
			"description" => __("Select how to sort retrieved posts.", 'the7mk2')
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Order way", 'the7mk2'),
			"param_name" => "order",
			"value" => array(
				"Descending" => "desc",
				"Ascending" => "asc"
			),
			"description" => __("Designates the ascending or descending order.", 'the7mk2')
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Animation", 'the7mk2'),
			"param_name" => "animation",
			"value" => presscore_get_vc_animation_options(),
			"description" => ""
		),

		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Animate", 'the7mk2'),
			"param_name" => "animate",
			"value" => array(
				"One-by-one" => 'one_by_one',
				"At the same time" => 'at_the_same_time'
			),
			"description" => ""
		),
	)
) );
