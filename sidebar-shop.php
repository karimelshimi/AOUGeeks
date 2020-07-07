<?php
/**
 * The Sidebar containing the main widget areas.
 *
 */
if ( ! is_active_sidebar( 'sidebar_shop' ) ) {
	return;
}
?>

<div class="main-sidebar-holder">
	<div class="sidebar-widgets-wrapper">
		<?php if ( ! dynamic_sidebar( 'sidebar_shop' ) ) :
			dynamic_sidebar( 'sidebar_shop' );
		endif; ?>
	</div>
</div>
