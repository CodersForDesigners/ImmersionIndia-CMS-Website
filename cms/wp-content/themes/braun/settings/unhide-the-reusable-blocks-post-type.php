<?php

/*
 |
 | Reveal the hidden "Reusable Blocks" post type
 |
 | This is a native post type that WordPress (i.e. Gutenberg) uses to store Reusable Blocks.
 |
 */

add_action( 'admin_menu', function () {

	add_menu_page(
		'Reusable Blocks',	// page title
		'Reusable Blocks',	// menu title
		'edit_posts',	// capability
		'edit.php?post_type=wp_block',	// menu slug
		'',	// callable function
		'dashicons-block-default',	// dashicon or icon URL
		4	// menu position
	);

} );
