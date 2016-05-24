<?php
/* Template Name: Gallery - justified grid */

/**
 * Media Gallery template. Uses dt_gallery post type and dt_gallery_category taxonomy.
 *
 * @package vogue
 * @since 1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

$config = Presscore_Config::get_instance();

$config->set( 'template', 'media' );

// add page content controller
add_action( 'presscore_before_main_container', 'presscore_page_content_controller', 15 );

get_header();

if ( presscore_is_content_visible() ): ?>

			<!-- Content -->
			<div id="content" class="content" role="main">

				<?php
				if ( have_posts() ) : while ( have_posts() ) : the_post(); // main loop

					do_action( 'presscore_before_loop' );

					if ( post_password_required() ) {
						the_content();

					} else {

						// backup config
						$config_backup = $config->get();

						// fullwidth wrap open
						if ( $config->get( 'full_width' ) ) { echo '<div class="full-width-wrap">'; }

						// masonry container open
						echo '<div ' . presscore_masonry_container_class( array( 'wf-container', 'dt-gallery-container' ) ) . presscore_masonry_container_data_atts() . presscore_get_share_buttons_for_prettyphoto( 'photo' ) . '>';

							//////////////////////
							// Custom loop //
							//////////////////////

							if ( function_exists( 'presscore_mod_albums_get_photos' ) ) {

								$page_query = presscore_mod_albums_get_photos();

								if ( $page_query->have_posts() ): while( $page_query->have_posts() ): $page_query->the_post();

									presscore_get_template_part( 'mod_albums', 'photo-masonry/photo' );

								endwhile; wp_reset_postdata(); endif;

							}

						// masonry container close
						echo '</div>';

						// fullwidth wrap close
						if ( $config->get( 'full_width' ) ) { echo '</div>'; }

						/////////////////////
						// Pagination //
						/////////////////////

						presscore_complex_pagination( $page_query );

						// restore config
						$config->reset( $config_backup );

					}

					do_action( 'presscore_after_loop' );

				endwhile; endif; // end of main loop
				?>

			</div><!-- #content -->

			<?php
			do_action('presscore_after_content');

		endif; // if content visible

get_footer(); ?>