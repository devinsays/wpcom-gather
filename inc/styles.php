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
	$setting = 'site_logo_header_text';
	$mod = get_theme_mod( 'site_logo_header_text', 1 );
	if ( $mod && function_exists( 'jetpack_has_site_logo' ) && jetpack_has_site_logo() ) {
		$css .= ".site-logo-link { margin-bottom: 30px; }\n";
	}

	// Hide Header Text if Checkbox Deactivated

	if ( ! empty( $css ) ) {
		echo "\n<!-- Gather Inline Styles -->\n<style type=\"text/css\" id=\"gather-custom-css\">\n";
		echo $css;
		echo "\n</style>\n";
	}
}
endif;
add_action( 'wp_head', 'gather_display_customizations', 100 );