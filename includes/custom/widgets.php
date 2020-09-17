<?php


require_once( plugin_dir_path( dirname( __FILE__ ) ) . '../lib/elementor/index.php' );

add_filter( 'siteorigin_widgets_widget_folders', function ( $folders ) {
	$folders[] = plugin_dir_path( dirname( __FILE__ ) ) . '../lib/siteorigin/';

	return $folders;
} );

add_filter( 'siteorigin_widgets_widget_banner', function ( $banner_url, $widget_meta ) {
	if ( $widget_meta['Author'] === '5 Anker GmbH' ) {
		$banner_url = plugin_dir_path( dirname( __FILE__ ) ) . '../lib/siteorigin/banner.svg';
	}

	return $banner_url;
}, 10, 2 );
