<?php
/**
 * Cartvai How It Works Block - Dynamic Template
 *
 * @package Cartvai_Theme
 * @var array $attributes Block attributes.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$heading    = isset( $attributes['heading'] ) ? wp_kses_post( $attributes['heading'] ) : 'Simple 3-Step Ordering Process';
$subheading = isset( $attributes['subheading'] ) ? wp_kses_post( $attributes['subheading'] ) : '';

$s1_title = isset( $attributes['s1Title'] ) ? sanitize_text_field( $attributes['s1Title'] ) : 'Select Your Package';
$s1_desc  = isset( $attributes['s1Desc'] ) ? sanitize_text_field( $attributes['s1Desc'] ) : '';

$s2_title = isset( $attributes['s2Title'] ) ? sanitize_text_field( $attributes['s2Title'] ) : 'Fast Express Dispatch';
$s2_desc  = isset( $attributes['s2Desc'] ) ? sanitize_text_field( $attributes['s2Desc'] ) : '';

$s3_title = isset( $attributes['s3Title'] ) ? sanitize_text_field( $attributes['s3Title'] ) : 'Inspect & Pay on Delivery';
$s3_desc  = isset( $attributes['s3Desc'] ) ? sanitize_text_field( $attributes['s3Desc'] ) : '';

$custom_heading_color    = ! empty( $attributes['customHeadingColor'] ) ? sanitize_hex_color( $attributes['customHeadingColor'] ) : '';
$custom_subheading_color = ! empty( $attributes['customSubheadingColor'] ) ? sanitize_hex_color( $attributes['customSubheadingColor'] ) : '';
$custom_bg_color         = ! empty( $attributes['customBgColor'] ) ? sanitize_hex_color( $attributes['customBgColor'] ) : '';
$custom_step_title_color = ! empty( $attributes['customStepTitleColor'] ) ? sanitize_hex_color( $attributes['customStepTitleColor'] ) : '';
$custom_step_desc_color  = ! empty( $attributes['customStepDescColor'] ) ? sanitize_hex_color( $attributes['customStepDescColor'] ) : ( ! empty( $attributes['customTextColor'] ) ? sanitize_hex_color( $attributes['customTextColor'] ) : '' );
$custom_accent_color     = ! empty( $attributes['customAccentColor'] ) ? sanitize_hex_color( $attributes['customAccentColor'] ) : '';

$border_shadow = function_exists( 'cartvai_get_block_border_shadow' )
	? cartvai_get_block_border_shadow( $attributes, array( 'borderRadius' => 'rounded-3xl' ) )
	: array(
		'style'        => 'border-color: var(--cartvai-border, #e2e8f0) !important; box-shadow: none !important;',
		'radius_class' => 'cv:rounded-3xl',
		'show_border'  => true,
	);

$card_style = $border_shadow['style'];
if ( ! empty( $custom_bg_color ) ) {
	$card_style .= ' background-color: ' . esc_attr( $custom_bg_color ) . ' !important;';
}
$card_style_attr = ! empty( $card_style ) ? ' style="' . esc_attr( trim( $card_style ) ) . '"' : '';

$heading_style_attr    = $custom_heading_color ? ' style="color: ' . esc_attr( $custom_heading_color ) . ' !important;"' : '';
$subheading_style_attr = $custom_subheading_color ? ' style="color: ' . esc_attr( $custom_subheading_color ) . ' !important;"' : '';
$badge_style_attr      = $custom_accent_color ? ' style="background-image: none !important; background-color: ' . esc_attr( $custom_accent_color ) . ' !important;"' : '';
$step_title_style_attr = $custom_step_title_color ? ' style="color: ' . esc_attr( $custom_step_title_color ) . ' !important;"' : '';
$step_desc_style_attr  = $custom_step_desc_color ? ' style="color: ' . esc_attr( $custom_step_desc_color ) . ' !important;"' : '';

$steps = array(
	array( 'num' => '01', 'title' => $s1_title, 'desc' => $s1_desc, 'color' => 'cv:from-blue-600 cv:to-indigo-600' ),
	array( 'num' => '02', 'title' => $s2_title, 'desc' => $s2_desc, 'color' => 'cv:from-indigo-600 cv:to-purple-600' ),
	array( 'num' => '03', 'title' => $s3_title, 'desc' => $s3_desc, 'color' => 'cv:from-emerald-600 cv:to-teal-600' ),
);
?>

<div class="cartvai-how-it-works-wrap cv:max-w-7xl cv:mx-auto cv:px-4 cv:sm:px-6 cv:lg:px-8 cv:my-14">
	<div class="cv:text-center cv:max-w-2xl cv:mx-auto cv:mb-12">
		<h2 class="cv:text-3xl cv:sm:text-4xl cv:font-extrabold cv:tracking-tight cv:text-slate-900 cv:mb-3"<?php echo $heading_style_attr; ?>>
			<?php echo $heading; ?>
		</h2>
		<?php if ( ! empty( $subheading ) ) : ?>
			<p class="cv:text-base cv:text-slate-600"<?php echo $subheading_style_attr; ?>>
				<?php echo $subheading; ?>
			</p>
		<?php endif; ?>
	</div>

	<div class="cv:grid cv:grid-cols-1 cv:md:grid-cols-3 cv:gap-8 cv:relative">
		<?php foreach ( $steps as $i => $step ) : ?>
			<div class="cv:relative <?php echo esc_attr( $border_shadow['radius_class'] ); ?> cv:p-8 cv:bg-white cv:transition-all cv:text-center cv:flex cv:flex-col cv:items-center"<?php echo $card_style_attr; ?>>
				<div class="cv:w-16 cv:h-16 cv:rounded-2xl cv:bg-blue-600 cv:bg-gradient-to-br <?php echo esc_attr( $step['color'] ); ?> cv:text-white cv:text-2xl cv:font-black cv:flex cv:items-center cv:justify-center cv:mb-6 cv:ring-4 cv:ring-blue-100"<?php echo $badge_style_attr; ?>>
					<?php echo esc_html( $step['num'] ); ?>
				</div>

				<h3 class="cv:text-xl cv:font-bold cv:text-slate-900 cv:mb-3"<?php echo $step_title_style_attr; ?>>
					<?php echo esc_html( $step['title'] ); ?>
				</h3>

				<p class="cv:text-sm cv:text-slate-600 cv:leading-relaxed"<?php echo $step_desc_style_attr; ?>>
					<?php echo esc_html( $step['desc'] ); ?>
				</p>
			</div>
		<?php endforeach; ?>
	</div>
</div>
