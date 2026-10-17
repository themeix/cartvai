<?php
/**
 * Cartvai Sticky Buy Bar Block - Dynamic Template
 *
 * @package Cartvai_Theme
 * @var array $attributes Block attributes.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$title       = isset( $attributes['productTitle'] ) ? sanitize_text_field( $attributes['productTitle'] ) : 'Special Flash Deal';
$price       = isset( $attributes['price'] ) ? sanitize_text_field( $attributes['price'] ) : '$49.00';
$regular     = isset( $attributes['regularPrice'] ) ? sanitize_text_field( $attributes['regularPrice'] ) : '';
$badge       = isset( $attributes['badge'] ) ? sanitize_text_field( $attributes['badge'] ) : 'In Stock • Ships Today';
$btn_text    = isset( $attributes['buttonText'] ) ? sanitize_text_field( $attributes['buttonText'] ) : 'Order Now (Cash on Delivery)';
$btn_url     = isset( $attributes['buttonUrl'] ) && ! empty( $attributes['buttonUrl'] ) ? esc_url( $attributes['buttonUrl'] ) : '#';
$visibility  = isset( $attributes['visibility'] ) ? sanitize_key( $attributes['visibility'] ) : 'mobile-only';

$custom_bg_color    = ! empty( $attributes['customBgColor'] ) ? sanitize_hex_color( $attributes['customBgColor'] ) : '';
$custom_badge_color = ! empty( $attributes['customBadgeColor'] ) ? sanitize_hex_color( $attributes['customBadgeColor'] ) : '';
$custom_price_color = ! empty( $attributes['customPriceColor'] ) ? sanitize_hex_color( $attributes['customPriceColor'] ) : ( ! empty( $attributes['customTextColor'] ) ? sanitize_hex_color( $attributes['customTextColor'] ) : '' );
$custom_btn_bg      = ! empty( $attributes['customBtnBgColor'] ) ? sanitize_hex_color( $attributes['customBtnBgColor'] ) : '';
$custom_btn_text    = ! empty( $attributes['customBtnTextColor'] ) ? sanitize_hex_color( $attributes['customBtnTextColor'] ) : '';

$show_border         = isset( $attributes['showBorder'] ) ? (bool) $attributes['showBorder'] : true;
$custom_border_color = isset( $attributes['customBorderColor'] ) ? sanitize_text_field( $attributes['customBorderColor'] ) : '';
$border_width        = isset( $attributes['borderWidth'] ) ? sanitize_text_field( $attributes['borderWidth'] ) : '1px';
$box_shadow          = isset( $attributes['boxShadow'] ) ? sanitize_key( $attributes['boxShadow'] ) : 'none';

$bar_styles = array();
if ( $custom_bg_color ) {
	$bar_styles[] = 'background-color: ' . $custom_bg_color . ' !important';
}

if ( ! $show_border ) {
	$bar_styles[] = 'border-top: none !important';
} else {
	$bar_border_color = ! empty( $custom_border_color ) ? $custom_border_color : 'var(--cartvai-border, #e2e8f0)';
	$bar_styles[]     = 'border-top-width: ' . esc_attr( $border_width ) . ' !important; border-top-style: solid !important; border-top-color: ' . esc_attr( $bar_border_color ) . ' !important';
}

$shadow_map = array(
	'none' => 'none',
	'sm'   => '0 -1px 2px 0 rgba(0, 0, 0, 0.05)',
	'md'   => '0 -4px 6px -1px rgba(0, 0, 0, 0.07)',
	'lg'   => '0 -10px 15px -3px rgba(0, 0, 0, 0.08)',
	'xl'   => '0 -20px 25px -5px rgba(0, 0, 0, 0.08)',
	'2xl'  => '0 -25px 50px -12px rgba(0, 0, 0, 0.15)',
);
$shadow_val   = isset( $shadow_map[ $box_shadow ] ) ? $shadow_map[ $box_shadow ] : 'none';
$bar_styles[] = 'box-shadow: ' . $shadow_val . ' !important';

$bar_style_attr = ! empty( $bar_styles ) ? ' style="' . esc_attr( implode( '; ', $bar_styles ) ) . '"' : '';

$btn_styles = array();
if ( $custom_btn_bg ) {
	$btn_styles[] = 'background-color: ' . $custom_btn_bg . ' !important';
}
if ( $custom_btn_text ) {
	$btn_styles[] = 'color: ' . $custom_btn_text . ' !important';
}
$btn_style_attr = ! empty( $btn_styles ) ? ' style="' . esc_attr( implode( '; ', $btn_styles ) ) . '"' : '';

$badge_style_attr = $custom_badge_color ? ' style="color: ' . esc_attr( $custom_badge_color ) . ';"' : '';
$price_style_attr = $custom_price_color ? ' style="color: ' . esc_attr( $custom_price_color ) . ';"' : '';

$display_class = ( 'mobile-only' === $visibility ) ? 'cv:flex cv:md:hidden' : 'cv:flex';
?>

<div class="cartvai-sticky-buy-bar cv:fixed cv:bottom-0 cv:inset-x-0 cv:z-50 cv:bg-white/95 cv:backdrop-blur-md cv:border-t cv:py-3 cv:px-4 <?php echo esc_attr( $display_class ); ?> cv:items-center cv:justify-between cv:gap-3"<?php echo $bar_style_attr; ?>>
	<div class="cv:min-w-0 cv:flex-1">
		<?php if ( ! empty( $badge ) ) : ?>
			<div class="cv:flex cv:items-center cv:gap-1.5 cv:text-[11px] cv:font-semibold cv:text-emerald-600 cv:leading-none cv:mb-1"<?php echo $badge_style_attr; ?>>
				<span class="cv:w-1.5 cv:h-1.5 cv:rounded-full cv:bg-emerald-500 cv:animate-pulse"<?php if ( $custom_badge_color ) echo ' style="background-color: ' . esc_attr( $custom_badge_color ) . ';"'; ?>></span>
				<span class="cv:truncate"><?php echo esc_html( $badge ); ?></span>
			</div>
		<?php endif; ?>
		<div class="cv:flex cv:items-baseline cv:gap-2">
			<span class="cv:text-lg cv:sm:text-xl cv:font-black cv:text-slate-900 cv:leading-none"<?php echo $price_style_attr; ?>><?php echo esc_html( $price ); ?></span>
			<?php if ( ! empty( $regular ) ) : ?>
				<span class="cv:text-xs cv:text-slate-400 cv:line-through cv:leading-none"><?php echo esc_html( $regular ); ?></span>
			<?php endif; ?>
		</div>
	</div>

	<div class="cv:shrink-0">
		<a href="<?php echo $btn_url; ?>" class="cv:inline-flex cv:items-center cv:gap-2 cv:px-5 cv:py-3 cv:rounded-xl cv:font-bold cv:text-sm cv:bg-blue-600 cv:text-white cv:hover:bg-blue-700 cv:shadow-lg cv:shadow-blue-600/30 cv:active:scale-95 cv:transition-all"<?php echo $btn_style_attr; ?>>
			<span><?php echo esc_html( $btn_text ); ?></span>
			<svg class="cv:w-4 cv:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
		</a>
	</div>
</div>
