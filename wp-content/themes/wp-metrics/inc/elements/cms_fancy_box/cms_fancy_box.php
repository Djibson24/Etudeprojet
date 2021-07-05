<?php
defined( 'ABSPATH' ) or exit();

$fancybox_icon = vc_map_integrate_shortcode( 'cms_icon', 'i_', esc_html__( 'Icon', 'wp-metrics' ),
    array(
        'include_only_regex' => '/^(type|icon_\w*)/',
        // we need only type, icon_fontawesome, icon_blabla..., NOT color and etc
    ), array(
        'element' => 'add_icon',
        'value' => 'symbol',
    )
);

if ( is_array( $fancybox_icon ) && ! empty( $fancybox_icon ) ) {
    foreach ( $fancybox_icon as $key => $param ) {
        if ( is_array( $param ) && ! empty( $param ) ) {
            if ( isset( $param['admin_label'] ) ) {
                // remove admin label
                unset( $fancybox_icon[ $key ]['admin_label'] );
            }
        }
    }
}

$params = array_merge(
    array(
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Title', 'wp-metrics' ),
            'param_name' => 'title',
            'description' => esc_html__( 'Title Of Fancy Icon Box', 'wp-metrics' ),
            'admin_label' => true
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Subtitle', 'wp-metrics' ),
            'param_name' => 'subtitle',
            'description' => esc_html__( 'Sub title for Fancy icon box', 'wp-metrics' )
        ),
        array(
            'type' => 'textarea',
            'heading' => esc_html__( 'Description','wp-metrics' ),
            'param_name' => 'description',
            'description' => esc_html__( 'Description Of Fancy Icon Box','wp-metrics' )
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
    $fancybox_icon,
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
            'heading' => esc_html__( 'Add Button?', 'wp-metrics' ),
            'param_name' => 'add_btn',
            'group' => esc_html__( 'Button Link', 'wp-metrics' ),
            'value' => array(
                esc_html__( 'None', 'wp-metrics' ) => '',
                esc_html__( 'Button', 'wp-metrics' ) => 'btn',
                esc_html__( 'Link', 'wp-metrics' ) => 'link'
            )
        ),
        array(
            'type' => 'vc_link',
            'heading' => esc_html__( 'Button Link', 'wp-metrics' ),
            'param_name' => 'link',
            'group' => esc_html__( 'Button Link', 'wp-metrics' ),
            'dependency' => array(
                'element' => 'add_btn',
                'value' => 'link'
            )
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__( 'Link color', 'wp-metrics' ),
            'param_name' => 'color_link',
            'description' => esc_html__( 'Set color for link', 'wp-metrics' ),
            'edit_field_class' => 'vc_col-sm-6 vc_column',
            'dependency' => array(
                'element' => 'add_btn',
                'value' => 'link'
            )
        ),
    ),
    vc_map_integrate_shortcode( 'cms_btn', 'btn_', esc_html__( 'Button Link', 'wp-metrics' ),
        array(
            'exclude' => array( 'container', 'align', 'el_class', 'css_animation', 'css' ),
        ),
        array(
            'element' => 'add_btn',
            'value' => 'btn'
        )
    ),
    array(
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Color scheme', 'wp-metrics' ),
            'param_name' => 'color_scheme',
            'value' => array(
                esc_html__( 'Dark', 'wp-metrics' ) => 'dark',
                esc_html__( 'Light', 'wp-metrics' ) => 'light',
                esc_html__( 'Custom', 'wp-metrics' ) => 'custom'
            )
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__( 'Icon color', 'wp-metrics' ),
            'param_name' => 'color_icon',
            'description' => esc_html__( 'Set color for icon', 'wp-metrics' ),
            'edit_field_class' => 'vc_col-sm-6 vc_column',
            'dependency' => array(
                'element' => 'color_scheme',
                'value' => 'custom'
            )
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__( 'Icon Background', 'wp-metrics' ),
            'param_name' => 'color_icon_bg',
            'description' => esc_html__( 'Set background color for icon', 'wp-metrics' ),
            'edit_field_class' => 'vc_col-sm-6 vc_column',
            'dependency' => array(
                'element' => 'color_scheme',
                'value' => 'custom'
            )
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__( 'Title color', 'wp-metrics' ),
            'param_name' => 'color_title',
            'description' => esc_html__( 'Set color for title', 'wp-metrics' ),
            'edit_field_class' => 'vc_col-sm-6 vc_column',
            'dependency' => array(
                'element' => 'color_scheme',
                'value' => 'custom'
            )
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__( 'Sub Title color', 'wp-metrics' ),
            'param_name' => 'color_subtitle',
            'description' => esc_html__( 'Set color for title', 'wp-metrics' ),
            'edit_field_class' => 'vc_col-sm-6 vc_column',
            'dependency' => array(
                'element' => 'color_scheme',
                'value' => 'custom'
            )
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__( 'Text color', 'wp-metrics' ),
            'param_name' => 'color_text',
            'description' => esc_html__( 'Set color for text', 'wp-metrics' ),
            'edit_field_class' => 'vc_col-sm-6 vc_column',
            'dependency' => array(
                'element' => 'color_scheme',
                'value' => 'custom'
            )
        ),
        array(
            'type' => 'cms_template_img',
            'heading' => esc_html__( 'Template', 'wp-metrics' ),
            'group' => esc_html__( 'Template', 'wp-metrics' ),
            'param_name' => 'cms_template',
            'shortcode' => 'cms_fancy_box',
            'admin_label' => true,
            'value' => 'cms_fancy_box.php'
            
        ),
        vc_map_add_css_animation( true ),
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
            'group' => esc_html__( 'Design Options', 'wp-metrics' )
        )
    )
);

vc_map( array(
    'name' => esc_html__( 'CMS Fancy Box', 'wp-metrics' ),
    'base' => 'cms_fancy_box',
    'description' => esc_html__( 'Fancy Content Box', 'wp-metrics' ),
    'show_settings_on_create' => true,
    'category' => esc_html__( 'CmsSuperheroes Shortcodes', 'wp-metrics' ),
    'icon' => 'icon-wpb-toggle-small-expand',
    'params' => $params
) );

class WPBakeryShortCode_CMS_Fancy_Box extends CmsShortCode {
    protected function content( $atts, $content = null ) {
        return parent::content( $atts, $content );
    }
}