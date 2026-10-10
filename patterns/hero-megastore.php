<?php
/**
 * Title: Cartvai - Modern Hero Banner
 * Slug: cartvai-theme/hero-megastore
 * Categories: cartvai, featured, header
 * Description: High-converting ecommerce hero banner with featured callout and product showcase using native block settings.
 *
 * @package Cartvai_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$shop_url = function_exists( 'cartvai_get_shop_page_url' ) ? cartvai_get_shop_page_url() : home_url( '/shop/' );
?>
<!-- wp:group {"align":"wide","style":{"color":{"text":"#ffffff","gradient":"linear-gradient(135deg,rgb(15,23,42) 0%,rgb(30,58,138) 40%,rgb(29,78,216) 75%,rgb(23,37,84) 100%)"},"border":{"radius":"24px","width":"1px","style":"solid","color":"rgba(255,255,255,0.15)"},"spacing":{"padding":{"top":"48px","bottom":"48px","left":"40px","right":"40px"}}},"textColor":"white","layout":{"type":"constrained"}} -->
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
