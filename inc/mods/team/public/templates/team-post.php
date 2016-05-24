<?php
/**
 * Team post
 *
 * @package vogue
 * @since 1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

do_action('presscore_before_post');

	presscore_get_template_part( 'mod_team', 'team-post-raw' );

do_action('presscore_after_post');
