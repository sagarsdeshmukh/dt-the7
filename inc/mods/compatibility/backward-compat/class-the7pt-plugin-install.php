<?php
/**
 * This class manage The7 PostTypes plugin auto installation.
 *
 * @since       3.7.0
 */

class Presscore_The7PT_Plugin_Install {
	
	public static function is_plugin_installed() {
		return ( 'yes' === get_option( 'dt_the7pt_installed_once' ) );
	}

	public static function check_plugin() {
		if ( ! self::is_plugin_installed() && is_plugin_active( 'dt-the7-core/dt-the7-core.php' ) ) {
			self::set_plugin_installed();
		}
	}

	public static function set_plugin_installed( $yes = true ) {
		update_option( 'dt_the7pt_installed_once', ( $yes ? 'yes' : 'no' ) );
	}

	public static function add_auto_install_hooks() {
		if ( self::activate_plugin() ) {
			add_action( 'all_admin_notices', array( __CLASS__, 'admin_notices' ) );
		}
	}

	public static function activate_plugin() {
		global $tgmpa;
		if ( $tgmpa && isset( $_GET['the7-core'] ) && 'activate' === $_GET['the7-core'] ) {
			$tgmpa->is_automatic = true;
			return true;
		}

		return false;
	}

	public static function admin_notices() {
		printf( // WPCS: xss ok.
			'<div class="updated"><p>%1$s</p></div>',
			esc_html( __( 'We are installing The7 Post Types plugin automatically, so you can continue using The7 custom post types.', 'the7mk2' ) )
		);
	}

	public static function redirect() {
		global $tgmpa;

		if ( ! $tgmpa ) {
			return false;
		}

		$redirected_option_name = 'dt_the7pt_redirected';

		if ( is_multisite() ) {
			$redirected = get_network_option( null, $redirected_option_name );
		} else {
			$redirected = get_option( $redirected_option_name );
		}

		// Prevent infinity redirects.
		if ( isset( $_GET['the7-core'] ) || $redirected ) {
			return false;
		}

		if ( is_multisite() ) {
			update_network_option( null, $redirected_option_name, true );
		} else {
			update_option( $redirected_option_name, true );
		}

		$url = add_query_arg( array(
			'page' => 'install-required-plugins',
			'plugin' => 'dt-the7-core',
			'tgmpa-install' => 'install-plugin',
			'the7-core' => 'activate',
			'tgmpa-nonce' => wp_create_nonce( 'tgmpa-install' ),
		), admin_url( 'plugins.php' ) );

		wp_safe_redirect( $url );
		exit;
	}
}