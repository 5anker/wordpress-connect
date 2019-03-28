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
function wls_cruise_slider_block_init() {
	// Skip block registration if Gutenberg is not enabled/merged.
	if ( ! function_exists( 'register_block_type' ) ) {
		return;
	}
	$dir = dirname( __FILE__ );

	$index_js = 'wls-cruise-slider/index.js';
	wp_register_script(
		'wls-cruise-slider-block-editor',
		plugins_url( $index_js, __FILE__ ),
		array(
			'wp-blocks',
			'wp-i18n',
			'wp-element',
		),
		filemtime( "$dir/$index_js" )
	);

	$editor_css = 'wls-cruise-slider/editor.css';
	wp_register_style(
		'wls-cruise-slider-block-editor',
		plugins_url( $editor_css, __FILE__ ),
		array(),
		filemtime( "$dir/$editor_css" )
	);

	$style_css = 'wls-cruise-slider/style.css';
	wp_register_style(
		'wls-cruise-slider-block',
		plugins_url( $style_css, __FILE__ ),
		array(),
		filemtime( "$dir/$style_css" )
	);

	register_block_type( 'anker-connect/wls-cruise-slider', array(
		'editor_script' => 'wls-cruise-slider-block-editor',
		'editor_style'  => 'wls-cruise-slider-block-editor',
		'style'         => 'wls-cruise-slider-block',
	) );
}
add_action( 'init', 'wls_cruise_slider_block_init' );
