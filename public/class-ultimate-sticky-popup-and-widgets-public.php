<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://www.itpathsolutions.com/
 * @since      1.0.0
 *
 * @package    Ultimate_Sticky_Popup_And_Widgets
 * @subpackage Ultimate_Sticky_Popup_And_Widgets/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Ultimate_Sticky_Popup_And_Widgets
 * @subpackage Ultimate_Sticky_Popup_And_Widgets/public
 * @author     Mayur <mayur@mail.com>
 */
class Ultimate_Sticky_Popup_And_Widgets_Public {

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

	private $uspaw_options;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->uspaw_options = Ultimate_Sticky_Popup_And_Widgets::uspaw_get_options();

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/ultimate-sticky-popup-and-widgets-public.css', array(), $this->version, 'all' );
		$show_uspaw_poup = $this->load_uspaw_popup();
		if($show_uspaw_poup)
			{
				wp_enqueue_style( $this->plugin_name . '-style', plugins_url( 'css/ultimate-sticky-popup.css', __FILE__ ), array(), $this->version );
			}

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/ultimate-sticky-popup-and-widgets-public.js', array( 'jquery' ), $this->version, false );
		$show_uspaw_poup = $this->load_uspaw_popup();
		if($show_uspaw_poup)
			{
				wp_enqueue_script( $this->plugin_name . '-modernizr-script', plugin_dir_url( __FILE__ ).'js/modernizr.custom.js', array('jquery'), $this->version );
			}

	}
	/**
	 * Create a function for Load css and action base on active popup 
	 * 
	 * @since 1.0
	 */
	public function load_uspaw_popup () {
		
		$show_uspaw_poup=false;
		

		if($this->uspaw_options['uspaw_popup_active'])
		{
			$show_uspaw_poup = true;
		}
		return $show_uspaw_poup;
	}
	/**
	 * Add styles for popup header color
	 * 
	 * @since 1.0
	 */
	public function head_styles() {
	?>
<style type="text/css">
.sticky-popup .popup-header {
    <?php if($this->uspaw_options['uspaw_popup_header_color'] !='') {
        ?>background-color: <?php echo esc_attr($this->uspaw_options['uspaw_popup_header_color']);
        ?>;
        <?php
    }

    else { ?>
	background-color: #0674fd;
		background-image: -webkit-gradient(linear, left top, right top, from(#0674fd), to(#00d0f9));
		background-image: -webkit-linear-gradient(left, #0674fd, #00d0f9);
		<?php
    }

    ?><?php if($this->uspaw_options['uspaw_popup_header_border_color'] !='') {
        ?>border: 1px solid <?php echo esc_attr($this->uspaw_options['uspaw_popup_header_border_color']);
        ?>;
        <?php
    }

    else {
        ?>border: none;
        <?php
    }
    ?>
}

.popup-title {
    <?php if($this->uspaw_options['uspaw_popup_color'] !='') {
        ?>color: <?php echo esc_attr($this->uspaw_options['uspaw_popup_color']);
        ?>;
        <?php
    }

    else {
        ?>color: #ffffff;
        <?php
    }

    ?>
}

.popup-image {
    <?php if($this->uspaw_options['uspaw_popup_right_icon_border'] !='') {
        ?>border: 2px solid <?php echo esc_attr($this->uspaw_options['uspaw_popup_right_icon_border']);
        ?>;
        <?php
    }

    else {
        ?>border: none;
        <?php
    }

    ?>
}


<?php if($this->uspaw_options['uspaw_popup_place']=='left'|| $this->uspaw_options['uspaw_popup_place']=='right') {
    ?>
	.sticky-popup-right,
    .sticky-popup-left {
    <?php if($this->uspaw_options['uspaw_popup_top_margin'] !='') {?>
	top: <?php echo esc_attr($this->uspaw_options['uspaw_popup_top_margin']);?>%;
    <?php
        }

        else {
            ?>
            <?php
        }

        ?>
    }

    <?php
}
?>
</style>
<?php
	}

	/**
	 * Print popup html code
	 *	 
	 * @since 1.0
	 */
	public function get_sticky_popup(){
		include plugin_dir_path( dirname( __FILE__ ) ).'public/partials/ultimate-sticky-popup-and-widgets-public-display.php';
	}
	/**
	 * Add Javascript for popup place
	 * 
	 * @since 1.0
	 */
	public function footer_scripts() {
		if( $this->uspaw_options['uspaw_popup_place'] == 'right-bottom' ){			
			wp_enqueue_script( $this->plugin_name . '-right-bottom-script', plugin_dir_url( __FILE__ ).'js/right_bottom.js', array('jquery'), $this->version );
		} elseif( $this->uspaw_options['uspaw_popup_place'] == 'left-bottom' ) {
			wp_enqueue_script( $this->plugin_name . '-left-bottom-script', plugin_dir_url( __FILE__ ).'js/left_bottom.js', array('jquery'), $this->version );
		} elseif( $this->uspaw_options['uspaw_popup_place'] == 'left' ) {
			wp_enqueue_script( $this->plugin_name . '-left-script', plugin_dir_url( __FILE__ ).'js/left.js', array('jquery'), $this->version );
		} elseif( $this->uspaw_options['uspaw_popup_place'] == 'right' ) {
			wp_enqueue_script( $this->plugin_name . '-right-script', plugin_dir_url( __FILE__ ).'js/right.js', array('jquery'), $this->version );
		} elseif( $this->uspaw_options['uspaw_popup_place'] == 'top-left' ) {
			wp_enqueue_script( $this->plugin_name . '-top-left-script', plugin_dir_url( __FILE__ ).'js/top_left.js', array('jquery'), $this->version );
		} elseif( $this->uspaw_options['uspaw_popup_place'] == 'top-right' ) {
			wp_enqueue_script( $this->plugin_name . '-top-right-script', plugin_dir_url( __FILE__ ).'js/top_right.js', array('jquery'), $this->version );
		} else {
			wp_enqueue_script( $this->plugin_name . '-right-bottom-script', plugin_dir_url( __FILE__ ).'js/right_bottom.js', array('jquery'), $this->version );
		}
	}

	/**
	 * Register the shortcode for the public-facing side of the site.
	 *
	 * @since    1.0.1
	 */
	public function register_uspaw_shortcode() {
		add_shortcode('uspaw_social_share', array($this, 'uspaw_social_share_shortcode'));
	}

	/**
	 * Added shorcode for the public-facing side of the site.
	 *
	 * @since    1.0.1
	 */
	public function uspaw_social_share_shortcode() {
		wp_enqueue_style( $this->plugin_name . 'social-share-style', plugins_url( 'css/uspw-social-share.css', __FILE__ ), array(), $this->version );
		require(dirname(__FILE__) . '/partials/uspaw-social-share-display.php');
	}
}