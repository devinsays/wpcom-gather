<?php
/**
 * Implements styles set in the theme customizer
 *
 * @package Gather
 */

if ( ! function_exists( 'gather_display_customizations' ) ) :
/**
 * Generates the style tag and CSS needed for the theme options.
 *
 * By using the "Customizer_Library_Styles" filter, different components can print CSS in the header.
 * It is organized this way to ensure there is only one "style" tag.
 *
 * @since  1.0.0.
 *
 * @return void
 */
function gather_display_customizations() {

	$css = '';

	// Header Image
	$image = get_header_image();
	if ( '' != $image ) {
		$css .= '.site-branding { background-image:url("' . esc_url( $image ) . '"); }' . "\n";
	}

	// Center Header Text
	$setting = 'center-branding';
	$mod = get_theme_mod( $setting, 0 );
	if ( $mod ) {
		$css .= ".site-branding { text-align: center; }\n";
	}

	// Logo Margin if Header Text Active
	$jetpack_logo = function_exists( 'jetpack_has_site_logo' ) && jetpack_has_site_logo();
	if ( ( 'blank' != get_header_textcolor() ) && $jetpack_logo ) {
		$css .= ".site-logo-link { margin-bottom: 30px; }\n";
	}

	// Set Minimum Height for Header
	if ( 'blank' == get_header_textcolor() ) {
		$css .= ".site-title, .site-description { position: absolute; clip: rect(1px, 1px, 1px, 1px); }\n";
	}

	if ( 'blank' == get_header_textcolor() && ! $jetpack_logo ) {
		$css .= ".site-branding { min-height: 180px; }\n";
	}

	if ( ! empty( $css ) ) {
		echo "\n<!-- Gather Inline Styles -->\n<style type=\"text/css\" id=\"gather-custom-css\">\n";
		echo $css;
		echo "\n</style>\n";
	}
}
endif;
add_action( 'wp_head', 'gather_display_customizations', 100 );