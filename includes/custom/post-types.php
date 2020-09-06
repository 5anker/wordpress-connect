<?php

if (!defined('ABSPATH')) {
    exit;
}

// Register the custom post type.
function register_wls_post_types()
{
    $settings = Anker_Connect::getOptions();

    if (!$settings->import) {
        return;
    }

    $args = [
        'labels' => [
            'name' => __('Marinas', 'anker-connect'),
            'singular_name' => __('Marina', 'anker-connect'),
            'view_item' => __('View Marina', 'anker-connect'),
            'search_items' => __('Search Marina', 'anker-connect'),
            'not_found' => __('No Marina found', 'anker-connect'),
            'not_found_in_trash' => __('No Marinas found in Trash', 'anker-connect'),
            'parent_item_colon' => __('Parent Marina:', 'anker-connect'),
            'menu_name' => __('Marinas', 'anker-connect'),
        ],
        'hierarchical' => false,
        'description' => 'description',
        'taxonomies' => [],
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_admin_bar' => true,
        'menu_position' => null,
        'menu_icon' => null,
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => true,
        'has_archive' => false,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => [
            'slug' => $settings->basements_uri
        ],
        'supports' => ['title', 'thumbnail', 'editor', 'custom-fields'],
        'capability_type' => 'post',
        'capabilities' => [
            'edit_post' => 'edit_post',
            'read_post' => 'read_post',
            'delete_post' => 'delete_post',
            'edit_posts' => 'edit_posts',
            'delete_posts' => 'delete_posts',
            'edit_others_posts' => 'do_not_allow',
            'publish_posts' => 'do_not_allow',
            'read_private_posts' => 'do_not_allow',
            'create_posts' => 'do_not_allow',
        ],
        "map_meta_cap" => true,
    ];

    register_post_type('basement', $args);

    $args = [
        'labels' => [
            'name' => __('Boats', 'anker-connect'),
            'singular_name' => __('Boat', 'anker-connect'),
            'view_item' => __('View Boat', 'anker-connect'),
            'search_items' => __('Search Boat', 'anker-connect'),
            'not_found' => __('No Boat found', 'anker-connect'),
            'not_found_in_trash' => __('No Boats found in Trash', 'anker-connect'),
            'parent_item_colon' => __('Parent Boat:', 'anker-connect'),
            'menu_name' => __('Boats', 'anker-connect'),
        ],
        'hierarchical' => false,
        'description' => 'description',
        'taxonomies' => [],
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_admin_bar' => true,
        'menu_position' => null,
        'menu_icon' => null,
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => true,
        'has_archive' => false,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => [
            'slug' => $settings->boats_uri
        ],
        'supports' => ['title', 'thumbnail', 'editor', 'custom-fields'],
        'capability_type' => 'post',
        'capabilities' => [
            'edit_post' => 'edit_post',
            'read_post' => 'read_post',
            'delete_post' => 'delete_post',
            'edit_posts' => 'edit_posts',
            'delete_posts' => 'delete_posts',
            'edit_others_posts' => 'do_not_allow',
            'publish_posts' => 'do_not_allow',
            'read_private_posts' => 'do_not_allow',
            'create_posts' => 'do_not_allow',
        ],
        "map_meta_cap" => true,
    ];

    register_post_type('boat', $args);
}

add_action('init', 'register_wls_post_types');
