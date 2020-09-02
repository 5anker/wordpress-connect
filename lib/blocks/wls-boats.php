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
function wls_boats_block_init()
{
	// Skip block registration if Gutenberg is not enabled/merged.
	if (! function_exists('register_block_type')) {
		return;
	}
	$dir = dirname(__FILE__);

	$index_js = 'wls-boats/index.js';
	wp_register_script(
		'wls-boats-block-editor',
		plugins_url($index_js, __FILE__),
		[
			'wp-blocks',
			'wp-i18n',
			'wp-element',
		],
		filemtime("$dir/$index_js")
	);

	$editor_css = 'wls-boats/editor.css';
	wp_register_style(
		'wls-boats-block-editor',
		plugins_url($editor_css, __FILE__),
		[],
		filemtime("$dir/$editor_css")
	);

	$style_css = 'wls-boats/style.css';
	wp_register_style(
		'wls-boats-block',
		plugins_url($style_css, __FILE__),
		[],
		filemtime("$dir/$style_css")
	);

	register_block_type('anker-connect/wls-boats', [
		'editor_script' => 'wls-boats-block-editor',
		'editor_style'  => 'wls-boats-block-editor',
		'style'         => 'wls-boats-block',
	]);

	wp_set_script_translations('wls-boats-block-editor', 'anker-connect');
}
add_action('init', 'wls_boats_block_init');
