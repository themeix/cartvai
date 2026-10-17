<?php
/**
 * Cartvai Trust Badges Block - Dynamic Template
 *
 * @package Cartvai_Theme
 * @var array $attributes Block attributes.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$layout       = isset( $attributes['layout'] ) ? sanitize_key( $attributes['layout'] ) : 'cards';
$color_scheme = isset( $attributes['colorScheme'] ) ? sanitize_key( $attributes['colorScheme'] ) : 'light';

$b1_title = isset( $attributes['b1Title'] ) ? sanitize_text_field( $attributes['b1Title'] ) : 'Free Express Delivery';
$b1_desc  = isset( $attributes['b1Desc'] ) ? sanitize_text_field( $attributes['b1Desc'] ) : 'Fast 2-3 days nationwide doorstep delivery';
$b1_icon  = ! empty( $attributes['b1IconUrl'] ) ? esc_url( $attributes['b1IconUrl'] ) : '';

$b2_title = isset( $attributes['b2Title'] ) ? sanitize_text_field( $attributes['b2Title'] ) : '100% Money-Back';
$b2_desc  = isset( $attributes['b2Desc'] ) ? sanitize_text_field( $attributes['b2Desc'] ) : '30-day hassle-free replacement warranty';
$b2_icon  = ! empty( $attributes['b2IconUrl'] ) ? esc_url( $attributes['b2IconUrl'] ) : '';

$b3_title = isset( $attributes['b3Title'] ) ? sanitize_text_field( $attributes['b3Title'] ) : 'Cash On Delivery';
$b3_desc  = isset( $attributes['b3Desc'] ) ? sanitize_text_field( $attributes['b3Desc'] ) : 'Inspect product before making payment';
$b3_icon  = ! empty( $attributes['b3IconUrl'] ) ? esc_url( $attributes['b3IconUrl'] ) : '';

$b4_title = isset( $attributes['b4Title'] ) ? sanitize_text_field( $attributes['b4Title'] ) : '24/7 Dedicated Care';
$b4_desc  = isset( $attributes['b4Desc'] ) ? sanitize_text_field( $attributes['b4Desc'] ) : 'Friendly instant support via phone or WhatsApp';
$b4_icon  = ! empty( $attributes['b4IconUrl'] ) ? esc_url( $attributes['b4IconUrl'] ) : '';

$badges = array(
	array(
		'title'       => $b1_title,
		'desc'        => $b1_desc,
		'color'       => 'emerald',
		'custom_icon' => $b1_icon,
		'icon'        => '<svg class="cv:w-6 cv:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h2m-6-1a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"/></svg>',
	),
	array(
		'title'       => $b2_title,
		'desc'        => $b2_desc,
		'color'       => 'blue',
		'custom_icon' => $b2_icon,
		'icon'        => '<svg class="cv:w-6 cv:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>',
	),
	array(
		'title'       => $b3_title,
		'desc'        => $b3_desc,
		'color'       => 'amber',
		'custom_icon' => $b3_icon,
		'icon'        => '<svg class="cv:w-6 cv:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>',
	),
	array(
		'title'       => $b4_title,
		'desc'        => $b4_desc,
		'color'       => 'purple',
		'custom_icon' => $b4_icon,
		'icon'        => '<svg class="cv:w-6 cv:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/></svg>',
	),
);

$is_dark = ( 'dark' === $color_scheme );

// Calculate border and shadow
$border_shadow = function_exists( 'cartvai_get_block_border_shadow' )
	? cartvai_get_block_border_shadow( $attributes )
	: array(
		'style'        => 'border-color: var(--cartvai-border, #e2e8f0) !important; box-shadow: none !important;',
		'radius_class' => 'cv:rounded-2xl',
		'show_border'  => true,
	);

$wrapper_bg = $is_dark
	? 'cv:bg-slate-900 cv:text-white'
	: 'cv:bg-white cv:text-slate-900';

$card_classes = $is_dark
	? 'cv:bg-slate-800/60 cv:hover:border-slate-600'
	: 'cv:bg-white cv:hover:bg-slate-50/50';

$custom_bg_color    = isset( $attributes['customBgColor'] ) ? sanitize_text_field( $attributes['customBgColor'] ) : '';
$custom_title_color = isset( $attributes['customTitleColor'] ) ? sanitize_text_field( $attributes['customTitleColor'] ) : '';
$custom_desc_color  = isset( $attributes['customDescColor'] ) ? sanitize_text_field( $attributes['customDescColor'] ) : ( isset( $attributes['customTextColor'] ) ? sanitize_text_field( $attributes['customTextColor'] ) : '' );
$custom_icon_color  = isset( $attributes['customIconColor'] ) ? sanitize_text_field( $attributes['customIconColor'] ) : '';

$box_style = '';
if ( ! empty( $custom_bg_color ) ) {
	$box_style .= 'background-color: ' . esc_attr( $custom_bg_color ) . ' !important; ';
}
$box_style .= $border_shadow['style'];
$box_style_attr = ! empty( $box_style ) ? 'style="' . esc_attr( trim( $box_style ) ) . '"' : '';

$title_style_attr = ! empty( $custom_title_color ) ? 'style="color: ' . esc_attr( $custom_title_color ) . ' !important;"' : '';
$desc_style_attr  = ! empty( $custom_desc_color ) ? 'style="color: ' . esc_attr( $custom_desc_color ) . ' !important;"' : '';
$icon_style_attr  = ! empty( $custom_icon_color ) ? 'style="color: ' . esc_attr( $custom_icon_color ) . ' !important;"' : '';
?>

<div class="cartvai-trust-badges-wrap cv:max-w-7xl cv:mx-auto cv:px-4 cv:sm:px-6 cv:lg:px-8 cv:my-8">
	<?php if ( 'strip' === $layout ) : ?>
		<!-- Horizontal Connected Strip Layout -->
		<div class="<?php echo esc_attr( $border_shadow['radius_class'] . ' ' . $wrapper_bg ); ?> cv:p-6 cv:sm:p-8 cv:border" <?php echo $box_style_attr; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
			<div class="cv:grid cv:grid-cols-1 cv:sm:grid-cols-2 cv:lg:grid-cols-4 cv:gap-6 cv:divide-y cv:sm:divide-y-0 cv:sm:divide-x <?php echo $is_dark ? 'cv:divide-slate-800' : 'cv:divide-slate-100'; ?>">
				<?php foreach ( $badges as $idx => $badge ) : ?>
					<div class="cv:flex cv:items-center cv:gap-4 <?php echo $idx > 0 ? 'cv:pt-4 cv:sm:pt-0 cv:sm:pl-6' : ''; ?>">
						<div class="cv:w-12 cv:h-12 cv:rounded-xl cv:bg-blue-500/10 cv:text-blue-600 cv:flex cv:items-center cv:justify-center cv:shrink-0" <?php echo $icon_style_attr; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
							<?php if ( ! empty( $badge['custom_icon'] ) ) : ?>
								<img src="<?php echo esc_url( $badge['custom_icon'] ); ?>" alt="<?php echo esc_attr( $badge['title'] ); ?>" class="cv:w-6 cv:h-6 cv:object-contain" />
							<?php else : ?>
								<?php echo $badge['icon']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							<?php endif; ?>
						</div>
						<div>
							<h4 class="cv:text-sm cv:sm:text-base cv:font-bold cv:leading-snug" <?php echo $title_style_attr; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>><?php echo esc_html( $badge['title'] ); ?></h4>
							<p class="cv:text-xs cv:mt-0.5 <?php echo $is_dark ? 'cv:text-slate-400' : 'cv:text-slate-500'; ?>" <?php echo $desc_style_attr; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>><?php echo esc_html( $badge['desc'] ); ?></p>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>

	<?php else : ?>
		<!-- 4 Separate Cards Layout -->
		<div class="cv:grid cv:grid-cols-1 cv:sm:grid-cols-2 cv:lg:grid-cols-4 cv:gap-4 cv:sm:gap-6">
			<?php foreach ( $badges as $badge ) : ?>
				<div class="<?php echo esc_attr( $border_shadow['radius_class'] . ' ' . $card_classes ); ?> cv:p-6 cv:border cv:transition-all cv:duration-200 cv:flex cv:flex-col cv:items-start" <?php echo $box_style_attr; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
					<div class="cv:w-12 cv:h-12 cv:rounded-xl cv:bg-blue-600/10 cv:text-blue-600 cv:flex cv:items-center cv:justify-center cv:mb-4" <?php echo $icon_style_attr; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
						<?php if ( ! empty( $badge['custom_icon'] ) ) : ?>
							<img src="<?php echo esc_url( $badge['custom_icon'] ); ?>" alt="<?php echo esc_attr( $badge['title'] ); ?>" class="cv:w-6 cv:h-6 cv:object-contain" />
						<?php else : ?>
							<?php echo $badge['icon']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						<?php endif; ?>
					</div>
					<h4 class="cv:text-base cv:font-bold cv:mb-1 cv:leading-snug" <?php echo $title_style_attr; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>><?php echo esc_html( $badge['title'] ); ?></h4>
					<p class="cv:text-xs cv:leading-relaxed <?php echo $is_dark ? 'cv:text-slate-400' : 'cv:text-slate-500'; ?>" <?php echo $desc_style_attr; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>><?php echo esc_html( $badge['desc'] ); ?></p>
				</div>
			<?php endforeach; ?>
		</div>
	<?php endif; ?>
</div>
