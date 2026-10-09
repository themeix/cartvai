<?php
/**
 * Centered Header Variation
 *
 * Boutique & luxury layout with:
 * - Centered brand identity
 * - Clean centered navigation
 * - Subtle utility icons
 *
 * @package Cartvai_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<header class="cv-header-centered cv:bg-white cv:border-b cv:border-gray-200 cv:sticky cv:top-0 cv:z-40">
	<!-- Top Bar -->
	<div class="cv-main-bar cv:max-w-7xl cv:mx-auto cv:px-4 cv:sm:px-6 cv:lg:px-8 cv:py-3 cv:sm:py-4 cv:flex cv:items-center cv:justify-between cv:gap-3">
		<!-- Left: Socials or Tagline -->
		<div class="cv:w-1/4 cv:hidden cv:md:block cv:text-xs cv:text-gray-500">
			<?php bloginfo( 'description' ); ?>
		</div>

		<!-- Center: Brand Logo -->
		<div class="cv:min-w-0 cv:flex-1 cv:md:w-2/4 cv:md:flex-initial cv:flex cv:justify-start cv:md:justify-center cv:text-left cv:md:text-center">
			<?php if ( has_custom_logo() ) : ?>
				<div class="cv-site-logo cv:max-w-[180px] cv:sm:max-w-[240px]"><?php the_custom_logo(); ?></div>
			<?php else : ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="cv:inline-block cv:text-lg cv:sm:text-2xl cv:md:text-3xl cv:font-black cv:tracking-wider cv:text-gray-950 hover:cv:text-primary cv:transition-colors cv:uppercase cv:break-words cv:line-clamp-2 cv:leading-tight">
					<?php bloginfo( 'name' ); ?>
				</a>
			<?php endif; ?>
		</div>

		<!-- Right: Cart & Mobile Toggle -->
		<div class="cv:shrink-0 cv:md:w-1/4 cv:flex cv:items-center cv:justify-end cv:gap-2.5 cv:sm:gap-3">
			<?php get_template_part( 'template-parts/components/header-cart' ); ?>

			<!-- Mobile Hamburger Button -->
			<button type="button" class="cv-mobile-menu-toggle cv:md:hidden cv:inline-flex cv:items-center cv:justify-center cv:p-2.5 cv:rounded-xl cv:bg-gray-100 hover:cv:bg-gray-200 cv:text-gray-900 cv:transition-colors" aria-expanded="false" aria-controls="cv-mobile-drawer" aria-label="<?php esc_attr_e( 'Open Navigation Menu', 'cartvai' ); ?>">
				<svg class="cv:w-5 cv:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
			</button>
		</div>
	</div>

	<!-- Bottom: Centered Navigation -->
	<nav class="cv-primary-nav cv-nav-bar cv:hidden cv:md:flex cv:items-center cv:justify-center cv:border-t cv:border-gray-100 cv:py-3" aria-label="<?php esc_attr_e( 'Centered Menu', 'cartvai' ); ?>">
		<?php
		if ( has_nav_menu( 'primary' ) ) {
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'container'      => false,
					'menu_class'     => 'cv-primary-menu cv:flex cv:items-center cv:gap-8 cv:text-xs cv:font-bold cv:uppercase cv:tracking-wider cv:text-gray-700',
					'fallback_cb'    => false,
				)
			);
		}
		?>
	</nav>
</header>
