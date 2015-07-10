<?php
/**
 * Search form template
 *
 * @package Gather
 */
?>

<form role="search" method="get" class="search-form clearfix" action="<?php echo home_url( '/' ); ?>">
	<label>
		<span class="screen-reader-text"><?php _e( 'Search for:', 'gather' ); ?></span>
		<input type="search" class="search-field" placeholder="<?php _e( 'Search...', 'gather' ); ?>" value="" name="s" title="<?php _e( 'Search for:', 'gather' ); ?>" />
	</label>
	<button type="submit" class="search-submit">
		<div class="gather-icon-search"></div><span class="screen-reader-text"><?php _e( 'Search...', 'gather' ); ?></span>
	</button>
</form>