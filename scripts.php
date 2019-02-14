<?php

if (! defined('ABSPATH')) {
	exit;
}

add_action('wp_head', function () {
	$settings = (object)unserialize(get_option('connect_options'));
	$defaults = [
		'token' => $settings->public_token,
	];

	$conf = json_decode(preg_replace('/\\\"/', "\"", $settings->config), true);

	if ($conf === null && json_last_error() !== JSON_ERROR_NONE) {
		$config = $defaults;
	} else {
		$config = array_merge($defaults, $conf);
	}

	echo '<script type="text/javascript">window.connect = '.json_encode($config).'</script>';
});

add_action('wp_enqueue_scripts', function () {
	wp_enqueue_script('widget-wls', 'https://wls.5-anker.com/js/app.js?v=' . date('y.n.j.G'), null, null, true);
	wp_enqueue_style('widget-wls-css', 'https://wls.5-anker.com/css/app.css?v=' . date('y.n.j.G'), false, null);
}, 100);
