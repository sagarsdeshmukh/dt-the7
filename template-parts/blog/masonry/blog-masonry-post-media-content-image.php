<?php
/**
 * Blog post media template for image post format in masonry layout
 *
 * @package vogue
 * @since 1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

$thumb_id = get_post_thumbnail_id();

$thumb_args = array(
	'img_meta' 	=> wp_get_attachment_image_src( $thumb_id, 'full' ),
	'img_id'	=> $thumb_id,

	// @see inc/helpers.php
	'options'	=> presscore_set_image_dimesions(),

	'class'		=> 'alignnone rollover dt-single-mfp-popup dt-mfp-item mfp-image',
	'wrap'		=> '<p><a %HREF% %CLASS% %CUSTOM% title="%RAW_ALT%" data-dt-img-description="%RAW_TITLE%"><img %IMG_CLASS% %SRC% %IMG_TITLE% %ALT% %SIZE% /></a></p>',
);

$thumb_args = apply_filters( 'dt_post_thumbnail_args', $thumb_args );

// output media
dt_get_thumb_img( $thumb_args );
