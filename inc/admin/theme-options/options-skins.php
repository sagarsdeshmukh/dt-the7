<?php
/**
 * Skins.
 *
 * @package the7
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$options[] = array(
	'desc' => sprintf( _x( "<strong>Attention!</strong> Changing skin will overwrite most of your settings.\nYou may want to use <a href='%s'>Export/Import Options</a> interface to backup your current theme options.", 'theme-options', 'the7mk2' ), admin_url( 'admin.php?page=of-importexport-menu' ) ),
	'type' => 'info',
);

$options[] = array( 'name' => _x( 'Skins', 'theme-options', 'the7mk2' ), 'type' => 'heading' );

	$options[] = array( 'name' => _x( 'Skins', 'theme-options', 'the7mk2' ), 'type' => 'block' );

		$options['preset'] = array(
			'id' => 'preset',
			'std' => 'none',
			'type' => 'images',
			'options' => optionsframework_get_presets_list(),
		);
