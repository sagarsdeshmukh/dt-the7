<?php
/**
 * Options to inject in header.
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

$new_options = array();

$new_options[] = array( 'name' => _x( 'WooCommerce shopping cart', 'theme-options', 'the7mk2' ), 'id' => 'microwidgets-cart-block', 'class' => 'block-disabled', 'type' => 'block' );

	presscore_options_apply_template( $new_options, 'basic-header-element', 'header-elements-woocommerce_cart', array(
		'caption' => array(
			'divider' => false,
		),
	) );

	$new_options[] = array( 'type' => 'divider' );

	$new_options['header-elements-woocommerce_cart-show_sub_cart'] = array(
		'id'		=> 'header-elements-woocommerce_cart-show_sub_cart',
		'name'		=> _x( 'Show drop down cart', 'theme-options', 'the7mk2' ),
		'type'  	=> 'checkbox',
		'std'		=> '1',
	);

	$new_options[] = array( 'type' => 'divider' );

	$new_options['header-elements-woocommerce_cart-show_subtotal'] = array(
		'id'		=> 'header-elements-woocommerce_cart-show_subtotal',
		'name'		=> _x( 'Show cart subtotal', 'theme-options', 'the7mk2' ),
		'type'  	=> 'checkbox',
		'std'		=> '0',
	);

	$new_options[] = array( 'type' => 'divider' );

	$new_options['header-elements-woocommerce_cart-show_counter'] = array(
		'id'		=> 'header-elements-woocommerce_cart-show_counter',
		'name'		=> _x( 'Show products counter', 'theme-options', 'the7mk2' ),
		'type'		=> 'radio',
		'std'		=> 'allways',
		'show_hide'	=> array( 'if_not_empty' => true, 'allways' => true ),
		'options'	=> array(
			'never'			=> _x( 'Never', 'theme-options', 'the7mk2' ),
			'if_not_empty'	=> _x( 'If not empty', 'theme-options', 'the7mk2' ),
			'allways'		=> _x( 'Allways', 'theme-options', 'the7mk2' ),
		),
	);

	$new_options[] = array( 'type' => 'js_hide_begin' );

		$new_options['header-elements-woocommerce_cart-counter-style'] = array(
			'id'		=> 'header-elements-woocommerce_cart-counter-style',
			'name'		=> _x( 'Products counter style', 'theme-options', 'the7mk2' ),
			'type'		=> 'radio',
			'std'		=> 'round',
			'options'	=> array(
				'round'			=> _x( 'Round', 'theme-options', 'the7mk2' ),
				'rectangular'	=> _x( 'Rectangular', 'theme-options', 'the7mk2' ),
			),
		);

		$new_options['header-elements-woocommerce_cart-counter-color'] = array(
			'id'	=> 'header-elements-woocommerce_cart-counter-color',
			'name'	=> _x( 'Products counter color', 'theme-options', 'the7mk2' ),
			'type'	=> 'color',
			'std'	=> '#ffffff',
		);

		$new_options['header-elements-woocommerce_cart-counter-bg'] = array(
			'id'		=> 'header-elements-woocommerce_cart-counter-bg',
			'name'		=> _x( 'Products counter background', 'theme-options', 'the7mk2' ),
			'type'		=> 'images',
			'class'     => 'small',
			'std'		=> 'accent',
			'options'	=> array(
				'accent'	=> array(
					'title' => _x( 'Accent', 'theme-options', 'the7mk2' ),
					'src' => '/inc/admin/assets/images/color-accent.gif',
				),
				'color'		=> array(
					'title' => _x( 'Custom color', 'theme-options', 'the7mk2' ),
					'src' => '/inc/admin/assets/images/color-custom.gif',
				),
				'gradient'	=> array(
					'title' => _x( 'Custom gradient', 'theme-options', 'the7mk2' ),
					'src' => '/inc/admin/assets/images/color-custom-gradient.gif',
				),
			),
		);

			$new_options['header-elements-woocommerce_cart-counter-bg-color'] = array(
				'id'         => 'header-elements-woocommerce_cart-counter-bg-color',
				'name'       => _x( 'Color', 'theme-options', 'the7mk2' ),
				'type'       => 'color',
				'std'        => '#000000',
				'dependency' => array(
					array(
						array(
							'field'    => 'header-elements-woocommerce_cart-counter-bg',
							'operator' => '==',
							'value'    => 'color',
						),
					),
				),
			);

			$new_options['header-elements-woocommerce_cart-counter-bg-gradient'] = array(
				'id'         => 'header-elements-woocommerce_cart-counter-bg-gradient',
				'name'       => _x( 'Gradient', 'theme-options', 'the7mk2' ),
				'type'       => 'gradient',
				'std'        => array( '#ffffff', '#000000' ),
				'dependency' => array(
					array(
						array(
							'field'    => 'header-elements-woocommerce_cart-counter-bg',
							'operator' => '==',
							'value'    => 'gradient',
						),
					),
				),
			);

	$new_options[] = array( 'type' => 'js_hide_end' );

// add new options
if ( isset( $options ) ) {
	$options = dt_array_push_after( $options, $new_options, 'header-before-elements-placeholder' );
}

// cleanup
unset( $new_options );
