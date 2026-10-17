<?php
/**
 * Title: Cartvai - Complete 1-Click Turnkey Landing Page
 * Slug: cartvai-theme/landing-page-turnkey
 * Categories: cartvai, featured
 * Description: High-converting turnkey product sales landing page with countdown timer, hero CTA, trust strip, video showcase, 3-step order guide, bundle tiers, and FAQ accordion.
 *
 * @package Cartvai_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$shop_url = function_exists( 'cartvai_get_shop_page_url' ) ? cartvai_get_shop_page_url() : home_url( '/shop/' );
?>
<!-- wp:cartvai/countdown {"timerType":"evergreen","evergreenHours":3,"colorScheme":"amber","heading":"⚡ FLASH SALE! Extra 40% OFF Ends Soon","badgeText":"LIMITED QUANTITY DEAL","buttonText":"Claim Your Discount Below","buttonUrl":"#pricing-packages"} /-->

<!-- wp:cartvai/cta {"layoutStyle":"centered","colorScheme":"brand-dark","heading":"Upgrade Your Daily Life with Revolutionary Performance","description":"Engineered for excellence. Experience the perfect combination of durability, high speed, and luxury aesthetics trusted by over 50,000 customers.","primaryButtonText":"Order Today - Free Express Shipping","primaryButtonUrl":"#pricing-packages","showSecondaryButton":true,"secondaryButtonText":"Watch Demo Video","secondaryButtonUrl":"#video-showcase","microcopy":"✓ 100% Cash On Delivery • ✓ 30-Day Money-Back Guarantee • ✓ 24/7 WhatsApp Support"} /-->

<!-- wp:cartvai/trust-badges {"layout":"cards","colorScheme":"light"} /-->

<!-- wp:cartvai/video {"alignment":"center","colorScheme":"dark","heading":"Watch Real Demonstration","description":"See how easy it is to use and why thousands of users rate it 5 stars. Watch the complete unboxing and test.","videoUrl":"https://www.youtube.com/watch?v=dQw4w9WgXcQ","showCta":true,"ctaText":"Order Special Combo Pack","ctaUrl":"#pricing-packages"} /-->

<!-- wp:cartvai/how-it-works {"heading":"Order in 3 Simple Steps","subheading":"No credit card required. Pay only after receiving and inspecting the package."} /-->

<div id="pricing-packages">
<!-- wp:cartvai/pricing-tiers {"heading":"Choose Your Package & Save Big","subheading":"Order today to get instant nationwide delivery & risk-free guarantee."} /-->
</div>

<!-- wp:cartvai/faq {"heading":"Frequently Asked Questions","subheading":"Got questions? We have clear answers."} /-->

<!-- wp:cartvai/sticky-bar {"productTitle":"Special Flash Sale Package","price":"$79.00","regularPrice":"$158.00","badge":"In Stock • Ships Today","buttonText":"Order Now (COD)","buttonUrl":"#pricing-packages","visibility":"mobile-only"} /-->
