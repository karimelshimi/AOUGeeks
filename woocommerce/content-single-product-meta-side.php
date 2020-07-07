<?php
/**
 * Template for Single Product on Sie
 */


if ( class_exists( 'Redux' ) ) {
	$course_post_share = codebean_option('course_share_story');
	$course_share_text = codebean_option('course_share_text');
} else {
	$course_post_share = false;
	$course_share_text = '';
}

$prefix = '_studiare_';

// Product Meta
$course_stock = get_post_meta(get_the_id(), '_stock', true);
$duration = get_post_meta(get_the_ID(), $prefix . 'course_duration', true);
$lessons = get_post_meta(get_the_ID(), $prefix . 'course_lesseons', true);
$skill_level = get_post_meta(get_the_ID(), $prefix . 'course_level', true);
$certificate = get_post_meta(get_the_ID(), $prefix . 'course_certificate', true);
$course_language = get_post_meta(get_the_ID(), $prefix . 'course_language', true);


?>

<div class="product-info-box">

	<?php
	/**
	 * woocommerce_single_product_summary hook
	 *
	 * @hooked woocommerce_template_single_title - 5 Removed
	 * @hooked woocommerce_template_single_rating - 10 Removed
	 * @hooked woocommerce_template_single_price - 10
	 * @hooked woocommerce_template_single_excerpt - 20 Removed
	 * @hooked woocommerce_template_single_add_to_cart - 30
	 * @hooked woocommerce_template_single_meta - 40 Removed
	 * @hooked woocommerce_template_single_sharing - 50 Removed
	 */
	do_action( 'woocommerce_single_product_summary' );
	?>

    <?php if ( !empty( $course_stock ) || !empty( $course_language ) || !empty( $duration) || !empty( $lessons ) || !empty( $skill_level ) || !empty( $certificate ) ) : ?>
        <div class="product-meta-info-list">
            <h6><?php esc_html_e('Course Features', 'studiare' ); ?></h6>
            <?php if ( !empty($course_stock) ) : ?>
                <div class="meta-info-unit">
                    <div class="icon"><i class="material-icons">group</i></div>
                    <div class="value"><?php echo esc_attr(floatval($course_stock)).' '.esc_html__('Students', 'studiare'); ?></div>
                </div>
            <?php endif; ?>

            <?php if ( !empty($course_language) ) : ?>
                <div class="meta-info-unit">
                    <div class="icon"><i class="material-icons">language</i></div>
                    <div class="value"><?php echo esc_attr(__('Language:', 'studiare').' '.$course_language); ?></div>
                </div>
            <?php endif; ?>

            <?php if ( !empty($duration) ) : ?>
                <div class="meta-info-unit">
                    <div class="icon"><i class="material-icons">access_time</i></div>
                    <div class="value"><?php echo esc_html($duration); ?></div>
                </div>
            <?php endif; ?>

            <?php if ( !empty($lessons) ) : ?>
                <div class="meta-info-unit">
                    <div class="icon"><i class="material-icons">playlist_add_check</i></div>
                    <div class="value"><?php echo esc_html($lessons); ?></div>
                </div>
            <?php endif; ?>

            <?php if ( !empty($skill_level) ) : ?>
                <div class="meta-info-unit">
                    <div class="icon"><i class="material-icons">spellcheck</i></div>
                    <div class="value"><?php echo esc_attr(__('Study Level:', 'studiare').' '.$skill_level); ?></div>
                </div>
            <?php endif; ?>

            <?php if ( !empty($certificate) ) : ?>
                <div class="meta-info-unit">
                    <div class="icon"><i class="material-icons">terrain</i></div>
                    <div class="value"><?php echo esc_html($certificate); ?></div>
                </div>
            <?php endif; ?>

        </div>
    <?php endif; ?>

</div>