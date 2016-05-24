<?php
/**
 * Album singla page template.
 *
 * @package vogue
 * @since  1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('project-post'); ?>>

	<?php
	do_action('presscore_before_post_content');

	if ( !post_password_required() ) {

		switch ( presscore_config()->get( 'post.media.type' ) ) {
			case 'photo_scroller': break;

			case 'jgrid':
			case 'masonry_grid':
				presscore_get_template_part( 'mod_albums', 'albums-post-single-media' );
				break;

			default:
				echo '<div class="wf-container">';
					echo '<div class="wf-cell wf-1 project-slider">';
						presscore_get_template_part( 'mod_albums', 'albums-post-single-media' );
					echo '</div>';
				echo '</div>';
		}

		if ( get_the_content() ) {

			echo '<div class="wf-container">';
				echo '<div class="wf-cell wf-1 project-content">';
					the_content();
				echo '</div>';
			echo '</div>';

		}

	} else {
		the_content();

	}

	do_action('presscore_after_post_content');
	?>

</article>