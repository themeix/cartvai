<?php
/**
 * Cartvai Countdown Block - Dynamic Template
 *
 * @package Cartvai_Theme
 * @var array $attributes Block attributes.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$timer_type     = isset( $attributes['timerType'] ) ? sanitize_key( $attributes['timerType'] ) : 'evergreen';
$evergreen_hrs  = isset( $attributes['evergreenHours'] ) ? absint( $attributes['evergreenHours'] ) : 4;
$fixed_date     = isset( $attributes['fixedDate'] ) ? sanitize_text_field( $attributes['fixedDate'] ) : '';
$badge_text     = isset( $attributes['badgeText'] ) ? sanitize_text_field( $attributes['badgeText'] ) : 'LIMITED TIME FLASH DEAL';
$heading        = isset( $attributes['heading'] ) ? wp_kses_post( $attributes['heading'] ) : 'Hurry Up! Special 40% Discount Ends In';
$description    = isset( $attributes['description'] ) ? wp_kses_post( $attributes['description'] ) : '';
$btn_text       = isset( $attributes['buttonText'] ) ? sanitize_text_field( $attributes['buttonText'] ) : 'Claim Discount Now';
$btn_url        = isset( $attributes['buttonUrl'] ) && ! empty( $attributes['buttonUrl'] ) ? esc_url( $attributes['buttonUrl'] ) : '#';
$color_scheme   = isset( $attributes['colorScheme'] ) ? sanitize_key( $attributes['colorScheme'] ) : 'amber';

$custom_bg_color        = isset( $attributes['customBgColor'] ) ? sanitize_text_field( $attributes['customBgColor'] ) : '';
$custom_heading_color   = isset( $attributes['customHeadingColor'] ) ? sanitize_text_field( $attributes['customHeadingColor'] ) : '';
$custom_text_color      = isset( $attributes['customTextColor'] ) ? sanitize_text_field( $attributes['customTextColor'] ) : '';
$custom_card_bg_color   = isset( $attributes['customCardBgColor'] ) ? sanitize_text_field( $attributes['customCardBgColor'] ) : '';
$custom_card_text_color = isset( $attributes['customCardTextColor'] ) ? sanitize_text_field( $attributes['customCardTextColor'] ) : '';
$custom_btn_bg_color    = isset( $attributes['customBtnBgColor'] ) ? sanitize_text_field( $attributes['customBtnBgColor'] ) : '';
$custom_btn_text_color  = isset( $attributes['customBtnTextColor'] ) ? sanitize_text_field( $attributes['customBtnTextColor'] ) : '';

// Theme presets
$theme_classes = 'cv:bg-gradient-to-r cv:from-amber-600 cv:via-orange-600 cv:to-red-600 cv:text-white';
$card_bg       = 'cv:bg-black/30 cv:border cv:border-white/20';
$badge_bg      = 'cv:bg-black/25 cv:text-amber-200 cv:border cv:border-amber-300/40';

if ( 'dark' === $color_scheme ) {
	$theme_classes = 'cv:bg-slate-900 cv:text-white';
	$card_bg       = 'cv:bg-slate-800/80 cv:border cv:border-slate-700';
	$badge_bg      = 'cv:bg-red-500/15 cv:text-red-400 cv:border cv:border-red-500/30';
} elseif ( 'emerald' === $color_scheme ) {
	$theme_classes = 'cv:bg-gradient-to-br cv:from-emerald-950 cv:via-emerald-900 cv:to-teal-950 cv:text-white';
	$card_bg       = 'cv:bg-emerald-800/40 cv:border cv:border-emerald-600/30';
	$badge_bg      = 'cv:bg-emerald-500/20 cv:text-emerald-300 cv:border cv:border-emerald-400/30';
} elseif ( 'primary' === $color_scheme ) {
	$theme_classes = 'cv:bg-gradient-to-r cv:from-blue-600 cv:to-indigo-700 cv:text-white';
	$card_bg       = 'cv:bg-black/20 cv:border cv:border-white/20';
	$badge_bg      = 'cv:bg-white/20 cv:text-white cv:border cv:border-white/30';
}

$border_shadow = function_exists( 'cartvai_get_block_border_shadow' )
	? cartvai_get_block_border_shadow( $attributes, array( 'showBorder' => false, 'borderRadius' => 'rounded-3xl', 'boxShadow' => 'none' ) )
	: array(
		'style'        => 'box-shadow: none !important;',
		'radius_class' => 'cv:rounded-3xl',
		'show_border'  => false,
	);

// Inline styles for custom colors
$box_styles = array();
if ( ! empty( $custom_bg_color ) ) {
	$box_styles[] = 'background: ' . esc_attr( $custom_bg_color ) . ' !important;';
}
if ( ! empty( $border_shadow['style'] ) ) {
	$box_styles[] = $border_shadow['style'];
}
$box_style_attr = ! empty( $box_styles ) ? 'style="' . implode( ' ', $box_styles ) . '"' : '';

$heading_style_attr = ! empty( $custom_heading_color ) ? 'style="color: ' . esc_attr( $custom_heading_color ) . ' !important;"' : '';
$desc_style_attr    = ! empty( $custom_text_color ) ? 'style="color: ' . esc_attr( $custom_text_color ) . ' !important;"' : '';

$card_styles = array();
if ( ! empty( $custom_card_bg_color ) ) {
	$card_styles[] = 'background-color: ' . esc_attr( $custom_card_bg_color ) . ' !important;';
}
if ( ! empty( $custom_card_text_color ) ) {
	$card_styles[] = 'color: ' . esc_attr( $custom_card_text_color ) . ' !important;';
}
$card_style_attr = ! empty( $card_styles ) ? 'style="' . implode( ' ', $card_styles ) . '"' : '';

$btn_styles = array();
if ( ! empty( $custom_btn_bg_color ) ) {
	$btn_styles[] = 'background-color: ' . esc_attr( $custom_btn_bg_color ) . ' !important;';
}
if ( ! empty( $custom_btn_text_color ) ) {
	$btn_styles[] = 'color: ' . esc_attr( $custom_btn_text_color ) . ' !important;';
}
$btn_style_attr = ! empty( $btn_styles ) ? 'style="' . implode( ' ', $btn_styles ) . '"' : '';
?>

<div class="cartvai-countdown-block-wrap cv:max-w-5xl cv:mx-auto cv:px-4 cv:sm:px-6 cv:my-8"
	data-cv-countdown
	data-timer-type="<?php echo esc_attr( $timer_type ); ?>"
	data-evergreen-hours="<?php echo esc_attr( $evergreen_hrs ); ?>"
	data-fixed-date="<?php echo esc_attr( $fixed_date ); ?>">

	<div class="cv:relative cv:overflow-hidden <?php echo esc_attr( $border_shadow['radius_class'] ); ?> cv:p-8 cv:sm:p-12 cv:text-center <?php echo esc_attr( $theme_classes ); ?>" <?php echo $box_style_attr; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
		<div class="cv:relative cv:z-10 cv:max-w-2xl cv:mx-auto">
			<?php if ( ! empty( $badge_text ) ) : ?>
				<div class="cv:mb-4">
					<span class="cv:inline-flex cv:items-center cv:gap-2 cv:px-4 cv:py-1.5 cv:rounded-full cv:text-xs cv:font-bold cv:tracking-wider cv:uppercase <?php echo esc_attr( $badge_bg ); ?>">
						<svg class="cv:w-4 cv:h-4 cv:animate-pulse" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/></svg>
						<?php echo esc_html( $badge_text ); ?>
					</span>
				</div>
			<?php endif; ?>

			<h2 class="cv:text-2xl cv:sm:text-4xl cv:font-extrabold cv:tracking-tight cv:leading-tight cv:mb-3" <?php echo $heading_style_attr; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
				<?php echo $heading; ?>
			</h2>

			<?php if ( ! empty( $description ) ) : ?>
				<p class="cv:text-sm cv:sm:text-base cv:opacity-90 cv:mb-8" <?php echo $desc_style_attr; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
					<?php echo $description; ?>
				</p>
			<?php endif; ?>

			<!-- Timer Digits Grid -->
			<div class="cv:grid cv:grid-cols-4 cv:gap-3 cv:sm:gap-5 cv:max-w-lg cv:mx-auto cv:mb-8">
				<div class="cv:rounded-2xl cv:p-3 cv:sm:p-4 cv:backdrop-blur-md cv:shadow-lg <?php echo esc_attr( $card_bg ); ?>" <?php echo $card_style_attr; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
					<div class="cv:text-2xl cv:sm:text-4xl cv:font-black cv:tracking-tight cv:countdown-days">00</div>
					<div class="cv:text-[10px] cv:sm:text-xs cv:font-semibold cv:uppercase cv:tracking-wider cv:opacity-75 cv:mt-1">Days</div>
				</div>
				<div class="cv:rounded-2xl cv:p-3 cv:sm:p-4 cv:backdrop-blur-md cv:shadow-lg <?php echo esc_attr( $card_bg ); ?>" <?php echo $card_style_attr; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
					<div class="cv:text-2xl cv:sm:text-4xl cv:font-black cv:tracking-tight cv:countdown-hours">03</div>
					<div class="cv:text-[10px] cv:sm:text-xs cv:font-semibold cv:uppercase cv:tracking-wider cv:opacity-75 cv:mt-1">Hours</div>
				</div>
				<div class="cv:rounded-2xl cv:p-3 cv:sm:p-4 cv:backdrop-blur-md cv:shadow-lg <?php echo esc_attr( $card_bg ); ?>" <?php echo $card_style_attr; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
					<div class="cv:text-2xl cv:sm:text-4xl cv:font-black cv:tracking-tight cv:countdown-minutes">45</div>
					<div class="cv:text-[10px] cv:sm:text-xs cv:font-semibold cv:uppercase cv:tracking-wider cv:opacity-75 cv:mt-1">Mins</div>
				</div>
				<div class="cv:rounded-2xl cv:p-3 cv:sm:p-4 cv:backdrop-blur-md cv:shadow-lg <?php echo esc_attr( $card_bg ); ?>" <?php echo $card_style_attr; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
					<div class="cv:text-2xl cv:sm:text-4xl cv:font-black cv:tracking-tight cv:countdown-seconds">20</div>
					<div class="cv:text-[10px] cv:sm:text-xs cv:font-semibold cv:uppercase cv:tracking-wider cv:opacity-75 cv:mt-1">Secs</div>
				</div>
			</div>

			<?php if ( ! empty( $btn_text ) ) : ?>
				<div>
					<a href="<?php echo $btn_url; ?>" class="cv:inline-flex cv:items-center cv:gap-2.5 cv:px-8 cv:py-4 cv:rounded-xl cv:font-extrabold cv:text-base cv:bg-white cv:text-slate-900 cv:hover:bg-slate-100 cv:shadow-2xl cv:hover:-translate-y-0.5 cv:transition-all cv:duration-200" <?php echo $btn_style_attr; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
						<span><?php echo esc_html( $btn_text ); ?></span>
						<svg class="cv:w-5 cv:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
					</a>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>
