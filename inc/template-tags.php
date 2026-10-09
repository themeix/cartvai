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
