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

	// Navigation Styles
	$section = 'navigation-styles';

	$sections[] = array(
		'id' => $section,
		'title' => __( 'Navigation Styles', 'gather' ),
		'priority' => '30'
	);

	if ( has_nav_menu( 'primary' ) ):
		$options['primary-menu-search'] = array(
			'id' => $menu . '-menu-search',
			'label'   => sprintf( __( 'Search Box (%s)', 'gather' ), $label ),
			'section' => $section,
			'type'    => 'checkbox',
			'default' => 0,
		);
	endif;

	if ( has_nav_menu( 'secondary' ) ):
		$options['secondary-menu-search'] = array(
			'id' => $menu . '-menu-search',
			'label'   => sprintf( __( 'Search Box (%s)', 'gather' ), $label ),
			'section' => $section,
			'type'    => 'checkbox',
			'default' => 0,
		);
	endif;

	// Colors
	$section = 'colors';

	$sections[] = array(
		'id' => $section,
		'title' => __( 'Colors', 'gather' ),
		'priority' => '80'
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
		'default' => 1
	);

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