<?php
/**
 * Logos admin part.
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

class Presscore_Mod_Logos_Admin {

	public function register_post_types() {
		$post_type = 'dt_logos';
		$args = array(
			'labels'                => array(
				'name'                  => _x('Partners, Clients, etc.',		'backend logos', 'the7mk2'),
				'singular_name'         => _x('Partner,Client, etc.',			'backend logos', 'the7mk2'),
				'add_new'               => _x('Add New Logo',					'backend logos', 'the7mk2'),
				'add_new_item'          => _x('Add New Logo',					'backend logos', 'the7mk2'),
				'edit_item'             => _x('Edit Partner,Client, etc.',		'backend logos', 'the7mk2'),
				'new_item'              => _x('New Item',						'backend logos', 'the7mk2'),
				'view_item'             => _x('View Item',						'backend logos', 'the7mk2'),
				'search_items'          => _x('Search Items',					'backend logos', 'the7mk2'),
				'not_found'             => _x('No items found',					'backend logos', 'the7mk2'),
				'not_found_in_trash'    => _x('No items found in Trash',		'backend logos', 'the7mk2'), 
				'parent_item_colon'     => '',
				'menu_name'             => _x('Partners, Clients, etc.',		'backend logos', 'the7mk2')
			),
			'public'                => true,
			'publicly_queryable'    => true,
			'show_ui'               => true,
			'show_in_menu'          => true, 
			'query_var'             => true,
			'rewrite'               => true,
			'capability_type'       => 'post',
			'has_archive'           => true, 
			'hierarchical'          => false,
			'menu_position'         => 38,
			'supports'              => array( 'title', 'thumbnail' )
		);

		$args = apply_filters( "presscore_post_type_{$post_type}_args", $args );

		register_post_type( $post_type, $args );
	}

	public function register_taxonomies() {
		$post_type = 'dt_logos';
		$taxonomy = 'dt_logos_category';
		$args = array(
			'labels'                => array(
				'name'              => _x( 'Logo Categories',			'backend partners', 'the7mk2' ),
				'singular_name'     => _x( 'Logo Category',				'backend partners', 'the7mk2' ),
				'search_items'      => _x( 'Search in Category',		'backend partners', 'the7mk2' ),
				'all_items'         => _x( 'Logo Categories',			'backend partners', 'the7mk2' ),
				'parent_item'       => _x( 'Parent Category',			'backend partners', 'the7mk2' ),
				'parent_item_colon' => _x( 'Parent Category:',			'backend partners', 'the7mk2' ),
				'edit_item'         => _x( 'Edit Category',				'backend partners', 'the7mk2' ), 
				'update_item'       => _x( 'Update Category',			'backend partners', 'the7mk2' ),
				'add_new_item'      => _x( 'Add New Logo Category',		'backend partners', 'the7mk2' ),
				'new_item_name'     => _x( 'New Logo Category Name',	'backend partners', 'the7mk2' ),
				'menu_name'         => _x( 'Logo Categories',			'backend partners', 'the7mk2' )
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
		$metaboxes[] = plugin_dir_path( __FILE__ ) . 'metaboxes/metaboxes-logos.php';
		return $metaboxes;
	}
}
