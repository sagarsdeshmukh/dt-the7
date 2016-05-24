<?php
/**
 * Templates settings
 *
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

$new_options = array();

///////////////
// Portfolio //
///////////////

/**
 * Heading definition.
 */
$new_options[] = array( "name" => _x("Portfolio post", "theme-options", 'the7mk2'), "type" => "heading" );

	/**
	 * Prev / Next buttons.
	 */
	$new_options[] = array(	"name" => _x('Previous &amp; next buttons', 'theme-options', 'the7mk2'), "type" => "block_begin" );

		// radio
		$new_options[] = array(
			"name"      => _x( 'Show in portfolio posts', 'theme-options', 'the7mk2' ),
			"id"    	=> 'general-next_prev_in_portfolio',
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

	$new_options[] = array(	"type" => "block_end");

	/**
	 * Back button.
	 */
	$new_options[] = array(	"name" => _x('Back button', 'theme-options', 'the7mk2'), "type" => "block_begin" );

		// radio
		$new_options[] = array(
			"desc"		=> '',
			"name"		=> _x('Back button', 'theme-options', 'the7mk2'),
			"id"		=> 'general-show_back_button_in_project',
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
		$new_options[] = array( 'type' => 'js_hide_begin' );

			// select
			$new_options[] = array(
				"name"		=> _x( 'Choose page', 'theme-options', 'the7mk2' ),
				"id"		=> 'general-project_back_button_target_page_id',
				"type"		=> 'pages_list'
			);

		$new_options[] = array( 'type' => 'js_hide_end' );

	$new_options[] = array(	"type" => "block_end");

	/**
	 * Meta information.
	 */
	$new_options[] = array(	"name" => _x('Meta information', 'theme-options', 'the7mk2'), "type" => "block_begin" );

		// radio
		$new_options[] = array(
			"desc"		=> '',
			"name"		=> _x('Meta information', 'theme-options', 'the7mk2'),
			"id"		=> 'general-portfolio_meta_on',
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
		$new_options[] = array( 'type' => 'js_hide_begin' );

			// checkbox
			$new_options[] = array(
				"desc"  	=> '',
				"name"      => _x( 'Date', 'theme-options', 'the7mk2' ),
				"id"    	=> 'general-portfolio_meta_date',
				"type"  	=> 'checkbox',
				'std'   	=> 1
			);

			// checkbox
			$new_options[] = array(
				"desc"  	=> '',
				"name"      => _x( 'Author', 'theme-options', 'the7mk2' ),
				"id"    	=> 'general-portfolio_meta_author',
				"type"  	=> 'checkbox',
				'std'   	=> 1
			);

			// checkbox
			$new_options[] = array(
				"desc"  	=> '',
				"name"      => _x( 'Categories', 'theme-options', 'the7mk2' ),
				"id"    	=> 'general-portfolio_meta_categories',
				"type"  	=> 'checkbox',
				'std'   	=> 1
			);

			// checkbox
			$new_options[] = array(
				"desc"  	=> '',
				"name"      => _x( 'Number of comments', 'theme-options', 'the7mk2' ),
				"id"    	=> 'general-portfolio_meta_comments',
				"type"  	=> 'checkbox',
				'std'   	=> 1
			);

		$new_options[] = array( 'type' => 'js_hide_end' );

	$new_options[] = array(	"type" => "block_end");

	/**
	 * Related projects.
	 */
	$new_options[] = array(	"name" => _x('Related projects', 'theme-options', 'the7mk2'), "type" => "block_begin" );

		// radio
		$new_options[] = array(
			"desc"		=> '',
			"name"		=> _x('Related projects', 'theme-options', 'the7mk2'),
			"id"		=> 'general-show_rel_projects',
			"std"		=> '0',
			'type'		=> 'images',
			'class'     => 'small',
			'options'	=> array(
				'1'    => array(
					'title' => _x( 'Enabled', 'theme-options', 'the7mk2' ),
					'src' => '/inc/admin/assets/images/general-show_rel_projects-enabled.gif',
				),
				'0'    => array(
					'title' => _x( 'Disabled', 'theme-options', 'the7mk2' ),
					'src' => '/inc/admin/assets/images/microwidgets-disabled.gif',
				),	
			),
			"show_hide"	=> array( '1' => true ),
		);

		// hidden area
		$new_options[] = array( 'type' => 'js_hide_begin' );

			// title
			$new_options[] = array(
				"name"		=> _x( 'Title', 'theme-options', 'the7mk2' ),
				"id"		=> 'general-rel_projects_head_title',
				"std"		=> __('Related projects', 'the7mk2'),
				"type"		=> 'text',
			);

			// show title
			$new_options[] = array(
				"name"		=> _x('Show titles', 'theme-options', 'the7mk2'),
				"id"		=> 'general-rel_projects_title',
				"std"		=> '1',
				"type"		=> 'checkbox'
			);

			// show excerpt
			$new_options[] = array(
				"name"		=> _x('Show excerpts', 'theme-options', 'the7mk2'),
				"id"		=> 'general-rel_projects_excerpt',
				"std"		=> '1',
				"type"		=> 'checkbox'
			);

			// show date
			$new_options[] = array(
				"name"		=> _x('Show date', 'theme-options', 'the7mk2'),
				"id"		=> 'general-rel_projects_info_date',
				"std"		=> '1',
				"type"		=> 'checkbox'
			);

			// show author
			$new_options[] = array(
				"name"		=> _x('Show author', 'theme-options', 'the7mk2'),
				"id"		=> 'general-rel_projects_info_author',
				"std"		=> '1',
				"type"		=> 'checkbox'
			);

			// show comments
			$new_options[] = array(
				"name"		=> _x('Show number of comments', 'theme-options', 'the7mk2'),
				"id"		=> 'general-rel_projects_info_comments',
				"std"		=> '1',
				"type"		=> 'checkbox'
			);

			// show categories
			$new_options[] = array(
				"name"		=> _x('Show categories', 'theme-options', 'the7mk2'),
				"id"		=> 'general-rel_projects_info_categories',
				"std"		=> '1',
				"type"		=> 'checkbox'
			);

			// show link
			$new_options[] = array(
				"name"		=> _x('Show links', 'theme-options', 'the7mk2'),
				"id"		=> 'general-rel_projects_link',
				"std"		=> '1',
				"type"		=> 'checkbox'
			);

			// show zoom
			$new_options[] = array(
				"name"		=> _x('Show zoom', 'theme-options', 'the7mk2'),
				"id"		=> 'general-rel_projects_zoom',
				"std"		=> '1',
				"type"		=> 'checkbox'
			);

			// show details
			$new_options[] = array(
				"name"		=> _x('Show "Details" button', 'theme-options', 'the7mk2'),
				"id"		=> 'general-rel_projects_details',
				"std"		=> '1',
				"type"		=> 'checkbox'
			);

			// posts per page
			$new_options[] = array(
				"name"		=> _x( 'Maximum number of projects posts', 'theme-options', 'the7mk2' ),
				"id"		=> 'general-rel_projects_max',
				"std"		=> 12,
				"type"		=> 'text',
				// number
				"sanitize"	=> 'ppp'
			);

			////////////////////////////////////
			// Related projects dimensions //
			////////////////////////////////////

			// input
			$new_options[] = array(
				"name"		=> _x( 'Related posts height for fullwidth posts (px)', 'theme-options', 'the7mk2' ),
				"id"		=> 'general-rel_projects_fullwidth_height',
				"std"		=> 210,
				"type"		=> 'text',
				// number
				"sanitize"	=> 'ppp'
			);

			// radio
			$new_options[] = array(
				"name"		=> _x('Related posts width for fullwidth posts', 'theme-options', 'the7mk2'),
				"id"		=> 'general-rel_projects_fullwidth_width_style',
				"std"		=> 'prop',
				"type"		=> 'radio',
				"options"	=> $prop_fixed_options,
				"show_hide"	=> array( 'fixed' => true ),
			);

			// hidden area
			$new_options[] = array( 'type' => 'js_hide_begin' );

				// input
				$new_options[] = array(
					"name"		=> _x( 'Width (px)', 'theme-options', 'the7mk2' ),
					"id"		=> 'general-rel_projects_fullwidth_width',
					"std"		=> '210',
					"type"		=> 'text',
					// number
					"sanitize"	=> 'ppp'
				);

			$new_options[] = array( 'type' => 'js_hide_end' );

			// input
			$new_options[] = array(
				"name"		=> _x( 'Related posts height for posts with sidebar (px)', 'theme-options', 'the7mk2' ),
				"id"		=> 'general-rel_projects_height',
				"std"		=> 180,
				"type"		=> 'text',
				// number
				"sanitize"	=> 'ppp'
			);

			// radio
			$new_options[] = array(
				"name"		=> _x( 'Related posts width for posts with sidebar', 'theme-options', 'the7mk2' ),
				"id"		=> 'general-rel_projects_width_style',
				"std"		=> 'prop',
				"type"		=> 'radio',
				"options"	=> $prop_fixed_options,
				"show_hide"	=> array( 'fixed' => true ),
			);

			// hidden area
			$new_options[] = array( 'type' => 'js_hide_begin' );

				// input
				$new_options[] = array(
					"name"		=> _x( 'Width (px)', 'theme-options', 'the7mk2' ),
					"id"		=> 'general-rel_projects_width',
					"std"		=> '180',
					"type"		=> 'text',
					// number
					"sanitize"	=> 'ppp'
				);

			$new_options[] = array( 'type' => 'js_hide_end' );

		$new_options[] = array( 'type' => 'js_hide_end' );

	$new_options[] = array(	"type" => "block_end");

// add new options
if ( isset( $options ) ) {
	$options = dt_array_push_after( $options, $new_options, 'blog_and_portfolio_placeholder' );
}

// cleanup
unset( $new_options );
