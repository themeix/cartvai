<?php
/**
 * Cartvai Theme Typography System
 *
 * Handles Google Fonts definitions, selection helpers, URL generation,
 * and CSS generation for Body and Headings/Titles.
 *
 * @package Cartvai_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Get comprehensive font definitions supported by Cartvai Theme.
 *
 * @return array
 */
function cartvai_get_font_definitions() {
	return array(
		'inter' => array(
			'name'        => 'Inter (Clean & Modern - Default)',
			'family'      => "'Inter', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif",
			'google_name' => 'Inter:wght@400;500;600;700;800',
			'category'    => 'sans-serif',
		),
		'plus-jakarta-sans' => array(
			'name'        => 'Plus Jakarta Sans (Trendy & High-End)',
			'family'      => "'Plus Jakarta Sans', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif",
			'google_name' => 'Plus+Jakarta+Sans:wght@400;500;600;700;800',
			'category'    => 'sans-serif',
		),
		'poppins' => array(
			'name'        => 'Poppins (Geometric & Friendly)',
			'family'      => "'Poppins', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif",
			'google_name' => 'Poppins:wght@400;500;600;700;800',
			'category'    => 'sans-serif',
		),
		'outfit' => array(
			'name'        => 'Outfit (Minimalist Luxury)',
			'family'      => "'Outfit', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif",
			'google_name' => 'Outfit:wght@400;500;600;700;800',
			'category'    => 'sans-serif',
		),
		'roboto' => array(
			'name'        => 'Roboto (Standard Sans)',
			'family'      => "'Roboto', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif",
			'google_name' => 'Roboto:wght@400;500;700;900',
			'category'    => 'sans-serif',
		),
		'montserrat' => array(
			'name'        => 'Montserrat (Bold & Elegant)',
			'family'      => "'Montserrat', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif",
			'google_name' => 'Montserrat:wght@400;500;600;700;800;900',
			'category'    => 'sans-serif',
		),
		'dm-sans' => array(
			'name'        => 'DM Sans (Low-contrast Grotesque)',
			'family'      => "'DM Sans', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif",
			'google_name' => 'DM+Sans:wght@400;500;700',
			'category'    => 'sans-serif',
		),
		'jost' => array(
			'name'        => 'Jost (Futura-style Sans)',
			'family'      => "'Jost', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif",
			'google_name' => 'Jost:wght@400;500;600;700;800',
			'category'    => 'sans-serif',
		),
		'space-grotesk' => array(
			'name'        => 'Space Grotesk (Tech & Streetwear)',
			'family'      => "'Space Grotesk', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif",
			'google_name' => 'Space+Grotesk:wght@500;600;700',
			'category'    => 'sans-serif',
		),
		'playfair-display' => array(
			'name'        => 'Playfair Display (Editorial / Luxury Serif)',
			'family'      => "'Playfair Display', Georgia, Cambria, 'Times New Roman', serif",
			'google_name' => 'Playfair+Display:wght@600;700;800',
			'category'    => 'serif',
		),
		'cinzel' => array(
			'name'        => 'Cinzel (Classical High-End Jewelry / Fashion)',
			'family'      => "'Cinzel', Georgia, 'Times New Roman', serif",
			'google_name' => 'Cinzel:wght@600;700;800',
			'category'    => 'serif',
		),
		'system' => array(
			'name'        => 'System Native UI (Fastest - Zero Bandwidth)',
			'family'      => "system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif",
			'google_name' => false,
			'category'    => 'system',
		),
	);
}

/**
 * Get simple key => label list for Customizer select controls.
 *
 * @return array
 */
function cartvai_get_font_choices() {
	$fonts   = cartvai_get_font_definitions();
	$choices = array();

	foreach ( $fonts as $slug => $data ) {
		$choices[ $slug ] = $data['name'];
	}

	return $choices;
}

/**
 * Get CSS font-family string by font slug.
 *
 * @param string $slug         Font slug.
 * @param string $default_slug Fallback slug if not found.
 * @return string CSS font-family string.
 */
function cartvai_get_font_family_css( $slug, $default_slug = 'inter' ) {
	$fonts = cartvai_get_font_definitions();

	if ( isset( $fonts[ $slug ] ) ) {
		return $fonts[ $slug ]['family'];
	}

	if ( isset( $fonts[ $default_slug ] ) ) {
		return $fonts[ $default_slug ]['family'];
	}

	return "'Inter', system-ui, -apple-system, sans-serif";
}

/**
 * Generate optimized Google Fonts URL for currently active body and heading fonts.
 *
 * @return string Google Fonts CSS URL or empty string if only system fonts used.
 */
function cartvai_get_active_fonts_google_url() {
	$body_slug    = cartvai_theme_option( 'body_font', 'inter' );
	$heading_slug = cartvai_theme_option( 'heading_font', 'inter' );
	$fonts        = cartvai_get_font_definitions();

	$google_families = array();

	if ( isset( $fonts[ $body_slug ] ) && ! empty( $fonts[ $body_slug ]['google_name'] ) ) {
		$google_families[] = $fonts[ $body_slug ]['google_name'];
	}

	if ( isset( $fonts[ $heading_slug ] ) && ! empty( $fonts[ $heading_slug ]['google_name'] ) ) {
		if ( ! in_array( $fonts[ $heading_slug ]['google_name'], $google_families, true ) ) {
			$google_families[] = $fonts[ $heading_slug ]['google_name'];
		}
	}

	if ( empty( $google_families ) ) {
		return '';
	}

	return 'https://fonts.googleapis.com/css2?family=' . implode( '&family=', $google_families ) . '&display=swap';
}

/**
 * Generate CSS variables and rules for typography.
 *
 * @return string Clean inline CSS.
 */
function cartvai_get_typography_css() {
	$body_slug     = cartvai_theme_option( 'body_font', 'inter' );
	$heading_slug  = cartvai_theme_option( 'heading_font', 'inter' );
	$weight        = cartvai_theme_option( 'heading_font_weight', '700' );

	$body_css      = cartvai_get_font_family_css( $body_slug, 'inter' );
	$heading_css   = cartvai_get_font_family_css( $heading_slug, 'inter' );

	return ":root {
		--cv-font-body: {$body_css};
		--cv-font-heading: {$heading_css};
		--cv-heading-weight: {$weight};
	}
	body,
	button, input, select, textarea {
		font-family: var(--cv-font-body) !important;
	}
	h1, h2, h3, h4, h5, h6,
	.wp-block-heading,
	.cartvai-heading {
		font-family: var(--cv-font-heading) !important;
		font-weight: var(--cv-heading-weight) !important;
	}";
}
