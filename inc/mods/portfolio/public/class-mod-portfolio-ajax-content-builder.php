<?php
/**
 * Portfolio ajax content builder.
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

class Presscore_Mod_Portfolio_Ajax_Content_Builder extends Presscore_Ajax_Content_Builder {

	protected function configure_template() {
		$this->config->set( 'template', 'portfolio' );
		presscore_config_base_init( $this->input['post_id'] );

		if ( $this->config->get('justified_grid') && isset($this->input['sender']) && in_array($this->input['sender'], array('filter', 'paginator')) ) {
			$this->input['loaded_items'] = array();
		}

		presscore_react_on_categorizer();
	}

	protected function custom_loop() {
		do_action( 'presscore_before_loop' );

		$page_query = presscore_get_filtered_posts( array( 'post_type' => 'dt_portfolio', 'taxonomy' => 'dt_portfolio_category' ) );
		if ( $page_query->have_posts() ) {

			$page_layout = presscore_get_current_layout_type();
			$current_post = $this->input['posts_count'];

			while( $page_query->have_posts() ) { $page_query->the_post();

				// populate post config
				presscore_populate_portfolio_config();

				// post template
				switch ( $page_layout ) {
					case 'masonry':
						presscore_get_template_part( 'mod_portfolio', 'masonry/project' );
						break;
					case 'list':
						// global posts counter
						$this->config->set( 'post.query.var.current_post', ++$current_post );

						presscore_get_template_part( 'mod_portfolio', 'list/project' );
						break;
				}

			}

			wp_reset_postdata();

		}

		return $page_query;
	}
}
