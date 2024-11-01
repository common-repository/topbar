<?php
/**
 * Plugin Name: navbar
 * Description:This plugin adds a simple and clean notification bar at the top of your website, allowing you to  show a message to your visitors
 * Version:1.0.0
 * Author Name :
 * Text-domain :topbar
 * Domain Path: /Languages
 * * License: GPL2.
 *
 * @package 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if ( ! class_exists( 'Fme_Nb_Navbar' ) ) {

	/**
	 * Class Fme_Nb_Navbar
	 *
	 * This class represents the top bar functionality in the application.
	 * Customize this class to include specific features and methods related to the top bar.
	 */
	class Fme_Nb_Navbar {
		/**
		 * FrontEnd constructor.
		 * Add the topbar menu to the user site in the head section of the HTML.
		 *
		 * This method is hooked to the 'wp_head' action in WordPress.
		 */
		public function __construct() {
			 // Constructor logic, initialize properties, etc.
			add_action( 'init', array( $this, 'fme_nb_text_domain' ) );
			if ( is_admin() ) {
				include 'admin/class-fme-nb-topbaradmin.php';
			} else {
				include 'frontend/class-fme-nb-frontend.php';
			}
		}
		/**
		 * Function to load text domain
		 */
		public function fme_nb_text_domain() {
			load_plugin_textdomain( 'topbar', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
		}
	}
}
$obj = new Fme_Nb_Navbar();
