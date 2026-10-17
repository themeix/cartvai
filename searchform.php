<?php
/**
 * The template for displaying search forms
 *
 * Supports:
 * 1. Standard Search Bar (Classic clean input + square icon button)
 * 2. Categorized Search Bar (Clean Input + Category Dropdown + square icon button)
 * 3. Configurable target content (Products, Posts, or All Content)
 *
 * @package Cartvai_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$cartvai_unique_id  = wp_unique_id( 'search-form-' );
$search_style       = function_exists( 'cartvai_theme_option' ) ? cartvai_theme_option( 'search_style', 'categorized' ) : 'categorized';
$search_post_type   = function_exists( 'cartvai_theme_option' ) ? cartvai_theme_option( 'search_post_type', 'cartvai_product' ) : 'cartvai_product';
$ajax_enabled       = function_exists( 'cartvai_theme_option' ) ? (bool) cartvai_theme_option( 'search_ajax_enabled', true ) : true;
$custom_placeholder = function_exists( 'cartvai_theme_option' ) ? cartvai_theme_option( 'search_placeholder', '' ) : '';

if ( ! empty( $custom_placeholder ) ) {
	$cartvai_placeholder = $custom_placeholder;
} else {
	if ( 'post' === $search_post_type ) {
		$cartvai_placeholder = __( 'Search blog posts...', 'cartvai' );
	} elseif ( 'any' === $search_post_type ) {
		$cartvai_placeholder = __( 'Search products, stories...', 'cartvai' );
	} else {
		$cartvai_placeholder = __( 'Search for products...', 'cartvai' );
	}
}

$categories       = ( 'categorized' === $search_style && function_exists( 'cartvai_get_search_categories' ) ) ? cartvai_get_search_categories() : array();
$current_cat_slug = isset( $_GET['product_cat'] ) ? sanitize_text_field( wp_unslash( $_GET['product_cat'] ) ) : ( isset( $_GET['cv_category'] ) ? sanitize_text_field( wp_unslash( $_GET['cv_category'] ) ) : '' );
$current_cat_name = __( 'SELECT CATEGORY', 'cartvai' );

if ( ! empty( $current_cat_slug ) && ! empty( $categories ) ) {
	foreach ( $categories as $cat ) {
		if ( $cat->slug === $current_cat_slug ) {
			$current_cat_name = $cat->name;
			break;
		}
	}
}
?>
<form role="search" method="get" class="cv-search-form cv-megastore-search cv:w-full cv:relative <?php echo 'categorized' === $search_style ? 'cv-search--categorized' : 'cv-search--standard'; ?>" action="<?php echo esc_url( home_url( '/' ) ); ?>" data-cartvai-search-form data-ajax-enabled="<?php echo $ajax_enabled ? '1' : '0'; ?>" data-post-type="<?php echo esc_attr( $search_post_type ); ?>">
	<label class="screen-reader-text" for="<?php echo esc_attr( $cartvai_unique_id ); ?>"><?php esc_html_e( 'Search for:', 'cartvai' ); ?></label>
	
	<?php if ( 'any' !== $search_post_type ) : ?>
		<input type="hidden" name="post_type" value="<?php echo esc_attr( $search_post_type ); ?>" />
	<?php endif; ?>

	<div class="cv-search-input-group cv:relative cv:flex cv:items-center cv:w-full cv:h-11 cv:bg-white cv:rounded-xl cv:border cv:border-gray-200 focus-within:cv:border-primary focus-within:cv:ring-2 focus-within:cv:ring-primary/20 cv:shadow-xs cv:transition-all">
		
		<!-- Main Search Input Field (Generous left padding, clean placeholder) -->
		<input type="search" id="<?php echo esc_attr( $cartvai_unique_id ); ?>" class="cv-search-field cv-megastore-search-input cv:w-full cv:h-full cv:pl-5 cv:pr-3 cv:sm:pl-6 cv:border-0 focus:cv:outline-none focus:cv:ring-0 cv:bg-transparent cv:text-sm cv:font-normal cv:text-gray-900" style="padding-left: 1.35rem;" placeholder="<?php echo esc_attr( $cartvai_placeholder ); ?>" value="<?php echo get_search_query(); ?>" name="s" aria-label="<?php esc_attr_e( 'Search', 'cartvai' ); ?>" autocomplete="off" data-cartvai-search-input />

		<?php if ( 'categorized' === $search_style && ! empty( $categories ) ) : ?>
			<!-- Category Selector Dropdown -->
			<div class="cv-search-cat-dropdown cv:relative cv:hidden cv:sm:flex cv:items-center cv:shrink-0 cv:border-l cv:border-gray-200 cv:h-6 cv:my-auto" data-cartvai-cat-dropdown>
				<input type="hidden" name="product_cat" value="<?php echo esc_attr( $current_cat_slug ); ?>" data-cartvai-cat-input />
				<button type="button" class="cv-search-cat-btn cv:flex cv:items-center cv:gap-1.5 cv:px-3 cv:h-full cv:text-[12px] cv:font-semibold cv:tracking-wide cv:text-gray-600 hover:cv:text-gray-950 cv:bg-transparent cv:border-0 cv:cursor-pointer cv:whitespace-nowrap cv:transition-colors" data-cartvai-cat-toggle aria-expanded="false" aria-haspopup="listbox">
					<span class="cv-search-cat-label cv:text-[12px] cv:max-w-[150px] cv:truncate" data-cartvai-cat-label><?php echo esc_html( $current_cat_name ); ?></span>
					<svg class="cv:w-3.5 cv:h-3.5 cv:text-gray-400 cv:transition-transform cv:duration-200 cv:shrink-0" width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
				</button>

				<!-- Popup category list -->
				<ul class="cv-search-cat-list cv:absolute cv:right-0 cv:top-full cv:mt-2.5 cv:w-56 cv:max-h-64 cv:overflow-y-auto cv:bg-white cv:rounded-xl cv:border cv:border-gray-200/90 cv:shadow-xl cv:py-1.5 cv:z-[1010] cv:hidden cv:list-none cv:p-0 cv:m-0" data-cartvai-cat-list role="listbox">
					<li class="cv-search-cat-item cv:px-3.5 cv:py-2 cv:text-xs cv:font-bold cv:text-gray-700 hover:cv:bg-primary/10 hover:cv:text-primary cv:cursor-pointer cv:transition-colors <?php echo empty( $current_cat_slug ) ? 'cv:bg-primary/5 cv:text-primary' : ''; ?>" data-value="" data-label="<?php esc_attr_e( 'SELECT CATEGORY', 'cartvai' ); ?>" role="option">
						<?php esc_html_e( 'All Categories', 'cartvai' ); ?>
					</li>
					<?php foreach ( $categories as $cat ) : ?>
						<li class="cv-search-cat-item cv:px-3.5 cv:py-2 cv:text-xs cv:font-medium cv:text-gray-700 hover:cv:bg-primary/10 hover:cv:text-primary cv:cursor-pointer cv:transition-colors cv:flex cv:items-center cv:justify-between <?php echo $current_cat_slug === $cat->slug ? 'cv:bg-primary/5 cv:text-primary cv:font-bold' : ''; ?>" data-value="<?php echo esc_attr( $cat->slug ); ?>" data-label="<?php echo esc_attr( $cat->name ); ?>" role="option">
							<span class="cv:truncate"><?php echo esc_html( $cat->name ); ?></span>
							<span class="cv:text-[10px] cv:text-gray-400 cv:ml-2"><?php echo esc_html( $cat->count ); ?></span>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
		<?php endif; ?>

		<!-- Search Submit Button (Square, Balanced 16px Icon with breathing space) -->
		<button type="submit" class="cv-search-submit cv-megastore-search-btn cv:w-9 cv:h-9 cv:min-w-[36px] cv:min-h-[36px] cv:aspect-square cv:flex cv:items-center cv:justify-center cv:rounded-lg cv:p-0 cv:mr-1.5 cv:text-white cv:bg-primary cv:border-0 hover:cv:bg-primary-hover cv:cursor-pointer cv:transition-all cv:shrink-0" aria-label="<?php esc_attr_e( 'Search', 'cartvai' ); ?>" title="<?php esc_attr_e( 'Search', 'cartvai' ); ?>">
			<svg class="cv-search-icon cv:w-4 cv:h-4 cv:shrink-0" width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
			<svg class="cv-search-spinner cv:w-4 cv:h-4 cv:animate-spin cv:hidden cv:shrink-0 cv:text-white" width="16" height="16" fill="none" viewBox="0 0 24 24"><circle class="cv:opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="3"></circle><path class="cv:opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
		</button>
	</div>

	<!-- AJAX Live Search Dropdown Container -->
	<div class="cv-ajax-search-dropdown cv:absolute cv:left-0 cv:right-0 cv:top-full cv:mt-2 cv:bg-white cv:rounded-2xl cv:border cv:border-gray-200/90 cv:shadow-2xl cv:z-[1000] cv:overflow-hidden cv:hidden" data-cartvai-search-dropdown></div>
</form>
