<?php
/**
 * Cartvai FAQ Accordion Block - Dynamic Template
 *
 * @package Cartvai_Theme
 * @var array $attributes Block attributes.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$heading    = isset( $attributes['heading'] ) ? wp_kses_post( $attributes['heading'] ) : 'Frequently Asked Questions';
$subheading = isset( $attributes['subheading'] ) ? wp_kses_post( $attributes['subheading'] ) : '';

$default_faqs = array(
	array(
		'question' => 'How long does delivery take?',
		'answer'   => 'Nationwide delivery typically takes 2 to 3 business days. You will receive a live tracking code via SMS as soon as your parcel is dispatched.',
	),
	array(
		'question' => 'Can I pay Cash on Delivery (COD)?',
		'answer'   => 'Yes, absolutely! You can inspect the package upon arrival and pay cash directly to the delivery courier.',
	),
	array(
		'question' => 'What if I receive a damaged or wrong product?',
		'answer'   => 'We offer a 100% free instant replacement guarantee. Just contact our support team on WhatsApp and we will replace it immediately.',
	),
	array(
		'question' => 'How do I claim the 30-day money-back guarantee?',
		'answer'   => 'If you are not completely satisfied with your purchase within 30 days, simply reach out to our dedicated care team for a prompt refund.',
	),
	array(
		'question' => 'Is this product genuine and original?',
		'answer'   => 'Yes, 100% original authentic product sourced directly from the authorized manufacturer with official warranty coverage.',
	),
);

$faqs = array();
for ( $i = 1; $i <= 5; $i++ ) {
	$q = isset( $attributes[ 'q' . $i ] ) ? sanitize_text_field( $attributes[ 'q' . $i ] ) : '';
	$a = isset( $attributes[ 'a' . $i ] ) ? wp_kses_post( $attributes[ 'a' . $i ] ) : '';
	if ( ! empty( $q ) && ! empty( $a ) ) {
		$faqs[] = array(
			'question' => $q,
			'answer'   => $a,
		);
	}
}

if ( empty( $faqs ) ) {
	$faqs = $default_faqs;
}

$custom_heading_color    = ! empty( $attributes['customHeadingColor'] ) ? sanitize_hex_color( $attributes['customHeadingColor'] ) : '';
$custom_subheading_color = ! empty( $attributes['customSubheadingColor'] ) ? sanitize_hex_color( $attributes['customSubheadingColor'] ) : '';
$custom_bg_color         = ! empty( $attributes['customBgColor'] ) ? sanitize_hex_color( $attributes['customBgColor'] ) : '';
$custom_question_color   = ! empty( $attributes['customQuestionColor'] ) ? sanitize_hex_color( $attributes['customQuestionColor'] ) : ( ! empty( $attributes['customTextColor'] ) ? sanitize_hex_color( $attributes['customTextColor'] ) : '' );
$custom_answer_color     = ! empty( $attributes['customAnswerColor'] ) ? sanitize_hex_color( $attributes['customAnswerColor'] ) : ( ! empty( $attributes['customTextColor'] ) ? sanitize_hex_color( $attributes['customTextColor'] ) : '' );
$custom_accent_color     = ! empty( $attributes['customAccentColor'] ) ? sanitize_hex_color( $attributes['customAccentColor'] ) : '';

$border_shadow = function_exists( 'cartvai_get_block_border_shadow' )
	? cartvai_get_block_border_shadow( $attributes )
	: array(
		'style'        => 'border-color: var(--cartvai-border, #e2e8f0) !important; box-shadow: none !important;',
		'radius_class' => 'cv:rounded-2xl',
		'show_border'  => true,
	);

$card_style = $border_shadow['style'];
if ( ! empty( $custom_bg_color ) ) {
	$card_style .= ' background-color: ' . esc_attr( $custom_bg_color ) . ' !important;';
}
$card_style_attr = ! empty( $card_style ) ? ' style="' . esc_attr( trim( $card_style ) ) . '"' : '';

$heading_style_attr    = $custom_heading_color ? ' style="color: ' . esc_attr( $custom_heading_color ) . ' !important;"' : '';
$subheading_style_attr = $custom_subheading_color ? ' style="color: ' . esc_attr( $custom_subheading_color ) . ' !important;"' : '';
$question_style_attr   = $custom_question_color ? ' style="color: ' . esc_attr( $custom_question_color ) . ' !important;"' : '';
$answer_style_attr     = $custom_answer_color ? ' style="color: ' . esc_attr( $custom_answer_color ) . ' !important;"' : '';
$accent_style_attr     = $custom_accent_color ? ' style="color: ' . esc_attr( $custom_accent_color ) . ' !important;"' : '';
?>

<div class="cartvai-faq-block-wrap cv:max-w-4xl cv:mx-auto cv:px-4 cv:sm:px-6 cv:my-12">
	<div class="cv:text-center cv:mb-10">
		<h2 class="cv:text-3xl cv:sm:text-4xl cv:font-extrabold cv:tracking-tight cv:text-slate-900 cv:mb-3"<?php echo $heading_style_attr; ?>>
			<?php echo $heading; ?>
		</h2>
		<?php if ( ! empty( $subheading ) ) : ?>
			<p class="cv:text-base cv:text-slate-600"<?php echo $subheading_style_attr; ?>>
				<?php echo $subheading; ?>
			</p>
		<?php endif; ?>
	</div>

	<div class="cv:space-y-4">
		<?php foreach ( $faqs as $index => $item ) : ?>
			<details class="cv:group <?php echo esc_attr( $border_shadow['radius_class'] ); ?> cv:bg-white cv:p-6 cv:transition-all cv:duration-200 cv:hover:border-slate-300" <?php echo 0 === $index ? 'open' : ''; ?><?php echo $card_style_attr; ?>>
				<summary class="cv:flex cv:items-center cv:justify-between cv:gap-4 cv:cursor-pointer cv:list-none cv:font-bold cv:text-base cv:sm:text-lg cv:text-slate-900 cv:select-none"<?php echo $question_style_attr; ?>>
					<span><?php echo esc_html( $item['question'] ); ?></span>
					<span class="cv:w-8 cv:h-8 cv:rounded-full cv:bg-slate-100 cv:flex cv:items-center cv:justify-center cv:shrink-0 cv:text-slate-500 group-open:cv:rotate-180 group-open:cv:bg-blue-50 group-open:cv:text-blue-600 cv:transition-transform cv:duration-200"<?php echo $accent_style_attr; ?>>
						<svg class="cv:w-4 cv:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
					</span>
				</summary>
				<div class="cv:pt-4 cv:text-sm cv:sm:text-base cv:text-slate-600 cv:leading-relaxed cv:border-t cv:mt-4" style="border-top-color: var(--cartvai-border, #f1f5f9);"<?php echo $answer_style_attr; ?>>
					<?php echo $item['answer']; ?>
				</div>
			</details>
		<?php endforeach; ?>
	</div>
</div>
