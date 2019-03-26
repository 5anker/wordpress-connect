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

load_plugin_textdomain('5anker', false, basename(dirname(__FILE__)) . '/lang');

require_once(dirname(__FILE__).'/titan-framework/titan-framework-embedder.php');
require_once(dirname(__FILE__).'/setup.php');
require_once(dirname(__FILE__).'/rest.php');
require_once(dirname(__FILE__).'/cron.php');
require_once(dirname(__FILE__).'/post-types.php');
require_once(dirname(__FILE__).'/columns.php');
require_once(dirname(__FILE__).'/templates.php');
require_once(dirname(__FILE__).'/scripts.php');
require_once(dirname(__FILE__).'/settings.php');
require_once(dirname(__FILE__).'/widgets.php');

register_activation_hook(__FILE__, 'anker_plugin_activate');
add_action('admin_init', 'anker_plugin_redirect');
