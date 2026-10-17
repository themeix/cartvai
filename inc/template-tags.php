<?php
/**
 * Cartvai Theme Template Tags and Helpers
 *
 * @package Cartvai_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Retrieve a theme setting value with fallback.
 *
 * Checks get_theme_mod first, then get_option('cartvai_theme_settings').
 *
 * @param string $key
 * @param mixed  $default
 * @return mixed
 */
function cartvai_theme_option( $key, $default = '' ) {
	$not_set = '__CV_NOT_SET__';
	$val     = $not_set;

	// 1. In Customizer preview, ALWAYS prioritize the live preview value
	if ( is_customize_preview() ) {
		$mod = get_theme_mod( 'cartvai_' . $key, $not_set );
		if ( $not_set !== $mod && '' !== $mod ) {
			$val = $mod;
		}
	}

	// 2. Check Theme Mod (if explicitly set and not empty string)
	if ( $not_set === $val ) {
		$mods = get_theme_mods();
		if ( is_array( $mods ) && array_key_exists( 'cartvai_' . $key, $mods ) ) {
			$mod = $mods[ 'cartvai_' . $key ];
			if ( '' !== $mod && null !== $mod ) {
				$val = $mod;
			}
		}
	}

	// 3. Check theme settings option array
	if ( $not_set === $val ) {
		$options = get_option( 'cartvai_theme_settings', array() );
		if ( is_array( $options ) && array_key_exists( $key, $options ) ) {
			$opt = $options[ $key ];
			if ( '' !== $opt && null !== $opt ) {
				$val = $opt;
			}
		}
	}

	// 4. Check CARTVAI_Settings (plugin settings integration)
	if ( $not_set === $val && class_exists( 'CARTVAI_Settings' ) ) {
		$plugin_val = CARTVAI_Settings::get( $key, $not_set );
		if ( $not_set !== $plugin_val && '' !== $plugin_val ) {
			$val = $plugin_val;
		} else {
			// Also check design_ prefix (e.g. primary_color -> design_primary_color)
			$design_map = array(
				'primary_color'       => 'design_primary_color',
				'primary_hover_color' => 'design_primary_deep_color',
				'primary_light_color' => 'design_primary_light_color',
				'border_color'        => 'design_border_color',
				'heading_color'       => 'design_heading_color',
				'text_color'          => 'design_text_color',
			);
			if ( isset( $design_map[ $key ] ) ) {
				$mapped_val = CARTVAI_Settings::get( $design_map[ $key ], $not_set );
				if ( $not_set !== $mapped_val && '' !== $mapped_val ) {
					$val = $mapped_val;
				}
			}
		}
	}

	if ( $not_set === $val || ( '' === $val && '' !== $default ) ) {
		$val = $default;
	}

	// Central safety check for contact email: never show empty or localhost addresses on frontend
	if ( 'contact_email' === $key ) {
		if ( empty( $val ) || false !== strpos( (string) $val, 'localhost' ) || false !== strpos( (string) $val, 'example.com' ) ) {
			return ! empty( $default ) ? $default : 'support@cartvai.com';
		}
	}

	return $val;
}

/**
 * Get active header style.
 *
 * Options: 'megastore', 'megabar', 'ecommerce', 'default', 'centered', 'minimal'
 *
 * @return string
 */
function cartvai_get_header_style() {
	$style   = cartvai_theme_option( 'header_style', 'megastore' );
	$allowed = array( 'megastore', 'megabar', 'ecommerce', 'default', 'centered', 'minimal' );

	return in_array( $style, $allowed, true ) ? $style : 'megastore';
}

/**
 * Get active footer style.
 *
 * Options: 'ecommerce', 'organic', 'warm_boutique', 'default', 'minimal'
 *
 * @return string
 */
function cartvai_get_footer_style() {
	$style   = cartvai_theme_option( 'footer_style', 'ecommerce' );
	$allowed = array( 'ecommerce', 'organic', 'warm_boutique', 'default', 'minimal' );

	return in_array( $style, $allowed, true ) ? $style : 'ecommerce';
}

/**
 * Get preset default colors for a footer style.
 *
 * @param string|null $footer_style Optional footer style slug.
 * @return array Associative array of CSS color values.
 */
function cartvai_get_footer_preset_defaults( $footer_style = null ) {
	if ( empty( $footer_style ) ) {
		$footer_style = cartvai_get_footer_style();
	}

	switch ( $footer_style ) {
		case 'organic':
			return array(
				'footer_bg'      => '#0d3b2e',
				'footer_text'    => '#cbd5e1',
				'footer_heading' => '#ffffff',
				'footer_link'    => '#a7f3d0',
				'footer_border'  => 'rgba(255, 255, 255, 0.1)',
				'footer_sub_bg'  => '#07241b',
			);
		case 'warm_boutique':
			return array(
				'footer_bg'      => '#fdf8f5',
				'footer_text'    => '#57534e',
				'footer_heading' => '#1c1917',
				'footer_link'    => '#44403c',
				'footer_border'  => '#e7e5e4',
				'footer_sub_bg'  => '#f5ece5',
			);
		case 'default':
			return array(
				'footer_bg'      => '#ffffff',
				'footer_text'    => '#64748b',
				'footer_heading' => '#0f172a',
				'footer_link'    => '#334155',
				'footer_border'  => '#e2e8f0',
				'footer_sub_bg'  => '#f8fafc',
			);
		case 'minimal':
			return array(
				'footer_bg'      => '#ffffff',
				'footer_text'    => '#64748b',
				'footer_heading' => '#0f172a',
				'footer_link'    => '#334155',
				'footer_border'  => '#f1f5f9',
				'footer_sub_bg'  => '#ffffff',
			);
		case 'ecommerce':
		default:
			return array(
				'footer_bg'      => '#030712',
				'footer_text'    => '#94a3b8',
				'footer_heading' => '#ffffff',
				'footer_link'    => '#d1d5db',
				'footer_border'  => '#1f2937',
				'footer_sub_bg'  => '#020617',
			);
	}
}

/**
 * Get preset default colors for a header style.
 *
 * @param string|null $header_style Optional header style slug.
 * @return array
 */
function cartvai_get_header_preset_defaults( $header_style = null ) {
	if ( empty( $header_style ) ) {
		$header_style = cartvai_get_header_style();
	}

	switch ( $header_style ) {
		case 'megastore':
			return array(
				'top_bar_bg'      => '#0b192c',
				'top_bar_text'    => '#dbeafe',
				'main_bar_bg'     => '#1e40af',
				'main_bar_border' => 'rgba(255, 255, 255, 0.1)',
				'nav_bar_bg'      => '#172554',
				'nav_bar_border'  => 'rgba(255, 255, 255, 0.1)',
				'nav_link_color'  => '#ffffff',
				'nav_link_hover'  => '#93c5fd',
			);
		case 'megabar':
			return array(
				'top_bar_bg'      => '#030712',
				'top_bar_text'    => '#d1d5db',
				'main_bar_bg'     => '#ffffff',
				'main_bar_border' => '#e5e7eb',
				'nav_bar_bg'      => '#1e40af',
				'nav_bar_border'  => 'rgba(255, 255, 255, 0.1)',
				'nav_link_color'  => '#ffffff',
				'nav_link_hover'  => '#93c5fd',
			);
		case 'ecommerce':
		default:
			return array(
				'top_bar_bg'      => '#030712',
				'top_bar_text'    => '#d1d5db',
				'main_bar_bg'     => '#ffffff',
				'main_bar_border' => '#e5e7eb',
				'nav_bar_bg'      => '#ffffff',
				'nav_bar_border'  => '#e5e7eb',
				'nav_link_color'  => '#1e293b',
				'nav_link_hover'  => '#2563eb',
			);
	}
}

/**
 * Determine if a given hex color is dark.
 *
 * @param string $hex Hex color string.
 * @return bool True if dark, false if light.
 */
function cartvai_is_dark_hex( $hex ) {
	$hex = ltrim( trim( (string) $hex ), '#' );
	if ( strlen( $hex ) === 3 ) {
		$hex = $hex[0] . $hex[0] . $hex[1] . $hex[1] . $hex[2] . $hex[2];
	}
	if ( strlen( $hex ) !== 6 ) {
		return true;
	}
	$r = hexdec( substr( $hex, 0, 2 ) );
	$g = hexdec( substr( $hex, 2, 2 ) );
	$b = hexdec( substr( $hex, 4, 2 ) );
	$luminance = ( 0.299 * $r + 0.587 * $g + 0.114 * $b ) / 255;
	return $luminance < 0.6;
}

/**
 * Retrieve the customer account page URL.
 *
 * Checks CARTVAI_Account first, with smart fallback to 'my-account' page or home_url('/my-account/').
 *
 * @param string $tab  Optional active tab.
 * @param array  $args Optional additional query parameters.
 * @return string Full account page URL.
 */
function cartvai_get_account_url( $tab = '', $args = array() ) {
	$url = '';

	if ( class_exists( 'CARTVAI_Account' ) && method_exists( 'CARTVAI_Account', 'get_account_page_url' ) ) {
		$url = CARTVAI_Account::get_account_page_url( $tab, $args );
	}

	// If plugin returns default fallback '/cartvai-account/' or empty, prefer 'my-account'
	if ( empty( $url ) || false !== strpos( $url, '/cartvai-account/' ) ) {
		$account_page = get_page_by_path( 'my-account' );
		if ( ! $account_page ) {
			$account_page = get_page_by_path( 'cartvai-account' );
		}

		if ( $account_page && 'publish' === $account_page->post_status ) {
			$url = get_permalink( $account_page->ID );
			if ( ! empty( $tab ) && 'dashboard' !== $tab ) {
				$args['tab'] = sanitize_key( $tab );
			}
			if ( ! empty( $args ) ) {
				$url = add_query_arg( $args, $url );
			}
		} else {
			$url = home_url( '/my-account/' );
			if ( ! empty( $tab ) && 'dashboard' !== $tab ) {
				$args['tab'] = sanitize_key( $tab );
			}
			if ( ! empty( $args ) ) {
				$url = add_query_arg( $args, $url );
			}
		}
	}

	return apply_filters( 'cartvai_theme_account_url', $url, $tab, $args );
}

/**
 * Custom Comment Callback for Modern Tailwind UI Design
 *
 * @param WP_Comment $comment Comment object.
 * @param array      $args    Arguments array.
 * @param int        $depth   Depth level.
 */
function cartvai_comment_callback( $comment, $args, $depth ) {
	$tag       = ( 'div' === $args['style'] ) ? 'div' : 'li';
	$is_reply  = (int) $comment->comment_parent > 0;
	$reply_btn = get_comment_reply_link(
		array_merge(
			$args,
			array(
				'add_below'  => 'div-comment',
				'depth'      => $depth,
				'max_depth'  => $args['max_depth'],
				'reply_text' => '<svg class="cv:w-3.5 cv:h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path></svg> <span>' . esc_html__( 'Reply', 'cartvai' ) . '</span>',
				'before'     => '',
				'after'      => '',
			)
		)
	);
	?>
	<<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( 'cv-comment-item ' . ( $is_reply ? 'cv-comment-reply' : '' ), $comment ); ?>>
		<article id="div-comment-<?php comment_ID(); ?>" class="cv-comment-body cv:group cv:p-5 cv:sm:p-6 cv:rounded-2xl cv:bg-gray-50/70 cv:border cv:border-gray-100/80 hover:cv:border-gray-200 cv:transition-all">
			<header class="cv-comment-meta cv:flex cv:items-center cv:justify-between cv:gap-4 cv:mb-3">
				<div class="cv:flex cv:items-center cv:gap-3.5">
					<?php if ( 0 !== (int) $args['avatar_size'] ) : ?>
						<div class="cv:shrink-0">
							<?php echo get_avatar( $comment, $args['avatar_size'], '', '', array( 'class' => 'cv:w-11 cv:h-11 cv:rounded-full cv:ring-2 cv:ring-white cv:shadow-xs cv:object-cover' ) ); ?>
						</div>
					<?php endif; ?>
					<div>
						<div class="cv:font-bold cv:text-gray-900 cv:text-sm cv:leading-snug">
							<?php echo get_comment_author_link( $comment ); ?>
						</div>
						<div class="cv:flex cv:items-center cv:gap-2 cv:text-xs cv:text-gray-400 cv:mt-0.5">
							<time datetime="<?php comment_time( 'c' ); ?>">
								<?php printf( esc_html__( '%1$s at %2$s', 'cartvai' ), get_comment_date( '', $comment ), get_comment_time() ); ?>
							</time>
						</div>
					</div>
				</div>

				<?php if ( ! empty( $reply_btn ) ) : ?>
					<div class="cv-comment-reply-wrap">
						<?php echo $reply_btn; ?>
					</div>
				<?php endif; ?>
			</header>

			<?php if ( '0' === (string) $comment->comment_approved ) : ?>
				<p class="cv-comment-awaiting-moderation cv:text-xs cv:text-amber-700 cv:font-medium cv:bg-amber-50 cv:border cv:border-amber-200 cv:px-3 cv:py-1.5 cv:rounded-lg cv:mb-3">
					<?php esc_html_e( 'Your comment is awaiting moderation.', 'cartvai' ); ?>
				</p>
			<?php endif; ?>

			<div class="cv-comment-content cv:text-sm cv:text-gray-700 cv:leading-relaxed [&>p]:cv:mb-2 [&>p:last-child]:cv:mb-0">
				<?php comment_text(); ?>
			</div>
		</article>
	<?php
}



