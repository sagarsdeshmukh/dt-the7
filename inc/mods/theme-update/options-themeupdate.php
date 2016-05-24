<?php
/**
 * Theme update page.
 *
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Page definition.
 */
$options[] = array(
		"page_title"	=> _x( "Theme Update", 'theme-options', 'the7mk2' ),
		"menu_title"	=> _x( "Theme Update", 'theme-options', 'the7mk2' ),
		"menu_slug"		=> "of-themeupdate-menu",
		"type"			=> "page"
);

/**
 * Heading definition.
 */
$options[] = array( "name" => _x('Theme Update', 'theme-options', 'the7mk2'), "type" => "heading" );

/**
 * User credentials.
 */
$options[] = array(	"name" => _x('Theme info', 'theme-options', 'the7mk2'), "type" => "block_begin" );

	// info
	$options[] = array(
		"id"		=> 'theme_update-user_name',
		"type"		=> 'info',
		"desc"		=> sprintf(
			/* translators: 1 - Theme name, 2 - Theme version, 3 - Link to tgm page, 4 - Changelog url */
			_x( 'Activated theme version is %1$s ver. %2$s

				%3$s<a href="%4$s" target="_blank">Check theme changelog</a>', 'theme-options', 'the7mk2' ),
			wp_get_theme()->get( 'Name' ),
			wp_get_theme()->get( 'Version' ),
			presscore_theme_update_get_install_plugins_link(),
			presscore_theme_update_get_changelog_url()
		)
	);

$options[] = array(	"type" => "block_end");

/**
 * User credentials.
 */
$options[] = array(	"name" => _x('User credentials', 'theme-options', 'the7mk2'), "type" => "block_begin" );

	// input
	$options[] = array(
		"name"		=> _x( 'Themeforest user name', 'theme-options', 'the7mk2' ),
		"id"		=> 'theme_update-user_name',
		"std"		=> '',
		"type"		=> 'text',
	//	"sanitize"	=> 'textarea'
	);

	// input
	$options[] = array(
		"name"		=> _x( 'Secret API key', 'theme-options', 'the7mk2' ),
		"id"		=> 'theme_update-api_key',
		"std"		=> '',
		"type"		=> 'password',
	//	"sanitize"	=> 'textarea'
	);

$options[] = array(	"type" => "block_end");
