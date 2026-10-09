<?php
/**
 * Modern Payment Badges Strip Component
 *
 * Displays clean vector badges for popular cards and mobile wallets:
 * - Visa, Mastercard, Amex
 * - Local wallets: bKash, Nagad, Rocket
 * - SSL / Secure checkout guarantee badge
 *
 * Fully compliant: pure SVG markup, no external network requests.
 *
 * @package Cartvai_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$show_pay_with = isset( $args['show_label'] ) ? (bool) $args['show_label'] : true;
$theme_style   = isset( $args['theme'] ) ? $args['theme'] : 'light'; // 'light' or 'dark'

$payment_image = '';
if ( function_exists( 'cartvai_theme_option' ) ) {
	$payment_image = cartvai_theme_option( 'footer_payment_image', '' );
}
if ( empty( $payment_image ) ) {
	$payment_image = get_theme_mod( 'cartvai_footer_payment_image', '' );
}
?>
<div class="cv-payment-badges-wrap cv:flex cv:flex-wrap cv:items-center cv:gap-2.5 cv:py-2">
	<?php if ( ! empty( $payment_image ) ) : ?>
		<?php if ( $show_pay_with ) : ?>
			<span class="cv:text-[11px] cv:font-bold cv:uppercase cv:tracking-wider cv:text-slate-400 cv:mr-1">
				<?php esc_html_e( 'Pay With', 'cartvai' ); ?>
			</span>
		<?php endif; ?>
		<img src="<?php echo esc_url( $payment_image ); ?>" alt="<?php esc_attr_e( 'Supported Payment Methods', 'cartvai' ); ?>" class="cv-payment-banner cv:max-h-10 cv:sm:max-h-12 cv:w-auto cv:object-contain" style="max-height: 42px; width: auto; object-fit: contain;" loading="lazy" />
	<?php else : ?>
		<?php if ( $show_pay_with ) : ?>
			<span class="cv:text-[11px] cv:font-bold cv:uppercase cv:tracking-wider cv:text-slate-400 cv:mr-1">
				<?php esc_html_e( 'Pay With', 'cartvai' ); ?>
			</span>
		<?php endif; ?>

		<!-- Visa Badge -->
		<div class="cv-badge-card cv:h-7 cv:px-2.5 cv:rounded-md cv:bg-white cv:border cv:border-slate-200/90 cv:shadow-2xs cv:flex cv:items-center cv:justify-center cv:text-blue-800" title="Visa">
			<span class="cv:text-[11px] cv:font-black cv:tracking-wider cv:italic">VISA</span>
		</div>

		<!-- Mastercard Badge -->
		<div class="cv-badge-card cv:h-7 cv:px-2.5 cv:rounded-md cv:bg-white cv:border cv:border-slate-200/90 cv:shadow-2xs cv:flex cv:items-center cv:justify-center cv:gap-0.5" title="Mastercard">
			<span class="cv:w-3.5 cv:h-3.5 cv:rounded-full cv:bg-red-500 cv:inline-block"></span>
			<span class="cv:w-3.5 cv:h-3.5 cv:rounded-full cv:bg-amber-400 cv:-ml-2 cv:inline-block cv:opacity-90"></span>
		</div>

		<!-- Amex Badge -->
		<div class="cv-badge-card cv:h-7 cv:px-2 cv:rounded-md cv:bg-sky-700 cv:text-white cv:shadow-2xs cv:flex cv:items-center cv:justify-center" title="American Express">
			<span class="cv:text-[10px] cv:font-extrabold cv:tracking-tighter">AMEX</span>
		</div>

		<!-- bKash Badge -->
		<div class="cv-badge-card cv:h-7 cv:px-2.5 cv:rounded-md cv:bg-white cv:border cv:border-pink-200 cv:text-pink-600 cv:shadow-2xs cv:flex cv:items-center cv:justify-center" title="bKash">
			<span class="cv:text-[11px] cv:font-black cv:tracking-tight cv:text-[#e2136e]">bKash</span>
		</div>

		<!-- Nagad Badge -->
		<div class="cv-badge-card cv:h-7 cv:px-2.5 cv:rounded-md cv:bg-white cv:border cv:border-orange-200 cv:text-orange-600 cv:shadow-2xs cv:flex cv:items-center cv:justify-center" title="Nagad">
			<span class="cv:text-[11px] cv:font-black cv:tracking-tight cv:text-[#f7941d]">Nagad</span>
		</div>

		<!-- Rocket Badge -->
		<div class="cv-badge-card cv:h-7 cv:px-2.5 cv:rounded-md cv:bg-white cv:border cv:border-purple-200 cv:text-purple-700 cv:shadow-2xs cv:flex cv:items-center cv:justify-center" title="Rocket">
			<span class="cv:text-[11px] cv:font-black cv:tracking-tight cv:text-[#8c3494]">Rocket</span>
		</div>

		<!-- SSL Secure Badge -->
		<div class="cv-badge-card cv:h-7 cv:px-2.5 cv:rounded-md cv:bg-emerald-50 cv:border cv:border-emerald-200 cv:text-emerald-800 cv:shadow-2xs cv:flex cv:items-center cv:gap-1" title="256-Bit SSL Encrypted">
			<svg class="cv:w-3 cv:h-3 cv:text-emerald-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path></svg>
			<span class="cv:text-[10px] cv:font-bold cv:tracking-tight">SSL SECURE</span>
		</div>
	<?php endif; ?>
</div>
