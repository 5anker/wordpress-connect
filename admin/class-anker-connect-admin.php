<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.5-anker.com
 * @since      1.0.0
 *
 * @package    Anker_Connect
 * @subpackage Anker_Connect/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Anker_Connect
 * @subpackage Anker_Connect/admin
 * @author     Jonas Imping <j.imping@5-anker.com>
 */
class Anker_Connect_Admin {

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
	 * The options of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $anker_connect_options The options of this plugin.
	 */
	private $anker_connect_options;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @param string $plugin_name The name of this plugin.
	 * @param string $version The version of this plugin.
	 *
	 * @since    1.0.0
	 */
	public function __construct( $plugin_name, $version ) {
		$this->plugin_name = $plugin_name;
		$this->version     = $version;
	}

	/**
	 * Register the stylesheets for the admin area.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/anker-connect-admin.css', [], $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the admin area.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/anker-connect-admin.js', [ 'jquery' ], $this->version, false );
	}

	/** Settings Panel */

	/*
	 * Retrieve this value with:
	 * $anker_connect_options = get_option( 'anker_connect_option_name' ); // Array of All Options
	 * $public_token = $anker_connect_options['public_token']; // Public Token
	 * $private_token = $anker_connect_options['private_token']; // Private Token
	 * $import = $anker_connect_options['import']; // Import Data
	 * $settings_3 = $anker_connect_options['settings_3']; // Settings
	 */

	public function anker_connect_add_plugin_page() {
		add_options_page(
			__( '5 Anker Connect', 'anker-connect' ), // page_title
			__( '5 Anker Connect', 'anker-connect' ), // menu_title
			'manage_options', // capability
			'anker-connect', // menu_slug
			[ $this, 'anker_connect_create_admin_page' ] // function
		);
	}

	public function anker_connect_create_admin_page() {
		$this->anker_connect_options = get_option( 'anker_connect_option_name' ); ?>

        <div class="wrap">
            <h2><?= __( '5 Anker Connect', 'anker-connect' ) ?></h2>
            <p></p>
			<?php settings_errors(); ?>

            <form method="post" action="options.php">
				<?php
				settings_fields( 'anker_connect_option_group' );
				do_settings_sections( 'anker-connect-admin' );
				submit_button();
				?>
            </form>
        </div>
	<?php }

	public function anker_connect_page_init() {
		register_setting(
			'anker_connect_option_group', // option_group
			'anker_connect_option_name', // option_name
			[ $this, 'anker_connect_sanitize' ] // sanitize_callback
		);

		add_settings_section(
			'anker_connect_setting_section', // id
			__( 'General', 'anker-connect' ), // title
			[ $this, 'anker_connect_section_info' ], // callback
			'anker-connect-admin' // page
		);

		add_settings_field(
			'public_token', // id
			__( 'Public Token', 'anker-connect' ), // title
			[ $this, 'public_token_callback' ], // callback
			'anker-connect-admin', // page
			'anker_connect_setting_section' // section
		);

		add_settings_field(
			'private_token', // id
			__( 'Private Token', 'anker-connect' ), // title
			[ $this, 'private_token_callback' ], // callback
			'anker-connect-admin', // page
			'anker_connect_setting_section' // section
		);

		add_settings_field(
			'import', // id
			__( 'Activate import', 'anker-connect' ), // title
			[ $this, 'activate_import_callback' ], // callback
			'anker-connect-admin', // page
			'anker_connect_setting_section' // section
		);

		add_settings_field(
			'index', // id
			__( 'Index boats and basements', 'anker-connect' ), // title
			[ $this, 'index_callback' ], // callback
			'anker-connect-admin', // page
			'anker_connect_setting_section' // section
		);

		add_settings_field(
			'notepad', // id
			__( 'Activate notepad', 'anker-connect' ), // title
			[ $this, 'notepad_callback' ], // callback
			'anker-connect-admin', // page
			'anker_connect_setting_section' // section
		);

		add_settings_field(
			'config', // id
			__( 'Additional configuration', 'anker-connect' ), // title
			[ $this, 'config_callback' ], // callback
			'anker-connect-admin', // page
			'anker_connect_setting_section' // section
		);

		// If Import

		add_settings_section(
			'anker_connect_url_section', // id
			'URL', // title
			[ $this, 'anker_connect_section_info' ], // callback
			'anker-connect-admin' // page
		);

		add_settings_field(
			'boats_uri', // id
			__( 'Boats URI', 'anker-connect' ), // title
			[ $this, 'boats_uri_callback' ], // callback
			'anker-connect-admin', // page
			'anker_connect_url_section' // section
		);

		add_settings_field(
			'basements_uri', // id
			__( 'Basements URI', 'anker-connect' ), // title
			[ $this, 'basements_uri_callback' ], // callback
			'anker-connect-admin', // page
			'anker_connect_url_section' // section
		);

		add_settings_section(
			'anker_connect_other_section', // id
			__( 'Other', 'anker-connect' ), // title
			[ $this, 'anker_connect_section_info' ], // callback
			'anker-connect-admin' // page
		);

		add_settings_field(
			'boats_uri', // id
			__( 'Boats URI', 'anker-connect' ), // title
			[ $this, 'boats_uri_callback' ], // callback
			'anker-connect-admin', // page
			'anker_connect_other_section' // section
		);

		add_settings_field(
			'basements_uri', // id
			__( 'Basements URI', 'anker-connect' ), // title
			[ $this, 'basements_uri_callback' ], // callback
			'anker-connect-admin', // page
			'anker_connect_other_section' // section
		);
	}

	public function anker_connect_sanitize( $input ) {
		$sanitary_values = [];
		if ( isset( $input['public_token'] ) ) {
			$sanitary_values['public_token'] = sanitize_text_field( $input['public_token'] );
		}

		if ( isset( $input['private_token'] ) ) {
			$sanitary_values['private_token'] = sanitize_text_field( $input['private_token'] );
		}

		if ( isset( $input['import'] ) ) {
			$sanitary_values['import'] = $input['import'];
		}

		if ( isset( $input['index'] ) ) {
			$sanitary_values['index'] = $input['index'];
		}

		if ( isset( $input['notepad'] ) ) {
			$sanitary_values['notepad'] = $input['notepad'];
		}

		if ( isset( $input['config'] ) ) {
			$sanitary_values['config'] = esc_textarea( $input['config'] );
		}


		if ( isset( $input['basements_uri'] ) ) {
			$sanitary_values['basements_uri'] = sanitize_text_field( $input['basements_uri'] );
		}

		if ( isset( $input['boats_uri'] ) ) {
			$sanitary_values['boats_uri'] = sanitize_text_field( $input['boats_uri'] );
		}

		return $sanitary_values;
	}

	public function anker_connect_section_info() {
	}

	public function public_token_callback() {
		printf(
			'<input class="regular-text" type="text" name="anker_connect_option_name[public_token]" id="public_token" value="%s">',
			isset( $this->anker_connect_options['public_token'] ) ? esc_attr( $this->anker_connect_options['public_token'] ) : ''
		);
	}

	public function private_token_callback() {
		printf(
			'<input class="regular-text" type="text" name="anker_connect_option_name[private_token]" id="private_token" value="%s">',
			isset( $this->anker_connect_options['private_token'] ) ? esc_attr( $this->anker_connect_options['private_token'] ) : ''
		);
	}

	public function activate_import_callback() {
		printf(
			'<input type="checkbox" name="anker_connect_option_name[import]" id="import" value="import" %s>',
			( isset( $this->anker_connect_options['import'] ) && $this->anker_connect_options['import'] === 'import' ) ? 'checked' : ''
		);
	}

	public function index_callback() {
		printf(
			'<input type="checkbox" name="anker_connect_option_name[index]" id="index" value="index" %s>',
			( isset( $this->anker_connect_options['index'] ) && $this->anker_connect_options['index'] === 'index' ) ? 'checked' : ''
		);
	}

	public function notepad_callback() {
		printf(
			'<input type="checkbox" name="anker_connect_option_name[notepad]" id="index" value="notepad" %s>',
			( isset( $this->anker_connect_options['notepad'] ) && $this->anker_connect_options['notepad'] === 'notepad' ) ? 'checked' : ''
		);
	}

	public function config_callback() {
		printf(
			'<textarea class="large-text" rows="5" name="anker_connect_option_name[settings_3]" id="settings_3">%s</textarea>',
			isset( $this->anker_connect_options['settings_3'] ) ? esc_attr( $this->anker_connect_options['settings_3'] ) : ''
		);
	}

	public function boats_uri_callback() {
		printf(
			'<input class="regular-text" type="text" name="anker_connect_option_name[boats_uri]" id="boats_uri" value="%s">',
			isset( $this->anker_connect_options['boats_uri'] ) ? esc_attr( $this->anker_connect_options['boats_uri'] ) : ''
		);
	}

	public function basements_uri_callback() {
		printf(
			'<input class="regular-text" type="text" name="anker_connect_option_name[basements_uri]" id="basements_uri" value="%s">',
			isset( $this->anker_connect_options['basements_uri'] ) ? esc_attr( $this->anker_connect_options['basements_uri'] ) : ''
		);
	}


}
