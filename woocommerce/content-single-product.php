<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;
/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked wc_print_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}

$rating_enabled = get_option('woocommerce_enable_review_rating');

// Custom Meta
$prefix = '_studiare_';
$teacher_id = get_post_meta( get_the_ID(), $prefix . 'course_teacher', true );
$stock = get_post_meta( get_the_ID(), '_stock', true );
?>
<div id="product-<?php the_ID(); ?>" <?php post_class(); ?>>

    <div class="row">

        <div class="product-single-main">

            <!-- Product Top Part-->
            <div class="product-single-top-part">

                <div class="product-info-before-gallery">

                    <?php if ( !empty( $teacher_id ) && $teacher_id != 'no-teacher' ) : ?>
                        <div class="course-author before-gallery-unit">
                            <div class="icon">
                                <i class="material-icons">account_box</i>
                            </div>
                            <div class="info">
                                <span class="label"><?php esc_html_e( 'Teacher', 'studiare' ); ?></span>
                                <div class="value"><a href="<?php echo get_permalink( $teacher_id ); ?>"><?php echo esc_attr( get_the_title( $teacher_id ) ); ?></a></div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php $product_cats = get_the_terms( get_the_id(), 'product_cat');  ?>

                    <?php if ( !empty( $product_cats ) ) : ?>
                        <div class="course-category before-gallery-unit">
                            <div class="icon">
                                <i class="material-icons">bookmark_border</i>
                            </div>
                            <div class="info">
                                <span class="label"><?php esc_html_e( 'Category', 'studiare' ); ?></span>
                                <div class="value">
                                    <?php foreach($product_cats as $product_cat): ?>
                                        <a href="<?php echo get_term_link($product_cat); ?>"><?php echo($product_cat->name.'<span>/</span>'); ?></a>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

	                <?php $comments_num = get_comments_number(get_the_id()); ?>
                    <?php if ( $comments_num ) : ?>
                        <div class="course-rating before-gallery-unit">
                            <?php woocommerce_template_loop_rating(); ?>
                        </div>
                    <?php endif; ?>

                </div>

                <!-- Product Gallery -->
                <div class="course-single-gallery">
                    <?php do_action( 'woocommerce_before_single_product_summary' ); ?>
                </div>

            </div>

            <div class="product-single-meta-inside">
                <?php wc_get_template_part( 'content', 'single-product-meta-side' ); ?>
            </div>

            <div class="product-single-content">
                <?php the_content(); ?>
            </div>

            <!-- Product Review -->
            <div class="product-reviews">

                <div class="product-review-title">
                    <h3 class="inner"><i class="material-icons">chat_bubble_outline</i><?php esc_html_e( 'Reviews', 'studiare' ); ?></h3>
                </div>

                <div class="product-reviews-inner">
                <?php
                    if($rating_enabled == 'yes'):
                        $product = wc_get_product(get_the_id());
                        $rating_count = $product->get_rating_count();
                        $average      = $product->get_average_rating();
                        $average = round($average, 1); ?>
                        <div class="product-reviews-stats">
                            <!-- Averate Rating -->
                            <div class="average-rating">
                                <p class="rating-subtitle"><?php esc_html_e('Average Rating', 'studiare');?></p>
                                <div class="avareage-rating-inner">
                                    <div class="average-rating-number"><?php echo esc_attr($average); ?></div>
                                    <div class="average-rating-stars">
                                        <?php do_action( 'woocommerce_after_shop_loop_item_title' ); ?>
                                    </div>
                                    <div class="average-rating-label">
                                        <?php echo esc_attr($rating_count.' '.esc_html__('Ratings', 'studiare')); ?>
                                    </div>
                                </div>
                            </div>

                            <!-- Detailed Ratings-->
                            <?php
                            // WP_Comment_Query arguments
                            $args = array (
                                'status'         => 'approve',
                                'type'           => 'comment',
                                'post_id'        => get_the_id(),
                            );

                            // The Comment Query
                            $woo_reviews = new WP_Comment_Query;
                            $comments = $woo_reviews->query( $args );

                            $rate1 = $rate2 = $rate3 = $rate4 = $rate5 = 0;
                            // The Comment Loop
                            if ( $comments ) {
                                foreach ( $comments as $comment ) {
                                    $rate = get_comment_meta($comment->comment_ID, 'rating', true);
                                    switch($rate) {
                                        case 1:
                                            $rate1++;
                                            break;
                                        case 2:
                                            $rate2++;
                                            break;
                                        case 3:
                                            $rate3++;
                                            break;
                                        case 4:
                                            $rate4++;
                                            break;
                                        case 5:
                                            $rate5++;
                                            break;
                                    } // switch
                                }
                            }
                            $rates = array('5'=>$rate5,'4'=>$rate4,'3'=>$rate3,'2'=>$rate2,'1'=>$rate1);
                            ?>
                            <div class="detailed-ratings">
                                <p class="rating-subtitle"><?php esc_html_e('Detailed Rating', 'studiare');?></p>
                                <div class="detailed-ratings-inner">
	                                <?php foreach($rates as $key => $rate): ?>
		                                <?php
		                                if($rate !=0 or $rating_count != 0) {
			                                $fill_value = round($rate*100/$rating_count, 2);
		                                } else {
			                                $fill_value = 0;
		                                }
		                                ?>
                                        <div class="course-rating">
                                            <span class="number"><?php echo esc_attr($key.' '.__('Stars', 'studiare')); ?></span>
                                            <div class="bar">
                                                <div class="bar-fill" style="width:<?php echo esc_attr($fill_value); ?>%"></div>
                                            </div>
                                            <span class="counter"><?php echo esc_attr($rate); ?></span>
                                        </div>
	                                <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if ( comments_open() || get_comments_number() ): ?>
                        <?php comments_template(); ?>
                    <?php endif; ?>

                </div>
            </div>

        </div>

        <div class="product-single-aside sticky-sidebar">
            <div class="theiaStickySidebar">
                <?php wc_get_template_part('content-single-product-meta-side'); ?>

	            <?php if ( !empty( $teacher_id ) && $teacher_id != 'no-teacher' ) : ?>
                    <?php

                    $teacher_post = get_post( $teacher_id );
                    $teacher_job_title = get_post_meta( $teacher_id, $prefix . 'teacher_job_title', true );
                    ?>

                    <div class="course-teacher-details">
                        <div class="top-part">
                            <?php $teacher_image = wp_get_attachment_image_src(get_post_thumbnail_id( $teacher_id ), 'img-120-120', false); ?>
                            <?php if(!empty($teacher_image[0])): ?>
                                <img class="img-fluid" src="<?php echo esc_url($teacher_image[0]); ?>" alt="<?php echo esc_attr( get_the_title( $teacher_id ) ); ?>">
                            <?php endif; ?>
                            <div class="name">
                                <h6><?php echo esc_attr(get_the_title($teacher_id)); ?></h6>
                                <?php if(!empty($teacher_job_title)): ?>
                                    <span class="job-title"><?php echo esc_attr($teacher_job_title); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="content">
                            <p><?php echo esc_attr( $teacher_post->post_excerpt ); ?></p>
                            <a href="<?php echo esc_url( get_permalink( $teacher_post ) ); ?>" class="btn-link"><?php esc_html_e( 'View full profile', 'studiare' ); ?></a>
                        </div>
                    </div>
	                <?php wp_reset_postdata(); ?>
                <?php endif; ?>
            </div>
        </div>

    </div>

</div>

<?php do_action( 'woocommerce_after_single_product_summary' ); ?>

<?php do_action( 'woocommerce_after_single_product' ); ?>