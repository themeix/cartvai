<?php
/**
 * Title: Cartvai - Dual Promotional Callout Cards
 * Slug: cartvai-theme/promo-banners-duo
 * Categories: cartvai, promotions
 * Description: Two side-by-side promotional callout banners for seasonal campaigns and discounts.
 *
 * @package Cartvai_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$shop_url = function_exists( 'cartvai_get_shop_page_url' ) ? cartvai_get_shop_page_url() : home_url( '/shop/' );
?>
<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"1rem","bottom":"2.5rem"}}},"className":"cv-home-section","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide cv-home-section" style="padding-top:1rem;padding-bottom:2.5rem">
	<!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"left":"1.25rem","top":"1.25rem"}}}} -->
	<div class="wp-block-columns alignwide">
		<!-- wp:column -->
		<div class="wp-block-column">
			<!-- wp:group {"style":{"spacing":{"padding":{"top":"2rem","bottom":"2rem","left":"2rem","right":"2rem"}},"border":{"radius":"1.25rem"}},"className":"cv-promo-duo-card","layout":{"type":"default"}} -->
			<div class="wp-block-group cv-promo-duo-card" style="border-radius:1.25rem;padding-top:2rem;padding-right:2rem;padding-bottom:2rem;padding-left:2rem;background:linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%)">
				<!-- wp:paragraph {"style":{"typography":{"fontSize":"0.75rem","fontWeight":"800"}}} -->
				<p style="font-size:0.75rem;font-weight:800;color:#2563eb;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:0.5rem">LIMITED TIME OFFER</p>
				<!-- /wp:paragraph -->
				<!-- wp:heading {"level":3,"style":{"typography":{"fontSize":"1.5rem","fontWeight":"800","lineHeight":"1.25"}},"textColor":"dark"} -->
				<h3 class="wp-block-heading has-dark-color has-text-color" style="font-size:1.5rem;font-weight:800;line-height:1.25;margin-bottom:0.5rem">Save Big on Smart Tech &amp; Audio</h3>
				<!-- /wp:heading -->
				<!-- wp:paragraph {"style":{"typography":{"fontSize":"0.875rem"}}} -->
				<p style="font-size:0.875rem;color:#475569;margin-bottom:1.5rem">Get up to 40% discount on noise-cancelling headphones and lifestyle wearables.</p>
				<!-- /wp:paragraph -->
				<!-- wp:buttons -->
				<div class="wp-block-buttons">
					<!-- wp:button {"style":{"border":{"radius":"0.75rem"},"color":{"background":"#2563eb","text":"#ffffff"},"typography":{"fontWeight":"700"}}} -->
					<div class="wp-block-button"><a class="wp-block-button__link has-text-color has-background wp-element-button" href="<?php echo esc_url( $shop_url ); ?>" style="border-radius:0.75rem;background-color:#2563eb;color:#ffffff;font-weight:700;padding:0.625rem 1.25rem">Shop Electronics →</a></div>
					<!-- /wp:button -->
				</div>
				<!-- /wp:buttons -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column -->
		<div class="wp-block-column">
			<!-- wp:group {"style":{"spacing":{"padding":{"top":"2rem","bottom":"2rem","left":"2rem","right":"2rem"}},"border":{"radius":"1.25rem"}},"className":"cv-promo-duo-card","layout":{"type":"default"}} -->
			<div class="wp-block-group cv-promo-duo-card" style="border-radius:1.25rem;padding-top:2rem;padding-right:2rem;padding-bottom:2rem;padding-left:2rem;background:linear-gradient(135deg, #fef2f2 0%, #fee2e2 100%)">
				<!-- wp:paragraph {"style":{"typography":{"fontSize":"0.75rem","fontWeight":"800"}}} -->
				<p style="font-size:0.75rem;font-weight:800;color:#dc2626;text-transform:uppercase;letter-spacing:0.05em;margin-bottom:0.5rem">WEEKEND SPECIAL</p>
				<!-- /wp:paragraph -->
				<!-- wp:heading {"level":3,"style":{"typography":{"fontSize":"1.5rem","fontWeight":"800","lineHeight":"1.25"}},"textColor":"dark"} -->
				<h3 class="wp-block-heading has-dark-color has-text-color" style="font-size:1.5rem;font-weight:800;line-height:1.25;margin-bottom:0.5rem">New Arrivals &amp; Best Picks</h3>
				<!-- /wp:heading -->
				<!-- wp:paragraph {"style":{"typography":{"fontSize":"0.875rem"}}} -->
				<p style="font-size:0.875rem;color:#475569;margin-bottom:1.5rem">Curated premium essentials direct to your doorstep with guaranteed fast express dispatch.</p>
				<!-- /wp:paragraph -->
				<!-- wp:buttons -->
				<div class="wp-block-buttons">
					<!-- wp:button {"style":{"border":{"radius":"0.75rem"},"color":{"background":"#0f172a","text":"#ffffff"},"typography":{"fontWeight":"700"}}} -->
					<div class="wp-block-button"><a class="wp-block-button__link has-text-color has-background wp-element-button" href="<?php echo esc_url( $shop_url ); ?>" style="border-radius:0.75rem;background-color:#0f172a;color:#ffffff;font-weight:700;padding:0.625rem 1.25rem">Explore Arrivals →</a></div>
					<!-- /wp:button -->
				</div>
				<!-- /wp:buttons -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->
</div>
<!-- /wp:group -->
