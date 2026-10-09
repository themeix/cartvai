<?php
/**
 * Template Name: Marketing: Contained (With Header/Footer, With Container)
 * Template Post Type: page
 *
 * Contained marketing page with standard store header and footer, but without
 * an automated title banner, giving marketers full layout freedom inside a standard max-w-7xl grid.
 *
 * @package Cartvai_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<main id="primary" class="cv-marketing-contained cv:w-full cv:py-8 cv:sm:py-12">
	<div class="cv:max-w-7xl cv:mx-auto cv:px-4 cv:sm:px-6 cv:lg:px-8">
		<?php
		while ( have_posts() ) :
			the_post();
			the_content();
		endwhile;
		?>
	</div>
</main>

<?php
get_footer();
