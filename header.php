<?php
/**
 * The header for Cartvai Base Theme
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
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<?php if ( is_front_page() || is_page( 'home-cv' ) ) : ?>
	<link rel="preload" as="image" href="<?php echo esc_url( get_template_directory_uri() . '/assets/images/hero-headphones.svg' ); ?>" type="image/svg+xml" fetchpriority="high">
	<?php elseif ( is_singular( 'cartvai_product' ) && has_post_thumbnail() ) : ?>
	<link rel="preload" as="image" href="<?php echo esc_url( get_the_post_thumbnail_url( get_the_ID(), 'full' ) ); ?>" fetchpriority="high">
	<?php endif; ?>
	<?php
	$meta_description = '';
	if ( is_singular() ) {
		$excerpt = get_the_excerpt();
		if ( ! empty( $excerpt ) ) {
			$meta_description = wp_strip_all_tags( $excerpt );
		}
	} elseif ( is_tax() || is_category() || is_tag() ) {
		$term_desc = term_description();
		if ( ! empty( $term_desc ) ) {
			$meta_description = wp_strip_all_tags( $term_desc );
		}
	}
	if ( empty( $meta_description ) ) {
		$meta_description = get_bloginfo( 'description', 'display' );
	}
	if ( empty( $meta_description ) ) {
		$meta_description = sprintf(
			/* translators: %s: site name */
			esc_html__( 'Discover top quality products and fast shipping at %s.', 'cartvai' ),
			get_bloginfo( 'name' )
		);
	}
	?>
	<meta name="description" content="<?php echo esc_attr( $meta_description ); ?>">
	<?php wp_head(); ?>
</head>
<body <?php body_class( 'cv-antialiased cv:bg-gray-50 cv:text-gray-900' ); ?>>
<?php wp_body_open(); ?>

<div id="page" class="cv-site cv:min-h-screen cv:flex cv:flex-col">
	<a class="skip-link screen-reader-text cv:sr-only cv:focus:not-sr-only cv:focus:fixed cv:focus:top-4 cv:focus:left-4 cv:focus:z-[999999] cv:focus:p-4 cv:focus:bg-white cv:focus:text-gray-900 cv:focus:rounded-xl cv:focus:shadow-2xl cv:focus:font-bold cv:focus:outline-2 cv:focus:outline-primary" href="#primary">
		<?php esc_html_e( 'Skip to content', 'cartvai' ); ?>
	</a>

	<?php
	$header_style = function_exists( 'cartvai_get_header_style' ) ? cartvai_get_header_style() : 'ecommerce';
	get_template_part( 'template-parts/header/' . $header_style );
	get_template_part( 'template-parts/components/mobile-menu' );
	?>

	<main id="primary" class="cv-site-main cv:flex-grow">
