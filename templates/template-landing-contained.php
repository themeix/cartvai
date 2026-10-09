<?php
/**
 * Template Name: Landing Page: Contained (No Header/Footer, With Container)
 * Template Post Type: page
 *
 * Clean distraction-free contained page without header or footer.
 * Ideal for lead generation, opt-in forms, webinar registration, and minimal checkout funnels.
 *
 * @package Cartvai_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>
<body <?php body_class( 'cv-landing-contained cv:bg-gray-50 cv:text-gray-900 cv-antialiased' ); ?>>
<?php wp_body_open(); ?>

<main id="primary" class="cv-landing-contained-main cv:min-h-screen cv:flex cv:flex-col cv:justify-center cv:py-10 cv:sm:py-16">
	<div class="cv:max-w-7xl cv:mx-auto cv:w-full cv:px-4 cv:sm:px-6 cv:lg:px-8">
		<?php
		while ( have_posts() ) :
			the_post();
			the_content();
		endwhile;
		?>
	</div>
</main>

<?php wp_footer(); ?>
</body>
</html>
