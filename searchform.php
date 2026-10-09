<?php
/**
 * The template for displaying search forms
 *
 * @package Cartvai_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$cartvai_unique_id  = wp_unique_id( 'search-form-' );
$cartvai_aria_label = ! empty( $args['aria_label'] ) ? $args['aria_label'] : __( 'Search products, brands, categories...', 'cartvai-theme' );
?>
<form role="search" method="get" class="cv-search-form cv:w-full cv:relative" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label class="screen-reader-text" for="<?php echo esc_attr( $cartvai_unique_id ); ?>"><?php esc_html_e( 'Search for:', 'cartvai-theme' ); ?></label>
	<input type="hidden" name="post_type" value="cartvai_product" />
	<div class="cv:relative cv:flex cv:items-center">
		<input type="search" id="<?php echo esc_attr( $cartvai_unique_id ); ?>" class="cv-search-field cv:w-full cv:h-11 cv:pl-4 cv:pr-12 cv:rounded-xl cv:border cv:border-gray-200/90 cv:bg-gray-50/70 hover:cv:bg-white focus:cv:bg-white focus:cv:border-primary focus:cv:outline-none focus:cv:ring-2 focus:cv:ring-primary/15 cv:text-sm cv:text-gray-900 cv:transition-all" placeholder="<?php echo esc_attr( $cartvai_aria_label ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
		<button type="submit" class="cv-search-submit cv:absolute cv:right-1.5 cv:h-8 cv:w-8 cv:flex cv:items-center cv:justify-center cv:rounded-lg cv:bg-gray-900 cv:text-white hover:cv:bg-primary cv:transition-colors cv:shadow-2xs" aria-label="<?php esc_attr_e( 'Search', 'cartvai-theme' ); ?>">
			<svg class="cv:w-4 cv:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
		</button>
	</div>
</form>
