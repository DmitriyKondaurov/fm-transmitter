<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package underscores
 */

if ( ! is_active_sidebar( 'call_to_action' ) ) {
	return;
}
?>
<div id="sidebar-modulator" class="call_to_action">
	<?php dynamic_sidebar( 'call_to_action' ); ?>
</div>

