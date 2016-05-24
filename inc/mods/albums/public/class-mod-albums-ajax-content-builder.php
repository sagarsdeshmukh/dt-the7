<?php
/**
 * Albums ajax content builder.
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

class Presscore_Mod_Albums_Ajax_Content_Builder extends Presscore_Ajax_Content_Builder {

	protected function configure_template() {
		$this->config->set( 'template', 'albums' );
		$this->config->set( 'template.layout.type', 'masonry' );
		presscore_config_base_init( $this->input['post_id'] );

		if ( $this->config->get('justified_grid') && isset($this->input['sender']) && in_array($this->input['sender'], array('filter', 'paginator')) ) {
			$this->input['loaded_items'] = array();
		}

		presscore_react_on_categorizer();
	}

	protected function custom_loop() {
		do_action( 'presscore_before_loop' );

		$page_query = presscore_get_filtered_posts( array( 'post_type' => 'dt_gallery', 'taxonomy' => 'dt_gallery_category' ) );
		if ( $page_query->have_posts() ) {

			add_filter( 'presscore_get_images_gallery_hoovered-title_img_args', 'presscore_gallery_post_exclude_featured_image_from_gallery', 15, 3 );

			while( $page_query->have_posts() ) { $page_query->the_post();

				// populate post config
				presscore_populate_album_post_config();

				presscore_get_template_part( 'mod_albums', 'album-masonry/album' );
			}

			wp_reset_postdata();

			remove_filter( 'presscore_get_images_gallery_hoovered-title_img_args', 'presscore_gallery_post_exclude_featured_image_from_gallery', 15, 3 );

		}

		return $page_query;
	}
}
