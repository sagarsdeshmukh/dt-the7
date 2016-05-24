<?php
/**
 * Meta box templates
 *
 * @package the7
 * @since 4.2.1
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

// Load meta box fields template class
if ( !class_exists( 'Presscore_Meta_Box_Field_Template', false ) ) {
	require_once PRESSCORE_CLASSES_DIR . '/presscore-meta-box-field-template.class.php';
}

////////////////////
// Base templates //
////////////////////

// yes no field values
Presscore_Meta_Box_Field_Template::add( 'yes no values', array(
	'1'	=> _x( 'Yes', 'backend metabox', 'the7mk2' ),
	'0' => _x( 'No', 'backend metabox', 'the7mk2' )
) );

// enabled disabled field values
Presscore_Meta_Box_Field_Template::add( 'enabled disabled values', array(
	'1'	=> _x( 'Enabled', 'backend metabox', 'the7mk2' ),
	'0' => _x( 'Disabled', 'backend metabox', 'the7mk2' )
) );

// image sizing
Presscore_Meta_Box_Field_Template::add( 'image sizing values', array(
	'original'	=> _x( 'preserve images proportions', 'backend metabox', 'the7mk2' ),
	'resize'	=> _x( 'resize images', 'backend metabox', 'the7mk2' ),
	'round'		=> _x( 'make images round', 'backend metabox', 'the7mk2' )
) );

// description style field values
Presscore_Meta_Box_Field_Template::add( 'description style values', array(
	'under_image'			=> array( _x( 'Under image', 'backend metabox', 'the7mk2' ), array( 'rollover-under.gif', 60, 40 ) ),
	'on_hoover_centered'	=> array( _x( 'Background', 'backend metabox', 'the7mk2' ), array( 'rollover-on-bg.gif', 60, 40 ) ),
	'on_dark_gradient'		=> array( _x( 'Dark gradient', 'backend metabox', 'the7mk2' ), array( 'rollover-on-grad.gif', 60, 40 ) ),
	'from_bottom'			=> array( _x( 'In the bottom', 'backend metabox', 'the7mk2' ), array( 'rollover-bottom.gif', 60, 40 ) ),
	'bg_with_lines'			=> array( _x( 'Background & animated lines', 'backend metabox', 'the7mk2' ), array( 'rollover-lines.gif', 60, 40 ) ),
	'disabled'				=> array( _x( 'Disabled', 'backend metabox', 'the7mk2' ), array( 'admin-text-hover-disabled.png', 75, 50 ) )
) );

// list layout values
Presscore_Meta_Box_Field_Template::add( 'list layout values', array(
	'list'			=> array( _x( 'Left-aligned image', 'backend metabox', 'the7mk2' ), array( 'list-left.gif', 60, 69 ) ),
	'right_list'	=> array( _x( 'Right-aligned image', 'backend metabox', 'the7mk2' ), array( 'list-right.gif', 60, 69 ) ),
	'checkerboard'	=> array( _x( 'Checkerboard order', 'backend metabox', 'the7mk2' ), array( 'list-checker.gif', 60, 69 ) )
) );

// loading effect values
Presscore_Meta_Box_Field_Template::add( 'loading effect values', array(
	'none'				=> _x( 'None', 'backend metabox', 'the7mk2' ),
	'fade_in'			=> _x( 'Fade in', 'backend metabox', 'the7mk2' ),
	'move_up'			=> _x( 'Move up', 'backend metabox', 'the7mk2' ),
	'scale_up'			=> _x( 'Scale up', 'backend metabox', 'the7mk2' ),
	'fall_perspective'	=> _x( 'Fall perspective', 'backend metabox', 'the7mk2' ),
	'fly'				=> _x( 'Fly', 'backend metabox', 'the7mk2' ),
	'flip'				=> _x( 'Flip', 'backend metabox', 'the7mk2' ),
	'helix'				=> _x( 'Helix', 'backend metabox', 'the7mk2' ),
	'scale'				=> _x( 'Scale', 'backend metabox', 'the7mk2' )
) );

///////////////////////
// Complex templates //
///////////////////////

// add list layout
Presscore_Meta_Box_Field_Template::add( 'list layout', array(
	'name'		=> _x( 'Layout:', 'backend metabox', 'the7mk2' ),
	'type'		=> 'radio',
	'std'		=> 'list',
	'options'	=> Presscore_Meta_Box_Field_Template::get( 'list layout values' )
) );

// add masonty layout
Presscore_Meta_Box_Field_Template::add( 'masonry layout', array(
	'name'    	=> _x( 'Layout:', 'backend metabox', 'the7mk2' ),
	'type'    	=> 'radio',
	'std'		=> 'masonry',
	'divider'	=> 'bottom',
	'options'	=> array(
		'masonry'	=> array( _x( 'Masonry', 'backend metabox', 'the7mk2' ), array( 'masonry-layout.gif', 60, 58 ) ),
		'grid'		=> array( _x( 'Grid', 'backend metabox', 'the7mk2' ), array( 'grid-layout.gif', 60, 58 ) )
	)
) );

// add gap between images
Presscore_Meta_Box_Field_Template::add( 'gap between images', array(
	'name'		=> _x( 'Gap between images (px):', 'backend metabox', 'the7mk2' ),
	'type'  	=> 'text',
	'std'   	=> '20',
	'desc' 		=> _x( 'Image paddings (e.g. 5 pixel padding will give you 10 pixel gaps between images)', 'backend metabox', 'the7mk2' )
) );

// add row target height
Presscore_Meta_Box_Field_Template::add( 'row target height', array(
	'name'		=> _x( 'Row target height (px):', 'backend metabox', 'the7mk2' ),
	'type'  	=> 'text',
	'std'   	=> '250',
	'divider'	=> 'top'
) );

// column target width
Presscore_Meta_Box_Field_Template::add( 'column target width', array(
	'name'		=> _x( 'Column minimum width (px):', 'backend metabox', 'the7mk2' ),
	'desc'		=> _x( 'Real column width will slightly vary depending on site visitor screen width', 'backend metabox', 'the7mk2' ),
	'type'  	=> 'text',
	'std'   	=> '370',
	'divider'	=> 'top'
) );

// columns number
Presscore_Meta_Box_Field_Template::add( 'columns number', array(
	'name'		=> _x( 'Desired columns number:', 'backend metabox', 'the7mk2' ),
	'type'  	=> 'text',
	'std'   	=> '3',
	'divider'	=> 'top'
) );

// 100 percent width
Presscore_Meta_Box_Field_Template::add( '100 percent width', array(
	'name'    	=> _x( '100% width:', 'backend metabox', 'the7mk2' ),
	'type'    	=> 'checkbox',
	'std'		=> 0,
	'divider'	=> 'top'
) );

// show image miniatures
Presscore_Meta_Box_Field_Template::add( 'image miniatures', array(
	'name'    	=> _x( 'Show image miniatures:', 'backend metabox', 'the7mk2' ),
	'type'    	=> 'radio',
	'std'		=> 1,
	'options'	=> Presscore_Meta_Box_Field_Template::get( 'yes no values' )
) );

// opacity slider
Presscore_Meta_Box_Field_Template::add( 'opacity slider', array(
	'type'			=> 'slider',
	'std'			=> '100',
	'js_options'	=> array(
		'min'	=> 0,
		'max'	=> 100,
		'step'	=> 1,
	)
) );

// description style
Presscore_Meta_Box_Field_Template::add( 'description style', array(
	'type'    	=> 'radio',
	'std'		=> 'under_image',
	// all except 'disabled'
	'options'	=> array_diff_key( Presscore_Meta_Box_Field_Template::get( 'description style values' ), array( 'disabled' => '' ) ),
	'divider'	=> 'top'
) );

// photo description style
Presscore_Meta_Box_Field_Template::add( 'photo description style', array(
	'type'    	=> 'radio',
	'std'		=> 'under_image',
	// all
	'options'	=> Presscore_Meta_Box_Field_Template::get( 'description style values' ),
	'divider'	=> 'top'
) );

// jgrid description style
Presscore_Meta_Box_Field_Template::add( 'jgrid description style', array(
	'type'    	=> 'radio',
	'std'		=> 'on_hoover_centered',
	// all except 'under_image' and 'disabled'
	'options'	=> array_diff_key( Presscore_Meta_Box_Field_Template::get( 'description style values' ), array( 'under_image' => '', 'disabled' => '' ) ),
	'divider'	=> 'top'
) );

// photo jgrid description style
Presscore_Meta_Box_Field_Template::add( 'photo jgrid description style', array(
	'type'    	=> 'radio',
	'std'		=> 'on_hoover_centered',
	// all except 'under_image'
	'options'	=> array_diff_key( Presscore_Meta_Box_Field_Template::get( 'description style values' ), array( 'under_image' => '' ) ),
	'divider'	=> 'top'
) );

// hover animation
Presscore_Meta_Box_Field_Template::add( 'hover animation', array(
	'name'    	=> _x( 'Animation:', 'backend metabox', 'the7mk2' ),
	'type'    	=> 'radio',
	'std'		=> 'fade',
	'divider'	=> 'top',
	'options'	=> array(
		'fade'				=> _x( 'Fade', 'backend metabox', 'the7mk2' ),
		'direction_aware'	=> _x( 'Direction aware', 'backend metabox', 'the7mk2' ),
		'redirection_aware'	=> _x( 'Reverse direction aware', 'backend metabox', 'the7mk2' ),
		'scale_in'			=> _x( 'Scale In', 'backend metabox', 'the7mk2' ),
	)
) );

// hover lines animation
Presscore_Meta_Box_Field_Template::add( 'hover lines animation', array(
	'name'    	=> _x( 'Animation effect:', 'backend metabox', 'the7mk2' ),
	'type'    	=> 'radio',
	'std'		=> '1',
	'divider'	=> 'top',
	'options'	=> array(
		'1'	=> _x( 'Effect 1', 'backend metabox', 'the7mk2' ),
		'2'	=> _x( 'Effect 2', 'backend metabox', 'the7mk2' ),
		'3'	=> _x( 'Effect 3', 'backend metabox', 'the7mk2' )
	)
) );

// hover background color
Presscore_Meta_Box_Field_Template::add( 'hover background color', array(
	'name'    	=> _x( 'Background color:', 'backend metabox', 'the7mk2' ),
	'type'    	=> 'radio',
	'std'		=> 'theme',
	'divider'	=> 'top',
	'options'	=> array(
		'dark'		=> _x( 'Dark', 'backend metabox', 'the7mk2' ),
		'theme'		=> _x( 'From theme options', 'backend metabox', 'the7mk2' )
	)
) );

// background under post preview
Presscore_Meta_Box_Field_Template::add( 'background under post', array(
	'type'		=> 'radio',
	'std'		=> 1,
	'divider'	=> 'top',
	'options'	=> Presscore_Meta_Box_Field_Template::get( 'enabled disabled values' )
) );

// background under masonry post preview
Presscore_Meta_Box_Field_Template::add( 'background under masonry post', array(
	'type'		=> 'radio',
	'std'		=> 'disabled',
	'divider'	=> 'top',
	'options'	=> array(
		'with_paddings' => _x( 'Enabled (image with paddings)', 'backend metabox', 'the7mk2' ),
		'fullwidth'		=> _x( 'Enabled (image without paddings)', 'backend metabox', 'the7mk2' ),
		'disabled'		=> _x( 'Disabled', 'backend metabox', 'the7mk2' )
	)
) );

// style for background under post preview
Presscore_Meta_Box_Field_Template::add( 'background under post style', array(
	'type'			=> 'info',
	'value'			=> 'Deprecated "background under post style"'
) );

// content alignment
Presscore_Meta_Box_Field_Template::add( 'content alignment', array(
	'name'		=> _x( 'Content alignment:', 'backend metabox', 'the7mk2' ),
	'type'		=> 'radio',
	'std'		=> 'left',
	'divider'	=> 'top',
	'options'	=> array(
		'left'		=> _x( 'Left', 'backend metabox', 'the7mk2' ),
		'center'	=> _x( 'Centre', 'backend metabox', 'the7mk2' )
	)
) );

// vertical left content alignment
Presscore_Meta_Box_Field_Template::add( 'vertical left content alignment', array(
	'name'		=> _x( 'Content alignment:', 'backend metabox', 'the7mk2' ),
	'type'		=> 'radio',
	'std'		=> 'center',
	'divider'	=> 'top',
	'options'	=> array(
		'center'		=> _x( 'Centre', 'backend metabox', 'the7mk2' ),
		'bottom'		=> _x( 'Bottom', 'backend metabox', 'the7mk2' ),
		'left_top'		=> _x( 'Left & top', 'backend metabox', 'the7mk2' ),
		'left_bottom'	=> _x( 'Left & bottom', 'backend metabox', 'the7mk2' )
	)
) );

// hover content
Presscore_Meta_Box_Field_Template::add( 'hover content visibility', array(
	'name'    	=> _x( 'Content:', 'backend metabox', 'the7mk2' ),
	'type'    	=> 'radio',
	'std'		=> 'on_hoover',
	'divider'	=> 'top',
	'options'	=> array(
		'always'	=> _x( 'Always visible', 'backend metabox', 'the7mk2' ),
		'on_hoover'	=> _x( 'On hover', 'backend metabox', 'the7mk2' )
	)
) );

// hide last row
Presscore_Meta_Box_Field_Template::add( 'hide last row', array(
	'name'   	=> _x( "Hide last row if there's not enough images to fill it:", 'backend metabox', 'the7mk2' ),
	'desc'   	=> _x( 'Works only for "Standard (no AJAX)" loading mode.', 'backend metabox', 'the7mk2' ),
	'type'    	=> 'checkbox',
	'std'		=> 0,
	'divider'	=> 'top'
) );

// image sizing
Presscore_Meta_Box_Field_Template::add( 'image sizing', array(
	'name'		=> _x( 'Images sizing:', 'backend metabox', 'the7mk2' ),
	'type'		=> 'radio',
	'std'		=> 'original',
	'options'	=> array_diff_key( Presscore_Meta_Box_Field_Template::get( 'image sizing values' ), array( 'round' => '' ) ),
	'divider'	=> 'top'
) );

// team image sizing 
Presscore_Meta_Box_Field_Template::add( 'team image sizing', Presscore_Meta_Box_Field_Template::get_as_array( 'image sizing', array(
	'options'	=> Presscore_Meta_Box_Field_Template::get( 'image sizing values' ),
) ) );

// image proportions
Presscore_Meta_Box_Field_Template::add( 'image proportions', array(
	'name'			=> _x( 'Images proportions:', 'backend metabox', 'the7mk2' ),
	'type'  		=> 'simple_proportions',
	'std'   		=> array( 'width' => 1, 'height' => 1 )
) );

// loading mode
Presscore_Meta_Box_Field_Template::add( 'loading mode', array(
	'name'    	=> _x( 'Loading mode:', 'backend metabox', 'the7mk2' ),
	'type'    	=> 'radio',
	'std'		=> 'ajax_pagination',
	'options'	=> array(
		'ajax_pagination'	=> _x( 'AJAX Pagination', 'backend metabox', 'the7mk2' ),
		'ajax_more'			=> _x( '"Load more" button', 'backend metabox', 'the7mk2' ),
		'lazy_loading'		=> _x( 'Lazy loading', 'backend metabox', 'the7mk2' ),
		'default'			=> _x( 'Standard (no AJAX)', 'backend metabox', 'the7mk2' )
	)
) );

// loading effect
Presscore_Meta_Box_Field_Template::add( 'loading effect', array(
	'name'    	=> _x( 'Loading effect:', 'backend metabox', 'the7mk2' ),
	'type'    	=> 'radio',
	'std'		=> 'fade_in',
	'options'	=> Presscore_Meta_Box_Field_Template::get( 'loading effect values' )
) );

// radio yes(default) no 
Presscore_Meta_Box_Field_Template::add( 'radio yes no', array(
	'type'    	=> 'radio',
	'std'		=> '1',
	'options'	=> Presscore_Meta_Box_Field_Template::get( 'yes no values' )
) );

// select pages 
Presscore_Meta_Box_Field_Template::add( 'select pages', array(
	'type'			=> 'dropdown_pages',
	'post_type'		=> 'page',
	'placeholder'	=> _x( '&mdash; Choose page &mdash;', 'backend metabox', 'the7mk2' ),
) );

// show name/date ordering (radio)
Presscore_Meta_Box_Field_Template::add( 'show name/date ordering', array(
	'name'    	=> _x( 'Show name / date ordering:', 'backend metabox', 'the7mk2' ),
	'type'    	=> 'radio',
	'std'		=> '1',
	'options'	=> Presscore_Meta_Box_Field_Template::get( 'yes no values' )
) );

// show asc/desc ordering (radio)
Presscore_Meta_Box_Field_Template::add( 'show asc/desc ordering', array(
	'name'    	=> _x( 'Show asc. / desc. ordering:', 'backend metabox', 'the7mk2' ),
	'type'    	=> 'radio',
	'std'		=> '1',
	'options'	=> Presscore_Meta_Box_Field_Template::get( 'yes no values' )
) );

// show all pages in paginator (radio)
Presscore_Meta_Box_Field_Template::add( 'show all pages paginator', array(
	'name'    	=> _x( 'Show all pages in paginator:', 'backend metabox', 'the7mk2' ),
	'type'    	=> 'radio',
	'std'		=> '0',
	'options'	=> Presscore_Meta_Box_Field_Template::get( 'yes no values' )
) );

// order
Presscore_Meta_Box_Field_Template::add( 'order', array(
	'name'    	=> _x( 'Order:', 'backend metabox', 'the7mk2' ),
	'type'    	=> 'radio',
	'std'		=> 'DESC',
	'options'	=> array(
		'ASC'	=> _x( 'ascending', 'backend', 'the7mk2' ),
		'DESC'	=> _x( 'descending', 'backend', 'the7mk2' ),
	)
) );

// orderby
Presscore_Meta_Box_Field_Template::add( 'orderby', array(
	'name'     	=> _x( 'Order by:', 'backend metabox', 'the7mk2' ),
	'type'     	=> 'select',
	'std'		=> 'date',
	'options'  	=> array(
		'date' => _x( 'date', 'backend', 'the7mk2' ),
		'name' => _x( 'name', 'backend', 'the7mk2' )
	)
) );

// preview width
Presscore_Meta_Box_Field_Template::add( 'preview width', array(
	'type'    	=> 'radio',
	'std'		=> 'normal',
	'options'	=> array(
		'normal'	=> _x( 'normal', 'backend metabox', 'the7mk2' ),
		'wide'		=> _x( 'wide', 'backend metabox', 'the7mk2' ),
	),
	'divider'	=> 'top'
) );

// media content width
Presscore_Meta_Box_Field_Template::add( 'media content width', array(
	'name'				=> _x( 'Thumbnail width (in %):', 'backend metabox', 'the7mk2' ),
	'type'				=> 'text',
	'std'				=> '',
	'divider'			=> 'top'
) );

Presscore_Meta_Box_Field_Template::add( 'transparent header color mode', array(
	'std'		=> 'light',
	'type'		=> 'radio',
	'options'	=> array(
		'light' => _x( 'Light', 'theme-options', 'the7mk2' ),
		'dark' => _x( 'Dark', 'theme-options', 'the7mk2' ),
		'theme' => _x( 'From Theme Options', 'theme-options', 'the7mk2' )
	)
) );

////////////////////
// Photo Scroller //
////////////////////

// max width
Presscore_Meta_Box_Field_Template::add( 'photoscroller max width', array(
	'name' => _x( 'Max width (%):', 'backend metabox', 'the7mk2' ),
	'type' => 'text',
	'std' => '100'
) );

// min width
Presscore_Meta_Box_Field_Template::add( 'photoscroller min width', array(
	'name' => _x( 'Min width (%):', 'backend metabox', 'the7mk2' ),
	'type' => 'text',
	'std' => '0'
) );

// filling mode desktop
Presscore_Meta_Box_Field_Template::add( 'photoscroller filling mode desktop', array(
	'name' => _x( 'Filling mode (desktop):', 'backend metabox', 'the7mk2' ),
	'type' => 'radio',
	'std' => 'fit',
	'options' => array(
		'fit' => _x( 'fit (preserve proportions)', 'theme-options', 'the7mk2' ),
		'fill' => _x( 'fill the viewport (crop)', 'theme-options', 'the7mk2' )
	)
) );

// filling mode mobile
Presscore_Meta_Box_Field_Template::add( 'photoscroller filling mode mobile', array(
	'name' => _x( 'Filling mode (mobile):', 'backend metabox', 'the7mk2' ),
	'type' => 'radio',
	'std' => 'fit',
	'options' => array(
		'fit' => _x( 'fit (preserve proportions)', 'theme-options', 'the7mk2' ),
		'fill' => _x( 'fill the viewport (crop)', 'theme-options', 'the7mk2' )
	)
) );
