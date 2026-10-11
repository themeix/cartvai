<?php
/**
 * Cartvai Theme One-Click Demo Importer
 *
 * Provides a reliable, professional one-click demo importer:
 * - Checks and validates required plugin dependencies
 * - Sets Theme Customizer options, brand design tokens, header & footer styles
 * - Imports curated sample products and categories from bundled data
 * - Creates core high-converting Gutenberg block pages (Home, Shop, Cart, Checkout, Funnel, Thank You)
 * - Configures Primary & Mega-Menu navigation and maps them to theme locations
 * - Configures WordPress Reading settings (Homepage as Front Page) and Cartvai store settings
 *
 * @package Cartvai_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class CARTVAI_Theme_Demo_Importer {

	/**
	 * Initialize hooks
	 */
	public static function init() {
		add_action( 'wp_ajax_cartvai_theme_demo_import_step', array( __CLASS__, 'ajax_import_step' ) );
		add_action( 'admin_enqueue_scripts', array( __CLASS__, 'enqueue_assets' ) );
	}

	/**
	 * Enqueue assets for the Demo Importer admin screen
	 */
	public static function enqueue_assets( $hook ) {
		if ( false === strpos( $hook, 'cartvai' ) ) {
			return;
		}

		wp_localize_script(
			'jquery',
			'cartvaiDemoImporter',
			array(
				'ajaxUrl'    => admin_url( 'admin-ajax.php' ),
				'nonce'      => wp_create_nonce( 'cartvai_demo_import_nonce' ),
				'homeUrl'    => home_url( '/' ),
				'customizer' => admin_url( 'customize.php' ),
				'strings'    => array(
					'confirm'     => esc_html__( 'Are you sure you want to import the Megastore demo? This will install demo pages, menus, settings, and sample products.', 'cartvai' ),
					'starting'    => esc_html__( 'Initializing Demo Setup...', 'cartvai' ),
					'plugins'     => esc_html__( 'Checking plugin dependencies...', 'cartvai' ),
					'customizer'  => esc_html__( 'Applying theme styles, colors & header options...', 'cartvai' ),
					'products'    => esc_html__( 'Importing demo products & categories...', 'cartvai' ),
					'pages'       => esc_html__( 'Creating core Gutenberg pages & funnel templates...', 'cartvai' ),
					'menus'       => esc_html__( 'Building navigation menus & assigning locations...', 'cartvai' ),
					'settings'    => esc_html__( 'Finalizing homepage & store settings...', 'cartvai' ),
					'complete'    => esc_html__( 'Demo imported successfully!', 'cartvai' ),
					'error'       => esc_html__( 'An error occurred during demo import.', 'cartvai' ),
				),
			)
		);
	}

	/**
	 * Render the Demo Importer UI
	 */
	public static function render() {
		$cap = defined( 'CARTVAI_THEME_CAPABILITY' ) ? CARTVAI_THEME_CAPABILITY : 'manage_options';
		if ( ! current_user_can( $cap ) ) {
			wp_die( esc_html__( 'You do not have sufficient permissions to access this page.', 'cartvai' ) );
		}

		$theme_version   = defined( 'CARTVAI_THEME_VERSION' ) ? CARTVAI_THEME_VERSION : '1.0.0';
		$screenshot_url  = get_template_directory_uri() . '/screenshot.png';
		$is_plugin_ready = class_exists( 'CARTVAI_CPT' );
		$product_count   = post_type_exists( 'cartvai_product' ) ? (int) wp_count_posts( 'cartvai_product' )->publish : 0;
		$pages_count     = (int) wp_count_posts( 'page' )->publish;
		?>
		<div class="wrap cv-demo-importer-wrap" style="max-width: 1200px; margin: 25px auto 40px 0; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen-Sans, Ubuntu, Cantarell, 'Helvetica Neue', sans-serif;">

			<!-- Navigation Tabs -->
			<div style="display: flex; gap: 8px; margin-bottom: 24px; border-bottom: 1px solid #e2e8f0; padding-bottom: 12px;">
				<a href="<?php echo esc_url( admin_url( 'themes.php?page=cartvai-theme' ) ); ?>" style="text-decoration: none; padding: 8px 18px; border-radius: 8px; font-size: 14px; font-weight: 600; color: #64748b; background: transparent; transition: all 0.15s;">
					<?php esc_html_e( 'Getting Started', 'cartvai' ); ?>
				</a>
				<a href="<?php echo esc_url( admin_url( 'themes.php?page=cartvai-theme&tab=demo-import' ) ); ?>" style="text-decoration: none; padding: 8px 18px; border-radius: 8px; font-size: 14px; font-weight: 700; color: #1e3a8a; background: #eff6ff; border: 1px solid #bfdbfe;">
					<?php esc_html_e( 'Starter Sites / Demo Import', 'cartvai' ); ?>
				</a>
			</div>

			<!-- Hero Banner -->
			<div style="background: linear-gradient(135deg, #0b192c 0%, #1e3a8a 60%, #1e40af 100%); border-radius: 16px; padding: 32px 36px; color: #ffffff; box-shadow: 0 10px 25px -5px rgba(30, 58, 138, 0.25); margin-bottom: 28px; position: relative; overflow: hidden;">
				<div style="position: absolute; top: -50px; right: -50px; width: 220px; height: 220px; border-radius: 50%; background: radial-gradient(circle, rgba(96, 165, 250, 0.18) 0%, rgba(30, 58, 138, 0) 70%); pointer-events: none;"></div>
				
				<div style="max-width: 760px; position: relative; z-index: 1;">
					<div style="display: flex; align-items: center; gap: 10px; margin-bottom: 12px;">
						<span style="background: #2563eb; color: #ffffff; font-size: 11px; font-weight: 800; padding: 4px 10px; border-radius: 9999px; letter-spacing: 0.05em; text-transform: uppercase;">
							<?php esc_html_e( '1-Click Starter Site', 'cartvai' ); ?>
						</span>
						<span style="background: rgba(255, 255, 255, 0.15); color: #dbeafe; font-size: 11px; font-weight: 700; padding: 4px 10px; border-radius: 9999px;">
							v<?php echo esc_html( $theme_version ); ?>
						</span>
					</div>
					<h1 style="color: #ffffff; font-size: 26px; font-weight: 800; line-height: 1.25; margin: 0 0 10px 0;">
						<?php esc_html_e( 'One-Click Demo Importer', 'cartvai' ); ?>
					</h1>
					<p style="color: #bfdbfe; font-size: 14.5px; line-height: 1.6; margin: 0;">
						<?php esc_html_e( 'Transform your site into a fully functional, high-converting online store in seconds. Installs complete Gutenberg block layouts, shop catalog, cart, checkout, navigation menus, and brand styling.', 'cartvai' ); ?>
					</p>
				</div>
			</div>

			<!-- Main Content: Demo Card Grid & Checklist -->
			<div style="display: grid; grid-template-columns: 2.2fr 1fr; gap: 24px; align-items: start;">
				
				<!-- Left Column: Flagship Demo Card -->
				<div>
					<div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 16px rgba(0,0,0,0.05);">
						
						<!-- Demo Screenshot Preview -->
						<div style="position: relative; height: 320px; overflow: hidden; background: #0f172a; border-bottom: 1px solid #e2e8f0;">
							<img src="<?php echo esc_url( $screenshot_url ); ?>" alt="Megastore Demo Preview" style="width: 100%; height: 100%; object-fit: cover; object-position: top; transition: transform 0.3s ease;">
							<div style="position: absolute; top: 16px; left: 16px; display: flex; gap: 8px;">
								<span style="background: #2563eb; color: #ffffff; font-size: 12px; font-weight: 800; padding: 5px 12px; border-radius: 9999px; box-shadow: 0 2px 8px rgba(0,0,0,0.25);">
									⭐ <?php esc_html_e( 'Flagship Starter Site', 'cartvai' ); ?>
								</span>
								<span style="background: #0f172a; color: #ffffff; font-size: 12px; font-weight: 700; padding: 5px 12px; border-radius: 9999px; box-shadow: 0 2px 8px rgba(0,0,0,0.25);">
									⚡ <?php esc_html_e( '100% Native Blocks', 'cartvai' ); ?>
								</span>
							</div>
						</div>

						<!-- Card Body -->
						<div style="padding: 28px 32px;">
							<div style="display: flex; justify-content: space-between; align-items: flex-start; gap: 20px; margin-bottom: 20px;">
								<div>
									<h2 style="font-size: 20px; font-weight: 800; color: #0f172a; margin: 0 0 6px 0;">
										<?php esc_html_e( 'Megastore – Modern Tech & Lifestyle Ecommerce', 'cartvai' ); ?>
									</h2>
									<p style="font-size: 14px; color: #64748b; line-height: 1.5; margin: 0;">
										<?php esc_html_e( 'Engineered for high-volume conversion. Features centered blue hero, responsive trust badges, category swiper, trending products grid, customer reviews, and a 1-page checkout funnel.', 'cartvai' ); ?>
									</p>
								</div>
							</div>

							<!-- What will be imported -->
							<div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 20px; margin-bottom: 24px;">
								<h3 style="font-size: 13px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.05em; color: #475569; margin: 0 0 14px 0;">
									<?php esc_html_e( 'What This 1-Click Import Sets Up:', 'cartvai' ); ?>
								</h3>
								<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px; font-size: 13.5px; color: #334155;">
									<div style="display: flex; align-items: center; gap: 8px;">
										<span style="color: #10b981; font-weight: 900;">✓</span> <?php esc_html_e( 'Home Page (Gutenberg blocks)', 'cartvai' ); ?>
									</div>
									<div style="display: flex; align-items: center; gap: 8px;">
										<span style="color: #10b981; font-weight: 900;">✓</span> <?php esc_html_e( 'Curated Product Catalog', 'cartvai' ); ?>
									</div>
									<div style="display: flex; align-items: center; gap: 8px;">
										<span style="color: #10b981; font-weight: 900;">✓</span> <?php esc_html_e( 'Shop, Cart & Checkout Pages', 'cartvai' ); ?>
									</div>
									<div style="display: flex; align-items: center; gap: 8px;">
										<span style="color: #10b981; font-weight: 900;">✓</span> <?php esc_html_e( 'Mega-Menu Navigation Bars', 'cartvai' ); ?>
									</div>
									<div style="display: flex; align-items: center; gap: 8px;">
										<span style="color: #10b981; font-weight: 900;">✓</span> <?php esc_html_e( 'Demo Funnel Page (#1 Funnel)', 'cartvai' ); ?>
									</div>
									<div style="display: flex; align-items: center; gap: 8px;">
										<span style="color: #10b981; font-weight: 900;">✓</span> <?php esc_html_e( 'Food Landing Page 1 (Artisan Feast)', 'cartvai' ); ?>
									</div>
									<div style="display: flex; align-items: center; gap: 8px;">
										<span style="color: #10b981; font-weight: 900;">✓</span> <?php esc_html_e( 'Customizer Colors & Styles', 'cartvai' ); ?>
									</div>
									<div style="display: flex; align-items: center; gap: 8px;">
										<span style="color: #10b981; font-weight: 900;">✓</span> <?php esc_html_e( 'Thank You Order Success Page', 'cartvai' ); ?>
									</div>
									<div style="display: flex; align-items: center; gap: 8px;">
										<span style="color: #10b981; font-weight: 900;">✓</span> <?php esc_html_e( 'Automatic Front Page Setup', 'cartvai' ); ?>
									</div>
								</div>
							</div>

							<!-- Action Buttons -->
							<div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 14px;">
								<div style="font-size: 12.5px; color: #64748b;">
									<?php esc_html_e( 'Safe import: Updates existing core pages and adds demo assets safely.', 'cartvai' ); ?>
								</div>
								<div style="display: flex; gap: 12px;">
									<a href="<?php echo esc_url( home_url( '/' ) ); ?>" target="_blank" class="button" style="height: 42px; line-height: 40px; padding: 0 18px; border-radius: 8px; font-weight: 700; color: #334155;">
										<?php esc_html_e( 'Live Preview Site ↗', 'cartvai' ); ?>
									</a>
									<button type="button" id="cv-btn-start-import" class="button button-primary" style="background: #2563eb; border-color: #1d4ed8; height: 42px; line-height: 40px; padding: 0 24px; border-radius: 8px; font-size: 14px; font-weight: 800; box-shadow: 0 4px 12px rgba(37,99,235,0.25); cursor: pointer;">
										⚡ <?php esc_html_e( 'Import Complete Demo', 'cartvai' ); ?>
									</button>
								</div>
							</div>
						</div>
					</div>
				</div>

				<!-- Right Column: System Status Checklist -->
				<div style="display: flex; flex-direction: column; gap: 20px;">
					
					<div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 14px; padding: 22px; box-shadow: 0 1px 3px rgba(0,0,0,0.03);">
						<h3 style="font-size: 14px; font-weight: 800; color: #0f172a; margin: 0 0 14px 0;">
							<?php esc_html_e( 'System Status & Readiness', 'cartvai' ); ?>
						</h3>
						<div style="display: flex; flex-direction: column; gap: 12px; font-size: 13px;">
							
							<div style="display: flex; justify-content: space-between; align-items: center; padding-bottom: 8px; border-bottom: 1px solid #f1f5f9;">
								<span style="color: #64748b;"><?php esc_html_e( 'Cartvai Ecommerce Plugin', 'cartvai' ); ?></span>
								<?php if ( $is_plugin_ready ) : ?>
									<span style="color: #059669; font-weight: 700; display: inline-flex; align-items: center; gap: 4px;">
										● <?php esc_html_e( 'Active', 'cartvai' ); ?>
									</span>
								<?php else : ?>
									<span style="color: #d97706; font-weight: 700; display: inline-flex; align-items: center; gap: 4px;">
										● <?php esc_html_e( 'Auto-Configured', 'cartvai' ); ?>
									</span>
								<?php endif; ?>
							</div>

							<div style="display: flex; justify-content: space-between; align-items: center; padding-bottom: 8px; border-bottom: 1px solid #f1f5f9;">
								<span style="color: #64748b;"><?php esc_html_e( 'PHP Version', 'cartvai' ); ?></span>
								<span style="color: #0f172a; font-weight: 700;"><?php echo esc_html( phpversion() ); ?></span>
							</div>

							<div style="display: flex; justify-content: space-between; align-items: center; padding-bottom: 8px; border-bottom: 1px solid #f1f5f9;">
								<span style="color: #64748b;"><?php esc_html_e( 'Current Published Pages', 'cartvai' ); ?></span>
								<span style="color: #0f172a; font-weight: 700;"><?php echo esc_html( $pages_count ); ?></span>
							</div>

							<div style="display: flex; justify-content: space-between; align-items: center;">
								<span style="color: #64748b;"><?php esc_html_e( 'Published Products', 'cartvai' ); ?></span>
								<span style="color: #0f172a; font-weight: 700;"><?php echo esc_html( $product_count ); ?></span>
							</div>
						</div>
					</div>

					<div style="background: #fffbeb; border: 1px solid #fef3c7; border-radius: 14px; padding: 20px; color: #92400e;">
						<h4 style="font-size: 13px; font-weight: 800; margin: 0 0 6px 0; display: flex; align-items: center; gap: 6px;">
							<span style="font-size: 16px;">💡</span> <?php esc_html_e( 'Best Practice Recommendation', 'cartvai' ); ?>
						</h4>
						<p style="font-size: 12.5px; line-height: 1.5; margin: 0;">
							<?php esc_html_e( 'After importing, visit Appearance → Customize to adjust your brand logo, announcement banner, and helpline number with instant live preview.', 'cartvai' ); ?>
						</p>
					</div>
				</div>
			</div>

			<!-- Live Progress Modal Overlay -->
			<div id="cv-import-modal-overlay" style="display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(15, 23, 42, 0.7); backdrop-filter: blur(4px); z-index: 999999; align-items: center; justify-content: center;">
				<div style="background: #ffffff; border-radius: 18px; width: 540px; max-width: 90vw; padding: 36px; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.35); text-align: center;">
					
					<!-- Header Icon -->
					<div id="cv-modal-icon" style="width: 56px; height: 56px; border-radius: 50%; background: #eff6ff; color: #2563eb; display: inline-flex; align-items: center; justify-content: center; font-size: 24px; margin-bottom: 18px;">
						<span class="dashicons dashicons-update" style="font-size: 28px; width: 28px; height: 28px; animation: cv-spin 1.2s linear infinite;"></span>
					</div>

					<h2 id="cv-modal-title" style="font-size: 20px; font-weight: 800; color: #0f172a; margin: 0 0 8px 0;">
						<?php esc_html_e( 'Importing Megastore Demo...', 'cartvai' ); ?>
					</h2>
					<p id="cv-modal-status" style="font-size: 13.5px; color: #64748b; margin: 0 0 24px 0;">
						<?php esc_html_e( 'Please keep this window open while the demo content installs.', 'cartvai' ); ?>
					</p>

					<!-- Progress Bar -->
					<div style="width: 100%; height: 10px; background: #e2e8f0; border-radius: 9999px; overflow: hidden; margin-bottom: 24px;">
						<div id="cv-progress-bar" style="width: 5%; height: 100%; background: linear-gradient(90deg, #2563eb, #3b82f6); border-radius: 9999px; transition: width 0.4s ease;"></div>
					</div>

					<!-- Checklist Steps -->
					<div style="text-align: left; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 18px; margin-bottom: 24px; font-size: 13px; display: flex; flex-direction: column; gap: 10px;">
						<div id="step-plugins" class="cv-step-item" style="display: flex; align-items: center; gap: 10px; color: #94a3b8;">
							<span class="cv-step-icon">○</span> <span><?php esc_html_e( 'Verify Plugin Dependencies', 'cartvai' ); ?></span>
						</div>
						<div id="step-customizer" class="cv-step-item" style="display: flex; align-items: center; gap: 10px; color: #94a3b8;">
							<span class="cv-step-icon">○</span> <span><?php esc_html_e( 'Theme Customizer Styles & Colors', 'cartvai' ); ?></span>
						</div>
						<div id="step-products" class="cv-step-item" style="display: flex; align-items: center; gap: 10px; color: #94a3b8;">
							<span class="cv-step-icon">○</span> <span><?php esc_html_e( 'Sample Catalog & Categories', 'cartvai' ); ?></span>
						</div>
						<div id="step-pages" class="cv-step-item" style="display: flex; align-items: center; gap: 10px; color: #94a3b8;">
							<span class="cv-step-icon">○</span> <span><?php esc_html_e( 'Core Gutenberg Block Pages & Funnel', 'cartvai' ); ?></span>
						</div>
						<div id="step-menus" class="cv-step-item" style="display: flex; align-items: center; gap: 10px; color: #94a3b8;">
							<span class="cv-step-icon">○</span> <span><?php esc_html_e( 'Primary Mega-Menu Navigation', 'cartvai' ); ?></span>
						</div>
						<div id="step-settings" class="cv-step-item" style="display: flex; align-items: center; gap: 10px; color: #94a3b8;">
							<span class="cv-step-icon">○</span> <span><?php esc_html_e( 'Store Front Page & Reading Settings', 'cartvai' ); ?></span>
						</div>
					</div>

					<!-- Complete Actions (Hidden by default) -->
					<div id="cv-modal-actions" style="display: none; justify-content: center; gap: 12px;">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" target="_blank" class="button button-primary" style="background: #10b981; border-color: #059669; height: 42px; line-height: 40px; padding: 0 22px; border-radius: 8px; font-weight: 800;">
							🚀 <?php esc_html_e( 'View Your Live Store', 'cartvai' ); ?>
						</a>
						<a href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>" class="button" style="height: 42px; line-height: 40px; padding: 0 18px; border-radius: 8px; font-weight: 700;">
							🎨 <?php esc_html_e( 'Customize Design', 'cartvai' ); ?>
						</a>
						<button type="button" id="cv-btn-close-modal" class="button" style="height: 42px; line-height: 40px; padding: 0 16px; border-radius: 8px;">
							<?php esc_html_e( 'Close', 'cartvai' ); ?>
						</button>
					</div>
				</div>
			</div>

			<style>
				@keyframes cv-spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }
				.cv-step-item.is-running { color: #2563eb !important; font-weight: 700; }
				.cv-step-item.is-running .cv-step-icon { display: inline-block; animation: cv-spin 1s linear infinite; }
				.cv-step-item.is-done { color: #059669 !important; font-weight: 600; }
				.cv-step-item.is-done .cv-step-icon { color: #059669; font-weight: 900; }
				.cv-step-item.is-error { color: #dc2626 !important; font-weight: 700; }
			</style>

			<script>
			jQuery(document).ready(function($) {
				var steps = [
					{ key: 'plugins', progress: 15 },
					{ key: 'customizer', progress: 35 },
					{ key: 'products', progress: 55 },
					{ key: 'pages', progress: 75 },
					{ key: 'menus', progress: 90 },
					{ key: 'settings', progress: 100 }
				];

				$('#cv-btn-start-import').on('click', function(e) {
					e.preventDefault();
					if (!confirm(cartvaiDemoImporter.strings.confirm)) {
						return;
					}

					$('#cv-import-modal-overlay').css('display', 'flex');
					$('#cv-progress-bar').css('width', '5%');
					$('#cv-modal-actions').hide();
					$('.cv-step-item').removeClass('is-running is-done is-error').css('color', '#94a3b8');
					$('.cv-step-icon').text('○');

					runStep(0);
				});

				$('#cv-btn-close-modal').on('click', function() {
					$('#cv-import-modal-overlay').hide();
					window.location.reload();
				});

				function runStep(index) {
					if (index >= steps.length) {
						// Complete!
						$('#cv-progress-bar').css('width', '100%');
						$('#cv-modal-icon').html('<span class="dashicons dashicons-yes-alt" style="font-size: 32px; width: 32px; height: 32px; color: #10b981;"></span>').css('background', '#ecfdf5');
						$('#cv-modal-title').text(cartvaiDemoImporter.strings.complete);
						$('#cv-modal-status').text('Your Megastore demo is installed with full Gutenberg layouts and ready for shoppers.');
						$('#cv-modal-actions').css('display', 'flex');
						return;
					}

					var cur = steps[index];
					var $item = $('#step-' + cur.key);
					$item.addClass('is-running');
					$item.find('.cv-step-icon').text('↻');
					$('#cv-progress-bar').css('width', cur.progress + '%');

					$.ajax({
						url: cartvaiDemoImporter.ajaxUrl,
						type: 'POST',
						dataType: 'json',
						data: {
							action: 'cartvai_theme_demo_import_step',
							step: cur.key,
							nonce: cartvaiDemoImporter.nonce
						},
						success: function(res) {
							if (res && res.success) {
								$item.removeClass('is-running').addClass('is-done');
								$item.find('.cv-step-icon').text('✓');
								setTimeout(function() {
									runStep(index + 1);
								}, 300);
							} else {
								var msg = (res && res.data && res.data.message) ? res.data.message : cartvaiDemoImporter.strings.error;
								$item.removeClass('is-running').addClass('is-error');
								$item.find('.cv-step-icon').text('✗');
								$('#cv-modal-status').text(msg).css('color', '#dc2626');
								$('#cv-modal-actions').css('display', 'flex');
							}
						},
						error: function(xhr, status, error) {
							$item.removeClass('is-running').addClass('is-error');
							$item.find('.cv-step-icon').text('✗');
							$('#cv-modal-status').text('Server error during ' + cur.key + ': ' + error).css('color', '#dc2626');
							$('#cv-modal-actions').css('display', 'flex');
						}
					});
				}
			});
			</script>
		</div>
		<?php
	}

	/**
	 * AJAX Handler for each Demo Import step
	 */
	public static function ajax_import_step() {
		check_ajax_referer( 'cartvai_demo_import_nonce', 'nonce' );

		$cap = defined( 'CARTVAI_THEME_CAPABILITY' ) ? CARTVAI_THEME_CAPABILITY : 'manage_options';
		if ( ! current_user_can( $cap ) ) {
			wp_send_json_error( array( 'message' => esc_html__( 'Unauthorized permissions.', 'cartvai' ) ) );
		}

		$step = isset( $_POST['step'] ) ? sanitize_key( $_POST['step'] ) : '';

		switch ( $step ) {
			case 'plugins':
				self::step_verify_plugins();
				break;

			case 'customizer':
				self::step_import_customizer();
				break;

			case 'products':
				self::step_import_products();
				break;

			case 'pages':
				self::step_import_pages();
				break;

			case 'menus':
				self::step_import_menus();
				break;

			case 'settings':
				self::step_import_settings();
				break;

			default:
				wp_send_json_error( array( 'message' => esc_html__( 'Invalid import step.', 'cartvai' ) ) );
		}
	}

	/**
	 * Step 1: Verify plugins
	 */
	private static function step_verify_plugins() {
		if ( ! class_exists( 'CARTVAI_CPT' ) ) {
			if ( function_exists( 'activate_plugin' ) ) {
				$plugin_file = 'cartvai-ecommerce/cartvai-ecommerce.php';
				$result      = activate_plugin( $plugin_file );
				if ( is_wp_error( $result ) ) {
					wp_send_json_error( array( 'message' => 'Please activate the Cartvai Ecommerce plugin before importing demo.' ) );
				}
			}
		}

		wp_send_json_success( array( 'message' => 'Plugin dependencies active.' ) );
	}

	/**
	 * Step 2: Customizer & Theme Settings
	 */
	private static function step_import_customizer() {
		$json_file = get_template_directory() . '/inc/demo-data/theme-settings.json';
		if ( file_exists( $json_file ) ) {
			$data = json_decode( file_get_contents( $json_file ), true );
			if ( ! empty( $data['theme_settings'] ) ) {
				update_option( 'cartvai_theme_settings', $data['theme_settings'] );
			}
			if ( ! empty( $data['theme_mods'] ) ) {
				foreach ( $data['theme_mods'] as $mod_key => $mod_val ) {
					set_theme_mod( $mod_key, $mod_val );
				}
			}
		}

		wp_send_json_success( array( 'message' => 'Theme Customizer styling configured.' ) );
	}

	/**
	 * Step 3: Demo Products
	 */
	private static function step_import_products() {
		$csv_file = get_template_directory() . '/inc/demo-data/products.csv';
		if ( ! file_exists( $csv_file ) && defined( 'CARTVAI_PLUGIN_DIR' ) ) {
			$csv_file = CARTVAI_PLUGIN_DIR . 'cartvai-demo-products.csv';
		}

		$existing_count = post_type_exists( 'cartvai_product' ) ? (int) wp_count_posts( 'cartvai_product' )->publish : 0;

		// If fewer than 15 products exist and CSV is present, run import
		if ( $existing_count < 15 && file_exists( $csv_file ) && class_exists( 'CARTVAI_Port_CSV' ) ) {
			CARTVAI_Port_CSV::import_uploaded_file( $csv_file, array( 'import_products' => true ) );
		}

		wp_send_json_success( array( 'message' => 'Demo products verified and ready.' ) );
	}

	/**
	 * Step 4: Core Gutenberg Pages
	 */
	private static function step_import_pages() {
		$home_html_file         = get_template_directory() . '/inc/demo-data/home.html';
		$funnel_html_file       = get_template_directory() . '/inc/demo-data/funnel.html';
		$food_landing_html_file = get_template_directory() . '/inc/demo-data/food-landing-1.html';

		$home_content         = file_exists( $home_html_file ) ? file_get_contents( $home_html_file ) : '';
		$funnel_content       = file_exists( $funnel_html_file ) ? file_get_contents( $funnel_html_file ) : '[cartvai id="1"]';
		$food_landing_content = file_exists( $food_landing_html_file ) ? file_get_contents( $food_landing_html_file ) : '';

		// 1. Home Page
		$home_id = self::get_or_create_page(
			'Home',
			'home',
			$home_content,
			'templates/template-full-width.php'
		);

		// 2. Shop Page
		$shop_id = self::get_or_create_page(
			'Shop Page',
			'shop',
			'[cartvai_shop]',
			'default'
		);

		// 3. Cart Page
		$cart_id = self::get_or_create_page(
			'Cart Page',
			'cart',
			'[cartvai_cart]',
			'default'
		);

		// 4. Checkout Page
		$checkout_id = self::get_or_create_page(
			'Checkout Page',
			'checkout',
			'[cartvai_checkout]',
			'default'
		);

		// 5. Thank You Page
		$thank_you_id = self::get_or_create_page(
			'Thank You Page',
			'thank-you',
			'[cartvai_thank_you]',
			'default'
		);

		// 6. Demo Funnel Page
		$funnel_id = self::get_or_create_page(
			'Exclusive Special Offer – Demo Funnel',
			'demo-funnel',
			$funnel_content,
			'templates/template-full-width.php'
		);

		// 7. Food Landing 1 Page
		$food_landing_id = self::get_or_create_page(
			'Food Landing 1',
			'food-landing-1',
			$food_landing_content,
			'templates/template-canvas.php'
		);

		// Store IDs in transient for step 6
		set_transient(
			'cartvai_demo_imported_pages',
			array(
				'home_id'         => $home_id,
				'shop_id'         => $shop_id,
				'cart_id'         => $cart_id,
				'checkout_id'     => $checkout_id,
				'thank_you_id'    => $thank_you_id,
				'funnel_id'       => $funnel_id,
				'food_landing_id' => $food_landing_id,
			),
			HOUR_IN_SECONDS
		);

		wp_send_json_success( array( 'message' => 'Core Gutenberg pages & funnels created.' ) );
	}

	/**
	 * Step 5: Navigation Menus
	 */
	private static function step_import_menus() {
		$menu_name = 'Main Megastore Menu';
		$menu_obj  = wp_get_nav_menu_object( $menu_name );

		if ( ! $menu_obj ) {
			$menu_id = wp_create_nav_menu( $menu_name );
		} else {
			$menu_id = $menu_obj->term_id;
		}

		if ( $menu_id && ! is_wp_error( $menu_id ) ) {
			$existing_items = wp_get_nav_menu_items( $menu_id );

			if ( empty( $existing_items ) ) {
				// Home Link
				wp_update_nav_menu_item(
					$menu_id,
					0,
					array(
						'menu-item-title'  => esc_html__( 'Home', 'cartvai' ),
						'menu-item-url'    => home_url( '/' ),
						'menu-item-status' => 'publish',
						'menu-item-type'   => 'custom',
					)
				);

				// Shop Link
				wp_update_nav_menu_item(
					$menu_id,
					0,
					array(
						'menu-item-title'  => esc_html__( 'Shop All', 'cartvai' ),
						'menu-item-url'    => home_url( '/shop/' ),
						'menu-item-status' => 'publish',
						'menu-item-type'   => 'custom',
					)
				);

				// Add Categories if they exist
				$categories = get_terms(
					array(
						'taxonomy'   => 'cartvai_product_cat',
						'hide_empty' => false,
						'number'     => 6,
					)
				);

				if ( ! empty( $categories ) && ! is_wp_error( $categories ) ) {
					foreach ( $categories as $cat ) {
						wp_update_nav_menu_item(
							$menu_id,
							0,
							array(
								'menu-item-title'  => $cat->name,
								'menu-item-url'    => get_term_link( $cat ),
								'menu-item-status' => 'publish',
								'menu-item-type'   => 'custom',
							)
						);
					}
				}

				// Demo Funnel Link
				wp_update_nav_menu_item(
					$menu_id,
					0,
					array(
						'menu-item-title'  => esc_html__( 'Special Deals ⚡', 'cartvai' ),
						'menu-item-url'    => home_url( '/demo-funnel/' ),
						'menu-item-status' => 'publish',
						'menu-item-type'   => 'custom',
					)
				);

				// Food Landing Link
				wp_update_nav_menu_item(
					$menu_id,
					0,
					array(
						'menu-item-title'  => esc_html__( 'Food Landing 🍕', 'cartvai' ),
						'menu-item-url'    => home_url( '/food-landing-1/' ),
						'menu-item-status' => 'publish',
						'menu-item-type'   => 'custom',
					)
				);
			}

			// Assign to theme menu locations
			$locations              = get_theme_mod( 'nav_menu_locations', array() );
			$locations['primary']  = $menu_id;
			$locations['megamenu'] = $menu_id;
			set_theme_mod( 'nav_menu_locations', $locations );
		}

		wp_send_json_success( array( 'message' => 'Primary & Mega-Menu navigation mapped.' ) );
	}

	/**
	 * Step 6: Settings & Mappings
	 */
	private static function step_import_settings() {
		$page_ids = get_transient( 'cartvai_demo_imported_pages' );
		if ( ! is_array( $page_ids ) ) {
			$page_ids = array();
		}

		// Find Home page ID
		$home_id = $page_ids['home_id'] ?? 0;
		if ( ! $home_id ) {
			$home_page = get_page_by_path( 'home' );
			$home_id   = $home_page ? $home_page->ID : 0;
		}

		// Set Front Page
		if ( $home_id ) {
			update_option( 'show_on_front', 'page' );
			update_option( 'page_on_front', $home_id );
		}

		// Map Cartvai Settings
		if ( class_exists( 'CARTVAI_Settings' ) ) {
			$shop_page     = get_page_by_path( 'shop' );
			$cart_page     = get_page_by_path( 'cart' );
			$checkout_page = get_page_by_path( 'checkout' );
			$thank_page    = get_page_by_path( 'thank-you' );

			if ( $shop_page ) {
				CARTVAI_Settings::set( 'shop_page_id', $shop_page->ID );
			}
			if ( $cart_page ) {
				CARTVAI_Settings::set( 'cart_page_id', $cart_page->ID );
			}
			if ( $checkout_page ) {
				CARTVAI_Settings::set( 'checkout_page_id', $checkout_page->ID );
			}
			if ( $thank_page ) {
				CARTVAI_Settings::set( 'thank_you_page_id', $thank_page->ID );
			}
		}

		delete_transient( 'cartvai_demo_imported_pages' );
		flush_rewrite_rules( false );

		wp_send_json_success( array( 'message' => 'Store Front Page & mappings configured!' ) );
	}

	/**
	 * Helper to get existing page by slug or create a new one
	 */
	private static function get_or_create_page( $title, $slug, $content, $template = 'default' ) {
		$page = get_page_by_path( $slug );
		if ( $page ) {
			// Update template if specified
			if ( $template ) {
				update_post_meta( $page->ID, '_wp_page_template', $template );
			}
			// Update content if page was empty
			if ( empty( trim( $page->post_content ) ) && ! empty( $content ) ) {
				wp_update_post(
					array(
						'ID'           => $page->ID,
						'post_content' => $content,
					)
				);
			}
			return $page->ID;
		}

		$new_id = wp_insert_post(
			array(
				'post_title'   => $title,
				'post_name'    => $slug,
				'post_content' => $content,
				'post_status'  => 'publish',
				'post_type'    => 'page',
			)
		);

		if ( $new_id && ! is_wp_error( $new_id ) ) {
			if ( $template ) {
				update_post_meta( $new_id, '_wp_page_template', $template );
			}
			return $new_id;
		}

		return 0;
	}
}

CARTVAI_Theme_Demo_Importer::init();
