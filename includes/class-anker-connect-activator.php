<?php

/**
 * Fired during plugin activation
 *
 * @link       https://www.5-anker.com
 * @since      1.0.0
 *
 * @package    Anker_Connect
 * @subpackage Anker_Connect/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Anker_Connect
 * @subpackage Anker_Connect/includes
 * @author     Jonas Imping <j.imping@5-anker.com>
 */
class Anker_Connect_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		$defaults = [
			'private_token' => '',
			'public_token'  => '',
			'config'        => '{}',
			'basements_uri' => 'marina',
			'boats_uri'     => 'yacht',
			'import'        => false,
			'index'         => false,
			'notepad'       => false
		];

		if ( ! $options = get_option( 'connect_options' ) ) {
			add_option( 'connect_options', serialize( $defaults ) );
		} else {
			update_option( 'connect_options', serialize( array_merge( $defaults, $options ) ) );
		}

		flush_rewrite_rules();
	}

}
