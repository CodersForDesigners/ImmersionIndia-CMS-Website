<?php

/*
 |
 | Routing
 |
 */
add_action( 'template_redirect', function () {

	// If the URL slug is simply `cms`, then forward to the login or admin screen depending on if the user is already logged in or not
	global $wp;
	if ( $wp->request == 'cms' ) {
		nocache_headers();
		$redirectURL = is_user_logged_in() ? get_admin_url() : wp_login_url();
		wp_redirect( $redirectURL, 302, 'BFS' );
		exit;
	}

	// If the site is private, prompt the user to log in
	if ( BFS_PRIVATE_SITE and ! is_user_logged_in() )
		if ( substr( $_SERVER[ 'REQUEST_URI' ], 0, strlen( '/robots.txt' ) ) != '/robots.txt' ) {
			$redirectURL = wp_login_url() . '?redirect_to=' . urlencode( get_home_url() . $_SERVER[ 'REQUEST_URI' ] );
			wp_redirect( $redirectURL, 302, 'BFS' );
			exit;
		}

	// If WordPress is being loaded as a module, then cut short the on the "template routing" and "response preparation".
	if ( \BFS\CMS::$onlySetupContext )
		add_filter( 'template_include', function ( $template ) {
			return get_template_directory() . '/template-stub.php';
		} );

} );
