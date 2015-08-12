<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package Gather
 */

get_header(); ?>

	<header class="page-header">
		<h1 class="page-title"><?php printf( esc_html__( 'Search results for: %s', 'gather' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
	</header><!-- .page-header -->

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<div id="posts-wrap" data-columns="<?php echo gather_get_columns(); ?>">
			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', gather_template_part() ); ?>

			<?php endwhile; ?>
			</div>

			<?php the_posts_navigation( array(
				'prev_text' => esc_html__( '<span class="meta-nav">&larr;</span> Older posts', 'gather' ),
				'next_text' => esc_html__( 'Newer posts <span class="meta-nav">&rarr;</span>', 'gather' )
			) ); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->

	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>