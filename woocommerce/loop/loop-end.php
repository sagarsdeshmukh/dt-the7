<?php
/**
 * Product Loop End
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

// masonry container close
echo '</div>';

// fullwidth wrap close
if ( presscore_config()->get( 'full_width' ) ) { echo '</div>'; }

do_action( 'presscore_after_loop' );

do_action( 'dt_wc_loop_end' );
