<?php
/**
 * Albums template config helpers.
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

/////////////////////
// ALBUMS TEMPLATE //
/////////////////////

if ( ! function_exists( 'presscore_congif_populate_albums_vars' ) ) :

	function presscore_congif_populate_albums_vars() {
		$config = presscore_config();
		$config->set_post_id( $config->get( 'post_id' ) );
		$post_id = $config->get_post_id();

		$prefix = '_dt_albums_options_';
		$config->set_meta_prefix( $prefix );

		// for categorizer compatibility
		if ( ! $config->get( 'order' ) ) {
			$config->set_meta( 'order', 'order' );
		}

		if ( ! $config->get( 'orderby' ) ) {
			$config->set_meta( 'orderby', 'orderby' );
		}

		if ( ! $config->get( 'display' ) ) {
			$display = get_post_meta( $post_id, '_dt_albums_display', true );
			if ( ! isset( $display['terms_ids'] ) ) {
				$display['terms_ids'] = null;
			}
			$config->set( 'display', $display );
		}

		$config->map( array(

			// filter
			'template.posts_filter.terms.enabled'	=> array( 'meta', 'show_filter', true ),
			'template.posts_filter.orderby.enabled'	=> array( 'meta', 'show_orderby', true ),
			'template.posts_filter.order.enabled'	=> array( 'meta', 'show_order', true ),

			// layout
			'posts_per_page'						=> array( 'meta', 'ppp', '' ),
			'full_width'							=> array( 'meta', 'full_width', false ),
			'item_padding'							=> array( 'meta', 'item_padding', 20 ),
			'thumb_proportions'						=> array( 'meta', 'thumb_proportions', array( 'width' => 1, 'height' => 1 ) ),
			'image_layout'							=> array( 'meta', 'image_layout', 'original' ),
			'all_the_same_width'					=> array( 'meta', 'posts_same_width', false ),

			// loading
			'load_style'							=> array( 'meta', 'load_style', 'default' ),

			// content
			'post.preview.mini_images.enabled'		=> array( 'meta', 'show_round_miniatures', true ),
			'show_titles'							=> array( 'meta', 'show_titles', true ),
			'show_excerpts'							=> array( 'meta', 'show_exerpts', true ),

			// meta
			'post.meta.fields.date'					=> array( 'meta', 'show_date_in_post_meta', true ),
			'post.meta.fields.categories'			=> array( 'meta', 'show_categories_in_post_meta', true ),
			'post.meta.fields.comments'				=> array( 'meta', 'show_comments_in_post_meta', true ),
			'post.meta.fields.author'				=> array( 'meta', 'show_author_in_post_meta', true ),
			'post.meta.fields.media_number'			=> array( 'meta', 'show_numbers_in_post_meta', true ),

			// loading
			'post.preview.load.effect'				=> array( 'meta', 'load_effect', 'fade_in' ),

			// pagination
			'show_all_pages'						=> array( 'meta', 'show_all_pages', false ),
		) );

		// layout
		if ( 'template-albums-jgrid.php' != dt_get_template_name( $post_id, true ) ) {
			$config->map( array(
				'layout'								=> array( 'meta', 'layout' ),

				// description
				'post.preview.description.style'		=> array( 'meta', 'description', 'under_image' ),
				'post.preview.description.alignment'	=> array( 'meta', 'post_content_alignment', 'left' ),

				// hover
				'post.preview.hover.animation'			=> array( 'meta', 'hover_animation', 'fade' ),
				'post.preview.hover.color'				=> array( 'meta', 'hover_bg_color', 'accent' ),
				'post.preview.hover.content.visibility'	=> array( 'meta', 'hover_content_visibility', 'on_hoover' ),
				'post.preview.hover.lines.animation'	=> array( 'meta', 'lines_animation_effect', '1' ),
				'post.preview.hover.title.visibility'	=> array( 'meta', 'title_visibility', 'on_hoover' ),

				// column minimum width
				'post.preview.width.min'				=> array( 'meta', 'target_width', 370 ),

				// desired columns number
				'template.columns.number'				=> array( 'meta', 'columns_number', 3 ),

				// do not show preview background
				'post.preview.background.enabled'		=> array( 'value', false ),
				'post.preview.background.style'			=> array( 'value', false ),
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

		// justified grid
		} else {
			$config->map( array(
				'layout'								=> array( 'value', 'grid' ),

				// description
				'post.preview.description.style'		=> array( 'meta', 'jgrid_description', 'on_hoover_centered' ),

				// hover
				'post.preview.hover.animation'			=> array( 'meta', 'jgrid_hover_animation', 'fade' ),
				'post.preview.hover.color'				=> array( 'meta', 'jgrid_hover_bg_color', 'accent' ),
				'post.preview.hover.content.visibility'	=> array( 'meta', 'jgrid_hover_content_visibility', 'on_hoover' ),
				'post.preview.hover.lines.animation'	=> array( 'meta', 'jgrid_lines_animation_effect', '1' ),
				'post.preview.hover.title.visibility'	=> array( 'meta', 'jgrid_title_visibility', 'on_hoover' ),

				// row
				'target_height'							=> array( 'meta', 'target_height', 250 ),

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
		}
	}

endif;

///////////////////////////
// ALBUM POST SETTINGS //
///////////////////////////

if ( ! function_exists( 'presscore_populate_album_post_config' ) ) :

	function presscore_populate_album_post_config( $target_post_id = 0 ) {

		$config = Presscore_Config::get_instance();
		global $post;

		if ( $target_post_id ) {
			$post_id = $target_post_id;

		} elseif ( $post && !empty( $post->ID ) ) {
			$post_id = $post->ID;

		} else {
			return false;

		}

		///////////////////////////
		// album media library //
		///////////////////////////

		$prefix = '_dt_album_media_';

		$config->set( 'post.media.library', get_post_meta( $post_id, "{$prefix}items", true ), array() );

		//////////////////////////////////////////
		// hide featured image in single post //
		//////////////////////////////////////////

		$prefix = '_dt_album_options_';

		$config->set( 'post.media.featured_image.enabled', !get_post_meta( $post_id, "{$prefix}exclude_featured_image", true ), true );

		if ( post_password_required( $post_id ) ) {
			$open_as = 'post';
		} else {
			$open_as = get_post_meta( $post_id, "{$prefix}open_album", true );
		}

		$config->set( 'post.open_as', $open_as, 'lightbox' );

		/////////////////////////
		// post preview width //
		/////////////////////////

		$config->set( 'post.preview.width', get_post_meta( $post_id, "{$prefix}preview", true ), 'normal' );

		//////////////////////////////////
		// is project content visible //
		//////////////////////////////////

		if ( in_the_loop() ) {

			// title
			$show_title = $config->get( 'show_titles' ) && get_the_title();

			// post content
			$show_description = $config->get( 'show_excerpts' ) && apply_filters( 'the_content', get_the_content() );

			// mini images
			$show_mini_images = $config->get( 'post.preview.mini_images.enabled' );

			// meta information
			$show_meta = 	$config->get( 'post.meta.fields.date' ) && 
							$config->get( 'post.meta.fields.categories' ) && 
							$config->get( 'post.meta.fields.comments' ) && 
							$config->get( 'post.meta.fields.author' ) && 
							$config->get( 'post.meta.fields.media_number' );

			$show_post_content = $show_title || $show_description || $show_meta || $show_mini_images;

		} else {
			$show_post_content = true;

		}

		$config->set( 'post.preview.content.visible', $show_post_content );

		return true;
	}

endif;

////////////////////
// SINGLE ALBUM //
////////////////////

if ( ! function_exists( 'presscore_congif_populate_single_album_vars' ) ) :

	function presscore_congif_populate_single_album_vars() {

		$config = Presscore_Config::get_instance();
		$post_id = $config->get( 'post_id' );

		$config->set( 'post.media.lightbox.enabled', true );

		/////////////////////////////
		// post meta information //
		/////////////////////////////

		// general meta switch
		if ( of_get_option( 'general-album_meta_on', true ) ) {

			// date
			$config->set( 'post.meta.fields.date', of_get_option( 'general-album_meta_date', true ) );

			// categories
			$config->set( 'post.meta.fields.categories', of_get_option( 'general-album_meta_categories', true ) );

			// comments
			$config->set( 'post.meta.fields.comments', of_get_option( 'general-album_meta_comments', true ) );

			// author
			$config->set( 'post.meta.fields.author', of_get_option( 'general-album_meta_author', true ) );

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

		$show_back_button = of_get_option( 'general-show_back_button_in_album', 0 );
		$config->set( 'post.navigation.back_button.enabled', $show_back_button );

		if ( $show_back_button ) {
			$post_back_btn_id = get_post_meta( $post_id, "_dt_album_options_back_button", true );
			$config->set( 'post.navigation.back_button.target_page_id', $post_back_btn_id ? $post_back_btn_id : of_get_option( 'general-album_back_button_target_page_id', 0 ) );
		}

		$config->set( 'post.navigation.arrows.enabled', of_get_option( 'general-next_prev_in_album', true ) );

		///////////////////////////
		// album media library //
		///////////////////////////

		$prefix = '_dt_album_media_';

		$config->set( 'post.media.library', get_post_meta( $post_id, "{$prefix}items", true ), array() );

		//////////////////
		// media type //
		//////////////////

		$prefix = '_dt_album_options_';

		$post_media_type = get_post_meta( $post_id, "{$prefix}type", true );
		$config->set( 'post.media.type', $post_media_type, 'slideshow' );

		switch ( $post_media_type ) {
			case 'photo_scroller':
				$config->set( 'header_background', 'normal' );
				$config->set( 'page_title.enabled', false );
				$config->set( 'page_title.breadcrumbs.enabled', false );
				break;

			case 'masonry_grid':
				$config->set( 'post.preview.description.style', 'disabled' );
				$config->set( 'show_excerpts', true );
				$config->set( 'show_titles', true );
				$config->set( 'post.preview.load.effect', get_post_meta( $post_id, "{$prefix}mg_load_effect", true ), 'fade_in' );
				$config->set( 'post.preview.width.min', get_post_meta( $post_id, "{$prefix}mg_target_width", true ), 370 );
				$config->set( 'template.columns.number', get_post_meta( $post_id, "{$prefix}mg_columns_number", true ), 3 );
				$config->set( 'layout', get_post_meta( $post_id, "{$prefix}mg_layout", true ), 'masonry' );
				$config->set( 'item_padding', get_post_meta( $post_id, "{$prefix}mg_item_padding", true ), 20 );
				$config->set( 'image_layout', get_post_meta( $post_id, "{$prefix}mg_image_layout", true ), 'original' );
				$config->set( 'thumb_proportions', get_post_meta( $post_id, "{$prefix}mg_thumb_proportions", true ), array( 'width' => 1, 'height' => 1 ) );
				$config->set( 'full_width', get_post_meta( $post_id, "{$prefix}mg_full_width", true ), false );
				break;

			case 'jgrid':
				$config->set( 'justified_grid', true );
				$config->set( 'layout', 'grid' );
				$config->set( 'show_excerpts', true );
				$config->set( 'show_titles', true );
				$config->set( 'post.preview.description.style', 'disabled' );
				$config->set( 'post.preview.load.effect', get_post_meta( $post_id, "{$prefix}jg_load_effect", true ), 'fade_in' );
				$config->set( 'template.columns.number', get_post_meta( $post_id, "{$prefix}jg_columns_number", true ), 3 );
				$config->set( 'target_height', get_post_meta( $post_id, "{$prefix}jg_target_height", true ), 250 );
				$config->set( 'item_padding', get_post_meta( $post_id, "{$prefix}jg_item_padding", true ), 20 );
				$config->set( 'image_layout', get_post_meta( $post_id, "{$prefix}jg_image_layout", true ), 'original' );
				$config->set( 'thumb_proportions', get_post_meta( $post_id, "{$prefix}jg_thumb_proportions", true ), array( 'width' => 1, 'height' => 1 ) );
				$config->set( 'full_width', get_post_meta( $post_id, "{$prefix}jg_full_width", true ), false );
				$config->set( 'hide_last_row', get_post_meta( $post_id, "{$prefix}jg_hide_last_row", true ), false );
				break;
		}

		//////////////////////////////////////
		// album media slider proportions //
		//////////////////////////////////////

		$config->set( 'post.media.slider.proportion', get_post_meta( $post_id, "{$prefix}slider_proportions", true ), array( 'width' => '', 'height' => '' ) );

		////////////////////////////
		// album media gallery  //
		////////////////////////////

		$config->set( 'post.media.gallery.columns', get_post_meta( $post_id, "{$prefix}gallery_columns", true ), 4 );
		$config->set( 'post.media.gallery.first_iamge_is_large', get_post_meta( $post_id, "{$prefix}gallery_make_first_big", true ), true );

		//////////////////////////////////////////
		// hide featured image in single post //
		//////////////////////////////////////////

		$config->set( 'post.media.featured_image.enabled', !get_post_meta( $post_id, "{$prefix}exclude_featured_image", true ), true );

		///////////////////////////////
		// Phoso Scroller settings //
		///////////////////////////////

		$config->set( 'post.media.photo_scroller.layout', get_post_meta( $post_id, "{$prefix}photo_scroller_layout", true ), 'fullscreen' );
		$config->set( 'post.media.photo_scroller.background.color', get_post_meta( $post_id, "{$prefix}photo_scroller_bg_color", true ), '#000000' );
		$config->set( 'post.media.photo_scroller.overlay.enabled', get_post_meta( $post_id, "{$prefix}photo_scroller_overlay", true ), true );

		$config->set( 'post.media.photo_scroller.padding.top', get_post_meta( $post_id, "{$prefix}photo_scroller_top_padding", true ), 0 );
		$config->set( 'post.media.photo_scroller.padding.bottom', get_post_meta( $post_id, "{$prefix}photo_scroller_bottom_padding", true ), 0 );
		$config->set( 'post.media.photo_scroller.padding.side', get_post_meta( $post_id, "{$prefix}photo_scroller_side_paddings", true ), 0 );

		$config->set( 'post.media.photo_scroller.inactive.opacity', get_post_meta( $post_id, "{$prefix}photo_scroller_inactive_opacity", true ), 15 );
		$config->set( 'post.media.photo_scroller.thumbnails.visibility', get_post_meta( $post_id, "{$prefix}photo_scroller_thumbnails_visibility", true ), 'show' );

		$config->set( 'post.media.photo_scroller.autoplay.mode', get_post_meta( $post_id, "{$prefix}photo_scroller_autoplay", true ), 'play' );
		$config->set( 'post.media.photo_scroller.autoplay.speed', get_post_meta( $post_id, "{$prefix}photo_scroller_autoplay_speed", true ), 4000 );

		$config->set( 'post.media.photo_scroller.thumbnail.width', get_post_meta( $post_id, "{$prefix}photo_scroller_thumbnails_width", true ), 0 );
		$config->set( 'post.media.photo_scroller.thumbnail.height', get_post_meta( $post_id, "{$prefix}photo_scroller_thumbnails_height", true ), 85 );

		$config->set( 'post.media.photo_scroller.behavior.landscape.width.max', get_post_meta( $post_id, "{$prefix}photo_scroller_ls_max_width", true ), '100' );
		$config->set( 'post.media.photo_scroller.behavior.landscape.width.min', get_post_meta( $post_id, "{$prefix}photo_scroller_ls_min_width", true ), '0' );
		$config->set( 'post.media.photo_scroller.behavior.landscape.fill.desktop', get_post_meta( $post_id, "{$prefix}photo_scroller_ls_fill_dt", true ), 'fit' );
		$config->set( 'post.media.photo_scroller.behavior.landscape.fill.mobile', get_post_meta( $post_id, "{$prefix}photo_scroller_ls_fill_mob", true ), 'fit' );

		$config->set( 'post.media.photo_scroller.behavior.portrait.width.max', get_post_meta( $post_id, "{$prefix}photo_scroller_pt_max_width", true ), '100' );
		$config->set( 'post.media.photo_scroller.behavior.portrait.width.min', get_post_meta( $post_id, "{$prefix}photo_scroller_pt_min_width", true ), '0' );
		$config->set( 'post.media.photo_scroller.behavior.portrait.fill.desktop', get_post_meta( $post_id, "{$prefix}photo_scroller_pt_fill_dt", true ), 'fit' );
		$config->set( 'post.media.photo_scroller.behavior.portrait.fill.mobile', get_post_meta( $post_id, "{$prefix}photo_scroller_pt_fill_mob", true ), 'fit' );

	}

endif;

/////////////////////
// PHOTOS TEMPLATE //
/////////////////////

if ( ! function_exists( 'presscore_congif_populate_media_vars' ) ) :

	function presscore_congif_populate_media_vars() {

		$config = Presscore_Config::get_instance();
		$post_id = $config->get( 'post_id' );

		////////////////////
		// posts filter //
		////////////////////

		$prefix = '_dt_media_options_';

		$config->set( 'order', get_post_meta( $post_id, "{$prefix}order", true ) );
		$config->set( 'orderby', get_post_meta( $post_id, "{$prefix}orderby", true ) );
		$config->set( 'display', get_post_meta( $post_id, "_dt_albums_media_display", true ) );

		$config->set( 'posts_per_page', get_post_meta( $post_id, "{$prefix}ppp", true ) );

		//////////////
		// layout //
		//////////////

		$config->set( 'layout', get_post_meta( $post_id, "{$prefix}layout", true ), 'masonry' );
		$config->set( 'item_padding', get_post_meta( $post_id, "{$prefix}item_padding", true ), 20 );

		//////////////
		// images //
		//////////////

		$config->set( 'image_layout', get_post_meta( $post_id, "{$prefix}image_layout", true ), 'original' );
		$config->set( 'thumb_proportions', get_post_meta( $post_id, "{$prefix}thumb_proportions", true ), array( 'width' => 1, 'height' => 1 ) );

		/////////////////////////
		// titles & excerpts //
		/////////////////////////

		$config->set( 'show_excerpts', get_post_meta( $post_id, "{$prefix}show_exerpts", true ), true );
		$config->set( 'show_titles', get_post_meta( $post_id, "{$prefix}show_titles", true ), true );

		//////////////////////////
		// is content visible //
		//////////////////////////

		$config->set( 'post.preview.content.visible', $config->get( 'show_titles' ) || $config->get( 'show_excerpts' ) );

		//////////////////
		// load style //
		//////////////////

		$load_style = get_post_meta( $post_id, "{$prefix}load_style", true );
		$load_style = $load_style ? $load_style : 'default';
		$hide_last_row = ( 'default' == $load_style ) ? get_post_meta( $post_id, "{$prefix}hide_last_row", true ) : false;

		$config->set( 'load_style', $load_style );
		$config->set( 'hide_last_row', $hide_last_row, false );

		$config->set( 'post.preview.load.effect', get_post_meta( $post_id, "{$prefix}load_effect", true ), 'fade_in' );

		/////////////////
		// paginator //
		/////////////////

		$config->set( 'show_all_pages', get_post_meta( $post_id, "{$prefix}show_all_pages", true ), false );

		$template_name = dt_get_template_name( $post_id, true );

		if ( 'template-media.php' == $template_name ) {
			$config->set( 'post.preview.width.min', get_post_meta( $post_id, "{$prefix}target_width", true ), 370 );
			$config->set( 'template.columns.number', get_post_meta( $post_id, "{$prefix}columns_number", true ), 3 );

			// preview description under image or disabled
			$config->set( 'post.preview.description.style', ( $config->get( 'post.preview.content.visible' ) ? 'under_image' : 'disabled' ) );

		} else if ( 'template-media-jgrid.php' == $template_name ) {
			$config->set( 'justified_grid', true );
			$config->set( 'layout', 'grid' );
			$config->set( 'target_height', get_post_meta( $post_id, "{$prefix}target_height", true ), 250 );

			// preview description on hover centered
			$config->set( 'post.preview.description.style', 'on_hoover_centered' );

		}

		///////////////
		// content //
		///////////////

		$config->set( 'full_width', get_post_meta( $post_id, "{$prefix}full_width", true ), false );

	}

endif;
