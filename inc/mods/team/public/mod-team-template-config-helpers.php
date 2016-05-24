<?php
/**
 * Team template config helpers.
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

////////////////////////
// TEAM POST SETTINGS //
////////////////////////

if ( ! function_exists( 'presscore_populate_team_config' ) ) :

	function presscore_populate_team_config( $target_post_id = 0 ) {

		global $post;

		if ( $target_post_id ) {
			$post_id = $target_post_id;

		} elseif ( $post && !empty( $post->ID ) ) {
			$post_id = $post->ID;

		} else {
			return false;

		}

		$config = Presscore_Config::get_instance();
		$prefix = '_dt_teammate_options_';

		// open as
		$open_as = get_post_meta( $post_id, "{$prefix}go_to_single", true );
		$config->set( 'post.open_as', ( $open_as ? 'post' : 'none' ) );

		// position
		$config->set( 'post.member.position', get_post_meta( $post_id, "{$prefix}position", true ), '' );

		// links
		$teammate_links = presscore_get_team_links_array();
		$links = array();
		foreach ( $teammate_links as $id=>$data ) {
			$link = get_post_meta( $post_id, "{$prefix}{$id}", true );
			if ( $link ) {
				$links[ $id ] = $link;
			}
		}
		$config->set( 'post.preview.links', $links, array() );

		return true;
	}

endif;

///////////////////
// TEAM TEMPLATE //
///////////////////

if ( ! function_exists( 'presscore_congif_populate_team_vars' ) ) :

	function presscore_congif_populate_team_vars() {

		$config = presscore_config();
		$post_id = $config->get( 'post_id' );

		$prefix = '_dt_team_options_';

		// for categorizer compatibility
		if ( ! $config->get('order') ) {
			$config->set( 'order', get_post_meta( $post_id, "{$prefix}order", true ) );
		}

		if ( ! $config->get('orderby') ) {
			$config->set( 'orderby', get_post_meta( $post_id, "{$prefix}orderby", true ) );
		}

		$config->set( 'display', get_post_meta( $post_id, "_dt_team_display", true ) );

		////////////////////
		// Image sizing //
		////////////////////

		$config->set( 'image_layout', get_post_meta( $post_id, "{$prefix}image_layout", true ) );
		$config->set( 'thumb_proportions', get_post_meta( $post_id, "{$prefix}thumb_proportions", true ) );

		$config->set( 'show_excerpts', get_post_meta( $post_id, "{$prefix}show_exerpts", true ) );

		//////////////
		// Layout //
		//////////////

		$config->set( 'layout', get_post_meta( $post_id, "{$prefix}masonry_layout", true ) );
		$config->set( 'full_width', get_post_meta( $post_id, "{$prefix}full_width", true ) );

		$config->set( 'posts_per_page', get_post_meta( $post_id, "{$prefix}ppp", true ) );
		$config->set( 'post.preview.description.style', 'under_image' );

		///////////////////
		// Items style //
		///////////////////

		$config->set( 'item_padding', get_post_meta( $post_id, "{$prefix}item_padding", true ), 20 );
		$config->set( 'post.preview.width.min', get_post_meta( $post_id, "{$prefix}target_width", true ), 370 );
		$config->set( 'template.columns.number', get_post_meta( $post_id, "{$prefix}columns_number", true ), 3 );
		$config->set( 'post.preview.background.enabled', get_post_meta( $post_id, "{$prefix}bg_under_posts", true ) );
	}

endif;
