<?php

function load_anker_templates($template)
{
	global $post;

	if ($post->post_type == "boat" && $template !== locate_template(["single-boat.php"])) {
		return CONNECT_PLUGIN_PATH . "/single-boat.php";
	}

	if ($post->post_type == "basement" && $template !== locate_template(["basement-boat.php"])) {
		return CONNECT_PLUGIN_PATH . "/single-basement.php";
	}

	return $template;
}

add_filter('single_template', 'load_anker_templates');
