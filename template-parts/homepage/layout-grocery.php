<?php
/**
 * Modern Ecommerce Homepage Layout (Default Fallback Template)
 *
 * Provides a high-converting, professional ecommerce homepage layout.
 * Controlled directly by Cartvai Theme Settings (Homepage Tab) or overridden
 * anytime by editing the page using native WordPress Gutenberg Block Patterns.
 *
 * @package Cartvai_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$shop_url     = function_exists( 'cartvai_get_shop_page_url' ) ? cartvai_get_shop_page_url() : home_url( '/shop/' );
$checkout_url = function_exists( 'cartvai_get_checkout_url' ) ? cartvai_get_checkout_url() : home_url( '/checkout/' );

// Hero Options
$hero_badge      = cartvai_theme_option( 'homepage_hero_badge', esc_html__( '⚡ LIMITED TIME MEGA SALE • UP TO 50% OFF', 'cartvai' ) );
$hero_title      = cartvai_theme_option( 'homepage_hero_title', esc_html__( 'Next-Gen Tech & Premium Lifestyle Gear', 'cartvai' ) );
$hero_subtitle   = cartvai_theme_option( 'homepage_hero_subtitle', esc_html__( 'Upgrade your daily routine with top-rated smart devices, audio accessories, and modern essentials at unbeatable prices.', 'cartvai' ) );
$hero_btn1_text  = cartvai_theme_option( 'homepage_hero_btn1_text', esc_html__( 'Shop Collection', 'cartvai' ) );
$hero_btn1_url   = cartvai_theme_option( 'homepage_hero_btn1_url', '' );
$hero_btn2_text  = cartvai_theme_option( 'homepage_hero_btn2_text', esc_html__( 'View Flash Deals', 'cartvai' ) );
$hero_btn2_url   = cartvai_theme_option( 'homepage_hero_btn2_url', '' );
$hero_perks      = cartvai_theme_option( 'homepage_hero_perks', esc_html__( '✓ Free Express Delivery • ✓ 30-Day Money-Back • ✓ Official Warranty', 'cartvai' ) );
$hero_image      = cartvai_theme_option( 'homepage_hero_image', '' );

$btn1_href = ! empty( $hero_btn1_url ) ? $hero_btn1_url : $shop_url;
$btn2_href = ! empty( $hero_btn2_url ) ? $hero_btn2_url : $shop_url;

// Promo Card 1 Options
$promo1_badge = cartvai_theme_option( 'homepage_promo1_badge', esc_html__( '🔥 TRENDING DEAL', 'cartvai' ) );
$promo1_title = cartvai_theme_option( 'homepage_promo1_title', esc_html__( 'Wireless Spatial Audio', 'cartvai' ) );
$promo1_desc  = cartvai_theme_option( 'homepage_promo1_desc', esc_html__( 'Immersive acoustic clarity with 40-hour ultra battery life.', 'cartvai' ) );
$promo1_price = cartvai_theme_option( 'homepage_promo1_price', esc_html__( 'Starting at $29.99', 'cartvai' ) );
$promo1_btn   = cartvai_theme_option( 'homepage_promo1_btn_text', esc_html__( 'Shop Now', 'cartvai' ) );
$promo1_url   = cartvai_theme_option( 'homepage_promo1_url', '' );
$promo1_href  = ! empty( $promo1_url ) ? $promo1_url : $shop_url;

// Promo Card 2 Options
$promo2_badge = cartvai_theme_option( 'homepage_promo2_badge', esc_html__( '⚡ FLASH OFFER', 'cartvai' ) );
$promo2_title = cartvai_theme_option( 'homepage_promo2_title', esc_html__( 'Smart Wearables & Fit Tech', 'cartvai' ) );
$promo2_desc  = cartvai_theme_option( 'homepage_promo2_desc', esc_html__( 'Real-time health telemetry with crisp AMOLED display.', 'cartvai' ) );
$promo2_price = cartvai_theme_option( 'homepage_promo2_price', esc_html__( 'Save Up To 40% OFF', 'cartvai' ) );
$promo2_btn   = cartvai_theme_option( 'homepage_promo2_btn_text', esc_html__( 'Explore Deals', 'cartvai' ) );
$promo2_url   = cartvai_theme_option( 'homepage_promo2_url', '' );
$promo2_href  = ! empty( $promo2_url ) ? $promo2_url : $shop_url;

$trust_enabled = (bool) cartvai_theme_option( 'homepage_trust_enabled', true );
?>

<div class="cv-homepage-wrap cv:max-w-7xl cv:mx-auto cv:px-4 cv:sm:px-6 cv:lg:px-8 cv:py-6 cv:space-y-10">

	<!-- ==================== 1. TOP SINGLE HERO BANNER ==================== -->
	<section class="cv-home-section cv:mb-8">
		<div class="cv-hero-main-banner cv-hero-banner-single cv:relative cv:rounded-3xl cv:p-6 cv:sm:p-8 cv:md:p-12 cv:border cv:border-white/10 cv:shadow-lg cv:overflow-hidden">
			<div class="cv-hero-main-banner-inner cv:flex cv:flex-col cv:lg:flex-row cv:items-center cv:justify-between cv:gap-8 cv:w-full cv:relative cv:z-10">
				
				<!-- Left Content Column -->
				<div class="cv-hero-content-col cv:flex-1 cv:max-w-2xl">
					<?php if ( ! empty( $hero_badge ) ) : ?>
						<span class="cv-hero-badge">
							<span class="cv-hero-badge-pulse"></span>
							<?php echo esc_html( $hero_badge ); ?>
						</span>
					<?php endif; ?>

					<h1 class="cv-hero-headline cv:text-3xl cv:sm:text-4xl cv:md:text-5xl cv:font-black cv:text-white cv:tracking-tight cv:leading-tight cv:mb-4">
						<?php echo esc_html( $hero_title ); ?>
					</h1>

					<p class="cv-hero-subtitle cv:text-base cv:sm:text-lg cv:text-emerald-100/90 cv:mb-8 cv:leading-relaxed">
						<?php echo esc_html( $hero_subtitle ); ?>
					</p>

					<div class="cv:flex cv:flex-wrap cv:items-center cv:gap-4">
						<a href="<?php echo esc_url( $btn1_href ); ?>" class="cv:inline-flex cv:items-center cv:gap-2 cv:px-7 cv:py-4 cv:rounded-xl cv:bg-amber-400 cv:text-gray-950 cv:text-base cv:font-bold hover:cv:bg-amber-300 cv:transition-all cv:shadow-md">
							<span><?php echo esc_html( $hero_btn1_text ); ?> →</span>
						</a>

						<?php if ( ! empty( $hero_btn2_text ) ) : ?>
							<a href="<?php echo esc_url( $btn2_href ); ?>" class="cv:inline-flex cv:items-center cv:gap-2 cv:px-6 cv:py-4 cv:rounded-xl cv:bg-white/10 cv:text-white cv:text-base cv:font-semibold hover:cv:bg-white/20 cv:border cv:border-white/20 cv:transition-all">
								<span><?php echo esc_html( $hero_btn2_text ); ?></span>
							</a>
						<?php endif; ?>
					</div>

					<?php if ( ! empty( $hero_perks ) ) : ?>
						<p class="cv-hero-perks cv:text-xs cv:sm:text-sm cv:text-emerald-200/80 cv:font-medium cv:mt-8 cv:tracking-wide">
							<?php echo esc_html( $hero_perks ); ?>
						</p>
					<?php endif; ?>
				</div>

				<!-- Right Visual Showcase Column -->
				<div class="cv-hero-visual-col cv:hidden cv:md:flex cv:flex-shrink-0 cv:items-center cv:justify-center">
					<div class="cv-hero-showcase-box">
						<span class="cv-hero-floating-badge">⚡ TOP RATED</span>
						<div class="cv-hero-product-preview">
							<?php if ( ! empty( $hero_image ) ) : ?>
								<img src="<?php echo esc_url( $hero_image ); ?>" alt="<?php echo esc_attr( $hero_title ); ?>" class="cv-hero-showcase-img" />
							<?php else : ?>
								<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/hero-headphones.svg' ); ?>" alt="Spatial Audio Pro" class="cv-hero-showcase-img" />
							<?php endif; ?>
						</div>
						<div class="cv-hero-glass-pill">
							<span class="cv:text-amber-400">★★★★★</span>
							<span>4.9 / 5.0 Rating</span>
						</div>
					</div>
				</div>

			</div>
		</div>
	</section>

	<!-- ==================== 2. TRUST & VALUE PROPOSITION STRIP ==================== -->
	<?php if ( $trust_enabled ) : ?>
		<section class="cv-trust-section cv:mb-10">
			<div class="cv:grid cv:grid-cols-1 cv:sm:grid-cols-2 cv:lg:grid-cols-4 cv:gap-4">
				<div class="cv-trust-card">
					<div class="cv-trust-icon">
						<svg class="cv:w-6 cv:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"></path></svg>
					</div>
					<div>
						<h4 class="cv:text-sm cv:font-extrabold cv:text-gray-900 cv:m-0"><?php esc_html_e( 'Free Express Shipping', 'cartvai' ); ?></h4>
						<p class="cv:text-xs cv:text-gray-500 cv:m-0"><?php esc_html_e( 'On eligible orders over $50', 'cartvai' ); ?></p>
					</div>
				</div>

				<div class="cv-trust-card">
					<div class="cv-trust-icon" style="background:#ecfdf5;color:#059669;">
						<svg class="cv:w-6 cv:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
					</div>
					<div>
						<h4 class="cv:text-sm cv:font-extrabold cv:text-gray-900 cv:m-0"><?php esc_html_e( '100% Secure Checkout', 'cartvai' ); ?></h4>
						<p class="cv:text-xs cv:text-gray-500 cv:m-0"><?php esc_html_e( 'Encrypted SSL payments', 'cartvai' ); ?></p>
					</div>
				</div>

				<div class="cv-trust-card">
					<div class="cv-trust-icon" style="background:#fff7ed;color:#ea580c;">
						<svg class="cv:w-6 cv:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
					</div>
					<div>
						<h4 class="cv:text-sm cv:font-extrabold cv:text-gray-900 cv:m-0"><?php esc_html_e( '30-Day Easy Returns', 'cartvai' ); ?></h4>
						<p class="cv:text-xs cv:text-gray-500 cv:m-0"><?php esc_html_e( 'Hassle-free refund policy', 'cartvai' ); ?></p>
					</div>
				</div>

				<div class="cv-trust-card">
					<div class="cv-trust-icon" style="background:#f5f3ff;color:#7c3aed;">
						<svg class="cv:w-6 cv:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
					</div>
					<div>
						<h4 class="cv:text-sm cv:font-extrabold cv:text-gray-900 cv:m-0"><?php esc_html_e( '24/7 Dedicated Support', 'cartvai' ); ?></h4>
						<p class="cv:text-xs cv:text-gray-500 cv:m-0"><?php esc_html_e( 'Live agent assistance', 'cartvai' ); ?></p>
					</div>
				</div>
			</div>
		</section>
	<?php endif; ?>

	<!-- ==================== 3. FEATURED CATEGORIES ==================== -->
	<section class="cv-home-section cv:mb-10">
		<div class="cv-shelf-header">
			<div class="cv-shelf-title-wrap">
				<span class="cv-shelf-badge"><?php esc_html_e( 'Curated Collections', 'cartvai' ); ?></span>
				<h2 class="cv-shelf-title"><?php esc_html_e( 'Popular Categories', 'cartvai' ); ?></h2>
				<p class="cv-shelf-subtitle"><?php esc_html_e( 'Explore our wide selection of top-rated items by category', 'cartvai' ); ?></p>
			</div>
			<a href="<?php echo esc_url( $shop_url ); ?>" class="cv-shelf-link">
				<span><?php esc_html_e( 'View All Categories', 'cartvai' ); ?></span>
				<svg class="cv:w-3.5 cv:h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
			</a>
		</div>
		<?php echo do_shortcode( '[cartvai_categories layout="carousel" columns="8" arrows="1"]' ); ?>
	</section>

	<!-- ==================== 4. TOP SELLING PRODUCTS ==================== -->
	<section class="cv-home-section cv:mb-12">
		<div class="cv-shelf-header">
			<div class="cv-shelf-title-wrap">
				<span class="cv-shelf-badge"><?php esc_html_e( 'Customer Favorites', 'cartvai' ); ?></span>
				<h2 class="cv-shelf-title"><?php esc_html_e( 'Top Selling Products', 'cartvai' ); ?></h2>
				<p class="cv-shelf-subtitle"><?php esc_html_e( 'Handpicked best-sellers with unbeatable quality and top reviews', 'cartvai' ); ?></p>
			</div>
			<a href="<?php echo esc_url( $shop_url ); ?>" class="cv-shelf-link">
				<span><?php esc_html_e( 'View All Best Sellers', 'cartvai' ); ?></span>
				<svg class="cv:w-3.5 cv:h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
			</a>
		</div>
		<?php echo do_shortcode( '[cartvai_products layout="wide" limit="4" orderby="date"]' ); ?>
	</section>

	<!-- ==================== 5. PROMOTIONAL DUO CALLOUT CARDS ==================== -->
	<section class="cv-home-section cv:mb-12">
		<div class="cv:grid cv:grid-cols-1 cv:md:grid-cols-2 cv:gap-6">
			<div class="cv-promo-duo-card" style="background:linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%)">
				<p class="cv:text-xs cv:font-extrabold cv:text-blue-600 cv:uppercase cv:tracking-wider cv:mb-2"><?php esc_html_e( 'Limited Time Offer', 'cartvai' ); ?></p>
				<h3 class="cv:text-xl cv:sm:text-2xl cv:font-black cv:text-gray-950 cv:leading-snug cv:mb-2"><?php esc_html_e( 'Save Big on Smart Tech & Audio', 'cartvai' ); ?></h3>
				<p class="cv:text-sm cv:text-gray-600 cv:mb-6"><?php esc_html_e( 'Get up to 40% discount on noise-cancelling headphones and lifestyle wearables.', 'cartvai' ); ?></p>
				<a href="<?php echo esc_url( $shop_url ); ?>" class="cv:inline-flex cv:items-center cv:gap-2 cv:px-5 cv:py-2.5 cv:rounded-xl cv:bg-blue-600 cv:text-white cv:text-xs cv:font-bold hover:cv:bg-blue-700 cv:transition-colors">
					<span><?php esc_html_e( 'Shop Electronics →', 'cartvai' ); ?></span>
				</a>
			</div>

			<div class="cv-promo-duo-card" style="background:linear-gradient(135deg, #fef2f2 0%, #fee2e2 100%)">
				<p class="cv:text-xs cv:font-extrabold cv:text-red-600 cv:uppercase cv:tracking-wider cv:mb-2"><?php esc_html_e( 'Weekend Special', 'cartvai' ); ?></p>
				<h3 class="cv:text-xl cv:sm:text-2xl cv:font-black cv:text-gray-950 cv:leading-snug cv:mb-2"><?php esc_html_e( 'New Arrivals & Best Picks', 'cartvai' ); ?></h3>
				<p class="cv:text-sm cv:text-gray-600 cv:mb-6"><?php esc_html_e( 'Curated premium essentials direct to your doorstep with guaranteed fast express dispatch.', 'cartvai' ); ?></p>
				<a href="<?php echo esc_url( $shop_url ); ?>" class="cv:inline-flex cv:items-center cv:gap-2 cv:px-5 cv:py-2.5 cv:rounded-xl cv:bg-gray-950 cv:text-white cv:text-xs cv:font-bold hover:cv:bg-gray-800 cv:transition-colors">
					<span><?php esc_html_e( 'Explore Arrivals →', 'cartvai' ); ?></span>
				</a>
			</div>
		</div>
	</section>

	<!-- ==================== 6. TRENDING PRODUCT SHELF ==================== -->
	<section class="cv-home-section cv:mb-12">
		<div class="cv-shelf-header">
			<div class="cv-shelf-title-wrap">
				<span class="cv-shelf-badge"><?php esc_html_e( 'Weekly Highlights', 'cartvai' ); ?></span>
				<h2 class="cv-shelf-title"><?php esc_html_e( 'Trending Products', 'cartvai' ); ?></h2>
				<p class="cv-shelf-subtitle"><?php esc_html_e( 'Don’t miss our latest arrivals and seasonal trending discounts', 'cartvai' ); ?></p>
			</div>
			<a href="<?php echo esc_url( $shop_url ); ?>" class="cv-shelf-link">
				<span><?php esc_html_e( 'Explore All Products', 'cartvai' ); ?></span>
				<svg class="cv:w-3.5 cv:h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
			</a>
		</div>
		<?php echo do_shortcode( '[cartvai_products limit="5" columns="5" orderby="date"]' ); ?>
	</section>

	<!-- ==================== 7. CUSTOMER REVIEWS ==================== -->
	<section class="cv-home-section cv:mb-8">
		<div class="cv-shelf-header">
			<div class="cv-shelf-title-wrap">
				<span class="cv-shelf-badge"><?php esc_html_e( 'Social Proof', 'cartvai' ); ?></span>
				<h2 class="cv-shelf-title"><?php esc_html_e( 'What Our Customers Say', 'cartvai' ); ?></h2>
				<p class="cv-shelf-subtitle"><?php esc_html_e( 'Real experiences and feedback from thousands of verified shoppers', 'cartvai' ); ?></p>
			</div>
			<div class="cv-shelf-rating-pill">
				<span class="cv:text-amber-400">★★★★★</span>
				<span><?php esc_html_e( '4.9 / 5 Overall Score', 'cartvai' ); ?></span>
			</div>
		</div>
		<div class="cv:grid cv:grid-cols-1 cv:md:grid-cols-3 cv:gap-6">
			<div class="cv-testimonial-card">
				<div class="cv:text-amber-400 cv:text-sm cv:mb-3">★★★★★</div>
				<p class="cv:text-sm cv:text-gray-700 cv:leading-relaxed cv:mb-5 cv:flex-1">
					&ldquo;<?php esc_html_e( 'The product quality blew away my expectations. Super clean packaging, lightning fast next-day delivery, and customer service answered my question in minutes!', 'cartvai' ); ?>&rdquo;
				</p>
				<div class="cv:flex cv:items-center cv:gap-3 cv:pt-4 cv:border-t cv:border-gray-100">
					<div class="cv:w-10 cv:h-10 cv:rounded-full cv:bg-blue-100 cv:text-blue-800 cv:font-bold cv:flex cv:items-center cv:justify-center cv:text-sm">AK</div>
					<div>
						<div class="cv:text-xs cv:font-bold cv:text-gray-900">Alex Kingston</div>
						<div class="cv:text-[11px] cv:text-emerald-600 cv:font-medium">✓ <?php esc_html_e( 'Verified Buyer', 'cartvai' ); ?></div>
					</div>
				</div>
			</div>

			<div class="cv-testimonial-card">
				<div class="cv:text-amber-400 cv:text-sm cv:mb-3">★★★★★</div>
				<p class="cv:text-sm cv:text-gray-700 cv:leading-relaxed cv:mb-5 cv:flex-1">
					&ldquo;<?php esc_html_e( 'Absolutely love shopping here. The cart checkout flow was seamless on mobile and the discounts were authentic. This is now my default online go-to store.', 'cartvai' ); ?>&rdquo;
				</p>
				<div class="cv:flex cv:items-center cv:gap-3 cv:pt-4 cv:border-t cv:border-gray-100">
					<div class="cv:w-10 cv:h-10 cv:rounded-full cv:bg-emerald-100 cv:text-emerald-800 cv:font-bold cv:flex cv:items-center cv:justify-center cv:text-sm">SR</div>
					<div>
						<div class="cv:text-xs cv:font-bold cv:text-gray-900">Sophia Rodriguez</div>
						<div class="cv:text-[11px] cv:text-emerald-600 cv:font-medium">✓ <?php esc_html_e( 'Verified Buyer', 'cartvai' ); ?></div>
					</div>
				</div>
			</div>

			<div class="cv-testimonial-card">
				<div class="cv:text-amber-400 cv:text-sm cv:mb-3">★★★★★</div>
				<p class="cv:text-sm cv:text-gray-700 cv:leading-relaxed cv:mb-5 cv:flex-1">
					&ldquo;<?php esc_html_e( 'High standard build quality and crystal clear sound. Hassle-free warranty registration and 100% genuine item as advertised. 10/10 recommendation!', 'cartvai' ); ?>&rdquo;
				</p>
				<div class="cv:flex cv:items-center cv:gap-3 cv:pt-4 cv:border-t cv:border-gray-100">
					<div class="cv:w-10 cv:h-10 cv:rounded-full cv:bg-amber-100 cv:text-amber-800 cv:font-bold cv:flex cv:items-center cv:justify-center cv:text-sm">MT</div>
					<div>
						<div class="cv:text-xs cv:font-bold cv:text-gray-900">Marcus Thorne</div>
						<div class="cv:text-[11px] cv:text-emerald-600 cv:font-medium">✓ <?php esc_html_e( 'Verified Buyer', 'cartvai' ); ?></div>
					</div>
				</div>
			</div>
		</div>
	</section>

</div>
