<?php defined( 'ABSPATH' ) or exit();
/**
 * Shortcode attributes
 * @var $title
 * @var $link
 * @var $type
 * @var $color
 * @var $hover_color
 * @var $size
 * @var $container
 * @var $align
 * @var $add_icon
 * @var $i_type
 * @var $i_icon_fontawesome
 * @var $i_icon_openiconic
 * @var $i_icon_typicons
 * @var $i_icon_entypo
 * @var $i_icon_linecons
 * @var $icon_align
 * @var $css_animation
 * @var $el_class
 * @var $css
 */

$title = $link = $type = $color = $hover_color = $size = $container = $align = $add_icon = $icon_align = $css_animation = $el_class = $css = '';
$a_href = $a_title = $a_target = '';
$button_html_before = $button_html_after = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$link = ( '||' === $link || empty( $link ) ) ? '' : $link;
$link = vc_build_link( $link );
$use_link = false;

if ( strlen( $link['url'] ) > 0 ) {
    $use_link = true;
    $a_href = $link['url'];
    $a_title = $link['title'];
    $a_target = empty( $link['target'] ) ? '_self' : $link['target'];
}

$button_classes = array( $type, $color, $hover_color, $size );

$button_html = $title;

if ( '' === trim( $title ) ) {
    $button_classes[] = 'btn-o-empty';
    $button_html = '<span class="btn-placeholder">&nbsp;</span>';
}

if ( 'true' === $add_icon ) {
    $button_classes[] = 'btn-icon-' . $icon_align;
    vc_icon_element_fonts_enqueue( $i_type );

    $icon_class = isset( ${'i_icon_' . $i_type} ) ? ${'i_icon_' . $i_type} : 'fa fa-adjust';
    $icon_html = '<i class="btn-icon ' . esc_attr( $icon_class ) . '"></i>';

    if ( 'left' === $icon_align ) {
        $button_html = $icon_html . ' ' . $button_html;
    } else {
        $button_html .= ' ' . $icon_html;
    }
}

if ( 'true' === $container ) {
    $wrapper_classes = array(
        'btn-container',
        vc_shortcode_custom_css_class( $css ),
        $this->getExtraClass( $el_class ),
        $this->getCSSAnimation( $css_animation )
    );
    if ( strlen( $align ) > 0 ) {
        $wrapper_classes[] = 'text-' . $align;
    }
    $wrapper_classes = empty( $wrapper_classes ) ? '' : implode( ' ', array_filter( $wrapper_classes ) );
    $button_html_before = '<div class="' . esc_attr( $wrapper_classes ) . '">';
    $button_html_after = '</div>';
}
else {
    $button_classes[] = $this->getExtraClass( $el_class );
    $button_classes[] = $this->getCSSAnimation( $css_animation );
}

$button_classes = empty( $button_classes ) ? '' : implode( ' ', array_filter( $button_classes ) );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $button_classes, $this->settings['base'], $atts );

if ( ! empty( $a_href ) ) :
    $button_html = '<a class="btn' . ( empty( $button_classes ) ? '' : ' ' . esc_attr( $button_classes ) ) .
        '" href="' . esc_url( $a_href ) . 
        '" title="' . esc_attr( $a_title ) . 
        '" target="' . esc_attr( $a_target ) . '">' .
        $button_html . 
        '</a>';
else:
    $button_html = '<button' . ( empty( $button_classes ) ? '' : ' class="' . esc_attr( $button_classes ) . '"' ) . '>' .
        $button_html .
        '</button>';
endif;

echo wp_kses_post( $button_html_before . $button_html . $button_html_after );
