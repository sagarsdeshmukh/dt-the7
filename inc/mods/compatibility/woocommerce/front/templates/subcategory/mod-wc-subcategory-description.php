<?php
// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

$category = presscore_config()->get( 'subcategory' );

do_action( 'woocommerce_before_subcategory', $category );

do_action( 'woocommerce_before_subcategory_title', $category );

do_action( 'woocommerce_shop_loop_subcategory_title', $category );

do_action( 'woocommerce_after_subcategory_title', $category );

do_action( 'woocommerce_after_subcategory', $category );
