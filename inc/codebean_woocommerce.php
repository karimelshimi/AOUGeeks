<?php
/**
 * Codebean WooCommerce functions, actons and filters
 */

// Remove Woo Styles
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

// Remove result count and catalog ordering
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

// Remove Cross-Sells from the shopping cart page
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display');

// Change out of stock text
add_filter( 'woocommerce_get_availability', 'studiare_custom_get_availability', 1, 2);

// Our hooked in function $availablity is passed via the filter!
function studiare_custom_get_availability( $availability, $_product ) {
	if ( !$_product->is_in_stock() ) $availability['availability'] = esc_html__('No available seats', 'studiare');
	return $availability;
}

//Change the breadcrumb separator
add_filter( 'woocommerce_breadcrumb_defaults', 'jk_change_breadcrumb_delimiter' );
function jk_change_breadcrumb_delimiter( $defaults ) {
	// Change the breadcrumb delimeter from '/' to '>'
	$defaults['delimiter'] = '<i class="fa fa-angle-right"></i>';
	return $defaults;
}

// Remove breadcrumb before content add it on page title
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );

// Remove tabs & upsell display
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );

// Remove functions before single product summary
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );

// Remove thumbnails from product single
remove_action( 'woocommerce_product_thumbnails', 'woocommerce_show_product_thumbnails', 20 );


/**
 * Get Teachers List and Return it as array
 */
if ( ! function_exists( 'studiare_get_teachers_list' ) ) {
	function studiare_get_teachers_list() {

		$teachers = array(
			'no-teacher' => esc_html__( 'Choose a Teacher', 'studiare' ),
		);

		$teachers_args = array(
			'post_type'     => 'teacher',
			'post_status'   => 'publish',
			'posts_per_page'=> -1,
		);

		// Makes a query for the teacher post type
		$teachers_query = new WP_Query( $teachers_args );

		// Adds every teacher to the $teachers array
		foreach( $teachers_query->posts as $teacher ){
			$teachers[$teacher->ID] = $teacher->post_title;
		}

		// Return these teachers
		return $teachers;
	}
}

/**
 * Shop products per page
 */
function studiare_shop_products_per_page() {

	$shop_per_page = '12';

	if ( class_exists('Redux') ) {
		$shop_per_page = codebean_option('shop_per_page');
	}

	$per_page = 12;
	$number = apply_filters('studiare_shop_per_page', $shop_per_page );
	if( is_numeric( $number )  &&  $number > 0) {
		$per_page = $number;
	}

	return $per_page;
}

add_filter( 'loop_shop_per_page', 'studiare_shop_products_per_page', 20 );


if( ! function_exists( 'studiare_cart_data' ) ) {
	add_filter('woocommerce_add_to_cart_fragments', 'studiare_cart_data', 30);
	function studiare_cart_data( $array ) {
		ob_start();
		studiare_cart_count();
		$count = ob_get_clean();

		ob_start();
		studiare_cart_subtotal();
		$subtotal = ob_get_clean();

		$array['span.studiare-cart-number'] = $count;
		$array['span.studiare-cart-subtotal'] = $subtotal;

		return $array;
	}
}

if( ! function_exists( 'studiare_cart_count' ) ) {
	function studiare_cart_count() {
		$count = WC()->cart->cart_contents_count;
		?>
		<span class="studiare-cart-number"><?php echo esc_html($count); ?></span>
		<?php
	}
}

if( ! function_exists( 'studiare_cart_subtotal' ) ) {
	function studiare_cart_subtotal() {
		?>
		<span class="studiare-cart-subtotal"><?php echo WC()->cart->get_cart_subtotal(); ?></span>
		<?php
	}
}

/**
 * Remove sidebar from single product
 */
function remove_sidebar_shop() {
	if ( is_singular('product') ) {
		remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar');
	}
}
add_action('template_redirect', 'remove_sidebar_shop');

/**
 * Render custom price html
 */
function studiare_custom_get_price_html( $price, $product ) {
	if ( $product->get_price() == 0 ) {
		if ( $product->is_on_sale() && $product->get_regular_price() ) {
			$regular_price = wc_get_price_to_display( $product, array( 'qty' => 1, 'price' => $product->get_regular_price() ) );

			$price = wc_format_price_range( $regular_price, esc_html__( 'Free!', 'studiare' ) );
		} else {
			$price = '<span class="amount">' . esc_html__( 'Free!', 'studiare' ) . '</span>';
		}
	}

	return $price;
}

add_filter( 'woocommerce_get_price_html', 'studiare_custom_get_price_html', 10, 2 );



/**
 * Cart Page markup
 */
add_action( 'woocommerce_before_cart', function() {
	echo '<div class="cart-page-inner row">';
}, 1);

add_action( 'woocommerce_after_cart', function() {
	echo '</div><!--.cart-totals-inner-->';
}, 200);

/**
 * Custom Excerpt for Products
 */
function studiare_product_custom_excerpt_length( $length ) {
	global $post;
	if ($post->post_type == 'product') {
		return 20;
	}
}

/**
 * Cart Mobile Menu Item
 */
function studiare_get_menu_item_cart() {
    $show_cart_item = true;

	if ( class_exists( 'Redux' ) ) {
		$show_cart_item = codebean_option('off_canvas_cart');
	}

	if ( ! $show_cart_item || ! function_exists( 'WC' ) ) {
		return;
	}

	$cart_items = WC()->cart->get_cart_contents_count();

	?>
    <div class="off-canvas-cart">
        <a href="<?php echo wc_get_cart_url(); ?>" class="cart-icon-link">
            <span class="bag-icon"><?php get_template_part( 'assets/images/shop-bag.svg' ); ?></span>
            <span class="cart-text"><?php esc_html_e( 'Cart', 'studiare' ); ?></span>
            <?php studiare_cart_count(); ?>
        </a>
    </div>
    <?php
}

/**
 * ------------------------------------------------------------------------------------------------
 * Determine is it product attribute archieve page
 * ------------------------------------------------------------------------------------------------
 */

if( ! function_exists( 'studiare_is_product_attribute_archieve' ) ) {
	function studiare_is_product_attribute_archieve() {
		$queried_object = get_queried_object();
		if( $queried_object && property_exists( $queried_object, 'taxonomy' ) ) {
			$taxonomy = $queried_object->taxonomy;
			return substr($taxonomy, 0, 3) == 'pa_';
		}
		return false;
	}
}

