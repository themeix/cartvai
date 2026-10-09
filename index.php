<?php
/**
 * Main index template
 *
 * @package Cartvai_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<div class="cv:max-w-7xl cv:mx-auto cv:px-4 cv:sm:px-6 cv:lg:px-8 cv:py-12">
	<?php if ( have_posts() ) : ?>
		<div class="cv:grid cv:grid-cols-1 cv:md:grid-cols-2 cv:lg:grid-cols-3 cv:gap-8">
			<?php
			while ( have_posts() ) :
				the_post();
				?>
				<article id="post-<?php the_ID(); ?>" <?php post_class( 'cv:bg-white cv:rounded-xl cv:border cv:border-gray-200 cv:overflow-hidden cv:shadow-sm hover:cv:shadow-md cv:transition' ); ?>>
					<?php if ( has_post_thumbnail() ) : ?>
						<div class="cv:aspect-video cv:overflow-hidden cv:bg-gray-100">
							<a href="<?php the_permalink(); ?>">
								<?php the_post_thumbnail( 'medium_large', array( 'class' => 'cv:w-full cv:h-full cv:object-cover' ) ); ?>
							</a>
						</div>
					<?php endif; ?>

					<div class="cv:p-6">
						<h2 class="cv:text-xl cv:font-semibold cv:text-gray-900 cv:mb-2">
							<a href="<?php the_permalink(); ?>" class="hover:cv:text-primary">
								<?php the_title(); ?>
							</a>
						</h2>
						<div class="cv:text-sm cv:text-gray-500 cv:mb-4">
							<?php echo esc_html( get_the_date() ); ?>
						</div>
						<div class="cv:text-gray-600 cv:text-sm cv:line-clamp-3">
							<?php the_excerpt(); ?>
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
		<p class="cv:text-gray-500"><?php esc_html_e( 'No posts found.', 'cartvai-theme' ); ?></p>
	<?php endif; ?>
</div>

<?php
get_footer();
