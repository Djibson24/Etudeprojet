<?php defined( 'ABSPATH' ) or exit();
/**
 * Counter group for Visual Composer
 */
$params = array_merge(
    array(
        array(
            'type'          => 'textfield',
            'param_name'    => 'el_class',
            'heading'       => esc_html__( 'Extra class name', 'wp-metrics' ),
            'description'   => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'wp-metrics' ),
        ),
        array(
            'type' => 'checkbox',
            'param_name' => 'sep',
            'heading' => esc_html__( 'Include seperator', 'wp-metrics' ),
            'description' => esc_html__( 'Include seperator between counters', 'wp-metrics' )
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__( 'Sep color', 'wp-metrics' ),
            'param_name' => 'sep_color',
            'dependency' => array(
                'element' => 'sep',
                'not_empty' => true
            )
        ),
    ),
    wpmetrics_vc_inline_group_base_param(),
    array(
        array(
            'type' => 'css_editor',
            'heading' => esc_html__( 'CSS box', 'wp-metrics' ),
            'param_name' => 'css',
            'group' => esc_html__( 'Design Options', 'wp-metrics' ),
        )
    )
);

vc_map( array(
    'name' => esc_html__( 'CMS Counters', 'wp-metrics' ),
    'base' => 'cms_counters',
    'as_parent' => array( 'only' => 'cms_countup' ),
    'content_element' => true,
    'show_settings_on_create' => true,
    'is_container' => true,
    'params' => $params,
    'icon' => 'cms-vc-icon cms-vc-icon-counter',
    'category' => esc_html__( 'CmsSuperheroes Shortcodes', 'wp-metrics' ),
    'description' => esc_html__( 'Fancy counter boxes', 'wp-metrics' ),
    'js_view' => 'VcColumnView'
) );

class WPBakeryShortCode_CMS_Counters extends WPBakeryShortCodesContainer {
    function get_item_class( $atts ) {
        $item_class = array();
        if ( '' != $atts['col_xs'] ) {
            $item_class[] = esc_html( $atts['col_xs'] );
        }
        if ( '' != $atts['col_sm'] ) {
            $item_class[] = esc_html( $atts['col_sm'] );
        }
        if ( '' != $atts['col_md'] ) {
            $item_class[] = esc_html( $atts['col_md'] );
        }
        if ( '' != $atts['col_lg'] ) {
            $item_class[] = esc_html( $atts['col_lg'] );
        }
        if ( ! empty( $item_class ) ) {
            return implode( ' ', $item_class );
        }
        return '';
    }
}