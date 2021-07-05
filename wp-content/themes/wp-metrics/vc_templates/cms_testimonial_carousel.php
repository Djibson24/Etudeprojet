<?php defined( 'ABSPATH' ) or exit();

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
$class_to_filter = $css_class = $posts = '';
$data_attr = $custom_links = array();

wp_enqueue_script( 'owl-carousel' );
wp_enqueue_style( 'owl-carousel' );

$class_to_filter = 'cms-carousel cms-testimonials-carousel';
if ( ! empty( $atts['built_in_class'] ) ) {
    $class_to_filter .= ' ' . $atts['built_in_class'];
}
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

$carousel_id = 'cms-testimonials-carousel-' . $this->getCarouselIndex();
$wrapper_class = array();
$wrapper_class[] = ( '' != $navigation_html ? 'carousel-has-nav' : 'carousel-no-nav' );
$wrapper_class[] = ( isset( $atts['pagination'] ) && 'yes' == $atts['pagination'] ? 'carousel-has-pager' : 'carousel-no-pager' );

$wrapper_class = ' ' . implode( ' ', $wrapper_class );
?><div class="<?php echo esc_attr( $css_class );?>">
    <div class="carousel-wrapper<?php echo $wrapper_class; ?>">
        <div class="carousel-inner"<?php echo $style_attr; ?>>
            <div id="<?php echo esc_attr( $carousel_id ); ?>" class="carousel-items"<?php echo $data_attr; ?>><?php
                $content_shortcodes = wpmetrics_get_shortcode_from_content( 'cms_testimonial', $content, false );
                if ( ! empty( $content_shortcodes ) ) :
                foreach ( $content_shortcodes as $key => $shortcode ) {
                    echo '<div class="carousel-item"' . $item_style_attr . '>';
                    echo do_shortcode( $shortcode );
                    echo '</div>';
                }
                endif;
            ?></div>
        </div>
        <?php echo $navigation_html; ?>
    </div>
</div>