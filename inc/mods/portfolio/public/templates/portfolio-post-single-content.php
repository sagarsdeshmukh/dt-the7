<?php
/**
 * Portfolio project single post template
 *
 * @package vogue
 * @since 1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

///////////////////
// media content //
///////////////////

ob_start();

include plugin_dir_path( __FILE__ ) . 'portfolio-post-single-media.php';

$media_content = ob_get_contents();
ob_end_clean();

$config = Presscore_Config::get_instance();

switch( $config->get( 'post.media.layout' ) ) {

	case 'before':

		if ( $media_content ) {

			echo '<div class="wf-container">';
				echo '<div class="wf-cell wf-1 project-slider">';
					echo $media_content;
				echo '</div>';
			echo '</div>';

		}

		echo '<div class="wf-container">';
			echo '<div class="wf-cell wf-1 project-content">';
				the_content();
				include plugin_dir_path( __FILE__ ) . 'portfolio-post-single-links.php';
			echo '</div>';
		echo '</div>';
		break;

	case 'after':

		echo '<div class="wf-container">';
			echo '<div class="wf-cell wf-1 project-content">';
				the_content();
			echo '</div>';
		echo '</div>';

		if ( $media_content ) {

			echo '<div class="wf-container">';
				echo '<div class="wf-cell wf-1 project-slider">';
					echo $media_content;
					include plugin_dir_path( __FILE__ ) . 'portfolio-post-single-links.php';
				echo '</div>';
			echo '</div>';

		}

		break;

	case 'left':

		echo '<div class="wf-container">';

			if ( $media_content ) {

				echo '<div class="wf-cell wf-2-3 project-slider">';
					echo $media_content;
				echo '</div>';

				// floationg content
				$content_container_class = '';
				if ( $config->get( 'post.content.floating.enabled' ) ) {
					$content_container_class = ' floating-content';
				}

				echo '<div class="wf-cell wf-1-3 project-content' . $content_container_class . '">';
					the_content();
					include plugin_dir_path( __FILE__ ) . 'portfolio-post-single-links.php';
				echo '</div>';

			} else {

				echo '<div class="wf-cell wf-1 project-content">';
					the_content();
					include plugin_dir_path( __FILE__ ) . 'portfolio-post-single-links.php';
				echo '</div>';
			}

		echo '</div>';

		break;

	case 'right':

		echo '<div class="wf-container">';

			if ( $media_content ) {

				// floationg content
				$content_container_class = '';
				if ( $config->get( 'post.content.floating.enabled' ) ) {
					$content_container_class = ' floating-content';
				}

				echo '<div class="wf-cell wf-1-3 project-content' . $content_container_class . '">';
					the_content();
					include plugin_dir_path( __FILE__ ) . 'portfolio-post-single-links.php';
				echo '</div>';
				echo '<div class="wf-cell wf-2-3 project-slider">';
					echo $media_content;
				echo '</div>';

			} else {

				echo '<div class="wf-cell wf-1 project-content">';
					the_content();
					include plugin_dir_path( __FILE__ ) . 'portfolio-post-single-links.php';
				echo '</div>';

			}

		echo '</div>';

		break;

	default:

		echo '<div class="wf-container">';
			echo '<div class="wf-cell wf-1 project-content">';
				the_content();
				include plugin_dir_path( __FILE__ ) . 'portfolio-post-single-links.php';
			echo '</div>';
		echo '</div>';

		break;

}
