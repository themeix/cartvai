<?php
/**
 * Template Name: Marketing: Full Width (With Header/Footer, Full Width)
 * Template Post Type: page
 *
 * Edge-to-edge full width layout with store header and footer.
 * Perfect for page builders, custom homepages, and promotional landing pages with full-width sections.
 *
 * @package Cartvai_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<main id="primary" class="cv-page-full-width cv:w-full">
	<?php
	while ( have_posts() ) :
		the_post();
		the_content();
	endwhile;
	?>
</main>

<?php
get_footer();
