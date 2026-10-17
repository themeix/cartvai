<?php
/**
 * Ecommerce Footer Variation
 *
 * Full-featured ecommerce footer driven by Customizer and Widgets (Columns 1 - 5):
 * - About bio & contact info (or Footer Column 1 Widget)
 * - Navigation links (or Footer Column 2 Widget)
 * - Customer care links (or Footer Column 3 Widget)
 * - Help / Custom Widgets (or Footer Column 4 Widget)
 * - Payment & security note
 * - Copyright text
 *
 * @package Cartvai_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$about_text    = cartvai_theme_option( 'footer_about_text', get_bloginfo( 'description' ) );
$contact_phone = cartvai_theme_option( 'contact_phone', '+1 (800) 123-4567' );
$contact_email = cartvai_theme_option( 'contact_email', 'support@cartvai.com' );
$security_note = cartvai_theme_option( 'footer_security_note', __( 'Guaranteed Safe Checkout', 'cartvai' ) );
$footer_cols   = (int) cartvai_theme_option( 'footer_columns', 4 );

// Copyright template tags replacement
$raw_copyright  = cartvai_theme_option( 'footer_copyright_text', '© {year} {site_name}. All rights reserved.' );
$copyright_text = str_replace(
	array( '{year}', '{site_name}' ),
	array( gmdate( 'Y' ), get_bloginfo( 'name' ) ),
	$raw_copyright
);

// Resolve grid class based on selected columns
$grid_class = 'cv:grid-cols-1 cv:md:grid-cols-2 cv:lg:grid-cols-4';
if ( 3 === $footer_cols ) {
	$grid_class = 'cv:grid-cols-1 cv:md:grid-cols-3';
} elseif ( 2 === $footer_cols ) {
	$grid_class = 'cv:grid-cols-1 cv:md:grid-cols-2';
} elseif ( 5 === $footer_cols ) {
	$grid_class = 'cv:grid-cols-1 cv:sm:grid-cols-2 cv:lg:grid-cols-5';
}
?>
<footer class="cv-footer-ecommerce cv:text-gray-300 cv:mt-auto" style="background-color: var(--cv-footer-bg, #030712); color: var(--cv-footer-text, #94a3b8); border-color: var(--cv-footer-border, #1f2937);">
	<!-- Main Multi-Column Section -->
	<div class="cv:max-w-7xl cv:mx-auto cv:px-4 cv:sm:px-6 cv:lg:px-8 cv:py-16">
		<div class="cv:grid <?php echo esc_attr( $grid_class ); ?> cv:gap-10">
			<!-- Col 1: Store Brand Info or Footer Column 1 Widget -->
			<div class="cv-footer-col cv-footer-col--1">
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
								<svg class="cv:w-4 cv:h-4 cv:text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
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
			<div class="cv-footer-col cv-footer-col--2">
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

			<?php if ( $footer_cols >= 3 ) : ?>
				<!-- Col 3: Customer Service or Footer Column 3 Widget -->
				<div class="cv-footer-col cv-footer-col--3">
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
			<?php endif; ?>

			<?php if ( $footer_cols >= 4 ) : ?>
				<!-- Col 4: Footer Column 4 Widget or Info Fallback -->
				<div class="cv-footer-col cv-footer-col--4">
					<?php if ( is_active_sidebar( 'footer-4' ) ) : ?>
						<?php dynamic_sidebar( 'footer-4' ); ?>
					<?php else : ?>
						<h3 class="cv:text-xs cv:font-bold cv:text-white cv:uppercase cv:tracking-wider cv:mb-4">
							<?php esc_html_e( 'Help & Information', 'cartvai' ); ?>
						</h3>
						<ul class="cv:space-y-2.5 cv:text-sm cv:list-none cv:pl-0 cv:p-0 cv:m-0">
							<li><a href="#" class="hover:cv:text-white cv:transition-colors"><?php esc_html_e( 'Privacy Policy', 'cartvai' ); ?></a></li>
							<li><a href="#" class="hover:cv:text-white cv:transition-colors"><?php esc_html_e( 'Terms of Service', 'cartvai' ); ?></a></li>
							<li><a href="#" class="hover:cv:text-white cv:transition-colors"><?php esc_html_e( 'Contact Us', 'cartvai' ); ?></a></li>
						</ul>
					<?php endif; ?>
				</div>
			<?php endif; ?>

			<?php if ( $footer_cols >= 5 ) : ?>
				<!-- Col 5: Footer Column 5 Widget -->
				<div class="cv-footer-col cv-footer-col--5">
					<?php if ( is_active_sidebar( 'footer-5' ) ) : ?>
						<?php dynamic_sidebar( 'footer-5' ); ?>
					<?php endif; ?>
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
