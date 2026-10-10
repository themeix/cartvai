<?php
/**
 * Colorful Megastore Header Variation (with Mega Menu)
 *
 * Rich brand-colored header inspired by modern D2C megastores:
 * - Optional top announcement strip
 * - Deep brand-colored main bar with white logo, wide pill search bar,
 *   and stacked icon+label utilities (Order Track, Account, Cart with badge)
 * - Full-width colorful category bar with hover Mega Menu (3-column product showcase)
 *
 * @package Cartvai_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$announcement_enabled = (bool) cartvai_theme_option( 'announcement_enabled', true );
$announcement_text    = cartvai_theme_option( 'announcement_text', '⚡ Flash Sale: Enjoy free shipping on orders over $50! Shop Now' );
$contact_phone        = cartvai_theme_option( 'contact_phone', '+1 (800) 123-4567' );
$contact_email        = cartvai_theme_option( 'contact_email', 'support@cartvai.com' );

$cart_count   = class_exists( 'CARTVAI_Cart' ) ? (int) CARTVAI_Cart::get_count() : 0;
$cart_url     = home_url( '/cart/' );
$checkout_url = home_url( '/checkout/' );
$account_url  = is_user_logged_in() ? admin_url( 'profile.php' ) : wp_login_url( get_permalink() );

$header_more_enabled        = (bool) cartvai_theme_option( 'header_more_enabled', true );
$brand_tagline_enabled      = (bool) cartvai_theme_option( 'brand_tagline_enabled', true );
?>
<header class="cv-header-megastore cv:sticky cv:top-0 cv:z-40 cv:shadow-md">
	<!-- Top Announcement Bar -->
	<?php if ( $announcement_enabled && ! empty( $announcement_text ) ) : ?>
		<div class="cv-megastore-top-bar cv:text-xs cv:py-2 cv:px-4">
			<div class="cv:max-w-7xl cv:mx-auto cv:flex cv:items-center cv:justify-between cv:gap-4">
				<div class="cv:flex cv:items-center cv:gap-2">
					<span class="cv:inline-block cv:w-2 cv:h-2 cv:rounded-full cv:bg-amber-400 cv:animate-pulse"></span>
					<span class="cv:font-medium"><?php echo esc_html( $announcement_text ); ?></span>
				</div>
				<div class="cv:hidden cv:md:flex cv:items-center cv:gap-5 cv:opacity-90">
					<?php if ( ! empty( $contact_phone ) ) : ?>
						<a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $contact_phone ) ); ?>" class="hover:cv:text-amber-300 cv:transition-colors cv:flex cv:items-center cv:gap-1.5">
							<svg class="cv:w-3.5 cv:h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
							<span><?php echo esc_html( $contact_phone ); ?></span>
						</a>
					<?php endif; ?>
					<?php if ( ! empty( $contact_email ) ) : ?>
						<a href="mailto:<?php echo esc_attr( $contact_email ); ?>" class="hover:cv:text-amber-300 cv:transition-colors cv:flex cv:items-center cv:gap-1.5">
							<svg class="cv:w-3.5 cv:h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
							<span><?php echo esc_html( $contact_email ); ?></span>
						</a>
					<?php endif; ?>
					<span class="cv:opacity-40">|</span>
					<span><?php esc_html_e( '100% Authentic & Verified Products', 'cartvai' ); ?></span>
				</div>
			</div>
		</div>
	<?php endif; ?>

	<!-- Main Colorful Brand Row -->
	<div class="cv-megastore-main">
		<div class="cv:max-w-7xl cv:mx-auto cv:px-4 cv:sm:px-6 cv:lg:px-8 cv:py-3.5 cv:sm:py-4">
			<div class="cv:flex cv:items-center cv:justify-between cv:gap-4 cv:lg:gap-8">
				<!-- Brand Logo -->
				<div class="cv:min-w-0 cv:shrink-0">
					<?php
					$site_tagline = get_bloginfo( 'description' );
					$show_tagline = $brand_tagline_enabled && ( function_exists( 'display_header_text' ) ? display_header_text() : true );
					if ( empty( $site_tagline ) && $brand_tagline_enabled ) {
						$site_tagline = __( 'Official Megastore', 'cartvai' );
					}
					?>
					<?php if ( has_custom_logo() ) : ?>
						<div class="cv-site-branding cv:flex cv:flex-col cv:items-start">
							<div class="cv-site-logo cv-site-logo--light cv:max-w-[180px] cv:sm:max-w-[230px]"><?php the_custom_logo(); ?></div>
							<?php if ( $show_tagline && ! empty( $site_tagline ) ) : ?>
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="cv-site-description cv-megastore-tagline cv:text-[10px] cv:font-semibold cv:uppercase cv:tracking-widest cv:mt-1 cv:leading-tight hover:cv:opacity-85 cv:transition-opacity" style="color: var(--cv-main-bar-tagline, #fcd34d);">
									<?php echo esc_html( $site_tagline ); ?>
								</a>
							<?php endif; ?>
						</div>
					<?php else : ?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="cv-megastore-brand cv:inline-flex cv:flex-col" style="color: var(--cv-main-bar-text, #ffffff);">
							<span class="cv-site-title cv-megastore-title cv:text-xl cv:sm:text-2xl cv:font-black cv:tracking-tight cv:leading-none" style="color: var(--cv-main-bar-text, #ffffff);">
								<?php bloginfo( 'name' ); ?>
							</span>
							<?php if ( $show_tagline && ! empty( $site_tagline ) ) : ?>
								<span class="cv-site-description cv-megastore-tagline cv:text-[10px] cv:font-semibold cv:uppercase cv:tracking-widest cv:mt-1 cv:leading-tight" style="color: var(--cv-main-bar-tagline, #fcd34d);">
									<?php echo esc_html( $site_tagline ); ?>
								</span>
							<?php endif; ?>
						</a>
					<?php endif; ?>
				</div>

				<!-- Wide Rounded Search Bar -->
				<div class="cv:hidden cv:md:flex cv:flex-1 cv:max-w-2xl cv:mx-auto">
					<?php get_search_form(); ?>
				</div>

				<!-- Stacked Utility Actions (Account, Cart, Mobile Toggle) -->
				<div class="cv:flex cv:items-center cv:gap-2 cv:sm:gap-5 cv:shrink-0">
					<!-- Account / Sign In -->
					<a href="<?php echo esc_url( $account_url ); ?>" class="cv-megastore-action cv:hidden cv:lg:flex cv:flex-col cv:items-center cv:justify-center cv:gap-1 cv:px-2.5 cv:py-1.5 cv:rounded-xl hover:cv:bg-white/10 cv:transition-all" style="color: var(--cv-main-bar-text, #ffffff);">
						<svg class="cv:w-5 cv:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
						</svg>
						<span class="cv:text-[11px] cv:font-semibold cv:leading-none">
							<?php echo is_user_logged_in() ? esc_html__( 'Account', 'cartvai' ) : esc_html__( 'Sign In', 'cartvai' ); ?>
						</span>
					</a>

					<!-- Cart Trigger with Vibrant Badge -->
					<div class="cartvai-header-cart-slot cv:relative cv:inline-flex cv:items-center">
						<button type="button" id="cartvaiMiniCartTrigger" class="cv-megastore-action cv:relative cv:flex cv:flex-col cv:items-center cv:justify-center cv:gap-1 cv:px-3 cv:py-1.5 cv:rounded-xl hover:cv:bg-white/10 cv:transition-all" data-cartvai-mini-cart-toggle aria-label="<?php esc_attr_e( 'Cart', 'cartvai' ); ?>" data-cart-url="<?php echo esc_url( $cart_url ); ?>" style="color: var(--cv-main-bar-text, #ffffff);">
							<div class="cv:relative">
								<svg class="cv:w-5 cv:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
								</svg>
								<span class="cartvai-mini-cart-count-badge cv:absolute cv:-top-2 cv:-right-2.5 cv:inline-flex cv:items-center cv:justify-center cv:min-w-[18px] cv:h-[18px] cv:px-1 cv:rounded-full cv:bg-amber-500 cv:text-gray-950 cv:text-[10px] cv:font-extrabold cv:leading-none cv:shadow-xs" data-cartvai-mini-cart-count data-cartvai-count <?php echo $cart_count > 0 ? '' : 'style="display:none;"'; ?>>
									<?php echo esc_html( $cart_count ); ?>
								</span>
							</div>
							<span class="cv:text-[11px] cv:font-semibold cv:leading-none"><?php esc_html_e( 'Cart', 'cartvai' ); ?></span>
						</button>
					</div>

					<!-- More / Mobile Drawer Toggle -->
					<?php if ( $header_more_enabled ) : ?>
						<button type="button" class="cv-mobile-menu-toggle cv-megastore-action cv:flex cv:flex-col cv:items-center cv:justify-center cv:gap-1 cv:px-2.5 cv:py-1.5 cv:rounded-xl hover:cv:bg-white/10 cv:transition-all" aria-expanded="false" aria-controls="cv-mobile-drawer" aria-label="<?php esc_attr_e( 'More Navigation Menu', 'cartvai' ); ?>" style="color: var(--cv-main-bar-text, #ffffff);">
							<svg class="cv:w-5 cv:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 6h16M4 12h16M4 18h16"></path></svg>
							<span class="cv:text-[11px] cv:font-semibold cv:leading-none"><?php esc_html_e( 'More', 'cartvai' ); ?></span>
						</button>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>

	<!-- Secondary Mega Menu Category Navigation Bar -->
	<div class="cv-megastore-navbar cv:hidden cv:md:block">
		<div class="cv-mega-nav-container cv:max-w-7xl cv:mx-auto cv:px-4 cv:sm:px-6 cv:lg:px-8 cv:relative">
			<nav class="cv:flex cv:items-center cv:justify-center" aria-label="<?php esc_attr_e( 'Category Mega Menu', 'cartvai' ); ?>">
				<?php get_template_part( 'template-parts/components/mega-menu-bar' ); ?>
			</nav>
		</div>
	</div>
</header>
