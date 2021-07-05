<?php defined( 'ABSPATH' ) or exit();

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
$class_to_filter = $css_class = $posts = '';
$data_attr = array();

wp_enqueue_script( 'bx-slider' );
wp_enqueue_style( 'bx-slider' );

$data_attr = $this->getCarouselOptions( $atts );
if ( ! empty( $data_attr ) ) {
    $data_attr = ' data-slider-options="' . esc_attr( '{' . implode( ',', $data_attr ) . '}' ) . '"';
}
else {
    $data_attr = '';
}

$navigation_data_attr = '';
$slider_controls = false;

if ( isset( $atts['controls'] ) && 'yes' == $atts['controls'] ) {
    $slider_controls = true;

    if ( isset( $atts['hide_control_on_end'] ) && 'yes' == $atts['hide_control_on_end'] ) {
        $navigation_data_attr .= ' data-hide-controls-on-end="true"';
    }
}

if ( $slider_controls ) {
    $slider_controls = '<div class="slider-controls"><div class="slider-control control-prev"></div><div class="slider-control control-next"></div></div>';
}
else {
    $slider_controls = '';
}

$class_to_filter = 'cms-slider cms-casestudy-slider';
$class_to_filter .= vc_shortcode_custom_css_class( $atts['css'], ' ' ) . $this->getExtraClass( $atts['el_class'] );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );

?><div class="<?php echo esc_attr( $css_class ); ?>"<?php echo $navigation_data_attr; ?>>
    <div class="slider-wrapper">
        <div class="slider-items"<?php echo $data_attr; ?>><?php
            $content_shortcodes = wpmetrics_get_shortcode_from_content( 'cms_casestudy', $content, false );
            if ( ! empty( $content_shortcodes ) ) :
            foreach ( $content_shortcodes as $key => $shortcode ) {
                echo '<div class="slider-item">';
                echo do_shortcode( $shortcode );
                echo '</div>';
            }
            endif;
        ?></div>
        <?php echo $slider_controls; ?>
    </div>
</div>