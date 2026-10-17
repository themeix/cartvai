<?php
/**
 * Title: Cartvai - High-Converting Call to Action Banner
 * Slug: cartvai-theme/cta-section
 * Categories: cartvai, call-to-action
 * Description: Full-featured conversion-focused CTA banner with badges, dual buttons, trust indicators, and dark luxury preset.
 *
 * @package Cartvai_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$shop_url = function_exists( 'cartvai_get_shop_page_url' ) ? cartvai_get_shop_page_url() : home_url( '/shop/' );
?>
<!-- wp:cartvai/cta {"layoutStyle":"centered","colorScheme":"brand-dark","containerWidth":"standard","showBadge":true,"badgeText":"LIMITED TIME PROMOTION","heading":"Supercharge Your Shopping with Exclusive Deals","description":"Discover handpicked premium essentials designed for performance and elegance. Enjoy instant discounts with fast express delivery on your first order.","primaryButtonText":"Shop Collection","primaryButtonUrl":"<?php echo esc_url( $shop_url ); ?>","showSecondaryButton":true,"secondaryButtonText":"Explore More","secondaryButtonUrl":"<?php echo esc_url( $shop_url ); ?>","microcopy":"✓ Free Express Delivery • ✓ 30-Day Money-Back Guarantee • ✓ 24/7 Dedicated Support"} /-->
