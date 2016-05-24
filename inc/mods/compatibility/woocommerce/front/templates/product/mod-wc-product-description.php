<?php
// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }
?>

<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>

<?php do_action( 'woocommerce_before_shop_loop_item_title' ); ?>

<?php do_action( 'woocommerce_shop_loop_item_title' ); ?>

<?php do_action( 'woocommerce_after_shop_loop_item_title' ); ?>

<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>