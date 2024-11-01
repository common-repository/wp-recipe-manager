<?php
/*
Plugin Name: WP Recipe Manager
Plugin URI: https://wordpress.org/plugins/wp-recipe-manager/
Description: WP Recipe Manager plugin supports fully features for a cooking recipe with recipe general information, ingredients/ instruction creation.
Author: Tomiup
Version: 1.0.0
Author URI: http://tomiup.com
Text Domain: wp-recipe-manager
Domain Path: /languages/
*/

/**
 * Prevent loading this file directly
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class WPRM
 */
if ( ! class_exists( 'WPRM' ) ) {
	class WPRM {
		function __construct() {

			define( 'WPRM_URL', plugin_dir_url( __FILE__ ) );
			define( 'WPRM_PATH', plugin_dir_path( __FILE__ ) );
			// Initial
			add_action( 'wp_enqueue_scripts', array( $this, 'register_assets' ) );
			add_action( 'init', array( $this, 'load_textdomain' ) );


			// Require functions
			$this->include_libs();
			$this->include_functions();

		}


		/**
		 * Load plugin textdomain.
		 */

		function load_textdomain() {
			load_plugin_textdomain( 'wp-recipe-manager', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
		}


		/**
		 * Register assets
		 * @author Khoapq
		 */
		public function register_assets() {
			wp_register_script( 'wprm-frontend', WPRM_URL . 'assets/js/frontend.js', array( 'jquery' ), '', true );
			wp_register_style( 'wprm-frontend', WPRM_URL . 'assets/css/frontend.css', array() );
			wp_register_style( 'ionicons', WPRM_URL . 'assets/css/ionicons.min.css', array() );
			if ( is_singular( 'recipe' ) ) {
				wp_enqueue_script( 'wprm-frontend' );
				wp_enqueue_style( 'wprm-frontend' );
				wp_enqueue_style( 'ionicons' );
			}
		}

		/**
		 * Require functions
		 */
		public function include_libs() {
			include_once( plugin_dir_path( __FILE__ ) . 'inc/libs/class.metaboxes.php' );
		}

		/**
		 * Require functions
		 */
		public function include_functions() {
			include_once( plugin_dir_path( __FILE__ ) . 'inc/plugin-core.php' );
			include_once( plugin_dir_path( __FILE__ ) . 'inc/post-type.php' );
			include_once( plugin_dir_path( __FILE__ ) . 'inc/metaboxes.php' );
			include_once( plugin_dir_path( __FILE__ ) . 'inc/template-loader.php' );
			include_once( plugin_dir_path( __FILE__ ) . 'inc/frontend-functions.php' );
		}

	}

	new WPRM();
}