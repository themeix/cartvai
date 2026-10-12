<?php
/**
 * Ecommerce Footer Variation
 *
 * Full-featured 4-column ecommerce footer with configurable:
 * - Trust reassurance band
 * - About bio & contact info
 * - Newsletter subscription box
 * - Payment & security note
 * - Copyright text
 *
 * @package Cartvai_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$trust_enabled = (bool) cartvai_theme_option( 'footer_trust_enabled', true );
$about_text    = cartvai_theme_option( 'footer_about_text', get_bloginfo( 'description' ) );
$contact_phone      = cartvai_theme_option( 'contact_phone', '+1 (800) 123-4567' );
$contact_email      = cartvai_theme_option( 'contact_email', 'support@cartvai.com' );
$security_note      = cartvai_theme_option( 'footer_security_note', __( 'Guaranteed Safe Checkout', 'cartvai' ) );

// Trust badges
$trust_1_title = cartvai_theme_option( 'footer_trust_1_title', __( 'Free Fast Shipping', 'cartvai' ) );
$trust_1_desc  = cartvai_theme_option( 'footer_trust_1_desc', __( 'On all orders above $50', 'cartvai' ) );
$trust_2_title = cartvai_theme_option( 'footer_trust_2_title', __( '100% Safe Payments', 'cartvai' ) );
$trust_2_desc  = cartvai_theme_option( 'footer_trust_2_desc', __( 'Encrypted SSL checkout', 'cartvai' ) );
$trust_3_title = cartvai_theme_option( 'footer_trust_3_title', __( 'Hassle-Free Returns', 'cartvai' ) );
$trust_3_desc  = cartvai_theme_option( 'footer_trust_3_desc', __( '7 days replacement warranty', 'cartvai' ) );
$trust_4_title = cartvai_theme_option( 'footer_trust_4_title', __( '24/7 Priority Support', 'cartvai' ) );
$trust_4_desc  = cartvai_theme_option( 'footer_trust_4_desc', __( 'Dedicated support team', 'cartvai' ) );

// Copyright template tags replacement
$raw_copyright  = cartvai_theme_option( 'footer_copyright_text', '© {year} {site_name}. All rights reserved.' );
$copyright_text = str_replace(
	array( '{year}', '{site_name}' ),
	array( gmdate( 'Y' ), get_bloginfo( 'name' ) ),
	$raw_copyright
);
?>
<footer class="cv-footer-ecommerce cv:text-gray-300 cv:mt-auto" style="background-color: var(--cv-footer-bg, #030712); color: var(--cv-footer-text, #94a3b8); border-color: var(--cv-footer-border, #1f2937);">
	<!-- Trust Reassurance Band -->
	<?php if ( $trust_enabled ) : ?>
		<div class="cv-trust-band cv:border-b cv:border-gray-800 cv:py-8">
			<div class="cv:max-w-7xl cv:mx-auto cv:px-4 cv:sm:px-6 cv:lg:px-8">
				<div class="cv:grid cv:grid-cols-1 cv:sm:grid-cols-2 cv:lg:grid-cols-4 cv:gap-6">
					<!-- Item 1 -->
					<div class="cv:flex cv:items-center cv:gap-3">
						<div class="cv:flex-shrink-0 cv:w-10 cv:h-10 cv:rounded-xl cv:bg-primary/10 cv:text-primary cv:flex cv:items-center cv:justify-center">
							<svg class="cv:w-5 cv:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path></svg>
						</div>
						<div>
							<h4 class="cv:text-sm cv:font-bold cv:text-white"><?php echo esc_html( $trust_1_title ); ?></h4>
							<p class="cv:text-xs cv:text-gray-400"><?php echo esc_html( $trust_1_desc ); ?></p>
						</div>
					</div>
					<!-- Item 2 -->
					<div class="cv:flex cv:items-center cv:gap-3">
						<div class="cv:flex-shrink-0 cv:w-10 cv:h-10 cv:rounded-xl cv:bg-emerald-500/10 cv:text-emerald-400 cv:flex cv:items-center cv:justify-center">
							<svg class="cv:w-5 cv:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
						</div>
						<div>
							<h4 class="cv:text-sm cv:font-bold cv:text-white"><?php echo esc_html( $trust_2_title ); ?></h4>
							<p class="cv:text-xs cv:text-gray-400"><?php echo esc_html( $trust_2_desc ); ?></p>
						</div>
					</div>
					<!-- Item 3 -->
					<div class="cv:flex cv:items-center cv:gap-3">
						<div class="cv:flex-shrink-0 cv:w-10 cv:h-10 cv:rounded-xl cv:bg-amber-500/10 cv:text-amber-400 cv:flex cv:items-center cv:justify-center">
							<svg class="cv:w-5 cv:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
						</div>
						<div>
							<h4 class="cv:text-sm cv:font-bold cv:text-white"><?php echo esc_html( $trust_3_title ); ?></h4>
							<p class="cv:text-xs cv:text-gray-400"><?php echo esc_html( $trust_3_desc ); ?></p>
						</div>
					</div>
					<!-- Item 4 -->
					<div class="cv:flex cv:items-center cv:gap-3">
						<div class="cv:flex-shrink-0 cv:w-10 cv:h-10 cv:rounded-xl cv:bg-purple-500/10 cv:text-purple-400 cv:flex cv:items-center cv:justify-center">
							<svg class="cv:w-5 cv:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
						</div>
						<div>
							<h4 class="cv:text-sm cv:font-bold cv:text-white"><?php echo esc_html( $trust_4_title ); ?></h4>
							<p class="cv:text-xs cv:text-gray-400"><?php echo esc_html( $trust_4_desc ); ?></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php endif; ?>

	<!-- Main Multi-Column Section -->
	<?php $has_col_4 = is_active_sidebar( 'footer-4' ); ?>
	<div class="cv:max-w-7xl cv:mx-auto cv:px-4 cv:sm:px-6 cv:lg:px-8 cv:py-16">
		<div class="cv:grid cv:grid-cols-1 cv:md:grid-cols-2 <?php echo $has_col_4 ? 'cv:lg:grid-cols-5' : 'cv:lg:grid-cols-4'; ?> cv:gap-10">
			<!-- Col 1: Store Brand Info or Footer Column 1 Widget (2 spans) -->
			<div class="cv:lg:col-span-2">
				<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
					<?php dynamic_sidebar( 'footer-1' ); ?>
				<?php else : ?>
					<div class="cv:mb-4">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="cv:text-2xl cv:font-black cv:tracking-tight cv:text-white hover:cv:text-primary cv:transition-colors">
							<?php bloginfo( 'name' ); ?>
						</a>
					</div>
					<?php if ( ! empty( $about_text ) ) : ?>
						<p class="cv:text-sm cv:text-gray-400 cv:mb-6 cv:max-w-sm cv:leading-relaxed">
							<?php echo esc_html( $about_text ); ?>
						</p>
					<?php endif; ?>

					<div class="cv:space-y-2">
						<?php if ( ! empty( $contact_phone ) ) : ?>
							<div class="cv:flex cv:items-center cv:gap-3 cv:text-sm">
								<svg class="cv:w-4 cv:h-4 cv:text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
								<span class="cv:text-gray-400"><?php esc_html_e( 'Helpline:', 'cartvai' ); ?></span>
								<a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $contact_phone ) ); ?>" class="cv:font-bold cv:text-white hover:cv:text-primary">
									<?php echo esc_html( $contact_phone ); ?>
								</a>
							</div>
						<?php endif; ?>

						<?php if ( ! empty( $contact_email ) ) : ?>
							<div class="cv:flex cv:items-center cv:gap-3 cv:text-sm">
								<svg class="cv:w-4 cv:h-4 cv:text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
								<span class="cv:text-gray-400"><?php esc_html_e( 'Email:', 'cartvai' ); ?></span>
								<a href="mailto:<?php echo esc_attr( $contact_email ); ?>" class="cv:font-medium cv:text-white hover:cv:text-primary">
									<?php echo esc_html( $contact_email ); ?>
								</a>
							</div>
						<?php endif; ?>
					</div>
				<?php endif; ?>
			</div>

			<!-- Col 2: Quick Links or Footer Column 2 Widget -->
			<div>
				<?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
					<?php dynamic_sidebar( 'footer-2' ); ?>
				<?php elseif ( has_nav_menu( 'footer_col_1' ) ) : ?>
					<h3 class="cv:text-xs cv:font-bold cv:text-white cv:uppercase cv:tracking-wider cv:mb-4">
						<?php esc_html_e( 'Quick Links', 'cartvai' ); ?>
					</h3>
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'footer_col_1',
							'container'      => false,
							'menu_class'     => 'cv:space-y-2.5 cv:text-sm cv:list-none cv:pl-0 cv:p-0 cv:m-0',
							'fallback_cb'    => false,
						)
					);
					?>
				<?php else : ?>
					<h3 class="cv:text-xs cv:font-bold cv:text-white cv:uppercase cv:tracking-wider cv:mb-4">
						<?php esc_html_e( 'Quick Links', 'cartvai' ); ?>
					</h3>
					<ul class="cv:space-y-2.5 cv:text-sm cv:list-none cv:pl-0 cv:p-0 cv:m-0">
						<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="hover:cv:text-white cv:transition-colors"><?php esc_html_e( 'Home', 'cartvai' ); ?></a></li>
						<li><a href="<?php echo esc_url( home_url( '/shop/' ) ); ?>" class="hover:cv:text-white cv:transition-colors"><?php esc_html_e( 'All Products', 'cartvai' ); ?></a></li>
						<li><a href="<?php echo esc_url( home_url( '/cart/' ) ); ?>" class="hover:cv:text-white cv:transition-colors"><?php esc_html_e( 'Cart', 'cartvai' ); ?></a></li>
						<li><a href="<?php echo esc_url( home_url( '/checkout/' ) ); ?>" class="hover:cv:text-white cv:transition-colors"><?php esc_html_e( 'Checkout', 'cartvai' ); ?></a></li>
					</ul>
				<?php endif; ?>
			</div>

			<!-- Col 3: Customer Service or Footer Column 3 Widget -->
			<div>
				<?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
					<?php dynamic_sidebar( 'footer-3' ); ?>
				<?php elseif ( has_nav_menu( 'footer_col_2' ) ) : ?>
					<h3 class="cv:text-xs cv:font-bold cv:text-white cv:uppercase cv:tracking-wider cv:mb-4">
						<?php esc_html_e( 'Customer Care', 'cartvai' ); ?>
					</h3>
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'footer_col_2',
							'container'      => false,
							'menu_class'     => 'cv:space-y-2.5 cv:text-sm cv:list-none cv:pl-0 cv:p-0 cv:m-0',
							'fallback_cb'    => false,
						)
					);
					?>
				<?php else : ?>
					<h3 class="cv:text-xs cv:font-bold cv:text-white cv:uppercase cv:tracking-wider cv:mb-4">
						<?php esc_html_e( 'Customer Care', 'cartvai' ); ?>
					</h3>
					<ul class="cv:space-y-2.5 cv:text-sm cv:list-none cv:pl-0 cv:p-0 cv:m-0">
						<li><a href="#" class="hover:cv:text-white cv:transition-colors"><?php esc_html_e( 'Order Tracking', 'cartvai' ); ?></a></li>
						<li><a href="#" class="hover:cv:text-white cv:transition-colors"><?php esc_html_e( 'Shipping Policy', 'cartvai' ); ?></a></li>
						<li><a href="#" class="hover:cv:text-white cv:transition-colors"><?php esc_html_e( 'Returns & Refund', 'cartvai' ); ?></a></li>
						<li><a href="#" class="hover:cv:text-white cv:transition-colors"><?php esc_html_e( 'Help & FAQ', 'cartvai' ); ?></a></li>
					</ul>
				<?php endif; ?>
			</div>

			<?php if ( $has_col_4 ) : ?>
				<!-- Col 4: Footer Column 4 Widget -->
				<div>
					<?php dynamic_sidebar( 'footer-4' ); ?>
				</div>
			<?php endif; ?>
		</div>
	</div>

	<!-- Sub-footer -->
	<div class="cv-sub-footer cv:border-t cv:border-gray-900 cv:py-6" style="background-color: var(--cv-footer-sub-bg, transparent);">
		<div class="cv:max-w-7xl cv:mx-auto cv:px-4 cv:sm:px-6 cv:lg:px-8 cv:flex cv:flex-col cv:sm:flex-row cv:items-center cv:justify-between cv:gap-4 cv:text-xs cv:text-gray-400">
			<div>
				<?php echo esc_html( $copyright_text ); ?>
			</div>
			<div>
				<?php
				get_template_part(
					'template-parts/components/payment-badges',
					null,
					array( 'show_label' => true )
				);
				?>
			</div>
		</div>
	</div>
</footer>
