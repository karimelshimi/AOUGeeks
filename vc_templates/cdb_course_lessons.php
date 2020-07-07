<?php

// Atts
if ( function_exists( 'vc_map_get_attributes' ) ) {
	$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
}

extract( $atts );

// Element Class
$class = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class, $this->settings['base'], $atts );

$css_class = "course-section";

?>
<div class="<?php echo esc_attr( $css_class ) . vc_shortcode_custom_css_class($css, ' '); ?>">
	<?php if(!empty($title)): ?>
        <h5 class="course-section-title"><?php echo esc_attr($title); ?></h5>
	<?php endif; ?>
    <div class="panel-group">
	    <?php echo wpb_js_remove_wpautop($content); ?>
    </div>
</div>
