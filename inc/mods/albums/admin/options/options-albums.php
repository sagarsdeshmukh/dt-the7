<?php
/**
 * Templates settings
 *
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

$new_options = array();

////////////
// Albums //
////////////

/**
 * Heading definition.
 */
$new_options[] = array( "name" => _x("Gallery post", "theme-options", 'the7mk2'), "type" => "heading" );

	/**
	 * Previous &amp; next buttons
	 */
	$new_options[] = array(	"name" => _x('Previous &amp; next buttons', 'theme-options', 'the7mk2'), "type" => "block_begin" );

		// checkbox
		$new_options[] = array(
			"name"      => _x( 'Show in gallery albums', 'theme-options', 'the7mk2' ),
			"id"    	=> 'general-next_prev_in_album',
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
			"id"		=> 'general-show_back_button_in_album',
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
				"id"		=> 'general-album_back_button_target_page_id',
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
			"id"		=> 'general-album_meta_on',
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
				"id"    	=> 'general-album_meta_date',
				"type"  	=> 'checkbox',
				'std'   	=> 1
			);

			// checkbox
			$new_options[] = array(
				"desc"  	=> '',
				"name"      => _x( 'Author', 'theme-options', 'the7mk2' ),
				"id"    	=> 'general-album_meta_author',
				"type"  	=> 'checkbox',
				'std'   	=> 1
			);

			// checkbox
			$new_options[] = array(
				"desc"  	=> '',
				"name"      => _x( 'Categories', 'theme-options', 'the7mk2' ),
				"id"    	=> 'general-album_meta_categories',
				"type"  	=> 'checkbox',
				'std'   	=> 1
			);

			// checkbox
			$new_options[] = array(
				"desc"  	=> '',
				"name"      => _x( 'Comments', 'theme-options', 'the7mk2' ),
				"id"    	=> 'general-album_meta_comments',
				"type"  	=> 'checkbox',
				'std'   	=> 1
			);

		$new_options[] = array( 'type' => 'js_hide_end' );

	$new_options[] = array( "type" => "block_end");

// add new options
if ( isset( $options ) ) {
	$options = dt_array_push_after( $options, $new_options, 'blog_and_portfolio_placeholder' );
}

// cleanup
unset( $new_options );
