<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package Cartvai_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<div class="cv:max-w-3xl cv:mx-auto cv:px-4 cv:py-20 cv:text-center">
	<div class="cv:w-20 cv:h-20 cv:rounded-3xl cv:bg-primary/10 cv:text-primary cv:flex cv:items-center cv:justify-center cv:mx-auto cv:mb-6">
		<svg class="cv:w-10 cv:h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
			<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
		</svg>
	</div>

	<h1 class="cv:text-6xl cv:font-black cv:text-gray-900 cv:tracking-tight cv:mb-3">
		404
	</h1>
	<h2 class="cv:text-2xl cv:font-bold cv:text-gray-800 cv:mb-4">
		<?php esc_html_e( 'Page Not Found', 'cartvai-theme' ); ?>
	</h2>
	<p class="cv:text-gray-500 cv:mb-8 cv:max-w-md cv:mx-auto cv:text-sm cv:leading-relaxed">
		<?php esc_html_e( 'Sorry, the page you are looking for doesn’t exist or has been moved. Try searching or browse our shop.', 'cartvai-theme' ); ?>
	</p>

	<div class="cv:max-w-md cv:mx-auto cv:mb-8">
		<?php get_search_form(); ?>
	</div>

	<div>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="cartvai-btn cartvai-btn-primary cv:inline-flex cv:items-center cv:gap-2 cv:px-6 cv:py-3 cv:rounded-xl cv:font-bold cv:text-sm cv:transition-colors">
			<svg class="cv:w-4 cv:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
			<span><?php esc_html_e( 'Back to Home', 'cartvai-theme' ); ?></span>
		</a>
	</div>
</div>

<?php
get_footer();
