<?php
/**
 * Blog post media template for gallery post format in list layout
 *
 * @package vogue
 * @since 1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

global $post;
$gallery = presscore_get_post_gallery_recursive( $post->ID, false );

if ( isset( $gallery['ids'] ) ) {
	$media_items = array_map( 'trim', explode( ',', $gallery['ids'] ) );

	// if we have post thumbnail and it's not hidden
	if ( has_post_thumbnail() && !get_post_meta( $post->ID, '_dt_post_options_hide_thumbnail', true ) ) {
		array_unshift( $media_items, get_post_thumbnail_id() );
	}

	$attachments_data = presscore_get_attachment_post_data( $media_items );
} else if ( isset( $gallery['src'] ) ) {
	$attachments_data = array();
	foreach ( $gallery['src'] as $image_src ) {
		$attachments_data[] = array(
			'full' => $image_src,
			'width' => 150,
			'height' => 150,
			'alt' => '',
			'title' => '',
			'description' => '',
			'ID' => false
		);
	}
} else {
	$attachments_data = array();
}

$class = array( 'alignnone' );

$config = presscore_get_config();
if ( 'normal' == $config->get( 'post.preview.width' ) ) {
	$class = array( 'alignleft' );
}

switch ( $config->get( 'post.preview.gallery.style' ) ) {

	case 'slideshow':

		$class[] = 'slider-simple';

		echo '<div class="post-slider">';
		echo presscore_get_post_media_slider( $attachments_data, array(
			'class' => $class,
			'style' => ' style="width: 100%;"',
			'proportions' => $config->get( 'post.preview.gallery.sideshow.proportions' )
		) );
		echo '</div>';

		break;

	case 'hovered_gallery':

		$class[] = 'rollover';
		$gallery_args = array( 'class' => $class, 'style' => '' );

		echo presscore_get_images_gallery_hoovered( current( $attachments_data ), $attachments_data, $gallery_args );

		break;

	default:

		if ( 'normal' == $config->get( 'post.preview.width' ) ) {
			$class[] = 'format-gallery-normal';
		}

		// show only 9 images
		echo presscore_get_images_gallery_1( $attachments_data, array( 'class' => $class, 'style' => '', 'show_only' => 9 ) );

}
