<?php
// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! function_exists( 'dt_woocommerce_enqueue_scripts' ) ) :

	/**
	 * Enqueue stylesheets and scripts.
	 */
	function dt_woocommerce_enqueue_scripts() {
		// remove woocommerce styles
		add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );
	}

endif;

if ( ! function_exists( 'woocommerce_pagination' ) ) {

	/**
	 * Output the pagination.
	 * (override)
	 *
	 * @access public
	 * @subpackage	Loop
	 * @return void
	 */
	function woocommerce_pagination() {
		global $wp_query;

		if ( $wp_query->max_num_pages <= 1 ) {
			return;
		}

		dt_paginator( $wp_query, array( 'class' => 'woocommerce-pagination paginator' ) );
	}
}

if ( ! function_exists( 'woocommerce_upsell_display' ) ) {

	/**
	 * Output product up sells.
	 * (override)
	 * 
	 * @access public
	 * @param int $posts_per_page (default: -1)
	 * @param int $columns (default: 5)
	 * @param string $orderby (default: 'rand')
	 * @return void
	 */
	function woocommerce_upsell_display( $posts_per_page = '-1', $columns = 5, $orderby = 'rand' ) {
		wc_get_template( 'single-product/up-sells.php', array(
				'posts_per_page'	=> $posts_per_page,
				'orderby'			=> apply_filters( 'woocommerce_upsells_orderby', $orderby ),
				'columns'			=> $columns
			) );
	}
}

if ( ! function_exists( 'woocommerce_cross_sell_display' ) ) {

	/**
	 * Output the cart cross-sells.
	 * (override)
	 *
	 * @param  integer $posts_per_page
	 * @param  integer $columns
	 * @param  string $orderby
	 */
	function woocommerce_cross_sell_display( $posts_per_page = 5, $columns = 5, $orderby = 'rand' ) {
		wc_get_template( 'cart/cross-sells.php', array(
				'posts_per_page' => $posts_per_page,
				'orderby'        => $orderby,
				'columns'        => $columns
			) );
	}
}

if ( ! function_exists( 'dt_woocommerce_related_products_args' ) ) :

	/**
	 * Change related products args to array( 'posts_per_page' => 5, 'columns' => 5, 'orderby' => 'date' ).
	 * 
	 * @param  array $args
	 * @return array
	 */
	function dt_woocommerce_related_products_args( $args ) {
		$posts_per_page = of_get_option( 'woocommerce_rel_products_max', 5 );
		return array_merge( $args, array( 'posts_per_page' => $posts_per_page, 'columns' => 5, 'orderby' => 'date' ) );
	}

endif;

if ( ! function_exists( 'dt_woocommerce_body_class' ) ) :

	/**
	 * Body classes filter.
	 * 
	 * @param  array $classes
	 * @return array
	 */
	function dt_woocommerce_body_class( $classes ) {
		if ( is_product() && in_array( presscore_get_config()->get( 'header_title' ), array( 'enabled', 'fancy' ) ) ) {
			$classes[] = 'hide-product-title';
		}
		return $classes;
	}

endif;

if ( ! function_exists( 'dt_woocommerce_before_main_content' ) ) :

	/**
	 * Display main content open tags and fire hooks.
	 */
	function dt_woocommerce_before_main_content () {

		// remove woocommerce breadcrumbs
		remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );

		// only for shop
		if ( is_shop() || is_product_category() || is_product_tag() ) {

			// remove woocommerce title
			add_filter( 'woocommerce_show_page_title', '__return_false');
		}
	?>
		<!-- Content -->
		<div id="content" class="content" role="main">
	<?php
	}

endif;

if ( ! function_exists( 'dt_woocommerce_after_main_content' ) ) :

	/**
	 * Display main content end tags.
	 */
	function dt_woocommerce_after_main_content () {
	?>
		</div>
	<?php
	}

endif;

if ( ! function_exists( 'dt_woocommerce_mini_cart' ) ) :

	/**
	 * Display customized shop mini cart.
	 */
	function dt_woocommerce_mini_cart() {
		get_template_part('inc/mods/compatibility/woocommerce/front/templates/cart/mod-wc-mini-cart');

		// enqueue custom script
		wp_enqueue_script( 'dt-wc-custom', get_template_directory_uri() . '/inc/mods/compatibility/woocommerce/assets/js/mod-wc-scripts.js', array( 'jquery' ), wp_get_theme()->get( 'Version' ), true );
	}

endif;

if ( ! function_exists( 'dt_woocommerce_replace_theme_breadcrumbs' ) ) :

	/**
	 * Breadcrumbs filter
	 * 
	 * @param  string $html
	 * @param  array  $args
	 * @return string
	 */
	function dt_woocommerce_replace_theme_breadcrumbs( $html = '', $args = array() ) {

		if ( ! $html ) {

			ob_start();
			woocommerce_breadcrumb( array(
				'delimiter' => '',
				'wrap_before' => '<div class="assistive-text"></div><ol' . $args['listAttr'] . ' xmlns:v="http://rdf.data-vocabulary.org/#">',
				'wrap_after' => '</ol>',
				'before' => '<li typeof="v:Breadcrumb">',
				'after' => '</li>',
				'home' => __( 'Home', 'the7mk2' ),
			) );
			$html = ob_get_clean();

			$html = apply_filters( 'presscore_get_breadcrumbs', $args['beforeBreadcrumbs'] . $html . $args['afterBreadcrumbs'] );

		}

		return $html;
	}

endif;

if ( ! function_exists( 'dt_woocommerce_template_loop_product_title' ) ) :

	/**
	 * Show the product title in the product loop.
	 */
	function dt_woocommerce_template_loop_product_title() {
		if ( presscore_config()->get( 'show_titles' ) && get_the_title() ) : ?>
			<h4 class="entry-title">
				<a href="<?php the_permalink(); ?>" title="<?php echo the_title_attribute( 'echo=0' ); ?>" rel="bookmark"><?php
					the_title();
				?></a>
			</h4>
		<?php endif;
	}

endif;

if ( ! function_exists( 'dt_woocommerce_template_loop_category_title' ) ) :

	/**
	 * Show the subcategory title in the product loop.
	 */
	function dt_woocommerce_template_loop_category_title( $category ) {
		if ( presscore_config()->get( 'show_titles' ) ) :
		?>
			<h3 class="entry-title">
				<a href="<?php echo get_term_link( $category->slug, 'product_cat' ); ?>"><?php
					echo $category->name;

					if ( $category->count > 0 )
						echo apply_filters( 'woocommerce_subcategory_count_html', ' <mark class="count">(' . $category->count . ')</mark>', $category );
				?></a>
			</h3>
		<?php
		endif;
	}

endif;

if ( ! function_exists( 'dt_woocommerce_get_page_title' ) ) :

	/**
	 * Wrap for woocommerce_page_title( false ).
	 * 
	 * @param  string $title
	 * @return string
	 */
	function dt_woocommerce_get_page_title( $title = '' ) {
		return woocommerce_page_title( false );
	}

endif;

if ( ! function_exists( 'dt_woocommerce_template_product_desc_under' ) ) :

	/**
	 * Display product description under image template.
	 */
	function dt_woocommerce_template_product_desc_under() {
		get_template_part( 'inc/mods/compatibility/woocommerce/front/templates/product/mod-wc-product-desc-under' );
	}

endif;

if ( ! function_exists( 'dt_woocommerce_template_product_desc_rollover' ) ) :

	/**
	 * Display product description on image template.
	 */
	function dt_woocommerce_template_product_desc_rollover() {
		get_template_part( 'inc/mods/compatibility/woocommerce/front/templates/product/mod-wc-product-desc-rollover' );
	}

endif;

if ( ! function_exists( 'dt_woocommerce_get_product_description' ) ) :

	/**
	 * Display product description template.
	 */
	function dt_woocommerce_get_product_description() {
		ob_start();
		get_template_part( 'inc/mods/compatibility/woocommerce/front/templates/product/mod-wc-product-description' );
		$content = ob_get_contents();
		ob_end_clean();
		return $content;
	}

endif;

if ( ! function_exists( 'dt_woocommerce_template_subcategory_desc_under' ) ) :

	/**
	 * Display subcategory description under image template.
	 */
	function dt_woocommerce_template_subcategory_desc_under() {
		get_template_part( 'inc/mods/compatibility/woocommerce/front/templates/subcategory/mod-wc-subcategory-desc-under' );
	}

endif;

if ( ! function_exists( 'dt_woocommerce_template_subcategory_desc_rollover' ) ) :

	/**
	 * Display subcategory description on image template.
	 */
	function dt_woocommerce_template_subcategory_desc_rollover() {
		get_template_part( 'inc/mods/compatibility/woocommerce/front/templates/subcategory/mod-wc-subcategory-desc-rollover' );
	}

endif;

if ( ! function_exists( 'dt_woocommerce_template_subcategory_description' ) ) :

	/**
	 * Display subcategory description template.
	 */
	function dt_woocommerce_template_subcategory_description() {
		get_template_part( 'inc/mods/compatibility/woocommerce/front/templates/subcategory/mod-wc-subcategory-description' );
	}

endif;

if ( ! function_exists( 'presscore_wc_template_loop_product_thumbnail' ) ) :

	/**
	 * Display woocommerce_template_loop_product_thumbnail() wrapped with 'a' tag.
	 * 
	 * @param  string $class
	 */
	function presscore_wc_template_loop_product_thumbnail( $class = '' ) {
		ob_start();
		woocommerce_template_loop_product_thumbnail();
		$img = ob_get_contents();
		ob_end_clean();

		$img = str_replace( 'wp-post-image', 'wp-post-image preload-me', $img );

		if ( presscore_lazy_loading_enabled() ) {
			$class .= ' layzr-bg';
		}

		echo '<a href="' . get_permalink() . '" class="' . esc_attr( $class ) . '">' . $img . '</a>';
	}

endif;

if ( ! function_exists( 'presscore_wc_add_masonry_lazy_load_attrs' ) ) :

	/**
	 * Add lazy loading images attributes.
	 */
	function presscore_wc_add_masonry_lazy_load_attrs() {
		add_filter( 'wp_get_attachment_image_attributes', 'presscore_wc_image_lazy_loading', 10, 3 );
	}

endif;

if ( ! function_exists( 'presscore_wc_remove_masonry_lazy_load_attrs' ) ) :

	/**
	 * Remove lazy loading images attributes.
	 */
	function presscore_wc_remove_masonry_lazy_load_attrs() {
		remove_filter( 'wp_get_attachment_image_attributes', 'presscore_wc_image_lazy_loading', 10, 3 );
	}

endif;

if ( ! function_exists( 'presscore_wc_image_lazy_loading' ) ) :

	/**
	 * Add lazy loading capability to images.
	 *
	 * @since  3.2.1
	 *
	 * @param  array $attr
	 * @param  WP_Post $attachment
	 * @param  string $size
	 * @return array
	 */
	function presscore_wc_image_lazy_loading( $attr, $attachment, $size ) {
		if ( presscore_lazy_loading_enabled() ) {
			$attr['data-src'] = $attr['src'];
			$image = wp_get_attachment_image_src( $attachment->ID, $size );
			$attr['src'] = "data:image/svg+xml;charset=utf-8,%3Csvg xmlns%3D'http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg' viewBox%3D'0 0 {$image[1]} {$image[2]}'%2F%3E";
			$lazy_class = 'iso-lazy-load';
			$attr['class'] = ( isset( $attr['class'] ) ? $attr['class'] . " {$lazy_class}" : $lazy_class );
			if ( isset( $attr['srcset'] ) ) {
				$attr['data-srcset'] = $attr['srcset'];
				unset( $attr['srcset'], $attr['sizes'] );
			}
		}

		return $attr;
	}

endif;

if ( ! function_exists( 'dt_woocommerce_subcategory_thumbnail' ) ) :

	/**
	 * Display woocommerce_subcategory_thumbnail() wrapped with 'a' targ.
	 * 
	 * @param  mixed $category
	 * @param  string $class
	 */
	function dt_woocommerce_subcategory_thumbnail( $category, $class = '' ) {
		ob_start();
		woocommerce_subcategory_thumbnail( $category );
		$img = ob_get_contents();
		ob_end_clean();

		$img = str_replace( '<img', '<img class="preload-me"', $img );

		echo '<a href="' . get_term_link( $category->slug, 'product_cat' ) . '" class="' . esc_attr( $class ) . '">' . $img . '</a>';
	}

endif;

if ( ! function_exists( 'dt_woocommerce_product_info_controller' ) ) :

	/**
	 * Controls product price and rating visibility.
	 */
	function dt_woocommerce_product_info_controller() {
		$config = presscore_config();

		if ( $config->get( 'product.preview.show_price' ) ) {
			add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 5 );
		}

		if ( $config->get( 'product.preview.show_rating' ) ) {
			add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 10 );
		}
	}

endif;

if ( ! function_exists( 'dt_woocommerce_get_product_icons_count' ) ) :

	/**
	 * Counts product icons for shop pages.
	 * 
	 * @return integer
	 */
	function dt_woocommerce_get_product_icons_count() {
		$config = presscore_config();

		$count = 0;

		if ( $config->get( 'product.preview.icons.show_cart' ) ) {
			$count++;
		}

		return apply_filters( 'dt_woocommerce_get_product_icons_count', $count );
	}

endif;

if ( ! function_exists( 'dt_woocommerce_product_show_content' ) ) :

	/**
	 * Controls content visibility.
	 * 
	 * @return bool
	 */
	function dt_woocommerce_product_show_content() {
		return apply_filters( 'dt_woocommerce_product_show_content', presscore_config()->get( 'post.preview.content.visible' ) );
	}

endif;

if ( ! function_exists( 'dt_woocommerce_get_product_add_to_cart_icon' ) ) :

	/**
	 * Return product add to cart icon html.
	 * 
	 * @return string
	 */
	function dt_woocommerce_get_product_add_to_cart_icon() {
		global $product;

		if ( $product && presscore_config()->get( 'product.preview.icons.show_cart' ) ) {
			ob_start();
			woocommerce_template_loop_add_to_cart(array(
				'class' => implode( ' ', array_filter( array(
						'product_type_' . $product->product_type,
						$product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
						$product->supports( 'ajax_add_to_cart' ) ? 'ajax_add_to_cart' : ''
				) ) )
			));
			return ob_get_clean();
		}
		return '';
	}

endif;

if ( ! function_exists( 'dt_woocommerce_render_product_add_to_cart_icon' ) ) :

	/**
	 * Display add to cart product icon.
	 */
	function dt_woocommerce_render_product_add_to_cart_icon() {
		$icon = dt_woocommerce_get_product_add_to_cart_icon();
		if ( $icon ) {
			echo '<div class="woo-buttons">' . $icon . '</div>';
		}
	}

endif;

if ( ! function_exists( 'dt_woocommerce_get_product_details_icon' ) ) :

	/**
	 * DEPRECATED. Return product details icon html.
	 * 
	 * @param int
	 * @param mixed
	 *
	 * @return string
	 */
	function dt_woocommerce_get_product_details_icon( $post_id = null, $class = 'project-details' ) {
		if ( ! presscore_config()->get( 'show_details' ) ) {
			return '';
		}

		if ( ! $post_id ) {
			global $product;
			$post_id = $product->id;
		}

		if ( is_array( $class ) ) {
			$class = implode( ' ', $class );
		}

		$output = '<a href="' . get_permalink( $post_id ) . '" class="' . esc_attr( $class ) . '" rel="nofollow">' . __( 'Product details', 'the7mk2' ) . '</a>';

		return apply_filters( 'dt_woocommerce_get_product_details_icon', $output, $post_id, $class );
	}

endif;

if ( ! function_exists( 'dt_woocommerce_filter_product_preview_icons' ) ) :

	/**
	 * Filters product icons for shop pages.
	 * 
	 * @return string
	 */
	function dt_woocommerce_filter_product_preview_icons( $icons = '' ) {
		$icons .= dt_woocommerce_get_product_add_to_cart_icon();
		return $icons;
	}

endif;

if ( ! function_exists( 'dt_woocommerce_get_product_preview_icons' ) ) :

	/**
	 * Returns product icons for shop pages.
	 * 
	 * @return string
	 */
	function dt_woocommerce_get_product_preview_icons() {
		return apply_filters( 'dt_woocommerce_get_product_preview_icons', '' );
	}

endif;

if ( ! function_exists( 'dt_woocommerce_template_config' ) ) :

	/**
	 * Return new instance of DT_WC_Template_Config
	 *
	 * @param  object $config
	 * @return object
	 */
	function dt_woocommerce_template_config( $config ) {
		return new DT_WC_Template_Config( $config );
	}

endif;

if ( ! function_exists( 'dt_woocommerce_add_product_template_to_search' ) ) :

	function dt_woocommerce_add_product_template_to_search( $html ) {
		static $products_config = array();

		if ( ! $html ) {

			$config = presscore_config();
			if ( empty( $products_config ) ) {

				$config->set( 'post.preview.description.style', 'under_image' );
				$config->set( 'post.preview.description.alignment', 'center' );
				$config->set( 'show_titles', true );
				$config->set( 'show_details', true );
				$config->set( 'product.preview.show_price', true );
				$config->set( 'product.preview.show_rating', false );
				$config->set( 'product.preview.icons.show_cart', true );

				$products_config = $config->get();

				dt_woocommerce_product_info_controller();
			} else {
				$config->reset( $products_config );
			}

			ob_start();

			get_template_part( 'woocommerce/content-product' );

			$html = ob_get_contents();
			ob_end_clean();
		}
		return $html;
	}

endif;

if ( ! function_exists( 'dt_woocommerce_change_paypal_icon' ) ) :

	function dt_woocommerce_change_paypal_icon() {
		return WC_HTTPS::force_https_url( WC()->plugin_url() . '/includes/gateways/paypal/assets/images/paypal.png' );
	}

endif;

if ( ! function_exists( 'dt_woocommerce_filter_product_add_to_cart_text' ) ) :

	function dt_woocommerce_filter_product_add_to_cart_text( $text, $product_obj ) {
		if ( ! ( $product_obj->is_purchasable() && $product_obj->is_in_stock() ) ) {
			$text = __( 'Out of stock', 'the7mk2' );
		}
		return $text;
	}

endif;

if ( ! function_exists( 'dt_woocommerce_filter_frontend_scripts_data' ) ) :

	function dt_woocommerce_filter_frontend_scripts_data( $data ) {
		$data['i18n_view_cart'] = esc_attr__( 'View cart', 'the7mk2' );
		return $data;
	}

endif;

if ( ! function_exists( 'dt_woocommerce_set_product_cart_button_position' ) ) :

	/**
	 * Choose where to display product cart button.
	 */
	function dt_woocommerce_set_product_cart_button_position() {
		if ( 'below_image' === presscore_config()->get( 'product.preview.add_to_cart.position' ) && 'under_image' === presscore_config()->get( 'post.preview.description.style' ) ) {
			add_action( 'woocommerce_after_shop_loop_item', 'dt_woocommerce_render_product_add_to_cart_icon', 40 );
		} else {
			add_filter( 'dt_woocommerce_get_product_preview_icons', 'dt_woocommerce_filter_product_preview_icons' );
		}
	}

endif;

if ( ! function_exists( 'dt_woocommerce_filter_masonry_container_class' ) ) :

	/**
	 * Filers masonry container class array.
	 * 
	 * @param  array  $class
	 * @return array
	 */
	function dt_woocommerce_filter_masonry_container_class( $class = array() ) {
		if ( 'under_image' === presscore_config()->get( 'post.preview.description.style' ) ) {
			if ( 'below_image' === presscore_config()->get( 'product.preview.add_to_cart.position' ) ) {
				$class[] = 'cart-btn-below-img';
			} else {
				$class[] = 'cart-btn-on-img';
			}
		}
		return $class;
	}

endif;

if ( ! function_exists( 'dt_woocommerce_add_masonry_container_filters' ) ) :

	/**
	 * Add masonry container class filters.
	 */
	function dt_woocommerce_add_masonry_container_filters() {
		add_filter( 'presscore_masonry_container_class', 'dt_woocommerce_filter_masonry_container_class' );
	}

endif;

if ( ! function_exists( 'dt_woocommerce_remove_masonry_container_filters' ) ) :

	/**
	 * Remove masonry container class filters.
	 */
	function dt_woocommerce_remove_masonry_container_filters() {
		remove_filter( 'presscore_masonry_container_class', 'dt_woocommerce_filter_masonry_container_class' );
	}

endif;

if ( ! function_exists( 'dt_woocommerce_set_product_title_to_h2_filter' ) ) :

	/**
	 * Wrap product title with h2 tag.
	 *
	 * There is h1 title on product page so we need to replace it with h2 here.
	 *
	 * @param  string $title
	 * @return string
	 */
	function dt_woocommerce_set_product_title_to_h2_filter( $title ) {
		return str_replace( array( '<h1', '</h1' ), array( '<h2', '</h2' ), $title );
	}

endif;
