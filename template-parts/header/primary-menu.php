<?php
/**
 * Primary menu.
 *
 * @package the7
 * @since 3.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

do_action( 'presscore_before_primary_menu' );

echo '<ul class="' . implode( ' ', presscore_get_primary_menu_class( 'main-nav' ) ) . '" role="menu">';

	$location = isset( $location ) ? $location : 'primary';

	presscore_primary_nav_menu( $location );

echo '</ul>';

do_action( 'presscore_after_primary_menu' );
