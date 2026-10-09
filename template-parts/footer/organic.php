<?php
/**
 * Organic / Nature D2C Footer Variation (Inspired by Naturo)
 *
 * Rich deep emerald theme with:
 * - Brand logo & tagline
 * - Social circle links (Facebook, WhatsApp, Instagram, etc.)
 * - 3 Custom Category/Navigation columns driven by WordPress menus
 * - Direct contact details (Hotline, Physical address, Email)
 * - Clean copyright row + full payment options & SSL trust strip
 *
 * @package Cartvai_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$about_text    = cartvai_theme_option( 'footer_about_text', get_bloginfo( 'description' ) );
$contact_phone = cartvai_theme_option( 'contact_phone', '09678812525' );
$contact_email = cartvai_theme_option( 'contact_email', get_bloginfo( 'admin_email' ) );
$store_address = cartvai_theme_option( 'footer_store_address', 'Level-5, Noor Tower, 110 Bir Uttam CR Dutta Rd, Dhaka 1205' );

// Copyright template tags replacement
$raw_copyright  = cartvai_theme_option( 'footer_copyright_text', '© {year} {site_name}. All Rights Reserved.' );
$copyright_text = str_replace(
	array( '{year}', '{site_name}' ),
	array( gmdate( 'Y' ), get_bloginfo( 'name' ) ),
	$raw_copyright
);
?>
<footer class="cv-footer-organic cv:text-slate-200 cv:mt-auto" style="background-color: var(--cv-footer-bg, #0d3b2e);">
	<!-- Main Footer Multi-Column Grid -->
	<div class="cv:max-w-7xl cv:mx-auto cv:px-4 cv:sm:px-6 cv:lg:px-8 cv:py-12 cv:lg:py-16">
		<div class="cv:grid cv:grid-cols-1 cv:md:grid-cols-2 cv:lg:grid-cols-12 cv:gap-8 cv:lg:gap-10">

			<!-- Brand Column or Footer Column 1 Widget (4 cols) -->
			<div class="cv:lg:col-span-4 cv:space-y-4">
				<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
					<?php dynamic_sidebar( 'footer-1' ); ?>
				<?php else : ?>
					<?php if ( has_custom_logo() ) : ?>
						<div class="cv-site-logo cv-site-logo--light cv:max-w-[210px]"><?php the_custom_logo(); ?></div>
					<?php else : ?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="cv:inline-block">
							<span class="cv:text-2xl cv:font-black cv:tracking-tight cv:text-white cv:block">
								<?php bloginfo( 'name' ); ?>
							</span>
							<span class="cv:text-xs cv:font-semibold cv:tracking-widest cv:uppercase cv:text-emerald-400 cv:block cv:mt-1">
								<?php esc_html_e( 'Back to Nature', 'cartvai-theme' ); ?>
							</span>
						</a>
					<?php endif; ?>

					<?php if ( ! empty( $about_text ) ) : ?>
						<p class="cv:text-sm cv:text-emerald-100/80 cv:leading-relaxed cv:max-w-sm">
							<?php echo esc_html( $about_text ); ?>
						</p>
					<?php endif; ?>

					<!-- Social Media Circle Buttons -->
					<div class="cv:flex cv:items-center cv:gap-2.5 cv:pt-2">
						<a href="#" class="cv:w-9 cv:h-9 cv:rounded-full cv:bg-white/10 hover:cv:bg-white/25 cv:text-white cv:flex cv:items-center cv:justify-center cv:transition-colors" aria-label="Facebook">
							<svg class="cv:w-4 cv:h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/></svg>
						</a>
						<a href="#" class="cv:w-9 cv:h-9 cv:rounded-full cv:bg-white/10 hover:cv:bg-white/25 cv:text-white cv:flex cv:items-center cv:justify-center cv:transition-colors" aria-label="WhatsApp">
							<svg class="cv:w-4 cv:h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/></svg>
						</a>
					</div>
				<?php endif; ?>
			</div>

			<!-- Column 2: Quick Links or Footer Column 2 Widget (2 cols) -->
			<div class="cv:lg:col-span-2">
				<?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
					<?php dynamic_sidebar( 'footer-2' ); ?>
				<?php elseif ( has_nav_menu( 'footer_col_1' ) ) : ?>
					<h3 class="cv:text-sm cv:font-bold cv:text-white cv:mb-4" style="color: var(--cv-footer-heading, #ffffff);">
						<?php esc_html_e( 'Quick Links', 'cartvai-theme' ); ?>
					</h3>
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'footer_col_1',
							'container'      => false,
							'menu_class'     => 'cv-footer-menu cv:space-y-2.5 cv:text-sm cv:list-none cv:p-0 cv:m-0',
							'fallback_cb'    => false,
						)
					);
					?>
				<?php else : ?>
					<h3 class="cv:text-sm cv:font-bold cv:text-white cv:mb-4" style="color: var(--cv-footer-heading, #ffffff);">
						<?php esc_html_e( 'Quick Links', 'cartvai-theme' ); ?>
					</h3>
					<ul class="cv:space-y-2.5 cv:text-sm cv:list-none cv:p-0 cv:m-0">
						<li><a href="<?php echo esc_url( home_url( '/shop/' ) ); ?>" class="hover:cv:text-emerald-300 cv:transition-colors"><?php esc_html_e( 'All Products', 'cartvai-theme' ); ?></a></li>
						<li><a href="#" class="hover:cv:text-emerald-300 cv:transition-colors"><?php esc_html_e( 'Special Offers', 'cartvai-theme' ); ?></a></li>
						<li><a href="#" class="hover:cv:text-emerald-300 cv:transition-colors"><?php esc_html_e( 'FAQ', 'cartvai-theme' ); ?></a></li>
						<li><a href="<?php echo esc_url( home_url( '/cart/' ) ); ?>" class="hover:cv:text-emerald-300 cv:transition-colors"><?php esc_html_e( 'Cart', 'cartvai-theme' ); ?></a></li>
						<li><a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>" class="hover:cv:text-emerald-300 cv:transition-colors"><?php esc_html_e( 'Blog & Health Tips', 'cartvai-theme' ); ?></a></li>
					</ul>
				<?php endif; ?>
			</div>

			<!-- Column 3: Useful Links or Footer Column 3 Widget (2 cols) -->
			<div class="cv:lg:col-span-2">
				<?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
					<?php dynamic_sidebar( 'footer-3' ); ?>
				<?php elseif ( has_nav_menu( 'footer_col_2' ) ) : ?>
					<h3 class="cv:text-sm cv:font-bold cv:text-white cv:mb-4" style="color: var(--cv-footer-heading, #ffffff);">
						<?php esc_html_e( 'Useful Links', 'cartvai-theme' ); ?>
					</h3>
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'footer_col_2',
							'container'      => false,
							'menu_class'     => 'cv-footer-menu cv:space-y-2.5 cv:text-sm cv:list-none cv:p-0 cv:m-0',
							'fallback_cb'    => false,
						)
					);
					?>
				<?php else : ?>
					<h3 class="cv:text-sm cv:font-bold cv:text-white cv:mb-4" style="color: var(--cv-footer-heading, #ffffff);">
						<?php esc_html_e( 'Useful Links', 'cartvai-theme' ); ?>
					</h3>
					<ul class="cv:space-y-2.5 cv:text-sm cv:list-none cv:p-0 cv:m-0">
						<li><a href="#" class="hover:cv:text-emerald-300 cv:transition-colors"><?php esc_html_e( 'About Us', 'cartvai-theme' ); ?></a></li>
						<li><a href="#" class="hover:cv:text-emerald-300 cv:transition-colors"><?php esc_html_e( 'Privacy Policy', 'cartvai-theme' ); ?></a></li>
						<li><a href="#" class="hover:cv:text-emerald-300 cv:transition-colors"><?php esc_html_e( 'Cookie Policy', 'cartvai-theme' ); ?></a></li>
						<li><a href="#" class="hover:cv:text-emerald-300 cv:transition-colors"><?php esc_html_e( 'Terms & Conditions', 'cartvai-theme' ); ?></a></li>
						<li><a href="#" class="hover:cv:text-emerald-300 cv:transition-colors"><?php esc_html_e( 'Return and Refund', 'cartvai-theme' ); ?></a></li>
					</ul>
				<?php endif; ?>
			</div>

			<!-- Column 4: Help Center or Footer Column 4 Widget (2 cols) -->
			<div class="cv:lg:col-span-2">
				<?php if ( is_active_sidebar( 'footer-4' ) ) : ?>
					<?php dynamic_sidebar( 'footer-4' ); ?>
				<?php elseif ( has_nav_menu( 'footer_col_3' ) ) : ?>
					<h3 class="cv:text-sm cv:font-bold cv:text-white cv:mb-4" style="color: var(--cv-footer-heading, #ffffff);">
						<?php esc_html_e( 'Help Center', 'cartvai-theme' ); ?>
					</h3>
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'footer_col_3',
							'container'      => false,
							'menu_class'     => 'cv-footer-menu cv:space-y-2.5 cv:text-sm cv:list-none cv:p-0 cv:m-0',
							'fallback_cb'    => false,
						)
					);
					?>
				<?php else : ?>
					<h3 class="cv:text-sm cv:font-bold cv:text-white cv:mb-4" style="color: var(--cv-footer-heading, #ffffff);">
						<?php esc_html_e( 'Help Center', 'cartvai-theme' ); ?>
					</h3>
					<ul class="cv:space-y-2.5 cv:text-sm cv:list-none cv:p-0 cv:m-0">
						<li><a href="<?php echo esc_url( home_url( '/checkout/' ) ); ?>" class="hover:cv:text-emerald-300 cv:transition-colors"><?php esc_html_e( 'Order Tracking', 'cartvai-theme' ); ?></a></li>
						<li><a href="#" class="hover:cv:text-emerald-300 cv:transition-colors"><?php esc_html_e( 'Contact Us', 'cartvai-theme' ); ?></a></li>
						<li><a href="#" class="hover:cv:text-emerald-300 cv:transition-colors"><?php esc_html_e( 'How to Order', 'cartvai-theme' ); ?></a></li>
						<li><a href="#" class="hover:cv:text-emerald-300 cv:transition-colors"><?php esc_html_e( 'Complaint & Feedback', 'cartvai-theme' ); ?></a></li>
						<li><a href="#" class="hover:cv:text-emerald-300 cv:transition-colors"><?php esc_html_e( 'Product Returns', 'cartvai-theme' ); ?></a></li>
					</ul>
				<?php endif; ?>
			</div>

			<!-- Column 5: Direct Contact Details or Footer Column 5 Widget (2 cols) -->
			<div class="cv:lg:col-span-2 cv:space-y-3.5">
				<?php if ( is_active_sidebar( 'footer-5' ) ) : ?>
					<?php dynamic_sidebar( 'footer-5' ); ?>
				<?php else : ?>
				<h3 class="cv:text-sm cv:font-bold cv:text-white cv:mb-4" style="color: var(--cv-footer-heading, #ffffff);">
					<?php esc_html_e( 'Contact', 'cartvai-theme' ); ?>
				</h3>

				<?php if ( ! empty( $contact_phone ) ) : ?>
					<div class="cv:flex cv:items-start cv:gap-2.5 cv:text-sm">
						<svg class="cv:w-4 cv:h-4 cv:text-amber-400 cv:shrink-0 cv:mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
						<a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $contact_phone ) ); ?>" class="cv:font-bold cv:text-white hover:cv:text-amber-300 cv:transition-colors">
							<?php echo esc_html( $contact_phone ); ?>
						</a>
					</div>
				<?php endif; ?>

				<?php if ( ! empty( $store_address ) ) : ?>
					<div class="cv:flex cv:items-start cv:gap-2.5 cv:text-xs cv:text-emerald-100/70 cv:leading-relaxed">
						<svg class="cv:w-4 cv:h-4 cv:text-amber-400 cv:shrink-0 cv:mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
						<span><?php echo esc_html( $store_address ); ?></span>
					</div>
				<?php endif; ?>

				<?php if ( ! empty( $contact_email ) ) : ?>
					<div class="cv:flex cv:items-start cv:gap-2.5 cv:text-xs">
						<svg class="cv:w-4 cv:h-4 cv:text-amber-400 cv:shrink-0 cv:mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
						<a href="mailto:<?php echo esc_attr( $contact_email ); ?>" class="hover:cv:text-amber-300 cv:text-emerald-100/90 cv:transition-colors">
							<?php echo esc_html( $contact_email ); ?>
						</a>
					</div>
				<?php endif; ?>
				<?php endif; ?>
			</div>

		</div>
	</div>

	<!-- Copyright Bar -->
	<div class="cv:border-t cv:border-white/10 cv:py-4 cv:text-center cv:text-xs cv:text-emerald-100/70" style="background-color: var(--cv-footer-sub-bg, rgba(0,0,0,0.15));">
		<div class="cv:max-w-7xl cv:mx-auto cv:px-4">
			<?php echo esc_html( $copyright_text ); ?>
		</div>
	</div>

	<!-- White Bottom Payment Methods Strip -->
	<div class="cv:bg-white cv:py-4 cv:border-t cv:border-slate-100">
		<div class="cv:max-w-7xl cv:mx-auto cv:px-4 cv:sm:px-6 cv:lg:px-8 cv:flex cv:flex-col cv:sm:flex-row cv:items-center cv:justify-between cv:gap-3">
			<?php
			get_template_part(
				'template-parts/components/payment-badges',
				null,
				array( 'show_label' => true )
			);
			?>
			<div class="cv:text-[11px] cv:font-semibold cv:text-slate-400">
				<span><?php esc_html_e( '100% Verified & Secure SSL Checkout', 'cartvai-theme' ); ?></span>
			</div>
		</div>
	</div>
</footer>
