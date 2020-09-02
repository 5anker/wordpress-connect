<?php

function load_anker_templates($template)
{
    global $post;

    if ($post->post_type == "boat" && $template !== locate_template(["single-boat.php"])) {
        return plugin_dir_path(dirname(__FILE__)) . "templates/single-boat.php";
    }

    if ($post->post_type == "basement" && $template !== locate_template(["basement-boat.php"])) {
        return plugin_dir_path(dirname(__FILE__)) . "templates/single-basement.php";
    }

    return $template;
}

add_filter('single_template', 'load_anker_templates');
