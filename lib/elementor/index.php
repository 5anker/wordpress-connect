<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

final class Anker_Connect_Elementor_Extension {

	/**
	 * Plugin Version
	 *
	 * @since 1.0.0
	 *
	 * @var string The plugin version.
	 */
	const VERSION = '1.0.0';

	/**
	 * Minimum Elementor Version
	 *
	 * @since 1.0.0
	 *
	 * @var string Minimum Elementor version required to run the plugin.
	 */
	const MINIMUM_ELEMENTOR_VERSION = '2.0.0';

	/**
	 * Minimum PHP Version
	 *
	 * @since 1.0.0
	 *
	 * @var string Minimum PHP version required to run the plugin.
	 */
	const MINIMUM_PHP_VERSION = '7.0';

	/**
	 * Instance
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 * @static
	 *
	 * @var Anker_Connect_Elementor_Extension The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @return Anker_Connect_Elementor_Extension An instance of the class.
	 * @since 1.0.0
	 *
	 * @access public
	 * @static
	 *
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function __construct() {
		add_action( 'plugins_loaded', [ $this, 'init' ] );
	}

	/**
	 * Initialize the plugin
	 *
	 * Load the plugin only after Elementor (and other plugins) are loaded.
	 * Checks for basic plugin requirements, if one check fail don't continue,
	 * if all check have passed load the files required to run the plugin.
	 *
	 * Fired by `plugins_loaded` action hook.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function init() {
		// Check if Elementor installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );

			return;
		}

		// Check for required Elementor version
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );

			return;
		}

		// Check for required PHP version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );

			return;
		}

		// Add Plugin actions
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'init_widgets' ] );
		add_action( 'elementor/controls/controls_registered', [ $this, 'init_controls' ] );
		add_action( 'elementor/elements/categories_registered', [ $this, 'init_categories' ] );
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have Elementor installed or activated.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_missing_main_plugin() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
		/* translators: 1: Plugin name 2: Elementor */
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'elementor-test-extension' ),
			'<strong>' . esc_html__( '5 Anker Connect Elementor Extension', 'anker-connect' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'elementor-test-extension' ) . '</strong>'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required Elementor version.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_minimum_elementor_version() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
		/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'elementor-test-extension' ),
			'<strong>' . esc_html__( 'Elementor Test Extension', 'elementor-test-extension' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'elementor-test-extension' ) . '</strong>',
			self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required PHP version.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_minimum_php_version() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
		/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'elementor-test-extension' ),
			'<strong>' . esc_html__( 'Elementor Test Extension', 'elementor-test-extension' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'elementor-test-extension' ) . '</strong>',
			self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}

	/**
	 * Init Widgets
	 *
	 * Include widgets files and register them
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function init_widgets() {
		// Include Widget files

		$plugins = [
			'wls_boat'               => '\Anker_Connect_Elementor_Wls_Boat_Widget',
			'wls_boats'              => '\Anker_Connect_Elementor_Wls_Boats_Widget',
			'wls_boats_grid'         => '\Anker_Connect_Elementor_Wls_BoatsGrid_Widget',
			'wls_boats_slider'       => '\Anker_Connect_Elementor_Wls_BoatsSlider_Widget',
			'wls_search'             => '\Anker_Connect_Elementor_Wls_Search_Widget',
			'wls_search_day'         => '\Anker_Connect_Elementor_Wls_SearchDay_Widget',
			'wls_cruise_slider'      => '\Anker_Connect_Elementor_Wls_CruiseSlider_Widget',
			'wls_search_form'        => '\Anker_Connect_Elementor_Wls_SearchForm_Widget',
			'wls_newsletter'         => '\Anker_Connect_Elementor_Wls_Newsletter_Widget',
			'wls_contact_form'       => '\Anker_Connect_Elementor_Wls_ContactForm_Widget',
			'wls_boat_book_calendar' => '\Anker_Connect_Elementor_Wls_BoatBookCalendar_Widget',
			'wls_marinas'            => '\Anker_Connect_Elementor_Wls_Marinas_Widget',
			'wls_marina'             => '\Anker_Connect_Elementor_Wls_Marina_Widget',
			'wls_map'                => '\Anker_Connect_Elementor_Wls_Map_Widget',
			'wls_notepad'            => '\Anker_Connect_Elementor_Wls_Notepad_Widget',
			'wls_planbar_login'      => '\Anker_Connect_Elementor_Wls_PlanbarLogin_Widget',
		];

		foreach ( $plugins as $plugin => $pClass ) {
			require_once plugin_dir_path( dirname( __FILE__ ) ) . '../lib/elementor/' . $plugin . '.php';

			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new $pClass );
		}
	}

	/**
	 * Init Controls
	 *
	 * Include controls files and register them
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function init_controls() {
		// Include Control files
		// require_once( __DIR__ . '/controls/test-control.php' );

		// Register control
		// \Elementor\Plugin::$instance->controls_manager->register_control( 'control-type-', new \Test_Control() );
	}

	/**
	 * Init Categories
	 *
	 * Init Categories and register them
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function init_categories( $elements_manager ) {
		$elements_manager->add_category(
			'connect-wls',
			[
				'title' => __( 'Connect', 'anker-connect' ),
				'icon'  => 'fa fa-plug',
			]
		);
	}

}

Anker_Connect_Elementor_Extension::instance();
