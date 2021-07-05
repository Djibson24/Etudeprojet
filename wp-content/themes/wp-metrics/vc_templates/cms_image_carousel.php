<?php defined( 'ABSPATH' ) or exit();

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
$class_to_filter = $css_class = $images = '';
$data_attr = $custom_links = array();

wp_enqueue_script( 'owl-carousel' );
wp_enqueue_style( 'owl-carousel' );

if ( 'link_image' === $atts['onclick'] ) {
    wp_enqueue_script( 'prettyphoto' );
    wp_enqueue_style( 'prettyphoto' );
}
if ( '' === $atts['images'] ) {
    $atts['images'] = '-1,-2,-3';
}
if ( 'custom_link' === $atts['onclick'] ) {
    $custom_links = explode( ',', $atts['custom_links'] );
}
$images = explode( ',', $atts['images'] );
$img_size = isset( $atts['img_size'] ) ? $atts['img_size'] : 'thumbnail';
$onclick = isset( $atts['onclick'] ) ? $atts['onclick'] : '';
$i = - 1;

$class_to_filter = 'cms-carousel cms-images-carousel';
$class_to_filter .= empty( $atts['built_in_class'] ) ? '' : ' ' . $atts['built_in_class'];
$class_to_filter .= empty( $atts['nav_color'] ) ? ' nav-color-default' : ' ' . esc_attr( $atts['nav_color'] );
$class_to_filter .= vc_shortcode_custom_css_class( $atts['css'], ' ' ) . $this->getExtraClass( $atts['el_class'] );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );

$data_attr = $this->getCarouselOptions( $atts );
if ( ! empty( $data_attr ) ) {
    $data_attr = ' data-carousel-options="' . esc_attr( '{' . implode( ',', $data_attr ) . '}' ) . '"';
}
else {
    $data_attr = '';
}

$navigation_html = '';
if ( isset( $atts['navigation'] ) && 'yes' == $atts['navigation'] ) {

    if ( ! isset( $atts['custom_nav_icons'] ) || 'yes' != $atts['custom_nav_icons'] ) {
        $atts['left_i_type'] = 'fontawesome';
        $atts['left_i_icon_fontawesome'] = 'fa fa-angle-left';

        $atts['right_i_type'] = 'fontawesome';
        $atts['right_i_icon_fontawesome'] = 'fa fa-angle-right';
    }

    vc_icon_element_fonts_enqueue( $atts['left_i_type'] );
    $left_icon = '';
    if ( isset( $atts["left_i_icon_" . $atts['left_i_type']] ) ) {
        $left_icon = $atts["left_i_icon_" . esc_attr( $atts['left_i_type'] )];
    } else {
        $left_icon = 'fa fa-angle-left';
    }

    vc_icon_element_fonts_enqueue( $atts['right_i_type'] );
    $right_icon = '';
    if ( isset( $atts["right_i_icon_" . $atts['right_i_type']] ) ) {
        $right_icon = $atts["right_i_icon_" . esc_attr( $atts['right_i_type'] )];
    } else {
        $right_icon = 'fa fa-angle-right';
    }
    
    $nav_left = '<a href="#" class="nav-link nav-prev disabled"><i class="' . esc_attr( $left_icon ) . '"></i></a>';

    $nav_next = '<a href="#" class="nav-link nav-next"><i class="' . esc_attr( $right_icon ) . '"></i></a>';

    $navigation_html = '<div class="carousel-navigation">' . $nav_left . $nav_next . '</div>';
}

$space = isset( $atts['space'] ) ? (int)$atts['space'] : 30;
$space = $space / 2;
$style_attr = $item_style_attr = '';
if ( $space > 0 ) {
    $style_attr = ' style="margin-left:-' . esc_attr( $space . 'px;' ) . 'margin-right:-' . esc_attr( $space . 'px;' ) . '"';
    $item_style_attr = ' style="padding-left:' . esc_attr( $space . 'px;' ) . 'padding-right:' . esc_attr( $space . 'px;' ) . '"';
}

$carousel_id = 'cms-images-carousel-' . $this->getCarouselIndex();
$pretty_rand = 'link_image' === $onclick ? ' rel="prettyPhoto[rel-' . get_the_ID() . '-' . rand() . ']"' : '';

$wrapper_class = array();
$wrapper_class[] = ( '' != $navigation_html ? 'carousel-has-nav' : 'carousel-no-nav' );
$wrapper_class[] = ( isset( $atts['pagination'] ) && 'yes' == $atts['pagination'] ? 'carousel-has-pager' : 'carousel-no-pager' );

$wrapper_class = ' ' . implode( ' ', $wrapper_class );
?><div class="<?php echo esc_attr( $css_class ); ?>">
    <div class="carousel-wrapper<?php echo $wrapper_class; ?>">
        <div class="carousel-inner"<?php echo $style_attr; ?>>
            <div id="<?php echo esc_attr( $carousel_id ); ?>" class="carousel-items"<?php echo $data_attr; ?>>
                <?php foreach ( $images as $attach_id ) :  ?>
                    <?php
                    $i ++;
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
                    ?>
                    <div class="carousel-item"<?php echo $item_style_attr; ?>>
                        <?php if ( 'link_image' === $onclick ) :  ?>
                            <?php $p_img_large = $post_thumbnail['p_img_large']; ?>
                            <a class="prettyphoto" href="<?php echo $p_img_large[0] ?>" <?php echo $pretty_rand; ?>>
                                <?php echo $thumbnail ?>
                            </a>
                        <?php elseif ( 'custom_link' === $onclick && isset( $custom_links[ $i ] ) && '' !== $custom_links[ $i ] ) :  ?>
                            <a href="<?php echo $custom_links[ $i ] ?>"<?php echo( ! empty( $custom_links_target ) ? ' target="' . $custom_links_target . '"' : '' ) ?>>
                                <?php echo $thumbnail ?>
                            </a>
                        <?php else : ?>
                            <?php echo $thumbnail ?>
                        <?php endif ?>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
        <?php echo $navigation_html; ?>
    </div>
</div>