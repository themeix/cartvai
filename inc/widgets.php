<?php
/**
 * Register widget area.
 *
 * @package Cartvai_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function cartvai_theme_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Primary Sidebar', 'cartvai-theme' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'cartvai-theme' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s cv:bg-white cv:p-6 cv:rounded-2xl cv:border cv:border-gray-100 cv:mb-6 cv:shadow-xs">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title cv:text-base cv:font-bold cv:text-gray-900 cv:mb-4 cv:pb-2 cv:border-b cv:border-gray-100">',
			'after_title'   => '</h2>',
		)
	);

	// Register Footer Widget Areas (Columns 1 - 5)
	$footer_sidebars = array(
		'footer-1' => array(
			'name'        => esc_html__( 'Footer Column 1', 'cartvai-theme' ),
			'description' => esc_html__( 'Widgets in this area appear in the first footer column (replaces default brand / about block if widgets are added).', 'cartvai-theme' ),
		),
		'footer-2' => array(
			'name'        => esc_html__( 'Footer Column 2', 'cartvai-theme' ),
			'description' => esc_html__( 'Widgets in this area appear in the second footer column (e.g. navigation menu, categories, or links).', 'cartvai-theme' ),
		),
		'footer-3' => array(
			'name'        => esc_html__( 'Footer Column 3', 'cartvai-theme' ),
			'description' => esc_html__( 'Widgets in this area appear in the third footer column (e.g. customer care, policies, or info).', 'cartvai-theme' ),
		),
		'footer-4' => array(
			'name'        => esc_html__( 'Footer Column 4', 'cartvai-theme' ),
			'description' => esc_html__( 'Widgets in this area appear in the fourth footer column (e.g. newsletter, help center, or social links).', 'cartvai-theme' ),
		),
		'footer-5' => array(
			'name'        => esc_html__( 'Footer Column 5', 'cartvai-theme' ),
			'description' => esc_html__( 'Widgets in this area appear in the fifth footer column (used in 5-column footers like Organic D2C & Boutique).', 'cartvai-theme' ),
		),
	);

	foreach ( $footer_sidebars as $id => $sidebar ) {
		register_sidebar(
			array(
				'name'          => $sidebar['name'],
				'id'            => $id,
				'description'   => $sidebar['description'],
				'before_widget' => '<div id="%1$s" class="widget cv-footer-widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widget-title cv-footer-widget-title cv:text-xs cv:font-bold cv:uppercase cv:tracking-wider cv:mb-4" style="color: var(--cv-footer-heading, inherit);">',
				'after_title'   => '</h3>',
			)
		);
	}
}
add_action( 'widgets_init', 'cartvai_theme_widgets_init' );
