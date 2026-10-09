<?php
/**
 * Warm Boutique / Luxury Jewelry Footer Variation (Inspired by Rupanjali)
 *
 * Warm luxury aesthetic with:
 * - Centered or left elegant typography / gold aesthetic
 * - Social media icon pills
 * - Menu columns driven by WordPress menus: Shop, Customer Care, About Us, Contact
 * - Bottom row with user copyright and clean payment pills
 *
 * @package Cartvai_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$about_text    = cartvai_theme_option( 'footer_about_text', __( 'Timeless elegance, crafted for you.', 'cartvai-theme' ) );
$contact_phone = cartvai_theme_option( 'contact_phone', '+880 1885-132466' );
$contact_email = cartvai_theme_option( 'contact_email', get_bloginfo( 'admin_email' ) );
$store_address = cartvai_theme_option( 'footer_store_address', 'Dhaka, Bangladesh' );

// Copyright template tags replacement
$raw_copyright  = cartvai_theme_option( 'footer_copyright_text', '© {year} {site_name}. All Rights Reserved.' );
$copyright_text = str_replace(
	array( '{year}', '{site_name}' ),
	array( gmdate( 'Y' ), get_bloginfo( 'name' ) ),
	$raw_copyright
);
?>
<footer class="cv-footer-warm-boutique cv:text-stone-700 cv:mt-auto cv:border-t cv:border-stone-200/80" style="background-color: var(--cv-footer-bg, #fdf8f5);">
	<!-- Main 5-Column Luxury Layout -->
	<div class="cv:max-w-7xl cv:mx-auto cv:px-4 cv:sm:px-6 cv:lg:px-8 cv:py-14 cv:lg:py-16">
		<div class="cv:grid cv:grid-cols-1 cv:md:grid-cols-2 cv:lg:grid-cols-12 cv:gap-8 cv:lg:gap-10">

			<!-- Brand & Socials Column or Footer Column 1 Widget (4 cols) -->
			<div class="cv:lg:col-span-4 cv:space-y-4">
				<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
					<?php dynamic_sidebar( 'footer-1' ); ?>
				<?php else : ?>
					<?php if ( has_custom_logo() ) : ?>
						<div class="cv-site-logo cv:max-w-[200px]"><?php the_custom_logo(); ?></div>
					<?php else : ?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="cv:inline-block">
							<span class="cv:text-2xl cv:font-black cv:tracking-wide cv:text-stone-900 cv:block" style="font-family: Georgia, serif;">
								<?php bloginfo( 'name' ); ?>
							</span>
						</a>
					<?php endif; ?>

					<?php if ( ! empty( $about_text ) ) : ?>
						<p class="cv:text-sm cv:text-stone-600 cv:leading-relaxed cv:max-w-sm" style="font-style: italic;">
							<?php echo esc_html( $about_text ); ?>
						</p>
					<?php endif; ?>

					<!-- Social Icon Circles with Soft Borders -->
					<div class="cv:flex cv:items-center cv:gap-2.5 cv:pt-2">
						<a href="#" class="cv:w-8 cv:h-8 cv:rounded-full cv:bg-white cv:border cv:border-stone-300 cv:text-stone-700 hover:cv:text-rose-600 hover:cv:border-rose-300 cv:flex cv:items-center cv:justify-center cv:transition-colors" aria-label="Facebook">
							<svg class="cv:w-3.5 cv:h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/></svg>
						</a>
						<a href="#" class="cv:w-8 cv:h-8 cv:rounded-full cv:bg-white cv:border cv:border-stone-300 cv:text-stone-700 hover:cv:text-rose-600 hover:cv:border-rose-300 cv:flex cv:items-center cv:justify-center cv:transition-colors" aria-label="Instagram">
							<svg class="cv:w-3.5 cv:h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
						</a>
						<a href="#" class="cv:w-8 cv:h-8 cv:rounded-full cv:bg-white cv:border cv:border-stone-300 cv:text-stone-700 hover:cv:text-rose-600 hover:cv:border-rose-300 cv:flex cv:items-center cv:justify-center cv:transition-colors" aria-label="Pinterest">
							<svg class="cv:w-3.5 cv:h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.627 0-12 5.372-12 12 0 5.084 3.163 9.426 7.627 11.174-.105-.949-.2-2.405.042-3.441.218-.937 1.407-5.965 1.407-5.965s-.359-.719-.359-1.782c0-1.668.967-2.914 2.171-2.914 1.023 0 1.518.769 1.518 1.69 0 1.029-.655 2.568-.994 3.995-.283 1.194.599 2.169 1.777 2.169 2.133 0 3.772-2.249 3.772-5.495 0-2.873-2.064-4.882-5.012-4.882-3.414 0-5.418 2.561-5.418 5.207 0 1.031.397 2.138.893 2.738.098.119.112.224.083.345-.09.375-.291 1.199-.334 1.357-.056.208-.182.254-.419.151-1.57-.729-2.55-3.018-2.55-4.856 0-3.954 2.874-7.587 8.288-7.587 4.35 0 7.73 3.1 7.73 7.242 0 4.322-2.724 7.802-6.505 7.802-1.27 0-2.464-.66-2.874-1.442l-.78 2.973c-.282 1.084-1.043 2.443-1.554 3.271 1.144.353 2.359.545 3.619.545 6.627 0 12-5.373 12-12 0-6.628-5.373-12-12-12z"/></svg>
						</a>
					</div>
				<?php endif; ?>
			</div>

			<!-- Column 2: Shop or Footer Column 2 Widget (2 cols) -->
			<div class="cv:lg:col-span-2">
				<?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
					<?php dynamic_sidebar( 'footer-2' ); ?>
				<?php elseif ( has_nav_menu( 'footer_col_1' ) ) : ?>
					<h3 class="cv:text-xs cv:font-bold cv:uppercase cv:tracking-widest cv:text-stone-900 cv:mb-4" style="color: var(--cv-footer-heading, #1c1917);">
						<?php esc_html_e( 'Shop', 'cartvai-theme' ); ?>
					</h3>
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'footer_col_1',
							'container'      => false,
							'menu_class'     => 'cv-footer-menu cv:space-y-2 cv:text-xs cv:list-none cv:p-0 cv:m-0',
							'fallback_cb'    => false,
						)
					);
					?>
				<?php else : ?>
					<h3 class="cv:text-xs cv:font-bold cv:uppercase cv:tracking-widest cv:text-stone-900 cv:mb-4" style="color: var(--cv-footer-heading, #1c1917);">
						<?php esc_html_e( 'Shop', 'cartvai-theme' ); ?>
					</h3>
					<ul class="cv:space-y-2 cv:text-xs cv:list-none cv:p-0 cv:m-0">
						<li><a href="<?php echo esc_url( home_url( '/shop/' ) ); ?>" class="hover:cv:text-stone-950 cv:transition-colors"><?php esc_html_e( 'All Products', 'cartvai-theme' ); ?></a></li>
						<li><a href="#" class="hover:cv:text-stone-950 cv:transition-colors"><?php esc_html_e( 'Necklaces', 'cartvai-theme' ); ?></a></li>
						<li><a href="#" class="hover:cv:text-stone-950 cv:transition-colors"><?php esc_html_e( 'Earrings', 'cartvai-theme' ); ?></a></li>
						<li><a href="#" class="hover:cv:text-stone-950 cv:transition-colors"><?php esc_html_e( 'Rings', 'cartvai-theme' ); ?></a></li>
						<li><a href="#" class="hover:cv:text-stone-950 cv:transition-colors"><?php esc_html_e( 'Bracelets', 'cartvai-theme' ); ?></a></li>
					</ul>
				<?php endif; ?>
			</div>

			<!-- Column 3: Customer Care or Footer Column 3 Widget (2 cols) -->
			<div class="cv:lg:col-span-2">
				<?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
					<?php dynamic_sidebar( 'footer-3' ); ?>
				<?php elseif ( has_nav_menu( 'footer_col_2' ) ) : ?>
					<h3 class="cv:text-xs cv:font-bold cv:uppercase cv:tracking-widest cv:text-stone-900 cv:mb-4" style="color: var(--cv-footer-heading, #1c1917);">
						<?php esc_html_e( 'Customer Care', 'cartvai-theme' ); ?>
					</h3>
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'footer_col_2',
							'container'      => false,
							'menu_class'     => 'cv-footer-menu cv:space-y-2 cv:text-xs cv:list-none cv:p-0 cv:m-0',
							'fallback_cb'    => false,
						)
					);
					?>
				<?php else : ?>
					<h3 class="cv:text-xs cv:font-bold cv:uppercase cv:tracking-widest cv:text-stone-900 cv:mb-4" style="color: var(--cv-footer-heading, #1c1917);">
						<?php esc_html_e( 'Customer Care', 'cartvai-theme' ); ?>
					</h3>
					<ul class="cv:space-y-2 cv:text-xs cv:list-none cv:p-0 cv:m-0">
						<li><a href="#" class="hover:cv:text-stone-950 cv:transition-colors"><?php esc_html_e( 'Contact Us', 'cartvai-theme' ); ?></a></li>
						<li><a href="#" class="hover:cv:text-stone-950 cv:transition-colors"><?php esc_html_e( 'FAQs', 'cartvai-theme' ); ?></a></li>
						<li><a href="#" class="hover:cv:text-stone-950 cv:transition-colors"><?php esc_html_e( 'Shipping Policy', 'cartvai-theme' ); ?></a></li>
						<li><a href="#" class="hover:cv:text-stone-950 cv:transition-colors"><?php esc_html_e( 'Return & Refund', 'cartvai-theme' ); ?></a></li>
						<li><a href="#" class="hover:cv:text-stone-950 cv:transition-colors"><?php esc_html_e( 'Privacy Policy', 'cartvai-theme' ); ?></a></li>
					</ul>
				<?php endif; ?>
			</div>

			<!-- Column 4: About Us or Footer Column 4 Widget (2 cols) -->
			<div class="cv:lg:col-span-2">
				<?php if ( is_active_sidebar( 'footer-4' ) ) : ?>
					<?php dynamic_sidebar( 'footer-4' ); ?>
				<?php elseif ( has_nav_menu( 'footer_col_3' ) ) : ?>
					<h3 class="cv:text-xs cv:font-bold cv:uppercase cv:tracking-widest cv:text-stone-900 cv:mb-4" style="color: var(--cv-footer-heading, #1c1917);">
						<?php esc_html_e( 'About Us', 'cartvai-theme' ); ?>
					</h3>
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'footer_col_3',
							'container'      => false,
							'menu_class'     => 'cv-footer-menu cv:space-y-2 cv:text-xs cv:list-none cv:p-0 cv:m-0',
							'fallback_cb'    => false,
						)
					);
					?>
				<?php else : ?>
					<h3 class="cv:text-xs cv:font-bold cv:uppercase cv:tracking-widest cv:text-stone-900 cv:mb-4" style="color: var(--cv-footer-heading, #1c1917);">
						<?php esc_html_e( 'About Us', 'cartvai-theme' ); ?>
					</h3>
					<ul class="cv:space-y-2 cv:text-xs cv:list-none cv:p-0 cv:m-0">
						<li><a href="#" class="hover:cv:text-stone-950 cv:transition-colors"><?php esc_html_e( 'Our Story', 'cartvai-theme' ); ?></a></li>
						<li><a href="#" class="hover:cv:text-stone-950 cv:transition-colors"><?php esc_html_e( 'Why Choose Us', 'cartvai-theme' ); ?></a></li>
						<li><a href="#" class="hover:cv:text-stone-950 cv:transition-colors"><?php esc_html_e( 'Care Guide', 'cartvai-theme' ); ?></a></li>
						<li><a href="#" class="hover:cv:text-stone-950 cv:transition-colors"><?php esc_html_e( 'Size Guide', 'cartvai-theme' ); ?></a></li>
						<li><a href="<?php echo esc_url( home_url( '/checkout/' ) ); ?>" class="hover:cv:text-stone-950 cv:transition-colors"><?php esc_html_e( 'Track Order', 'cartvai-theme' ); ?></a></li>
					</ul>
				<?php endif; ?>
			</div>

			<!-- Column 5: Contact Us or Footer Column 5 Widget (2 cols) -->
			<div class="cv:lg:col-span-2 cv:space-y-3">
				<?php if ( is_active_sidebar( 'footer-5' ) ) : ?>
					<?php dynamic_sidebar( 'footer-5' ); ?>
				<?php else : ?>
					<h3 class="cv:text-xs cv:font-bold cv:uppercase cv:tracking-widest cv:text-stone-900 cv:mb-4" style="color: var(--cv-footer-heading, #1c1917);">
						<?php esc_html_e( 'Contact Us', 'cartvai-theme' ); ?>
					</h3>

					<?php if ( ! empty( $contact_phone ) ) : ?>
						<div class="cv:flex cv:items-center cv:gap-2 cv:text-xs cv:text-stone-700">
							<svg class="cv:w-3.5 cv:h-3.5 cv:text-stone-400 cv:shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
							<a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $contact_phone ) ); ?>" class="cv:font-medium hover:cv:text-stone-950 cv:transition-colors">
								<?php echo esc_html( $contact_phone ); ?>
							</a>
						</div>
					<?php endif; ?>

					<?php if ( ! empty( $contact_email ) ) : ?>
						<div class="cv:flex cv:items-center cv:gap-2 cv:text-xs cv:text-stone-700">
							<svg class="cv:w-3.5 cv:h-3.5 cv:text-stone-400 cv:shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
							<a href="mailto:<?php echo esc_attr( $contact_email ); ?>" class="hover:cv:text-stone-950 cv:transition-colors">
								<?php echo esc_html( $contact_email ); ?>
							</a>
						</div>
					<?php endif; ?>

					<?php if ( ! empty( $store_address ) ) : ?>
						<div class="cv:flex cv:items-start cv:gap-2 cv:text-xs cv:text-stone-500 cv:leading-relaxed">
							<svg class="cv:w-3.5 cv:h-3.5 cv:text-stone-400 cv:shrink-0 cv:mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
							<span><?php echo esc_html( $store_address ); ?></span>
						</div>
					<?php endif; ?>
				<?php endif; ?>
			</div>

		</div>
	</div>

	<!-- Sub-Footer Row: Copyright & Payment Pills -->
	<div class="cv:border-t cv:border-stone-200 cv:py-6" style="background-color: var(--cv-footer-sub-bg, transparent);">
		<div class="cv:max-w-7xl cv:mx-auto cv:px-4 cv:sm:px-6 cv:lg:px-8 cv:flex cv:flex-col cv:sm:flex-row cv:items-center cv:justify-between cv:gap-4 cv:text-xs cv:text-stone-500">
			<div>
				<?php echo esc_html( $copyright_text ); ?>
			</div>

			<div>
				<?php
				get_template_part(
					'template-parts/components/payment-badges',
					null,
					array( 'show_label' => false )
				);
				?>
			</div>
		</div>
	</div>
</footer>
