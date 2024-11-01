<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://www.itpathsolutions.com/
 * @since      1.0.0
 *
 * @package    Ultimate_Sticky_Popup_And_Widgets
 * @subpackage Ultimate_Sticky_Popup_And_Widgets/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Ultimate_Sticky_Popup_And_Widgets
 * @subpackage Ultimate_Sticky_Popup_And_Widgets/includes
 * @author     Mayur <mayur@mail.com>
 */
class Ultimate_Sticky_Popup_And_Widgets {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Ultimate_Sticky_Popup_And_Widgets_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'ULTIMATE_STICKY_POPUP_AND_WIDGETS_VERSION' ) ) {
			$this->version = ULTIMATE_STICKY_POPUP_AND_WIDGETS_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'ultimate-sticky-popup-and-widgets';

		$this->uspaw_get_options[] = $this->uspaw_get_options();
		$this->get_uspaw_place = $this->get_uspaw_place();
		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Ultimate_Sticky_Popup_And_Widgets_Loader. Orchestrates the hooks of the plugin.
	 * - Ultimate_Sticky_Popup_And_Widgets_i18n. Defines internationalization functionality.
	 * - Ultimate_Sticky_Popup_And_Widgets_Admin. Defines all hooks for the admin area.
	 * - Ultimate_Sticky_Popup_And_Widgets_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-ultimate-sticky-popup-and-widgets-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-ultimate-sticky-popup-and-widgets-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-ultimate-sticky-popup-and-widgets-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-ultimate-sticky-popup-and-widgets-public.php';

		$this->loader = new Ultimate_Sticky_Popup_And_Widgets_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Ultimate_Sticky_Popup_And_Widgets_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Ultimate_Sticky_Popup_And_Widgets_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Ultimate_Sticky_Popup_And_Widgets_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		// Add the settings page and menu item.
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'uspaw_plugin_admin_menu' );
		$this->loader->add_action( 'admin_post_save_uspaw_update_settings',$plugin_admin,'uspaw_update_settings');
		$this->loader->add_filter( 'plugin_action_links_ultimate-sticky-popup-widgets/'.$this->plugin_name.'.php',$plugin_admin,'uspaw_settings_link',10,1 );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Ultimate_Sticky_Popup_And_Widgets_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
		$this->loader->add_action( 'wp', $plugin_public, 'load_uspaw_popup' );
		$load_uspaw_popup = $this->uspaw_get_options();
		if($load_uspaw_popup['uspaw_popup_active'])
		{
			$this->loader->add_action( 'wp_head', $plugin_public, 'head_styles');
			$this->loader->add_filter( 'wp_footer', $plugin_public, 'get_sticky_popup' );
			$this->loader->add_action( 'wp_footer', $plugin_public, 'footer_scripts' );
		}
		if($load_uspaw_popup['uspaw_social_share_active']){
			$this->loader->add_action( 'init', $plugin_public, 'register_uspaw_shortcode');
		}

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Ultimate_Sticky_Popup_And_Widgets_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

	public static function uspaw_get_options(){
		$options['uspaw_button_layout'] = get_option( 'uspaw_button_layout' );
		$options['uspaw_popup_active'] = get_option( 'uspaw_popup_active' );
		$options['uspaw_social_share_active'] = get_option( 'uspaw_social_share_active' );
		$options['uspaw_popup_title']  = get_option( 'uspaw_popup_title' );
		$options['uspaw_popup_color']  = get_option( 'uspaw_popup_color' );
		$options['uspaw_popup_image'] = get_option( 'uspaw_popup_image' );
		$options['uspaw_popup_right_icon_border']  = get_option( 'uspaw_popup_right_icon_border' );
		$options['uspaw_popup_header_color'] = get_option( 'uspaw_popup_header_color' );
		$options['uspaw_popup_header_border_color'] = get_option( 'uspaw_popup_header_border_color' );
		$options['uspaw_popup_place'] = get_option( 'uspaw_popup_place' );
		$options['uspaw_popup_top_margin'] = get_option( 'uspaw_popup_top_margin' );
		$options['uspaw_popup_content'] = get_option( 'uspaw_popup_content' );
		return $options;
	}
	/**
	 * Returns list of Popup Place
	 * 
	 * @since 1.0
	 *
	 * @return array Popup Place
	 */
	public function get_uspaw_place() {
		return array(
				'right-bottom' => 'Right Bottom',
				'left-bottom' => 'Left Bottom',
				'top-left' => 'Top Left',
				'top-right' => 'Top Right',				
				'right' => 'Right',
				'left' => 'Left',				
			);
	}

	public function get_uspaw_button_layout() {
		return array(
				'squre-layout' => 'Square Layout',
				'round-layout' => 'Round Layout',				
			);
	}

}
