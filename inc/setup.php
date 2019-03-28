<?php

function anker_plugin_activate()
{
	$defaults = [
		'private_token' => '',
		'public_token' => '',
		'config' => '{}',
		'basements_uri' => 'marina',
		'boats_uri' => 'yacht',
		'import' => false,
		'notepad' => false
	];

	if (!$options = get_option('connect_options')) {
		add_option('connect_options', serialize($defaults));
	} else {
		update_option('connect_options', serialize(array_merge($defaults, unserialize($options))));
	}

	flush_rewrite_rules();

	add_option('anker_plugin_do_activation_redirect', true);
}

function anker_plugin_redirect()
{
	if (get_option('anker_plugin_do_activation_redirect', false)) {
		delete_option('anker_plugin_do_activation_redirect');

		if (!isset($_GET['activate-multi'])) {
			wp_redirect("admin.php?page=connect");
		}
	}
}
