<?php
/**
 * @package Gather
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'module'); ?>>

	<?php if ( has_post_thumbnail() ) { ?>
	<div class="entry-image-section">
		<a href="<?php the_permalink() ?>" class="entry-image-link">
			<figure class="entry-image">
				<?php the_post_thumbnail( 'gather-archive' ); ?>
			</figure>
		</a>
	</div>
	<?php } ?>

	<header class="entry-header">
		<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content clearfix">
		<?php if ( 'excerpt' == get_theme_mod( 'archive-content', 'excerpt' ) || has_excerpt() ) {
			the_excerpt();
		} else {
			the_content(
				wp_kses_post( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'gather' ) )
			);
		} ?>
	<?php
		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'gather' ),
			'after'  => '</div>',
		) );
	?>
	</div><!-- .entry-content -->

	<footer class="entry-meta entry-footer-meta">
		<span class="more-link"><a href="<?php the_permalink(); ?>"><?php esc_html_e( 'View More', 'gather' ); ?></a></span>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->