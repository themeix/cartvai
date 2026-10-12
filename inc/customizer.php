<?php
/**
 * Cartvai Theme Customizer Controls
 *
 * Provides live Customizer controls for:
 * 1. Site Colors (Primary, Hover, Light, Accent, Heading, Text, Border, Background)
 * 2. Product Card Options (Hide description, qty, buy now, add to cart, badges)
 * 3. Header & Footer variations and settings
 *
 * Uses the custom Cartvai capability 'manage_cartvai_theme' and synchronizes
 * values with both cartvai_theme_settings and CARTVAI_Settings.
 *
 * @package Cartvai_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function cartvai_theme_customize_register( $wp_customize ) {
	$cap = defined( 'CARTVAI_THEME_CAPABILITY' ) ? CARTVAI_THEME_CAPABILITY : 'manage_options';

	// ==========================================
	// 1. SECTION: Global Colors & Design Tokens
	// ==========================================
	$wp_customize->add_section(
		'cartvai_theme_colors',
		array(
			'title'       => esc_html__( 'Cartvai Colors & Styling', 'cartvai' ),
			'description' => esc_html__( 'Manage site-wide colors from 1 place. Applies to buttons, headers, cards, badges, and checkout.', 'cartvai' ),
			'priority'    => 25,
			'capability'  => $cap,
		)
	);

	$colors = array(
		'cartvai_primary_color'       => array(
			'default' => '#2563eb',
			'label'   => esc_html__( 'Primary Brand Color', 'cartvai' ),
			'desc'    => esc_html__( 'Main buttons (Buy Now), active links, and brand highlights.', 'cartvai' ),
		),
		'cartvai_primary_hover_color' => array(
			'default' => '#1d4ed8',
			'label'   => esc_html__( 'Primary Hover Color', 'cartvai' ),
			'desc'    => esc_html__( 'Hover state for primary buttons and links.', 'cartvai' ),
		),
		'cartvai_primary_light_color' => array(
			'default' => '#eff6ff',
			'label'   => esc_html__( 'Primary Light Tint', 'cartvai' ),
			'desc'    => esc_html__( 'Soft background tint for active tabs and badge containers.', 'cartvai' ),
		),
		'cartvai_accent_color'        => array(
			'default' => '#0f172a',
			'label'   => esc_html__( 'Accent / Secondary Color', 'cartvai' ),
			'desc'    => esc_html__( 'Dark contrast buttons, labels, and badges.', 'cartvai' ),
		),
		'cartvai_heading_color'       => array(
			'default' => '#0f172a',
			'label'   => esc_html__( 'Headings Color', 'cartvai' ),
			'desc'    => esc_html__( 'Applied to page titles, headings (H1-H6), and product names.', 'cartvai' ),
		),
		'cartvai_text_color'          => array(
			'default' => '#334155',
			'label'   => esc_html__( 'Body Text Color', 'cartvai' ),
			'desc'    => esc_html__( 'Applied to body paragraphs, product descriptions, and metadata.', 'cartvai' ),
		),
		'cartvai_border_color'        => array(
			'default' => '#e2e8f0',
			'label'   => esc_html__( 'Border & Divider Color', 'cartvai' ),
			'desc'    => esc_html__( 'Card borders, table dividers, and input borders.', 'cartvai' ),
		),
		'cartvai_bg_color'            => array(
			'default' => '#f8fafc',
			'label'   => esc_html__( 'Site Background Color', 'cartvai' ),
			'desc'    => esc_html__( 'Storefront canvas background behind cards.', 'cartvai' ),
		),
	);

	foreach ( $colors as $setting_id => $data ) {
		$wp_customize->add_setting(
			$setting_id,
			array(
				'default'           => $data['default'],
				'sanitize_callback' => 'sanitize_hex_color',
				'transport'         => 'refresh',
				'capability'        => $cap,
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				$setting_id,
				array(
					'label'       => $data['label'],
					'description' => $data['desc'],
					'section'     => 'cartvai_theme_colors',
				)
			)
		);
	}

	// ==========================================
	// 2. SECTION: Product Card Options
	// ==========================================
	$wp_customize->add_section(
		'cartvai_theme_product_cards',
		array(
			'title'       => esc_html__( 'Cartvai Product Cards', 'cartvai' ),
			'description' => esc_html__( 'Customize product card visibility across Shop, Category archives, Tags, and Related Products.', 'cartvai' ),
			'priority'    => 28,
			'capability'  => $cap,
		)
	);

	$card_toggles = array(
		'cartvai_shop_page_hide_short_description' => array(
			'label' => esc_html__( 'Hide Short Description', 'cartvai' ),
			'desc'  => esc_html__( 'Remove excerpt text below product title on cards.', 'cartvai' ),
		),
		'cartvai_shop_page_hide_quantity'          => array(
			'label' => esc_html__( 'Hide Quantity Selector', 'cartvai' ),
			'desc'  => esc_html__( 'Remove the -/+ quantity selector from product cards.', 'cartvai' ),
		),
		'cartvai_shop_page_hide_buy_now'           => array(
			'label' => esc_html__( 'Hide "Buy Now" Button', 'cartvai' ),
			'desc'  => esc_html__( 'Remove the direct checkout Buy Now button.', 'cartvai' ),
		),
		'cartvai_shop_page_hide_add_to_cart'       => array(
			'label' => esc_html__( 'Hide "Add to Cart" Button', 'cartvai' ),
			'desc'  => esc_html__( 'Remove the Add to Cart button from cards.', 'cartvai' ),
		),
		'cartvai_shop_page_hide_off_badge'         => array(
			'label' => esc_html__( 'Hide Discount (% OFF) Badge', 'cartvai' ),
			'desc'  => esc_html__( 'Remove percentage discount badge on sale cards.', 'cartvai' ),
		),
		'cartvai_shop_page_hide_save_badge'        => array(
			'label' => esc_html__( 'Hide "Save Amount" Badge', 'cartvai' ),
			'desc'  => esc_html__( 'Remove green Save $XX pill next to sale price.', 'cartvai' ),
		),
	);

	foreach ( $card_toggles as $setting_id => $data ) {
		$wp_customize->add_setting(
			$setting_id,
			array(
				'default'           => false,
				'sanitize_callback' => 'rest_sanitize_boolean',
				'transport'         => 'refresh',
				'capability'        => $cap,
			)
		);

		$wp_customize->add_control(
			$setting_id,
			array(
				'label'       => $data['label'],
				'description' => $data['desc'],
				'section'     => 'cartvai_theme_product_cards',
				'type'        => 'checkbox',
			)
		);
	}

	// ==========================================
	// 3. SECTION: Header Settings
	// ==========================================
	$wp_customize->add_section(
		'cartvai_theme_header',
		array(
			'title'       => esc_html__( 'Cartvai Header Settings', 'cartvai' ),
			'description' => esc_html__( 'Select and customize your ecommerce header, announcements, helpline, and navbar styling.', 'cartvai' ),
			'priority'    => 30,
			'capability'  => $cap,
		)
	);

	// Header Style
	$wp_customize->add_setting(
		'cartvai_header_style',
		array(
			'default'           => 'megastore',
			'sanitize_callback' => 'sanitize_key',
			'transport'         => 'refresh',
			'capability'        => $cap,
		)
	);

	$wp_customize->add_control(
		'cartvai_header_style',
		array(
			'label'       => esc_html__( 'Header Layout Style', 'cartvai' ),
			'description' => esc_html__( 'Choose from several tailored ecommerce header designs.', 'cartvai' ),
			'section'     => 'cartvai_theme_header',
			'type'        => 'select',
			'choices'     => array(
				'megastore' => esc_html__( 'Colorful Megastore + Mega Menu (Rich Brand Header)', 'cartvai' ),
				'megabar'   => esc_html__( 'Contrast MegaBar + Mega Menu (White Top + Brand Navbar)', 'cartvai' ),
				'ecommerce' => esc_html__( 'Ecommerce Store (Top Bar + Search + Categories)', 'cartvai' ),
				'default'   => esc_html__( 'Default Standard (Logo + Nav + Cart)', 'cartvai' ),
				'centered'  => esc_html__( 'Centered Logo (Luxury / Boutique Style)', 'cartvai' ),
				'minimal'   => esc_html__( 'Minimalist (Clean & Ultra-compact)', 'cartvai' ),
			),
		)
	);

	// Top Announcement Bar Toggle & Text
	$wp_customize->add_setting(
		'cartvai_announcement_enabled',
		array(
			'default'           => true,
			'sanitize_callback' => 'rest_sanitize_boolean',
			'capability'        => $cap,
		)
	);

	$wp_customize->add_control(
		'cartvai_announcement_enabled',
		array(
			'label'       => esc_html__( 'Show Top Announcement Bar', 'cartvai' ),
			'section'     => 'cartvai_theme_header',
			'type'        => 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'cartvai_announcement_text',
		array(
			'default'           => '⚡ Flash Sale: Enjoy free shipping on orders over $50! Shop Now',
			'sanitize_callback' => 'sanitize_text_field',
			'capability'        => $cap,
		)
	);

	$wp_customize->add_control(
		'cartvai_announcement_text',
		array(
			'label'       => esc_html__( 'Announcement Bar Text', 'cartvai' ),
			'section'     => 'cartvai_theme_header',
			'type'        => 'text',
		)
	);

	// Brand Tagline Toggle (Megastore Header)
	$wp_customize->add_setting(
		'cartvai_brand_tagline_enabled',
		array(
			'default'           => true,
			'sanitize_callback' => 'rest_sanitize_boolean',
			'capability'        => $cap,
		)
	);

	$wp_customize->add_control(
		'cartvai_brand_tagline_enabled',
		array(
			'label'       => esc_html__( 'Show Brand Tagline ("Official Megastore")', 'cartvai' ),
			'description' => esc_html__( 'Display the site description tagline under the site name in the megastore header.', 'cartvai' ),
			'section'     => 'cartvai_theme_header',
			'type'        => 'checkbox',
		)
	);

	// Contact / Helpline
	$wp_customize->add_setting(
		'cartvai_contact_phone',
		array(
			'default'           => '+1 (800) 123-4567',
			'sanitize_callback' => 'sanitize_text_field',
			'capability'        => $cap,
		)
	);

	$wp_customize->add_control(
		'cartvai_contact_phone',
		array(
			'label'       => esc_html__( 'Support Phone / Hotline', 'cartvai' ),
			'section'     => 'cartvai_theme_header',
			'type'        => 'text',
		)
	);

	// Contact / Support Email
	$wp_customize->add_setting(
		'cartvai_contact_email',
		array(
			'default'           => 'support@cartvai.com',
			'sanitize_callback' => 'sanitize_email',
			'capability'        => $cap,
		)
	);

	$wp_customize->add_control(
		'cartvai_contact_email',
		array(
			'label'       => esc_html__( 'Support Email Address', 'cartvai' ),
			'section'     => 'cartvai_theme_header',
			'type'        => 'email',
			'input_attrs' => array(
				'placeholder' => 'support@cartvai.com',
			),
		)
	);


	// More Button Visibility
	$wp_customize->add_setting(
		'cartvai_header_more_enabled',
		array(
			'default'           => true,
			'sanitize_callback' => 'rest_sanitize_boolean',
			'capability'        => $cap,
		)
	);

	$wp_customize->add_control(
		'cartvai_header_more_enabled',
		array(
			'label'       => esc_html__( 'Show "More" Menu Button', 'cartvai' ),
			'description' => esc_html__( 'Displays the "More" hamburger trigger opening the professional side menu drawer.', 'cartvai' ),
			'section'     => 'cartvai_theme_header',
			'type'        => 'checkbox',
		)
	);

	// Popular Categories Bar Toggle
	$wp_customize->add_setting(
		'cartvai_popular_categories_enabled',
		array(
			'default'           => true,
			'sanitize_callback' => 'wp_validate_boolean',
			'transport'         => 'refresh',
			'capability'        => $cap,
		)
	);

	$wp_customize->add_control(
		'cartvai_popular_categories_enabled',
		array(
			'label'       => esc_html__( 'Show Popular Categories', 'cartvai' ),
			'description' => esc_html__( 'Toggle quick category pills in the ecommerce header.', 'cartvai' ),
			'section'     => 'cartvai_theme_header',
			'type'        => 'checkbox',
		)
	);

	// ==========================================
	// 4. SECTION: Footer Settings
	// ==========================================
	$wp_customize->add_section(
		'cartvai_theme_footer',
		array(
			'title'       => esc_html__( 'Cartvai Footer Settings', 'cartvai' ),
			'description' => esc_html__( 'Select your footer layout, reassurance badges, store address, payment banners, and colors.', 'cartvai' ),
			'priority'    => 32,
			'capability'  => $cap,
		)
	);

	// Footer Style
	$wp_customize->add_setting(
		'cartvai_footer_style',
		array(
			'default'           => 'ecommerce',
			'sanitize_callback' => 'sanitize_key',
			'transport'         => 'refresh',
			'capability'        => $cap,
		)
	);

	$wp_customize->add_control(
		'cartvai_footer_style',
		array(
			'label'       => esc_html__( 'Footer Layout Style', 'cartvai' ),
			'description' => esc_html__( 'Choose from several ecommerce footer structures.', 'cartvai' ),
			'section'     => 'cartvai_theme_footer',
			'type'        => 'select',
			'choices'     => array(
				'ecommerce'     => esc_html__( 'Ecommerce Multi-Column (Reassurance + Newsletter + 4 Columns)', 'cartvai' ),
				'organic'       => esc_html__( 'Organic D2C / Emerald Store (5 Columns + Contact + Payment Strip)', 'cartvai' ),
				'warm_boutique' => esc_html__( 'Warm Boutique Luxury (Serif Elegance + Socials + Payment Pills)', 'cartvai' ),
				'default'       => esc_html__( 'Default Standard 3-Column', 'cartvai' ),
				'minimal'       => esc_html__( 'Minimalist Row', 'cartvai' ),
			),
		)
	);

	// Store Physical Address
	$wp_customize->add_setting(
		'cartvai_footer_store_address',
		array(
			'default'           => 'Dhaka, Bangladesh',
			'sanitize_callback' => 'sanitize_text_field',
			'capability'        => $cap,
		)
	);

	$wp_customize->add_control(
		'cartvai_footer_store_address',
		array(
			'label'       => esc_html__( 'Physical Store / Office Address', 'cartvai' ),
			'description' => esc_html__( 'Displayed in Organic and Boutique footers.', 'cartvai' ),
			'section'     => 'cartvai_theme_footer',
			'type'        => 'text',
		)
	);

	// Footer Trust Strip Toggle
	$wp_customize->add_setting(
		'cartvai_footer_trust_enabled',
		array(
			'default'           => true,
			'sanitize_callback' => 'rest_sanitize_boolean',
			'capability'        => $cap,
		)
	);

	$wp_customize->add_control(
		'cartvai_footer_trust_enabled',
		array(
			'label'       => esc_html__( 'Show Footer Trust Strip (Ecommerce footer)', 'cartvai' ),
			'section'     => 'cartvai_theme_footer',
			'type'        => 'checkbox',
		)
	);

	// Footer Copyright Text
	$wp_customize->add_setting(
		'cartvai_footer_copyright_text',
		array(
			'default'           => '© {year} {site_name}. All rights reserved.',
			'sanitize_callback' => 'sanitize_text_field',
			'capability'        => $cap,
		)
	);

	$wp_customize->add_control(
		'cartvai_footer_copyright_text',
		array(
			'label'       => esc_html__( 'Copyright Notice Text', 'cartvai' ),
			'description' => esc_html__( 'Use {year} for current year and {site_name} for site title.', 'cartvai' ),
			'section'     => 'cartvai_theme_footer',
			'type'        => 'text',
		)
	);

	// Footer Background Color
	$wp_customize->add_setting(
		'cartvai_footer_bg_color',
		array(
			'default'           => '',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability'        => $cap,
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'cartvai_footer_bg_color',
			array(
				'label'       => esc_html__( 'Custom Footer Background Color', 'cartvai' ),
				'description' => esc_html__( 'Leave empty to use each layout preset default color.', 'cartvai' ),
				'section'     => 'cartvai_theme_footer',
			)
		)
	);

	// Footer Heading Color
	$wp_customize->add_setting(
		'cartvai_footer_heading_color',
		array(
			'default'           => '',
			'sanitize_callback' => 'sanitize_hex_color',
			'capability'        => $cap,
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'cartvai_footer_heading_color',
			array(
				'label'   => esc_html__( 'Footer Heading Color', 'cartvai' ),
				'section' => 'cartvai_theme_footer',
			)
		)
	);

	// Sub-footer Row Background
	$wp_customize->add_setting(
		'cartvai_footer_sub_bg_color',
		array(
			'default'           => '',
			'sanitize_callback' => 'sanitize_text_field',
			'capability'        => $cap,
		)
	);

	$wp_customize->add_control(
		'cartvai_footer_sub_bg_color',
		array(
			'label'       => esc_html__( 'Sub-Footer / Copyright Row Background', 'cartvai' ),
			'description' => esc_html__( 'Hex color or transparent (e.g. #06241c, #f5ede6, transparent)', 'cartvai' ),
			'section'     => 'cartvai_theme_footer',
			'type'        => 'text',
		)
	);

	// Payment Gateway / Trust Badges Banner Image (e.g. SSLCommerz, ShurjoPay, Bkash, etc.)
	$wp_customize->add_setting(
		'cartvai_footer_payment_image',
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_url_raw',
			'capability'        => $cap,
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'cartvai_footer_payment_image',
			array(
				'label'       => esc_html__( 'Payment Gateway Banner Image', 'cartvai' ),
				'description' => esc_html__( 'Upload a payment gateway/partner banner (e.g. SSLCommerz logos). Replaces individual badges.', 'cartvai' ),
				'section'     => 'cartvai_theme_footer',
			)
		)
	);
	// Top Bar Colors & Spacing
	$wp_customize->add_setting(
		'cartvai_top_bar_bg_color',
		array(
			'default'           => '',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'refresh',
			'capability'        => $cap,
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'cartvai_top_bar_bg_color',
			array(
				'label'   => esc_html__( 'Top Bar Background Color', 'cartvai' ),
				'section' => 'cartvai_theme_header',
			)
		)
	);

	$wp_customize->add_setting(
		'cartvai_top_bar_text_color',
		array(
			'default'           => '',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'refresh',
			'capability'        => $cap,
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'cartvai_top_bar_text_color',
			array(
				'label'   => esc_html__( 'Top Bar Text & Link Color', 'cartvai' ),
				'section' => 'cartvai_theme_header',
			)
		)
	);

	$wp_customize->add_setting(
		'cartvai_top_bar_padding_y',
		array(
			'default'           => 8,
			'sanitize_callback' => 'absint',
			'transport'         => 'refresh',
			'capability'        => $cap,
		)
	);
	$wp_customize->add_control(
		'cartvai_top_bar_padding_y',
		array(
			'label'       => esc_html__( 'Top Bar Vertical Padding (px)', 'cartvai' ),
			'section'     => 'cartvai_theme_header',
			'type'        => 'number',
			'input_attrs' => array(
				'min'  => 0,
				'max'  => 40,
				'step' => 1,
			),
		)
	);

	// Main Header Colors & Spacing
	$wp_customize->add_setting(
		'cartvai_main_bar_bg_color',
		array(
			'default'           => '',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'refresh',
			'capability'        => $cap,
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'cartvai_main_bar_bg_color',
			array(
				'label'   => esc_html__( 'Main Header Background Color', 'cartvai' ),
				'section' => 'cartvai_theme_header',
			)
		)
	);

	$wp_customize->add_setting(
		'cartvai_main_bar_border_color',
		array(
			'default'           => '',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'refresh',
			'capability'        => $cap,
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'cartvai_main_bar_border_color',
			array(
				'label'   => esc_html__( 'Main Header Border Color', 'cartvai' ),
				'section' => 'cartvai_theme_header',
			)
		)
	);

	$wp_customize->add_setting(
		'cartvai_main_bar_padding_y',
		array(
			'default'           => 18,
			'sanitize_callback' => 'absint',
			'transport'         => 'refresh',
			'capability'        => $cap,
		)
	);
	$wp_customize->add_control(
		'cartvai_main_bar_padding_y',
		array(
			'label'       => esc_html__( 'Main Header Vertical Padding (px)', 'cartvai' ),
			'section'     => 'cartvai_theme_header',
			'type'        => 'number',
			'input_attrs' => array(
				'min'  => 4,
				'max'  => 60,
				'step' => 1,
			),
		)
	);

	// Navigation Bar Colors & Spacing
	$wp_customize->add_setting(
		'cartvai_nav_bar_bg_color',
		array(
			'default'           => '',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'refresh',
			'capability'        => $cap,
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'cartvai_nav_bar_bg_color',
			array(
				'label'   => esc_html__( 'Navigation Bar Background Color', 'cartvai' ),
				'section' => 'cartvai_theme_header',
			)
		)
	);

	$wp_customize->add_setting(
		'cartvai_nav_bar_border_color',
		array(
			'default'           => '',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'refresh',
			'capability'        => $cap,
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'cartvai_nav_bar_border_color',
			array(
				'label'   => esc_html__( 'Navigation Bar Border Color', 'cartvai' ),
				'section' => 'cartvai_theme_header',
			)
		)
	);

	$wp_customize->add_setting(
		'cartvai_nav_bar_padding_y',
		array(
			'default'           => 3,
			'sanitize_callback' => 'absint',
			'transport'         => 'refresh',
			'capability'        => $cap,
		)
	);
	$wp_customize->add_control(
		'cartvai_nav_bar_padding_y',
		array(
			'label'       => esc_html__( 'Navigation Bar Vertical Padding (px)', 'cartvai' ),
			'section'     => 'cartvai_theme_header',
			'type'        => 'number',
			'input_attrs' => array(
				'min'  => 0,
				'max'  => 40,
				'step' => 1,
			),
		)
	);

	$wp_customize->add_setting(
		'cartvai_nav_link_color',
		array(
			'default'           => '',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'refresh',
			'capability'        => $cap,
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'cartvai_nav_link_color',
			array(
				'label'   => esc_html__( 'Nav Link Color', 'cartvai' ),
				'section' => 'cartvai_theme_header',
			)
		)
	);

	$wp_customize->add_setting(
		'cartvai_nav_link_hover_color',
		array(
			'default'           => '',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'refresh',
			'capability'        => $cap,
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'cartvai_nav_link_hover_color',
			array(
				'label'   => esc_html__( 'Nav Link Hover Color', 'cartvai' ),
				'section' => 'cartvai_theme_header',
			)
		)
	);

	$wp_customize->add_setting(
		'cartvai_nav_link_gap',
		array(
			'default'           => 28,
			'sanitize_callback' => 'absint',
			'transport'         => 'refresh',
			'capability'        => $cap,
		)
	);
	$wp_customize->add_control(
		'cartvai_nav_link_gap',
		array(
			'label'       => esc_html__( 'Nav Link Spacing / Gap (px)', 'cartvai' ),
			'section'     => 'cartvai_theme_header',
			'type'        => 'number',
			'input_attrs' => array(
				'min'  => 8,
				'max'  => 60,
				'step' => 1,
			),
		)
	);

	$wp_customize->add_setting(
		'cartvai_nav_font_size',
		array(
			'default'           => 14,
			'sanitize_callback' => 'absint',
			'transport'         => 'refresh',
			'capability'        => $cap,
		)
	);
	$wp_customize->add_control(
		'cartvai_nav_font_size',
		array(
			'label'       => esc_html__( 'Nav Font Size (px)', 'cartvai' ),
			'section'     => 'cartvai_theme_header',
			'type'        => 'number',
			'input_attrs' => array(
				'min'  => 11,
				'max'  => 22,
				'step' => 1,
			),
		)
	);

	$wp_customize->add_setting(
		'cartvai_nav_font_weight',
		array(
			'default'           => '600',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'refresh',
			'capability'        => $cap,
		)
	);
	$wp_customize->add_control(
		'cartvai_nav_font_weight',
		array(
			'label'       => esc_html__( 'Nav Font Weight', 'cartvai' ),
			'section'     => 'cartvai_theme_header',
			'type'        => 'select',
			'choices'     => array(
				'400' => esc_html__( '400 - Normal', 'cartvai' ),
				'500' => esc_html__( '500 - Medium', 'cartvai' ),
				'600' => esc_html__( '600 - Semi-Bold', 'cartvai' ),
				'700' => esc_html__( '700 - Bold', 'cartvai' ),
			),
		)
	);

	// Site Identity selective refresh
	if ( isset( $wp_customize->selective_refresh ) ) {
		if ( $wp_customize->get_setting( 'blogname' ) ) {
			$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
		}
		if ( $wp_customize->get_setting( 'blogdescription' ) ) {
			$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
		}

		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.cv-site-title',
				'render_callback' => function() {
					bloginfo( 'name' );
				},
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.cv-site-description',
				'render_callback' => function() {
					bloginfo( 'description' );
				},
			)
		);
	}
}
add_action( 'customize_register', 'cartvai_theme_customize_register' );

/**
 * Automatically synchronize Customizer values into cartvai_theme_settings and CARTVAI_Settings
 * so that Customizer, Theme Settings page, and plugin stay in 100% lockstep.
 *
 * @param WP_Customize_Manager $wp_customize Manager instance.
 */
function cartvai_theme_sync_customizer_to_settings( $wp_customize ) {
	$options = get_option( 'cartvai_theme_settings', array() );
	if ( ! is_array( $options ) ) {
		$options = array();
	}

	$mapping = array(
		'header_style'                     => 'cartvai_header_style',
		'announcement_enabled'             => 'cartvai_announcement_enabled',
		'announcement_text'                => 'cartvai_announcement_text',
		'brand_tagline_enabled'            => 'cartvai_brand_tagline_enabled',
		'contact_phone'                    => 'cartvai_contact_phone',
		'contact_email'                    => 'cartvai_contact_email',
		'popular_categories_enabled'       => 'cartvai_popular_categories_enabled',
		'footer_style'                     => 'cartvai_footer_style',
		'footer_trust_enabled'             => 'cartvai_footer_trust_enabled',
		'footer_copyright_text'            => 'cartvai_footer_copyright_text',

		// Header & Navbar Styling
		'top_bar_bg_color'                 => 'cartvai_top_bar_bg_color',
		'top_bar_text_color'               => 'cartvai_top_bar_text_color',
		'top_bar_padding_y'                => 'cartvai_top_bar_padding_y',
		'main_bar_bg_color'                => 'cartvai_main_bar_bg_color',
		'main_bar_border_color'            => 'cartvai_main_bar_border_color',
		'main_bar_padding_y'               => 'cartvai_main_bar_padding_y',
		'nav_bar_bg_color'                 => 'cartvai_nav_bar_bg_color',
		'nav_bar_border_color'             => 'cartvai_nav_bar_border_color',
		'nav_bar_padding_y'                => 'cartvai_nav_bar_padding_y',
		'nav_link_color'                   => 'cartvai_nav_link_color',
		'nav_link_hover_color'             => 'cartvai_nav_link_hover_color',
		'nav_link_gap'                     => 'cartvai_nav_link_gap',
		'nav_font_size'                    => 'cartvai_nav_font_size',
		'nav_font_weight'                  => 'cartvai_nav_font_weight',

		// Colors
		'primary_color'                    => 'cartvai_primary_color',
		'primary_hover_color'              => 'cartvai_primary_hover_color',
		'primary_light_color'              => 'cartvai_primary_light_color',
		'accent_color'                     => 'cartvai_accent_color',
		'heading_color'                    => 'cartvai_heading_color',
		'text_color'                       => 'cartvai_text_color',
		'border_color'                     => 'cartvai_border_color',
		'bg_color'                         => 'cartvai_bg_color',

		// Card options
		'shop_page_hide_short_description' => 'cartvai_shop_page_hide_short_description',
		'shop_page_hide_quantity'          => 'cartvai_shop_page_hide_quantity',
		'shop_page_hide_buy_now'           => 'cartvai_shop_page_hide_buy_now',
		'shop_page_hide_add_to_cart'       => 'cartvai_shop_page_hide_add_to_cart',
		'shop_page_hide_off_badge'         => 'cartvai_shop_page_hide_off_badge',
		'shop_page_hide_save_badge'        => 'cartvai_shop_page_hide_save_badge',
	);

	foreach ( $mapping as $opt_key => $mod_key ) {
		$setting = $wp_customize->get_setting( $mod_key );
		if ( $setting ) {
			$val = $setting->value();
			if ( is_bool( $val ) ) {
				$options[ $opt_key ] = $val ? 1 : 0;
			} else {
				$options[ $opt_key ] = $val;
			}
		}
	}

	update_option( 'cartvai_theme_settings', $options );

	// Sync to CARTVAI_Settings
	if ( class_exists( 'CARTVAI_Settings' ) ) {
		if ( isset( $options['primary_color'] ) ) {
			CARTVAI_Settings::set( 'design_primary_color', $options['primary_color'] );
		}
		if ( isset( $options['primary_hover_color'] ) ) {
			CARTVAI_Settings::set( 'design_primary_deep_color', $options['primary_hover_color'] );
		}
		if ( isset( $options['primary_light_color'] ) ) {
			CARTVAI_Settings::set( 'design_primary_light_color', $options['primary_light_color'] );
		}
		if ( isset( $options['heading_color'] ) ) {
			CARTVAI_Settings::set( 'design_heading_color', $options['heading_color'] );
		}
		if ( isset( $options['text_color'] ) ) {
			CARTVAI_Settings::set( 'design_text_color', $options['text_color'] );
		}
		if ( isset( $options['border_color'] ) ) {
			CARTVAI_Settings::set( 'design_border_color', $options['border_color'] );
		}

		if ( isset( $options['shop_page_hide_short_description'] ) ) {
			CARTVAI_Settings::set( 'shop_page_hide_short_description', (bool) $options['shop_page_hide_short_description'] );
		}
		if ( isset( $options['shop_page_hide_quantity'] ) ) {
			CARTVAI_Settings::set( 'shop_page_hide_quantity', (bool) $options['shop_page_hide_quantity'] );
		}
		if ( isset( $options['shop_page_hide_buy_now'] ) ) {
			CARTVAI_Settings::set( 'shop_page_hide_buy_now', (bool) $options['shop_page_hide_buy_now'] );
		}
		if ( isset( $options['shop_page_hide_add_to_cart'] ) ) {
			CARTVAI_Settings::set( 'shop_page_hide_add_to_cart', (bool) $options['shop_page_hide_add_to_cart'] );
		}
		if ( isset( $options['shop_page_hide_off_badge'] ) ) {
			CARTVAI_Settings::set( 'shop_page_hide_off_badge', (bool) $options['shop_page_hide_off_badge'] );
		}
		if ( isset( $options['shop_page_hide_save_badge'] ) ) {
			CARTVAI_Settings::set( 'shop_page_hide_save_badge', (bool) $options['shop_page_hide_save_badge'] );
		}
	}
}
add_action( 'customize_save_after', 'cartvai_theme_sync_customizer_to_settings' );
