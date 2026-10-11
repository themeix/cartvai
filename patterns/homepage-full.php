<?php
/**
 * Title: Cartvai - Complete Modern Ecommerce Homepage
 * Slug: cartvai-theme/homepage-full
 * Categories: cartvai, featured
 * Description: Complete turnkey ecommerce homepage using native Gutenberg block settings for colors, spacing, borders, and typography.
 *
 * @package Cartvai_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$shop_url = function_exists( 'cartvai_get_shop_page_url' ) ? cartvai_get_shop_page_url() : home_url( '/shop/' );
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"24px","bottom":"48px"},"blockGap":"40px"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="padding-top:24px;padding-bottom:48px"><!-- wp:group {"align":"wide","style":{"color":{"text":"#ffffff","gradient":"linear-gradient(135deg,rgb(15,23,42) 0%,rgb(30,58,138) 40%,rgb(29,78,216) 75%,rgb(23,37,84) 100%)"},"border":{"radius":"24px","width":"1px","style":"solid","color":"rgba(255,255,255,0.15)"},"spacing":{"padding":{"top":"48px","bottom":"48px","left":"40px","right":"40px"}}},"textColor":"white","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide has-white-color has-text-color has-background" style="border-color:rgba(255,255,255,0.15);border-style:solid;border-width:1px;border-radius:24px;background:linear-gradient(135deg,rgb(15,23,42) 0%,rgb(30,58,138) 40%,rgb(29,78,216) 75%,rgb(23,37,84) 100%);color:#ffffff;padding-top:48px;padding-right:40px;padding-bottom:48px;padding-left:40px"><!-- wp:columns {"verticalAlignment":"center","style":{"spacing":{"blockGap":{"left":"32px","top":"32px"}}}} -->
<div class="wp-block-columns are-vertically-aligned-center"><!-- wp:column {"verticalAlignment":"center","width":"58%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:58%"><!-- wp:paragraph {"style":{"color":{"background":"rgba(255,255,255,0.12)","text":"#fbbf24"},"spacing":{"padding":{"top":"6px","bottom":"6px","left":"14px","right":"14px"},"margin":{"bottom":"16px"}},"border":{"radius":"9999px","width":"1px","style":"solid","color":"rgba(255,255,255,0.2)"},"typography":{"fontSize":"12px","fontWeight":"700","letterSpacing":"0.05em","textTransform":"uppercase"}}} -->
<p class="has-text-color has-background" style="border-color:rgba(255,255,255,0.2);border-style:solid;border-width:1px;border-radius:9999px;background-color:rgba(255,255,255,0.12);color:#fbbf24;font-size:12px;font-weight:700;letter-spacing:0.05em;text-transform:uppercase;margin-bottom:16px;padding-top:6px;padding-right:14px;padding-bottom:6px;padding-left:14px;display:inline-block"><span class="cv-hero-badge-pulse" style="display:inline-block;width:8px;height:8px;border-radius:9999px;background-color:#fbbf24;margin-right:6px"></span>⚡ LIMITED TIME MEGA SALE • UP TO 50% OFF</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":1,"style":{"color":{"text":"#ffffff"},"typography":{"fontSize":"42px","lineHeight":"1.15","fontWeight":"800"},"spacing":{"margin":{"top":"0px","bottom":"16px"}}}} -->
<h1 class="wp-block-heading has-text-color" style="color:#ffffff;font-size:42px;font-weight:800;line-height:1.15;margin-top:0px;margin-bottom:16px">Next-Gen Tech &amp; Premium Lifestyle Gear</h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"color":{"text":"rgba(224,231,255,0.9)"},"typography":{"fontSize":"17px","lineHeight":"1.6"},"spacing":{"margin":{"top":"0px","bottom":"24px"}}}} -->
<p class="has-text-color" style="color:rgba(224,231,255,0.9);font-size:17px;line-height:1.6;margin-top:0px;margin-bottom:24px">Upgrade your daily routine with top-rated smart devices, audio accessories, and modern essentials at unbeatable prices.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"style":{"spacing":{"blockGap":"16px","margin":{"top":"0px","bottom":"20px"}}}} -->
<div class="wp-block-buttons" style="margin-top:0px;margin-bottom:20px"><!-- wp:button {"style":{"color":{"background":"#fbbf24","text":"#0f172a"},"border":{"radius":"12px"},"spacing":{"padding":{"top":"12px","bottom":"12px","left":"24px","right":"24px"}},"typography":{"fontWeight":"700"}}} -->
<div class="wp-block-button"><a class="wp-block-button__link has-text-color has-background wp-element-button" href="<?php echo esc_url( $shop_url ); ?>" style="border-radius:12px;background-color:#fbbf24;color:#0f172a;font-weight:700;padding-top:12px;padding-right:24px;padding-bottom:12px;padding-left:24px">Shop Collection →</a></div>
<!-- /wp:button -->

<!-- wp:button {"style":{"color":{"background":"rgba(255,255,255,0.15)","text":"#ffffff"},"border":{"radius":"12px","width":"1px","style":"solid","color":"rgba(255,255,255,0.3)"},"spacing":{"padding":{"top":"12px","bottom":"12px","left":"24px","right":"24px"}},"typography":{"fontWeight":"600"}}} -->
<div class="wp-block-button"><a class="wp-block-button__link has-text-color has-background wp-element-button" href="<?php echo esc_url( $shop_url ); ?>" style="border-color:rgba(255,255,255,0.3);border-style:solid;border-width:1px;border-radius:12px;background-color:rgba(255,255,255,0.15);color:#ffffff;font-weight:600;padding-top:12px;padding-right:24px;padding-bottom:12px;padding-left:24px">View Flash Deals</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons -->

<!-- wp:paragraph {"style":{"color":{"text":"rgba(203,213,225,0.9)"},"typography":{"fontSize":"13px"},"spacing":{"margin":{"top":"0px","bottom":"0px"}}}} -->
<p class="has-text-color" style="color:rgba(203,213,225,0.9);font-size:13px;margin-top:0px;margin-bottom:0px">✓ Free Express Delivery • ✓ 30-Day Money-Back • ✓ Official Warranty</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"center","width":"42%"} -->
<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:42%"><!-- wp:group {"style":{"color":{"background":"rgba(255,255,255,0.08)"},"border":{"radius":"24px","width":"1px","style":"solid","color":"rgba(255,255,255,0.2)"},"spacing":{"padding":{"top":"24px","bottom":"24px","left":"24px","right":"24px"},"blockGap":"12px"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group has-background" style="border-color:rgba(255,255,255,0.2);border-style:solid;border-width:1px;border-radius:24px;background-color:rgba(255,255,255,0.08);padding-top:24px;padding-right:24px;padding-bottom:24px;padding-left:24px"><!-- wp:paragraph {"align":"center","style":{"color":{"background":"#fbbf24","text":"#0f172a"},"border":{"radius":"9999px"},"spacing":{"padding":{"top":"4px","bottom":"4px","left":"12px","right":"12px"},"margin":{"bottom":"8px"}},"typography":{"fontSize":"11px","fontWeight":"800"}}} -->
<p class="has-text-align-center has-text-color has-background" style="border-radius:9999px;background-color:#fbbf24;color:#0f172a;font-size:11px;font-weight:800;margin-bottom:8px;padding-top:4px;padding-right:12px;padding-bottom:4px;padding-left:12px;display:inline-block">⚡ TOP RATED</p>
<!-- /wp:paragraph -->

<!-- wp:image {"sizeSlug":"full","linkDestination":"none"} -->
<figure class="wp-block-image size-full"><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/hero-headphones.svg' ); ?>" alt="Spatial Audio Pro" style="max-height:160px;width:auto;margin:0 auto;display:block"/></figure>
<!-- /wp:image -->

<!-- wp:paragraph {"align":"center","style":{"color":{"background":"#ffffff","text":"#0f172a"},"border":{"radius":"9999px"},"spacing":{"padding":{"top":"6px","bottom":"6px","left":"14px","right":"14px"},"margin":{"top":"8px","bottom":"0px"}},"typography":{"fontSize":"12px","fontWeight":"700"}}} -->
<p class="has-text-align-center has-text-color has-background" style="border-radius:9999px;background-color:#ffffff;color:#0f172a;font-size:12px;font-weight:700;margin-top:8px;margin-bottom:0px;padding-top:6px;padding-right:14px;padding-bottom:6px;padding-left:14px;display:inline-block"><span style="color:#f59e0b">★★★★★</span> 4.9 / 5.0 Rating</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->

<!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"8px","bottom":"8px"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide" style="padding-top:8px;padding-bottom:8px"><!-- wp:columns {"style":{"spacing":{"blockGap":{"left":"16px","top":"16px"}}}} -->
<div class="wp-block-columns"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"style":{"color":{"background":"#ffffff"},"border":{"radius":"16px","width":"1px","style":"solid","color":"#e2e8f0"},"spacing":{"padding":{"top":"18px","bottom":"18px","left":"18px","right":"18px"},"blockGap":"12px"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
<div class="wp-block-group has-background" style="border-color:#e2e8f0;border-style:solid;border-width:1px;border-radius:16px;background-color:#ffffff;padding-top:18px;padding-right:18px;padding-bottom:18px;padding-left:18px"><!-- wp:paragraph {"style":{"color":{"background":"#eff6ff","text":"#2563eb"},"border":{"radius":"12px"},"spacing":{"padding":{"top":"10px","bottom":"10px","left":"10px","right":"10px"},"margin":{"top":"0px","bottom":"0px"}},"typography":{"fontSize":"22px"}}} -->
<p class="has-text-color has-background" style="border-radius:12px;background-color:#eff6ff;color:#2563eb;font-size:22px;line-height:1;margin-top:0px;margin-bottom:0px;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px">🚚</p>
<!-- /wp:paragraph -->

<!-- wp:group {"style":{"spacing":{"blockGap":"2px"}},"layout":{"type":"default"}} -->
<div class="wp-block-group"><!-- wp:heading {"level":4,"style":{"color":{"text":"#0f172a"},"typography":{"fontSize":"15px","fontWeight":"800"},"spacing":{"margin":{"top":"0px","bottom":"2px"}}}} -->
<h4 class="wp-block-heading has-text-color" style="color:#0f172a;font-size:15px;font-weight:800;margin-top:0px;margin-bottom:2px">Free Express Shipping</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"color":{"text":"#64748b"},"typography":{"fontSize":"13px"},"spacing":{"margin":{"top":"0px","bottom":"0px"}}}} -->
<p class="has-text-color" style="color:#64748b;font-size:13px;margin-top:0px;margin-bottom:0px">On all eligible orders over $50</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"style":{"color":{"background":"#ffffff"},"border":{"radius":"16px","width":"1px","style":"solid","color":"#e2e8f0"},"spacing":{"padding":{"top":"18px","bottom":"18px","left":"18px","right":"18px"},"blockGap":"12px"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
<div class="wp-block-group has-background" style="border-color:#e2e8f0;border-style:solid;border-width:1px;border-radius:16px;background-color:#ffffff;padding-top:18px;padding-right:18px;padding-bottom:18px;padding-left:18px"><!-- wp:paragraph {"style":{"color":{"background":"#ecfdf5","text":"#059669"},"border":{"radius":"12px"},"spacing":{"padding":{"top":"10px","bottom":"10px","left":"10px","right":"10px"},"margin":{"top":"0px","bottom":"0px"}},"typography":{"fontSize":"22px"}}} -->
<p class="has-text-color has-background" style="border-radius:12px;background-color:#ecfdf5;color:#059669;font-size:22px;line-height:1;margin-top:0px;margin-bottom:0px;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px">🛡️</p>
<!-- /wp:paragraph -->

<!-- wp:group {"style":{"spacing":{"blockGap":"2px"}},"layout":{"type":"default"}} -->
<div class="wp-block-group"><!-- wp:heading {"level":4,"style":{"color":{"text":"#0f172a"},"typography":{"fontSize":"15px","fontWeight":"800"},"spacing":{"margin":{"top":"0px","bottom":"2px"}}}} -->
<h4 class="wp-block-heading has-text-color" style="color:#0f172a;font-size:15px;font-weight:800;margin-top:0px;margin-bottom:2px">100% Secure Checkout</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"color":{"text":"#64748b"},"typography":{"fontSize":"13px"},"spacing":{"margin":{"top":"0px","bottom":"0px"}}}} -->
<p class="has-text-color" style="color:#64748b;font-size:13px;margin-top:0px;margin-bottom:0px">Encrypted 256-bit SSL protection</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"style":{"color":{"background":"#ffffff"},"border":{"radius":"16px","width":"1px","style":"solid","color":"#e2e8f0"},"spacing":{"padding":{"top":"18px","bottom":"18px","left":"18px","right":"18px"},"blockGap":"12px"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
<div class="wp-block-group has-background" style="border-color:#e2e8f0;border-style:solid;border-width:1px;border-radius:16px;background-color:#ffffff;padding-top:18px;padding-right:18px;padding-bottom:18px;padding-left:18px"><!-- wp:paragraph {"style":{"color":{"background":"#fffbeb","text":"#d97706"},"border":{"radius":"12px"},"spacing":{"padding":{"top":"10px","bottom":"10px","left":"10px","right":"10px"},"margin":{"top":"0px","bottom":"0px"}},"typography":{"fontSize":"22px"}}} -->
<p class="has-text-color has-background" style="border-radius:12px;background-color:#fffbeb;color:#d97706;font-size:22px;line-height:1;margin-top:0px;margin-bottom:0px;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px">🔄</p>
<!-- /wp:paragraph -->

<!-- wp:group {"style":{"spacing":{"blockGap":"2px"}},"layout":{"type":"default"}} -->
<div class="wp-block-group"><!-- wp:heading {"level":4,"style":{"color":{"text":"#0f172a"},"typography":{"fontSize":"15px","fontWeight":"800"},"spacing":{"margin":{"top":"0px","bottom":"2px"}}}} -->
<h4 class="wp-block-heading has-text-color" style="color:#0f172a;font-size:15px;font-weight:800;margin-top:0px;margin-bottom:2px">30-Day Easy Returns</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"color":{"text":"#64748b"},"typography":{"fontSize":"13px"},"spacing":{"margin":{"top":"0px","bottom":"0px"}}}} -->
<p class="has-text-color" style="color:#64748b;font-size:13px;margin-top:0px;margin-bottom:0px">Hassle-free money-back policy</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"style":{"color":{"background":"#ffffff"},"border":{"radius":"16px","width":"1px","style":"solid","color":"#e2e8f0"},"spacing":{"padding":{"top":"18px","bottom":"18px","left":"18px","right":"18px"},"blockGap":"12px"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
<div class="wp-block-group has-background" style="border-color:#e2e8f0;border-style:solid;border-width:1px;border-radius:16px;background-color:#ffffff;padding-top:18px;padding-right:18px;padding-bottom:18px;padding-left:18px"><!-- wp:paragraph {"style":{"color":{"background":"#f5f3ff","text":"#7c3aed"},"border":{"radius":"12px"},"spacing":{"padding":{"top":"10px","bottom":"10px","left":"10px","right":"10px"},"margin":{"top":"0px","bottom":"0px"}},"typography":{"fontSize":"22px"}}} -->
<p class="has-text-color has-background" style="border-radius:12px;background-color:#f5f3ff;color:#7c3aed;font-size:22px;line-height:1;margin-top:0px;margin-bottom:0px;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px">💬</p>
<!-- /wp:paragraph -->

<!-- wp:group {"style":{"spacing":{"blockGap":"2px"}},"layout":{"type":"default"}} -->
<div class="wp-block-group"><!-- wp:heading {"level":4,"style":{"color":{"text":"#0f172a"},"typography":{"fontSize":"15px","fontWeight":"800"},"spacing":{"margin":{"top":"0px","bottom":"2px"}}}} -->
<h4 class="wp-block-heading has-text-color" style="color:#0f172a;font-size:15px;font-weight:800;margin-top:0px;margin-bottom:2px">24/7 Dedicated Support</h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"color":{"text":"#64748b"},"typography":{"fontSize":"13px"},"spacing":{"margin":{"top":"0px","bottom":"0px"}}}} -->
<p class="has-text-color" style="color:#64748b;font-size:13px;margin-top:0px;margin-bottom:0px">Live agent assistance any time</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group -->

<!-- wp:group {"align":"wide","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide"><!-- wp:group {"style":{"spacing":{"margin":{"bottom":"20px"}}},"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between","verticalAlignment":"center"}} -->
<div class="wp-block-group" style="margin-bottom:20px"><!-- wp:group {"style":{"spacing":{"blockGap":"4px"}},"layout":{"type":"default"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"style":{"color":{"text":"#2563eb"},"typography":{"fontSize":"12px","fontWeight":"800","letterSpacing":"0.05em","textTransform":"uppercase"},"spacing":{"margin":{"bottom":"4px"}}}} -->
<p class="has-text-color" style="color:#2563eb;font-size:12px;font-weight:800;letter-spacing:0.05em;text-transform:uppercase;margin-bottom:4px">CURATED COLLECTIONS</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2,"style":{"color":{"text":"#0f172a"},"typography":{"fontSize":"24px","fontWeight":"800"},"spacing":{"margin":{"top":"0px","bottom":"2px"}}}} -->
<h2 class="wp-block-heading has-text-color" style="color:#0f172a;font-size:24px;font-weight:800;margin-top:0px;margin-bottom:2px">Explore By Popular Categories</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"color":{"text":"#64748b"},"typography":{"fontSize":"14px"},"spacing":{"margin":{"top":"0px","bottom":"0px"}}}} -->
<p class="has-text-color" style="color:#64748b;font-size:14px;margin-top:0px;margin-bottom:0px">Discover trending electronics, everyday essentials, and tech accessories</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"14px","fontWeight":"600"}}} -->
<p style="font-size:14px;font-weight:600"><a href="<?php echo esc_url( $shop_url ); ?>">View All Categories →</a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:shortcode -->
[cartvai_categories columns="6"]
<!-- /wp:shortcode --></div>
<!-- /wp:group -->

<!-- wp:group {"align":"wide","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide"><!-- wp:group {"style":{"spacing":{"margin":{"bottom":"20px"}}},"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between","verticalAlignment":"center"}} -->
<div class="wp-block-group" style="margin-bottom:20px"><!-- wp:group {"style":{"spacing":{"blockGap":"4px"}},"layout":{"type":"default"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"style":{"color":{"text":"#2563eb"},"typography":{"fontSize":"12px","fontWeight":"800","letterSpacing":"0.05em","textTransform":"uppercase"},"spacing":{"margin":{"bottom":"4px"}}}} -->
<p class="has-text-color" style="color:#2563eb;font-size:12px;font-weight:800;letter-spacing:0.05em;text-transform:uppercase;margin-bottom:4px">CUSTOMER FAVORITES</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2,"style":{"color":{"text":"#0f172a"},"typography":{"fontSize":"24px","fontWeight":"800"},"spacing":{"margin":{"top":"0px","bottom":"2px"}}}} -->
<h2 class="wp-block-heading has-text-color" style="color:#0f172a;font-size:24px;font-weight:800;margin-top:0px;margin-bottom:2px">Top Trending &amp; Best Sellers</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"color":{"text":"#64748b"},"typography":{"fontSize":"14px"},"spacing":{"margin":{"top":"0px","bottom":"0px"}}}} -->
<p class="has-text-color" style="color:#64748b;font-size:14px;margin-top:0px;margin-bottom:0px">Handpicked products loved by thousands of our happy customers</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"14px","fontWeight":"600"}}} -->
<p style="font-size:14px;font-weight:600"><a href="<?php echo esc_url( $shop_url ); ?>">View All Best Sellers →</a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:shortcode -->
[cartvai_products limit="8" columns="4"]
<!-- /wp:shortcode --></div>
<!-- /wp:group -->

<!-- wp:group {"align":"wide","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide"><!-- wp:group {"style":{"spacing":{"margin":{"bottom":"20px"}}},"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between","verticalAlignment":"center"}} -->
<div class="wp-block-group" style="margin-bottom:20px"><!-- wp:group {"style":{"spacing":{"blockGap":"4px"}},"layout":{"type":"default"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"style":{"color":{"text":"#2563eb"},"typography":{"fontSize":"12px","fontWeight":"800","letterSpacing":"0.05em","textTransform":"uppercase"},"spacing":{"margin":{"bottom":"4px"}}}} -->
<p class="has-text-color" style="color:#2563eb;font-size:12px;font-weight:800;letter-spacing:0.05em;text-transform:uppercase;margin-bottom:4px">WEEKLY HIGHLIGHTS</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2,"style":{"color":{"text":"#0f172a"},"typography":{"fontSize":"24px","fontWeight":"800"},"spacing":{"margin":{"top":"0px","bottom":"2px"}}}} -->
<h2 class="wp-block-heading has-text-color" style="color:#0f172a;font-size:24px;font-weight:800;margin-top:0px;margin-bottom:2px">Weekly Special Offers</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"color":{"text":"#64748b"},"typography":{"fontSize":"14px"},"spacing":{"margin":{"top":"0px","bottom":"0px"}}}} -->
<p class="has-text-color" style="color:#64748b;font-size:14px;margin-top:0px;margin-bottom:0px">Limited quantity discounts updated every Monday morning</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:paragraph {"style":{"typography":{"fontSize":"14px","fontWeight":"600"}}} -->
<p style="font-size:14px;font-weight:600"><a href="<?php echo esc_url( $shop_url ); ?>">Explore All Products →</a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:shortcode -->
[cartvai_products limit="4" columns="4"]
<!-- /wp:shortcode --></div>
<!-- /wp:group -->

<!-- wp:group {"align":"wide","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide"><!-- wp:group {"style":{"spacing":{"margin":{"bottom":"24px"}}},"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between","verticalAlignment":"center"}} -->
<div class="wp-block-group" style="margin-bottom:24px"><!-- wp:group {"style":{"spacing":{"blockGap":"4px"}},"layout":{"type":"default"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"style":{"color":{"text":"#2563eb"},"typography":{"fontSize":"12px","fontWeight":"800","letterSpacing":"0.05em","textTransform":"uppercase"},"spacing":{"margin":{"bottom":"4px"}}}} -->
<p class="has-text-color" style="color:#2563eb;font-size:12px;font-weight:800;letter-spacing:0.05em;text-transform:uppercase;margin-bottom:4px">SOCIAL PROOF</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2,"style":{"color":{"text":"#0f172a"},"typography":{"fontSize":"24px","fontWeight":"800"},"spacing":{"margin":{"top":"0px","bottom":"2px"}}}} -->
<h2 class="wp-block-heading has-text-color" style="color:#0f172a;font-size:24px;font-weight:800;margin-top:0px;margin-bottom:2px">Loved By Thousands of Shoppers</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"color":{"text":"#64748b"},"typography":{"fontSize":"14px"},"spacing":{"margin":{"top":"0px","bottom":"0px"}}}} -->
<p class="has-text-color" style="color:#64748b;font-size:14px;margin-top:0px;margin-bottom:0px">Read real feedback from our verified global community</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:paragraph {"style":{"color":{"background":"#eff6ff","text":"#1d4ed8"},"border":{"radius":"9999px","width":"1px","style":"solid","color":"#bfdbfe"},"spacing":{"padding":{"top":"6px","bottom":"6px","left":"12px","right":"12px"}},"typography":{"fontSize":"13px","fontWeight":"700"}}} -->
<p class="has-text-color has-background" style="border-color:#bfdbfe;border-style:solid;border-width:1px;border-radius:9999px;background-color:#eff6ff;color:#1d4ed8;font-size:13px;font-weight:700;padding-top:6px;padding-right:12px;padding-bottom:6px;padding-left:12px">★★★★★ 4.9 / 5.0 Customer Rating</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:columns {"style":{"spacing":{"blockGap":{"left":"20px","top":"20px"}}}} -->
<div class="wp-block-columns"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"style":{"color":{"background":"#ffffff"},"border":{"radius":"16px","width":"1px","style":"solid","color":"#e2e8f0"},"spacing":{"padding":{"top":"24px","bottom":"24px","left":"24px","right":"24px"},"blockGap":"10px"}},"layout":{"type":"default"}} -->
<div class="wp-block-group has-background" style="border-color:#e2e8f0;border-style:solid;border-width:1px;border-radius:16px;background-color:#ffffff;padding-top:24px;padding-right:24px;padding-bottom:24px;padding-left:24px"><!-- wp:paragraph {"style":{"color":{"text":"#f59e0b"},"typography":{"fontSize":"16px"},"spacing":{"margin":{"bottom":"8px"}}}} -->
<p class="has-text-color" style="color:#f59e0b;font-size:16px;margin-bottom:8px">★★★★★</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"color":{"text":"#334155"},"typography":{"fontSize":"14px","lineHeight":"1.6"},"spacing":{"margin":{"bottom":"16px"}}}} -->
<p class="has-text-color" style="color:#334155;font-size:14px;line-height:1.6;margin-bottom:16px">“Fastest delivery I have ever experienced. The packaging was immaculate and product quality exceeded all expectations.”</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3,"style":{"color":{"text":"#0f172a"},"typography":{"fontSize":"15px","fontWeight":"700"},"spacing":{"margin":{"top":"0px","bottom":"2px"}}}} -->
<h3 class="wp-block-heading has-text-color" style="color:#0f172a;font-size:15px;font-weight:700;margin-top:0px;margin-bottom:2px">Sarah Jenkins</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"color":{"text":"#64748b"},"typography":{"fontSize":"12px"},"spacing":{"margin":{"top":"0px","bottom":"0px"}}}} -->
<p class="has-text-color" style="color:#64748b;font-size:12px;margin-top:0px;margin-bottom:0px">Verified Buyer · California, US</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"style":{"color":{"background":"#ffffff"},"border":{"radius":"16px","width":"1px","style":"solid","color":"#e2e8f0"},"spacing":{"padding":{"top":"24px","bottom":"24px","left":"24px","right":"24px"},"blockGap":"10px"}},"layout":{"type":"default"}} -->
<div class="wp-block-group has-background" style="border-color:#e2e8f0;border-style:solid;border-width:1px;border-radius:16px;background-color:#ffffff;padding-top:24px;padding-right:24px;padding-bottom:24px;padding-left:24px"><!-- wp:paragraph {"style":{"color":{"text":"#f59e0b"},"typography":{"fontSize":"16px"},"spacing":{"margin":{"bottom":"8px"}}}} -->
<p class="has-text-color" style="color:#f59e0b;font-size:16px;margin-bottom:8px">★★★★★</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"color":{"text":"#334155"},"typography":{"fontSize":"14px","lineHeight":"1.6"},"spacing":{"margin":{"bottom":"16px"}}}} -->
<p class="has-text-color" style="color:#334155;font-size:14px;line-height:1.6;margin-bottom:16px">“Customer support answered my questions in seconds and guided me through checkout. Outstanding shopping experience!”</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3,"style":{"color":{"text":"#0f172a"},"typography":{"fontSize":"15px","fontWeight":"700"},"spacing":{"margin":{"top":"0px","bottom":"2px"}}}} -->
<h3 class="wp-block-heading has-text-color" style="color:#0f172a;font-size:15px;font-weight:700;margin-top:0px;margin-bottom:2px">Marcus Vance</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"color":{"text":"#64748b"},"typography":{"fontSize":"12px"},"spacing":{"margin":{"top":"0px","bottom":"0px"}}}} -->
<p class="has-text-color" style="color:#64748b;font-size:12px;margin-top:0px;margin-bottom:0px">Tech Enthusiast · London, UK</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column -->

<!-- wp:column -->
<div class="wp-block-column"><!-- wp:group {"style":{"color":{"background":"#ffffff"},"border":{"radius":"16px","width":"1px","style":"solid","color":"#e2e8f0"},"spacing":{"padding":{"top":"24px","bottom":"24px","left":"24px","right":"24px"},"blockGap":"10px"}},"layout":{"type":"default"}} -->
<div class="wp-block-group has-background" style="border-color:#e2e8f0;border-style:solid;border-width:1px;border-radius:16px;background-color:#ffffff;padding-top:24px;padding-right:24px;padding-bottom:24px;padding-left:24px"><!-- wp:paragraph {"style":{"color":{"text":"#f59e0b"},"typography":{"fontSize":"16px"},"spacing":{"margin":{"bottom":"8px"}}}} -->
<p class="has-text-color" style="color:#f59e0b;font-size:16px;margin-bottom:8px">★★★★★</p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"color":{"text":"#334155"},"typography":{"fontSize":"14px","lineHeight":"1.6"},"spacing":{"margin":{"bottom":"16px"}}}} -->
<p class="has-text-color" style="color:#334155;font-size:14px;line-height:1.6;margin-bottom:16px">“Unbeatable prices on high-end electronics. The 30-day warranty gave me complete peace of mind. Highly recommend!”</p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3,"style":{"color":{"text":"#0f172a"},"typography":{"fontSize":"15px","fontWeight":"700"},"spacing":{"margin":{"top":"0px","bottom":"2px"}}}} -->
<h3 class="wp-block-heading has-text-color" style="color:#0f172a;font-size:15px;font-weight:700;margin-top:0px;margin-bottom:2px">Elena Rostova</h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"color":{"text":"#64748b"},"typography":{"fontSize":"12px"},"spacing":{"margin":{"top":"0px","bottom":"0px"}}}} -->
<p class="has-text-color" style="color:#64748b;font-size:12px;margin-top:0px;margin-bottom:0px">Verified Buyer · Toronto, CA</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
