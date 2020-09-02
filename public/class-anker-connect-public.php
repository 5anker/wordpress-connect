<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://www.5-anker.com
 * @since      1.0.0
 *
 * @package    Anker_Connect
 * @subpackage Anker_Connect/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Anker_Connect
 * @subpackage Anker_Connect/public
 * @author     Jonas Imping <j.imping@5-anker.com>
 */
class Anker_Connect_Public
{

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string $plugin_name The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string $version The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @param string $plugin_name The name of the plugin.
     * @param string $version The version of this plugin.
     * @since    1.0.0
     */
    public function __construct($plugin_name, $version)
    {

        $this->plugin_name = $plugin_name;
        $this->version = $version;

    }

    /**
     * Register the stylesheets for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_styles()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Anker_Connect_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Anker_Connect_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/anker-connect-public.css', array(), $this->version, 'all');

    }

    /**
     * Register the JavaScript for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Anker_Connect_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Anker_Connect_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/anker-connect-public.js', array('jquery'), $this->version, false);
        wp_enqueue_script($this->plugin_name . 'widget-wls', 'https://wls.5-anker.com/app.js?v=' . date('y.n.j.G'), null, null, true);

    }

    public function enqueue_head_config()
    {
        $settings = (object)unserialize(get_option('connect_options'));
        $defaults = [
            'token' => $settings->public_token,
            'redirects' => [],
            'settings' => [],
        ];

        if ($settings->import) {
            $defaults['redirects']['boat'] = "/{$settings->boats_uri}/{slug}";
            $defaults['redirects']['booking'] = "/{$settings->boats_uri}/{slug}";
            $defaults['redirects']['marina'] = "/{$settings->basements_uri}/{slug}";
        }

        if ($settings->notepad) {
            $defaults['settings']['notepad'] = true;
        }

        $conf = json_decode(preg_replace('/\\\"/', "\"", $settings->config), true);

        if ($conf === null && json_last_error() !== JSON_ERROR_NONE) {
            $config = $defaults;
        } else {
            $config = array_merge($defaults, $conf);
        }

        echo '<script type="text/javascript">window.connect = ' . json_encode($config) . '</script>';
    }

}
