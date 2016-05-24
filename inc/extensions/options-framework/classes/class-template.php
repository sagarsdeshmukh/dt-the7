<?php
/**
 * Base options template abstract class.
 *
 * @package The7\Options\Templates
 * @since 3.0.0
 */

if ( ! class_exists( 'Presscore_Lib_Options_Template', false ) ) :

	/**
	 * Options template abstract base class.
	 */
	abstract class Presscore_Lib_Options_Template {

		/**
		 * Apply options template to $options array.
		 * 
		 * @param  array &$options
		 * @param  string $prefix
		 * @param  array  $fields
		 */
		public function execute( &$options, $prefix, $fields = array(), $dependency = array() ) {
			$_fields = $this->do_execute();

			$_fields = $this->merge_fields( $_fields, $fields );
			$_fields = array_filter( $_fields );

			$prefix = ( $prefix ? $prefix . '-' : '' );
			foreach ( $_fields as $field_id => $field ) {
				$field_id = ( isset( $field['id'] ) ? $field['id'] : $field_id );

				if ( ! is_numeric( $field_id ) ) {
					$field_id = $prefix . $field_id;

					$field['id'] = $field_id;

					$field = $this->prefacing_dependency( $prefix, $field );

					if ( $dependency ) {
						$field['dependency'] = isset( $field['dependency'] ) ? array_merge_recursive( $field['dependency'], $dependency ) : $dependency;
					}

					$options[ $field_id ] = $field;
				} else {
					$options[] = $field;
				}
			}
		}

		protected function merge_fields( &$fields1, &$fields2 ) {
			$merged = $fields1;

			foreach ( $fields2 as $key => &$value ) {
				if ( is_array ( $value ) && isset ( $merged [$key] ) && is_array ( $merged [$key] ) ) {
					$merged [$key] = $this->merge_fields( $merged [$key], $value );
				} else {
					$merged [$key] = $value;
				}
			}

			return $merged;
		}

		protected function prefacing_dependency( $prefix, $field ) {
			if ( isset( $field['dependency'] ) ) {
				foreach ( $field['dependency'] as $i=>$or ) {
					foreach ( $or as $j=>$and ) {
						$field['dependency'][ $i ][ $j ]['field'] = $prefix . $and['field'];
					}
				}
			}

			return $field;
		}

		/**
		 * Template method.
		 * 
		 * @return array
		 */
		abstract protected function do_execute();
	}

endif;

if ( ! function_exists( 'presscore_options_apply_template' ) ) :

	/**
	 * Apply options template.
	 * 
	 * @param  array &$options
	 * @param  string $tpl
	 * @param  string $prefix
	 * @param  array  $fields
	 */
	function presscore_options_apply_template( &$options, $tpl, $prefix, $fields = array(), $dependency = array() ) {
		$class_name = 'Presscore_Lib_Options_' . implode( '', array_map( 'ucfirst', explode( '-',  strtolower( $tpl ) ) ) ) . 'Template';

		if ( class_exists( $class_name ) ) {
			$template = new $class_name();
			$template->execute( $options, $prefix, $fields, $dependency );
		}
	}

endif;
