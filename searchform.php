<?php
/**
 * Search form template
 *
 * @package Gather
 */
?>

<form role="search" method="get" class="search-form clearfix" action="<?php echo home_url( '/' ); ?>">
	<label>
		<span class="screen-reader-text"><?php esc_html_e( 'Search for:', 'gather' ); ?></span>
		<input type="search" class="search-field" placeholder="<?php esc_html_e( 'Search...', 'gather' ); ?>" value="" name="s" title="<?php esc_html_e( 'Search for:', 'gather' ); ?>" />
	</label>
	<button type="submit" class="search-submit">
		<div class="gather-icon-search"></div><span class="screen-reader-text"><?php esc_html_e( 'Search...', 'gather' ); ?></span>
	</button>
</form>