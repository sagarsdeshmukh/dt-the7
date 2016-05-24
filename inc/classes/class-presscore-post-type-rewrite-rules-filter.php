<?php
/**
 * Class register actions for custom post type rewrite rules.
 */

class Presscore_Post_Type_Rewrite_Rules_Filter {
	private $slug_option_id;

	public function __construct( $slug_option_id ) {
		$this->slug_option_id = $slug_option_id;

		add_action( 'presscore_post_type_rewrite_rules_filter_one_time', array( $this, 'flush_rewrite_rules' ) );
	}

	public function filter_post_type_rewrite( $args ) {
		if ( isset( $args['rewrite']['slug'] ) ) {
			$new_slug = of_get_option( $this->slug_option_id, false );
			if ( $new_slug && is_string( $new_slug ) ) {
				$args['rewrite']['slug'] = trim( strtolower( $new_slug ) );
			}
		}
		return $args;
	}

	public function flush_rules_after_slug_change( $options = array() ) {
		if ( array_key_exists( $this->slug_option_id, $options ) ) {
			$old_slug = of_get_option( $this->slug_option_id, false );
			$new_slug = $options[ $this->slug_option_id ];

			// check if new slug is really new
			if ( $old_slug !== $new_slug ) {
				wp_schedule_single_event( time(), 'presscore_post_type_rewrite_rules_filter_one_time' );
			}
		}
	}

	public function flush_rewrite_rules() {
		flush_rewrite_rules();
	}
}
