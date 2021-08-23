<?php

/*
 |
 | Managing the document title.
 |
 | Let WordPress manage this. This theme does not use a hard-coded <title> tag in the document head, WordPress will provide it for us.
 |
 */
if ( class_exists( '\BFS\CMS' ) and ! \BFS\CMS::$onlySetupContext ) {
	add_theme_support( 'title-tag' );
	add_filter( 'document_title_separator', function ( $separator ) {
		return '|';
	} );
}
