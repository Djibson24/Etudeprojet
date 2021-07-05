<?php defined( 'ABSPATH' ) or exit();
/**
 * Custom heading for the theme
 *
 * Shortcode agruments
 * @var $title
 * @var $subtitle
 * @var $desc
 * @var $subtitle_pos
 * @var $sep_type
 * @var $color_title
 * @var $color_subtitle
 * @var $color_desc
 * @var $color_sep
 * @var $cms_template
 * @var $css_animation
 * @var $el_class
 * @var $css
 */

$title = $subtitle = $desc = $subtitle_pos = $sep_type = $color_title = $color_subtitle = $color_desc = $color_sep = $cms_template = $css_animation = $el_class = $css = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$allowed_html = array(
    'strong' => array(),
    'em' => array(),
    'b' => array(),
    'i' => array(),
    'u' => array(),
    'span' => array()
);

$sep_type = empty( $sep_type ) ? 'vertical' : $sep_type;

$class_to_filter = vc_shortcode_custom_css_class( $css, ' ' ) . $this->getExtraClass( $el_class ) . $this->getCSSAnimation( $css_animation );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );

$title_html = $subtitle_html = $sep_html = $desc_html = '';
$title_style = $subtitle_style = $sep_style = $desc_style = '';

if ( $color_title && wpmetrics_validate_color( $color_title ) ) {
    $title_style = ' style="color:' . esc_attr( $color_title ) . '"';
}
if ( $color_subtitle && wpmetrics_validate_color( $color_subtitle ) ) {
    $subtitle_style = ' style="color:' . esc_attr( $color_subtitle ) . '"';
}
if ( $color_sep && wpmetrics_validate_color( $color_sep ) ) {
    $sep_style = ' style="border-color:' . esc_attr( $color_sep ) . '"';
}

if ( '' != trim( $title ) ) {
    $title_inner_html = wp_kses( trim( $title ), $allowed_html );
    $title_html = '<h2 class="title"' . $title_style . '>';
    $title_html .= '<span class="title-shadow">' . $title_inner_html . '</span>';
    $title_html .= '<span class="title-text">' . $title_inner_html . '</span>';
    $title_html .='</h2>';
}

$subtitle_html = ( '' == trim( $subtitle ) ) ? '' : '<h6 class="subtitle"' . $subtitle_style . '>' . wp_kses( trim( $subtitle ), $allowed_html ) . '</h6>';

switch ( $sep_type ) {
    case 'border':
        $sep_html = '<span class="cms-heading-divider"' . $sep_style . '></span>';
        break;
    case 'horizontal':
    case 'vertical':
        $sep_html .= '<span class="cms-divider divider-' . esc_attr( $sep_type ) . '"' . $sep_style . '><span class="divider-line-1">-</span><span class="divider-line-2">-</span><span class="divider-line-3">-</span></span>';
        break;
    default:
        break;
}

if ( ! empty( $desc ) ) {
    $desc_html = '<div class="desc-block">' . wp_kses( $desc, $allowed_html ) . '</div>';
}
    

echo '<div class="cms-heading-container' . esc_attr( $css_class ) . '">';
echo    '<div class="cms-heading text-left">';
echo        '<div class="heading-block">';
if ( 'top' === $subtitle_pos ) {
    echo        $subtitle_html; 
}
echo            $title_html;
if ( 'bottom' === $subtitle_pos ) {
    echo        $subtitle_html; 
}
echo            $desc_html;
echo            $sep_html;
echo        '</div>';
echo    '</div>';
echo '</div>';