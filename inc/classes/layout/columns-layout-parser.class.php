<?php
/**
 * Parse columns layout string
 *
 * @package vogue
 * @since 1.0.0
 */

class Presscore_Columns_Layout_Parser {

	protected $columns = array();
	protected $columns_count = 0;

	public function __construct( $columns_layout = '' ) {
		$this->columns = $this->parse_columns( $columns_layout );
		$this->columns_count = count( $this->columns );
	}

	public function get_columns() {
		return $this->columns;
	}

	public function get_columns_count() {
		return $this->columns_count;
	}

	protected function parse_columns( $columns_layout = '' ) {

		if ( ! $columns_layout ) {
			return array();
		}

		return array_map( array( $this, 'get_column_class' ), explode( '+', $columns_layout ) );
	}

	protected function get_column_class( $string = '' ) {
		$clear_string = trim( $string );
		$clear_string = str_replace( '/', '-', $clear_string );
		return 'wf-' . $clear_string;
	}
}
