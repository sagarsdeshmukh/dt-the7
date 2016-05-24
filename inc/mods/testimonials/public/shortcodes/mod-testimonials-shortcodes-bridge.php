<?php
/**
 * Testimonials shortcodes VC bridge
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

// ! Testimonials
vc_map( array(
	"weight" => -1,
	"name" => __("Testimonials", 'the7mk2'),
	"base" => 'dt_testimonials',
	"icon" => "dt_vc_ico_testimonials",
	"class" => "dt_vc_sc_testimonials",
	"category" => __('by Dream-Theme', 'the7mk2'),
	"params" => array(

		// Terms
		array(
			"type" => "dt_taxonomy",
			"taxonomy" => "dt_testimonials_category",
			"class" => "",
			"heading" => __("Categories", 'the7mk2'),
			"param_name" => "category",
			"admin_label" => true,
			"description" => __("Note: By default, all your testimonials will be displayed. <br>If you want to narrow output, select category(s) above. Only selected categories will be displayed.", 'the7mk2')
		),

		// Appearance
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Appearance", 'the7mk2'),
			"admin_label" => true,
			"param_name" => "type",
			"value" => array(
				"Masonry" => "masonry",
				"Slider" => "slider"
			),
			"description" => ""
		),

		// Gap
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Gap between testimonials (px)", 'the7mk2'),
			"description" => __("Testimonial paddings (e.g. 5 pixel padding will give you 10 pixel gaps between testimonials)", 'the7mk2'),
			"param_name" => "padding",
			"value" => "20",
			"dependency" => array(
				"element" => "type",
				"value" => array(
					"masonry"
				)
			)
		),

		// Column width
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Column minimum width (px)", 'the7mk2'),
			"param_name" => "column_width",
			"value" => "370",
			"dependency" => array(
				"element" => "type",
				"value" => array(
					"masonry"
				)
			)
		),

		// Desired columns number
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Desired columns number", 'the7mk2'),
			"param_name" => "columns",
			"value" => "2",
			"dependency" => array(
				"element" => "type",
				"value" => array(
					"masonry"
				)
			)
		),

		// Loading effect
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Loading effect", 'the7mk2'),
			"param_name" => "loading_effect",
			"value" => array(
				'None' => 'none',
				'Fade in' => 'fade_in',
				'Move up' => 'move_up',
				'Scale up' => 'scale_up',
				'Fall perspective' => 'fall_perspective',
				'Fly' => 'fly',
				'Flip' => 'flip',
				'Helix' => 'helix',
				'Scale' => 'scale'
			),
			"description" => "",
			"dependency" => array(
				"element" => "type",
				"value" => array(
					"masonry"
				)
			)
		),

		// Autoslide
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Autoslide", 'the7mk2'),
			"param_name" => "autoslide",
			"value" => "",
			"description" => __('In milliseconds (e.g. 3 secund = 3000 miliseconds). Leave this field empty to disable autoslide. This field works only when "Appearance: Slider" selected.', 'the7mk2'),
			"dependency" => array(
				"element" => "type",
				"value" => array(
					"slider"
				)
			)
		),

		// Number of posts
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Number of testimonials to show", 'the7mk2'),
			"param_name" => "number",
			"value" => "12",
			"description" => ""
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
