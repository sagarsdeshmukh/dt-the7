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
			if ( ! is_admin() ) {
				return;
			}

			require_once plugin_dir_path( __FILE__ ) . 'class-tgm-plugin-activation.php';

			add_action( 'tgmpa_register', array( __CLASS__, 'register_plugins_action' ) );
			add_filter( 'presscore_tgmpa_module_plugins_list', array( __CLASS__, 'add_plugins_list_filter' ) );
			add_filter( 'tgmpa_admin_menu_args', array( __CLASS__, 'tgmpa_admin_menu_args_filter' ) );
			add_filter( 'tgmpa_admin_menu_use_add_theme_page', '__return_false' );
			add_action( 'admin_print_footer_scripts', array( __CLASS__, 'print_inline_js_action' ) );
		}

		public static function tgmpa_admin_menu_args_filter( $args = array() ) {
			// Show tgm page link on Theme Update options page.
			add_filter( 'presscore_theme_update_get_install_plugins_link', '__return_true' );

			$args['parent_slug'] = 'plugins.php';
			return $args;
		}

		public static function add_plugins_list_filter( $plugins ) {
			$new_plugins = include trailingslashit( PRESSCORE_PLUGINS_DIR ) . 'plugins.php';
			return array_merge( $plugins, $new_plugins );
		}

		public static function register_plugins_action() {
			$plugins = apply_filters( 'presscore_tgmpa_module_plugins_list', array() );

			tgmpa( $plugins, array(
				'domain'           => 'the7mk2',
				'parent_menu_slug' => 'plugins.php',
				'parent_url_slug'  => 'plugins.php',
				'menu'             => 'install-required-plugins',
				'has_notices'      => true,
				'is_automatic'     => false,
				'message'          => '',
				'strings'          => array(
					'page_title'                      => __( 'The7 Plugins', 'the7mk2' ),
					'menu_title'                      => __( 'The7 Plugins', 'the7mk2' ),
					'installing'                      => __( 'Installing Plugin: %s', 'the7mk2' ),
					'oops'                            => __( 'Something went wrong with the plugin API.', 'the7mk2' ),
					'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'the7mk2' ),
					'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'the7mk2' ),
					'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'the7mk2' ),
					'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'the7mk2' ),
					'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'the7mk2' ),
					'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'the7mk2' ),
					'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'the7mk2' ),
					'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'the7mk2' ),
					'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'the7mk2' ),
					'activate_link'                   => _n_noop( 'Activate installed plugin', 'Activate installed plugins', 'the7mk2' ),
					'return'                          => __( 'Return to Required Plugins Installer', 'the7mk2' ),
					'plugin_activated'                => __( 'Plugin activated successfully.', 'the7mk2' ),
					'complete'                        => __( 'All plugins installed and activated successfully. %s', 'the7mk2' ),
					'nag_type'                        => 'updated',
				),
			) );
		}

		public static function print_inline_js_action() {
			if ( ! get_settings_errors( 'tgmpa' ) ) {
				return;
			}
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
	}

	Presscore_Modules_TGMPAModule::execute();

endif;
