
wp.domReady( function() {

	/*
	 *
	 * ----- Only allow specific blocks to be used
	 *
	 */
	let allowedBlockTypes = [
		"core/heading",
		"core/subhead",
		"core/paragraph",
		"core/image",
		"core/gallery",
		"core/list",
		"core/separator",
		"core/block",
		"core/spacer",
		"acf/bfs-youtube-embed",
		"acf/bfs-gallery"
	];

	let allBlockTypes = wp.blocks.getBlockTypes();

	allBlockTypes.forEach( function ( blockType ) {
		if ( allowedBlockTypes.indexOf( blockType.name ) === -1 )
			wp.blocks.unregisterBlockType( blockType.name );
	} );

} );

/*
 |
 | Rename the core "Gallery", effectively designating our custom gallery block as the canonical version
 |
 */
wp.hooks.addFilter( "blocks.registerBlockType", "bfs/registerBlockTypeFilter", function ( settings ) {
	if ( settings.name === "core/gallery" )
		settings = { ...settings, title: "[DO NOT USE] Gallery (WordPress version)" }

	return settings
} )
