<?php
/**
 * Portfolio template config helpers.
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

////////////////////////
// PORTFOLIO TEMPLATE //
////////////////////////

if ( ! function_exists( 'presscore_congif_populate_portfolio_vars' ) ) :

	function presscore_congif_populate_portfolio_vars() {
		$config = presscore_config();
		$config->set_post_id( $config->get( 'post_id' ) );
		$post_id = $config->get_post_id();

		$prefix = '_dt_portfolio_options_';
		$config->set_meta_prefix( $prefix );

		// for categorizer compatibility
		if ( ! $config->get( 'order' ) ) {
			$config->set_meta( 'order', 'order' );
		}

		if ( ! $config->get( 'orderby' ) ) {
			$config->set_meta( 'orderby', 'orderby' );
		}

		if ( ! $config->get( 'display' ) ) {
			$display = get_post_meta( $post_id, '_dt_portfolio_display', true );
			if ( ! isset( $display['terms_ids'] ) ) {
				$display['terms_ids'] = null;
			}
			$config->set( 'display', $display );
		}

		$config->map( array(

			// filter
			'template.posts_filter.terms.enabled'	=> array( 'meta', 'show_filter' ),
			'template.posts_filter.orderby.enabled'	=> array( 'meta', 'show_orderby' ),
			'template.posts_filter.order.enabled'	=> array( 'meta', 'show_order' ),

			// layout
			'posts_per_page'						=> array( 'meta', 'ppp' ),
			'full_width'							=> array( 'meta', 'full_width' ),
			'item_padding'							=> array( 'meta', 'item_padding', 20 ),
			'post.preview.media.width'				=> array( 'meta', 'thumb_width', 30 ),

			// loading
			'load_style'							=> array( 'meta', 'load_style', 'default' ),

			// images
			'all_the_same_width'					=> array( 'meta', 'posts_same_width' ),
			'image_layout'							=> array( 'meta', 'image_layout' ),
			'thumb_proportions'						=> array( 'meta', 'thumb_proportions' ),

			// content
			'show_titles'							=> array( 'meta', 'show_titles' ),
			'show_excerpts'							=> array( 'meta', 'show_exerpts' ),

			// meta
			'post.meta.fields.date'					=> array( 'meta', 'show_date_in_post_meta' ),
			'post.meta.fields.categories'			=> array( 'meta', 'show_categories_in_post_meta' ),
			'post.meta.fields.comments'				=> array( 'meta', 'show_comments_in_post_meta' ),
			'post.meta.fields.author'				=> array( 'meta', 'show_author_in_post_meta' ),

			// icons
			'show_links'							=> array( 'meta', 'show_links' ),
			'show_details'							=> array( 'meta', 'show_details' ),
			'show_zoom'								=> array( 'meta', 'show_zoom' ),

			// pagination
			'show_all_pages'						=> array( 'meta', 'show_all_pages' ),

			// do not show preview details button
			'post.preview.buttons.details.enabled'	=> array( 'value', false ),

			// do not show preview background
			'post.preview.background.enabled'		=> array( 'value', false ),
			'post.preview.background.style'			=> array( 'value', false ),
		) );

		// layout
		$template_name = dt_get_template_name( $post_id, true );
		switch ( $template_name ) {

			case 'template-portfolio-masonry.php' :
				$config->map( array(
					'layout'								=> array( 'meta', 'masonry_layout' ),

					// description
					'post.preview.description.style'		=> array( 'meta', 'description', 'under_image' ),

					// hover
					'post.preview.hover.animation'			=> array( 'meta', 'hover_animation', 'fade' ),
					'post.preview.hover.color'				=> array( 'meta', 'hover_bg_color', 'theme' ),
					'post.preview.hover.content.visibility'	=> array( 'meta', 'hover_content_visibility', 'on_hoover' ),
					'post.preview.hover.lines.animation'	=> array( 'meta', 'lines_animation_effect', '1' ),
					'post.preview.hover.title.visibility'	=> array( 'meta', 'title_visibility', 'on_hoover' ),

					// column minimum width
					'post.preview.width.min'				=> array( 'meta', 'target_width', 370 ),

					// desired columns number
					'template.columns.number'				=> array( 'meta', 'columns_number', 3 ),

					// loading
					'post.preview.load.effect'				=> array( 'meta', 'load_effect', 'fade_in' ),
				) );

				$description_style = $config->get( 'post.preview.description.style' );

				// content alignment
				if ( 'on_hoover_centered' == $description_style ) {
					$config->set_meta( 'post.preview.description.alignment', 'bg_post_content_alignment' );
				} else if ( 'bg_with_lines' == $description_style ) {
					$config->set( 'post.preview.description.alignment', false );
				} else {
					$config->set_meta( 'post.preview.description.alignment', 'post_content_alignment' );
				}

				// preview background
				if ( 'under_image' == $description_style ) {
					$background_under_posts = get_post_meta( $post_id, "{$prefix}bg_under_masonry_posts", true );
					$config->set( 'post.preview.background.enabled', ! in_array( $background_under_posts, array( 'disabled', '' ) ) );
					$config->set( 'post.preview.background.style', $background_under_posts, false );
				}
				break;

			case 'template-portfolio-jgrid.php':
				$config->map( array(
					'layout'								=> array( 'value', 'grid' ),

					// description
					'post.preview.description.style'		=> array( 'meta', 'jgrid_description', 'on_hoover_centered' ),

					// hover
					'post.preview.hover.animation'			=> array( 'meta', 'jgrid_hover_animation', 'fade' ),
					'post.preview.hover.color'				=> array( 'meta', 'jgrid_hover_bg_color', 'theme' ),
					'post.preview.hover.content.visibility'	=> array( 'meta', 'jgrid_hover_content_visibility', 'on_hoover' ),
					'post.preview.hover.lines.animation'	=> array( 'meta', 'jgrid_lines_animation_effect', '1' ),
					'post.preview.hover.title.visibility'	=> array( 'meta', 'jgrid_title_visibility', 'on_hoover' ),

					// row
					'target_height'							=> array( 'meta', 'target_height', 250 ),

					// loading
					'post.preview.load.effect'				=> array( 'meta', 'load_effect', 'fade_in' ),

					// template settings
					'justified_grid'						=> array( 'value', true ),
					'all_the_same_width'					=> array( 'value', true ),
					'hide_last_row'							=> array( 'meta', 'hide_last_row', false ),
				) );

				$description_style = $config->get( 'post.preview.description.style' );

				// content alignment
				if ( 'on_hoover_centered' == $description_style ) {
					$config->set_meta( 'post.preview.description.alignment', 'jgrid_bg_post_content_alignment' );
				} else if ( 'bg_with_lines' == $description_style ) {
					$config->set( 'post.preview.description.alignment', false );
				} else {
					$config->set_meta( 'post.preview.description.alignment', 'jgrid_post_content_alignment' );
				}

				if ( 'default' != $config->get( 'load_style' ) ) {
					$config->set( 'hide_last_row', false );
				}
				break;

			// list layout
			default:
				$config->map( array(
					'layout'								=> array( 'meta', 'list_layout' ),

					// hover
					'post.preview.hover.color'				=> array( 'meta', 'list_hover_bg_color', 'accent' ),

					// background
					'post.preview.background.enabled'		=> array( 'meta', 'bg_under_list_posts', false ),
					'post.preview.background.style'			=> array( 'value', 'with_paddings' ),

					// buttons
					'post.preview.buttons.details.enabled'	=> array( 'meta', 'show_details_buttons', true ),

					// loading
					'post.preview.load.effect'				=> array( 'value', 'fade_in' ),
				) );
		}
	}

endif;

//////////////////////
// SINGLE PORTFOLIO //
//////////////////////

if ( ! function_exists( 'presscore_congif_populate_single_portfolio_vars' ) ) :

	function presscore_congif_populate_single_portfolio_vars() {

		$config = Presscore_Config::get_instance();
		$post_id = $config->get( 'post_id' );

		/////////////////////////////
		// post meta information //
		/////////////////////////////

		// general meta switch
		if ( of_get_option( 'general-portfolio_meta_on', 1 ) ) {

			// date
			$config->set( 'post.meta.fields.date', of_get_option( 'general-portfolio_meta_date', 1 ) );

			// categories
			$config->set( 'post.meta.fields.categories', of_get_option( 'general-portfolio_meta_categories', 1 ) );

			// comments
			$config->set( 'post.meta.fields.comments', of_get_option( 'general-portfolio_meta_comments', 1 ) );

			// author
			$config->set( 'post.meta.fields.author', of_get_option( 'general-portfolio_meta_author', 1 ) );

		} else {

			// turn off all
			$config->set( 'post.meta.fields.date', 0 );
			$config->set( 'post.meta.fields.categories',0 );
			$config->set( 'post.meta.fields.comments', 0 );
			$config->set( 'post.meta.fields.author', 0 );

		}

		///////////////////////////////
		// post navigation buttons //
		///////////////////////////////

		$show_back_button = of_get_option( 'general-show_back_button_in_project', 0 );
		$config->set( 'post.navigation.back_button.enabled', $show_back_button );

		if ( $show_back_button ) {
			$post_back_btn_id = get_post_meta( $post_id, "_dt_project_options_back_button", true );
			$config->set( 'post.navigation.back_button.target_page_id', $post_back_btn_id ? $post_back_btn_id : of_get_option( 'general-project_back_button_target_page_id', 0 ) );
		}

		$config->set( 'post.navigation.arrows.enabled', of_get_option( 'general-next_prev_in_portfolio', 1 ) );

		/////////////////////////////
		// project media library //
		/////////////////////////////

		$prefix = '_dt_project_media_';

		$config->set( 'post.media.library', get_post_meta( $post_id, "{$prefix}items", true ), array() );

		/////////////////////////////
		// project media layout //
		/////////////////////////////

		$prefix = '_dt_project_media_options_';

		$config->set( 'post.media.layout', get_post_meta( $post_id, "{$prefix}layout", true ), 'left' );

		////////////////////////
		// floating content //
		////////////////////////

		$config->set( 'post.content.floating.enabled', get_post_meta( $post_id, "{$prefix}enable_floationg_content", true ), false );

		//////////////////
		// media type //
		//////////////////

		$config->set( 'post.media.type', get_post_meta( $post_id, "{$prefix}type", true ), 'slideshow' );

		////////////////////////////////////////
		// project media slider proportions //
		////////////////////////////////////////

		$config->set( 'post.media.slider.proportion', get_post_meta( $post_id, "{$prefix}slider_proportions", true ), array( 'width' => '', 'height' => '' ) );

		///////////////////////////////
		// project media gallery  //
		///////////////////////////////

		$config->set( 'post.media.gallery.columns', get_post_meta( $post_id, "{$prefix}gallery_columns", true ), 4 );
		$config->set( 'post.media.gallery.first_iamge_is_large', get_post_meta( $post_id, "{$prefix}gallery_make_first_big", true ), true );

		/////////////////////
		// related posts //
		/////////////////////

		$prefix = '_dt_project_options_';

		$config->set( 'post.related_posts.enabled', of_get_option( 'general-show_rel_projects', false ) );

		$config->set( 'post.related_posts.query.mode', get_post_meta( $post_id, "{$prefix}related_mode", true ) );
		$config->set( 'post.related_posts.query.terms', get_post_meta( $post_id, "{$prefix}related_categories", true ) );
		$config->set( 'post.related_posts.query.posts_per_page', of_get_option( 'general-rel_projects_max', 12 ) );

		$config->set( 'post.related_posts.title', of_get_option( 'general-rel_projects_head_title', '' ) );

		$config->set( 'post.related_posts.show.title', of_get_option( 'general-rel_projects_title', true ) );
		$config->set( 'post.related_posts.show.description', of_get_option( 'general-rel_projects_excerpt', true ) );
		$config->set( 'post.related_posts.show.link', of_get_option( 'general-rel_projects_link', true ) );
		$config->set( 'post.related_posts.show.zoom', of_get_option( 'general-rel_projects_zoom', true ) );
		$config->set( 'post.related_posts.show.details_link', of_get_option( 'general-rel_projects_details', true ) );

		// related posts meta

		// date
		$config->set( 'post.related_posts.meta.fields.date', of_get_option( 'general-rel_projects_info_date', 1 ) );

		// categories
		$config->set( 'post.related_posts.meta.fields.categories', of_get_option( 'general-rel_projects_info_categories', 1 ) );

		// comments
		$config->set( 'post.related_posts.meta.fields.comments', of_get_option( 'general-rel_projects_info_comments', 1 ) );

		// author
		$config->set( 'post.related_posts.meta.fields.author', of_get_option( 'general-rel_projects_info_author', 1 ) );

		// related posts with sidebar
		if ( 'disabled' != $config->get( 'sidebar_position' ) ) {
			$config->set( 'post.related_posts.height', of_get_option( 'general-rel_projects_height', 190 ) );

			$related_posts_width_mode = of_get_option('general-rel_projects_width_style');
			$config->set( 'post.related_posts.width.mode', $related_posts_width_mode );
			$config->set( 'post.related_posts.width', 'fixed' == $related_posts_width_mode ? of_get_option( 'general-rel_projects_width' ) : null );

		// fullwidth related posts
		} else {
			$config->set( 'post.related_posts.height', of_get_option( 'general-rel_projects_fullwidth_height', 270 ) );

			$related_posts_width_mode = of_get_option('general-rel_projects_fullwidth_width_style');
			$config->set( 'post.related_posts.width.mode', $related_posts_width_mode );
			$config->set( 'post.related_posts.width', 'fixed' == $related_posts_width_mode ? of_get_option( 'general-rel_projects_fullwidth_width' ) : null );
		}

		////////////////////
		// project link //
		////////////////////

		$config->set( 'post.buttons.link.enabled', get_post_meta( $post_id, "{$prefix}show_link", true ) );
		$config->set( 'post.buttons.link.title', get_post_meta( $post_id, "{$prefix}link_name", true ) );
		$config->set( 'post.buttons.link.url', get_post_meta( $post_id, "{$prefix}link", true ) );
		$config->set( 'post.buttons.link.target_blank', get_post_meta( $post_id, "{$prefix}link_target", true ) );

		//////////////////////////////////////////
		// hide featured image in single post //
		//////////////////////////////////////////

		$config->set( 'post.media.featured_image.enabled', !get_post_meta( $post_id, "{$prefix}hide_thumbnail", true ), true );

		///////////////////////////////////////
		// open images in lightbox //
		///////////////////////////////////////

		$config->set( 'post.media.lightbox.enabled', get_post_meta( $post_id, "{$prefix}open_thumbnail_in_lightbox", true ), false );
	}

endif;

/////////////////////////////
// PORTFOLIO POST SETTINGS //
/////////////////////////////

if ( ! function_exists( 'presscore_populate_portfolio_config' ) ) :

	function presscore_populate_portfolio_config( $target_post_id = 0 ) {

		$config = Presscore_Config::get_instance();
		global $post;

		if ( $target_post_id ) {
			$post_id = $target_post_id;

		} elseif ( $post && !empty( $post->ID ) ) {
			$post_id = $post->ID;

		} else {
			return false;

		}

		/////////////////////////////
		// project media library //
		/////////////////////////////

		$prefix = '_dt_project_media_';

		$project_library = get_post_meta( $post_id, "{$prefix}items", true );

		$config->set( 'post.media.library', $project_library, array() );

		////////////////////////////////
		// post preview media style //
		////////////////////////////////

		$prefix = '_dt_project_options_';

		// if project media library is empty - treat preview style as featured image
		if ( !empty($project_library) ) {
			$project_preview_media_style = get_post_meta( $post_id, "{$prefix}preview_style", true );

		} else {
			$project_preview_media_style = 'featured_image';

		}

		$config->set( 'post.preview.media.style', $project_preview_media_style, 'featured_image' );

		/////////////////////////
		// post preview width //
		/////////////////////////

		if ( 'list' == presscore_get_current_layout_type() ) {

			$post_preview_media_width = $config->get( 'post.preview.media.width' );
			if ( $post_preview_media_width >= 100 ) {
				$post_preview_width = 'wide';

			} else {
				$post_preview_width = get_post_meta( $post_id, "{$prefix}preview", true );

			}

		} else {
			$post_preview_width = get_post_meta( $post_id, "{$prefix}preview", true );

		}

		$config->set( 'post.preview.width', $post_preview_width, 'normal' );

		////////////////////
		// project link //
		////////////////////

		// allways show project link for post preview
		$config->set( 'post.buttons.link.enabled', get_post_meta( $post_id, "{$prefix}show_link", true ), false );
		$config->set( 'post.buttons.link.title', get_post_meta( $post_id, "{$prefix}link_name", true ), '' );
		$config->set( 'post.buttons.link.url', get_post_meta( $post_id, "{$prefix}link", true ), '#' );
		$config->set( 'post.buttons.link.target_blank', get_post_meta( $post_id, "{$prefix}link_target", true ), '' );

		//////////////////////////////////
		// is project content visible //
		//////////////////////////////////

		if ( in_the_loop() ) {
			$show_title = $config->get( 'show_titles' ) && get_the_title();
			$show_description = $config->get( 'show_excerpts' ) && get_the_excerpt();
			$show_links = $config->get( 'show_links' ) && $config->get( 'show_details' ) && $config->get( 'show_zoom' ) && has_post_thumbnail() && !post_password_required();
			$show_meta = $config->get( 'post.meta.fields.date' ) && $config->get( 'post.meta.fields.categories' ) && $config->get( 'post.meta.fields.comments' ) && $config->get( 'post.meta.fields.author' );

			$show_project_content = $show_title || $show_description || $show_links || $show_meta;
		} else {
			$show_project_content = true;

		}

		$config->set( 'post.preview.content.visible', $show_project_content );

		return true;
	}

endif;
