<?php
/**
 * Functions to register client-side assets (scripts and stylesheets) for the
 * Gutenberg block.
 *
 * @package anker-connect
 */

/**
 * Registers all block assets so that they can be enqueued through Gutenberg in
 * the corresponding context.
 *
 * @see https://wordpress.org/gutenberg/handbook/blocks/writing-your-first-block-type/#enqueuing-block-scripts
 */
function wls_map_block_init() {
	// Skip block registration if Gutenberg is not enabled/merged.
	if ( ! function_exists( 'register_block_type' ) ) {
		return;
	}
	$dir = dirname( __FILE__ );

	$index_js = 'wls-map/index.js';
	wp_register_script(
		'wls-map-block-editor',
		plugins_url( $index_js, __FILE__ ),
		array(
			'wp-editor',
			'wp-blocks',
			'wp-i18n',
			'wp-element',
		),
		filemtime( "$dir/$index_js" )
	);

	$editor_css = 'wls-map/editor.css';
	wp_register_style(
		'wls-map-block-editor',
		plugins_url( $editor_css, __FILE__ ),
		array(),
		filemtime( "$dir/$editor_css" )
	);

	$style_css = 'wls-map/style.css';
	wp_register_style(
		'wls-map-block',
		plugins_url( $style_css, __FILE__ ),
		array(),
		filemtime( "$dir/$style_css" )
	);

	register_block_type( 'anker-connect/wls-map', array(
		'editor_script' => 'wls-map-block-editor',
		'editor_style'  => 'wls-map-block-editor',
		'style'         => 'wls-map-block',
	) );
}
add_action( 'init', 'wls_map_block_init' );
