<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package Gather
 */
?>

<?php if ( gather_show_sidebar() ) : ?>

	<div id="secondary" class="secondary" role="complementary">
		<?php if ( ! dynamic_sidebar( 'primary' ) ) : ?>

		<?php endif; // end sidebar widget area ?>
	</div><!-- #secondary -->

<?php endif; ?>