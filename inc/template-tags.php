<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Gather
 */

if ( ! function_exists( 'gather_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 */
function gather_paging_nav() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	?>
	<nav class="navigation paging-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'gather' ); ?></h1>
		<div class="nav-links module">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'gather' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'gather' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'gather_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 */
function gather_post_nav() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation post-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'gather' ); ?></h1>
		<div class="nav-links">
			<?php
				previous_post_link( '<div class="nav-previous">%link</div>', _x( '<span class="meta-nav">&larr;</span> %title', 'Previous post link', 'gather' ) );
				next_post_link(     '<div class="nav-next">%link</div>',     _x( '%title <span class="meta-nav">&rarr;</span>', 'Next post link',     'gather' ) );
			?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'gather_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function gather_posted_on() {

	if ( get_theme_mod( 'display-post-dates', 1 ) ) :

		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() )
		);

		$posted_on = sprintf(
			_x( '%s', 'post date', 'gather' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		$byline = sprintf(
			_x( 'By %s', 'post author', 'gather' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span>';
		echo '<span class="byline"> ' . $byline . '</span>';

	endif;

}
endif;

if ( ! function_exists( 'gather_post_meta' ) ) :
/**
 * Prints post meta information for categories and tags.
 */
function gather_post_meta( $type = 'post' ) {

	/* translators: used between list items, there is a space after the comma */
	if ( 'download' == $type) {
		$category_list =  get_the_term_list( get_the_ID(), 'download_category', '', ', ', '' );
	} else {
		$category_list = get_the_category_list( __( ', ', 'gather' ) );
	}

	if ( $category_list ) {
		echo '<span class="category-meta meta-group">';
		echo '<span class="category-meta-list">' . $category_list . '</span>';
		echo '</span>';
	}

	/* translators: used between list items, there is a space after the comma */
	if ( 'download' == $type) {
		$tag_list =  get_the_term_list( get_the_ID(), 'download_tag', '', ', ', '' );
	} else {
		$tag_list = get_the_tag_list( '', __( ', ', 'gather' ) );
	}

	if ( $tag_list ) {
		echo '<span class="tag-meta meta-group">';
		echo '<span class="tag-meta-list">' . $tag_list . '</span>';
		echo '</span>';
	}

	edit_post_link( __( 'Edit', 'gather' ), '<span class="edit-meta meta-group"><span class="edit-link">', '</span></span></span>' );

}
endif;