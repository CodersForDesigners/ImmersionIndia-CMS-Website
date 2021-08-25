<?php

/*
 |
 | General Block settings
 |
 */
add_action( 'enqueue_block_editor_assets', function () {
	wp_enqueue_script(
		'bfs-guten-script',
		get_template_directory_uri() . '/js/blocks.js',
		[ 'wp-dom-ready', 'wp-blocks', 'wp-edit-post' ],
		filemtime( get_template_directory() . '/js/blocks.js' )
	);
} );



/*
 |
 | For the _travel program_ and _virtual series_ post types,
 | 	hide the Category and Tag edit panels on the sidebar.
 | 	The user can only edit the category through the ACF field that has been set up.
 |
 */
add_action( 'bfs/backend/on-editing-posts', function ( $postType ) {

	if ( $postType !== 'travel_programs' and $postType !== 'virtual_series' )
		return;

	wp_enqueue_script(
		'bfs-hide-taxonomy-category-tag-panels',
		get_template_directory_uri() . '/js/hide-taxonomy-category-tag-panels.js',
		[ 'wp-data', 'wp-hooks', 'wp-edit-post', 'lodash', 'jquery' ],
		filemtime( get_template_directory() . '/js/hide-taxonomy-category-tag-panels.js' )
	);

} );
