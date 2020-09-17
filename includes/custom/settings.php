<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'tf_create_options', 'anker_load_settings' );

add_action( 'wp_ajax_reset_connect_import_status', 'reset_connect_import_status' );
add_action( 'wp_ajax_anker_truncate_data', 'anker_truncate_data' );
add_action( 'wp_ajax_anker_import_all_immediately', 'anker_import_all_immediately' );

function reset_connect_import_status() {
	delete_option( 'last_boat_import' );
	delete_option( 'last_boat_import_page' );
	delete_option( 'last_basement_import' );
	delete_option( 'last_basement_import_page' );

	wp_send_json_success( __( 'Action succeeded!', 'anker-connect' ) );
}

function anker_delete_custom_posts( $post_type = 'boat' ) {
	$posts = get_posts( array( 'post_type' => $post_type, 'numberposts' => - 1 ) );

	foreach ( $posts as $post ) {
		wp_delete_post( $post->ID, true );
	}
}

function anker_truncate_data() {
	anker_delete_custom_posts( 'boat' );
	anker_delete_custom_posts( 'basement' );
	delete_option( 'last_boat_import' );
	delete_option( 'last_boat_import_page' );
	delete_option( 'last_basement_import' );
	delete_option( 'last_basement_import_page' );

	wp_send_json_success( __( 'Action succeeded!', 'anker-connect' ) );
}

function anker_import_all_immediately() {
	anker_schedule_hook_boats( 10000 );
	anker_schedule_hook_basements( 10000 );

	wp_send_json_success( __( 'Action succeeded!', 'anker-connect' ) );
}

function anker_load_settings() {
	$settings = Anker_Connect::getOptions();

	$titan = \TitanFramework::getInstance( 'connect' );
	$panel = $titan->createContainer( [
		'id'     => '5anker-connect',
		'type'   => 'admin-page',
		'parent' => 'options-general.php',
		'name'   => __( '5 Anker Connect', 'anker-connect' ),
	] );

	$general = $panel->createTab( [
		'name' => __( 'General', 'anker-connect' ),
	] );

	$general->createOption( [
		'name' => __( 'Public Token', 'anker-connect' ),
		'id'   => 'public_token',
		'type' => 'text',
	] );

	$general->createOption( [
		'name' => __( 'Private Token', 'anker-connect' ),
		'id'   => 'private_token',
		'type' => 'text',
	] );

	$general->createOption( [
		'name'    => __( 'Activate import', 'anker-connect' ),
		'id'      => 'import',
		'type'    => 'checkbox',
		'default' => false,
	] );

	if ( $settings->import ) {
		$general->createOption( [
			'name'    => __( 'Index boats and basements', 'anker-connect' ),
			'id'      => 'index',
			'type'    => 'checkbox',
			'default' => false,
		] );
	}

	$general->createOption( [
		'name'    => __( 'Activate notepad', 'anker-connect' ),
		'id'      => 'notepad',
		'type'    => 'checkbox',
		'default' => false,
	] );

	$general->createOption( [
		'name'    => __( 'Additional configuration', 'anker-connect' ),
		'id'      => 'config',
		'type'    => 'code',
		'lang'    => 'json',
		'default' => '{}',
		'is_code' => true,
	] );

	$general->createOption( [
		'type'      => 'save',
		'use_reset' => false,
	] );

	if ( $settings->import ) {
		$url = $panel->createTab( [
			'name' => __( 'URL', 'anker-connect' ),
		] );

		$url->createOption( [
			'name'    => __( 'Boats URI', 'anker-connect' ),
			'id'      => 'boats_uri',
			'type'    => 'text',
			'default' => 'yacht',
		] );

		$url->createOption( [
			'name'    => __( 'Basements URI', 'anker-connect' ),
			'id'      => 'basements_uri',
			'type'    => 'text',
			'default' => 'marina',
		] );

		$url->createOption( [
			'type'      => 'save',
			'use_reset' => false,
		] );

		$other = $panel->createTab( [
			'name' => __( 'Other', 'anker-connect' ),
		] );


		$other->createOption( [
			'name'             => __( 'Reset Import Status', 'anker-connect' ),
			'type'             => 'ajax-button',
			'action'           => 'reset_connect_import_status',
			'label'            => __( 'Reset Import Status', 'anker-connect' ),
			'success_callback' => 'ajax_success_refresh',
		] );

		$other->createOption( [
			'name'             => __( 'Truncate All 5 Anker Data', 'anker-connect' ),
			'type'             => 'ajax-button',
			'action'           => 'anker_truncate_data',
			'label'            => __( 'Truncate All 5 Anker Data', 'anker-connect' ),
			'success_callback' => 'ajax_success_refresh',
		] );

		$other->createOption( [
			'name'             => __( 'Import all immediately', 'anker-connect' ),
			'type'             => 'ajax-button',
			'action'           => 'anker_import_all_immediately',
			'label'            => __( 'Import all immediately', 'anker-connect' ),
			'success_callback' => 'ajax_success_refresh',
		] );
	}
}
