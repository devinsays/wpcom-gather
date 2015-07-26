<?php
/**
 * Compatibility settings and functions for Jetpack.
 * See http://jetpack.me/support/infinite-scroll/
 *
 * @package Gather
 */

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 *
 * @since Gather 1.0.0
 */
function gather_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => '#posts-wrap',
		'footer'    => false,
		'footer_widgets' => 'footer',
		'render' => 'gather_infinite_scroll_render'
	) );
}
add_action( 'after_setup_theme', 'gather_jetpack_setup' );

/**
 * Used by JetPack to render the correct template part
 *
 * @since Gather 1.0.0
 */
function gather_infinite_scroll_render() {
	while ( have_posts() ) {
	    the_post();
	    get_template_part( 'content', gather_template_part() );
	}
}

/**
 * Add support for the Site Logo
 *
 * @since Gather 1.0.0
 */
function gather_site_logo_init() {
	add_image_size( 'gather-logo', 1140, 180 );
	add_theme_support( 'site-logo', array( 'size' => 'gather-logo' ) );
}
add_action( 'after_setup_theme', 'gather_site_logo_init' );

/**
 * Add theme support for Responsive Videos
 *
 * @since Gather 1.0.0
 */
function gather_responsive_videos_init() {
	add_theme_support( 'jetpack-responsive-videos' );
}
add_action( 'after_setup_theme', 'gather_responsive_videos_init' );