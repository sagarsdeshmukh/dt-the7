<?php
/**
 * Export/Import Options.
 *
 * @package the7
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$options[] = array(
	'desc' => _x( "Field below contains your current theme options in encrypted format.\nYou can copy and backup them in .txt file.\nTo restore settings, copy them from backup .txt file, paste into field below and hit the \"Save Options\" button.", 'theme-options', 'the7mk2' ),
	'type' => 'info',
);

$options[] = array( 'name' => _x( 'Export/Import Options', 'theme-options', 'the7mk2' ), 'type' => 'heading' );

	$options[] = array( 'name' => _x( 'Export/Import Options', 'theme-options', 'the7mk2' ), 'type' => 'block' );


		$options['import_export'] = array(
			'id' => 'import_export',
			'type' => 'import_export_options',
			'std' => '',
			'settings' => array( 'rows' => 16 ),
		);
