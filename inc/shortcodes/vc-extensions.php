<?php
/**
 * Visual Composer extensions.
 *
 */

// Initialising Shortcodes
if (class_exists('WPBakeryVisualComposerAbstract')) {

	/**
	 * Taxonomy checkbox list field.
	 *
	 */
	function presscore_vc_taxonomy_settings_field($settings, $value) {
		$value_arr = $value_inner = $value;
		if ( !is_array($value_arr) ) {
			$value_arr = array_map( 'trim', explode(',', $value_arr) );
		}

		$terms_slugs = array();
		$terms_fields = array();
		if ( !empty($settings['taxonomy']) ) {

			$terms = get_terms( $settings['taxonomy'] );
			if ( $terms && !is_wp_error($terms) ) {

				foreach( $terms as $term ) {
					$terms_slugs[] = $term->slug;

					$terms_fields[] = sprintf(
						'<label><input id="%s" class="%s" type="checkbox" name="%s" value="%s" %s/>%s</label>',
						$settings['param_name'] . '-' . $term->slug,
						$settings['param_name'].' '.$settings['type'],
						$settings['param_name'],
						$term->slug,
						checked( in_array( $term->slug, $value_arr ), true, false ),
						$term->name
					);
				}

			}

			$value_inner = implode( ',', array_intersect( $value_arr, $terms_slugs ) );
		}

		$dependency = vc_generate_dependencies_attributes($settings);
		return '<div class="dt_taxonomy_block">'
				.'<input type="hidden" name="'.$settings['param_name'].'" class="wpb_vc_param_value wpb-checkboxes '.$settings['param_name'].' '.$settings['type'].'_field" value="'.$value_inner.'" '.$dependency.' />'
				 .'<div class="dt_taxonomy_terms">'
				 .implode( $terms_fields )
				 .'</div>'
			 .'</div>';
	}

	/**
	 * Posts checkbox list field.
	 *
	 */
	function presscore_vc_posttype_settings_field($settings, $value) {
		$dependency = vc_generate_dependencies_attributes($settings);

		$posts_fields = array();
		$posts_names = array();

		$value_arr = $value_inner = $value;
		if ( !is_array($value_arr) ) {
			$value_arr = array_map( 'trim', explode(',', $value_arr) );
		}

		if ( !empty($settings['posttype']) ) {

			$args = array(
				'no_found_rows' => 1,
				'ignore_sticky_posts' => 1,
				'posts_per_page' => -1,
				'post_type' => $settings['posttype'],
				'post_status' => 'publish',
				'orderby' => 'date',
				'order' => 'DESC'
			);

			$dt_query = new WP_Query( $args );
			if ( $dt_query->have_posts() ) {

				foreach( $dt_query->posts as $p ) {

					$posts_names[] = $p->post_name;

					$posts_fields[] = sprintf(
						'<label><input id="%s" class="%s" type="checkbox" name="%s" value="%s" %s/>%s</label>',
						$settings['param_name'] . '-' . $p->post_name,
						$settings['param_name'] . ' ' . $settings['type'],
						$settings['param_name'],
						$p->post_name,
						checked( in_array( $p->post_name, $value_arr ), true, false ),
						$p->post_title
					);

				}

			}

			$value_inner = implode( ',', array_intersect( $value_arr, $posts_names ) );
		}

		return '<div class="dt_posttype_block">'
				.'<input type="hidden" name="'.$settings['param_name'].'" class="wpb_vc_param_value wpb-checkboxes '.$settings['param_name'].' '.$settings['type'].'_field" value="'.$value_inner.'" '.$dependency.' />'
				 .'<div class="dt_posttype_post">'
				 .implode( $posts_fields )
				 .'</div>'
			 .'</div>';
	}

	function presscore_vc_add_custom_fields() {
		$dir = get_template_directory_uri();

		vc_add_shortcode_param( 'dt_taxonomy', 'presscore_vc_taxonomy_settings_field', $dir . '/inc/shortcodes/vc_extend/dt-vc-scripts.js' );
		vc_add_shortcode_param( 'dt_posttype', 'presscore_vc_posttype_settings_field', $dir . '/inc/shortcodes/vc_extend/dt-vc-scripts.js' );
	}
	add_action( 'admin_init', 'presscore_vc_add_custom_fields', 15 );

	function presscore_vc_register_custom_vc_scripts() {

		// register custom pie jquery plugin
		wp_register_script('vc_dt_pie', PRESSCORE_THEME_URI . '/inc/shortcodes/vc_extend/jquery.vc_chart.js', array('jquery', 'waypoints', 'progressCircle'), wp_get_theme()->get( 'Version' ) );
	}
	add_action('wp_enqueue_scripts', 'presscore_vc_register_custom_vc_scripts', 15);
}

if ( ! function_exists( 'presscore_vc_row_stripe_change_class' ) ):

	function presscore_vc_row_stripe_change_class( $classes, $atts ) {
		$type = esc_attr( $atts['type'] );
		if ( in_array( $type, array( '1', '2', '3' ) ) ) {
			switch( of_get_option( "stripes-stripe_{$type}_content_boxes_decoration", 'none' ) ) {
				case 'shadow':
					$classes[] = 'shadow-element-decoration';
					break;
				case 'outline':
					$classes[] = 'outline-element-decoration';
					break;
			}

			if ( 'show' == of_get_option( "stripes-stripe_{$type}_outline", 'hide' ) ) {
				$classes[] = 'outline-stripe-decoration';
			}
		}
		return $classes;
	}
	add_filter( 'presscore_vc_row_stripe_class', 'presscore_vc_row_stripe_change_class', 10, 2 );

endif;
