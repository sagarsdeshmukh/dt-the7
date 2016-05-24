<?php
/**
 * Config class.
 *
 * @since presscore 1.0
 */

interface Presscore_Config_Interface {
	public function set( $name, $value = null, $default = null );
	public function reset( $options = array() );
	public function get( $name = '', $default = null );
}

/**
 * Singleton.
 *
 */
class Presscore_Config implements Presscore_Config_Interface{

	public static function get_instance() {
		if ( !self::$instance ) {
			self::$instance = new Presscore_Config();
		}

		return self::$instance;
	}

	protected function __construct() {}

	private function __clone() {}

	private function __wakeup() {}

	private static $instance = null;

	private $meta_prefix = '';

	private $post_id = 0;

	private $page_id = 0;

	private $options = array();

	/**
	 * Description here
	 *
	 * @param string $name    Setting name
	 * @param mixed $value    Setting value
	 * @param mixed $default  Setting default value, used if $value === '' or $value === null
	 */
	public function set( $name, $value = null, $default = null ) {

		if ( ('' === $value || null === $value) && isset($default) ) {
			$this->options[ $name ] = $default;

		} else {
			$this->options[ $name ] = $value;

		}
	}

	public function reset( $options = array() ) {
		$this->options = $options;
	}

	public function get( $name = '', $default = null ) {
		if ( '' == $name ) {
			return $this->options;
		}

		if ( isset( $this->options[ $name ] ) ) {
			return $this->options[ $name ];

		}

		return $default;
	}

	public function get_bool( $name = '', $default = null ) {
		$value = $this->get( $name, $default );
		return in_array( $value, array( '1', 'true', 'y', 'on', 'enabled' ) );
	}

	public function set_meta_prefix( $meta_prefix = '' ) {
		$this->meta_prefix = (string) $meta_prefix;
	}

	public function get_meta_prefix() {
		return $thia->meta_prefix;
	}

	public function set_post_id( $post_id = 0 ) {
		$this->post_id = absint( $post_id );
	}

	public function get_post_id() {
		return $this->post_id;
	}

	public function set_page_id( $page_id = 0 ) {
		$this->page_id = absint( $page_id );
	}

	public function get_page_id() {
		return $this->page_id;
	}

	public function map( $options ) {
		if ( is_array( $options ) ) {

			foreach ( $options as $opt_name=>$opt_data ) {
				$opt_data = array_values( (array) $opt_data );

				if ( count( $opt_data ) >= 2 ) {
					$opt_type = $opt_data[0];
					$opt_val = $opt_data[1];
					$def = isset( $opt_data[2] ) ? $opt_data[2] : null;
					switch( $opt_type ) {
						case 'meta':
							$this->set_meta( $opt_name, $opt_val, $def );
							break;
						case 'option':
							$this->set_option( $opt_name, $opt_val, $def );
							break;
						case 'value':
							$this->set( $opt_name, $opt_val, $def );
							break;
					}
				}
			}
		}
	}

	public function set_meta( $name, $meta_key, $default = null ) {
		$meta_value = null;
		if ( $this->post_id ) {
			$meta_value = get_post_meta( $this->post_id, $this->meta_prefix . $meta_key, true  );
		}
		$this->set( $name, $meta_value, $default );
	}

	public function set_option( $name, $option_key, $default = null ) {
		$this->set( $name, $this->get_option( $option_key ), $default );
	}

	/**
	 * Debug method. Dump setting array that contains $search_name. If $search_name is empty - dump all stored settings.
	 *
	 * @since  4.1.4
	 * @param  string $search_name Setting name for search
	 */
	public function dump( $search_name = '' ) {

		echo '<pre style="background-color: #F1F1F1; padding: 10px;">';
		echo '<span style="background-color: #FFFFFF; color: red;">' . __METHOD__ . ' => ' . $search_name . '</span></br>';

		if ( $search_name ) {
			$options = array();

			foreach ( $this->options as $option_name => $value ) {

				if ( false !== strpos($option_name, $search_name) ) {
					$options[ $option_name ] = $value;
				}
			}
			var_dump( $options );

		} else {
			var_dump( $this->options );

		}
		echo '</pre>';

	}

	protected function get_option( $name, $default = null ) {
		return of_get_option( $name, $default );
	}
}

if ( ! function_exists( 'presscore_get_config' ) ) :

	/**
	 * @return Presscore_Config
	 */
	function presscore_get_config() {
		return Presscore_Config::get_instance();
	}

endif;
