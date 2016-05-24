<?php
/**
 * Media ajax content builder.
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

class Presscore_Mod_Media_Ajax_Content_Builder extends Presscore_Ajax_Content_Builder {

	protected function configure_template() {
		$this->config->set( 'template', 'media' );
		presscore_config_base_init( $this->input['post_id'] );

		if ( $this->config->get('justified_grid') && isset($this->input['sender']) && in_array($this->input['sender'], array('filter', 'paginator')) ) {
			$this->input['loaded_items'] = array();
		}
	}

	protected function custom_loop() {
		do_action( 'presscore_before_loop' );

		$page_query = presscore_mod_albums_get_photos();

		if ( $page_query->have_posts() ) {

			while( $page_query->have_posts() ) { $page_query->the_post();
				presscore_get_template_part( 'mod_albums', 'photo-masonry/photo' );
			}

			wp_reset_postdata();

		}

		return $page_query;
	}
}
