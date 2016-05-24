<?php
/**
 * Album single media content part
 *
 * @package vogue
 * @since 1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

$config = Presscore_Config::get_instance();

if ( 'disabled' != $config->get( 'post.media.layout' ) ) {

	// get media
	$media_items = $config->get( 'post.media.library' );

	if ( !$media_items ) $media_items = array();

	// if we have post thumbnail and it's not hidden
	if ( has_post_thumbnail() && $config->get( 'post.media.featured_image.enabled' ) ) {
		array_unshift( $media_items, absint( get_post_thumbnail_id() ) );
	}

	// open in lightbox
	$open_thumbnail_in_lightbox = $config->get( 'post.media.lightbox.enabled' );

	$media_type = $config->get( 'post.media.type' );
	$attachments_data = presscore_get_attachment_post_data( $media_items );
	$media_html = '';

	if ( count( $attachments_data ) > 1 ) {

		// media html
		switch ( $media_type ) {

			case 'gallery' :
				$gallery_columns = absint( $config->get( 'post.media.gallery.columns' ) );
				$gallery_columns = $gallery_columns ? $gallery_columns : 4;

				$media_html = presscore_get_images_gallery_1( $attachments_data, array(
					'columns' => $gallery_columns,
					'first_big' => $config->get( 'post.media.gallery.first_iamge_is_large' ),
					'style' => presscore_get_share_buttons_for_prettyphoto( 'photo' )
				) );
				break;

			case 'list' :
				$media_html = presscore_get_images_list( $attachments_data, array(
					'open_in_lightbox' => $open_thumbnail_in_lightbox,
					'show_share_buttons' => true
				) );
				break;

			case 'masonry_grid':
				$dt_query = new WP_Query( array(
					'no_found_rows'     => true,
					'posts_per_page'    => -1,
					'post_type'         => 'attachment',
					'post_mime_type'    => 'image',
					'post_status'       => 'inherit',
					'post__in'			=> $media_items,
					'orderby'			=> 'post__in',
					'order'				=> 'DESC',
				) );

				if ( $dt_query->have_posts() ) {

					// backup config
					$config_backup = $config->get();

					// hide description
					$config->set( 'show_titles', false );
					$config->set( 'show_excerpts', false );

					// fullwidth wrap open
					if ( $config->get( 'full_width' ) ) { echo '<div class="full-width-wrap">'; }

					// masonry container open
					echo '<div ' . presscore_masonry_container_class( array( 'wf-container', 'dt-gallery-container', 'single-gallery-media' ) ) . presscore_masonry_container_data_atts() . presscore_get_share_buttons_for_prettyphoto( 'photo' ) . '>';

						if ( $dt_query->have_posts() ): while( $dt_query->have_posts() ): $dt_query->the_post();

							presscore_get_template_part( 'mod_albums', 'photo-masonry/photo' );

						endwhile; wp_reset_postdata(); endif;

					// masonry container close
					echo '</div>';

					// fullwidth wrap close
					if ( $config->get( 'full_width' ) ) { echo '</div>'; }

					// restore config
					$config->reset( $config_backup );
				}

				break;

			case 'jgrid':
				$dt_query = new WP_Query( array(
					'no_found_rows'     => true,
					'posts_per_page'    => -1,
					'post_type'         => 'attachment',
					'post_mime_type'    => 'image',
					'post_status'       => 'inherit',
					'post__in'			=> $media_items,
					'orderby'			=> 'post__in',
					'order'				=> 'DESC',
				) );

				if ( $dt_query->have_posts() ) {

					// backup config
					$config_backup = $config->get();

					// hide description
					$config->set( 'show_titles', false );
					$config->set( 'show_excerpts', false );

					// fullwidth wrap open
					if ( $config->get( 'full_width' ) ) { echo '<div class="full-width-wrap">'; }

					// masonry container open
					echo '<div ' . presscore_masonry_container_class( array( 'wf-container', 'dt-gallery-container', 'single-gallery-media' ) ) . presscore_masonry_container_data_atts() . presscore_get_share_buttons_for_prettyphoto( 'photo' ) . '>';

						if ( $dt_query->have_posts() ): while( $dt_query->have_posts() ): $dt_query->the_post();

							presscore_get_template_part( 'mod_albums', 'photo-masonry/photo' );

						endwhile; wp_reset_postdata(); endif;

					// masonry container close
					echo '</div>';

					// fullwidth wrap close
					if ( $config->get( 'full_width' ) ) { echo '</div>'; }

					// restore config
					$config->reset( $config_backup );
				}

				break;

			default:
				// slideshow dimensions
				$slider_proportions = $config->get( 'post.media.slider.proportion' );
				if ( !is_array( $slider_proportions ) ) {
					$slider_proportions = array( 'width' => '', 'height' => '' );
				}
				$slider_proportions = wp_parse_args( $slider_proportions, array( 'width' => '', 'height' => '' ) );

				$media_html = presscore_get_royal_slider( $attachments_data, array(
					'class' 	=> array('slider-post'),
					'width' 	=> absint( $slider_proportions['width'] ),
					'height'	=> absint( $slider_proportions['height'] ),
					'style'		=> ' style="width: 100%;"',
					'show_info'	=> array( 'title', 'link', 'description', 'share_buttons' )
				) );
		}

		if ( $media_html && in_array( $media_type, array( 'list', 'gallery' ) ) ) {
			$media_html = sprintf( '<div class="images-container">%s</div>', $media_html );
		}

	} else {

		$one_image_params = array();

		if ( !$open_thumbnail_in_lightbox ) {
			$one_image_params['wrap'] = '<img %IMG_CLASS% %SRC% %IMG_TITLE% %ALT% %SIZE% />';
		}

		$media_html = presscore_get_post_attachment_html( current( $attachments_data ), $one_image_params );

		if ( $media_html ) {
			$media_html = sprintf( '<div class="images-container">%s</div>', $media_html );
		}

	}

	echo $media_html;

}
