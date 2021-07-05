<?php defined( 'ABSPATH' ) or die( '-1' );

/**
 * Shortcode attributes
 * @var atts {
 *     $title
 *     $desc
 *     $subtitle
 *     $subtitle_text
 *     $subtitle_pos
 *     $add_icon
 *     $text_icon
 *     $i_
 *     $img_
 *     $add_btn
 *     $link
 *     $btn_
 *     $color_scheme
 *     $el_class
 *     $template
 * }
 */

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
$fancybox_classes = array(
    'cms-fancybox-texticon',
    'cms-fancybox-color-' . $atts['color_scheme']
);

$fancybox_classes = implode( ' ', $fancybox_classes );

$class_to_filter = vc_shortcode_custom_css_class( $atts['css'], ' ' ) . $this->getExtraClass( $atts['el_class'] ) . $this->getCSSAnimation( $atts['css_animation'] );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );

$icon_html = $header_html = $content_html = '';
$icon_color = $title_color = $subtitle_color = $text_color = $link_color = $background_color = '';

if ( 'custom' == $atts['color_scheme'] ) {
    $icon_color = empty( $atts['color_icon'] ) ? '' : ' style="color:' . esc_attr( $atts['color_icon'] ) . ';"';
    $title_color = empty( $atts['color_title'] ) ? '' : ' style="color:' . esc_attr( $atts['color_title'] ) . ';"';
    $subtitle_color = empty( $atts['color_subtitle'] ) ? '' : ' style="color:' . esc_attr( $atts['color_subtitle'] ) . ';"';
    $text_color = empty( $atts['color_text'] ) ? '' : ' style="color:' . esc_attr( $atts['color_text'] ) . ';"';
    $link_color = empty( $atts['color_link'] ) ? '' : ' style="color:' . esc_attr( $atts['color_link'] ) . ';"';
    $background_color = empty( $atts['color_bg'] ) ? '' : ' style="background-color:' . esc_attr( $atts['color_bg'] ) . ';"';
}

$icon_html = esc_html( $atts['text_icon'] );

if ( '' != $icon_html ) {
    vc_icon_element_fonts_enqueue( $atts['i_type'] );
}

if ( ! empty( $atts['subtitle'] ) ) {
    $header_html .= '<h6 class="fancybox-subtitle"' . $subtitle_color . '>' . esc_html( $atts['subtitle'] ) . '</h6>';
}
if ( ! empty( $atts['title'] ) ) {
    $header_html .= '<h3 class="fancybox-title">' .
                        '<span class="fancybox-icon color-primary"' . $icon_color . '>' . $icon_html . '</span>' .
                        '<span class="fancybox-title-text"' . $title_color . '>' . esc_html( $atts['title'] ) . '</span>' .
                    '</h3>';
}

$content_html = empty( $atts['description'] ) ? '' : esc_html( $atts['description'] );

$action_html = '';

if ( $atts['add_btn'] == 'button' ) {
    $btn_data = vc_map_integrate_parse_atts( $this->shortcode, 'cms_btn', $atts, 'btn_' );
    if ( $btn_data ) {
        $action_html = visual_composer()->getShortCode( 'cms_btn' );
        if ( is_object( $action_html ) ) {
            $action_html = $action_html->render( array_filter( $btn_data ) );
        }
    }
}
if ( $atts['add_btn'] == 'link' ) {
    $link = array();
    $atts['link'] = ( $atts['link'] == '||' ) ? '' : $atts['link'];
    $atts['link'] = vc_build_link( $atts['link'] );

    if ( '' !== $atts['link']['url'] ) {
        $link['href'] = esc_url( $atts['link']['url'] );
        $link['title'] = esc_attr( $atts['link']['title'] );
        $link['target'] = ( '' !== $atts['link']['target'] ? esc_url( $atts['link']['target'] ) : '_self' );
        $action_html = '<a class="fancybox-link link-underline"' .
                            ' href="' . $link['href'] . '"' .
                            ' title="' . $link['title'] . '"' .
                            ' target="' . $link['target'] . '"' . $link_color . '>' . 
                            $link['title'] . 
                            '<i class="fa fa-long-arrow-right"></i>' .
                        '</a>';
    }
} ?>
<div class="cms-fancybox-wrapper<?php echo esc_attr( $css_class ); ?>">
    <div class="cms-fancybox<?php echo empty( $fancybox_classes ) ? '' : ' ' . esc_attr( $fancybox_classes ); ?>"<?php echo $background_color; ?>>
        <div class="fancybox-body">
            <div class="fancybox-header">
                <?php echo $header_html; ?>
            </div>
            <div class="fancybox-content"<?php echo $text_color; ?>>
                <?php echo $content_html; ?>
            </div>
        </div>
        <?php if ( ! empty( $action_html ) ) : ?>
        <div class="fancybox-action">
            <?php echo $action_html; ?>
        </div>
        <?php endif; ?>
    </div>
</div>