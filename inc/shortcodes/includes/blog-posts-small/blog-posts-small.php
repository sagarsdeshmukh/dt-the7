<?php
/**
 * Blog posts small shortcode.
 *
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Shortcode Blog masonry class.
 *
 */
class DT_Shortcode_BlogPostsSmall extends DT_Shortcode {

	static protected $instance;

	protected $shortcode_name = 'dt_blog_posts_small';
	protected $post_type = 'post';
	protected $taxonomy = 'category';

	public static function get_instance() {
		if ( !self::$instance ) {
			self::$instance = new DT_Shortcode_BlogPostsSmall();
		}
		return self::$instance;
	}

	protected function __construct() {
		add_shortcode( $this->shortcode_name, array($this, 'shortcode') );
	}

	public function shortcode( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'featured_images' => 'true',
			'round_images' => '',
			'images_width' => '60',
			'images_height' => '60',
			'category' => '',
			'order' => 'desc',
			'orderby' => 'date',
			'number' => '6',
			'columns' => '1',
		), $atts ) );

		// sanitize attributes
		$featured_images = apply_filters('dt_sanitize_flag', $featured_images );
		$round_images = apply_filters('dt_sanitize_flag', $round_images);
		$order = apply_filters('dt_sanitize_order', $order);
		$orderby = apply_filters('dt_sanitize_orderby', $orderby);
		$number = apply_filters('dt_sanitize_posts_per_page', $number);
		$columns = absint( $columns );
		$images_width = absint( $images_width );
		$images_height = absint( $images_height );

		if ( $category) {
			$category = explode(',', $category);
			$category = array_map('trim', $category);
		}

		// vc inline dummy
		if ( presscore_vc_is_inline() ) {
			$terms_title = _x( 'Display categories', 'vc inline dummy', 'the7mk2' );
			$terms_list = presscore_get_terms_list_by_slug( array( 'slugs' => $category, 'taxonomy' => $this->taxonomy ) );

			return $this->vc_inline_dummy( array(
				'class' => 'dt_vc-mini_blog',
				'title' => _x( 'Mini blog', 'vc inline dummy', 'the7mk2' ),
				'fields' => array( $terms_title => $terms_list )
			) );
		}

		$related_posts_args = array(
			'exclude_current'   => false,
			'post_type'         => $this->post_type,
			'taxonomy'          => $this->taxonomy,
			'field'             => 'slug',
			'args'              => array(
				'posts_per_page'    => $number,
				'orderby'           => $orderby,
				'order'             => $order,
			)
		);

		if ( !empty($category) ) {
			$related_posts_args['cats'] = $category;
			$related_posts_args['select'] = 'only';
		} else {
			$related_posts_args['select'] = 'all';
		}

		$attachments_data = presscore_get_related_posts( $related_posts_args );

		$list_args = array(
			'show_images' => $featured_images,
			'image_dimensions' => array( 'w' => $images_width, 'h' => $images_height )
		);

		$posts_list = presscore_get_posts_small_list( $attachments_data, $list_args );

		switch ( $columns ) {
			case 2: $column_class = 'wf-1-2'; break;
			case 3: $column_class = 'wf-1-3'; break;
			case 1:
			default: $column_class = 'wf-1';
		}

		$output = '';

		if ( $posts_list ) {

			foreach ( $posts_list as $p ) {
				$output .= sprintf( '<div class="wf-cell %s"><div class="borders">%s</div></div>', $column_class, $p );
			}

			$section_class = 'items-grid wf-container';
			if ( $featured_images && $round_images ) {
				$section_class .= ' round-images';
			}

			$output = '<section class="' . $section_class . '">' . $output . '</section>';
		}

		return $output;
	}
}

// create shortcode
DT_Shortcode_BlogPostsSmall::get_instance();
