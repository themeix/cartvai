<?php
/**
 * Modern Mobile / More Navigation Drawer Component
 *
 * Provides a clean, modern sliding drawer with:
 * - Brand header + quick close
 * - Tabbed navigation (Categories / Main Menu / More) or unified view
 * - High-converting Quick Action buttons (Track Order, My Account, Shop, Cart)
 * - Modern accordion styling for sub-menus with smooth chevrons
 * - Support & Helpline footer
 *
 * @package Cartvai_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$contact_phone               = cartvai_theme_option( 'contact_phone', '+1 (800) 123-4567' );
$header_order_track_enabled  = (bool) cartvai_theme_option( 'header_order_track_enabled', false );
$header_order_track_label    = cartvai_theme_option( 'header_order_track_label', 'Order Track' );
$header_order_track_url      = cartvai_theme_option( 'header_order_track_url', '' );
if ( empty( $header_order_track_url ) ) {
	$header_order_track_url = home_url( '/checkout/' );
}

$cart_url     = home_url( '/cart/' );
$shop_url     = home_url( '/shop/' );
$account_url  = is_user_logged_in() ? admin_url( 'profile.php' ) : wp_login_url( get_permalink() );
$cart_count   = class_exists( 'CARTVAI_Cart' ) ? (int) CARTVAI_Cart::get_count() : 0;

// Determine which menus are registered
$has_more_menu = has_nav_menu( 'more_menu' );
$has_megamenu  = has_nav_menu( 'megamenu' );
$has_primary   = has_nav_menu( 'primary' );
?>
<!-- Mobile Drawer Backdrop Overlay -->
<div id="cv-mobile-overlay" class="cv:fixed cv:inset-0 cv:bg-gray-950/60 cv:backdrop-blur-sm cv:z-[99998] cv:opacity-0 cv:pointer-events-none cv:transition-opacity cv:duration-300" aria-hidden="true"></div>

<!-- Mobile & More Navigation Drawer -->
<div id="cv-mobile-drawer" class="cv-more-drawer cv:fixed cv:inset-y-0 cv:left-0 cv:w-full cv:max-w-sm cv:bg-white cv:z-[99999] cv:shadow-2xl cv:transform cv:-translate-x-full cv:transition-transform cv:duration-300 cv:ease-out cv:flex cv:flex-col cv:overflow-hidden" aria-hidden="true" inert role="dialog" aria-modal="true" aria-label="<?php esc_attr_e( 'Menu Drawer', 'cartvai' ); ?>">

	<!-- Drawer Header Bar -->
	<div class="cv-drawer-header cv:flex cv:items-center cv:justify-between cv:px-5 cv:py-4 cv:bg-slate-900 cv:text-white cv:border-b cv:border-slate-800">
		<div class="cv:flex cv:items-center cv:gap-3">
			<div class="cv:w-8 cv:h-8 cv:rounded-lg cv:bg-white/10 cv:flex cv:items-center cv:justify-center cv:text-amber-400">
				<svg class="cv:w-5 cv:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
			</div>
			<div>
				<span class="cv:font-bold cv:text-base cv:block cv:leading-tight"><?php bloginfo( 'name' ); ?></span>
				<span class="cv:text-[11px] cv:text-slate-400 cv:block"><?php esc_html_e( 'Store Navigation', 'cartvai' ); ?></span>
			</div>
		</div>
		<button type="button" id="cv-mobile-close" class="cv:w-8 cv:h-8 cv:rounded-lg cv:bg-white/10 hover:cv:bg-white/20 cv:text-slate-300 hover:cv:text-white cv:flex cv:items-center cv:justify-center cv:transition-colors" aria-label="<?php esc_attr_e( 'Close menu', 'cartvai' ); ?>">
			<svg class="cv:w-5 cv:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
		</button>
	</div>

	<!-- Drawer Search Bar -->
	<div class="cv:p-4 cv:border-b cv:border-slate-100 cv:bg-slate-50/70">
		<?php get_search_form(); ?>
	</div>

	<!-- Quick Action Utilities Strip -->
	<div class="cv:px-4 cv:py-3 cv:bg-white cv:border-b cv:border-slate-100 cv:grid cv:grid-cols-2 cv:gap-2">
		<a href="<?php echo esc_url( $account_url ); ?>" class="cv:flex cv:flex-col cv:items-center cv:justify-center cv:p-2.5 cv:rounded-xl cv:bg-slate-50 hover:cv:bg-slate-100 cv:border cv:border-slate-200/70 cv:text-slate-700 hover:cv:text-slate-900 cv:transition-all">
			<svg class="cv:w-4 cv:h-4 cv:text-slate-600 cv:mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
			</svg>
			<span class="cv:text-[11px] cv:font-semibold cv:leading-none">
				<?php echo is_user_logged_in() ? esc_html__( 'Account', 'cartvai' ) : esc_html__( 'Sign In', 'cartvai' ); ?>
			</span>
		</a>

		<a href="<?php echo esc_url( $cart_url ); ?>" class="cv:relative cv:flex cv:flex-col cv:items-center cv:justify-center cv:p-2.5 cv:rounded-xl cv:bg-slate-50 hover:cv:bg-slate-100 cv:border cv:border-slate-200/70 cv:text-slate-700 hover:cv:text-slate-900 cv:transition-all">
			<div class="cv:relative cv:mb-1">
				<svg class="cv:w-4 cv:h-4 cv:text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
				</svg>
				<span class="cartvai-mini-cart-count-badge cv:absolute cv:-top-1.5 cv:-right-2.5 cv:inline-flex cv:items-center cv:justify-center cv:min-w-[15px] cv:h-[15px] cv:px-1 cv:rounded-full cv:bg-amber-500 cv:text-slate-950 cv:text-[9px] cv:font-extrabold cv:leading-none" data-cartvai-mini-cart-count data-cartvai-count <?php echo $cart_count > 0 ? '' : 'style="display:none;"'; ?>>
					<?php echo esc_html( $cart_count ); ?>
				</span>
			</div>
			<span class="cv:text-[11px] cv:font-semibold cv:leading-none"><?php esc_html_e( 'My Cart', 'cartvai' ); ?></span>
		</a>
	</div>

	<!-- Drawer Scrollable Content Area -->
	<div class="cv:flex-1 cv:overflow-y-auto cv:p-4 cv:space-y-4">

		<!-- More Menu / Custom Links Section (if registered) -->
		<?php if ( $has_more_menu ) : ?>
			<div class="cv-drawer-section">
				<div class="cv:text-[11px] cv:font-bold cv:uppercase cv:tracking-wider cv:text-slate-400 cv:px-2 cv:mb-1.5">
					<?php esc_html_e( 'Explore & More', 'cartvai' ); ?>
				</div>
				<nav class="cv-mobile-nav" aria-label="<?php esc_attr_e( 'More Menu', 'cartvai' ); ?>">
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'more_menu',
							'container'      => false,
							'menu_class'     => 'cv-mobile-menu-list cv:space-y-1',
							'fallback_cb'    => false,
						)
					);
					?>
				</nav>
			</div>
		<?php endif; ?>

		<!-- Categories Section (Mega Menu bar items) -->
		<?php if ( $has_megamenu ) : ?>
			<div class="cv-drawer-section">
				<div class="cv:text-[11px] cv:font-bold cv:uppercase cv:tracking-wider cv:text-slate-400 cv:px-2 cv:mb-1.5">
					<?php esc_html_e( 'Product Categories', 'cartvai' ); ?>
				</div>
				<nav class="cv-mobile-nav" aria-label="<?php esc_attr_e( 'Categories Menu', 'cartvai' ); ?>">
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'megamenu',
							'container'      => false,
							'menu_class'     => 'cv-mobile-menu-list cv:space-y-1',
							'fallback_cb'    => false,
						)
					);
					?>
				</nav>
			</div>
		<?php endif; ?>

		<!-- Primary Menu Section -->
		<?php if ( $has_primary && ( ! $has_more_menu || ! $has_megamenu ) ) : ?>
			<div class="cv-drawer-section">
				<div class="cv:text-[11px] cv:font-bold cv:uppercase cv:tracking-wider cv:text-slate-400 cv:px-2 cv:mb-1.5">
					<?php esc_html_e( 'Main Menu', 'cartvai' ); ?>
				</div>
				<nav class="cv-mobile-nav" aria-label="<?php esc_attr_e( 'Primary Menu', 'cartvai' ); ?>">
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'primary',
							'container'      => false,
							'menu_class'     => 'cv-mobile-menu-list cv:space-y-1',
							'fallback_cb'    => false,
						)
					);
					?>
				</nav>
			</div>
		<?php endif; ?>

	</div>

	<!-- Drawer Footer Info -->
	<div class="cv:p-4 cv:border-t cv:border-slate-100 cv:bg-slate-50 cv:flex cv:items-center cv:justify-between">
		<?php if ( ! empty( $contact_phone ) ) : ?>
			<a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $contact_phone ) ); ?>" class="cv:flex cv:items-center cv:gap-2 cv:text-xs cv:font-semibold cv:text-slate-700 hover:cv:text-slate-900">
				<span class="cv:w-7 cv:h-7 cv:rounded-full cv:bg-emerald-100 cv:text-emerald-700 cv:flex cv:items-center cv:justify-center">
					<svg class="cv:w-3.5 cv:h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
				</span>
				<span><?php echo esc_html( $contact_phone ); ?></span>
			</a>
		<?php endif; ?>
		<span class="cv:text-[10px] cv:font-semibold cv:text-slate-400 cv:uppercase cv:tracking-wider">
			<?php esc_html_e( 'Official Store', 'cartvai' ); ?>
		</span>
	</div>

</div>
