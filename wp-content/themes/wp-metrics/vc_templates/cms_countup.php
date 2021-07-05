<?php defined( 'ABSPATH' ) or exit();

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );

$class_to_filter = array(
    'cms-counter-wrapper'
);
$class_to_filter[] = $this->getExtraClass( $atts['el_class'] );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $class_to_filter ) ), $this->settings['base'], $atts );

if ( ! wp_script_is( 'count-up', 'enqueued' ) ) {
    wp_enqueue_script( 'count-up' );
}

$data_attr = $this->getCounterOptions( $atts );
if ( ! empty( $data_attr ) ) {
    $data_attr = ' data-counter-options="' . esc_attr( '{' . implode( ',', $data_attr ) . '}' ) . '"';
}
else {
    $data_attr = '';
}

$data_attr_extra = $this->getCounterCustomizations( $atts );
if ( ! empty( $data_attr_extra ) ) {
    $data_attr_extra = ' data-counter-extras="' . esc_attr( '{' . implode( ',', $data_attr_extra ) . '}' ) . '"';
}
else {
    $data_attr_extra = '';
}

$icon_html = '';
if ( ! empty( $atts['add_icon'] ) ) {
    vc_icon_element_fonts_enqueue( $atts['i_type'] );
    $icon_wrapper = false;
    if ( isset( $atts["i_icon_" . $atts['i_type']] ) ) {
        $iconClass = $atts["i_icon_" . esc_attr($atts['i_type'])];
    } else {
        $iconClass = 'fa fa-adjust';
    }
    $icon_html = '<i class="' . esc_attr( $iconClass ) . '"></i>';
}

$icon_color = '';
$title_color = '';
$number_color = '';
if ( ! empty( $atts['color'] ) ) {
    $css_class .= ' counter-color-' . $atts['color'];
    if ( 'custom' == $atts['color'] ) {
        $icon_color = empty( $atts['color_icon'] ) ? '' : ' style="color:' . esc_attr( $atts['color_icon'] ) . ';"';
        $title_color = empty( $atts['color_title'] ) ? '' : ' style="color:' . esc_attr( $atts['color_title'] ) . ';"';
        $number_color = empty( $atts['color_number'] ) ? '' : ' style="color:' . esc_attr( $atts['color_number'] ) . ';"';
    }
}
?>
<div class="<?php echo esc_attr( $css_class ); ?>">
    <div class="cms-counter">
        <div class="counter-icon"<?php echo $icon_color; ?>><?php echo $icon_html; ?></div>
        <div id="counter-<?php echo $this->getCounterIndex(); ?>"<?php echo $number_color; ?> class="counter-text"<?php echo $data_attr; echo $data_attr_extra; ?>></div>
        <?php if ( ! empty( $atts['title'] ) ) : ?>
        <div class="counter-info">
           <h5 class="counter-title"<?php echo $title_color; ?>><?php echo $atts['title']; ?></h5>
        </div>
        <?php endif; ?>
    </div>
</div>
