<?php
/**
 * Team shortcodes VC bridge
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

vc_map( array(
	"weight" => -1,
	"name" => __("Team", 'the7mk2'),
	"base" => 'dt_team',
	"icon" => "dt_vc_ico_team",
	"class" => "dt_vc_sc_team",
	"category" => __('by Dream-Theme', 'the7mk2'),
	"params" => array(

		// Terms
		array(
			"type" => "dt_taxonomy",
			"taxonomy" => "dt_team_category",
			"class" => "",
			"heading" => __("Categories", 'the7mk2'),
			"admin_label" => true,
			"param_name" => "category",
			"description" => __("Note: By default, all your team will be displayed. <br>If you want to narrow output, select category(s) above. Only selected categories will be displayed.", 'the7mk2')
		),

		// Appearance
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Appearance", 'the7mk2'),
			"param_name" => "type",
			"value" => array(
				"Masonry" => "masonry",
				"Grid" => "grid"
			),
			"description" => ""
		),

		// Gap
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Gap between team members (px)", 'the7mk2'),
			"description" => __("Team member paddings (e.g. 5 pixel padding will give you 10 pixel gaps between team members)", 'the7mk2'),
			"param_name" => "padding",
			"value" => "20"
		),

		// Column width
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Column target width (px)", 'the7mk2'),
			"param_name" => "column_width",
			"value" => "370"
		),

		// Desired columns number
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Desired columns number", 'the7mk2'),
			"param_name" => "columns",
			"value" => "2"
		),

		// Background under team members
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Background under team members", 'the7mk2'),
			"param_name" => "members_bg",
			"value" => array(
				"Enabled" => "true",
				"disabled" => "false"
			),
			"description" => ""
		),

		// Images sizing
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Images sizing", 'the7mk2'),
			"param_name" => "images_sizing",
			"value" => array(
				"preserve images proportions" => "original",
				"resize images" => "resize",
				"make images round" => "round"
			),
			"description" => ""
		),

		// Proportions
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Images proportions", 'the7mk2'),
			"param_name" => "proportion",
			"value" => "",
			"description" => __("Width:height (e.g. 16:9). Leave this field empty to preserve original image proportions.", 'the7mk2'),
			"dependency" => array(
				"element" => "images_sizing",
				"value" => array(
					'resize'
				)
			)
		),

		// Show excerpts
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Show excerpts", 'the7mk2'),
			"param_name" => "show_excerpts",
			"value" => array(
				"" => "true",
			)
		),

		// Number of posts
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Number of team members to show", 'the7mk2'),
			"param_name" => "number",
			"value" => "12",
			"description" => __("(Integer)", 'the7mk2')
		),

		// Order by
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

		// Order
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
		)
	)
) );
