<?php
/**
 * Header Cart Action Component
 *
 * Provides a responsive cart toggle button with live count badge.
 * Integrates automatically with Cartvai Mini Cart drawer or links
 * to the cart page if the drawer is not present.
 *
 * @package Cartvai_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$cart_count = class_exists( 'CARTVAI_Cart' ) ? (int) CARTVAI_Cart::get_count() : 0;
$cart_url   = home_url( '/cart/' );
?>
<div class="cartvai-header-cart-slot cv:relative cv:inline-flex cv:items-center">
	<button type="button" id="cartvaiMiniCartTrigger" class="cv-cart-btn cv:relative cv:inline-flex cv:items-center cv:gap-2.5 cv:px-4 cv:py-2.5 cv:rounded-xl cv:bg-gray-50 cv:border cv:border-gray-200/90 cv:hover:bg-white cv:hover:border-primary/50 cv:hover:shadow-xs cv:text-gray-900 cv:text-sm cv:font-semibold cv:transition-all" data-cartvai-mini-cart-toggle aria-label="<?php esc_attr_e( 'Cart', 'cartvai' ); ?>" data-cart-url="<?php echo esc_url( $cart_url ); ?>">
		<svg class="cv:w-5 cv:h-5 cv:text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
			<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
		</svg>
		<span class="cv:hidden cv:sm:inline"><?php esc_html_e( 'Cart', 'cartvai' ); ?></span>
		<span class="cartvai-mini-cart-count-badge cv:inline-flex cv:items-center cv:justify-center cv:min-w-5 cv:h-5 cv:px-1.5 cv:rounded-full cv:bg-primary cv:text-white cv:text-xs cv:font-bold cv:transition-all" data-cartvai-mini-cart-count data-cartvai-count <?php echo $cart_count > 0 ? '' : 'style="display:none;"'; ?>>
			<?php echo esc_html( $cart_count ); ?>
		</span>
	</button>
</div>
