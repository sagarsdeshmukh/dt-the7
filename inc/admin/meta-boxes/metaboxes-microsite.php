<?php
/**
 * Microsite meta boxes.
 *
 * @package the7
 * @since 2.2.0
 */

// File Security Check.
if ( ! defined( 'ABSPATH' ) ) { exit; }

$nav_menus_clear = array( -1 => _x( 'Default menu', 'backend metabox', 'the7mk2' ) );
$nav_menus = wp_get_nav_menus();
foreach ( $nav_menus as $nav_menu ) {
	$nav_menus_clear[ $nav_menu->term_id ] = wp_html_excerpt( $nav_menu->name, 40, '&hellip;' );
}

$logo_field_title = _x( 'Logo:', 'backend metabox', 'the7mk2' );
$logo_hd_field_title = _x( 'High-DPI (retina) logo:', 'backend metabox', 'the7mk2' );

$prefix = '_dt_microsite_';

$DT_META_BOXES[] = array(
	'id'       => 'dt_page_box-microsite',
	'title'    => _x( 'Microsite', 'backend metabox', 'the7mk2' ),
	'pages'    => array( 'page' ),
	'context'  => 'side',
	'priority' => 'default',
	'fields'   => array(

		array(
			'name'    => _x( 'Page layout:', 'backend metabox', 'the7mk2' ),
			'id'      => "{$prefix}page_layout",
			'type'    => 'radio',
			'std'     => 'wide',
			'options' => array(
				'wide'  => _x( 'full-width', 'backend metabox', 'the7mk2' ),
				'boxed' => _x( 'boxed', 'backend metabox', 'the7mk2' ),
			),
		),

		array(
			'name'        => _x( 'Hide:', 'backend metabox', 'the7mk2' ),
			'id'          => "{$prefix}hidden_parts",
			'type'        => 'checkbox_list',
			'options'     => array(
				'header'        => _x( 'header &amp; top bar', 'backend metabox', 'the7mk2' ),
				'floating_menu' => _x( 'floating menu', 'backend metabox', 'the7mk2' ),
				'content'       => _x( 'content area', 'backend metabox', 'the7mk2' ),
				'bottom_bar'    => _x( 'bottom bar', 'backend metabox', 'the7mk2' ),
			),
			'top_divider' => true,
		),

		array(
			'name'        => _x( 'Beautiful loading:', 'backend metabox', 'the7mk2' ),
			'id'          => "{$prefix}page_loading",
			'type'        => 'radio',
			'std'         => 'enabled',
			'options'     => array(
				'enabled'  => _x( 'Enabled', 'backend metabox', 'the7mk2' ),
				'disabled' => _x( 'Disabled', 'backend metabox', 'the7mk2' ),
			),
			'top_divider' => true,
		),

		array(
			'name' => _x( 'MAIN LOGO', 'backend metabox', 'the7mk2' ),
			'id'   => 'main_logo_heading',
			'type' => 'heading',
		),

		array(
			'name'             => $logo_field_title,
			'id'               => "{$prefix}main_logo_regular",
			'type'             => 'image_advanced_mk2',
			'max_file_uploads' => 1,
		),

		array(
			'name'             => $logo_hd_field_title,
			'id'               => "{$prefix}main_logo_hd",
			'type'             => 'image_advanced_mk2',
			'max_file_uploads' => 1,
		),

		array(
			'name' => _x( 'TRANSPARENT HEADER LOGO', 'backend metabox', 'the7mk2' ),
			'id'   => 'transparent_logo_heading',
			'type' => 'heading',
		),

		array(
			'name'             => $logo_field_title,
			'id'               => "{$prefix}transparent_logo_regular",
			'type'             => 'image_advanced_mk2',
			'max_file_uploads' => 1,
		),

		array(
			'name'             => $logo_hd_field_title,
			'id'               => "{$prefix}transparent_logo_hd",
			'type'             => 'image_advanced_mk2',
			'max_file_uploads' => 1,
		),

		array(
			'name' => _x( 'MENU ICON, TOP LINE, SIDE LINE LOGO', 'backend metabox', 'the7mk2' ),
			'id'   => 'transparent_logo_heading',
			'type' => 'heading',
		),

		array(
			'name'             => $logo_field_title,
			'id'               => "{$prefix}mixed_logo_regular",
			'type'             => 'image_advanced_mk2',
			'max_file_uploads' => 1,
		),

		array(
			'name'             => $logo_hd_field_title,
			'id'               => "{$prefix}mixed_logo_hd",
			'type'             => 'image_advanced_mk2',
			'max_file_uploads' => 1,
		),

		array(
			'name' => _x( 'FLOATING NAVIGATION LOGO', 'backend metabox', 'the7mk2' ),
			'id'   => 'floating_logo_heading',
			'type' => 'heading',
		),

		array(
			'name'             => $logo_field_title,
			'id'               => "{$prefix}floating_logo_regular",
			'type'             => 'image_advanced_mk2',
			'max_file_uploads' => 1,
		),

		array(
			'name'             => $logo_hd_field_title,
			'id'               => "{$prefix}floating_logo_hd",
			'type'             => 'image_advanced_mk2',
			'max_file_uploads' => 1,
		),

		array(
			'name' => _x( 'MOBILE LOGO', 'backend metabox', 'the7mk2' ),
			'id'   => 'transparent_logo_heading',
			'type' => 'heading',
		),

		array(
			'name'             => $logo_field_title,
			'id'               => "{$prefix}mobile_logo_regular",
			'type'             => 'image_advanced_mk2',
			'max_file_uploads' => 1,
		),

		array(
			'name'             => $logo_hd_field_title,
			'id'               => "{$prefix}mobile_logo_hd",
			'type'             => 'image_advanced_mk2',
			'max_file_uploads' => 1,
		),

		array(
			'name' => _x( 'BOTTOM LINE LOGO', 'backend metabox', 'the7mk2' ),
			'id'   => 'bottom_logo_heading',
			'type' => 'heading',
		),

		array(
			'name'             => $logo_field_title,
			'id'               => "{$prefix}bottom_logo_regular",
			'type'             => 'image_advanced_mk2',
			'max_file_uploads' => 1,
		),

		array(
			'name'             => $logo_hd_field_title,
			'id'               => "{$prefix}bottom_logo_hd",
			'type'             => 'image_advanced_mk2',
			'max_file_uploads' => 1,
		),

		array(
			'name'             => _x( 'Favicon:', 'backend metabox', 'the7mk2' ),
			'id'               => "{$prefix}favicon",
			'type'             => 'image_advanced_mk2',
			'max_file_uploads' => 1,
			'top_divider'      => true,
		),

		array(
			'name'        => _x( 'Target link:', 'backend metabox', 'the7mk2' ),
			'id'          => "{$prefix}logo_link",
			'type'        => 'text',
			'std'         => '',
			'top_divider' => true,
		),

		array(
			'name'        => _x( 'Primary menu:', 'backend', 'the7mk2' ),
			'id'          => "{$prefix}primary_menu",
			'type'        => 'select',
			'options'     => $nav_menus_clear,
			'placeholder' => _x( 'Primary Menu location', 'backend metabox', 'the7mk2' ),
			'std'         => '',
			'top_divider' => true,
		),

		array(
			'name'        => _x( 'Split Menu Left:', 'backend', 'the7mk2' ),
			'id'          => "{$prefix}split_left_menu",
			'type'        => 'select',
			'options'     => $nav_menus_clear,
			'placeholder' => _x( 'Split Menu Left location', 'backend metabox', 'the7mk2' ),
			'std'         => '',
		),

		array(
			'name'        => _x( 'Split Menu Right:', 'backend', 'the7mk2' ),
			'id'          => "{$prefix}split_right_menu",
			'type'        => 'select',
			'options'     => $nav_menus_clear,
			'placeholder' => _x( 'Split Menu Right location', 'backend metabox', 'the7mk2' ),
			'std'         => '',
		),

		array(
			'name'        => _x( 'Mobile Menu:', 'backend', 'the7mk2' ),
			'id'          => "{$prefix}mobile_menu",
			'type'        => 'select',
			'options'     => $nav_menus_clear,
			'placeholder' => _x( 'Mobile Menu location', 'backend metabox', 'the7mk2' ),
			'std'         => '',
		),

	),
	'only_on' => array( 'template' => array( 'template-microsite.php' ) ),
);

unset( $nav_menus_clear, $logo_field_title, $logo_hd_field_title );
