<?php
/**
 * Cartvai Theme Template Tags and Helpers
 *
 * @package Cartvai_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Retrieve a theme setting value with fallback.
 *
 * Checks get_theme_mod first, then get_option('cartvai_theme_settings').
 *
 * @param string $key
 * @param mixed  $default
 * @return mixed
 */
function cartvai_theme_option( $key, $default = '' ) {
	$not_set = '__CV_NOT_SET__';

	// 1. In Customizer preview, ALWAYS prioritize the live preview value (including boolean false)
	if ( is_customize_preview() ) {
		$mod = get_theme_mod( 'cartvai_' . $key, $not_set );
		if ( $not_set !== $mod ) {
			return $mod;
		}
	}

	// 2. Check Theme Mod (if explicitly set, even if boolean false)
	$mods = get_theme_mods();
	if ( is_array( $mods ) && array_key_exists( 'cartvai_' . $key, $mods ) ) {
		return $mods[ 'cartvai_' . $key ];
	}

	// 3. Check theme settings option array
	$options = get_option( 'cartvai_theme_settings', array() );
	if ( is_array( $options ) && array_key_exists( $key, $options ) ) {
		return $options[ $key ];
	}

	// 4. Check CARTVAI_Settings (plugin settings integration)
	if ( class_exists( 'CARTVAI_Settings' ) ) {
		$plugin_val = CARTVAI_Settings::get( $key, $not_set );
		if ( $not_set !== $plugin_val ) {
			return $plugin_val;
		}

		// Also check design_ prefix (e.g. primary_color -> design_primary_color)
		$design_map = array(
			'primary_color'       => 'design_primary_color',
			'primary_hover_color' => 'design_primary_deep_color',
			'primary_light_color' => 'design_primary_light_color',
			'border_color'        => 'design_border_color',
			'heading_color'       => 'design_heading_color',
			'text_color'          => 'design_text_color',
		);
		if ( isset( $design_map[ $key ] ) ) {
			$mapped_val = CARTVAI_Settings::get( $design_map[ $key ], $not_set );
			if ( $not_set !== $mapped_val ) {
				return $mapped_val;
			}
		}
	}

	return $default;
}

/**
 * Get active header style.
 *
 * Options: 'megastore', 'megabar', 'ecommerce', 'default', 'centered', 'minimal'
 *
 * @return string
 */
function cartvai_get_header_style() {
	$style   = cartvai_theme_option( 'header_style', 'megastore' );
	$allowed = array( 'megastore', 'megabar', 'ecommerce', 'default', 'centered', 'minimal' );

	return in_array( $style, $allowed, true ) ? $style : 'megastore';
}

/**
 * Get active footer style.
 *
 * Options: 'ecommerce', 'organic', 'warm_boutique', 'default', 'minimal'
 *
 * @return string
 */
function cartvai_get_footer_style() {
	$style   = cartvai_theme_option( 'footer_style', 'ecommerce' );
	$allowed = array( 'ecommerce', 'organic', 'warm_boutique', 'default', 'minimal' );

	return in_array( $style, $allowed, true ) ? $style : 'ecommerce';
}

/**
 * Get preset default colors for a header style.
 *
 * @param string|null $header_style Optional header style slug.
 * @return array
 */
function cartvai_get_header_preset_defaults( $header_style = null ) {
	if ( empty( $header_style ) ) {
		$header_style = cartvai_get_header_style();
	}

	switch ( $header_style ) {
		case 'megastore':
			return array(
				'top_bar_bg'      => '#07241b',
				'top_bar_text'    => '#d1fae5',
				'main_bar_bg'     => '#0d3b2e',
				'main_bar_border' => 'rgba(255, 255, 255, 0.08)',
				'nav_bar_bg'      => '#0a2f24',
				'nav_bar_border'  => 'rgba(255, 255, 255, 0.1)',
				'nav_link_color'  => '#ffffff',
				'nav_link_hover'  => '#fde68a',
			);
		case 'megabar':
			return array(
				'top_bar_bg'      => '#030712',
				'top_bar_text'    => '#d1d5db',
				'main_bar_bg'     => '#ffffff',
				'main_bar_border' => '#e5e7eb',
				'nav_bar_bg'      => '#0d3b2e',
				'nav_bar_border'  => 'rgba(255, 255, 255, 0.1)',
				'nav_link_color'  => '#ffffff',
				'nav_link_hover'  => '#fde68a',
			);
		case 'ecommerce':
		default:
			return array(
				'top_bar_bg'      => '#030712',
				'top_bar_text'    => '#d1d5db',
				'main_bar_bg'     => '#ffffff',
				'main_bar_border' => '#e5e7eb',
				'nav_bar_bg'      => '#ffffff',
				'nav_bar_border'  => '#e5e7eb',
				'nav_link_color'  => '#1e293b',
				'nav_link_hover'  => '#2563eb',
			);
	}
}

/**
 * Determine if a given hex color is dark.
 *
 * @param string $hex Hex color string.
 * @return bool True if dark, false if light.
 */
function cartvai_is_dark_hex( $hex ) {
	$hex = ltrim( trim( (string) $hex ), '#' );
	if ( strlen( $hex ) === 3 ) {
		$hex = $hex[0] . $hex[0] . $hex[1] . $hex[1] . $hex[2] . $hex[2];
	}
	if ( strlen( $hex ) !== 6 ) {
		return true;
	}
	$r = hexdec( substr( $hex, 0, 2 ) );
	$g = hexdec( substr( $hex, 2, 2 ) );
	$b = hexdec( substr( $hex, 4, 2 ) );
	$luminance = ( 0.299 * $r + 0.587 * $g + 0.114 * $b ) / 255;
	return $luminance < 0.6;
}

