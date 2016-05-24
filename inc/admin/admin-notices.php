<?php
/**
 * Admin notices hooks.
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

function presscore_admin_notices() {
	static $admin_notices = null;
	if ( null === $admin_notices ) {
		$admin_notices = new Presscore_Admin_Notices( 'admin_notices' );
	}
	return $admin_notices;
}

function presscore_admin_enqueue_scripts() {
	wp_enqueue_script( 'presscore-admin-notices', trailingslashit( PRESSCORE_ADMIN_URI ) . 'assets/presscore-admin-notices.js', array( 'jquery' ), false, true );
	wp_localize_script( 'presscore-admin-notices', 'presscoreNotices', array( '_ajax_nonce' => presscore_admin_notices()->get_nonce() ) );
}

function presscore_admin_handle_notices() {
	presscore_admin_notices()->get_dismissed_notices();

	// load scripts
	add_action( 'admin_enqueue_scripts', 'presscore_admin_enqueue_scripts' );

	// add ajax handle
	add_action( 'wp_ajax_presscore-admin-notice', array( presscore_admin_notices(), 'dismiss_notices' ) );

	// print admin notices
	add_action( 'admin_notices', array( presscore_admin_notices(), 'print_admin_notices' ), 40 );
}
add_action( 'admin_init', 'presscore_admin_handle_notices' );
