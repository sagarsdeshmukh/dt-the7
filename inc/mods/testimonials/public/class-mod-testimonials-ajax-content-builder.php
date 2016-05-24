<?php
/**
 * Testimonials ajax content builder.
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

class Presscore_Mod_Testimonials_Ajax_Content_Builder extends Presscore_Ajax_Content_Builder {

	protected function configure_template() {
		$this->config->set( 'template', 'testimonials' );
		$this->config->set( 'template.layout.type', 'masonry' );
		presscore_config_base_init( $this->input['post_id'] );

		if ( $this->config->get('justified_grid') && isset($this->input['sender']) && in_array($this->input['sender'], array('filter', 'paginator')) ) {
			$this->input['loaded_items'] = array();
		}

		presscore_react_on_categorizer();
	}

	protected function custom_loop() {
		do_action( 'presscore_before_loop' );

		$page_query = presscore_get_filtered_posts( array( 'post_type' => 'dt_testimonials', 'taxonomy' => 'dt_testimonials_category' ) );
		if ( $page_query->have_posts() ) {

			while( $page_query->have_posts() ) { $page_query->the_post();

				get_template_part( 'content', 'testimonials' );

			}

			wp_reset_postdata();

		}

		return $page_query;
	}
}
