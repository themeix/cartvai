<?php
/**
 * Template Name: Cart (Cartvai)
 * Template Post Type: page
 *
 * @package Cartvai_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<div class="cv-cart-hero cv:bg-white cv:border-b cv:border-gray-200/80 cv:py-8 cv:sm:py-10 cv:mb-8">
	<div class="cv:max-w-7xl cv:mx-auto cv:px-4 cv:sm:px-6 cv:lg:px-8">
		<div class="cv:flex cv:flex-col cv:md:flex-row cv:md:items-center cv:md:justify-between cv:gap-4">
			<div>
				<nav class="cv:flex cv:items-center cv:gap-2 cv:text-xs cv:font-medium cv:text-slate-600 cv:mb-2" aria-label="Breadcrumb">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="hover:cv:text-primary cv:transition-colors"><?php esc_html_e( 'Home', 'cartvai' ); ?></a>
					<span class="cv:text-slate-400">/</span>
					<a href="<?php echo esc_url( home_url( '/shop/' ) ); ?>" class="hover:cv:text-primary cv:transition-colors"><?php esc_html_e( 'Shop', 'cartvai' ); ?></a>
					<span class="cv:text-slate-400">/</span>
					<span class="cv:text-slate-900 cv:font-semibold"><?php the_title(); ?></span>
				</nav>
				<h1 class="cv:text-2xl cv:sm:text-3xl cv:font-black cv:text-gray-950 cv:tracking-tight cv:leading-tight">
					<?php the_title(); ?>
				</h1>
				<p class="cv:text-xs cv:sm:text-sm cv:text-gray-500 cv:mt-1.5 cv:flex cv:items-center cv:gap-2">
					<span><?php esc_html_e( 'Review and manage your selected items before checkout', 'cartvai' ); ?></span>
					<span class="cv:inline-block cv:w-1 cv:h-1 cv:rounded-full cv:bg-gray-300"></span>
					<span class="cv:text-emerald-700 cv:font-medium"><?php esc_html_e( 'Free Delivery On Eligible Orders', 'cartvai' ); ?></span>
				</p>
			</div>
			<div class="cv:flex cv:items-center cv:gap-3">
				<div class="cv:inline-flex cv:items-center cv:gap-2 cv:px-3.5 cv:py-2 cv:rounded-xl cv:bg-gray-50 cv:border cv:border-gray-200 cv:text-xs cv:font-semibold cv:text-gray-700">
					<svg class="cv:w-4 cv:h-4 cv:text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
					<span><?php esc_html_e( 'Guaranteed Safe & Secure Checkout', 'cartvai' ); ?></span>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="cv-page-cart cv:max-w-7xl cv:mx-auto cv:px-4 cv:sm:px-6 cv:lg:px-8 cv:pb-16">
	<div class="cv-page-content">
		<?php
		while ( have_posts() ) :
			the_post();
			the_content();
		endwhile;
		?>
	</div>
</div>

<?php
get_footer();
