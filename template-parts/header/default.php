<?php
/**
 * Default Header Template Part
 *
 * @package Cartvai_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<header class="cv-site-header cv:bg-white cv:border-b cv:border-gray-200 cv:sticky cv:top-0 cv:z-30">
	<div class="cv-main-bar cv:max-w-7xl cv:mx-auto cv:px-4 cv:sm:px-6 cv:lg:px-8">
		<div class="cv:flex cv:items-center cv:justify-between cv:gap-3 cv:sm:gap-6 cv:h-16">
			<!-- Branding -->
			<div class="cv:flex cv:items-center cv:min-w-0 cv:flex-1 cv:md:flex-initial cv:md:shrink-0">
				<?php if ( has_custom_logo() ) : ?>
					<div class="cv-site-logo cv:max-w-[180px] cv:sm:max-w-[240px]"><?php the_custom_logo(); ?></div>
				<?php else : ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="cv:inline-block cv:text-lg cv:sm:text-xl cv:font-bold cv:text-gray-900 cv:tracking-tight hover:cv:text-primary cv:break-words cv:line-clamp-2 cv:leading-tight">
						<?php bloginfo( 'name' ); ?>
					</a>
				<?php endif; ?>
			</div>

			<!-- Primary Navigation -->
			<nav class="cv-primary-nav cv:hidden cv:md:flex cv:items-center cv:gap-6" aria-label="<?php esc_attr_e( 'Primary Navigation', 'cartvai-theme' ); ?>">
				<?php
				if ( has_nav_menu( 'primary' ) ) {
					wp_nav_menu(
						array(
							'theme_location' => 'primary',
							'container'      => false,
							'menu_class'     => 'cv-primary-menu cv:flex cv:items-center cv:gap-6 cv:text-sm cv:font-medium cv:text-gray-700',
							'fallback_cb'    => false,
						)
					);
				}
				?>
			</nav>

			<!-- Header Utilities (Mini Cart + Mobile Toggle) -->
			<div class="cv:flex cv:items-center cv:gap-2.5 cv:sm:gap-3 cv:shrink-0">
				<?php get_template_part( 'template-parts/components/header-cart' ); ?>

				<!-- Mobile Hamburger Button -->
				<button type="button" class="cv-mobile-menu-toggle cv:md:hidden cv:inline-flex cv:items-center cv:justify-center cv:p-2.5 cv:rounded-xl cv:bg-gray-100 hover:cv:bg-gray-200 cv:text-gray-900 cv:transition-colors" aria-expanded="false" aria-controls="cv-mobile-drawer" aria-label="<?php esc_attr_e( 'Open Navigation Menu', 'cartvai-theme' ); ?>">
					<svg class="cv:w-5 cv:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
				</button>
			</div>
		</div>
	</div>
</header>
