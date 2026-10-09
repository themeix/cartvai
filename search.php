<?php
/**
 * The template for displaying search results pages
 *
 * @package Cartvai_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

global $wp_query;
$cartvai_search_query = get_search_query();
$cartvai_total_found  = (int) $wp_query->found_posts;
?>

<!-- Search Page Header Banner -->
<div class="cv-search-hero cv:bg-white cv:border-b cv:border-gray-200 cv:py-6 cv:sm:py-8 cv:mb-8">
	<div class="cv:max-w-7xl cv:mx-auto cv:px-4 cv:sm:px-6 cv:lg:px-8">
		<div class="cv:flex cv:flex-col cv:md:flex-row cv:md:items-center cv:md:justify-between cv:gap-4">
			<div>
				<div class="cv:inline-flex cv:items-center cv:gap-1.5 cv:text-xs cv:font-semibold cv:text-primary cv:uppercase cv:tracking-wide cv:mb-1.5">
					<svg class="cv:w-3.5 cv:h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
					</svg>
					<span><?php esc_html_e( 'Search Results', 'cartvai' ); ?></span>
				</div>
				<h1 class="cv:text-xl cv:sm:text-2xl cv:font-bold cv:text-gray-950 cv:tracking-tight">
					<?php if ( ! empty( $cartvai_search_query ) ) : ?>
						<?php
						printf(
							/* translators: %s: Search term */
							esc_html__( 'Results for &ldquo;%s&rdquo;', 'cartvai' ),
							'<span class="cv:text-primary">' . esc_html( $cartvai_search_query ) . '</span>'
						);
						?>
					<?php else : ?>
						<?php esc_html_e( 'Search the Store', 'cartvai' ); ?>
					<?php endif; ?>
				</h1>
				<p class="cv:text-xs cv:sm:text-sm cv:text-gray-500 cv:mt-1">
					<?php
					printf(
						/* translators: %d: count */
						esc_html( _n( 'Showing %d result', 'Showing %d results', $cartvai_total_found, 'cartvai' ) ),
						$cartvai_total_found
					);
					?>
				</p>
			</div>

			<!-- Quick Refine Search Box -->
			<div class="cv:w-full cv:md:max-w-xs">
				<?php get_search_form(); ?>
			</div>
		</div>
	</div>
</div>

<!-- Search Results Content Area -->
<div class="cv-search-container cv:max-w-7xl cv:mx-auto cv:px-4 cv:sm:px-6 cv:lg:px-8 cv:pb-16">
	<?php if ( have_posts() ) : ?>
		<h2 class="cv:sr-only"><?php esc_html_e( 'Search Results List', 'cartvai' ); ?></h2>
		<div class="cv:grid cv:grid-cols-1 cv:sm:grid-cols-2 cv:md:grid-cols-3 cv:lg:grid-cols-4 cv:gap-6">
			<?php
			while ( have_posts() ) :
				the_post();

				if ( get_post_type() === 'cartvai_product' && function_exists( 'cartvai_render_product_card' ) ) {
					echo cartvai_render_product_card( get_the_ID() ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Rendering API handles escaping.
				} else {
					?>
					<article id="post-<?php the_ID(); ?>" <?php post_class( 'cv:bg-white cv:rounded-2xl cv:border cv:border-gray-100 cv:p-5 cv:shadow-xs hover:cv:shadow-md cv:transition-all cv:flex cv:flex-col' ); ?>>
						<?php if ( has_post_thumbnail() ) : ?>
							<div class="cv:aspect-video cv:rounded-xl cv:overflow-hidden cv:mb-4 cv:bg-gray-100">
								<a href="<?php the_permalink(); ?>">
									<?php the_post_thumbnail( 'medium', array( 'class' => 'cv:w-full cv:h-full cv:object-cover' ) ); ?>
								</a>
							</div>
						<?php endif; ?>

						<h2 class="cv:text-base cv:font-bold cv:text-gray-900 cv:mb-2 cv:line-clamp-2">
							<a href="<?php the_permalink(); ?>" class="hover:cv:text-primary cv:transition-colors">
								<?php the_title(); ?>
							</a>
						</h2>

						<div class="cv:text-xs cv:text-gray-500 cv:line-clamp-3 cv:mb-4 cv:flex-1">
							<?php the_excerpt(); ?>
						</div>

						<a href="<?php the_permalink(); ?>" class="cv:text-xs cv:font-bold cv:text-primary hover:cv:underline cv:inline-flex cv:items-center cv:gap-1">
							<span><?php esc_html_e( 'View Details', 'cartvai' ); ?></span>
							<svg class="cv:w-3 cv:h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
						</a>
					</article>
					<?php
				}
			endwhile;
			?>
		</div>

		<div class="cv:mt-12 cv:flex cv:justify-center">
			<?php the_posts_pagination(); ?>
		</div>

	<?php else : ?>

		<!-- Empty Search State -->
		<div class="cv-search-empty cv:bg-white cv:rounded-2xl cv:border cv:border-gray-100 cv:p-8 cv:sm:p-10 cv:text-center cv:max-w-lg cv:mx-auto cv:shadow-xs">
			<div class="cv:w-12 cv:h-12 cv:rounded-xl cv:bg-blue-50 cv:text-primary cv:flex cv:items-center cv:justify-center cv:mx-auto cv:mb-4">
				<svg class="cv:w-6 cv:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
				</svg>
			</div>

			<h2 class="cv:text-lg cv:sm:text-xl cv:font-bold cv:text-gray-900 cv:mb-2">
				<?php esc_html_e( 'No products found', 'cartvai' ); ?>
			</h2>

			<p class="cv:text-xs cv:sm:text-sm cv:text-gray-500 cv:mb-6 cv:leading-relaxed">
				<?php
				if ( ! empty( $cartvai_search_query ) ) {
					printf(
						/* translators: %s: Search term */
						esc_html__( 'We could not find any products matching &ldquo;%s&rdquo;. Please check for typos, try using different keywords, or browse our popular categories.', 'cartvai' ),
						esc_html( $cartvai_search_query )
					);
				} else {
					esc_html__( 'Please enter one or more keywords above to search products.', 'cartvai' );
				}
				?>
			</p>

			<div class="cv:flex cv:flex-wrap cv:items-center cv:justify-center cv:gap-3">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="cv:inline-flex cv:items-center cv:gap-2 cv:px-5 cv:py-2.5 cv:rounded-xl cv:bg-gray-900 hover:cv:bg-primary cv:text-white cv:text-xs cv:font-semibold cv:transition-colors">
					<svg class="cv:w-4 cv:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
					<span><?php esc_html_e( 'Return to Home', 'cartvai' ); ?></span>
				</a>
			</div>
		</div>

	<?php endif; ?>
</div>

<?php
get_footer();
