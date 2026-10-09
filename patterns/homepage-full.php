<?php
/**
 * Title: Cartvai - Complete Modern Ecommerce Homepage
 * Slug: cartvai-theme/homepage-full
 * Categories: cartvai, featured
 * Description: Complete turnkey ecommerce homepage combining modern hero banner, trust strip, category carousel, best sellers, promo callouts, product shelves, and customer reviews.
 *
 * @package Cartvai_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$shop_url = function_exists( 'cartvai_get_shop_page_url' ) ? cartvai_get_shop_page_url() : home_url( '/shop/' );
?>
<!-- wp:group {"align":"full","className":"cv-homepage-wrap cv:w-full cv:max-w-7xl cv:mx-auto cv:px-4 cv:sm:px-6 cv:lg:px-8 cv:py-6 cv:space-y-10","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull cv-homepage-wrap cv:w-full cv:max-w-7xl cv:mx-auto cv:px-4 cv:sm:px-6 cv:lg:px-8 cv:py-6 cv:space-y-10">

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

	<!-- wp:group {"align":"wide","className":"cv-trust-features-row","layout":{"type":"constrained"}} -->
	<div class="wp-block-group alignwide cv-trust-features-row"><!-- wp:columns {"className":"cv-trust-features-grid"} -->
	<div class="wp-block-columns cv-trust-features-grid"><!-- wp:column {"className":"cv-trust-col"} -->
	<div class="wp-block-column cv-trust-col"><!-- wp:group {"className":"cv-trust-card cv-trust-card--shipping","layout":{"type":"flex","flexWrap":"nowrap"}} -->
	<div class="wp-block-group cv-trust-card cv-trust-card--shipping"><!-- wp:paragraph {"className":"cv-trust-icon cv-trust-icon--shipping"} -->
	<p class="cv-trust-icon cv-trust-icon--shipping">🚚</p>
	<!-- /wp:paragraph -->

	<!-- wp:group {"className":"cv-trust-text","layout":{"type":"default"}} -->
	<div class="wp-block-group cv-trust-text"><!-- wp:heading {"level":4,"className":"cv-trust-title"} -->
	<h4 class="wp-block-heading cv-trust-title">Free Express Shipping</h4>
	<!-- /wp:heading -->

	<!-- wp:paragraph {"className":"cv-trust-desc"} -->
	<p class="cv-trust-desc">On all eligible orders over $50</p>
	<!-- /wp:paragraph --></div>
	<!-- /wp:group --></div>
	<!-- /wp:group --></div>
	<!-- /wp:column -->

	<!-- wp:column {"className":"cv-trust-col"} -->
	<div class="wp-block-column cv-trust-col"><!-- wp:group {"className":"cv-trust-card cv-trust-card--shield","layout":{"type":"flex","flexWrap":"nowrap"}} -->
	<div class="wp-block-group cv-trust-card cv-trust-card--shield"><!-- wp:paragraph {"className":"cv-trust-icon cv-trust-icon--shield"} -->
	<p class="cv-trust-icon cv-trust-icon--shield">🛡️</p>
	<!-- /wp:paragraph -->

	<!-- wp:group {"className":"cv-trust-text","layout":{"type":"default"}} -->
	<div class="wp-block-group cv-trust-text"><!-- wp:heading {"level":4,"className":"cv-trust-title"} -->
	<h4 class="wp-block-heading cv-trust-title">100% Secure Checkout</h4>
	<!-- /wp:heading -->

	<!-- wp:paragraph {"className":"cv-trust-desc"} -->
	<p class="cv-trust-desc">Encrypted 256-bit SSL protection</p>
	<!-- /wp:paragraph --></div>
	<!-- /wp:group --></div>
	<!-- /wp:group --></div>
	<!-- /wp:column -->

	<!-- wp:column {"className":"cv-trust-col"} -->
	<div class="wp-block-column cv-trust-col"><!-- wp:group {"className":"cv-trust-card cv-trust-card--returns","layout":{"type":"flex","flexWrap":"nowrap"}} -->
	<div class="wp-block-group cv-trust-card cv-trust-card--returns"><!-- wp:paragraph {"className":"cv-trust-icon cv-trust-icon--returns"} -->
	<p class="cv-trust-icon cv-trust-icon--returns">🔄</p>
	<!-- /wp:paragraph -->

	<!-- wp:group {"className":"cv-trust-text","layout":{"type":"default"}} -->
	<div class="wp-block-group cv-trust-text"><!-- wp:heading {"level":4,"className":"cv-trust-title"} -->
	<h4 class="wp-block-heading cv-trust-title">30-Day Easy Returns</h4>
	<!-- /wp:heading -->

	<!-- wp:paragraph {"className":"cv-trust-desc"} -->
	<p class="cv-trust-desc">Hassle-free money-back policy</p>
	<!-- /wp:paragraph --></div>
	<!-- /wp:group --></div>
	<!-- /wp:group --></div>
	<!-- /wp:column -->

	<!-- wp:column {"className":"cv-trust-col"} -->
	<div class="wp-block-column cv-trust-col"><!-- wp:group {"className":"cv-trust-card cv-trust-card--support","layout":{"type":"flex","flexWrap":"nowrap"}} -->
	<div class="wp-block-group cv-trust-card cv-trust-card--support"><!-- wp:paragraph {"className":"cv-trust-icon cv-trust-icon--support"} -->
	<p class="cv-trust-icon cv-trust-icon--support">💬</p>
	<!-- /wp:paragraph -->

	<!-- wp:group {"className":"cv-trust-text","layout":{"type":"default"}} -->
	<div class="wp-block-group cv-trust-text"><!-- wp:heading {"level":4,"className":"cv-trust-title"} -->
	<h4 class="wp-block-heading cv-trust-title">24/7 Dedicated Support</h4>
	<!-- /wp:heading -->

	<!-- wp:paragraph {"className":"cv-trust-desc"} -->
	<p class="cv-trust-desc">Live agent assistance any time</p>
	<!-- /wp:paragraph --></div>
	<!-- /wp:group --></div>
	<!-- /wp:group --></div>
	<!-- /wp:column --></div>
	<!-- /wp:columns --></div>
	<!-- /wp:group -->

	<!-- wp:group {"align":"wide","className":"cv-shelf-section cv-shelf-categories","layout":{"type":"constrained"}} -->
	<div class="wp-block-group alignwide cv-shelf-section cv-shelf-categories"><!-- wp:group {"className":"cv-shelf-header","layout":{"type":"default"}} -->
	<div class="wp-block-group cv-shelf-header"><!-- wp:group {"className":"cv-shelf-title-wrap","layout":{"type":"default"}} -->
	<div class="wp-block-group cv-shelf-title-wrap"><!-- wp:paragraph {"className":"cv-shelf-badge"} -->
	<p class="cv-shelf-badge">CURATED COLLECTIONS</p>
	<!-- /wp:paragraph -->

	<!-- wp:heading {"level":2,"className":"cv-shelf-title"} -->
	<h2 class="wp-block-heading cv-shelf-title">Explore By Popular Categories</h2>
	<!-- /wp:heading -->

	<!-- wp:paragraph {"className":"cv-shelf-subtitle"} -->
	<p class="cv-shelf-subtitle">Discover trending electronics, everyday essentials, and tech accessories</p>
	<!-- /wp:paragraph --></div>
	<!-- /wp:group -->

	<!-- wp:paragraph {"className":"cv-shelf-link"} -->
	<p class="cv-shelf-link"><a href="<?php echo esc_url( $shop_url ); ?>">View All Categories →</a></p>
	<!-- /wp:paragraph --></div>
	<!-- /wp:group -->

	<!-- wp:shortcode -->
	[cartvai_categories columns="6"]
	<!-- /wp:shortcode --></div>
	<!-- /wp:group -->

	<!-- wp:group {"align":"wide","className":"cv-shelf-section cv-shelf-bestsellers","layout":{"type":"constrained"}} -->
	<div class="wp-block-group alignwide cv-shelf-section cv-shelf-bestsellers"><!-- wp:group {"className":"cv-shelf-header","layout":{"type":"default"}} -->
	<div class="wp-block-group cv-shelf-header"><!-- wp:group {"className":"cv-shelf-title-wrap","layout":{"type":"default"}} -->
	<div class="wp-block-group cv-shelf-title-wrap"><!-- wp:paragraph {"className":"cv-shelf-badge"} -->
	<p class="cv-shelf-badge">CUSTOMER FAVORITES</p>
	<!-- /wp:paragraph -->

	<!-- wp:heading {"level":2,"className":"cv-shelf-title"} -->
	<h2 class="wp-block-heading cv-shelf-title">Top Trending &amp; Best Sellers</h2>
	<!-- /wp:heading -->

	<!-- wp:paragraph {"className":"cv-shelf-subtitle"} -->
	<p class="cv-shelf-subtitle">Handpicked products loved by thousands of our happy customers</p>
	<!-- /wp:paragraph --></div>
	<!-- /wp:group -->

	<!-- wp:paragraph {"className":"cv-shelf-link"} -->
	<p class="cv-shelf-link"><a href="<?php echo esc_url( $shop_url ); ?>">View All Best Sellers →</a></p>
	<!-- /wp:paragraph --></div>
	<!-- /wp:group -->

	<!-- wp:shortcode -->
	[cartvai_products limit="8" columns="4"]
	<!-- /wp:shortcode --></div>
	<!-- /wp:group -->

	<!-- wp:group {"align":"wide","className":"cv-shelf-section cv-shelf-deals","layout":{"type":"constrained"}} -->
	<div class="wp-block-group alignwide cv-shelf-section cv-shelf-deals"><!-- wp:group {"className":"cv-shelf-header","layout":{"type":"default"}} -->
	<div class="wp-block-group cv-shelf-header"><!-- wp:group {"className":"cv-shelf-title-wrap","layout":{"type":"default"}} -->
	<div class="wp-block-group cv-shelf-title-wrap"><!-- wp:paragraph {"className":"cv-shelf-badge"} -->
	<p class="cv-shelf-badge">WEEKLY HIGHLIGHTS</p>
	<!-- /wp:paragraph -->

	<!-- wp:heading {"level":2,"className":"cv-shelf-title"} -->
	<h2 class="wp-block-heading cv-shelf-title">Weekly Special Offers</h2>
	<!-- /wp:heading -->

	<!-- wp:paragraph {"className":"cv-shelf-subtitle"} -->
	<p class="cv-shelf-subtitle">Limited quantity discounts updated every Monday morning</p>
	<!-- /wp:paragraph --></div>
	<!-- /wp:group -->

	<!-- wp:paragraph {"className":"cv-shelf-link"} -->
	<p class="cv-shelf-link"><a href="<?php echo esc_url( $shop_url ); ?>">Explore All Products →</a></p>
	<!-- /wp:paragraph --></div>
	<!-- /wp:group -->

	<!-- wp:shortcode -->
	[cartvai_products limit="4" columns="4"]
	<!-- /wp:shortcode --></div>
	<!-- /wp:group -->

	<!-- wp:group {"align":"wide","className":"cv-shelf-section cv-shelf-testimonials","layout":{"type":"constrained"}} -->
	<div class="wp-block-group alignwide cv-shelf-section cv-shelf-testimonials"><!-- wp:group {"className":"cv-shelf-header","layout":{"type":"default"}} -->
	<div class="wp-block-group cv-shelf-header"><!-- wp:group {"className":"cv-shelf-title-wrap","layout":{"type":"default"}} -->
	<div class="wp-block-group cv-shelf-title-wrap"><!-- wp:paragraph {"className":"cv-shelf-badge"} -->
	<p class="cv-shelf-badge">SOCIAL PROOF</p>
	<!-- /wp:paragraph -->

	<!-- wp:heading {"level":2,"className":"cv-shelf-title"} -->
	<h2 class="wp-block-heading cv-shelf-title">Loved By Thousands of Shoppers</h2>
	<!-- /wp:heading -->

	<!-- wp:paragraph {"className":"cv-shelf-subtitle"} -->
	<p class="cv-shelf-subtitle">Read real feedback from our verified global community</p>
	<!-- /wp:paragraph --></div>
	<!-- /wp:group -->

	<!-- wp:paragraph {"className":"cv-shelf-rating-pill"} -->
	<p class="cv-shelf-rating-pill">★★★★★ 4.9 / 5.0 Customer Rating</p>
	<!-- /wp:paragraph --></div>
	<!-- /wp:group -->

	<!-- wp:columns {"className":"cv-testimonial-grid"} -->
	<div class="wp-block-columns cv-testimonial-grid"><!-- wp:column {"className":"cv-testimonial-col"} -->
	<div class="wp-block-column cv-testimonial-col"><!-- wp:group {"className":"cv-testimonial-card","layout":{"type":"default"}} -->
	<div class="wp-block-group cv-testimonial-card"><!-- wp:paragraph {"className":"cv-test-stars"} -->
	<p class="cv-test-stars">★★★★★</p>
	<!-- /wp:paragraph -->

	<!-- wp:paragraph {"className":"cv-test-quote"} -->
	<p class="cv-test-quote">“Fastest delivery I have ever experienced. The packaging was immaculate and product quality exceeded all expectations.”</p>
	<!-- /wp:paragraph -->

	<!-- wp:heading {"level":4,"className":"cv-test-author-name"} -->
	<h4 class="wp-block-heading cv-test-author-name">Sarah Jenkins</h4>
	<!-- /wp:heading -->

	<!-- wp:paragraph {"className":"cv-test-author-meta"} -->
	<p class="cv-test-author-meta">Verified Buyer · California, US</p>
	<!-- /wp:paragraph --></div>
	<!-- /wp:group --></div>
	<!-- /wp:column -->

	<!-- wp:column {"className":"cv-testimonial-col"} -->
	<div class="wp-block-column cv-testimonial-col"><!-- wp:group {"className":"cv-testimonial-card","layout":{"type":"default"}} -->
	<div class="wp-block-group cv-testimonial-card"><!-- wp:paragraph {"className":"cv-test-stars"} -->
	<p class="cv-test-stars">★★★★★</p>
	<!-- /wp:paragraph -->

	<!-- wp:paragraph {"className":"cv-test-quote"} -->
	<p class="cv-test-quote">“Customer support answered my questions in seconds and guided me through checkout. Outstanding shopping experience!”</p>
	<!-- /wp:paragraph -->

	<!-- wp:heading {"level":4,"className":"cv-test-author-name"} -->
	<h4 class="wp-block-heading cv-test-author-name">Marcus Vance</h4>
	<!-- /wp:heading -->

	<!-- wp:paragraph {"className":"cv-test-author-meta"} -->
	<p class="cv-test-author-meta">Tech Enthusiast · London, UK</p>
	<!-- /wp:paragraph --></div>
	<!-- /wp:group --></div>
	<!-- /wp:column -->

	<!-- wp:column {"className":"cv-testimonial-col"} -->
	<div class="wp-block-column cv-testimonial-col"><!-- wp:group {"className":"cv-testimonial-card","layout":{"type":"default"}} -->
	<div class="wp-block-group cv-testimonial-card"><!-- wp:paragraph {"className":"cv-test-stars"} -->
	<p class="cv-test-stars">★★★★★</p>
	<!-- /wp:paragraph -->

	<!-- wp:paragraph {"className":"cv-test-quote"} -->
	<p class="cv-test-quote">“Unbeatable prices on high-end electronics. The 30-day warranty gave me complete peace of mind. Highly recommend!”</p>
	<!-- /wp:paragraph -->

	<!-- wp:heading {"level":4,"className":"cv-test-author-name"} -->
	<h4 class="wp-block-heading cv-test-author-name">Elena Rostova</h4>
	<!-- /wp:heading -->

	<!-- wp:paragraph {"className":"cv-test-author-meta"} -->
	<p class="cv-test-author-meta">Verified Buyer · Toronto, CA</p>
	<!-- /wp:paragraph --></div>
	<!-- /wp:group --></div>
	<!-- /wp:column --></div>
	<!-- /wp:columns --></div>
	<!-- /wp:group -->

</div>
<!-- /wp:group -->
