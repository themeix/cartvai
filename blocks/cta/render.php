<?php
/**
 * Cartvai CTA Block - Server-side Dynamic Template
 *
 * @package Cartvai_Theme
 * @var array    $attributes Block attributes.
 * @var string   $content    Block inner content.
 * @var WP_Block $block      Block instance.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$layout_style       = isset( $attributes['layoutStyle'] ) ? sanitize_key( $attributes['layoutStyle'] ) : 'centered';
$color_scheme       = isset( $attributes['colorScheme'] ) ? sanitize_key( $attributes['colorScheme'] ) : 'brand-dark';
$container_width    = isset( $attributes['containerWidth'] ) ? sanitize_key( $attributes['containerWidth'] ) : 'standard';
$show_badge         = isset( $attributes['showBadge'] ) ? (bool) $attributes['showBadge'] : true;
$badge_text         = isset( $attributes['badgeText'] ) ? sanitize_text_field( $attributes['badgeText'] ) : 'LIMITED TIME OFFER';
$heading            = isset( $attributes['heading'] ) ? wp_kses_post( $attributes['heading'] ) : 'Boost Your Sales with Exclusive Deals';
$description        = isset( $attributes['description'] ) ? wp_kses_post( $attributes['description'] ) : 'Join thousands of happy customers today. Enjoy instant discounts, express shipping, and our hassle-free 30-day money-back guarantee.';
$primary_btn_text   = isset( $attributes['primaryButtonText'] ) ? sanitize_text_field( $attributes['primaryButtonText'] ) : 'Shop Now';
$primary_btn_url    = isset( $attributes['primaryButtonUrl'] ) && ! empty( $attributes['primaryButtonUrl'] ) ? esc_url( $attributes['primaryButtonUrl'] ) : '#';
$show_secondary_btn = isset( $attributes['showSecondaryButton'] ) ? (bool) $attributes['showSecondaryButton'] : true;
$secondary_btn_text = isset( $attributes['secondaryButtonText'] ) ? sanitize_text_field( $attributes['secondaryButtonText'] ) : 'Learn More';
$secondary_btn_url  = isset( $attributes['secondaryButtonUrl'] ) && ! empty( $attributes['secondaryButtonUrl'] ) ? esc_url( $attributes['secondaryButtonUrl'] ) : '#';
$microcopy          = isset( $attributes['microcopy'] ) ? sanitize_text_field( $attributes['microcopy'] ) : '';
$image_url          = isset( $attributes['imageUrl'] ) ? esc_url( $attributes['imageUrl'] ) : '';
$image_alt          = isset( $attributes['imageAlt'] ) ? sanitize_text_field( $attributes['imageAlt'] ) : 'Special Offer';

// Container max-width styling
$container_classes = 'cv:max-w-7xl cv:mx-auto cv:px-4 cv:sm:px-6 cv:lg:px-8 cv:my-8';
if ( 'narrow' === $container_width ) {
	$container_classes = 'cv:max-w-4xl cv:mx-auto cv:px-4 cv:sm:px-6 cv:my-8';
} elseif ( 'full' === $container_width ) {
	$container_classes = 'cv:w-full cv:px-4 cv:sm:px-6 cv:lg:px-8 cv:my-8';
}

// Color scheme theme mappings
$theme_presets = array(
	'brand-dark'    => array(
		'container' => 'cv:bg-slate-900 cv:text-white cv:border cv:border-slate-800',
		'badge'     => 'cv:bg-blue-500/15 cv:text-blue-300 cv:border cv:border-blue-500/30',
		'heading'   => 'cv:text-white',
		'desc'      => 'cv:text-slate-300',
		'btn_pri'   => 'cv:bg-blue-600 cv:text-white cv:hover:bg-blue-500',
		'btn_sec'   => 'cv:bg-white/10 cv:text-white cv:hover:bg-white/20 cv:border cv:border-white/20',
		'micro'     => 'cv:text-slate-400',
		'glow'      => 'cv:bg-blue-600/20',
	),
	'brand-primary' => array(
		'container' => 'cv:bg-gradient-to-br cv:from-blue-600 cv:via-blue-700 cv:to-indigo-800 cv:text-white',
		'badge'     => 'cv:bg-white/20 cv:text-white cv:border cv:border-white/30',
		'heading'   => 'cv:text-white',
		'desc'      => 'cv:text-blue-100',
		'btn_pri'   => 'cv:bg-white cv:text-blue-700 cv:hover:bg-blue-50',
		'btn_sec'   => 'cv:bg-blue-950/40 cv:text-white cv:hover:bg-blue-950/60 cv:border cv:border-white/30',
		'micro'     => 'cv:text-blue-200',
		'glow'      => 'cv:bg-white/10',
	),
	'emerald'       => array(
		'container' => 'cv:bg-gradient-to-br cv:from-emerald-950 cv:via-emerald-900 cv:to-teal-950 cv:text-white cv:border cv:border-emerald-800/40',
		'badge'     => 'cv:bg-emerald-500/20 cv:text-emerald-300 cv:border cv:border-emerald-500/40',
		'heading'   => 'cv:text-white',
		'desc'      => 'cv:text-emerald-200',
		'btn_pri'   => 'cv:bg-emerald-500 cv:text-slate-950 cv:hover:bg-emerald-400 cv:font-bold',
		'btn_sec'   => 'cv:bg-white/10 cv:text-white cv:hover:bg-white/20 cv:border cv:border-white/20',
		'micro'     => 'cv:text-emerald-300/80',
		'glow'      => 'cv:bg-emerald-500/20',
	),
	'clean-light'   => array(
		'container' => 'cv:bg-white cv:text-slate-900 cv:border cv:border-slate-200',
		'badge'     => 'cv:bg-blue-50 cv:text-blue-700 cv:border cv:border-blue-200',
		'heading'   => 'cv:text-slate-900',
		'desc'      => 'cv:text-slate-600',
		'btn_pri'   => 'cv:bg-blue-600 cv:text-white cv:hover:bg-blue-700',
		'btn_sec'   => 'cv:bg-slate-100 cv:text-slate-800 cv:hover:bg-slate-200 cv:border cv:border-slate-300',
		'micro'     => 'cv:text-slate-500',
		'glow'      => 'cv:bg-blue-500/5',
	),
	'amber'         => array(
		'container' => 'cv:bg-gradient-to-r cv:from-amber-600 cv:via-orange-600 cv:to-red-600 cv:text-white',
		'badge'     => 'cv:bg-black/25 cv:text-amber-200 cv:border cv:border-amber-300/40',
		'heading'   => 'cv:text-white',
		'desc'      => 'cv:text-amber-100',
		'btn_pri'   => 'cv:bg-white cv:text-orange-700 cv:hover:bg-orange-50 cv:font-bold',
		'btn_sec'   => 'cv:bg-black/20 cv:text-white cv:hover:bg-black/35 cv:border cv:border-white/30',
		'micro'     => 'cv:text-amber-100/90',
		'glow'      => 'cv:bg-white/15',
	),
);

$border_shadow = function_exists( 'cartvai_get_block_border_shadow' )
	? cartvai_get_block_border_shadow( $attributes, array( 'borderRadius' => 'rounded-3xl', 'boxShadow' => 'none' ) )
	: array(
		'style'        => 'border-color: var(--cartvai-border, #e2e8f0) !important; box-shadow: none !important;',
		'radius_class' => 'cv:rounded-3xl',
		'show_border'  => true,
	);

$custom_bg_color      = isset( $attributes['customBgColor'] ) ? sanitize_text_field( $attributes['customBgColor'] ) : '';
$custom_heading_color = isset( $attributes['customHeadingColor'] ) ? sanitize_text_field( $attributes['customHeadingColor'] ) : '';
$custom_text_color    = isset( $attributes['customTextColor'] ) ? sanitize_text_field( $attributes['customTextColor'] ) : '';
$custom_badge_color   = isset( $attributes['customBadgeColor'] ) ? sanitize_text_field( $attributes['customBadgeColor'] ) : '';
$custom_btn_bg        = isset( $attributes['customBtnBgColor'] ) ? sanitize_text_field( $attributes['customBtnBgColor'] ) : '';
$custom_btn_text      = isset( $attributes['customBtnTextColor'] ) ? sanitize_text_field( $attributes['customBtnTextColor'] ) : '';

$container_style = '';
if ( ! empty( $custom_bg_color ) ) {
	$container_style .= 'background: ' . esc_attr( $custom_bg_color ) . ' !important; ';
}
$container_style .= $border_shadow['style'];
$container_style_attr = ! empty( $container_style ) ? 'style="' . esc_attr( trim( $container_style ) ) . '"' : '';

$heading_style_attr = ! empty( $custom_heading_color ) ? 'style="color: ' . esc_attr( $custom_heading_color ) . ' !important;"' : '';
$desc_style_attr    = ! empty( $custom_text_color ) ? 'style="color: ' . esc_attr( $custom_text_color ) . ' !important;"' : '';

$badge_style_attr = ! empty( $custom_badge_color ) ? 'style="color: ' . esc_attr( $custom_badge_color ) . ' !important; border-color: currentColor !important;"' : '';

$btn_pri_styles = array();
if ( ! empty( $custom_btn_bg ) ) {
	$btn_pri_styles[] = 'background-color: ' . esc_attr( $custom_btn_bg ) . ' !important;';
}
if ( ! empty( $custom_btn_text ) ) {
	$btn_pri_styles[] = 'color: ' . esc_attr( $custom_btn_text ) . ' !important;';
}
$btn_pri_style_attr = ! empty( $btn_pri_styles ) ? 'style="' . implode( ' ', $btn_pri_styles ) . '"' : '';

$theme = isset( $theme_presets[ $color_scheme ] ) ? $theme_presets[ $color_scheme ] : $theme_presets['brand-dark'];

// Extra wrapper classes from Gutenberg
$extra_classes = isset( $attributes['className'] ) ? ' ' . esc_attr( $attributes['className'] ) : '';
?>

<div class="cartvai-cta-block-wrap <?php echo esc_attr( $container_classes . $extra_classes ); ?>">
	<?php if ( 'minimal' === $layout_style ) : ?>
		<!-- Minimal Horizontal Bar Layout -->
		<div class="cv:relative cv:overflow-hidden <?php echo esc_attr( $border_shadow['radius_class'] ); ?> cv:py-6 cv:px-6 cv:sm:px-8 cv:lg:px-10 <?php echo esc_attr( $theme['container'] ); ?>" <?php echo $container_style_attr; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
			<!-- Decorative Background Glow -->
			<div class="cv:absolute cv:top-0 cv:right-0 cv:w-72 cv:h-72 <?php echo esc_attr( $theme['glow'] ); ?> cv:rounded-full cv:blur-3xl cv:pointer-events-none cv:opacity-60" aria-hidden="true"></div>

			<div class="cv:relative cv:z-10 cv:flex cv:flex-col cv:lg:flex-row cv:items-start cv:lg:items-center cv:justify-between cv:gap-6">
				<div class="cv:max-w-2xl">
					<?php if ( $show_badge && ! empty( $badge_text ) ) : ?>
						<span class="cv:inline-flex cv:items-center cv:gap-1.5 cv:px-3 cv:py-1 cv:rounded-full cv:text-xs cv:font-bold cv:tracking-wider cv:uppercase cv:mb-2.5 <?php echo esc_attr( $theme['badge'] ); ?>" <?php echo $badge_style_attr; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
							<span class="cv:w-1.5 cv:h-1.5 cv:rounded-full cv:bg-current cv:animate-pulse"></span>
							<?php echo esc_html( $badge_text ); ?>
						</span>
					<?php endif; ?>

					<h3 class="cv:text-xl cv:sm:text-2xl cv:font-extrabold cv:tracking-tight cv:leading-snug <?php echo esc_attr( $theme['heading'] ); ?>" <?php echo $heading_style_attr; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
						<?php echo $heading; ?>
					</h3>

					<?php if ( ! empty( $description ) ) : ?>
						<p class="cv:text-sm cv:sm:text-base cv:mt-1.5 <?php echo esc_attr( $theme['desc'] ); ?>" <?php echo $desc_style_attr; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
							<?php echo $description; ?>
						</p>
					<?php endif; ?>
				</div>

				<div class="cv:flex cv:flex-wrap cv:items-center cv:gap-3 cv:shrink-0">
					<?php if ( ! empty( $primary_btn_text ) ) : ?>
						<a href="<?php echo $primary_btn_url; ?>" class="cv:inline-flex cv:items-center cv:justify-center cv:gap-2 cv:px-6 cv:py-3 cv:rounded-xl cv:font-semibold cv:text-sm cv:shadow-md cv:hover:shadow-lg cv:hover:-translate-y-0.5 cv:transition-all cv:duration-200 <?php echo esc_attr( $theme['btn_pri'] ); ?>" <?php echo $btn_pri_style_attr; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
							<span><?php echo esc_html( $primary_btn_text ); ?></span>
							<svg class="cv:w-4 cv:h-4 cv:transition-transform cv:duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
						</a>
					<?php endif; ?>

					<?php if ( $show_secondary_btn && ! empty( $secondary_btn_text ) ) : ?>
						<a href="<?php echo $secondary_btn_url; ?>" class="cv:inline-flex cv:items-center cv:justify-center cv:px-5 cv:py-3 cv:rounded-xl cv:font-semibold cv:text-sm cv:transition-all cv:duration-200 <?php echo esc_attr( $theme['btn_sec'] ); ?>">
							<?php echo esc_html( $secondary_btn_text ); ?>
						</a>
					<?php endif; ?>
				</div>
			</div>
		</div>

	<?php elseif ( 'split' === $layout_style ) : ?>
		<!-- 2-Column Split Banner Layout -->
		<div class="cv:relative cv:overflow-hidden <?php echo esc_attr( $border_shadow['radius_class'] ); ?> cv:p-8 cv:sm:p-12 cv:lg:p-14 <?php echo esc_attr( $theme['container'] ); ?>" <?php echo $container_style_attr; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
			<!-- Decorative Background Glow -->
			<div class="cv:absolute cv:-top-24 cv:-left-24 cv:w-96 cv:h-96 <?php echo esc_attr( $theme['glow'] ); ?> cv:rounded-full cv:blur-3xl cv:pointer-events-none cv:opacity-60" aria-hidden="true"></div>
			<div class="cv:absolute cv:-bottom-24 cv:-right-24 cv:w-96 cv:h-96 <?php echo esc_attr( $theme['glow'] ); ?> cv:rounded-full cv:blur-3xl cv:pointer-events-none cv:opacity-40" aria-hidden="true"></div>

			<div class="cv:relative cv:z-10 cv:grid cv:grid-cols-1 cv:lg:grid-cols-12 cv:gap-10 cv:lg:gap-12 cv:items-center">
				<!-- Left Text & Actions Column -->
				<div class="cv:lg:col-span-7 cv:text-left">
					<?php if ( $show_badge && ! empty( $badge_text ) ) : ?>
						<div class="cv:mb-4">
							<span class="cv:inline-flex cv:items-center cv:gap-2 cv:px-3.5 cv:py-1.5 cv:rounded-full cv:text-xs cv:font-bold cv:tracking-wider cv:uppercase <?php echo esc_attr( $theme['badge'] ); ?>" <?php echo $badge_style_attr; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
								<svg class="cv:w-3.5 cv:h-3.5 cv:text-amber-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
								<?php echo esc_html( $badge_text ); ?>
							</span>
						</div>
					<?php endif; ?>

					<h2 class="cv:text-3xl cv:sm:text-4xl cv:lg:text-5xl cv:font-extrabold cv:tracking-tight cv:leading-tight cv:mb-5 <?php echo esc_attr( $theme['heading'] ); ?>" <?php echo $heading_style_attr; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
						<?php echo $heading; ?>
					</h2>

					<?php if ( ! empty( $description ) ) : ?>
						<p class="cv:text-base cv:sm:text-lg cv:leading-relaxed cv:mb-8 <?php echo esc_attr( $theme['desc'] ); ?>" <?php echo $desc_style_attr; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
							<?php echo $description; ?>
						</p>
					<?php endif; ?>

					<div class="cv:flex cv:flex-wrap cv:items-center cv:gap-4 cv:mb-6">
						<?php if ( ! empty( $primary_btn_text ) ) : ?>
							<a href="<?php echo $primary_btn_url; ?>" class="cv:inline-flex cv:items-center cv:justify-center cv:gap-2.5 cv:px-7 cv:py-3.5 cv:rounded-xl cv:font-semibold cv:text-base cv:shadow-lg cv:hover:shadow-xl cv:hover:-translate-y-0.5 cv:transition-all cv:duration-200 <?php echo esc_attr( $theme['btn_pri'] ); ?>" <?php echo $btn_pri_style_attr; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
								<span><?php echo esc_html( $primary_btn_text ); ?></span>
								<svg class="cv:w-5 cv:h-5 cv:transition-transform cv:duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
							</a>
						<?php endif; ?>

						<?php if ( $show_secondary_btn && ! empty( $secondary_btn_text ) ) : ?>
							<a href="<?php echo $secondary_btn_url; ?>" class="cv:inline-flex cv:items-center cv:justify-center cv:px-6 cv:py-3.5 cv:rounded-xl cv:font-semibold cv:text-base cv:transition-all cv:duration-200 <?php echo esc_attr( $theme['btn_sec'] ); ?>">
								<?php echo esc_html( $secondary_btn_text ); ?>
							</a>
						<?php endif; ?>
					</div>

					<?php if ( ! empty( $microcopy ) ) : ?>
						<p class="cv:text-xs cv:sm:text-sm cv:flex cv:items-center cv:gap-2 <?php echo esc_attr( $theme['micro'] ); ?>" <?php echo $desc_style_attr; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
							<?php echo $microcopy; ?>
						</p>
					<?php endif; ?>
				</div>

				<!-- Right Media Column -->
				<div class="cv:lg:col-span-5 cv:flex cv:items-center cv:justify-center">
					<?php if ( ! empty( $image_url ) ) : ?>
						<div class="cv:relative cv:w-full cv:max-w-md cv:rounded-2xl cv:overflow-hidden cv:shadow-2xl cv:border cv:border-white/10 cv:aspect-4/3">
							<img src="<?php echo $image_url; ?>" alt="<?php echo esc_attr( $image_alt ); ?>" class="cv:w-full cv:h-full cv:object-cover cv:hover:scale-105 cv:transition-transform cv:duration-500" loading="lazy" />
						</div>
					<?php else : ?>
						<!-- Sleek Fallback Visual Card -->
						<div class="cv:w-full cv:max-w-md cv:rounded-2xl cv:p-6 cv:sm:p-8 cv:backdrop-blur-md cv:bg-white/5 cv:border cv:border-white/15 cv:shadow-xl cv:space-y-4">
							<div class="cv:flex cv:items-center cv:justify-between cv:border-b cv:border-white/10 cv:pb-4">
								<span class="cv:text-xs cv:font-semibold cv:uppercase cv:tracking-wider cv:opacity-75">Customer Perks</span>
								<span class="cv:px-2.5 cv:py-1 cv:rounded-full cv:text-xs cv:font-bold cv:bg-amber-400/20 cv:text-amber-300 cv:border cv:border-amber-400/30">Verified</span>
							</div>
							<div class="cv:space-y-3">
								<div class="cv:flex cv:items-center cv:gap-3">
									<div class="cv:w-8 cv:h-8 cv:rounded-lg cv:bg-emerald-500/20 cv:text-emerald-400 cv:flex cv:items-center cv:justify-center cv:shrink-0">
										<svg class="cv:w-5 cv:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
									</div>
									<span class="cv:text-sm cv:font-medium">Express Dispatch & Delivery</span>
								</div>
								<div class="cv:flex cv:items-center cv:gap-3">
									<div class="cv:w-8 cv:h-8 cv:rounded-lg cv:bg-blue-500/20 cv:text-blue-400 cv:flex cv:items-center cv:justify-center cv:shrink-0">
										<svg class="cv:w-5 cv:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
									</div>
									<span class="cv:text-sm cv:font-medium">100% Secure Encrypted Checkout</span>
								</div>
								<div class="cv:flex cv:items-center cv:gap-3">
									<div class="cv:w-8 cv:h-8 cv:rounded-lg cv:bg-purple-500/20 cv:text-purple-400 cv:flex cv:items-center cv:justify-center cv:shrink-0">
										<svg class="cv:w-5 cv:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
									</div>
									<span class="cv:text-sm cv:font-medium">30 Days Hassle-Free Returns</span>
								</div>
							</div>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>

	<?php else : ?>
		<!-- Centered & Card Layout (Default) -->
		<?php
		$card_padding = ( 'card' === $layout_style )
			? 'cv:p-8 cv:sm:p-12 cv:lg:p-16 ' . $border_shadow['radius_class']
			: 'cv:py-14 cv:px-6 cv:sm:px-12 cv:lg:py-20 cv:lg:px-16 ' . $border_shadow['radius_class'];
		?>
		<div class="cv:relative cv:overflow-hidden cv:text-center <?php echo esc_attr( $card_padding . ' ' . $theme['container'] ); ?>" <?php echo $container_style_attr; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
			<!-- Decorative Ambient Blur Lights -->
			<div class="cv:absolute cv:top-0 cv:left-1/2 cv:-translate-x-1/2 cv:w-96 cv:h-96 <?php echo esc_attr( $theme['glow'] ); ?> cv:rounded-full cv:blur-3xl cv:pointer-events-none cv:opacity-60" aria-hidden="true"></div>
			<div class="cv:absolute cv:bottom-0 cv:right-10 cv:w-64 cv:h-64 <?php echo esc_attr( $theme['glow'] ); ?> cv:rounded-full cv:blur-2xl cv:pointer-events-none cv:opacity-30" aria-hidden="true"></div>

			<div class="cv:relative cv:z-10 cv:max-w-3xl cv:mx-auto">
				<?php if ( $show_badge && ! empty( $badge_text ) ) : ?>
					<div class="cv:mb-5">
						<span class="cv:inline-flex cv:items-center cv:gap-2 cv:px-4 cv:py-1.5 cv:rounded-full cv:text-xs cv:font-bold cv:tracking-wider cv:uppercase cv:shadow-sm <?php echo esc_attr( $theme['badge'] ); ?>" <?php echo $badge_style_attr; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
							<span class="cv:w-2 cv:h-2 cv:rounded-full cv:bg-current cv:animate-ping"></span>
							<?php echo esc_html( $badge_text ); ?>
						</span>
					</div>
				<?php endif; ?>

				<h2 class="cv:text-3xl cv:sm:text-4xl cv:lg:text-5xl cv:font-extrabold cv:tracking-tight cv:leading-tight cv:mb-5 <?php echo esc_attr( $theme['heading'] ); ?>" <?php echo $heading_style_attr; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
					<?php echo $heading; ?>
				</h2>

				<?php if ( ! empty( $description ) ) : ?>
					<p class="cv:text-base cv:sm:text-lg cv:leading-relaxed cv:mb-8 cv:max-w-2xl cv:mx-auto <?php echo esc_attr( $theme['desc'] ); ?>" <?php echo $desc_style_attr; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
						<?php echo $description; ?>
					</p>
				<?php endif; ?>

				<div class="cv:flex cv:flex-wrap cv:items-center cv:justify-center cv:gap-4 cv:mb-6">
					<?php if ( ! empty( $primary_btn_text ) ) : ?>
						<a href="<?php echo $primary_btn_url; ?>" class="cv:inline-flex cv:items-center cv:justify-center cv:gap-2.5 cv:px-8 cv:py-4 cv:rounded-xl cv:font-semibold cv:text-base cv:shadow-lg cv:hover:shadow-2xl cv:hover:-translate-y-0.5 cv:transition-all cv:duration-200 <?php echo esc_attr( $theme['btn_pri'] ); ?>" <?php echo $btn_pri_style_attr; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
							<span><?php echo esc_html( $primary_btn_text ); ?></span>
							<svg class="cv:w-5 cv:h-5 cv:transition-transform cv:duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
						</a>
					<?php endif; ?>

					<?php if ( $show_secondary_btn && ! empty( $secondary_btn_text ) ) : ?>
						<a href="<?php echo $secondary_btn_url; ?>" class="cv:inline-flex cv:items-center cv:justify-center cv:px-7 cv:py-4 cv:rounded-xl cv:font-semibold cv:text-base cv:transition-all cv:duration-200 <?php echo esc_attr( $theme['btn_sec'] ); ?>">
							<?php echo esc_html( $secondary_btn_text ); ?>
						</a>
					<?php endif; ?>
				</div>

				<?php if ( ! empty( $microcopy ) ) : ?>
					<p class="cv:text-xs cv:sm:text-sm cv:flex cv:items-center cv:justify-center cv:gap-2 cv:opacity-90 <?php echo esc_attr( $theme['micro'] ); ?>" <?php echo $desc_style_attr; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
						<?php echo esc_html( $microcopy ); ?>
					</p>
				<?php endif; ?>
			</div>
		</div>
	<?php endif; ?>
</div>
