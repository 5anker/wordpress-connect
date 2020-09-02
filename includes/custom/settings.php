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
		'name' => __('Connect', 'anker-connect'),
	]);

	$general = $panel->createTab([
		'name' => __('General', 'anker-connect'),
	]);

	$general->createOption([
		'name' => __('Public Token', 'anker-connect'),
		'id' => 'public_token',
		'type' => 'text'
	]);

	$general->createOption([
		'name' => __('Private Token', 'anker-connect'),
		'id' => 'private_token',
		'type' => 'text'
	]);

	$general->createOption([
		'name' => __('Activate import', 'anker-connect'),
		'id' => 'import',
		'type' => 'checkbox',
		'default' => false
	]);

	if ($settings->import) {
		$general->createOption([
			'name' => __('Index boats and basements', 'anker-connect'),
			'id' => 'index',
			'type' => 'checkbox',
			'default' => false
		]);
	}

	$general->createOption([
		'name' => __('Activate notepad', 'anker-connect'),
		'id' => 'notepad',
		'type' => 'checkbox',
		'default' => false
	]);

	$general->createOption([
		'name' => __('Additional configuration', 'anker-connect'),
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
			'name' => __('URL', 'anker-connect'),
		]);

		$url->createOption([
			'name' => __('Boats URI', 'anker-connect'),
			'id' => 'boats_uri',
			'type' => 'text',
			'default' => 'yacht'
		]);

		$url->createOption([
			'name' => __('Basements URI', 'anker-connect'),
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
