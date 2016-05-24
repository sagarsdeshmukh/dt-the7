<?php
/**
 * Project single media content part
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

	if ( count( $attachments_data ) > 1 ) {

		// media html
		switch ( $media_type ) {

			case 'gallery' :
				$gallery_columns = absint( $config->get( 'post.media.gallery.columns' ) );
				$gallery_columns = $gallery_columns ? $gallery_columns : 4;

				$media_html = presscore_get_images_gallery_1( $attachments_data, array(
					'columns' => $gallery_columns,
					'first_big' => $config->get( 'post.media.gallery.first_iamge_is_large' )
				) );
				break;

			case 'list' :
				$media_html = presscore_get_images_list( $attachments_data, array(
					'open_in_lightbox' => $open_thumbnail_in_lightbox
				) );
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
