<?php


require_once(CONNECT_PLUGIN_PATH . '/elementor/index.php');

add_filter('siteorigin_widgets_widget_folders', function ($folders) {
	$folders[] = CONNECT_PLUGIN_PATH . '/siteorigin/';

	return $folders;
});

add_filter('siteorigin_widgets_widget_banner', function ($banner_url, $widget_meta) {
	if ($widget_meta['Author'] == '5 Anker GmbH') {
		$banner_url = plugin_dir_url(__FILE__) . 'siteorigin/banner.svg';
	}

	return $banner_url;
}, 10, 2);
