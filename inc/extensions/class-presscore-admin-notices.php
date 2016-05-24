<?php
/**
 * Presscore admin messages class.
 */

class Presscore_Admin_Notices {

	private $registered_notices = array();
	private $dismissed_notices = array();
	private $user_meta_key;
	private $setting;

	public function __construct( $setting ) {
		$this->setting = sanitize_key( $setting );
		$this->user_meta_key = "_presscore_dismiss_{$this->setting}";
	}

	public function add_notice( $code, $message, $type ) {
		$this->registered_notices[ $code ] = array(
			'message' => $message,
			'type' => $type
		);
	}

	public function print_admin_notices() {
		$dismissed_notices = $this->dismissed_notices ? array_combine( $this->dismissed_notices, $this->dismissed_notices ) : array();
		$notices_to_show = array_diff_key( $this->registered_notices, $dismissed_notices );
		$exclude_from_screen = apply_filters( 'presscore_admin_exclude_notices_from_screen', array( 'options-general' ) );

		if ( $notices_to_show && ! in_array( get_current_screen()->parent_base, $exclude_from_screen ) ) {
			foreach( $notices_to_show as $code=>$notice ) {
				$type = explode( ' ', $notice['type'] );
				$message = $notice['message'];

				if ( ! in_array( 'presscore-without-wrap', $type ) ) {
					$message = "<p><strong>{$message}</strong></p>";
				}

				$id = 'presscore-notice-' . $code;
				$class = $notice['type'] . ' presscore-notice notice is-dismissible';
				printf( '<div id="%s" class="%s">%s</div>', esc_attr( $id ), esc_attr( $class ), $message );
			}
		}
	}

	public function dismiss_notices() {
		check_ajax_referer( "presscore_dismiss_{$this->setting}" );

		$code = $_POST['code'];

		if ( ! $this->notice_is_dismissed( $code ) ) {
			$this->dissmiss_notice( $code );
			$this->update_user_meta();
		}
		wp_die();
	}

	public function get_nonce() {
		return wp_create_nonce( "presscore_dismiss_{$this->setting}" );
	}

	public function get_dismissed_notices() {
		$user_meta = get_user_meta( get_current_user_id(), $this->user_meta_key, true );
		$this->dismissed_notices = $user_meta ? (array) $user_meta : array();
	}

	protected function update_user_meta() {
		update_user_meta( get_current_user_id(), $this->user_meta_key, $this->dismissed_notices );
	}

	protected function dissmiss_notice( $code ) {
		$this->dismissed_notices[] = (string) $code;
	}

	protected function notice_is_dismissed( $code ) {
		return in_array( $code, $this->dismissed_notices );
	}
}
