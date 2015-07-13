<?php
/**
 * The template for displaying single posts.
 *
 * @package Gather
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<div class="module">
			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'single' ); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() ) :
						comments_template();
					endif;
				?>

				<?php the_post_navigation( array(
					'prev_text' => _x( '<span class="meta-nav">&larr;</span> %title', 'Previous post link', 'gather' ),
					'next_text' => _x( '%title <span class="meta-nav">&rarr;</span>', 'Next post link', 'gather' )
				) ); ?>

			<?php endwhile; // end of the loop. ?>
		</div>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>