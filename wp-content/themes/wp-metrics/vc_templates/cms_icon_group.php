<?php defined( 'ABSPATH' ) or exit();
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );

$class_to_filter = empty( $atts['built_in_css'] ) ? '' : ' cms-icon-group-' . esc_attr( $atts['built_in_css'] );
$class_to_filter .= vc_shortcode_custom_css_class( $atts['css'], ' ' ) . $this->getExtraClass( $atts['el_class'] );
$class_to_filter .= ( 'true' === $atts['sep'] ? ' cms-icon-group-with-sep' : '' );
$class_to_filter .= empty( $atts['built_in_class'] ) ? '' : ' ' . $atts['built_in_class'];
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );

$item_class = $this->getGridItemClass( $atts );
$item_class = empty( $item_class ) ? '' : ' ' . $item_class;
$item_style = ( ! empty( $atts['color_sep'] ) && wpmetrics_validate_color( $atts['color_sep'] ) ) ? ' style="border-color:' . esc_attr( $atts['color_sep'] ) . '"' : '';
?>

<div class="cms-icon-group-wrapper<?php echo esc_attr( $css_class ); ?>">
    <div class="cms-inline-block-wrapper cms-icon-group"><?php
            $content_shortcodes = wpmetrics_get_shortcode_from_content( 'cms_icon', $content, false );
            if ( ! empty( $content_shortcodes ) ) :
            foreach ( $content_shortcodes as $key => $shortcode ) {
                echo '<div class="cms-icon-box-item' . esc_attr( $item_class ) . '"' . $item_style . '>';
                echo '<div class="cms-icon-box-item-inner">';
                echo do_shortcode( $shortcode );
                echo '</div>';
                echo '</div>';
            }
            endif;
    ?></div>
</div>