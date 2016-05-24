<?php

if ( ! class_exists( 'DT_WC_Template_Config', false ) ) :

	class DT_WC_Template_Config {
		private $config_back = array();
		private $config = null;

		public function __construct( Presscore_Config_Interface $config ) {
			$this->config = $config;
		}

		public function setup() {
			global $woocommerce_loop;

			$this->backup_config();

			$config = $this->config;

			$config->set( 'post.preview.description.style', of_get_option( 'woocommerce_display_product_info', 'under_image' ), 'under_image' );
			$config->set( 'layout', of_get_option( 'woocommerce_shop_template_layout', 'masonry' ), 'masonry' );

			$config->set( 'justified_grid', false );
			$config->set( 'all_the_same_width', true );
			$config->set( 'image_layout', 'original' );
			$config->set( 'load_style', 'default' );
			$config->set( 'post.preview.load.effect', 'fade_in' );
			$config->set( 'post.preview.background.enabled', false );
			$config->set( 'post.preview.background.style', false );
			$config->set( 'post.preview.description.alignment', 'left' );
			$config->set( 'full_width', false );

			$config->set( 'item_padding', of_get_option( 'woocommerce_shop_template_gap', 20 ), 20 );

			if ( $woocommerce_loop && ! empty( $woocommerce_loop['columns'] ) ) {
				$config->set( 'template.columns.number', absint( $woocommerce_loop['columns'] ) );
			} else {
				$config->set( 'template.columns.number', of_get_option( 'woocommerce_shop_template_columns', 3 ), 3 );
			}

			$config->set( 'post.preview.width.min', of_get_option( 'woocommerce_shop_template_column_min_width', 370 ), 370 );

			$config->set( 'show_titles', of_get_option( 'woocommerce_show_product_titles', true ), true );

			$config->set( 'product.preview.show_price', of_get_option( 'woocommerce_show_product_price', true ), true );
			$config->set( 'product.preview.show_rating', of_get_option( 'woocommerce_show_product_rating', true ), true );
			$config->set( 'product.preview.icons.show_cart', of_get_option( 'woocommerce_show_cart_icon', true ), true );
			$config->set( 'product.preview.add_to_cart.position', of_get_option( 'woocommerce_add_to_cart_position', 'on_image' ) );

			$config->set( 'post.preview.load.effect', of_get_option( 'woocommerce_shop_template_loading_effect', 'fade_in' ), 'fade_in' );

			$config->set( 'post.preview.content.visible', $this->product_content_visible() );
		}

		public function product_content_visible() {
			$config = $this->config;

			$icons_count = 0;
			if ( $config->get( 'show_details' ) ) {
				$icons_count++;
			}

			if ( $config->get( 'product.preview.icons.show_cart' ) ) {
				$icons_count++;
			}

			$show_product_content = $config->get( 'product.preview.show_price' ) 
				|| $config->get( 'product.preview.show_rating' ) 
				|| $config->get( 'show_titles' ) 
				|| $icons_count > 0;

			return $show_product_content;
		}

		public function cleanup() {
			$this->restore_config();
		}

		private function backup_config() {
			$this->config_back = $this->config->get();
		}

		private function restore_config() {
			if ( $this->config_back ) {
				$this->config->reset( $this->config_back );
			}
		}
	}

endif;
