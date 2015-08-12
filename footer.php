<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Gather
 */
?>
		</div><!-- .col-width -->
	</div><!-- #content -->

</div><!-- #page -->

<?php if ( is_active_sidebar( 'footer' ) ) : ?>
<div class="footer-widgets <?php echo esc_attr( gather_footer_class() ); ?> clearfix">
	<div class="col-width">
		<?php dynamic_sidebar( 'footer' ); ?>
	</div>
</div><!-- .footer-widgets -->
<?php endif; ?>

<footer id="colophon" class="site-footer" role="contentinfo">
	<div class="col-width">
		<div class="site-info">
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', '_s' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'gather' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<?php printf( esc_html__( 'Theme: %1$s by %2$s.', 'gather' ), 'Gather', '<a href="https://devpress.com/" rel="designer">DevPress</a>' ); ?>
		</div><!-- .site-info -->
	</div><!-- .col-width -->
</footer><!-- #colophon -->

<?php wp_footer(); ?>

</body>
</html>
