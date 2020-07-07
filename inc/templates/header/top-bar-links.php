<?php
/**
 * The template for displaying top bar links like search, shop cart & secondary menu
 */

$search_icon = true;
$cart_icon = true;

if ( class_exists( 'Redux' ) ) {
	$search_icon = codebean_option('topbar_search');
	$cart_icon = codebean_option('topbar_cart');
}

$menu = wp_nav_menu(
	array(
		'theme_location'    => 'top-bar-menu',
		'container'         => 'nav',
		'menu_class'        => 'top-menu',
		'echo'				=> false
	)
);

?>
<div class="top-bar-links">

    <?php if ( has_nav_menu('top-bar-menu') ) : ?>
        <div class="top-bar-secondary-menu">
	        <?php echo wp_kses_post($menu); ?>
        </div>
    <?php endif; ?>

	<?php if ( $search_icon ) : ?>
		<div class="top-bar-search">
			<a href="#" class="search-form-opener">
				<span class="search-icon">
                    <?php get_template_part('assets/images/search-icon.svg'); ?>
                </span>
				<span class="close-icon">
                    <?php get_template_part( 'assets/images/close-icon.svg'); ?>
                </span>
			</a>
		</div>
	<?php endif; ?>

    <?php if ( $cart_icon && function_exists('WC' ) ) : ?>
        <div class="top-bar-cart">
            <a href="<?php echo wc_get_cart_url(); ?>" class="mini-cart-opener">
                <span class="bag-icon">
                    <?php get_template_part( 'assets/images/shop-bag.svg' ); ?>
                </span>
	            <?php studiare_cart_count(); ?>
            </a>
            <div class="dropdown-cart">
		        <?php

		        // Insert cart widget placeholder - code in woocommerce.js will update this on page load
		        echo '<div class="widget woocommerce widget_shopping_cart"><div class="widget_shopping_cart_content"></div></div>';

		        ?>
            </div>
        </div>
    <?php endif; ?>

</div>
