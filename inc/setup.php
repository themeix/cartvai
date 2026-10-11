<?php
/**
 * Cartvai Theme Setup
 *
 * @package Cartvai_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function cartvai_theme_setup() {
	// Make theme available for translation.
	load_theme_textdomain( 'cartvai', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Let WordPress manage the document title.
	add_theme_support( 'title-tag' );

	// Enable support for Post Thumbnails.
	add_theme_support( 'post-thumbnails' );

	// Gutenberg / Block Editor supports.
	add_theme_support( 'align-wide' );
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'responsive-embeds' );

	// Register Navigation Menus.
	register_nav_menus(
		array(
			'primary'            => esc_html__( 'Primary Menu', 'cartvai' ),
			'megamenu'           => esc_html__( 'Mega Menu Bar (Colorful Category Nav)', 'cartvai' ),
			'more_menu'          => esc_html__( 'More Menu (Header "More" Drawer & Links)', 'cartvai' ),
			'footer'             => esc_html__( 'Footer Menu (Sub-footer Row)', 'cartvai' ),
			'footer_col_1'       => esc_html__( 'Footer Column 1 (e.g. Quick Links / Shop)', 'cartvai' ),
			'footer_col_2'       => esc_html__( 'Footer Column 2 (e.g. Useful Links / Care)', 'cartvai' ),
			'footer_col_3'       => esc_html__( 'Footer Column 3 (e.g. Help Center / Support)', 'cartvai' ),
		)
	);

	// Switch default core markup to output valid HTML5.
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'cartvai_theme_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Set up the WordPress core custom header feature.
	add_theme_support(
		'custom-header',
		apply_filters(
			'cartvai_theme_custom_header_args',
			array(
				'default-image' => '',
				'width'         => 1600,
				'height'        => 400,
				'flex-height'   => true,
				'flex-width'    => true,
				'header-text'   => true,
			)
		)
	);

	// Custom Logo.
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 80,
			'width'       => 240,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);

	// Editor styles support.
	add_theme_support( 'editor-styles' );
	add_editor_style( 'assets/css/editor-style.css' );

	// Declare Cartvai support.
	add_theme_support( 'cartvai' );

	// Enable theme-specific related products carousel on single product pages.
	add_filter( 'cartvai_show_related_products', '__return_true' );
}
add_action( 'after_setup_theme', 'cartvai_theme_setup' );

/**
 * Register Gutenberg Block Styles
 */
function cartvai_theme_register_block_styles() {
	if ( function_exists( 'register_block_style' ) ) {
		register_block_style(
			'core/button',
			array(
				'name'  => 'cartvai-pill',
				'label' => esc_html__( 'Cartvai Pill', 'cartvai' ),
			)
		);

		register_block_style(
			'core/group',
			array(
				'name'  => 'cartvai-card',
				'label' => esc_html__( 'Cartvai Card', 'cartvai' ),
			)
		);
	}
}
add_action( 'init', 'cartvai_theme_register_block_styles' );
