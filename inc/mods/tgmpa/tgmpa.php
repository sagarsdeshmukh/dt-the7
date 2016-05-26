<?php
/**
 * TGM plugin module.
 *
 * @package the7
 * @since 3.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! class_exists( 'Presscore_Modules_TGMPAModule', false ) ) :

	class Presscore_Modules_TGMPAModule {

		/**
		 * Execute module.
		 */
		public static function execute() {
			if ( ! is_admin() || defined( 'DOING_AJAX' ) ) {
				return;
			}

			require_once plugin_dir_path( __FILE__ ) . 'class-tgm-plugin-activation.php';

			// Register plugins.
			add_action( 'tgmpa_register', array( __CLASS__, 'register_plugins_action' ) );
			add_action( 'admin_menu', array( __CLASS__, 'on_page_load' ), 9999 );
		}

		public static function register_plugins_action() {
			$plugins = include trailingslashit( PRESSCORE_PLUGINS_DIR ) . 'plugins.php';
			$plugins = apply_filters( 'presscore_tgmpa_module_plugins_list', $plugins );

			tgmpa( $plugins, array(
				'id'               => 'the7_tgmpa',
				'menu'             => 'install-required-plugins',
				'parent_slug'      => 'plugins.php',
				'dismissable'      => true,
				'has_notices'      => true,
				'is_automatic'     => false,
				'strings'          => array(
					'page_title'                      => __( 'The7 Plugins', 'the7mk2' ),
					'menu_title'                      => __( 'The7 Plugins', 'the7mk2' ),
					'installing'                      => __( 'Installing Plugin: %s', 'the7mk2' ),
					'oops'                            => __( 'Something went wrong with the plugin API.', 'the7mk2' ),
					'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'the7mk2' ),
					'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'the7mk2' ),
					'notice_cannot_install'           => false,
					'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'the7mk2' ),
					'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'the7mk2' ),
					'notice_cannot_activate'          => false,
					'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'the7mk2' ),
					'notice_cannot_update'            => false,
					'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'the7mk2' ),
					'activate_link'                   => _n_noop( 'Activate installed plugin', 'Activate installed plugins', 'the7mk2' ),
					'return'                          => __( 'Return to Required Plugins Installer', 'the7mk2' ),
					'plugin_activated'                => __( 'Plugin activated successfully.', 'the7mk2' ),
					'complete'                        => __( 'All plugins installed and activated successfully. %s', 'the7mk2' ),
					'nag_type'                        => 'updated',
				),
			) );

			global $tgmpa;
			if ( $tgmpa && ! $tgmpa->is_tgmpa_complete() ) {
				add_action( 'admin_print_footer_scripts', array( __CLASS__, 'print_inline_js_action' ) );
			}
		}

		public static function print_inline_js_action() {
			?>
			<script type="text/javascript">
				jQuery(function($) {
					$('#setting-error-tgmpa .notice-dismiss').unbind().on('click.the7.tgmpa.dismiss', function(event) {
						location.href = $('#setting-error-tgmpa a.dismiss-notice').attr('href');
					});
				});
			</script>
			<?php
		}

		/**
		 * Fires on the page load.
		 */
		public static function on_page_load() {
			global $tgmpa;
			if ( $tgmpa ) {
				add_action( 'load-' . $tgmpa->page_hook, array( __CLASS__, 'remove_update_filters' ) );
			}
		}

		/**
		 * This function prevents plugin update api modification, so tgmpa can its job.
		 */
		public static function remove_update_filters() {
			$tgmpa_update = ( isset( $_GET['tgmpa-update'] ) ? $_GET['tgmpa-update'] : '' );

			if ( 'update-plugin' !== $tgmpa_update ) {
				return;
			}

			$tags_to_wipe = array(
				'pre_set_site_transient_update_plugins',
				'update_api',
				'upgrader_pre_download',
			);

			// Wipe out filters.
			foreach ( $tags_to_wipe as $tag ) {
				$GLOBALS['wp_filter'][ $tag ] = array();
				unset( $GLOBALS['merged_filters'][ $tag ] );
			}
		}
	}

	Presscore_Modules_TGMPAModule::execute();

endif;
