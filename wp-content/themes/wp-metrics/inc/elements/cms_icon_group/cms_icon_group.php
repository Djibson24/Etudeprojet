<?php defined( 'ABSPATH' ) or exit();

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
            'description' => esc_html__( 'Include seperator between icon boxes', 'wp-metrics' )
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__( 'Seperator color', 'wp-metrics' ),
            'param_name' => 'color_sep',
            'description' => esc_html__( 'Set seperator line color', 'wp-metrics' )
        )
    ),
    wpmetrics_vc_inline_group_base_param(),
    array(
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Built-in css features', 'wp-metrics' ),
            'param_name' => 'built_in_css',
            'value' => array(
                esc_html__( 'None', 'wp-metrics' ) => '',
                esc_html__( 'Support for icon box hover', 'wp-metrics' ) => 'icon-box-hover' ),
            'description' => esc_html__( 'If you want to use hover support, then don not style any thing ( except alignment ) from invidual icon boxes', 'wp-metrics' )
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
    'name' => esc_html__( 'CMS Icon Group', 'wp-metrics' ),
    'base' => 'cms_icon_group',
    'as_parent' => array( 'only' => 'cms_icon' ),
    'content_element' => true,
    'show_settings_on_create' => true,
    'is_container' => true,
    'params' => $params,
    'icon' => 'icon-wpb-vc_icon',
    'category' => esc_html__( 'CmsSuperheroes Shortcodes', 'wp-metrics' ),
    'description' => esc_html__( 'Group of icon boxes', 'wp-metrics' ),
    'js_view' => 'VcColumnView'
) );

class WPBakeryShortCode_CMS_Icon_Group extends WPBakeryShortCodesContainer {
    public function getGridItemClass( $atts ) {
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