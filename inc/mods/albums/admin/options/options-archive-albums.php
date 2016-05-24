<?php
/**
 * Albums archive options.
 *
 * @package the7
 * @since 3.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

$new_options[] = array( 'name' => _x( 'Albums archives', 'theme-options', 'the7mk2' ), 'type' => 'block' );

	$new_options['template_page_id_gallery_category'] = array(
		'id'		=> 'template_page_id_gallery_category',
		'name'		=> _x( 'Albums category template', 'theme-options', 'the7mk2' ),
		'type'		=> 'pages_list',
	);

// add new options
if ( isset( $options ) ) {
	$options = dt_array_push_after( $options, $new_options, 'archive_placeholder' );
}

// cleanup
unset( $new_options );