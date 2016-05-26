<?php
/**
 * Presscore template manager.
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

class Presscore_Template_Manager {

	protected $templates_path;

	public function __construct() {
		$this->templates_path = array();
	}

	public function get_template_part( $interface, $slug, $name = null, $args = array() ) {
		do_action( "get_template_part_{$slug}", $slug, $name );

		$template_names = $this->get_template_names( $interface, $slug, $name );

		return $this->locate_template( $template_names, $args, true, false );
	}

	public function locate_template( $template_names, $args = array(), $load = false, $require_once = true ) {
		$located = apply_filters( 'presscore_template_manager_located_template', $this->_locate_template( $template_names ), $template_names );

		if ( $load && '' != $located ) {
			return $this->load_template( $located, $args, $require_once );
		}

		return $located;
	}

	public function load_template( $_template_file, $args = array(), $require_once = true ) {
		global $posts, $post, $wp_did_header, $wp_query, $wp_rewrite, $wpdb, $wp_version, $wp, $id, $comment, $user_ID;

		if ( isset( $wp_query->query_vars ) && is_array( $wp_query->query_vars ) ){
			extract( $wp_query->query_vars, EXTR_SKIP );
		}

		extract( $args, EXTR_SKIP );

		if ( $require_once ) {
			return require_once $_template_file;
		} else {
			return require $_template_file;
		}
	}

	public function add_path( $interface, $path ) {
		$path = is_array( $path ) ? $path : array( $path );
		$this->templates_path[ $interface ] = array_map( array( $this, 'sanitize_path' ), $path );
	}

	public function remove_path( $interface ) {
		unset( $this->templates_path[ $interface ] );
	}

	public function get_path( $interface ) {
		return ( isset( $this->templates_path[ $interface ] ) ? $this->templates_path[ $interface ] : array() );
	}

	protected function sanitize_path( $path ) {
		return ltrim( trailingslashit( $path ), '\/' );
	}

	protected function get_template_names( $interface, $slug, $name = null ) {
		$templates = array();
		$name = (string) $name;
		if ( isset( $this->templates_path[ $interface ] ) ) {

			foreach ( $this->templates_path[ $interface ] as $path ) {
				if ( '' !== $name ) {
					$templates[] = "{$path}{$slug}-{$name}.php";
				}

				$templates[] = "{$path}{$slug}.php";
			}
		}
		return $templates;
	}

	protected function _locate_template( $templates ) {
		return locate_template( $templates, false );
	}
}
