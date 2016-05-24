<?php
/**
 * Templates settings
 *
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Page definition.
 */
$options[] = array(
		"page_title"	=> _x( "Blog, Portfolio, Gallery", "theme-options", 'the7mk2' ),
		"menu_title"	=> _x( "Blog, Portfolio, Gallery", "theme-options", 'the7mk2' ),
		"menu_slug"		=> "of-blog-and-portfolio-menu",
		"type"			=> "page"
);

//////////
// Blog //
//////////

/**
 * Heading definition.
 */
$options[] = array( "name" => _x("Blog post", "theme-options", 'the7mk2'), "type" => "heading" );

	/**
	 * Author info in posts
	 */
	$options[] = array(	"name" => _x('Author info in posts', 'theme-options', 'the7mk2'), "type" => "block_begin" );

		// checkbox
		$options[] = array(
			"name"      => _x( 'Show author info in blog posts', 'theme-options', 'the7mk2' ),
			"id"    	=> 'general-show_author_in_blog',
			'std'   	=> 1,
			'type'		=> 'images',
			'class'     => 'small',
			'options'	=> array(
				'1'    => array(
					'title' => _x( 'Enabled', 'theme-options', 'the7mk2' ),
					'src' => '/inc/admin/assets/images/general-show_author_in_blog-yes.gif',
				),
				'0'    => array(
					'title' => _x( 'Disabled', 'theme-options', 'the7mk2' ),
					'src' => '/inc/admin/assets/images/microwidgets-disabled.gif',
				),	
			),
		);

	$options[] = array(	"type" => "block_end");

	/**
	 * Previous &amp; next buttons
	 */
	$options[] = array(	"name" => _x('Previous &amp; next buttons', 'theme-options', 'the7mk2'), "type" => "block_begin" );

		// checkbox
		$options[] = array(
			"name"      => _x( 'Show in blog posts', 'theme-options', 'the7mk2' ),
			"id"    	=> 'general-next_prev_in_blog',
			'type'		=> 'images',
			'class'     => 'small',
			'std'   	=> 1,
			'options'	=> array(
				'1'    => array(
					'title' => _x( 'Enabled', 'theme-options', 'the7mk2' ),
					'src' => '/inc/admin/assets/images/general-next-prev-enabled.gif',
				),
				'0'    => array(
					'title' => _x( 'Disabled', 'theme-options', 'the7mk2' ),
					'src' => '/inc/admin/assets/images/microwidgets-disabled.gif',
				),	
			),
		);

	$options[] = array(	"type" => "block_end");

	/**
	 * Back button.
	 */
	$options[] = array(	"name" => _x('Back button', 'theme-options', 'the7mk2'), "type" => "block_begin" );

		// radio
		$options[] = array(
			"desc"		=> '',
			"name"		=> _x('Back button', 'theme-options', 'the7mk2'),
			"id"		=> 'general-show_back_button_in_post',
			"std"		=> '0',
			'type'		=> 'images',
			'class'     => 'small',
			'options'	=> array(
				'1'    => array(
					'title' => _x( 'Enabled', 'theme-options', 'the7mk2' ),
					'src' => '/inc/admin/assets/images/general-show-back-button-enabled.gif',
				),
				'0'    => array(
					'title' => _x( 'Disabled', 'theme-options', 'the7mk2' ),
					'src' => '/inc/admin/assets/images/microwidgets-disabled.gif',
				),	
			),
			"show_hide"	=> array( '1' => true ),
		);

		// hidden area
		$options[] = array( 'type' => 'js_hide_begin' );

			// select
			$options[] = array(
				"name"		=> _x( 'Choose page', 'theme-options', 'the7mk2' ),
				"id"		=> 'general-post_back_button_target_page_id',
				"type"		=> 'pages_list'
			);

		$options[] = array( 'type' => 'js_hide_end' );

	$options[] = array(	"type" => "block_end");

	/**
	 * Meta information.
	 */
	$options[] = array(	"name" => _x('Meta information', 'theme-options', 'the7mk2'), "type" => "block_begin" );

		// radio
		$options[] = array(
			"desc"		=> '',
			"name"		=> _x('Meta information', 'theme-options', 'the7mk2'),
			"id"		=> 'general-blog_meta_on',
			"std"		=> '1',
			'type'		=> 'images',
			'class'     => 'small',
			'options'	=> array(
				'1'    => array(
					'title' => _x( 'Enabled', 'theme-options', 'the7mk2' ),
					'src' => '/inc/admin/assets/images/general-album_meta_on-enabled.gif',
				),
				'0'    => array(
					'title' => _x( 'Disabled', 'theme-options', 'the7mk2' ),
					'src' => '/inc/admin/assets/images/microwidgets-disabled.gif',
				),	
			),
			"show_hide"	=> array( '1' => true ),
		);

		// hidden area
		$options[] = array( 'type' => 'js_hide_begin' );

			// checkbox
			$options[] = array(
				"desc"  	=> '',
				"name"      => _x( 'Date', 'theme-options', 'the7mk2' ),
				"id"    	=> 'general-blog_meta_date',
				"type"  	=> 'checkbox',
				'std'   	=> 1
			);

			// checkbox
			$options[] = array(
				"desc"  	=> '',
				"name"      => _x( 'Author', 'theme-options', 'the7mk2' ),
				"id"    	=> 'general-blog_meta_author',
				"type"  	=> 'checkbox',
				'std'   	=> 1
			);

			// checkbox
			$options[] = array(
				"desc"  	=> '',
				"name"      => _x( 'Categories', 'theme-options', 'the7mk2' ),
				"id"    	=> 'general-blog_meta_categories',
				"type"  	=> 'checkbox',
				'std'   	=> 1
			);

			// checkbox
			$options[] = array(
				"desc"  	=> '',
				"name"      => _x( 'Comments', 'theme-options', 'the7mk2' ),
				"id"    	=> 'general-blog_meta_comments',
				"type"  	=> 'checkbox',
				'std'   	=> 1
			);

			// checkbox
			$options[] = array(
				"desc"  	=> '',
				"name"      => _x( 'Tags', 'theme-options', 'the7mk2' ),
				"id"    	=> 'general-blog_meta_tags',
				"type"  	=> 'checkbox',
				'std'   	=> 1
			);

		$options[] = array( 'type' => 'js_hide_end' );

	$options[] = array(	"type" => "block_end");

	/**
	 * Related posts.
	 */
	$options[] = array(	"name" => _x('Related posts', 'theme-options', 'the7mk2'), "type" => "block_begin" );

		// radio
		$options[] = array(
			"desc"		=> '',
			"name"		=> _x('Related posts', 'theme-options', 'the7mk2'),
			"id"		=> 'general-show_rel_posts',
			"std"		=> '0',
			'type'		=> 'images',
			'class'     => 'small',
			'options'	=> array(
				'1'    => array(
					'title' => _x( 'Enabled', 'theme-options', 'the7mk2' ),
					'src' => '/inc/admin/assets/images/general-show_rel_posts-enabled.gif',
				),
				'0'    => array(
					'title' => _x( 'Disabled', 'theme-options', 'the7mk2' ),
					'src' => '/inc/admin/assets/images/microwidgets-disabled.gif',
				),	
			),
			"show_hide"	=> array( '1' => true ),
		);

		// hidden area
		$options[] = array( 'type' => 'js_hide_begin' );

			// input
			$options[] = array(
				"name"		=> _x( 'Title', 'theme-options', 'the7mk2' ),
				"id"		=> 'general-rel_posts_head_title',
				"std"		=> __('Related posts', 'the7mk2'),
				"type"		=> 'text',
			);

			// input
			$options[] = array(
				"name"		=> _x( 'Maximum number of related posts', 'theme-options', 'the7mk2' ),
				"id"		=> 'general-rel_posts_max',
				"std"		=> 6,
				"type"		=> 'text',
				// number
				"sanitize"	=> 'ppp'
			);

		$options[] = array( 'type' => 'js_hide_end' );

	$options[] = array(	"type" => "block_end");

// options placeholder
$options['blog_and_portfolio_placeholder'] = array();
