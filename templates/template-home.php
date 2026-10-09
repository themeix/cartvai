<?php
/**
 * Template Name: Homepage (Cartvai)
 * Template Post Type: page
 *
 * @package Cartvai_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<div class="cv-homepage cv:w-full">
	<?php
	while ( have_posts() ) :
		the_post();

		$content = get_the_content();
		if ( ! empty( trim( $content ) ) ) {
			the_content();
		} else {
			get_template_part( 'template-parts/homepage/layout-grocery' );
		}
	endwhile;
	?>
</div>

<?php
get_footer();
