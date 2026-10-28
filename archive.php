<?php
/**
 * The template for displaying archive pages (categories, tags, author, date)
 *
 * @package Cartvai_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<!-- Archive Hero Header -->
<div class="cv-archive-hero cv:bg-white cv:border-b cv:border-gray-200/80 cv:py-8 cv:sm:py-10 cv:mb-8">
	<div class="cv:max-w-7xl cv:mx-auto cv:px-4 cv:sm:px-6 cv:lg:px-8">
		<nav class="cv:flex cv:items-center cv:gap-2 cv:text-xs cv:font-medium cv:text-gray-400 cv:mb-2" aria-label="Breadcrumb">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="cv:hover:text-primary cv:transition-colors"><?php esc_html_e( 'Home', 'cartvai' ); ?></a>
			<span>/</span>
			<span class="cv:text-gray-700"><?php esc_html_e( 'Archive', 'cartvai' ); ?></span>
		</nav>
		<h1 class="cv:text-2xl cv:sm:text-3xl cv:font-black cv:text-gray-950 cv:tracking-tight cv:leading-tight">
			<?php the_archive_title(); ?>
		</h1>
		<?php if ( get_the_archive_description() ) : ?>
			<div class="cv:text-sm cv:text-gray-600 cv:mt-2 cv:max-w-2xl">
				<?php the_archive_description(); ?>
			</div>
		<?php endif; ?>
	</div>
</div>

<div class="cv:max-w-7xl cv:mx-auto cv:px-4 cv:sm:px-6 cv:lg:px-8 cv:pb-16">
	<?php if ( have_posts() ) : ?>
		<div class="cv:grid cv:grid-cols-1 cv:md:grid-cols-2 cv:lg:grid-cols-3 cv:gap-8">
			<?php
			while ( have_posts() ) :
				the_post();
				?>
				<article id="post-<?php the_ID(); ?>" <?php post_class( 'cv:bg-white cv:rounded-2xl cv:border cv:border-gray-100 cv:overflow-hidden cv:shadow-xs cv:hover:shadow-md cv:transition-all cv:flex cv:flex-col' ); ?>>
					<?php if ( has_post_thumbnail() ) : ?>
						<div class="cv:aspect-video cv:overflow-hidden cv:bg-gray-100">
							<a href="<?php the_permalink(); ?>">
								<?php the_post_thumbnail( 'medium_large', array( 'class' => 'cv:w-full cv:h-full cv:object-cover' ) ); ?>
							</a>
						</div>
					<?php endif; ?>

					<div class="cv:p-6 cv:flex cv:flex-col cv:flex-grow">
						<div class="cv:flex cv:items-center cv:gap-3 cv:text-xs cv:text-gray-500 cv:mb-3">
							<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
							<span>&bull;</span>
							<span><?php the_author(); ?></span>
						</div>

						<h2 class="cv:text-lg cv:font-bold cv:text-gray-900 cv:mb-2 cv:line-clamp-2">
							<a href="<?php the_permalink(); ?>" class="cv:hover:text-primary cv:transition-colors">
								<?php the_title(); ?>
							</a>
						</h2>

						<div class="cv:text-gray-600 cv:text-sm cv:line-clamp-3 cv:mb-4 cv:flex-grow">
							<?php the_excerpt(); ?>
						</div>

						<div class="cv:pt-4 cv:border-t cv:border-gray-50 cv:mt-auto">
							<a href="<?php the_permalink(); ?>" class="cv:inline-flex cv:items-center cv:gap-1.5 cv:text-xs cv:font-bold cv:text-primary cv:hover:text-primary-hover">
								<span><?php esc_html_e( 'Read More', 'cartvai' ); ?></span>
								<svg class="cv:w-3.5 cv:h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
							</a>
						</div>
					</div>
				</article>
				<?php
			endwhile;
			?>
		</div>

		<div class="cv:mt-12 cv:flex cv:justify-center">
			<?php the_posts_pagination(); ?>
		</div>
	<?php else : ?>
		<div class="cv:bg-white cv:rounded-2xl cv:border cv:border-gray-100 cv:p-12 cv:text-center cv:max-w-md cv:mx-auto">
			<p class="cv:text-gray-500"><?php esc_html_e( 'No posts found in this archive.', 'cartvai' ); ?></p>
		</div>
	<?php endif; ?>
</div>

<?php
get_footer();
