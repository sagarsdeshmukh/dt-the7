<?php
/**
 * The7 theme compatibility module :)
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! class_exists( 'Presscore_Modules_Compatibility_oldThe7', false ) ) :

	class Presscore_Modules_Compatibility_oldThe7 {
		public static $instance = null;

		protected $module_dir = '';
		protected $assets_uri = '';
		protected $import_status = null;
		protected $import_status_slug = '';
		protected $default_preset = 'skin07s';
		protected $old_options_key = 'the72';

		public static function execute() {
			if ( null === self::$instance ) {
				self::$instance = new self();
			}

			self::$instance->setup();
		}

		public function setup() {
			if ( ! class_exists( 'Presscore_The7PT_Plugin_Install' ) ) {
				require 'class-the7pt-plugin-install.php';
			}

			$this->import_status_slug = 'presscore_mod_' . sanitize_key( wp_get_theme()->get( 'Name' ) ) . '_the7_options_import_status';
			$this->module_dir = trailingslashit( dirname( __FILE__ ) );
			$this->assets_uri = $this->get_assets_uri();

			// check for the7 options
			add_action( 'admin_init', array( $this, 'the7_options_exists' ) );

			if ( ! defined( 'DOING_AJAX' ) && ! defined( 'WP_CLI' ) ) {
				add_action( 'admin_init', array( $this, 'install_the7pt_plugin' ) );
				add_action( 'init', array( $this, 'check_fresh_install_for_the7pt_plugin' ) );
				add_action( 'init', array( $this, 'upgrade_db_action' ) );
				add_action( 'init', array( $this, 'upgrade_stylesheets_action' ) );
			}

			add_action( 'admin_init', array( $this, 'change_import_status' ) );


			// dismiss admin notices.
			add_action( 'wp_ajax_presscore_compatibility_dismiss_admin_notice', array( $this, 'dismiss_admin_notice' ) );
		}

		public function reset_importer() {
			delete_option( $this->import_status_slug );
		}

		/**
		 * This method check 'the7_style_version' option and if it's not there - set 'dt_the7pt_installed_once' flag.
		 * It prevents the7pt plugin to be installed on fresh theme install.
		 *
		 * @see Presscore_The7PT_Plugin_Install
		 */
		public function check_fresh_install_for_the7pt_plugin() {
			// Fresh install. No stylesheet version stored.
			if ( ! get_option( 'the7_style_version' ) ) {
				Presscore_The7PT_Plugin_Install::set_plugin_installed( true );
			}
		}

		/**
		 * This method installs the7pt plugin automatically if it not been installed earlier.
		 * Work only for users which can 'install_plugins'.
		 *
		 * @see Presscore_The7PT_Plugin_Install
		 */
		public function install_the7pt_plugin() {
			if ( ! current_user_can( 'install_plugins' ) ) {
				return;
			}

			// Add auto install hooks for tgmpa plugin page.
			add_action( 'load-plugins_page_install-required-plugins', array(
				'Presscore_The7PT_Plugin_Install',
				'add_auto_install_hooks'
			) );

			// Check if plugin is installed and activated.
			Presscore_The7PT_Plugin_Install::check_plugin();

			if ( ! Presscore_The7PT_Plugin_Install::is_plugin_installed() ) {
				Presscore_The7PT_Plugin_Install::set_plugin_installed( true );

				// Redirect to plugin installation page.
				Presscore_The7PT_Plugin_Install::redirect();
			}
		}

		public function upgrade_db_action() {
			$db_version = get_option( 'the7_db_version' );

			if ( version_compare( $db_version, PRESSCORE_DB_VERSION ) < 0 ) {
				$this->patch_db( $db_version );

				// Clean options cache.
				delete_transient( 'optionsframework_clean_options' );

				update_option( 'the7_db_version', PRESSCORE_DB_VERSION );
			}
		}

		public function upgrade_stylesheets_action() {
			if ( version_compare( get_option( 'the7_style_version' ), PRESSCORE_STYLESHEETS_VERSION ) < 0 ) {
				self::regenerate_stylesheets();

				update_option( 'the7_style_version', PRESSCORE_STYLESHEETS_VERSION );
			}
		}

		public function add_admin_notices() {
			global $current_screen;

			if ( $this->the7_options_found() ) {

				$import_link = esc_url( add_query_arg( 'the7_opts_import', 'options_imported' ) );

				$msg = '<p>' 
						. _x( 'Would you like to import The7.2 settings?', 'options import', 'the7mk2' ) 
					. '</p>' 
					. '<div class="dt-buttons-holder">' 
						. '<div class="dt-button-primary">' 
							. '<a href="' . $import_link . '" class="button button-primary dt-import-options">' . _x( "Yes, do it!" , 'options import', 'the7mk2' ) . '</a>' 
							. '<span class="spinner"></span>' 
						. '</div>' 
					. '</div>';

				add_settings_error( 'presscore-import-the7-options', 'presscore-import-the7-options', $msg, 'error' );

				if ( ! in_array( $current_screen->parent_base, array( 'options-general', 'options-framework' ) ) ) {
					settings_errors( 'presscore-import-the7-options' );
				}
			}
		}

		public function dismiss_admin_notice() {
			if ( ! current_user_can( 'edit_theme_options' ) ) {
				die();
			}

			check_ajax_referer( 'migration-dismiss' );

			update_option( $this->import_status_slug, 'import_refused' );
		}

		public function change_import_status() {
			if ( ! current_user_can( 'edit_theme_options' ) ) {
				return;
			}

			$this->import_status = get_option( $this->import_status_slug );

			if ( $this->the7_options_found() ) {

				// add admin notices
				add_action( 'admin_notices', array( $this, 'add_admin_notices' ) );

				// enqueue scripts
				add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );

				if ( ! empty( $_POST['the7_opts_import'] ) ) {

					// remove filters
					remove_action( 'optionsframework_after_validate', 'flush_rewrite_rules' );

					// import options
					add_filter( 'optionsframework_validated_options', array( $this, 'import_theme_options' ) );
				}
			}
		}

		public function import_theme_options( $input = array() ) {
			if ( ! $input ) {
				return $input;
			}

			update_option( $this->import_status_slug, 'options_imported' );

			$the72_options = get_option( $this->old_options_key );

			$header_preset_relation = array(
				'side' => 'wizard05',
				'left' => 'wizard01',
				'classic' => 'wizard03',
				'center' => 'wizard03',
			);
			$header_layout = $the72_options['header-layout'];
			$preset_id = isset( $header_preset_relation[ $header_layout ] ) ? $header_preset_relation[ $header_layout ] : 'skin07s';
			$preset_options = optionsframework_presets_data( $preset_id );

			// Skin.
			$the72_options['preset'] = $preset_options['preset'];

			// Top bar.
			$the72_options['top_bar-font-size'] = self::fix_font_size_option( $the72_options['top_bar-font_size'] );
			$the72_options['top_bar-font-color'] = $the72_options['top_bar-text_color'];
			$the72_options['top_bar-paddings-top'] = $the72_options['top_bar-paddings-bottom'] = $the72_options['top_bar-paddings'];
			$the72_options['top_bar-bg-style'] = $the72_options['top_bar-bg_mode'];
			$the72_options['top_bar-bg-color'] = $the72_options['top_bar-bg_color'];
			$the72_options['top_bar-bg-opacity'] = $the72_options['top_bar-bg_opacity'];
			$the72_options['top_bar-bg-image'] = $the72_options['top_bar-bg_image'];

			// Microwidgets.
			$the72_options['header-elements-near_menu-font_family'] = $the72_options['fonts-font_family'];
			$the72_options['header-elements-near_menu-font_size'] = '12';
			$the72_options['header-elements-near_menu-font_color'] = $the72_options['menu-font_color'];
			$the72_options['header-elements-near_logo-font_family'] = $the72_options['fonts-font_family'];
			$the72_options['header-elements-near_logo-font_size'] = $the72_options['menu-font_size'];
			$the72_options['header-elements-near_logo-font_color'] = $the72_options['menu-font_color'];

			// Header.
			$the72_options['header-layout'] = $preset_options['header-layout'];
			$the72_options['header-bg-color'] = $the72_options['header-bg_color'];
			$the72_options['header-bg-opacity'] = $the72_options['header-bg_opacity'];
			$the72_options['header-bg-image'] = $the72_options['header-bg_image'];
			$the72_options['header-bg-is_fullscreen'] = $the72_options['header-bg_fullscreen'];
			$the72_options['header-bg-is_fixed'] = $the72_options['header-bg_fixed'];
			$the72_options['header-decoration'] = 'shadow';

			$the72_options['header-menu-item-padding-top'] = '0';
			$the72_options['header-menu-item-padding-bottom'] = '0';
			$the72_options['header-menu-item-padding-left'] = '0';
			$the72_options['header-menu-item-padding-right'] = '0';
			$the72_options['header-menu-item-margin-top'] = '0';
			$the72_options['header-menu-item-margin-right'] = '0';
			$the72_options['header-menu-item-margin-bottom'] = '0';
			$the72_options['header-menu-item-margin-left'] = '0';
			$the72_options['header-menu-decoration-other-border-radius'] = '6';
			$the72_options['header-menu-decoration-other-links-is_justified'] = '0';

			switch ( $header_layout ) {
				case 'side':
					if ( 'sticky' == $the72_options['header-side_menu_visibility'] ) {
						$the72_options['header-layout'] = 'slide_out';
						$the72_options['header-slide_out-show_elements'] = ( 'show' == $the72_options['header-side_layout_elements_visibility'] ? '1' : '0' );
						$the72_options['header-slide_out-elements'] = self::fix_header_elements_option( $header_layout, $the72_options['header-side_layout_elements'] );
						$the72_options['header-slide_out-position'] = $the72_options['header-side_position'];
						$the72_options['header-slide_out-width'] = $the72_options['header-slide_out-content-width'] = $the72_options['header-side_menu_width'];
						$the72_options['header-slide_out-layout'] = 'menu_icon';
						$the72_options['header-slide_out-layout-menu_icon-show_floating_logo'] = '0';
						$the72_options['header-slide_out-overlay-animation'] = 'slide';
						$the72_options['header-slide_out-menu-position'] = 'v_top';
						$the72_options['header-slide_out-logo-position'] = 'inside';
						$the72_options['header-slide_out-elements-below_menu-padding-top'] = '6';
						$the72_options['header-slide_out-elements-below_menu-padding-right'] = '0';
						$the72_options['header-slide_out-elements-below_menu-padding-bottom'] = '6';
						$the72_options['header-slide_out-elements-below_menu-padding-left'] = '0';
						$the72_options['header-slide_out-content-padding-top'] = '0';
						$the72_options['header-slide_out-content-padding-bottom'] = '0';
						$the72_options['header-slide_out-content-padding-right'] = $the72_options['header-side_paddings'];
						$the72_options['header-slide_out-content-padding-left'] = $the72_options['header-side_paddings'];
						$the72_options['header-slide_out-content-position'] = 'center';
						$the72_options['header-slide_out-menu-items_alignment'] = 'center';
						$the72_options['header-slide_out-menu-items_link'] = 'textwidth';
						$the72_options['header-menu_icon-hover-bg-color'] = $the72_options['header-menu_icon-bg-color'] = ( 'color' == $the72_options['general-accent_color_mode'] ? $the72_options['general-accent_bg_color'] : $the72_options['general-accent_bg_color_gradient'][0] );
						$the72_options['header-menu_icon-hover-bg-opacity'] = $the72_options['header-menu_icon-bg-opacity'] = '100';
						$the72_options['header-menu_icon-bg-border-radius'] = '3';
						$the72_options['header-menu_icon-margin-top'] = '50';
						$the72_options['header-menu_icon-margin-right'] = '0';
						$the72_options['header-menu_icon-margin-bottom'] = '0';
						$the72_options['header-menu_icon-margin-left'] = '50';
					} else {
						$the72_options['header-side-show_elements'] = ( 'show' == $the72_options['header-side_layout_elements_visibility'] ? '1' : '0' );
						$the72_options['header-side-elements'] = self::fix_header_elements_option( $header_layout, $the72_options['header-side_layout_elements'] );
						$the72_options['header-side-position'] = $the72_options['header-side_position'];
						$the72_options['header-side-width'] = $the72_options['header-side-content-width'] = $the72_options['header-side_menu_width'];
						$the72_options['header-side-menu-position'] = 'v_top';
						$the72_options['header-side-logo-position'] = 'inside';
						$the72_options['header-side-content-padding-top'] = '0';
						$the72_options['header-side-content-padding-bottom'] = '0';
						$the72_options['header-side-elements-below_menu-padding-top'] = '6';
						$the72_options['header-side-elements-below_menu-padding-right'] = '0';
						$the72_options['header-side-elements-below_menu-padding-bottom'] = '6';
						$the72_options['header-side-elements-below_menu-padding-left'] = '0';
						$the72_options['header-side-content-padding-right'] = $the72_options['header-side_paddings'];
						$the72_options['header-side-content-padding-left'] = $the72_options['header-side_paddings'];
						$the72_options['header-side-content-position'] = 'center';
						$the72_options['header-side-menu-items_alignment'] = 'center';
						$the72_options['header-side-menu-items_link'] = 'textwidth';
					}
					break;
				case 'left':
					$the72_options['header-inline-show_elements'] = ( 'show' == $the72_options['header-left_layout_elements_visibility'] ? '1' : '0' );
					$the72_options['header-inline-elements'] = self::fix_header_elements_option( $header_layout, $the72_options['header-left_layout_elements'] );

					// Hide top bar if it's empty.
					if ( empty( $the72_options['header-inline-elements']['top_bar_left'] ) && empty( $the72_options['header-inline-elements']['top_bar_right'] ) ) {
						$the72_options['top_bar-paddings-top'] = $the72_options['top_bar-paddings-bottom'] = '0';
					}

					$the72_options['header-inline-is_fullwidth'] = '0';
					$the72_options['header-inline-elements-near_menu_right-padding-left'] = '30';
					$the72_options['header-inline-elements-near_menu_right-padding-right'] = '0';
					$the72_options['header-menu-item-padding-top'] = '4';
					$the72_options['header-menu-item-padding-bottom'] = '6';
					$the72_options['header-inline-menu-position'] = 'center';
					break;
				case 'classic':
					$the72_options['header-classic-show_elements'] = ( 'show' == $the72_options['header-classic_layout_elements_visibility'] ? '1' : '0' );
					$the72_options['header-classic-elements'] = self::fix_header_elements_option( $header_layout, $the72_options['header-classic_layout_elements'] );

					// Hide top bar if it's empty.
					if ( empty( $the72_options['header-classic-elements']['top_bar_left'] ) && empty( $the72_options['header-classic-elements']['top_bar_right'] ) ) {
						$the72_options['top_bar-paddings-top'] = $the72_options['top_bar-paddings-bottom'] = '0';
					}

					$the72_options['header-classic-menu-bg-style'] = $the72_options['header-classic_menu_bg_mode'];
					$the72_options['header-classic-menu-bg-color'] = $the72_options['header-classic_menu_bg_color'];
					$the72_options['header-classic-menu-bg-opacity'] = $the72_options['header-classic_menu_bg_opacity'];
					$the72_options['header-classic-logo-position'] = 'left';
					$the72_options['header-classic-menu-position'] = 'center';

					$the72_options['header-elements-near_logo-font_size'] = self::fix_font_size_option( $the72_options['header-near_logo_font_size'] );
					$the72_options['header-elements-near_logo-font_color'] = $the72_options['header-near_logo_bg_color'];
					break;
				case 'center':
					$the72_options['header-classic-show_elements'] = ( 'show' == $the72_options['header-center_layout_elements_visibility'] ? '1' : '0' );
					$the72_options['header-classic-elements'] = self::fix_header_elements_option( $header_layout, $the72_options['header-center_layout_elements'] );

					// Hide top bar if it's empty.
					if ( empty( $the72_options['header-classic-elements']['top_bar_left'] ) && empty( $the72_options['header-classic-elements']['top_bar_right'] ) ) {
						$the72_options['top_bar-paddings-top'] = $the72_options['top_bar-paddings-bottom'] = '0';
					}

					$the72_options['header-classic-logo-position'] = 'center';
					$the72_options['header-classic-menu-position'] = 'center';
					$the72_options['header-classic-menu-bg-style'] = $the72_options['header-center_menu_bg_mode'];
					$the72_options['header-classic-menu-bg-color'] = $the72_options['header-center_menu_bg_color'];
					$the72_options['header-classic-menu-bg-opacity'] = $the72_options['header-center_menu_bg_opacity'];
					break;
			}

			// Cart.
			$the72_options['header-elements-woocommerce_cart-caption'] = $the72_options['header-woocommerce_cart_caption'];
			$the72_options['header-elements-woocommerce_cart-icon'] = $the72_options['header-woocommerce_cart_icon'];
			$the72_options['header-elements-woocommerce_cart-second-header-switch'] = 'in_menu';
			$the72_options['header-elements-woocommerce_cart-show_sub_cart'] = '1';
			$the72_options['header-elements-woocommerce_cart-show_subtotal'] = $the72_options['header-woocommerce_show_cart_subtotal'];
			$the72_options['header-elements-woocommerce_cart-show_counter'] = $the72_options['header-woocommerce_show_counter'];
			$the72_options['header-elements-woocommerce_cart-counter-style'] = 'rectangular';
			$the72_options['header-elements-woocommerce_cart-counter-color'] = $the72_options['header-woocommerce_counter_color'];
			$the72_options['header-elements-woocommerce_cart-counter-bg'] = $the72_options['header-woocommerce_counter_bg_mode'];
			$the72_options['header-elements-woocommerce_cart-counter-bg-color'] = $the72_options['header-woocommerce_counter_bg_color'];
			$the72_options['header-elements-woocommerce_cart-counter-bg-gradient'] = $the72_options['header-woocommerce_counter_bg_color_gradient'];
			// Search.
			$the72_options['header-elements-search-caption'] = $the72_options['header-search_caption'];
			$the72_options['header-elements-search-icon'] = $the72_options['header-search_icon'];
			$the72_options['header-elements-search-second-header-switch'] = 'in_menu';
			// Contact information.
			$contact_info = array(
				'address',
				'phone',
				'email',
				'skype',
				'clock',
			);
			foreach ( $contact_info as $element ) {
				$the72_options["header-elements-contact-{$element}-caption"] = $the72_options["header-contact_{$element}"];
				$the72_options["header-elements-contact-{$element}-icon"] = $the72_options["header-contact_{$element}_icon"];
				$the72_options["header-elements-contact-{$element}-second-header-switch"] = 'in_menu';
			}
			// Login.
			$the72_options['header-elements-login-caption'] = $the72_options['header-login_caption'];
			$the72_options['header-elements-logout-caption'] = $the72_options['header-logout_caption'];
			$the72_options['header-elements-login-icon'] = $the72_options['header-login_icon'];
			$the72_options['header-elements-login-second-header-switch'] = 'in_menu';
			$the72_options['header-elements-login-url'] = $the72_options['header-login_url'];
			// Text.
			$the72_options['header-elements-text'] = $the72_options['header-text'];
			$the72_options['header-elements-text-second-header-switch'] = 'in_menu';
			// Custom menu.
			$the72_options['header-elements-text-second-header-switch'] = 'hidden';
			// Social icons.
			$the72_options['header-elements-text-second-header-switch'] = 'hidden';
			$the72_options['header-elements-soc_icons-color'] = $the72_options['header-soc_icon_color'];
			$the72_options['header-elements-soc_icons-bg'] = $the72_options['header-soc_icon_bg_color_mode'];
			$the72_options['header-elements-soc_icons-bg-color'] = $the72_options['header-soc_icon_bg_color'];
			$the72_options['header-elements-soc_icons-bg-opacity'] = '100';
			$the72_options['header-elements-soc_icons-bg-gradient'] = $the72_options['header-soc_icon_bg_color_gradient'];
			$the72_options['header-elements-soc_icons-hover-color'] = $the72_options['header-soc_icon_hover_color'];
			$the72_options['header-elements-soc_icons-hover-bg'] = $the72_options['header-soc_icon_hover_bg_color_mode'];
			$the72_options['header-elements-soc_icons-hover-bg-color'] = $the72_options['header-soc_icon_hover_bg_color'];
			$the72_options['header-elements-soc_icons-bg-hover-opacity'] = '100';
			$the72_options['header-elements-soc_icons-hover-bg-gradient'] = $the72_options['header-soc_icon_hover_bg_color_gradient'];
			$the72_options['header-elements-soc_icons'] = array_reverse( $the72_options['header-soc_icons'] );

			// Menu.
			$the72_options['header-menu-font-family'] = $the72_options['menu-font_family'];
			$the72_options['header-menu-font-size'] = $the72_options['menu-font_size'];
			$the72_options['header-menu-font-is_capitalized'] = $the72_options['menu-font_uppercase'];
			$the72_options['header-menu-font-color'] = $the72_options['menu-font_color'];
			$the72_options['header-menu-hover-font-color-style'] = $the72_options['header-menu-active_item-font-color-style'] = $the72_options['menu-hover_font_color_mode'];
			$the72_options['header-menu-hover-font-color'] = $the72_options['header-menu-active_item-font-color'] = $the72_options['menu-hover_font_color'];
			$the72_options['header-menu-hover-font-gradient'] = $the72_options['header-menu-active_item-font-gradient'] = $the72_options['menu-hover_font_color_gradient'];
			$the72_options['header-menu-icon-size'] = $the72_options['menu-iconfont_size'];
			$the72_options['header-menu-show_next_lvl_icons'] = $the72_options['menu-next_level_indicator'];
			$the72_options['header-classic-height'] = $the72_options['header-inline-height'] = $the72_options['header-bg_height'];
			$the72_options['header-menu-show_dividers'] = '0';
			switch ( $the72_options['menu-decoration_style'] ) {
				// Left to right.
				case 'underline':
					$the72_options['header-menu-decoration-style'] = 'underline';
					$the72_options['header-menu-decoration-underline-direction'] = 'left_to_right';
					$the72_options['header-menu-decoration-underline-color-style'] = $the72_options['menu-hover_decoration_color_mode'];
					$the72_options['header-menu-decoration-underline-color'] = $the72_options['menu-hover_decoration_color'];
					$the72_options['header-menu-decoration-underline-gradient'] = $the72_options['menu-hover_decoration_color_gradient'];
					$the72_options['header-menu-item-padding-top'] = $the72_options['header-menu-item-padding-bottom'] = '4';
					break;
				// From centre.
				case 'brackets':
					$the72_options['header-menu-decoration-style'] = 'underline';
					$the72_options['header-menu-decoration-underline-direction'] = 'from_center';
					$the72_options['header-menu-decoration-underline-color-style'] = $the72_options['menu-hover_decoration_color_mode'];
					$the72_options['header-menu-decoration-underline-color'] = $the72_options['menu-hover_decoration_color'];
					$the72_options['header-menu-decoration-underline-gradient'] = $the72_options['menu-hover_decoration_color_gradient'];
					$the72_options['header-menu-item-padding-top'] = $the72_options['header-menu-item-padding-bottom'] = '4';
					break;
				// Upwards.
				case 'upwards':
					$the72_options['header-menu-decoration-style'] = 'underline';
					$the72_options['header-menu-decoration-underline-direction'] = 'upwards';
					$the72_options['header-menu-decoration-underline-color-style'] = $the72_options['menu-hover_decoration_color_mode'];
					$the72_options['header-menu-decoration-underline-color'] = $the72_options['menu-hover_decoration_color'];
					$the72_options['header-menu-decoration-underline-gradient'] = $the72_options['menu-hover_decoration_color_gradient'];
					$the72_options['header-menu-item-padding-top'] = $the72_options['header-menu-item-padding-bottom'] = '4';
					break;
				// Downwards.
				case 'downwards':
					$the72_options['header-menu-decoration-style'] = 'underline';
					$the72_options['header-menu-decoration-underline-direction'] = 'downwards';
					$the72_options['header-menu-decoration-underline-color-style'] = $the72_options['menu-hover_decoration_color_mode'];
					$the72_options['header-menu-decoration-underline-color'] = $the72_options['menu-hover_decoration_color'];
					$the72_options['header-menu-decoration-underline-gradient'] = $the72_options['menu-hover_decoration_color_gradient'];
					$the72_options['header-menu-item-padding-top'] = $the72_options['header-menu-item-padding-bottom'] = '4';
					break;
				// Background & outline.
				case 'background':
					$the72_options['header-menu-decoration-style'] = 'other';
					$the72_options['header-menu-decoration-other-hover-style'] = 'outline';
					$the72_options['header-menu-decoration-other-click_decor'] = '0';
					$the72_options['header-menu-decoration-other-active-style'] = 'background';
					$the72_options['header-menu-item-padding-top'] = '7';
					$the72_options['header-menu-item-padding-right'] = '11';
					$the72_options['header-menu-item-padding-bottom'] = '8';
					$the72_options['header-menu-item-padding-left'] = '11';
					$the72_options['header-menu-decoration-other-hover-line'] = $the72_options['header-menu-decoration-other-active-line'] = '0';
					$the72_options['header-menu-decoration-other-opacity'] = $the72_options['header-menu-decoration-other-active-opacity'] = '100';

					// Hover font and hover/active decoration colors.
					$the72_options['header-menu-hover-font-color-style'] = $the72_options['header-menu-decoration-other-hover-color-style'] = $the72_options['header-menu-decoration-other-active-color-style'] = $the72_options['menu-hover_decoration_color_mode'];
					$the72_options['header-menu-hover-font-color'] = $the72_options['header-menu-decoration-other-hover-color'] = $the72_options['header-menu-decoration-other-active-color'] = $the72_options['menu-hover_decoration_color'];
					$the72_options['header-menu-hover-font-gradient'] = $the72_options['header-menu-decoration-other-hover-gradient'] = $the72_options['header-menu-decoration-other-active-gradient'] = $the72_options['menu-hover_decoration_color_gradient'];
					break;
				// Material background.
				case 'material':
					$the72_options['header-menu-decoration-style'] = 'other';
					$the72_options['header-menu-decoration-other-hover-style'] = 'background';
					$the72_options['header-menu-decoration-other-click_decor'] = '1';
					$the72_options['header-menu-decoration-other-active-style'] = 'background';
					$the72_options['header-menu-item-padding-top'] = '7';
					$the72_options['header-menu-item-padding-right'] = '11';
					$the72_options['header-menu-item-padding-bottom'] = '8';
					$the72_options['header-menu-item-padding-left'] = '11';
					$the72_options['header-menu-decoration-other-hover-line'] = $the72_options['header-menu-decoration-other-active-line'] = '0';
					$the72_options['header-menu-decoration-other-active-opacity'] = '100';

					// Hover font and hover/active decoration colors.
					$the72_options['header-menu-decoration-other-click_decor-color-style'] = $the72_options['header-menu-hover-font-color-style'] = $the72_options['header-menu-decoration-other-hover-color-style'] = $the72_options['header-menu-decoration-other-active-color-style'] = $the72_options['menu-hover_decoration_color_mode'];
					$the72_options['header-menu-decoration-other-click_decor-color'] = $the72_options['header-menu-hover-font-color'] = $the72_options['header-menu-decoration-other-hover-color'] = $the72_options['header-menu-decoration-other-active-color'] = $the72_options['menu-hover_decoration_color'];
					$the72_options['header-menu-decoration-other-click_decor-gradient'] = $the72_options['header-menu-hover-font-gradient'] = $the72_options['header-menu-decoration-other-hover-gradient'] = $the72_options['header-menu-decoration-other-active-gradient'] = $the72_options['menu-hover_decoration_color_gradient'];
					break;
				// Material underline.
				case 'material_underline':
					$the72_options['header-menu-decoration-style'] = 'other';
					$the72_options['header-menu-decoration-other-hover-style'] = 'background';
					$the72_options['header-menu-decoration-other-click_decor'] = '1';
					$the72_options['header-menu-decoration-other-active-style'] = 'background';
					if ( 'left' == $header_layout ) {
						$the72_options['header-menu-item-padding-top'] = '0';
						$the72_options['header-menu-item-padding-right'] = '0';
						$the72_options['header-menu-item-padding-bottom'] = '0';
						$the72_options['header-menu-item-padding-left'] = '0';
						$the72_options['header-menu-item-margin-top'] = '0';
						$the72_options['header-menu-item-margin-right'] = '0';
						$the72_options['header-menu-item-margin-bottom'] = '0';
						$the72_options['header-menu-item-margin-left'] = '0';
					} else {
						$the72_options['header-menu-item-padding-top'] = $the72_options['header-menu-item-padding-bottom'] = ceil( intval( $the72_options['header-bg_height'] - $the72_options['header-menu-font-size'] ) / 2 );
						$the72_options['header-menu-item-padding-right'] = '9';
						$the72_options['header-menu-item-padding-left'] = '9';
						$the72_options['header-menu-item-margin-top'] = '0';
						$the72_options['header-menu-item-margin-bottom'] = '0';
					}
					$the72_options['header-menu-decoration-other-hover-line'] = $the72_options['header-menu-decoration-other-active-line'] = '1';
					$the72_options['header-menu-decoration-other-active-opacity'] = '0';
					$the72_options['header-menu-decoration-other-opacity'] = '0';
					$the72_options['header-menu-decoration-other-border-radius'] = '0';
					$the72_options['header-menu-decoration-other-links-is_justified'] = '1';
					$the72_options['header-menu-decoration-other-active-line-opacity'] = '100';
					$the72_options['header-menu-decoration-other-hover-line-opacity'] = '100';

					// Hover font and hover/active decoration colors.
					$the72_options['header-menu-decoration-other-hover-line-color-style'] = 
					$the72_options['header-menu-decoration-other-active-line-color-style'] = 
					$the72_options['header-menu-decoration-other-click_decor-color-style'] = 
					$the72_options['header-menu-decoration-other-hover-color-style'] = 
					$the72_options['header-menu-decoration-other-active-color-style'] = 
					$the72_options['menu-hover_decoration_color_mode'];

					$the72_options['header-menu-decoration-other-hover-line-color'] = 
					$the72_options['header-menu-decoration-other-active-line-color'] = 
					$the72_options['header-menu-decoration-other-click_decor-color'] = 
					$the72_options['header-menu-decoration-other-hover-color'] = 
					$the72_options['header-menu-decoration-other-active-color'] = 
					$the72_options['menu-hover_decoration_color'];

					$the72_options['header-menu-decoration-other-hover-line-gradient'] = 
					$the72_options['header-menu-decoration-other-active-line-gradient'] = 
					$the72_options['header-menu-decoration-other-click_decor-gradient'] = 
					$the72_options['header-menu-decoration-other-hover-gradient'] = 
					$the72_options['header-menu-decoration-other-active-gradient'] = 
					$the72_options['menu-hover_decoration_color_gradient'];
					break;
				// Disabled.
				default:
					$the72_options['header-menu-decoration-style'] = 'none';
			}
			if ( 'side' == $header_layout ) {
				$the72_options['header-menu-item-padding-top'] = $the72_options['header-menu-item-margin-bottom'] = intval( round( intval( $the72_options['menu-items_distance'] ) / 2 ) );
			} else {
				$the72_options['header-menu-item-margin-right'] = $the72_options['header-menu-item-margin-left'] = intval( round( intval( $the72_options['menu-items_distance'] ) / 2 ) );

				if ( 'material_underline' != $the72_options['menu-decoration_style'] ) {
					$the72_options['header-menu-item-margin-top'] = $the72_options['header-menu-item-margin-bottom'] = intval( round( intval( $the72_options['header-bg_height'] - $the72_options['header-menu-font-size'] ) / 2 ) );
				}
			}

			// Submenu.
			$the72_options['header-menu-submenu-font-family'] = $the72_options['header-menu-submenu-subtitle-font-family'] = $the72_options['submenu-font_family'];
			$the72_options['header-menu-submenu-font-size'] = $the72_options['submenu-font_size'];
			$the72_options['header-menu-submenu-font-is_uppercase'] = $the72_options['submenu-font_uppercase'];
			$the72_options['header-menu-submenu-font-color'] = $the72_options['submenu-font_color'];
			$the72_options['header-menu-submenu-show_next_lvl_icons'] = $the72_options['submenu-next_level_indicator'];
			$the72_options['header-menu-submenu-active-font-color-style'] = $the72_options['header-menu-submenu-hover-font-color-style'] = $the72_options['submenu-hover_font_color_mode'];
			$the72_options['header-menu-submenu-active-font-color'] = $the72_options['header-menu-submenu-hover-font-color'] = $the72_options['submenu-hover_font_color'];
			$the72_options['header-menu-submenu-active-font-gradient'] = $the72_options['header-menu-submenu-hover-font-gradient'] = $the72_options['submenu-hover_font_color_gradient'];
			$the72_options['header-menu-submenu-icon-size'] = $the72_options['submenu-iconfont_size'];
			$the72_options['header-menu-submenu-item-margin-top'] = '0';
			$the72_options['header-menu-submenu-item-margin-right'] = '0';
			$the72_options['header-menu-submenu-item-margin-bottom'] = '0';
			$the72_options['header-menu-submenu-item-margin-left'] = '0';
			$the72_options['header-menu-submenu-item-padding-left'] = '10';
			$the72_options['header-menu-submenu-item-padding-right'] = '30';
			$the72_options['header-menu-submenu-item-padding-top'] = $the72_options['header-menu-submenu-item-padding-bottom'] = intval( round( intval( $the72_options['submenu-items_distance'] ) / 2 ) );
			$the72_options['header-menu-submenu-bg-color'] = $the72_options['submenu-bg_color'];
			$the72_options['header-menu-submenu-bg-opacity'] = $the72_options['submenu-bg_opacity'];
			$the72_options['header-menu-submenu-bg-width'] = $the72_options['submenu-bg_width'];
			$the72_options['header-menu-submenu-parent_is_clickable'] = $the72_options['submenu-parent_clickable'];

			// Floating navigation.
			$the72_options['header-show_floating_navigation'] = $the72_options['header-show_floating_menu'];
			$the72_options['header-floating_navigation-height'] = $the72_options['float_menu-height'];
			if ( 'header_color' == $the72_options['float_menu-bg_color_mode'] ) {
				$the72_options['header-floating_navigation-bg-color'] = $the72_options['header-bg_color'];
			} else {
				$the72_options['header-floating_navigation-bg-color'] = $the72_options['float_menu-bg_color'];
			}
			$the72_options['header-floating_navigation-bg-opacity'] = $the72_options['float_menu-transparency'];
			$the72_options['header-floating_navigation-style'] = $the72_options['header-floating_menu_animation'];
			$the72_options['header-floating_navigation-decoration'] = 'shadow';

			// Mobile header.
			if ( 'accent' == $the72_options['header-mobile-menu_color'] ) {
				$the72_options['header-mobile-menu-font-color'] = $the72_options['submenu-font_color'];
				$the72_options['header-mobile-menu-bg-color'] = $the72_options['submenu-bg_color'];
			} else {
				$the72_options['header-mobile-menu-font-color'] = $the72_options['header-mobile-menu_color-text'];
				$the72_options['header-mobile-menu-bg-color'] = $the72_options['header-mobile-menu_color-background'];
			}
			$the72_options['header-mobile-menu-font-hover-color-style'] = $the72_options['submenu-hover_font_color_mode'];
			$the72_options['header-mobile-menu-font-hover-color'] = $the72_options['submenu-hover_font_color'];
			$the72_options['header-mobile-menu-font-hover-gradient'] = $the72_options['submenu-hover_font_color_gradient'];
			$the72_options['header-mobile-menu-font-family'] = $the72_options['menu-font_family'];
			$the72_options['header-mobile-menu-font-size'] = $the72_options['menu-font_size'];
			$the72_options['header-mobile-menu-font-is_capitalized'] = $the72_options['menu-font_uppercase'];
			$the72_options['header-mobile-submenu-font-family'] = $the72_options['submenu-font_family'];
			$the72_options['header-mobile-submenu-font-size'] = $the72_options['submenu-font_size'];
			$the72_options['header-mobile-submenu-font-is_capitalized'] = $the72_options['submenu-font_uppercase'];
			$the72_options['header-mobile-menu-bg-opacity'] = '100';
			$the72_options['header-mobile-floating_navigation'] = 'disabled';

			// Branding.
			// Main.
			$the72_options['header-logo_regular'] = $the72_options['header-logo_regular'];
			$the72_options['header-logo_hd'] = $the72_options['header-logo_hd'];
			$the72_options['header-logo-padding-top'] = $the72_options['header-logo_padding_top'];
			$the72_options['header-logo-padding-bottom'] = $the72_options['header-logo_padding_bottom'];
			$the72_options['header-logo-padding-right'] = '0';
			$the72_options['header-logo-padding-left'] = '0';
			// Transparent.
			$the72_options['header-style-transparent-logo_regular'] = $the72_options['header-logo_regular'];
			$the72_options['header-style-transparent-logo_hd'] = $the72_options['header-logo_hd'];
			$the72_options['header-style-transparent-logo-padding-top'] = $the72_options['header-logo_padding_top'];
			$the72_options['header-style-transparent-logo-padding-bottom'] = $the72_options['header-logo_padding_bottom'];
			$the72_options['header-style-transparent-logo-padding-right'] = '0';
			$the72_options['header-style-transparent-logo-padding-left'] = '0';
			// Menu icon.
			$the72_options['header-style-mixed-logo_regular'] = array( '', 0 );
			$the72_options['header-style-mixed-logo_hd'] = array( '', 0 );
			$the72_options['header-style-mixed-logo-padding-top'] = $the72_options['header-logo_padding_top'];
			$the72_options['header-style-mixed-logo-padding-bottom'] = $the72_options['header-logo_padding_bottom'];
			$the72_options['header-style-mixed-logo-padding-right'] = '0';
			$the72_options['header-style-mixed-logo-padding-left'] = '0';
			// Floating navigation.
			$the72_options['header-style-floating-choose_logo'] = ( '1' == $the72_options['general-floating_menu_show_logo'] ? 'custom' : 'none' );
			$the72_options['header-style-floating-logo_regular'] = $the72_options['general-floating_menu_logo_regular'];
			$the72_options['header-style-floating-logo_hd'] = $the72_options['general-floating_menu_logo_hd'];
			$the72_options['header-style-floating-logo-padding-top'] = '0';
			$the72_options['header-style-floating-logo-padding-bottom'] = '0';
			$the72_options['header-style-floating-logo-padding-right'] = '0';
			$the72_options['header-style-floating-logo-padding-left'] = '0';
			// Mobile logo.
			$the72_options['header-mobile-first_switch-logo'] = $the72_options['header-mobile-first_switch-logo'];
			$the72_options['header-mobile-second_switch-logo'] = $the72_options['header-mobile-second_switch-logo'];
			$the72_options['header-style-mobile-logo_regular'] = $the72_options['general-mobile_logo-regular'];
			$the72_options['header-style-mobile-logo_hd'] = $the72_options['general-mobile_logo-hd'];
			$the72_options['header-style-mobile-logo-padding-top'] = $the72_options['general-mobile_logo-padding_top'];
			$the72_options['header-style-mobile-logo-padding-bottom'] = $the72_options['general-mobile_logo-padding_bottom'];
			$the72_options['header-style-mobile-logo-padding-right'] = '0';
			$the72_options['header-style-mobile-logo-padding-left'] = '0';
			// Bottom logo.
			$the72_options['bottom_bar-logo-padding-top'] = '10';
			$the72_options['bottom_bar-logo-padding-bottom'] = '10';
			$the72_options['bottom_bar-logo-padding-right'] = '10';
			$the72_options['bottom_bar-logo-padding-left'] = '0';

			// Content boxes.
			if ( 'solid' == $the72_options['general-content_boxes_bg_mode'] ) {
				$the72_options['general-content_boxes_bg_color'] = $the72_options['general-content_boxes_solid_bg_color'];
				$the72_options['general-content_boxes_bg_opacity'] = '100';
			} else {
				$the72_options['general-content_boxes_bg_color'] = '#888888';
				$the72_options['general-content_boxes_bg_opacity'] = '8';
			}
			$the72_options['general-content_boxes_decoration'] = 'none';

			// Stripes.
			for ( $i = 1; $i <= 3; $i++ ) {
				$the72_options["stripes-stripe_{$i}_outline"] = 'hide';
				$the72_options["stripes-stripe_{$i}_content_boxes_decoration"] = 'none';
				if ( 'solid' == $the72_options["stripes-stripe_{$i}_content_boxes_bg_mode"] ) {
					$the72_options["stripes-stripe_{$i}_content_boxes_bg_color"] = $the72_options["stripes-stripe_{$i}_content_boxes_solid_bg_color"];
					$the72_options["stripes-stripe_{$i}_content_boxes_bg_opacity"] = '100';
				} else {
					$the72_options["stripes-stripe_{$i}_content_boxes_bg_color"] = '#888888';
					$the72_options["stripes-stripe_{$i}_content_boxes_bg_opacity"] = '8';
				}
			}

			// Bottom bar.
			$the72_options['footer-padding-top'] = $the72_options['footer-paddings-top-bottom'];
			$the72_options['footer-padding-bottom'] = '10';
			switch ( $the72_options['footer-style'] ) {
				case 'content_width_line':
				case 'full_width_line':
					$the72_options['footer-bg_color'] = $the72_options['footer-primary_text_color'];
					$the72_options['footer-bg_opacity'] = '15';
					break;
				case 'transparent_bg_line':
					$the72_options['footer-bg_color'] = $the72_options['footer-primary_text_color'];
					$the72_options['footer-bg_opacity'] = '8';
					$the72_options['footer-style'] = 'solid_background';
					$the72_options['footer-decoration'] = 'none';
					break;
				case 'solid_background':
					$the72_options['footer-bg_opacity'] = '100';
					break;
			}
			switch ( $the72_options['bottom_bar-style'] ) {
				case 'content_width_line':
				case 'full_width_line':
					$the72_options['bottom_bar-bg_color'] = $the72_options['footer-primary_text_color'];
					$the72_options['bottom_bar-bg_opacity'] = '15';
					break;
				case 'solid_background':
					$the72_options['bottom_bar-bg_opacity'] = '100';
					break;
			}

			// Page title.
			$the72_options['page_title-padding-top'] = $the72_options['page_title-padding-bottom'] = '0';
			$the72_options['general-title_decoration'] = 'none';
			switch ( $the72_options['general-title_bg_mode'] ) {
				case 'transparent_bg':
					$the72_options['general-title_bg_mode'] = 'background';
					$the72_options['header-background'] = 'normal';
					$the72_options['general-title_bg_color'] = $the72_options['content-primary_text_color'];
					$the72_options['general-title_bg_opacity'] = '8';
					$the72_options['general-title_bg_parallax'] = '';
					$the72_options['general-title_bg_image'] = array(
						'image' => '',
						'repeat' => 'repeat',
						'position_x' => 'center',
						'position_y' => 'center',
					);
					break;
				case 'gradient':
				case 'background':
					$the72_options['general-title_bg_opacity'] = '100';
					if ( 'transparent' == $the72_options['header-background'] && 'disabled' == $the72_options['header-style'] ) {
						$the72_options['header-transparent_bg_opacity'] = '0';
					}
					break;
			}
			if ( in_array( $the72_options['header-menu_top_bar_color_mode'], array( 'theme', 'dark' ) ) ) {
				$the72_options['page_title-background-style-transparent-color_scheme'] = 'from_options';
			}

			// Buttons.
			$the72_options['buttons-hover_color_mode'] = $the72_options['buttons-color_mode'];
			$the72_options['buttons-hover_color'] = $the72_options['buttons-color'];
			$the72_options['buttons-hover_color_gradient'] = $the72_options['buttons-color_gradient'];
			$the72_options['buttons-text_hover_color_mode'] = $preset_options['buttons-text_color_mode'];
			$the72_options['buttons-text_hover_color'] = $preset_options['buttons-text_color'];

			// Image hovers.
			$the72_options['image_hover-project_rollover_color_mode'] = $the72_options['image_hover-color_mode'];
			$the72_options['image_hover-project_rollover_color'] = $the72_options['image_hover-color'];
			$the72_options['image_hover-project_rollover_color_gradient'] = $the72_options['image_hover-color_gradient'];
			$the72_options['image_hover-project_rollover_opacity'] = $the72_options['image_hover-opacity'];
			$the72_options['image_hover-default_icon'] = ( 'none' == $the72_options['image_hover-default_icon'] ? 'none' : 'big_center' );
			switch ( $the72_options['general-style'] ) {
				case 'ios7':
					$the72_options['general-filter_style'] = $the72_options['general-contact_form_style'] = 'ios';
					break;
				case 'minimalistic':
					$the72_options['image_hover-project_icons_style'] = 'transparent';
					$the72_options['image_hover-album_miniatures_style'] = 'style_1';
					$the72_options['general-filter_style'] = $the72_options['general-contact_form_style'] = 'minimal';
					break;
				case 'material':
					$the72_options['image_hover-project_icons_style'] = 'small';
					$the72_options['image_hover-album_miniatures_style'] = 'style_2';
					$the72_options['general-filter_style'] = $the72_options['general-contact_form_style'] = 'material';
					break;
			}

			// Filted style.
			$the72_options['general-filter-font-family'] = $the72_options['fonts-font_family'];
			$the72_options['general-filter_ucase'] = '0';
			$the72_options['general-filter-padding-top'] = '8';
			$the72_options['general-filter-padding-right'] = '13';
			$the72_options['general-filter-padding-bottom'] = '8';
			$the72_options['general-filter-padding-left'] = '13';
			$the72_options['general-filter-margin-top'] = '0';
			$the72_options['general-filter-margin-right'] = '5';
			$the72_options['general-filter-margin-bottom'] = '0';
			$the72_options['general-filter-margin-left'] = '0';

			// Beautiful loading.
			if ( 'accent' == $the72_options['general-beautiful_loading'] ) {
				$the72_options['general-fullscreen_overlay_color_mode'] = 'accent';
				$the72_options['general-spinner_color'] = '#ffffff';
			}
			$the72_options['general-beautiful_loading'] = ( 'disabled' == $the72_options['general-beautiful_loading'] ? 'disabled' : 'enabled' );

			// Sidebar.
			$the72_options['sidebar-bg_opacity'] = '100';

			// Disable plugins notifications.
			$the72_options['general-hide_plugins_notifications'] = '1';

			$merged_options = array_merge( $preset_options, $the72_options );

			// Validate options.
			$options_fields =& _optionsframework_options();
			foreach ( $options_fields as $option_field ) {
				if ( isset( $option_field['id'] ) && ! array_key_exists( $option_field['id'], $merged_options ) ) {
					unset( $merged_options[ $option_field['id'] ] );
				}
			}

			return apply_filters( 'presscore_compatibility_import_theme_options', $merged_options );
		}

		public function the7_options_exists() {
			if ( get_option( $this->import_status_slug ) ) {
				return;
			}

			$of_options = get_option( 'optionsframework' );

			if ( ! empty( $of_options['knownoptions'] ) && in_array( $this->old_options_key, $of_options['knownoptions'] ) ) {
				$the7_options = get_option( $this->old_options_key );

				if ( ! empty( $the7_options ) ) {
					add_option( $this->import_status_slug, 'options_found' );
				}
			}
		}

		public function admin_enqueue_scripts() {
			wp_enqueue_style( 'the7-options-import', $this->assets_uri . '/css/the7-import-style.css', false, wp_get_theme()->get( 'Version' ) );
			wp_enqueue_script( 'the7-options-import', $this->assets_uri . '/js/the7-import-script.js', array( 'jquery' ), wp_get_theme()->get( 'Version' ), true );

			wp_localize_script( 'the7-options-import', 'the7Adapter', array(
				'importPostData' => array(
					'option_page' => 'optionsframework',
					'action' => 'update',
					'_wpnonce' => wp_create_nonce( 'optionsframework-options' ),
					'the7_opts_import' => true,
					'defaultPreset' => $this->default_preset,
				),
				'dismissNotice' => array(
					'_wpnonce' => wp_create_nonce( 'migration-dismiss' ),
					'action' => 'presscore_compatibility_dismiss_admin_notice',
				),
			) );
		}

		protected function the7_options_found() {
			return 'options_found' == $this->import_status;
		}

		protected function get_assets_uri() {
			$theme_root = str_replace( '\\', '/', get_theme_root() );
			$current_dir = str_replace( '\\', '/', $this->module_dir );

			return str_replace( $theme_root, get_theme_root_uri(), $current_dir );
		}

		public static function regenerate_stylesheets() {
			presscore_refresh_dynamic_css();
		}

		protected static function fix_header_elements_option( $header, $values ) {
			$microwidgets_elements_relation = array(
				'side' => array(
					'below_menu' => 'bottom',
				),
				'left' => array(
					'top_bar_left' => 'top_bar_left',
					'top_bar_right' => 'top_bar_right',
					'near_menu_right' => 'nav_area',
				),
				'classic' => array(
					'top_bar_left' => 'top_bar_left',
					'top_bar_right' => 'top_bar_right',
					'near_menu_right' => 'nav_area',
					'near_logo_right' => 'logo_area',
					'near_logo_left' => '',
				),
				'center' => array(
					'top_bar_left' => 'top_bar_left',
					'top_bar_right' => '',
					'near_menu_right' => 'nav_area',
					'near_logo_right' => '',
					'near_logo_left' => '',
				),
			);

			// Combine top and bottom microwidgets for side header layout.
			if ( 'side' == $header && isset( $values['top'] ) ) {
				$values['bottom'] = array_merge( $values['top'], $values['bottom'] );
			}

			$elements = array();
			foreach ( $microwidgets_elements_relation[ $header ] as $new_val => $old_val ) {
				if ( isset( $values[ $old_val ] ) ) {
					$elements[ $new_val ] = $values[ $old_val ];
				} else {
					$elements[ $new_val ] = array();
				}
			}

			return $elements;
		}

		protected static function fix_font_size_option( $font_size ) {
			$canonized_font_size = $font_size;
			switch ( $font_size ) {
				case 'big':
					$canonized_font_size = '16';
					break;
				case 'normal':
					$canonized_font_size = '15';
					break;
				case 'small':
					$canonized_font_size = '12';
					break;
			}
			return $canonized_font_size;
		}

		protected function patch_db( $cur_db_version ) {
			$options = optionsframework_get_options();
			if ( ! $options ) {
				return;
			}

			$pathes_dir = trailingslashit( trailingslashit( dirname( __FILE__ ) ) . 'patches' );
			require_once $pathes_dir . 'interface-the7-db-patch.php';

			$patches = array(
				'3.5.0' => 'The7_DB_Patch_030500',
			);

			foreach ( $patches as $ver => $class_name ) {
				if ( version_compare( $ver, $cur_db_version ) <= 0 ) {
					continue;
				}

				include $pathes_dir . 'class-' . strtolower( str_replace( '_', '-', $class_name ) ) . '.php';

				$patch = new $class_name();
				$options = $patch->apply( $options );
			}

			update_option( optionsframework_get_options_id(), $options );
		}

	}

	Presscore_Modules_Compatibility_oldThe7::execute();

endif;
