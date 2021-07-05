<?php defined( 'ABSPATH' ) or exit();

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
$class_to_filter = 'cms-counters-wrapper';
$inner_classes = 'cms-inline-block-wrapper cms-counters';
$sep_color = wpmetrics_validate_color( $atts['sep_color'] ) ? $atts['sep_color'] : '';

if ( 'true' === $atts['sep'] ) {
    $class_to_filter .= ' cms-counters-with-sep';
}

$class_to_filter .= vc_shortcode_custom_css_class( $atts['css'], ' ' ) . $this->getExtraClass( $atts['el_class'] );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );

$item_class = $this->get_item_class( $atts );
$item_class = empty( $item_class ) ? '' : ' ' . $item_class;
?>
<div class="<?php echo esc_attr( $css_class );?>">
    <div class="<?php echo esc_attr( $inner_classes ); ?>"<?php echo ( $sep_color ? ' style="border-color:' . $sep_color . '"' : '' ); ?>><?php
        $content_shortcodes = wpmetrics_get_shortcode_from_content( 'cms_countup', $content, false );
        if ( ! empty( $content_shortcodes ) ) :
        foreach ( $content_shortcodes as $key => $shortcode ) {
            echo '<div class="counter-item' . esc_attr( $item_class ) . '">';
            echo do_shortcode( $shortcode );
            echo '</div>';
        }
        endif;
    ?></div>
</div>