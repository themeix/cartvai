<?php
/**
 * Cartvai Theme Welcome & Getting Started Hub
 *
 * Provides a clean, modern Getting Started Hub under Appearance → Cartvai Theme:
 * - Direct deep-links into the WordPress Customizer sections (Header, Colors, Navbar, Product Cards, Footer)
 * - Video tutorials and walkthroughs showcase container
 * - Documentation and helpful ecommerce setup resources
 * - System status and setup checklist
 *
 * @package Cartvai_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register Appearance → Cartvai Theme Menu Page
 */
function cartvai_theme_add_admin_menu() {
	$cap = defined( 'CARTVAI_THEME_CAPABILITY' ) ? CARTVAI_THEME_CAPABILITY : 'manage_options';

	add_theme_page(
		esc_html__( 'Cartvai Theme', 'cartvai' ),
		esc_html__( 'Cartvai Theme', 'cartvai' ),
		$cap,
		'cartvai-theme',
		'cartvai_theme_render_welcome_page'
	);

	add_theme_page(
		esc_html__( 'Demo Import', 'cartvai' ),
		esc_html__( 'Demo Import', 'cartvai' ),
		$cap,
		'cartvai-demo-importer',
		'cartvai_theme_render_demo_importer_page'
	);
}
add_action( 'admin_menu', 'cartvai_theme_add_admin_menu' );

/**
 * Render Demo Importer page directly from submenu
 */
function cartvai_theme_render_demo_importer_page() {
	if ( class_exists( 'CARTVAI_Theme_Demo_Importer' ) ) {
		CARTVAI_Theme_Demo_Importer::render();
	}
}

/**
 * Redirect legacy theme settings URL to the new hub
 */
function cartvai_theme_admin_redirect_legacy_page() {
	if ( isset( $_GET['page'] ) && 'cartvai-theme-settings' === $_GET['page'] ) {
		wp_safe_redirect( admin_url( 'themes.php?page=cartvai-theme' ) );
		exit;
	}
}
add_action( 'admin_init', 'cartvai_theme_admin_redirect_legacy_page' );

/**
 * Render Welcome & Getting Started Hub
 */
function cartvai_theme_render_welcome_page() {
	$cap = defined( 'CARTVAI_THEME_CAPABILITY' ) ? CARTVAI_THEME_CAPABILITY : 'manage_options';

	if ( ! current_user_can( $cap ) ) {
		wp_die( esc_html__( 'You do not have sufficient permissions to access this page.', 'cartvai' ) );
	}

	$current_tab = isset( $_GET['tab'] ) ? sanitize_key( $_GET['tab'] ) : 'dashboard';
	if ( 'demo-import' === $current_tab ) {
		if ( class_exists( 'CARTVAI_Theme_Demo_Importer' ) ) {
			CARTVAI_Theme_Demo_Importer::render();
			return;
		}
	}

	$theme_version = defined( 'CARTVAI_THEME_VERSION' ) ? CARTVAI_THEME_VERSION : '1.0.0';
	$active_header = function_exists( 'cartvai_get_header_style' ) ? cartvai_get_header_style() : 'megastore';
	$active_footer = function_exists( 'cartvai_get_footer_style' ) ? cartvai_get_footer_style() : 'ecommerce';
	$plugin_active = class_exists( 'CARTVAI_CPT' );
	$has_menu      = has_nav_menu( 'primary' ) || has_nav_menu( 'megamenu' );

	// Customizer Deep Links
	$customizer_url   = admin_url( 'customize.php' );
	$colors_url       = admin_url( 'customize.php?autofocus[section]=cartvai_theme_colors' );
	$header_url       = admin_url( 'customize.php?autofocus[section]=cartvai_theme_header' );
	$footer_url       = admin_url( 'customize.php?autofocus[section]=cartvai_theme_footer' );
	$cards_url        = admin_url( 'customize.php?autofocus[section]=cartvai_theme_product_cards' );
	$identity_url     = admin_url( 'customize.php?autofocus[section]=title_tagline' );
	$menus_url        = admin_url( 'nav-menus.php' );
	$pages_url        = admin_url( 'edit.php?post_type=page' );
	?>
	<div class="wrap cv-welcome-wrap" style="max-width: 1200px; margin: 25px auto 40px 0; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen-Sans, Ubuntu, Cantarell, 'Helvetica Neue', sans-serif;">

		<!-- Navigation Tabs -->
		<div style="display: flex; gap: 8px; margin-bottom: 24px; border-bottom: 1px solid #e2e8f0; padding-bottom: 12px;">
			<a href="<?php echo esc_url( admin_url( 'themes.php?page=cartvai-theme' ) ); ?>" style="text-decoration: none; padding: 8px 18px; border-radius: 8px; font-size: 14px; font-weight: 700; color: #1e3a8a; background: #eff6ff; border: 1px solid #bfdbfe;">
				<?php esc_html_e( 'Getting Started', 'cartvai' ); ?>
			</a>
			<a href="<?php echo esc_url( admin_url( 'themes.php?page=cartvai-theme&tab=demo-import' ) ); ?>" style="text-decoration: none; padding: 8px 18px; border-radius: 8px; font-size: 14px; font-weight: 600; color: #64748b; background: transparent; transition: all 0.15s;">
				<?php esc_html_e( 'Starter Sites / Demo Import', 'cartvai' ); ?>
			</a>
		</div>
		
		<!-- Hero Welcome Banner -->
		<div style="background: linear-gradient(135deg, #0b192c 0%, #1e3a8a 60%, #1e40af 100%); border-radius: 16px; padding: 36px 40px; color: #ffffff; box-shadow: 0 10px 25px -5px rgba(30, 58, 138, 0.25); margin-bottom: 28px; position: relative; overflow: hidden;">
			<div style="position: absolute; top: -50px; right: -50px; width: 220px; height: 220px; border-radius: 50%; background: radial-gradient(circle, rgba(96, 165, 250, 0.18) 0%, rgba(30, 58, 138, 0) 70%); pointer-events: none;"></div>
			
			<div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 20px; position: relative; z-index: 1;">
				<div style="max-width: 680px;">
					<div style="display: flex; align-items: center; gap: 10px; margin-bottom: 12px;">
						<span style="background: #2563eb; color: #ffffff; font-size: 11px; font-weight: 800; padding: 4px 10px; border-radius: 9999px; letter-spacing: 0.05em; text-transform: uppercase;">
							<?php esc_html_e( 'Official Ecommerce Theme', 'cartvai' ); ?>
						</span>
						<span style="background: rgba(255, 255, 255, 0.15); color: #dbeafe; font-size: 11px; font-weight: 700; padding: 4px 10px; border-radius: 9999px;">
							v<?php echo esc_html( $theme_version ); ?>
						</span>
					</div>
					<h1 style="color: #ffffff; font-size: 28px; font-weight: 800; line-height: 1.25; margin: 0 0 10px 0; letter-spacing: -0.02em;">
						<?php esc_html_e( 'Welcome to Cartvai Theme Hub', 'cartvai' ); ?>
					</h1>
					<p style="color: #bfdbfe; font-size: 15px; line-height: 1.6; margin: 0;">
						<?php esc_html_e( 'Your store design, colors, headers, and product cards are managed directly in the WordPress Customizer with real-time visual preview. Explore the quick links below to customize your store.', 'cartvai' ); ?>
					</p>
				</div>
				<div style="display: flex; flex-direction: column; sm:flex-direction: row; gap: 10px;">
					<a href="<?php echo esc_url( admin_url( 'themes.php?page=cartvai-theme&tab=demo-import' ) ); ?>" class="button" style="background: #2563eb; color: #ffffff; border: 1px solid rgba(255,255,255,0.3); font-size: 13.5px; font-weight: 800; height: 44px; line-height: 42px; padding: 0 20px; border-radius: 10px; display: inline-flex; align-items: center; justify-content: center; gap: 8px;">
						⚡ <?php esc_html_e( 'Starter Sites / Demo Import', 'cartvai' ); ?>
					</a>
					<a href="<?php echo esc_url( $customizer_url ); ?>" class="button button-primary" style="background: #ffffff; color: #1e3a8a; border: none; font-size: 13.5px; font-weight: 800; height: 44px; line-height: 44px; padding: 0 20px; border-radius: 10px; box-shadow: 0 4px 14px rgba(0,0,0,0.18); display: inline-flex; align-items: center; justify-content: center; gap: 8px;">
						<span class="dashicons dashicons-admin-customizer" style="font-size: 18px; width: 18px; height: 18px; line-height: 44px;"></span>
						<?php esc_html_e( 'Launch Customizer Live', 'cartvai' ); ?>
					</a>
				</div>
			</div>
		</div>

		<!-- Main 2-Column Grid: Quick Links (Left 8 Cols) + Sidebar Status (Right 4 Cols) -->
		<div style="display: grid; grid-template-columns: 2.2fr 1fr; gap: 24px; align-items: start;">
			
			<!-- Left Column: Quick Customization Cards + Video Tutorials -->
			<div style="display: flex; flex-direction: column; gap: 28px;">
				
				<!-- Quick Actions Grid -->
				<div>
					<div style="margin-bottom: 16px;">
						<h2 style="font-size: 18px; font-weight: 800; color: #0f172a; margin: 0 0 4px 0;">
							<?php esc_html_e( 'Quick Customization Shortcuts', 'cartvai' ); ?>
						</h2>
						<p style="font-size: 13px; color: #64748b; margin: 0;">
							<?php esc_html_e( 'Jump directly into the corresponding live preview panel inside the Customizer.', 'cartvai' ); ?>
						</p>
					</div>

					<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 16px;">
						
						<!-- Card 1: Colors & Design -->
						<div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 20px; display: flex; flex-direction: column; justify-content: space-between; transition: transform .15s, box-shadow .15s; box-shadow: 0 1px 3px rgba(0,0,0,0.03);">
							<div>
								<div style="width: 40px; height: 40px; border-radius: 10px; background: #eff6ff; color: #2563eb; display: flex; align-items: center; justify-content: center; margin-bottom: 14px;">
									<span class="dashicons dashicons-art" style="font-size: 20px;"></span>
								</div>
								<h3 style="font-size: 15px; font-weight: 700; color: #0f172a; margin: 0 0 6px 0;">
									<?php esc_html_e( 'Brand Colors & Design Tokens', 'cartvai' ); ?>
								</h3>
								<p style="font-size: 12.5px; color: #64748b; line-height: 1.5; margin: 0 0 16px 0;">
									<?php esc_html_e( 'Set your primary brand color, hover states, tint highlights, badges, and button styling.', 'cartvai' ); ?>
								</p>
							</div>
							<a href="<?php echo esc_url( $colors_url ); ?>" class="button button-secondary" style="font-weight: 700; border-color: #cbd5e1; height: 36px; line-height: 34px; border-radius: 8px; text-align: center; display: block;">
								<?php esc_html_e( 'Customize Colors →', 'cartvai' ); ?>
							</a>
						</div>

						<!-- Card 2: Header & Megastore -->
						<div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 20px; display: flex; flex-direction: column; justify-content: space-between; box-shadow: 0 1px 3px rgba(0,0,0,0.03);">
							<div>
								<div style="width: 40px; height: 40px; border-radius: 10px; background: #eff6ff; color: #2563eb; display: flex; align-items: center; justify-content: center; margin-bottom: 14px;">
									<span class="dashicons dashicons-heading" style="font-size: 20px;"></span>
								</div>
								<h3 style="font-size: 15px; font-weight: 700; color: #0f172a; margin: 0 0 6px 0;">
									<?php esc_html_e( 'Header Style & Announcements', 'cartvai' ); ?>
								</h3>
								<p style="font-size: 12.5px; color: #64748b; line-height: 1.5; margin: 0 0 16px 0;">
									<?php esc_html_e( 'Select header style (Megastore, MegaBar, Ecommerce), configure top flash sale announcement and helpline.', 'cartvai' ); ?>
								</p>
							</div>
							<a href="<?php echo esc_url( $header_url ); ?>" class="button button-secondary" style="font-weight: 700; border-color: #cbd5e1; height: 36px; line-height: 34px; border-radius: 8px; text-align: center; display: block;">
								<?php esc_html_e( 'Customize Header →', 'cartvai' ); ?>
							</a>
						</div>

						<!-- Card 3: Site Logo & Tagline -->
						<div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 20px; display: flex; flex-direction: column; justify-content: space-between; box-shadow: 0 1px 3px rgba(0,0,0,0.03);">
							<div>
								<div style="width: 40px; height: 40px; border-radius: 10px; background: #eff6ff; color: #2563eb; display: flex; align-items: center; justify-content: center; margin-bottom: 14px;">
									<span class="dashicons dashicons-format-image" style="font-size: 20px;"></span>
								</div>
								<h3 style="font-size: 15px; font-weight: 700; color: #0f172a; margin: 0 0 6px 0;">
									<?php esc_html_e( 'Logo & Sub-Tagline', 'cartvai' ); ?>
								</h3>
								<p style="font-size: 12.5px; color: #64748b; line-height: 1.5; margin: 0 0 16px 0;">
									<?php esc_html_e( 'Upload your brand logo, set site title, and configure the sub-tagline that displays directly under the logo.', 'cartvai' ); ?>
								</p>
							</div>
							<a href="<?php echo esc_url( $identity_url ); ?>" class="button button-secondary" style="font-weight: 700; border-color: #cbd5e1; height: 36px; line-height: 34px; border-radius: 8px; text-align: center; display: block;">
								<?php esc_html_e( 'Set Logo & Tagline →', 'cartvai' ); ?>
							</a>
						</div>

						<!-- Card 4: Footer & Trust Badges -->
						<div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 20px; display: flex; flex-direction: column; justify-content: space-between; box-shadow: 0 1px 3px rgba(0,0,0,0.03);">
							<div>
								<div style="width: 40px; height: 40px; border-radius: 10px; background: #eff6ff; color: #2563eb; display: flex; align-items: center; justify-content: center; margin-bottom: 14px;">
									<span class="dashicons dashicons-layout" style="font-size: 20px;"></span>
								</div>
								<h3 style="font-size: 15px; font-weight: 700; color: #0f172a; margin: 0 0 6px 0;">
									<?php esc_html_e( 'Footer Layout & Badges', 'cartvai' ); ?>
								</h3>
								<p style="font-size: 12.5px; color: #64748b; line-height: 1.5; margin: 0 0 16px 0;">
									<?php esc_html_e( 'Select footer structures (Ecommerce, Organic, Boutique), trust badges, address, and copyright.', 'cartvai' ); ?>
								</p>
							</div>
							<a href="<?php echo esc_url( $footer_url ); ?>" class="button button-secondary" style="font-weight: 700; border-color: #cbd5e1; height: 36px; line-height: 34px; border-radius: 8px; text-align: center; display: block;">
								<?php esc_html_e( 'Customize Footer →', 'cartvai' ); ?>
							</a>
						</div>

						<!-- Card 5: Product Cards -->
						<div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 20px; display: flex; flex-direction: column; justify-content: space-between; box-shadow: 0 1px 3px rgba(0,0,0,0.03);">
							<div>
								<div style="width: 40px; height: 40px; border-radius: 10px; background: #eff6ff; color: #2563eb; display: flex; align-items: center; justify-content: center; margin-bottom: 14px;">
									<span class="dashicons dashicons-products" style="font-size: 20px;"></span>
								</div>
								<h3 style="font-size: 15px; font-weight: 700; color: #0f172a; margin: 0 0 6px 0;">
									<?php esc_html_e( 'Product Card Display Options', 'cartvai' ); ?>
								</h3>
								<p style="font-size: 12.5px; color: #64748b; line-height: 1.5; margin: 0 0 16px 0;">
									<?php esc_html_e( 'Toggle Buy Now buttons, quantity selectors, sale badges, discount percentage pills, and excerpts.', 'cartvai' ); ?>
								</p>
							</div>
							<a href="<?php echo esc_url( $cards_url ); ?>" class="button button-secondary" style="font-weight: 700; border-color: #cbd5e1; height: 36px; line-height: 34px; border-radius: 8px; text-align: center; display: block;">
								<?php esc_html_e( 'Configure Cards →', 'cartvai' ); ?>
							</a>
						</div>

						<!-- Card 6: Mega Menu Setup -->
						<div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 20px; display: flex; flex-direction: column; justify-content: space-between; box-shadow: 0 1px 3px rgba(0,0,0,0.03);">
							<div>
								<div style="width: 40px; height: 40px; border-radius: 10px; background: #eff6ff; color: #2563eb; display: flex; align-items: center; justify-content: center; margin-bottom: 14px;">
									<span class="dashicons dashicons-networking" style="font-size: 20px;"></span>
								</div>
								<h3 style="font-size: 15px; font-weight: 700; color: #0f172a; margin: 0 0 6px 0;">
									<?php esc_html_e( 'Navigation & Mega Menus', 'cartvai' ); ?>
								</h3>
								<p style="font-size: 12.5px; color: #64748b; line-height: 1.5; margin: 0 0 16px 0;">
									<?php esc_html_e( 'Assign menus to the "Mega Menu Bar" location for interactive 3-column product category showcases.', 'cartvai' ); ?>
								</p>
							</div>
							<a href="<?php echo esc_url( $menus_url ); ?>" class="button button-secondary" style="font-weight: 700; border-color: #cbd5e1; height: 36px; line-height: 34px; border-radius: 8px; text-align: center; display: block;">
								<?php esc_html_e( 'Manage Menus →', 'cartvai' ); ?>
							</a>
						</div>

					</div>
				</div>
			</div>

			<!-- Right Sidebar: System Status & Resources -->
			<div style="display: flex; flex-direction: column; gap: 20px;">
				
				<!-- Store Setup Status Card -->
				<div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 14px; padding: 22px; box-shadow: 0 1px 3px rgba(0,0,0,0.03);">
					<h3 style="font-size: 15px; font-weight: 800; color: #0f172a; margin: 0 0 14px 0; border-bottom: 1px solid #f1f5f9; padding-bottom: 10px;">
						<?php esc_html_e( 'Store Setup Status', 'cartvai' ); ?>
					</h3>
					
					<div style="display: flex; flex-direction: column; gap: 12px; font-size: 13px;">
						<!-- Plugin Status -->
						<div style="display: flex; align-items: center; justify-content: space-between;">
							<span style="color: #64748b;"><?php esc_html_e( 'Cartvai Plugin', 'cartvai' ); ?></span>
							<?php if ( $plugin_active ) : ?>
								<span style="color: #059669; font-weight: 700; display: inline-flex; align-items: center; gap: 4px;">
									<span class="dashicons dashicons-yes-alt" style="font-size: 16px;"></span> <?php esc_html_e( 'Active', 'cartvai' ); ?>
								</span>
							<?php else : ?>
								<span style="color: #d97706; font-weight: 700;">
									<?php esc_html_e( 'Not Detected', 'cartvai' ); ?>
								</span>
							<?php endif; ?>
						</div>

						<!-- Header Preset -->
						<div style="display: flex; align-items: center; justify-content: space-between;">
							<span style="color: #64748b;"><?php esc_html_e( 'Header Style', 'cartvai' ); ?></span>
							<span style="color: #0f172a; font-weight: 700; text-transform: capitalize;">
								<?php echo esc_html( $active_header ); ?>
							</span>
						</div>

						<!-- Footer Preset -->
						<div style="display: flex; align-items: center; justify-content: space-between;">
							<span style="color: #64748b;"><?php esc_html_e( 'Footer Style', 'cartvai' ); ?></span>
							<span style="color: #0f172a; font-weight: 700; text-transform: capitalize;">
								<?php echo esc_html( $active_footer ); ?>
							</span>
						</div>

						<!-- Menu Assigned -->
						<div style="display: flex; align-items: center; justify-content: space-between;">
							<span style="color: #64748b;"><?php esc_html_e( 'Menus Assigned', 'cartvai' ); ?></span>
							<?php if ( $has_menu ) : ?>
								<span style="color: #059669; font-weight: 700; display: inline-flex; align-items: center; gap: 4px;">
									<span class="dashicons dashicons-yes-alt" style="font-size: 16px;"></span> <?php esc_html_e( 'Ready', 'cartvai' ); ?>
								</span>
							<?php else : ?>
								<a href="<?php echo esc_url( $menus_url ); ?>" style="color: #2563eb; font-weight: 700; text-decoration: underline;">
									<?php esc_html_e( 'Assign Menus', 'cartvai' ); ?>
								</a>
							<?php endif; ?>
						</div>

						<!-- Theme Version -->
						<div style="display: flex; align-items: center; justify-content: space-between;">
							<span style="color: #64748b;"><?php esc_html_e( 'Theme Version', 'cartvai' ); ?></span>
							<span style="color: #0f172a; font-weight: 700;">
								<?php echo esc_html( $theme_version ); ?>
							</span>
						</div>
					</div>
				</div>

				<!-- Block Patterns Card -->
				<div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 14px; padding: 22px; box-shadow: 0 1px 3px rgba(0,0,0,0.03);">
					<h3 style="font-size: 15px; font-weight: 800; color: #0f172a; margin: 0 0 8px 0;">
						<?php esc_html_e( 'Gutenberg Patterns', 'cartvai' ); ?>
					</h3>
					<p style="font-size: 12.5px; color: #64748b; line-height: 1.5; margin: 0 0 14px 0;">
						<?php esc_html_e( 'Design your homepage quickly using pre-designed Cartvai Block Patterns: Hero Banner, Product Shelves, Promo Duos, and Trust Badges.', 'cartvai' ); ?>
					</p>
					<a href="<?php echo esc_url( $pages_url ); ?>" class="button button-secondary" style="font-weight: 700; border-color: #cbd5e1; height: 36px; line-height: 34px; border-radius: 8px; width: 100%; text-align: center; display: block;">
						<?php esc_html_e( 'Open Pages & Patterns →', 'cartvai' ); ?>
					</a>
				</div>

				<!-- Need Help Card -->
				<div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 14px; padding: 22px;">
					<h3 style="font-size: 15px; font-weight: 800; color: #0f172a; margin: 0 0 8px 0;">
						<?php esc_html_e( 'Need Assistance?', 'cartvai' ); ?>
					</h3>
					<p style="font-size: 12.5px; color: #64748b; line-height: 1.5; margin: 0 0 14px 0;">
						<?php esc_html_e( 'Have questions, need help setting up your store, or want to report an issue? Check out our online documentation and guides.', 'cartvai' ); ?>
					</p>
					<a href="https://demo.cartvai.com" target="_blank" rel="noopener noreferrer" class="button" style="font-weight: 700; border-color: #cbd5e1; height: 36px; line-height: 34px; border-radius: 8px; width: 100%; text-align: center; display: block; background: #ffffff;">
						<?php esc_html_e( 'View Documentation & Demo ↗', 'cartvai' ); ?>
					</a>
				</div>

			</div>

		</div>

	</div>
	<?php
}
