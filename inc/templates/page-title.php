<?php

$prefix = '_studiare_';

$post_id = get_the_ID();
$is_shop        = false;
$is_product     = false;
$page_for_posts = get_option( 'page_for_posts' );

if ( is_home() || is_category() || is_search() || is_tag() || is_tax() ) {
	$post_id = $page_for_posts;
}

?>
<?php if ( ! get_post_meta( $post_id,  $prefix . 'disable_title', true ) || ! get_post_meta( $post_id, $prefix. 'disable_breadcrumbs', true ) ): ?>
    <div class="page-title">


        <div class="container">
            <?php if ( ! get_post_meta( $post_id, $prefix . 'disable_title', true ) ): ?>
                <?php if( studiare_page_title( false, esc_html__( 'News', 'studiare' ) ) ): ?>
                    <h1 class="h2"><?php echo studiare_page_title( false, esc_html__( 'News', 'studiare' ) ); ?></h1>
                <?php endif; ?>
            <?php endif; ?>

	        <?php
	        if ( ! get_post_meta( $post_id, $prefix . 'disable_breadcrumbs', true ) && ! studiare_is_shop_archive() ) {
		        studiare_breadcrumbs();
	        } else if ( studiare_is_shop_archive() ) {
	            woocommerce_breadcrumb();
            }
	        ?>
        </div>


    </div>
<?php endif; ?>