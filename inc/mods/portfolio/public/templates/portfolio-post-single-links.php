<?php
/**
 * Portfolio project single links content part
 *
 * @package vogue
 * @since 1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

// link pages
wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'the7mk2' ), 'after' => '</div>', 'echo' => false ) );

$share_buttons = presscore_display_share_buttons_for_post( 'portfolio_post', array('echo' => false) );
$project_link = presscore_get_project_link( 'h5-size btn-project-link' );

if ( $share_buttons || $project_link ) {

	echo '<div class="project-content-btn">';
	echo $project_link, $share_buttons;
	echo '</div>';

}
