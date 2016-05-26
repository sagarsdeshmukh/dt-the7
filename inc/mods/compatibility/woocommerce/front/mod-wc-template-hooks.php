<?php
// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Assets.
 */
add_action( 'wp_enqueue_scripts', 'dt_woocommerce_enqueue_scripts', 9 );

/**
 * Header.
 */
add_action( 'presscore_render_header_element-cart', 'dt_woocommerce_mini_cart' );

/**
 * Main content.
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

add_action( 'woocommerce_before_main_content', 'dt_woocommerce_before_main_content', 10 );
add_action( 'woocommerce_after_main_content', 'dt_woocommerce_after_main_content', 10 );

add_filter( 'body_class', 'dt_woocommerce_body_class' );

/**
 * Loop.
 */
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );

add_action( 'woocommerce_shop_loop_item_title', 'dt_woocommerce_template_loop_product_title', 10 );

add_action( 'dt_wc_loop_start', 'dt_woocommerce_add_masonry_container_filters' );
add_action( 'dt_wc_loop_start', 'presscore_wc_add_masonry_lazy_load_attrs' );
add_action( 'dt_wc_loop_start', 'dt_woocommerce_product_info_controller', 20 );
add_action( 'dt_wc_loop_start', 'dt_woocommerce_set_product_cart_button_position', 40 );

add_action( 'dt_wc_loop_end', 'dt_woocommerce_remove_masonry_container_filters' );
add_action( 'dt_wc_loop_end', 'presscore_wc_remove_masonry_lazy_load_attrs' );

// change products add to cart text
add_filter( 'woocommerce_product_add_to_cart_text', 'dt_woocommerce_filter_product_add_to_cart_text', 10, 2 );
add_filter( 'wc_add_to_cart_params', 'dt_woocommerce_filter_frontend_scripts_data' );

/**
 * Related products.
 */
add_filter( 'woocommerce_output_related_products_args', 'dt_woocommerce_related_products_args' );

/**
 * Subcategory shortcode.
 */
remove_action( 'woocommerce_before_subcategory_title', 'woocommerce_subcategory_thumbnail', 10 );
remove_action( 'woocommerce_before_subcategory', 'woocommerce_template_loop_category_link_open', 10 );
remove_action( 'woocommerce_shop_loop_subcategory_title', 'woocommerce_template_loop_category_title', 10 );
remove_action( 'woocommerce_after_subcategory', 'woocommerce_template_loop_category_link_close', 10 );
add_action( 'woocommerce_shop_loop_subcategory_title', 'dt_woocommerce_template_loop_category_title', 10 );

/**
 * Single product.
 */
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );

add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );

/**
 * Search.
 */
add_action( 'presscore_archive_post_content-product', 'dt_woocommerce_add_product_template_to_search', 10 );

/**
 * Change paypal icon.
 */
add_filter( 'woocommerce_paypal_icon', 'dt_woocommerce_change_paypal_icon' );
