<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $title
 * @var $text
 * @var $el_class
 * Shortcode class
 * @var $this NewsletterWidget
 */
$title = $number = $show_date = $show_category = $show_author = $show_sticky = $el_class = '';
$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
$atts['text'] = wpb_js_remove_wpautop( $atts['text'], true );
extract( $atts );

$el_class = vc_shortcode_custom_css_class( $css, ' ' ) . $this->getExtraClass( $el_class );

$output = '<div class="vc_wp_newsletter wpb_content_element' . esc_attr( $el_class ) . '">';
$type = 'NewsletterWidget';
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

    $output .= '</div>';

    echo $output;
} else {
    echo $this->debugComment( 'Widget ' . esc_attr( $type ) . 'Not found in : vc_wp_newsletter' );
}

