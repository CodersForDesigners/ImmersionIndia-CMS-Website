<?php

/*
 |
 | For Gallery blocks
 | 	1. remove the `srcset` attribute
 | 	2. replace the `src` attribute with `data-lazy`
 |
 */
add_filter( 'render_block', function ( $content, $block ) {
	if ( $block[ 'blockName' ] === 'core/gallery' )
		return str_replace(
			'srcset',
			'data-srcset',
			str_replace( '<img src', '<img data-lazy', $content )
		);
	else
		return $content;
}, 9999, 2 );
