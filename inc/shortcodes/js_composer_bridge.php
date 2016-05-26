<?php 
/**
 * This file contains shortcodes interface for Visual Composer.
 *
 * @package the7\Shortcodes
 * @since 1.0.0
 */

// ! File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Changing rows and columns classes.
 *
 * @param  string $class_string
 * @param  string $tag
 * @return string
 */
function custom_css_classes_for_vc_row_and_vc_column( $class_string, $tag ) {
	if ( $tag=='vc_column' || $tag=='vc_column_inner' ) {
		$class_string = preg_replace( '/vc_span(\d{1,2})/', 'wf-cell wf-span-$1', $class_string );
	}

	return $class_string;
}
add_filter( 'vc_shortcodes_css_class', 'custom_css_classes_for_vc_row_and_vc_column', 10, 2 );


/**
 * Adding our classes to paint standard VC shortcodes.
 *
 * @param  string $class_string
 * @param  string $tag
 * @param  array  $atts
 * @return string
 */
function custom_css_accordion( $class_string, $tag, $atts = array() ) {
	if ( in_array( $tag, array( 'vc_accordion', 'vc_toggle', 'vc_progress_bar', 'vc_posts_slider' ) ) ) {
		$class_string .= ' dt-style';
	}

	if ( 'vc_accordion' === $tag ) {
		if ( array_key_exists( 'style' , $atts ) ) {
			switch ( $atts['style'] ) {
				case '2':
					$class_string .= ' dt-accordion-bg-on';
					break;

				case '3':
					$class_string .= ' dt-accordion-line-on';
					break;
			}
		}

		if ( array_key_exists( 'title_size', $atts ) ) {
			$class_string .= ' dt-accordion-' . presscore_get_font_size_class( $atts['title_size'] );
		}
	}

	return $class_string;
}
add_filter( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'custom_css_accordion', 10, 3 );

/**
 * VC Row.
 */

// Animation
vc_add_param( "vc_row", array(
	"heading" => __( "Animation", 'the7mk2' ),
	"param_name" => "animation",
	"type" => "dropdown",
	"value" => presscore_get_vc_animation_options(),
	"admin_label" => true,
	"edit_field_class" => "dt_vc_row-param vc_col-xs-12 vc_column",
));

// Anchor
vc_add_param( "vc_row", array(
	"heading" => __( "Anchor", 'the7mk2' ),
	"description" => __( "If anchor is &quot;contact&quot;, use &quot;#!/contact&quot; as its smooth scroll link.", 'the7mk2' ),
	"param_name" => "anchor",
	"type" => "textfield",
	"edit_field_class" => "dt_vc_row-param vc_col-xs-12 vc_column",
));

// Minimum height
vc_add_param( "vc_row", array(
	"heading" => __( "Row minimum height", 'the7mk2' ),
	"description" => __( "You can use pixels (px) or percents (%).", 'the7mk2' ),
	"param_name" => "min_height",
	"type" => "textfield",
	"edit_field_class" => "dt_vc_row-param vc_col-xs-12 vc_column",
));

$row_margin_support_link = 'http://support.dream-theme.com/knowledgebase/remove-gap-above-and-below-content-area/';

// Top margin
vc_add_param( "vc_row", array(
	"heading" => __( "Top margin", 'the7mk2' ),
	"description" => sprintf( __( 'In pixels; negative values are allowed. if this is <a href="%s" target="_blank">the first stripe</a>, set -50px.', 'the7mk2' ), $row_margin_support_link ),
	"param_name" => "margin_top",
	"type" => "textfield",
	"value" => "",
	"edit_field_class" => "dt_vc_row-param vc_col-xs-12 vc_column",
));

// Bottom margin
vc_add_param( "vc_row", array(
	"heading" => __( "Bottom margin", 'the7mk2' ),
	"description" => sprintf( __( 'In pixels; negative values are allowed. if this is <a href="%s" target="_blank">the last stripe</a>, set -50px.', 'the7mk2' ), $row_margin_support_link ),
	"param_name" => "margin_bottom",
	"type" => "textfield",
	"value" => "",
	"edit_field_class" => "dt_vc_row-param vc_col-xs-12 vc_column",
));

// Full-width content
vc_add_param( "vc_row", array(
	"heading" => __( "Full-width content", 'the7mk2' ),
	"param_name" => "full_width_row",
	"type" => "checkbox",
	"value" => array( "" => "true" ),
	"edit_field_class" => "dt_vc_row-param vc_col-xs-12 vc_column",
));

// Left padding
vc_add_param( "vc_row", array(
	"heading" => __( "Left padding", 'the7mk2' ),
	"description" => __( "In pixels. This setting works only for inner row (a row inside a row).", 'the7mk2' ),
	"param_name" => "padding_left",
	"type" => "textfield",
	"value" => "",
	"dependency" => array(
		"element" => "full_width_row",
		"not_empty" => true,
	),
	"edit_field_class" => "dt_vc_row-param vc_col-xs-12 vc_column",
));

// Right padding
vc_add_param( "vc_row", array(
	"heading" => __( "Right padding", 'the7mk2' ),
	"description" => __( "In pixels. This setting works only for inner row (a row inside a row).", 'the7mk2' ),
	"param_name" => "padding_right",
	"type" => "textfield",
	"value" => "",
	"dependency" => array(
		"element" => "full_width_row",
		"not_empty" => true,
	),
	"edit_field_class" => "dt_vc_row-param vc_col-xs-12 vc_column",
));

// Top padding
vc_add_param( "vc_row", array(
	"heading" => __( "Top padding", 'the7mk2' ),
	"description" => __( "In pixels.", 'the7mk2' ),
	"param_name" => "padding_top",
	"type" => "textfield",
	"value" => "",
	"dependency" => array(
		"element" => "type",
		"value" => array( '1', '2', '3', '4', '5' ),
	),
	"edit_field_class" => "dt_vc_row-param vc_col-xs-12 vc_column",
));

// Bottom padding
vc_add_param( "vc_row", array(
	"heading" => __( "Bottom padding", 'the7mk2' ),
	"description" => __( "In pixels.", 'the7mk2' ),
	"param_name" => "padding_bottom",
	"type" => "textfield",
	"value" => "",
	"dependency" => array(
		"element" => "type",
		"value" => array( '1', '2', '3', '4', '5' ),
	),
	"edit_field_class" => "dt_vc_row-param vc_col-xs-12 vc_column",
));

// Background color
vc_add_param( "vc_row", array(
	"heading" => __( "Background color", 'the7mk2' ),
	"param_name" => "bg_color",
	"type" => "colorpicker",
	"value" => "",
	"dependency" => array(
		"element" => "type",
		"not_empty" => true,
	),
	"edit_field_class" => "dt_vc_row-param vc_col-xs-12 vc_column",
));

// Background image
vc_add_param( "vc_row", array(
	"heading" => __( "Background image", 'the7mk2' ),
	"description" => __( "Image URL.", 'the7mk2' ),
	"param_name" => "bg_image",
	"type" => "textfield",
	"class" => "dt_image",
	"dependency" => array(
		"element" => "type",
		"value" => array( '1', '2', '3', '4', '5' ),
	),
	"edit_field_class" => "dt_vc_row-param vc_col-xs-12 vc_column",
));

// Background position
vc_add_param( "vc_row", array(
	"heading" => __( "Background position", 'the7mk2' ),
	"param_name" => "bg_position",
	"type" => "dropdown",
	"value" => array(
		"Top" => "top",
		"Middle" => "center",
		"Bottom" => "bottom",
	),
	"dependency" => array(
		"element" => "type",
		"value" => array( '1', '2', '3', '4', '5' ),
	),
	"edit_field_class" => "dt_vc_row-param vc_col-xs-12 vc_column",
));

// Background repeat
vc_add_param( "vc_row", array(
	"heading" => __( "Background repeat", 'the7mk2' ),
	"param_name" => "bg_repeat",
	"type" => "dropdown",
	"value" => array(
		"No repeat" => "no-repeat",
		"Repeat (horizontally & vertically)" => "repeat",
		"Repeat horizontally" => "repeat-x",
		"Repeat vertically" => "repeat-y",
	),
	"dependency" => array(
		"element" => "type",
		"value" => array( '1', '2', '3', '4', '5' ),
	),
	"edit_field_class" => "dt_vc_row-param vc_col-xs-12 vc_column",
));

// Full-width background
vc_add_param( "vc_row", array(
	"heading" => __( "Full-width background", 'the7mk2' ),
	"param_name" => "bg_cover",
	"type" => "dropdown",
	"value" => array(
		"Disabled" => "false",
		"Enabled" => "true"
	),
	"dependency" => array(
		"element" => "type",
		"value" => array( '1', '2', '3', '4', '5' ),
	),
	"edit_field_class" => "dt_vc_row-param vc_col-xs-12 vc_column",
));

// Fixed background
vc_add_param( "vc_row", array(
	"heading" => __( "Fixed background", 'the7mk2' ),
	"param_name" => "bg_attachment",
	"type" => "dropdown",
	"value" => array(
		"Disabled" => "false",
		"Enabled" => "true"
	),
	"dependency" => array(
		"element" => "type",
		"value" => array( '1', '2', '3', '4', '5' ),
	),
	"edit_field_class" => "dt_vc_row-param vc_col-xs-12 vc_column",
));

// Enable parallax
vc_add_param( "vc_row", array(
	"heading" => __( "Enable parallax", 'the7mk2' ),
	"param_name" => "enable_parallax",
	"type" => "checkbox",
	"value" => array( "" => "false" ),
	"dependency" => array(
		"element" => "type",
		"value" => array( '1', '2', '3', '4', '5' ),
	),
	"edit_field_class" => "dt_vc_row-param vc_col-xs-12 vc_column",
));

// Parallax speed
vc_add_param( "vc_row", array(
	"heading" => __( "Parallax speed", 'the7mk2' ),
	"description" => __( "Slower then content scrolling: 0.1 - 1. Faster then content scrolling: 1 and above. Reverse direction: - 0.1 and below.", 'the7mk2' ),
	"param_name" => "parallax_speed",
	"type" => "textfield",
	"value" => "0.1",
	"dependency" => array(
		"element" => "enable_parallax",
		"not_empty" => true,
	),
	"edit_field_class" => "dt_vc_row-param vc_col-xs-12 vc_column",
));

// Video background (mp4)
vc_add_param( "vc_row", array(
	"heading" => __( "Video background (mp4)", 'the7mk2' ),
	"param_name" => "bg_video_src_mp4",
	"type" => "textfield",
	"value" => "",
	"dependency" => array(
		"element" => "type",
		"value" => array( '1', '2', '3', '4', '5' ),
	),
	"edit_field_class" => "dt_vc_row-param vc_col-xs-12 vc_column dt-force-hidden",
));

// Video background (ogv)
vc_add_param( "vc_row", array(
	"heading" => __( "Video background (ogv)", 'the7mk2' ),
	"param_name" => "bg_video_src_ogv",
	"type" => "textfield",
	"value" => "",
	"dependency" => array(
		"element" => "type",
		"value" => array( '1', '2', '3', '4', '5' ),
	),
	"edit_field_class" => "dt_vc_row-param vc_col-xs-12 vc_column dt-force-hidden",
));

// Video background (webm)
vc_add_param( "vc_row", array(
	"heading" => __( "Video background (webm)", 'the7mk2' ),
	"param_name" => "bg_video_src_webm",
	"type" => "textfield",
	"value" => "",
	"dependency" => array(
		"element" => "type",
		"value" => array( '1', '2', '3', '4', '5' ),
	),
	"edit_field_class" => "dt_vc_row-param vc_col-xs-12 vc_column dt-force-hidden",
));

$vc_row_shortcode = WPBMap::getShortCode( 'vc_row' );
if ( isset( $vc_row_shortcode['params'] ) && is_array( $vc_row_shortcode['params'] ) ) {
	$params = $vc_row_shortcode['params'];

	// Output 'tupe' param first.
	array_unshift( $params, array(
		'heading' => __( 'Row style', 'the7mk2' ),
		'param_name' => 'type',
		'type' => 'dropdown',
		'edit_field_class' => 'dt_vc_row-params_switch vc_col-xs-12 vc_column',
		'admin_label' => true,
		'value' => array(
			'Default The7' => '',
			'Default VC' => 'vc_default',
			'Stripe 1 (from Theme Options > Stripes)' => '1',
			'Stripe 2 (from Theme Options > Stripes)' => '2',
			'Stripe 3 (from Theme Options > Stripes)' => '3',
			'Stripe 4 (dark background & light content)' => '4',
			'Stripe 5 (light background & dark content)' => '5',
		),
	) );

	$el_class_key = false;
	foreach ( $params as $p_key=>$p_data ) {
		if ( isset( $p_data['param_name'] ) && 'el_class' === $p_data['param_name'] ) {
			$el_class_key = $p_key;
			break;
		}
	}

	// Output 'el_class' param last.
	if ( false !== $el_class_key ) {
		$el_class = $params[ $el_class_key ];
		unset( $params[ $el_class_key ] );
		$params[] = $el_class;
	}

	WPBMap::modify( 'vc_row', 'params', $params );
}

/**
 * VC Column.
 */

vc_add_param("vc_column", array(
	"type" => "dropdown",
	"class" => "",
	"heading" => __("Animation", 'the7mk2'),
	"admin_label" => true,
	"param_name" => "animation",
	"value" => presscore_get_vc_animation_options(),
	"description" => ""
));

/**
 * VC Pie.
 */

vc_map( array(
	'base'			=> 'vc_pie',
	'name'			=> __( 'Pie chart', 'the7mk2' ),
	'description'	=> __( 'Animated pie chart', 'the7mk2' ),
	'category'		=> __( 'Content', 'the7mk2' ),
	'icon'			=> 'icon-wpb-vc_pie',
	'params'		=> array(
		array(
			'heading'		=> __( 'Widget title', 'the7mk2' ),
			'description'	=> __( 'Enter text which will be used as widget title. Leave blank if no title is needed.', 'the7mk2' ),
			'param_name'	=> 'title',
			'type'			=> 'textfield',
			'admin_label'	=> true,
		),
		array(
			'heading'		=> __( 'Pie value', 'the7mk2' ),
			'description'	=> __( 'Input graph value here. Choose range between 0 and 100.', 'the7mk2' ),
			'param_name'	=> 'value',
			'type'			=> 'textfield',
			'value'			=> '50',
			'admin_label'	=> true,
		),
		array(
			'heading'		=> __( 'Pie label value', 'the7mk2' ),
			'description'	=> __( 'Input integer value for label. If empty "Pie value" will be used.', 'the7mk2' ),
			'param_name'	=> 'label_value',
			'type'			=> 'textfield',
			'value'			=> '',
		),
		array(
			'heading'		=> __( 'Units', 'the7mk2' ),
			'description'	=> __( 'Enter measurement units (if needed) Eg. %, px, points, etc. Graph value and unit will be appended to the graph title.', 'the7mk2' ),
			'param_name'	=> 'units',
			'type'			=> 'textfield',
		),
		array(
			"heading"		=> __( "Bar color", 'the7mk2' ),
			"description"	=> __( 'Select pie chart color.', 'the7mk2' ),
			"param_name"	=> "color_mode",
			"type"			=> "dropdown",
			"value"			=> array(
				"Title"					=> "title_like",
				"Light (50% content)"	=> "content_like",
				"Accent"				=> "accent",
				"Custom"				=> "custom"
			),
		),
		array(
			"heading"		=> __( "Custom bar color", 'the7mk2' ),
			"param_name"	=> "color",
			"type"			=> "colorpicker",
			"value"			=> '#f7f7f7',
			"dependency"	=> array(
				"element"		=> "color_mode",
				"value"			=> array( "custom" )
			)
		),
		array(
			'heading'		=> __( 'Extra class name', 'the7mk2' ),
			'description'	=> __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'the7mk2' ),
			'param_name'	=> 'el_class',
			'type'			=> 'textfield',
		),
		array(
			"heading"		=> __( "Appearance", 'the7mk2' ),
			"param_name"	=> "appearance",
			"type"			=> "dropdown",
			"value"			=> array(
				"Pie chart (default)"	=> "default",
				"Counter"				=> "counter"
			),
			"admin_label"	=> true,
		),
		array(
			'type' => 'css_editor',
			'heading' => __( 'CSS box', 'the7mk2' ),
			'param_name' => 'css',
			'group' => __( 'Design Options', 'the7mk2' )
		),
	)
) );

/**
 * VC Widgetized sidebar.
 */

vc_add_param( "vc_widget_sidebar", array(
	"type" => "dropdown",
	"class" => "",
	"heading" => __( "Show background", 'the7mk2' ),
	"admin_label" => true,
	"param_name" => "show_bg",
	"value" => array(
		"Yes" => "true",
		"No" => "false"
	)
) );

/**
 * VC Tabs.
 */

// undeprecate
vc_map_update("vc_tabs", array(
	"deprecated" => null,
	"category" => __('by Dream-Theme', 'the7mk2'),
	"icon" => "dt_vc_ico_tabs",
	"weight" => -1,
));

vc_map_update( 'vc_tab', array(
	'deprecated' => null,
) );

// title font size
vc_add_param("vc_tabs", array(
	"type" => "dropdown",
	"heading" => __("Title size", 'the7mk2'),
	"param_name" => "title_size",
	"value" => array(
		'small' => "small",
		'medium' => "normal",
		'large' => "big",
		'h1' => "h1",
		'h2' => "h2",
		'h3' => "h3",
		'h4' => "h4",
		'h5' => "h5",
		'h6' => "h6",
	),
	"std" => "big"
));

// style
vc_add_param("vc_tabs", array(
	"type" => "dropdown",
	"heading" => __("Style", 'the7mk2'),
	"param_name" => "style",
	"value" => array(
		"Style 1" => "tab-style-one",
		"Style 2" => "tab-style-two",
		"Style 3" => "tab-style-three",
		"Style 4" => "tab-style-four"
	)
));

/**
 * VC Tour.
 */

// undeprecate
vc_map_update("vc_tour", array(
	"deprecated" => null,
	"category" => __('by Dream-Theme', 'the7mk2'),
	"icon" => "dt_vc_ico_tour",
	"weight" => -1,
));

// title font size
vc_add_param("vc_tour", array(
	"type" => "dropdown",
	"heading" => __("Title size", 'the7mk2'),
	"param_name" => "title_size",
	"value" => array(
		'small' => "small",
		'medium' => "normal",
		'large' => "big",
		'h1' => "h1",
		'h2' => "h2",
		'h3' => "h3",
		'h4' => "h4",
		'h5' => "h5",
		'h6' => "h6",
	),
	"std" => "big"
));

vc_add_param("vc_tour", array(
	"type" => "dropdown",
	"heading" => __("Style", 'the7mk2'),
	"param_name" => "style",
	"value" => array(
		"Style 1" => "tab-style-one",
		"Style 2" => "tab-style-two",
		"Style 3" => "tab-style-three",
		"Style 4" => "tab-style-four"
	)
));

/**
 * VC Progress bars.
 */

vc_add_param("vc_progress_bar", array(
	"type" => "dropdown",
	"heading" => __( 'Style', 'the7mk2' ),
	"param_name" => "caption_pos",
	"value" => array(
		'Style 1 (text on the bar)' => 'on',
		'Style 2 (text above the thick bar)' => 'top',
		'Style 3 (text above the thin bar)' => 'thin_top',
	)
));

vc_add_param("vc_progress_bar", array(
	"type" => "dropdown",
	"heading" => __( 'Background', 'the7mk2' ),
	"param_name" => "bgstyle",
	"value" => array(
		'Default' => 'default',
		'Outlines' => 'outline',
		'Semitransparent' => 'transparent',
	)
));

// add accent predefined color
$param = WPBMap::getParam('vc_progress_bar', 'bgcolor');
$param['value'] = array( 'Accent' => 'accent-bg', 'Custom' => 'custom' );
WPBMap::mutateParam('vc_progress_bar', $param);

/**
 * VC Column text.
 */

// add custom animation
$param = WPBMap::getParam('vc_column_text', 'css_animation');
$param['value'] = presscore_get_vc_animation_options();
WPBMap::mutateParam('vc_column_text', $param);

/**
 * VC Message Box.
 */

// add custom animation
$param = WPBMap::getParam('vc_message', 'css_animation');
$param['value'] = presscore_get_vc_animation_options();
WPBMap::mutateParam('vc_message', $param);

/**
 * VC Toggle.
 */

// add custom animation
$param = WPBMap::getParam('vc_toggle', 'css_animation');
$param['value'] = presscore_get_vc_animation_options();
WPBMap::mutateParam('vc_toggle', $param);

/**
 * VC Single Image.
 */

// add custom animation
$param = WPBMap::getParam('vc_single_image', 'css_animation');
$param['value'] = presscore_get_vc_animation_options();
WPBMap::mutateParam('vc_single_image', $param);

// replace pretty photo with theme popup
$param = WPBMap::getParam('vc_single_image', 'onclick');

if ( $param && $key = array_search( 'link_image', $param['value'] ) ) {
	unset( $param['value'][ $key ] );

	$key = 'Open Magnific Popup';

	$param['value'][ $key ] = 'link_image';

	WPBMap::mutateParam('vc_single_image', $param);
}
unset( $param, $key );

vc_add_param("vc_single_image", array(
	"type" => "dropdown",
	"class" => "",
	"heading" => __("Image hovers", 'the7mk2'),
	"param_name" => "image_hovers",
	"std" => "true",
	"value" => array(
		"Disabled" => "false",
		"Enabled" => "true"
	)
));

/**
 * @since 3.1.4
 */
vc_add_param("vc_single_image", array(
	"type" => "checkbox",
	"heading" => __("Lazy loading", 'the7mk2'),
	"param_name" => "lazy_loading",
));

/**
 * VC Accordion.
 */

// undeprecate
vc_map_update("vc_accordion", array(
	"deprecated" => null,
	"category" => __('by Dream-Theme', 'the7mk2'),
	"icon" => "dt_vc_ico_accordion",
	"weight" => -1,
));

vc_map_update( 'vc_accordion_tab', array(
	'deprecated' => null,
));

// title font size
vc_add_param("vc_accordion", array(
	"type" => "dropdown",
	"heading" => __("Title size", 'the7mk2'),
	"param_name" => "title_size",
	"value" => array(
		'small' => "small",
		'medium' => "normal",
		'large' => "big",
		'h1' => "h1",
		'h2' => "h2",
		'h3' => "h3",
		'h4' => "h4",
		'h5' => "h5",
		'h6' => "h6",
	),
	"std" => "big"
));

vc_add_param("vc_accordion", array(
	"type" => "dropdown",
	"heading" => __("Style", 'the7mk2'),
	"param_name" => "style",
	"value" => array(
		'Style 1 (no background)' => '1',
		'Style 2 (with background)' => '2',
		'Style 3 (with dividers)' => '3'
	),
	"description" => ""
));

/**
 * VC Button.
 */

vc_add_param( 'vc_btn', array(
	'type' => 'checkbox',
	'heading' => __( 'Smooth scroll?', 'the7mk2' ),
	'param_name' => 'smooth_scroll',
	'description' => __( 'for #anchor navigation', 'the7mk2' )
) );

/**
 * DT Fancy Titles.
 */

vc_map( array(
	"weight" => -1,
	"name" => "Fancy Titles",
	"base" => "dt_fancy_title",
	"icon" => "dt_vc_ico_fancy_titles",
	"class" => "dt_vc_sc_fancy_titles",
	"category" => __('by Dream-Theme', 'the7mk2'),
	"description" => '',
	"params" => array(
		array(
			"type" => "textfield",
			"heading" => "Title",
			"param_name" => "title",
			"holder" => "div",
			"value" => "Title",
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"heading" => "Title position",
			"param_name" => "title_align",
			"value" => array(
				'centre' => "center",
				'left' => "left",
				'right' => "right"
			),
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"heading" => "Title size",
			"param_name" => "title_size",
			"value" => array(
				'small' => "small",
				'medium' => "normal",
				'large' => "big",
				'h1' => "h1",
				'h2' => "h2",
				'h3' => "h3",
				'h4' => "h4",
				'h5' => "h5",
				'h6' => "h6",
			),
			"std" => "normal",
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"heading" => "Title color",
			"param_name" => "title_color",
			"value" => array(
				"semitransparent" => "default",
				"accent" => "accent",
				"title" => "title",
				"custom" => "custom"
			),
			"std" => "default",
			"description" => ""
		),
		array(
			"type" => "colorpicker",
			"heading" => "Custom title color",
			"param_name" => "custom_title_color",
			"dependency" => array(
				"element" => "title_color",
				"value" => array( "custom" )
			),
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"heading" => "Separator style",
			"param_name" => "separator_style",
			"value" => array(
				"line" => "",
				"dashed" => "dashed",
				"dotted" => "dotted",
				"double" => "double",
				"thick" => "thick",
				"disabled" => "disabled"
			),
			"description" => ""
		),
		array(
			"type" => "textfield",
			"heading" => "Element width (in %)",
			"param_name" => "el_width",
			"value" => "100",
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"heading" => "Background under title",
			"param_name" => "title_bg",
			"value" => array(
				"enabled" => "enabled",
				"disabled" => "disabled"
			),
			"std" => "disabled",
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"heading" => "Separator & background color",
			"param_name" => "separator_color",
			"value" => array(
				"default" => "default",
				"accent" => "accent",
				"custom" => "custom"
			),
			"std" => "default",
			"description" => ""
		),
		array(
			"type" => "colorpicker",
			"heading" => "Custom separator color",
			"param_name" => "custom_separator_color",
			"dependency" => array(
				"element" => "separator_color",
				"value" => array( "custom" )
			),
			"description" => ""
		),
	)
) );

/**
 * DT Fancy Separators.
 */

vc_map( array(
	"weight" => -1,
	"name" => "Fancy Separators",
	"base" => "dt_fancy_separator",
	"icon" => "dt_vc_ico_separators",
	"class" => "dt_vc_sc_separators",
	"category" => __('by Dream-Theme', 'the7mk2'),
	"description" => '',
	"params" => array(
		array(
			"type" => "dropdown",
			"heading" => "Separator style",
			"param_name" => "separator_style",
			"value" => array(
				"solid line" => "line",
				"dashed" => "dashed",
				"dotted" => "dotted",
				"double" => "double",
			),
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"heading" => "Separator color",
			"param_name" => "separator_color",
			"value" => array(
				"default" => "default",
				"accent" => "accent",
				"custom" => "custom"
			),
			"std" => "default",
			"description" => ""
		),
		array(
			"type" => "colorpicker",
			"heading" => "Custom separator color",
			"param_name" => "custom_separator_color",
			"dependency" => array(
				"element" => "separator_color",
				"value" => array( "custom" )
			),
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"heading" => "Alignment",
			"param_name" => "alignment",
			"value" => array(
				'center' => 'center',
				'left' => 'left',
				'right' => 'right',
			),
			"description" => ""
		),
		array(
			"type" => "textfield",
			"heading" => "Thickness (in px)",
			"param_name" => "line_thickness",
			"value" => "",
			"description" => ""
		),
		array(
			"type" => "textfield",
			"heading" => "Element width (in % or px)",
			"param_name" => "el_width",
			"value" => "100%",
			"description" => ""
		),
	)
) );

/**
 * DT Fancy Quote.
 */

vc_map( array(
	"weight" => -1,
	"name" => __("Fancy Quote", 'the7mk2'),
	"base" => "dt_quote",
	"icon" => "dt_vc_ico_quote",
	"class" => "dt_vc_sc_quote",
	"category" => __('by Dream-Theme', 'the7mk2'),
	"params" => array(
		array(
			"type" => "textarea_html",
			"holder" => "div",
			"class" => "",
			"heading" => __("Content", 'the7mk2'),
			"param_name" => "content",
			"value" => __("<p>I am test text for QUOTE. Click edit button to change this text.</p>", 'the7mk2'),
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Quote type", 'the7mk2'),
			"param_name" => "type",
			"value" => array(
				"Blockquote" => "blockquote",
				"Pullquote" => "pullquote"
			),
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Font size", 'the7mk2'),
			"param_name" => "font_size",
			"value" => array(
				"Small" => "small",
				"Medium" => "normal",
				"Large" => "big",
				"h1" => "h1",
				"h2" => "h2",
				"h3" => "h3",
				"h4" => "h4",
				"h5" => "h5",
				"h6" => "h6",
			),
			"std" => "big",
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Blockquote style", 'the7mk2'),
			"param_name" => "background",
			"value" => array(
				"Border" => "plain",
				"Background" => "fancy"
			),
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Animation", 'the7mk2'),
			"param_name" => "animation",
			"value" => presscore_get_vc_animation_options(),
			"description" => ""
		)
	)
) );

/**
 * DT Call to Action.
 */

vc_map( array(
	"weight" => -1,
	"name" => __("Call to Action", 'the7mk2'),
	"base" => "dt_call_to_action",
	"icon" => "dt_vc_ico_call_to_action",
	"class" => "dt_vc_sc_call_to_action",
	"category" => __('by Dream-Theme', 'the7mk2'),
	"params" => array(
		array(
			"type" => "textarea_html",
			"holder" => "div",
			"class" => "",
			"heading" => __("Content", 'the7mk2'),
			"param_name" => "content",
			"value" => __("<p>I am test text for CALL TO ACTION. Click edit button to change this text.</p>", 'the7mk2'),
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Font size", 'the7mk2'),
			"param_name" => "content_size",
			"value" => array(
				"Small" => "small",
				"Medium" => "normal",
				"Large" => "big",
			),
			"std" => "big",
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Style", 'the7mk2'),
			"param_name" => "background",
			"value" => array(
				"None" => "no",
				"Outline" => "plain",
				"Background" => "fancy"
			),
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Decorative line on the left", 'the7mk2'),
			"param_name" => "line",
			"value" => array(
				"Disable" => "false",
				"Enable" => "true"
			),
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Button alignment", 'the7mk2'),
			"param_name" => "style",
			"value" => array(
				"Default" => "0",
				"On the right" => "1"
			),
			"description" => __( "Use [dt_button] to insert a button. Default: button keeps alignment from content editor. On the right: button is aligned to the right.", 'the7mk2' )
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Animation", 'the7mk2'),
			"param_name" => "animation",
			"value" => presscore_get_vc_animation_options(),
			"description" => ""
		)
	)
) );

/**
 * DT Teaser.
 */

vc_map( array(
	"weight" => -1,
	"name" => __("Teaser", 'the7mk2'),
	"base" => "dt_teaser",
	"icon" => "dt_vc_ico_teaser",
	"class" => "dt_vc_sc_teaser",
	"category" => __('by Dream-Theme', 'the7mk2'),
	"params" => array(

		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Type", 'the7mk2'),
			"param_name" => "type",
			"value" => array(
				"Uploaded image" => "uploaded_image",
				"Image from url" => "image",
				"Video from url" => "video"
			),
			"description" => ""
		),

		//////////////////////
		// uploaded image //
		//////////////////////

		array(
			"type" => "attach_image",
			"holder" => "img",
			"class" => "dt_image",
			"heading" => __("Choose image", 'the7mk2'),
			"param_name" => "image_id",
			"value" => "",
			"description" => "",
			"dependency" => array(
				"element" => "type",
				"value" => array(
					"uploaded_image"
				)
			)
		),

		//////////////////////
		// image from url //
		//////////////////////

		// image url
		array(
			"type" => "textfield",
			"class" => "dt_image",
			"heading" => __("Image URL", 'the7mk2'),
			"param_name" => "image",
			"value" => "",
			"description" => "",
			"dependency" => array(
				"element" => "type",
				"value" => array(
					"image"
				)
			)
		),

		// image width
		array(
			"type" => "textfield",
			"class" => "dt_image",
			"heading" => __("Image WIDTH", 'the7mk2'),
			"param_name" => "image_width",
			"value" => "",
			"description" => __("image width in px", 'the7mk2'),
			"dependency" => array(
				"element" => "type",
				"value" => array(
					"image"
				)
			)
		),

		// image height
		array(
			"type" => "textfield",
			"class" => "dt_image",
			"heading" => __("Image HEIGHT", 'the7mk2'),
			"param_name" => "image_height",
			"value" => "",
			"description" => __("image height in px", 'the7mk2'),
			"dependency" => array(
				"element" => "type",
				"value" => array(
					"image"
				)
			)
		),

		// image alt
		array(
			"type" => "textfield",
			"class" => "dt_image",
			"heading" => __("Image ALT", 'the7mk2'),
			"param_name" => "image_alt",
			"value" => "",
			"description" => "",
			"dependency" => array(
				"element" => "type",
				"value" => array(
					"image",
					"uploaded_image"
				)
			)
		),

		// misc link
		array(
			"type" => "textfield",
			"class" => "dt_image",
			"heading" => __("Misc link", 'the7mk2'),
			"param_name" => "misc_link",
			"value" => "",
			"description" => "",
			"dependency" => array(
				"element" => "type",
				"value" => array(
					"image",
					"uploaded_image"
				)
			)
		),

		// target
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Target link", 'the7mk2'),
			"param_name" => "target",
			"value" => array(
				"Blank" => "blank",
				"Self" => "self"
			),
			"description" => "",
			"dependency" => array(
				"element" => "type",
				"value" => array(
					"image",
					"uploaded_image"
				)
			)
		),

		// open in lightbox
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Open in lighbox", 'the7mk2'),
			"param_name" => "lightbox",
			"value" => array(
				"" => "true"
			),
			"description" => __("If selected, larger image will be opened on click.", 'the7mk2'),
			"dependency" => array(
				"element" => "type",
				"value" => array(
					"image",
					"uploaded_image"
				)
			)
		),

		//////////////////////
		// video from url //
		//////////////////////

		// video url
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Video URL", 'the7mk2'),
			"admin_label" => true,
			"param_name" => "media",
			"value" => "",
			"description" => "",
			"dependency" => array(
				"element" => "type",
				"value" => array(
					"video"
				)
			)
		),

		// content
		array(
			"type" => "textarea_html",
			"holder" => "div",
			"class" => "",
			"heading" => __("Content", 'the7mk2'),
			"param_name" => "content",
			"value" => __("I am test text for TEASER. Click edit button to change this text.", 'the7mk2'),
			"description" => ""
		),

		// media style
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Media style", 'the7mk2'),
			"param_name" => "style",
			"value" => array(
				"Full-width" => "1",
				"With paddings" => "2"
			),
			"description" => ""
		),

		// image hoovers
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Image hovers", 'the7mk2'),
			"param_name" => "image_hovers",
			"std" => "true",
			"value" => array(
				"Disabled" => "false",
				"Enabled" => "true"
			)
		),

		// font size
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Font size", 'the7mk2'),
			"param_name" => "content_size",
			"value" => array(
				"Small" => "small",
				"Medium" => "normal",
				"Large" => "big"
			),
			"std" => "big",
			"description" => ""
		),

		// background
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Style", 'the7mk2'),
			"param_name" => "background",
			"value" => array(
				"None" => "no",
				"Outline" => "plain",
				"Background" => "fancy"
			),
			"description" => ""
		),

		// animation
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Animation", 'the7mk2'),
			"param_name" => "animation",
			"value" => presscore_get_vc_animation_options(),
			"description" => ""
		)
	)
) );

/**
 * DT Banner.
 */

vc_map( array(
	"weight" => -1,
	"name" => __("Banner", 'the7mk2'),
	"base" => "dt_banner",
	"icon" => "dt_vc_ico_banner",
	"class" => "dt_vc_sc_banner",
	"category" => __('by Dream-Theme', 'the7mk2'),
	"params" => array(
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Type", 'the7mk2'),
			"param_name" => "type",
			"value" => array(
				"Uploaded image" => "uploaded_image",
				"Image from url" => "image"
			),
			"description" => ""
		),
		array(
			"type" => "attach_image",
			"holder" => "img",
			"class" => "dt_image",
			"heading" => __("Background image", 'the7mk2'),
			"param_name" => "image_id",
			"value" => "",
			"description" => "",
			"dependency" => array(
				"element" => "type",
				"value" => array(
					"uploaded_image"
				)
			)
		),
		array(
			"type" => "textfield",
			"class" => "dt_image",
			"heading" => __("Background image", 'the7mk2'),
			"param_name" => "bg_image",
			"description" => __("Image URL.", 'the7mk2'),
			"dependency" => array(
				"element" => "type",
				"value" => array(
					"image"
				)
			)
		),
		array(
			"type" => "textarea_html",
			"holder" => "div",
			"class" => "",
			"heading" => __("Content", 'the7mk2'),
			"param_name" => "content",
			"value" => __("<p>I am test text for BANNER. Click edit button to change this text.</p>", 'the7mk2'),
			"description" => ""
		),
		array(
			"type" => "textfield",
			"class" => "",
			"admin_label" => true,
			"heading" => __("Banner link", 'the7mk2'),
			"param_name" => "link",
			"value" => ""
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Open link in", 'the7mk2'),
			"param_name" => "target_blank",
			"value" => array(
				"Same window" => "false",
				"New window" => "true"
			),
			"description" => "",
			"dependency" => array(
				"element" => "link",
				"not_empty" => true
			)
		),
		array(
			"type" => "colorpicker",
			"class" => "",
			"heading" => __("Background color", 'the7mk2'),
			"param_name" => "bg_color",
			"value" => "rgba(0,0,0,0.4)",
			"description" => ""
		),
		array(
			"type" => "colorpicker",
			"class" => "",
			"heading" => __("Border color", 'the7mk2'),
			"param_name" => "text_color",
			"value" => "#ffffff",
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Font size", 'the7mk2'),
			"param_name" => "text_size",
			"value" => array(
				"Small" => "small",
				"Medium" => "normal",
				"Large" => "big"
			),
			"std" => "big",
			"description" => ""
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Border width", 'the7mk2'),
			"param_name" => "border_width",
			"value" => "3",
			"description" => __("In pixels.", 'the7mk2')
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Outer padding", 'the7mk2'),
			"param_name" => "outer_padding",
			"value" => "10",
			"description" => __("In pixels.", 'the7mk2')
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Inner padding", 'the7mk2'),
			"param_name" => "inner_padding",
			"value" => "10",
			"description" => __("In pixels.", 'the7mk2')
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Banner minimal height", 'the7mk2'),
			"param_name" => "min_height",
			"value" => "150",
			"description" => __("In pixels.", 'the7mk2')
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Animation", 'the7mk2'),
			"param_name" => "animation",
			"value" => presscore_get_vc_animation_options(),
			"description" => ""
		)
	)
) );

/**
 * DT Contact form.
 */

vc_map( array(
	"weight" => -1,
	"name" => __("Contact Form", 'the7mk2'),
	"base" => "dt_contact_form",
	"icon" => "dt_vc_ico_contact_form",
	"class" => "dt_vc_sc_contact_form",
	"category" => __('by Dream-Theme', 'the7mk2'),
	"params" => array(
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Form fields", 'the7mk2'),
			"admin_label" => true,
			"param_name" => "fields",
			"value" => array(
				"name" => "name",
				"email" => "email",
				"telephone" => "telephone",
				"country" => "country",
				"city" => "city",
				"company" => "company",
				"website" => "website",
				"message" => "message"
			),
			"description" => __("Attention! At least one must be selected.", 'the7mk2')
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Message textarea height", 'the7mk2'),
			"param_name" => "message_height",
			"value" => "6",
			"description" => __("Number of lines.", 'the7mk2'),
		),
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Required fields", 'the7mk2'),
			//"admin_label" => true,
			"param_name" => "required",
			"value" => array(
				"name" => "name",
				"email" => "email",
				"telephone" => "telephone",
				"country" => "country",
				"city" => "city",
				"company" => "company",
				"website" => "website",
				"message" => "message"
			),
			"description" => __("Attention! At least one must be selected.", 'the7mk2')
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __('Submit button caption', 'the7mk2'),
			"param_name" => "button_title",
			"value" => "Send message",
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Submit button size", 'the7mk2'),
			"param_name" => "button_size",
			"value" => array(
				"Small" => "small",
				"Medium" => "medium",
				"Big" => "big"
			),
			"description" => ""
		)
	)
) );

/**
 * DT Mini Blog.
 */

vc_map( array(
	"weight" => -1,
	"name" => __("Blog Mini", 'the7mk2'),
	"base" => "dt_blog_posts_small",
	"icon" => "dt_vc_ico_blog_posts_small",
	"class" => "dt_vc_sc_blog_posts_small",
	"category" => __('by Dream-Theme', 'the7mk2'),
	"params" => array(
		array(
			"type" => "dt_taxonomy",
			"taxonomy" => "category",
			"class" => "",
			"heading" => __("Categories", 'the7mk2'),
			"admin_label" => true,
			"param_name" => "category",
			"description" => __("Note: By default, all your posts will be displayed. <br>If you want to narrow output, select category(s) above. Only selected categories will be displayed.", 'the7mk2')
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Layout", 'the7mk2'),
			"param_name" => "columns",
			"value" => array(
				"List" => "1",
				"2 columns" => "2",
				"3 columns" => "3"
			),
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Featured images", 'the7mk2'),
			"param_name" => "featured_images",
			"value" => array(
				"Show" => "true",
				"Hide" => "false"
			),
			"description" => "",
			"group" => __("Featured images", 'the7mk2'),
		),
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Enable rounded corners", 'the7mk2'),
			"param_name" => "round_images",
			"value" => array(
				"" => "true",
			),
			"group" => __("Featured images", 'the7mk2'),
			"dependency" => array(
				"element" => "featured_images",
				"value" => array( "true" )
			)
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Images width (in px)", 'the7mk2'),
			"param_name" => "images_width",
			"value" => "60",
			"description" => "",
			"group" => __("Featured images", 'the7mk2'),
			"dependency" => array(
				"element" => "featured_images",
				"value" => array( "true" )
			)
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Images height (in px)", 'the7mk2'),
			"param_name" => "images_height",
			"value" => "60",
			"description" => "",
			"group" => __("Featured images", 'the7mk2'),
			"dependency" => array(
				"element" => "featured_images",
				"value" => array( "true" )
			)
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Number of posts to show", 'the7mk2'),
			"param_name" => "number",
			"value" => "6",
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
		)
	)
) );

/**
 * DT Blog.
 */

vc_map( array(
	"weight" => -1,
	"name" => __("Blog Masonry & Grid", 'the7mk2'),
	"base" => "dt_blog_posts",
	"icon" => "dt_vc_ico_blog_posts",
	"class" => "dt_vc_sc_blog_posts",
	"category" => __('by Dream-Theme', 'the7mk2'),
	"params" => array(

		// Taxonomy
		array(
			"type" => "dt_taxonomy",
			"taxonomy" => "category",
			"class" => "",
			"admin_label" => true,
			"heading" => __("Categories", 'the7mk2'),
			"param_name" => "category",
			"description" => __("Note: By default, all your posts will be displayed. <br>If you want to narrow output, select category(s) above. Only selected categories will be displayed.", 'the7mk2')
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
			"heading" => __("Gap between posts (px)", 'the7mk2'),
			"description" => __("Post paddings (e.g. 5 pixel padding will give you 10 pixel gaps between posts)", 'the7mk2'),
			"param_name" => "padding",
			"value" => "20"
		),

		// Column min width
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Column minimum width (px)", 'the7mk2'),
			"param_name" => "column_width",
			"value" => "370"
		),

		// Column max width
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Desired columns number", 'the7mk2'),
			"param_name" => "columns_number",
			"value" => "3"
		),

		// Fancy date
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Fancy date", 'the7mk2'),
			"param_name" => "fancy_date",
			"value" => array(
				"" => "true",
			)
		),

		// Image & background style
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Image & background style", 'the7mk2'),
			"param_name" => "background",
			"value" => array(
				"No background" => "disabled",
				"Fullwidth image" => "fullwidth",
				"Image with paddings" => "with_paddings"
			),
			"description" => ""
		),

		// Proportions
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Post proportions", 'the7mk2'),
			"param_name" => "proportion",
			"value" => "",
			"description" => __("Width:height (e.g. 16:9). Leave this field empty to preserve original image proportions.", 'the7mk2')
		),

		// Post width
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Posts width", 'the7mk2'),
			"param_name" => "same_width",
			"value" => array(
				"Preserve original width" => "false",
				"Make posts same width" => "true",
			),
			"description" => ""
		),

		// Number of posts
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Number of posts to show", 'the7mk2'),
			"param_name" => "number",
			"value" => "12",
			"description" => ""
		),

		// Posts per page
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Number of posts to display on one page", 'the7mk2'),
			"param_name" => "posts_per_page",
			"value" => "-1",
			"description" => ""
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
		),

		// Show excerpts
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Show excerpts", 'the7mk2'),
			"param_name" => "show_excerpts",
			"value" => array(
				"" => "true"
			)
		),

		// Show "Read more" buttons
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __('Show "Read more" buttons', 'the7mk2'),
			"param_name" => "show_read_more_button",
			"value" => array(
				"" => "true"
			)
		),

		//////////////////////////////////
		// blog post meta information //
		//////////////////////////////////

		// Categories
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Show post categories", 'the7mk2'),
			"param_name" => "show_post_categories",
			"value" => array(
				"" => "true"
			)
		),

		// Date
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Show post date", 'the7mk2'),
			"param_name" => "show_post_date",
			"value" => array(
				"" => "true"
			)
		),

		// Author
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Show post author", 'the7mk2'),
			"param_name" => "show_post_author",
			"value" => array(
				"" => "true"
			)
		),

		// Comments
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Show post comments", 'the7mk2'),
			"param_name" => "show_post_comments",
			"value" => array(
				"" => "true"
			)
		),

		// Filter
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Show categories filter", 'the7mk2'),
			"param_name" => "show_filter",
			"value" => array(
				"" => "true"
			)
		),

		// Show orderby
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Show name / date ordering", 'the7mk2'),
			"param_name" => "show_orderby",
			"value" => array(
				"" => "true"
			)
		),

		// Show order
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Show asc. / desc. ordering", 'the7mk2'),
			"param_name" => "show_order",
			"value" => array(
				"" => "true"
			)
		),
	)
) );

/**
 * DT Blog Scroller.
 */

vc_map( array(
	"weight" => -1,
	"name" => __("Blog Scroller", 'the7mk2'),
	"base" => "dt_blog_scroller",
	"icon" => "dt_vc_ico_blog_posts",
	"class" => "dt_vc_sc_blog_posts",
	"category" => __('by Dream-Theme', 'the7mk2'),
	"params" => array(

		array(
			"type" => "dt_taxonomy",
			"taxonomy" => "category",
			"class" => "",
			"admin_label" => true,
			"heading" => __("Categories", 'the7mk2'),
			"param_name" => "category",
			"description" => __("Note: By default, all your posts will be displayed. <br>If you want to narrow output, select category(s) above. Only selected categories will be displayed.", 'the7mk2')
		),

		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Thumbnails height", 'the7mk2'),
			"param_name" => "height",
			"value" => "210",
			"description" => __("In pixels.", 'the7mk2')
		),

		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Thumbnails width", 'the7mk2'),
			"param_name" => "width",
			"value" => "",
			"description" => __("In pixels. Leave this field empty if you want to preserve original thumbnails proportions.", 'the7mk2')
		),

		// Gap
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Gap between images (px)", 'the7mk2'),
			"description" => '',
			"param_name" => "padding",
			"value" => "20"
		),

		// Arrows
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Arrows", 'the7mk2'),
			"param_name" => "arrows",
			"value" => array(
				'light' => 'light',
				'dark' => 'dark',
				'rectangular accent' => 'rectangular_accent',
				'disabled' => 'disabled'
			)
		),

		// Image hover background color
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Image hover background color", 'the7mk2'),
			"param_name" => "hover_bg_color",
			"value" => array(
				'Color (from Theme Options)' => 'accent',
				'Dark' => 'dark'
			)
		),

		// Background under projects
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Background under projects", 'the7mk2'),
			"param_name" => "bg_under_posts",
			"value" => array(
				'Enabled (image with paddings)' => 'with_paddings',
				'Enabled (image without paddings)' => 'fullwidth',
				'Disabled' => 'disabled'
			)
		),

		// Content alignment
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Content alignment", 'the7mk2'),
			"param_name" => "content_aligment",
			"value" => array(
				'Left' => 'left',
				'Centre' => 'center'
			)
		),

		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Show excerpt", 'the7mk2'),
			"param_name" => "show_excerpt",
			"value" => array(
				"" => "true",
			),
			"description" => ""
		),

		// Show categories
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Show post categories", 'the7mk2'),
			"param_name" => "show_categories",
			"value" => array(
				"" => "true",
			),
			"description" => ""
		),

		// Show date
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Show post date", 'the7mk2'),
			"param_name" => "show_date",
			"value" => array(
				"" => "true",
			),
			"description" => ""
		),

		// Show author
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Show post author", 'the7mk2'),
			"param_name" => "show_author",
			"value" => array(
				"" => "true",
			),
			"description" => ""
		),

		// Show comments
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Show post comments", 'the7mk2'),
			"param_name" => "show_comments",
			"value" => array(
				"" => "true",
			),
			"description" => ""
		),

		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Number of posts to show", 'the7mk2'),
			"param_name" => "number",
			"value" => "12",
			"description" => ""
		),

		// Autoslide interval
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Autoslide interval (in milliseconds)", 'the7mk2'),
			"description" => "",
			"param_name" => "autoslide",
			"value" => ""
		),

		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Loop", 'the7mk2'),
			"param_name" => "loop",
			"value" => array(
				"" => "true",
			),
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
		)

	)
) );

/**
 * DT Gap.
 */

vc_map( array(
	"weight" => -1,
	"name" => __("Gap", 'the7mk2'),
	"base" => "dt_gap",
	"deprecated" => '4.6',
	"icon" => "dt_vc_ico_gap",
	"class" => "dt_vc_sc_gap",
	"category" => __('by Dream-Theme', 'the7mk2'),
	"params" => array(
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Gap height", 'the7mk2'),
			"admin_label" => true,
			"param_name" => "height",
			"value" => "10",
			"description" => __("In pixels.", 'the7mk2')
		)
	)
) );

/**
 * DT Fancy Media.
 */

vc_map( array(
	"weight" => -1,
	"name" => __("Fancy Media", 'the7mk2'),
	"base" => "dt_fancy_image",
	"icon" => "dt_vc_ico_fancy_image",
	"class" => "dt_vc_sc_fancy_image",
	"category" => __('by Dream-Theme', 'the7mk2'),
	"params" => array(
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Type", 'the7mk2'),
			"param_name" => "type",
			"value" => array(
				"Uploaded media" => "uploaded_image",
				"Media from url" => "from_url"
			),
			"description" => ""
		),
		array(
			"type" => "attach_image",
			"holder" => "img",
			"class" => "dt_image",
			"heading" => __("Choose image", 'the7mk2'),
			"param_name" => "image_id",
			"value" => "",
			"description" => "",
			"dependency" => array(
				"element" => "type",
				"value" => array(
					"uploaded_image"
				)
			)
		),
		//Only for "image" and "video_in_lightbox"
		array(
			"type" => "textfield",
			"class" => "dt_image",
			"heading" => __("Image URL", 'the7mk2'),
			"param_name" => "image",
			"value" => "",
			"description" => "",
			"dependency" => array(
				"element" => "type",
				"value" => array(
					"from_url"
				)
			)
		),
		array(
			"type" => "textfield",
			"class" => "dt_image",
			"heading" => __("Image size", 'the7mk2'),
			"description" => __("Enter image size in pixels. Example: 200x100 (Width x Height).", 'the7mk2'),
			"param_name" => "image_dimensions",
			"value" => "",
			"dependency" => array(
				"element" => "type",
				"value" => array(
					"from_url"
				)
			)
		),
		//Only for "image" and "video_in_lightbox"
		array(
			"type" => "textfield",
			"class" => "dt_image",
			"heading" => __("Image ALT", 'the7mk2'),
			"param_name" => "image_alt",
			"value" => "",
			"dependency" => array(
				"element" => "type",
				"value" => array(
					"from_url"
				)
			)
		),
		//Only for "video" and "video_in_lightbox"
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Video URL", 'the7mk2'),
			"admin_label" => true,
			"param_name" => "media",
			"value" => "",
			"description" => "",
			"dependency" => array(
				"element" => "type",
				"value" => array(
					"from_url"
				)
			)
		),
		//Only for "image"
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Open in lighbox", 'the7mk2'),
			"param_name" => "lightbox",
			"value" => array(
				"" => "true"
			),
			"description" => __("If selected, larger image will be opened on click.", 'the7mk2')
		),

		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Image hovers", 'the7mk2'),
			"param_name" => "image_hovers",
			"std" => "true",
			"value" => array(
				"Disabled" => "false",
				"Enabled" => "true"
			),
			"dependency" => array(
				"element" => "lightbox",
				"value" => array(
					"true"
				)
			)
		),

		array(
			"type" => "dropdown",
			"heading" => __("Style", 'the7mk2'),
			"param_name" => "style",
			"value" => array(
				"Full-width media" => "1",
				"Media with padding & outline" => "2",
				"Media with padding & background fill" => "3"
			),
			"edit_field_class" => "vc_col-xs-12 vc_column dt-force-hidden",
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Width", 'the7mk2'),
			"param_name" => "width",
			"value" => "270",
			"description" => __("In pixels.", 'the7mk2')
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Height", 'the7mk2'),
			"param_name" => "height",
			"value" => "",
			"description" => __("In pixels. Will be calculated automatically if empty.", 'the7mk2'),
			"dependency" => array(
				"element" => "type",
				"value" => array(
					"uploaded_image"
				),
			)
		),
		array(
			"type" => "textfield",
			"heading" => __("Padding", 'the7mk2'),
			"param_name" => "padding",
			"value" => "",
			"description" => __("In pixels.", 'the7mk2'),
			"dependency" => array(
				"element" => "style",
				"value" => array(
					"2",
					"3"
				),
			),
			"edit_field_class" => "vc_col-xs-12 vc_column dt-force-hidden",
		),
		array(
			"type" => "textfield",
			"heading" => __("Margin-top", 'the7mk2'),
			"param_name" => "margin_top",
			"value" => "",
			"description" => __("In pixels.", 'the7mk2'),
			"edit_field_class" => "vc_col-xs-12 vc_column dt-force-hidden",
		),
		array(
			"type" => "textfield",
			"heading" => __("Margin-bottom", 'the7mk2'),
			"param_name" => "margin_bottom",
			"value" => "",
			"description" => __("In pixels.", 'the7mk2'),
			"edit_field_class" => "vc_col-xs-12 vc_column dt-force-hidden",
		),
		array(
			"type" => "textfield",
			"heading" => __("Margin-left", 'the7mk2'),
			"param_name" => "margin_left",
			"value" => "",
			"description" => __("In pixels.", 'the7mk2'),
			"edit_field_class" => "vc_col-xs-12 vc_column dt-force-hidden",
		),
		array(
			"type" => "textfield",
			"heading" => __("Margin-right", 'the7mk2'),
			"param_name" => "margin_right",
			"value" => "",
			"description" => __("In pixels.", 'the7mk2'),
			"edit_field_class" => "vc_col-xs-12 vc_column dt-force-hidden",
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Align", 'the7mk2'),
			"param_name" => "align",
			"value" => array(
				"Left" => "left",
				"Center" => "center",
				"Right" => "right"
			),
			"description" => ""
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
			'type' => 'css_editor',
			'heading' => __( 'CSS box', 'the7mk2' ),
			'param_name' => 'css',
			'group' => __( 'Design Options', 'the7mk2' )
		),
	)
) );

/**
 * DT Button.
 */

vc_map( array(
	"weight" => -1,
	"name" => __("Button", 'the7mk2'),
	"base" => "dt_button",
	"icon" => "dt_vc_ico_button",
	"class" => "dt_vc_sc_button",
	"category" => __('by Dream-Theme', 'the7mk2'),
	"params" => array(

		// Extra class name
		array(
			"type" => "textfield",
			"heading" => __("Extra class name", 'the7mk2'),
			"param_name" => "el_class",
			"value" => "",
			"description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'the7mk2')
		),

		// Caption
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Caption", 'the7mk2'),
			"admin_label" => true,
			"param_name" => "content",
			"value" => ""
		),

		// Link Url
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Link URL", 'the7mk2'),
			"param_name" => "link",
			"value" => ""
		),

		// Open link in
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Open link in", 'the7mk2'),
			"param_name" => "target_blank",
			"value" => array(
				"Same window" => "false",
				"New window" => "true"
			)
		),

		// Smooth scroll
		array(
			'type' => 'checkbox',
			'heading' => __( 'Smooth scroll?', 'the7mk2' ),
			'param_name' => 'smooth_scroll',
			'description' => __( 'for #anchor navigation', 'the7mk2' )
		),

		// Align
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Button alignment", 'the7mk2'),
			"param_name" => "button_alignment",
			"value" => array(
				"Default" => "default",
				"Centre" => "center",
			),
		),

		// Animation
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Animation", 'the7mk2'),
			"param_name" => "animation",
			"value" => presscore_get_vc_animation_options()
		),

		// Size
		array(
			"group" => __("Style", 'the7mk2'),
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Size", 'the7mk2'),
			"param_name" => "size",
			"value" => array(
				"Small" => "small",
				"Medium" => "medium",
				"Large" => "big"
			),
		),

		// Style
		array(
			"group"			=> __("Style", 'the7mk2'),
			"type"			=> "dropdown",
			"class"			=> "",
			"heading"		=> __("Style", 'the7mk2'),
			"param_name"	=> "style",
			"value"			=> array(
				"Default (from Theme Options / Buttons)"	=> "default",
				"Link"										=> "link",
				"Light"										=> "light",
				"Light with background on hover"			=> "light_with_bg",
				"Outline"									=> "outline",
				"Outline with background on hover"			=> "outline_with_bg",
			)
		),

		// Button background color style
		array(
			"group"			=> __("Style", 'the7mk2'),
			"type"			=> "dropdown",
			"class"			=> "",
			"heading"		=> __("Background (border) color", 'the7mk2'),
			"param_name"	=> "bg_color_style",
			"value"			=> array(
				"Default (from Theme Options / Buttons)"	=> "default",
				"Accent"									=> "accent",
				"Custom"									=> "custom"
			),
			"dependency"	=> array(
				"element"	=> "style",
				"value"		=> array(
					'default',
					'outline',
					'outline_with_bg'
				)
			),
		),

		// Button background color
		array(
			"group"			=> __("Style", 'the7mk2'),
			"type"			=> "colorpicker",
			"class"			=> "",
			"heading"		=> __("Custom background color", 'the7mk2'),
			"param_name"	=> "bg_color",
			"value"			=> '#888888',
			"dependency"	=> array(
				"element"	=> "bg_color_style",
				"value"		=> array( "custom" )
			),
		),

		// Button hover background color style
		array(
			"group"			=> __("Style", 'the7mk2'),
			"type"			=> "dropdown",
			"class"			=> "",
			"heading"		=> __("Background (border) hover color", 'the7mk2'),
			"param_name"	=> "bg_hover_color_style",
			"value"			=> array(
				"Default (from Theme Options / Buttons)"	=> "default",
				"Accent"									=> "accent",
				"Custom"									=> "custom"
			),
			"dependency"	=> array(
				"element"	=> "style",
				"value"		=> array(
					'default',
					'light_with_bg',
					'outline',
					'outline_with_bg'
				)
			),
		),

		// Button hover background color
		array(
			"group"			=> __("Style", 'the7mk2'),
			"type"			=> "colorpicker",
			"class"			=> "",
			"heading"		=> __("Custom background hover color", 'the7mk2'),
			"param_name"	=> "bg_hover_color",
			"value"			=> '#888888',
			"dependency"	=> array(
				"element"	=> "bg_hover_color_style",
				"value"		=> array( "custom" )
			),
		),

		// Button text color style
		array(
			"group"			=> __("Style", 'the7mk2'),
			"type"			=> "dropdown",
			"class"			=> "",
			"heading"		=> __("Text color", 'the7mk2'),
			"param_name"	=> "text_color_style",
			"value"			=> array(
				"Default (from Theme Options / Buttons)"	=> "default",
				"Title"										=> "context",
				"Accent"									=> "accent",
				"Custom"									=> "custom"
			)
		),

		// Button text color
		array(
			"group"			=> __("Style", 'the7mk2'),
			"type"			=> "colorpicker",
			"class"			=> "",
			"heading"		=> __("Custom text color", 'the7mk2'),
			"param_name"	=> "text_color",
			"value"			=> '#888888',
			"dependency"	=> array(
				"element"	=> "text_color_style",
				"value"		=> array( "custom" )
			),
		),

		// Button hover text color style
		array(
			"group"			=> __("Style", 'the7mk2'),
			"type"			=> "dropdown",
			"class"			=> "",
			"heading"		=> __("Text hover color", 'the7mk2'),
			"param_name"	=> "text_hover_color_style",
			"value"			=> array(
				"Default (from Theme Options / Buttons)"	=> "default",
				"Title"										=> "context",
				"Accent"									=> "accent",
				"Custom"									=> "custom"
			)
		),

		// Button hover text color
		array(
			"group"			=> __("Style", 'the7mk2'),
			"type"			=> "colorpicker",
			"class"			=> "",
			"heading"		=> __("Custom text hover color", 'the7mk2'),
			"param_name"	=> "text_hover_color",
			"value"			=> '#888888',
			"dependency"	=> array(
				"element"	=> "text_hover_color_style",
				"value"		=> array( "custom" )
			),
		),

		// Icon
		array(
			"group" => __("Icon", 'the7mk2'),
			"type" => "textarea_raw_html",
			"class" => "",
			"heading" => __("Icon", 'the7mk2'),
			"param_name" => "icon",
			"value" => '',
			"description" => __('f.e. <code>&lt;i class="fa fa-coffee"&gt;&lt;/i&gt;</code>', 'the7mk2'),
		),

		// Icon align
		array(
			"group" => __("Icon", 'the7mk2'),
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Icon align", 'the7mk2'),
			"param_name" => "icon_align",
			"value" => array(
				"Left" => "left",
				"Right" => "right"
			)
		),
	)
) );

/**
 * DT Fancy List.
 */

vc_map( array(
	"weight" => -1,
	"name" => __("Fancy List", 'the7mk2'),
	"base" => "dt_vc_list",
	"icon" => "dt_vc_ico_list",
	"class" => "dt_vc_sc_list",
	"category" => __('by Dream-Theme', 'the7mk2'),
	"params" => array(
		array(
			"type" => "textarea_html",
			"holder" => "div",
			"class" => "",
			"heading" => __("Caption", 'the7mk2'),
			"param_name" => "content",
			"value" => __("<ul><li>Your list</li><li>goes</li><li>here!</li></ul>", 'the7mk2'),
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("List style", 'the7mk2'),
			"param_name" => "style",
			"value" => array(
				"Unordered" => "1",
				"Ordered (numbers)" => "2",
				"No bullets" => "3"
			),
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Bullet position", 'the7mk2'),
			"param_name" => "bullet_position",
			"value" => array(
				"Top" => "top",
				"Middle" => "middle"
			),
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Dividers", 'the7mk2'),
			"param_name" => "dividers",
			"value" => array(
				"Show" => "true",
				"Hide" => "false"
			),
			"description" => ""
		)
	)
) );

/**
 * DT Before / After.
 */

vc_map( array(
	"weight" => -1,
	'name' => __( 'Before / After', 'the7mk2' ),
	'base' => 'dt_before_after',
	'class' => 'dt_vc_sc_before_after',
	'icon' => 'dt_vc_ico_before_after',
	'category' => __( 'by Dream-Theme', 'the7mk2' ),
	'description' => "",
	'params' => array(

		array(
			"type" => "attach_image",
			"holder" => "img",
			"class" => "dt_image",
			"heading" => __("Choose first image", 'the7mk2'),
			"param_name" => "image_1",
			"value" => "",
			"description" => ""
		),

		array(
			"type" => "attach_image",
			"holder" => "img",
			"class" => "dt_image",
			"heading" => __("Choose second image", 'the7mk2'),
			"param_name" => "image_2",
			"value" => "",
			"description" => ""
		),

		array(
			"type" => "dropdown",
			"class" => "",
			"holder" => "div",
			"heading" => __("Orientation", 'the7mk2'),
			"param_name" => "orientation",
			"value" => array(
				"Vertical" => "horizontal",
				"Horizontal" => "vertical"
			),
			"description" => ""
		),

		array(
			"type" => "dropdown",
			"class" => "",
			"holder" => "div",
			"heading" => __("Navigation", 'the7mk2'),
			"param_name" => "navigation",
			"value" => array(
				"Click and drag" => "drag",
				"Follow" => "move"
			),
			"description" => ""
		),

		array(
			'type' => 'textfield',
			"holder" => "div",
			'heading' => __( 'Visible part of the "Before" image (in %)', 'the7mk2' ),
			'param_name' => 'offset',
			'std' => '50',
			'description' => "",
		),

	)
) );
