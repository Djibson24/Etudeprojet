<?php defined( 'ABSPATH' ) or exit();
/**
 * Shortcode Attributes
 *
 * @var $subtitle_pos
 * @var $collapse
 * @var $images
 * @var $img_size
 * @var $featuredimg_
 * @var $title
 * @var $subtitle
 * @var $link
 */
$subtitle_pos = $collapse = $images = $img_size = $featuredimg_image = $featuredimg_img_size = $title = $subtitle = $link = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );

extract( $atts );

$class_to_filter = 'cms-slider-item-case-study';

$class_to_filter .= $this->getExtraClass( $atts['el_class'] );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );

$col_class = isset( $atts['collapse'] ) && '' != $atts['collapse'] ? $atts['collapse'] : 'vc_col-md-6';
$col_class .= ' vc_column_container';

$featured_img_data = vc_map_integrate_parse_atts( $this->shortcode, 'vc_single_image', $atts, 'featuredimg_' );
$featured_img = '';
$featured_thumbnail = '';
if ( $featured_img_data ) {
    $featured_img_sc = visual_composer()->getShortCode( 'vc_single_image' );
    if ( is_object( $featured_img_sc ) ) {
        $featured_img = $featured_img_sc->render( array_filter( $featured_img_data ) );
        $featured_img_data['img_size'] = 'medium';
        $featured_thumbnail = $featured_img_sc->render( array_filter( $featured_img_data ) );
    }
}

$title_html = $subtitle_html = $action_html = '';
$title_style = $subtitle_style = $action_style = $desc_style = '';
if ( ! empty( $title ) ) {
    $title_style = empty( $color_title ) ? '' : ' style="color:' . esc_attr( $color_title ) . '"';
    $title_html = '<h2 class="title"'. $title_style . '>' . $title . '</h2>';
}
if ( ! empty( $subtitle ) ) {
    $subtitle_style = empty( $color_title ) ? '' : ' style="color:' . esc_attr( $color_subtitle ) . '"';
    $subtitle_html = '<h6 class="subtitle"'. $subtitle_style . '>' . $subtitle . '</h6>';
}

if ( $atts['add_link'] == 'button' ) {
    $btn_data = vc_map_integrate_parse_atts( $this->shortcode, 'cms_btn', $atts, 'btn_' );
    if ( $btn_data ) {
        $action_html = visual_composer()->getShortCode( 'cms_btn' );
        if ( is_object( $action_html ) ) {
            $action_html = $action_html->render( array_filter( $btn_data ) );
        }
    }
}
if ( $atts['add_link'] == 'link' ) {
    $link = array();
    $atts['link'] = ( $atts['link'] == '||' ) ? '' : $atts['link'];
    $atts['link'] = vc_build_link( $atts['link'] );

    if ( '' !== $atts['link']['url'] ) {
        $action_style = empty( $color_link ) ? '' : ' style="color:' . esc_attr( $color_link ) . '"';
        $link['url'] = esc_url( $atts['link']['url'] );
        $link['title'] = esc_attr( $atts['link']['title'] );
        $link['target'] = ( '' !== $atts['link']['target'] ? esc_url( $atts['link']['target'] ) : '_self' );
        $action_html = '<a class="link-underline" href="' . $link['url'] . '" title="' . $link['title'] . '" target="' . $link['target'] . '"' . $action_style . '><strong>' . $link['title'] . '</strong> <i class="fa fa-long-arrow-right"></i></a>';
    }
}

if ( '' != $action_html ) {
    $action_html = '<div class="item-action">' . $action_html . '</div>';
}

$desc_style = empty( $color_desc ) ? '' : ' style="color:' . esc_attr( $color_desc ) . '"';
if ( '' === $atts['images'] ) {
    $atts['images'] = '-1,-2,-3';
}
$images = explode( ',', $atts['images'] );
$img_size = isset( $atts['img_size'] ) ? $atts['img_size'] : 'thumbnail';
?>
<div class="slider-item-thumbnail slider-item-thumbnail-top">
    <?php echo wp_kses_post( $featured_thumbnail ); ?>
</div>
<div class="<?php echo esc_attr( $css_class ); ?>">
    <div class="<?php echo esc_attr( $col_class ); ?> column-fill-place">
        <div class="vc_column-inner">
            <div class="case-study-slider-item-featured">
                <?php echo wp_kses_post( $featured_img ); ?>
            </div>
        </div>
    </div>
    <div class="<?php echo esc_attr( $col_class ); ?> ">
        <div class="vc_column-inner">
            <div class="case-study-slider-item-content">
                <div class="item-header"><?php
                    if ( 'top' === $subtitle_pos ) {
                        echo $subtitle_html; echo $title_html;
                    }
                    else {
                        echo $title_html; echo $subtitle_html;
                    }
                ?></div>
                <div class="item-description"<?php echo $desc_style; ?>>
                <?php echo wpb_js_remove_wpautop( $content, true ); ?>
                </div>
                <?php echo $action_html; ?>
                <div class="item-images"><?php
                    foreach ( $images as $key => $attach_id ) {
                        if ( $attach_id > 0 ) {
                            $post_thumbnail = wpb_getImageBySize( array(
                                'attach_id' => $attach_id,
                                'thumb_size' => $img_size,
                            ) );
                        } else {
                            $post_thumbnail = array();
                            $post_thumbnail['thumbnail'] = '<img src="' . vc_asset_url( 'vc/no_image.png' ) . '" />';
                            $post_thumbnail['p_img_large'][0] = vc_asset_url( 'vc/no_image.png' );
                        }
                        $thumbnail = $post_thumbnail['thumbnail'];
                        echo '<div class="item-image">' . $thumbnail . '</div>';
                    }
                ?></div>
            </div>
        </div>
    </div>
</div>
<div class="slider-item-thumbnail slider-item-thumbnail-bottom">
    <?php echo $featured_thumbnail; ?>
</div>