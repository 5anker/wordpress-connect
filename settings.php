<?php

if (! defined('ABSPATH')) {
	exit;
}

add_action('tf_create_options', 'anker_load_settings');

function anker_load_settings()
{
	$settings = (object)unserialize(get_option('connect_options'));

	$titan = \TitanFramework::getInstance('connect');
	$panel = $titan->createAdminPanel([
		'name' => __('Connect', '5anker'),
	]);

	$general = $panel->createTab([
		'name' => __('General', '5anker'),
	]);

	$general->createOption([
		'name' => __('Public Token', '5anker'),
		'id' => 'public_token',
		'type' => 'text'
	]);

	$general->createOption([
		'name' => __('Private Token', '5anker'),
		'id' => 'private_token',
		'type' => 'text'
	]);

	$general->createOption([
		'name' => __('Activate import', '5anker'),
		'id' => 'import',
		'type' => 'checkbox',
		'default' => false
	]);

	$general->createOption([
		'name' => __('Activate notepad', '5anker'),
		'id' => 'notepad',
		'type' => 'checkbox',
		'default' => false
	]);

	$general->createOption([
		'name' => __('Additional configuration', '5anker'),
		'id' => 'config',
		'type' => 'code',
		'lang' => 'json',
		'default' => '{}',
		'is_code' => true
	]);

	$general->createOption([
		'type' => 'save',
		'use_reset' => false
	]);

	if ($settings->import) {
		$url = $panel->createTab([
			'name' => __('URL', '5anker'),
		]);

		$url->createOption([
			'name' => __('Boats URI', '5anker'),
			'id' => 'boats_uri',
			'type' => 'text',
			'default' => 'yacht'
		]);

		$url->createOption([
			'name' => __('Basements URI', '5anker'),
			'id' => 'basements_uri',
			'type' => 'text',
			'default' => 'marina'
		]);

		$url->createOption([
			'type' => 'save',
			'use_reset' => false
		]);
	}
}
