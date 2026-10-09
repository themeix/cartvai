<?php
/**
 * Title: Cartvai - Featured Categories Showcase
 * Slug: cartvai-theme/categories-showcase
 * Categories: cartvai
 * Description: Clean shelf header with carousel of top ecommerce categories.
 *
 * @package Cartvai_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$shop_url = function_exists( 'cartvai_get_shop_page_url' ) ? cartvai_get_shop_page_url() : home_url( '/shop/' );
?>
<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"1.5rem","bottom":"2rem"}}},"className":"cv-home-section","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide cv-home-section" style="padding-top:1.5rem;padding-bottom:2rem">
	<div class="cv-shelf-header">
		<!-- wp:heading {"level":3,"className":"cv-shelf-title"} -->
		<h3 class="wp-block-heading cv-shelf-title">Featured Categories</h3>
		<!-- /wp:heading -->
		<a href="<?php echo esc_url( $shop_url ); ?>" class="cv-shelf-link">
			<span>View All Categories</span>
			<svg class="cv:w-3.5 cv:h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
		</a>
	</div>

	<!-- wp:shortcode -->
	[cartvai_categories layout="carousel" columns="8" arrows="1"]
	<!-- /wp:shortcode -->
</div>
<!-- /wp:group -->
