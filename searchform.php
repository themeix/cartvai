<?php
/**
 * The template for displaying search forms
 *
 * @package Cartvai
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$cartvai_unique_id  = wp_unique_id( 'search-form-' );
$cartvai_aria_label = ! empty( $args['aria_label'] ) ? $args['aria_label'] : sprintf( /* translators: %s: site name */ __( 'Search in %s...', 'cartvai' ), get_bloginfo( 'name' ) );
?>
<form role="search" method="get" class="cv-search-form cv-megastore-search cv:w-full cv:relative" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label class="screen-reader-text" for="<?php echo esc_attr( $cartvai_unique_id ); ?>"><?php esc_html_e( 'Search for:', 'cartvai' ); ?></label>
	<input type="hidden" name="post_type" value="cartvai_product" />
	<div class="cv:relative cv:flex cv:items-center">
		<span class="cv:absolute cv:left-4 cv:text-gray-400 cv:pointer-events-none">
			<svg class="cv:w-4 cv:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
		</span>
		<input type="search" id="<?php echo esc_attr( $cartvai_unique_id ); ?>" class="cv-search-field cv-megastore-search-input cv:w-full cv:h-11 cv:pl-11 cv:pr-24 cv:rounded-xl cv:border cv:border-gray-200 focus:cv:border-primary focus:cv:outline-none focus:cv:ring-2 focus:cv:ring-primary/20 cv:bg-white cv:text-sm cv:font-medium cv:text-gray-900 cv:shadow-xs cv:transition-all" placeholder="<?php echo esc_attr( $cartvai_aria_label ); ?>" value="<?php echo get_search_query(); ?>" name="s" aria-label="<?php esc_attr_e( 'Search products', 'cartvai' ); ?>" />
		<button type="submit" class="cv-search-submit cv-megastore-search-btn cv:absolute cv:right-1.5 cv:h-8 cv:px-3.5 cv:flex cv:items-center cv:justify-center cv:rounded-lg cv:text-xs cv:font-bold cv:text-white cv:bg-primary cv:border-0 hover:cv:bg-primary-hover cv:transition-colors" aria-label="<?php esc_attr_e( 'Search', 'cartvai' ); ?>">
			<?php esc_html_e( 'Search', 'cartvai' ); ?>
		</button>
	</div>
</form>
