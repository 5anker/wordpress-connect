<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function anker_connect_cron_schedules( $schedules ) {
	if ( ! isset( $schedules["5min"] ) ) {
		$schedules["5min"] = [
			'interval' => 5 * 60,
			'display'  => __( 'Once every 5 minutes', '5-anker-connect' ),
		];
	}

	return $schedules;
}

add_filter( 'cron_schedules', 'anker_connect_cron_schedules' );

if ( ! wp_next_scheduled( 'anker_connect_schedule_hook_boats' ) ) {
	wp_schedule_event( time(), '5min', 'anker_connect_schedule_hook_boats' );
}

if ( ! wp_next_scheduled( 'anker_connect_schedule_hook_basements' ) ) {
	wp_schedule_event( time(), '5min', 'anker_connect_schedule_hook_basements' );
}

// Hook into that action that'll fire every three minutes
add_action( 'anker_connect_schedule_hook_boats', 'anker_connect_schedule_hook_boats' );
add_action( 'anker_connect_schedule_hook_basements', 'anker_connect_schedule_hook_basements' );

function anker_connect_schedule_hook_boats( $limit = 50 ) {
	$settings = Anker_Connect::getOptions();

	if ( ! $settings->import ) {
		return;
	}

	$page = get_option( 'last_boat_import_page', 1 );

	if ( ! $rest = AnkerRest::get( 'rest/remote/wp/boat', [
		'limit'      => $limit,
		'updated_at' => 'gt:' . get_option( 'last_boat_import', '2015-01-01 00:00:00' ),
		'page'       => $page,
	] ) ) {
		return;
	}

	if ( ! isset( $rest->data ) ) {
		return;
	}

	foreach ( $rest->data as $boat ) {
		$postID = 0;
		$post   = null;

		$posts = get_posts( [
			'post_type'  => 'boat',
			'meta_key'   => 'com5anker_boat_id',
			'meta_value' => $boat->id,
		] );

		if ( count( $posts ) ) {
			$postID = $posts[0]->ID;
			$post   = $posts[0];
		}

		$postCreated = [
			'ID'           => $postID,
			'post_title'   => $boat->title,
			'post_name'    => $boat->slug,
			'post_content' => $post && ! empty( $post->post_content ) ? $post->post_content : '',
			'post_excerpt' => $post && ! empty( $post->post_excerpt ) ? $post->post_excerpt : '',
			'post_status'  => 'publish',
			'post_type'    => 'boat' // Or "page" or some custom post type
		];

		$postInsertId = wp_insert_post( $postCreated );

		$metas = array_merge( [
			'com5anker_id'      => $boat->id,
			'com5anker_boat_id' => $boat->id,
			'com5anker_mm'      => $boat->model->manufacturer->name . ' ' . $boat->model->name,
			'com5anker_data'    => $boat,
		], (array) $boat->metas );

		if ( ! isset( $settings->index ) || empty( $settings->index ) ) {
			$metas = array_merge( $metas, [
				'_yoast_wpseo_meta-robots-noindex'  => 1,
				'_yoast_wpseo_meta-robots-nofollow' => 1,
			] );
		} else {
			$metas = array_merge( $metas, [
				'_yoast_wpseo_meta-robots-noindex'  => 0,
				'_yoast_wpseo_meta-robots-nofollow' => 0,
			] );
		}

		foreach ( $metas as $key => $value ) {
			update_post_meta( $postInsertId, $key, $value );
		}
	}

	update_option( 'last_boat_import_page', ++ $page );

	if ( $rest->meta->current_page >= $rest->meta->last_page ) {
		update_option( 'last_boat_import', date( 'Y-m-d H:i:s', time() ) );
		update_option( 'last_boat_import_page', 1 );
	}

	flush_rewrite_rules();
}

function anker_connect_schedule_hook_basements( $limit = 20 ) {
	$settings = Anker_Connect::getOptions();

	if ( ! $settings->import ) {
		return;
	}

	$page = get_option( 'last_basement_import_page', 1 );

	if ( ! $rest = AnkerRest::get( 'rest/remote/wp/basement', [
		'limit'      => $limit,
		'updated_at' => 'gt:' . get_option( 'last_basement_import', '2015-01-01 00:00:00' ),
		'page'       => $page,
	] ) ) {
		return;
	}

	if ( ! isset( $rest->data ) ) {
		return;
	}

	foreach ( $rest->data as $basement ) {
		$postID = 0;
		$post   = null;

		$posts = get_posts( [
			'post_type'  => 'basement',
			'meta_key'   => 'com5anker_basement_id',
			'meta_value' => $basement->id,
		] );

		if ( count( $posts ) ) {
			$postID = $posts[0]->ID;
			$post   = $posts[0];
		}

		$postCreated = [
			'ID'           => $postID,
			'post_title'   => $basement->name,
			'post_name'    => $basement->slug,
			'post_content' => $post && ! empty( $post->post_content ) ? $post->post_content : '',
			'post_excerpt' => $post && ! empty( $post->post_excerpt ) ? $post->post_excerpt : '',
			'post_status'  => 'publish',
			'post_type'    => 'basement' // Or "page" or some custom post type
		];

		$postInsertId = wp_insert_post( $postCreated );

		$metas = array_merge( [
			'com5anker_id'          => $basement->id,
			'com5anker_basement_id' => $basement->id,
			'com5anker_region'      => $basement->region->name,
			'com5anker_data'        => $basement,
		], (array) $basement->metas );

		if ( ! isset( $settings->index ) || empty( $settings->index ) ) {
			$metas = array_merge( $metas, [
				'_yoast_wpseo_meta-robots-noindex'  => 1,
				'_yoast_wpseo_meta-robots-nofollow' => 1,
			] );
		} else {
			$metas = array_merge( $metas, [
				'_yoast_wpseo_meta-robots-noindex'  => 0,
				'_yoast_wpseo_meta-robots-nofollow' => 0,
			] );
		}

		foreach ( $metas as $key => $value ) {
			update_post_meta( $postInsertId, $key, $value );
		}
	}

	update_option( 'last_basement_import_page', ++ $page );

	if ( $rest->meta->current_page >= $rest->meta->last_page ) {
		update_option( 'last_basement_import', date( 'Y-m-d H:i:s', time() ) );
		update_option( 'last_basement_import_page', 1 );
	}

	flush_rewrite_rules();
}
