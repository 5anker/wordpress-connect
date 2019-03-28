<?php
/*
 Plugin Name: 5 Anker Connect
 Plugin URI: https://www.5-anker.com
 Description: This Plugin inserts the WLS Widgets and imports all boat and destination data.
 Version: 3.2.2
 Author: 5 Anker GmbH
 Author URI: https://www.5-anker.com
 Text Domain: 5anker
 GitHub Plugin URI: https://github.com/5anker/5anker-connect-wp
 */

if (! defined('ABSPATH')) {
	exit;
}

define("CONNECT_PLUGIN_PATH", plugin_dir_path(__FILE__));
define("CONNECT_INCLUDES_PATH", plugin_dir_path(__FILE__) . 'inc');
define("CONNECT_LANG_PATH", basename(plugin_dir_path(__FILE__)) . '/lang/');

load_plugin_textdomain('5anker', false, CONNECT_LANG_PATH);

require_once(CONNECT_PLUGIN_PATH . '/titan-framework/titan-framework-embedder.php');
require_once(CONNECT_INCLUDES_PATH . '/setup.php');
require_once(CONNECT_INCLUDES_PATH . '/rest.php');
require_once(CONNECT_INCLUDES_PATH . '/cron.php');
require_once(CONNECT_INCLUDES_PATH . '/post-types.php');
require_once(CONNECT_INCLUDES_PATH . '/columns.php');
require_once(CONNECT_INCLUDES_PATH . '/templates.php');
require_once(CONNECT_INCLUDES_PATH . '/scripts.php');
require_once(CONNECT_INCLUDES_PATH . '/settings.php');

require_once(CONNECT_INCLUDES_PATH . '/widgets.php');
require_once(CONNECT_INCLUDES_PATH . '/blocks.php');

register_activation_hook(__FILE__, 'anker_plugin_activate');
add_action('admin_init', 'anker_plugin_redirect');
