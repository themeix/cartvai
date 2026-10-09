<?php
/**
 * Title: Cartvai - Modern Hero Banner
 * Slug: cartvai-theme/hero-megastore
 * Categories: cartvai, featured, header
 * Description: High-converting ecommerce hero banner with featured callout and product showcase.
 *
 * @package Cartvai_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$shop_url = function_exists( 'cartvai_get_shop_page_url' ) ? cartvai_get_shop_page_url() : home_url( '/shop/' );
?>
<!-- wp:group {"align":"wide","className":"cv-hero-main-banner cv-hero-banner-single","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide cv-hero-main-banner cv-hero-banner-single"><!-- wp:columns {"verticalAlignment":"center","className":"cv-hero-columns"} -->
<div class="wp-block-columns are-vertically-aligned-center cv-hero-columns"><!-- wp:column {"verticalAlignment":"center","width":"58%","className":"cv-hero-content-col"} -->
<div class="wp-block-column is-vertically-aligned-center cv-hero-content-col" style="flex-basis:58%"><!-- wp:paragraph {"className":"cv-hero-badge"} -->
<p class="cv-hero-badge"><span class="cv-hero-badge-pulse"></span>⚡ LIMITED TIME MEGA SALE • UP TO 50% OFF</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":1,"className":"cv-hero-headline"} -->
<h1 class="wp-block-heading cv-hero-headline">Next-Gen Tech &amp; Premium Lifestyle Gear</h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"cv-hero-subtitle"} -->
<p class="cv-hero-subtitle">Upgrade your daily routine with top-rated smart devices, audio accessories, and modern essentials at unbeatable prices.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"className":"cv-hero-buttons"} -->
<div class="wp-block-buttons cv-hero-buttons"><!-- wp:button {"className":"cv-hero-btn-primary"} -->
<div class="wp-block-button cv-hero-btn-primary"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( $shop_url ); ?>">Shop Collection →</a></div>
<!-- /wp:button -->

<!-- wp:button {"className":"cv-hero-btn-secondary"} -->
<div class="wp-block-button cv-hero-btn-secondary"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( $shop_url ); ?>">View Flash Deals</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons -->

<!-- wp:paragraph {"className":"cv-hero-perks"} -->
<p class="cv-hero-perks">✓ Free Express Delivery • ✓ 30-Day Money-Back • ✓ Official Warranty</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"42%","className":"cv-hero-visual-col"} -->
<div class="wp-block-column is-vertically-aligned-center cv-hero-visual-col" style="flex-basis:42%"><!-- wp:group {"className":"cv-hero-showcase-box","layout":{"type":"default"}} -->
<div class="wp-block-group cv-hero-showcase-box"><!-- wp:paragraph {"className":"cv-hero-floating-badge"} -->
<p class="cv-hero-floating-badge">⚡ TOP RATED</p>
<!-- /wp:paragraph -->

<!-- wp:image {"className":"cv-hero-showcase-img-wrap"} -->
<figure class="wp-block-image cv-hero-showcase-img-wrap"><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/hero-headphones.svg' ); ?>" alt="Spatial Audio Pro"/></figure>
<!-- /wp:image -->

<!-- wp:paragraph {"className":"cv-hero-floating-rating"} -->
<p class="cv-hero-floating-rating"><span style="color:#f59e0b">★★★★★</span> 4.9 / 5.0 Rating</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->
