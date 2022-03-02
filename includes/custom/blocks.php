<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function connect_gutenberg_blocks( $categories ) {
    return array_merge(
        $categories,
        [
            [
                'slug'  => 'anker-connect',
                'title' => __( '5 Anker Connect Blocks', '5-anker-connect' ),
            ],
        ]
    );
}

if ( version_compare( $GLOBALS['wp_version'], '5.8-alpha-1', '<' ) ) {
    add_filter( 'block_categories', 'connect_gutenberg_blocks', 10, 2 );
} else {
    add_filter( 'block_categories_all', 'connect_gutenberg_blocks', 10, 2 );
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
