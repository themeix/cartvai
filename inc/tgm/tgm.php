<?php
/**
 * TGM Plugin Activation configuration for Cartvai Theme
 *
 * @package Cartvai_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once get_template_directory() . '/inc/tgm/class-tgm-plugin-activation.php';

/**
 * Register required / recommended plugins for Cartvai Theme.
 */
function cartvai_theme_register_required_plugins() {
	$plugins = array(
		array(
			'name'             => esc_html__( 'Cartvai – Ecommerce Checkout, Funnel Builder & Shop Manager', 'cartvai' ),
			'slug'             => 'cartvai-ecommerce',
			'required'         => true,
			'force_activation' => false,
		),
	);

	$config = array(
		'id'           => 'cartvai',
		'default_path' => '',
		'menu'         => 'tgmpa-install-plugins',
		'parent_slug'  => 'themes.php',
		'capability'   => 'edit_theme_options',
		'has_notices'  => true,
		'dismissable'  => true,
		'dismiss_msg'  => '',
		'is_automatic' => false,
		'message'      => '',
	);

	tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'cartvai_theme_register_required_plugins' );
