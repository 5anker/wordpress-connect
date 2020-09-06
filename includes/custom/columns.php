<?php

add_action( 'admin_head', 'anker_admin_column_width' );
function anker_admin_column_width() {
	echo '<style type="text/css">
        .column-anker_id { text-align: left; width:50px !important; overflow:hidden }
        .column-anker_mm { text-align: left; width:200px !important; overflow:hidden }
    </style>';
}


add_filter( 'manage_boat_posts_columns', 'set_custom_edit_boat_columns' );
function set_custom_edit_boat_columns( $columns ) {
	$columns['anker_id'] = __( 'ID' );
	$columns['anker_mm'] = __( 'Manufacturer / Model', 'anker-connect' );

	return $columns;
}

// Add the data to the custom columns for the book post type:
add_action( 'manage_boat_posts_custom_column', 'custom_boat_column', 10, 2 );

function custom_boat_column( $column, $post_id ) {
	switch ( $column ) {
		case 'anker_mm':
			echo get_post_meta( $post_id, 'com5anker_mm', true );
			break;

		case 'anker_id':
			echo get_post_meta( $post_id, 'com5anker_id', true );
			break;
	}
}

function add_boat_columns( $columns ) {
	return array_merge( array_flip( [ 'cb', 'anker_id', 'title', 'anker_mm', 'date' ] ), $columns );
}

add_filter( 'manage_boat_posts_columns', 'add_boat_columns' );


//


add_filter( 'manage_basement_posts_columns', 'set_custom_edit_basement_columns' );
function set_custom_edit_basement_columns( $columns ) {
	$columns['anker_id']     = __( 'ID' );
	$columns['anker_region'] = __( 'Region', 'anker-connect' );

	return $columns;
}

// Add the data to the custom columns for the book post type:
add_action( 'manage_basement_posts_custom_column', 'custom_basement_column', 10, 2 );

function custom_basement_column( $column, $post_id ) {
	switch ( $column ) {
		case 'anker_region':
			echo get_post_meta( $post_id, 'com5anker_region', true );
			break;

		case 'anker_id':
			echo get_post_meta( $post_id, 'com5anker_id', true );
			break;
	}
}

function add_basement_columns( $columns ) {
	return array_merge( array_flip( [ 'cb', 'anker_id', 'title', 'anker_region', 'date' ] ), $columns );
}

add_filter( 'manage_basement_posts_columns', 'add_basement_columns' );
