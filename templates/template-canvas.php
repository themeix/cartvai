<?php
/**
 * Template Name: Landing Page: Blank Canvas (No Header/Footer, Full Width)
 * Template Post Type: page
 *
 * Ultra-clean edge-to-edge blank canvas without theme header or footer.
 * Perfect for Elementor, Gutenberg block funnels, and custom marketing landing pages.
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
<body <?php body_class( 'cv-canvas cv:bg-white cv:text-gray-900 cv-antialiased' ); ?>>
<?php wp_body_open(); ?>

<main id="primary" class="cv-canvas-main cv:w-full cv:min-h-screen">
	<?php
	while ( have_posts() ) :
		the_post();
		the_content();
	endwhile;
	?>
</main>

<?php wp_footer(); ?>
</body>
</html>
