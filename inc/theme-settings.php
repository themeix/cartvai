<?php
/**
 * Cartvai Theme Settings Admin Page
 *
 * Implements the standard Cartvai plugin admin design:
 * - Cartvai header icon & clean layout (.cartvai-wrap)
 * - Modern tabbed navigation (Header, Footer, Design & Colors, Product Cards)
 * - Official Cartvai toggle switches (.cartvai-toggle-switch)
 * - High-end compact cards and action buttons
 * - Restricted strictly by custom capability: 'manage_cartvai_theme'
 * - Single-point design token & product card options synchronization across full site
 *
 * @package Cartvai_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register Theme Settings Menu Page
 */
function cartvai_theme_add_admin_menu() {
	$cap = defined( 'CARTVAI_THEME_CAPABILITY' ) ? CARTVAI_THEME_CAPABILITY : 'manage_options';

	add_theme_page(
		esc_html__( 'Cartvai Theme Settings', 'cartvai-theme' ),
		esc_html__( 'Theme Settings', 'cartvai-theme' ),
		$cap,
		'cartvai-theme-settings',
		'cartvai_theme_render_settings_page'
	);
}
add_action( 'admin_menu', 'cartvai_theme_add_admin_menu' );

/**
 * Enqueue Cartvai plugin admin styles on this page if present
 */
function cartvai_theme_enqueue_admin_assets( $hook ) {
	if ( strpos( $hook, 'cartvai-theme-settings' ) === false ) {
		return;
	}

	wp_enqueue_media();
	wp_enqueue_style( 'dashicons' );

	if ( defined( 'CARTVAI_PLUGIN_URL' ) && file_exists( CARTVAI_PLUGIN_DIR . 'assets/css/admin.css' ) ) {
		wp_enqueue_style(
			'cartvai-admin-styles',
			CARTVAI_PLUGIN_URL . 'assets/css/admin.css',
			array( 'dashicons' ),
			defined( 'CARTVAI_VERSION' ) ? CARTVAI_VERSION : '1.0.0'
		);
	}
}
add_action( 'admin_enqueue_scripts', 'cartvai_theme_enqueue_admin_assets' );

/**
 * Helper to normalize hex colors
 */
function cartvai_theme_normalize_hex( $color, $default = '#2563eb' ) {
	$color = sanitize_hex_color( trim( (string) $color ) );
	return ! empty( $color ) ? $color : $default;
}

/**
 * Render Theme Settings Page
 */
function cartvai_theme_render_settings_page() {
	$cap = defined( 'CARTVAI_THEME_CAPABILITY' ) ? CARTVAI_THEME_CAPABILITY : 'manage_options';

	if ( ! current_user_can( $cap ) ) {
		wp_die( esc_html__( 'You do not have sufficient permissions to access these theme settings.', 'cartvai-theme' ) );
	}

	$message = '';

	// Handle Save Form Submission
	if ( isset( $_POST['cartvai_theme_nonce'] ) && wp_verify_nonce( sanitize_key( $_POST['cartvai_theme_nonce'] ), 'cartvai_theme_save_settings' ) ) {
		$settings = array(
			// Header Options
			'header_style'                       => isset( $_POST['header_style'] ) ? sanitize_key( $_POST['header_style'] ) : 'ecommerce',
			'announcement_enabled'               => ! empty( $_POST['announcement_enabled'] ) ? 1 : 0,
			'announcement_text'                  => isset( $_POST['announcement_text'] ) ? sanitize_text_field( wp_unslash( $_POST['announcement_text'] ) ) : '',
			'contact_phone'                      => isset( $_POST['contact_phone'] ) ? sanitize_text_field( wp_unslash( $_POST['contact_phone'] ) ) : '',
			'popular_categories_enabled'         => ! empty( $_POST['popular_categories_enabled'] ) ? 1 : 0,
			'header_order_track_enabled'         => ! empty( $_POST['header_order_track_enabled'] ) ? 1 : 0,
			'header_order_track_label'           => isset( $_POST['header_order_track_label'] ) ? sanitize_text_field( wp_unslash( $_POST['header_order_track_label'] ) ) : 'Order Track',
			'header_order_track_url'             => isset( $_POST['header_order_track_url'] ) ? esc_url_raw( wp_unslash( $_POST['header_order_track_url'] ) ) : '',
			'header_more_enabled'                => ! empty( $_POST['header_more_enabled'] ) ? 1 : 0,

			// Homepage Options
			'homepage_hero_badge'                => isset( $_POST['homepage_hero_badge'] ) ? sanitize_text_field( wp_unslash( $_POST['homepage_hero_badge'] ) ) : '⚡ LIMITED TIME MEGA SALE • UP TO 50% OFF',
			'homepage_hero_title'                => isset( $_POST['homepage_hero_title'] ) ? sanitize_text_field( wp_unslash( $_POST['homepage_hero_title'] ) ) : 'Next-Gen Tech & Premium Lifestyle Gear',
			'homepage_hero_subtitle'             => isset( $_POST['homepage_hero_subtitle'] ) ? sanitize_text_field( wp_unslash( $_POST['homepage_hero_subtitle'] ) ) : 'Upgrade your daily routine with top-rated smart devices, audio accessories, and modern essentials at unbeatable prices.',
			'homepage_hero_btn1_text'            => isset( $_POST['homepage_hero_btn1_text'] ) ? sanitize_text_field( wp_unslash( $_POST['homepage_hero_btn1_text'] ) ) : 'Shop Collection',
			'homepage_hero_btn1_url'             => isset( $_POST['homepage_hero_btn1_url'] ) ? esc_url_raw( wp_unslash( $_POST['homepage_hero_btn1_url'] ) ) : '',
			'homepage_hero_btn2_text'            => isset( $_POST['homepage_hero_btn2_text'] ) ? sanitize_text_field( wp_unslash( $_POST['homepage_hero_btn2_text'] ) ) : 'View Flash Deals',
			'homepage_hero_btn2_url'             => isset( $_POST['homepage_hero_btn2_url'] ) ? esc_url_raw( wp_unslash( $_POST['homepage_hero_btn2_url'] ) ) : '',
			'homepage_hero_perks'                => isset( $_POST['homepage_hero_perks'] ) ? sanitize_text_field( wp_unslash( $_POST['homepage_hero_perks'] ) ) : '✓ Free Express Delivery • ✓ 30-Day Money-Back • ✓ Official Warranty',
			'homepage_hero_image'                => isset( $_POST['homepage_hero_image'] ) ? esc_url_raw( wp_unslash( $_POST['homepage_hero_image'] ) ) : '',

			'homepage_promo1_badge'              => isset( $_POST['homepage_promo1_badge'] ) ? sanitize_text_field( wp_unslash( $_POST['homepage_promo1_badge'] ) ) : '🔥 TRENDING DEAL',
			'homepage_promo1_title'              => isset( $_POST['homepage_promo1_title'] ) ? sanitize_text_field( wp_unslash( $_POST['homepage_promo1_title'] ) ) : 'Wireless Spatial Audio',
			'homepage_promo1_desc'               => isset( $_POST['homepage_promo1_desc'] ) ? sanitize_text_field( wp_unslash( $_POST['homepage_promo1_desc'] ) ) : 'Immersive acoustic clarity with 40-hour ultra battery life.',
			'homepage_promo1_price'              => isset( $_POST['homepage_promo1_price'] ) ? sanitize_text_field( wp_unslash( $_POST['homepage_promo1_price'] ) ) : 'Starting at $29.99',
			'homepage_promo1_btn_text'           => isset( $_POST['homepage_promo1_btn_text'] ) ? sanitize_text_field( wp_unslash( $_POST['homepage_promo1_btn_text'] ) ) : 'Shop Now',
			'homepage_promo1_url'                => isset( $_POST['homepage_promo1_url'] ) ? esc_url_raw( wp_unslash( $_POST['homepage_promo1_url'] ) ) : '',

			'homepage_promo2_badge'              => isset( $_POST['homepage_promo2_badge'] ) ? sanitize_text_field( wp_unslash( $_POST['homepage_promo2_badge'] ) ) : '⚡ FLASH OFFER',
			'homepage_promo2_title'              => isset( $_POST['homepage_promo2_title'] ) ? sanitize_text_field( wp_unslash( $_POST['homepage_promo2_title'] ) ) : 'Smart Wearables & Fit Tech',
			'homepage_promo2_desc'               => isset( $_POST['homepage_promo2_desc'] ) ? sanitize_text_field( wp_unslash( $_POST['homepage_promo2_desc'] ) ) : 'Real-time health telemetry with crisp AMOLED display.',
			'homepage_promo2_price'              => isset( $_POST['homepage_promo2_price'] ) ? sanitize_text_field( wp_unslash( $_POST['homepage_promo2_price'] ) ) : 'Save Up To 40% OFF',
			'homepage_promo2_btn_text'           => isset( $_POST['homepage_promo2_btn_text'] ) ? sanitize_text_field( wp_unslash( $_POST['homepage_promo2_btn_text'] ) ) : 'Explore Deals',
			'homepage_promo2_url'                => isset( $_POST['homepage_promo2_url'] ) ? esc_url_raw( wp_unslash( $_POST['homepage_promo2_url'] ) ) : '',

			'homepage_trust_enabled'             => ! empty( $_POST['homepage_trust_enabled'] ) ? 1 : 0,

			// Header & Navbar Styling
			'top_bar_bg_color'                   => cartvai_theme_normalize_hex( $_POST['top_bar_bg_color'] ?? '#030712', '#030712' ),
			'top_bar_text_color'                 => cartvai_theme_normalize_hex( $_POST['top_bar_text_color'] ?? '#d1d5db', '#d1d5db' ),
			'top_bar_padding_y'                  => isset( $_POST['top_bar_padding_y'] ) ? max( 0, min( 40, (int) $_POST['top_bar_padding_y'] ) ) : 8,
			'main_bar_bg_color'                  => cartvai_theme_normalize_hex( $_POST['main_bar_bg_color'] ?? '#ffffff', '#ffffff' ),
			'main_bar_border_color'              => cartvai_theme_normalize_hex( $_POST['main_bar_border_color'] ?? '#e5e7eb', '#e5e7eb' ),
			'main_bar_padding_y'                 => isset( $_POST['main_bar_padding_y'] ) ? max( 4, min( 60, (int) $_POST['main_bar_padding_y'] ) ) : 18,
			'nav_bar_bg_color'                   => cartvai_theme_normalize_hex( $_POST['nav_bar_bg_color'] ?? '#fbfcfd', '#fbfcfd' ),
			'nav_bar_border_color'               => cartvai_theme_normalize_hex( $_POST['nav_bar_border_color'] ?? '#e5e7eb', '#e5e7eb' ),
			'nav_bar_padding_y'                  => isset( $_POST['nav_bar_padding_y'] ) ? max( 2, min( 40, (int) $_POST['nav_bar_padding_y'] ) ) : 13,
			'nav_link_color'                     => cartvai_theme_normalize_hex( $_POST['nav_link_color'] ?? '#1e293b', '#1e293b' ),
			'nav_link_hover_color'               => cartvai_theme_normalize_hex( $_POST['nav_link_hover_color'] ?? '#2563eb', '#2563eb' ),
			'nav_link_gap'                       => isset( $_POST['nav_link_gap'] ) ? max( 8, min( 60, (int) $_POST['nav_link_gap'] ) ) : 28,
			'nav_font_size'                      => isset( $_POST['nav_font_size'] ) ? max( 11, min( 22, (int) $_POST['nav_font_size'] ) ) : 14,
			'nav_font_weight'                    => isset( $_POST['nav_font_weight'] ) ? sanitize_text_field( wp_unslash( $_POST['nav_font_weight'] ) ) : '600',

			// Footer Options
			'footer_style'                       => isset( $_POST['footer_style'] ) ? sanitize_key( $_POST['footer_style'] ) : 'ecommerce',
			'footer_trust_enabled'               => ! empty( $_POST['footer_trust_enabled'] ) ? 1 : 0,
			'footer_trust_1_title'               => isset( $_POST['footer_trust_1_title'] ) ? sanitize_text_field( wp_unslash( $_POST['footer_trust_1_title'] ) ) : '',
			'footer_trust_1_desc'                => isset( $_POST['footer_trust_1_desc'] ) ? sanitize_text_field( wp_unslash( $_POST['footer_trust_1_desc'] ) ) : '',
			'footer_trust_2_title'               => isset( $_POST['footer_trust_2_title'] ) ? sanitize_text_field( wp_unslash( $_POST['footer_trust_2_title'] ) ) : '',
			'footer_trust_2_desc'                => isset( $_POST['footer_trust_2_desc'] ) ? sanitize_text_field( wp_unslash( $_POST['footer_trust_2_desc'] ) ) : '',
			'footer_trust_3_title'               => isset( $_POST['footer_trust_3_title'] ) ? sanitize_text_field( wp_unslash( $_POST['footer_trust_3_title'] ) ) : '',
			'footer_trust_3_desc'                => isset( $_POST['footer_trust_3_desc'] ) ? sanitize_text_field( wp_unslash( $_POST['footer_trust_3_desc'] ) ) : '',
			'footer_trust_4_title'               => isset( $_POST['footer_trust_4_title'] ) ? sanitize_text_field( wp_unslash( $_POST['footer_trust_4_title'] ) ) : '',
			'footer_trust_4_desc'                => isset( $_POST['footer_trust_4_desc'] ) ? sanitize_text_field( wp_unslash( $_POST['footer_trust_4_desc'] ) ) : '',

			'footer_newsletter_enabled'          => ! empty( $_POST['footer_newsletter_enabled'] ) ? 1 : 0,
			'footer_newsletter_title'            => isset( $_POST['footer_newsletter_title'] ) ? sanitize_text_field( wp_unslash( $_POST['footer_newsletter_title'] ) ) : '',
			'footer_newsletter_desc'             => isset( $_POST['footer_newsletter_desc'] ) ? sanitize_text_field( wp_unslash( $_POST['footer_newsletter_desc'] ) ) : '',

			'footer_about_text'                  => isset( $_POST['footer_about_text'] ) ? sanitize_textarea_field( wp_unslash( $_POST['footer_about_text'] ) ) : '',
			'footer_store_address'               => isset( $_POST['footer_store_address'] ) ? sanitize_text_field( wp_unslash( $_POST['footer_store_address'] ) ) : '',
			'contact_email'                      => isset( $_POST['contact_email'] ) ? sanitize_email( wp_unslash( $_POST['contact_email'] ) ) : '',
			'footer_security_note'               => isset( $_POST['footer_security_note'] ) ? sanitize_text_field( wp_unslash( $_POST['footer_security_note'] ) ) : '',
			'footer_copyright_text'              => isset( $_POST['footer_copyright_text'] ) ? sanitize_text_field( wp_unslash( $_POST['footer_copyright_text'] ) ) : '',
			'footer_bg_color'                    => isset( $_POST['footer_bg_color'] ) ? sanitize_hex_color( $_POST['footer_bg_color'] ) : '',
			'footer_heading_color'               => isset( $_POST['footer_heading_color'] ) ? sanitize_hex_color( $_POST['footer_heading_color'] ) : '',
			'footer_sub_bg_color'                => isset( $_POST['footer_sub_bg_color'] ) ? sanitize_text_field( wp_unslash( $_POST['footer_sub_bg_color'] ) ) : '',
			'footer_payment_image'               => isset( $_POST['footer_payment_image'] ) ? esc_url_raw( wp_unslash( $_POST['footer_payment_image'] ) ) : '',

			// Design & Global Colors
			'primary_color'                      => cartvai_theme_normalize_hex( $_POST['primary_color'] ?? '#2563eb', '#2563eb' ),
			'primary_hover_color'                => cartvai_theme_normalize_hex( $_POST['primary_hover_color'] ?? '#1d4ed8', '#1d4ed8' ),
			'primary_light_color'                => cartvai_theme_normalize_hex( $_POST['primary_light_color'] ?? '#eff6ff', '#eff6ff' ),
			'accent_color'                       => cartvai_theme_normalize_hex( $_POST['accent_color'] ?? '#0f172a', '#0f172a' ),
			'heading_color'                      => cartvai_theme_normalize_hex( $_POST['heading_color'] ?? '#0f172a', '#0f172a' ),
			'text_color'                         => cartvai_theme_normalize_hex( $_POST['text_color'] ?? '#334155', '#334155' ),
			'border_color'                       => cartvai_theme_normalize_hex( $_POST['border_color'] ?? '#e2e8f0', '#e2e8f0' ),
			'bg_color'                           => cartvai_theme_normalize_hex( $_POST['bg_color'] ?? '#f8fafc', '#f8fafc' ),

			// Product & Card Display Options
			'shop_page_hide_short_description'   => ! empty( $_POST['shop_page_hide_short_description'] ) ? 1 : 0,
			'shop_page_hide_quantity'            => ! empty( $_POST['shop_page_hide_quantity'] ) ? 1 : 0,
			'shop_page_hide_buy_now'             => ! empty( $_POST['shop_page_hide_buy_now'] ) ? 1 : 0,
			'shop_page_hide_add_to_cart'         => ! empty( $_POST['shop_page_hide_add_to_cart'] ) ? 1 : 0,
			'shop_page_hide_off_badge'           => ! empty( $_POST['shop_page_hide_off_badge'] ) ? 1 : 0,
			'shop_page_hide_save_badge'          => ! empty( $_POST['shop_page_hide_save_badge'] ) ? 1 : 0,
		);

		update_option( 'cartvai_theme_settings', $settings );

		// Sync core mods for customizer compatibility
		set_theme_mod( 'cartvai_header_style', $settings['header_style'] );
		set_theme_mod( 'cartvai_footer_style', $settings['footer_style'] );
		set_theme_mod( 'cartvai_announcement_enabled', (bool) $settings['announcement_enabled'] );
		set_theme_mod( 'cartvai_announcement_text', $settings['announcement_text'] );
		set_theme_mod( 'cartvai_contact_phone', $settings['contact_phone'] );
		set_theme_mod( 'cartvai_popular_categories_enabled', (bool) $settings['popular_categories_enabled'] );
		set_theme_mod( 'cartvai_header_order_track_enabled', (bool) $settings['header_order_track_enabled'] );
		set_theme_mod( 'cartvai_header_order_track_label', $settings['header_order_track_label'] );
		set_theme_mod( 'cartvai_header_order_track_url', $settings['header_order_track_url'] );
		set_theme_mod( 'cartvai_header_more_enabled', (bool) $settings['header_more_enabled'] );
		set_theme_mod( 'cartvai_footer_trust_enabled', (bool) $settings['footer_trust_enabled'] );
		set_theme_mod( 'cartvai_footer_newsletter_enabled', (bool) $settings['footer_newsletter_enabled'] );
		set_theme_mod( 'cartvai_contact_email', $settings['contact_email'] );
		set_theme_mod( 'cartvai_footer_store_address', $settings['footer_store_address'] );
		set_theme_mod( 'cartvai_footer_copyright_text', $settings['footer_copyright_text'] );
		set_theme_mod( 'cartvai_footer_bg_color', $settings['footer_bg_color'] );
		set_theme_mod( 'cartvai_footer_heading_color', $settings['footer_heading_color'] );
		set_theme_mod( 'cartvai_footer_sub_bg_color', $settings['footer_sub_bg_color'] );
		set_theme_mod( 'cartvai_footer_payment_image', $settings['footer_payment_image'] );

		// Sync homepage mods
		set_theme_mod( 'cartvai_homepage_hero_badge', $settings['homepage_hero_badge'] );
		set_theme_mod( 'cartvai_homepage_hero_title', $settings['homepage_hero_title'] );
		set_theme_mod( 'cartvai_homepage_hero_subtitle', $settings['homepage_hero_subtitle'] );
		set_theme_mod( 'cartvai_homepage_hero_btn1_text', $settings['homepage_hero_btn1_text'] );
		set_theme_mod( 'cartvai_homepage_hero_btn1_url', $settings['homepage_hero_btn1_url'] );
		set_theme_mod( 'cartvai_homepage_hero_btn2_text', $settings['homepage_hero_btn2_text'] );
		set_theme_mod( 'cartvai_homepage_hero_btn2_url', $settings['homepage_hero_btn2_url'] );
		set_theme_mod( 'cartvai_homepage_hero_perks', $settings['homepage_hero_perks'] );
		set_theme_mod( 'cartvai_homepage_hero_image', $settings['homepage_hero_image'] );

		set_theme_mod( 'cartvai_homepage_promo1_badge', $settings['homepage_promo1_badge'] );
		set_theme_mod( 'cartvai_homepage_promo1_title', $settings['homepage_promo1_title'] );
		set_theme_mod( 'cartvai_homepage_promo1_desc', $settings['homepage_promo1_desc'] );
		set_theme_mod( 'cartvai_homepage_promo1_price', $settings['homepage_promo1_price'] );
		set_theme_mod( 'cartvai_homepage_promo1_btn_text', $settings['homepage_promo1_btn_text'] );
		set_theme_mod( 'cartvai_homepage_promo1_url', $settings['homepage_promo1_url'] );

		set_theme_mod( 'cartvai_homepage_promo2_badge', $settings['homepage_promo2_badge'] );
		set_theme_mod( 'cartvai_homepage_promo2_title', $settings['homepage_promo2_title'] );
		set_theme_mod( 'cartvai_homepage_promo2_desc', $settings['homepage_promo2_desc'] );
		set_theme_mod( 'cartvai_homepage_promo2_price', $settings['homepage_promo2_price'] );
		set_theme_mod( 'cartvai_homepage_promo2_btn_text', $settings['homepage_promo2_btn_text'] );
		set_theme_mod( 'cartvai_homepage_promo2_url', $settings['homepage_promo2_url'] );

		set_theme_mod( 'cartvai_homepage_trust_enabled', (bool) $settings['homepage_trust_enabled'] );

		// Sync header & navbar mods
		set_theme_mod( 'cartvai_top_bar_bg_color', $settings['top_bar_bg_color'] );
		set_theme_mod( 'cartvai_top_bar_text_color', $settings['top_bar_text_color'] );
		set_theme_mod( 'cartvai_top_bar_padding_y', $settings['top_bar_padding_y'] );
		set_theme_mod( 'cartvai_main_bar_bg_color', $settings['main_bar_bg_color'] );
		set_theme_mod( 'cartvai_main_bar_border_color', $settings['main_bar_border_color'] );
		set_theme_mod( 'cartvai_main_bar_padding_y', $settings['main_bar_padding_y'] );
		set_theme_mod( 'cartvai_nav_bar_bg_color', $settings['nav_bar_bg_color'] );
		set_theme_mod( 'cartvai_nav_bar_border_color', $settings['nav_bar_border_color'] );
		set_theme_mod( 'cartvai_nav_bar_padding_y', $settings['nav_bar_padding_y'] );
		set_theme_mod( 'cartvai_nav_link_color', $settings['nav_link_color'] );
		set_theme_mod( 'cartvai_nav_link_hover_color', $settings['nav_link_hover_color'] );
		set_theme_mod( 'cartvai_nav_link_gap', $settings['nav_link_gap'] );
		set_theme_mod( 'cartvai_nav_font_size', $settings['nav_font_size'] );
		set_theme_mod( 'cartvai_nav_font_weight', $settings['nav_font_weight'] );

		// Sync color mods
		set_theme_mod( 'cartvai_primary_color', $settings['primary_color'] );
		set_theme_mod( 'cartvai_primary_hover_color', $settings['primary_hover_color'] );
		set_theme_mod( 'cartvai_primary_light_color', $settings['primary_light_color'] );
		set_theme_mod( 'cartvai_accent_color', $settings['accent_color'] );
		set_theme_mod( 'cartvai_heading_color', $settings['heading_color'] );
		set_theme_mod( 'cartvai_text_color', $settings['text_color'] );
		set_theme_mod( 'cartvai_border_color', $settings['border_color'] );
		set_theme_mod( 'cartvai_bg_color', $settings['bg_color'] );

		// Sync product card mods
		set_theme_mod( 'cartvai_shop_page_hide_short_description', (bool) $settings['shop_page_hide_short_description'] );
		set_theme_mod( 'cartvai_shop_page_hide_quantity', (bool) $settings['shop_page_hide_quantity'] );
		set_theme_mod( 'cartvai_shop_page_hide_buy_now', (bool) $settings['shop_page_hide_buy_now'] );
		set_theme_mod( 'cartvai_shop_page_hide_add_to_cart', (bool) $settings['shop_page_hide_add_to_cart'] );
		set_theme_mod( 'cartvai_shop_page_hide_off_badge', (bool) $settings['shop_page_hide_off_badge'] );
		set_theme_mod( 'cartvai_shop_page_hide_save_badge', (bool) $settings['shop_page_hide_save_badge'] );

		// Single Source of Truth: sync into CARTVAI_Settings (plugin)
		if ( class_exists( 'CARTVAI_Settings' ) ) {
			CARTVAI_Settings::set( 'design_primary_color', $settings['primary_color'] );
			CARTVAI_Settings::set( 'design_primary_deep_color', $settings['primary_hover_color'] );
			CARTVAI_Settings::set( 'design_primary_light_color', $settings['primary_light_color'] );
			CARTVAI_Settings::set( 'design_heading_color', $settings['heading_color'] );
			CARTVAI_Settings::set( 'design_text_color', $settings['text_color'] );
			CARTVAI_Settings::set( 'design_border_color', $settings['border_color'] );

			CARTVAI_Settings::set( 'shop_page_hide_short_description', (bool) $settings['shop_page_hide_short_description'] );
			CARTVAI_Settings::set( 'shop_page_hide_quantity', (bool) $settings['shop_page_hide_quantity'] );
			CARTVAI_Settings::set( 'shop_page_hide_buy_now', (bool) $settings['shop_page_hide_buy_now'] );
			CARTVAI_Settings::set( 'shop_page_hide_add_to_cart', (bool) $settings['shop_page_hide_add_to_cart'] );
			CARTVAI_Settings::set( 'shop_page_hide_off_badge', (bool) $settings['shop_page_hide_off_badge'] );
			CARTVAI_Settings::set( 'shop_page_hide_save_badge', (bool) $settings['shop_page_hide_save_badge'] );
		}

		$message = esc_html__( 'Settings saved and synchronized successfully!', 'cartvai-theme' );
	}

	// Current Saved Values
	$current_header             = cartvai_theme_option( 'header_style', 'ecommerce' );
	$current_footer             = cartvai_theme_option( 'footer_style', 'ecommerce' );
	$announcement_enabled       = (bool) cartvai_theme_option( 'announcement_enabled', true );
	$announcement_text          = cartvai_theme_option( 'announcement_text', '⚡ Flash Sale: Enjoy free shipping on orders over $50! Shop Now' );
	$contact_phone              = cartvai_theme_option( 'contact_phone', '+1 (800) 123-4567' );
	$popular_categories_enabled  = (bool) cartvai_theme_option( 'popular_categories_enabled', true );
	$header_order_track_enabled  = (bool) cartvai_theme_option( 'header_order_track_enabled', false );
	$header_order_track_label    = cartvai_theme_option( 'header_order_track_label', 'Order Track' );
	$header_order_track_url      = cartvai_theme_option( 'header_order_track_url', '' );
	$header_more_enabled         = (bool) cartvai_theme_option( 'header_more_enabled', true );

	// Homepage Options
	$homepage_hero_badge      = cartvai_theme_option( 'homepage_hero_badge', '⚡ LIMITED TIME MEGA SALE • UP TO 50% OFF' );
	$homepage_hero_title      = cartvai_theme_option( 'homepage_hero_title', 'Next-Gen Tech & Premium Lifestyle Gear' );
	$homepage_hero_subtitle   = cartvai_theme_option( 'homepage_hero_subtitle', 'Upgrade your daily routine with top-rated smart devices, audio accessories, and modern essentials at unbeatable prices.' );
	$homepage_hero_btn1_text  = cartvai_theme_option( 'homepage_hero_btn1_text', 'Shop Collection' );
	$homepage_hero_btn1_url   = cartvai_theme_option( 'homepage_hero_btn1_url', '' );
	$homepage_hero_btn2_text  = cartvai_theme_option( 'homepage_hero_btn2_text', 'View Flash Deals' );
	$homepage_hero_btn2_url   = cartvai_theme_option( 'homepage_hero_btn2_url', '' );
	$homepage_hero_perks      = cartvai_theme_option( 'homepage_hero_perks', '✓ Free Express Delivery • ✓ 30-Day Money-Back • ✓ Official Warranty' );
	$homepage_hero_image      = cartvai_theme_option( 'homepage_hero_image', '' );

	$homepage_promo1_badge    = cartvai_theme_option( 'homepage_promo1_badge', '🔥 TRENDING DEAL' );
	$homepage_promo1_title    = cartvai_theme_option( 'homepage_promo1_title', 'Wireless Spatial Audio' );
	$homepage_promo1_desc     = cartvai_theme_option( 'homepage_promo1_desc', 'Immersive acoustic clarity with 40-hour ultra battery life.' );
	$homepage_promo1_price    = cartvai_theme_option( 'homepage_promo1_price', 'Starting at $29.99' );
	$homepage_promo1_btn_text = cartvai_theme_option( 'homepage_promo1_btn_text', 'Shop Now' );
	$homepage_promo1_url      = cartvai_theme_option( 'homepage_promo1_url', '' );

	$homepage_promo2_badge    = cartvai_theme_option( 'homepage_promo2_badge', '⚡ FLASH OFFER' );
	$homepage_promo2_title    = cartvai_theme_option( 'homepage_promo2_title', 'Smart Wearables & Fit Tech' );
	$homepage_promo2_desc     = cartvai_theme_option( 'homepage_promo2_desc', 'Real-time health telemetry with crisp AMOLED display.' );
	$homepage_promo2_price    = cartvai_theme_option( 'homepage_promo2_price', 'Save Up To 40% OFF' );
	$homepage_promo2_btn_text = cartvai_theme_option( 'homepage_promo2_btn_text', 'Explore Deals' );
	$homepage_promo2_url      = cartvai_theme_option( 'homepage_promo2_url', '' );

	$homepage_trust_enabled   = (bool) cartvai_theme_option( 'homepage_trust_enabled', true );

	// Header & Navbar Styling
	$top_bar_bg_color       = cartvai_theme_option( 'top_bar_bg_color', '#030712' );
	$top_bar_text_color     = cartvai_theme_option( 'top_bar_text_color', '#d1d5db' );
	$top_bar_padding_y      = (int) cartvai_theme_option( 'top_bar_padding_y', 8 );
	$main_bar_bg_color      = cartvai_theme_option( 'main_bar_bg_color', '#ffffff' );
	$main_bar_border_color  = cartvai_theme_option( 'main_bar_border_color', '#e5e7eb' );
	$main_bar_padding_y     = (int) cartvai_theme_option( 'main_bar_padding_y', 18 );
	$nav_bar_bg_color       = cartvai_theme_option( 'nav_bar_bg_color', '#fbfcfd' );
	$nav_bar_border_color   = cartvai_theme_option( 'nav_bar_border_color', '#e5e7eb' );
	$nav_bar_padding_y      = (int) cartvai_theme_option( 'nav_bar_padding_y', 13 );
	$nav_link_color         = cartvai_theme_option( 'nav_link_color', '#1e293b' );
	$nav_link_hover_color   = cartvai_theme_option( 'nav_link_hover_color', '#2563eb' );
	$nav_link_gap           = (int) cartvai_theme_option( 'nav_link_gap', 28 );
	$nav_font_size          = (int) cartvai_theme_option( 'nav_font_size', 14 );
	$nav_font_weight        = cartvai_theme_option( 'nav_font_weight', '600' );

	$footer_trust_enabled      = (bool) cartvai_theme_option( 'footer_trust_enabled', true );
	$footer_trust_1_title      = cartvai_theme_option( 'footer_trust_1_title', 'Free Fast Shipping' );
	$footer_trust_1_desc       = cartvai_theme_option( 'footer_trust_1_desc', 'On all orders above $50' );
	$footer_trust_2_title      = cartvai_theme_option( 'footer_trust_2_title', '100% Safe Payments' );
	$footer_trust_2_desc       = cartvai_theme_option( 'footer_trust_2_desc', 'Encrypted SSL checkout' );
	$footer_trust_3_title      = cartvai_theme_option( 'footer_trust_3_title', 'Hassle-Free Returns' );
	$footer_trust_3_desc       = cartvai_theme_option( 'footer_trust_3_desc', '7 days replacement warranty' );
	$footer_trust_4_title      = cartvai_theme_option( 'footer_trust_4_title', '24/7 Priority Support' );
	$footer_trust_4_desc       = cartvai_theme_option( 'footer_trust_4_desc', 'Dedicated support team' );

	$footer_newsletter_enabled = (bool) cartvai_theme_option( 'footer_newsletter_enabled', true );
	$footer_newsletter_title   = cartvai_theme_option( 'footer_newsletter_title', 'Get 10% Off' );
	$footer_newsletter_desc    = cartvai_theme_option( 'footer_newsletter_desc', 'Subscribe for insider deals, new drop alerts, and VIP discounts.' );

	$footer_about_text         = cartvai_theme_option( 'footer_about_text', get_bloginfo( 'description' ) );
	$footer_store_address      = cartvai_theme_option( 'footer_store_address', 'Level-5, Noor Tower, 110 Bir Uttam CR Dutta Rd, Dhaka 1205' );
	$contact_email             = cartvai_theme_option( 'contact_email', 'support@cartvai.com' );
	$footer_security_note      = cartvai_theme_option( 'footer_security_note', 'Guaranteed Safe Checkout' );
	$footer_copyright_text     = cartvai_theme_option( 'footer_copyright_text', '© {year} {site_name}. All rights reserved.' );
	$footer_bg_color           = cartvai_theme_option( 'footer_bg_color', '' );
	$footer_heading_color      = cartvai_theme_option( 'footer_heading_color', '' );
	$footer_sub_bg_color       = cartvai_theme_option( 'footer_sub_bg_color', '' );
	$footer_payment_image      = cartvai_theme_option( 'footer_payment_image', '' );

	// Colors
	$primary_color       = cartvai_theme_option( 'primary_color', '#2563eb' );
	$primary_hover_color = cartvai_theme_option( 'primary_hover_color', '#1d4ed8' );
	$primary_light_color = cartvai_theme_option( 'primary_light_color', '#eff6ff' );
	$accent_color        = cartvai_theme_option( 'accent_color', '#0f172a' );
	$heading_color       = cartvai_theme_option( 'heading_color', '#0f172a' );
	$text_color          = cartvai_theme_option( 'text_color', '#334155' );
	$border_color        = cartvai_theme_option( 'border_color', '#e2e8f0' );
	$bg_color            = cartvai_theme_option( 'bg_color', '#f8fafc' );

	// Product Card Options
	$hide_short_desc = (bool) cartvai_theme_option( 'shop_page_hide_short_description', false );
	$hide_quantity   = (bool) cartvai_theme_option( 'shop_page_hide_quantity', false );
	$hide_buy_now    = (bool) cartvai_theme_option( 'shop_page_hide_buy_now', false );
	$hide_atc        = (bool) cartvai_theme_option( 'shop_page_hide_add_to_cart', false );
	$hide_off_badge  = (bool) cartvai_theme_option( 'shop_page_hide_off_badge', false );
	$hide_save_badge = (bool) cartvai_theme_option( 'shop_page_hide_save_badge', false );

	$headers = array(
		'megastore' => array(
			'title' => esc_html__( 'Colorful Megastore', 'cartvai-theme' ),
			'desc'  => esc_html__( 'Rich brand-colored header + wide search + Mega Menu product showcase.', 'cartvai-theme' ),
			'badge' => esc_html__( 'New • Mega Menu', 'cartvai-theme' ),
		),
		'megabar'   => array(
			'title' => esc_html__( 'Contrast MegaBar', 'cartvai-theme' ),
			'desc'  => esc_html__( 'Clean white top row + colorful brand category bar with Mega Menu.', 'cartvai-theme' ),
			'badge' => esc_html__( 'Mega Menu', 'cartvai-theme' ),
		),
		'ecommerce' => array(
			'title' => esc_html__( 'Ecommerce Store', 'cartvai-theme' ),
			'desc'  => esc_html__( 'Top Bar + product search + category navigation + cart count badge.', 'cartvai-theme' ),
			'badge' => esc_html__( 'Recommended', 'cartvai-theme' ),
		),
		'default'   => array(
			'title' => esc_html__( 'Standard Navigation', 'cartvai-theme' ),
			'desc'  => esc_html__( 'Classic clean header with brand logo, main menu, and cart button.', 'cartvai-theme' ),
			'badge' => esc_html__( 'Classic', 'cartvai-theme' ),
		),
		'centered'  => array(
			'title' => esc_html__( 'Centered Logo', 'cartvai-theme' ),
			'desc'  => esc_html__( 'Boutique & luxury look with centered brand mark and split menu.', 'cartvai-theme' ),
			'badge' => esc_html__( 'Modern', 'cartvai-theme' ),
		),
		'minimal'   => array(
			'title' => esc_html__( 'Minimalist', 'cartvai-theme' ),
			'desc'  => esc_html__( 'Streamlined compact layout designed for maximum conversion speed.', 'cartvai-theme' ),
			'badge' => esc_html__( 'Clean', 'cartvai-theme' ),
		),
	);

	$footers = array(
		'ecommerce'     => array(
			'title' => esc_html__( 'Ecommerce Multi-Column', 'cartvai-theme' ),
			'desc'  => esc_html__( '4 Columns + Reassurance Band + Newsletter + Safe payment badges.', 'cartvai-theme' ),
			'badge' => esc_html__( 'Recommended', 'cartvai-theme' ),
		),
		'organic'       => array(
			'title' => esc_html__( 'Organic D2C / Emerald Store', 'cartvai-theme' ),
			'desc'  => esc_html__( '5 Columns + Social circles + Direct contact details + Full payment strip.', 'cartvai-theme' ),
			'badge' => esc_html__( 'New • High Converting', 'cartvai-theme' ),
		),
		'warm_boutique' => array(
			'title' => esc_html__( 'Warm Boutique Luxury', 'cartvai-theme' ),
			'desc'  => esc_html__( 'Elegant typography + Social media icons + Clean menu columns + Payment pills.', 'cartvai-theme' ),
			'badge' => esc_html__( 'Luxury Look', 'cartvai-theme' ),
		),
		'default'       => array(
			'title' => esc_html__( 'Standard 3-Column', 'cartvai-theme' ),
			'desc'  => esc_html__( 'Classic store layout with copyright, menu links, and brand details.', 'cartvai-theme' ),
			'badge' => esc_html__( 'Classic', 'cartvai-theme' ),
		),
		'minimal'       => array(
			'title' => esc_html__( 'Minimalist Row', 'cartvai-theme' ),
			'desc'  => esc_html__( 'Clean single-row footer with brand logo, copyright, and links.', 'cartvai-theme' ),
			'badge' => esc_html__( 'Clean', 'cartvai-theme' ),
		),
	);
	?>
	<div class="cartvai-wrap cv:w-full cv:max-w-[1300px] cv:mx-auto cv:p-6 cv:space-y-6" style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;">
		
		<!-- Modern Top Header Bar -->
		<div style="display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 16px; padding-bottom: 8px;">
			<div style="display: flex; align-items: center; gap: 14px;">
				<div style="width: 44px; height: 44px; border-radius: 12px; background: #eff6ff; color: #2563eb; display: flex; align-items: center; justify-content: center; border: 1px solid #dbeafe;">
					<span class="dashicons dashicons-admin-appearance" style="font-size: 22px; width: 22px; height: 22px;"></span>
				</div>
				<div>
					<div style="display: flex; align-items: center; gap: 8px;">
						<h1 style="font-size: 20px; font-weight: 700; color: #0f172a; margin: 0; line-height: 1.2;"><?php esc_html_e( 'Cartvai Theme & Store Settings', 'cartvai-theme' ); ?></h1>
						<span style="font-size: 11px; font-weight: 700; background: #e0f2fe; color: #0284c7; padding: 2px 8px; border-radius: 9999px;">v1.1.0</span>
					</div>
					<p style="font-size: 13px; color: #64748b; margin: 3px 0 0 0;"><?php esc_html_e( 'Manage site colors, product cards, headers, and footers from one unified location.', 'cartvai-theme' ); ?></p>
				</div>
			</div>
			<div style="display: flex; align-items: center; gap: 10px;">
				<a href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>" class="button button-secondary" style="height: 38px; line-height: 36px; padding: 0 16px; border-radius: 8px; font-weight: 600; display: inline-flex; align-items: center; gap: 6px;">
					<span class="dashicons dashicons-admin-customizer" style="font-size: 16px; width: 16px; height: 16px;"></span>
					<span><?php esc_html_e( 'Live Customizer', 'cartvai-theme' ); ?></span>
				</a>
				<button type="submit" form="cartvai-theme-settings-form" class="button button-primary" style="height: 38px; line-height: 36px; padding: 0 20px; border-radius: 8px; font-weight: 600; background: #2563eb; border-color: #2563eb; display: inline-flex; align-items: center; gap: 6px;">
					<span class="dashicons dashicons-saved" style="font-size: 16px; width: 16px; height: 16px;"></span>
					<span><?php esc_html_e( 'Save Changes', 'cartvai-theme' ); ?></span>
				</button>
			</div>
		</div>

		<?php if ( ! empty( $message ) ) : ?>
			<div style="display: flex; align-items: center; gap: 10px; padding: 12px 16px; background: #ecfdf5; border: 1px solid #a7f3d0; border-radius: 10px; color: #065f46; font-size: 13px; font-weight: 600;">
				<span class="dashicons dashicons-yes-alt" style="color: #059669;"></span>
				<span><?php echo esc_html( $message ); ?></span>
			</div>
		<?php endif; ?>

		<form method="post" action="" id="cartvai-theme-settings-form">
			<?php wp_nonce_field( 'cartvai_theme_save_settings', 'cartvai_theme_nonce' ); ?>

			<div style="display: grid; grid-template-columns: 240px 1fr; gap: 24px; align-items: start;">

				<!-- Left Tab Navigation -->
				<div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 8px; box-shadow: 0 1px 2px rgba(0,0,0,0.03);">
					<nav id="cv-settings-tabs" style="display: flex; flex-direction: column; gap: 4px;">
						<button type="button" class="cv-tab-btn is-active" data-tab="tab-colors" style="display: flex; align-items: center; gap: 10px; width: 100%; text-align: left; padding: 10px 14px; border-radius: 8px; font-size: 13px; font-weight: 600; border: none; cursor: pointer; background: #eff6ff; color: #2563eb; transition: all 0.15s;">
							<span class="dashicons dashicons-art"></span>
							<span><?php esc_html_e( 'Design & Colors', 'cartvai-theme' ); ?></span>
						</button>
						<button type="button" class="cv-tab-btn" data-tab="tab-products" style="display: flex; align-items: center; gap: 10px; width: 100%; text-align: left; padding: 10px 14px; border-radius: 8px; font-size: 13px; font-weight: 600; border: none; cursor: pointer; background: transparent; color: #64748b; transition: all 0.15s;">
							<span class="dashicons dashicons-products"></span>
							<span><?php esc_html_e( 'Product Card Options', 'cartvai-theme' ); ?></span>
						</button>
						<button type="button" class="cv-tab-btn" data-tab="tab-header" style="display: flex; align-items: center; gap: 10px; width: 100%; text-align: left; padding: 10px 14px; border-radius: 8px; font-size: 13px; font-weight: 600; border: none; cursor: pointer; background: transparent; color: #64748b; transition: all 0.15s;">
							<span class="dashicons dashicons-arrow-up-alt2"></span>
							<span><?php esc_html_e( 'Header Settings', 'cartvai-theme' ); ?></span>
						</button>
						<button type="button" class="cv-tab-btn" data-tab="tab-footer" style="display: flex; align-items: center; gap: 10px; width: 100%; text-align: left; padding: 10px 14px; border-radius: 8px; font-size: 13px; font-weight: 600; border: none; cursor: pointer; background: transparent; color: #64748b; transition: all 0.15s;">
							<span class="dashicons dashicons-arrow-down-alt2"></span>
							<span><?php esc_html_e( 'Footer Settings', 'cartvai-theme' ); ?></span>
						</button>
						<button type="button" class="cv-tab-btn" data-tab="tab-homepage" style="display: flex; align-items: center; gap: 10px; width: 100%; text-align: left; padding: 10px 14px; border-radius: 8px; font-size: 13px; font-weight: 600; border: none; cursor: pointer; background: transparent; color: #64748b; transition: all 0.15s;">
							<span class="dashicons dashicons-admin-home"></span>
							<span><?php esc_html_e( 'Homepage Settings', 'cartvai-theme' ); ?></span>
						</button>
					</nav>
				</div>

				<!-- Right Tab Content -->
				<div style="display: flex; flex-direction: column; gap: 20px;">

					<!-- ==========================================
					     TAB 1: DESIGN & COLORS (Central Site Palette)
					     ========================================== -->
					<div id="tab-colors" class="cv-tab-panel" style="display: flex; flex-direction: column; gap: 20px;">
						<div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 22px; box-shadow: 0 1px 2px rgba(0,0,0,0.02);">
							<div style="margin-bottom: 20px; border-bottom: 1px solid #f1f5f9; padding-bottom: 14px;">
								<h2 style="font-size: 16px; font-weight: 700; color: #0f172a; margin: 0 0 4px 0;"><?php esc_html_e( 'Global Site Colors & Brand Palette', 'cartvai-theme' ); ?></h2>
								<p style="font-size: 12px; color: #64748b; margin: 0;"><?php esc_html_e( 'Manage site colors from 1 central place. These colors apply across all headers, cards, buttons, badges, links, and checkout.', 'cartvai-theme' ); ?></p>
							</div>

							<!-- Grid of Color Pickers -->
							<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 18px;">

								<!-- Primary Color -->
								<div style="border: 1px solid #e2e8f0; border-radius: 10px; padding: 16px; background: #fafafa;">
									<div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 6px;">
										<label style="font-size: 13px; font-weight: 700; color: #0f172a; margin: 0;"><?php esc_html_e( 'Primary Brand Color', 'cartvai-theme' ); ?></label>
										<span style="font-size: 11px; font-weight: 600; color: #2563eb; background: #eff6ff; padding: 2px 8px; border-radius: 9999px;"><?php esc_html_e( 'Buttons & Accents', 'cartvai-theme' ); ?></span>
									</div>
									<p style="font-size: 11px; color: #64748b; margin: 0 0 10px 0;"><?php esc_html_e( 'Used for Buy Now, add-to-cart active hover, badges, links & key highlights.', 'cartvai-theme' ); ?></p>
									<div style="display: flex; align-items: center; gap: 10px;">
										<input type="color" class="cv-color-picker-input" data-target="primary_color" value="<?php echo esc_attr( $primary_color ); ?>" style="width: 44px; height: 38px; border: 1px solid #cbd5e1; border-radius: 8px; cursor: pointer; padding: 2px; background: #fff;" />
										<input type="text" id="primary_color" name="primary_color" value="<?php echo esc_attr( $primary_color ); ?>" style="flex: 1; height: 38px; border-radius: 8px; border: 1px solid #cbd5e1; padding: 0 12px; font-size: 13px; font-family: monospace;" />
									</div>
								</div>

								<!-- Primary Hover / Deep -->
								<div style="border: 1px solid #e2e8f0; border-radius: 10px; padding: 16px; background: #fafafa;">
									<div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 6px;">
										<label style="font-size: 13px; font-weight: 700; color: #0f172a; margin: 0;"><?php esc_html_e( 'Primary Hover / Dark Tone', 'cartvai-theme' ); ?></label>
										<span style="font-size: 11px; font-weight: 600; color: #1e40af; background: #dbeafe; padding: 2px 8px; border-radius: 9999px;"><?php esc_html_e( 'Hover State', 'cartvai-theme' ); ?></span>
									</div>
									<p style="font-size: 11px; color: #64748b; margin: 0 0 10px 0;"><?php esc_html_e( 'Used when hovering over primary buttons, links, and focused active inputs.', 'cartvai-theme' ); ?></p>
									<div style="display: flex; align-items: center; gap: 10px;">
										<input type="color" class="cv-color-picker-input" data-target="primary_hover_color" value="<?php echo esc_attr( $primary_hover_color ); ?>" style="width: 44px; height: 38px; border: 1px solid #cbd5e1; border-radius: 8px; cursor: pointer; padding: 2px; background: #fff;" />
										<input type="text" id="primary_hover_color" name="primary_hover_color" value="<?php echo esc_attr( $primary_hover_color ); ?>" style="flex: 1; height: 38px; border-radius: 8px; border: 1px solid #cbd5e1; padding: 0 12px; font-size: 13px; font-family: monospace;" />
									</div>
								</div>

								<!-- Primary Light Tint -->
								<div style="border: 1px solid #e2e8f0; border-radius: 10px; padding: 16px; background: #fafafa;">
									<div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 6px;">
										<label style="font-size: 13px; font-weight: 700; color: #0f172a; margin: 0;"><?php esc_html_e( 'Primary Light Tint', 'cartvai-theme' ); ?></label>
										<span style="font-size: 11px; font-weight: 600; color: #0369a1; background: #e0f2fe; padding: 2px 8px; border-radius: 9999px;"><?php esc_html_e( 'Soft Tints', 'cartvai-theme' ); ?></span>
									</div>
									<p style="font-size: 11px; color: #64748b; margin: 0 0 10px 0;"><?php esc_html_e( 'Soft background for active tabs, icon circles, and subtle chip pills.', 'cartvai-theme' ); ?></p>
									<div style="display: flex; align-items: center; gap: 10px;">
										<input type="color" class="cv-color-picker-input" data-target="primary_light_color" value="<?php echo esc_attr( $primary_light_color ); ?>" style="width: 44px; height: 38px; border: 1px solid #cbd5e1; border-radius: 8px; cursor: pointer; padding: 2px; background: #fff;" />
										<input type="text" id="primary_light_color" name="primary_light_color" value="<?php echo esc_attr( $primary_light_color ); ?>" style="flex: 1; height: 38px; border-radius: 8px; border: 1px solid #cbd5e1; padding: 0 12px; font-size: 13px; font-family: monospace;" />
									</div>
								</div>

								<!-- Accent Color -->
								<div style="border: 1px solid #e2e8f0; border-radius: 10px; padding: 16px; background: #fafafa;">
									<div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 6px;">
										<label style="font-size: 13px; font-weight: 700; color: #0f172a; margin: 0;"><?php esc_html_e( 'Accent / Secondary Color', 'cartvai-theme' ); ?></label>
										<span style="font-size: 11px; font-weight: 600; color: #334155; background: #f1f5f9; padding: 2px 8px; border-radius: 9999px;"><?php esc_html_e( 'Dark Contrast', 'cartvai-theme' ); ?></span>
									</div>
									<p style="font-size: 11px; color: #64748b; margin: 0 0 10px 0;"><?php esc_html_e( 'Used for dark action buttons, contrast badges, and solid indicators.', 'cartvai-theme' ); ?></p>
									<div style="display: flex; align-items: center; gap: 10px;">
										<input type="color" class="cv-color-picker-input" data-target="accent_color" value="<?php echo esc_attr( $accent_color ); ?>" style="width: 44px; height: 38px; border: 1px solid #cbd5e1; border-radius: 8px; cursor: pointer; padding: 2px; background: #fff;" />
										<input type="text" id="accent_color" name="accent_color" value="<?php echo esc_attr( $accent_color ); ?>" style="flex: 1; height: 38px; border-radius: 8px; border: 1px solid #cbd5e1; padding: 0 12px; font-size: 13px; font-family: monospace;" />
									</div>
								</div>

								<!-- Heading Color -->
								<div style="border: 1px solid #e2e8f0; border-radius: 10px; padding: 16px; background: #fafafa;">
									<div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 6px;">
										<label style="font-size: 13px; font-weight: 700; color: #0f172a; margin: 0;"><?php esc_html_e( 'Heading & Title Color', 'cartvai-theme' ); ?></label>
									</div>
									<p style="font-size: 11px; color: #64748b; margin: 0 0 10px 0;"><?php esc_html_e( 'Applied to product titles, section headers (H1-H6), and post titles.', 'cartvai-theme' ); ?></p>
									<div style="display: flex; align-items: center; gap: 10px;">
										<input type="color" class="cv-color-picker-input" data-target="heading_color" value="<?php echo esc_attr( $heading_color ); ?>" style="width: 44px; height: 38px; border: 1px solid #cbd5e1; border-radius: 8px; cursor: pointer; padding: 2px; background: #fff;" />
										<input type="text" id="heading_color" name="heading_color" value="<?php echo esc_attr( $heading_color ); ?>" style="flex: 1; height: 38px; border-radius: 8px; border: 1px solid #cbd5e1; padding: 0 12px; font-size: 13px; font-family: monospace;" />
									</div>
								</div>

								<!-- Body Text Color -->
								<div style="border: 1px solid #e2e8f0; border-radius: 10px; padding: 16px; background: #fafafa;">
									<div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 6px;">
										<label style="font-size: 13px; font-weight: 700; color: #0f172a; margin: 0;"><?php esc_html_e( 'Body Text Color', 'cartvai-theme' ); ?></label>
									</div>
									<p style="font-size: 11px; color: #64748b; margin: 0 0 10px 0;"><?php esc_html_e( 'Applied to body paragraphs, product descriptions, and footer text.', 'cartvai-theme' ); ?></p>
									<div style="display: flex; align-items: center; gap: 10px;">
										<input type="color" class="cv-color-picker-input" data-target="text_color" value="<?php echo esc_attr( $text_color ); ?>" style="width: 44px; height: 38px; border: 1px solid #cbd5e1; border-radius: 8px; cursor: pointer; padding: 2px; background: #fff;" />
										<input type="text" id="text_color" name="text_color" value="<?php echo esc_attr( $text_color ); ?>" style="flex: 1; height: 38px; border-radius: 8px; border: 1px solid #cbd5e1; padding: 0 12px; font-size: 13px; font-family: monospace;" />
									</div>
								</div>

								<!-- Border Color -->
								<div style="border: 1px solid #e2e8f0; border-radius: 10px; padding: 16px; background: #fafafa;">
									<div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 6px;">
										<label style="font-size: 13px; font-weight: 700; color: #0f172a; margin: 0;"><?php esc_html_e( 'Border & Divider Color', 'cartvai-theme' ); ?></label>
									</div>
									<p style="font-size: 11px; color: #64748b; margin: 0 0 10px 0;"><?php esc_html_e( 'Used for card borders, form input outlines, table lines, and separators.', 'cartvai-theme' ); ?></p>
									<div style="display: flex; align-items: center; gap: 10px;">
										<input type="color" class="cv-color-picker-input" data-target="border_color" value="<?php echo esc_attr( $border_color ); ?>" style="width: 44px; height: 38px; border: 1px solid #cbd5e1; border-radius: 8px; cursor: pointer; padding: 2px; background: #fff;" />
										<input type="text" id="border_color" name="border_color" value="<?php echo esc_attr( $border_color ); ?>" style="flex: 1; height: 38px; border-radius: 8px; border: 1px solid #cbd5e1; padding: 0 12px; font-size: 13px; font-family: monospace;" />
									</div>
								</div>

								<!-- Site Background Color -->
								<div style="border: 1px solid #e2e8f0; border-radius: 10px; padding: 16px; background: #fafafa;">
									<div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 6px;">
										<label style="font-size: 13px; font-weight: 700; color: #0f172a; margin: 0;"><?php esc_html_e( 'Site Background Color', 'cartvai-theme' ); ?></label>
									</div>
									<p style="font-size: 11px; color: #64748b; margin: 0 0 10px 0;"><?php esc_html_e( 'Storefront canvas and page backdrop color behind cards.', 'cartvai-theme' ); ?></p>
									<div style="display: flex; align-items: center; gap: 10px;">
										<input type="color" class="cv-color-picker-input" data-target="bg_color" value="<?php echo esc_attr( $bg_color ); ?>" style="width: 44px; height: 38px; border: 1px solid #cbd5e1; border-radius: 8px; cursor: pointer; padding: 2px; background: #fff;" />
										<input type="text" id="bg_color" name="bg_color" value="<?php echo esc_attr( $bg_color ); ?>" style="flex: 1; height: 38px; border-radius: 8px; border: 1px solid #cbd5e1; padding: 0 12px; font-size: 13px; font-family: monospace;" />
									</div>
								</div>

							</div>
						</div>
					</div>

					<!-- ==========================================
					     TAB 2: PRODUCT & CARD DISPLAY OPTIONS
					     ========================================== -->
					<div id="tab-products" class="cv-tab-panel" style="display: none; flex-direction: column; gap: 20px;">
						<div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 22px; box-shadow: 0 1px 2px rgba(0,0,0,0.02);">
							<div style="margin-bottom: 20px; border-bottom: 1px solid #f1f5f9; padding-bottom: 14px;">
								<h2 style="font-size: 16px; font-weight: 700; color: #0f172a; margin: 0 0 4px 0;"><?php esc_html_e( 'Product Card Display Options', 'cartvai-theme' ); ?></h2>
								<p style="font-size: 12px; color: #64748b; margin: 0;"><?php esc_html_e( 'Control card elements across Shop, Category archives, Tag archives, and Related Products carousels.', 'cartvai-theme' ); ?></p>
							</div>

							<div style="display: flex; flex-direction: column; gap: 16px;">

								<!-- Hide Short Description -->
								<div style="display: flex; align-items: center; justify-content: space-between; padding-bottom: 14px; border-bottom: 1px solid #f1f5f9;">
									<div>
										<strong style="font-size: 13px; font-weight: 600; color: #0f172a; display: block;"><?php esc_html_e( 'Hide Short Description', 'cartvai-theme' ); ?></strong>
										<span style="font-size: 12px; color: #64748b;"><?php esc_html_e( 'Remove the text description under the product title on product cards.', 'cartvai-theme' ); ?></span>
									</div>
									<label class="cartvai-toggle-switch" style="position: relative; display: inline-block; width: 44px; height: 24px;">
										<input type="checkbox" name="shop_page_hide_short_description" value="1" <?php checked( $hide_short_desc ); ?> style="opacity: 0; width: 0; height: 0;">
										<span class="cartvai-toggle-switch__track" style="position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0; background-color: <?php echo $hide_short_desc ? '#2563eb' : '#cbd5e1'; ?>; transition: .2s; border-radius: 9999px;"></span>
									</label>
								</div>

								<!-- Hide Quantity -->
								<div style="display: flex; align-items: center; justify-content: space-between; padding-bottom: 14px; border-bottom: 1px solid #f1f5f9;">
									<div>
										<strong style="font-size: 13px; font-weight: 600; color: #0f172a; display: block;"><?php esc_html_e( 'Hide Quantity Selector', 'cartvai-theme' ); ?></strong>
										<span style="font-size: 12px; color: #64748b;"><?php esc_html_e( 'Remove the quantity -/+ selector row from product cards.', 'cartvai-theme' ); ?></span>
									</div>
									<label class="cartvai-toggle-switch" style="position: relative; display: inline-block; width: 44px; height: 24px;">
										<input type="checkbox" name="shop_page_hide_quantity" value="1" <?php checked( $hide_quantity ); ?> style="opacity: 0; width: 0; height: 0;">
										<span class="cartvai-toggle-switch__track" style="position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0; background-color: <?php echo $hide_quantity ? '#2563eb' : '#cbd5e1'; ?>; transition: .2s; border-radius: 9999px;"></span>
									</label>
								</div>

								<!-- Hide Buy Now Button -->
								<div style="display: flex; align-items: center; justify-content: space-between; padding-bottom: 14px; border-bottom: 1px solid #f1f5f9;">
									<div>
										<strong style="font-size: 13px; font-weight: 600; color: #0f172a; display: block;"><?php esc_html_e( 'Hide "Buy Now" Button', 'cartvai-theme' ); ?></strong>
										<span style="font-size: 12px; color: #64748b;"><?php esc_html_e( 'Remove the direct checkout Buy Now button from cards.', 'cartvai-theme' ); ?></span>
									</div>
									<label class="cartvai-toggle-switch" style="position: relative; display: inline-block; width: 44px; height: 24px;">
										<input type="checkbox" name="shop_page_hide_buy_now" value="1" <?php checked( $hide_buy_now ); ?> style="opacity: 0; width: 0; height: 0;">
										<span class="cartvai-toggle-switch__track" style="position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0; background-color: <?php echo $hide_buy_now ? '#2563eb' : '#cbd5e1'; ?>; transition: .2s; border-radius: 9999px;"></span>
									</label>
								</div>

								<!-- Hide Add to Cart Button -->
								<div style="display: flex; align-items: center; justify-content: space-between; padding-bottom: 14px; border-bottom: 1px solid #f1f5f9;">
									<div>
										<strong style="font-size: 13px; font-weight: 600; color: #0f172a; display: block;"><?php esc_html_e( 'Hide "Add to Cart" Button', 'cartvai-theme' ); ?></strong>
										<span style="font-size: 12px; color: #64748b;"><?php esc_html_e( 'Remove the Add to Cart button from product cards.', 'cartvai-theme' ); ?></span>
									</div>
									<label class="cartvai-toggle-switch" style="position: relative; display: inline-block; width: 44px; height: 24px;">
										<input type="checkbox" name="shop_page_hide_add_to_cart" value="1" <?php checked( $hide_atc ); ?> style="opacity: 0; width: 0; height: 0;">
										<span class="cartvai-toggle-switch__track" style="position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0; background-color: <?php echo $hide_atc ? '#2563eb' : '#cbd5e1'; ?>; transition: .2s; border-radius: 9999px;"></span>
									</label>
								</div>

								<!-- Hide Discount (% OFF) Badge -->
								<div style="display: flex; align-items: center; justify-content: space-between; padding-bottom: 14px; border-bottom: 1px solid #f1f5f9;">
									<div>
										<strong style="font-size: 13px; font-weight: 600; color: #0f172a; display: block;"><?php esc_html_e( 'Hide Discount (% OFF) Badge', 'cartvai-theme' ); ?></strong>
										<span style="font-size: 12px; color: #64748b;"><?php esc_html_e( 'Remove the pill discount badge (e.g. -20% OFF) on sale products.', 'cartvai-theme' ); ?></span>
									</div>
									<label class="cartvai-toggle-switch" style="position: relative; display: inline-block; width: 44px; height: 24px;">
										<input type="checkbox" name="shop_page_hide_off_badge" value="1" <?php checked( $hide_off_badge ); ?> style="opacity: 0; width: 0; height: 0;">
										<span class="cartvai-toggle-switch__track" style="position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0; background-color: <?php echo $hide_off_badge ? '#2563eb' : '#cbd5e1'; ?>; transition: .2s; border-radius: 9999px;"></span>
									</label>
								</div>

								<!-- Hide Save Amount Badge -->
								<div style="display: flex; align-items: center; justify-content: space-between;">
									<div>
										<strong style="font-size: 13px; font-weight: 600; color: #0f172a; display: block;"><?php esc_html_e( 'Hide "Save Amount" Badge', 'cartvai-theme' ); ?></strong>
										<span style="font-size: 12px; color: #64748b;"><?php esc_html_e( 'Remove the green "Save $XX" badge next to discounted prices.', 'cartvai-theme' ); ?></span>
									</div>
									<label class="cartvai-toggle-switch" style="position: relative; display: inline-block; width: 44px; height: 24px;">
										<input type="checkbox" name="shop_page_hide_save_badge" value="1" <?php checked( $hide_save_badge ); ?> style="opacity: 0; width: 0; height: 0;">
										<span class="cartvai-toggle-switch__track" style="position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0; background-color: <?php echo $hide_save_badge ? '#2563eb' : '#cbd5e1'; ?>; transition: .2s; border-radius: 9999px;"></span>
									</label>
								</div>

							</div>
						</div>
					</div>

					<!-- ==========================================
					     TAB 3: HEADER SETTINGS
					     ========================================== -->
					<div id="tab-header" class="cv-tab-panel" style="display: none; flex-direction: column; gap: 20px;">
						
						<!-- Header Layout Selection Card -->
						<div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 22px; box-shadow: 0 1px 2px rgba(0,0,0,0.02);">
							<div style="margin-bottom: 16px;">
								<h2 style="font-size: 16px; font-weight: 700; color: #0f172a; margin: 0 0 4px 0;"><?php esc_html_e( 'Header Style', 'cartvai-theme' ); ?></h2>
								<p style="font-size: 12px; color: #64748b; margin: 0;"><?php esc_html_e( 'Select the navigation layout style for your storefront.', 'cartvai-theme' ); ?></p>
							</div>

							<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(210px, 1fr)); gap: 12px;">
								<?php foreach ( $headers as $slug => $data ) : ?>
									<?php $is_checked = ( $slug === $current_header ); ?>
									<label class="cv-card-radio" style="display: block; border: 2px solid <?php echo $is_checked ? '#2563eb' : '#e2e8f0'; ?>; background: <?php echo $is_checked ? '#f8fafc' : '#ffffff'; ?>; border-radius: 10px; padding: 14px; cursor: pointer; transition: all 0.15s;">
										<div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 8px;">
											<input type="radio" name="header_style" value="<?php echo esc_attr( $slug ); ?>" <?php checked( $is_checked ); ?> style="margin: 0;" />
											<span style="font-size: 10px; font-weight: 700; padding: 2px 7px; border-radius: 9999px; background: <?php echo $is_checked ? '#2563eb' : '#f1f5f9'; ?>; color: <?php echo $is_checked ? '#ffffff' : '#64748b'; ?>;">
												<?php echo esc_html( $data['badge'] ); ?>
											</span>
										</div>
										<strong style="font-size: 14px; color: #0f172a; display: block; margin-bottom: 2px;"><?php echo esc_html( $data['title'] ); ?></strong>
										<span style="font-size: 11px; color: #64748b; line-height: 1.4; display: block;"><?php echo esc_html( $data['desc'] ); ?></span>
									</label>
								<?php endforeach; ?>
							</div>
						</div>

						<!-- Announcement Bar & Support Card -->
						<div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 22px; box-shadow: 0 1px 2px rgba(0,0,0,0.02);">
							<h2 style="font-size: 16px; font-weight: 700; color: #0f172a; margin: 0 0 16px 0;"><?php esc_html_e( 'Top Announcement Bar & Hotline', 'cartvai-theme' ); ?></h2>

							<div style="display: flex; flex-direction: column; gap: 16px;">
								<div style="display: flex; align-items: center; justify-content: space-between; padding-bottom: 14px; border-bottom: 1px solid #f1f5f9;">
									<div>
										<strong style="font-size: 13px; font-weight: 600; color: #0f172a; display: block;"><?php esc_html_e( 'Enable Top Announcement Bar', 'cartvai-theme' ); ?></strong>
										<span style="font-size: 12px; color: #64748b;"><?php esc_html_e( 'Display promotional flash text at the very top of the ecommerce header.', 'cartvai-theme' ); ?></span>
									</div>
									<label class="cartvai-toggle-switch" style="position: relative; display: inline-block; width: 44px; height: 24px;">
										<input type="checkbox" name="announcement_enabled" value="1" <?php checked( $announcement_enabled ); ?> style="opacity: 0; width: 0; height: 0;">
										<span class="cartvai-toggle-switch__track" style="position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0; background-color: <?php echo $announcement_enabled ? '#2563eb' : '#cbd5e1'; ?>; transition: .2s; border-radius: 9999px;"></span>
									</label>
								</div>

								<div>
									<label style="display: block; font-size: 12px; font-weight: 600; color: #334155; margin-bottom: 6px;"><?php esc_html_e( 'Announcement Message', 'cartvai-theme' ); ?></label>
									<input type="text" name="announcement_text" value="<?php echo esc_attr( $announcement_text ); ?>" style="width: 100%; height: 38px; border-radius: 8px; border: 1px solid #cbd5e1; padding: 0 12px; font-size: 13px;" />
								</div>

								<div>
									<label style="display: block; font-size: 12px; font-weight: 600; color: #334155; margin-bottom: 6px;"><?php esc_html_e( 'Customer Support Phone / Hotline', 'cartvai-theme' ); ?></label>
									<input type="text" name="contact_phone" value="<?php echo esc_attr( $contact_phone ); ?>" style="width: 100%; max-width: 380px; height: 38px; border-radius: 8px; border: 1px solid #cbd5e1; padding: 0 12px; font-size: 13px;" />
								</div>
							</div>
						</div>

						<!-- Header Utility Actions (Order Track & More Menu) Card -->
						<div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 22px; box-shadow: 0 1px 2px rgba(0,0,0,0.02);">
							<div style="margin-bottom: 16px; border-bottom: 1px solid #f1f5f9; padding-bottom: 12px;">
								<h2 style="font-size: 16px; font-weight: 700; color: #0f172a; margin: 0 0 4px 0;"><?php esc_html_e( 'Header Utility Actions (Order Track & More Menu)', 'cartvai-theme' ); ?></h2>
								<p style="font-size: 12px; color: #64748b; margin: 0;"><?php esc_html_e( 'Manage the action buttons on the right side of the header and the dedicated More Menu items.', 'cartvai-theme' ); ?></p>
							</div>

							<div style="display: flex; flex-direction: column; gap: 16px;">
								<!-- Enable Order Track -->
								<div style="display: flex; align-items: center; justify-content: space-between; padding-bottom: 14px; border-bottom: 1px solid #f1f5f9;">
									<div>
										<strong style="font-size: 13px; font-weight: 600; color: #0f172a; display: block;"><?php esc_html_e( 'Show "Order Track" Button', 'cartvai-theme' ); ?></strong>
										<span style="font-size: 12px; color: #64748b;"><?php esc_html_e( 'Display the Order Track utility button with truck icon in the header.', 'cartvai-theme' ); ?></span>
									</div>
									<label class="cartvai-toggle-switch" style="position: relative; display: inline-block; width: 44px; height: 24px;">
										<input type="checkbox" name="header_order_track_enabled" value="1" <?php checked( $header_order_track_enabled ); ?> style="opacity: 0; width: 0; height: 0;">
										<span class="cartvai-toggle-switch__track" style="position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0; background-color: <?php echo $header_order_track_enabled ? '#2563eb' : '#cbd5e1'; ?>; transition: .2s; border-radius: 9999px;"></span>
									</label>
								</div>

								<!-- Order Track Custom Label -->
								<div>
									<label style="display: block; font-size: 12px; font-weight: 600; color: #334155; margin-bottom: 6px;"><?php esc_html_e( 'Order Track Label', 'cartvai-theme' ); ?></label>
									<input type="text" name="header_order_track_label" value="<?php echo esc_attr( $header_order_track_label ); ?>" style="width: 100%; max-width: 320px; height: 38px; border-radius: 8px; border: 1px solid #cbd5e1; padding: 0 12px; font-size: 13px;" />
								</div>

								<!-- Order Track Custom URL -->
								<div>
									<label style="display: block; font-size: 12px; font-weight: 600; color: #334155; margin-bottom: 6px;"><?php esc_html_e( 'Order Track Destination URL', 'cartvai-theme' ); ?></label>
									<input type="url" name="header_order_track_url" placeholder="<?php echo esc_url( home_url( '/checkout/' ) ); ?>" value="<?php echo esc_attr( $header_order_track_url ); ?>" style="width: 100%; max-width: 480px; height: 38px; border-radius: 8px; border: 1px solid #cbd5e1; padding: 0 12px; font-size: 13px;" />
									<span style="font-size: 11px; color: #64748b; margin-top: 4px; display: block;"><?php esc_html_e( 'Leave blank to link directly to Checkout or default track page.', 'cartvai-theme' ); ?></span>
								</div>

								<!-- Enable More Menu Button -->
								<div style="display: flex; align-items: center; justify-content: space-between; padding-top: 10px; padding-bottom: 14px; border-top: 1px solid #f1f5f9; border-bottom: 1px solid #f1f5f9;">
									<div>
										<strong style="font-size: 13px; font-weight: 600; color: #0f172a; display: block;"><?php esc_html_e( 'Show "More" Button', 'cartvai-theme' ); ?></strong>
										<span style="font-size: 12px; color: #64748b;"><?php esc_html_e( 'Displays the hamburger button that opens the professional slide drawer.', 'cartvai-theme' ); ?></span>
									</div>
									<label class="cartvai-toggle-switch" style="position: relative; display: inline-block; width: 44px; height: 24px;">
										<input type="checkbox" name="header_more_enabled" value="1" <?php checked( $header_more_enabled ); ?> style="opacity: 0; width: 0; height: 0;">
										<span class="cartvai-toggle-switch__track" style="position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0; background-color: <?php echo $header_more_enabled ? '#2563eb' : '#cbd5e1'; ?>; transition: .2s; border-radius: 9999px;"></span>
									</label>
								</div>

								<!-- Link to Menus for More Menu -->
								<div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 14px; display: flex; align-items: center; justify-content: space-between;">
									<div>
										<strong style="font-size: 13px; color: #0f172a; display: block;"><?php esc_html_e( 'Manage More Menu Items', 'cartvai-theme' ); ?></strong>
										<span style="font-size: 11px; color: #64748b;"><?php esc_html_e( 'Assign custom links, pages, or categories to the "More Menu" location in WordPress native menus.', 'cartvai-theme' ); ?></span>
									</div>
									<a href="<?php echo esc_url( admin_url( 'nav-menus.php?action=locations' ) ); ?>" class="button button-secondary" style="font-weight: 600;">
										<?php esc_html_e( 'Edit Menus →', 'cartvai-theme' ); ?>
									</a>
								</div>
							</div>
						</div>

						<!-- Top Bar & Main Header Styling Card -->
						<div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 22px; box-shadow: 0 1px 2px rgba(0,0,0,0.02);">
							<div style="margin-bottom: 16px; border-bottom: 1px solid #f1f5f9; padding-bottom: 12px;">
								<h2 style="font-size: 16px; font-weight: 700; color: #0f172a; margin: 0 0 4px 0;"><?php esc_html_e( 'Top Bar & Main Header Styling', 'cartvai-theme' ); ?></h2>
								<p style="font-size: 12px; color: #64748b; margin: 0;"><?php esc_html_e( 'Customize background colors, borders, and vertical spacing for the announcement bar and main header.', 'cartvai-theme' ); ?></p>
							</div>

							<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 16px;">
								<!-- Top Bar Background -->
								<div style="border: 1px solid #e2e8f0; border-radius: 10px; padding: 14px; background: #fafafa;">
									<label style="font-size: 12px; font-weight: 700; color: #0f172a; display: block; margin-bottom: 4px;"><?php esc_html_e( 'Top Bar Background', 'cartvai-theme' ); ?></label>
									<span style="font-size: 11px; color: #64748b; display: block; margin-bottom: 8px;"><?php esc_html_e( 'Background of the top announcement band.', 'cartvai-theme' ); ?></span>
									<div style="display: flex; align-items: center; gap: 8px;">
										<input type="color" value="<?php echo esc_attr( $top_bar_bg_color ); ?>" oninput="this.nextElementSibling.value = this.value" style="width: 38px; height: 38px; padding: 2px; border-radius: 6px; border: 1px solid #cbd5e1; cursor: pointer; background: #fff;" />
										<input type="text" name="top_bar_bg_color" value="<?php echo esc_attr( $top_bar_bg_color ); ?>" oninput="this.previousElementSibling.value = this.value" style="flex: 1; height: 38px; border-radius: 6px; border: 1px solid #cbd5e1; padding: 0 10px; font-size: 13px; font-family: monospace;" />
									</div>
								</div>

								<!-- Top Bar Text Color -->
								<div style="border: 1px solid #e2e8f0; border-radius: 10px; padding: 14px; background: #fafafa;">
									<label style="font-size: 12px; font-weight: 700; color: #0f172a; display: block; margin-bottom: 4px;"><?php esc_html_e( 'Top Bar Text & Links', 'cartvai-theme' ); ?></label>
									<span style="font-size: 11px; color: #64748b; display: block; margin-bottom: 8px;"><?php esc_html_e( 'Color for text, icons, and phone link in top bar.', 'cartvai-theme' ); ?></span>
									<div style="display: flex; align-items: center; gap: 8px;">
										<input type="color" value="<?php echo esc_attr( $top_bar_text_color ); ?>" oninput="this.nextElementSibling.value = this.value" style="width: 38px; height: 38px; padding: 2px; border-radius: 6px; border: 1px solid #cbd5e1; cursor: pointer; background: #fff;" />
										<input type="text" name="top_bar_text_color" value="<?php echo esc_attr( $top_bar_text_color ); ?>" oninput="this.previousElementSibling.value = this.value" style="flex: 1; height: 38px; border-radius: 6px; border: 1px solid #cbd5e1; padding: 0 10px; font-size: 13px; font-family: monospace;" />
									</div>
								</div>

								<!-- Top Bar Vertical Padding -->
								<div style="border: 1px solid #e2e8f0; border-radius: 10px; padding: 14px; background: #fafafa;">
									<label style="font-size: 12px; font-weight: 700; color: #0f172a; display: block; margin-bottom: 4px;"><?php esc_html_e( 'Top Bar Vertical Padding (px)', 'cartvai-theme' ); ?></label>
									<span style="font-size: 11px; color: #64748b; display: block; margin-bottom: 8px;"><?php esc_html_e( 'Top and bottom inner spacing in pixels.', 'cartvai-theme' ); ?></span>
									<input type="number" name="top_bar_padding_y" value="<?php echo esc_attr( $top_bar_padding_y ); ?>" min="0" max="40" step="1" style="width: 100%; height: 38px; border-radius: 6px; border: 1px solid #cbd5e1; padding: 0 10px; font-size: 13px;" />
								</div>

								<!-- Main Header Background -->
								<div style="border: 1px solid #e2e8f0; border-radius: 10px; padding: 14px; background: #fafafa;">
									<label style="font-size: 12px; font-weight: 700; color: #0f172a; display: block; margin-bottom: 4px;"><?php esc_html_e( 'Main Header Background', 'cartvai-theme' ); ?></label>
									<span style="font-size: 11px; color: #64748b; display: block; margin-bottom: 8px;"><?php esc_html_e( 'Color behind logo, search bar, and cart.', 'cartvai-theme' ); ?></span>
									<div style="display: flex; align-items: center; gap: 8px;">
										<input type="color" value="<?php echo esc_attr( $main_bar_bg_color ); ?>" oninput="this.nextElementSibling.value = this.value" style="width: 38px; height: 38px; padding: 2px; border-radius: 6px; border: 1px solid #cbd5e1; cursor: pointer; background: #fff;" />
										<input type="text" name="main_bar_bg_color" value="<?php echo esc_attr( $main_bar_bg_color ); ?>" oninput="this.previousElementSibling.value = this.value" style="flex: 1; height: 38px; border-radius: 6px; border: 1px solid #cbd5e1; padding: 0 10px; font-size: 13px; font-family: monospace;" />
									</div>
								</div>

								<!-- Main Header Border Color -->
								<div style="border: 1px solid #e2e8f0; border-radius: 10px; padding: 14px; background: #fafafa;">
									<label style="font-size: 12px; font-weight: 700; color: #0f172a; display: block; margin-bottom: 4px;"><?php esc_html_e( 'Main Header Border Color', 'cartvai-theme' ); ?></label>
									<span style="font-size: 11px; color: #64748b; display: block; margin-bottom: 8px;"><?php esc_html_e( 'Bottom border divider line color.', 'cartvai-theme' ); ?></span>
									<div style="display: flex; align-items: center; gap: 8px;">
										<input type="color" value="<?php echo esc_attr( $main_bar_border_color ); ?>" oninput="this.nextElementSibling.value = this.value" style="width: 38px; height: 38px; padding: 2px; border-radius: 6px; border: 1px solid #cbd5e1; cursor: pointer; background: #fff;" />
										<input type="text" name="main_bar_border_color" value="<?php echo esc_attr( $main_bar_border_color ); ?>" oninput="this.previousElementSibling.value = this.value" style="flex: 1; height: 38px; border-radius: 6px; border: 1px solid #cbd5e1; padding: 0 10px; font-size: 13px; font-family: monospace;" />
									</div>
								</div>

								<!-- Main Header Vertical Padding -->
								<div style="border: 1px solid #e2e8f0; border-radius: 10px; padding: 14px; background: #fafafa;">
									<label style="font-size: 12px; font-weight: 700; color: #0f172a; display: block; margin-bottom: 4px;"><?php esc_html_e( 'Main Header Vertical Padding (px)', 'cartvai-theme' ); ?></label>
									<span style="font-size: 11px; color: #64748b; display: block; margin-bottom: 8px;"><?php esc_html_e( 'Top and bottom inner spacing in pixels.', 'cartvai-theme' ); ?></span>
									<input type="number" name="main_bar_padding_y" value="<?php echo esc_attr( $main_bar_padding_y ); ?>" min="4" max="60" step="1" style="width: 100%; height: 38px; border-radius: 6px; border: 1px solid #cbd5e1; padding: 0 10px; font-size: 13px;" />
								</div>
							</div>
						</div>

						<!-- Navigation Bar & Menu Typography Card -->
						<div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 22px; box-shadow: 0 1px 2px rgba(0,0,0,0.02);">
							<div style="margin-bottom: 16px; border-bottom: 1px solid #f1f5f9; padding-bottom: 12px;">
								<h2 style="font-size: 16px; font-weight: 700; color: #0f172a; margin: 0 0 4px 0;"><?php esc_html_e( 'Navigation Bar (Navbar) & Links Styling', 'cartvai-theme' ); ?></h2>
								<p style="font-size: 12px; color: #64748b; margin: 0;"><?php esc_html_e( 'Control the navbar strip background, borders, link colors, spacing, and font weight.', 'cartvai-theme' ); ?></p>
							</div>

							<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 16px;">
								<!-- Navbar Background -->
								<div style="border: 1px solid #e2e8f0; border-radius: 10px; padding: 14px; background: #fafafa;">
									<label style="font-size: 12px; font-weight: 700; color: #0f172a; display: block; margin-bottom: 4px;"><?php esc_html_e( 'Navbar Background', 'cartvai-theme' ); ?></label>
									<span style="font-size: 11px; color: #64748b; display: block; margin-bottom: 8px;"><?php esc_html_e( 'Background of the secondary navigation bar.', 'cartvai-theme' ); ?></span>
									<div style="display: flex; align-items: center; gap: 8px;">
										<input type="color" value="<?php echo esc_attr( $nav_bar_bg_color ); ?>" oninput="this.nextElementSibling.value = this.value" style="width: 38px; height: 38px; padding: 2px; border-radius: 6px; border: 1px solid #cbd5e1; cursor: pointer; background: #fff;" />
										<input type="text" name="nav_bar_bg_color" value="<?php echo esc_attr( $nav_bar_bg_color ); ?>" oninput="this.previousElementSibling.value = this.value" style="flex: 1; height: 38px; border-radius: 6px; border: 1px solid #cbd5e1; padding: 0 10px; font-size: 13px; font-family: monospace;" />
									</div>
								</div>

								<!-- Navbar Border Color -->
								<div style="border: 1px solid #e2e8f0; border-radius: 10px; padding: 14px; background: #fafafa;">
									<label style="font-size: 12px; font-weight: 700; color: #0f172a; display: block; margin-bottom: 4px;"><?php esc_html_e( 'Navbar Border Color', 'cartvai-theme' ); ?></label>
									<span style="font-size: 11px; color: #64748b; display: block; margin-bottom: 8px;"><?php esc_html_e( 'Top border dividing main header and navbar.', 'cartvai-theme' ); ?></span>
									<div style="display: flex; align-items: center; gap: 8px;">
										<input type="color" value="<?php echo esc_attr( $nav_bar_border_color ); ?>" oninput="this.nextElementSibling.value = this.value" style="width: 38px; height: 38px; padding: 2px; border-radius: 6px; border: 1px solid #cbd5e1; cursor: pointer; background: #fff;" />
										<input type="text" name="nav_bar_border_color" value="<?php echo esc_attr( $nav_bar_border_color ); ?>" oninput="this.previousElementSibling.value = this.value" style="flex: 1; height: 38px; border-radius: 6px; border: 1px solid #cbd5e1; padding: 0 10px; font-size: 13px; font-family: monospace;" />
									</div>
								</div>

								<!-- Navbar Vertical Padding -->
								<div style="border: 1px solid #e2e8f0; border-radius: 10px; padding: 14px; background: #fafafa;">
									<label style="font-size: 12px; font-weight: 700; color: #0f172a; display: block; margin-bottom: 4px;"><?php esc_html_e( 'Navbar Vertical Padding (px)', 'cartvai-theme' ); ?></label>
									<span style="font-size: 11px; color: #64748b; display: block; margin-bottom: 8px;"><?php esc_html_e( 'Top and bottom inner padding in pixels.', 'cartvai-theme' ); ?></span>
									<input type="number" name="nav_bar_padding_y" value="<?php echo esc_attr( $nav_bar_padding_y ); ?>" min="2" max="40" step="1" style="width: 100%; height: 38px; border-radius: 6px; border: 1px solid #cbd5e1; padding: 0 10px; font-size: 13px;" />
								</div>

								<!-- Nav Link Color -->
								<div style="border: 1px solid #e2e8f0; border-radius: 10px; padding: 14px; background: #fafafa;">
									<label style="font-size: 12px; font-weight: 700; color: #0f172a; display: block; margin-bottom: 4px;"><?php esc_html_e( 'Navigation Link Color', 'cartvai-theme' ); ?></label>
									<span style="font-size: 11px; color: #64748b; display: block; margin-bottom: 8px;"><?php esc_html_e( 'Default text color of menu links.', 'cartvai-theme' ); ?></span>
									<div style="display: flex; align-items: center; gap: 8px;">
										<input type="color" value="<?php echo esc_attr( $nav_link_color ); ?>" oninput="this.nextElementSibling.value = this.value" style="width: 38px; height: 38px; padding: 2px; border-radius: 6px; border: 1px solid #cbd5e1; cursor: pointer; background: #fff;" />
										<input type="text" name="nav_link_color" value="<?php echo esc_attr( $nav_link_color ); ?>" oninput="this.previousElementSibling.value = this.value" style="flex: 1; height: 38px; border-radius: 6px; border: 1px solid #cbd5e1; padding: 0 10px; font-size: 13px; font-family: monospace;" />
									</div>
								</div>

								<!-- Nav Link Hover Color -->
								<div style="border: 1px solid #e2e8f0; border-radius: 10px; padding: 14px; background: #fafafa;">
									<label style="font-size: 12px; font-weight: 700; color: #0f172a; display: block; margin-bottom: 4px;"><?php esc_html_e( 'Navigation Link Hover Color', 'cartvai-theme' ); ?></label>
									<span style="font-size: 11px; color: #64748b; display: block; margin-bottom: 8px;"><?php esc_html_e( 'Color when hovering or active menu link.', 'cartvai-theme' ); ?></span>
									<div style="display: flex; align-items: center; gap: 8px;">
										<input type="color" value="<?php echo esc_attr( $nav_link_hover_color ); ?>" oninput="this.nextElementSibling.value = this.value" style="width: 38px; height: 38px; padding: 2px; border-radius: 6px; border: 1px solid #cbd5e1; cursor: pointer; background: #fff;" />
										<input type="text" name="nav_link_hover_color" value="<?php echo esc_attr( $nav_link_hover_color ); ?>" oninput="this.previousElementSibling.value = this.value" style="flex: 1; height: 38px; border-radius: 6px; border: 1px solid #cbd5e1; padding: 0 10px; font-size: 13px; font-family: monospace;" />
									</div>
								</div>

								<!-- Nav Link Gap (Spacing) -->
								<div style="border: 1px solid #e2e8f0; border-radius: 10px; padding: 14px; background: #fafafa;">
									<label style="font-size: 12px; font-weight: 700; color: #0f172a; display: block; margin-bottom: 4px;"><?php esc_html_e( 'Link Spacing / Gap (px)', 'cartvai-theme' ); ?></label>
									<span style="font-size: 11px; color: #64748b; display: block; margin-bottom: 8px;"><?php esc_html_e( 'Space between adjacent menu items.', 'cartvai-theme' ); ?></span>
									<input type="number" name="nav_link_gap" value="<?php echo esc_attr( $nav_link_gap ); ?>" min="8" max="60" step="1" style="width: 100%; height: 38px; border-radius: 6px; border: 1px solid #cbd5e1; padding: 0 10px; font-size: 13px;" />
								</div>

								<!-- Nav Font Size -->
								<div style="border: 1px solid #e2e8f0; border-radius: 10px; padding: 14px; background: #fafafa;">
									<label style="font-size: 12px; font-weight: 700; color: #0f172a; display: block; margin-bottom: 4px;"><?php esc_html_e( 'Navigation Font Size (px)', 'cartvai-theme' ); ?></label>
									<span style="font-size: 11px; color: #64748b; display: block; margin-bottom: 8px;"><?php esc_html_e( 'Font size of menu links (default: 14px).', 'cartvai-theme' ); ?></span>
									<input type="number" name="nav_font_size" value="<?php echo esc_attr( $nav_font_size ); ?>" min="11" max="22" step="1" style="width: 100%; height: 38px; border-radius: 6px; border: 1px solid #cbd5e1; padding: 0 10px; font-size: 13px;" />
								</div>

								<!-- Nav Font Weight -->
								<div style="border: 1px solid #e2e8f0; border-radius: 10px; padding: 14px; background: #fafafa;">
									<label style="font-size: 12px; font-weight: 700; color: #0f172a; display: block; margin-bottom: 4px;"><?php esc_html_e( 'Navigation Font Weight', 'cartvai-theme' ); ?></label>
									<span style="font-size: 11px; color: #64748b; display: block; margin-bottom: 8px;"><?php esc_html_e( 'Thickness of menu links text.', 'cartvai-theme' ); ?></span>
									<select name="nav_font_weight" style="width: 100%; height: 38px; border-radius: 6px; border: 1px solid #cbd5e1; padding: 0 10px; font-size: 13px; background: #fff;">
										<option value="400" <?php selected( $nav_font_weight, '400' ); ?>><?php esc_html_e( '400 - Normal', 'cartvai-theme' ); ?></option>
										<option value="500" <?php selected( $nav_font_weight, '500' ); ?>><?php esc_html_e( '500 - Medium', 'cartvai-theme' ); ?></option>
										<option value="600" <?php selected( $nav_font_weight, '600' ); ?>><?php esc_html_e( '600 - Semi-Bold', 'cartvai-theme' ); ?></option>
										<option value="700" <?php selected( $nav_font_weight, '700' ); ?>><?php esc_html_e( '700 - Bold', 'cartvai-theme' ); ?></option>
									</select>
								</div>
							</div>
						</div>

					</div>

					<!-- ==========================================
					     TAB 4: FOOTER SETTINGS
					     ========================================== -->
					<div id="tab-footer" class="cv-tab-panel" style="display: none; flex-direction: column; gap: 20px;">
						
						<!-- Footer Layout Selection Card -->
						<div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 22px; box-shadow: 0 1px 2px rgba(0,0,0,0.02);">
							<div style="margin-bottom: 16px;">
								<h2 style="font-size: 16px; font-weight: 700; color: #0f172a; margin: 0 0 4px 0;"><?php esc_html_e( 'Footer Style', 'cartvai-theme' ); ?></h2>
								<p style="font-size: 12px; color: #64748b; margin: 0;"><?php esc_html_e( 'Select the global footer layout.', 'cartvai-theme' ); ?></p>
							</div>

							<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(210px, 1fr)); gap: 12px;">
								<?php foreach ( $footers as $slug => $data ) : ?>
									<?php $is_checked = ( $slug === $current_footer ); ?>
									<label class="cv-card-radio" style="display: block; border: 2px solid <?php echo $is_checked ? '#2563eb' : '#e2e8f0'; ?>; background: <?php echo $is_checked ? '#f8fafc' : '#ffffff'; ?>; border-radius: 10px; padding: 14px; cursor: pointer; transition: all 0.15s;">
										<div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 8px;">
											<input type="radio" name="footer_style" value="<?php echo esc_attr( $slug ); ?>" <?php checked( $is_checked ); ?> style="margin: 0;" />
											<span style="font-size: 10px; font-weight: 700; padding: 2px 7px; border-radius: 9999px; background: <?php echo $is_checked ? '#2563eb' : '#f1f5f9'; ?>; color: <?php echo $is_checked ? '#ffffff' : '#64748b'; ?>;">
												<?php echo esc_html( $data['badge'] ); ?>
											</span>
										</div>
										<strong style="font-size: 14px; color: #0f172a; display: block; margin-bottom: 2px;"><?php echo esc_html( $data['title'] ); ?></strong>
										<span style="font-size: 11px; color: #64748b; line-height: 1.4; display: block;"><?php echo esc_html( $data['desc'] ); ?></span>
									</label>
								<?php endforeach; ?>
							</div>
						</div>

						<!-- Trust & Reassurance Badges Card -->
						<div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 22px; box-shadow: 0 1px 2px rgba(0,0,0,0.02);">
							<div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 16px; padding-bottom: 12px; border-bottom: 1px solid #f1f5f9;">
								<div>
									<h2 style="font-size: 16px; font-weight: 700; color: #0f172a; margin: 0 0 4px 0;"><?php esc_html_e( 'Trust & Reassurance Strip', 'cartvai-theme' ); ?></h2>
									<p style="font-size: 12px; color: #64748b; margin: 0;"><?php esc_html_e( 'Display 4 trust guarantee highlights above the footer columns.', 'cartvai-theme' ); ?></p>
								</div>
								<label class="cartvai-toggle-switch" style="position: relative; display: inline-block; width: 44px; height: 24px;">
									<input type="checkbox" name="footer_trust_enabled" value="1" <?php checked( $footer_trust_enabled ); ?> style="opacity: 0; width: 0; height: 0;">
									<span class="cartvai-toggle-switch__track" style="position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0; background-color: <?php echo $footer_trust_enabled ? '#2563eb' : '#cbd5e1'; ?>; transition: .2s; border-radius: 9999px;"></span>
								</label>
							</div>

							<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 16px;">
								<div style="border: 1px solid #f1f5f9; padding: 14px; border-radius: 8px;">
									<span style="font-size: 11px; font-weight: 700; color: #2563eb; display: block; margin-bottom: 8px;"><?php esc_html_e( 'Badge 1 (Shipping)', 'cartvai-theme' ); ?></span>
									<input type="text" name="footer_trust_1_title" value="<?php echo esc_attr( $footer_trust_1_title ); ?>" placeholder="Title" style="width: 100%; height: 34px; border-radius: 6px; border: 1px solid #cbd5e1; padding: 0 10px; font-size: 12px; margin-bottom: 6px;" />
									<input type="text" name="footer_trust_1_desc" value="<?php echo esc_attr( $footer_trust_1_desc ); ?>" placeholder="Subtitle" style="width: 100%; height: 34px; border-radius: 6px; border: 1px solid #cbd5e1; padding: 0 10px; font-size: 12px;" />
								</div>
								<div style="border: 1px solid #f1f5f9; padding: 14px; border-radius: 8px;">
									<span style="font-size: 11px; font-weight: 700; color: #2563eb; display: block; margin-bottom: 8px;"><?php esc_html_e( 'Badge 2 (Payment)', 'cartvai-theme' ); ?></span>
									<input type="text" name="footer_trust_2_title" value="<?php echo esc_attr( $footer_trust_2_title ); ?>" placeholder="Title" style="width: 100%; height: 34px; border-radius: 6px; border: 1px solid #cbd5e1; padding: 0 10px; font-size: 12px; margin-bottom: 6px;" />
									<input type="text" name="footer_trust_2_desc" value="<?php echo esc_attr( $footer_trust_2_desc ); ?>" placeholder="Subtitle" style="width: 100%; height: 34px; border-radius: 6px; border: 1px solid #cbd5e1; padding: 0 10px; font-size: 12px;" />
								</div>
								<div style="border: 1px solid #f1f5f9; padding: 14px; border-radius: 8px;">
									<span style="font-size: 11px; font-weight: 700; color: #2563eb; display: block; margin-bottom: 8px;"><?php esc_html_e( 'Badge 3 (Returns)', 'cartvai-theme' ); ?></span>
									<input type="text" name="footer_trust_3_title" value="<?php echo esc_attr( $footer_trust_3_title ); ?>" placeholder="Title" style="width: 100%; height: 34px; border-radius: 6px; border: 1px solid #cbd5e1; padding: 0 10px; font-size: 12px; margin-bottom: 6px;" />
									<input type="text" name="footer_trust_3_desc" value="<?php echo esc_attr( $footer_trust_3_desc ); ?>" placeholder="Subtitle" style="width: 100%; height: 34px; border-radius: 6px; border: 1px solid #cbd5e1; padding: 0 10px; font-size: 12px;" />
								</div>
								<div style="border: 1px solid #f1f5f9; padding: 14px; border-radius: 8px;">
									<span style="font-size: 11px; font-weight: 700; color: #2563eb; display: block; margin-bottom: 8px;"><?php esc_html_e( 'Badge 4 (Support)', 'cartvai-theme' ); ?></span>
									<input type="text" name="footer_trust_4_title" value="<?php echo esc_attr( $footer_trust_4_title ); ?>" placeholder="Title" style="width: 100%; height: 34px; border-radius: 6px; border: 1px solid #cbd5e1; padding: 0 10px; font-size: 12px; margin-bottom: 6px;" />
									<input type="text" name="footer_trust_4_desc" value="<?php echo esc_attr( $footer_trust_4_desc ); ?>" placeholder="Subtitle" style="width: 100%; height: 34px; border-radius: 6px; border: 1px solid #cbd5e1; padding: 0 10px; font-size: 12px;" />
								</div>
							</div>
						</div>

						<!-- Newsletter Banner Card -->
						<div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 22px; box-shadow: 0 1px 2px rgba(0,0,0,0.02);">
							<div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 16px; padding-bottom: 12px; border-bottom: 1px solid #f1f5f9;">
								<div>
									<h2 style="font-size: 16px; font-weight: 700; color: #0f172a; margin: 0 0 4px 0;"><?php esc_html_e( 'Newsletter Subscribe Section', 'cartvai-theme' ); ?></h2>
									<p style="font-size: 12px; color: #64748b; margin: 0;"><?php esc_html_e( 'Show email capture block in ecommerce footer.', 'cartvai-theme' ); ?></p>
								</div>
								<label class="cartvai-toggle-switch" style="position: relative; display: inline-block; width: 44px; height: 24px;">
									<input type="checkbox" name="footer_newsletter_enabled" value="1" <?php checked( $footer_newsletter_enabled ); ?> style="opacity: 0; width: 0; height: 0;">
									<span class="cartvai-toggle-switch__track" style="position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0; background-color: <?php echo $footer_newsletter_enabled ? '#2563eb' : '#cbd5e1'; ?>; transition: .2s; border-radius: 9999px;"></span>
								</label>
							</div>

							<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
								<div>
									<label style="display: block; font-size: 12px; font-weight: 600; color: #334155; margin-bottom: 6px;"><?php esc_html_e( 'Heading', 'cartvai-theme' ); ?></label>
									<input type="text" name="footer_newsletter_title" value="<?php echo esc_attr( $footer_newsletter_title ); ?>" style="width: 100%; height: 38px; border-radius: 8px; border: 1px solid #cbd5e1; padding: 0 12px; font-size: 13px;" />
								</div>
								<div>
									<label style="display: block; font-size: 12px; font-weight: 600; color: #334155; margin-bottom: 6px;"><?php esc_html_e( 'Subtitle', 'cartvai-theme' ); ?></label>
									<input type="text" name="footer_newsletter_desc" value="<?php echo esc_attr( $footer_newsletter_desc ); ?>" style="width: 100%; height: 38px; border-radius: 8px; border: 1px solid #cbd5e1; padding: 0 12px; font-size: 13px;" />
								</div>
							</div>
						</div>

						<!-- Store Details & Copyright Card -->
						<div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 22px; box-shadow: 0 1px 2px rgba(0,0,0,0.02);">
							<h2 style="font-size: 16px; font-weight: 700; color: #0f172a; margin: 0 0 16px 0;"><?php esc_html_e( 'Store Details & Copyright', 'cartvai-theme' ); ?></h2>

							<div style="display: flex; flex-direction: column; gap: 16px;">
								<div>
									<label style="display: block; font-size: 12px; font-weight: 600; color: #334155; margin-bottom: 6px;"><?php esc_html_e( 'About Store Text (Column 1)', 'cartvai-theme' ); ?></label>
									<textarea name="footer_about_text" rows="3" style="width: 100%; border-radius: 8px; border: 1px solid #cbd5e1; padding: 8px 12px; font-size: 13px;"><?php echo esc_textarea( $footer_about_text ); ?></textarea>
								</div>

								<div>
									<label style="display: block; font-size: 12px; font-weight: 600; color: #334155; margin-bottom: 6px;"><?php esc_html_e( 'Physical Store / Office Address (Column 5)', 'cartvai-theme' ); ?></label>
									<input type="text" name="footer_store_address" value="<?php echo esc_attr( $footer_store_address ); ?>" placeholder="e.g. Level-5, Noor Tower, 110 Bir Uttam CR Dutta Rd, Dhaka 1205" style="width: 100%; height: 38px; border-radius: 8px; border: 1px solid #cbd5e1; padding: 0 12px; font-size: 13px;" />
								</div>

								<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
									<div>
										<label style="display: block; font-size: 12px; font-weight: 600; color: #334155; margin-bottom: 6px;"><?php esc_html_e( 'Support Email Address', 'cartvai-theme' ); ?></label>
										<input type="email" name="contact_email" value="<?php echo esc_attr( $contact_email ); ?>" placeholder="support@cartvai.com" style="width: 100%; height: 38px; border-radius: 8px; border: 1px solid #cbd5e1; padding: 0 12px; font-size: 13px;" />
									</div>
									<div>
										<label style="display: block; font-size: 12px; font-weight: 600; color: #334155; margin-bottom: 6px;"><?php esc_html_e( 'Safe Checkout Note', 'cartvai-theme' ); ?></label>
										<input type="text" name="footer_security_note" value="<?php echo esc_attr( $footer_security_note ); ?>" style="width: 100%; height: 38px; border-radius: 8px; border: 1px solid #cbd5e1; padding: 0 12px; font-size: 13px;" />
									</div>
								</div>

								<div>
									<label style="display: block; font-size: 12px; font-weight: 600; color: #334155; margin-bottom: 6px;">
										<?php esc_html_e( 'Copyright Notice Text', 'cartvai-theme' ); ?>
										<span style="font-weight: normal; color: #64748b;">(Use {year} and {site_name})</span>
									</label>
									<input type="text" name="footer_copyright_text" value="<?php echo esc_attr( $footer_copyright_text ); ?>" style="width: 100%; height: 38px; border-radius: 8px; border: 1px solid #cbd5e1; padding: 0 12px; font-size: 13px;" />
								</div>
							</div>
						</div>

						<!-- Custom Footer Colors & Menu Freedom Card -->
						<div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 22px; box-shadow: 0 1px 2px rgba(0,0,0,0.02);">
							<div style="margin-bottom: 16px; border-bottom: 1px solid #f1f5f9; padding-bottom: 12px;">
								<h2 style="font-size: 16px; font-weight: 700; color: #0f172a; margin: 0 0 4px 0;"><?php esc_html_e( 'Footer Colors & Menu Management', 'cartvai-theme' ); ?></h2>
								<p style="font-size: 12px; color: #64748b; margin: 0;"><?php esc_html_e( 'Customize footer colors and assign menus to individual footer columns from 1 place.', 'cartvai-theme' ); ?></p>
							</div>

							<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 16px; margin-bottom: 18px;">
								<!-- Footer Background -->
								<div style="border: 1px solid #e2e8f0; border-radius: 10px; padding: 14px; background: #fafafa;">
									<label style="font-size: 12px; font-weight: 700; color: #0f172a; display: block; margin-bottom: 4px;"><?php esc_html_e( 'Custom Footer Background', 'cartvai-theme' ); ?></label>
									<span style="font-size: 11px; color: #64748b; display: block; margin-bottom: 8px;"><?php esc_html_e( 'Leave empty to use layout preset defaults.', 'cartvai-theme' ); ?></span>
									<div style="display: flex; align-items: center; gap: 8px;">
										<input type="color" value="<?php echo esc_attr( $footer_bg_color ?: '#0d3b2e' ); ?>" oninput="this.nextElementSibling.value = this.value" style="width: 38px; height: 38px; padding: 2px; border-radius: 6px; border: 1px solid #cbd5e1; cursor: pointer; background: #fff;" />
										<input type="text" name="footer_bg_color" placeholder="#0d3b2e" value="<?php echo esc_attr( $footer_bg_color ); ?>" oninput="this.previousElementSibling.value = this.value" style="flex: 1; height: 38px; border-radius: 6px; border: 1px solid #cbd5e1; padding: 0 10px; font-size: 13px; font-family: monospace;" />
									</div>
								</div>

								<!-- Footer Heading Color -->
								<div style="border: 1px solid #e2e8f0; border-radius: 10px; padding: 14px; background: #fafafa;">
									<label style="font-size: 12px; font-weight: 700; color: #0f172a; display: block; margin-bottom: 4px;"><?php esc_html_e( 'Footer Heading Color', 'cartvai-theme' ); ?></label>
									<span style="font-size: 11px; color: #64748b; display: block; margin-bottom: 8px;"><?php esc_html_e( 'Color for column titles and subtitles.', 'cartvai-theme' ); ?></span>
									<div style="display: flex; align-items: center; gap: 8px;">
										<input type="color" value="<?php echo esc_attr( $footer_heading_color ?: '#ffffff' ); ?>" oninput="this.nextElementSibling.value = this.value" style="width: 38px; height: 38px; padding: 2px; border-radius: 6px; border: 1px solid #cbd5e1; cursor: pointer; background: #fff;" />
										<input type="text" name="footer_heading_color" placeholder="#ffffff" value="<?php echo esc_attr( $footer_heading_color ); ?>" oninput="this.previousElementSibling.value = this.value" style="flex: 1; height: 38px; border-radius: 6px; border: 1px solid #cbd5e1; padding: 0 10px; font-size: 13px; font-family: monospace;" />
									</div>
								</div>

								<!-- Sub-Footer / Copyright Row Background -->
								<div style="border: 1px solid #e2e8f0; border-radius: 10px; padding: 14px; background: #fafafa;">
									<label style="font-size: 12px; font-weight: 700; color: #0f172a; display: block; margin-bottom: 4px;"><?php esc_html_e( 'Sub-Footer / Copyright Row Background', 'cartvai-theme' ); ?></label>
									<span style="font-size: 11px; color: #64748b; display: block; margin-bottom: 8px;"><?php esc_html_e( 'e.g. rgba(0,0,0,0.15), #06241c, or transparent.', 'cartvai-theme' ); ?></span>
									<input type="text" name="footer_sub_bg_color" placeholder="transparent or #06241c" value="<?php echo esc_attr( $footer_sub_bg_color ); ?>" style="width: 100%; height: 38px; border-radius: 6px; border: 1px solid #cbd5e1; padding: 0 10px; font-size: 13px; font-family: monospace;" />
								</div>
							</div>

							<div style="display: flex; flex-direction: column; gap: 10px;">
								<!-- Link to Appearance -> Widgets for Columns 1 to 5 -->
								<div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px; padding: 16px; display: flex; align-items: center; justify-content: space-between; gap: 14px;">
									<div>
										<strong style="font-size: 13px; color: #0f172a; display: block;"><?php esc_html_e( 'Manage Footer Widgets (Columns 1 to 5)', 'cartvai-theme' ); ?></strong>
										<span style="font-size: 12px; color: #64748b;"><?php esc_html_e( 'Place any block or classic widget in Footer Column 1 through 5 to dynamically customize column contents.', 'cartvai-theme' ); ?></span>
									</div>
									<a href="<?php echo esc_url( admin_url( 'widgets.php' ) ); ?>" class="button button-primary" style="font-weight: 600; white-space: nowrap;">
										<?php esc_html_e( 'Manage Widgets →', 'cartvai-theme' ); ?>
									</a>
								</div>

								<!-- Link to Appearance -> Menus for Columns 1, 2, 3 -->
								<div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px; padding: 16px; display: flex; align-items: center; justify-content: space-between; gap: 14px;">
									<div>
										<strong style="font-size: 13px; color: #0f172a; display: block;"><?php esc_html_e( 'Manage Footer Column Menus (Columns 1, 2, and 3)', 'cartvai-theme' ); ?></strong>
										<span style="font-size: 12px; color: #64748b;"><?php esc_html_e( 'Assign custom menus to "Footer Column 1", "Footer Column 2", and "Footer Column 3" in WordPress Menus for total control.', 'cartvai-theme' ); ?></span>
									</div>
									<a href="<?php echo esc_url( admin_url( 'nav-menus.php?action=locations' ) ); ?>" class="button button-secondary" style="font-weight: 600; white-space: nowrap;">
										<?php esc_html_e( 'Manage Menus →', 'cartvai-theme' ); ?>
									</a>
								</div>
							</div>
						</div>

						<!-- Payment Gateway Banner Image Card -->
						<div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 22px; box-shadow: 0 1px 2px rgba(0,0,0,0.02);">
							<div style="margin-bottom: 16px; border-bottom: 1px solid #f1f5f9; padding-bottom: 12px; display: flex; align-items: center; justify-content: space-between;">
								<div>
									<h2 style="font-size: 16px; font-weight: 700; color: #0f172a; margin: 0 0 4px 0;"><?php esc_html_e( 'Payment Gateway Banner Image', 'cartvai-theme' ); ?></h2>
									<p style="font-size: 12px; color: #64748b; margin: 0;"><?php esc_html_e( 'Upload or enter an image URL for your payment partner strip banner (e.g. SSLCommerz, Shurjopay, bKash/Nagad/Visa strip). Replaces individual badges when set.', 'cartvai-theme' ); ?></p>
								</div>
								<span style="font-size: 11px; font-weight: 600; color: #059669; background: #d1fae5; padding: 3px 10px; border-radius: 9999px;"><?php esc_html_e( 'Image Uploader', 'cartvai-theme' ); ?></span>
							</div>

							<div style="display: flex; flex-direction: column; gap: 12px;">
								<div style="display: flex; gap: 10px; align-items: center;">
									<input type="text" id="footer_payment_image" name="footer_payment_image" value="<?php echo esc_attr( $footer_payment_image ); ?>" placeholder="<?php esc_attr_e( 'https://example.com/payment-banner.png or click Upload', 'cartvai-theme' ); ?>" style="flex: 1; height: 38px; border-radius: 8px; border: 1px solid #cbd5e1; padding: 0 12px; font-size: 13px;" />
									<button type="button" class="button button-secondary cv-upload-image-btn" data-target="footer_payment_image" data-preview="footer_payment_image_preview" style="height: 38px; font-weight: 600; display: inline-flex; align-items: center; gap: 6px;">
										<span class="dashicons dashicons-upload" style="font-size: 16px; width: 16px; height: 16px; line-height: 16px;"></span>
										<?php esc_html_e( 'Upload / Select Image', 'cartvai-theme' ); ?>
									</button>
									<button type="button" class="button cv-remove-image-btn" data-target="footer_payment_image" data-preview="footer_payment_image_preview" style="height: 38px; color: #dc2626; border-color: #fca5a5; <?php echo empty( $footer_payment_image ) ? 'display: none;' : ''; ?>">
										<?php esc_html_e( 'Remove', 'cartvai-theme' ); ?>
									</button>
								</div>

								<div id="footer_payment_image_preview" style="<?php echo empty( $footer_payment_image ) ? 'display: none;' : 'display: inline-block;'; ?> background: #f8fafc; border: 1px dashed #cbd5e1; border-radius: 8px; padding: 12px; max-width: 520px;">
									<img src="<?php echo esc_url( $footer_payment_image ); ?>" alt="<?php esc_attr_e( 'Payment Banner Preview', 'cartvai-theme' ); ?>" style="max-height: 48px; width: auto; object-fit: contain; display: block;" />
								</div>
								<span style="font-size: 11px; color: #94a3b8;"><?php esc_html_e( 'Recommended image: transparent PNG or SVG banner strip (height: 28px - 48px). Leave empty to show clean default vector badges.', 'cartvai-theme' ); ?></span>
							</div>
						</div>
					</div>

					<!-- ==========================================
					     TAB 5: HOMEPAGE SETTINGS (Hero & Sections)
					     ========================================== -->
					<div id="tab-homepage" class="cv-tab-panel" style="display: none; flex-direction: column; gap: 20px;">
						
						<!-- Block Editor Callout Tip -->
						<div style="background: #eff6ff; border: 1px solid #bfdbfe; border-radius: 12px; padding: 16px 20px; display: flex; align-items: center; justify-content: space-between; gap: 16px;">
							<div style="display: flex; align-items: center; gap: 12px;">
								<span class="dashicons dashicons-layout" style="font-size: 24px; width: 24px; height: 24px; color: #2563eb;"></span>
								<div>
									<strong style="font-size: 13px; color: #1e3a8a; display: block;"><?php esc_html_e( 'WordPress Native Block Patterns Available', 'cartvai-theme' ); ?></strong>
									<span style="font-size: 12px; color: #3b82f6;"><?php esc_html_e( 'You can also visually build or edit your homepage in the Gutenberg block editor using the "Cartvai" block patterns (+ -> Patterns -> Cartvai).', 'cartvai-theme' ); ?></span>
								</div>
							</div>
							<a href="<?php echo esc_url( admin_url( 'edit.php?post_type=page' ) ); ?>" class="button button-secondary" style="font-weight: 600; white-space: nowrap;">
								<?php esc_html_e( 'View Pages →', 'cartvai-theme' ); ?>
							</a>
						</div>

						<!-- Main Hero Banner Settings -->
						<div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 22px; box-shadow: 0 1px 2px rgba(0,0,0,0.02);">
							<div style="margin-bottom: 20px; border-bottom: 1px solid #f1f5f9; padding-bottom: 14px; display: flex; align-items: center; justify-content: space-between;">
								<div>
									<h2 style="font-size: 16px; font-weight: 700; color: #0f172a; margin: 0 0 4px 0;"><?php esc_html_e( 'Main Hero Banner (Left 8 Columns)', 'cartvai-theme' ); ?></h2>
									<p style="font-size: 12px; color: #64748b; margin: 0;"><?php esc_html_e( 'Control the main headline, callout badge, CTA buttons, and banner media image.', 'cartvai-theme' ); ?></p>
								</div>
								<span style="font-size: 11px; font-weight: 600; color: #059669; background: #d1fae5; padding: 3px 10px; border-radius: 9999px;"><?php esc_html_e( 'Hero Showcase', 'cartvai-theme' ); ?></span>
							</div>

							<div style="display: flex; flex-direction: column; gap: 16px;">
								<!-- Hero Badge -->
								<div>
									<label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 6px;"><?php esc_html_e( 'Hero Top Eyebrow Badge', 'cartvai-theme' ); ?></label>
									<input type="text" name="homepage_hero_badge" value="<?php echo esc_attr( $homepage_hero_badge ); ?>" style="width: 100%; max-width: 500px; height: 38px; border-radius: 8px; border: 1px solid #cbd5e1; padding: 0 12px; font-size: 13px;" />
								</div>

								<!-- Hero Title -->
								<div>
									<label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 6px;"><?php esc_html_e( 'Hero Main Title / Headline', 'cartvai-theme' ); ?></label>
									<input type="text" name="homepage_hero_title" value="<?php echo esc_attr( $homepage_hero_title ); ?>" style="width: 100%; max-width: 600px; height: 38px; border-radius: 8px; border: 1px solid #cbd5e1; padding: 0 12px; font-size: 14px; font-weight: 600;" />
								</div>

								<!-- Hero Subtitle -->
								<div>
									<label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 6px;"><?php esc_html_e( 'Hero Subtitle / Description', 'cartvai-theme' ); ?></label>
									<textarea name="homepage_hero_subtitle" rows="3" style="width: 100%; max-width: 650px; border-radius: 8px; border: 1px solid #cbd5e1; padding: 10px 12px; font-size: 13px; line-height: 1.5;"><?php echo esc_textarea( $homepage_hero_subtitle ); ?></textarea>
								</div>

								<!-- Buttons Grid -->
								<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 16px;">
									<div style="border: 1px solid #f1f5f9; border-radius: 8px; padding: 14px; background: #fafafa;">
										<strong style="font-size: 12px; color: #0f172a; display: block; margin-bottom: 8px;"><?php esc_html_e( 'Primary Button', 'cartvai-theme' ); ?></strong>
										<div style="display: flex; flex-direction: column; gap: 8px;">
											<input type="text" name="homepage_hero_btn1_text" placeholder="<?php esc_attr_e( 'Button Text (e.g. Shop Collection)', 'cartvai-theme' ); ?>" value="<?php echo esc_attr( $homepage_hero_btn1_text ); ?>" style="width: 100%; height: 36px; border-radius: 6px; border: 1px solid #cbd5e1; padding: 0 10px; font-size: 13px;" />
											<input type="url" name="homepage_hero_btn1_url" placeholder="<?php esc_attr_e( 'URL (Leave blank for shop page)', 'cartvai-theme' ); ?>" value="<?php echo esc_attr( $homepage_hero_btn1_url ); ?>" style="width: 100%; height: 36px; border-radius: 6px; border: 1px solid #cbd5e1; padding: 0 10px; font-size: 13px;" />
										</div>
									</div>

									<div style="border: 1px solid #f1f5f9; border-radius: 8px; padding: 14px; background: #fafafa;">
										<strong style="font-size: 12px; color: #0f172a; display: block; margin-bottom: 8px;"><?php esc_html_e( 'Secondary Outline Button', 'cartvai-theme' ); ?></strong>
										<div style="display: flex; flex-direction: column; gap: 8px;">
											<input type="text" name="homepage_hero_btn2_text" placeholder="<?php esc_attr_e( 'Button Text (e.g. View Flash Deals)', 'cartvai-theme' ); ?>" value="<?php echo esc_attr( $homepage_hero_btn2_text ); ?>" style="width: 100%; height: 36px; border-radius: 6px; border: 1px solid #cbd5e1; padding: 0 10px; font-size: 13px;" />
											<input type="url" name="homepage_hero_btn2_url" placeholder="<?php esc_attr_e( 'URL (Leave blank for shop page)', 'cartvai-theme' ); ?>" value="<?php echo esc_attr( $homepage_hero_btn2_url ); ?>" style="width: 100%; height: 36px; border-radius: 6px; border: 1px solid #cbd5e1; padding: 0 10px; font-size: 13px;" />
										</div>
									</div>
								</div>

								<!-- Perks String -->
								<div>
									<label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 6px;"><?php esc_html_e( 'Trust Perks Bullet Points', 'cartvai-theme' ); ?></label>
									<input type="text" name="homepage_hero_perks" value="<?php echo esc_attr( $homepage_hero_perks ); ?>" style="width: 100%; max-width: 600px; height: 38px; border-radius: 8px; border: 1px solid #cbd5e1; padding: 0 12px; font-size: 13px;" />
								</div>

								<!-- Hero Custom Image -->
								<div>
									<label style="display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 6px;"><?php esc_html_e( 'Hero Banner Media Image (Optional)', 'cartvai-theme' ); ?></label>
									<div style="display: flex; gap: 10px; align-items: center; max-width: 650px;">
										<input type="text" id="homepage_hero_image" name="homepage_hero_image" value="<?php echo esc_attr( $homepage_hero_image ); ?>" placeholder="<?php esc_attr_e( 'Upload an image or paste URL', 'cartvai-theme' ); ?>" style="flex: 1; height: 38px; border-radius: 8px; border: 1px solid #cbd5e1; padding: 0 12px; font-size: 13px;" />
										<button type="button" class="button button-secondary cv-upload-image-btn" data-target="homepage_hero_image" data-preview="homepage_hero_image_preview" style="height: 38px; font-weight: 600; display: inline-flex; align-items: center; gap: 6px;">
											<span class="dashicons dashicons-upload" style="font-size: 16px; width: 16px; height: 16px; line-height: 16px;"></span>
											<?php esc_html_e( 'Upload Image', 'cartvai-theme' ); ?>
										</button>
										<button type="button" class="button cv-remove-image-btn" data-target="homepage_hero_image" data-preview="homepage_hero_image_preview" style="height: 38px; color: #dc2626; border-color: #fca5a5; <?php echo empty( $homepage_hero_image ) ? 'display: none;' : ''; ?>">
											<?php esc_html_e( 'Remove', 'cartvai-theme' ); ?>
										</button>
									</div>
									<div id="homepage_hero_image_preview" style="<?php echo empty( $homepage_hero_image ) ? 'display: none;' : 'display: inline-block;'; ?> margin-top: 10px; background: #f8fafc; border: 1px dashed #cbd5e1; border-radius: 8px; padding: 12px; max-width: 320px;">
										<img src="<?php echo esc_url( $homepage_hero_image ); ?>" alt="<?php esc_attr_e( 'Hero Preview', 'cartvai-theme' ); ?>" style="max-height: 90px; width: auto; object-fit: contain; display: block;" />
									</div>
								</div>
							</div>
						</div>

						<!-- Secondary Hero Promo Cards (Right Column) -->
						<div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 22px; box-shadow: 0 1px 2px rgba(0,0,0,0.02);">
							<div style="margin-bottom: 20px; border-bottom: 1px solid #f1f5f9; padding-bottom: 14px;">
								<h2 style="font-size: 16px; font-weight: 700; color: #0f172a; margin: 0 0 4px 0;"><?php esc_html_e( 'Secondary Hero Promo Cards (Right 4 Columns)', 'cartvai-theme' ); ?></h2>
								<p style="font-size: 12px; color: #64748b; margin: 0;"><?php esc_html_e( 'Two stacked high-converting promotional deal cards placed next to the main banner.', 'cartvai-theme' ); ?></p>
							</div>

							<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 18px;">
								
								<!-- Promo Card 1 -->
								<div style="border: 1px solid #bbf7d0; background: #f0fdf4; border-radius: 10px; padding: 16px; display: flex; flex-direction: column; gap: 10px;">
									<strong style="font-size: 13px; color: #166534; display: block; border-bottom: 1px solid #dcfce7; padding-bottom: 6px;"><?php esc_html_e( 'Promo Card 1 (Top)', 'cartvai-theme' ); ?></strong>
									
									<div>
										<label style="font-size: 11px; font-weight: 700; color: #166534; display: block; margin-bottom: 4px;"><?php esc_html_e( 'Badge Text', 'cartvai-theme' ); ?></label>
										<input type="text" name="homepage_promo1_badge" value="<?php echo esc_attr( $homepage_promo1_badge ); ?>" style="width: 100%; height: 34px; border-radius: 6px; border: 1px solid #cbd5e1; padding: 0 10px; font-size: 12px;" />
									</div>

									<div>
										<label style="font-size: 11px; font-weight: 700; color: #166534; display: block; margin-bottom: 4px;"><?php esc_html_e( 'Card Title', 'cartvai-theme' ); ?></label>
										<input type="text" name="homepage_promo1_title" value="<?php echo esc_attr( $homepage_promo1_title ); ?>" style="width: 100%; height: 34px; border-radius: 6px; border: 1px solid #cbd5e1; padding: 0 10px; font-size: 13px; font-weight: 600;" />
									</div>

									<div>
										<label style="font-size: 11px; font-weight: 700; color: #166534; display: block; margin-bottom: 4px;"><?php esc_html_e( 'Card Description', 'cartvai-theme' ); ?></label>
										<input type="text" name="homepage_promo1_desc" value="<?php echo esc_attr( $homepage_promo1_desc ); ?>" style="width: 100%; height: 34px; border-radius: 6px; border: 1px solid #cbd5e1; padding: 0 10px; font-size: 12px;" />
									</div>

									<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 8px;">
										<div>
											<label style="font-size: 11px; font-weight: 700; color: #166534; display: block; margin-bottom: 4px;"><?php esc_html_e( 'Price Pill Text', 'cartvai-theme' ); ?></label>
											<input type="text" name="homepage_promo1_price" value="<?php echo esc_attr( $homepage_promo1_price ); ?>" style="width: 100%; height: 34px; border-radius: 6px; border: 1px solid #cbd5e1; padding: 0 10px; font-size: 12px;" />
										</div>
										<div>
											<label style="font-size: 11px; font-weight: 700; color: #166534; display: block; margin-bottom: 4px;"><?php esc_html_e( 'Button Text', 'cartvai-theme' ); ?></label>
											<input type="text" name="homepage_promo1_btn_text" value="<?php echo esc_attr( $homepage_promo1_btn_text ); ?>" style="width: 100%; height: 34px; border-radius: 6px; border: 1px solid #cbd5e1; padding: 0 10px; font-size: 12px;" />
										</div>
									</div>

									<div>
										<label style="font-size: 11px; font-weight: 700; color: #166534; display: block; margin-bottom: 4px;"><?php esc_html_e( 'Destination URL', 'cartvai-theme' ); ?></label>
										<input type="url" name="homepage_promo1_url" placeholder="<?php esc_attr_e( 'Leave blank for shop page', 'cartvai-theme' ); ?>" value="<?php echo esc_attr( $homepage_promo1_url ); ?>" style="width: 100%; height: 34px; border-radius: 6px; border: 1px solid #cbd5e1; padding: 0 10px; font-size: 12px;" />
									</div>
								</div>

								<!-- Promo Card 2 -->
								<div style="border: 1px solid #fde68a; background: #fffbeb; border-radius: 10px; padding: 16px; display: flex; flex-direction: column; gap: 10px;">
									<strong style="font-size: 13px; color: #92400e; display: block; border-bottom: 1px solid #fef3c7; padding-bottom: 6px;"><?php esc_html_e( 'Promo Card 2 (Bottom)', 'cartvai-theme' ); ?></strong>
									
									<div>
										<label style="font-size: 11px; font-weight: 700; color: #92400e; display: block; margin-bottom: 4px;"><?php esc_html_e( 'Badge Text', 'cartvai-theme' ); ?></label>
										<input type="text" name="homepage_promo2_badge" value="<?php echo esc_attr( $homepage_promo2_badge ); ?>" style="width: 100%; height: 34px; border-radius: 6px; border: 1px solid #cbd5e1; padding: 0 10px; font-size: 12px;" />
									</div>

									<div>
										<label style="font-size: 11px; font-weight: 700; color: #92400e; display: block; margin-bottom: 4px;"><?php esc_html_e( 'Card Title', 'cartvai-theme' ); ?></label>
										<input type="text" name="homepage_promo2_title" value="<?php echo esc_attr( $homepage_promo2_title ); ?>" style="width: 100%; height: 34px; border-radius: 6px; border: 1px solid #cbd5e1; padding: 0 10px; font-size: 13px; font-weight: 600;" />
									</div>

									<div>
										<label style="font-size: 11px; font-weight: 700; color: #92400e; display: block; margin-bottom: 4px;"><?php esc_html_e( 'Card Description', 'cartvai-theme' ); ?></label>
										<input type="text" name="homepage_promo2_desc" value="<?php echo esc_attr( $homepage_promo2_desc ); ?>" style="width: 100%; height: 34px; border-radius: 6px; border: 1px solid #cbd5e1; padding: 0 10px; font-size: 12px;" />
									</div>

									<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 8px;">
										<div>
											<label style="font-size: 11px; font-weight: 700; color: #92400e; display: block; margin-bottom: 4px;"><?php esc_html_e( 'Price Pill Text', 'cartvai-theme' ); ?></label>
											<input type="text" name="homepage_promo2_price" value="<?php echo esc_attr( $homepage_promo2_price ); ?>" style="width: 100%; height: 34px; border-radius: 6px; border: 1px solid #cbd5e1; padding: 0 10px; font-size: 12px;" />
										</div>
										<div>
											<label style="font-size: 11px; font-weight: 700; color: #92400e; display: block; margin-bottom: 4px;"><?php esc_html_e( 'Button Text', 'cartvai-theme' ); ?></label>
											<input type="text" name="homepage_promo2_btn_text" value="<?php echo esc_attr( $homepage_promo2_btn_text ); ?>" style="width: 100%; height: 34px; border-radius: 6px; border: 1px solid #cbd5e1; padding: 0 10px; font-size: 12px;" />
										</div>
									</div>

									<div>
										<label style="font-size: 11px; font-weight: 700; color: #92400e; display: block; margin-bottom: 4px;"><?php esc_html_e( 'Destination URL', 'cartvai-theme' ); ?></label>
										<input type="url" name="homepage_promo2_url" placeholder="<?php esc_attr_e( 'Leave blank for shop page', 'cartvai-theme' ); ?>" value="<?php echo esc_attr( $homepage_promo2_url ); ?>" style="width: 100%; height: 34px; border-radius: 6px; border: 1px solid #cbd5e1; padding: 0 10px; font-size: 12px;" />
									</div>
								</div>

							</div>
						</div>

						<!-- Trust & Value Props Strip Toggle -->
						<div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 22px; box-shadow: 0 1px 2px rgba(0,0,0,0.02);">
							<div style="display: flex; align-items: center; justify-content: space-between;">
								<div>
									<h2 style="font-size: 16px; font-weight: 700; color: #0f172a; margin: 0 0 4px 0;"><?php esc_html_e( 'Trust Badges & Value Props Strip', 'cartvai-theme' ); ?></h2>
									<p style="font-size: 12px; color: #64748b; margin: 0;"><?php esc_html_e( 'Display the 4-card value proposition row (Free Shipping, Secure Checkout, 30-Day Returns, 24/7 Support) under the hero.', 'cartvai-theme' ); ?></p>
								</div>
								<label class="cartvai-toggle-switch" style="position: relative; display: inline-block; width: 44px; height: 24px;">
									<input type="checkbox" name="homepage_trust_enabled" value="1" <?php checked( $homepage_trust_enabled ); ?> style="opacity: 0; width: 0; height: 0;">
									<span class="cartvai-toggle-switch__track" style="position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0; background-color: <?php echo $homepage_trust_enabled ? '#2563eb' : '#cbd5e1'; ?>; transition: .2s; border-radius: 9999px;"></span>
								</label>
							</div>
						</div>

					</div>

				</div>
			</div>
		</form>
	</div>

	<!-- Tab Switching & Color Synchronizer Script -->
	<script>
	document.addEventListener('DOMContentLoaded', function() {
		const tabButtons = document.querySelectorAll('.cv-tab-btn');
		const tabPanels = document.querySelectorAll('.cv-tab-panel');

		tabButtons.forEach(btn => {
			btn.addEventListener('click', function(e) {
				e.preventDefault();
				const targetTab = this.getAttribute('data-tab');

				tabButtons.forEach(b => {
					b.classList.remove('is-active');
					b.style.background = 'transparent';
					b.style.color = '#64748b';
				});

				this.classList.add('is-active');
				this.style.background = '#eff6ff';
				this.style.color = '#2563eb';

				tabPanels.forEach(panel => {
					if (panel.id === targetTab) {
						panel.style.display = 'flex';
					} else {
						panel.style.display = 'none';
					}
				});
			});
		});

		// Visual radio card highlight sync
		const radioCards = document.querySelectorAll('.cv-card-radio');
		radioCards.forEach(card => {
			const input = card.querySelector('input[type="radio"]');
			if (input) {
				input.addEventListener('change', function() {
					const name = this.name;
					document.querySelectorAll('input[name="' + name + '"]').forEach(r => {
						const parent = r.closest('.cv-card-radio');
						if (parent) {
							parent.style.borderColor = '#e2e8f0';
							parent.style.background = '#ffffff';
							const badge = parent.querySelector('span[style*="border-radius: 9999px"]');
							if (badge) {
								badge.style.background = '#f1f5f9';
								badge.style.color = '#64748b';
							}
						}
					});

					card.style.borderColor = '#2563eb';
					card.style.background = '#f8fafc';
					const activeBadge = card.querySelector('span[style*="border-radius: 9999px"]');
					if (activeBadge) {
						activeBadge.style.background = '#2563eb';
						activeBadge.style.color = '#ffffff';
					}
				});
			}
		});

		// Live toggle switch color update
		const toggles = document.querySelectorAll('.cartvai-toggle-switch input[type="checkbox"]');
		toggles.forEach(toggle => {
			toggle.addEventListener('change', function() {
				const track = this.nextElementSibling;
				if (track) {
					track.style.backgroundColor = this.checked ? '#2563eb' : '#cbd5e1';
				}
			});
		});

		// Live Color Picker & Hex Input Sync
		const colorPickers = document.querySelectorAll('.cv-color-picker-input');
		colorPickers.forEach(picker => {
			const targetId = picker.getAttribute('data-target');
			const textInput = document.getElementById(targetId);

			if (textInput) {
				picker.addEventListener('input', function() {
					textInput.value = this.value;
				});

				textInput.addEventListener('input', function() {
					if (/^#[0-9A-Fa-f]{6}$/.test(this.value)) {
						picker.value = this.value;
					}
				});
			}
		});

		// Media Uploader for Image Inputs
		const uploadBtns = document.querySelectorAll('.cv-upload-image-btn');
		uploadBtns.forEach(btn => {
			btn.addEventListener('click', function(e) {
				e.preventDefault();
				const targetId = this.getAttribute('data-target');
				const previewId = this.getAttribute('data-preview');
				const targetInput = document.getElementById(targetId);
				const previewDiv = document.getElementById(previewId);
				const removeBtn = this.parentElement.querySelector('.cv-remove-image-btn');

				if (typeof wp !== 'undefined' && wp.media) {
					const mediaFrame = wp.media({
						title: '<?php echo esc_js( __( 'Select or Upload Payment Banner Image', 'cartvai-theme' ) ); ?>',
						button: {
							text: '<?php echo esc_js( __( 'Use this image', 'cartvai-theme' ) ); ?>'
						},
						multiple: false
					});

					mediaFrame.on('select', function() {
						const attachment = mediaFrame.state().get('selection').first().toJSON();
						if (targetInput) {
							targetInput.value = attachment.url;
						}
						if (previewDiv) {
							previewDiv.innerHTML = '<img src="' + attachment.url + '" alt="Payment Banner Preview" style="max-height: 48px; width: auto; object-fit: contain; display: block;" />';
							previewDiv.style.display = 'inline-block';
						}
						if (removeBtn) {
							removeBtn.style.display = 'inline-block';
						}
					});

					mediaFrame.open();
				}
			});
		});

		// Remove Image Button
		const removeBtns = document.querySelectorAll('.cv-remove-image-btn');
		removeBtns.forEach(btn => {
			btn.addEventListener('click', function(e) {
				e.preventDefault();
				const targetId = this.getAttribute('data-target');
				const previewId = this.getAttribute('data-preview');
				const targetInput = document.getElementById(targetId);
				const previewDiv = document.getElementById(previewId);

				if (targetInput) {
					targetInput.value = '';
				}
				if (previewDiv) {
					previewDiv.innerHTML = '';
					previewDiv.style.display = 'none';
				}
				this.style.display = 'none';
			});
		});

		// Direct Input Change Preview Sync
		const setupImageInputSync = function(inputId, previewId, maxHeight) {
			const input = document.getElementById(inputId);
			if (input) {
				input.addEventListener('input', function() {
					const val = this.value.trim();
					const previewDiv = document.getElementById(previewId);
					const removeBtn = this.parentElement.querySelector('.cv-remove-image-btn');

					if (val && previewDiv) {
						previewDiv.innerHTML = '<img src="' + encodeURI(val) + '" alt="Preview" style="max-height: ' + maxHeight + 'px; width: auto; object-fit: contain; display: block;" />';
						previewDiv.style.display = 'inline-block';
						if (removeBtn) removeBtn.style.display = 'inline-block';
					} else if (previewDiv) {
						previewDiv.innerHTML = '';
						previewDiv.style.display = 'none';
						if (removeBtn) removeBtn.style.display = 'none';
					}
				});
			}
		};
		setupImageInputSync('footer_payment_image', 'footer_payment_image_preview', 48);
		setupImageInputSync('homepage_hero_image', 'homepage_hero_image_preview', 90);
	});
	</script>
	<?php
}
