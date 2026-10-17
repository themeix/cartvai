<?php
/**
 * Cartvai Theme Gutenberg Blocks Registration
 *
 * @package Cartvai_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register Cartvai block category in Gutenberg if not already registered by plugin.
 *
 * @param array                   $categories Block categories.
 * @param WP_Block_Editor_Context $context    Block editor context.
 * @return array
 */
function cartvai_theme_register_block_categories( $categories, $context = null ) {
	foreach ( $categories as $category ) {
		if ( isset( $category['slug'] ) && 'cartvai' === $category['slug'] ) {
			return $categories;
		}
	}

	array_unshift(
		$categories,
		array(
			'slug'  => 'cartvai',
			'title' => esc_html__( 'Cartvai Blocks', 'cartvai' ),
			'icon'  => 'cart',
		)
	);

	return $categories;
}
add_filter( 'block_categories_all', 'cartvai_theme_register_block_categories', 10, 2 );

/**
 * Universal server-side render callback for Cartvai theme blocks.
 *
 * @param array    $attributes Block attributes.
 * @param string   $content    Block inner content.
 * @param WP_Block $block      Block instance.
 * @return string Rendered block HTML.
 */
function cartvai_render_theme_block( $attributes, $content = '', $block = null ) {
	if ( ! $block || empty( $block->name ) ) {
		return '';
	}

	$block_slug  = str_replace( 'cartvai/', '', $block->name );
	$render_file = get_template_directory() . '/blocks/' . sanitize_key( $block_slug ) . '/render.php';

	if ( file_exists( $render_file ) ) {
		ob_start();
		include $render_file;
		return ob_get_clean();
	}

	return '';
}

/**
 * Helper to calculate border and shadow inline styles and classes for Cartvai blocks.
 *
 * @param array $attributes Block attributes.
 * @param array $defaults   Optional defaults.
 * @return array Array with 'style', 'radius_class', 'show_border', 'border_color', 'box_shadow'.
 */
function cartvai_get_block_border_shadow( $attributes, $defaults = array() ) {
	$show_border         = isset( $attributes['showBorder'] ) ? (bool) $attributes['showBorder'] : ( isset( $defaults['showBorder'] ) ? (bool) $defaults['showBorder'] : true );
	$custom_border_color = ! empty( $attributes['customBorderColor'] ) ? sanitize_hex_color( $attributes['customBorderColor'] ) : ( isset( $defaults['customBorderColor'] ) ? $defaults['customBorderColor'] : '' );
	$border_width        = ! empty( $attributes['borderWidth'] ) ? sanitize_text_field( $attributes['borderWidth'] ) : ( isset( $defaults['borderWidth'] ) ? $defaults['borderWidth'] : '1px' );
	$border_radius       = ! empty( $attributes['borderRadius'] ) ? sanitize_text_field( $attributes['borderRadius'] ) : ( isset( $defaults['borderRadius'] ) ? $defaults['borderRadius'] : 'rounded-2xl' );
	$box_shadow          = ! empty( $attributes['boxShadow'] ) ? sanitize_text_field( $attributes['boxShadow'] ) : ( isset( $defaults['boxShadow'] ) ? $defaults['boxShadow'] : 'none' );

	$styles = array();

	// Border styling
	if ( ! $show_border ) {
		$styles[] = 'border: none !important;';
	} else {
		$styles[] = 'border-style: solid !important;';
		$styles[] = 'border-width: ' . esc_attr( $border_width ) . ' !important;';
		if ( ! empty( $custom_border_color ) ) {
			$styles[] = 'border-color: ' . esc_attr( $custom_border_color ) . ' !important;';
		} else {
			$styles[] = 'border-color: var(--cartvai-border, #e2e8f0) !important;';
		}
	}

	// Box shadow styling (Default is 'none')
	switch ( $box_shadow ) {
		case 'sm':
			$styles[] = 'box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05) !important;';
			break;
		case 'md':
			$styles[] = 'box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.07), 0 2px 4px -2px rgba(0, 0, 0, 0.05) !important;';
			break;
		case 'lg':
			$styles[] = 'box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.08), 0 4px 6px -4px rgba(0, 0, 0, 0.04) !important;';
			break;
		case 'xl':
			$styles[] = 'box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.08), 0 8px 10px -6px rgba(0, 0, 0, 0.04) !important;';
			break;
		case '2xl':
			$styles[] = 'box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15) !important;';
			break;
		case 'none':
		default:
			$styles[] = 'box-shadow: none !important;';
			break;
	}

	// Border radius class mapping
	$radius_class = 'cv:rounded-2xl';
	if ( 'rounded-none' === $border_radius ) {
		$radius_class = 'cv:rounded-none';
	} elseif ( 'rounded-lg' === $border_radius ) {
		$radius_class = 'cv:rounded-lg';
	} elseif ( 'rounded-xl' === $border_radius ) {
		$radius_class = 'cv:rounded-xl';
	} elseif ( 'rounded-2xl' === $border_radius ) {
		$radius_class = 'cv:rounded-2xl';
	} elseif ( 'rounded-3xl' === $border_radius ) {
		$radius_class = 'cv:rounded-3xl';
	}

	return array(
		'style'        => implode( ' ', $styles ),
		'radius_class' => $radius_class,
		'show_border'  => $show_border,
		'border_color' => ! empty( $custom_border_color ) ? $custom_border_color : 'var(--cartvai-border, #e2e8f0)',
		'box_shadow'   => $box_shadow,
	);
}

/**
 * Note: Gutenberg blocks (CTA, Video, Countdown, Trust Badges, Pricing Tiers, FAQ,
 * How it Works, Sticky Bar) are registered via the companion plugin (Cartvai Ecommerce)
 * in compliance with WordPress.org theme review guidelines (blocks are plugin territory).
 * Theme provides block templates, category taxonomy filters, and Tailwind styling.
 */
