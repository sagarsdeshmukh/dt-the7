<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package presscore
 * @since presscore 0.1
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

$config = Presscore_Config::get_instance();
$config->set( 'template', 'blog' );
$config->set( 'layout', 'list' );
$config->set( 'template.layout.type', 'list' );
$config->set( 'post.preview.media.width', 30 );

get_header(); ?>

			<!-- Content -->
			<div id="content" class="content" role="main">

				<?php if ( have_posts() ) : ?>

					<div class="articles-list">

						<?php do_action( 'presscore_before_loop' ); ?>

						<?php update_post_thumbnail_cache(); ?>

						<?php while ( have_posts() ) : the_post(); ?>

							<?php
							// populate config with current post settings
							presscore_populate_post_config();

							presscore_get_template_part( 'theme', 'blog/list/blog-list-post' );
							?>

						<?php endwhile; ?>

						<?php do_action( 'presscore_after_loop' ); ?>

					</div>

					<?php dt_paginator(); ?>

				<?php else : ?>

					<?php get_template_part( 'no-results', 'blog' ); ?>

				<?php endif; ?>

			</div><!-- #content -->

			<?php do_action('presscore_after_content'); ?>

<?php get_footer(); ?>