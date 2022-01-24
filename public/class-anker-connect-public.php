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
 * @package    5_Anker_Connect
 * @subpackage 5_Anker_Connect/public
 * @author     Jonas Imping <j.imping@5-anker.com>
 */
class Anker_Connect_Public {

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
	 *
	 * @since    1.0.0
	 */
	public function __construct( $plugin_name, $version ) {
		$this->plugin_name = $plugin_name;
		$this->version     = $version;
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
		 * defined in Anker_Connect_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Anker_Connect_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		// wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/anker-connect-public.css', [], $this->version, 'all' );
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
		 * defined in Anker_Connect_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Anker_Connect_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		$date   = date( 'y.n.j.G' );
		$module = Anker_Connect::getOptions()->module;

		// wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/anker-connect-public.js', [ 'jquery' ], $this->version, false );
		wp_enqueue_script( $this->plugin_name . '-wls', "https://wls.5-anker.com/{$module}/app.js?v={$date}", null, null, true );
	}

	/**
	 * Adds shortcodes to frontend
	 */
	public function add_shortcodes() {
		$plugins = [
			'wls_boat'               => 'Boat',
			'wls_boats'              => 'Boats',
			'wls_boats_grid'         => 'BoatsGrid',
			'wls_boats_slider'       => 'BoatsSlider',
			'wls_search'             => 'Search',
			'wls_search_day'         => 'SearchDay',
			'wls_search_watercamper' => 'SearchWaterCamper',
			'wls_cruise_slider'      => 'CruiseSlider',
			'wls_search_form'        => 'SearchForm',
			'wls_newsletter'         => 'Newsletter',
			'wls_contact_form'       => 'ContactForm',
			'wls_boat_book_calendar' => 'BoatBookCalendar',
			'wls_marinas'            => 'Marinas',
			'wls_marina'             => 'Marina',
			'wls_map'                => 'Map',
			'wls_notepad'            => 'Notepad',
			'wls_planbar_login'      => 'PlanbarLogin',
		];


		foreach ( $plugins as $plugin => $name ) {
			$nn = str_replace( '_', '-', $plugin );

			add_shortcode( $nn, function ( $atts ) use ( $nn ) {
				$atts = (array) $atts;
				//Use & for modify current item in array
				array_walk( $atts, function ( &$item, $key ) {
					$item = $key . '="' . $item . '"';
				} );

				return sprintf( '<%s %s></%s>', $nn, implode( ' ', $atts ), $nn );
			} );
		}
	}

	/**
	 *
	 */
	public function enqueue_head_config() {
		$settings = Anker_Connect::getOptions();
		$defaults = [
			'api'       => $settings->endpoint ?: 'https://connect.5-anker.com/dnet/com/',
			'token'     => $settings->public_token,
			'redirects' => [],
			'settings'  => [],
		];

		if ( $settings->import ) {
			$defaults['redirects']['boat']    = "/{$settings->boats_uri}/{slug}";
			$defaults['redirects']['booking'] = "/{$settings->boats_uri}/{slug}";
			$defaults['redirects']['marina']  = "/{$settings->basements_uri}/{slug}";
		}

		if ( $settings->notepad ) {
			$defaults['settings']['notepad'] = true;
		}

		$conf = json_decode( preg_replace( '/\\\"/', "\"", $settings->config ), true );

		if ( $conf === null && json_last_error() !== JSON_ERROR_NONE ) {
			$config = $defaults;
		} else {
			$config = array_merge( $defaults, $conf );
		}

		echo '<script type="text/javascript">window.connect = ' . json_encode( $config ) . '</script>';
	}

}
