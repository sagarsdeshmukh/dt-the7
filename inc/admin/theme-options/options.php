<?php

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the "id" fields, make sure to use all lowercase and no spaces.
 *  
 */

$repeat_arr = array(
	'repeat'    => _x( 'repeat', 'backend options', 'the7mk2' ),
	'repeat-x'  => _x( 'repeat-x', 'backend options', 'the7mk2' ),
	'repeat-y'  => _x( 'repeat-y', 'backend options', 'the7mk2' ),
	'no-repeat' => _x( 'no-repeat', 'backend options', 'the7mk2' )
);

$repeat_x_arr = array(
	'no-repeat' => _x( 'no-repeat', 'backend options', 'the7mk2' ),
	'repeat-x'  => _x( 'repeat-x', 'backend options', 'the7mk2' )
);

$y_position_arr = array(
	'center'    => _x( 'center', 'backend options', 'the7mk2' ),
	'top'       => _x( 'top', 'backend options', 'the7mk2' ),
	'bottom'    => _x( 'bottom', 'backend options', 'the7mk2' )
);

$x_position_arr = array(
	'center'    => _x( 'center', 'backend options', 'the7mk2' ),
	'left'      => _x( 'left', 'backend options', 'the7mk2' ),
	'right'     => _x( 'right', 'backend options', 'the7mk2' )
);

$colour_arr = array(
	'blue'      => _x( 'blue', 'backend options', 'the7mk2' ),
	'green'     => _x( 'green', 'backend options', 'the7mk2' ),
	'orange'    => _x( 'orange', 'backend options', 'the7mk2' ),
	'purple'    => _x( 'purple', 'backend options', 'the7mk2' ),
	'yellow'    => _x( 'yellow', 'backend options', 'the7mk2' ),
	'pink'      => _x( 'pink', 'backend options', 'the7mk2' ),
	'white'     => _x( 'white', 'backend options', 'the7mk2' )
);

$footer_arr = array(
	'every'     => _x( 'on every page', 'backend options', 'the7mk2' ),
	'home'      => _x( 'front page only', 'backend options', 'the7mk2' ),
	'ex_home'   => _x( 'everywhere except front page', 'backend options', 'the7mk2' ),
	'nowhere'   => _x( 'nowhere', 'backend options', 'the7mk2' )
);

$homepage_arr = array(
	'every'     => _x( 'everywhere', 'backend options', 'the7mk2' ),
	'home'      => _x( 'only on homepage templates', 'backend options', 'the7mk2' ),
	'ex_home'   => _x( 'everywhere except homepage templates', 'backend options', 'the7mk2' ),
	'nowhere'   => _x( 'nowhere', 'backend options', 'the7mk2' )
);

$image_hovers = array(
	'slice'     => _x( 'slice', 'backend options', 'the7mk2' ),
	'fade'      => _x( 'fade', 'backend options', 'the7mk2' )
);

// contact fields

$soc_ico_arr = array(
	'skype'	=> array(
		'img'	=> '\'\'',
		'desc'	=> 'Skype'
	),
	'working_hours'	=> array(
		'img'	=> '\'\'',
		'desc'	=> 'Working hours'
	),
	'additional_info'	=> array(
		'img'	=> '\'\'',
		'desc'	=> 'Additional info'
	)
);

// Background Defaults
$background_defaults = array(
	'image' 		=> '',
	'repeat' 		=> 'repeat',
	'position_x' 	=> 'center',
	'position_y'	=> 'center'
);

// Radio enabled/disabled
$en_dis_options = array(
	'1' => _x('Enabled', 'theme-options', 'the7mk2'),
	'0' => _x('Disabled', 'theme-options', 'the7mk2')
);

// Radio yes/no
$yes_no_options = array(
	'1'	=> _x('Yes', 'theme-options', 'the7mk2'),
	'0'	=> _x('No', 'theme-options', 'the7mk2'),
);

// Radio on/off
$on_off_options = array(
	'1'	=> _x('On', 'theme-options', 'the7mk2'),
	'0'	=> _x('Off', 'theme-options', 'the7mk2'),
);

// Radio Show/Hide
$show_hide_options = array(
	'show'	=> _x('Show', 'theme-options', 'the7mk2'),
	'hide'	=> _x('Hide', 'theme-options', 'the7mk2'),
);

// Radio proportional images/fixed width
$prop_fixed_options = array(
	'prop'	=> _x('Proportional images', 'theme-options', 'the7mk2'),
	'fixed'	=> _x('Fixed width', 'theme-options', 'the7mk2'),
);


// used in:
//	menu first level background
$background_dis_line_solid_mode = array(
	"disabled" => _x( 'Disabled', 'theme-options', 'the7mk2' ),
	"content_line" => _x( 'Content-width line', 'theme-options', 'the7mk2' ),
	"fullwidth_line" => _x( 'Full-width line', 'theme-options', 'the7mk2' ),
	"solid" => _x( 'Solid background', 'theme-options', 'the7mk2' ),
);

// used in:
// social buttons
$background_dis_acc_col_grad_mode = array(
	"disabled"	=> _x( 'Disabled', 'theme-options', 'the7mk2' ),
	"accent"	=> _x( 'Accent', 'theme-options', 'the7mk2' ),
	"color"		=> _x( 'Custom color', 'theme-options', 'the7mk2' ),
	"gradient"	=> _x( 'Custom gradient', 'theme-options', 'the7mk2' ),
	"outline"	=> _x( 'Custom color outline', 'theme-options', 'the7mk2' ),
);

$background_acc_col_grad_mode = array_diff_key( $background_dis_acc_col_grad_mode, array( 'disabled' => '', 'outline' => '' ) );
$color_mode_acc_col = array_diff_key( $background_dis_acc_col_grad_mode, array( 'disabled' => '', 'gradient' => '', 'outline' => '' ) );

$background_dis_line_solid_mode_dependency = array( "content_line" => true, "fullwidth_line" => true, "solid" => true );

// header layout
$header_layout_info_title = _x('Available areas:', 'theme-options', 'the7mk2');
$header_layout_palette_title = _x('Inactive elements', 'theme-options', 'the7mk2');

$header_layout_fields = array(
	'top' => array( 'title' => _x('Top', 'theme-options', 'the7mk2'), 'class' => 'field-red' ),
	'bottom' => array( 'title' => _x('Bottom', 'theme-options', 'the7mk2'), 'class' => 'field-blue' ),

	'top_bar_left' => array( 'title' => _x('Top bar (left)', 'theme-options', 'the7mk2'), 'class' => 'field-red' ),
	'top_bar_right' => array( 'title' => _x('Top bar (right)', 'theme-options', 'the7mk2'), 'class' => 'field-green' ),

	'logo_area' => array( 'title' => _x('Near logo', 'theme-options', 'the7mk2'), 'class' => 'field-purple' ),
	'nav_area' => array( 'title' => _x('Near navigation area', 'theme-options', 'the7mk2'), 'class' => 'field-blue' )
);

$header_layout_elements = array(
	'social_icons' => array( 'title' => _x('Social icons', 'theme-options', 'the7mk2'), 'class' => '' ),
	'search' => array( 'title' => _x('Search', 'theme-options', 'the7mk2'), 'class' => '' ),
	'cart' => array( 'title' => _x('Cart', 'theme-options', 'the7mk2'), 'class' => '' ),
	'custom_menu' => array( 'title' => _x('Custom menu', 'theme-options', 'the7mk2'), 'class' => '' ),
	'login' => array( 'title' => _x('Login', 'theme-options', 'the7mk2'), 'class' => '' ),
	'text_area' => array( 'title' => _x('Text area', 'theme-options', 'the7mk2'), 'class' => '' ),
	'skype' => array( 'title' => _x('Skype', 'theme-options', 'the7mk2'), 'class' => '' ),
	'email' => array( 'title' => _x('Mail', 'theme-options', 'the7mk2'), 'class' => '' ),
	'address' => array( 'title' => _x('Address', 'theme-options', 'the7mk2'), 'class' => '' ),
	'phone' => array( 'title' => _x('Phone', 'theme-options', 'the7mk2'), 'class' => '' ),
	'working_hours' => array( 'title' => _x('Working hours', 'theme-options', 'the7mk2'), 'class' => '' )
);

$header_layout_elements = apply_filters( 'header_layout_elements', $header_layout_elements );

$font_sizes = array(
	"big" => _x( 'large', 'theme-options', 'the7mk2' ),
	"normal" => _x( 'medium', 'theme-options', 'the7mk2' ),
	"small" => _x( 'small', 'theme-options', 'the7mk2' )
);
