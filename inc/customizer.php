<?php
/**
 * Gather Theme Customizer
 *
 * @package Gather
 */

/**
 * Adds controls to the customizer
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function gather_customize_controls( $wp_customize ) {

	// Header Settings
	$wp_customize->add_setting( 'center-branding', array(
		'default'    =>  0,
		'transport'  =>  'refresh',
		'sanitize_callback' => 'gather_sanitize_checkbox'
	) );

	$wp_customize->add_control( 'center-branding', array(
		'label'   => __( 'Center Header Text/Logo', 'gather' ),
		'section'   => 'title_tagline',
		'type'      => 'checkbox'
	) );

	// Navigation Settings
	if ( has_nav_menu( 'primary' ) ):

		$wp_customize->add_setting( 'primary-menu-search', array(
			'default'    =>  0,
			'transport'  =>  'refresh',
			'sanitize_callback' => 'gather_sanitize_checkbox'
		) );

		$wp_customize->add_control( 'primary-menu-search', array(
			'label'   => __( 'Search Box (Primary Menu)', 'gather' ),
			'section'   => 'nav',
			'type'      => 'checkbox'
		) );

	endif;

	if ( has_nav_menu( 'secondary' ) ):

		$wp_customize->add_setting( 'secondary-menu-search', array(
			'default'    =>  0,
			'transport'  =>  'refresh',
			'sanitize_callback' => 'gather_sanitize_checkbox'
		) );

		$wp_customize->add_control( 'secondary-menu-search', array(
			'label'   => __( 'Search Box (Secondary Menu)', 'gather' ),
			'section'   => 'nav',
			'type'      => 'checkbox'
		) );

	endif;

	// Layout Settings
	$wp_customize->add_section( 'layout' , array(
		'title' => __( 'Layout', 'gather' ),
		'priority'   => 70,
	) );

	$wp_customize->add_setting( 'standard-layout', array(
		'default'    =>  1,
		'transport'  =>  'refresh',
		'default' => 'sidebar-right',
		'sanitize_callback' => 'gather_sanitize_standard_layout'
	) );

	$wp_customize->add_control( 'standard-layout', array(
		'label'   => __( 'Standard Layout', 'gather' ),
		'section'   => 'layout',
		'type'      => 'select',
		'choices'	=> gather_get_select_choices( 'standard-layout' )
	) );

	$wp_customize->add_setting( 'archive-layout', array(
		'default'    =>  1,
		'transport'  =>  'refresh',
		'default' => 'column-masonry-3',
		'sanitize_callback' => 'gather_sanitize_archive_layout'
	) );

	$wp_customize->add_control( 'archive-layout', array(
		'label'   => __( 'Archive Layout', 'gather' ),
		'section'   => 'layout',
		'type'      => 'select',
		'choices'	=> gather_get_select_choices( 'archive-layout' )
	) );

	$wp_customize->add_setting( 'archive-sidebar', array(
		'default'    =>  0,
		'transport'  =>  'refresh',
		'sanitize_callback' => 'gather_sanitize_checkbox'
	) );

	$wp_customize->add_control( 'archive-sidebar', array(
		'label'   => __( 'Display Sidebar on Archives', 'gather' ),
		'section'   => 'layout',
		'type'      => 'checkbox'
	) );

	// Archive Settings
	$wp_customize->add_section( 'archive' , array(
		'title' => __( 'Archive', 'gather' ),
		'priority'   => 80,
	) );

	$wp_customize->add_setting( 'archive-excerpts', array(
		'default'    =>  0,
		'transport'  =>  'refresh',
		'sanitize_callback' => 'gather_sanitize_checkbox'
	) );

	$wp_customize->add_control( 'archive-excerpts', array(
		'label'			=> __( 'Display Excerpts', 'gather' ),
		'description'	=> __( 'Always display excerpts instead of full content.', 'gather' ),
		'section'		=> 'archive',
		'type'			=> 'checkbox'
	) );

	$wp_customize->add_setting( 'archive-featured-images', array(
		'default'    =>  1,
		'transport'  =>  'refresh',
		'sanitize_callback' => 'gather_sanitize_checkbox'
	) );

	$wp_customize->add_control( 'archive-featured-images', array(
		'label'			=> __( 'Display Featured Images', 'gather' ),
		'section'		=> 'archive',
		'type'			=> 'checkbox'
	) );

	// Post Settings
	$wp_customize->add_section( 'post' , array(
		'title' => __( 'Post', 'gather' ),
		'priority'   => 80,
	) );

	$wp_customize->add_setting( 'display-post-dates', array(
		'default'    =>  1,
		'transport'  =>  'refresh',
		'sanitize_callback' => 'gather_sanitize_checkbox'
	) );

	$wp_customize->add_control( 'display-post-dates', array(
		'label'   => __( 'Display Post Dates', 'gather' ),
		'section'		=> 'post',
		'type'			=> 'checkbox'
	) );

	$wp_customize->add_setting( 'post-featured-images', array(
		'default'    =>  1,
		'transport'  =>  'refresh',
		'sanitize_callback' => 'gather_sanitize_checkbox'
	) );

	$wp_customize->add_control( 'post-featured-images', array(
		'label'			=> __( 'Display Featured Images', 'gather' ),
		'section'		=> 'post',
		'type'			=> 'checkbox'
	) );

	// Footer Settings
	$wp_customize->add_section( 'footer' , array(
		'title'      => __( 'Footer Text', 'luminate' ),
		'priority'   => 100,
	) );

	$wp_customize->add_setting( 'footer-text', array(
		'default'           => gather_get_default_footer_text(),
		'sanitize_callback' => 'gather_sanitize_textarea'
	) );

	$wp_customize->add_control( 'footer-text', array(
		'label'   => __( 'Footer Text', 'gather' ),
		'section'  => 'footer',
		'type'     => 'textarea'
	) );

}
add_action( 'customize_register', 'gather_customize_controls' );

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function gather_customize_transports( $wp_customize ) {

	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

}
add_action( 'customize_register', 'gather_customize_transports' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function gather_customize_preview_js() {
	wp_enqueue_script(
		'gather_customizer',
		get_template_directory_uri() . '/js/customizer.js',
		array( 'customize-preview' ),
		'1.0.0',
		true
	);
}
add_action( 'customize_preview_init', 'gather_customize_preview_js' );

if ( ! function_exists( 'gather_select_settings' ) ) :
/**
 * Returns choices for various select boxes
 *
 * @since  1.0.0.
 *
 * @param  string	$id
 * @return array	$choices
 */
function gather_get_select_choices( $id ) {

	$choices = '';

	if ( 'standard-layout' == $id ) :
		$choices = array(
			'sidebar-right' => __( 'Sidebar Right', 'gather' ),
			'sidebar-left' => __( 'Sidebar Left', 'gather' )
		);
	endif;

	if ( 'archive-layout' == $id ) :
		$choices = array(
			'standard' => __( 'Standard Layout', 'gather' ),
			'column-masonry-2' => __( '2 Column Masonry', 'gather' ),
			'column-masonry-3' => __( '3 Column Masonry', 'gather' ),
			'column-masonry-4' => __( '4 Column Masonry', 'gather' )
		);
	endif;

	return $choices;

}
endif;

if ( ! function_exists( 'gather_sanitize_checkbox' ) ) :
/**
 * Sanitize a checkbox to only allow 0 or 1
 *
 * @since  1.0.0.
 *
 * @param  boolean    $value    The unsanitized value.
 * @return boolean				The sanitized boolean.
 */
function gather_sanitize_checkbox( $value ) {
	if ( $value == 1 ) {
		return 1;
    } else {
		return 0;
    }
}
endif;

if ( ! function_exists( 'gather_sanitize_textarea' ) ) :
/**
 * Sanitize textarea.
 *
 * @since  1.0.0.
 *
 * @param string $content
 * @return string
 */
function gather_sanitize_textarea( $content ) {

	if ( '' === $content ) {
		return '';
	}
	return wp_kses( $content, wp_kses_allowed_html( 'post' ) );

}
endif;

if ( ! function_exists( 'gather_sanitize_archive_layout' ) ) :
/**
 * Sanitization callback for standard layout select.
 *
 * @since Gather 1.0.0
 *
 * @param string $value Layout value.
 * @return string Layout value.
 */
function gather_sanitize_archive_layout( $value ) {
	$layouts = gather_get_select_choices( 'archive-layout' );

	if ( ! array_key_exists( $value, $layouts ) ) {
		$value = 'column-masonry-3';
	}

	return $value;
}
endif; // gather_sanitize_archive_layout

if ( ! function_exists( 'gather_sanitize_standard_layout' ) ) :
/**
 * Sanitization callback for standard layout select.
 *
 * @since Gather 1.0.0
 *
 * @param string $value Layout value.
 * @return string Layout value.
 */
function gather_sanitize_standard_layout( $value ) {
	$layouts = gather_get_select_choices( 'standard-layout' );

	if ( ! array_key_exists( $value, $layouts ) ) {
		$value = 'sidebar-right';
	}

	return $value;
}
endif; // gather_sanitize_standard_layout