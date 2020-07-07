<?php

if ( ! class_exists( 'Redux' ) ) {
	return;
}

// This is your option name where all the Redux data is stored.
$opt_name = "codebean_option";

$studiare_selectors = codebean_get_config('selectors');

/**
 * ---> SET ARGUMENTS
 * All the possible arguments for Redux.
 * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
 * */

$theme = wp_get_theme(); // For use with some settings. Not necessary.

$codebean_social_networks_shortcode = "
<code style='font-size: 10px; display: inline-block; margin-top: 10px;'>[social_networks]</code><br>
<code style='font-size: 10px; display: inline-block; margin-top: 10px;'>[social_networks rounded]</code><br>
<code style='font-size: 10px; display: inline-block; margin-top: 10px;'>[social_networks light]</code><br>";

$args = array(
	'opt_name'             => $opt_name,
	'display_name'         => $theme->get( 'Name' ),
	'display_version'      => $theme->get( 'Version' ),
	'menu_type'            => 'menu',
	'allow_sub_menu'       => true,
	'menu_title'           => esc_html__( 'Theme Settings', 'studiare' ),
	'page_title'           => esc_html__( 'Theme Settings', 'studiare' ),
	'google_api_key'       => '',
	'google_update_weekly' => false,
	'async_typography'     => false,
	'admin_bar'            => true,
	'admin_bar_icon'       => 'dashicons-laptop',
	'admin_bar_priority'   => 50,
	'global_variable'      => '',
	'dev_mode'             => false,
	'show_options_object'  => false,
	'update_notice'        => true,
	'customizer'           => true,
	'disable_tracking'     => true,

	// OPTIONAL -> Give you extra features
	'page_priority'        => 61,
	'page_parent'          => 'themes.php',
	'page_permissions'     => 'manage_options',
	'menu_icon'            => 'dashicons-laptop',
	'last_tab'             => '',
	'page_icon'            => 'icon-themes',
	'page_slug'            => 'theme-options',
	'save_defaults'        => true,
	'default_show'         => false,
	'default_mark'         => '',
	'show_import_export'   => true,

	// CAREFUL -> These options are for advanced use only
	'transient_time'       => 60 * MINUTE_IN_SECONDS,
	'output'               => true,
	'output_tag'           => true,
	'database'             => '',
	'use_cdn'              => true,
	// HINTS
	'hints'                => array(
		'icon'          => 'el-question-sign',
		'icon_position' => 'right',
		'icon_color'    => 'lightgray',
		'icon_size'     => 'normal',
		'tip_style'     => array(
			'color'   => 'red',
			'shadow'  => true,
			'rounded' => false,
			'style'   => '',
		),
		'tip_position'  => array(
			'my' => 'top left',
			'at' => 'bottom right',
		),
		'tip_effect'    => array(
			'show' => array(
				'effect'   => 'slide',
				'duration' => '500',
				'event'    => 'mouseover',
			),
			'hide' => array(
				'effect'   => 'slide',
				'duration' => '500',
				'event'    => 'click mouseleave',
			),
		),
	)

);

Redux::setArgs( $opt_name, $args );

/*
 * ---> END ARGUMENTS
 */


/*
 *
 * ---> START SECTIONS
 *
 */

# General Settings
Redux::setSection( $opt_name, array(
	'title'             => esc_html__( 'General', 'studiare' ),
	'id'                => 'codebean_general',
	'desc'              => '',
	'customizer_width'  => '400px',
	'submenu'           => true,
	'icon'              => 'el-icon-home',
	'fields' => array(
		array (
			'id' => 'favicon',
			'type' => 'media',
			'desc' => esc_html__( 'Upload image: png, ico', 'studiare' ),
			'operator' => 'and',
			'title' => esc_html__( 'Favicon image', 'studiare' ),
		),
		array (
			'id' => 'favicon_retina',
			'type' => 'media',
			'desc' => esc_html__( 'Upload image: png, ico', 'studiare' ),
			'operator' => 'and',
			'title' => esc_html__( 'Favicon retina image', 'studiare' )
		),
		array(
			'id'       => 'studiare_preloader',
			'type'     => 'switch',
			'title'    => esc_html__('Enable Preloader', 'studiare'),
			'default'  => false
		),
		array(
			'id'       => 'preloader_icon',
			'type'     => 'select',
			'title'    => esc_html__('Enable Preloader', 'studiare'),
			'default'  => 'circle',
			'options'   => array(
				'circle' => esc_html__( 'Circle', 'studiare' ),
				'square-boxes' => esc_html__( 'Square Boxes', 'studiare' )
			),
			'required' => array('studiare_preloader', '=', true),
			'select2'   => array('allowClear' => false)
		),
		array(
			'id'        => 'google_api_key',
			'type'      => 'text',
			'title'     => esc_html__( 'Google API Key', 'studiare' ),
			'description' => esc_html__( 'Enter here the secret api key you have created on Google APIs', 'studiare' )
		)
	)
) );


# Header Settings
Redux::setSection( $opt_name, array(
	'title' => esc_html__( 'Header', 'studiare' ),
	'id' => 'header',
	'icon' => 'el-icon-wrench'
) );


Redux::setSection( $opt_name, array(
	'title' => esc_html__( 'Header Layout', 'studiare' ),
	'id' => 'branding',
	'subsection' => true,
	'fields' => array(
		array(
			'id'        => 'header_height',
			'type'      => 'slider',
			'title'     => esc_html__('Header height', 'studiare'),
			"default"   => 112,
			"min"       => 40,
			"step"      => 1,
			"max"       => 220,
			'display_value' => 'label',
			'tags'     => 'header size logo height logo size'
		),
		array(
			'id' => 'custom_logo_image',
			'type' => 'media',
			'desc' => esc_html__('Upload image: png, jpg or gif file', 'studiare'),
			'operator' => 'and',
			'title' => esc_html__('Logo image', 'studiare'),
		),
		array(
			'id'        => 'logo_img_width',
			'type'      => 'slider',
			'title'     => esc_html__('Logo image maximum width (px)', 'studiare'),
			'desc'      => esc_html__('Set maximum width for logo image in the header. In pixels', 'studiare'),
			"default"   => 200,
			"min"       => 50,
			"step"      => 1,
			"max"       => 600,
			'display_value' => 'label',
			'tags'     => 'logo width logo size'
		),
		array(
			'id'             => 'logo_padding',
			'type'           => 'spacing',
			'mode'           => 'padding',
			'units'          => array('px'),
			'units_extended' => 'false',
			'title'          => esc_html__('Logo image padding', 'studiare'),
			'desc'           => esc_html__('Add some spacing around your logo image', 'studiare'),
			'default'            => array(
				'padding-top'     => '10px',
				'padding-right'   => '20px',
				'padding-bottom'  => '10px',
				'padding-left'    => '0px',
				'units'          => 'px',
			),
			'tags'     => 'logo padding logo spacing',
			'select2'   => array('allowClear' => false)
		),
		array(
			'id'        => 'header_button',
			'type'      => 'switch',
			'title'     => esc_html__( 'Button on header', 'studiare' ),
			'subtitle'  => esc_html__( 'Show/hide button on header right', 'studiare' ),
			'default'   => true,
		),
		array(
			'id'        => 'header_button_link',
			'type'      => 'select',
			'title'     => esc_html__( 'Button Link', 'studiare' ),
			'subtitle'  => esc_html__( 'Choose link you want to add on button', 'studiare' ),
			'default'   => 'account',
			'options'   => array(
				'account' => esc_html__( 'Link to account', 'studiare' ),
				'custom'  => esc_html__( 'Custom link', 'studiare' ),
			),
			'required'  => array('header_button', '=', true),
			'select2'   => array('allowClear' => false)
		),
		array(
			'id'        => 'header_button_custom_text',
			'type'      => 'text',
			'title'     => esc_html__( 'Custom button text', 'studiare' ),
			'required'  => array('header_button_link', '=', 'custom'),
		),
		array(
			'id'        => 'header_button_custom_link',
			'type'      => 'text',
			'title'     => esc_html__( 'Custom button link', 'studiare' ),
			'required'  => array('header_button_link', '=', 'custom'),
		)
	),
) );

Redux::setSection( $opt_name, array(
	'title' => esc_html__( 'Top bar', 'studiare' ),
	'id' => 'header-topbar',
	'subsection' => true,
	'fields' => array(
		array(
			'id'        => 'topbar_display_opt',
			'type'      => 'switch',
			'title'     => esc_html__( 'Top Bar', 'studiare' ),
			'subtitle'  => esc_html__( 'Information about the header', 'studiare' ),
			'default'   => true,
		),
		array(
			'id'        => 'topbar_color',
			'type'      => 'select',
			'title'     => esc_html__( 'Top bar text color', 'studiare' ),
			'default'   => 'light',
			'options'   => array(
				'dark' => esc_html__( 'Dark', 'studiare' ),
				'light'  => esc_html__( 'Light', 'studiare' )
			),
			'required'  => array('topbar_display_opt', '=', '1'),
			'select2'   => array('allowClear' => false)
		),
		array(
			'id'       => 'top-bar-bg',
			'type'     => 'background',
			'title'    => esc_html__( 'Top bar background', 'studiare' ),
			'background-image' => false,
			'background-position' => false,
			'background-attachment' => false,
			'background-size' => false,
			'background-repeat' => false,
			'transparent' => false,
			'preview' => false,
			'output'   => '.top-bar',
			'default'  => array(
				'background-color' => '#2e3e77'
			),
			'required'  => array('topbar_display_opt', '=', '1'),
		),
		array(
			'id'      => 'top_bar_phone',
			'type'    => 'text',
			'title'   => esc_html__( 'Phone Number', 'studiare' ),
		),
		array(
			'id'      => 'top_bar_email',
			'type'    => 'text',
			'title'   => esc_html__( 'Email Address', 'studiare' ),
		),
		array(
			'id'        => 'topbar_search',
			'type'      => 'switch',
			'title'     => esc_html__( 'Show/hide search', 'studiare' ),
			'default'   => true,
		),
		array(
			'id'        => 'topbar_cart',
			'type'      => 'switch',
			'title'     => esc_html__( 'Show/hide cart', 'studiare' ),
			'default'   => true,
		)
	)
) );

Redux::setSection( $opt_name, array(
	'title' => esc_html__( 'Mobile Navigation', 'studiare' ),
	'id' => 'mobile-nav',
	'subsection' => true,
	'fields' => array(
		array(
			'id' => 'off_canvas_search',
			'type' => 'switch',
			'title' => esc_html__( 'Search on mobile', 'studiare' ),
			'subtitle' => esc_html__( 'Show/hide search form on mobile navigation', 'studiare' ),
			'default' => true
		),
		array(
			'id' => 'off_canvas_cart',
			'type' => 'switch',
			'title' => esc_html__( 'Shopping cart on mobile', 'studiare' ),
			'subtitle' => esc_html__( 'Show/hide shopping cart on mobile navigation', 'studiare' ),
			'default' => true
		),
		array(
			'id' => 'off_canvas_footer',
			'type' => 'textarea',
			'title' => esc_html__( 'Text or shortcode on mobile', 'studiare' ),
			'subtitle' => esc_html__( 'Place here text you want to see in the mobile nav footer area. You can use shortocdes. Ex.: [social_buttons]', 'studiare' )
		),
	)
) );

# Styling
Redux::setSection( $opt_name, array(
	'title' => esc_html__( 'Styling', 'studiare' ),
	'id' => 'colors',
	'icon' => 'el-icon-brush',
	'fields' => array(
		array(
			'id'       => 'primary_color',
			'type'     => 'color',
			'title'    => esc_html__( 'Primary Color', 'studiare' ),
			'validate' => 'color',
			'transparent' => false,
			'output'   => $studiare_selectors['primary_color'],
			'default'  => '#f9a134'
		),
		array(
			'id'       => 'secondary_color',
			'type'     => 'color',
			'title'    => esc_html__( 'Secondary Color', 'studiare' ),
			'validate' => 'color',
			'transparent' => false,
			'output'   => $studiare_selectors['secondary_color'],
			'default'  => '#1e83f0'
		)
	)
) );

# Typography
Redux::setSection( $opt_name, array(
	'title' => esc_html__('Typography', 'studiare'),
	'id' => 'typography',
	'icon' => 'el-icon-fontsize',
	'fields' => array(
		array(
			'id'             => 'font_body',
			'type'           => 'typography',
			'title'          => esc_html__( 'Body', 'studiare' ),
			'compiler'       => true,
			'google'         => true,
			'font-backup'    => false,
			'font-weight'    => false,
			'all_styles'     => true,
			'text-align'     => false,
			'font-style'     => false,
			'subsets'        => false,
			'font-size'      => true,
			'line-height'    => false,
			'word-spacing'   => false,
			'letter-spacing' => false,
			'color'          => true,
			'preview'        => true,
			'output'         => array( 'body' ),
			'units'          => 'px',
			'subtitle'       => esc_html__( 'Select custom font for your main body text.', 'studiare' ),
			'default'        => array(
				'color'       => "#7d7e7f",
				'font-size'   => '15px',
				'font-family' => 'Raleway',
				'google'      => true,
				'font-backup' => "'MS Sans Serif', Geneva, sans-serif"
			)
		),
		array(
			'id'             => 'menu_heading',
			'type'           => 'typography',
			'title'          => esc_html__( 'Menu', 'studiare' ),
			'compiler'       => true,
			'google'         => true,
			'font-backup'    => false,
			'all_styles'     => true,
			'font-weight'    => true,
			'font-style'     => false,
			'text-align'     => false,
			'subsets'        => false,
			'font-size'      => true,
			'line-height'    => false,
			'word-spacing'   => false,
			'letter-spacing' => false,
			'color'          => false,
			'preview'        => true,
			'output'         => array( '.studiare-navigation ul.menu>li>a, .studiare-navigation .menu>ul>li>a' ),
			'units'          => 'px',
			'subtitle'       => esc_html__( 'Select custom font for menu', 'studiare' ),
			'default'        => array(
				'font-family' => 'Raleway',
				'font-weight' => '400',
				'font-size'   => '16px'
			)
		),
		array(
			'id'             => 'submenu_font',
			'type'           => 'typography',
			'title'          => esc_html__( 'Sub Menu', 'studiare' ),
			'compiler'       => false,
			'google'         => false,
			'font-backup'    => false,
			'all_styles'     => true,
			'font-weight'    => true,
			'text-align'     => false,
			'font-style'     => true,
			'subsets'        => false,
			'font-size'      => true,
			'line-height'    => false,
			'word-spacing'   => false,
			'letter-spacing' => false,
			'color'          => false,
			'preview'        => true,
			'output'         => array( '.studiare-navigation ul.menu>li ul li>a, .studiare-navigation .menu>ul>li ul li>a' ),
			'units'          => 'px',
			'subtitle'       => esc_html__( 'Select custom font for sub menu', 'studiare' ),
			'default'        => array(
				'font-family' => 'Raleway',
				'font-size' => '14px',
				'font-weight' => '400',
			)
		),
		array(
			'id'             => 'h1_params',
			'type'           => 'typography',
			'title'          => esc_html__( 'H1', 'studiare' ),
			'compiler'       => true,
			'google'         => true,
			'font-backup'    => false,
			'all_styles'     => true,
			'font-weight'    => true,
			'font-family'    => true,
			'text-align'     => false,
			'font-style'     => true,
			'subsets'        => false,
			'font-size'      => true,
			'line-height'    => false,
			'word-spacing'   => false,
			'letter-spacing' => false,
			'color'          => true,
			'preview'        => true,
			'output'         => array( 'h1,.h1' ),
			'units'          => 'px',
			'default'        => array(
				'font-size' => '26px',
				'font-weight' => '400',
				'color'       => '#464749',
				'font-family' => 'Raleway',
				'google'      => true,
			)
		),
		array(
			'id'             => 'h2_params',
			'type'           => 'typography',
			'title'          => esc_html__( 'H2', 'studiare' ),
			'compiler'       => true,
			'google'         => true,
			'font-backup'    => false,
			'all_styles'     => true,
			'font-weight'    => true,
			'font-family'    => true,
			'text-align'     => false,
			'font-style'     => true,
			'subsets'        => false,
			'font-size'      => true,
			'line-height'    => false,
			'word-spacing'   => false,
			'letter-spacing' => false,
			'color'          => true,
			'preview'        => true,
			'output'         => array( 'h2,.h2' ),
			'units'          => 'px',
			'default'        => array(
				'font-size' => '24px',
				'font-weight' => '400',
				'color'       => '#464749',
				'font-family' => 'Raleway',
				'google'      => true,
			)
		),
		array(
			'id'             => 'h3_params',
			'type'           => 'typography',
			'title'          => esc_html__( 'H3', 'studiare' ),
			'compiler'       => true,
			'google'         => true,
			'font-backup'    => false,
			'all_styles'     => true,
			'font-weight'    => true,
			'font-family'    => true,
			'text-align'     => false,
			'font-style'     => true,
			'subsets'        => false,
			'font-size'      => true,
			'line-height'    => false,
			'word-spacing'   => false,
			'letter-spacing' => false,
			'color'          => true,
			'preview'        => true,
			'output'         => array( 'h3,.h3' ),
			'units'          => 'px',
			'default'        => array(
				'font-size' => '22px',
				'font-weight' => '400',
				'color'       => '#464749',
				'font-family' => 'Raleway',
				'google'      => true,
			)
		),
		array(
			'id'             => 'h4_params',
			'type'           => 'typography',
			'title'          => esc_html__( 'H4', 'studiare' ),
			'compiler'       => true,
			'google'         => true,
			'font-backup'    => false,
			'all_styles'     => true,
			'font-weight'    => true,
			'font-family'    => true,
			'text-align'     => false,
			'font-style'     => true,
			'subsets'        => false,
			'font-size'      => true,
			'line-height'    => false,
			'word-spacing'   => false,
			'letter-spacing' => false,
			'color'          => true,
			'preview'        => true,
			'output'         => array( 'h4,.h4' ),
			'units'          => 'px',
			'default'        => array(
				'font-size' => '18px',
				'font-weight' => '500',
				'color'       => '#464749',
				'font-family' => 'Raleway',
				'google'      => true,
			)
		),
		array(
			'id'             => 'h5_params',
			'type'           => 'typography',
			'title'          => esc_html__( 'H5', 'studiare' ),
			'compiler'       => true,
			'google'         => true,
			'font-backup'    => false,
			'all_styles'     => true,
			'font-weight'    => true,
			'font-family'    => true,
			'text-align'     => false,
			'font-style'     => true,
			'subsets'        => false,
			'font-size'      => true,
			'line-height'    => false,
			'word-spacing'   => false,
			'letter-spacing' => false,
			'color'          => true,
			'preview'        => true,
			'output'         => array( 'h5,.h5' ),
			'units'          => 'px',
			'default'        => array(
				'font-size' => '18px',
				'font-weight' => '500',
				'color'       => '#464749',
				'font-family' => 'Raleway',
				'google'      => true,
			)
		),
		array(
			'id'             => 'h6_params',
			'type'           => 'typography',
			'title'          => esc_html__( 'H6', 'studiare' ),
			'compiler'       => true,
			'google'         => true,
			'font-backup'    => false,
			'all_styles'     => true,
			'font-weight'    => true,
			'font-family'    => true,
			'text-align'     => false,
			'font-style'     => true,
			'subsets'        => false,
			'font-size'      => true,
			'line-height'    => false,
			'word-spacing'   => false,
			'letter-spacing' => false,
			'color'          => true,
			'preview'        => true,
			'output'         => array( 'h6,.h6' ),
			'units'          => 'px',
			'default'        => array(
				'font-size' => '16px',
				'font-weight' => '500',
				'color'       => '#464749',
				'font-family' => 'Raleway',
				'google'      => true,
			)
		),
	)
) );

# Blog Settings
Redux::setSection( $opt_name, array(
	'title' => esc_html__( 'Blog', 'studiare' ),
	'id' => 'blog',
	'icon' => 'el-icon-pencil',

) );

Redux::setSection( $opt_name, array(
	'title'            => esc_html__( 'Blog Settings', 'studiare' ),
	'id'               => 'blog_settings',
	'subsection'       => true,
	'fields'           => array(
		array(
			'id'        => 'blog_post_style',
			'type'      => 'button_set',
			'title'     => esc_html__( 'Blog Posts Layout', 'studiare' ),
			'subtitle'  => esc_html__( 'Choose the form you want to show blog posts', 'studiare' ),
			'default'   => 'list',
			'options'   => array(
				'list' => esc_html__( 'List View', 'studiare' ),
				'grid' => esc_html__( 'Grid View', 'studiare' ),
			)
		),
		array(
			'id' => 'blog_grid_columns',
			'type' => 'select',
			'title' => esc_html__( 'Blog Grid Columns', 'studiare' ),
			'subtitle' => esc_html__( 'How many columns you want in a row', 'studiare' ),
			'default' => 'three',
			'options' => array(
				'one' => esc_html__( 'One Column', 'studiare' ),
				'two' => esc_html__( 'Two Columns', 'studiare' ),
				'three' => esc_html__( 'Three Columns', 'studiare' ),
				'four' => esc_html__( 'Four Columns', 'studiare' )
			),
			'select2'   => array('allowClear' => false),
			'required'  => array('blog_post_style', '=', 'grid')
		),
		array(
			'id'        => 'sidebar_position',
			'type'      => 'image_select',
			'title'     => esc_html__( 'Sidebar Position', 'studiare' ),
			'subtitle'  => esc_html__( 'Set blog sidebar position or hide it', 'studiare' ),
			'default'   => 'right',
			'options'   => array(
				'none'      => array(
					'alt'   => esc_html__( 'No Sidebar', 'studiare' ),
					'img'   => ReduxFramework::$_url.'assets/img/1col.png'
				),
				'left'      => array(
					'alt'   => esc_html__( 'Sidebar Left', 'studiare' ),
					'img'   => ReduxFramework::$_url.'assets/img/2cl.png'
				),
				'right'      => array(
					'alt'   => esc_html__( 'Sidebar Right', 'studiare' ),
					'img'  => ReduxFramework::$_url.'assets/img/2cr.png'
				),
			)
		),
		array(
			'id'        => 'article_author',
			'type'      => 'switch',
			'title'     => esc_html__( 'Display Author Info?', 'studiare' ),
			'subtitle'  => esc_html__( 'Displays author information at the bottom. Will only be displayed if the author description is filled.', 'studiare' ),
			'default'   => true,
		),
		array(
			'id'        => 'blog_navigation',
			'type'      => 'switch',
			'title'     => esc_html__( 'Display Article Navigation?', 'studiare' ),
			'subtitle'  => esc_html__( 'Displays article navigation after post content.', 'studiare' ),
			'default'   => true,
		),
	)
) );

$share_story_networks = array(
	'enabled' => array(
		'placebo'	=> 'placebo',
		'fb'   	 	=> 'Facebook',
		'tw'   	 	=> 'Twitter',
		'lin'       => 'LinkedIn',
		'tlr'       => 'Tumblr',
		'gp'       	=> 'Google Plus',
	),
	'disabled' => array(
		'placebo'   => 'placebo',
		'pi'       	=> 'Pinterest',
		'em'       	=> 'Email',
		'vk'       	=> 'VKontakte',
	),
);

Redux::setSection( $opt_name, array(
	'title'            => esc_html__( 'Sharing Settings', 'studiare' ),
	'id'               => 'sharing_settings',
	'subsection'       => true,
	'fields'           => array(
		array(
			'id'       => 'blog_share_story',
			'title'    => esc_html__( 'Share Story', 'studiare' ),
			'subtitle' => esc_html__( 'Enable or disable sharing blog post on social networks', 'studiare' ),
			'type'     => 'switch',
			'default'  => true,
			'on'       => esc_html__( 'Allow Share', 'studiare' ),
			'off'      => esc_html__( 'No', 'studiare' ),
		),
		array(
			'id'       => 'blog_share_story_networks',
			'title'    => esc_html__( 'Share on:', 'studiare' ),
			'subtitle' => esc_html__( 'Choose social networks that visitors can share your blog post', 'studiare' ),
			'type'     => 'sorter',
			'options'  => $share_story_networks,
			'required' => array('blog_share_story', '=', '1'),
		),
	)
) );

# Footer Settings
Redux::setSection( $opt_name, array(
	'title'             => esc_html__( 'Footer', 'studiare' ),
	'id'                => 'footer_settings',
	'desc'              => esc_html__( 'Every footer option is included here.', 'studiare' ),
	'customizer_width'  => '400px',
	'icon'              => 'el-icon-photo',
	'fields'            => array(
		array(
			'id'        => 'footer_visibility',
			'type'      => 'switch',
			'title'     => esc_html__( 'Footer Visibility', 'studiare' ),
			'subtitle'  => esc_html__( 'Show or hide footer globally', 'studiare' ),
			'default'   => true,
		),
		array(
			'id'        => 'footer_color_scheme',
			'type'      => 'select',
			'title'     => esc_html__( 'Footer text color', 'studiare' ),
			'subtitle'  => esc_html__( 'Choose your footer color scheme', 'studiare' ),
			'default'   => 'light',
			'options'   => array(
				'dark' => esc_html__( 'Dark', 'studiare' ),
				'light'  => esc_html__( 'Light', 'studiare' )
			),
			'select2'   => array('allowClear' => false)
		),
		array(
			'id'       => 'footer-widgets-bg',
			'type'     => 'background',
			'title'    => esc_html__( 'Footer background', 'studiare' ),
			'output'   => '.site-footer',
			'default'  => array(
				'background-color' => '#2e3e77'
			)
		),
		array(
			'id'        => 'footer_widgets',
			'type'      => 'switch',
			'required'  => array('footer_visibility', '=' , '1'),
			'title'     => esc_html__( 'Footer Widgets', 'studiare' ),
			'subtitle'  => esc_html__( 'Show or hide footer widgets', 'studiare' ),
			'default'   => true,
		),
		array(
			'id'        => 'footer_columns',
			'type'      => 'image_select',
			'required'  => array('footer_widgets', '=', '1'),
			'title'     => esc_html__( 'Footer Columns', 'studiare' ),
			'subtitle'  => esc_html__( 'Set columns layout for footer to split widgets.', 'studiare' ),
			'default'   => 'three',
			'options'   => array(
				'four'   => array(
					'alt'   => '4 Columns',
					'img' => get_parent_theme_file_uri('assets/images/admin/footer-4.png' ),
				),
				'three'  => array(
					'alt'   => '3 Columns',
					'img' => get_parent_theme_file_uri('assets/images/admin/footer-3.png' ),
				),
				'two'    => array(
					'alt'   => '2 Columns',
					'img' => get_parent_theme_file_uri('assets/images/admin/footer-2.png' ),
				),
				'doubleleft'    => array(
					'alt'   => 'Double Left',
					'img' => get_parent_theme_file_uri('assets/images/admin/footer-double-left.png'),
				),
				'doubleright'   => array(
					'alt'   => 'Double Right',
					'img' => get_parent_theme_file_uri('assets/images/admin/footer-double-right.png'),
				),
				'one'     => array(
					'alt'   => '1 Column',
					'img' => get_parent_theme_file_uri('assets/images/admin/footer-1.png'),
				),
			),
		),
		array(
			'id'       => 'disable_copyrights',
			'type'     => 'switch',
			'title'    => esc_html__('Copyrights', 'studiare'),
			'default' => true
		),
		array(
			'id'       => 'copyrights-layout',
			'type'     => 'select',
			'title'    => esc_html__('Copyrights layout', 'studiare'),
			'options'  => array(
				'two-columns' => esc_html__('Two columns', 'studiare'),
				'centered' => esc_html__('Centered', 'studiare'),
			),
			'default' => 'two-columns'
		),
		array(
			'id'       => 'copyrights-layout',
			'type'     => 'select',
			'title'    => esc_html__('Copyrights layout', 'studiare'),
			'options'  => array(
				'default' => esc_html__('Two columns', 'studiare'),
				'centered' => esc_html__('Centered', 'studiare'),
			),
			'default' => 'default',
			'select2'   => array('allowClear' => false)
		),
		array(
			'id'       => 'copyrights',
			'type'     => 'text',
			'title'    => esc_html__('Copyrights text', 'studiare'),
			'subtitle' => esc_html__('Place here text you want to see in the copyrights area. You can use shortocdes. Ex.: [social_networks]', 'studiare'),
		),
		array(
			'id'       => 'copyrights2',
			'type'     => 'text',
			'title'    => esc_html__('Text next to copyrights', 'studiare'),
			'subtitle' => esc_html__('You can use shortcodes. Ex.: [social_networks]', 'studiare'),
		),
		array(
			'id'       => 'scroll_top_btn',
			'type'     => 'switch',
			'title'    => esc_html__( 'Scroll to top button', 'studiare' ),
			'default' => true
		),
	)
) );

# Courses Settings
Redux::setSection( $opt_name, array(
	'title' => esc_html__( 'Courses', 'studiare' ),
	'id' => 'courses',
	'icon' => 'el-icon-shopping-cart',

) );

Redux::setSection( $opt_name, array(
	'title'            => esc_html__( 'Course Settings', 'studiare' ),
	'id'               => 'course_settings',
	'subsection'       => true,
	'fields' => array(
		array(
			'id'        => 'shop_sidebar',
			'type'      => 'image_select',
			'title'     => esc_html__( 'Sidebar Position', 'studiare' ),
			'subtitle'  => esc_html__( 'Set shop sidebar position or hide it', 'studiare' ),
			'default'   => 'right',
			'options'   => array(
				'none'      => array(
					'alt'   => esc_html__( 'No Sidebar', 'studiare' ),
					'img'   => ReduxFramework::$_url.'assets/img/1col.png'
				),
				'left'      => array(
					'alt'   => esc_html__( 'Sidebar Left', 'studiare' ),
					'img'   => ReduxFramework::$_url.'assets/img/2cl.png'
				),
				'right'      => array(
					'alt'   => esc_html__( 'Sidebar Right', 'studiare' ),
					'img'  => ReduxFramework::$_url.'assets/img/2cr.png'
				),
			)
		),
		array(
			'id'        => 'courses_columns',
			'type'      => 'select',
			'title'     => esc_html__( 'Courses Columns', 'studiare' ),
			'subtitle'  => esc_html__( 'Choose columns for courses grid', 'studiare' ),
			'options'   => array(
				'2' => esc_html__( 'Two Columns', 'studiare' ),
				'3' => esc_html__( 'Three Columns', 'studiare' ),
				'4' => esc_html__( 'Four Columns', 'studiare' ),
			),
			'default'   => '3',
			'select2'   => array('allowClear' => false)
		),
		array(
			'id'       => 'shop_per_page',
			'type'     => 'spinner',
			'title'    => esc_html__( 'Courses per page', 'studiare' ),
			'subtitle' => esc_html__( 'Number of courses per page', 'studiare' ),
			'default'  => '9',
			'min'      => '1',
			'max'      => '20',
		)
	)
) );

Redux::setSection( $opt_name, array(
	'title'            => esc_html__( 'Sharing Settings', 'studiare' ),
	'id'               => 'course_sharing_settings',
	'subsection'       => true,
	'fields'           => array(
		array(
			'id'       => 'course_share_story',
			'title'    => esc_html__( 'Share Course', 'studiare' ),
			'subtitle' => esc_html__( 'Enable or disable sharing course on social networks', 'studiare' ),
			'type'     => 'switch',
			'default'  => true,
			'on'       => esc_html__( 'Allow Share', 'studiare' ),
			'off'      => esc_html__( 'No', 'studiare' )
		),
		array(
			'id'       => 'course_share_story_networks',
			'title'    => esc_html__( 'Share on:', 'studiare' ),
			'subtitle' => esc_html__( 'Choose social networks that visitors can share your course', 'studiare' ),
			'type'     => 'sorter',
			'options'  => $share_story_networks,
			'required' => array('course_share_story', '=', '1')
		),
		array(
			'id'       => 'course_share_text',
			'type'     => 'editor',
			'title'    => esc_html__( 'Course share text', 'studiare' ),
			'subtitle' => esc_html__( 'Place text before course share icons', 'studiare' ),
			'required' => array('course_share_story', '=', '1')
		)
	)
) );

# Portfolio Settings
Redux::setSection( $opt_name, array(
	'title'             => esc_html__( 'Portfolio', 'studiare' ),
	'id'                => 'portfolio_settings',
	'icon'              => 'el-icon-th',
	'fields'            => array(
		array(
			'id'       => 'portfolio_columns',
			'type'     => 'button_set',
			'title'    => esc_html__('Projects columns', 'studiare'),
			'subtitle' => esc_html__('How many projects you want to show per row', 'studiare'),
			'options'  => array(
				'two'  => esc_html__( 'Two Columns', 'studiare' ),
				'three'  => esc_html__( 'Three Columns', 'studiare' ),
				'four'  => esc_html__( 'Four Columns', 'studiare' ),
			),
			'default' => 'three'
		),
		array(
			'id'        => 'portfolio_filters',
			'type'      => 'button_set',
			'title'     => esc_html__( 'Portfolio Filters', 'studiare' ),
			'subtitle'  => esc_html__( 'Show/hide portfolio filters on side', 'studiare' ),
			'options'   => array(
				'left'  => esc_html__( 'On Left', 'studiare' ),
				'right' => esc_html__( 'On Right', 'studiare' ),
				'no'    => esc_html__( 'None', 'studiare' )
			),
			'default'   => 'left'
		),
		array(
			'id'       => 'portfolio_per_page',
			'type'     => 'spinner',
			'title'    => esc_html__( 'Portfolio per page', 'studiare' ),
			'subtitle' => esc_html__( 'Number of portfolio per page', 'studiare' ),
			'default'  => '9',
			'min'      => '1',
			'max'      => '20',
		),
		array(
			'id'        => 'portfolio_nav',
			'type'      => 'switch',
			'title'     => esc_html__( 'Display Portfolio Navigation?', 'studiare' ),
			'subtitle'  => esc_html__( 'Displays portfolio item navigation after content.', 'studiare' ),
			'default'   => true,
		)
	)
) );


# Social Media Links
$social_networks_ordering = array(
	'enabled' => array (
		'placebo'	=> 'placebo',
		'fb'   	 	=> 'Facebook',
		'tw'   	 	=> 'Twitter',
		'ig'        => 'Instagram',
		'vm'        => 'Vimeo',
		'be'        => 'Behance',
		'fs'        => 'Foursquare',
		'custom'    => 'Custom Link',
	),
	'disabled' => array (
		'placebo'   => 'placebo',
		'gp'        => "Google+",
		'lin'       => 'LinkedIn',
		'yt'        => 'YouTube',
		'drb'       => 'Dribbble',
		'pi'        => 'Pinterest',
		'vk'        => 'VKontakte',
		'da'        => 'DeviantArt',
		'fl'        => 'Flickr',
		'vi'        => 'Vine',
		'tu'        => 'Tumblr',
		'sk'        => 'Skype',
		'gh'        => 'GitHub',
		'hz'        => 'Houzz',
		'px'        => '500px',
		'xi'        => 'Xing',
		'sn'        => 'Snapchat',
		'em'        => 'Email',
		'yp'        => 'Yelp',
		'ta'        => 'TripAdvisor',
	),
);

Redux::setSection( $opt_name, array(
	'title'             => esc_html__( 'Social Networks', 'studiare' ),
	'id'                => 'social_networks',
	'desc'              => '',
	'customizer_width'  => '400px',
	'submenu'           => true,
	'icon'              => 'fa fa-share-alt',
	'fields'            => array(
		// Social Networks Ordering
		array(
			'id'        => 'social_order',
			'type'      => 'sorter',
			'title'     => esc_html__( 'Social Networks Ordering', 'studiare' ),
			'subtitle'  => "Set the appearing order of social networks in the footer. To use social networks links list copy this shortcode:<br><br> " . $codebean_social_networks_shortcode,
			'options'   => $social_networks_ordering,
		),
		array(
			'id'        => 'social_networks_target_attr',
			'type'      => 'select',
			'title'     => esc_html__( 'Link Target', 'studiare' ),
			'subtitle'  => esc_html__( 'Open social links in new window or current window', 'studiare' ),
			'default'   => '_blank',
			'options'   => array(
				'_self' => esc_html__( 'Same Window', 'studiare' ),
				'_blank' => esc_html__( 'New Window', 'studiare' ),
			),
			'select2'   => array('allowClear' => false)
		),
		array(
			'id'       => 'social_network_link_fb',
			'type'     => 'text',
			'title'    => 'Facebook',
			'placeholder' => 'https://facebook.com/username',
			'default'  => '',
		),
		array(
			'id'       => 'social_network_link_tw',
			'type'     => 'text',
			'title'    => 'Twitter',
			'placeholder' => 'https://twitter.com/username',
			'default'  => '',
		),
		array(
			'id'       => 'social_network_link_lin',
			'type'     => 'text',
			'title'    => 'Linkedin',
			'placeholder' => 'https://linkedin.com/in/username',
			'default'  => '',
		),
		array(
			'id'       => 'social_network_link_yt',
			'type'     => 'text',
			'title'    => 'YouTube',
			'placeholder' => 'https://youtube.com/user/username',
			'default'  => '',
		),
		array(
			'id'       => 'social_network_link_vm',
			'type'     => 'text',
			'title'    => 'Vimeo',
			'placeholder' => 'https://vimeo.com/username',
			'default'  => '',
		),
		array(
			'id'       => 'social_network_link_drb',
			'type'     => 'text',
			'title'    => 'Dribbble',
			'placeholder' => 'https://dribbble.com/username',
			'default'  => '',
		),
		array(
			'id'       => 'social_network_link_ig',
			'type'     => 'text',
			'title'    => 'Instagram',
			'placeholder' => 'https://instagram.com/username',
			'default'  => '',
		),
		array(
			'id'       => 'social_network_link_pi',
			'type'     => 'text',
			'title'    => 'Pinterest',
			'placeholder' => 'https://pinterest.com/username',
			'default'  => '',
		),
		array(
			'id'       => 'social_network_link_gp',
			'type'     => 'text',
			'title'    => 'Google Plus',
			'placeholder' => 'https://plus.google.com/username',
			'default'  => '',
		),
		array(
			'id'       => 'social_network_link_vk',
			'type'     => 'text',
			'title'    => 'VKontakte',
			'placeholder' => 'https://vk.com/username',
			'default'  => '',
		),
		array(
			'id'       => 'social_network_link_da',
			'type'     => 'text',
			'title'    => 'DeviantArt',
			'placeholder' => 'https://username.deviantart.com/',
			'default'  => '',
		),
		array(
			'id'       => 'social_network_link_tu',
			'type'     => 'text',
			'title'    => 'Tumblr',
			'placeholder' => 'https://username.tumblr.com/',
			'default'  => '',
		),
		array(
			'id'       => 'social_network_link_vi',
			'type'     => 'text',
			'title'    => 'Vine',
			'placeholder' => 'https://vine.com/username',
			'default'  => '',
		),
		array(
			'id'       => 'social_network_link_be',
			'type'     => 'text',
			'title'    => 'Behance',
			'placeholder' => 'https://behance.com/username',
			'default'  => '',
		),
		array(
			'id'       => 'social_network_link_fl',
			'type'     => 'text',
			'title'    => 'Flickr',
			'placeholder' => 'https://flickr.com/photos/username',
			'default'  => '',
		),
		array(
			'id'       => 'social_network_link_fs',
			'type'     => 'text',
			'title'    => 'Foursquare',
			'placeholder' => 'https://foursquare.com/username',
			'default'  => '',
		),
		array(
			'id'       => 'social_network_link_sk',
			'type'     => 'text',
			'title'    => 'Skype',
			'placeholder' => 'skype:username',
			'default'  => '',
		),
		array(
			'id'       => 'social_network_link_gh',
			'type'     => 'text',
			'title'    => 'GitHub',
			'placeholder' => 'https://github.com/username',
			'default'  => '',
		),
		array(
			'id'       => 'social_network_link_hz',
			'type'     => 'text',
			'title'    => 'Houzz',
			'placeholder' => 'https://houzz.com/user/username',
			'default'  => '',
		),
		array(
			'id'       => 'social_network_link_px',
			'type'     => 'text',
			'title'    => '500px',
			'placeholder' => 'https://500px.com/username',
			'default'  => '',
		),
		array(
			'id'       => 'social_network_link_vi',
			'type'     => 'text',
			'title'    => 'Xing',
			'placeholder' => 'https://xing.com/profile/username',
			'default'  => '',
		),
		array(
			'id'       => 'social_network_link_sn',
			'type'     => 'text',
			'title'    => 'Snapchat',
			'placeholder' => 'https://snapchat.com/add/username',
			'default'  => '',
		),
		array(
			'id'       => 'social_network_link_yp',
			'type'     => 'text',
			'title'    => 'Yelp',
			'placeholder' => 'https://yelp.com/biz/alias',
			'default'  => '',
		),
		array(
			'id'       => 'social_network_link_ta',
			'type'     => 'text',
			'title'    => 'Trip Advisor',
			'placeholder' => 'https://tripadvisor.com',
			'default'  => '',
		),
		array(
			'id'       => 'social_network_link_em',
			'type'     => 'text',
			'title'    => 'Contact Email',
			'placeholder' => 'john.doe@email.com',
			'default'  => '',
		),
		array(
			'id'       => 'social_network_link_em_subject',
			'type'     => 'text',
			'title'    => 'Contact Subject',
			'placeholder' => 'Hello!',
			'default'  => '',
		),
		array(
			'id'       => 'social_network_custom_link_title',
			'type'     => 'text',
			'title'    => 'Custom Link',
			'placeholder' => 'Custom Link Title',
			'default'  => '',
		),
		array(
			'id'       => 'social_network_custom_link_link',
			'type'     => 'text',
			'title'    => 'Link',
			'placeholder' => 'https://www.mywebsite.com/',
			'default'  => '',
		),
		array(
			'id'       => 'social_network_custom_link_icon',
			'type'     => 'text',
			'title'    => 'Custom Link Icon',
			'desc'     => 'Icon (optional)<br><small>Note: If you want to set custom icon, enter icon alias from <a href="http://fontawesome.io/icons/" target="_blank">Font Awesome</a> icon collection.</small>',
			'placeholder' => 'Example: bookmark',
			'default'  => '',
		),

	)
) );

/*
 * <--- END SECTIONS
 */

// Function used to retrieve theme option values
if ( ! function_exists( 'codebean_option' ) ) {
	function codebean_option( $id, $fallback = false, $param = false ) {
		global $codebean_option;
		if ( $fallback == false ) $fallback = '';
		$output = ( isset( $codebean_option[$id] ) && $codebean_option[$id] !== '' ) ? $codebean_option[$id] : $fallback;
		if ( !empty( $codebean_options[$id] ) && $param ) {
			$output = $codebean_options[$id][$param];
		}
		return $output;
	}
}