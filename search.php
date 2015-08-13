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

			<div id="posts-wrap" data-columns="<?php echo esc_attr( gather_get_columns() ); ?>">
			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', gather_template_part() ); ?>

			<?php endwhile; ?>
			</div>

			<?php gather_posts_navigation(); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->

	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>