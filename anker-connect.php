<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.5-anker.com
 * @since             1.0.0
 * @package           5_Anker_Connect
 *
 * @wordpress-plugin
 * Plugin Name:       5 Anker Connect
 * Description:       Plugin to integrate the White Label Solution of 5 Anker Connect into your WordPress Website.
 * Version:           1.1.6
 * Author:            5 Anker GmbH
 * Author URI:        https://www.5-anker.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       5-anker-connect
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
define( 'ANKER_CONNECT_VERSION', '1.1.6' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-anker-connect-activator.php
 */
function activate_anker_connect() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-anker-connect-activator.php';
	Anker_Connect_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-anker-connect-deactivator.php
 */
function deactivate_anker_connect() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-anker-connect-deactivator.php';
	Anker_Connect_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_anker_connect' );
register_deactivation_hook( __FILE__, 'deactivate_anker_connect' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-anker-connect.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_anker_connect() {

	$plugin = new Anker_Connect();
	$plugin->run();

}
run_anker_connect();
