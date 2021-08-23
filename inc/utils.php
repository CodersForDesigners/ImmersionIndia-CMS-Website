<?php





/*
 *
 * Pull in the WordPress files if possible
 *
 */
function initWordPress () {

	if ( cmsIsEnabled() )
		return;

	$configFile = __DIR__ . '/../cms/wp-config.php';
	$configFile__AlternateLocation = __DIR__ . '/../wp-config.php';
	if ( file_exists( $configFile ) || file_exists( $configFile__AlternateLocation ) ) {
		$includeStatus = include_once __DIR__ . '/../cms/index.php';
		if ( $includeStatus ) {
			global $cmsHasBeenLoaded;
			// global $onlyPrepareWPContext;
			$cmsHasBeenLoaded = true;
			// $onlyPrepareWPContext = true;
			$GLOBALS[ 'onlyPrepareWPContext' ] = true;
			// establishContext();
		}
	}
}

/*
 |
 | Prevent the page from being cached
 |
 */
function dontCachePage () {
	header( 'Surrogate-Control: no-store' );
	header( 'Cache-Control: max-age=0, s-maxage=0, no-store, no-cache, must-revalidate, proxy-revalidate' );
	header( 'Pragma: no-cache' );
	header( 'Expires: 0' );
}


/*
 *
 * Is the CMS enabled?
 *
 */
function cmsIsEnabled () {
	global $cmsHasBeenLoaded;
	return $cmsHasBeenLoaded;
}


/*
 *
 * Set up global variables
 *
 */
$siteUrl = ( HTTPS_SUPPORT ? 'https://' : 'http://' ) . $_SERVER[ 'HTTP_HOST' ];
if ( ! isset( $cmsHasBeenLoaded ) )
	$cmsHasBeenLoaded = false;
$postId = null;



/*
 *
 * ----- Returns a string built from interpolating text enclosed in double curly braces (like this — {{ field }}) with values found in the provided context
 *
 */
function interpolateString ( $string, $context = [ ] ) {
	$formattedContext = [ ];
	foreach ( $context as $key => $value )
		$formattedContext[ '{{ ' . $key . ' }}' ] = $value;

	return str_replace( array_keys( $formattedContext ), array_values( $formattedContext ), $string );
}



/*
 *
 * Dump the values on the page and onto JavaScript memory, finally end the script
 *
 */
function dd ( $data ) {

	echo '<pre>';
		var_dump( [ 'memory usage' => memory_get_usage() ] );
	echo '</pre>';

	echo '<pre>';
		var_dump( $data );
	echo '</pre>';

	echo '<pre>';
		var_dump( [ 'memory usage' => memory_get_usage() ] );
	echo '</pre>';

	echo '<script>';
		echo '__data = ' . json_encode( $data ) . ';';
	echo '</script>';

	exit;

}
