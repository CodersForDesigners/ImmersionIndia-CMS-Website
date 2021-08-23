<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

/**
 * Project configuration
 *
 * Pull the configuration file from the project root
 */
require_once __DIR__ . '/../conf.php';


if ( HTTPS_SUPPORT )
	$httpProtocol = 'https';
else
	$httpProtocol = 'http';

$hostName = $_SERVER[ 'HTTP_HOST' ] ?: $_SERVER[ 'SERVER_NAME' ];


/**
 * Routing
 *
 */
// Fetch media files from the WIP server
if ( CMS_FETCH_MEDIA_REMOTELY )
	if ( $hostName !== CMS_REMOTE_ADDRESS )
		if ( strpos( $_SERVER[ 'REQUEST_URI' ], '/content/cms/' ) !== false )
			return header( 'Location: ' . $httpProtocol . '://' . CMS_REMOTE_ADDRESS . $_SERVER[ 'REQUEST_URI' ], true, 302 );



/**
 * WordPress Website Roots
 *
 * Set it such that it is contextual to the domain that the site is hosted behind
 */
define( 'WP_HOME', $httpProtocol . '://' . $hostName );
if ( ! defined( 'WP_SITEURL' ) )
	define( 'WP_SITEURL', $httpProtocol . '://' . $hostName . '/cms' );



/**
 * Cron
 *
 */
if ( BFS_ENV_PRODUCTION )
	define( 'DISABLE_WP_CRON', true );



/**
 * Database
 *
 */
// SQLite
define( 'USE_MYSQL', ! CMS_USE_SQLITE );
define( 'DB_DIR', $_SERVER[ 'DOCUMENT_ROOT' ] . '/data/' );
define( 'DB_FILE', 'cms.db.sqlite' );

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', CMS_DB_NAME );

/** MySQL database username */
define( 'DB_USER', CMS_DB_USER );

/** MySQL database password */
define( 'DB_PASSWORD', CMS_DB_PASSWORD );

/** MySQL hostname */
define( 'DB_HOST', CMS_DB_HOST );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '2mtoKe?_ogo3XXy*U^OR+M!T+?Yz/qB*`Fn0}f/`3yRC%YvD?4UR2!j[TBEYRU]M' );
define( 'SECURE_AUTH_KEY',  'VUIN4!J(m0qF]0OjyQW;QI6{h`Ig-kBN~62%#yQBHMaD7.g+f_-t);vjs,nh!mDd' );
define( 'LOGGED_IN_KEY',    'u;6CuP. Ftb~|,#*9h45*/0zU)~Z.lTD!jU+=ABH/6gLFjV+xD0j|3F7|vN%Rc;Z' );
define( 'NONCE_KEY',        '%fTRG5enkSv:90a:uB(iIZR1N|pZ!mvF4nmD-}Rn~uYq(16{r~%--XvFL?{8,t27' );
define( 'AUTH_SALT',        ':F4?fGNI`Z&0`YRT8c=bl)X~0=Kab{AMhc=_5)r] onjeu0=bu1%pWZX+iWrT#dc' );
define( 'SECURE_AUTH_SALT', '=mKrzu>A9gF5L4W3,4q+8t>X8J/d$z+E&5:+&L[<sknrVYS!6(w=N4>wr(sRV>tI' );
define( 'LOGGED_IN_SALT',   'ur`~])z:>x(2!Ly69-iSrWB/V&a^bP_pDRTqNhb7>~g*T^Gd#s^E FgTT]Dm}Wd)' );
define( 'NONCE_SALT',       '# ]G1!:0X~bumaZ&cdhVBEY0Xwb,FYXSNXx;048BSfBLz7zqXg>W2s>=@V{|-mDG' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', CMS_DEBUG_MODE );
define( 'WP_DEBUG_LOG', CMS_DEBUG_LOG_TO_FILE );
define( 'WP_DEBUG_DISPLAY', CMS_DEBUG_LOG_TO_FRONTEND );
ini_set( 'display_errors', CMS_DEBUG_LOG_TO_FRONTEND ? '1' : '0' );

/**
 * WordPress Updates
 *
 */
define( 'WP_AUTO_UPDATE_CORE', CMS_AUTO_UPDATE );
// define( 'AUTOMATIC_UPDATER_DISABLED', !! CMS_AUTO_UPDATE );

/**
 * Media and Uploads
 *
 */
if ( ! defined( 'UPLOADS' ) )
	define( 'UPLOADS', '../content/cms' );	# this one is relative to `ABSPATH`


/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) )
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
