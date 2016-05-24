<?php
/**
 * Sidebar columns layuot parser
 *
 * @package vogue
 * @since 1.0.0
 */

class Presscore_Sidebar_Layout_Parser extends Presscore_Columns_Layout_Parser {

	protected $widgets_count = 0;

	public function filter_dynamic_sidebar_params( $params = array() ) {

		if ( isset( $this->columns[ $this->widgets_count ] ) ) {
			$this->flush_default_widgets_cache();

			$column = $this->columns[ $this->widgets_count ];

			$params[0]['before_widget'] = preg_replace('/(class=[\'"])(.*?)([\'"])/', '$1$2 wf-cell ' . $column . '$3', $params[0]['before_widget']);

			if ( $this->widgets_count >= ( $this->columns_count - 1 ) ) {
				$this->widgets_count = 0;
			} else {
				$this->widgets_count++;
			}
		}

		return $params;
	}

	public function add_sidebar_columns() {
		add_filter( 'dynamic_sidebar_params', array( $this, 'filter_dynamic_sidebar_params' ) );
	}

	public function remove_sidebar_columns() {
		remove_filter( 'dynamic_sidebar_params', array( $this, 'filter_dynamic_sidebar_params' ) );
	}

	private function flush_default_widgets_cache() {
		wp_cache_delete('widget_recent_comments', 'widget');
		wp_cache_delete('widget_recent_posts', 'widget');
	}

}
