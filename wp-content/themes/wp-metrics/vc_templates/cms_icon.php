<?php defined( 'ABSPATH' ) or exit();
/**
 * Template for cms_icon
 */
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );

$class_to_filter = vc_shortcode_custom_css_class( $atts['css'], ' ' ) . $this->getExtraClass( $atts['el_class'] ) . $this->getCSSAnimation( $atts['css_animation'] );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );
$css_class .= empty( $atts['align'] ) ? '' : ' ' . $atts['align'];

// Enqueue needed icon font.
vc_icon_element_fonts_enqueue( $atts['type'] );

$link = vc_build_link( $atts['link'] );

$iconClass = isset( $atts["icon_${atts['type']}"] ) ? esc_attr( $atts["icon_${atts['type']}"] ) : 'fa fa-adjust';

$icon_styles = $title_styles = array();
$link_html = $link_color = '';

if ( ! empty( $atts['color_icon'] ) && wpmetrics_validate_color( $atts['color_icon'] ) ) {
    $icon_styles[] = 'color:' . esc_attr( $atts['color_icon'] );
}
if ( ! empty( $atts['color_title'] ) && wpmetrics_validate_color( $atts['color_title'] ) ) {
    $title_styles[] = 'color:' . esc_attr( $atts['color_title'] );
}
if ( ! empty( $atts['color_link'] ) && wpmetrics_validate_color( $atts['color_link'] ) ) {
    $link_color = ' style="color:' . esc_attr( $atts['color_link'] ) . '"';
}
if ( ! empty( $atts['size_icon'] ) && wpmetrics_validate_css_unit( $atts['size_icon'] ) ) {
    if ( false !== strrpos( $atts['size_icon'], 'px' ) ) {
        $icon_styles[] = 'font-size:' . esc_attr( $atts['size_icon'] );
    }
    else {
        $icon_styles[] = 'font-size:' . esc_attr( $atts['size_icon'] ) . 'px';
    }
        
}
if ( ! empty( $atts['size_title'] ) && wpmetrics_validate_css_unit( $atts['size_title'] ) ) {
    if ( false !== strrpos( $atts['size_icon'], 'px' ) ) {
        $title_styles[] = 'font-size:' . esc_attr( $atts['size_title'] );
    }
    else {
        $title_styles[] = 'font-size:' . esc_attr( $atts['size_title'] ) . 'px';
    }
}

$icon_styles = empty( $icon_styles ) ? '' : ' style="' . esc_attr( implode( ';', $icon_styles ) ) . '"';
$title_styles = empty( $title_styles ) ? '' : ' style="' . esc_attr( implode( ';', $title_styles ) ) . '"';

$icon_html = '<i class="cms-icon ' . esc_attr( $iconClass ) . '"' . $icon_styles . '></i>';

if ( ! empty( $atts['link'] ) && ! empty( $link['url'] ) ) {
    if ( ! empty( $atts['link_alone'] ) ) {
        $link_html = '<a class="icon-link link-underline" href="' . esc_attr( $link['url'] ) . 
                '" title="' . esc_attr( $link['title'] ) . 
                '" target="' . ( ! empty( $link['target'] ) ? esc_attr( $link['target'] ) : '_self' ) . '"' .
                $link_color .
                '>' .
                $link['title'] . '&nbsp;&nbsp;<i class="fa fa-long-arrow-right"></i>' .
            '</a>';
    }
    else {
        $icon_html = '<a class="icon-link" href="' . esc_attr( $link['url'] ) . 
            '" title="' . esc_attr( $link['title'] ) . 
            '" target="' . ( ! empty( $link['target'] ) ? esc_attr( $link['target'] ) : '_self' ) . '">' .
            $icon_html .
        '</a>';
    }
}
$link_html = empty( $link_html ) ? '' : '<div class="icon-link-block">' . $link_html . '</div>';
echo '<div class="cms-icon-box-wrapper' . esc_attr( $css_class ) . '">';
echo    '<div class="cms-icon-box">';
echo        empty( $icon_html ) ? '' : '<div class="icon-content">' . $icon_html . '</div>';
echo        empty( $atts['title'] ) ? '' : '<h4 class="icon-title"' . $title_styles . '>' . $atts['title'] . '</h4>';
echo        $link_html;
echo    '</div>';
echo '</div>';
