<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'init', function () {
	foreach ( glob( plugin_dir_path( dirname( __FILE__ ) ) . '../lib/blocks/*.php' ) as $filename ) {
		$path = plugin_dir_path( dirname( __FILE__ ) ) . '../languages/';
		wp_set_script_translations( substr( basename( $filename ), 0, - 4 ) . '-block-editor', '5-anker-connect', $path );
	}
} );

foreach ( glob( plugin_dir_path( dirname( __FILE__ ) ) . '../lib/blocks/*.php' ) as $filename ) {
	require_once( $filename );
}
