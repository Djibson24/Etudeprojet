<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

/**
 * Shortcode class
 * @var $this WPMetrics_Social_Widget
 */
$title = $icon_style = $alignment = $el_class = $css = '';
$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );

$atts['icons'] = $this->get_icons( $atts );

$el_class = vc_shortcode_custom_css_class( $css, ' ' ) . $this->getExtraClass( $el_class );

$output = '<div class="cms_social wpb_content_element' . esc_attr( $el_class ) . '">';
$type = 'WPMetrics_Social_Widget';
$args = array(
    'before_widget' => '<section class="widget %1$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h4 class="widget-title">',
    'after_title'   => '<span class="cms-divider divider-horizontal"><span class="divider-line-1">-</span><span class="divider-line-2">-</span><span class="divider-line-3">-</span></span></h4>',
);
global $wp_widget_factory;
// to avoid unwanted warnings let's check before using widget
if ( is_object( $wp_widget_factory ) && isset( $wp_widget_factory->widgets, $wp_widget_factory->widgets[ $type ] ) ) {
    ob_start();
    the_widget( $type, $atts, $args );
    $output .= ob_get_clean();
} else {
    echo $this->debugComment( 'Widget ' . esc_attr( $type ) . 'Not found in : cms_social' );
}

printf( '<div class="cms_social wpb_content_element%s">%s</div>', esc_attr( $el_class ), $output );