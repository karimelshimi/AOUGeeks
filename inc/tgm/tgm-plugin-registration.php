<?php

# Library
require_once get_parent_theme_file_path('/inc/tgm/class-tgm-plugin-activation.php');

add_action( 'tgmpa_register', 'studiare_register_required_plugins' );

function studiare_register_required_plugins( $return = false ) {

	$plugins = array(

		array(
			'name'      => esc_html__( 'Redux Framework', 'studiare' ),
			'slug'      => 'redux-framework',
			'required'  => true,
		),

		array(
			'name'               => esc_html__( 'WooCommerce', 'studiare' ),
			'slug'               => 'woocommerce',
			'required'           => true,
		),

		array(
			'name'      => esc_html__( 'Studiare Core', 'studiare' ),
			'slug'      => 'studiare-core',
			'source'    => get_template_directory() . '/inc/lib/plugins/studiare-core.zip',
			'required'  => true,
		),

		array(
			'name'      => esc_html__( 'WPBakery Page Builder', 'studiare' ),
			'slug'      => 'js_composer',
			'source'    => get_template_directory() . '/inc/lib/plugins/js_composer.zip',
			'required'  => false,
			'version'   => '5.5',
		),

		array(
			'name'      => esc_html__( 'Revolution Slider', 'studiare' ),
			'slug'      => 'revslider',
			'source'    => get_template_directory() . '/inc/lib/plugins/revslider.zip',
			'required'  => false,
			'version'   => '5.4.7.2',
		),

		array(
			'name'      => esc_html__( 'CMB2', 'studiare' ),
			'slug'      => 'cmb2',
			'required'  => true,
		),

		array(
			'name'     => esc_html__( 'Breadcrumb NavXT', 'studiare' ),
			'slug'     => 'breadcrumb-navxt',
			'required' => false
		),

		array(
			'name'      => esc_html__( 'WP Events Manager', 'studiare' ),
			'slug'      => 'wp-events-manager',
			'required'  => false,
		),

		array(
			'name'      => esc_html__( 'Contact Form 7', 'studiare' ),
			'slug'      => 'contact-form-7',
			'required'  => false,
		),

		array(
			'name'      => esc_html__( 'MailChimp for WordPress', 'studiare' ),
			'slug'      => 'mailchimp-for-wp',
			'required'  => false,
		),

		array(
			'name'        => esc_html__('bbPress', 'studiare' ),
			'slug'        => 'bbpress',
			'required'    => false,
		),

		array(
			'name'        => esc_html__( 'Portfolio Post Type', 'studiare' ),
			'slug'        => 'portfolio-post-type',
			'required'    => false,
		),

	);

	if($return) {
		return $plugins;
	} else {
		$config = array(
			'is_automatic' => true
		);

		tgmpa($plugins, $config);
	}
}