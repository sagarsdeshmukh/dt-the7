<?php
/* Template Name: Portfolio - list */

/**
 * Portfolio list layout.
 *
 * @package presscore
 * @since presscore 0.1
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

global $post;
$config = Presscore_Config::get_instance();
$config->set('template', 'portfolio');

add_action('presscore_before_main_container', 'presscore_page_content_controller', 15);

get_header();

if ( presscore_is_content_visible() ): ?>

			<!-- Content -->
			<div id="content" class="content" role="main">

				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); // main loop 

					do_action( 'presscore_before_loop' );

					if ( post_password_required() ) {
						the_content();

					} else {

						// backup config
						$config_backup = $config->get();

						///////////////////////
						// Posts Filer //
						///////////////////////

						presscore_display_posts_filter( array(
							'post_type' => 'dt_portfolio',
							'taxonomy' => 'dt_portfolio_category'
						) );

						// list container open
						echo '<div ' . presscore_list_container_html_class( 'articles-list' ) . presscore_list_container_data_atts() .'>';

							$page_query = presscore_get_filtered_posts( array( 'post_type' => 'dt_portfolio', 'taxonomy' => 'dt_portfolio_category' ) );
							if ( $page_query->have_posts() ) {

								while( $page_query->have_posts() ) { $page_query->the_post();

									// global posts counter
									$config->set( 'post.query.var.current_post', $page_query->current_post + 1 );

									// populate post config
									presscore_populate_portfolio_config();

									presscore_get_template_part( 'mod_portfolio', 'list/project' );
								}

								wp_reset_postdata();
							}

						// list container close
						echo '</div>';

						/////////////////////
						// Pagination //
						/////////////////////

						presscore_complex_pagination( $page_query );

						// restore config
						$config->reset( $config_backup );

					}

					do_action( 'presscore_after_loop' );

				endwhile; endif; // main loop ?>

			</div><!-- #content -->

			<?php
			do_action('presscore_after_content');

endif; // if content visible

get_footer(); ?>