<?php
/**
 * Testimonials admin part.
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

class Presscore_Mod_Testimonials_Admin {

	public function register_post_types() {
		$post_type = 'dt_testimonials';
		$args = array(
			'labels'                => array(
				'name'                  => _x('Testimonials',						'backend testimonials', 'the7mk2'),
				'singular_name'         => _x('Testimonials',						'backend testimonials', 'the7mk2'),
				'add_new'               => _x('Add New Testimonial',				'backend testimonials', 'the7mk2'),
				'add_new_item'          => _x('Add New Testimonial',				'backend testimonials', 'the7mk2'),
				'edit_item'             => _x('Edit Testimonial',					'backend testimonials', 'the7mk2'),
				'new_item'              => _x('New Testimonial',					'backend testimonials', 'the7mk2'),
				'view_item'             => _x('View Testimonial',					'backend testimonials', 'the7mk2'),
				'search_items'          => _x('Search Testimonials',				'backend testimonials', 'the7mk2'),
				'not_found'             => _x('No Testimonials found',				'backend testimonials', 'the7mk2'),
				'not_found_in_trash'    => _x('No Testimonials found in Trash',		'backend testimonials', 'the7mk2'), 
				'parent_item_colon'     => '',
				'menu_name'             => _x('Testimonials',						'backend testimonials', 'the7mk2')
			),
			'public'                => true,
			'publicly_queryable'    => true,
			'show_ui'               => true,
			'show_in_menu'          => true, 
			'query_var'             => true,
			'rewrite'               => true,
			'capability_type'       => 'post',
			'has_archive'           => false, 
			'hierarchical'          => false,
			'menu_position'         => 36,
			'supports'              => array( 'title', 'editor', 'excerpt', 'thumbnail' )
		);

		$args = apply_filters( "presscore_post_type_{$post_type}_args", $args );

		register_post_type( $post_type, $args );
	}

	public function register_taxonomies() {
		$post_type = 'dt_testimonials';
		$taxonomy = 'dt_testimonials_category';
		$args = array(
			'labels'                => array(
				'name'              => _x( 'Testimonial Categories',			'backend testimonials', 'the7mk2' ),
				'singular_name'     => _x( 'Testimonial Category',				'backend testimonials', 'the7mk2' ),
				'search_items'      => _x( 'Search in Category',				'backend testimonials', 'the7mk2' ),
				'all_items'         => _x( 'Categories',						'backend testimonials', 'the7mk2' ),
				'parent_item'       => _x( 'Parent Category',					'backend testimonials', 'the7mk2' ),
				'parent_item_colon' => _x( 'Parent Category:',					'backend testimonials', 'the7mk2' ),
				'edit_item'         => _x( 'Edit Category',						'backend testimonials', 'the7mk2' ), 
				'update_item'       => _x( 'Update Category',					'backend testimonials', 'the7mk2' ),
				'add_new_item'      => _x( 'Add New Testimonial Category',		'backend testimonials', 'the7mk2' ),
				'new_item_name'     => _x( 'New Category Name',					'backend testimonials', 'the7mk2' ),
				'menu_name'         => _x( 'Testimonial Categories',			'backend testimonials', 'the7mk2' )
			),
			'hierarchical'          => true,
			'public'                => true,
			'show_ui'               => true,
			'rewrite'               => true,
			'show_admin_column'		=> true,
		);

		$args = apply_filters( "presscore_taxonomy_{$taxonomy}_args", $args );

		register_taxonomy( $taxonomy, array( $post_type ), $args );
	}

	public function add_meta_boxes( $metaboxes ) {
		$metaboxes[] = plugin_dir_path( __FILE__ ) . 'metaboxes/metaboxes-testimonials.php';
		return $metaboxes;
	}
}
