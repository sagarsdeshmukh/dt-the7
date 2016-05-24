<?php
/**
 * This class fixes header theme options compatibility issues.
 */

final class Presscore_Mod_The7_Adapter_Header {
	private static $instance;
	private $header_layout_obj;
	private $new_opts = array();
	private $old_opts = array();

	public static function get_instance() {
		if ( ! self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	public function filter_theme_options( $new_opts, $old_opts ) {
		$this->new_opts = $new_opts;
		$this->old_opts = $old_opts;
		$this->header_layout_obj = new Presscore_Mod_The7_Adapter_Utility_Header_Layout();

		$this->fix_contact_information();
		$this->fix_textarea();
		$this->fix_woocommerce_cart();
		$this->fix_social_icons();
		$this->fix_search();

		$this->fix_header_layout();

		return $this->new_opts;
	}

	private function fix_contact_information() {
		if ( ! empty( $this->old_opts['top_bar-contact_show'] ) ) {

			$contact_info_fields = array(
				'top_bar-contact_address' => array(
					'new_field_id' => 'header-contact_address',
					'element_id' => 'address',
				),
				'top_bar-contact_phone' => array(
					'new_field_id' => 'header-contact_phone',
					'element_id' => 'phone',
				),
				'top_bar-contact_email' => array(
					'new_field_id' => 'header-contact_email',
					'element_id' => 'email',
				),
				'top_bar-contact_skype' => array(
					'new_field_id' => 'header-contact_skype',
					'element_id' => 'skype',
				),
				'top_bar-contact_clock' => array(
					'new_field_id' => 'header-contact_clock',
					'element_id' => 'working_hours'
				),
			);

			foreach ( $contact_info_fields as $old_field_id=>$new_field ) {
				if ( ! empty( $this->old_opts[ $old_field_id ] ) ) {

					// copy value from ancestor option
					$this->new_opts[ $new_field['new_field_id'] ] = $this->old_opts[ $old_field_id ];

					// turn on icon
					$this->new_opts[ $new_field['new_field_id'] . '_icon' ] = true;

					// populate top bar left position
					$this->header_layout_obj->add_element( $new_field['element_id'], 'top_bar_left' );
				}
			}

		}
	}

	private function fix_woocommerce_cart() {
		if ( ! empty( $this->old_opts['general-woocommerce_show_mini_cart_in_top_bar'] ) ) {
			$this->header_layout_obj->add_element( 'cart', 'top_bar_left' );
		}
	}

	private function fix_social_icons() {
		if ( $this->get_old_option( 'header-soc_icons' ) ) {
			$this->header_layout_obj->add_element( 'social_icons', 'top_bar_left' );
		}
	}

	private function fix_textarea() {
		if ( $this->get_old_option( 'top_bar-text' ) ) {
			$this->set_new_option( 'header-text', $this->get_old_option( 'top_bar-text' ) );
			$this->header_layout_obj->add_element( 'text_area', 'top_bar_left' );
		}
	}

	private function fix_search() {
		if ( $this->get_old_option( 'header-search_show' ) ) {
			$this->set_new_option( 'header-search_icon', true );
			$this->set_new_option( 'header-search_caption', '' );
			$this->header_layout_obj->add_element( 'search', 'top_bar_left' );
		}
	}

	private function fix_header_layout() {
		// deprecated value
		if ( 'classic-centered' == $this->new_opts['header-layout'] ) {
			$this->new_opts['header-layout'] = 'center';
		}

		$header_layout_id = 'header-' . $this->new_opts['header-layout'] . '_layout_elements';
		$this->new_opts[ $header_layout_id ] = $this->header_layout_obj->get_layout_data();
	}

	private function get_old_option( $key ) {
		if ( ! empty( $this->old_opts[ $key ] ) ) {
			return $this->old_opts[ $key ];
		}

		return '';
	}

	private function get_new_option( $key ) {
		if ( ! empty( $this->new_opts[ $key ] ) ) {
			return $this->new_opts[ $key ];
		}

		return '';
	}

	private function set_new_option( $key, $value ) {
		$this->new_opts[ $key ] = $value;
	}

	private function __construct() {}
	private function __clone() {}
}
