<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.itpathsolutions.com/
 * @since             1.0.0
 * @package           Ultimate_Sticky_Popup_And_Widgets
 *
 * @wordpress-plugin
 * Plugin Name:       Ultimate Sticky Popup & Widgets
 * Plugin URI:        https://wordpress.org/plugins/ultimate-sticky-popup-and-widgets/
 * Description:       Ultimate Sticky Popup & Widgets is a simple, easy and fully-customizable WordPress plugin used to add popup on fixed position like bottom left, bottom right, left side or right side , top left side & top right side with User friendly Settings.
 * Version:           1.0.3
 * Author:            IT Path Solutions
 * Author URI:        https://www.itpathsolutions.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       ultimate-sticky-popup-and-widgets
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'ULTIMATE_STICKY_POPUP_AND_WIDGETS_VERSION', '1.0.3' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-ultimate-sticky-popup-and-widgets-activator.php
 */
function activate_ultimate_sticky_popup_and_widgets() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-ultimate-sticky-popup-and-widgets-activator.php';
	Ultimate_Sticky_Popup_And_Widgets_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-ultimate-sticky-popup-and-widgets-deactivator.php
 */
function deactivate_ultimate_sticky_popup_and_widgets() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-ultimate-sticky-popup-and-widgets-deactivator.php';
	Ultimate_Sticky_Popup_And_Widgets_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_ultimate_sticky_popup_and_widgets' );
register_deactivation_hook( __FILE__, 'deactivate_ultimate_sticky_popup_and_widgets' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-ultimate-sticky-popup-and-widgets.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_ultimate_sticky_popup_and_widgets() {

	$plugin = new Ultimate_Sticky_Popup_And_Widgets();
	$plugin->run();

}
run_ultimate_sticky_popup_and_widgets();