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

	<!-- wp:columns {"align":"wide"} -->
	<div class="wp-block-columns alignwide">
		<!-- wp:column {"width":"66.66%"} -->
		<div class="wp-block-column" style="flex-basis:66.66%">
			<!-- wp:group {"className":"cv-hero-main-banner","layout":{"type":"default"}} -->
			<div class="wp-block-group cv-hero-main-banner">
				<!-- wp:paragraph {"className":"cv-hero-badge"} -->
				<p class="cv-hero-badge">⚡ LIMITED TIME MEGA SALE • UP TO 50% OFF</p>
				<!-- /wp:paragraph -->

				<!-- wp:heading {"level":1,"className":"cv-hero-headline"} -->
				<h1 class="wp-block-heading cv-hero-headline">Next-Gen Tech &amp; Premium Lifestyle Gear</h1>
				<!-- /wp:heading -->

				<!-- wp:paragraph {"className":"cv-hero-subtitle"} -->
				<p class="cv-hero-subtitle">Upgrade your daily routine with top-rated smart devices, audio accessories, and modern essentials at unbeatable prices.</p>
				<!-- /wp:paragraph -->

				<!-- wp:buttons -->
				<div class="wp-block-buttons">
					<!-- wp:button {"className":"cv-hero-btn-primary"} -->
					<div class="wp-block-button cv-hero-btn-primary"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( $shop_url ); ?>">Shop Collection →</a></div>
					<!-- /wp:button -->

					<!-- wp:button {"className":"cv-hero-btn-secondary"} -->
					<div class="wp-block-button cv-hero-btn-secondary"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( $shop_url ); ?>">View Flash Deals</a></div>
					<!-- /wp:button -->
				</div>
				<!-- /wp:buttons -->

				<!-- wp:paragraph {"className":"cv-hero-perks"} -->
				<p class="cv-hero-perks">✓ Free Express Delivery • ✓ 30-Day Money-Back • ✓ Official Warranty</p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column {"width":"33.34%"} -->
		<div class="wp-block-column" style="flex-basis:33.34%">
			<!-- wp:group {"className":"cv-hero-promo-stack","layout":{"type":"default"}} -->
			<div class="wp-block-group cv-hero-promo-stack">
				<!-- wp:group {"className":"cv-hero-promo-card cv-hero-promo-card--blue","layout":{"type":"default"}} -->
				<div class="wp-block-group cv-hero-promo-card cv-hero-promo-card--blue">
					<!-- wp:paragraph {"className":"cv-promo-badge"} -->
					<p class="cv-promo-badge">🔥 TRENDING DEAL</p>
					<!-- /wp:paragraph -->

					<!-- wp:heading {"level":3} -->
					<h3 class="wp-block-heading">Wireless Spatial Audio</h3>
					<!-- /wp:heading -->

					<!-- wp:paragraph -->
					<p>Immersive acoustic clarity with 40-hour ultra battery life.</p>
					<!-- /wp:paragraph -->

					<!-- wp:buttons -->
					<div class="wp-block-buttons">
						<!-- wp:button {"className":"is-style-fill"} -->
						<div class="wp-block-button is-style-fill"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( $shop_url ); ?>">Shop Now →</a></div>
						<!-- /wp:button -->
					</div>
					<!-- /wp:buttons -->
				</div>
				<!-- /wp:group -->

				<!-- wp:group {"className":"cv-hero-promo-card cv-hero-promo-card--amber","layout":{"type":"default"}} -->
				<div class="wp-block-group cv-hero-promo-card cv-hero-promo-card--amber">
					<!-- wp:paragraph {"className":"cv-promo-badge"} -->
					<p class="cv-promo-badge">⚡ FLASH OFFER</p>
					<!-- /wp:paragraph -->

					<!-- wp:heading {"level":3} -->
					<h3 class="wp-block-heading">Smart Wearables &amp; Fit Tech</h3>
					<!-- /wp:heading -->

					<!-- wp:paragraph -->
					<p>Real-time health telemetry with crisp AMOLED display.</p>
					<!-- /wp:paragraph -->

					<!-- wp:buttons -->
					<div class="wp-block-buttons">
						<!-- wp:button {"className":"is-style-fill"} -->
						<div class="wp-block-button is-style-fill"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( $shop_url ); ?>">Explore Deals →</a></div>
						<!-- /wp:button -->
					</div>
					<!-- /wp:buttons -->
				</div>
				<!-- /wp:group -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->

	<!-- wp:columns {"align":"wide"} -->
	<div class="wp-block-columns alignwide">
		<!-- wp:column -->
		<div class="wp-block-column">
			<div class="cv-trust-card">
				<div class="cv-trust-icon">
					<svg class="cv:w-6 cv:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"></path></svg>
				</div>
				<div>
					<h4 class="wp-block-heading has-dark-color has-text-color" style="font-size:0.9375rem;font-weight:800;margin:0 0 0.15rem 0">Free Express Shipping</h4>
					<p style="font-size:0.8125rem;color:#64748b;margin:0">On all eligible orders over $50</p>
				</div>
			</div>
		</div>
		<!-- /wp:column -->

		<!-- wp:column -->
		<div class="wp-block-column">
			<div class="cv-trust-card">
				<div class="cv-trust-icon" style="background:#ecfdf5;color:#059669;">
					<svg class="cv:w-6 cv:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
				</div>
				<div>
					<h4 class="wp-block-heading has-dark-color has-text-color" style="font-size:0.9375rem;font-weight:800;margin:0 0 0.15rem 0">100% Secure Checkout</h4>
					<p style="font-size:0.8125rem;color:#64748b;margin:0">Encrypted 256-bit SSL protection</p>
				</div>
			</div>
		</div>
		<!-- /wp:column -->

		<!-- wp:column -->
		<div class="wp-block-column">
			<div class="cv-trust-card">
				<div class="cv-trust-icon" style="background:#fff7ed;color:#ea580c;">
					<svg class="cv:w-6 cv:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
				</div>
				<div>
					<h4 class="wp-block-heading has-dark-color has-text-color" style="font-size:0.9375rem;font-weight:800;margin:0 0 0.15rem 0">30-Day Easy Returns</h4>
					<p style="font-size:0.8125rem;color:#64748b;margin:0">Hassle-free money-back policy</p>
				</div>
			</div>
		</div>
		<!-- /wp:column -->

		<!-- wp:column -->
		<div class="wp-block-column">
			<div class="cv-trust-card">
				<div class="cv-trust-icon" style="background:#f5f3ff;color:#7c3aed;">
					<svg class="cv:w-6 cv:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
				</div>
				<div>
					<h4 class="wp-block-heading has-dark-color has-text-color" style="font-size:0.9375rem;font-weight:800;margin:0 0 0.15rem 0">24/7 Dedicated Support</h4>
					<p style="font-size:0.8125rem;color:#64748b;margin:0">Live agent assistance any time</p>
				</div>
			</div>
		</div>
		<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->

	<!-- wp:group {"align":"wide","className":"cv-home-section","layout":{"type":"constrained"}} -->
	<div class="wp-block-group alignwide cv-home-section">
		<div class="cv-shelf-header">
			<h3 class="wp-block-heading cv-shelf-title">Featured Categories</h3>
			<a href="<?php echo esc_url( $shop_url ); ?>" class="cv-shelf-link">
				<span>View All Categories</span>
				<svg class="cv:w-3.5 cv:h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
			</a>
		</div>

		<!-- wp:shortcode -->
		[cartvai_categories layout="carousel" columns="8" arrows="1"]
		<!-- /wp:shortcode -->
	</div>
	<!-- /wp:group -->

	<!-- wp:group {"align":"wide","className":"cv-home-section","layout":{"type":"constrained"}} -->
	<div class="wp-block-group alignwide cv-home-section">
		<div class="cv-shelf-header">
			<h3 class="wp-block-heading cv-shelf-title">Top Selling Products</h3>
			<a href="<?php echo esc_url( $shop_url ); ?>" class="cv-shelf-link">
				<span>View All Best Sellers</span>
				<svg class="cv:w-3.5 cv:h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
			</a>
		</div>

		<!-- wp:shortcode -->
		[cartvai_products layout="wide" limit="4" orderby="date"]
		<!-- /wp:shortcode -->
	</div>
	<!-- /wp:group -->

	<!-- wp:columns {"align":"wide"} -->
	<div class="wp-block-columns alignwide">
		<!-- wp:column -->
		<div class="wp-block-column">
			<div class="wp-block-group cv-promo-duo-card" style="border-radius:1.25rem;padding:2rem;background:linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%)">
				<p style="font-size:0.75rem;font-weight:800;color:#2563eb;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:0.5rem">LIMITED TIME OFFER</p>
				<h3 class="wp-block-heading has-dark-color has-text-color" style="font-size:1.5rem;font-weight:800;line-height:1.25;margin-bottom:0.5rem">Save Big on Smart Tech &amp; Audio</h3>
				<p style="font-size:0.875rem;color:#475569;margin-bottom:1.5rem">Get up to 40% discount on noise-cancelling headphones and lifestyle wearables.</p>
				<div class="wp-block-buttons">
					<div class="wp-block-button"><a class="wp-block-button__link has-text-color has-background wp-element-button" href="<?php echo esc_url( $shop_url ); ?>" style="border-radius:0.75rem;background-color:#2563eb;color:#ffffff;font-weight:700;padding:0.625rem 1.25rem">Shop Electronics →</a></div>
				</div>
			</div>
		</div>
		<!-- /wp:column -->

		<!-- wp:column -->
		<div class="wp-block-column">
			<div class="wp-block-group cv-promo-duo-card" style="border-radius:1.25rem;padding:2rem;background:linear-gradient(135deg, #fef2f2 0%, #fee2e2 100%)">
				<p style="font-size:0.75rem;font-weight:800;color:#dc2626;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:0.5rem">WEEKEND SPECIAL</p>
				<h3 class="wp-block-heading has-dark-color has-text-color" style="font-size:1.5rem;font-weight:800;line-height:1.25;margin-bottom:0.5rem">New Arrivals &amp; Best Picks</h3>
				<p style="font-size:0.875rem;color:#475569;margin-bottom:1.5rem">Curated premium essentials direct to your doorstep with guaranteed fast express dispatch.</p>
				<div class="wp-block-buttons">
					<div class="wp-block-button"><a class="wp-block-button__link has-text-color has-background wp-element-button" href="<?php echo esc_url( $shop_url ); ?>" style="border-radius:0.75rem;background-color:#0f172a;color:#ffffff;font-weight:700;padding:0.625rem 1.25rem">Explore Arrivals →</a></div>
				</div>
			</div>
		</div>
		<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->

	<!-- wp:group {"align":"wide","className":"cv-home-section","layout":{"type":"constrained"}} -->
	<div class="wp-block-group alignwide cv-home-section">
		<div class="cv-shelf-header">
			<h3 class="wp-block-heading cv-shelf-title">Trending Products</h3>
			<a href="<?php echo esc_url( $shop_url ); ?>" class="cv-shelf-link">
				<span>View All</span>
				<svg class="cv:w-3.5 cv:h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
			</a>
		</div>
		<!-- wp:shortcode -->
		[cartvai_products limit="5" columns="5" orderby="date"]
		<!-- /wp:shortcode -->
	</div>
	<!-- /wp:group -->

	<!-- wp:group {"align":"wide","className":"cv-home-section","layout":{"type":"constrained"}} -->
	<div class="wp-block-group alignwide cv-home-section">
		<div class="cv-shelf-header">
			<h3 class="wp-block-heading cv-shelf-title">Customer Reviews</h3>
			<span style="font-size:0.75rem;color:#64748b;font-weight:600">Verified Buyer Experiences</span>
		</div>

		<!-- wp:columns {"align":"wide"} -->
		<div class="wp-block-columns alignwide">
			<!-- wp:column -->
			<div class="wp-block-column">
				<div class="wp-block-group cv-testimonial-card" style="border-radius:1.25rem;padding:1.5rem">
					<div style="color:#f59e0b;font-size:0.875rem;margin-bottom:0.75rem">★★★★★</div>
					<p style="font-size:0.875rem;line-height:1.6;color:#334155;margin-bottom:1.25rem">&ldquo;The product quality blew away my expectations. Super clean packaging, lightning fast next-day delivery, and customer service answered my question in minutes!&rdquo;</p>
					<div style="display:flex;align-items:center;gap:0.75rem;padding-top:1rem;border-top:1px solid #f1f5f9">
						<div style="width:2.5rem;height:2.5rem;border-radius:9999px;background:#eff6ff;color:#1e40af;font-weight:700;display:flex;align-items:center;justify-content:center;font-size:0.875rem">AK</div>
						<div>
							<h5 class="wp-block-heading" style="font-size:0.8125rem;font-weight:700;margin:0">Alex Kingston</h5>
							<span style="font-size:0.6875rem;color:#059669;font-weight:600">✓ Verified Buyer</span>
						</div>
					</div>
				</div>
			</div>
			<!-- /wp:column -->

			<!-- wp:column -->
			<div class="wp-block-column">
				<div class="wp-block-group cv-testimonial-card" style="border-radius:1.25rem;padding:1.5rem">
					<div style="color:#f59e0b;font-size:0.875rem;margin-bottom:0.75rem">★★★★★</div>
					<p style="font-size:0.875rem;line-height:1.6;color:#334155;margin-bottom:1.25rem">&ldquo;Absolutely love shopping here. The cart checkout flow was seamless on mobile and the discounts were authentic. This is now my default online go-to store.&rdquo;</p>
					<div style="display:flex;align-items:center;gap:0.75rem;padding-top:1rem;border-top:1px solid #f1f5f9">
						<div style="width:2.5rem;height:2.5rem;border-radius:9999px;background:#ecfdf5;color:#065f46;font-weight:700;display:flex;align-items:center;justify-content:center;font-size:0.875rem">SR</div>
						<div>
							<h5 class="wp-block-heading" style="font-size:0.8125rem;font-weight:700;margin:0">Sophia Rodriguez</h5>
							<span style="font-size:0.6875rem;color:#059669;font-weight:600">✓ Verified Buyer</span>
						</div>
					</div>
				</div>
			</div>
			<!-- /wp:column -->

			<!-- wp:column -->
			<div class="wp-block-column">
				<div class="wp-block-group cv-testimonial-card" style="border-radius:1.25rem;padding:1.5rem">
					<div style="color:#f59e0b;font-size:0.875rem;margin-bottom:0.75rem">★★★★★</div>
					<p style="font-size:0.875rem;line-height:1.6;color:#334155;margin-bottom:1.25rem">&ldquo;High standard build quality and crystal clear sound. Hassle-free warranty registration and 100% genuine item as advertised. 10/10 recommendation!&rdquo;</p>
					<div style="display:flex;align-items:center;gap:0.75rem;padding-top:1rem;border-top:1px solid #f1f5f9">
						<div style="width:2.5rem;height:2.5rem;border-radius:9999px;background:#fef3c7;color:#92400e;font-weight:700;display:flex;align-items:center;justify-content:center;font-size:0.875rem">MT</div>
						<div>
							<h5 class="wp-block-heading" style="font-size:0.8125rem;font-weight:700;margin:0">Marcus Thorne</h5>
							<span style="font-size:0.6875rem;color:#059669;font-weight:600">✓ Verified Buyer</span>
						</div>
					</div>
				</div>
			</div>
			<!-- /wp:column -->
		</div>
		<!-- /wp:columns -->
	</div>
	<!-- /wp:group -->

</div>
<!-- /wp:group -->
