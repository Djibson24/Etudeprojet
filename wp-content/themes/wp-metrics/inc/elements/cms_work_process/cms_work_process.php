<?php
defined( 'ABSPATH' ) or exit();

$icon = vc_map_integrate_shortcode( 'cms_icon', 'i_', esc_html__( 'Icon', 'wp-metrics' ),
    array(
        'include_only_regex' => '/^(type|icon_\w*)/',
        // we need only type, icon_fontawesome, icon_blabla..., NOT color and etc
    ), array(
        'element' => 'add_icon',
        'value' => 'symbol',
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
            'heading' => esc_html__( 'Step Number', 'wp-metrics' ),
            'param_name' => 'step',
            'description' => esc_html__( 'Step number of process', 'wp-metrics' ),
            'admin_label' => true
        ),
        array(
            'type' => 'textarea',
            'heading' => esc_html__( 'Description','wp-metrics' ),
            'param_name' => 'description',
            'description' => esc_html__( 'Description Of Fancy Icon Box','wp-metrics' ),
            'admin_label' => true
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Add Icon?', 'wp-metrics' ),
            'param_name' => 'add_icon',
            'group' => esc_html__( 'Icon', 'wp-metrics' ),
            'value' => array(
                esc_html__( 'None', 'wp-metrics' ) => '',
                esc_html__( 'Symbol', 'wp-metrics' ) => 'symbol',
                esc_html__( 'Text', 'wp-metrics' ) => 'text',
                esc_html__( 'Image', 'wp-metrics' ) => 'image'
            ),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Text icon', 'wp-metrics' ),
            'param_name' => 'text_icon',
            'group' => esc_html__( 'Icon', 'wp-metrics' ),
            'description' => esc_html__( 'Custom text for icon area.', 'wp-metrics' ),
            'dependency' => array(
                'element' => 'add_icon',
                'value' => 'text'
            )
        )
    ),
    $icon,
    vc_map_integrate_shortcode( 'vc_single_image', 'img_', esc_html__( 'Icon', 'wp-metrics' ),
        array(
            'exclude'   => array( 'title', 'caption', 'add_caption', 'style', 'alignment' ,'external_style', 'border_color', 'external_border_color', 'onclick', 'link', 'img_link_target', 'el_class', 'css_animation', 'css' )
        ),
        array(
            'element'   => 'add_icon',
            'value' => 'image'
        )
    ),
    array(
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Color scheme', 'wp-metrics' ),
            'param_name' => 'color_scheme',
            'value' => array(
                esc_html__( 'Dark', 'wp-metrics' ) => 'dark',
                esc_html__( 'Light', 'wp-metrics' ) => 'light'
            )
        ),
        vc_map_add_css_animation( true ),
        array(
            'type'          => 'textfield',
            'param_name'    => 'el_class',
            'heading'       => esc_html__( 'Extra class name', 'wp-metrics' ),
            'description'   => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'wp-metrics' ),
        ),
        array(
            'type' => 'cms_template_img',
            'param_name' => 'cms_template',
            'admin_label' => true,
            'value' => 'cms_work_process.php',
            'heading' => esc_html__( 'Template', 'wp-metrics' ),
            'shortcode' => 'cms_work_process',
            'group' => esc_html__( 'Template', 'wp-metrics' )
        ),
        array(
            'type' => 'css_editor',
            'heading' => esc_html__( 'CSS box', 'wp-metrics' ),
            'param_name' => 'css',
            'group' => esc_html__( 'Design Options', 'wp-metrics' )
        )
    )
);

vc_map( array(
    'name' => esc_html__( 'CMS Work Process', 'wp-metrics' ),
    'base' => 'cms_work_process',
    'description' => esc_html__( 'Fancy process box', 'wp-metrics' ),
    'icon' => 'cms-vc-icon cms-vc-icon-work-process',
    'show_settings_on_create' => true,
    'category' => esc_html__( 'CmsSuperheroes Shortcodes', 'wp-metrics' ),
    'params' => $params
) );

class WPBakeryShortCode_CMS_Work_Process extends CmsShortCode {
    protected function content( $atts, $content = null ) {
        return parent::content( $atts, $content );
    }
}
