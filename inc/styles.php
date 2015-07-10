<?php
/**
 * Implements styles set in the theme customizer
 *
 * @package Gather
 */

if ( ! function_exists( 'gather_styles' ) && class_exists( 'Customizer_Library_Styles' ) ) :
/**
 * Process user options to generate CSS needed to implement the choices.
 *
 * @since  1.0.0.
 *
 * @return void
 */
function gather_styles() {

	// Header Background Color
	$setting = 'header-background-color';
	$mod = get_theme_mod( $setting, customizer_library_get_default( $setting ) );

	if ( $mod != customizer_library_get_default( $setting ) ) {

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.site-branding'
			),
			'declarations' => array(
				'background-color' => $mod
			)
		) );

	}

	// Header Background Image
	$setting = 'header-background-image';
	$mod = get_theme_mod( $setting, false );

	if ( $mod ) {

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.site-branding'
			),
			'declarations' => array(
				'background-image' => 'url(' . $mod . ')'
			)
		) );

	}

	// Header Background Image Styles
	$setting = 'header-background-image-style';
	$mod = get_theme_mod( $setting, customizer_library_get_default( $setting ) );

	if ( $mod != customizer_library_get_default( $setting ) ) {

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.site-branding'
			),
			'declarations' => array(
				'background-size' => 'auto auto',
				'background-repeat' => 'repeat',
				'background-position' => '0 0'
			)
		) );

	}

	// Center Header Text
	$setting = 'center-branding';
	$mod = get_theme_mod( $setting, customizer_library_get_default( $setting ) );

	if ( $mod ) {

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.site-branding'
			),
			'declarations' => array(
				'text-align' => 'center'
			)
		) );

	}

	// Site Title Color
	$setting = 'site-title-color';
	$mod = get_theme_mod( $setting, customizer_library_get_default( $setting ) );

	if ( $mod != customizer_library_get_default( $setting ) ) {

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.site-title a'
			),
			'declarations' => array(
				'color' => $mod
			)
		) );

	}

	// Site Title Color
	$setting = 'site-title-hover-color';
	$mod = get_theme_mod( $setting, customizer_library_get_default( $setting ) );

	if ( $mod != customizer_library_get_default( $setting ) ) {

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.site-title a:hover'
			),
			'declarations' => array(
				'color' => $mod
			)
		) );

	}

	// Site Title Font
	$setting = 'site-title-font';
	$mod = get_theme_mod( $setting, customizer_library_get_default( $setting ) );
	$stack = customizer_library_get_font_stack( $mod );

	if ( $mod != customizer_library_get_default( $setting ) ) {

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.site-title'
			),
			'declarations' => array(
				'font-family' => $stack
			)
		) );

	}

	// Site Tagline Color
	$setting = 'site-tagline-color';
	$mod = get_theme_mod( $setting, customizer_library_get_default( $setting ) );

	if ( $mod != customizer_library_get_default( $setting ) ) {

		Customizer_Library_Styles()->add( array(
			'selectors' => array(
				'.site-description'
			),
			'declarations' => array(
				'color' => $mod
			)
		) );

	}

}
endif;

add_action( 'customizer_library_styles', 'gather_styles' );

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

	do_action( 'customizer_library_styles' );

	// Echo the rules
	$css = Customizer_Library_Styles()->build();

	if ( ! empty( $css ) ) {
		echo "\n<!-- Begin Gather Custom CSS -->\n<style type=\"text/css\" id=\"gather-custom-css\">\n";
		echo $css;
		echo "\n</style>\n<!-- End Gather Custom CSS -->\n";
	}
}
endif;

add_action( 'wp_head', 'gather_display_customizations', 11 );