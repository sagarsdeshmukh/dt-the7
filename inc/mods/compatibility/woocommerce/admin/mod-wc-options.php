<?php
// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Page definition.
 */
$options[] = array(
	"page_title" => _x( "WooCommerce", 'theme-options', 'the7mk2' ),
	"menu_title" => _x( "WooCommerce", 'theme-options', 'the7mk2' ),
	"menu_slug" => "of-woocommerce-menu",
	"type" => "page"
);

/**
 * Heading definition.
 */
$options[] = array( "name" => _x('Item settings', 'theme-options', 'the7mk2'), "type" => "heading" );

/**
 * Item settings.
 */
$options[] = array( "name" => _x("Item settings", "theme-options", 'the7mk2'), "type" => "block_begin" );

	$options[] = array(
		"name" => _x( "Show product information", "theme-options", 'the7mk2' ),
		"id" => "woocommerce_display_product_info",
		"std" => "under_image",
		"type" => "radio",
		"options" => array(
			'under_image' => _x( "Under image", "theme-options", 'the7mk2' ),
			'on_hoover_centered' => _x( "On image hover", "theme-options", 'the7mk2' )
		)
	);

		$options[] = array(
			"name" => _x( '"Add to cart" button position', "theme-options", 'the7mk2' ),
			"id" => "woocommerce_add_to_cart_position",
			"std" => "on_image",
			"type" => "radio",
			"options" => array(
				'on_image' => _x( "On image", "theme-options", 'the7mk2' ),
				'below_image' => _x( "Below image", "theme-options", 'the7mk2' ),
			),
			'dependency' => array(
				array(
					array(
						'field' => 'woocommerce_display_product_info',
						'operator' => '==',
						'value' => 'under_image',
					),
				),
			),
		);

	$options[] = array( "type" => "divider" );

	$options[] = array(
		"name" => _x( "Product titles", "theme-options", 'the7mk2' ),
		"id" => "woocommerce_show_product_titles",
		"std" => 1,
		"type" => "radio",
		"options" => $en_dis_options
	);

	$options[] = array( "type" => "divider" );

	$options[] = array(
		"name" => _x( "Product price", "theme-options", 'the7mk2' ),
		"id" => "woocommerce_show_product_price",
		"std" => 1,
		"type" => "radio",
		"options" => $en_dis_options
	);

	$options[] = array( "type" => "divider" );

	$options[] = array(
		"name" => _x( "Product rating", "theme-options", 'the7mk2' ),
		"id" => "woocommerce_show_product_rating",
		"std" => 1,
		"type" => "radio",
		"options" => $en_dis_options
	);

	$options[] = array( "type" => "divider" );

	$options[] = array(
		"name" => _x( "Cart icon", "theme-options", 'the7mk2' ),
		"id" => "woocommerce_show_cart_icon",
		"std" => 1,
		"type" => "radio",
		"options" => $en_dis_options
	);

$options[] = array( "type" => "block_end" );

/**
 * Heading definition.
 */
$options[] = array( "name" => _x('List settings', 'theme-options', 'the7mk2'), "type" => "heading" );

/**
 * List settings.
 */
$options[] = array( "name" => _x("List settings", "theme-options", 'the7mk2'), "type" => "block_begin" );

	$options[] = array(
		"name" => _x( "Layout", "theme-options", 'the7mk2' ),
		"id" => "woocommerce_shop_template_layout",
		"std" => "grid",
		"type" => "radio",
		"options" => array(
			'masonry' => _x( "Masonry", "theme-options", 'the7mk2' ),
			'grid' => _x( "Grid", "theme-options", 'the7mk2' )
		)
	);

	$options[] = array( "type" => "divider" );

	$options[] = array(
		"name" => _x( "Image paddings (px)", "theme-options", 'the7mk2' ),
		"desc" => _x( "(e.g. 5 pixel padding will give you 10 pixel gaps between images)", "theme-options", 'the7mk2' ),
		"id" => "woocommerce_shop_template_gap",
		"class" => "mini",
		"std" => '22',
		"type" => "text",
		"sanitize" => "dimensions"
	);

	$options[] = array( "type" => "divider" );

	$options[] = array(
		"name" => _x( "Column minimum width (px)", "theme-options", 'the7mk2' ),
		"id" => "woocommerce_shop_template_column_min_width",
		"class" => "mini",
		"std" => '220',
		"type" => "text",
		"sanitize" => "dimensions"
	);

	$options[] = array( "type" => "divider" );

	$options[] = array(
		"name" => _x( "Desired columns number", "theme-options", 'the7mk2' ),
		"desc" => _x( "(used for defult shop page, archives, search results etc.)", "theme-options", 'the7mk2' ),
		"id" => "woocommerce_shop_template_columns",
		"class" => "mini",
		"std" => '5',
		"type" => "text",
		"sanitize" => "dimensions"
	);

	$options[] = array( "type" => "divider" );

	$options[] = array(
		"name" => _x( "Loading effect", "theme-options", 'the7mk2' ),
		"id" => "woocommerce_shop_template_loading_effect",
		"std" => "none",
		"type" => "radio",
		"options" => array(
			'none'				=> _x( 'None', 'backend metabox', 'the7mk2' ),
			'fade_in'			=> _x( 'Fade in', 'backend metabox', 'the7mk2' ),
			'move_up'			=> _x( 'Move up', 'backend metabox', 'the7mk2' ),
			'scale_up'			=> _x( 'Scale up', 'backend metabox', 'the7mk2' ),
			'fall_perspective'	=> _x( 'Fall perspective', 'backend metabox', 'the7mk2' ),
			'fly'				=> _x( 'Fly', 'backend metabox', 'the7mk2' ),
			'flip'				=> _x( 'Flip', 'backend metabox', 'the7mk2' ),
			'helix'				=> _x( 'Helix', 'backend metabox', 'the7mk2' ),
			'scale'				=> _x( 'Scale', 'backend metabox', 'the7mk2' )
		)
	);

$options[] = array( "type" => "block_end" );

/**
 * Heading definition.
 */
$options[] = array( "name" => _x("Product", "theme-options", 'the7mk2'), "type" => "heading" );

/**
 * Related products.
 */
$options[] = array( "name" => _x("Related products", "theme-options", 'the7mk2'), "type" => "block_begin" );

	// input
	$options[] = array(
		"name"		=> _x( "Maximum number of products", "theme-options", 'the7mk2' ),
		"id"		=> "woocommerce_rel_products_max",
		"std"		=> "3",
		"type"		=> "text",
		"class"		=> "mini",
		"sanitize"	=> "slider"
	);

$options[] = array( "type" => "block_end" );
