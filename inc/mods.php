<?php
/**
 * Functions used to implement options
 *
 * @package Gather
 */

/**
 * Get default footer text
 *
 * @return string $text
 */
function gather_get_default_footer_text() {
	$text = sprintf(
		__( 'Powered by %s', 'gather' ),
		'<a href="' . esc_url( __( 'http://wordpress.org/', 'gather' ) ) . '">WordPress</a>'
	);
	$text .= '<span class="sep"> | </span>';
	$text .= sprintf(
		__( '%1$s by %2$s.', 'gather' ),
			'Gather Theme',
			'<a href="http://devpress.com/" rel="designer">DevPress</a>'
	);
	return $text;
}

/**
 * Adds custom classes to the array of body classes.
 *
 * @since Gather 0.1
 */
function gather_body_classes( $classes ) {

	global $post;

	if ( gather_load_masonry() ) {
		$classes[] = get_theme_mod( 'archive-layout', customizer_library_get_default( 'archive-layout' ) );
		$classes[] = 'masonry';
	}

	if ( gather_show_sidebar() ) {
		$classes[] = get_theme_mod( 'standard-layout', customizer_library_get_default( 'standard-layout' ) );
	} else {
		$classes[] = 'no-sidebar';
	}

	// Simplify body class for full-width template
	if ( isset( $post ) && ( is_page_template( 'templates/full-width.php' ) ) ) {
		foreach( $classes as $key => $value) {
			if ( $value == 'page-template-templatesfull-width-php') {
				$classes[$key] = 'page-template-full-width-php';
			}
		}
		$classes[] = 'full-width';
	}

	return $classes;
}
add_filter( 'body_class', 'gather_body_classes' );

/**
 * Conditional logic for displaying sidebar
 *
 * @since Gather 0.1
 */
 function gather_show_sidebar() {

	// Support for bbPress archives
 	if ( is_post_type_archive( 'forum' ) && is_active_sidebar( 'primary' ) ) {
 		return true;
	}

 	 // If an archive page is displayed and display sidebar on archives is checked
 	if ( !is_singular() && !is_404() && !get_theme_mod( 'archive-sidebar', '0' ) ) {
	 	return false;
 	}

 	// If there's no active sidebar widgets
 	if ( !is_active_sidebar( 'primary' ) ) {
	 	return false;
 	}

 	return true;
}

/**
 * Conditional logic for loading masonry script
 *
 * @since Gather 0.1
 */
 function gather_load_masonry() {

 	if ( !is_singular() && !is_404() ) {
	 	// Support for bbPress
	 	if ( is_post_type_archive( 'forum' ) ) {
		 	return false;
	 	}
 		$archive_layout = get_theme_mod( 'archive-layout', customizer_library_get_default( 'archive-layout' ) );
 		if ( $archive_layout != 'standard' ) {
 			return true;
 		}
 	}

 	return false;
 }

/**
 * Outputs the number of masonry columns as a data attribute
 *
 * @since Gather 0.1
 */
 function gather_get_columns() {
	 $layout = get_theme_mod( 'archive-layout', customizer_library_get_default( 'archive-layout' ) );
	 switch ( $layout ) {
	 	case '4-column-masonry':
	 		return '4';
	 	case '3-column-masonry':
	 		return '3';
	 	case '2-column-masonry':
	 		return '2';
	 	default:
	 		return '0';
	 }
 }

/**
 * Outputs search icon in menu based on customizer option
 *
 * @since Gather 0.1
 */
function gather_search_in_menu( $items, $args ) {

	if (
		( get_theme_mod( 'primary-menu-search', false ) && 'primary' == $args->theme_location ) ||
		( get_theme_mod( 'secondary-menu-search', false ) && 'secondary' == $args->theme_location )
	) :

		$selector = '#' . $args->theme_location . '-navigation .toggle-search';
	    $items .= '<li class="menu-item menu-search">';
	    $items .= '<a class="toggle-search-link" href="#search" data-toggle="' . $selector . '">';
	    $items .= '<span class="screen-reader-text">' . __( 'Search', 'gather' ) . '</span>';
	    $items .= '</a></li>';
	    $items .= '<div class="toggle-search">' . get_search_form( false ) . '</div>';

	endif;

    return $items;
}
add_filter( 'wp_nav_menu_items', 'gather_search_in_menu', 10, 2 );

/**
 * Append class "social" to specific off-site links
 *
 * @since Gather 0.1
 */
function gather_social_nav_class( $classes, $item ) {

    if ( 0 == $item->parent && 'custom' == $item->type) {

    	$url = parse_url( $item->url );

    	if ( !isset( $url['host'] ) ) {
	    	return $classes;
    	}

    	$base = str_replace( "www.", "", $url['host'] );

    	// @TODO Make this filterable
    	$social = array(
    		'behance.com',
    		'dribbble.com',
    		'facebook.com',
    		'flickr.com',
    		'github.com',
    		'linkedin.com',
    		'pinterest.com',
    		'plus.google.com',
    		'instagr.am',
    		'instagram.com',
    		'skype.com',
    		'soundcloud.com',
    		'spotify.com',
    		'twitter.com',
    		'vimeo.com'
    	);

    	// Tumblr needs special attention
    	if ( strpos( $base, 'tumblr' ) ) {
			$classes[] = 'social';
		}

    	if ( in_array( $base, $social ) ) {
	    	$classes[] = 'social';
    	}

    }

    return $classes;

}
add_filter( 'nav_menu_css_class', 'gather_social_nav_class', 10, 2 );

/**
 * Display favicon and apple-touch logo in the head
 *
 * @since Gather 0.1
 */
if ( ! function_exists( 'gather_display_favicons' ) ) :
function gather_display_favicons() {
	$logo_favicon = get_theme_mod( 'logo-favicon' );
	if ( ! empty( $logo_favicon ) ) : ?>
		<link rel="icon" href="<?php echo esc_url( $logo_favicon ); ?>" />
	<?php endif;

	$logo_apple_touch = get_theme_mod( 'logo-apple-touch' );
	if ( ! empty( $logo_apple_touch ) ) : ?>
		<link rel="apple-touch-icon" href="<?php echo esc_url( $logo_apple_touch ); ?>" />
	<?php endif;
}
endif;
add_action( 'wp_head', 'gather_display_favicons' );

/**
 * Loads the downloads post type archive as the front page.
 * Requires Easy Digital Downloads plugin to be installed.
 *
 * @since Gather 0.6
 */
function gather_downloads_front_page( $query ) {

	// Only load if Easy Digital Downloads is installed
	if ( ! class_exists( 'Easy_Digital_Downloads' ) ) {
		return;
	}

	// Only filter the main query on the front-end
    if ( is_admin() || ! $query->is_main_query() ) {
    	return;
    }

	// Only filter if the option is set
	if ( ! get_theme_mod( 'front-page-downloads', 0 ) ) {
		return;
	}

    global $wp;
    $front = false;

	// If the latest posts are showing on the home page
    if ( ( is_home() && empty( $wp->query_string ) ) ) {
    	$front = true;
    }

	// If a static page is set as the home page
    if ( ( $query->get( 'page_id' ) == get_option( 'page_on_front' ) && get_option( 'page_on_front' ) ) || empty( $wp->query_string ) ) {
    	$front = true;
    }

    if ( $front ) :

        $query->set( 'post_type', 'download' );
        $query->set( 'page_id', '' );

        // Set properties to match an archive
        $query->is_page = 0;
        $query->is_singular = 0;
        $query->is_post_type_archive = 1;
        $query->is_archive = 1;

    endif;

}
add_action( 'pre_get_posts', 'gather_downloads_front_page' );