<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package Gather
 */

/**
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
function gather_wp_title( $title, $sep ) {
	if ( is_feed() ) {
		return $title;
	}

	global $page, $paged;

	// If "Downloads" are set on home page, just display site name and tagline
	if ( get_theme_mod( 'front-page-downloads', 0 ) && is_front_page() ) {
		$title = '';
	}

	// Add the blog name
	$title .= get_bloginfo( 'name', 'display' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title .= " $sep $site_description";
	}

	// Add a page number if necessary:
	if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
		$title .= " $sep " . sprintf( __( 'Page %s', 'gather' ), max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', 'gather_wp_title', 10, 2 );

/**
 * Sets the authordata global when viewing an author archive.
 *
 * This provides backwards compatibility with
 * http://core.trac.wordpress.org/changeset/25574
 *
 * It removes the need to call the_post() and rewind_posts() in an author
 * template to print information about the author.
 *
 * @global WP_Query $wp_query WordPress Query object.
 * @return void
 */
function gather_setup_author() {
	global $wp_query;

	if ( $wp_query->is_author() && isset( $wp_query->post ) ) {
		$GLOBALS['authordata'] = get_userdata( $wp_query->post->post_author );
	}
}
add_action( 'wp', 'gather_setup_author' );

/**
 * Use a template for individual comment output
 *
 * @param object $comment Comment to display.
 * @param int    $depth   Depth of comment.
 * @param array  $args    An array of arguments.
 */
function gather_comment_callback( $comment, $args, $depth ) {
	include( locate_template( 'comment.php' ) );
}

/**
 * Add HTML5 placeholders for each default comment field
 *
 * @param array $fields
 * @return array $fields
 */
function gather_comment_fields( $fields ) {

    $commenter = wp_get_current_commenter();
    $req = get_option( 'require_name_email' );
    $aria_req = ( $req ? " aria-required='true'" : '' );

    $fields['author'] =
        '<p class="comment-form-author">
        	<label for="author">' . __( 'Name', 'gather' ) . '</label>
            <input required minlength="3" maxlength="30" placeholder="' . __( 'Name *', 'gather' ) . '" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
    '" size="30"' . $aria_req . ' />
        </p>';

    $fields['email'] =
        '<p class="comment-form-email">
        	<label for="email">' . __( 'Email', 'gather' ) . '</label>
            <input required placeholder="' . __( 'Email *', 'gather' ) . '" id="email" name="email" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) .
    '" size="30"' . $aria_req . ' />
        </p>';

    $fields['url'] =
        '<p class="comment-form-url">
        	<label for="url">' . __( 'Website', 'gather' ) . '</label>
            <input placeholder="' . __( 'Website', 'gather' ) . '" id="url" name="url" type="url" value="' . esc_attr( $commenter['comment_author_url'] ) .
    '" size="30" />
        </p>';

    return $fields;
}
add_filter( 'comment_form_default_fields', 'gather_comment_fields' );

/**
 * Add HTML5 placeholder to the comment textarea.
 *
 * @param string $comment_field
 * @return string $comment_field
 */
 function gather_commtent_textarea( $comment_field ) {

    $comment_field =
        '<p class="comment-form-comment">
            <textarea required placeholder="' . __( 'Comment *', 'gather' ) . '" id="comment" name="comment" cols="45" rows="6" aria-required="true"></textarea>
        </p>';

    return $comment_field;
}
add_filter( 'comment_form_field_comment', 'gather_commtent_textarea' );

/**
 * Returns class to be used for footer
 *
 * @return string footer class
 */
function gather_footer_class() {

	$count = gather_count_widgets( 'footer' );

	// If there's two widgets or less
	if ( $count <= 2) {
		return 'columns-' . $count;
	}

	// Otherwise we'll have 3 columns
	return 'columns-3';

}

/**
 * Counts number of widgets in a sidebar
 *
 * @param string $sidebar_id
 * @return int $widget_count
 */
function gather_count_widgets( $sidebar_id ) {

	// If loading from front page, consult $_wp_sidebars_widgets rather than options
	// to see if wp_convert_widget_settings() has made manipulations in memory.
	global $_wp_sidebars_widgets;
	if ( empty( $_wp_sidebars_widgets ) ) :
		$_wp_sidebars_widgets = get_option( 'sidebars_widgets', array() );
	endif;

	$sidebars_widgets_count = $_wp_sidebars_widgets;

	if ( isset( $sidebars_widgets_count[ $sidebar_id ] ) ) :
		$widget_count = count( $sidebars_widgets_count[ $sidebar_id ] );
		return $widget_count;
	endif;

}

/**
 * Get menu name by location
 *
 * @param string $location
 * @return object $menu_obj
 */
function gather_get_menu_name( $location ) {

    $locations = get_nav_menu_locations();
    $menu_obj = get_term( $locations[$location], 'nav_menu' );

    return $menu_obj->name;
}

/**
 * Determine which template part to load
 *
 * @return string template part
 */
function gather_template_part() {
	$template = '';
	$type = get_post_type();
	if ( gather_load_masonry() ) {
		$template = 'masonry';
	}
	if ( 'download' == $type && gather_load_masonry() ) {
		$template = 'masonry-download';
	}
	return $template;
}

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 */
function gather_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => '#posts-wrap',
		'footer'    => false,
		'footer_widgets' => 'footer',
		'render' => 'gather_infinite_scroll_render'
	) );
}
add_action( 'after_setup_theme', 'gather_jetpack_setup' );

/**
 * Used by JetPack to render the correct template part
 */
function gather_infinite_scroll_render() {
	while( have_posts() ) {
	    the_post();
	    get_template_part( 'content', gather_template_part() );
	}
}