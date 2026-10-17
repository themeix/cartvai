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
			array(),
			filemtime( get_template_directory() . '/assets/css/style.css' )
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
		$presets         = function_exists( 'cartvai_get_header_preset_defaults' )
			? cartvai_get_header_preset_defaults( $header_style )
			: array(
				'top_bar_bg'      => '#030712',
				'top_bar_text'    => '#d1d5db',
				'main_bar_bg'     => '#ffffff',
				'main_bar_border' => '#e5e7eb',
				'nav_bar_bg'      => '#ffffff',
				'nav_bar_border'  => '#e5e7eb',
				'nav_link_color'  => '#1e293b',
				'nav_link_hover'  => '#2563eb',
			);

		$custom_top_bg   = cartvai_theme_option( 'top_bar_bg_color', '' );
		$custom_top_text = cartvai_theme_option( 'top_bar_text_color', '' );
		$custom_main_bg  = cartvai_theme_option( 'main_bar_bg_color', '' );
		$custom_main_bdr = cartvai_theme_option( 'main_bar_border_color', '' );
		$custom_nav_bg   = cartvai_theme_option( 'nav_bar_bg_color', '' );
		$custom_nav_bdr  = cartvai_theme_option( 'nav_bar_border_color', '' );
		$custom_nav_lnk  = cartvai_theme_option( 'nav_link_color', '' );
		$custom_nav_hvr  = cartvai_theme_option( 'nav_link_hover_color', '' );

		// Recovery guard: if previous faulty form submission saved '#ffffff', light borders, or old green tones for megastore, restore preset
		if ( 'megastore' === $header_style ) {
			if ( in_array( strtolower( (string) $custom_main_bg ), array( '#ffffff', '#fff', '#0d3b2e', '#114738' ), true ) ) {
				$custom_main_bg = '';
			}
			if ( in_array( strtolower( (string) $custom_nav_bg ), array( '#fbfcfd', '#ffffff', '#fff', '#0a2f24', '#0d3b2e' ), true ) ) {
				$custom_nav_bg = '';
			}
			if ( in_array( strtolower( (string) $custom_top_bg ), array( '#07241b' ), true ) ) {
				$custom_top_bg = '';
			}
			if ( in_array( strtolower( (string) $custom_top_text ), array( '#d1fae5' ), true ) ) {
				$custom_top_text = '';
			}
			if ( in_array( strtolower( (string) $custom_nav_lnk ), array( '#1e293b' ), true ) ) {
				$custom_nav_lnk = '';
			}
			if ( in_array( strtolower( (string) $custom_main_bdr ), array( '#e5e7eb', '#e2e8f0', '#cbd5e1', '#ffffff', '#fff', '#f1f5f9' ), true ) ) {
				$custom_main_bdr = '';
			}
			if ( in_array( strtolower( (string) $custom_nav_bdr ), array( '#e5e7eb', '#e2e8f0', '#cbd5e1', '#ffffff', '#fff', '#f1f5f9' ), true ) ) {
				$custom_nav_bdr = '';
			}
		}

		$top_bar_bg      = ! empty( $custom_top_bg ) ? $custom_top_bg : $presets['top_bar_bg'];
		$top_bar_text    = ! empty( $custom_top_text ) ? $custom_top_text : $presets['top_bar_text'];
		$top_bar_py      = (int) cartvai_theme_option( 'top_bar_padding_y', 8 );

		$main_bar_bg     = ! empty( $custom_main_bg ) ? $custom_main_bg : $presets['main_bar_bg'];
		$is_dark_main_bg = function_exists( 'cartvai_is_dark_hex' ) ? cartvai_is_dark_hex( $main_bar_bg ) : true;

		// Clear light border on dark main header
		if ( $is_dark_main_bg && in_array( strtolower( (string) $custom_main_bdr ), array( '#e5e7eb', '#e2e8f0', '#cbd5e1', '#ffffff', '#fff', '#f1f5f9' ), true ) ) {
			$custom_main_bdr = '';
		}

		$main_bar_border = ! empty( $custom_main_bdr ) ? $custom_main_bdr : $presets['main_bar_border'];
		$main_bar_py     = (int) cartvai_theme_option( 'main_bar_padding_y', 18 );

		$nav_bar_bg      = ! empty( $custom_nav_bg ) ? $custom_nav_bg : $presets['nav_bar_bg'];
		$is_dark_nav_bg  = function_exists( 'cartvai_is_dark_hex' ) ? cartvai_is_dark_hex( $nav_bar_bg ) : true;

		// Clear light border on dark navbar
		if ( $is_dark_nav_bg && in_array( strtolower( (string) $custom_nav_bdr ), array( '#e5e7eb', '#e2e8f0', '#cbd5e1', '#ffffff', '#fff', '#f1f5f9' ), true ) ) {
			$custom_nav_bdr = '';
		}

		$nav_bar_border  = ! empty( $custom_nav_bdr ) ? $custom_nav_bdr : $presets['nav_bar_border'];
		$nav_bar_py      = (int) cartvai_theme_option( 'nav_bar_padding_y', 3 );

		$nav_link_color  = ! empty( $custom_nav_lnk ) ? $custom_nav_lnk : $presets['nav_link_color'];
		$nav_link_hover  = ! empty( $custom_nav_hvr ) ? $custom_nav_hvr : $presets['nav_link_hover'];
		$nav_link_gap    = (int) cartvai_theme_option( 'nav_link_gap', 28 );
		$nav_font_size   = (int) cartvai_theme_option( 'nav_font_size', 14 );
		$nav_font_weight = cartvai_theme_option( 'nav_font_weight', '600' );

		// Adaptive main bar text & tagline tokens
		$is_dark_main_bg  = function_exists( 'cartvai_is_dark_hex' ) ? cartvai_is_dark_hex( $main_bar_bg ) : true;
		$main_bar_text    = $is_dark_main_bg ? '#ffffff' : '#0f172a';
		$main_bar_tagline = $is_dark_main_bg ? '#fcd34d' : '#d97706';

		// Footer Styling Tokens
		$footer_style   = function_exists( 'cartvai_get_footer_style' ) ? cartvai_get_footer_style() : 'ecommerce';
		$footer_presets = function_exists( 'cartvai_get_footer_preset_defaults' )
			? cartvai_get_footer_preset_defaults( $footer_style )
			: array(
				'footer_bg'      => '#030712',
				'footer_text'    => '#94a3b8',
				'footer_heading' => '#ffffff',
				'footer_link'    => '#d1d5db',
				'footer_border'  => '#1f2937',
				'footer_sub_bg'  => '#020617',
			);

		$custom_footer_bg      = cartvai_theme_option( 'footer_bg_color', '' );
		$custom_footer_text    = cartvai_theme_option( 'footer_text_color', '' );
		$custom_footer_heading = cartvai_theme_option( 'footer_heading_color', '' );
		$custom_footer_link    = cartvai_theme_option( 'footer_link_color', '' );
		$custom_footer_border  = cartvai_theme_option( 'footer_border_color', '' );
		$custom_footer_sub_bg  = cartvai_theme_option( 'footer_sub_bg_color', '' );

		// Recovery guard: If footer style is 'organic' and stored background was saved as white or old dark fallback, restore organic preset
		if ( 'organic' === $footer_style ) {
			if ( in_array( strtolower( (string) $custom_footer_bg ), array( '#ffffff', '#fff', '#f8fafc', '#f1f5f9', '#030712' ), true ) ) {
				$custom_footer_bg = '';
			}
			if ( in_array( strtolower( (string) $custom_footer_sub_bg ), array( '#020617', '#ffffff', '#fff' ), true ) ) {
				$custom_footer_sub_bg = '';
			}
		} elseif ( 'warm_boutique' === $footer_style ) {
			if ( in_array( strtolower( (string) $custom_footer_bg ), array( '#030712', '#000000', '#020617' ), true ) ) {
				$custom_footer_bg = '';
			}
			if ( in_array( strtolower( (string) $custom_footer_sub_bg ), array( '#020617', '#000000' ), true ) ) {
				$custom_footer_sub_bg = '';
			}
		}

		$footer_bg_color      = ! empty( $custom_footer_bg ) ? $custom_footer_bg : $footer_presets['footer_bg'];
		$footer_text_color    = ! empty( $custom_footer_text ) ? $custom_footer_text : $footer_presets['footer_text'];
		$footer_heading_color = ! empty( $custom_footer_heading ) ? $custom_footer_heading : $footer_presets['footer_heading'];
		$footer_link_color    = ! empty( $custom_footer_link ) ? $custom_footer_link : $footer_presets['footer_link'];
		$footer_border_color  = ! empty( $custom_footer_border ) ? $custom_footer_border : $footer_presets['footer_border'];
		$footer_sub_bg_color  = ! empty( $custom_footer_sub_bg ) ? $custom_footer_sub_bg : $footer_presets['footer_sub_bg'];

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
			"--cv-main-bar-text: {$main_bar_text}; " .
			"--cv-main-bar-tagline: {$main_bar_tagline}; " .
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
				'searchNonce'  => wp_create_nonce( 'cartvai_ajax_search_nonce' ),
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
		'cartvai-product-variations',
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
