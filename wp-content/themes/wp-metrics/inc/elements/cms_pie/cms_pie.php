<?php defined( 'ABSPATH' ) or exit();
/**
 * Pie chart for the theme
 *
 * @package CMSSuperHeroes
 * @subpackage WPMetrics
 */

$icon = vc_map_integrate_shortcode( 'cms_icon', 'i_', '',
    array(
        'include_only_regex' => '/^(type|icon_\w*)/',
        // we need only type, icon_fontawesome, icon_blabla..., NOT color and etc
    ), array(
        'element' => 'use_icon_as_value',
        'not_empty' => true,
    )
);

if ( is_array( $icon ) && ! empty( $icon ) ) {
    foreach ( $icon as $key => $param ) {
        if ( is_array( $param ) && ! empty( $param ) ) {
            if ( isset( $param['admin_label'] ) ) {
                // remove admin label
                unset( $icon[ $key ]['admin_label'] );
            }
        }
    }
}

$params = array_merge(
    array(
        array(
            'type' => 'textfield',
            'param_name' => 'title',
            'heading' => esc_html__( 'Title', 'wp-metrics' ),
            'admin_label' => true
        ),
        array(
            'type' => 'textfield',
            'param_name' => 'value',
            'heading' => esc_html__( 'Value', 'wp-metrics' ),
            'description' => esc_html__( 'Enter value for graph (Note: choose range from 0 to 100).', 'wp-metrics' ),
            'admin_label' => true
        ),
        array(
            'type' => 'textfield',
            'param_name' => 'duration',
            'heading' => esc_html__( 'Animation duration', 'wp-metrics' ),
            'description' => esc_html__( 'Should lager than 100.', 'wp-metrics' ),
            'std' => '2500'
        ),
        array(
            'type' => 'dropdown',
            'param_name' => 'style',
            'heading' => esc_html__( 'Styles', 'wp-metrics' ),
            'value' => array(
                esc_html__( 'Default', 'wp-metrics' ) => 'default',
                esc_html__( 'Thick border', 'wp-metrics' ) => 'thick'
            )
        ),
        array(
            'type' => 'colorpicker',
            'param_name' => 'title_color',
            'heading' => esc_html__( 'Title Color', 'wp-metrics' ),
            'edit_field_class' => 'vc_col-sm-6 vc_column'
        ),
        array(
            'type' => 'colorpicker',
            'param_name' => 'value_color',
            'heading' => esc_html__( 'Value color', 'wp-metrics' ),
            'edit_field_class' => 'vc_col-sm-6 vc_column'
        ),
        array(
            'type' => 'colorpicker',
            'param_name' => 'accent_color',
            'heading' => esc_html__( 'Accent color', 'wp-metrics' ),
            'edit_field_class' => 'vc_col-sm-6 vc_column'
        ),
        array(
            'type' => 'colorpicker',
            'param_name' => 'border_color',
            'heading' => esc_html__( 'Border color', 'wp-metrics' ),
            'edit_field_class' => 'vc_col-sm-6 vc_column'
        ),
        array(
            'type' => 'checkbox',
            'param_name' => 'use_icon_as_value',
            'heading' => esc_html__( 'Use icon as value', 'wp-metrics' )
        )
    ),
    $icon,
    array(
        array(
            'type'          => 'textfield',
            'param_name'    => 'el_class',
            'heading'       => esc_html__( 'Extra class name', 'wp-metrics' ),
            'description'   => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS. If button container is enabled, these class names will be applied to the container.', 'wp-metrics' ),
        ),
        array(
            'type' => 'css_editor',
            'heading' => esc_html__( 'CSS box', 'wp-metrics' ),
            'param_name' => 'css',
            'group' => esc_html__( 'Design Options', 'wp-metrics' ),
            'dependency' => array(
                'element' => 'container',
                'not_empty' => true
            )
        )
    )
);

vc_map( array(
    'name' => esc_html__( 'CMS Pie Chart', 'wp-metrics' ),
    'base' => 'cms_pie',
    'icon' => 'icon-wpb-vc_pie',
    'description' => esc_html__( 'Simple animated pie chart', 'wp-metrics' ),
    'category' => esc_html__( 'CmsSuperheroes Shortcodes', 'wp-metrics' ),
    'params' => $params
) );

class WPBakeryShortCode_CMS_Pie extends WPBakeryShortCode {}