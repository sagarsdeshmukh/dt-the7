<?php
/**
 * Testimonial post template.
 */

// ! File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

global $post;
$post_id = get_the_ID();

// get avatar ( featured image )
$avatar = '<span class="alignleft no-avatar"></span>';
if ( has_post_thumbnail( $post_id ) ) {

	$thumb_id = get_post_thumbnail_id( $post_id );
	$avatar = dt_get_thumb_img( array(
		'img_meta'      => wp_get_attachment_image_src( $thumb_id, 'full' ),
		'img_id'		=> $thumb_id,
		'options'       => array( 'w' => 60, 'h' => 60 ),
		'echo'			=> false,
		'wrap'			=> '<img %IMG_CLASS% %SRC% %SIZE% %IMG_TITLE% %ALT% />',
	) );

	$avatar = '<span class="alignleft">' . $avatar . '</span>';
}

// get link
$link = get_post_meta( $post_id, '_dt_testimonial_options_link', true );
if ( $link ) {
	$link = esc_url( $link );
	$avatar = '<a href="' . $link . '" class="rollover" target="_blank">' . $avatar . '</a>';
} else {
	$link = '';
}

// get position
$position = get_post_meta( $post_id, '_dt_testimonial_options_position', true );
if ( $position ) {
	$position = '<span class="text-secondary color-secondary">' . $position . '</span>';
} else {
	$position = '';
}

// get title
$title = get_the_title();
if ( $title ) {

	if ( $link ) {
		$title = '<a href="' . $link . '" class="text-primary" target="_blank"><span>' . $title . '</span></a>';
	} else {
		$title = '<span class="text-primary">' . $title . '</span>';
	}

	$title .= '<br />';
} else {
	$title = '';
}

$details_link = '';
if ( get_post_meta( $post_id, '_dt_testimonial_options_go_to_single', true ) ) {
	$details_link = ' ' . presscore_post_details_link( null, array( 'more-link' ), __( 'read more', 'the7mk2' ) );
}

$excerpt = $post->post_excerpt;
$content = apply_filters( 'the_content', $excerpt ? get_the_excerpt() . $details_link : get_the_content() . $details_link );

// get it all togeather
echo '<article>', "\n\t",
		'<div class="testimonial-content">',
			$content,
		'</div>', "\n\t",
		'<div class="testimonial-vcard">',
			'<div class="wf-td">',
				$avatar,
			'</div>',
			'<div class="wf-td">',
				$title . $position,
			'</div>',
		'</div>', "\n",
	'</article>', "\n";
