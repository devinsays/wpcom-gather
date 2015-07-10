<?php
/**
 * Theme Customizer
 *
 * @package Gather
 */

/**
 * Gather Options
 *
 * @since  1.0.0
 *
 * @return array $options
 */
function gather_options() {

	// Theme defaults
	$primary_color = '#5bc08c';
	$secondary_color = '#f99868';

	// Stores all the controls that will be added
	$options = array();

	// Stores all the sections to be added
	$sections = array();

	// Header section
	$section = 'title_tagline';

	$options['center-branding'] = array(
		'id' => 'center-branding',
		'label'   => __( 'Center Header Text/Logo', 'gather' ),
		'section' => $section,
		'type'    => 'checkbox',
		'default' => 0,
		'priority' => 20,
	);

	$options['header-background-color'] = array(
		'id' => 'header-background-color',
		'label'   => __( 'Header Background Color', 'gather' ),
		'section' => $section,
		'type'    => 'color',
		'default' => '#ffffff',
		'priority' => 30,
	);

	$options['header-background-image'] = array(
		'id' => 'header-background-image',
		'label'   => __( 'Header Background Image', 'gather' ),
		'section' => $section,
		'type'    => 'upload',
		'default' => '',
		'priority' => 40,
	);

	$choices = array(
		'image-scale' => 'Image Scale',
		'image-repeat' => 'Image Repeat'
	);

	$options['header-background-image-style'] = array(
		'id' => 'header-background-image-style',
		'label'   => __( 'Background Image Style', 'gather' ),
		'section' => $section,
		'type'    => 'select',
		'choices' => $choices,
		'default' => 'image-scale',
		'priority' => 50,
	);

	// Logo
	$section = 'logo';

	$sections[] = array(
		'id' => $section,
		'title' => __( 'Logo', 'gather' ),
		'priority' => '20'
	);

	$options['logo'] = array(
		'id' => 'logo',
		'label'   => __( 'Logo', 'gather' ),
		'section' => $section,
		'type'    => 'upload',
		'default' => '',
	);

	$options['logo-favicon'] = array(
		'id' => 'logo-favicon',
		'label'   => __( 'Favicon', 'gather' ),
		'section' => $section,
		'type'    => 'upload',
		'default' => '',
		'description'  => __( 'File must be <strong>.png</strong> format. Optimal dimensions: <strong>32px x 32px</strong>.', 'gather' ),
	);

	$options['logo-apple-touch'] = array(
		'id' => 'logo-apple-touch',
		'label'   => __( 'Apple Touch Icon', 'gather' ),
		'section' => $section,
		'type'    => 'upload',
		'default' => '',
		'description'  => __( 'File must be <strong>.png</strong> format. Optimal dimensions: <strong>152px x 152px</strong>.', 'gather' ),
	);

	// Navigation Styles
	$section = 'navigation-styles';

	$sections[] = array(
		'id' => $section,
		'title' => __( 'Navigation Styles', 'gather' ),
		'priority' => '30'
	);

	$menus = array(
		'primary',
		'secondary'
	);

	foreach ( $menus as $menu ) {

		if ( has_nav_menu( $menu ) ) :

			if ( $menu == 'primary' ) {
				$label = __( 'Primary Menu', 'gather' );
			}

			if ( $menu == 'secondary' ) {
				$label = __( 'Secondary Menu', 'gather' );
			}

			$options[$menu . '-menu-background'] = array(
				'id' => $menu . '-menu-background',
				'label'   => __( sprintf( 'Background (%s)', $label ), 'gather' ),
				'section' => $section,
				'type'    => 'color',
				'default' => $primary_color,
			);

			$mod = get_theme_mod( $menu . '-menu-background', $primary_color );
			$color = sanitize_hex_color( $mod );

			// 5% lighter
			$color_obj = new Jetpack_Color( $color );
			$lighten5 = $color_obj->lighten(5)->toHex();

			// 20% lighter
			$color_obj = new Jetpack_Color( $color );
			$lighten20 = $color_obj->lighten(20)->toHex();

			// Contrasting text
			$color_obj = new Jetpack_Color( $color );
			$contrast = $color_obj->getGrayscaleContrastingColor()->lighten(40)->toHex();

			$options[$menu . '-menu-background-hover'] = array(
				'id' => $menu . '-menu-background-hover',
				'label'   => sprintf( __( 'Background Hover (%s)', 'gather' ), $label ),
				'section' => $section,
				'type'    => 'color',
				'default' => $lighten5,
			);

			$options[$menu . '-menu-color'] = array(
				'id' => $menu . '-menu-color',
				'label'   => sprintf( __( 'Text (%s)', 'gather' ), $label ),
				'section' => $section,
				'type'    => 'color',
				'default' => $contrast,
			);

			$options[$menu . '-menu-border'] = array(
				'id' => $menu . '-menu-border',
				'label'   => sprintf( __( 'Border (%s)', 'gather' ), $label ),
				'section' => $section,
				'type'    => 'color',
				'default' => $lighten20,
			);

			$options[$menu . '-menu-search'] = array(
				'id' => $menu . '-menu-search',
				'label'   => sprintf( __( 'Search Box (%s)', 'gather' ), $label ),
				'section' => $section,
				'type'    => 'checkbox',
				'default' => 0,
			);

		endif;

	}

	// Colors
	$section = 'colors';

	$sections[] = array(
		'id' => $section,
		'title' => __( 'Colors', 'gather' ),
		'priority' => '80'
	);

	$options['primary-color'] = array(
		'id' => 'primary-color',
		'label'   => __( 'Primary Color', 'gather' ),
		'section' => $section,
		'type'    => 'color',
		'default' => $primary_color,
	);

	$options['secondary-color'] = array(
		'id' => 'secondary-color',
		'label'   => __( 'Secondary Color', 'gather' ),
		'section' => $section,
		'type'    => 'color',
		'default' => $secondary_color,
	);

	$options['site-title-color'] = array(
		'id' => 'site-title-color',
		'label'   => __( 'Site Title Color', 'gather' ),
		'section' => $section,
		'type'    => 'color',
		'default' => $primary_color,
	);

	$options['site-title-hover-color'] = array(
		'id' => 'site-title-hover-color',
		'label'   => __( 'Site Title Hover Color', 'gather' ),
		'section' => $section,
		'type'    => 'color',
		'default' => $secondary_color,
	);

	$options['site-tagline-color'] = array(
		'id' => 'site-tagline-color',
		'label'   => __( 'Site Tagline Color', 'gather' ),
		'section' => $section,
		'type'    => 'color',
		'default' => $primary_color,
	);

	// Layout
	$section = 'layout';

	$sections[] = array(
		'id' => $section,
		'title' => __( 'Layout', 'gather' ),
		'priority' => '70'
	);

	$choices = array(
		'sidebar-right' => 'Sidebar Right',
		'sidebar-left' => 'Sidebar Left',
	);

	$options['standard-layout'] = array(
		'id' => 'standard-layout',
		'label'   => __( 'Standard Layout', 'gather' ),
		'section' => $section,
		'type'    => 'select',
		'choices' => $choices,
		'default' => 'sidebar-right'
	);

	$choices = array(
		'standard' => 'Standard Layout',
		'column-masonry-2' => '2 Column Masonry',
		'column-masonry-3' => '3 Column Masonry',
		'column-masonry-4' => '4 Column Masonry',
	);

	$options['archive-layout'] = array(
		'id' => 'archive-layout',
		'label'   => __( 'Archive Layout', 'gather' ),
		'section' => $section,
		'type'    => 'select',
		'choices' => $choices,
		'default' => 'column-masonry-3'
	);

	$options['archive-sidebar'] = array(
		'id' => 'archive-sidebar',
		'label'   => __( 'Display Sidebar on Archives', 'gather' ),
		'section' => $section,
		'type'    => 'checkbox',
		'default' => 0,
	);

	// Typography
	$section = 'typography';

	$sections[] = array(
		'id' => $section,
		'title' => __( 'Typography', 'gather' ),
		'priority' => '75'
	);

	$options['site-title-font'] = array(
		'id' => 'site-title-font',
		'label'   => __( 'Site Title Font', 'gather' ),
		'section' => $section,
		'type'    => 'select',
		'choices' => customizer_library_get_font_choices(),
		'default' => 'Monoton'
	);

	$options['primary-font'] = array(
		'id' => 'primary-font',
		'label'   => __( 'Primary Font', 'gather' ),
		'section' => $section,
		'type'    => 'select',
		'choices' => customizer_library_get_font_choices(),
		'default' => 'Roboto'
	);

	$options['secondary-font'] = array(
		'id' => 'secondary-font',
		'label'   => __( 'Secondary Font', 'gather' ),
		'section' => $section,
		'type'    => 'select',
		'choices' => customizer_library_get_font_choices(),
		'default' => 'Merriweather'
	);

	// Archive Settings
	$section = 'archive';

	$sections[] = array(
		'id' => $section,
		'title' => __( 'Archive', 'gather' ),
		'priority' => '80'
	);

	$options['archive-excerpts'] = array(
		'id' => 'archive-excerpts',
		'label'   => __( 'Display Excerpts', 'gather' ),
		'description'   => __( 'Always display excerpts instead of full content.', 'gather' ),
		'section' => $section,
		'type'    => 'checkbox',
		'default' => 0,
	);

	$options['archive-featured-images'] = array(
		'id' => 'archive-featured-images',
		'label'   => __( 'Display Featured Images', 'gather' ),
		'section' => $section,
		'type'    => 'checkbox',
		'default' => 1,
	);

	// Post Settings
	$section = 'post';

	$sections[] = array(
		'id' => $section,
		'title' => __( 'Post', 'gather' ),
		'priority' => '80'
	);

	$options['display-post-dates'] = array(
		'id' => 'display-post-dates',
		'label'   => __( 'Display Post Dates', 'gather' ),
		'section' => $section,
		'type'    => 'checkbox',
		'default' => 1,
	);

	$options['post-featured-images'] = array(
		'id' => 'post-featured-images',
		'label'   => __( 'Display Featured Images', 'gather' ),
		'section' => $section,
		'type'    => 'checkbox',
		'default' => 1,
	);

	// Easy Digital Downloads
	if ( class_exists( 'Easy_Digital_Downloads' ) ) :

		// EDD Settings
		$section = 'easy-digital-downloads';

		$sections[] = array(
			'id' => $section,
			'title' => __( 'Easy Digital Downloads', 'gather' ),
			'priority' => '90'
		);

		$options['front-page-downloads'] = array(
			'id' => 'front-page-downloads',
			'label'   => __( 'Display Downloads on Front Page', 'gather' ),
			'section' => $section,
			'type'    => 'checkbox',
			'default' => 0
		);

	endif;

	// Footer Settings
	$section = 'footer';

	$sections[] = array(
		'id' => $section,
		'title' => __( 'Footer', 'gather' ),
		'priority' => '100'
	);

	$options['footer-text'] = array(
		'id' => 'footer-text',
		'label'   => __( 'Footer Text', 'gather' ),
		'section' => $section,
		'type'    => 'textarea',
		'default' => gather_get_default_footer_text(),
	);

	// Adds the sections to the $options array
	$options['sections'] = $sections;

	$customizer_library = Customizer_Library::Instance();
	$customizer_library->add_options( $options );

}
add_action( 'init', 'gather_options', 100 );

/**
 * Alters some of the defaults for the theme customizer
 *
 * @since  1.0.0.
 *
 * @param  object $wp_customize The global customizer object.
 * @return void
 */
function gather_customizer_defaults( $wp_customize ) {

	$wp_customize->get_section( 'title_tagline' )->title = 'Header';

}
add_action( 'customize_register', 'gather_customizer_defaults', 100 );