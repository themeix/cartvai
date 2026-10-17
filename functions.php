<?php
/**
 * Cartvai Base Theme functions and definitions
 *
 * @package Cartvai_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'CARTVAI_THEME_VERSION', '1.0.0' );
define( 'CARTVAI_THEME_DIR', get_template_directory() );
define( 'CARTVAI_THEME_URI', get_template_directory_uri() );

// Enable automatic gzip compression for HTML responses if server supports zlib and not already active
if ( ! is_admin() && function_exists( 'ini_set' ) && ! ini_get( 'zlib.output_compression' ) ) {
	@ini_set( 'zlib.output_compression', '1' );
}

// Prevent 'Notice: ob_end_flush(): Failed to send buffer of zlib output compression' (WordPress Trac #22430)
if ( (bool) ini_get( 'zlib.output_compression' ) ) {
	remove_action( 'shutdown', 'wp_ob_end_flush_all', 1 );
}

// Theme Core Includes
require_once CARTVAI_THEME_DIR . '/inc/capabilities.php';
require_once CARTVAI_THEME_DIR . '/inc/template-tags.php';
require_once CARTVAI_THEME_DIR . '/inc/setup.php';
require_once CARTVAI_THEME_DIR . '/inc/enqueue.php';
require_once CARTVAI_THEME_DIR . '/inc/customizer.php';
require_once CARTVAI_THEME_DIR . '/inc/theme-settings.php';
require_once CARTVAI_THEME_DIR . '/inc/navigation.php';
require_once CARTVAI_THEME_DIR . '/inc/widgets.php';
require_once CARTVAI_THEME_DIR . '/inc/patterns.php';
require_once CARTVAI_THEME_DIR . '/inc/tgm/tgm.php';
require_once CARTVAI_THEME_DIR . '/inc/demo-importer.php';
require_once CARTVAI_THEME_DIR . '/inc/search.php';
