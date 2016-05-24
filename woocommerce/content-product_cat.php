<?php
/**
 * The template for displaying product category thumbnails within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product_cat.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) ) {
	$woocommerce_loop['loop'] = 0;
}

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) ) {
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );
}

// Increase loop count
$woocommerce_loop['loop']++;

// Extra post classes
$classes = array( 'post', 'product-category', 'product' );
if ( 0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'] ) {
	$classes[] = 'first';
}
if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] ) {
	$classes[] = 'last';
}
?>

<?php do_action( 'presscore_before_post' ); ?>

<article <?php post_class( $classes ); ?>>

	<?php
	presscore_get_config()->set( 'subcategory', $category );

	if ( 'under_image' == presscore_get_config()->get( 'post.preview.description.style' ) ) {

		dt_woocommerce_template_subcategory_desc_under();

	} else {

		dt_woocommerce_template_subcategory_desc_rollover();
	}
	?>

</article>

<?php do_action( 'presscore_after_post' ); ?>