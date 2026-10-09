<?php
/**
 * Ecommerce Header Variation
 *
 * Full-featured ecommerce store header with:
 * - Top announcement bar & support hotline
 * - Primary bar with logo, product search bar, user account, and mini cart
 * - Secondary bar with category pills and navigation
 *
 * @package Cartvai_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$announcement_enabled        = (bool) cartvai_theme_option( 'announcement_enabled', true );
$announcement_text           = cartvai_theme_option( 'announcement_text', '⚡ Flash Sale: Enjoy free shipping on orders over $50! Shop Now' );
$contact_phone               = cartvai_theme_option( 'contact_phone', '+1 (800) 123-4567' );
$popular_categories_enabled  = (bool) cartvai_theme_option( 'popular_categories_enabled', true );

// Get product categories for quick category navigation
$categories = array();
if ( $popular_categories_enabled && class_exists( 'CARTVAI_CPT' ) ) {
	$terms = get_terms(
		array(
			'taxonomy'   => CARTVAI_CPT::TAXONOMY,
			'hide_empty' => true,
			'number'     => 6,
		)
	);
	if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
		$categories = $terms;
	}
}
?>
<header class="cv-header-ecommerce cv:bg-white cv:border-b cv:border-gray-200 cv:sticky cv:top-0 cv:z-40 cv:shadow-xs">
	<!-- Top Announcement Bar -->
	<?php if ( $announcement_enabled && ! empty( $announcement_text ) ) : ?>
		<div class="cv-top-bar cv:bg-gray-950 cv:text-gray-300 cv:text-xs cv:py-2 cv:px-4">
			<div class="cv:max-w-7xl cv:mx-auto cv:flex cv:items-center cv:justify-between cv:gap-4">
				<div class="cv:flex cv:items-center cv:gap-2">
					<span class="cv:inline-block cv:w-2 cv:h-2 cv:rounded-full cv:bg-emerald-400 cv:animate-pulse"></span>
					<span class="cv:font-medium"><?php echo esc_html( $announcement_text ); ?></span>
				</div>
				<div class="cv:hidden cv:md:flex cv:items-center cv:gap-6 cv:text-gray-400">
					<?php if ( ! empty( $contact_phone ) ) : ?>
						<a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $contact_phone ) ); ?>" class="hover:cv:text-white cv:transition-colors cv:flex cv:items-center cv:gap-1.5">
							<svg class="cv:w-3.5 cv:h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
							<span><?php echo esc_html( $contact_phone ); ?></span>
						</a>
					<?php endif; ?>
					<span class="cv:text-gray-600">|</span>
					<span class="cv:text-gray-400"><?php esc_html_e( '24/7 Dedicated Support', 'cartvai-theme' ); ?></span>
				</div>
			</div>
		</div>
	<?php endif; ?>

	<!-- Main Header Row -->
	<div class="cv-main-bar cv:max-w-7xl cv:mx-auto cv:px-4 cv:sm:px-6 cv:lg:px-8 cv:py-4 cv:sm:py-5">
		<div class="cv:flex cv:items-center cv:justify-between cv:gap-4 cv:sm:gap-8">
			<!-- Logo -->
			<div class="cv:min-w-0 cv:flex-1 cv:md:flex-initial cv:md:shrink-0">
				<?php if ( has_custom_logo() ) : ?>
					<div class="cv-site-logo cv:max-w-[190px] cv:sm:max-w-[250px]"><?php the_custom_logo(); ?></div>
				<?php else : ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="cv:inline-block cv:text-xl cv:sm:text-2xl cv:font-black cv:tracking-tight cv:text-gray-950 hover:cv:text-primary cv:transition-colors cv:break-words cv:line-clamp-2 cv:leading-tight">
						<?php bloginfo( 'name' ); ?>
					</a>
				<?php endif; ?>
			</div>

			<!-- Product Search Form -->
			<div class="cv:hidden cv:md:flex cv:flex-1 cv:max-w-lg cv:mx-auto">
				<?php get_search_form(); ?>
			</div>

			<!-- User & Cart Utilities + Mobile Toggle -->
			<div class="cv:flex cv:items-center cv:gap-3 cv:shrink-0">
				<?php get_template_part( 'template-parts/components/header-cart' ); ?>

				<!-- Mobile Hamburger Button -->
				<button type="button" class="cv-mobile-menu-toggle cv:md:hidden cv:inline-flex cv:items-center cv:justify-center cv:p-2.5 cv:rounded-xl cv:bg-gray-100 hover:cv:bg-gray-200 cv:text-gray-900 cv:transition-colors" aria-expanded="false" aria-controls="cv-mobile-drawer" aria-label="<?php esc_attr_e( 'Open Navigation Menu', 'cartvai-theme' ); ?>">
					<svg class="cv:w-5 cv:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
				</button>
			</div>
		</div>
	</div>

	<!-- Secondary Navigation & Category Bar -->
	<div class="cv-nav-bar cv:border-t cv:border-b cv:border-gray-200/80 cv:bg-slate-50/70">
		<div class="cv:max-w-7xl cv:mx-auto cv:px-4 cv:sm:px-6 cv:lg:px-8 cv:flex cv:items-center cv:justify-between">
			<!-- Primary Menu -->
			<nav class="cv-primary-nav cv:hidden cv:md:flex cv:items-center cv:gap-8 cv:py-3.5" aria-label="<?php esc_attr_e( 'Main Menu', 'cartvai-theme' ); ?>">
				<?php
				if ( has_nav_menu( 'primary' ) ) {
					wp_nav_menu(
						array(
							'theme_location' => 'primary',
							'container'      => false,
							'menu_class'     => 'cv-primary-menu cv:flex cv:items-center cv:gap-8 cv:text-sm cv:font-semibold cv:text-slate-800',
							'fallback_cb'    => false,
						)
					);
				}
				?>
			</nav>

			<!-- Quick Category Badges -->
			<?php if ( $popular_categories_enabled && ! empty( $categories ) ) : ?>
				<div class="cv:hidden cv:lg:flex cv:items-center cv:gap-2 cv:py-3">
					<span class="cv:text-xs cv:font-bold cv:text-gray-400 cv:uppercase cv:tracking-wider"><?php esc_html_e( 'Popular:', 'cartvai-theme' ); ?></span>
					<?php foreach ( $categories as $cat ) : ?>
						<a href="<?php echo esc_url( get_term_link( $cat ) ); ?>" class="cv:text-xs cv:font-semibold cv:px-3 cv:py-1.5 cv:rounded-lg cv:bg-white cv:border cv:border-gray-200/90 cv:text-slate-700 hover:cv:border-primary hover:cv:text-primary cv:shadow-2xs cv:transition-all">
							<?php echo esc_html( $cat->name ); ?>
						</a>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</header>
