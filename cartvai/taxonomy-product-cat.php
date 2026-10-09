<?php
/**
 * Cartvai Theme Override: Product Category Taxonomy Archive
 *
 * Implements a modern, responsive hero header with breadcrumbs and
 * product count, followed by a responsive product grid.
 *
 * @package Cartvai_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$cartvai_term  = get_queried_object();
$product_count = $cartvai_term && ! empty( $cartvai_term->count ) ? (int) $cartvai_term->count : (int) $GLOBALS['wp_query']->found_posts;
$shop_page_id  = function_exists( 'CARTVAI_Settings::get' ) ? (int) CARTVAI_Settings::get( 'shop_page_id', 0 ) : 0;
$shop_url      = $shop_page_id ? get_permalink( $shop_page_id ) : home_url( '/shop/' );
?>

<!-- Modern Category Hero Header -->
<div class="cv-category-hero cv:bg-white cv:border-b cv:border-gray-200/80 cv:py-8 cv:sm:py-10 cv:mb-8">
	<div class="cv:max-w-7xl cv:mx-auto cv:px-4 cv:sm:px-6 cv:lg:px-8">
		<div class="cv:flex cv:flex-col cv:md:flex-row cv:md:items-center cv:md:justify-between cv:gap-4">
			<div>
				<nav class="cv:flex cv:items-center cv:gap-2 cv:text-xs cv:font-medium cv:text-slate-600 cv:mb-2" aria-label="Breadcrumb">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="hover:cv:text-primary cv:transition-colors"><?php esc_html_e( 'Home', 'cartvai' ); ?></a>
					<span class="cv:text-slate-400">/</span>
					<a href="<?php echo esc_url( $shop_url ); ?>" class="hover:cv:text-primary cv:transition-colors"><?php esc_html_e( 'Shop', 'cartvai' ); ?></a>
					<span class="cv:text-slate-400">/</span>
					<span class="cv:text-slate-900 cv:font-semibold"><?php echo esc_html( $cartvai_term ? $cartvai_term->name : __( 'Category', 'cartvai' ) ); ?></span>
				</nav>
				<h1 class="cv:text-2xl cv:sm:text-3xl cv:font-black cv:text-gray-950 cv:tracking-tight cv:leading-tight">
					<?php echo esc_html( $cartvai_term ? $cartvai_term->name : single_term_title( '', false ) ); ?>
				</h1>
				<?php if ( $cartvai_term && ! empty( $cartvai_term->description ) ) : ?>
					<div class="cv:text-sm cv:text-gray-600 cv:mt-2 cv:max-w-2xl">
						<?php echo wp_kses_post( wpautop( $cartvai_term->description ) ); ?>
					</div>
				<?php endif; ?>
				<p class="cv:text-xs cv:sm:text-sm cv:text-gray-500 cv:mt-1.5 cv:flex cv:items-center cv:gap-2">
					<span>
						<?php
						/* translators: %d: number of products */
						printf( esc_html__( 'Showing all %d products', 'cartvai' ), (int) $product_count );
						?>
					</span>
					<span class="cv:inline-block cv:w-1 cv:h-1 cv:rounded-full cv:bg-gray-300"></span>
					<span class="cv:text-emerald-700 cv:font-medium"><?php esc_html_e( '100% Genuine & In Stock', 'cartvai' ); ?></span>
				</p>
			</div>
			<div class="cv:flex cv:items-center cv:gap-3">
				<div class="cv:inline-flex cv:items-center cv:gap-2 cv:px-3.5 cv:py-2 cv:rounded-xl cv:bg-gray-50 cv:border cv:border-gray-200 cv:text-xs cv:font-semibold cv:text-gray-700">
					<svg class="cv:w-4 cv:h-4 cv:text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
					<span><?php esc_html_e( 'Fast Nationwide Delivery', 'cartvai' ); ?></span>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Category Products Grid -->
<div class="cv-category-container cv:max-w-7xl cv:mx-auto cv:px-4 cv:sm:px-6 cv:lg:px-8 cv:pb-16">
	<?php if ( have_posts() ) : ?>
		<h2 class="cv:sr-only"><?php esc_html_e( 'Products List', 'cartvai' ); ?></h2>
		<div class="cv:grid cv:grid-cols-1 cv:sm:grid-cols-2 cv:md:grid-cols-3 cv:lg:grid-cols-4 cv:gap-6">
			<?php
			while ( have_posts() ) :
				the_post();
				if ( function_exists( 'cartvai_render_product_card' ) ) {
					// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					echo cartvai_render_product_card( get_the_ID() );
				} else {
					CARTVAI_CPT::get_template_part( 'content', 'product' );
				}
			endwhile;
			?>
		</div>

		<div class="cv:mt-10 cv:flex cv:justify-center">
			<?php
			if ( class_exists( 'CARTVAI_Shop_Page' ) ) {
				CARTVAI_Shop_Page::render_archive_pagination();
			} else {
				the_posts_pagination();
			}
			?>
		</div>
	<?php else : ?>
		<div class="cv:bg-white cv:rounded-2xl cv:border cv:border-gray-100 cv:p-12 cv:text-center cv:max-w-md cv:mx-auto">
			<div class="cv:w-16 cv:h-16 cv:rounded-full cv:bg-gray-100 cv:text-gray-400 cv:flex cv:items-center cv:justify-center cv:mx-auto cv:mb-4">
				<svg class="cv:w-8 cv:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
				</svg>
			</div>
			<h2 class="cv:text-lg cv:font-bold cv:text-gray-900 cv:mb-1.5"><?php esc_html_e( 'No Products Found', 'cartvai' ); ?></h2>
			<p class="cv:text-sm cv:text-gray-500 cv:mb-6"><?php esc_html_e( 'There are currently no products available in this category.', 'cartvai' ); ?></p>
			<a href="<?php echo esc_url( $shop_url ); ?>" class="cartvai-btn cartvai-btn-primary cv:inline-flex cv:items-center cv:gap-2 cv:px-6 cv:py-2.5 cv:rounded-xl cv:font-semibold cv:text-sm cv:transition-colors">
				<?php esc_html_e( 'Browse All Products', 'cartvai' ); ?>
			</a>
		</div>
	<?php endif; ?>
</div>

<?php
get_footer();
