<?php
/**
 * Title: Cartvai - Customer Reviews & Verified Testimonials
 * Slug: cartvai-theme/testimonials
 * Categories: cartvai, testimonials
 * Description: 3-column customer review grid with 5-star rating, quotes, reviewer avatars, and verified badges.
 *
 * @package Cartvai_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"1rem","bottom":"2.5rem"}}},"className":"cv-home-section","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide cv-home-section" style="padding-top:1rem;padding-bottom:2.5rem">
	<div class="cv-shelf-header">
		<!-- wp:heading {"level":3,"className":"cv-shelf-title"} -->
		<h3 class="wp-block-heading cv-shelf-title">Customer Reviews</h3>
		<!-- /wp:heading -->
		<span style="font-size:0.75rem;color:#64748b;font-weight:600">Verified Buyer Experiences</span>
	</div>

	<!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"left":"1.25rem","top":"1.25rem"}}}} -->
	<div class="wp-block-columns alignwide">
		<!-- wp:column -->
		<div class="wp-block-column">
			<!-- wp:group {"style":{"spacing":{"padding":{"top":"1.5rem","bottom":"1.5rem","left":"1.5rem","right":"1.5rem"}},"border":{"radius":"1.25rem"}},"className":"cv-testimonial-card","layout":{"type":"default"}} -->
			<div class="wp-block-group cv-testimonial-card" style="border-radius:1.25rem;padding-top:1.5rem;padding-right:1.5rem;padding-bottom:1.5rem;padding-left:1.5rem">
				<div style="color:#f59e0b;font-size:0.875rem;margin-bottom:0.75rem">★★★★★</div>
				<!-- wp:paragraph {"style":{"typography":{"fontSize":"0.875rem","lineHeight":"1.6"}}} -->
				<p style="font-size:0.875rem;line-height:1.6;color:#334155;margin-bottom:1.25rem">&ldquo;The product quality blew away my expectations. Super clean packaging, lightning fast next-day delivery, and customer service answered my question in minutes!&rdquo;</p>
				<!-- /wp:paragraph -->
				<div style="display:flex;align-items:center;gap:0.75rem;padding-top:1rem;border-top:1px solid #f1f5f9">
					<div style="width:2.5rem;height:2.5rem;border-radius:9999px;background:#eff6ff;color:#1e40af;font-weight:700;display:flex;align-items:center;justify-content:center;font-size:0.875rem">AK</div>
					<div>
						<!-- wp:heading {"level":5,"style":{"typography":{"fontSize":"0.8125rem","fontWeight":"700"}}} -->
						<h5 class="wp-block-heading" style="font-size:0.8125rem;font-weight:700;margin:0">Alex Kingston</h5>
						<!-- /wp:heading -->
						<span style="font-size:0.6875rem;color:#059669;font-weight:600">✓ Verified Buyer</span>
					</div>
				</div>
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column -->
		<div class="wp-block-column">
			<!-- wp:group {"style":{"spacing":{"padding":{"top":"1.5rem","bottom":"1.5rem","left":"1.5rem","right":"1.5rem"}},"border":{"radius":"1.25rem"}},"className":"cv-testimonial-card","layout":{"type":"default"}} -->
			<div class="wp-block-group cv-testimonial-card" style="border-radius:1.25rem;padding-top:1.5rem;padding-right:1.5rem;padding-bottom:1.5rem;padding-left:1.5rem">
				<div style="color:#f59e0b;font-size:0.875rem;margin-bottom:0.75rem">★★★★★</div>
				<!-- wp:paragraph {"style":{"typography":{"fontSize":"0.875rem","lineHeight":"1.6"}}} -->
				<p style="font-size:0.875rem;line-height:1.6;color:#334155;margin-bottom:1.25rem">&ldquo;Absolutely love shopping here. The cart checkout flow was seamless on mobile and the discounts were authentic. This is now my default online go-to store.&rdquo;</p>
				<!-- /wp:paragraph -->
				<div style="display:flex;align-items:center;gap:0.75rem;padding-top:1rem;border-top:1px solid #f1f5f9">
					<div style="width:2.5rem;height:2.5rem;border-radius:9999px;background:#ecfdf5;color:#065f46;font-weight:700;display:flex;align-items:center;justify-content:center;font-size:0.875rem">SR</div>
					<div>
						<!-- wp:heading {"level":5,"style":{"typography":{"fontSize":"0.8125rem","fontWeight":"700"}}} -->
						<h5 class="wp-block-heading" style="font-size:0.8125rem;font-weight:700;margin:0">Sophia Rodriguez</h5>
						<!-- /wp:heading -->
						<span style="font-size:0.6875rem;color:#059669;font-weight:600">✓ Verified Buyer</span>
					</div>
				</div>
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column -->
		<div class="wp-block-column">
			<!-- wp:group {"style":{"spacing":{"padding":{"top":"1.5rem","bottom":"1.5rem","left":"1.5rem","right":"1.5rem"}},"border":{"radius":"1.25rem"}},"className":"cv-testimonial-card","layout":{"type":"default"}} -->
			<div class="wp-block-group cv-testimonial-card" style="border-radius:1.25rem;padding-top:1.5rem;padding-right:1.5rem;padding-bottom:1.5rem;padding-left:1.5rem">
				<div style="color:#f59e0b;font-size:0.875rem;margin-bottom:0.75rem">★★★★★</div>
				<!-- wp:paragraph {"style":{"typography":{"fontSize":"0.875rem","lineHeight":"1.6"}}} -->
				<p style="font-size:0.875rem;line-height:1.6;color:#334155;margin-bottom:1.25rem">&ldquo;High standard build quality and crystal clear sound. Hassle-free warranty registration and 100% genuine item as advertised. 10/10 recommendation!&rdquo;</p>
				<!-- /wp:paragraph -->
				<div style="display:flex;align-items:center;gap:0.75rem;padding-top:1rem;border-top:1px solid #f1f5f9">
					<div style="width:2.5rem;height:2.5rem;border-radius:9999px;background:#fef3c7;color:#92400e;font-weight:700;display:flex;align-items:center;justify-content:center;font-size:0.875rem">MT</div>
					<div>
						<!-- wp:heading {"level":5,"style":{"typography":{"fontSize":"0.8125rem","fontWeight":"700"}}} -->
						<h5 class="wp-block-heading" style="font-size:0.8125rem;font-weight:700;margin:0">Marcus Thorne</h5>
						<!-- /wp:heading -->
						<span style="font-size:0.6875rem;color:#059669;font-weight:600">✓ Verified Buyer</span>
					</div>
				</div>
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->
</div>
<!-- /wp:group -->
