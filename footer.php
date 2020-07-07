<?php
/**
 * The template for displaying the footer
 */

$prefix = '_studiare_';
$post_id = get_the_ID();

$footer_visiblity = true;
$footer_widgets_opt = true;
$footer_color_scheme = 'light';
$footer_coyprights_opt = true;
$back_to_top = true;

if ( class_exists('Redux')) {
    $footer_visiblity = codebean_option('footer_visibility');
    $footer_widgets_opt = codebean_option('footer_widgets');
    $footer_color_scheme = codebean_option('footer_color_scheme');
	$footer_coyprights_opt = codebean_option('disable_copyrights');
	$back_to_top = codebean_option('scroll_top_btn');
}

?>
<?php if ( studiare_needs_footer() ): ?>

    <?php if ( $footer_visiblity || ! get_post_meta($post_id, $prefix . 'footer_off', true) || ! get_post_meta($post_id, $prefix . 'copyrights_off', true) ) : ?>
        <footer id="footer" class="site-footer footer-color-<?php echo esc_attr( $footer_color_scheme ); ?>">

            <?php if ( $footer_widgets_opt && ! get_post_meta($post_id, $prefix . 'footer_off', true) ) {
                get_template_part( 'inc/templates/footer-widgets' );
            } ?>

            <?php if ( $footer_coyprights_opt && ! get_post_meta( $post_id, $prefix . 'copyrights_off', true ) ) {
                get_template_part( 'inc/templates/footer-copyrights' );
            } ?>

        </footer>
    <?php endif; ?>

<?php endif; ?>

</div> <!-- end .wrap -->


<?php if ( $back_to_top ) : ?>
    <a id="back-to-top" class="back-to-top">
        <i class="material-icons">keyboard_arrow_up</i>
    </a>
<?php endif; ?>

<?php wp_footer(); ?>

</body>
</html>