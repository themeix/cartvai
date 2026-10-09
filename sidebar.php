<?php
/**
 * The sidebar containing the main widget area
 *
 * @package Cartvai_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<aside id="secondary" class="cv-widget-area cv:w-full cv:lg:w-80 cv:shrink-0" aria-label="<?php esc_attr_e( 'Sidebar', 'cartvai' ); ?>">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside>
