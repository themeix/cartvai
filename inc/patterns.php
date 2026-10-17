<?php
/**
 * Block Patterns Registration
 *
 * @package Cartvai_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register Cartvai theme block pattern categories and patterns.
 */
function cartvai_theme_register_block_patterns() {
	if ( ! function_exists( 'register_block_pattern_category' ) || ! function_exists( 'register_block_pattern' ) ) {
		return;
	}

	register_block_pattern_category(
		'cartvai',
		array(
			'label' => esc_html__( 'Cartvai', 'cartvai' ),
		)
	);

	$patterns_dir = get_template_directory() . '/patterns/';

	$pattern_files = array(
		'hero-megastore'      => array(
			'title'       => esc_html__( 'Cartvai - Modern Hero Banner & Promo Cards', 'cartvai' ),
			'description' => esc_html__( 'High-converting ecommerce hero banner with main callout and 2 secondary promo cards.', 'cartvai' ),
			'categories'  => array( 'cartvai', 'featured', 'header' ),
		),
		'features-strip'      => array(
			'title'       => esc_html__( 'Cartvai - Trust Badges & Value Proposition Strip', 'cartvai' ),
			'description' => esc_html__( '4-column value proposition banner with icons, headings, and descriptions.', 'cartvai' ),
			'categories'  => array( 'cartvai', 'services' ),
		),
		'categories-showcase' => array(
			'title'       => esc_html__( 'Cartvai - Featured Categories Showcase', 'cartvai' ),
			'description' => esc_html__( 'Clean shelf header with carousel of top ecommerce categories.', 'cartvai' ),
			'categories'  => array( 'cartvai' ),
		),
		'top-sellers'         => array(
			'title'       => esc_html__( 'Cartvai - Top Selling Products (2x2 Wide Cards)', 'cartvai' ),
			'description' => esc_html__( 'Section header and 2x2 wide featured card grid for top selling products.', 'cartvai' ),
			'categories'  => array( 'cartvai' ),
		),
		'promo-banners-duo'   => array(
			'title'       => esc_html__( 'Cartvai - Dual Promotional Callout Cards', 'cartvai' ),
			'description' => esc_html__( 'Two side-by-side promotional callout banners for seasonal campaigns and discounts.', 'cartvai' ),
			'categories'  => array( 'cartvai', 'promotions' ),
		),
		'testimonials'        => array(
			'title'       => esc_html__( 'Cartvai - Customer Reviews & Verified Testimonials', 'cartvai' ),
			'description' => esc_html__( '3-column customer review grid with 5-star ratings, quotes, reviewer avatars, and verified badges.', 'cartvai' ),
			'categories'  => array( 'cartvai', 'testimonials' ),
		),
		'homepage-full'       => array(
			'title'       => esc_html__( 'Cartvai - Complete Modern Ecommerce Homepage', 'cartvai' ),
			'description' => esc_html__( 'Complete turnkey ecommerce homepage combining modern hero banner, trust strip, category carousel, best sellers, promo callouts, product shelves, and customer reviews.', 'cartvai' ),
			'categories'  => array( 'cartvai', 'featured' ),
		),
		'food-landing-1'      => array(
			'title'       => esc_html__( 'Cartvai - Food Landing Page (Artisan Feast)', 'cartvai' ),
			'description' => esc_html__( 'Complete 10-section high-converting food delivery and combo feast landing page with 1-page checkout.', 'cartvai' ),
			'categories'  => array( 'cartvai', 'featured' ),
		),
		'cta-section'         => array(
			'title'       => esc_html__( 'Cartvai - High-Converting Call to Action Banner', 'cartvai' ),
			'description' => esc_html__( 'Conversion-focused CTA banner with badges, dual buttons, trust indicators, and dark luxury preset.', 'cartvai' ),
			'categories'  => array( 'cartvai', 'call-to-action' ),
		),
		'landing-page-turnkey' => array(
			'title'       => esc_html__( 'Cartvai - Complete 1-Click Turnkey Landing Page', 'cartvai' ),
			'description' => esc_html__( 'High-converting product sales landing page with countdown timer, hero CTA, trust strip, video showcase, 3-step order guide, bundle tiers, and FAQ accordion.', 'cartvai' ),
			'categories'  => array( 'cartvai', 'featured' ),
		),
	);

	foreach ( $pattern_files as $slug => $meta ) {
		$file_path = $patterns_dir . $slug . '.php';
		if ( file_exists( $file_path ) ) {
			ob_start();
			include $file_path;
			$content = ob_get_clean();

			// Strip PHP header docblock if present so only block comments remain
			$content = preg_replace( '/<\?php[\s\S]*?\?>/i', '', $content );
			$content = trim( $content );

			if ( ! empty( $content ) ) {
				register_block_pattern(
					'cartvai-theme/' . $slug,
					array(
						'title'       => $meta['title'],
						'description' => $meta['description'],
						'categories'  => $meta['categories'],
						'content'     => $content,
					)
				);
			}
		}
	}
}
add_action( 'init', 'cartvai_theme_register_block_patterns' );
