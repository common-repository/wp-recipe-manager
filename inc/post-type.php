<?php

/**
 * Class WPRM_Post_Type
 */
if ( ! class_exists( 'WPRM_Post_Type' ) ) {
	class WPRM_Post_Type {
		function __construct() {

			// Initial
			add_action( 'init', array( $this, 'register_recipe_post_type' ) );
			add_action( 'init', array( $this, 'register_recipe_category' ) );
			add_action( 'init', array( $this, 'register_recipe_cuisine' ) );
			add_action( 'init', array( $this, 'register_recipe_tag' ) );

		}

		/**
		 * Register Custom Post Type - Recipe
		 */
		public function register_recipe_post_type() {
			$labels = array(
				'name'               => _x( 'Recipes', 'Post Type General Name', 'wp-recipe-manager' ),
				'singular_name'      => _x( 'Recipe', 'Post Type Singular Name', 'wp-recipe-manager' ),
				'menu_name'          => esc_html__( 'Recipe Manager', 'wp-recipe-manager' ),
				'name_admin_bar'     => esc_html__( 'Recipe', 'wp-recipe-manager' ),
				'parent_item_colon'  => esc_html__( 'Parent Item:', 'wp-recipe-manager' ),
				'all_items'          => esc_html__( 'All Recipes', 'wp-recipe-manager' ),
				'add_new_item'       => esc_html__( 'Add New', 'wp-recipe-manager' ),
				'add_new'            => esc_html__( 'Add New', 'wp-recipe-manager' ),
				'new_item'           => esc_html__( 'New Recipe', 'wp-recipe-manager' ),
				'edit_item'          => esc_html__( 'Edit Recipe', 'wp-recipe-manager' ),
				'update_item'        => esc_html__( 'Update Recipe', 'wp-recipe-manager' ),
				'view_item'          => esc_html__( 'View Recipe', 'wp-recipe-manager' ),
				'view_items'         => esc_html__( 'View Recipes', 'wp-recipe-manager' ),
				'search_items'       => esc_html__( 'Search Recipe', 'wp-recipe-manager' ),
				'not_found'          => esc_html__( 'Not found', 'wp-recipe-manager' ),
				'not_found_in_trash' => esc_html__( 'Not found in Trash', 'wp-recipe-manager' ),
			);
			$args   = array(
				'labels'             => $labels,
				'supports'           => array( 'title', 'editor', 'thumbnail', 'comments' ),
				'taxonomies'         => array( 'recipe_category', 'recipe_cuisine', 'recipe_tag' ),
				'hierarchical'       => false,
				'public'             => true,
				'show_ui'            => true,
				'show_in_menu'       => true,
				'menu_position'      => 3,
				'menu_icon'          => WPRM_URL . 'assets/images/menu_icon.png',
				'show_in_admin_bar'  => true,
				'show_in_nav_menus'  => true,
				'capability_type'    => 'post',
				'query_var'          => true,
				'publicly_queryable' => true,
				'rewrite'            => array(
					'slug'         => _x( 'recipe', 'Recipe slug Single', 'wp-recipe-manager' ),
					'hierarchical' => true,
					'with_front'   => false
				),
				'has_archive'        => _x( 'recipes', 'Recipe slug Archive', 'wp-recipe-manager' ),

			);
			register_post_type( 'recipe', $args );
		}

		/**
		 * Register Custom Taxonomy - Recipe Category
		 */
		public function register_recipe_category() {

			$labels = array(
				'name'                => _x( 'Recipe Categories', 'Taxonomy General Name', 'wp-recipe-manager' ),
				'singular_name'       => _x( 'Category', 'Taxonomy Singular Name', 'wp-recipe-manager' ),
				'menu_name'           => esc_html__( 'Categories', 'wp-recipe-manager' ),
				'all_items'           => esc_html__( 'All Categories', 'wp-recipe-manager' ),
				'parent_item'         => esc_html__( 'Parent Category', 'wp-recipe-manager' ),
				'parent_item_colon'   => esc_html__( 'Parent Category:', 'wp-recipe-manager' ),
				'new_item_name'       => esc_html__( 'New Category Name', 'wp-recipe-manager' ),
				'add_new_item'        => esc_html__( 'Add New Category', 'wp-recipe-manager' ),
				'edit_item'           => esc_html__( 'Edit Category', 'wp-recipe-manager' ),
				'update_item'         => esc_html__( 'Update Category', 'wp-recipe-manager' ),
				'search_items'        => esc_html__( 'Search categories', 'wp-recipe-manager' ),
				'add_or_remove_items' => esc_html__( 'Add or remove categories', 'wp-recipe-manager' ),
			);
			$args   = array(
				'labels'            => $labels,
				'hierarchical'      => true,
				'show_ui'           => true,
				'show_admin_column' => true,
				'query_var'         => true,
				'rewrite'           => array( 'slug' => _x( 'recipe-category', 'Recipe slug Category', 'wp-recipe-manager' ) ),
			);
			register_taxonomy( 'recipe_category', array( 'recipe' ), $args );
		}

		/**
		 * Register Custom Taxonomy - Recipe Cuisine
		 */
		public function register_recipe_cuisine() {

			$labels = array(
				'name'                => _x( 'Cuisines', 'Taxonomy General Name', 'wp-recipe-manager' ),
				'singular_name'       => _x( 'Cuisine', 'Taxonomy Singular Name', 'wp-recipe-manager' ),
				'menu_name'           => esc_html__( 'Cuisines', 'wp-recipe-manager' ),
				'all_items'           => esc_html__( 'All Cuisines', 'wp-recipe-manager' ),
				'parent_item'         => esc_html__( 'Parent Cuisine', 'wp-recipe-manager' ),
				'parent_item_colon'   => esc_html__( 'Parent Cuisine:', 'wp-recipe-manager' ),
				'new_item_name'       => esc_html__( 'New Cuisine Name', 'wp-recipe-manager' ),
				'add_new_item'        => esc_html__( 'Add New Cuisine', 'wp-recipe-manager' ),
				'edit_item'           => esc_html__( 'Edit Cuisine', 'wp-recipe-manager' ),
				'update_item'         => esc_html__( 'Update Cuisine', 'wp-recipe-manager' ),
				'search_items'        => esc_html__( 'Search cuisines', 'wp-recipe-manager' ),
				'add_or_remove_items' => esc_html__( 'Add or remove cuisines', 'wp-recipe-manager' ),
			);
			$args   = array(
				'labels'            => $labels,
				'hierarchical'      => true,
				'show_ui'           => true,
				'show_admin_column' => true,
				'query_var'         => true,
				'rewrite'           => array( 'slug' => _x( 'recipe-cuisine', 'Recipe slug Cuisine', 'wp-recipe-manager' ) ),
			);
			register_taxonomy( 'recipe_cuisine', array( 'recipe' ), $args );
		}

		/**
		 * Register Custom Taxonomy - Recipe Tag
		 */
		public function register_recipe_tag() {

			$labels = array(
				'name'                       => _x( 'Tags', 'Taxonomy General Name', 'wp-recipe-manager' ),
				'singular_name'              => _x( 'Tag', 'Taxonomy Singular Name', 'wp-recipe-manager' ),
				'menu_name'                  => esc_html__( 'Tags', 'wp-recipe-manager' ),
				'all_items'                  => esc_html__( 'All Tags', 'wp-recipe-manager' ),
				'parent_item'                => esc_html__( 'Parent Tag', 'wp-recipe-manager' ),
				'parent_item_colon'          => esc_html__( 'Parent Tag:', 'wp-recipe-manager' ),
				'new_item_name'              => esc_html__( 'New Tag Name', 'wp-recipe-manager' ),
				'add_new_item'               => esc_html__( 'Add New Tag', 'wp-recipe-manager' ),
				'edit_item'                  => esc_html__( 'Edit Tag', 'wp-recipe-manager' ),
				'update_item'                => esc_html__( 'Update Tag', 'wp-recipe-manager' ),
				'separate_items_with_commas' => esc_html__( 'Separate tags with commas', 'wp-recipe-manager' ),
				'search_items'               => esc_html__( 'Search tags', 'wp-recipe-manager' ),
				'add_or_remove_items'        => esc_html__( 'Add or remove tags', 'wp-recipe-manager' ),
				'choose_from_most_used'      => esc_html__( 'Choose from the most used recipe tags', 'wp-recipe-manager' ),
			);
			$args   = array(
				'labels'            => $labels,
				'hierarchical'      => false,
				'show_ui'           => true,
				'show_admin_column' => true,
				'query_var'         => true,
				'rewrite'           => array( 'slug' => _x( 'recipe-tag', 'Recipe slug Tag', 'wp-recipe-manager' ) ),
			);
			register_taxonomy( 'recipe_tag', array( 'recipe' ), $args );
		}

	}

	new WPRM_Post_Type();
}