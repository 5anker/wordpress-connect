<?php


require_once(dirname(__FILE__).'/elementor/index.php');


add_filter('siteorigin_widgets_widget_folders', function ($folders) {
	$folders[] = dirname(__FILE__) . '/siteorigin/';

	return $folders;
});

add_filter('siteorigin_widgets_widget_banner', function ($banner_url, $widget_meta) {
	if (substr($widget_meta['Name'], 0, 9) == 'Connect: ') {
		$banner_url = plugin_dir_url(__FILE__) . 'siteorigin/banner.svg';
	}

	return $banner_url;
}, 10, 2);
