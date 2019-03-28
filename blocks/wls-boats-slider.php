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
function wls_boats_slider_block_init() {
	// Skip block registration if Gutenberg is not enabled/merged.
	if ( ! function_exists( 'register_block_type' ) ) {
		return;
	}
	$dir = dirname( __FILE__ );

	$index_js = 'wls-boats-slider/index.js';
	wp_register_script(
		'wls-boats-slider-block-editor',
		plugins_url( $index_js, __FILE__ ),
		array(
			'wp-blocks',
			'wp-i18n',
			'wp-element',
		),
		filemtime( "$dir/$index_js" )
	);

	$editor_css = 'wls-boats-slider/editor.css';
	wp_register_style(
		'wls-boats-slider-block-editor',
		plugins_url( $editor_css, __FILE__ ),
		array(),
		filemtime( "$dir/$editor_css" )
	);

	$style_css = 'wls-boats-slider/style.css';
	wp_register_style(
		'wls-boats-slider-block',
		plugins_url( $style_css, __FILE__ ),
		array(),
		filemtime( "$dir/$style_css" )
	);

	register_block_type( 'anker-connect/wls-boats-slider', array(
		'editor_script' => 'wls-boats-slider-block-editor',
		'editor_style'  => 'wls-boats-slider-block-editor',
		'style'         => 'wls-boats-slider-block',
	) );
}
add_action( 'init', 'wls_boats_slider_block_init' );
