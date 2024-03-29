<?php
/**
 * Brownie Fudge Sundae functions and definitions
 *
 * @package Brownie Fudge Sundae
 * @since 1.0.0
 */

define( 'THEME_SETTINGS_PATH', get_template_directory() . '/settings' );



require get_template_directory() . '/inc/utils.php';
require get_template_directory() . '/inc/hooks.php';



require_once THEME_SETTINGS_PATH . '/routing.php';
require_once THEME_SETTINGS_PATH . '/authentication.php';
require_once THEME_SETTINGS_PATH . '/unhide-the-reusable-blocks-post-type.php';

add_action( 'after_setup_theme', function () {

	// Theme supports
	require_once THEME_SETTINGS_PATH . '/theme-supports.php';
	// Document Title
	require_once THEME_SETTINGS_PATH . '/document-title.php';
	// Media settings
	require_once THEME_SETTINGS_PATH . '/media.php';
	// Gutenberg Block editor settings
	require_once THEME_SETTINGS_PATH . '/gutenberg-block-editor.php';
	// Admin dashboard settings
	require_once THEME_SETTINGS_PATH . '/admin-dashboard.php';

} );



// URL auto correction
require_once THEME_SETTINGS_PATH . '/url-auto-correction.php';
// Custom Gutenberg Blocks
require_once THEME_SETTINGS_PATH . '/custom-gutenberg-blocks.php';
// Gutenberg Block customizations
require_once THEME_SETTINGS_PATH . '/gutenberg-block-customizations.php';
