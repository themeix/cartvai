<?php
/**
 * Cartvai Base Theme Override: Product Grid
 *
 * Implements an ecommerce responsive product grid using Tailwind CSS v4.
 *
 * Available variables:
 * - $products (array) Array of decorated Cartvai product objects
 * - $args     (array) Grid arguments
 *
 * @package Cartvai_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$columns = ! empty( $args['columns'] ) ? absint( $args['columns'] ) : 4;

// Map columns to Tailwind responsive grid classes
$col_classes = array(
	1 => 'cv:grid-cols-1',
	2 => 'cv:grid-cols-1 cv:sm:grid-cols-2',
	3 => 'cv:grid-cols-1 cv:sm:grid-cols-2 cv:lg:grid-cols-3',
	4 => 'cv:grid-cols-1 cv:sm:grid-cols-2 cv:md:grid-cols-3 cv:lg:grid-cols-4',
	5 => 'cv:grid-cols-1 cv:sm:grid-cols-2 cv:md:grid-cols-3 cv:lg:grid-cols-5',
	6 => 'cv:grid-cols-2 cv:sm:grid-cols-3 cv:md:grid-cols-4 cv:lg:grid-cols-6',
);

$grid_cols = isset( $col_classes[ $columns ] ) ? $col_classes[ $columns ] : $col_classes[4];
$grid_class = ! empty( $args['grid_class'] ) ? esc_attr( $args['grid_class'] ) : '';
?>
<div class="cv-products-grid cv:grid <?php echo esc_attr( $grid_cols ); ?> cv:gap-6 <?php echo esc_attr( $grid_class ); ?>">
	<?php if ( ! empty( $products ) && is_array( $products ) ) : ?>
		<?php foreach ( $products as $product ) : ?>
			<?php
			// Delegate rendering of each card to the rendering API to honor card overrides/hooks
			// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			echo cartvai_render_product_card( $product, $args );
			?>
		<?php endforeach; ?>
	<?php else : ?>
		<div class="cv:col-span-full cv:py-16 cv:text-center cv:text-gray-500">
			<svg class="cv:mx-auto cv:h-12 cv:w-12 cv:text-gray-400 cv:mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
			</svg>
			<p class="cv:text-base cv:font-medium"><?php esc_html_e( 'No products found.', 'cartvai-theme' ); ?></p>
		</div>
	<?php endif; ?>
</div>
