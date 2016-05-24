<?php
/**
 * Options to inject in header.
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

$new_options = array();

$new_options[] = array( 'name' => _x( 'WPML language switcher', 'theme-options', 'the7mk2' ), 'type' => 'block' );

	presscore_options_apply_template( $new_options, 'basic-header-element', 'header-elements-language', array(
		'caption' => false,
		'icon' => false,
	) );

// add new options
if ( isset( $options ) ) {
	$options = dt_array_push_after( $options, $new_options, 'header-before-elements-placeholder' );
}

// cleanup
unset( $new_options );
