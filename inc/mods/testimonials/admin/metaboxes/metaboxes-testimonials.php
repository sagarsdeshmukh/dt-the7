<?php
/**
 * Testimonials template and post meta boxes
 *
 * @package vogue
 * @since 1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

/***********************************************************/
// Display Testimonials
/***********************************************************/

$prefix = '_dt_testimonials_';

$DT_META_BOXES[] = array(
	'id'		=> 'dt_page_box-display_testimonials',
	'title' 	=> _x('Display Testimonials Category(s)', 'backend metabox', 'the7mk2'),
	'pages' 	=> array( 'page' ),
	'context' 	=> 'normal',
	'priority' 	=> 'high',
	'fields' 	=> array(

		// Sidebar widgetized area
		array(
			'id'       			=> "{$prefix}display",
			'type'     			=> 'fancy_category',
			// may be posts, taxonomy, both
			'mode'				=> 'taxonomy',
			'post_type'			=> 'dt_testimonials',
			'taxonomy'			=> 'dt_testimonials_category',
			// posts, categories, images
			'post_type_info'	=> array( 'categories' ),
			'main_tab_class'	=> 'dt_all_blog',
			'desc'				=> sprintf(
				'<h2>%s</h2><p><strong>%s</strong> %s</p><p><strong>%s</strong></p><ul><li><strong>%s</strong>%s</li><li><strong>%s</strong>%s</li><li><strong>%s</strong>%s</li></ul>',

				_x( 'ALL your Testimonials are being displayed on this page!', 'backend', 'the7mk2' ),
				_x( 'By default all your Testimonials will be displayed on this page. ', 'backend', 'the7mk2' ),
				_x( 'But you can specify which Testimonials categories will (or will not) be shown.', 'backend', 'the7mk2' ),
				_x( 'In tabs above you can select from the following options:', 'backend', 'the7mk2' ),

				_x( 'All', 'backend', 'the7mk2' ),

				_x( ' &mdash; all Testimonials (from all categories) will be shown on this page.', 'backend', 'the7mk2' ),

				_x( 'Only', 'backend', 'the7mk2' ),

				_x( ' &mdash; choose Testimonials category(s) to be shown on this page.', 'backend', 'the7mk2' ),

				_x( 'All, except', 'backend', 'the7mk2' ),

				_x( ' &mdash; choose which category(s) will be excluded from displaying on this page.', 'backend', 'the7mk2' )
			)
		)
	),
	'only_on'	=> array( 'template' => array( 'template-testimonials.php' ) ),
);

/***********************************************************/
// Testimonials options
/***********************************************************/

$prefix = '_dt_testimonials_options_';

$DT_META_BOXES[] = array(
	'id'		=> 'dt_page_box-testimonials_options',
	'title' 	=> _x( 'Testimonials Options', 'backend metabox', 'the7mk2' ),
	'pages' 	=> array( 'page' ),
	'context' 	=> 'normal',
	'priority' 	=> 'high',
	'fields' 	=> array(

		// Masonry layout
		Presscore_Meta_Box_Field_Template::get_as_array( 'masonry layout', array( 'id' => "{$prefix}masonry_layout" ) ),

		// Gep between images
		Presscore_Meta_Box_Field_Template::get_as_array( 'gap between images', array(
			'name'	=> _x( 'Gap between testimonials (px):', 'backend metabox', 'the7mk2' ),
			'id'	=> "{$prefix}item_padding"
		) ),

		// Column target width
		Presscore_Meta_Box_Field_Template::get_as_array( 'column target width', array( 'id' => "{$prefix}target_width" ) ),

		// Columns number
		Presscore_Meta_Box_Field_Template::get_as_array( 'columns number', array( 'id' => "{$prefix}columns_number" ) ),

		// 100% width
		Presscore_Meta_Box_Field_Template::get_as_array( '100 percent width', array( 'id' => "{$prefix}full_width" ) ),

		// Number of posts to display on one page
		array(
			'name'		=> _x( 'Number of testimonials on one page:', 'backend metabox', 'the7mk2' ),
			'id'		=> "{$prefix}ppp",
			'type'		=> 'text',
			'std'		=> '',
			'divider'	=> 'top'
		),

		// Loading mode
		Presscore_Meta_Box_Field_Template::get_as_array( 'loading mode', array( 'id' => "{$prefix}load_style", 'divider' => 'top' ) ),

		// Loading effect
		Presscore_Meta_Box_Field_Template::get_as_array( 'loading effect', array( 'id' => "{$prefix}load_effect" ) ),

	),
	'only_on'	=> array( 'template' => array( 'template-testimonials.php' ) ),
);

/***********************************************************/
// Testimonial options
/***********************************************************/

$prefix = '_dt_testimonial_options_';

$DT_META_BOXES[] = array(
	'id'		=> 'dt_page_box-testimonial_options',
	'title' 	=> _x( 'Options', 'backend metabox', 'the7mk2' ),
	'pages' 	=> array( 'dt_testimonials' ),
	'context' 	=> 'side',
	'priority' 	=> 'core',
	'fields' 	=> array(

		// Open single post
		Presscore_Meta_Box_Field_Template::get_as_array( 'radio yes no', array(
			'id'		=> "{$prefix}go_to_single",
			'name'		=> _x( 'Link to testimonial details page:','backend metabox', 'the7mk2' ),
			'std'		=> '0',
			'divider'	=> 'bottom'
		) ),

		// Position
		array(
			'name'	=> _x( 'Position:', 'backend metabox', 'the7mk2' ),
			'id'	=> "{$prefix}position",
			'type'	=> 'textarea',
			'std'	=> '',
		),

		// Link
		array(
			'name'		=> _x( 'Link:', 'backend metabox', 'the7mk2' ),
			'id'		=> "{$prefix}link",
			'type'		=> 'text',
			'std'		=> '',
			'divider'	=> 'top'
		),

	),
);
