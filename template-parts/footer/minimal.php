<?php
/**
 * Minimal Footer Variation
 *
 * Streamlined single-row footer:
 * - Brand copyright
 * - Horizontal navigation links
 * - Minimalist styling
 *
 * @package Cartvai_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<footer class="cv-footer-minimal cv:bg-white cv:border-t cv:border-gray-100 cv:py-8 cv:mt-auto">
	<div class="cv:max-w-7xl cv:mx-auto cv:px-4 cv:sm:px-6 cv:lg:px-8">
		<div class="cv:flex cv:flex-col cv:sm:flex-row cv:items-center cv:justify-between cv:gap-4">
			<div class="cv:text-xs cv:text-gray-500">
				&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>. <?php esc_html_e( 'All rights reserved.', 'cartvai-theme' ); ?>
			</div>

			<?php if ( has_nav_menu( 'footer' ) ) : ?>
				<nav class="cv-footer-nav" aria-label="<?php esc_attr_e( 'Footer Navigation', 'cartvai-theme' ); ?>">
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'footer',
							'container'      => false,
							'menu_class'     => 'cv:flex cv:flex-wrap cv:items-center cv:gap-6 cv:text-xs cv:font-medium cv:text-gray-500',
							'fallback_cb'    => false,
						)
					);
					?>
				</nav>
			<?php endif; ?>
		</div>
	</div>
</footer>
