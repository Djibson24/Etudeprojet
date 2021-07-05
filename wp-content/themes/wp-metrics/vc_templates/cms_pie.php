<?php
/**
 * Simple pie chart
 *
 * @var title
 * @var value
 * @var title_color
 * @var value_color
 * @var accent_color
 * @var border_color
 * @var use_icon_as_value
 * @var el_class
 * @var css
 */

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );

$options = array();
$value_html = $icon_class = '';

$pie_classes = array(
    'cms-pie-chart',
    'cms-pie-chart-style' . $atts['style'],
    vc_shortcode_custom_css_class( $atts['css'] ),
    $this->getExtraClass( $atts['el_class'] )
);

$atts['value'] = absint( $atts['value'] );
if ( 0 < $atts['value'] && 100 > $atts['value'] )
{
    $options['value'] = $atts['value'];
}

$atts['duration'] = absint( $atts['duration'] );
if ( 100 < $atts['duration'] )
{
    $options['duration'] = $atts['duration'];
}

if ( 'default' == $atts['style'] )
{
    $options['width'] = 3;
}
else
{
    $options['width'] = 11;
}

if ( $atts['use_icon_as_value'] )
{
    vc_icon_element_fonts_enqueue( $atts['i_type'] );
    $icon_class = isset( $atts[ 'i_icon_' . $atts['i_type'] ] ) ? $atts[ 'i_icon_' . $atts['i_type'] ] : '';
}


$css_classes = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $pie_classes ) ), $this->settings['base'], $atts );

?>
<div class="<?php echo esc_attr( $css_classes ); ?>" data-cms-element="piechart" data-options="<?php echo esc_attr( json_encode( $options ) ); ?>">
    <div class="cms-pies-holder">
        <div class="pie-border"<?php echo ( $atts['border_color'] ? ' style="border-color:' . esc_attr( $atts['border_color'] ) . '"' : '' ); ?>></div>
        <div class="pie-graphic" data-role="graphic"<?php echo ( $atts['accent_color'] ? ' style="border-color:' . esc_attr( $atts['accent_color'] ) . '"' : '' ); ?>></div>
        <div class="pie-value"<?php echo ( $atts['value_color'] ? ' style="color:' . $atts['value_color'] . '"' : '' ); ?>>
            <?php if ( $icon_class ) : ?>
                <span class="icon"><i class="<?php echo esc_attr( $icon_class ); ?>"></i></span>
            <?php else : ?>
                <span class="value"><span data-role="value"></span>%</span>
            <?php endif; ?>
        </div>
    </div>
    <?php if ( $atts['title'] ) : ?>
        <div class="chart-content">
            <h3 class="chart-title"<?php echo ( $atts['title_color'] ? ' style="color:' . $atts['title_color'] . '"' : '' ); ?>><?php echo esc_html( $atts['title'] ); ?></h3>
        </div>
    <?php endif; ?>
</div>