<?php
/**
 * Cartvai Pricing Tiers Block - Dynamic Template
 *
 * @package Cartvai_Theme
 * @var array $attributes Block attributes.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$heading    = isset( $attributes['heading'] ) ? wp_kses_post( $attributes['heading'] ) : 'Choose Your Package';
$subheading = isset( $attributes['subheading'] ) ? wp_kses_post( $attributes['subheading'] ) : '';

$tiers = array(
	1 => array(
		'title'        => isset( $attributes['t1Title'] ) ? sanitize_text_field( $attributes['t1Title'] ) : 'Starter Pack (1 Pc)',
		'price'        => isset( $attributes['t1Price'] ) ? sanitize_text_field( $attributes['t1Price'] ) : '$49',
		'regular'      => isset( $attributes['t1RegularPrice'] ) ? sanitize_text_field( $attributes['t1RegularPrice'] ) : '$79',
		'badge'        => isset( $attributes['t1Badge'] ) ? sanitize_text_field( $attributes['t1Badge'] ) : '',
		'features'     => isset( $attributes['t1Features'] ) ? explode( "\n", trim( $attributes['t1Features'] ) ) : array(),
		'btn_text'     => isset( $attributes['t1BtnText'] ) ? sanitize_text_field( $attributes['t1BtnText'] ) : 'Buy 1 Unit',
		'btn_url'      => isset( $attributes['t1BtnUrl'] ) && ! empty( $attributes['t1BtnUrl'] ) ? esc_url( $attributes['t1BtnUrl'] ) : '#',
		'is_featured'  => false,
	),
	2 => array(
		'title'        => isset( $attributes['t2Title'] ) ? sanitize_text_field( $attributes['t2Title'] ) : 'Double Pack (2 Pcs)',
		'price'        => isset( $attributes['t2Price'] ) ? sanitize_text_field( $attributes['t2Price'] ) : '$79',
		'regular'      => isset( $attributes['t2RegularPrice'] ) ? sanitize_text_field( $attributes['t2RegularPrice'] ) : '$158',
		'badge'        => isset( $attributes['t2Badge'] ) ? sanitize_text_field( $attributes['t2Badge'] ) : 'MOST POPULAR - SAVE 50%',
		'features'     => isset( $attributes['t2Features'] ) ? explode( "\n", trim( $attributes['t2Features'] ) ) : array(),
		'btn_text'     => isset( $attributes['t2BtnText'] ) ? sanitize_text_field( $attributes['t2BtnText'] ) : 'Order Popular Pack',
		'btn_url'      => isset( $attributes['t2BtnUrl'] ) && ! empty( $attributes['t2BtnUrl'] ) ? esc_url( $attributes['t2BtnUrl'] ) : '#',
		'is_featured'  => true,
	),
	3 => array(
		'title'        => isset( $attributes['t3Title'] ) ? sanitize_text_field( $attributes['t3Title'] ) : 'Family Mega Pack (3 Pcs)',
		'price'        => isset( $attributes['t3Price'] ) ? sanitize_text_field( $attributes['t3Price'] ) : '$109',
		'regular'      => isset( $attributes['t3RegularPrice'] ) ? sanitize_text_field( $attributes['t3RegularPrice'] ) : '$237',
		'badge'        => isset( $attributes['t3Badge'] ) ? sanitize_text_field( $attributes['t3Badge'] ) : 'BEST VALUE - SAVE 60%',
		'features'     => isset( $attributes['t3Features'] ) ? explode( "\n", trim( $attributes['t3Features'] ) ) : array(),
		'btn_text'     => isset( $attributes['t3BtnText'] ) ? sanitize_text_field( $attributes['t3BtnText'] ) : 'Get Family Pack',
		'btn_url'      => isset( $attributes['t3BtnUrl'] ) && ! empty( $attributes['t3BtnUrl'] ) ? esc_url( $attributes['t3BtnUrl'] ) : '#',
		'is_featured'  => false,
	),
);

$custom_heading_color    = isset( $attributes['customHeadingColor'] ) ? sanitize_text_field( $attributes['customHeadingColor'] ) : '';
$custom_subheading_color = isset( $attributes['customSubheadingColor'] ) ? sanitize_text_field( $attributes['customSubheadingColor'] ) : '';
$custom_highlight_color  = isset( $attributes['customHighlightColor'] ) ? sanitize_text_field( $attributes['customHighlightColor'] ) : '';
$custom_bg_color         = isset( $attributes['customBgColor'] ) ? sanitize_text_field( $attributes['customBgColor'] ) : '';
$custom_title_color      = isset( $attributes['customTitleColor'] ) ? sanitize_text_field( $attributes['customTitleColor'] ) : '';
$custom_price_color      = isset( $attributes['customPriceColor'] ) ? sanitize_text_field( $attributes['customPriceColor'] ) : '';
$custom_text_color       = isset( $attributes['customTextColor'] ) ? sanitize_text_field( $attributes['customTextColor'] ) : '';
$custom_btn_text_color   = isset( $attributes['customBtnTextColor'] ) ? sanitize_text_field( $attributes['customBtnTextColor'] ) : '';

$heading_style_attr    = ! empty( $custom_heading_color ) ? 'style="color: ' . esc_attr( $custom_heading_color ) . ' !important;"' : '';
$subheading_style_attr = ! empty( $custom_subheading_color ) ? 'style="color: ' . esc_attr( $custom_subheading_color ) . ' !important;"' : '';
$tier_title_style_attr = ! empty( $custom_title_color ) ? 'style="color: ' . esc_attr( $custom_title_color ) . ' !important;"' : '';
$tier_price_style_attr = ! empty( $custom_price_color ) ? 'style="color: ' . esc_attr( $custom_price_color ) . ' !important;"' : '';
$tier_text_style_attr  = ! empty( $custom_text_color ) ? 'style="color: ' . esc_attr( $custom_text_color ) . ' !important;"' : '';

$border_shadow = function_exists( 'cartvai_get_block_border_shadow' )
	? cartvai_get_block_border_shadow( $attributes, array( 'borderRadius' => 'rounded-3xl' ) )
	: array(
		'style'        => 'border-color: var(--cartvai-border, #e2e8f0) !important; box-shadow: none !important;',
		'radius_class' => 'cv:rounded-3xl',
		'show_border'  => true,
	);
?>

<div class="cartvai-pricing-tiers-wrap cv:max-w-7xl cv:mx-auto cv:px-4 cv:sm:px-6 cv:lg:px-8 cv:my-12">
	<div class="cv:text-center cv:max-w-2xl cv:mx-auto cv:mb-12">
		<h2 class="cv:text-3xl cv:sm:text-4xl cv:font-extrabold cv:tracking-tight cv:text-slate-900 cv:mb-3" <?php echo $heading_style_attr; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
			<?php echo $heading; ?>
		</h2>
		<?php if ( ! empty( $subheading ) ) : ?>
			<p class="cv:text-base cv:text-slate-600" <?php echo $subheading_style_attr; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
				<?php echo $subheading; ?>
			</p>
		<?php endif; ?>
	</div>

	<div class="cv:grid cv:grid-cols-1 cv:lg:grid-cols-3 cv:gap-8 cv:items-center">
		<?php foreach ( $tiers as $tier ) : ?>
			<?php
			$is_feat    = $tier['is_featured'];
			$card_wrap  = $is_feat
				? 'cv:relative ' . esc_attr( $border_shadow['radius_class'] ) . ' cv:bg-white cv:p-8 cv:sm:p-10 cv:lg:scale-105 cv:z-10 cv:transition-all'
				: 'cv:relative ' . esc_attr( $border_shadow['radius_class'] ) . ' cv:bg-white cv:p-8 cv:transition-all';
			$btn_class  = $is_feat
				? 'cv:bg-blue-600 cv:text-white cv:hover:bg-blue-700'
				: 'cv:bg-slate-900 cv:text-white cv:hover:bg-slate-800';

			$card_style = $border_shadow['style'];
			if ( $is_feat ) {
				$highlight_bdr = ! empty( $custom_highlight_color ) ? $custom_highlight_color : 'var(--cartvai-primary, #2563eb)';
				$card_style .= ' border-color: ' . esc_attr( $highlight_bdr ) . ' !important; border-width: 2px !important;';
			}
			if ( ! empty( $custom_bg_color ) ) {
				$card_style .= ' background-color: ' . esc_attr( $custom_bg_color ) . ' !important;';
			}
			$card_style_attr = ! empty( $card_style ) ? 'style="' . esc_attr( trim( $card_style ) ) . '"' : '';

			$badge_style_attr = ( $is_feat && ! empty( $custom_highlight_color ) )
				? 'style="background-color: ' . esc_attr( $custom_highlight_color ) . ' !important;"'
				: '';

			$btn_style = '';
			if ( $is_feat && ! empty( $custom_highlight_color ) ) {
				$btn_style .= 'background-color: ' . esc_attr( $custom_highlight_color ) . ' !important;';
			}
			if ( ! empty( $custom_btn_text_color ) ) {
				$btn_style .= 'color: ' . esc_attr( $custom_btn_text_color ) . ' !important;';
			}
			$btn_style_attr = ! empty( $btn_style ) ? 'style="' . $btn_style . '"' : '';
			?>
			<div class="<?php echo esc_attr( $card_wrap ); ?>" <?php echo $card_style_attr; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
				<?php if ( ! empty( $tier['badge'] ) ) : ?>
					<div class="cv:absolute cv:-top-3.5 cv:left-1/2 cv:-translate-x-1/2 cv:px-4 cv:py-1 cv:rounded-full cv:text-xs cv:font-bold cv:tracking-wider cv:uppercase <?php echo $is_feat ? 'cv:bg-blue-600 cv:text-white' : 'cv:bg-slate-900 cv:text-white'; ?>" <?php echo $badge_style_attr; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
						<?php echo esc_html( $tier['badge'] ); ?>
					</div>
				<?php endif; ?>

				<div class="cv:text-center cv:pb-6 cv:border-b cv:border-slate-100">
					<h3 class="cv:text-xl cv:font-bold cv:text-slate-900 cv:mb-3" <?php echo $tier_title_style_attr; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>><?php echo esc_html( $tier['title'] ); ?></h3>
					<div class="cv:flex cv:items-baseline cv:justify-center cv:gap-2">
						<span class="cv:text-4xl cv:sm:text-5xl cv:font-black cv:tracking-tight cv:text-slate-900" <?php echo $tier_price_style_attr; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>><?php echo esc_html( $tier['price'] ); ?></span>
						<?php if ( ! empty( $tier['regular'] ) ) : ?>
							<span class="cv:text-lg cv:text-slate-400 cv:line-through"><?php echo esc_html( $tier['regular'] ); ?></span>
						<?php endif; ?>
					</div>
				</div>

				<ul class="cv:py-6 cv:space-y-3.5 cv:text-sm cv:text-slate-600" <?php echo $tier_text_style_attr; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
					<?php foreach ( $tier['features'] as $feature ) : ?>
						<?php if ( ! empty( trim( $feature ) ) ) : ?>
							<li class="cv:flex cv:items-start cv:gap-3">
								<svg class="cv:w-5 cv:h-5 cv:text-emerald-500 cv:shrink-0 cv:mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
								<span><?php echo esc_html( trim( $feature ) ); ?></span>
							</li>
						<?php endif; ?>
					<?php endforeach; ?>
				</ul>

				<div class="cv:pt-2">
					<a href="<?php echo $tier['btn_url']; ?>" class="cv:w-full cv:inline-flex cv:items-center cv:justify-center cv:gap-2 cv:py-3.5 cv:px-6 cv:rounded-xl cv:font-bold cv:text-base cv:transition-all cv:duration-200 <?php echo esc_attr( $btn_class ); ?>" <?php echo $btn_style_attr; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
						<span><?php echo esc_html( $tier['btn_text'] ); ?></span>
						<svg class="cv:w-4 cv:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
					</a>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</div>
