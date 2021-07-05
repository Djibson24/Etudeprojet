<?php defined( 'ABSPATH' ) or exit();
/**
 * @var $title
 * @var $subtitle
 * @var $subtitle_pos
 * @var $add_icon
 * @var $i_
 * @var $add_button
 * @var $add_extra_button
 * @var $button_1_
 * @var $button_2_
 * @var $color_title
 * @var $color_subtitle
 * @var $color_text
 * @var $color_icon
 * @var $css_animation
 * @var $el_class
 * @var $cms_template
 * @var $css
 */
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );

$class_to_filter = array(
    'cms-cta-box-wrapper',
    'cms-cta-box-icon-' . $atts['add_icon'],
    'cms-cta-box-actions-' . $atts['add_button']
);
$class_to_filter = implode( ' ', array_filter( $class_to_filter ) );
$class_to_filter .= vc_shortcode_custom_css_class( $atts['css'], ' ' ) . $this->getExtraClass( $atts['el_class'] ) . $this->getCSSAnimation( $atts['css_animation'] );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );

$header_html = $title_html = $subtitle_html = $icon_html = $actions_html = $content_html = $title_style = $subtitle_style = $icon_style = $content_style = '';

$title_style = empty( $atts['color_title'] ) ? '' : ' style="color:' . esc_attr( $atts['color_title'] ) . '"';
$subtitle_style = empty( $atts['color_subtitle'] ) ? '' : ' style="color:' . esc_attr( $atts['color_subtitle'] ) . '"';

$title_html = empty( $atts['title'] ) ? '' : '<h3 class="cta-box-title"' . $title_style . '>' . esc_html( $atts['title'] ) . '</h3>';
$subtitle_html = empty( $atts['subtitle'] ) ? '' : '<h6 class="cta-box-subtitle"' . $subtitle_style . '>' . esc_html( $atts['subtitle'] ) . '</h6>';

if ( ! empty( $title_html ) || ! empty( $subtitle_html ) ) {
    $header_html = '<div class="cta-box-header">';
    if ( 'top' === $atts['subtitle_pos'] ) {
        $header_html .= $subtitle_html;
    }
    $header_html .= $title_html;
    if ( 'bottom' === $atts['subtitle_pos'] ) {
        $header_html .= $subtitle_html;
    }
    $header_html .= '</div>';
}

if ( ! empty( $atts['add_icon'] ) ) {
    $icon_class = isset( $atts['i_icon_' . $atts['i_type'] ] ) ? $atts['i_icon_' . $atts['i_type'] ] : 'fa fa-adjust';
    if ( ! empty( $atts['color_icon'] ) ) {
        $icon_style = ' style="color:' . esc_attr( $atts['color_icon'] ) . '"';
    }
    $icon_html = '<div class="cta-box-icon"' . $icon_style . '><i class="' . esc_attr( $icon_class ) . '"></i></div>';
}
if ( ! empty( $atts['add_button'] ) ) {
    $button_1_data = vc_map_integrate_parse_atts( $this->shortcode, 'cms_btn', $atts, 'button_1_' );
    $button_1 = '';
    $actions_class = ' cta-box-actions-1-button';
    if ( $button_1_data ) {
        $button_1 = visual_composer()->getShortCode( 'cms_btn' );

        if ( is_object( $button_1 ) ) {
            $button_1 = $button_1->render( array_filter( $button_1_data ) );
        }
    }
    if ( '' !== $button_1 ) {
        $actions_html .= $button_1;
    }
    if ( ! empty( $atts['add_extra_button'] ) ) {
        $button_2_data = vc_map_integrate_parse_atts( $this->shortcode, 'cms_btn', $atts, 'button_2_' );
        $button_2 = '';
        if ( $button_2_data ) {
            $button_2 = visual_composer()->getShortCode( 'cms_btn' );

            if ( is_object( $button_2 ) ) {
                $button_2 = $button_2->render( array_filter( $button_2_data ) );
            }
        }
        if ( '' !== $button_2 ) {
            $actions_html .= $button_2;
            $actions_class = ' cta-box-actions-2-buttons';
        }
    }
    $actions_html = empty( $actions_html ) ? '' : '<div class="cta-box-actions' . esc_attr( $actions_class ) .'">' . $actions_html . '</div>';
}
$content_html = wpb_js_remove_wpautop( $content, true );

$content_style = empty( $atts['color_text'] ) ? '' : ' style="color:' . esc_attr( $atts['color_text'] ) . '"';
$icon_html = empty( $icon_html ) ? '' : '<div class="cta-box-icon-wrapper">' . $icon_html . '</div>';
$actions_html = empty( $actions_html ) ? '' : '<div class="cta-box-actions-wrapper">' . $actions_html . '</div>';
$content_html = empty( $content_html ) ? '' : '<div class="cta-box-content-wrapper">' . $header_html . '<div class="cta-box-content"' . $content_style . '>' . $content_html . '</div></div>';

echo '<div class="' . esc_attr( $css_class ) . '">';
echo    '<div class="cms-cta-box">';
if ( 'top' === $atts['add_icon'] || 'left' === $atts['add_icon'] ) {
    echo    $icon_html;
}

if ( ! empty( $content_html ) ) {
    echo '<div class="cta-box-body">';
    if ( 'top' === $atts['add_button'] || 'left' === $atts['add_button'] ) {
        echo    $actions_html;
    }
    echo        $content_html;
    if ( 'bottom' === $atts['add_button'] || 'right' === $atts['add_button'] ) {
        echo    $actions_html;
    }
    echo '</div>';

}
if ( 'right' === $atts['add_icon'] || 'bottom' === $atts['add_icon'] ) {
    echo    $icon_html;
}
echo    '</div>';
echo '</div>';