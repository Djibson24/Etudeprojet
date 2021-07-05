<?php defined( 'ABSPATH' ) or die( '-1' );
/**
 * Fancy box element for Visual Composer
 * 
 * Shortcode attributes
 * @var $title
 * @var $subtitle
 * @var $description
 * @var $add_icon
 * @var $text_icon
 * @var $i_
 * @var $img_
 * @var $add_btn
 * @var $link
 * @var $color_link
 * @var $btn_
 * @var $color_scheme
 * @var $color_icon
 * @var $color_title
 * @var $color_subtitle
 * @var $color_text
 * @var $css_animation
 * @var $el_class
 * @var $css
 */

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );

$fancybox_classes = array(
    'cms-fancybox-left-icon-box',
    'cms-fancybox-color-' . $atts['color_scheme']
);

$icon_html = $header_html = $content_html = $icon_styles = $title_styles = $subtitle_styles = $text_styles = $link_styles = '';

if ( 'custom' === $atts['color_scheme'] ) {
    $icon_styles = array();
    if ( ! empty( $atts['color_icon'] ) ) {
        $icon_styles[] = 'color:' . $atts['color_icon'];
    }
    if ( ! empty( $atts['color_icon_bg'] ) ) {
        $icon_styles[] = 'background-color:' . $atts['color_icon_bg'];
    }
    $icon_styles = empty( $icon_styles ) ? '' : ' style="' . esc_attr( implode( ';', $icon_styles ) ) . '"';
    $title_styles = empty( $atts['color_title'] ) ? '' : ' style="color:' . esc_attr( $atts['color_title'] ) . '"';
    $subtitle_styles = empty( $atts['color_subtitle'] ) ? '' : ' style="color:' . esc_attr( $atts['color_subtitle'] ) . '"';
    $text_styles = empty( $atts['color_text'] ) ? '' : ' style="color:' . esc_attr( $atts['color_text'] ) . '"';
}

switch ( $atts['add_icon'] ) {
    // Icon font as icon
    case 'symbol':
        $icon_class = 'fa fa-adjust';
        if ( isset( $atts[ "i_icon_" . $atts['i_type'] ] ) ) {
            $icon_class = $atts[ "i_icon_" . esc_attr( $atts['i_type'] ) ];
        }
        $icon_html = '<i class="' . esc_attr( $icon_class ) . '"></i>';
        break;

    // Image as icon
    case 'image':
        $img_data = vc_map_integrate_parse_atts( $this->shortcode, 'vc_single_image', $atts, 'img_' );
        if ( $img_data ) {
            $fancybox_image = visual_composer()->getShortCode( 'vc_single_image' );
            if ( is_object( $fancybox_image ) ) {
                $fancybox_image = $fancybox_image->render( array_filter( $img_data ) );
            }
        }
        if ( '' !== $fancybox_image ) {
            $icon_html = $fancybox_image;
        }
        break;

    // Text as icon
    case 'text':
        $icon_html = esc_html( $atts['text_icon'] );
        break;

    // Default to none
    default:
        break;
}

$class_to_filter = vc_shortcode_custom_css_class( $atts['css'], ' ' ) . $this->getExtraClass( $atts['el_class'] ) . $this->getCSSAnimation( $atts['css_animation'] );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );

switch ( $atts['add_icon'] ) {
    // Icon font as icon
    case 'symbol':
        $icon_class = 'fa fa-adjust';
        if ( isset( $atts[ "i_icon_" . $atts['i_type'] ] ) ) {
            $icon_class = $atts[ "i_icon_" . esc_attr( $atts['i_type'] ) ];
        }
        $icon_html = '<i class="' . esc_attr( $icon_class ) . '"></i>';
        break;

    // Image as icon
    case 'image':
        $img_data = vc_map_integrate_parse_atts( $this->shortcode, 'vc_single_image', $atts, 'img_' );
        if ( $img_data ) {
            $fancybox_image = visual_composer()->getShortCode( 'vc_single_image' );
            if ( is_object( $fancybox_image ) ) {
                $fancybox_image = $fancybox_image->render( array_filter( $img_data ) );
            }
        }
        if ( '' !== $fancybox_image ) {
            $icon_html = $fancybox_image;
        }
        break;

    // Text as icon
    case 'text':
        $icon_html = esc_html( $atts['text_icon'] );
        break;

    // Default to none
    default:
        break;
}

if ( '' != $icon_html ) {
    vc_icon_element_fonts_enqueue( $atts['i_type'] );
}

if ( ! empty( $atts['title'] ) ) {
    $header_html .= '<h4 class="fancybox-title"' . $title_styles . '>' . esc_html( $atts['title'] ) . '</h4>';
}
if ( ! empty( $atts['subtitle'] ) ) {
    $header_html .= '<h6 class="fancybox-subtitle"' . $subtitle_styles . '>' . esc_html( $atts['subtitle'] ) . '</h6>';
}

$content_html = empty( $atts['description'] ) ? '' : esc_html( $atts['description'] );

$action_html = '';

if ( $atts['add_btn'] == 'btn' ) {
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

    $link_styles = empty( $atts['color_link'] ) ? '' : ' style="color:' . esc_attr( $atts['color_link'] ) . '"';

    if ( '' !== $atts['link']['url'] ) {
        $link['url'] = esc_url( $atts['link']['url'] );
        $link['title'] = esc_attr( $atts['link']['title'] );
        $link['target'] = ( '' !== $atts['link']['target'] ? esc_url( $atts['link']['target'] ) : '_self' );
        $action_html = '<a class="fancybox-link link-underline" href="' . $link['url'] . '" title="' . $link['title'] . '" target="' . $link['target'] . '"' . $link_styles . '>' . 
            $link['title'] . '<i class="fa fa-long-arrow-right"></i></a>';
    }
}

$fancybox_classes = implode( ' ', $fancybox_classes );
?>
<div class="cms-fancybox-wrapper<?php echo esc_attr( $css_class ); ?>">
    <div class="cms-fancybox<?php echo empty( $fancybox_classes ) ? '' : ' ' . esc_attr( $fancybox_classes ); ?>">
        <div class="fancybox-body">
            <div class="fancybox-icon"<?php echo $icon_styles; ?>><?php echo $icon_html; ?></div>
            <div class="fancybox-header">
                <?php echo $header_html; ?>
            </div>
            <div class="fancybox-content"<?php echo $text_styles; ?>>
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
