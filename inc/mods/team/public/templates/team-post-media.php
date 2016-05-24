<?php
/**
 * Team post media template
 *
 * @package vogue
 * @since 1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( has_post_thumbnail() ) {

	$thumb_id = get_post_thumbnail_id();

	$teammate_thumb_args = array(
		'img_meta'		=> wp_get_attachment_image_src( $thumb_id, 'full' ),
		'img_id'		=> $thumb_id,
		'options'		=> presscore_set_image_dimesions(),
		'echo'			=> true,
		'wrap'			=> '<img %IMG_CLASS% %SRC% %SIZE% %IMG_TITLE% %ALT% />',
	);

	$config = Presscore_Config::get_instance();

	if ( 'post' == $config->get( 'post.open_as' ) ) {
		$teammate_thumb_args['wrap'] = '<a %HREF% %CLASS%>' . $teammate_thumb_args['wrap'] . '</a>';
		$teammate_thumb_args['class'] = 'rollover';
		$teammate_thumb_args['href'] = get_permalink();

	} else {
		$teammate_thumb_args['wrap'] = '<span>' . $teammate_thumb_args['wrap'] . '</span>';

	}

	$teammate_thumb_args = presscore_add_thumbnail_class_for_masonry( $teammate_thumb_args );

	echo '<div class="team-media">';

		dt_get_thumb_img( $teammate_thumb_args );

	echo '</div>';

}
