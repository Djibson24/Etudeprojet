<?php defined( 'ABSPATH' ) or exit();

$title = $color = $bar_bg = $text_color = $value_color = $value = $el_class = $css = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );

extract( $atts );

$class_to_filter = vc_shortcode_custom_css_class( $css, ' ' ) . $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );

wp_enqueue_script( 'bootstrap-progressbar' );

$style_attr = array();

$bar_style = array();

if ( ! empty( $color ) ) {
    $bar_style[] = 'background-color:' . $color . ';';
}
if ( ! empty( $value_color ) ) {
    $bar_style[] = 'color:' . $value_color . ';';
}

$bar_style = ( ! empty( $bar_style ) ? implode( ';', $bar_style ) : false );

$value = ( ! empty( $value ) && is_numeric( $value ) ) ? (int)$value : 100;
$title_html = '';
if ( ! empty( $title ) ) {
    $title_html = '<div class="progress-title"><h6 class="progress-title-text"' . ( ! empty( $text_color ) ? ' style="color:' . esc_attr( $text_color ) . ';"' : '' ) . '>' . esc_html( $title ) . '</h6></div>';
}
?>
<div class="cms-progress-bar-wrapper<?php echo ( '' != $css_class ? ' ' . esc_attr( $css_class ) : '' ); ?>">
    <div class="cms-progress-bar"><?php
        echo $title_html;
        echo '<div class="progress-content">';
        echo    '<div class="progress"' . ( ! empty( $bar_bg ) ? ' style="background-color: ' . esc_attr( $bar_bg ) . ';"' : '' ) . '>';
        echo        '<div class="progress-bar" role="progressbar" data-transitiongoal="' . esc_attr( $value ) . '"' . ( $bar_style ? ' style="' . esc_attr( $bar_style ) . '"' : '' ) . '></div>';
        echo    '</div>';
        echo '</div>';
    ?></div>
</div>