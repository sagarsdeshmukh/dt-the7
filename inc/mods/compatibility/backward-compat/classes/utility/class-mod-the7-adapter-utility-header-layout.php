<?php
/**
 * Class that helps manage header layout theme option.
 * 
 */

final class Presscore_Mod_The7_Adapter_Utility_Header_Layout {
	private $placeholders = array(
		'top_bar_left',
		'top_bar_right',
		'nav_area',
		'top',
		'bottom',
		'logo_area'
	);

	private $layout_data = array();

	public function __construct( $layout_data = array() ) {
		$this->layout_data = (array) $layout_data;
	}

	public function add_element( $element_id, $placeholder ) {
		if ( ! $this->placeholder_exists( $placeholder ) ) {
			$this->layout_data[ $placeholder ] = array();
		}

		$this->layout_data[ $placeholder ][] = $element_id;
	}

	public function get_elements_from( $placeholder ) {
		if ( $this->placeholder_exists( $placeholder ) ) {
			return $this->layout_data[ $placeholder ];
		}

		return false;
	}

	public function clear_placeholder( $placeholder ) {
		unset( $this->layout_data[ $placeholder ] );
	}

	public function clear_all_placeholders() {
		$this->layout_data = array();
	}

	public function get_layout_data() {
		return $this->layout_data;
	}

	private function placeholder_exists( $placeholder ) {
		return isset( $this->layout_data[ $placeholder ] ) && is_array( $this->layout_data[ $placeholder ] );
	}
}
