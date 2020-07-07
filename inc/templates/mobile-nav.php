<?php
/**
 * Template file for mobile navigation
 */

$off_canvas_footer = '';
$off_canvas_cart = true;
$off_canvas_search = true;

if ( class_exists('Redux' ) ) {
    $off_canvas_footer = codebean_option('off_canvas_footer');
    $off_canvas_cart = codebean_option('off_canvas_cart');
    $off_canvas_search = codebean_option('off_canvas_search');
}

$nav_id = 'main-menu';

if(has_nav_menu('mobile-menu')) {
	$nav_id = 'mobile-menu';
}

$menu = wp_nav_menu(
	array(
		'theme_location'    => $nav_id,
		'container'         => 'nav',
		'menu_class'        => 'mobile-menu',
		'echo'				=> false
	)
);

?>
<div class="off-canvas-navigation">

    <?php if ( $off_canvas_search ) : ?>
        <div class="search-form-wrapper">
            <?php get_search_form(); ?>
        </div>
    <?php endif; ?>

	<?php studiare_get_menu_item_cart(); ?>

	<div class="off-canvas-main">
		<?php echo wp_kses_post($menu); ?>
	</div>

	<?php if ( $off_canvas_footer != '' ) : ?>
        <footer class="off-canvas-footer">
            <?php echo do_shortcode( $off_canvas_footer ); ?>
        </footer>
    <?php endif; ?>
</div>

<div class="off-canvas-overlay"></div>