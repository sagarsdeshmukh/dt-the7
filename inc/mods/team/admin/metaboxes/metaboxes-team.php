<?php
/**
 * Team template and post metaboxes.
 * @since presscore 0.1
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

/***********************************************************/
// Display Team
/***********************************************************/

$prefix = '_dt_team_';

$DT_META_BOXES[] = array(
	'id'		=> 'dt_page_box-display_team',
	'title' 	=> _x('Display Team Members by Category(s)', 'backend metabox', 'the7mk2'),
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
			'post_type'			=> 'dt_team',
			'taxonomy'			=> 'dt_team_category',
			// posts, categories, images
			'post_type_info'	=> array( 'categories' ),
			'main_tab_class'	=> 'dt_all_blog',
			'desc'				=> sprintf(
				'<h2>%s</h2><p><strong>%s</strong> %s</p><p><strong>%s</strong></p><ul><li><strong>%s</strong>%s</li><li><strong>%s</strong>%s</li><li><strong>%s</strong>%s</li></ul>',

				_x( 'ALL your Team  Members are being displayed on this page!', 'backend', 'the7mk2' ),
				_x( 'By default all your Team Members will be displayed on this page. ', 'backend', 'the7mk2' ),
				_x( 'But you can specify which Team  Members categories will (or will not) be shown.', 'backend', 'the7mk2' ),
				_x( 'In tabs above you can select from the following options:', 'backend', 'the7mk2' ),

				_x( 'All', 'backend', 'the7mk2' ),

				_x( ' &mdash; all Team  Members (from all categories) will be shown on this page.', 'backend', 'the7mk2' ),

				_x( 'Only', 'backend', 'the7mk2' ),

				_x( ' &mdash; choose Team category(s) to be shown on this page.', 'backend', 'the7mk2' ),

				_x( 'All, except', 'backend', 'the7mk2' ),

				_x( ' &mdash; choose which category(s) will be excluded from displaying on this page.', 'backend', 'the7mk2' )
			)
		)
	),
	'only_on'	=> array( 'template' => array('template-team.php') ),
);

/***********************************************************/
// Team options
/***********************************************************/

$prefix = '_dt_team_options_';

$DT_META_BOXES[] = array(
	'id'		=> 'dt_page_box-team_options',
	'title' 	=> _x('Team Options', 'backend metabox', 'the7mk2'),
	'pages' 	=> array( 'page' ),
	'context' 	=> 'normal',
	'priority' 	=> 'high',
	'fields' 	=> array(

		// Masonry layout
		Presscore_Meta_Box_Field_Template::get_as_array( 'masonry layout', array( 'id' => "{$prefix}masonry_layout" ) ),

		// Gep between images
		Presscore_Meta_Box_Field_Template::get_as_array( 'gap between images', array(
			'id'	=> "{$prefix}item_padding",
			'name'	=> _x( 'Gap between team members (px):', 'backend metabox', 'the7mk2' ),
			'desc'	=> _x( 'Team member paddings (e.g. 5 pixel padding will give you 10 pixel gaps between team members)', 'backend metabox', 'the7mk2' ),
		) ),

		// Column target width
		Presscore_Meta_Box_Field_Template::get_as_array( 'column target width', array( 'id' => "{$prefix}target_width" ) ),

		// Columns number
		Presscore_Meta_Box_Field_Template::get_as_array( 'columns number', array( 'id' => "{$prefix}columns_number" ) ),

		// 100% width
		Presscore_Meta_Box_Field_Template::get_as_array( '100 percent width', array( 'id' => "{$prefix}full_width" ) ),

		// Background under post
		Presscore_Meta_Box_Field_Template::get_as_array( 'background under post', array( 'id' => "{$prefix}bg_under_posts", 'name' => _x( 'Background under team members:', 'backend metabox', 'the7mk2' ) ) ),

		// Image sizing
		Presscore_Meta_Box_Field_Template::get_as_array( 'team image sizing', array(
			'id'			=> "{$prefix}image_layout",
			'hide_fields'	=> array(
				'original' => array( "{$prefix}thumb_proportions" ),
				'round' => array( "{$prefix}thumb_proportions" ),
			)
		) ),

		// Image proportions
		Presscore_Meta_Box_Field_Template::get_as_array( 'image proportions', array( 'id' => "{$prefix}thumb_proportions" ) ),

		// Show excerpts
		Presscore_Meta_Box_Field_Template::get_as_array( 'radio yes no', array(
			'id'		=> "{$prefix}show_exerpts",
			'name'		=> _x( 'Show team members excerpts:','backend metabox', 'the7mk2' ),
			'divider'	=> 'top'
		) ),

		// Number of posts to display on one page
		array(
			'name'		=> _x( 'Number of team members on one page:', 'backend metabox', 'the7mk2' ),
			'id'		=> "{$prefix}ppp",
			'type'		=> 'text',
			'std'		=> '',
			'divider'	=> 'top'
		),

		// Order
		array(
			'before'	=> presscore_meta_boxes_advanced_settings_tpl('dt_portfolio-advanced'), // advanced settings

			'name'		=> _x('Order:', 'backend metabox', 'the7mk2'),
			'id'		=> "{$prefix}order",
			'type'		=> 'radio',
			'std'		=> 'DESC',
			'options'	=> $order_options
		),

		// Orderby
		array(
			'name'     	=> _x('Orderby:', 'backend metabox', 'the7mk2'),
			'id'       	=> "{$prefix}orderby",
			'type'     	=> 'select',
			'options'  	=> array_intersect_key($orderby_options, array('date' => null, 'name' => null)),
			'std'		=> 'date',

			'after'		=> '</div>' // advanced settings :)
		),

	),
	'only_on'	=> array( 'template' => array('template-team.php') ),
);

/***********************************************************/
// Teammate options
/***********************************************************/

// get team links array
$teammate_links = presscore_get_team_links_array();

$prefix = '_dt_teammate_options_';

// teammate metabox fields
$teammate_fields = array(

	// Open single post
	Presscore_Meta_Box_Field_Template::get_as_array( 'radio yes no', array(
		'id'		=> "{$prefix}go_to_single",
		'name'		=> _x( 'Link to teammate details page:','backend metabox', 'the7mk2' ),
		'divider'	=> 'bottom'
	) ),

	// Position
	array(
		'name'	=> _x('Position:', 'backend metabox', 'the7mk2'),
		'id'    => "{$prefix}position",
		'type'  => 'textarea',
		'std'   => '',
	),

);

// links fields
foreach ( $teammate_links as $id=>$data ) {
	$teammate_fields[] = array(
		'name'			=> $data['desc'],
		'id'    		=> "{$prefix}{$id}",
		'type'  		=> 'text',
		'std'   		=> '',
		'top_divider'	=> true,
	);
}

$DT_META_BOXES[] = array(
	'id'		=> 'dt_page_box-testimonial_options',
	'title' 	=> _x('Options', 'backend metabox', 'the7mk2'),
	'pages' 	=> array( 'dt_team' ),
	'context' 	=> 'side',
	'priority' 	=> 'low',
	'fields' 	=> $teammate_fields,
);
