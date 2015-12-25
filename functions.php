<?php
/**
 * Gather functions and definitions
 *
 * @package Gather
 */

/**
 * The current version of the theme.
 */
define( 'GATHER_VERSION', '1.1.0' );

if ( ! function_exists( 'gather_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function gather_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Gather, use a find and replace
	 * to change 'gather' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'gather', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	// Registers navigation menus
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'gather' ),
		'secondary' => esc_html__( 'Secondary Menu', 'gather' ),
		'social' => esc_html__( 'Social Menu', 'gather' )
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-form', 'gallery', 'caption'
	) );

	// Post editor styles
	add_editor_style( 'editor-style.css' );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'gather_custom_background_args', array(
		'default-color' => 'f2f2f2',
		'default-image' => '',
	) ) );

	add_theme_support( 'custom-header', array(
		'default-text-color'     => 'ffffff',
		'width'                  => 1280,
		'height'                 => 180,
		'flex-height'            => false
	) );

}
endif; // gather_setup
add_action( 'after_setup_theme', 'gather_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function gather_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'gather_content_width', 664 );
}
add_action( 'after_setup_theme', 'gather_content_width', 0 );

if ( ! function_exists( 'gather_register_image_sizes' ) ) :
/*
 * Enables support for Post Thumbnails on posts and pages.
 *
 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
 */
function gather_register_image_sizes() {

	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 720, 1200 );
	add_image_size( 'gather-archive', 560, 999 );

}
add_action( 'after_setup_theme', 'gather_register_image_sizes' );
endif;

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function gather_widgets_init() {

	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'gather' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget module %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer', 'gather' ),
		'id'            => 'footer',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );


}
add_action( 'widgets_init', 'gather_widgets_init' );

if ( ! function_exists( 'gather_body_fonts' ) ) :
/**
 * Enqueue web fonts.
 */
function gather_body_fonts() {

	// Google font URL to load
	$font_url = '';

    /* Translators: If there are characters in your language that are not
    * supported by Roboto, translate this to 'off'. Do not translate
    * into your own language.
    */
    $accent = _x( 'active', 'Monoton font: active or inactive', 'gather' );
    $primary = _x( 'active', 'Roboto font: active or inactive', 'gather' );
    $secondary = _x( 'active', 'Merriweather font: active or inactive', 'gather' );

    if ( 'active' == $accent || 'active' == $primary || 'active' == $secondary ) :

        $font_families = array();

        if ( 'inactive' !== $accent ) {
            $font_families[] = 'Monoton';
        }

        if ( 'inactive' !== $primary ) {
            $font_families[] = 'Roboto:400italic,700italic,700,400';
        }

		if ( 'inactive' !== $secondary ) {
            $font_families[] = 'Merriweather:400,400italic,700,700italic';
        }

        $query_args = array(
            'family' => urlencode( implode( '|', $font_families ) ),
            'subset' => urlencode( 'latin,latin-ext' ),
        );

        $font_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );

        // Load Google Fonts
		wp_enqueue_style( 'gather-body-fonts', $font_url, array(), null, 'screen' );

    endif;

}
add_action( 'wp_enqueue_scripts', 'gather_body_fonts' );
endif;

/**
 * Enqueue icon font.
 */
function gather_icon_font() {

	// Icon Font
	wp_enqueue_style(
		'gather-icons',
		get_template_directory_uri() . '/fonts/gather-icons.css',
		array(), '0.4.0'
	);

}
add_action( 'wp_enqueue_scripts', 'gather_icon_font' );

/**
 * Enqueue scripts and styles.
 */
function gather_scripts() {

	wp_enqueue_style(
		'gather-style',
		get_stylesheet_uri(),
		array(),
		GATHER_VERSION
	);

	// Use style-rtl.css for RTL layouts
	wp_style_add_data(
		'gather-style',
		'rtl',
		'replace'
	);

	wp_enqueue_script(
		'gather-skip-link-focus-fix',
		get_template_directory_uri() . '/js/skip-link-focus-fix.js',
		array(),
		GATHER_VERSION,
		true
	);

	wp_enqueue_script(
		'gather-global',
		get_template_directory_uri() . '/js/theme.js',
		array( 'jquery' ),
		GATHER_VERSION,
		true
	);

	if ( gather_load_masonry() ) {
		 wp_enqueue_script( 'masonry' );
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'gather_scripts' );

// Custom template tags for this theme.
require get_template_directory() . '/inc/template-tags.php';

// Custom functions that act independently of the theme templates.
require get_template_directory() . '/inc/extras.php';

// Define options for the theme customizer.
require get_template_directory() . '/inc/customizer.php';

// Additional filters and actions based on theme customizer selections.
require get_template_directory() . '/inc/mods.php';

// Style options based on theme customizer selections.
require get_template_directory() . '/inc/styles.php';

// Load Jetpack compatibility file.
require get_template_directory() . '/inc/jetpack.php';