<?php
/**
 * Cartvai Theme Capabilities
 *
 * Defines and registers custom Cartvai theme capabilities so that
 * administrator and custom roles created via Cartvai Pro (e.g. staff, shop manager)
 * can be assigned fine-grained access to theme settings.
 *
 * @package Cartvai_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Capability constant for theme management.
 * In accordance with WordPress theme review guidelines, themes must use 'edit_theme_options'.
 */
define( 'CARTVAI_THEME_CAPABILITY', 'edit_theme_options' );

/**
 * Register the custom capability and grant it to Administrator by default.
 */
function cartvai_theme_register_capabilities() {
	// Standard WordPress themes must not register arbitrary capabilities.
	// We rely on standard 'edit_theme_options'.
}
add_action( 'admin_init', 'cartvai_theme_register_capabilities' );

/**
 * Check if the current user can manage Cartvai Theme settings.
 *
 * @return bool
 */
function cartvai_theme_current_user_can() {
	return current_user_can( 'edit_theme_options' );
}
