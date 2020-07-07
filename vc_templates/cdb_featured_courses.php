<?php


// Atts
if ( function_exists( 'vc_map_get_attributes' ) ) {
	$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
}

extract( $atts );

list( $query_args, $products_query ) = vc_build_loop_query( $products_query );

// Element Class
$class_to_filter = "products grid-view courses-{$columns}-columns";
$class_to_filter .= $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );



?>

<div class="<?php echo esc_attr( $css_class ) . vc_shortcode_custom_css_class($css, ' '); ?>">
    <?php if ( $products_query->have_posts() ) : $i = 0; ?>
        <?php while( $products_query->have_posts() ) : $products_query->the_post(); ?>
            <?php
                global $product;
                
                // Custom Meta
                $prefix = '_studiare_';
                $teacher_id = get_post_meta( get_the_ID(), $prefix . 'course_teacher', true );
                $stock = get_post_meta( get_the_ID(), '_stock', true );
                $regular_price = get_post_meta(get_the_id(), '_regular_price', true );
                $sale_price = get_post_meta(get_the_id(), '_sale_price', true );
		    ?>
            <div <?php post_class( 'course-item' ); ?>>
                <div class="course-item-inner">

		            <?php if ( has_post_thumbnail( ) ) : ?>
                        <div class="course-thumbnail-holder">
                            <a href="<?php the_permalink(); ?>">
					            <?php the_post_thumbnail('studiare-course-thumb', array('class'=>'img-fluid')); ?>
                            </a>
                        </div>
		            <?php endif; ?>

                    <div class="course-content-holder">

                        <div class="course-content-main">
                            <h4 class="course-title">
                                <a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
                            </h4>
                            <div class="course-rating-teacher">
					            <?php woocommerce_template_loop_rating(); ?>
					            <?php if ( !empty( $teacher_id ) && $teacher_id != 'no-teacher' ) : ?>
                                    <a href="<?php echo esc_url( get_the_permalink( $teacher_id ) ); ?>" class="course-loop-teacher"><?php echo esc_attr( get_the_title( $teacher_id ) ); ?></a>
					            <?php else : ?>
                                    <h6>&nbsp;</h6>
					            <?php endif; ?>
                            </div>
                            <div class="course-description">
					            <?php the_excerpt(); ?>
                            </div>
                        </div>

                        <div class="course-content-bottom">

				            <?php if(!empty($stock)): ?>
                                <div class="course-students">
                                    <i class="material-icons">group</i><span><?php echo esc_attr(floatval($stock)); ?></span>
                                </div>
				            <?php else: ?>
                                <div class="course-students">
                                    <i class="material-icons">group</i><span>0</span>
                                </div>
				            <?php endif; ?>

                            <div class="course-price">
					            <?php if ( !empty( $sale_price ) && $sale_price != '0' ) : ?>
                                    <span class="price-sale"><?php echo esc_attr( get_woocommerce_currency_symbol().$sale_price ); ?></span>
					            <?php elseif( !empty( $regular_price ) && $regular_price != '0' ) : ?>
                                    <span><?php echo esc_attr( get_woocommerce_currency_symbol().$regular_price ); ?></span>
					            <?php else : ?>
                                    <span class="price-free"><?php esc_html_e('Free Course!', 'studiare' ); ?></span>
					            <?php endif; ?>
                            </div>

                        </div>

                    </div>

                </div>
            </div>
        <?php $i++; endwhile; wp_reset_postdata(); ?>
    <?php endif; ?>
</div>
