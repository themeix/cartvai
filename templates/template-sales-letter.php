<?php
/**
 * Template Name: Marketing: Sales Letter / Long-Form (Narrow Container)
 * Template Post Type: page
 *
 * Focused, narrow reading layout (max-w-3xl) with store header and footer.
 * Perfect for long-form sales copy, advertorials, product stories, and high-converting manifestos.
 *
 * @package Cartvai_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<main id="primary" class="cv-sales-letter cv:w-full cv:py-10 cv:sm:py-16">
	<div class="cv:max-w-3xl cv:mx-auto cv:px-4 cv:sm:px-6">
		<article id="post-<?php the_ID(); ?>" <?php post_class( 'cv-entry' ); ?>>
			<div class="cv-entry__content cv:text-gray-800 cv:text-lg cv:leading-relaxed">
				<?php
				while ( have_posts() ) :
					the_post();
					the_content();
				endwhile;
				?>
			</div>
		</article>
	</div>
</main>

<?php
get_footer();
