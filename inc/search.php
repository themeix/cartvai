<?php
/**
 * Real-Time Live AJAX Product & Content Search for Cartvai Theme
 *
 * Provides:
 * - Category retrieval for categorized search
 * - Multi-content AJAX live search supporting products, blog posts, and all content
 * - Taxonomy filtering by selected category
 * - Relevance sorting on title, SKU, content
 * - Formatted pricing for products, category badges, post type badges
 * - Pre_get_posts integration for standard search result pages
 *
 * @package Cartvai_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Retrieve categories for the search dropdown based on configured search post type.
 *
 * @return array Array of WP_Term objects or empty array.
 */
function cartvai_get_search_categories() {
	$search_post_type = function_exists( 'cartvai_theme_option' ) ? cartvai_theme_option( 'search_post_type', 'cartvai_product' ) : 'cartvai_product';
	$taxonomy         = 'cartvai_product_cat';

	if ( 'post' === $search_post_type ) {
		$taxonomy = 'category';
	}

	$terms = get_terms(
		array(
			'taxonomy'   => $taxonomy,
			'hide_empty' => false,
			'number'     => 40,
			'orderby'    => 'count',
			'order'      => 'DESC',
		)
	);

	if ( ( is_wp_error( $terms ) || empty( $terms ) ) && ( 'any' === $search_post_type || 'cartvai_product' === $search_post_type ) ) {
		// Fallback to standard blog categories if no product categories exist
		$terms = get_terms(
			array(
				'taxonomy'   => 'category',
				'hide_empty' => false,
				'number'     => 40,
			)
		);
	}

	return ( ! is_wp_error( $terms ) && ! empty( $terms ) ) ? $terms : array();
}

/**
 * Filter search query to respect selected category and post types on search result page
 *
 * @param WP_Query $query The main query object.
 */
function cartvai_theme_filter_search_query( $query ) {
	if ( ! is_admin() && $query->is_main_query() && $query->is_search() ) {
		$post_type = $query->get( 'post_type' );

		/*
		 * Flag product searches (cartvai_product, any, or unscoped) so the
		 * Cartvai plugin's SKU search filters (sku_search_join /
		 * sku_search_where) include SKU matches. Inert when the plugin is
		 * inactive and skipped for blog-only searches.
		 */
		if ( 'post' !== $post_type ) {
			$query->set( 'cartvai_sku_search', true );
		}

		$cat_slug = '';
		if ( isset( $_GET['product_cat'] ) && ! empty( $_GET['product_cat'] ) ) {
			$cat_slug = sanitize_text_field( wp_unslash( $_GET['product_cat'] ) );
		} elseif ( isset( $_GET['cv_category'] ) && ! empty( $_GET['cv_category'] ) ) {
			$cat_slug = sanitize_text_field( wp_unslash( $_GET['cv_category'] ) );
		}

		if ( ! empty( $cat_slug ) ) {
			$post_type = $query->get( 'post_type' );
			$taxonomy  = ( 'post' === $post_type ) ? 'category' : 'cartvai_product_cat';

			$tax_query   = (array) $query->get( 'tax_query' );
			$tax_query[] = array(
				'taxonomy' => $taxonomy,
				'field'    => 'slug',
				'terms'    => $cat_slug,
			);
			$query->set( 'tax_query', $tax_query );
		}
	}
}
add_action( 'pre_get_posts', 'cartvai_theme_filter_search_query' );

/**
 * Handle AJAX Live Search Request
 */
function cartvai_theme_ajax_search() {
	check_ajax_referer( 'cartvai_ajax_search_nonce', 'nonce' );

	$term     = isset( $_REQUEST['term'] ) ? sanitize_text_field( wp_unslash( $_REQUEST['term'] ) ) : '';
	$category = isset( $_REQUEST['category'] ) ? sanitize_text_field( wp_unslash( $_REQUEST['category'] ) ) : '';

	if ( mb_strlen( $term ) < 2 ) {
		wp_send_json_success(
			array(
				'products' => array(),
				'total'    => 0,
				'term'     => $term,
			)
		);
	}

	// Determine post type to search
	$theme_post_type = function_exists( 'cartvai_theme_option' ) ? cartvai_theme_option( 'search_post_type', 'cartvai_product' ) : 'cartvai_product';
	if ( isset( $_REQUEST['post_type'] ) && ! empty( $_REQUEST['post_type'] ) ) {
		$requested_pt = sanitize_key( $_REQUEST['post_type'] );
		if ( in_array( $requested_pt, array( 'cartvai_product', 'post', 'any' ), true ) ) {
			$theme_post_type = $requested_pt;
		}
	}

	$post_types = ( 'any' === $theme_post_type ) ? array( 'cartvai_product', 'post' ) : $theme_post_type;

	$query_args = array(
		'post_type'      => $post_types,
		'post_status'    => 'publish',
		's'              => $term,
		'posts_per_page' => 8,
		'orderby'        => 'relevance',
	);

	// Product searches also match the SKU via the Cartvai plugin's
	// sku_search filters; the flag is inert when the plugin is inactive
	// and skipped for blog-only searches.
	if ( 'post' !== $theme_post_type ) {
		$query_args['cartvai_sku_search'] = true;
	}

	// Apply category filtering if selected
	if ( ! empty( $category ) ) {
		$taxonomy = ( 'post' === $theme_post_type ) ? 'category' : 'cartvai_product_cat';
		$query_args['tax_query'] = array(
			array(
				'taxonomy' => $taxonomy,
				'field'    => 'slug',
				'terms'    => $category,
			),
		);
	}

	$query    = new WP_Query( $query_args );
	$items    = array();

	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {
			$query->the_post();
			$post_id   = get_the_ID();
			$post_type = get_post_type();

			// Thumbnail
			$image_url = get_the_post_thumbnail_url( $post_id, 'thumbnail' );
			if ( ! $image_url ) {
				$image_url = '';
			}

			$price_html = '';
			$badge      = '';

			if ( 'cartvai_product' === $post_type ) {
				// Product price calculation
				$regular_price = get_post_meta( $post_id, '_cartvai_price', true );
				if ( '' === $regular_price || null === $regular_price ) {
					$regular_price = get_post_meta( $post_id, '_cartvai_regular_price', true );
				}
				$sale_price = get_post_meta( $post_id, '_cartvai_sale_price', true );

				if ( class_exists( 'CARTVAI_Settings' ) && method_exists( 'CARTVAI_Settings', 'format_price' ) ) {
					if ( '' !== $sale_price && null !== $sale_price && (float) $sale_price < (float) $regular_price ) {
						$price_html = '<span class="cv:font-bold cv:text-primary">' . esc_html( CARTVAI_Settings::format_price( $sale_price ) ) . '</span> <span class="cv:text-xs cv:text-gray-400 cv:line-through cv:ml-1">' . esc_html( CARTVAI_Settings::format_price( $regular_price ) ) . '</span>';
					} elseif ( '' !== $regular_price && null !== $regular_price ) {
						$price_html = '<span class="cv:font-bold cv:text-gray-900">' . esc_html( CARTVAI_Settings::format_price( $regular_price ) ) . '</span>';
					}
				}

				// Primary product category
				$categories = get_the_terms( $post_id, 'cartvai_product_cat' );
				$badge      = ( ! empty( $categories ) && ! is_wp_error( $categories ) ) ? $categories[0]->name : esc_html__( 'Product', 'cartvai' );

			} else {
				// Blog post display
				$categories = get_the_category( $post_id );
				$badge      = ( ! empty( $categories ) ) ? $categories[0]->name : esc_html__( 'Article', 'cartvai' );
				$price_html = '';
				$post_date  = get_the_date( 'M j, Y' );
			}

			$items[] = array(
				'id'         => $post_id,
				'type'       => $post_type,
				'title'      => html_entity_decode( get_the_title(), ENT_QUOTES, 'UTF-8' ),
				'url'        => get_permalink( $post_id ),
				'image'      => $image_url,
				'price_html' => $price_html,
				'category'   => $badge,
				'date'       => ( 'cartvai_product' === $post_type ) ? '' : ( isset( $post_date ) ? $post_date : '' ),
			);
		}
		wp_reset_postdata();
	}

	// Build View All Results URL
	$view_all_args = array(
		's' => $term,
	);
	if ( 'any' !== $theme_post_type ) {
		$view_all_args['post_type'] = $theme_post_type;
	}
	if ( ! empty( $category ) ) {
		$view_all_args['product_cat'] = $category;
	}

	$view_all_url = add_query_arg( $view_all_args, home_url( '/' ) );

	if ( 'cartvai_product' === $theme_post_type && empty( $category ) && class_exists( 'CARTVAI_Settings' ) ) {
		$shop_page_id = (int) CARTVAI_Settings::get( 'shop_page_id', 0 );
		if ( $shop_page_id ) {
			$view_all_url = add_query_arg( 'cv_search', rawurlencode( $term ), get_permalink( $shop_page_id ) );
		}
	}

	wp_send_json_success(
		array(
			'products'     => $items,
			'total'        => (int) $query->found_posts,
			'view_all_url' => $view_all_url,
			'term'         => $term,
			'category'     => $category,
		)
	);
}
add_action( 'wp_ajax_cartvai_ajax_search', 'cartvai_theme_ajax_search' );
add_action( 'wp_ajax_nopriv_cartvai_ajax_search', 'cartvai_theme_ajax_search' );
