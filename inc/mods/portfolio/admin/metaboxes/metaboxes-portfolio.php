<?php
/**
 * Portfolio template and post meta boxes
 *
 * @package vogue
 * @since 1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

/***********************************************************/
// Display Portfolio
/***********************************************************/

$prefix = '_dt_portfolio_';

$DT_META_BOXES[] = array(
	'id'		=> 'dt_page_box-display_portfolio',
	'title' 	=> _x('Display Portfolio Category(s)', 'backend metabox', 'the7mk2'),
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
			'post_type'			=> 'dt_portfolio',
			'taxonomy'			=> 'dt_portfolio_category',
			// posts, categories, images
			'post_type_info'	=> array( 'categories' ),
			'main_tab_class'	=> 'dt_all_portfolio',
			'desc'				=> sprintf(
				'<h2>%s</h2><p><strong>%s</strong> %s</p><p><strong>%s</strong></p><ul><li><strong>%s</strong>%s</li><li><strong>%s</strong>%s</li><li><strong>%s</strong>%s</li></ul>',

				_x('ALL your Portfolio projects are being displayed on this page!', 'backend', 'the7mk2'),
				_x('By default all your Portfolio projects will be displayed on this page. ', 'backend', 'the7mk2'),
				_x('But you can specify which Portfolio project category(s) will (or will not) be shown.', 'backend', 'the7mk2'),
				_x('In tabs above you can select from the following options:', 'backend', 'the7mk2'),

				_x( 'All', 'backend', 'the7mk2' ),

				_x(' &mdash; all Projects will be shown on this page.', 'backend', 'the7mk2'),

				_x( 'Only', 'backend', 'the7mk2' ),

				_x(' &mdash; choose Project category(s) to be shown on this page.', 'backend', 'the7mk2'),

				_x( 'All, except', 'backend', 'the7mk2' ),

				_x(' &mdash; choose which Project category(s) will be excluded from displaying on this page.', 'backend', 'the7mk2')
			)
		)
	),
	'only_on'	=> array( 'template' => array('template-portfolio-list.php', 'template-portfolio-masonry.php', 'template-portfolio-jgrid.php') ),
);

/***********************************************************/
// Portfolio template options
/***********************************************************/

$prefix = '_dt_portfolio_options_';

$DT_META_BOXES[] = array(
	'id'		=> 'dt_page_box-portfolio_options',
	'title' 	=> _x('Portfolio Options', 'backend metabox', 'the7mk2'),
	'pages' 	=> array( 'page' ),
	'context' 	=> 'normal',
	'priority' 	=> 'high',
	'fields' 	=> array(

		///////////////////
		// List layout //
		///////////////////

		Presscore_Meta_Box_Field_Template::get_as_array( 'list layout', array( 'id' => "{$prefix}list_layout", 'show_on_template' => 'template-portfolio-list.php' ) ),

		// Background under posts
		Presscore_Meta_Box_Field_Template::get_as_array( 'background under post', array(
			'name'				=> _x( 'Background under projects:', 'backend metabox', 'the7mk2' ),
			'id'				=> "{$prefix}bg_under_list_posts",
			'divider'			=> 'top',
			'show_on_template'	=> 'template-portfolio-list.php'
		) ),

		// Hover background color
		Presscore_Meta_Box_Field_Template::get_as_array( 'hover background color', array(
			'name'				=> _x( 'Image rollover color:', 'backend metabox', 'the7mk2' ),
			'id'				=> "{$prefix}list_hover_bg_color",
			'show_on_template'	=> 'template-portfolio-list.php'
		) ),

		//////////////////////
		// Masonry layout //
		//////////////////////

		Presscore_Meta_Box_Field_Template::get_as_array( 'masonry layout', array( 'id' => "{$prefix}masonry_layout", 'divider' => 'bottom', 'show_on_template' => 'template-portfolio-masonry.php' ) ),

		//////////////////////////////////
		// Masonry and jgrid settings //
		//////////////////////////////////

		// Gep between images
		Presscore_Meta_Box_Field_Template::get_as_array( 'gap between images', array(
			'id'				=> "{$prefix}item_padding",
			'divider'			=> false,
			'show_on_template'	=> array( 'template-portfolio-masonry.php', 'template-portfolio-jgrid.php' )
		) ),

		// Row target height
		Presscore_Meta_Box_Field_Template::get_as_array( 'row target height', array( 'id' => "{$prefix}target_height", 'show_on_template' => 'template-portfolio-jgrid.php' ) ),

		// Column target width
		Presscore_Meta_Box_Field_Template::get_as_array( 'column target width', array( 'id' => "{$prefix}target_width", 'show_on_template' => 'template-portfolio-masonry.php' ) ),

		// Columns number
		Presscore_Meta_Box_Field_Template::get_as_array( 'columns number', array( 'id' => "{$prefix}columns_number", 'show_on_template' => 'template-portfolio-masonry.php' ) ),

		// 100% width
		Presscore_Meta_Box_Field_Template::get_as_array( '100 percent width', array( 'id' => "{$prefix}full_width", 'show_on_template' => array( 'template-portfolio-jgrid.php', 'template-portfolio-masonry.php' ) ) ),

		////////////////////////////////////
		// Masonry description settings //
		////////////////////////////////////

		// Albums descriptions
		Presscore_Meta_Box_Field_Template::get_as_array( 'description style', array(
			'name'				=> _x( 'Show projects descriptions:', 'backend metabox', 'the7mk2' ),
			'id'				=> "{$prefix}description",
			'hide_fields'		=> array(
				'under_image'			=> array(
					"{$prefix}hover_animation",
					"{$prefix}lines_animation_effect",
					"{$prefix}bg_post_content_alignment",
					"{$prefix}hover_content_visibility",
					"{$prefix}title_visibility"
				),
				'on_hoover_centered'	=> array(
					"{$prefix}bg_under_masonry_posts",
					"{$prefix}post_content_alignment",
					"{$prefix}lines_animation_effect",
					"{$prefix}hover_content_visibility",
					"{$prefix}title_visibility"
				),
				'on_dark_gradient'		=> array(
					"{$prefix}bg_under_masonry_posts",
					"{$prefix}bg_post_content_alignment",
					"{$prefix}hover_animation",
					"{$prefix}hover_bg_color",
					"{$prefix}lines_animation_effect",
					"{$prefix}title_visibility"
				),
				'from_bottom'			=> array(
					"{$prefix}bg_under_masonry_posts",
					"{$prefix}bg_post_content_alignment",
					"{$prefix}hover_animation",
					"{$prefix}hover_bg_color",
					"{$prefix}lines_animation_effect",
					"{$prefix}hover_content_visibility",
					"{$prefix}title_visibility"
				),
				'bg_with_lines'			=> array(
					"{$prefix}bg_under_masonry_posts",
					"{$prefix}post_content_alignment",
					"{$prefix}bg_post_content_alignment",
					"{$prefix}hover_animation",
					"{$prefix}hover_content_visibility"
				),
			),
			'show_on_template'	=> 'template-portfolio-masonry.php'
		) ),

		// Hover animation
		Presscore_Meta_Box_Field_Template::get_as_array( 'hover animation', array( 'id' => "{$prefix}hover_animation", 'show_on_template' => 'template-portfolio-masonry.php' ) ),

		// Hover background color
		Presscore_Meta_Box_Field_Template::get_as_array( 'hover background color', array( 'id' => "{$prefix}hover_bg_color", 'show_on_template' => 'template-portfolio-masonry.php' ) ),

		// Background under posts
		Presscore_Meta_Box_Field_Template::get_as_array( 'background under masonry post', array(
			'name'				=> _x( 'Background under projects:', 'backend metabox', 'the7mk2' ),
			'id'				=> "{$prefix}bg_under_masonry_posts",
			'show_on_template'	=> 'template-portfolio-masonry.php'
		) ),

		// Hover content visibility
		Presscore_Meta_Box_Field_Template::get_as_array( 'hover content visibility', array( 'id' => "{$prefix}hover_content_visibility", 'show_on_template' => 'template-portfolio-masonry.php' ) ),

		// Content alignment
		Presscore_Meta_Box_Field_Template::get_as_array( 'content alignment', array( 'id' => "{$prefix}post_content_alignment", 'show_on_template' => 'template-portfolio-masonry.php' ) ),

		// Vertical left ontent alignment
		Presscore_Meta_Box_Field_Template::get_as_array( 'vertical left content alignment', array( 'id' => "{$prefix}bg_post_content_alignment", 'show_on_template' => 'template-portfolio-masonry.php' ) ),

		// Animation effect
		Presscore_Meta_Box_Field_Template::get_as_array( 'hover lines animation', array( 'id' => "{$prefix}lines_animation_effect", 'show_on_template' => 'template-portfolio-masonry.php' ) ),

		// Title visibility
		Presscore_Meta_Box_Field_Template::get_as_array( 'hover content visibility', array( 'id' => "{$prefix}title_visibility", 'name' => _x( 'Title visibility:', 'backend metabox', 'the7mk2' ), 'show_on_template' => 'template-portfolio-masonry.php' ) ),

		//////////////////////////////////
		// Jgrid description settings //
		//////////////////////////////////

		// Project descriptions
		Presscore_Meta_Box_Field_Template::get_as_array( 'jgrid description style', array(
			'name'				=> _x( 'Show projects descriptions:', 'backend metabox', 'the7mk2' ),
			'id'				=> "{$prefix}jgrid_description",
			'hide_fields'		=> array(
				'on_hoover_centered'	=> array(
					"{$prefix}jgrid_lines_animation_effect",
					"{$prefix}jgrid_post_content_alignment",
					"{$prefix}jgrid_hover_content_visibility",
					"{$prefix}jgrid_title_visibility"
				),
				'on_dark_gradient'		=> array(
					"{$prefix}jgrid_hover_animation",
					"{$prefix}jgrid_hover_bg_color",
					"{$prefix}jgrid_bg_post_content_alignment",
					"{$prefix}jgrid_lines_animation_effect",
					"{$prefix}jgrid_title_visibility"
				),
				'from_bottom'			=> array(
					"{$prefix}jgrid_hover_animation",
					"{$prefix}jgrid_hover_bg_color",
					"{$prefix}jgrid_bg_post_content_alignment",
					"{$prefix}jgrid_lines_animation_effect",
					"{$prefix}jgrid_hover_content_visibility",
					"{$prefix}jgrid_title_visibility"
				),
				'bg_with_lines'			=> array(
					"{$prefix}jgrid_hover_animation",
					"{$prefix}jgrid_bg_post_content_alignment",
					"{$prefix}jgrid_post_content_alignment",
					"{$prefix}jgrid_hover_content_visibility"
				)
			),
			'show_on_template'	=> 'template-portfolio-jgrid.php'
		) ),

		// Hover animation
		Presscore_Meta_Box_Field_Template::get_as_array( 'hover animation', array( 'id' => "{$prefix}jgrid_hover_animation", 'show_on_template' => 'template-portfolio-jgrid.php' ) ),

		// Hover background color
		Presscore_Meta_Box_Field_Template::get_as_array( 'hover background color', array( 'id' => "{$prefix}jgrid_hover_bg_color", 'show_on_template' => 'template-portfolio-jgrid.php' ) ),

		// Hover content visibility
		Presscore_Meta_Box_Field_Template::get_as_array( 'hover content visibility', array( 'id' => "{$prefix}jgrid_hover_content_visibility", 'show_on_template' => 'template-portfolio-jgrid.php' ) ),

		// Vertical left ontent alignment
		Presscore_Meta_Box_Field_Template::get_as_array( 'vertical left content alignment', array( 'id' => "{$prefix}jgrid_bg_post_content_alignment", 'show_on_template' => 'template-portfolio-jgrid.php' ) ),

		// Content alignment
		Presscore_Meta_Box_Field_Template::get_as_array( 'content alignment', array( 'id' => "{$prefix}jgrid_post_content_alignment", 'show_on_template' => 'template-portfolio-jgrid.php' ) ),

		// Animation effect
		Presscore_Meta_Box_Field_Template::get_as_array( 'hover lines animation', array( 'id' => "{$prefix}jgrid_lines_animation_effect", 'show_on_template' => 'template-portfolio-jgrid.php' ) ),

		// Title visibility
		Presscore_Meta_Box_Field_Template::get_as_array( 'hover content visibility', array( 'id' => "{$prefix}jgrid_title_visibility", 'name' => _x( 'Title visibility:', 'backend metabox', 'the7mk2' ), 'show_on_template' => 'template-portfolio-jgrid.php' ) ),

		///////////////////////
		// Common settings //
		///////////////////////

		// Make all posts the same width
		array(
			'name'    			=> _x( 'Make all projects the same width:', 'backend metabox', 'the7mk2' ),
			'id'      			=> "{$prefix}posts_same_width",
			'type'    			=> 'checkbox',
			'std'				=> 0,
			'divider'			=> 'top',
			'show_on_template'	=> 'template-portfolio-masonry.php'
		),

		// Hide last row
		Presscore_Meta_Box_Field_Template::get_as_array( 'hide last row', array( 'id' => "{$prefix}hide_last_row", 'show_on_template' => 'template-portfolio-jgrid.php' ) ),


		// Image sizing
		Presscore_Meta_Box_Field_Template::get_as_array( 'image sizing', array(
			'id'			=> "{$prefix}image_layout",
			'hide_fields'	=> array(
				'original' => array( "{$prefix}thumb_proportions" ),
			)
		) ),

		// Image proportions
		Presscore_Meta_Box_Field_Template::get_as_array( 'image proportions', array( 'id' => "{$prefix}thumb_proportions" ) ),

		// Media content width
		Presscore_Meta_Box_Field_Template::get_as_array( 'media content width', array( 'id' => "{$prefix}thumb_width", 'show_on_template' => 'template-portfolio-list.php' ) ),

		// Number of posts to display on one page
		array(
			'name'		=> _x( 'Number of projects to display on one page:', 'backend metabox', 'the7mk2' ),
			'id'		=> "{$prefix}ppp",
			'type'		=> 'text',
			'std'		=> '',
			'divider'	=> 'top_and_bottom'
		),

		// Loading mode
		Presscore_Meta_Box_Field_Template::get_as_array( 'loading mode', array( 'id' => "{$prefix}load_style" ) ),

		// Loading effect
		Presscore_Meta_Box_Field_Template::get_as_array( 'loading effect', array( 'id' => "{$prefix}load_effect", 'show_on_template' => array( 'template-portfolio-jgrid.php', 'template-portfolio-masonry.php' ) ) ),

		/////////////////////////
		// Advanced settings //
		/////////////////////////

		// Show projects titles
		array(
			'before'	=> presscore_meta_boxes_advanced_settings_tpl('dt_portfolio-advanced'), // advanced settings

			'name'		=> _x( 'Show projects titles:', 'backend metabox', 'the7mk2' ),
			'id'		=> "{$prefix}show_titles",
			'type'		=> 'radio',
			'std'		=> '1',
			'options'	=> $yes_no_options,
		),

		// Show projects excerpts
		array(
			'name'    	=> _x('Show projects excerpts:', 'backend metabox', 'the7mk2'),
			'id'      	=> "{$prefix}show_exerpts",
			'type'    	=> 'radio',
			'std'		=> '1',
			'options'	=> $yes_no_options,
		),

		////////////////////////
		// Meta information //
		////////////////////////

		// categories
		array(
			'name'    	=> _x('Show project categories:', 'backend metabox', 'the7mk2'),
			'id'      	=> "{$prefix}show_categories_in_post_meta",
			'type'    	=> 'radio',
			'std'		=> '1',
			'options'	=> $yes_no_options,
			'top_divider'	=> true
		),

		// date
		array(
			'name'    	=> _x('Show project date:', 'backend metabox', 'the7mk2'),
			'id'      	=> "{$prefix}show_date_in_post_meta",
			'type'    	=> 'radio',
			'std'		=> '1',
			'options'	=> $yes_no_options,
		),

		// author
		array(
			'name'    	=> _x('Show project author:', 'backend metabox', 'the7mk2'),
			'id'      	=> "{$prefix}show_author_in_post_meta",
			'type'    	=> 'radio',
			'std'		=> '1',
			'options'	=> $yes_no_options,
		),

		// comments
		array(
			'name'    	=> _x('Show project comments:', 'backend metabox', 'the7mk2'),
			'id'      	=> "{$prefix}show_comments_in_post_meta",
			'type'    	=> 'radio',
			'std'		=> '1',
			'options'	=> $yes_no_options,
		),

		///////////////////////
		// Functional icons //
		///////////////////////

		// details
		array(
			'name'    	=> _x('Show details icons:', 'backend metabox', 'the7mk2'),
			'id'      	=> "{$prefix}show_details",
			'type'    	=> 'radio',
			'std'		=> '1',
			'options'	=> $yes_no_options,
			'top_divider'	=> true
		),

		// links
		array(
			'name'    	=> _x('Show links icons:', 'backend metabox', 'the7mk2'),
			'id'      	=> "{$prefix}show_links",
			'type'    	=> 'radio',
			'std'		=> '1',
			'options'	=> $yes_no_options,
		),

		// zoom
		array(
			'name'    	=> _x('Show zoom icons:', 'backend metabox', 'the7mk2'),
			'id'      	=> "{$prefix}show_zoom",
			'type'    	=> 'radio',
			'std'		=> '1',
			'options'	=> $yes_no_options,
		),

		// details button
		array(
			'before'	=> '<div class="rwmb-hidden-field hide-if-js" data-show-on="template-portfolio-list.php">',
			'top_divider'	=> true,

			'name'    	=> _x('Show details buttons:', 'backend metabox', 'the7mk2'),
			'id'      	=> "{$prefix}show_details_buttons",
			'type'    	=> 'radio',
			'std'		=> '1',
			'options'	=> $yes_no_options,

			'after'		=> '</div>'
		),

		//////////////
		// Filter //
		//////////////

		// Show categories filter
		array(
			'name'    	=> _x('Show categories filter:', 'backend metabox', 'the7mk2'),
			'id'      	=> "{$prefix}show_filter",
			'type'    	=> 'radio',
			'std'		=> '1',
			'options'	=> $yes_no_options,
			'top_divider'	=> true
		),

		// Show name / date ordering
		array(
			'name'    	=> _x('Show name / date ordering:', 'backend metabox', 'the7mk2'),
			// 'id'      	=> "{$prefix}show_ordering",
			'id'      	=> "{$prefix}show_orderby",
			'type'    	=> 'radio',
			'std'		=> '1',
			'options'	=> $yes_no_options,
		),

		// Show asc / desc ordering
		array(
			'name'    	=> _x('Show asc. / desc. ordering:', 'backend metabox', 'the7mk2'),
			'id'      	=> "{$prefix}show_order",
			'type'    	=> 'radio',
			'std'		=> '1',
			'options'	=> $yes_no_options,
		),

		/////////////////
		// Paginator //
		/////////////////

		// Show all pages in paginator
		array(
			'name'    	=> _x('Show all pages in paginator:', 'backend metabox', 'the7mk2'),
			'id'      	=> "{$prefix}show_all_pages",
			'type'    	=> 'radio',
			'std'		=> '0',
			'options'	=> $yes_no_options,
			'top_divider'	=> true
		),

		////////////////
		// Ordering //
		////////////////

		// Order
		array(
			'name'    	=> _x('Order:', 'backend metabox', 'the7mk2'),
			'id'      	=> "{$prefix}order",
			'type'    	=> 'radio',
			'std'		=> 'DESC',
			'options'	=> $order_options,
			'top_divider'	=> true
		),

		// Orderby
		array(
			'name'     	=> _x('Orderby:', 'backend metabox', 'the7mk2'),
			'id'       	=> "{$prefix}orderby",
			'type'     	=> 'select',
			'options'  	=> array_intersect_key($orderby_options, array('date' => null, 'name' => null)),
			'std'		=> 'date',
			'after'		=> '</div>',// advanced settings :)
		),

	),
	'only_on'	=> array( 'template' => array('template-portfolio-list.php', 'template-portfolio-masonry.php', 'template-portfolio-jgrid.php') ),
);

/***********************************************************/
// Portfolio post media
/***********************************************************/

$prefix = '_dt_project_media_';

$DT_META_BOXES[] = array(
	'id'		=> 'dt_page_box-portfolio_post_media',
	'title' 	=> _x('Add/Edit Project Media', 'backend metabox', 'the7mk2'),
	'pages' 	=> array( 'dt_portfolio' ),
	'context' 	=> 'normal',
	'priority' 	=> 'high',
	'fields' 	=> array(

		// IMAGE ADVANCED (WP 3.5+)
		array(
			'id'               => "{$prefix}items",
			'type'             => 'image_advanced_mk2',
		),

	),
);

/***********************************************************/
// Portfolio post media options
/***********************************************************/

$prefix = '_dt_project_media_options_';

$DT_META_BOXES[] = array(
	'id'		=> 'dt_page_box-portfolio_post_media_options',
	'title' 	=> _x('Media Options', 'backend metabox', 'the7mk2'),
	'pages' 	=> array( 'dt_portfolio' ),
	'context' 	=> 'normal',
	'priority' 	=> 'high',
	'fields' 	=> array(

		// Layout settings
		array(
			'name'    	=> _x('Layout settings:', 'backend metabox', 'the7mk2'),
			'id'      	=> "{$prefix}layout",
			'type'    	=> 'radio',
			'std'		=> 'left',
			'options'	=> array(
				'left'		=> array( _x('Media on the left of content', 'backend metabox', 'the7mk2'), array('right-content.gif', 75, 50) ),
				'right' 	=> array( _x('Media on the right of content', 'backend metabox', 'the7mk2'), array('left-content.gif', 75, 50) ),
				'before' 	=> array( _x('Media before content area', 'backend metabox', 'the7mk2'), array('bottom-content.gif', 75, 50) ),
				'after' 	=> array( _x('Media after content area', 'backend metabox', 'the7mk2'), array('top-content.gif', 75, 50) ),
				'disabled' 	=> array( _x('Media disabled (blank page)', 'backend metabox', 'the7mk2'), array('no-media-content.gif', 75, 50) ),
			),
			'hide_fields'	=> array(
				'before'	=> array( "{$prefix}enable_floationg_content" ),
				'after'		=> array( "{$prefix}enable_floationg_content" ),
				'disabled'	=> array( "{$prefix}enable_floationg_content" )
			)
		),

		// Fixed background
		array(
			'name'    		=> _x('Enable floating content:', 'backend metabox', 'the7mk2'),
			'id'      		=> "{$prefix}enable_floationg_content",
			'type'    		=> 'checkbox',
			'std'			=> 1,
			'top_divider'	=> true
		),

		// Show media as
		array(
			'name'    	=> _x('Show media as:', 'backend metabox', 'the7mk2'),
			'id'      	=> "{$prefix}type",
			'type'    	=> 'radio',
			'std'		=> 'slideshow',
			'options'	=> array(
				'slideshow'	=> array( _x('Slideshow', 'backend metabox', 'the7mk2'), array('layout-slider.gif', 75, 50) ),
				'gallery' 	=> array( _x('Gallery', 'backend metabox', 'the7mk2'), array('layout-metro.gif', 75, 50) ),
				'list'		=> array( _x('List', 'backend metabox', 'the7mk2'), array('layout-list.gif', 75, 50) ),
			),
			'hide_fields'	=> array(
				'gallery' 	=> array( "{$prefix}slider_proportions" ),
				'list'		=> array( "{$prefix}slider_proportions", "{$prefix}gallery_container" ),
				'slideshow'	=> array( "{$prefix}gallery_container" )
			),
			'top_divider'	=> true

		),

		// Slider proportions
		array(
			'name'			=> _x('Slider proportions:', 'backend metabox', 'the7mk2'),
			'id'    		=> "{$prefix}slider_proportions",
			'type'  		=> 'simple_proportions',
			'std'   		=> array( 'width' => '', 'height' => '' ),
			'top_divider'	=> true
		),

		// gallery
		array(
			// container begin !!!
			'before'		=> '<div class="rwmb-input-' . $prefix . 'gallery_container rwmb-flickering-field">',

			'name'     		=> _x('Columns', 'backend metabox', 'the7mk2'),
			'id'       		=> "{$prefix}gallery_columns",
			'type'     		=> 'select',
			'std'			=>'4',
			'options'  		=> array(
				'1' => '1',
				'2' => '2',
				'3' => '3',
				'4' => '4',
				'5' => '5',
				'6' => '6',
			),
			'multiple' 		=> false,
			'top_divider'	=> true
		),

		// Fixed background
		array(
			'name'    		=> _x('Make first image large:', 'backend metabox', 'the7mk2'),
			'id'      		=> "{$prefix}gallery_make_first_big",
			'type'    		=> 'checkbox',
			'std'			=> 1,

			// container end !!!
			'after'			=> '</div>',
		),

	),
);

/***********************************************************/
// Portfolio post options
/***********************************************************/

$prefix = '_dt_project_options_';

$DT_META_BOXES[] = array(
	'id'		=> 'dt_page_box-portfolio_post',
	'title' 	=> _x('Project Options', 'backend metabox', 'the7mk2'),
	'pages' 	=> array( 'dt_portfolio' ),
	'context' 	=> 'normal',
	'priority' 	=> 'high',
	'fields' 	=> array(

		// Back button
		Presscore_Meta_Box_Field_Template::get_as_array( 'select pages', array(
			'name'		=> _x('Back button:', 'backend metabox', 'the7mk2'),
			'id'		=> "{$prefix}back_button",
			'divider'	=> 'bottom'
		) ),

		////////////////////
		// Project link //
		////////////////////

		array(
			'name'    		=> _x('Project link:', 'backend metabox', 'the7mk2'),
			'id'      		=> "{$prefix}show_link",
			'type'    		=> 'checkbox',
			'std'			=> 0,
			'hide_fields'	=> array(
				"{$prefix}link",
				"{$prefix}link_name",
				"{$prefix}link_target",
			),
		),

		// Link
		array(
			'name'	=> _x('Link:', 'backend metabox', 'the7mk2'),
			'id'    => "{$prefix}link",
			'type'  => 'text',
			'std'   => '',
		),

		// Link name
		array(
			'name'	=> _x('Caption:', 'backend metabox', 'the7mk2'),
			'id'    => "{$prefix}link_name",
			'type'  => 'text',
			'std'   => '',
		),

		// Target
		array(
			'name'    	=> _x('Target:', 'backend metabox', 'the7mk2'),
			'id'      	=> "{$prefix}link_target",
			'type'    	=> 'radio',
			'std'		=> '',
			'options'	=> array(
				''			=> _x('_self', 'backend metabox', 'the7mk2'),
				'_blank' 	=> _x('_blank', 'backend metabox', 'the7mk2'),
			),
		),

		///////////////////////////////////////////
		// Hide featured image on project page //
		///////////////////////////////////////////

		array(
			'name'    		=> _x('Hide featured image on project page:', 'backend metabox', 'the7mk2'),
			'id'      		=> "{$prefix}hide_thumbnail",
			'type'    		=> 'checkbox',
			'std'			=> 0,
			'top_divider'	=> true,
		),

		///////////////////////////////////////
		// Open featured image in lightbox //
		///////////////////////////////////////

		array(
			'name'    		=> _x('Open images in lightbox:', 'backend metabox', 'the7mk2'),
			'id'      		=> "{$prefix}open_thumbnail_in_lightbox",
			'type'    		=> 'checkbox',
			'std'			=> 0,
			'top_divider'	=> true,
		),

		/////////////////////////////////
		// Related projects category //
		/////////////////////////////////

		array(
			'name'    	=> _x('Related projects category:', 'backend metabox', 'the7mk2'),
			'id'      	=> "{$prefix}related_mode",
			'type'    	=> 'radio',
			'std'		=> 'same',
			'options'	=> array(
				'same'		=> _x('from the same category', 'backend metabox', 'the7mk2'),
				'custom'	=> _x('choose category(s)', 'backend metabox', 'the7mk2'),
			),
			'hide_fields'	=> array(
				'same'	=> array( "{$prefix}related_categories" ),
			),
			'top_divider'	=> true,
		),

		// Taxonomy list
		array(
			'id'      => "{$prefix}related_categories",
			'type'    => 'taxonomy_list',
			'options' => array(
				// Taxonomy name
				'taxonomy' => 'dt_portfolio_category',
				// How to show taxonomy: 'checkbox_list' (default) or 'checkbox_tree', 'select_tree' or 'select'. Optional
				'type' => 'checkbox_list',
				// Additional arguments for get_terms() function. Optional
				'args' => array()
			),
		),

		//////////////////////////////
		//  Project preview width //
		//////////////////////////////

		array(
			'name'    	=> _x('Project preview width:', 'backend metabox', 'the7mk2'),
			'id'      	=> "{$prefix}preview",
			'type'    	=> 'radio',
			'std'		=> 'normal',
			'options'	=> array(
				'normal'	=> _x('normal', 'backend metabox', 'the7mk2'),
				'wide'		=> _x('wide', 'backend metabox', 'the7mk2'),
			),
			'before'	=> '<p><small>' . sprintf(
				_x('Related projects can be enabled / disabled from %sTheme Options / Blog, Portfolio, Gallery%s', 'backend metabox', 'the7mk2'),
				'<a href="' . esc_url( add_query_arg( 'page', 'of-blog-and-portfolio-menu', get_admin_url() . 'admin.php' ) ) . '" target="_blank">',
				'</a>'
			) . '</small></p><div class="dt_hr"></div><p><strong>' . _x('Project Preview Options', 'backend metabox', 'the7mk2') . '</strong></p>'
		),

		//////////////////////////////
		//  Project preview style //
		//////////////////////////////

		array(
			'name'    	=> _x('Preview style:', 'backend metabox', 'the7mk2'),
			'id'      	=> "{$prefix}preview_style",
			'type'    	=> 'radio',
			'std'		=> 'featured_image',
			'options'	=> array(
				'featured_image'	=> _x('featured image', 'backend metabox', 'the7mk2'),
				'slideshow'			=> _x('slideshow', 'backend metabox', 'the7mk2'),
			),
			'hide_fields'	=> array(
				'featured_image' => array( "{$prefix}slider_proportions" ),
			),
		),

		// Slider proportions
		array(
			'name'			=> _x('Slider proportions:', 'backend metabox', 'the7mk2'),
			'id'    		=> "{$prefix}slider_proportions",
			'type'  		=> 'simple_proportions',
			'std'   		=> array('width' => '', 'height' => ''),
		),

	),
);
