<?php

/*
 |
 | Custom Gutenberg blocks
 |
 */
add_action( 'acf/init', function () {
	if ( ! function_exists( 'acf_register_block_type' ) )
		return;

	// (custom) Gallery block
	acf_register_block_type( [
		'name' => 'bfs-gallery',
		'title' => __( 'Gallery' ),
		'description' => __( 'A gallery block that supports captioning as well as linking images.' ),
		'category' => 'embed',
		'icon' => 'format-gallery',
		'align' => 'wide',
		'mode' => 'edit',
		'supports' => [
			'multiple' => true,
			'align' => [ 'wide' ]
		],
		'keywords' => [ 'gallery', 'image' ],
		'render_template' => 'template-parts/bfs-gallery.php',
	] );

	// Youtube Embed block
	acf_register_block_type( [
		'name' => 'bfs-youtube-embed',
		'title' => __( 'YouTube Embed' ),
		'description' => __( 'Embed YouTube video' ),
		'render_template' => 'template-parts/youtube-embed.php',
		'category' => 'embed',
		'icon' => '<svg width="24" height="24" viewBox="0 0 24 24" role="img" aria-hidden="true" focusable="false"><path d="M21.8 8s-.195-1.377-.795-1.984c-.76-.797-1.613-.8-2.004-.847-2.798-.203-6.996-.203-6.996-.203h-.01s-4.197 0-6.996.202c-.39.046-1.242.05-2.003.846C2.395 6.623 2.2 8 2.2 8S2 9.62 2 11.24v1.517c0 1.618.2 3.237.2 3.237s.195 1.378.795 1.985c.76.797 1.76.77 2.205.855 1.6.153 6.8.2 6.8.2s4.203-.005 7-.208c.392-.047 1.244-.05 2.005-.847.6-.607.795-1.985.795-1.985s.2-1.618.2-3.237v-1.517C22 9.62 21.8 8 21.8 8zM9.935 14.595v-5.62l5.403 2.82-5.403 2.8z"></path></svg>',
		'keywords' => [ 'youtube', 'embed' ],
		'mode' => 'edit'
	] );

} );
