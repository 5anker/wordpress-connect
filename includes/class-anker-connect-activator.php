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
 * @package    5_Anker_Connect
 * @subpackage 5_Anker_Connect/includes
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
			'module'        => 'charter',
			'endpoint'      => 'https://connect.5-anker.com/dnet/com/',
			'private_token' => '',
			'public_token'  => '',
			'config'        => '{"redirects":{"form":"/boot-mieten/","boat":"/yacht/{slug}/","booking":"/yacht/{slug}/?date_from={date_from}&date_to={date_to}&duration={duration}","marina":"/marina/{slug}/"}}',
			'basements_uri' => 'marina',
			'boats_uri'     => 'yacht',
			'import'        => false,
			'index'         => true,
			'notepad'       => false,
		];

		if ( ! $options = get_option( 'connect_options' ) ) {
			$options = [];
		}

		update_option( 'connect_options', array_merge( $defaults, $options ) );

		flush_rewrite_rules();
	}

}
