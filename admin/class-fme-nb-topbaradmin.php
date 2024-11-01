<?php
/**
 *
 * Class Fme_Nb_Topbaradmin
 *
 * Description of what the class does.
 *
 * @package 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if ( ! class_exists( 'Fme_Nb_Topbaradmin' ) ) {
	/**
	 * Class Fme_Nb_Topbaradmin
	 *
	 * This class handles the administration settings for the Topbar feature.
	 *
	 * @package topbar
	 */
	class Fme_Nb_Topbaradmin {
		/**
		 * FrontEnd constructor.
		 * Add the topbar menu to the user site in the head section of the HTML.
		 *
		 * This method is hooked to the 'wp_head' action in WordPress.
		 */
		public function __construct() {
			/**
 * MyClass constructor.
 *
 * @param string $functionName The name of the function used to initialize the object.
 */
			add_action( 'admin_enqueue_scripts', array( $this, 'fme_nb_topbar_admin_js_script' ) );
			add_action( 'admin_menu', array( $this, 'fme_nb_topbar_plugin_settings_page' ) );
			add_action( 'wp_ajax_topbarajax', array( $this, 'fme_nb_topbar_save_settings' ) );
			add_action( 'wp_ajax_nopriv_topbarajax', array( $this, 'fme_nb_topbar_save_settings' ) );
			add_action( 'wp_ajax_textbarajax', array( $this, 'fme_nb_get_text_show_usersite' ) );
			add_action( 'wp_ajax_nopriv_textbarajax', array( $this, 'fme_nb_get_text_show_usersite' ) );
			// ( 'wp_ajax_buttonText', array( $this, 'fme_nb_btn_shortcode' ) );
			// add_action( 'wp_ajax_nopriv_buttonText', array( $this, 'fme_nb_btn_shortcode' ) );
			add_action( 'wp_ajax_cssajax', array( $this, 'fme_nb_topbar_style_show_usersite' ) );
			add_action( 'wp_ajax_nopriv_cssajax', array( $this, 'fme_nb_topbar_style_show_usersite' ) );
		}

		/**
		 * Enqueue JavaScript script for the admin topbar.
		 *
		 * This function is responsible for enqueuing the JavaScript script needed for the admin topbar functionality.
		 * Customize this function to include specific script dependencies, versioning, or any additional settings.
		 */
		public function fme_nb_topbar_admin_js_script() {
			wp_register_script( 'my__tab', WP_PLUGIN_URL . '/navbar/admin/asset/js/main.js', array( 'jquery' ), 1.0 );
			wp_enqueue_script( 'my__tab' );
			wp_localize_script( 'my__tab', 'mytabkAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
			wp_enqueue_script( 'my__tab' );
			wp_register_style( 'togglestyle', WP_PLUGIN_URL . '//navbar/admin/asset/css/main.css', false, '1.0', 'all' );
			wp_enqueue_style( 'togglestyle' );
		}
			/**
			 * Save settings for the topbar functionality.
			 *
			 * This function handles the process of saving user-defined settings related to the topbar.
			 * Customize this function to handle the specific settings and validation logic.
			 *
			 * @return void
			 */
		public function fme_nb_get_text_show_usersite() {
			// $save_textarea_content = ( isset( $_REQUEST['textarea'] ) ) ? sanitize_text_field( $_REQUEST['textarea'] ) : '';

			$save_textarea_content = isset( $_REQUEST['textarea'] )
			? sanitize_text_field( wp_unslash( $_REQUEST['textarea'] ) )
			: '';
			$button_text = isset( $_REQUEST['button_text'] )
			? sanitize_text_field( wp_unslash( $_REQUEST['button_text'] ) )
			: '';

			$button_url = isset( $_REQUEST['button_url'] )
			? sanitize_text_field( wp_unslash( $_REQUEST['button_url'] ) )
			: '';
			$btn_colors = isset( $_REQUEST['btn_colors'] )
			? sanitize_text_field( wp_unslash( $_REQUEST['btn_colors'] ) )
			: '';
			$behavior_tab = isset( $_REQUEST['behavior_tab'] )
			? sanitize_text_field( wp_unslash( $_REQUEST['behavior_tab'] ) )
			: '';
			$btn_texts = isset( $_REQUEST['btn_texts'] )
			? sanitize_text_field( wp_unslash( $_REQUEST['btn_texts'] ) )
			: '';

			update_option( 'fme_nb_textarea', $save_textarea_content );
			update_option( 'fme_nb_button_text', $button_text );
			update_option( 'fme_nb_button_url', $button_url );
			update_option( 'fme_nb_behavior_tab', $behavior_tab );
			update_option( 'fme_nb_btn_colors', $btn_colors );
			update_option( 'fme_nb_btn_texts', $btn_texts );
		}
		/**
		 * Enqueue styles for displaying the topbar on the user site.
		 *
		 * This function is responsible for enqueuing the necessary styles to display the topbar
		 * on the user site. Customize this function as needed, including any specific styles or dependencies.
		 */
		public function fme_nb_topbar_style_show_usersite() {
			$px = isset( $_REQUEST['px'] )
			? sanitize_text_field( wp_unslash( $_REQUEST['px'] ) )
			: '';
			$set_height = isset( $_REQUEST['set_height'] )
			? sanitize_text_field( wp_unslash( $_REQUEST['set_height'] ) )
			: '';
			$set_width  = isset( $_REQUEST['set_width'] )
			? sanitize_text_field( wp_unslash( $_REQUEST['set_width'] ) )
			: '';
			$wp_px_percent  = isset( $_REQUEST['wp_px_percent'] )
			? sanitize_text_field( wp_unslash( $_REQUEST['wp_px_percent'] ) )
			: '';
			update_option( 'fme_nb_px', $px );
			update_option( 'fme_nb_set_height', $set_height );
			update_option( 'fme_nb_set_width', $set_width );
			update_option( 'fme_nb_wp_px_percent', $wp_px_percent );
		}
		/**
		 * Save settings for the topbar functionality.
		 *
		 * This function handles the process of saving user-defined settings related to the topbar.
		 * Customize this function to handle the specific settings and validation logic.
		 *
		 * @return void
		 */
		public function fme_nb_topbar_save_settings() {
			 $checkbox_save = isset( $_REQUEST['checkbox'] )
			? sanitize_text_field( wp_unslash( $_REQUEST['checkbox'] ) )
			: '';
			 $tb_postion = isset( $_REQUEST['tb_postion'] )
			? sanitize_text_field( wp_unslash( $_REQUEST['tb_postion'] ) )
			: '';
			 $visible_type = isset( $_REQUEST['visible_type'] )
			? sanitize_text_field( wp_unslash( $_REQUEST['visible_type'] ) )
			: '';

			 $color_bg = isset( $_REQUEST['color_bg'] )
			? sanitize_text_field( wp_unslash( $_REQUEST['color_bg'] ) )
			: '';
			 $color_text = isset( $_REQUEST['color_text'] )
			? sanitize_text_field( wp_unslash( $_REQUEST['color_text'] ) )
			: '';

			update_option( 'fme_nb_checkbox', $checkbox_save );
			update_option( 'fme_nb_tb_postion', $tb_postion );
			update_option( 'fme_nb_visible_type', $visible_type );
			update_option( 'fme_nb_color_text', $color_text );
			update_option( 'fme_nb_color_bg', $color_bg );
		}
		/**
		 * Save settings for the topbar functionality.
		 *
		 * This function handles the process of saving user-defined settings related to the topbar.
		 * Customize this function to handle the specific settings and validation logic.
		 *
		 * @return void
		 */
		public function fme_nb_topbar_plugin_settings_page() {

			$page_title = 'Top Bar Settings';
			$menu_title = 'TopBar';
			$capability = 'manage_options';
			$slug = 'topbar_settings';
			$callback = array( $this, 'fme_nb_plugin_settings_page_content' );
			$icon = ' dashicons-admin-generic';
			$position = 70;
			add_menu_page( $page_title, $menu_title, $capability, $slug, $callback, $icon, $position );
		}
		/**
		 * Generates the content for the plugin settings page.
		 *
		 * This function is responsible for displaying and handling the content
		 * on the plugin settings page.
		 *
		 * @since 1.0.0
		 */
		public function fme_nb_plugin_settings_page_content() {
			ob_start();
			$status = esc_attr( get_option( 'fme_nb_checkbox' ) );
			$postion = esc_attr( get_option( 'fme_nb_tb_postion' ) );
			$visible_type = esc_attr( get_option( 'fme_nb_visible_type' ) );
			$color_text = esc_attr( get_option( 'fme_nb_color_text' ) );
			$color_bg = esc_attr( get_option( 'fme_nb_color_bg' ) );
			$current_text = esc_attr( get_option( 'fme_nb_textarea' ) );
			$text = get_option( 'fme_nb_textarea' );
			$btn_text = get_option( 'fme_nb_button_text' );
			$button_url = get_option( 'fme_nb_button_url' );
			$behavior_tab = get_option( 'fme_nb_behavior_tab' );
			$set_height = esc_attr( get_option( 'fme_nb_set_height' ) );
			$set_width = esc_attr( get_option( 'fme_nb_set_width' ) );
			$btn_bg = esc_attr( get_option( 'fme_nb_btn_colors' ) );
			$wp_px_percent = esc_attr( get_option( 'fme_nb_wp_px_percent' ) );

			$btn_texts = esc_attr( get_option( 'fme_nb_btn_texts' ) );
			$px = esc_attr( get_option( 'fme_nb_px' ) );
			$curr_status = 'true' === $status ? 'checked' : 'unchecked';

			?>
			
			<!-- General -->
			<h1><?php esc_html_e( 'Top Bar settings', 'topbar' ); ?></h1>
			<div class="main_heading">
				<ul>
					<li id="fme_nb_General"><a href='#' class="current "><?php esc_html_e( 'General', 'topbar' ); ?> </a></li>
					|
					<li id="fme_nb_content"><a href='#content' class="fme_nb_tb_active_tab"> <?php esc_html_e( 'Content', 'topbar' ); ?>  </a></li> 
					|
					<li id="fme_nb_css"><a href='#' class="fme_nb_tb_active_tab"> <?php esc_html_e( 'css', 'topbar' ); ?>  </a></li> 

					<ul>
					</div>
					<div class="fme_nb_General">
						<table class="fme_nb_table">
							<tbody>
								<tr class="fme_nb_size">
									<th ><?php esc_html_e( 'Status', 'topbar' ); ?></th>
									<td >
										<?php
										if ( 'true' === $status ) {
											?>
											<input type="checkbox"  name='checkbox'id="fme_nb_checkboxs"
											 <?php
												printf(
												/* translators: %s: Name of a status */
													esc_html__( 'status %s', 'topbar' ),
													esc_html( $curr_status )
												);

												?>
											>
											<span><?php esc_html_e( 'Enable / Disable', 'topbar' ); ?></span>	
										</td>
											<?php
										} else {
											?>
										<input type="checkbox"  name='checkbox'id="fme_nb_checkboxs" 
											<?php
											printf(
											/* translators: %s: Name of a status */
												esc_html__( 'status %s', 'topbar' ),
												esc_html( $curr_status )
											);

											?>

										>
											<span><?php esc_html_e( 'Enable / Disable', 'topbar' ); ?></span>
											<?php
										}
										?>
										
								</tr>
								<tr>
									<th ><?php esc_html_e( 'Top Bar Position', 'topbar' ); ?></th>
									<td >
										<select name="tb_postion" class="fme_nb_wc-tb_postion">
											<?php if ( 'standard' == $postion ) { ?>
												<option value="standard" selected><?php esc_html_e( 'Standard', 'topbar' ); ?>
											</option>
											<option value="sticky"><?php esc_html_e( 'Fixed', 'topbar' ); ?>
										</option>
									<?php } elseif ( 'sticky' == $postion ) { ?>
										<option value="sticky" selected><?php esc_html_e( 'Fixed', 'topbar' ); ?>
									</option>
									<option value="standard"><?php esc_html_e( 'Standard', 'topbar' ); ?>
								</option>
							<?php } else { ?>
								<option value="standard" selected><?php esc_html_e( 'Standard', 'topbar' ); ?>
							</option>
							<option value="sticky"><?php esc_html_e( 'Fixed', 'topbar' ); ?>
						</option>
					<?php } ?>
				</select>
			</td>
		</tr>
		<tr>
			<th ><?php esc_html_e( 'Top Bar Visibility', 'topbar' ); ?></th>
			<td >
				<select name="visible_type" class="fme_nb_wp-visible_type">
					<?php if ( 'reg_user' == $visible_type ) { ?>
						<option value="reg_user" selected><?php esc_html_e( 'Login user', 'topbar' ); ?>
					</option>
					<option value="guest"><?php esc_html_e( 'Every One', 'topbar' ); ?>
				</option>
			<?php } elseif ( 'guest' == $visible_type ) { ?>
				<option value="guest" selected><?php esc_html_e( 'Every One', 'topbar' ); ?>
			</option>
			<option value="reg_user"><?php esc_html_e( 'Login user', 'topbar' ); ?>
		</option>
	<?php } else { ?>
		<option value="reg_user" selected><?php esc_html_e( 'Login user', 'topbar' ); ?>
	</option>
	<option value="guest"><?php esc_html_e( 'Every One', 'topbar' ); ?>
</option>
<?php } ?>
</select>
</td>
</tr>
<tr>
	<th ><?php esc_html_e( 'Background Color', 'topbar' ); ?>

</th>
<td >
<input type="color" id="fme_nb_bg_text_color" class="fme_nb_color_bg" name="color_bg" value="<?php echo esc_attr( $color_bg ); ?>">

</td>
</tr>
<tr>
	<th ><?php esc_html_e( 'Text Color', 'topbar' ); ?>

</th>
<td >
	<input type="color" id="fme_nb_bg_text_color" class="fme_nb_color_text" value="<?php echo esc_attr( $color_text ); ?>" name="color_text">

</td>
</tr>

</tbody>
</table>
<button type='button' name='save_data' class="fme_nb_btn_save"><?php esc_html_e( 'save', 'topbar' ); ?></button>
</div>

<!-------------------------------------------- content ---------------------------------------------------------->
<div class="fme_nb_Content">
	<table class="fme_nb_table">
		<tbody>
			<tr class="">
				<th class='fme_nb_msg' ><?php esc_html_e( 'Message', 'topbar' ); ?></th>
				<td >
					<textarea cols="50"  name="textarea" class='fme_nb_textarea'rows="4"><?php echo esc_attr( $current_text ); ?></textarea>
					<p><?php esc_html_e( 'Use shortcode [button] to make a button ', 'topbar' ); ?></p>
					
				</td>
			</tr>
			<tr>
				<th ><?php esc_html_e( 'Button Name', 'topbar' ); ?>

			</th>
			<td >
			<input type="text" class="fme_nb_button_text"  value="<?php echo esc_attr( $btn_text ); ?>" >
			</td>
		</tr>
		<tr>
			<th ><?php esc_html_e( 'Button URL', 'topbar' ); ?>

		</th>
		<td >
		<input type="text" class="fme_nb_button_url" value="<?php echo esc_attr( $button_url ); ?>">
		</td>
	</tr>
	<tr>
		<th ><?php esc_html_e( 'Button Background Color', 'topbar' ); ?>

	</th>
	<td >
		<input type="color" id="fme_nb_btn_colors" class="fme_nb_color_bg" name="" value="<?php echo esc_attr( $btn_bg ); ?>">
	</td>
</tr>
<tr>
	<th ><?php esc_html_e( 'Button Text Color', 'topbar' ); ?>

</th>
<td >
	<input type="color" id="fme_nb_btn_texts" class="fme_nb_btn_texts "value="<?php echo esc_attr( $btn_texts ); ?>">

</td>
</tr>
<tr>
	<th ><?php esc_html_e( 'Tab behavior when clicked.', 'topbar' ); ?></th>
	<td >
		<select   class="fme_nb_behavior_tab">
			<?php if ( '_blank' == $behavior_tab ) { ?>
				<option value="_blank" selected><?php esc_html_e( 'New Tab', 'topbar' ); ?>
			</option>
			<option value="_self"><?php esc_html_e( 'Current Tab', 'topbar' ); ?>
		</option>
	<?php } elseif ( '_self' == $behavior_tab ) { ?>
		<option value="_self" selected><?php esc_html_e( 'Current Tab', 'topbar' ); ?>
	</option>
	<option value="_blank"><?php esc_html_e( 'New Tab', 'topbar' ); ?>
</option>
<?php } else { ?>
	<option value="_blank" selected><?php esc_html_e( 'New Tab', 'topbar' ); ?>
</option>
<option value="_self"><?php esc_html_e( 'Current Tab', 'topbar' ); ?>
</option>
<?php } ?>
</select>
</td>
</tr>
</tbody>
</table>
<button type='button' name='info_data' class="fme_nb_Message_save"><?php esc_html_e( 'Save', 'topbar' ); ?></button>
</div>
<!----------------------------------------------------- css------------------------------------------------------------->
<div class="fme_nb_css">
	<table class="fme_nb_table">
		<tbody>
			<tr>
				<th ><?php esc_html_e( 'Top Bar width', 'topbar' ); ?></th>
				<td >
					<select class="fme_nb_px">
						<?php if ( 'px' == $px ) { ?>
							<option value="px" selected><?php esc_html_e( 'px', 'topbar' ); ?>
						</option>
						<option value="%"><?php esc_html_e( 'percentage', 'topbar' ); ?>
					</option>
				<?php } elseif ( '%' == $px ) { ?>
					<option value="%" selected><?php esc_html_e( 'percentage', 'topbar' ); ?>
				</option>
				<option value="px"><?php esc_html_e( 'px', 'topbar' ); ?>
			</option>
		<?php } else { ?>
			<option value="px" selected><?php esc_html_e( 'px', 'topbar' ); ?>
		</option>
		<option value="%"><?php esc_html_e( 'percentage', 'topbar' ); ?>
	</option>
<?php } ?>
</select>
</td>
</tr>


<tr>
	<th ><?php esc_html_e( 'Set Top Bar width', 'topbar' ); ?>

</th>
<td >
	<input type="number" min="0" class="fme_nb_set_width" value="<?php echo esc_attr( $set_width ); ?>">
</td>
</tr>
<tr>
	<th ><?php esc_html_e( 'Set Top Bar height', 'topbar' ); ?>

</th>
<td >
	<input type="number" min="0"class='fme_nb_set_height'value="<?php echo esc_attr( $set_height ); ?>">
</td>
</tr>

<tr>
	<th ><?php esc_html_e( ' Top Bar height ', 'topbar' ); ?></th>
	<td >
		<select class="fme_nb_wp_px_percent">
			<?php if ( 'px' == $wp_px_percent ) { ?>
				<option value="px" selected><?php esc_html_e( 'px', 'topbar' ); ?>
			</option>
			<option value="vh"><?php esc_html_e( 'percentage', 'topbar' ); ?>
		</option>
	<?php } elseif ( 'vh' == $wp_px_percent ) { ?>
		<option value="vh" selected><?php esc_html_e( 'percentage', 'topbar' ); ?>
	</option>
	<option value="px"><?php esc_html_e( 'px', 'topbar' ); ?>
</option>
<?php } else { ?>
	<option value="px" selected><?php esc_html_e( 'px', 'topbar' ); ?>
</option>
<option value="vh"><?php esc_html_e( 'percentage', 'topbar' ); ?>
</option>
<?php } ?>
</select>
</td>
</tr>

</tbody>
</table>
<button type='button' name='css_data' class="fme_nb_css_save"><?php esc_html_e( 'save', 'topbar' ); ?></button>
</div>
<div class="loader">

</div>
			<?php
		}
	}

}
$topbar_admin = new Fme_Nb_Topbaradmin();
?>