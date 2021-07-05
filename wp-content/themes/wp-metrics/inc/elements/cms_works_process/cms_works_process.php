<?php defined( 'ABSPATH' ) or exit();

$params = array_merge( 
    array(
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Alignment', 'wp-metrics' ),
            'param_name' => 'align',
            'value' => array(
                esc_html__( 'Center', 'wp-metrics' ) => 'center',
                esc_html__( 'Left', 'wp-metrics' ) => 'left',
                esc_html__( 'Right', 'wp-metrics' ) => 'right'
            )
        )
    ),
    wpmetrics_vc_inline_group_base_param(),
    array(
        array(
            'type'          => 'textfield',
            'param_name'    => 'el_class',
            'heading'       => esc_html__( 'Extra class name', 'wp-metrics' ),
            'description'   => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'wp-metrics' ),
        ),
        array(
            'type' => 'css_editor',
            'heading' => esc_html__( 'CSS box', 'wp-metrics' ),
            'param_name' => 'css',
            'group' => esc_html__( 'Design Options', 'wp-metrics' ),
        )
    )
);

vc_map( array(
    'name' => esc_html__( 'CMS Works Process Boxes', 'wp-metrics'),
    'base' => 'cms_works_process',
    'as_parent' => array( 'only' => 'cms_work_process' ),
    'content_element' => true,
    'show_settings_on_create' => true,
    'is_container' => true,
    'params' => $params,
    'icon' => 'cms-vc-icon cms-vc-icon-work-process',
    'category' => esc_html__( 'CmsSuperheroes Shortcodes', 'wp-metrics'),
    'description'   => esc_html__( 'Fancy process boxes', 'wp-metrics' ),
    'js_view' => 'VcColumnView'
) );

class WPBakeryShortCode_CMS_Works_Process extends WPBakeryShortCodesContainer {
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