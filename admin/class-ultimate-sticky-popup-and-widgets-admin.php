<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.itpathsolutions.com/
 * @since      1.0.0
 *
 * @package    Ultimate_Sticky_Popup_And_Widgets
 * @subpackage Ultimate_Sticky_Popup_And_Widgets/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Ultimate_Sticky_Popup_And_Widgets
 * @subpackage Ultimate_Sticky_Popup_And_Widgets/admin
 * @author     Mayur <mayur@mail.com>
 */
class Ultimate_Sticky_Popup_And_Widgets_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Ultimate_Sticky_Popup_And_Widgets_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Ultimate_Sticky_Popup_And_Widgets_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/ultimate-sticky-popup-and-widgets-admin.css', array(), $this->version, 'all' );

		$screen = get_current_screen();
		if ( 'toplevel_page_'.$this->plugin_name == $screen->id ) {	
			wp_enqueue_style( $this->plugin_name . '-admin-style', plugin_dir_url( __FILE__ ) .'css/admin.css', $this->version,'all' );
			wp_enqueue_style( 'wp-color-picker' );
		}
	}
	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/ultimate-sticky-popup-and-widgets-admin.js', array( 'jquery' ), $this->version, false );

		// Added by Devloper
		$screen = get_current_screen();
		if ( 'toplevel_page_'.$this->plugin_name == $screen->id ) {	
			wp_enqueue_script( $this->plugin_name . '-admin-script', plugin_dir_url( __FILE__ ). 'js/admin.js', array( 'jquery', 'wp-color-picker' ),$this->version);
			wp_enqueue_media(); 
		}
	}
	/**
	 * Register the settings menu for this plugin into the WordPress Settings menu.
	 * 
	 * @since 1.0
	 */
	public function uspaw_plugin_admin_menu() {
		add_menu_page(
			__( 'Ultimate Sticky Popup & Widgets Settings', 'uspaw' ),
			'Ultimate Sticky Popup & Widgets',
			'manage_options',
			'ultimate-sticky-popup-and-widgets',
			array($this, 'uspad_options'),
			'dashicons-slides',
			99
		);
	}

	/**
	 * Plugin settings link
	 * 
	 * @since    1.0.0
	 */
	public function uspaw_settings_link( array $links ) {
	    $url = get_admin_url() . "admin.php?page=ultimate-sticky-popup-and-widgets";
		$settings_link = '<a href="' . $url . '">' . __('Settings', 'uspaw') . '</a>';
		  	$links[] = $settings_link;
		return $links;
	}

	/**
	 * Render the settings page for this plugin.
	 * 
	 * @since 1.0
	 */
	public function uspad_options() {

		// HTML Form inside this file
		include plugin_dir_path( dirname( __FILE__ ) ).'admin/partials/ultimate-sticky-popup-and-widgets-admin-display.php';
	}
	public function uspaw_update_settings(){
		$uspaw_object = new Ultimate_Sticky_Popup_And_Widgets();
		$uspaw_options = $uspaw_object->uspaw_get_options();
		$get_uspaw_place = $uspaw_object->get_uspaw_place();
		$get_uspaw_button_layout = $uspaw_object->get_uspaw_button_layout();

		if ( ! current_user_can( 'manage_options' ) )  {
			wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
		}
		
		if ( ! empty( $_POST ) && check_admin_referer( -1, 'save_uspaw_popup' ) ) {

			//add or update sticky popup Layout 
		
			if (  $uspaw_options['uspaw_button_layout'] !== false ) {
				update_option( 'uspaw_button_layout', sanitize_text_field($_POST['button_layout']) );
			} else {
				add_option( 'uspaw_button_layout', sanitize_text_field($_POST['button_layout']), null, 'no' );
			}

			//add or update sticky popup active stats
			if ($uspaw_options['uspaw_popup_active'] !== false ) {
				update_option( 'uspaw_popup_active', sanitize_text_field($_POST['popup_active']) );
			} else {
				add_option( 'uspaw_popup_active', sanitize_text_field($_POST['popup_active']), null, 'no' );
			}			
			//add or update Social Share active stats
			if ($uspaw_options['uspaw_social_share_active'] !== false ) {
				update_option( 'uspaw_social_share_active', sanitize_text_field($_POST['social_share_active']) );
			} else {
				add_option( 'uspaw_social_share_active', sanitize_text_field($_POST['social_share_active']), null, 'no' );
			}

			//add or update sticky popup title options
			if ( $uspaw_options['uspaw_popup_title'] !== false ) {

				update_option( 'uspaw_popup_title', sanitize_text_field($_POST['popup_title']) );
			} else {
				add_option( 'uspaw_popup_title', sanitize_text_field($_POST['popup_title']), null, 'no' );
			}			
			//add or update sticky popup title colour since version 1.1
			if ( $uspaw_options['uspaw_popup_color'] !== false ) {
				echo update_option( 'uspaw_popup_color', sanitize_text_field($_POST['popup_title_color']) );

			} else {
				add_option( 'uspaw_popup_color', sanitize_text_field($_POST['popup_title_color']), null, 'no' );
			}
			//add or update sticky popup title icon
			if ( $uspaw_options['uspaw_popup_image'] !== false ) {
				update_option( 'uspaw_popup_image', sanitize_text_field($_POST['popup_title_image']) );
			} else {
				add_option( 'uspaw_popup_image', sanitize_text_field($_POST['popup_title_image']), null, 'no' );
			}

				//add or update sticky popup Right icon border_color
			if ( $uspaw_options['uspaw_popup_right_icon_border'] !== false ) {
					echo update_option( 'uspaw_popup_right_icon_border', sanitize_text_field($_POST['popup_right_icon_border']) );
	
			} else {
					add_option( 'uspaw_popup_right_icon_border', sanitize_text_field($_POST['popup_right_icon_border']), null, 'no' );
			}
			
			//add or update sticky popup header color
			if ( $uspaw_options['uspaw_popup_header_color'] !== false ) {
				update_option( 'uspaw_popup_header_color', sanitize_text_field($_POST['popup_header_color']) );
			} else {
				add_option( 'uspaw_popup_header_color', sanitize_text_field($_POST['popup_header_color']), null, 'no' );
			}
			
			//add or update sticky popup header border color since version 1.1
			if ( $uspaw_options['uspaw_popup_header_border_color'] !== false ) {
				update_option( 'uspaw_popup_header_border_color', sanitize_text_field($_POST['popup_header_border_color']) );
			} else {
				add_option( 'uspaw_popup_header_border_color', sanitize_text_field($_POST['popup_header_border_color']), null, 'no' );
			}

			//add or update sticky popup place
			if (  $uspaw_options['uspaw_popup_place'] !== false ) {
				update_option( 'uspaw_popup_place', sanitize_text_field($_POST['popup_place']) );
			} else {
				add_option( 'uspaw_popup_place', sanitize_text_field($_POST['popup_place']), null, 'no' );
			}
			//add or update sticky popup Top Margin when position is left or right 
			if ( $uspaw_options['uspaw_popup_top_margin'] !== false ) {
				update_option( 'uspaw_popup_top_margin', sanitize_text_field($_POST['popup_top_margin']) );
			} else {
				add_option( 'uspaw_popup_top_margin', sanitize_text_field($_POST['popup_top_margin']), null, 'no' );
			}
			//add or update sticky popup content
			if ( $uspaw_options['uspaw_popup_content'] !== false ) {				
				update_option( 'uspaw_popup_content', wp_unslash( $_POST['popup_content'] ) );
			} else {
				add_option( 'uspaw_popup_content', wp_unslash( $_POST['popup_content'] ), null, 'no' );
			}

			wp_redirect( admin_url( 'admin.php?page=ultimate-sticky-popup-and-widgets&update-status=true' ) );
		}

	}


} //End of Ultimate_Sticky_Popup_And_Widgets_Admin Classs Put all code inside that class