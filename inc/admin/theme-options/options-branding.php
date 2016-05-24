<?php
/**
 * Branding theme options.
 *
 * @package the7
 * @since 1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

$options[] = array( 'name' => _x( 'Branding', 'theme-options', 'the7mk2' ), 'type' => 'heading' );

	$options[] = array( 'name' => _x( 'Main', 'theme-options', 'the7mk2' ), 'type' => 'block' );

		presscore_options_apply_template( $options, 'logo', 'header' );

		$options[] = array( 'type' => 'divider' );

		presscore_options_apply_template( $options, 'indents', 'header-logo-padding' );

	$options[] = array( 'name' => _x( 'Transparent header', 'theme-options', 'the7mk2' ), 'type' => 'block' );

		presscore_options_apply_template( $options, 'logo', 'header-style-transparent' );

		$options[] = array( 'type' => 'divider' );

		presscore_options_apply_template( $options, 'indents', 'header-style-transparent-logo-padding' );

	$options[] = array( 'name' => _x( 'Menu icon, top line, side line', 'theme-options', 'the7mk2' ), 'id' => 'branding-menu-icon-block', 'type' => 'block' );

		presscore_options_apply_template( $options, 'logo', 'header-style-mixed' );

		$options[] = array( 'type' => 'divider' );

		presscore_options_apply_template( $options, 'indents', 'header-style-mixed-logo-padding' );

	$options[] = array( 'name' => _x( 'Floating navigation', 'theme-options', 'the7mk2'), 'id' => 'branding-floating-nav-block', 'type' => 'block' );

		$options['header-style-floating-choose_logo'] = array(
			'id'		=> 'header-style-floating-choose_logo',
			'name'		=> _x( 'Show logo', 'theme-options', 'the7mk2' ),
			'std'		=> 'custom',
			'type'		=> 'radio',
			'options'	=> array(
				'custom' => _x( 'Custom logo', 'theme-options', 'the7mk2' ),
				'main'   => _x( 'Main logo', 'theme-options', 'the7mk2' ),
				'none'   => _x( 'Don\'t show', 'theme-options', 'the7mk2' ),
			),
		);

		presscore_options_apply_template( $options, 'logo', 'header-style-floating', array(), array(
			array(
				array(
					'field'    => 'header-style-floating-choose_logo',
					'operator' => '==',
					'value'    => 'custom',
				),
			),
		) );

		presscore_options_apply_template( $options, 'indents', 'header-style-floating-logo-padding',
			array(
				'top' => array(
					'divider' => 'top',
				),
			),
			array(
				array(
					array(
						'field'    => 'header-style-floating-choose_logo',
						'operator' => '==',
						'value'    => 'custom',
					),
				),
				array(
					array(
						'field'    => 'header-style-floating-choose_logo',
						'operator' => '==',
						'value'    => 'main',
					),
				),
			)
		);

	$options[] = array( 'name' => _x( 'Mobile', 'theme-options', 'the7mk2' ), 'type' => 'block' );

		$options['header-mobile-first_switch-logo'] = array(
			'id'      => 'header-mobile-first_switch-logo',
			'name'    => _x( 'First switch point (tablet)', 'theme-options', 'the7mk2' ),
			'type'    => 'radio',
			'std'     => 'mobile',
			'options' => array(
				'desktop'  => _x( 'Main logo', 'theme-options', 'the7mk2' ),
				'mobile'   => _x( 'Custom logo', 'theme-options', 'the7mk2' ),
			),
		);

		$options['header-mobile-second_switch-logo'] = array(
			'id'      => 'header-mobile-second_switch-logo',
			'name'    => _x( 'Second switch point (phone)', 'theme-options', 'the7mk2' ),
			'type'    => 'radio',
			'std'     => 'mobile',
			'options' => array(
				'desktop'  => _x( 'Main logo', 'theme-options', 'the7mk2' ),
				'mobile'   => _x( 'Custom logo', 'theme-options', 'the7mk2' ),
			),
		);

		presscore_options_apply_template( $options, 'logo', 'header-style-mobile', array(), array(
			array(
				array(
					'field'    => 'header-mobile-first_switch-logo',
					'operator' => '==',
					'value'    => 'mobile',
				),
			),
			array(
				array(
					'field'    => 'header-mobile-second_switch-logo',
					'operator' => '==',
					'value'    => 'mobile',
				),
			),
		) );

		$options[] = array( 'type' => 'divider' );

		presscore_options_apply_template( $options, 'indents', 'header-style-mobile-logo-padding' );

	$options[] = array( 'name' => _x( 'Bottom bar', 'theme-options', 'the7mk2' ), 'type' => 'block' );

		presscore_options_apply_template( $options, 'logo', 'bottom_bar' );

		$options[] = array( 'type' => 'divider' );

		presscore_options_apply_template( $options, 'indents', 'bottom_bar-logo-padding' );

	$options[] = array( 'name' => _x( 'Favicon', 'theme-options', 'the7mk2' ), 'type' => 'block' );

		$options['general-favicon'] = array(
			'id'	=> 'general-favicon',
			'name'	=> _x( 'Regular (16x16 px)', 'theme-options', 'the7mk2' ),
			'type'	=> 'upload',
			'std'	=> '',
		);

		$options['general-favicon_hd'] = array(
			'id'	=> 'general-favicon_hd',
			'name'	=> _x( 'High-DPI (32x32 px)', 'theme-options', 'the7mk2' ),
			'type'	=> 'upload',
			'std'	=> '',
		);

	$options[] = array( 'name' => _x( 'Icons for handheld devices', 'theme-options', 'the7mk2' ), 'type' => 'block' );

		$options['general-handheld_icon-old_iphone'] = array(
			'id'	=> 'general-handheld_icon-old_iphone',
			'name'	=> _x( '60x60 px (old iPhone)', 'theme-options', 'the7mk2' ),
			'type'	=> 'upload',
			'std'	=> '',
		);

		$options['general-handheld_icon-old_ipad'] = array(
			'id'	=> 'general-handheld_icon-old_ipad',
			'name'	=> _x( '76x76 px (old iPad)', 'theme-options', 'the7mk2' ),
			'type'	=> 'upload',
			'std'	=> '',
		);

		$options['general-handheld_icon-retina_iphone'] = array(
			'id'	=> 'general-handheld_icon-retina_iphone',
			'name'	=> _x( '120x120 px (retina iPhone)', 'theme-options', 'the7mk2' ),
			'type'	=> 'upload',
			'std'	=> '',
		);

		$options['general-handheld_icon-retina_ipad'] = array(
			'id'	=> 'general-handheld_icon-retina_ipad',
			'name'	=> _x( '152x152 px (retina iPad)', 'theme-options', 'the7mk2' ),
			'type'	=> 'upload',
			'std'	=> '',
		);

	$options[] = array(	'name' => _x( 'Copyright information', 'theme-options', 'the7mk2' ), 'type' => 'block' );

		$options['bottom_bar-copyrights'] = array(
			'id'		=> 'bottom_bar-copyrights',
			'name'		=> _x( 'Copyright information', 'theme-options', 'the7mk2' ),
			'type'		=> 'textarea',
			'std'		=> false,
		);

		$options['bottom_bar-credits'] = array(
			'id'		=> 'bottom_bar-credits',
			'name'		=> _x( 'Give credits to Dream-Theme', 'theme-options', 'the7mk2' ),
			'type'		=> 'checkbox',
			'std'		=> '1',
		);
