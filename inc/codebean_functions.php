<?php
/**
 * Codebean Functions File
 */


// custom excerpt length
function studiare_custom_excerpt_length( $length ) {
	return 30;
}
add_filter( 'excerpt_length', 'studiare_custom_excerpt_length', 999 );

// remove dots from read more excerpt
if ( ! function_exists('studiare_excerpt_more' ) ) {
	function studiare_excerpt_more( $more ) {
		return '&hellip;';
	}
}

add_filter( 'excerpt_more', 'studiare_excerpt_more' );

// Studiare get css from settings
if ( ! function_exists( 'studiare_settings_css' ) ) {
	function studiare_settings_css() {
		$logo_img_width = '152';
		$logo_padding = array(
            'padding-top' => '10px',
            'padding-right' => '20px',
            'padding-bottom' => '10px',
            'padding-left' => '0'
        );
		$header_height = '100';

		if ( class_exists('Redux') ) {
			$logo_img_width = codebean_option('logo_img_width');
			$logo_padding = codebean_option('logo_padding');
			$header_height = codebean_option( 'header_height' );
		}

		ob_start(); ?>

		/* Header Settings */
        .site-header {
            min-height: <?php echo esc_html( $header_height ); ?>px;
        }

        .site-header .site-logo .studiare-logo-wrap img {
			max-width: <?php echo esc_html( $logo_img_width ); ?>px;
		}

        .site-header .site-logo .studiare-logo-wrap {
			padding-top: <?php echo esc_html( $logo_padding['padding-top'] ); ?>;
			padding-right: <?php echo esc_html( $logo_padding['padding-right'] ); ?>;
			padding-bottom: <?php echo esc_html( $logo_padding['padding-bottom'] ); ?>;
			padding-left: <?php echo esc_html( $logo_padding['padding-left'] ); ?>;
		}

		<?php

		return ob_get_clean();
	}
}

// Get Enabled Options from Redux
function codebean_get_enabled_options( $items ) {
	$enabled = array();

	if ( isset( $items['enabled'] ) ) {
		foreach ( $items['enabled'] as $item_id => $item ) {

			if ( $item_id == 'placebo' ) {
				continue;
			}

			$enabled[ $item_id ] = $item;
		}
	}

	return $enabled;
}

// Codebean Excerpt Clean
function codebean_clean_excerpt( $content, $strip_tags = false ) {
	$content = strip_shortcodes( $content );
	$content = preg_replace( '#<style.*?>(.*?)</style>#i', '', $content );
	$content = preg_replace( '#<script.*?>(.*?)</script>#i', '', $content );

	return $strip_tags ? strip_tags( $content ) : $content;
}

# Print attribute values based on boolean value
function when_match( $bool, $str = '', $otherwise_str = '', $echo = true ) {
	$str = trim( $bool ? $str : $otherwise_str );

	if ( $str ) {
		$str = ' ' . $str;

		if ( $echo ) {
			echo esc_attr($str);
			return '';
		}
	}

	return $str;
}

// Studiare Page Title
if ( ! function_exists( 'studiare_page_title' ) ) {
	function studiare_page_title($display = true, $single_posts = '', $vacancies_posts = '')
	{
		global $wp_locale;

		$m = get_query_var('m');
		$year = get_query_var('year');
		$monthnum = get_query_var('monthnum');
		$day = get_query_var('day');
		$search = get_query_var('s');
		$title = '';


		// If there is a post
		if ( ( is_home() && !is_front_page()) || (is_page() && !is_front_page()) || is_front_page()) {
			$title = single_post_title('', false);
		}

		if ( is_single() ) {

			if ( get_post_type( get_the_ID() == 'event' ) ) {
				$title = single_post_title( '', false );
			}

			if ( get_post_type( get_the_ID() ) == 'post' ) {
				$categories = get_the_category();
				$title = esc_html__( 'Blog', 'studiare' );
			}

        }

		if (is_home()) {
			if (!get_option('page_for_posts')) {
				$title = $single_posts;
			}
		}

		// If there's a post type archive
		if (is_post_type_archive()) {
			$post_type = get_query_var('post_type');
			if (is_array($post_type)) {
				$post_type = reset($post_type);
			}
			$post_type_object = get_post_type_object($post_type);
			if (!$post_type_object->has_archive) {
				$title = post_type_archive_title('', false);
			}
		}

		// If there's a category or tag
		if (is_category() || is_tag()) {
			$title = single_term_title('', false);
		}

		// If there's a taxonomy
		if (is_tax()) {
			$term = get_queried_object();
			if ($term) {
				$tax = get_taxonomy($term->taxonomy);
				$title = single_term_title('', false);
			}
		}

		// If there's an author
		if (is_author() && !is_post_type_archive()) {
			$author = get_queried_object();
			if ($author) {
				$title = $author->display_name;
			}
		}

		// Post type archives with has_archive should override terms.
		if (is_post_type_archive() && $post_type_object->has_archive) {
			if (function_exists('is_shop') && is_shop()) {
				$title = get_the_title(get_option('woocommerce_shop_page_id'));
			} else {
				$title = post_type_archive_title('', false);
			}
		}

		// If there's a month
		if (is_archive() && !empty($m)) {
			$my_year = substr($m, 0, 4);
			$my_month = $wp_locale->get_month(substr($m, 4, 2));
			$my_day = intval(substr($m, 6, 2));
			$title = $my_year . ($my_month ? $my_month : '') . ($my_day ? $my_day : '');
		}

		// If there's a year
		if (is_archive() && !empty($year)) {
			$title = $year;
			if (!empty($monthnum)) {
				$title .= ' ' . $wp_locale->get_month($monthnum);
			}
			if (!empty($day)) {
				$title .= ' ' . zeroise($day, 2);
			}
		}

		// If it's a search
		if (is_search()) {
			/* translators: 1: separator, 2: search phrase */
			$title = esc_html__('Search Results', 'studiare');
		}

		// If it's a 404 page
		if (is_404()) {
			$title = esc_html__('Page not found', 'studiare');
		}

		if ($display) {
			echo esc_html($title);
		} else {
			return esc_html($title);
		}
	}
}


// Studiare Breadcrumbs
if ( ! function_exists( 'studiare_breadcrumbs' ) ) {
    function studiare_breadcrumbs() {
	    $prefix = '_studiare_';

        if ( function_exists( 'bcn_display' ) && ! get_post_meta(get_the_ID(), $prefix . 'disable_breadcrumbs', true) ) { ?>
            <div class="breadcrumbs">
		        <?php bcn_display(); ?>
            </div>
        <?php }
    }
}

// Studiare Metaboxes
add_action( 'cmb2_admin_init', 'studiare_metaboxes' );

function studiare_metaboxes() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_studiare_';

	$studiare_metaboxes = new_cmb2_box( array(
		'id'           => 'page_metabox',
		'title'        => esc_html__( 'Page Settings', 'studiare' ),
		'object_types' => array( 'page', 'post' ),
		'context'      => 'normal',
		'priority'     => 'high',
		'show_names'   => true,
	) );

	$studiare_metaboxes->add_field( array(
		'name' => esc_html__( 'Disable Page title', 'studiare' ),
		'desc' => esc_html__( 'You can hide page heading for this page', 'studiare' ),
		'id'   => $prefix . 'disable_title',
		'type' => 'checkbox',
	) );

	$studiare_metaboxes->add_field( array(
		'name' => esc_html__( 'Disable breadcrumbs', 'studiare' ),
		'desc' => esc_html__( 'You can hide breadcrumbs for this page', 'studiare' ),
		'id'   => $prefix . 'disable_breadcrumbs',
		'type' => 'checkbox',
	) );

	$studiare_metaboxes->add_field( array(
		'name' => esc_html__( 'Disable footer widgets', 'studiare' ),
		'desc' => esc_html__( 'You can disable footer widgets area for this page', 'studiare' ),
		'id'   => $prefix . 'footer_off',
		'type' => 'checkbox',
	) );

	$studiare_metaboxes->add_field( array(
		'name' => esc_html__( 'Disable sub-footer', 'studiare' ),
		'desc' => esc_html__( 'You can disable sub-footer for this page', 'studiare' ),
		'id'   => $prefix . 'copyrights_off',
		'type' => 'checkbox',
	) );

	$studiare_metaboxes->add_field( array(
		'name' => esc_html__( 'Disable top-bar', 'studiare' ),
		'desc' => esc_html__( 'You can disable top-bar for this page', 'studiare' ),
		'id'   => $prefix . 'top_bar_off',
		'type' => 'checkbox',
	) );

	$courses_metaboxes = new_cmb2_box( array(
	    'id'           => 'product_metabox',
        'title'        => esc_html__( 'Course Details', 'studiare' ),
        'object_types' => array( 'product' ),
        'context'      => 'normal',
        'priority'     => 'core',
        'show_names'   => true,
    ) );


    $courses_metaboxes->add_field( array(
        'name' => esc_html__( 'Teacher', 'studiare' ),
        'desc' => esc_html__( 'Select teacher for this course', 'studiare' ),
//        'default' => '',
        'id' => $prefix . 'course_teacher',
        'type' => 'select',
        'options' => studiare_get_teachers_list()
    ) );

	$courses_metaboxes->add_field( array(
		'name' => esc_html__( 'Duration', 'studiare' ),
		'desc' => esc_html__( 'Duration of course in hours', 'studiare' ),
		'default' => '7 hours on-demand video',
		'id'   => $prefix . 'course_duration',
		'type' => 'text',
    ) );

	$courses_metaboxes->add_field( array(
		'name' => esc_html__( 'Lessons', 'studiare' ),
		'desc' => esc_html__( 'Number of lessons included on course', 'studiare' ),
		'default' => '11 Lessons',
		'id'   => $prefix . 'course_lesseons',
		'type' => 'text',
	) );

	$courses_metaboxes->add_field( array(
		'name' => esc_html__( 'Certifitcate', 'studiare' ),
		'id'   => $prefix . 'course_certificate',
		'type' => 'text',
        'default' => 'Certificate of Completion'
	) );

	$courses_metaboxes->add_field( array(
		'name' => esc_html__( 'Skill Level', 'studiare' ),
		'id'   => $prefix . 'course_level',
		'type' => 'text',
        'default' => 'Intermediate'
	) );

	$courses_metaboxes->add_field( array(
		'name' => esc_html__( 'Language', 'studiare' ),
		'id'   => $prefix . 'course_language',
		'type' => 'text',
		'default' => 'English'
	) );

	$courses_metaboxes->add_field( array(
        'name' => esc_html__( 'Intro Video URL', 'studiare' ),
        'desc' => esc_html__( 'Supports 3 types of video urls: Direct video link, Youtube link, Vimeo link.', 'studiare' ),
        'id'   => $prefix . 'course_video',
        'type' => 'text',
        'default' => ''
    ) );

	$courses_metaboxes->add_field( array(
	    'name' => esc_html__( 'URL', 'studiare' ),
        'id' => $prefix . 'woo_course_url',
        'type' => 'text',
	    'default' => ''
    ) );

	$courses_metaboxes->add_field( array(
		'name' => esc_html__( 'Button text', 'studiare' ),
		'id' => $prefix . 'woo_course_label',
		'type' => 'text',
		'default' => ''
	) );

}

// Needs Header
if ( ! function_exists( 'studiare_needs_header' ) ) {
    function studiare_needs_header() {
	    return ( ! studiare_maintenance_page() );
    }
}

// Needs Footer
if( ! function_exists( 'studiare_needs_footer' ) ) {
	function studiare_needs_footer() {
		return ( ! studiare_maintenance_page() );
	}
}

// Is maintenance page
if( ! function_exists( 'studiare_maintenance_page' ) ) {
	function studiare_maintenance_page() {

		$pages_ids = studiare_pages_ids_from_template( 'maintenance' );

		if( ! empty( $pages_ids ) && is_page( $pages_ids ) ) {
			return true;
		}

		return false;
	}
}

// Get page id by template name
if( ! function_exists( 'studiare_pages_ids_from_template' ) ) {
	function studiare_pages_ids_from_template( $name ) {
		$pages = get_pages(array(
			'meta_key' => '_wp_page_template',
			'meta_value' => $name . '.php'
		));

		$return = array();

		foreach($pages as $page){
			$return[] = $page->ID;
		}

		return $return;
	}
}

// Function that echoes generated style attributes
function studiare_inline_style($value) {
	echo studiare_get_inline_style($value);
}

// Function that generates style attribute and returns generated string
function studiare_get_inline_style($value) {
	return studiare_get_inline_attr($value, 'style', ';');
}

// Generate multiple inline attributes
function studiare_get_inline_attrs($attrs) {
	$output = '';

	if(is_array($attrs) && count($attrs)) {
		foreach($attrs as $attr => $value) {
			$output .= ' '.studiare_get_inline_attr($value, $attr);
		}
	}

	$output = ltrim($output);

	return $output;
}

// Function that echoes class attribute
function studiare_class_attribute($value) {
	echo studiare_get_class_attribute($value);
}

// Function that returns generated class attribute
function studiare_get_class_attribute($value) {
	return studiare_get_inline_attr($value, 'class', ' ');
}

// Function that generates html attribute
function studiare_get_inline_attr($value, $attr, $glue = '') {
	if(!empty($value)) {

		if(is_array($value) && count($value)) {
			$properties = implode($glue, $value);
		} elseif($value !== '') {
			$properties = $value;
		}

		return $attr.'="'.esc_attr($properties).'"';
	}

	return '';
}


/**
 * Allow SVG Upload
 */
if( ! function_exists( 'studiare_allow_svg_upload' ) ) {
	add_filter( 'upload_mimes', 'studiare_allow_svg_upload', 100, 1 );
	function studiare_allow_svg_upload( $mimes ) {
		$mimes['svg'] = 'image/svg+xml';
		$mimes['svgz'] = 'image/svg+xml';
		return $mimes;
	}
}

/**
 * Codebean add shortcode
 */
if ( ! function_exists('codebean_add_short') ) {
	function codebean_add_short( $name, $call ) {
		$func = 'add' . '_shortcode';
		return $func( $name, $call );
	}
}

/**
 * Returns array of font weights
 */
function studiare_get_font_weight_array($first_empty = false) {
	$font_weights = array();

	if ($first_empty) {
		$font_weights[''] = '';
	}

	$font_weights['100'] = esc_html__('Thin 100', 'studiare');
	$font_weights['200'] = esc_html__('Extra-Light 200', 'studiare');
	$font_weights['300'] = esc_html__('Light 300', 'studiare');
	$font_weights['400'] = esc_html__('Regular 400', 'studiare');
	$font_weights['500'] = esc_html__('Medium 500', 'studiare');
	$font_weights['600'] = esc_html__('Semi-Bold 600', 'studiare');
	$font_weights['700'] = esc_html__('Bold 700', 'studiare');
	$font_weights['800'] = esc_html__('Extra-Bold 800', 'studiare');
	$font_weights['900'] = esc_html__('Ultra-bold 900', 'studiare');

	return $font_weights;
}


/**
 * Returns array of text transforms
 */
function studiare_get_text_transform_array($first_empty = false) {
	$text_transforms = array();

	if ($first_empty) {
		$text_transforms[''] = '';
	}

	$text_transforms['none'] = esc_html__( 'None', 'studiare' );
	$text_transforms['capitalize'] = esc_html__( 'Capitalize', 'studiare' );
	$text_transforms['uppercase'] = esc_html__( 'Uppercase', 'studiare' );
	$text_transforms['lowercase'] = esc_html__( 'Lowercase', 'studiare' );

	return $text_transforms;
}


/**
 * Enable Support For Plugins Check in Multisite Setup
 */
function codebean_is_plugin_active_for_network( $plugin ) {
	if ( !is_multisite() )
		return false;

	$plugins = get_site_option( 'active_sitewide_plugins');
	if ( isset($plugins[$plugin]) )
		return true;

	return false;
}

/**
 * Escape script tag
 */
function codebean_esc_script( $str = '' ) {
	$str = str_ireplace( array( '<script', '</script>' ), array( '&lt;script', '&lt;/script&gt;' ), $str );
	return $str;
}

/**
 * Studiare WP Link Pages
 */
function studiare_wp_link_pages() {
	$defaults = array(
		'before'           => '<div class="page-numbers studiare_wp_link_pages">',
		'after'            => '</div>',
		'link_before'      => '<div class="page-number">',
		'link_after'       => '</div>',
		'next_or_number'   => 'number',
		'separator'        => ' ',
		'nextpagelink'     => esc_html__('Next page', 'studiare'),
		'previouspagelink' => esc_html__('Previous page', 'studiare'),
		'pagelink'         => '%',
		'echo'             => 1
	);

	wp_link_pages($defaults);
}

/**
 * Kses Image Attributes
 */
function codebean_kses_img($content) {
	$img_atts = apply_filters('codebean_kses_img_atts', array(
		'src'    => true,
		'alt'    => true,
		'height' => true,
		'width'  => true,
		'class'  => true,
		'id'     => true,
		'title'  => true
	));

	return wp_kses($content, array(
		'img' => $img_atts
	));
}

/**
 * Codebean Get Config
 */
if( ! function_exists( 'codebean_get_config' ) ) {
	function codebean_get_config( $name ) {
		$path = get_parent_theme_file_path ('inc/codebean_' . $name . '.php');
		if( file_exists( $path ) ) {
			return include $path;
		} else {
			return array();
		}
	}
}

/**
 * Text to on line text
 */
if( ! function_exists( 'studiare_text2line')) {
	function studiare_text2line( $str ) {
		return trim(preg_replace("/('|\"|\r?\n)/", '', $str));
	}
}

/**
 * Redux Related Functions
 */
function codebean_remove_demo_mode_link() {
	if ( class_exists('ReduxFrameworkPlugin') ) {
		remove_filter( 'plugin_row_meta', array( ReduxFrameworkPlugin::get_instance(), 'plugin_metalinks'), null, 2 );
	}
	if ( class_exists('ReduxFrameworkPlugin') ) {
		remove_action('admin_notices', array( ReduxFrameworkPlugin::get_instance(), 'admin_notices' ) );
	}
}
add_action( 'init', 'codebean_remove_demo_mode_link');

function codebean_remove_redux_menu() {
	remove_submenu_page('tools.php','redux-about');
}
add_action( 'admin_menu', 'codebean_remove_redux_menu', 12 );

/**
 * Check if WooCommerce is Active
 */
if( ! function_exists( 'studiare_woocommerce_installed' ) ) {
	function studiare_woocommerce_installed() {
		return class_exists( 'WooCommerce' );
	}
}

/**
 * Conditional Tags
 */
if( ! function_exists( 'studiare_is_shop_archive' ) ) {
	function studiare_is_shop_archive() {
		return ( studiare_woocommerce_installed() && ( is_shop() || is_product_category() || is_product_tag() || is_singular( "product" ) || studiare_is_product_attribute_archieve() ) );
	}
}