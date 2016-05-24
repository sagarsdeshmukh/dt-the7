<?php
/**
 * Search results page.
 *
 * @package vogue
 * @since 1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

$config = presscore_get_config();
$config->set( 'template', 'search' );
$config->set( 'layout', 'masonry' );
$config->set( 'template.layout.type', 'masonry' );

get_header(); ?>

			<!-- Content -->
			<div id="content" class="content" role="main">

				<?php
				if ( have_posts() ) :

					do_action( 'presscore_before_loop' );
					do_action( 'presscore_before_search_loop' );

					// backup config
					$config_backup = $config->get();

					// masonry container open
					echo '<div ' . presscore_masonry_container_class( array( 'wf-container' ) ) . presscore_masonry_container_data_atts() . '>';

						while ( have_posts() ) : the_post();

							presscore_archive_post_content();
							$config->reset( $config_backup );

						endwhile;

					// masonry container close
					echo '</div>';

					dt_paginator();

					do_action( 'presscore_after_loop' );

				else :

					get_template_part( 'no-results', 'search' );

				endif;
				?>

			</div><!-- #content -->

			<?php do_action('presscore_after_content'); ?>

<?php get_footer(); ?>