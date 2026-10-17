<?php
/**
 * Cartvai Video Showcase Block - Server-side Dynamic Template
 *
 * @package Cartvai_Theme
 * @var array $attributes Block attributes.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$video_url       = isset( $attributes['videoUrl'] ) ? esc_url( $attributes['videoUrl'] ) : '';
$video_type      = isset( $attributes['videoType'] ) ? sanitize_key( $attributes['videoType'] ) : 'youtube';
$poster_url      = isset( $attributes['posterUrl'] ) ? esc_url( $attributes['posterUrl'] ) : '';
$poster_alt      = isset( $attributes['posterAlt'] ) ? sanitize_text_field( $attributes['posterAlt'] ) : 'Video preview';
$alignment       = isset( $attributes['alignment'] ) ? sanitize_key( $attributes['alignment'] ) : 'center';
$aspect_ratio    = isset( $attributes['aspectRatio'] ) ? sanitize_text_field( $attributes['aspectRatio'] ) : '16/9';
$show_badge      = isset( $attributes['showBadge'] ) ? (bool) $attributes['showBadge'] : true;
$badge_text      = isset( $attributes['badgeText'] ) ? sanitize_text_field( $attributes['badgeText'] ) : 'WATCH PRODUCT DEMO';
$heading         = isset( $attributes['heading'] ) ? wp_kses_post( $attributes['heading'] ) : 'See the Product in Action';
$description     = isset( $attributes['description'] ) ? wp_kses_post( $attributes['description'] ) : '';
$show_cta        = isset( $attributes['showCta'] ) ? (bool) $attributes['showCta'] : true;
$cta_text        = isset( $attributes['ctaText'] ) ? sanitize_text_field( $attributes['ctaText'] ) : 'Order Now';
$cta_url         = isset( $attributes['ctaUrl'] ) && ! empty( $attributes['ctaUrl'] ) ? esc_url( $attributes['ctaUrl'] ) : '#';
$container_width = isset( $attributes['containerWidth'] ) ? sanitize_key( $attributes['containerWidth'] ) : 'standard';
$color_scheme    = isset( $attributes['colorScheme'] ) ? sanitize_key( $attributes['colorScheme'] ) : 'dark';

// Helper function to extract YouTube Embed URL
$embed_src = '';
$is_direct_video = false;

if ( ! empty( $video_url ) ) {
	if ( preg_match( '/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/ ]{11})/i', $video_url, $matches ) ) {
		$embed_src = 'https://www.youtube-nocookie.com/embed/' . $matches[1] . '?rel=0&modestbranding=1';
	} elseif ( preg_match( '/vimeo\.com\/(?:video\/)?([0-9]+)/i', $video_url, $matches ) ) {
		$embed_src = 'https://player.vimeo.com/video/' . $matches[1] . '?title=0&byline=0&portrait=0';
	} elseif ( preg_match( '/\.(mp4|webm|ogg)$/i', $video_url ) || 'self_hosted' === $video_type ) {
		$is_direct_video = true;
	} else {
		$embed_src = $video_url;
	}
}

// Aspect ratio classes
$aspect_classes = 'cv:aspect-16/9';
if ( '4/3' === $aspect_ratio ) {
	$aspect_classes = 'cv:aspect-4/3';
} elseif ( '1/1' === $aspect_ratio ) {
	$aspect_classes = 'cv:aspect-square';
} elseif ( '9/16' === $aspect_ratio ) {
	$aspect_classes = 'cv:aspect-9/16 cv:max-w-xs cv:mx-auto';
}

// Container sizing
$container_classes = 'cv:max-w-7xl cv:mx-auto cv:px-4 cv:sm:px-6 cv:lg:px-8 cv:my-10';
if ( 'narrow' === $container_width ) {
	$container_classes = 'cv:max-w-4xl cv:mx-auto cv:px-4 cv:sm:px-6 cv:my-10';
} elseif ( 'full' === $container_width ) {
	$container_classes = 'cv:w-full cv:px-4 cv:sm:px-6 cv:lg:px-8 cv:my-10';
}

// Theme colors
$is_dark = ( 'dark' === $color_scheme );
$card_bg = $is_dark
	? 'cv:bg-slate-900 cv:text-white cv:border cv:border-slate-800'
	: 'cv:bg-white cv:text-slate-900 cv:border cv:border-slate-200';
$badge_color = $is_dark
	? 'cv:bg-blue-500/15 cv:text-blue-300 cv:border cv:border-blue-500/30'
	: 'cv:bg-blue-50 cv:text-blue-700 cv:border cv:border-blue-200';
$desc_color = $is_dark ? 'cv:text-slate-300' : 'cv:text-slate-600';

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
$custom_btn_bg        = isset( $attributes['customBtnBgColor'] ) ? sanitize_text_field( $attributes['customBtnBgColor'] ) : '';
$custom_btn_text      = isset( $attributes['customBtnTextColor'] ) ? sanitize_text_field( $attributes['customBtnTextColor'] ) : '';

$card_styles = array();
if ( ! empty( $custom_bg_color ) ) {
	$card_styles[] = 'background: ' . esc_attr( $custom_bg_color ) . ' !important;';
}
if ( ! empty( $border_shadow['style'] ) ) {
	$card_styles[] = $border_shadow['style'];
}
$card_style_attr = ! empty( $card_styles ) ? 'style="' . implode( ' ', $card_styles ) . '"' : '';

$heading_style_attr = ! empty( $custom_heading_color ) ? 'style="color: ' . esc_attr( $custom_heading_color ) . ' !important;"' : '';
$desc_style_attr    = ! empty( $custom_text_color ) ? 'style="color: ' . esc_attr( $custom_text_color ) . ' !important;"' : '';

$btn_styles = array();
if ( ! empty( $custom_btn_bg ) ) {
	$btn_styles[] = 'background-color: ' . esc_attr( $custom_btn_bg ) . ' !important;';
}
if ( ! empty( $custom_btn_text ) ) {
	$btn_styles[] = 'color: ' . esc_attr( $custom_btn_text ) . ' !important;';
}
$btn_style_attr = ! empty( $btn_styles ) ? 'style="' . implode( ' ', $btn_styles ) . '"' : '';
?>

<div class="cartvai-video-block-wrap <?php echo esc_attr( $container_classes ); ?>">
	<?php if ( 'left' === $alignment || 'right' === $alignment ) : ?>
		<!-- Split 2-Column Layout -->
		<div class="cv:relative cv:overflow-hidden <?php echo esc_attr( $border_shadow['radius_class'] ); ?> cv:p-8 cv:sm:p-12 <?php echo esc_attr( $card_bg ); ?>" <?php echo $card_style_attr; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
			<div class="cv:grid cv:grid-cols-1 cv:lg:grid-cols-12 cv:gap-8 cv:lg:gap-12 cv:items-center">
				<!-- Video Column -->
				<div class="cv:lg:col-span-7 <?php echo 'right' === $alignment ? 'cv:lg:order-2' : 'cv:lg:order-1'; ?>">
					<div class="cv:relative cv:rounded-2xl cv:overflow-hidden cv:bg-black cv:border cv:border-white/10 <?php echo esc_attr( $aspect_classes ); ?>">
						<?php if ( $is_direct_video ) : ?>
							<video controls <?php echo ! empty( $poster_url ) ? 'poster="' . $poster_url . '"' : ''; ?> class="cv:w-full cv:h-full cv:object-cover" preload="metadata">
								<source src="<?php echo $video_url; ?>" type="video/mp4">
								Your browser does not support HTML5 video.
							</video>
						<?php elseif ( ! empty( $embed_src ) ) : ?>
							<iframe src="<?php echo esc_url( $embed_src ); ?>" title="<?php echo esc_attr( $heading ); ?>" class="cv:w-full cv:h-full cv:border-0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen loading="lazy"></iframe>
						<?php else : ?>
							<div class="cv:flex cv:items-center cv:justify-center cv:h-full cv:text-slate-400 cv:text-sm">
								<span>Enter a valid video URL in block settings</span>
							</div>
						<?php endif; ?>
					</div>
				</div>

				<!-- Content Column -->
				<div class="cv:lg:col-span-5 <?php echo 'right' === $alignment ? 'cv:lg:order-1' : 'cv:lg:order-2'; ?>">
					<?php if ( $show_badge && ! empty( $badge_text ) ) : ?>
						<span class="cv:inline-flex cv:items-center cv:gap-1.5 cv:px-3.5 cv:py-1.5 cv:rounded-full cv:text-xs cv:font-bold cv:tracking-wider cv:uppercase cv:mb-4 <?php echo esc_attr( $badge_color ); ?>">
							<span class="cv:w-2 cv:h-2 cv:rounded-full cv:bg-red-500 cv:animate-ping"></span>
							<?php echo esc_html( $badge_text ); ?>
						</span>
					<?php endif; ?>

					<h2 class="cv:text-2xl cv:sm:text-3xl cv:lg:text-4xl cv:font-extrabold cv:tracking-tight cv:leading-snug cv:mb-4" <?php echo $heading_style_attr; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
						<?php echo $heading; ?>
					</h2>

					<?php if ( ! empty( $description ) ) : ?>
						<p class="cv:text-base cv:leading-relaxed cv:mb-6 <?php echo esc_attr( $desc_color ); ?>" <?php echo $desc_style_attr; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
							<?php echo $description; ?>
						</p>
					<?php endif; ?>

					<?php if ( $show_cta && ! empty( $cta_text ) ) : ?>
						<div>
							<a href="<?php echo $cta_url; ?>" class="cv:inline-flex cv:items-center cv:gap-2.5 cv:px-7 cv:py-3.5 cv:rounded-xl cv:font-semibold cv:text-base cv:bg-blue-600 cv:text-white cv:hover:bg-blue-500 cv:shadow-lg cv:hover:shadow-blue-500/30 cv:hover:-translate-y-0.5 cv:transition-all cv:duration-200" <?php echo $btn_style_attr; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
								<span><?php echo esc_html( $cta_text ); ?></span>
								<svg class="cv:w-5 cv:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
							</a>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>

	<?php else : ?>
		<!-- Centered Showcase Layout -->
		<div class="cv:relative cv:overflow-hidden <?php echo esc_attr( $border_shadow['radius_class'] ); ?> cv:p-8 cv:sm:p-12 cv:lg:p-16 cv:text-center <?php echo esc_attr( $card_bg ); ?>" <?php echo $card_style_attr; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
			<!-- Header -->
			<div class="cv:max-w-3xl cv:mx-auto cv:mb-8">
				<?php if ( $show_badge && ! empty( $badge_text ) ) : ?>
					<div class="cv:mb-4">
						<span class="cv:inline-flex cv:items-center cv:gap-1.5 cv:px-4 cv:py-1.5 cv:rounded-full cv:text-xs cv:font-bold cv:tracking-wider cv:uppercase <?php echo esc_attr( $badge_color ); ?>">
							<span class="cv:w-2 cv:h-2 cv:rounded-full cv:bg-red-500 cv:animate-pulse"></span>
							<?php echo esc_html( $badge_text ); ?>
						</span>
					</div>
				<?php endif; ?>

				<h2 class="cv:text-3xl cv:sm:text-4xl cv:lg:text-5xl cv:font-extrabold cv:tracking-tight cv:leading-tight cv:mb-4" <?php echo $heading_style_attr; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
					<?php echo $heading; ?>
				</h2>

				<?php if ( ! empty( $description ) ) : ?>
					<p class="cv:text-base cv:sm:text-lg cv:leading-relaxed <?php echo esc_attr( $desc_color ); ?>" <?php echo $desc_style_attr; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
						<?php echo $description; ?>
					</p>
				<?php endif; ?>
			</div>

			<!-- Video Player -->
			<div class="cv:relative cv:max-w-4xl cv:mx-auto cv:rounded-2xl cv:overflow-hidden cv:bg-black cv:border cv:border-white/10 <?php echo esc_attr( $aspect_classes ); ?>">
				<?php if ( $is_direct_video ) : ?>
					<video controls <?php echo ! empty( $poster_url ) ? 'poster="' . $poster_url . '"' : ''; ?> class="cv:w-full cv:h-full cv:object-cover" preload="metadata">
						<source src="<?php echo $video_url; ?>" type="video/mp4">
						Your browser does not support HTML5 video.
					</video>
				<?php elseif ( ! empty( $embed_src ) ) : ?>
					<iframe src="<?php echo esc_url( $embed_src ); ?>" title="<?php echo esc_attr( $heading ); ?>" class="cv:w-full cv:h-full cv:border-0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen loading="lazy"></iframe>
				<?php else : ?>
					<div class="cv:flex cv:items-center cv:justify-center cv:h-full cv:text-slate-400 cv:text-sm">
						<span>Enter a valid YouTube, Vimeo, or MP4 URL</span>
					</div>
				<?php endif; ?>
			</div>

			<?php if ( $show_cta && ! empty( $cta_text ) ) : ?>
				<div class="cv:mt-8">
					<a href="<?php echo $cta_url; ?>" class="cv:inline-flex cv:items-center cv:gap-2.5 cv:px-8 cv:py-4 cv:rounded-xl cv:font-semibold cv:text-base cv:bg-blue-600 cv:text-white cv:hover:bg-blue-500 cv:shadow-lg cv:hover:shadow-blue-500/30 cv:hover:-translate-y-0.5 cv:transition-all cv:duration-200" <?php echo $btn_style_attr; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
						<span><?php echo esc_html( $cta_text ); ?></span>
						<svg class="cv:w-5 cv:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
					</a>
				</div>
			<?php endif; ?>
		</div>
	<?php endif; ?>
</div>
