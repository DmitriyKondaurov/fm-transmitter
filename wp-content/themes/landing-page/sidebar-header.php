<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package underscores
 */

if ( ! is_active_sidebar( 'header_banner' ) ) {
	return;
}
?>
<div id="header_banner" class="call_to_action">
	<?php dynamic_sidebar( 'header_banner' ); ?>
</div>

