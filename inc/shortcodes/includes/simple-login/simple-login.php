<?php
/**
 * Simple login form shortcode.
 *
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! class_exists( 'DT_Shortcode_Simple_Login', false ) ) {

	class DT_Shortcode_Simple_Login extends DT_Shortcode {

		static protected $instance;

		public static function get_instance() {
			if ( !self::$instance ) {
				self::$instance = new DT_Shortcode_Simple_Login();
			}
			return self::$instance;
		}

		protected function __construct() {
			add_shortcode( 'dt_simple_login_form', array( $this, 'shortcode' ) );
		}

		public function shortcode( $atts, $content = null ) {
			$default_atts = array(
				'redirect' => '',
				'label_username' => '',
				'label_password' => '',
				'label_remember' => '',
				'label_log_in' => '',
				'form_id' => 'loginform',
				'id_username' => 'user_login',
				'id_password' => 'user_pass',
				'id_remember' => 'rememberme',
				'id_submit' => 'wp-submit',
				'remember' => '1',
				'value_username' => '',
				'value_remember' => '0'
			);
			$atts = shortcode_atts( $default_atts, $atts );

			$login_form_args = array();

			foreach ( $atts as $att=>$val ) {
				$clear_val = strip_tags( $val );

				if ( '' === $clear_val ) {
					continue;
				}

				if ( in_array( $att, array( 'remember', 'value_remember' ) ) ) {
					$clear_val = (bool) absint( $clear_val );
				}

				$login_form_args[ $att ] = $clear_val;
			}

			$output = '';

			$this->add_actions();

			$output .= '<div class="simple-login-form-shortcode">';
				$output .= $this->get_wp_login_form( $login_form_args );
			$output .= '</div>';

			$this->remove_actions();

			return $output; 
		}

		public function do_login_action( $output = '' ) {

			ob_start();
			do_action( 'login_form' );
			$output .= ob_get_contents();
			ob_end_clean();

			return $output;
		}

		protected function get_wp_login_form( $args = array() ) {
			$defaults = array(
				'echo' => false,
				'redirect' => ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'], // Default redirect is back to the current page
				'form_id' => 'loginform',
				'label_username' => _x( 'Username', 'shortcode simple login', 'the7mk2' ),
				'label_password' => _x( 'Password', 'shortcode simple login', 'the7mk2' ),
				'label_remember' => _x( 'Remember Me', 'shortcode simple login', 'the7mk2' ),
				'label_log_in' => _x( 'Log In', 'shortcode simple login', 'the7mk2' ),
				'id_username' => 'user_login',
				'id_password' => 'user_pass',
				'id_remember' => 'rememberme',
				'id_submit' => 'wp-submit',
				'remember' => true,
				'value_username' => '',
				'value_remember' => false, // Set this to true to default the "Remember me" checkbox to checked
			);

			$args = wp_parse_args( $args, apply_filters( 'login_form_defaults', $defaults ) );

			if ( is_user_logged_in() ) {
				global $user_identity;
				get_currentuserinfo();

				$form = '<p class="logged-in-as">' 
					. sprintf(
						_x( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'shortcode simple login', 'the7mk2' ),
						get_edit_user_link(),
						$user_identity,
						wp_logout_url( apply_filters( 'the_permalink', get_permalink() ) )
					) 
					. '</p>';

			} else {
				$login_form_top = apply_filters( 'login_form_top', '', $args );
				$login_form_middle = apply_filters( 'login_form_middle', '', $args );
				$login_form_bottom = apply_filters( 'login_form_bottom', '', $args );

				$form = '
					<form name="' . $args['form_id'] . '" id="' . $args['form_id'] . '" action="' . esc_url( site_url( 'wp-login.php', 'login_post' ) ) . '" method="post">
						' . $login_form_top . '
						<p class="login-username">
							<label class="assistive-text" for="' . esc_attr( $args['id_username'] ) . '">' . esc_html( $args['label_username'] ) . '</label>
							<input type="text" name="log" placeholder="' . esc_attr( $args['label_username'] ) . '" id="' . esc_attr( $args['id_username'] ) . '" class="input" value="' . esc_attr( $args['value_username'] ) . '" size="20" />
						</p>
						<p class="login-password">
							<label class="assistive-text" for="' . esc_attr( $args['id_password'] ) . '">' . esc_html( $args['label_password'] ) . '</label>
							<input type="password" name="pwd" placeholder="' . esc_attr( $args['label_password'] ) . '" id="' . esc_attr( $args['id_password'] ) . '" class="input" value="" size="20" />
						</p>
						' . $login_form_middle . '
						' . ( $args['remember'] ? '<p class="login-remember"><label><input name="rememberme" type="checkbox" id="' . esc_attr( $args['id_remember'] ) . '" value="forever"' . ( $args['value_remember'] ? ' checked="checked"' : '' ) . ' /> ' . esc_html( $args['label_remember'] ) . '</label></p>' : '' ) . '
						<p class="login-submit">
							<input type="submit" name="wp-submit" id="' . esc_attr( $args['id_submit'] ) . '" class="button-primary" value="' . esc_attr( $args['label_log_in'] ) . '" />
							<input type="hidden" name="redirect_to" value="' . esc_url( $args['redirect'] ) . '" />
						</p>
						' . $login_form_bottom . '
					</form>';
			}

			return $form;
		}

		protected function add_actions() {
			add_filter( 'login_form_middle', array( $this, 'do_login_action' ) );
		}

		protected function remove_actions() {
			remove_filter( 'login_form_middle', array( $this, 'do_login_action' ) );
		}

	}

	// create shortcode
	DT_Shortcode_Simple_Login::get_instance();

}
