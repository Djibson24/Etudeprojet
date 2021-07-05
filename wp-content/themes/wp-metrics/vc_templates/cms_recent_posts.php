<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

/**
 * Shortcode class
 * @var $this WPMetrics_Recent_Posts_Widget
 */
global $wp_widget_factory;

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );

$atts = wp_parse_args( $atts, array(
    'title' => '',
    'show_date' => '',
    'show_category' => '',
    'show_author' => '',
    'show_sticky' => '',
    'number' => 0
) );


$el_class = vc_shortcode_custom_css_class( $atts['css'], ' ' ) . $this->getExtraClass( $atts['el_class'] );
$output = '';

$atts['show_date'] = (bool)$atts['show_date'];
$atts['show_category'] = (bool)$atts['show_category'];
$atts['show_author'] = (bool)$atts['show_author'];
$atts['show_sticky'] = (bool)$atts['show_sticky'];
$atts['number'] = absint( $atts['number'] );

$type = 'WPMetrics_Recent_Posts_Widget';
$args = array(
    'before_widget' => '<section class="widget %1$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h4 class="widget-title">',
    'after_title'   => '<span class="cms-divider divider-horizontal"><span class="divider-line-1">-</span><span class="divider-line-2">-</span><span class="divider-line-3">-</span></span></h4>',
);

// to avoid unwanted warnings let's check before using widget
if ( is_object( $wp_widget_factory ) && isset( $wp_widget_factory->widgets, $wp_widget_factory->widgets[ $type ] ) ) {
    ob_start();
    the_widget( $type, $atts, $args );
    $output = ob_get_clean();
} else {
    echo $this->debugComment( 'Widget ' . esc_attr( $type ) . 'Not found in : cms_recent_posts' );
}

printf( '<div class="cms_recent_posts wpb_content_element%s">%s</div>', esc_attr( $el_class ), $output );