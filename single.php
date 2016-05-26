<?php
/**
 * The Template for displaying all single posts.
 *
 * @package The7
 * @since 1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

get_header( 'single' ); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

		<?php get_template_part( 'header-main' ); ?>

		<?php if ( presscore_is_content_visible() ): ?>

			<?php do_action( 'presscore_before_loop' ); ?>

			<!-- !- Content -->
			<div id="content" class="content" role="main">

				<?php get_template_part( 'content-single', str_replace( 'dt_', '', get_post_type() ) ); ?>

				<?php comments_template( '', true ); ?>

			</div><!-- #content .wf-cell -->

			<?php do_action( 'presscore_after_content' ); ?>

		<?php endif; // content is visible ?>

<?php endwhile; endif; // end of the loop. ?>

<?php get_footer(); ?>