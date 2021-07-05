<?php defined( 'ABSPATH' ) or exit();
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
$class_to_filter = 'cms-works-process-wrapper';
$class_to_filter .= vc_shortcode_custom_css_class( $atts['css'], ' ' ) . $this->getExtraClass( $atts['el_class'] );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );
$css_class .= ' text-' . esc_attr( $atts['align'] );

$item_class = $this->get_item_class( $atts );
?>
<div class="<?php echo esc_attr( $css_class ); ?>">
    <div class="cms-inline-block-wrapper cms-works-process"><?php
        $content_shortcodes = wpmetrics_get_shortcode_from_content( 'cms_work_process', $content, false );
        if ( ! empty( $content_shortcodes ) ) :
        foreach ( $content_shortcodes as $key => $shortcode ) {
            echo '<div class="works-process-item' . ( empty( $item_class ) ? '' : ' ' . esc_attr( $item_class ) ) . '">';
            echo do_shortcode( $shortcode );
            echo '</div>';
        }
        endif;
    ?></div>
</div>