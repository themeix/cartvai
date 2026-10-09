<?php
/**
 * Navigation Filters & Dropdown Enhancements
 *
 * @package Cartvai_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Append stylish SVG chevron to menu items that have children.
 */
function cartvai_theme_add_menu_arrows( $title, $item, $args, $depth ) {
	if ( in_array( 'menu-item-has-children', $item->classes, true ) ) {
		$title .= '<svg class="cv-dropdown-arrow cv:w-3.5 cv:h-3.5 cv:ml-1 cv:inline-block cv:transition-transform cv:duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>';
	}
	return $title;
}
add_filter( 'nav_menu_item_title', 'cartvai_theme_add_menu_arrows', 10, 4 );
