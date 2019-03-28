<?php

if (! defined('ABSPATH')) {
	exit;
}

add_action('wp_head', function () {
	$settings = (object)unserialize(get_option('connect_options'));
	$defaults = [
		'token' => $settings->public_token,
		'redirects' => [],
		'settings' => [],
	];

	if ($settings->import) {
		$defaults['redirects']['boat'] = "/{$settings->boats_uri}/{slug}";
		$defaults['redirects']['booking'] = "/{$settings->boats_uri}/{slug}";
		$defaults['redirects']['marina'] = "/{$settings->basements_uri}/{slug}";
	}

	if ($settings->notepad) {
		$defaults['settings']['notepad'] = true;
	}

	$conf = json_decode(preg_replace('/\\\"/', "\"", $settings->config), true);

	if ($conf === null && json_last_error() !== JSON_ERROR_NONE) {
		$config = $defaults;
	} else {
		$config = array_merge($defaults, $conf);
	}

	echo '<script type="text/javascript">window.connect = '.json_encode($config).'</script>';
});

add_action('wp_enqueue_scripts', function () {
	wp_enqueue_script('widget-wls', 'https://wls.5-anker.com/app.js?v=' . date('y.n.j.G'), null, null, true);
}, 100);
