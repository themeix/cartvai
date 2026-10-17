<?php
/**
 * Cartvai Theme - Cloud Patterns Sync & Remote Distribution Integration
 *
 * Automatically fetches fresh block patterns and turnkey landing page templates
 * from the central Cartvai Pattern Hub (demo.cartvai.com) and registers them
 * directly inside the native WordPress Gutenberg Block Editor.
 *
 * @package Cartvai_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Cartvai_Cloud_Patterns {

	const TRANSIENT_KEY = 'cartvai_cloud_patterns_feed';
	const CACHE_TTL     = 43200; // 12 hours.

	public static function init() {
		add_action( 'init', array( __CLASS__, 'register_cloud_patterns' ), 20 );
		add_action( 'admin_bar_menu', array( __CLASS__, 'add_admin_bar_sync_button' ), 95 );
		add_action( 'admin_post_cartvai_sync_cloud_patterns', array( __CLASS__, 'handle_sync_action' ) );
		add_action( 'admin_notices', array( __CLASS__, 'render_sync_notice' ) );
	}

	/**
	 * Get the Cloud Pattern API Endpoint URL.
	 *
	 * Defaults to local rest_url if local, or demo.cartvai.com in production.
	 * Can be overridden via constant or filter.
	 *
	 * @return string
	 */
	public static function get_api_endpoint() {
		// Developer override via constant (e.g. in wp-config.php during private testing)
		if ( defined( 'CARTVAI_CLOUD_PATTERN_API_URL' ) && ! empty( CARTVAI_CLOUD_PATTERN_API_URL ) ) {
			return esc_url_raw( CARTVAI_CLOUD_PATTERN_API_URL );
		}

		// When running locally in development, default to local rest_url
		$host = wp_parse_url( home_url(), PHP_URL_HOST );
		if ( in_array( $host, array( 'localhost', '127.0.0.1' ), true ) || str_ends_with( (string) $host, '.local' ) ) {
			$endpoint = rest_url( 'cartvai-patterns/v1/feed' );
		} else {
			// Permanently connected to official Cartvai Cloud Hub
			$endpoint = 'https://demo.cartvai.com/wp-json/cartvai-patterns/v1/feed';
		}

		return apply_filters( 'cartvai_cloud_pattern_api_url', $endpoint );
	}

	/**
	 * Fetch patterns from remote cloud feed with transient caching.
	 *
	 * @param bool $force_refresh
	 * @return array
	 */
	public static function get_cloud_patterns( $force_refresh = false ) {
		if ( $force_refresh ) {
			delete_transient( self::TRANSIENT_KEY );
		}

		$cached = get_transient( self::TRANSIENT_KEY );
		if ( false !== $cached && is_array( $cached ) ) {
			return $cached;
		}

		$api_url = self::get_api_endpoint();
		if ( empty( $api_url ) ) {
			return array();
		}

		// When running locally on single-threaded dev servers, query internally to avoid cURL loopback deadlocks!
		if ( class_exists( 'Cartvai_Pattern_API' ) && method_exists( 'Cartvai_Pattern_API', 'get_patterns_feed' ) && ( strpos( $api_url, 'localhost' ) !== false || strpos( $api_url, '127.0.0.1' ) !== false ) ) {
			$rest_request = new WP_REST_Request( 'GET', '/' . Cartvai_Pattern_API::API_NAMESPACE . '/feed' );
			$rest_response = Cartvai_Pattern_API::get_patterns_feed( $rest_request );
			if ( ! is_wp_error( $rest_response ) && method_exists( $rest_response, 'get_data' ) ) {
				$data = $rest_response->get_data();
				if ( ! empty( $data['patterns'] ) && is_array( $data['patterns'] ) ) {
					set_transient( self::TRANSIENT_KEY, $data['patterns'], self::CACHE_TTL );
					return $data['patterns'];
				}
			}
		}

		$response = wp_remote_get(
			$api_url,
			array(
				'timeout'    => 6,
				'user-agent' => 'CartvaiTheme/' . wp_get_theme()->get( 'Version' ) . '; ' . home_url(),
				'headers'    => array(
					'Accept' => 'application/json',
				),
			)
		);

		if ( is_wp_error( $response ) || 200 !== wp_remote_retrieve_response_code( $response ) ) {
			// Cache an empty array for 10 minutes on error to avoid hammering API on network outage
			set_transient( self::TRANSIENT_KEY, array(), 10 * MINUTE_IN_SECONDS );
			return array();
		}

		$body = wp_remote_retrieve_body( $response );
		$data = json_decode( $body, true );

		if ( ! empty( $data['patterns'] ) && is_array( $data['patterns'] ) ) {
			set_transient( self::TRANSIENT_KEY, $data['patterns'], self::CACHE_TTL );
			return $data['patterns'];
		}

		return array();
	}

	/**
	 * Register remote patterns inside WordPress Gutenberg.
	 */
	public static function register_cloud_patterns() {
		if ( ! function_exists( 'register_block_pattern_category' ) || ! function_exists( 'register_block_pattern' ) ) {
			return;
		}

		// Pre-register Core Cartvai Categories so they always appear cleanly in the sidebar
		$core_categories = array(
			'cartvai-cloud'         => esc_html__( 'Cartvai Cloud Hub', 'cartvai' ),
			'cartvai-landing-pages' => esc_html__( 'Cartvai: Landing Pages', 'cartvai' ),
			'cartvai-hero-sections' => esc_html__( 'Cartvai: Hero Sections', 'cartvai' ),
			'cartvai-pricing-tables'=> esc_html__( 'Cartvai: Pricing Tables', 'cartvai' ),
			'cartvai-call-to-action'=> esc_html__( 'Cartvai: Call to Action', 'cartvai' ),
			'cartvai-trust-badges'  => esc_html__( 'Cartvai: Trust & Badges', 'cartvai' ),
			'cartvai-faq-accordion' => esc_html__( 'Cartvai: FAQ & Help', 'cartvai' ),
			'cartvai-how-it-works'  => esc_html__( 'Cartvai: How It Works', 'cartvai' ),
		);

		foreach ( $core_categories as $slug => $label ) {
			register_block_pattern_category( $slug, array( 'label' => $label ) );
		}

		$patterns = self::get_cloud_patterns();
		if ( empty( $patterns ) || ! is_array( $patterns ) ) {
			return;
		}

		foreach ( $patterns as $pattern ) {
			if ( empty( $pattern['slug'] ) || empty( $pattern['content'] ) ) {
				continue;
			}

			$categories = array( 'cartvai-cloud', 'cartvai' );

			if ( isset( $pattern['type'] ) && 'page' === $pattern['type'] ) {
				$categories[] = 'cartvai-landing-pages';
			}

			// Dynamically register and link categories from Pattern Hub
			if ( ! empty( $pattern['categories'] ) && is_array( $pattern['categories'] ) ) {
				foreach ( $pattern['categories'] as $index => $cat_slug ) {
					$prefixed_cat = 'cartvai-' . sanitize_key( $cat_slug );
					$cat_label    = ! empty( $pattern['category_labels'][ $index ] )
						? 'Cartvai: ' . wp_strip_all_tags( $pattern['category_labels'][ $index ] )
						: 'Cartvai: ' . ucwords( str_replace( '-', ' ', $cat_slug ) );

					register_block_pattern_category( $prefixed_cat, array( 'label' => $cat_label ) );
					$categories[] = $prefixed_cat;

					// Also map to WordPress core standard categories if matched
					$core_map = array(
						'hero-sections'   => 'banner',
						'banners'         => 'banner',
						'call-to-action'  => 'call-to-action',
						'cta'             => 'call-to-action',
						'footers-headers' => 'header',
						'headers'         => 'header',
						'footers'         => 'footer',
						'testimonials'    => 'testimonials',
						'services'        => 'services',
						'about'           => 'about',
						'landing-pages'   => 'featured',
					);

					if ( isset( $core_map[ $cat_slug ] ) ) {
						$categories[] = $core_map[ $cat_slug ];
					}
				}
			}

			$categories = array_values( array_unique( $categories ) );

			$title = sanitize_text_field( $pattern['title'] );
			if ( ! empty( $pattern['badge'] ) ) {
				$title .= ' [' . sanitize_text_field( $pattern['badge'] ) . ']';
			}

			register_block_pattern(
				'cartvai-cloud/' . sanitize_key( $pattern['slug'] ),
				array(
					'title'         => $title,
					'description'   => esc_html__( 'Cloud synced pattern from Cartvai Hub.', 'cartvai' ),
					'categories'    => $categories,
					'content'       => $pattern['content'],
					'viewportWidth' => ! empty( $pattern['viewportWidth'] ) ? absint( $pattern['viewportWidth'] ) : 1280,
				)
			);
		}
	}

	/**
	 * 1-Click Sync button on admin bar for quick refreshing.
	 *
	 * @param WP_Admin_Bar $wp_admin_bar
	 */
	public static function add_admin_bar_sync_button( $wp_admin_bar ) {
		if ( ! current_user_can( 'edit_theme_options' ) ) {
			return;
		}

		$sync_url = wp_nonce_url(
			admin_url( 'admin-post.php?action=cartvai_sync_cloud_patterns' ),
			'cartvai_sync_cloud_patterns_nonce'
		);

		$wp_admin_bar->add_node(
			array(
				'id'    => 'cartvai-sync-patterns',
				'title' => '<span class="ab-icon dashicons dashicons-update-alt" style="margin-top:2px;"></span> ' . esc_html__( 'Sync Cartvai Patterns', 'cartvai' ),
				'href'  => $sync_url,
				'meta'  => array(
					'title' => esc_html__( 'Fetch latest designs from Cartvai Cloud Pattern Hub', 'cartvai' ),
				),
			)
		);
	}

	/**
	 * Handle manual sync action.
	 */
	public static function handle_sync_action() {
		if ( ! current_user_can( 'edit_theme_options' ) ) {
			wp_die( esc_html__( 'Unauthorized.', 'cartvai' ) );
		}

		check_admin_referer( 'cartvai_sync_cloud_patterns_nonce' );

		$patterns = self::get_cloud_patterns( true );
		$count    = count( $patterns );

		$redirect_url = wp_get_referer();
		if ( ! $redirect_url ) {
			$redirect_url = admin_url();
		}

		$redirect_url = add_query_arg(
			array(
				'cartvai_patterns_synced' => 1,
				'pattern_count'           => $count,
			),
			$redirect_url
		);

		wp_safe_redirect( $redirect_url );
		exit;
	}

	/**
	 * Admin notice after manual sync.
	 */
	public static function render_sync_notice() {
		if ( isset( $_GET['cartvai_patterns_synced'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
			$count = isset( $_GET['pattern_count'] ) ? absint( $_GET['pattern_count'] ) : 0; // phpcs:ignore WordPress.Security.NonceVerification.Recommended
			?>
			<div class="notice notice-success is-dismissible">
				<p>
					<strong><?php esc_html_e( 'Cartvai Cloud Hub:', 'cartvai' ); ?></strong>
					<?php
					printf(
						/* translators: %d: number of patterns synced */
						esc_html__( 'Successfully synced %d cloud patterns and landing pages! They are now ready to use inside the Gutenberg editor.', 'cartvai' ),
						absint( $count )
					);
					?>
				</p>
			</div>
			<?php
		}
	}
}

Cartvai_Cloud_Patterns::init();
