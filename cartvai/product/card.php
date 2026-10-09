<?php
/**
 * Cartvai Theme Override: Product Card
 *
 * Renders the canonical Cartvai product card design matching the official Shop page.
 * Ensures complete design and functionality consistency across Shop, Categories,
 * Tags, Related Products carousels, and Search results.
 *
 * Available variables:
 * - $product (object|int) Decorated Cartvai product object or post ID
 * - $args    (array)      Display configuration from cartvai_render_product_card()
 *
 * @package Cartvai_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( empty( $product ) ) {
	return;
}

if ( class_exists( 'CARTVAI_Shop_Page' ) ) {
	echo CARTVAI_Shop_Page::render_product_card( $product, isset( $args ) ? $args : true ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
} elseif ( function_exists( 'cartvai_get_template' ) ) {
	cartvai_get_template(
		'frontend/product/card',
		array(
			'product' => $product,
			'args'    => isset( $args ) ? $args : array(),
		),
		false
	);
}
