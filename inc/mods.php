<?php
/**
 * Functions used to implement options
 *
 * @package Gather
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @since Gather 1.0.0
 *
 * @param array $classes
 * @returns array $classes
 */
function gather_body_classes( $classes ) {

	global $post;

	if ( gather_load_masonry() ) {
		$classes[] = get_theme_mod( 'archive-layout', 'column-masonry-3' );
		$classes[] = 'masonry';
	}

	if ( gather_show_sidebar() ) {
		$classes[] = get_theme_mod( 'standard-layout', 'sidebar-right' );
	} else {
		$classes[] = 'no-sidebar';
	}

	// Simplify body class for full-width template
	if ( isset( $post ) && ( is_page_template( 'templates/full-width.php' ) ) ) {
		$classes[] = 'full-width';
	}

	return $classes;
}
add_filter( 'body_class', 'gather_body_classes' );

if ( ! function_exists( 'gather_show_sidebar' ) ) :
/**
 * Conditional logic for displaying sidebar
 *
 * @since Gather 1.0.0
 */
function gather_show_sidebar() {

	// If an archive page is displayed and display sidebar on archives is checked
	if ( !is_singular() && !is_404() && !get_theme_mod( 'archive-sidebar', '0' ) ) {
		return false;
	}

	// If there's no active sidebar widgets
	if ( !is_active_sidebar( 'primary' ) ) {
		return false;
	}

	return true;
}
endif;

if ( ! function_exists( 'gather_load_masonry' ) ) :
/**
 * Conditional logic for loading masonry script
 *
 * @since Gather 1.0.0
 */
function gather_load_masonry() {

	if ( !is_singular() && !is_404() ) {
		$archive_layout = get_theme_mod( 'archive-layout', 'column-masonry-3' );
		if ( $archive_layout != 'standard' ) {
			return true;
		}
	}

	return false;
}
endif;

if ( ! function_exists( 'gather_get_columns' ) ) :
/**
 * Outputs the number of masonry columns as a data attribute
 *
 * @since Gather 1.0.0
 */
function gather_get_columns() {
	$layout = get_theme_mod( 'archive-layout', 'column-masonry-3' );
	switch ( $layout ) {
		case '4-column-masonry':
			return '4';
		case '3-column-masonry':
			return '3';
		case '2-column-masonry':
			return '2';
		default:
			return '0';
	}
}
endif;