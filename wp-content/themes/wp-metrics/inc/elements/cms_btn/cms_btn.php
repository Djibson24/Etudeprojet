<?php defined( 'ABSPATH' ) or exit();
/**
 * Buttons for the theme
 *
 * @package CMSSuperHeroes
 * @subpackage WPMetrics
 */

$btn_icon = vc_map_integrate_shortcode( 'cms_icon', 'i_', '',
    array(
        'include_only_regex' => '/^(type|icon_\w*)/',
        // we need only type, icon_fontawesome, icon_blabla..., NOT color and etc
    ), array(
        'element' => 'add_icon',
        'not_empty' => true,
    )
);

if ( is_array( $btn_icon ) && ! empty( $btn_icon ) ) {
    foreach ( $btn_icon as $key => $param ) {
        if ( is_array( $param ) && ! empty( $param ) ) {
            if ( isset( $param['admin_label'] ) ) {
                // remove admin label
                unset( $btn_icon[ $key ]['admin_label'] );
            }
        }
    }
}

$params = array_merge(
    array(
        array(
            'type' => 'textfield',
            'param_name' => 'title',
            'heading' => esc_html__( 'Button Text', 'wp-metrics' ),
            'save_always' => true,
            'value' => esc_html__( 'Text on the button', 'wp-metrics' )
        ),
        array(
            'type' => 'vc_link',
            'param_name' => 'link',
            'heading' => esc_html__( 'URL (Link)', 'wp-metrics' ),
            'description' => esc_html__( 'Add link to button.', 'wp-metrics' )
        ),
        array(
            'type' => 'dropdown',
            'param_name' => 'type',
            'heading' => esc_html__('Button Type', 'wp-metrics'),
            'edit_field_class' => 'vc_col-sm-6 vc_column',
            'value' => array(
                esc_html__( 'Outline', 'wp-metrics' ) => '',
                esc_html__( 'Filled', 'wp-metrics' ) => 'btn-filled'
            )
        ),
        array(
            'type' => 'dropdown',
            'param_name' => 'color',
            'heading' => esc_html__( 'Button Color', 'wp-metrics'),
            'edit_field_class' => 'vc_col-sm-6 vc_column',
            'value' => array(
                esc_html__( 'Default', 'wp-metrics' ) => '',
                esc_html__( 'Primary Color', 'wp-metrics' ) => 'btn-primary',
                esc_html__( 'White', 'wp-metrics' ) => 'btn-white'
            )
        ),
        array(
            'type' => 'dropdown',
            'param_name' => 'hover_color',
            'heading' => esc_html__( 'Button Hover Color', 'wp-metrics' ),
            'edit_field_class' => 'vc_col-sm-6 vc_column',
            'value' => array(
                esc_html__( 'Default', 'wp-metrics' ) => '',
                esc_html__( 'Primary', 'wp-metrics' ) => 'btn-hover-primary',
                esc_html__( 'Dark', 'wp-metrics' ) => 'btn-hover-dark',
                esc_html__( 'White', 'wp-metrics' ) => 'btn-hover-white'
            )
        ),
        array(
            'type' => 'dropdown',
            'param_name' => 'size',
            'heading' => esc_html__( 'Button Size', 'wp-metrics' ),
            'edit_field_class' => 'vc_col-sm-6 vc_column',
            'value'         => array(
                esc_html__( 'Default', 'wp-metrics' ) => '',
                esc_html__( 'Full width', 'wp-metrics' ) => 'btn-block',
                esc_html__( 'Small', 'wp-metrics' ) => 'btn-small',
                esc_html__( 'Full width small', 'wp-metrics' ) => 'btn-small btn-block'
            )
        ),
        array(
            'type' => 'checkbox',
            'param_name' => 'container',
            'heading' => esc_html__( 'Add Container?', 'wp-metrics' )
        ),
        array(
            'type' => 'dropdown',
            'param_name' => 'align',
            'heading' => esc_html__( 'Button Align', 'wp-metrics' ),
            'value' => array(
                esc_html__( 'Left', 'wp-metrics' ) => 'left',
                esc_html__( 'Right', 'wp-metrics' ) => 'right',
                esc_html__( 'Center', 'wp-metrics' ) => 'center',
            ),
            'dependency' => array(
                'element' => 'container',
                'not_empty' => true
            )
        ),
        array(
            'type' => 'checkbox',
            'param_name' => 'add_icon',
            'heading' => esc_html__( 'Add icon?', 'wp-metrics' )
        )
    ),
    $btn_icon,
    array(
        array(
            'type' => 'dropdown',
            'param_name' => 'icon_align',
            'heading' => esc_html__( 'Icon Alignment', 'wp-metrics' ),
            'description' => esc_html__( 'Select icon alignment.', 'wp-metrics' ),
            'value' => array(
                esc_html__( 'Left', 'wp-metrics' ) => 'left',
                esc_html__( 'Right', 'wp-metrics' ) => 'right',
            ),
            'dependency' => array(
                'element' => 'add_icon',
                'value' => 'true',
            )
        ),
        vc_map_add_css_animation( true ),
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

if ( shortcode_exists( 'cms_btn' ) ) {
    vc_map_update( 'cms_btn', array(
        'params' => $params
    ) );
}
else {
    vc_map( array(
        'name' => esc_html__( 'CMS Button', 'wp-metrics' ),
        'base' => 'cms_btn',
        'icon' => 'icon-wpb-ui-button',
        'description' => esc_html__( 'Eye catching button', 'wp-metrics' ),
        'category' => esc_html__( 'CmsSuperheroes Shortcodes', 'wp-metrics' ),
        'params' => $params,
        'js_view' => 'VcButton3View',
        'custom_markup' => '<h4 class="wpb_element_title"><i class="vc_general vc_element-icon icon-wpb-ui-button"></i></h4>' .
            '<div class="vc_btn3-container"><button class="vc_general vc_btn3 vc_btn3-size-sm vc_btn3-shape-rounded vc_btn3-style-default vc_btn3-color-default"">{{{ params.title }}}</button></div>'
    ) );

    class WPBakeryShortCode_CMS_Btn extends WPBakeryShortCode {}
}
