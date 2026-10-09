<?php
/**
 * Cartvai Theme Enqueues
 *
 * @package Cartvai_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function cartvai_theme_scripts() {
	$theme_version = wp_get_theme()->get( 'Version' );

	// Enqueue Google Font Inter
	wp_enqueue_style(
		'cartvai-theme-font',
		'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap',
		array(),
		null
	);

	// Enqueue Compiled Tailwind CSS
	if ( file_exists( get_template_directory() . '/assets/css/style.css' ) ) {
		wp_enqueue_style(
			'cartvai-theme-styles',
			get_template_directory_uri() . '/assets/css/style.css',
			array( 'cartvai-theme-font' ),
			$theme_version
		);

		$primary_color = cartvai_theme_option( 'primary_color', '#2563eb' );
		$primary_hover = cartvai_theme_option( 'primary_hover_color', '#1d4ed8' );
		$primary_light = cartvai_theme_option( 'primary_light_color', '#eff6ff' );
		$accent_color  = cartvai_theme_option( 'accent_color', '#0f172a' );
		$heading_color = cartvai_theme_option( 'heading_color', '#0f172a' );
		$text_color    = cartvai_theme_option( 'text_color', '#334155' );
		$border_color  = cartvai_theme_option( 'border_color', '#e2e8f0' );
		$bg_color      = cartvai_theme_option( 'bg_color', '#f8fafc' );

		// Header & Navbar Styling Tokens
		$header_style    = cartvai_get_header_style();
		$is_dark_navbar  = in_array( $header_style, array( 'megabar', 'megastore' ), true );
		$default_nav_bg  = $is_dark_navbar ? '#0d3b2e' : '#fbfcfd';
		$default_nav_lnk = $is_dark_navbar ? '#ffffff' : '#1e293b';

		$top_bar_bg      = cartvai_theme_option( 'top_bar_bg_color', '#030712' );
		$top_bar_text    = cartvai_theme_option( 'top_bar_text_color', '#d1d5db' );
		$top_bar_py      = (int) cartvai_theme_option( 'top_bar_padding_y', 8 );
		$main_bar_bg     = cartvai_theme_option( 'main_bar_bg_color', '#ffffff' );
		$main_bar_border = cartvai_theme_option( 'main_bar_border_color', '#e5e7eb' );
		$main_bar_py     = (int) cartvai_theme_option( 'main_bar_padding_y', 18 );
		$nav_bar_bg      = cartvai_theme_option( 'nav_bar_bg_color', $default_nav_bg );
		$nav_bar_border  = cartvai_theme_option( 'nav_bar_border_color', $is_dark_navbar ? 'rgba(255, 255, 255, 0.1)' : '#e5e7eb' );
		$nav_bar_py      = (int) cartvai_theme_option( 'nav_bar_padding_y', 13 );
		$nav_link_color  = cartvai_theme_option( 'nav_link_color', $default_nav_lnk );
		$nav_link_hover  = cartvai_theme_option( 'nav_link_hover_color', $is_dark_navbar ? '#fde68a' : '#2563eb' );
		$nav_link_gap    = (int) cartvai_theme_option( 'nav_link_gap', 28 );
		$nav_font_size   = (int) cartvai_theme_option( 'nav_font_size', 14 );
		$nav_font_weight = cartvai_theme_option( 'nav_font_weight', '600' );

		// Footer Styling Tokens
		$footer_bg_color       = cartvai_theme_option( 'footer_bg_color', '#030712' );
		$footer_text_color     = cartvai_theme_option( 'footer_text_color', '#94a3b8' );
		$footer_heading_color  = cartvai_theme_option( 'footer_heading_color', '#ffffff' );
		$footer_link_color     = cartvai_theme_option( 'footer_link_color', '#d1d5db' );
		$footer_border_color   = cartvai_theme_option( 'footer_border_color', '#1f2937' );
		$footer_sub_bg_color   = cartvai_theme_option( 'footer_sub_bg_color', '#020617' );

		$footer_tokens  = "--cv-footer-bg: {$footer_bg_color}; ";
		$footer_tokens .= "--cv-footer-text: {$footer_text_color}; ";
		$footer_tokens .= "--cv-footer-heading: {$footer_heading_color}; ";
		$footer_tokens .= "--cv-footer-link: {$footer_link_color}; ";
		$footer_tokens .= "--cv-footer-border: {$footer_border_color}; ";
		$footer_tokens .= "--cv-footer-sub-bg: {$footer_sub_bg_color}; ";

		$theme_tokens  = ":root { " .
			"--cartvai-primary: {$primary_color}; " .
			"--cartvai-primary-hover: {$primary_hover}; " .
			"--cartvai-primary-light: {$primary_light}; " .
			"--cartvai-primary-deep: {$primary_hover}; " .
			"--color-primary: {$primary_color}; " .
			"--color-primary-hover: {$primary_hover}; " .
			"--cartvai-accent: {$accent_color}; " .
			"--cartvai-heading: {$heading_color}; " .
			"--cartvai-text: {$text_color}; " .
			"--cartvai-border: {$border_color}; " .
			"--cartvai-bg: {$bg_color}; " .
			"--cv-top-bar-bg: {$top_bar_bg}; " .
			"--cv-top-bar-text: {$top_bar_text}; " .
			"--cv-top-bar-py: {$top_bar_py}px; " .
			"--cv-main-bar-bg: {$main_bar_bg}; " .
			"--cv-main-bar-border: {$main_bar_border}; " .
			"--cv-main-bar-py: {$main_bar_py}px; " .
			"--cv-nav-bar-bg: {$nav_bar_bg}; " .
			"--cv-nav-bar-border: {$nav_bar_border}; " .
			"--cv-nav-bar-py: {$nav_bar_py}px; " .
			"--cv-nav-link-color: {$nav_link_color}; " .
			"--cv-nav-link-hover: {$nav_link_hover}; " .
			"--cv-nav-link-gap: {$nav_link_gap}px; " .
			"--cv-nav-font-size: {$nav_font_size}px; " .
			"--cv-nav-font-weight: {$nav_font_weight}; " .
			$footer_tokens .
		"}";
		wp_add_inline_style( 'cartvai-theme-styles', $theme_tokens );
		if ( wp_style_is( 'cartvai-variables', 'registered' ) ) {
			wp_add_inline_style( 'cartvai-variables', $theme_tokens );
		}
	}

	// Enqueue Theme Vanilla JS
	if ( file_exists( get_template_directory() . '/assets/js/theme.js' ) ) {
		wp_enqueue_script(
			'cartvai-theme-script',
			get_template_directory_uri() . '/assets/js/theme.js',
			array(),
			$theme_version,
			true
		);

		// Localize REST API & Config
		wp_localize_script(
			'cartvai-theme-script',
			'cartvaiThemeConfig',
			array(
				'restUrl'      => esc_url_raw( rest_url() ),
				'nonce'        => wp_create_nonce( 'wp_rest' ),
				'cartvaiNonce' => wp_create_nonce( 'cartvai_frontend_nonce' ),
				'ajaxUrl'      => admin_url( 'admin-ajax.php' ),
			)
		);
	}

	// Enqueue comment-reply for singular views with threaded comments
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'cartvai_theme_scripts' );

/**
 * Enqueue styles specifically for Gutenberg Block Editor
 */
function cartvai_theme_block_editor_assets() {
	wp_enqueue_style(
		'cartvai-editor-font',
		'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap',
		array(),
		null
	);

	if ( file_exists( get_template_directory() . '/assets/css/editor-style.css' ) ) {
		wp_enqueue_style(
			'cartvai-theme-editor-styles',
			get_template_directory_uri() . '/assets/css/editor-style.css',
			array( 'cartvai-editor-font' ),
			wp_get_theme()->get( 'Version' )
		);
	}
}
add_action( 'enqueue_block_editor_assets', 'cartvai_theme_block_editor_assets' );

/**
 * Defer non-critical frontend scripts to optimize First Contentful Paint and eliminate render-blocking.
 *
 * @param string $tag    The `<script>` tag.
 * @param string $handle The script handle.
 * @param string $src    The script src URL.
 * @return string Modified script tag.
 */
function cartvai_defer_frontend_scripts( $tag, $handle, $src ) {
	if ( is_admin() ) {
		return $tag;
	}

	$defer_handles = array(
		'jquery-core',
		'jquery-migrate',
		'cartvai-theme-script',
		'cartvai-shop',
		'cartvai-frontend',
		'cartvai-mini-cart',
		'cartvai-smart-discount-frontend',
		'cartvai-products-load-more',
		'cartvai-product-gallery-frontend',
	);

	if ( in_array( $handle, $defer_handles, true ) && false === strpos( $tag, 'defer' ) ) {
		return str_replace( ' src', ' defer src', $tag );
	}

	return $tag;
}
add_filter( 'script_loader_tag', 'cartvai_defer_frontend_scripts', 10, 3 );

/**
 * Load Google Fonts asynchronously to eliminate font render-blocking.
 *
 * @param string $tag    The `<link>` tag.
 * @param string $handle The style handle.
 * @param string $href   The stylesheet URL.
 * @param string $media  The stylesheet media attribute.
 * @return string Modified link tag.
 */
function cartvai_async_styles( $tag, $handle, $href, $media ) {
	if ( is_admin() ) {
		return $tag;
	}

	if ( 'cartvai-theme-font' === $handle ) {
		return '<link rel="preload" as="style" href="' . esc_url( $href ) . '">' .
		       '<link rel="stylesheet" id="' . esc_attr( $handle ) . '-css" href="' . esc_url( $href ) . '" media="print" onload="this.media=\'all\'">' .
		       '<noscript><link rel="stylesheet" href="' . esc_url( $href ) . '"></noscript>';
	}

	return $tag;
}
add_filter( 'style_loader_tag', 'cartvai_async_styles', 10, 4 );

// Disable core emoji scripts on frontend to eliminate unnecessary DOM mutations and script execution.
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
