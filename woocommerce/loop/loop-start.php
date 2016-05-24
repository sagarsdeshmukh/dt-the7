<?php
/**
 * Product Loop Start
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

do_action( 'dt_wc_loop_start' );

do_action( 'presscore_before_loop' );

// fullwidth wrap open
if ( presscore_config()->get( 'full_width' ) ) { echo '<div class="full-width-wrap">'; }

// masonry container open
echo '<div ' . presscore_masonry_container_class( array( 'wf-container', 'woo-hover' ) ) . presscore_masonry_container_data_atts() . '>';
