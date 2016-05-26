<?php
/* Template Name: Blog - list */

/**
 * Blog list template
 *
 * @package vogue
 * @since 1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

$config = Presscore_Config::get_instance();
$config->set( 'template', 'blog' );
$config->set( 'template.layout.type', 'list' );

// add content controller
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

						///////////////////////
						// Posts Filer //
						///////////////////////

						presscore_display_posts_filter( array(
							'post_type' => 'post',
							'taxonomy' => 'category'
						) );

						echo '<div ' . presscore_list_container_html_class( 'articles-list' ) . presscore_list_container_data_atts() . '>';

							//////////////////////
							// Custom loop //
							//////////////////////

							$page_query = presscore_get_blog_query();

							// start loop
							if ( $page_query->have_posts() ): while( $page_query->have_posts() ): $page_query->the_post();

								// global posts counter
								$config->set( 'post.query.var.current_post', $page_query->current_post + 1 );

								// populate config with current post settings
								presscore_populate_post_config();

								presscore_get_template_part( 'theme', 'blog/list/blog-list-post' );

							endwhile; wp_reset_postdata(); endif;

						echo '</div>';

						/////////////////////
						// Pagination //
						/////////////////////

						presscore_complex_pagination( $page_query );

						// restore config
						$config->reset( $config_backup );

					}

					do_action( 'presscore_after_loop' );

				endwhile; endif; // main loop
				?>

			</div><!-- #content -->

			<?php do_action('presscore_after_content');

endif; // if content visible

get_footer(); ?>