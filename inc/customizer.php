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

	// Layout Settings
	$wp_customize->add_section( 'theme-options' , array(
		'title' => esc_html__( 'Theme Options', 'gather' ),
		'priority'   => 70,
	) );

	// Header Settings
	$wp_customize->add_setting( 'center-branding', array(
		'default'    =>  0,
		'transport'  =>  'refresh',
		'sanitize_callback' => 'gather_sanitize_checkbox'
	) );

	$wp_customize->add_control( 'center-branding', array(
		'label'   => esc_html__( 'Center Header Text/Logo', 'gather' ),
		'section'   => 'theme-options',
		'type'      => 'checkbox'
	) );

	$wp_customize->add_setting( 'header-background-color', array(
		'default'    =>  '#ffffff',
		'transport'  =>  'transport',
		'sanitize_callback' => 'sanitize_hex_color'
	) );

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
		$wp_customize,
			'header-background-color',
			array(
				'label'      => __( 'Header Background Color', 'gather' ),
				'section'    => 'theme-options',
			)
		)
	);

	// Layout Settings
	$wp_customize->add_setting( 'standard-layout', array(
		'transport'  =>  'refresh',
		'default' => 'sidebar-right',
		'sanitize_callback' => 'gather_sanitize_standard_layout'
	) );

	$wp_customize->add_control( 'standard-layout', array(
		'label'   => esc_html__( 'Standard Layout', 'gather' ),
		'section'   => 'theme-options',
		'type'      => 'select',
		'choices'	=> gather_get_select_choices( 'standard-layout' ),
		'description' => esc_html__( 'Sidebar will display if widgets are set.', 'gather' ),
	) );

	$wp_customize->add_setting( 'archive-layout', array(
		'default'    =>  1,
		'transport'  =>  'refresh',
		'default' => 'column-masonry-3',
		'sanitize_callback' => 'gather_sanitize_archive_layout'
	) );

	$wp_customize->add_control( 'archive-layout', array(
		'label'   => esc_html__( 'Archive Layout', 'gather' ),
		'section'   => 'theme-options',
		'type'      => 'select',
		'choices'	=> gather_get_select_choices( 'archive-layout' )
	) );

	$wp_customize->add_setting( 'archive-content', array(
		'default'    =>  'excerpts',
		'transport'  =>  'refresh',
		'sanitize_callback' => 'gather_sanitize_archive_content'
	) );

	$wp_customize->add_control( 'archive-content', array(
		'label'   => esc_html__( 'Archive Content', 'gather' ),
		'section'   => 'theme-options',
		'type'      => 'select',
		'choices'	=> gather_get_select_choices( 'archive-content' ),
		'description' => esc_html__( 'Choose to display full content or excerpts.', 'gather' ),
	) );

	$wp_customize->add_setting( 'archive-sidebar', array(
		'default'    =>  0,
		'transport'  =>  'refresh',
		'sanitize_callback' => 'gather_sanitize_checkbox'
	) );

	$wp_customize->add_control( 'archive-sidebar', array(
		'label'   => esc_html__( 'Display Sidebar on Archives', 'gather' ),
		'section'   => 'theme-options',
		'type'      => 'checkbox'
	) );

	// Remove "Header Text Color" option added by Custom Header
	$wp_customize->remove_control( 'header_textcolor' );

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
	$wp_customize->get_setting( 'header-background-color' )->transport  = 'postMessage';

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

	if ( 'archive-content' == $id ) :
		$choices = array(
			'excerpt' => esc_html__( 'Excerpts', 'gather' ),
			'content' => esc_html__( 'Content', 'gather' )
		);
	endif;

	if ( 'standard-layout' == $id ) :
		$choices = array(
			'sidebar-right' => esc_html__( 'Sidebar Right', 'gather' ),
			'sidebar-left' => esc_html__( 'Sidebar Left', 'gather' )
		);
	endif;

	if ( 'archive-layout' == $id ) :
		$choices = array(
			'standard' => esc_html__( 'Standard Layout', 'gather' ),
			'column-masonry-2' => esc_html__( '2 Column Masonry', 'gather' ),
			'column-masonry-3' => esc_html__( '3 Column Masonry', 'gather' ),
			'column-masonry-4' => esc_html__( '4 Column Masonry', 'gather' )
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
	if ( 1 == $value ) {
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

if ( ! function_exists( 'gather_sanitize_archive_content' ) ) :
/**
 * Sanitization callback for archive content.
 *
 * @since Gather 1.0.0
 *
 * @param string $value Archive content type.
 * @return string content type.
 */
function gather_sanitize_archive_content( $value ) {

	if ( 'content' == $value ) {
		return 'content';
	}
	return 'excerpt';

}
endif; // gather_sanitize_archive_content

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

if ( ! function_exists( 'sanitize_hex_color' ) ) :
/**
 * Sanitizes a hex color.
 *
 * Returns either '', a 3 or 6 digit hex color (with #), or null.
 * For sanitizing values without a #, see sanitize_hex_color_no_hash().
 *
 * @since 3.4.0
 *
 * @param string $color
 * @return string|null
 */
function sanitize_hex_color( $color ) {
	if ( '' === $color )
		return '';
	// 3 or 6 hex digits, or the empty string.
	if ( preg_match('|^#([A-Fa-f0-9]{3}){1,2}$|', $color ) )
		return $color;
	return null;
}
endif;