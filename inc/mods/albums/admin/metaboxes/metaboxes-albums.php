<?php
/**
 * Albums template and post metaboxes.
 *
 * @package vogue
 * @since 1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

/***********************************************************/
// Display Albums
/***********************************************************/

$prefix = '_dt_albums_';

$DT_META_BOXES[] = array(
	'id'		=> 'dt_page_box-display_albums',
	'title' 	=> _x('Display Photo & Video Albums', 'backend metabox', 'the7mk2'),
	'pages' 	=> array( 'page' ),
	'context' 	=> 'normal',
	'priority' 	=> 'high',
	'fields' 	=> array(

		// Sidebar widgetized area
		array(
			'id' => "{$prefix}display",
			'type' => 'fancy_category',
			// may be posts, taxonomy, both
			'mode' => 'both',
			'post_type' => 'dt_gallery',
			'taxonomy' => 'dt_gallery_category',
			// posts, categories, images
			'post_type_info' => array( 'categories', 'posts' ),
			'main_tab_class' => 'dt_all_albums',
			'desc' => sprintf(
				'<h2>%s</h2><p><strong>%s</strong> %s</p><p><strong>%s</strong></p><ul><li><strong>%s</strong>%s</li><li><strong>%s</strong>%s</li><li><strong>%s</strong>%s</li></ul>',

				_x( 'ALL your Photo & Video albums are being displayed on this page!', 'backend', 'the7mk2' ),
				_x( 'By default all your Albums will be displayed on this page. ', 'backend', 'the7mk2' ),
				_x( 'But you can specify which Album(s) or Album category(s) will (or will not) be shown.', 'backend', 'the7mk2' ),
				_x( 'In tabs above you can select from the following options:', 'backend', 'the7mk2' ),

				_x( 'All', 'backend', 'the7mk2' ),

				_x( ' &mdash; all Albums will be shown on this page.', 'backend', 'the7mk2' ),

				_x( 'Only', 'backend', 'the7mk2' ),

				_x( ' &mdash; choose Album(s) or Album category(s) to be shown on this page.', 'backend', 'the7mk2' ),

				_x( 'All, except', 'backend', 'the7mk2' ),

				_x( ' &mdash; choose which Album(s) or Album category(s) will be excluded from displaying on this page.', 'backend', 'the7mk2' )
			)
		)
	),

	'only_on'	=> array( 'template' => array('template-albums.php', 'template-albums-jgrid.php') ),
);

/***********************************************************/
// Albums options
/***********************************************************/

$prefix = '_dt_albums_options_';

$DT_META_BOXES[] = array(
	'id'		=> 'dt_page_box-albums_options',
	'title' 	=> _x('Albums Options', 'backend metabox', 'the7mk2'),
	'pages' 	=> array( 'page' ),
	'context' 	=> 'normal',
	'priority' 	=> 'high',
	'fields' 	=> array(

		// Masonry layout
		Presscore_Meta_Box_Field_Template::get_as_array( 'masonry layout', array( 'id' => "{$prefix}layout", 'show_on_template' => 'template-albums.php' ) ),

		// Gep between images
		Presscore_Meta_Box_Field_Template::get_as_array( 'gap between images', array( 'id' => "{$prefix}item_padding", 'show_on_template' => array( 'template-albums-jgrid.php', 'template-albums.php' ) ) ),

		// Row target height
		Presscore_Meta_Box_Field_Template::get_as_array( 'row target height', array( 'id' => "{$prefix}target_height", 'show_on_template' => 'template-albums-jgrid.php' ) ),

		// Column target width
		Presscore_Meta_Box_Field_Template::get_as_array( 'column target width', array( 'id' => "{$prefix}target_width", 'show_on_template' => 'template-albums.php' ) ),

		// Columns number
		Presscore_Meta_Box_Field_Template::get_as_array( 'columns number', array( 'id' => "{$prefix}columns_number", 'show_on_template' => 'template-albums.php' ) ),

		// 100% width
		Presscore_Meta_Box_Field_Template::get_as_array( '100 percent width', array( 'id' => "{$prefix}full_width", 'show_on_template' => array( 'template-albums-jgrid.php', 'template-albums.php' ) ) ),

		////////////////////////////////////
		// Masonry description settings //
		////////////////////////////////////

		// Albums descriptions
		Presscore_Meta_Box_Field_Template::get_as_array( 'description style', array(
			'id'				=> "{$prefix}description",
			'name'				=> _x( 'Show albums descriptions:', 'backend metabox', 'the7mk2' ),
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
				)
			),
			'show_on_template'	=> 'template-albums.php',
		) ),

		// Hover animation
		Presscore_Meta_Box_Field_Template::get_as_array( 'hover animation', array( 'id' => "{$prefix}hover_animation", 'show_on_template' => 'template-albums.php' ) ),

		// Hover background color
		Presscore_Meta_Box_Field_Template::get_as_array( 'hover background color', array( 'id' => "{$prefix}hover_bg_color", 'show_on_template' => 'template-albums.php' ) ),

		// Background under posts
		Presscore_Meta_Box_Field_Template::get_as_array( 'background under masonry post', array(
			'name'				=> _x( 'Background under album:', 'backend metabox', 'the7mk2' ),
			'id'				=> "{$prefix}bg_under_masonry_posts",
			'show_on_template'	=> 'template-albums.php',
		) ),

		// Hover content visibility
		Presscore_Meta_Box_Field_Template::get_as_array( 'hover content visibility', array( 'id' => "{$prefix}hover_content_visibility", 'show_on_template' => 'template-albums.php' ) ),

		// Content alignment
		Presscore_Meta_Box_Field_Template::get_as_array( 'content alignment', array( 'id' => "{$prefix}post_content_alignment", 'show_on_template' => 'template-albums.php' ) ),

		// Vertical left ontent alignment
		Presscore_Meta_Box_Field_Template::get_as_array( 'vertical left content alignment', array( 'id' => "{$prefix}bg_post_content_alignment", 'show_on_template' => 'template-albums.php' ) ),

		// Animation effect
		Presscore_Meta_Box_Field_Template::get_as_array( 'hover lines animation', array( 'id' => "{$prefix}lines_animation_effect", 'show_on_template' => 'template-albums.php' ) ),

		// Title visibility
		Presscore_Meta_Box_Field_Template::get_as_array( 'hover content visibility', array( 'id' => "{$prefix}title_visibility", 'name' => _x( 'Title visibility:', 'backend metabox', 'the7mk2' ), 'show_on_template' => 'template-albums.php' ) ),

		// Make all posts the same width
		array(
			'id'      			=> "{$prefix}posts_same_width",
			'name'    			=> _x( 'Make all albums the same width:', 'backend metabox', 'the7mk2' ),
			'type'    			=> 'checkbox',
			'std'				=> 0,
			'divider'			=> 'top',
			'show_on_template'	=> 'template-albums.php'
		),

		// Hide last row
		Presscore_Meta_Box_Field_Template::get_as_array( 'hide last row', array( 'id' => "{$prefix}hide_last_row", 'show_on_template' => 'template-albums-jgrid.php' ) ),

		//////////////////////////////////
		// Jgrid description settings //
		//////////////////////////////////

		// Albums descriptions
		Presscore_Meta_Box_Field_Template::get_as_array( 'jgrid description style', array(
			'id'				=> "{$prefix}jgrid_description",
			'name'				=> _x( 'Show albums descriptions:', 'backend metabox', 'the7mk2' ),
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
					"{$prefix}jgrid_hover_content_visibility",
				)
			),
			'show_on_template'	=> 'template-albums-jgrid.php'
		) ),

		// Hover animation
		Presscore_Meta_Box_Field_Template::get_as_array( 'hover animation', array( 'id' => "{$prefix}jgrid_hover_animation", 'show_on_template' => 'template-albums-jgrid.php' ) ),

		// Hover background color
		Presscore_Meta_Box_Field_Template::get_as_array( 'hover background color', array( 'id' => "{$prefix}jgrid_hover_bg_color", 'show_on_template' => 'template-albums-jgrid.php' ) ),

		// Hover content visibility
		Presscore_Meta_Box_Field_Template::get_as_array( 'hover content visibility', array( 'id' => "{$prefix}jgrid_hover_content_visibility", 'show_on_template' => 'template-albums-jgrid.php' ) ),

		// Vertical left ontent alignment
		Presscore_Meta_Box_Field_Template::get_as_array( 'vertical left content alignment', array( 'id' => "{$prefix}jgrid_bg_post_content_alignment", 'show_on_template' => 'template-albums-jgrid.php' ) ),

		// Content alignment
		Presscore_Meta_Box_Field_Template::get_as_array( 'content alignment', array( 'id' => "{$prefix}jgrid_post_content_alignment", 'show_on_template' => 'template-albums-jgrid.php' ) ),

		// Animation effect
		Presscore_Meta_Box_Field_Template::get_as_array( 'hover lines animation', array( 'id' => "{$prefix}jgrid_lines_animation_effect", 'show_on_template' => 'template-albums-jgrid.php' ) ),

		// Title visibility
		Presscore_Meta_Box_Field_Template::get_as_array( 'hover content visibility', array( 'id' => "{$prefix}jgrid_title_visibility", 'name' => _x( 'Title visibility:', 'backend metabox', 'the7mk2' ), 'show_on_template' => 'template-albums-jgrid.php' ) ),

		///////////////////////
		// Common settings //
		///////////////////////

		// Image sizing
		Presscore_Meta_Box_Field_Template::get_as_array( 'image sizing', array(
			'id'			=> "{$prefix}image_layout",
			'hide_fields'	=> array(
				'original' => array( "{$prefix}thumb_proportions" ),
			)
		) ),

		// Image proportions
		Presscore_Meta_Box_Field_Template::get_as_array( 'image proportions', array( 'id' => "{$prefix}thumb_proportions" ) ),

		// Number of posts to display on one page
		array(
			'name'		=> _x( 'Number of albums to display on one page:', 'backend metabox', 'the7mk2' ),
			'id'    	=> "{$prefix}ppp",
			'type'  	=> 'text',
			'std'   	=> '',
			'divider'	=> 'top'
		),

		// Loading mode
		Presscore_Meta_Box_Field_Template::get_as_array( 'loading mode', array( 'id' => "{$prefix}load_style", 'divider' => 'top' ) ),

		// Loading effect
		Presscore_Meta_Box_Field_Template::get_as_array( 'loading effect', array( 'id' => "{$prefix}load_effect" ) ),

		/////////////////////////
		// Advanced settings //
		/////////////////////////

		array(
			'before'	=> presscore_meta_boxes_advanced_settings_tpl('dt_portfolio-advanced'), // advanced settings

			'name'    	=> _x( 'Show albums titles:', 'backend metabox', 'the7mk2' ),
			'id'      	=> "{$prefix}show_titles",
			'type'    	=> 'radio',
			'std'		=> '1',
			'options'	=> Presscore_Meta_Box_Field_Template::get( 'yes no values' ),
		),

		// Show excerpts
		Presscore_Meta_Box_Field_Template::get_as_array( 'radio yes no', array( 'id' => "{$prefix}show_exerpts", 'name' => _x( 'Show albums excerpts:', 'backend metabox', 'the7mk2' ) ) ),

		// Show image miniatures
		Presscore_Meta_Box_Field_Template::get_as_array( 'image miniatures', array( 'id' => "{$prefix}show_round_miniatures", 'divider' => 'top_and_bottom' ) ),


		// Show categories
		Presscore_Meta_Box_Field_Template::get_as_array( 'radio yes no', array( 'id' => "{$prefix}show_categories_in_post_meta", 'name' => _x( 'Show album categories:', 'backend metabox', 'the7mk2' ) ) ),

		// Show date
		Presscore_Meta_Box_Field_Template::get_as_array( 'radio yes no', array( 'id' => "{$prefix}show_date_in_post_meta", 'name' => _x( 'Show album date:', 'backend metabox', 'the7mk2' ) ) ),

		// Show author
		Presscore_Meta_Box_Field_Template::get_as_array( 'radio yes no', array( 'id' => "{$prefix}show_author_in_post_meta", 'name' => _x( 'Show album author:', 'backend metabox', 'the7mk2' ) ) ),

		// Show comments
		Presscore_Meta_Box_Field_Template::get_as_array( 'radio yes no', array( 'id' => "{$prefix}show_comments_in_post_meta", 'name' => _x( 'Show album comments:', 'backend metabox', 'the7mk2' ) ) ),

		// Show media numbers
		Presscore_Meta_Box_Field_Template::get_as_array( 'radio yes no', array( 'id' => "{$prefix}show_numbers_in_post_meta", 'name' => _x( 'Show number of images &amp; videos:', 'backend metabox', 'the7mk2' ) ) ),

		// Show posts filter
		Presscore_Meta_Box_Field_Template::get_as_array( 'radio yes no', array(
			'id'		=> "{$prefix}show_filter",
			'name'		=> _x( 'Show albums filter:', 'backend metabox', 'the7mk2' ),
			'divider'	=> 'top'
		) ),

		// Show name/date ordering
		Presscore_Meta_Box_Field_Template::get_as_array( 'show name/date ordering', array( 'id' => "{$prefix}show_orderby" ) ),

		// Show asc/desc ordering
		Presscore_Meta_Box_Field_Template::get_as_array( 'show asc/desc ordering', array( 'id' => "{$prefix}show_order" ) ),

		// Show all pages in paginator
		Presscore_Meta_Box_Field_Template::get_as_array( 'show all pages paginator', array( 'id' => "{$prefix}show_all_pages", 'divider' => 'top' ) ),

		// Order
		Presscore_Meta_Box_Field_Template::get_as_array( 'order', array( 'id' => "{$prefix}order", 'divider' => 'top' ) ),

		// Orderby
		Presscore_Meta_Box_Field_Template::get_as_array( 'orderby', array( 'id' => "{$prefix}orderby", 'after' => '</div>' ) ),

	),

	'only_on'	=> array( 'template' => array('template-albums.php', 'template-albums-jgrid.php') ),
);

/***********************************************************/
// Display Photos
/***********************************************************/

$prefix = '_dt_albums_media_';

$DT_META_BOXES[] = array(
	'id'		=> 'dt_page_box-display_albums_media',
	'title' 	=> _x('Display Photos & Videos', 'backend metabox', 'the7mk2'),
	'pages' 	=> array( 'page' ),
	'context' 	=> 'normal',
	'priority' 	=> 'high',
	'fields' 	=> array(

		// Sidebar widgetized area
		array(
			'id'       			=> "{$prefix}display",
			'type'     			=> 'fancy_category',
			// may be posts, taxonomy, both
			'mode'				=> 'both',
			'post_type'			=> 'dt_gallery',
			'taxonomy'			=> 'dt_gallery_category',
			// posts, categories, images
			'post_type_info'	=> array( 'categories', 'posts' ),
			'main_tab_class'	=> 'dt_all_albums',
			'desc'				=> sprintf(
				'<h2>%s</h2><p><strong>%s</strong> %s</p><p><strong>%s</strong></p><ul><li><strong>%s</strong>%s</li><li><strong>%s</strong>%s</li><li><strong>%s</strong>%s</li></ul>',

				_x('ALL Photos & Videos from all your Albums are being displayed on this page!', 'backend', 'the7mk2'),
				_x('By default all your Photos & Videos will be displayed on this page. ', 'backend', 'the7mk2'),
				_x('But you can specify which Album(s) or Album category(s) will (or will not) be shown.', 'backend', 'the7mk2'),
				_x('In tabs above you can select from the following options:', 'backend', 'the7mk2'),

				_x( 'All', 'backend', 'the7mk2' ),

				_x(' &mdash; all Photos & Videos from all Albums will be shown on this page.', 'backend', 'the7mk2'),

				_x( 'Only', 'backend', 'the7mk2' ),

				_x(' &mdash; choose Album(s) or Album category(s) to be shown on this page.', 'backend', 'the7mk2'),

				_x( 'All, except', 'backend', 'the7mk2' ),

				_x(' &mdash; choose which Album(s) or Album category(s) will be excluded from displaying on this page.', 'backend', 'the7mk2')
			)
		)
	),

	'only_on'	=> array( 'template' => array('template-media.php', 'template-media-jgrid.php') ),
);

/***********************************************************/
// Media template options
/***********************************************************/

$prefix = '_dt_media_options_';

$DT_META_BOXES[] = array(
	'id'		=> 'dt_page_box-media_options',
	'title' 	=> _x('Gallery Options', 'backend metabox', 'the7mk2'),
	'pages' 	=> array( 'page' ),
	'context' 	=> 'normal',
	'priority' 	=> 'high',
	'fields' 	=> array(

		// Masonry layout
		Presscore_Meta_Box_Field_Template::get_as_array( 'masonry layout', array( 'id' => "{$prefix}layout", 'show_on_template' => 'template-media.php' ) ),

		// Gap between images
		Presscore_Meta_Box_Field_Template::get_as_array( 'gap between images', array( 'id' => "{$prefix}item_padding" ) ),

		// Row target height (px)
		Presscore_Meta_Box_Field_Template::get_as_array( 'row target height', array( 'id' => "{$prefix}target_height", 'show_on_template' => 'template-media-jgrid.php' ) ),

		// Column target width (px)
		Presscore_Meta_Box_Field_Template::get_as_array( 'column target width', array( 'id' => "{$prefix}target_width", 'show_on_template' => 'template-media.php' ) ),

		// Columns number
		Presscore_Meta_Box_Field_Template::get_as_array( 'columns number', array( 'id' => "{$prefix}columns_number", 'show_on_template' => 'template-media.php' ) ),

		// Make all 100% width
		Presscore_Meta_Box_Field_Template::get_as_array( '100 percent width', array( 'id' => "{$prefix}full_width" ) ),

		// Hide last row
		Presscore_Meta_Box_Field_Template::get_as_array( 'hide last row', array( 'id' => "{$prefix}hide_last_row", 'show_on_template' => 'template-media-jgrid.php' ) ),

		///////////////////////
		// Common settings //
		///////////////////////

		// Image sizing
		Presscore_Meta_Box_Field_Template::get_as_array( 'image sizing', array(
			'id'			=> "{$prefix}image_layout",
			'hide_fields'	=> array(
				'original' => array( "{$prefix}thumb_proportions" ),
			)
		) ),

		// Image proportions
		Presscore_Meta_Box_Field_Template::get_as_array( 'image proportions', array( 'id' => "{$prefix}thumb_proportions" ) ),

		// Number of posts to display on one page
		array(
			'name'		=> _x( 'Number of items to display on one page:', 'backend metabox', 'the7mk2' ),
			'id'    	=> "{$prefix}ppp",
			'type'  	=> 'text',
			'std'   	=> '',
			'divider'	=> 'top'
		),

		// Loading mode
		Presscore_Meta_Box_Field_Template::get_as_array( 'loading mode', array( 'id' => "{$prefix}load_style", 'divider' => 'top' ) ),

		// Loading effect
		Presscore_Meta_Box_Field_Template::get_as_array( 'loading effect', array( 'id' => "{$prefix}load_effect" ) ),

		/////////////////////////
		// Advanced settings //
		/////////////////////////

		// Show projects titles
		array(
			'name'    	=> _x('Show items titles:', 'backend metabox', 'the7mk2'),
			'id'      	=> "{$prefix}show_titles",
			'type'    	=> 'radio',
			'std'		=> '1',
			'options'	=> $yes_no_options,
			'before'	=> presscore_meta_boxes_advanced_settings_tpl('dt_portfolio-advanced'), // advanced settings
		),

		// Show excerpts
		Presscore_Meta_Box_Field_Template::get_as_array( 'radio yes no', array( 'id' => "{$prefix}show_exerpts", 'name' => _x( 'Show items captions:', 'backend metabox', 'the7mk2' ) ) ),

		// Show all pages in paginator
		Presscore_Meta_Box_Field_Template::get_as_array( 'show all pages paginator', array( 'id' => "{$prefix}show_all_pages", 'divider' => 'top' ) ),

		// Order
		Presscore_Meta_Box_Field_Template::get_as_array( 'order', array( 'id' => "{$prefix}order", 'divider' => 'top' ) ),

		// Orderby
		Presscore_Meta_Box_Field_Template::get_as_array( 'orderby', array( 'id' => "{$prefix}orderby", 'after' => '</div>' ) ),

	),

	'only_on'	=> array( 'template' => array('template-media.php', 'template-media-jgrid.php') ),
);

/***********************************************************/
// Albums post media
/***********************************************************/

$prefix = '_dt_album_media_';

$DT_META_BOXES[] = array(
	'id'		=> 'dt_page_box-album_post_media',
	'title' 	=> _x('Add/Edit Media', 'backend metabox', 'the7mk2'),
	'pages' 	=> array( 'dt_gallery' ),
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

/////////////////////////////////
// Single album media settings //
/////////////////////////////////

$prefix = '_dt_album_options_';

$DT_META_BOXES[] = array(
	'id'		=> 'dt_page_box-album_options',
	'title' 	=> _x('Album Options', 'backend metabox', 'the7mk2'),
	'pages' 	=> array( 'dt_gallery' ),
	'context' 	=> 'normal',
	'priority' 	=> 'high',
	'fields' 	=> array(

		// Back button
		Presscore_Meta_Box_Field_Template::get_as_array( 'select pages', array(
			'name'		=> _x('Back button:', 'backend metabox', 'the7mk2'),
			'id'		=> "{$prefix}back_button",
			'divider'	=> 'bottom'
		) ),

		///////////////////////////
		// Open slideshow with //
		///////////////////////////

		array(
			'name'     		=> _x('Open album:', 'backend metabox', 'the7mk2'),
			'id'       		=> "{$prefix}open_album",
			'type'     		=> 'radio',
			'std'			=> 'lightbox',
			'options'  		=> array(
				'lightbox' => _x( 'Lightbox', 'backend metabox', 'the7mk2' ),
				'post' => _x( 'Album page', 'backend metabox', 'the7mk2' )
			),
			'bottom_divider'	=> true
		),

		/////////////////////
		// Show media as //
		/////////////////////

		array(
			'name'    	=> _x('Show media as:', 'backend metabox', 'the7mk2'),
			'id'      	=> "{$prefix}type",
			'type'    	=> 'radio',
			'std'		=> 'slideshow',
			'options'	=> array(
				'slideshow'			=> array( _x('Slideshow', 'backend metabox', 'the7mk2'), array('layout-slider.gif', 75, 50) ),
				'gallery' 			=> array( _x('Gallery', 'backend metabox', 'the7mk2'), array('layout-metro.gif', 75, 50) ),
				'list'				=> array( _x('List', 'backend metabox', 'the7mk2'), array('layout-list.gif', 75, 50) ),
				'photo_scroller' 	=> array( _x('PhotoScroller', 'backend metabox', 'the7mk2'), array('photoscroller.gif', 75, 50) ),
				'masonry_grid' 		=> array( _x('Masonry & Grid', 'backend metabox', 'the7mk2'), array('gallery-masonry-and-grid.gif', 75, 50) ),
				'jgrid' 			=> array( _x('Justified Grid', 'backend metabox', 'the7mk2'), array('gallery-j-grid.gif', 75, 50) )
			),
			'hide_fields'		=> array(
				'gallery' 			=> array( "{$prefix}slider_proportions", "{$prefix}photo_scroller_container", "{$prefix}masonry_grid_container", "{$prefix}jgrid_container" ),
				'list'				=> array( "{$prefix}slider_proportions", "{$prefix}gallery_container", "{$prefix}photo_scroller_container", "{$prefix}masonry_grid_container", "{$prefix}jgrid_container" ),
				'slideshow'			=> array( "{$prefix}gallery_container", "{$prefix}photo_scroller_container", "{$prefix}masonry_grid_container", "{$prefix}jgrid_container" ),
				'photo_scroller'	=> array( "{$prefix}slider_proportions", "{$prefix}gallery_container", "{$prefix}masonry_grid_container", "{$prefix}jgrid_container" ),
				'masonry_grid'		=> array( "{$prefix}slider_proportions", "{$prefix}gallery_container", "{$prefix}photo_scroller_container", "{$prefix}jgrid_container" ),
				'jgrid'				=> array( "{$prefix}slider_proportions", "{$prefix}gallery_container", "{$prefix}photo_scroller_container", "{$prefix}masonry_grid_container" )
			)
		),

		//////////////////////////
		// Slider proportions //
		//////////////////////////

		array(
			'name'			=> _x('Slider proportions:', 'backend metabox', 'the7mk2'),
			'id'    		=> "{$prefix}slider_proportions",
			'type'  		=> 'simple_proportions',
			'std'   		=> array( 'width' => '', 'height' => '' ),
			'top_divider'	=> true
		),

		///////////////////////////////
		// Gallery container begin //
		///////////////////////////////

		array(
			// container begin !!!
			'before'		=> '<div class="rwmb-input-' . $prefix . 'gallery_container rwmb-flickering-field">',

			'name'     		=> _x('Columns:', 'backend metabox', 'the7mk2'),
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

		array(
			'name'    		=> _x('Make first image large:', 'backend metabox', 'the7mk2'),
			'id'      		=> "{$prefix}gallery_make_first_big",
			'type'    		=> 'checkbox',
			'std'			=> 1,

			// container end !!!
			'after'			=> '</div>',
		),

		/////////////////////////////
		// Gallery container end //
		/////////////////////////////


		////////////////////////////////////
		// PhotoScroller container begin//
		////////////////////////////////////

		array(
			// container begin !!!
			'before'	=> '<div class="rwmb-input-' . $prefix . 'photo_scroller_container rwmb-flickering-field">',

			'name'		=> _x( 'Layout:', 'backend metabox', 'the7mk2' ),
			'id'		=> "{$prefix}photo_scroller_layout",
			'type'		=> 'radio',
			'std'		=> 'fullscreen',
			'options'	=> array(
				'fullscreen'	=> _x( 'Fullscreen slideshow', 'backend metabox', 'the7mk2' ),
				'with_content'	=> _x( 'Fullscreen slideshow + text area', 'backend metabox', 'the7mk2' )
			),
			'divider'	=> 'top'
		),

		//////////////////////////////////////
		// New slideshow background color //
		//////////////////////////////////////

		array(
			'name'     		=> _x( 'Background under slideshow:', 'backend metabox', 'the7mk2' ),
			'id'       		=> "{$prefix}photo_scroller_bg_color",
			'type'     		=> 'color',
			'std'			=> '#000000',
			'divider'		=> 'top'
		),

		// PhotoScroller pixel overlay
		Presscore_Meta_Box_Field_Template::get_as_array( 'radio yes no', array(
			'id'		=> "{$prefix}photo_scroller_overlay",
			'name'		=> _x( 'Show pixel overlay:', 'backend metabox', 'the7mk2' ),
			'divider'	=> 'top'
		) ),

		/////////////////////////////////
		// New slideshow Top padding //
		/////////////////////////////////

		array(
			'name'			=> _x('Top padding:', 'backend metabox', 'the7mk2'),
			'id'			=> "{$prefix}photo_scroller_top_padding",
			'type'			=> 'text',
			'std'			=> '0',
			'divider'		=> 'top'
		),

		////////////////////////////////////
		// New slideshow Bottom padding //
		////////////////////////////////////

		array(
			'name'			=> _x('Bottom padding:', 'backend metabox', 'the7mk2'),
			'id'			=> "{$prefix}photo_scroller_bottom_padding",
			'type'			=> 'text',
			'std'			=> '0',
			'divider'		=> 'top'
		),

		///////////////////////////////////
		// New slideshow Side paddings //
		///////////////////////////////////

		array(
			'name'			=> _x('Side paddings:', 'backend metabox', 'the7mk2'),
			'id'			=> "{$prefix}photo_scroller_side_paddings",
			'type'			=> 'text',
			'std'			=> '0',
			'divider'		=> 'top'
		),

		/////////////////////////////////////////////////
		// New slideshow Inactive image transparency //
		/////////////////////////////////////////////////

		Presscore_Meta_Box_Field_Template::get_as_array( 'opacity slider', array(
			'name'		=> _x( 'Inactive image opacity (%):', 'backend metabox', 'the7mk2' ),
			'id'		=> "{$prefix}photo_scroller_inactive_opacity",
			'std' => 15,
			'divider'	=> 'top'
		) ),

		///////////////////////////////////////////
		// New slideshow Thumbnails visibility //
		///////////////////////////////////////////

		array(
			'name'     	=> _x( 'Thumbnails:', 'backend metabox', 'the7mk2' ),
			'id'       	=> "{$prefix}photo_scroller_thumbnails_visibility",
			'type'     	=> 'radio',
			'std'		=> 'show',
			'options'  	=> array(
				'show'		=> _x( 'Show by default', 'backend metabox', 'the7mk2' ),
				'hide'		=> _x( 'Hide by default', 'backend metabox', 'the7mk2' ),
				'disabled'	=> _x( 'Disable', 'backend metabox', 'the7mk2' )
			),
			'divider'	=> 'top'
		),

		//////////////////////////////////////
		// New slideshow Thumbnails width //
		//////////////////////////////////////

		array(
			'name'		=> _x( 'Thumbnails width:', 'backend metabox', 'the7mk2' ),
			'id'		=> "{$prefix}photo_scroller_thumbnails_width",
			'type'		=> 'text',
			'std'		=> '',
			'divider'	=> 'top'
		),

		//////////////////////////////////////
		// New slideshow Thumbnails height //
		//////////////////////////////////////

		array(
			'name'		=> _x( 'Thumbnails height:', 'backend metabox', 'the7mk2' ),
			'id'		=> "{$prefix}photo_scroller_thumbnails_height",
			'type'		=> 'text',
			'std'		=> 85,
			'divider'	=> 'top'
		),

		//////////////////////////////
		// New slideshow Autoplay //
		//////////////////////////////

		array(
			'name'     	=> _x( 'Autoplay:', 'backend metabox', 'the7mk2' ),
			'id'       	=> "{$prefix}photo_scroller_autoplay",
			'type'     	=> 'radio',
			'std'		=> 'play',
			'options'  	=> array(
				'play'		=> _x( 'Play', 'backend metabox', 'the7mk2' ),
				'paused'	=> _x( 'Paused', 'backend metabox', 'the7mk2' ),
			),
			'divider'	=> 'top'
		),

		////////////////////////////////////
		// New slideshow Autoplay speed //
		////////////////////////////////////

		array(
			'name'		=> _x( 'Autoplay speed:', 'backend metabox', 'the7mk2' ),
			'id'		=> "{$prefix}photo_scroller_autoplay_speed",
			'type'		=> 'text',
			'std'		=> '4000',
			'divider'	=> 'top'
		),

		////////////////////////
		// Landscape images //
		////////////////////////

		array(
			'type' => 'heading',
			'name' => _x( 'Landscape images', 'backend metabox', 'the7mk2' ),
			'id' => 'fake_id',
			'divider' => 'top'
		),

		Presscore_Meta_Box_Field_Template::get_as_array( 'photoscroller max width', array(
			'id' => "{$prefix}photo_scroller_ls_max_width",
		) ),

		Presscore_Meta_Box_Field_Template::get_as_array( 'photoscroller min width', array(
			'id' => "{$prefix}photo_scroller_ls_min_width",
		) ),

		Presscore_Meta_Box_Field_Template::get_as_array( 'photoscroller filling mode desktop', array(
			'id' => "{$prefix}photo_scroller_ls_fill_dt",
		) ),

		Presscore_Meta_Box_Field_Template::get_as_array( 'photoscroller filling mode mobile', array(
			'id' => "{$prefix}photo_scroller_ls_fill_mob",
		) ),

		///////////////////////
		// Portrait images //
		///////////////////////

		array(
			'type' => 'heading',
			'name' => _x( 'Portrait images', 'backend metabox', 'the7mk2' ),
			'id' => 'fake_id',
			'divider' => 'top'
		),

		Presscore_Meta_Box_Field_Template::get_as_array( 'photoscroller max width', array(
			'id' => "{$prefix}photo_scroller_pt_max_width",
		) ),

		Presscore_Meta_Box_Field_Template::get_as_array( 'photoscroller min width', array(
			'id' => "{$prefix}photo_scroller_pt_min_width",
		) ),

		Presscore_Meta_Box_Field_Template::get_as_array( 'photoscroller filling mode desktop', array(
			'id' => "{$prefix}photo_scroller_pt_fill_dt",
		) ),

		Presscore_Meta_Box_Field_Template::get_as_array( 'photoscroller filling mode mobile', array(
			'id' => "{$prefix}photo_scroller_pt_fill_mob",

			// container end !!!
			'after' => '</div>',
		) ),

		///////////////////////////////////
		// PhotoScroller container end //
		///////////////////////////////////


		//////////////////////////////////////
		// Masonry & Grid container begin //
		//////////////////////////////////////

		// Masonry layout
		Presscore_Meta_Box_Field_Template::get_as_array( 'masonry layout', array(
			// container begin !!!
			'before' => '<div class="rwmb-input-' . $prefix . 'masonry_grid_container rwmb-flickering-field">',

			'id' => "{$prefix}mg_layout",
			'divider' => 'top',
			'options' => array(
				'masonry'	=> array( _x( 'Masonry', 'backend metabox', 'the7mk2' ), array( 'gallery-masonry.gif', 60, 48 ) ),
				'grid'		=> array( _x( 'Grid', 'backend metabox', 'the7mk2' ), array( 'gallery-grid.gif', 60, 48 ) )
			)
		) ),

		// Gap between images
		Presscore_Meta_Box_Field_Template::get_as_array( 'gap between images', array(
			'id' => "{$prefix}mg_item_padding",
			'divider' => 'top'
		) ),

		// Column target width (px)
		Presscore_Meta_Box_Field_Template::get_as_array( 'column target width', array( 'id' => "{$prefix}mg_target_width" ) ),

		// Columns number
		Presscore_Meta_Box_Field_Template::get_as_array( 'columns number', array( 'id' => "{$prefix}mg_columns_number" ) ),

		// Make all 100% width
		Presscore_Meta_Box_Field_Template::get_as_array( '100 percent width', array( 'id' => "{$prefix}mg_full_width" ) ),

		///////////////////////
		// Common settings //
		///////////////////////

		// Image sizing
		Presscore_Meta_Box_Field_Template::get_as_array( 'image sizing', array(
			'id'			=> "{$prefix}mg_image_layout",
			'hide_fields'	=> array(
				'original' => array( "{$prefix}mg_thumb_proportions" ),
			)
		) ),

		// Image proportions
		Presscore_Meta_Box_Field_Template::get_as_array( 'image proportions', array( 'id' => "{$prefix}mg_thumb_proportions" ) ),

		// Loading effect
		Presscore_Meta_Box_Field_Template::get_as_array( 'loading effect', array(
			'id' => "{$prefix}mg_load_effect",

			// container end !!!
			'after' => '</div>'
		) ),

		////////////////////////////////////
		// Masonry & Grid container end //
		////////////////////////////////////


		/////////////////////////////////////
		// JustifiedGrid container begin //
		/////////////////////////////////////

		// Gap between images
		Presscore_Meta_Box_Field_Template::get_as_array( 'gap between images', array(
			// container begin !!!
			'before' => '<div class="rwmb-input-' . $prefix . 'jgrid_container rwmb-flickering-field">',

			'id' => "{$prefix}jg_item_padding",
			'divider' => 'top'
		) ),

		// Row target height (px)
		Presscore_Meta_Box_Field_Template::get_as_array( 'row target height', array( 'id' => "{$prefix}jg_target_height" ) ),

		// Make all 100% width
		Presscore_Meta_Box_Field_Template::get_as_array( '100 percent width', array( 'id' => "{$prefix}jg_full_width" ) ),

		// Hide last row
		Presscore_Meta_Box_Field_Template::get_as_array( 'hide last row', array( 'id' => "{$prefix}jg_hide_last_row" ) ),

		///////////////////////
		// Common settings //
		///////////////////////

		// Image sizing
		Presscore_Meta_Box_Field_Template::get_as_array( 'image sizing', array(
			'id'			=> "{$prefix}jg_image_layout",
			'hide_fields'	=> array(
				'original' => array( "{$prefix}jg_thumb_proportions" ),
			)
		) ),

		// Image proportions
		Presscore_Meta_Box_Field_Template::get_as_array( 'image proportions', array( 'id' => "{$prefix}jg_thumb_proportions" ) ),

		// Loading effect
		Presscore_Meta_Box_Field_Template::get_as_array( 'loading effect', array(
			'id' => "{$prefix}jg_load_effect",

			// container end !!!
			'after' => '</div>'
		) ),

		///////////////////////////////////
		// JustifiedGrid container end //
		///////////////////////////////////


		////////////////////////////////////////
		// Hide featured image on post page //
		////////////////////////////////////////

		array(
			'name'    	=> _x( 'Exclude featured image from the album:', 'backend metabox', 'the7mk2' ),
			'id'      	=> "{$prefix}exclude_featured_image",
			'type'    	=> 'checkbox',
			'std'		=> 0,
			'divider'	=> 'top'
		),

		///////////////////////////////////////////
		//  Post preview width (radio buttons) //
		///////////////////////////////////////////

		array(
			'name'    	=> _x( 'Album preview width:', 'backend metabox', 'the7mk2' ),
			'id'      	=> "{$prefix}preview",
			'type'    	=> 'radio',
			'std'		=> 'normal',
			'options'	=> array(
				'normal'	=> _x('normal', 'backend metabox', 'the7mk2'),
				'wide'		=> _x('wide', 'backend metabox', 'the7mk2'),
			),
			'divider'	=> 'top',
		),

	),
);
