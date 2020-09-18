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

	public function reset_import_status() {
		delete_option( 'last_boat_import' );
		delete_option( 'last_boat_import_page' );
		delete_option( 'last_basement_import' );
		delete_option( 'last_basement_import_page' );
	}

	public function delete_custom_posts( $post_type = 'boat' ) {
		$posts = get_posts( array( 'post_type' => $post_type, 'numberposts' => - 1 ) );

		foreach ( $posts as $post ) {
			wp_delete_post( $post->ID, true );
		}
	}

	public function truncate_data() {
		$this->delete_custom_posts( 'boat' );
		$this->delete_custom_posts( 'basement' );
		$this->reset_import_status();
	}

	public function import_all_immediately() {
		anker_connect_schedule_hook_boats( 10000 );
		anker_connect_schedule_hook_basements( 10000 );
	}

	/** Settings Panel */

	public function anker_connect_add_plugin_page() {
		$this->anker_connect_options = get_option( 'connect_options' );

		add_options_page(
			__( '5 Anker Connect', 'anker-connect' ), // page_title
			__( '5 Anker Connect', 'anker-connect' ), // menu_title
			'manage_options', // capability
			'anker-connect', // menu_slug
			[ $this, 'anker_connect_create_admin_page' ] // function
		);
	}

	public function anker_connect_create_admin_page() {
		?>

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

            <form method="post" action="options.php">
				<?php
				settings_fields( 'anker_connect_option_group2' );
				do_settings_sections( 'anker-connect-admin2' );
				submit_button( __( 'Reset Import Status', 'anker-connect' ), 'secondary', 'reset_import_status', false );
				submit_button( __( 'Truncate All 5 Anker Data', 'anker-connect' ), 'secondary', 'truncate_data', false );
				submit_button( __( 'Import all immediately', 'anker-connect' ), 'secondary', 'import_all_immediately', false );
				?>
            </form>
        </div>
	<?php }

	public function anker_connect_page_init() {
		register_setting(
			'anker_connect_option_group', // option_group
			'connect_options', // option_name
			[ $this, 'anker_connect_sanitize' ] // sanitize_callback
		);


		register_setting(
			'anker_connect_option_group2', // option_group
			'connect_options_actions', // option_name
			[ $this, 'anker_connect_sanitize_actions' ] // sanitize_callback
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

		if ( ( $this->anker_connect_options['import'] ?? null ) === true ) {
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
		}

		add_settings_field(
			'config', // id
			__( 'Additional configuration', 'anker-connect' ), // title
			[ $this, 'config_callback' ], // callback
			'anker-connect-admin', // page
			'anker_connect_setting_section' // section
		);

		if ( ( $this->anker_connect_options['import'] ?? null ) === true ) {

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
				'anker-connect-admin2' // page
			);
		}
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
			$sanitary_values['import'] = (bool) $input['import'];
		}

		if ( isset( $input['index'] ) ) {
			$sanitary_values['index'] = (bool) $input['index'];
		}

		if ( isset( $input['notepad'] ) ) {
			$sanitary_values['notepad'] = (bool) $input['notepad'];
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

	public function anker_connect_sanitize_actions( $input ) {
		if ( isset( $_POST['import_all_immediately'] ) ) {
			$this->import_all_immediately();
		}

		if ( isset( $_POST['truncate_data'] ) ) {
			$this->truncate_data();
		}

		if ( isset( $_POST['reset_import_status'] ) ) {
			$this->reset_import_status();
		}

		return null;
	}

	public function anker_connect_section_info() {
	}

	public function public_token_callback() {
		printf(
			'<input class="regular-text" type="text" name="connect_options[public_token]" id="public_token" value="%s">',
			isset( $this->anker_connect_options['public_token'] ) ? esc_attr( $this->anker_connect_options['public_token'] ) : ''
		);
	}

	public function private_token_callback() {
		printf(
			'<input class="regular-text" type="text" name="connect_options[private_token]" id="private_token" value="%s">',
			isset( $this->anker_connect_options['private_token'] ) ? esc_attr( $this->anker_connect_options['private_token'] ) : ''
		);
	}

	public function activate_import_callback() {
		printf(
			'<input type="checkbox" name="connect_options[import]" id="import" value="true" %s>',
			( isset( $this->anker_connect_options['import'] ) && $this->anker_connect_options['import'] === true ) ? 'checked' : ''
		);
	}

	public function index_callback() {
		printf(
			'<input type="checkbox" name="connect_options[index]" id="index" value="true" %s>',
			( isset( $this->anker_connect_options['index'] ) && $this->anker_connect_options['index'] === true ) ? 'checked' : ''
		);
	}

	public function notepad_callback() {
		printf(
			'<input type="checkbox" name="connect_options[notepad]" id="notepad" value="true" %s>',
			( isset( $this->anker_connect_options['notepad'] ) && $this->anker_connect_options['notepad'] === true ) ? 'checked' : ''
		);
	}

	public function config_callback() {
		printf(
			'<textarea class="large-text" rows="5" name="connect_options[config]" id="config">%s</textarea>',
			isset( $this->anker_connect_options['config'] ) ? esc_attr( $this->anker_connect_options['config'] ) : ''
		);
	}

	public function boats_uri_callback() {
		printf(
			'<input class="regular-text" type="text" name="connect_options[boats_uri]" id="boats_uri" value="%s">',
			isset( $this->anker_connect_options['boats_uri'] ) ? esc_attr( $this->anker_connect_options['boats_uri'] ) : ''
		);
	}

	public function basements_uri_callback() {
		printf(
			'<input class="regular-text" type="text" name="connect_options[basements_uri]" id="basements_uri" value="%s">',
			isset( $this->anker_connect_options['basements_uri'] ) ? esc_attr( $this->anker_connect_options['basements_uri'] ) : ''
		);
	}


}
