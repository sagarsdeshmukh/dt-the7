<?php
/**
 * The7 db patch base class.
 *
 * @package the7
 * @since 3.5.0
 */

interface The7_DB_Patch_Interface {

	public function apply( $options );

}

class The7_DB_Patch implements The7_DB_Patch_Interface {

	protected $options = array();

	public function apply( $options ) {
		$this->options = $options;
		$this->do_apply();
		return $this->options;
	}

	/**
	 * Override in a subclass.
	 */
	protected function do_apply() {}

	protected function rename_option( $old_key, $new_key ) {
		if ( $this->option_exists( $old_key ) && ! $this->option_exists( $new_key ) ) {
			$this->set_option( $new_key, $this->get_option( $old_key ) );
			$this->remove_option( $old_key );
		}
	}

	protected function remove_option( $key ) {
		unset( $this->options[ $key ] );
	}

	protected function set_option( $key, $val ) {
		$this->options[ $key ] = $val;
	}

	protected function get_option( $key ) {
		if ( $this->option_exists( $key ) ) {
			return $this->options[ $key ];
		}

		return null;
	}

	protected function option_exists( $key ) {
		return array_key_exists( $key, $this->options );
	}
}
