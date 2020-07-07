<?php
/**
 * The header for our theme
 */
?> <!DOCTYPE html>
<html itemscope itemtype="http://schema.org/WebPage" <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<?php do_action( 'studiare_before_body' ); ?>

<?php

$header_button = true;
$header_button_link = 'account';
$account_link = get_permalink( get_option('woocommerce_myaccount_page_id') );

if ( class_exists('Redux') ) {
	$header_button = codebean_option('header_button');
	$header_button_link = codebean_option('header_button_link');
} ?>

<?php if ( ( $header_button ) && ( $header_button_link == 'account' ) ) : ?>
    <div class="modal">
        <div class="login-form-overlay"></div>
        <div class="login-form-modal">
            <div class="login-form-modal-inner">
                <div class="login-form-modal-box">
                    <a href="javascript:void(0)" class="close">
                        <?php get_template_part('/assets/images/close-icon.svg'); ?>
                    </a>
                    <div class="login-form-header">
                        <h3 class="login-title"><?php esc_html_e( 'Sign In', 'studiare' ); ?></h3>
                    </div>
                    <div class="login-form-content">
                        <?php get_template_part('/inc/templates/login-modal' ); ?>
                        <?php printf(
	                        esc_html__( 'Not a member yet? %1$sSign Up%2$s', 'studiare' ),
	                        '<a href="' . esc_url( $account_link ) . '"><strong>',
                            '</strong></a>'
                        ); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<div class="wrap">

    <?php if ( studiare_needs_header() ): ?>

        <?php get_template_part('/inc/templates/header/top-bar' ); ?>

        <?php get_template_part( '/inc/templates/header/header-main' ); ?>

        <?php get_template_part('/inc/templates/page-title'); ?>

    <?php endif; ?>