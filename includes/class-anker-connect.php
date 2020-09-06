<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://www.5-anker.com
 * @since      1.0.0
 *
 * @package    Anker_Connect
 * @subpackage Anker_Connect/includes
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
 * @package    Anker_Connect
 * @subpackage Anker_Connect/includes
 * @author     Jonas Imping <j.imping@5-anker.com>
 */
class Anker_Connect {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Anker_Connect_Loader $loader Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string $plugin_name The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string $version The current version of the plugin.
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
		if ( defined( 'ANKER_CONNECT_VERSION' ) ) {
			$this->version = ANKER_CONNECT_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'anker-connect';

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
	 * - Anker_Connect_Loader. Orchestrates the hooks of the plugin.
	 * - Anker_Connect_i18n. Defines internationalization functionality.
	 * - Anker_Connect_Admin. Defines all hooks for the admin area.
	 * - Anker_Connect_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {
		/**
		 * The class responsible for managing the settings of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/titan-framework/titan-framework-embedder.php';

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-anker-connect-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-anker-connect-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-anker-connect-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-anker-connect-public.php';

		/** Custom Stuff loader */

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/custom/rest.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/custom/cron.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/custom/post-types.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/custom/columns.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/custom/templates.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/custom/settings.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/custom/widgets.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/custom/blocks.php';

		$this->loader = new Anker_Connect_Loader();
	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Anker_Connect_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {
		$plugin_i18n = new Anker_Connect_i18n();

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
		$plugin_admin = new Anker_Connect_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {
		$plugin_public = new Anker_Connect_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_head', $plugin_public, 'enqueue_head_config' );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
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
	 * @return    string    The name of the plugin.
	 * @since     1.0.0
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @return    Anker_Connect_Loader    Orchestrates the hooks of the plugin.
	 * @since     1.0.0
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @return    string    The version number of the plugin.
	 * @since     1.0.0
	 */
	public function get_version() {
		return $this->version;
	}

	/**
	 * Retrieve Plugin Options
	 *
	 * @return    object   The Options
	 * @since     1.0.0
	 */
	public static function getOptions() {
		$settings = array_merge( [
			'private_token' => '',
			'public_token'  => '',
			'config'        => '{}',
			'basements_uri' => 'marina',
			'boats_uri'     => 'yacht',
			'import'        => false,
			'index'         => false,
			'notepad'       => false,
		], (array) unserialize( get_option( 'connect_options' ) ) );

		return (object) $settings;
	}

}
