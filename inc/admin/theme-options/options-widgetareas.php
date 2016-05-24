<?php
/**
 * Widgetareas.
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Page definition.
 */
$options[] = array(
	"page_title"    => _x( "Widget Areas", 'theme-options', 'the7mk2' ),
	"menu_title"    => _x( "Widget Areas", 'theme-options', 'the7mk2' ),
	"menu_slug"     => "of-widgetareas-menu",
	"type"          => "page"
);

/**
 * Heading definition.
 */
$options[] = array( "name" => _x( "Widget Areas", 'theme-options', 'the7mk2' ), "type" => "heading" );

/**
 * Widget areas.
 */
$options[] = array(	"name" => _x( 'Widget areas', 'theme-options', 'the7mk2' ), "type" => "block_begin" );

	// fields_generator
	$options[] = array(
		'id'        => 'widgetareas',
		'type'      => 'fields_generator',
		'std'       => array(
			1 => array(
					'sidebar_name'  => _x( 'Default Sidebar', 'theme-options', 'the7mk2' ),
					'sidebar_desc'  => _x( 'Sidebar primary widget area', 'theme-options', 'the7mk2' )
			),
			2 => array(
					'sidebar_name'  => _x( 'Default Footer', 'theme-options', 'the7mk2' ),
					'sidebar_desc'  => _x( 'Footer primary widget area', 'theme-options', 'the7mk2' )
			)
		),
		'options'   => array(
			'title' => _x( 'Add new widget area', 'theme-options', 'the7mk2' ),
			'fields' => array(
				'sidebar_name'   => array(
					'type'          => 'text',
					'class'         => 'of_fields_gen_title',
					'description'   => _x( 'Sidebar name', 'theme-options', 'the7mk2' ),
					'wrap'          => '<label>%2$s%1$s</label>',
					'desc_wrap'     => '%2$s'
				),
				'sidebar_desc'   => array(
					'type'          => 'textarea',
					'description'   => _x( 'Sidebar description (optional)', 'theme-options', 'the7mk2' ),
					'wrap'          => '<label>%2$s%1$s</label>',
					'desc_wrap'     => '%2$s'
				)
			)
		)
	);

$options[] = array(	"type" => "block_end" );
