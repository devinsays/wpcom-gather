<?php
/**
 * WordPress.com-specific functions and definitions
 * This file is centrally included from `wp-content/mu-plugins/wpcom-theme-compat.php`.
 *
 * @package Gather
 */

 /**
 * Adds support for WP.com print styles and $themecolors
 */
function gather_theme_support() {

	global $themecolors;

	/**
	 * Set a default theme color array for WP.com.
	 *
	 * @global array $themecolors
	 */
	if ( ! isset( $themecolors ) ) :
		$themecolors = array(
			'bg'     => 'f2f2f2',
			'text'   => '333333',
			'link'   => '5bc08c',
			'url'    => '5bc08c',
		);
	endif;

	add_theme_support( 'print-style' );
}
add_action( 'after_setup_theme', 'gather_theme_support' );

/*
 * De-queue Google fonts if custom fonts are being used instead
 */
function gather_dequeue_fonts() {
	if ( class_exists( 'TypekitData' ) && class_exists( 'CustomDesign' ) && CustomDesign::is_upgrade_active() ) {
		$customfonts = TypekitData::get( 'families' );
		if ( $customfonts && $customfonts['site-title']['id'] && $customfonts['headings']['id'] && $customfonts['body-text']['id'] ) {
			wp_dequeue_style( 'gather-body-fonts' );
		}
	}
}
add_action( 'wp_enqueue_scripts', 'gather_dequeue_fonts' );