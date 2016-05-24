<?php
/**
 * Portfolio public part.
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

class Presscore_Mod_Portfolio_Public {

	public function resolve_template_ajax( $response, $data, $template_name ) {
		if ( in_array( $template_name, array( 'template-portfolio-masonry.php', 'template-portfolio-list.php', 'template-portfolio-jgrid.php' ) ) ) {

			$ajax_content = new Presscore_Mod_Portfolio_Ajax_Content_Builder();
			$response = $ajax_content->get_response( $data );

		}
		return $response;
	}

	public function register_shortcodes() {
		foreach ( array( 'portfolio', 'portfolio-jgrid', 'portfolio-slider' ) as $shortcode_name ) {
			include_once plugin_dir_path( __FILE__ ) . "shortcodes/{$shortcode_name}/{$shortcode_name}.php";
		}
	}

	public function load_shortcodes_vc_bridge() {
		include_once plugin_dir_path( __FILE__ ) . "shortcodes/mod-portfolio-shortcodes-bridge.php";
	}

	public function init_widgets() {
		register_widget( 'Presscore_Inc_Widgets_Portfolio' );
	}

	public function init_template_config( $post_type, $template = null ) {
		if ( 'dt_portfolio' == $post_type ) {
			presscore_congif_populate_single_portfolio_vars();
		} else if ( 'page' == $post_type && 'portfolio' == $template ) {
			presscore_congif_populate_portfolio_vars();
		}
	}

	public function archive_post_content( $html ) {
		if ( ! $html ) {
			ob_start();

			presscore_populate_portfolio_config();
			presscore_get_template_part( 'mod_portfolio', 'masonry/project' );

			$html = ob_get_contents();
			ob_end_clean();
		}
		return $html;
	}

	public function cache_attachments( $attachments_id, $post_type, $posts_query ) {
		if ( 'dt_portfolio' === $post_type ) {
			foreach( $posts_query->posts as $_post ) {
				$post_media = get_post_meta( $_post->ID, '_dt_project_media_items', true );
				$preview_style = get_post_meta( $_post->ID, '_dt_project_options_preview_style', true );

				if ( $post_media && is_array( $post_media ) && 'slideshow' == $preview_style ) {
					$attachments_id = array_merge( $attachments_id, $post_media );
				}
			}
		}
		return $attachments_id;
	}

	public function archive_page_id( $page_id ) {
		if ( is_tax( 'dt_portfolio_category' ) ) {
			$page_id = of_get_option( 'template_page_id_portfolio_category', null );
		}

		return $page_id;
	}

	public function post_meta_wrap_class_filter( $class ) {
		if ( 'dt_portfolio' == get_post_type() ) {
			$class[] = 'portfolio-categories';
		}
		return $class;
	}

	public function filter_page_title( $page_title ) {
		if ( is_tax( 'dt_portfolio_category' ) ) {
			$page_title = sprintf( __( 'Portfolio Archives: %s', 'the7mk2' ), '<span>' . single_term_title( '', false ) . '</span>' );
		}
		return $page_title;
	}

	public function filter_body_class( $classes ) {
		// fix single portfolio class
		if ( is_single() && 'dt_portfolio' === get_post_type() ) {
			$key = array_search( 'single-dt_portfolio', $classes );
			if ( false !== $key ) {
				$classes[ $key ] = 'single-portfolio';
			}
		}

		// hover icons style
		switch ( presscore_config()->get( 'post.preview.hover.icon.style' ) ) {
			case 'outline':
				$classes[] = 'outlined-portfolio-icons';
				break;
			case 'transparent':
				$classes[] = 'semitransparent-portfolio-icons';
				break;
			case 'accent':
				$classes[] = 'accent-portfolio-icons';
				break;
			case 'small':
				$classes[] = 'small-portfolio-icons';
				break;
		}

		return $classes;
	}

	public function filter_masonry_wrap_taxonomy( $taxonomy, $post_type ) {
		if ( 'dt_portfolio' == $post_type ) {
			$taxonomy = 'dt_portfolio_category';
		}
		return $taxonomy;
	}

	public function filter_add_to_author_archive( $new_post_types ) {
		$new_post_types[] = 'dt_portfolio';
		return $new_post_types;
	}
}
