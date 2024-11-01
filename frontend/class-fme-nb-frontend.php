<?php
/**
 * Class Fme_Nb_Frontend
 * Description: This file contains the implementation of the FrontEnd class.
 *
 * @package 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}
if ( ! class_exists( 'Fme_Nb_Frontend' ) ) {
	/**
	 * Class Fme_Nb_Frontend
	 * This class handles the front-end functionality of your application.
	 */
	class Fme_Nb_Frontend {

		 /**
		  * Fme_Nb_Frontend constructor.
		  * Add the topbar menu to the user site in the head section of the HTML.
		  *
		  * This method is hooked to the 'wp_head' action in WordPress.
		  */
		public function __construct() {
			add_action( 'wp_head', array( $this, 'fme_nb_topbar_menu_usersite' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'fme_nb_topbar_admin_site_css' ) );
		}
		/**
		 * Enqueue CSS styles for the admin topbar.
		 *
		 * This function is responsible for adding CSS styles to the WordPress admin topbar.
		 * It should be hooked to the appropriate action or filter to ensure it is called at the right time.
		 */
		public function fme_nb_topbar_admin_site_css() {
			wp_register_style( 'togglestyle', WP_PLUGIN_URL . '//navbar/frontend/css/main.css', false, '1.0', 'all' );
			wp_enqueue_style( 'togglestyle' );
		}

		/**
		 * Display the topbar menu for the user site.
		 *
		 * This function is responsible for generating and displaying the topbar menu on the user site.
		 * You might want to customize this function to include specific menu items or behavior.
		 */
		public function fme_nb_topbar_menu_usersite() {

			$current_status = esc_attr( get_option( 'fme_nb_checkbox' ) );
			 $current_background = esc_attr( get_option( 'fme_nb_color_bg' ) );
			 $current_text = esc_attr( get_option( 'fme_nb_textarea' ) );
			$color_text = esc_attr( get_option( 'fme_nb_color_text' ) );
			$postion_topbar = esc_attr( get_option( 'fme_nb_tb_postion' ) );
			$user_type = esc_attr( get_option( 'fme_nb_visible_type' ) );
			// $btn = esc_attr( get_option( 'fme_nb_btn_static' ) );
			$button_text = esc_attr( get_option( 'fme_nb_button_text' ) );
			$button_url = esc_attr( get_option( 'fme_nb_button_url' ) );
			$set_height = esc_attr( get_option( 'fme_nb_set_height' ) );
			$set_width = esc_attr( get_option( 'fme_nb_set_width' ) );
			$new_tab = esc_attr( get_option( 'fme_nb_behavior_tab' ) );
			$px = esc_attr( get_option( 'fme_nb_px' ) );
			$color_bg = esc_attr( get_option( 'fme_nb_btn_colors' ) );
			$btn_texts = esc_attr( get_option( 'fme_nb_btn_texts' ) );
			$wp_px_percent = esc_attr( get_option( 'fme_nb_wp_px_percent' ) );
			  global $allowedposttags;
			$my_allowed_tags = array(
				'style' => array(),
			);
			$merged_allowed_tags = array_merge( $allowedposttags, $my_allowed_tags );
				ob_start();
			?>
					<style>
					 .fme_nb_display_content {
					 background-color: 
					 <?php
						echo esc_attr( $current_background );
						?>
						!important;
					  width:<?php echo esc_attr( $set_width . $px ); ?>;	
					  height:<?php echo esc_attr( $set_height . $wp_px_percent ); ?>!important;
					  position:<?php echo esc_attr( $postion_topbar ); ?>;
					  color:<?php echo esc_attr( $color_text ); ?>;
					   }
						 .fme_nb_display_content a{ 
						  background-color:<?php echo esc_attr( $color_bg ); ?>!important;
						 color:<?php echo esc_attr( $btn_texts ); ?>!important;
						 }
					 </style>
					<div class="fme_nb_display_content">
					
					  <?php

						if ( 'true' === $current_status && 'reg_user' === $user_type && is_user_logged_in() ) {
							$result = str_ireplace( '[button]', "<a target=\"$new_tab\" href=\"$button_url\"> $button_text</a>", $current_text ?? 'Welcome to our website!' );

							echo wp_kses( $result, $merged_allowed_tags );

						} elseif ( 'true' === $current_status && 'guest' === $user_type ) {

							$value = str_ireplace( '[button]', "<a target=\"$new_tab\" href=\"$button_url\"> $button_text</a>", $current_text ?? 'Welcome to our website!' );
							echo wp_kses( $value, $merged_allowed_tags );

						} else {
							?>
					   <style>
					 .fme_nb_display_content{
					  display: none;
				   }
					.fme_nb_display_content a{
						  display: none;
						 }
					 </style>

							<?php
						}
						?>
				</div>
			<?php
			 $html = ob_get_clean();

			 echo wp_kses( $html, $merged_allowed_tags );
		}
	}
}
		$obj = new Fme_Nb_Frontend();
?>