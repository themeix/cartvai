<?php
/**
 * Default Footer Template Part
 *
 * @package Cartvai_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$raw_copyright  = cartvai_theme_option( 'footer_copyright_text', '© {year} {site_name}. All rights reserved.' );
$copyright_text = str_replace(
	array( '{year}', '{site_name}' ),
	array( gmdate( 'Y' ), get_bloginfo( 'name' ) ),
	$raw_copyright
);

$has_widgets = is_active_sidebar( 'footer-1' ) || is_active_sidebar( 'footer-2' ) || is_active_sidebar( 'footer-3' ) || is_active_sidebar( 'footer-4' );
?>
<footer class="cv-site-footer cv:border-t cv:mt-auto" style="background-color: var(--cv-footer-bg, #ffffff); color: var(--cv-footer-text, #64748b); border-color: var(--cv-footer-border, #e2e8f0);">
	<?php if ( $has_widgets ) : ?>
		<div class="cv:max-w-7xl cv:mx-auto cv:py-12 cv:px-4 cv:sm:px-6 cv:lg:px-8 cv:border-b cv:border-gray-100">
			<div class="cv:grid cv:grid-cols-1 cv:md:grid-cols-2 cv:lg:grid-cols-4 cv:gap-8">
				<?php for ( $i = 1; $i <= 4; $i++ ) : ?>
					<div>
						<?php if ( is_active_sidebar( 'footer-' . $i ) ) : ?>
							<?php dynamic_sidebar( 'footer-' . $i ); ?>
						<?php endif; ?>
					</div>
				<?php endfor; ?>
			</div>
		</div>
	<?php endif; ?>

	<div class="cv:max-w-7xl cv:mx-auto cv:py-8 cv:px-4 cv:sm:px-6 cv:lg:px-8">
		<div class="cv:flex cv:flex-col cv:md:flex-row cv:items-center cv:justify-between cv:gap-6">
			<div class="cv:text-sm cv:text-gray-500">
				<?php echo esc_html( $copyright_text ); ?>
			</div>

			<?php if ( has_nav_menu( 'footer' ) ) : ?>
				<nav class="cv-footer-nav" aria-label="<?php esc_attr_e( 'Footer Navigation', 'cartvai' ); ?>">
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'footer',
							'container'      => false,
							'menu_class'     => 'cv:flex cv:flex-wrap cv:items-center cv:gap-6 cv:text-sm cv:text-gray-500',
							'fallback_cb'    => false,
						)
					);
					?>
				</nav>
			<?php endif; ?>
		</div>
	</div>
</footer>
