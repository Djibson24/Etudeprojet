<?php defined( 'ABSPATH' ) or exit();
/**
 * Call to action for Visual Composer
 */
$cta_icon = vc_map_integrate_shortcode( 'cms_icon', 'i_', esc_html__( 'Icon', 'wp-metrics' ),
    array(
        'include_only_regex' => '/^(type|icon_\w*)/',
        // we need only type, icon_fontawesome, icon_blabla..., NOT color and etc
    ), array(
        'element' => 'add_icon',
        'value_not_equal_to' => 'none',
    )
);

if ( is_array( $cta_icon ) && ! empty( $cta_icon ) ) {
    foreach ( $cta_icon as $key => $param ) {
        if ( is_array( $param ) && ! empty( $param ) ) {
            if ( isset( $param['admin_label'] ) ) {
                // remove admin label
                unset( $cta_icon[ $key ]['admin_label'] );
            }
        }
    }
}

$cta_btn1 = vc_map_integrate_shortcode( 'cms_btn', 'button_1_', esc_html__( 'Button 1', 'wp-metrics' ),
    array(
        'exclude'   => array( 'container', 'align', 'add_icon', 'i_type', 'i_icon_fontawesome', 'i_icon_openiconic', 'i_icon_typicons', 'i_icon_entypo', 'i_icon_linecons', 'i_icon_strokegapicons', 'icon_align', 'css_animation', 'el_class', 'css' ),
    ), array(
        'element' => 'add_button',
        'value_not_equal_to' => 'none'
    )
);

$cta_btn2 = vc_map_integrate_shortcode( 'cms_btn', 'button_2_', esc_html__( 'Button 2', 'wp-metrics' ),
    array(
        'exclude'   => array( 'container', 'align', 'add_icon', 'i_type', 'i_icon_fontawesome', 'i_icon_openiconic', 'i_icon_typicons', 'i_icon_entypo', 'i_icon_linecons', 'i_icon_strokegapicons', 'icon_align', 'css_animation', 'el_class', 'css' ),
    ), array(
        'element' => 'add_extra_button',
        'not_empty' => true
    )
);

$params = array_merge(
    array(
        array(
            'type'          => 'textfield',
            'param_name'    => 'title',
            'heading'       => esc_html__( 'Title', 'wp-metrics' )
        ),
        array(
            'type'          => 'textfield',
            'param_name'    => 'subtitle',
            'heading'       => esc_html__( 'Sub Title', 'wp-metrics' )
        ),
        array(
            'type'          => 'dropdown',
            'param_name'    => 'subtitle_pos',
            'heading'       => esc_html__( 'Sub Title Position', 'wp-metrics' ),
            'value'         => array(
                esc_html__( 'Top', 'wp-metrics' ) => 'top',
                esc_html__( 'Bottom', 'wp-metrics' ) => 'bottom',
            )
        ),
        array(
            'type'          => 'textarea_html',
            'param_name'    => 'content',
            'heading'       => esc_html__( 'Content', 'wp-metrics' )
        ),
        array(
            'type'          => 'dropdown',
            'param_name'    => 'add_icon',
            'heading'       => esc_html__( 'Add icon', 'wp-metrics' ),
            'group'         => esc_html__( 'Icon', 'wp-metrics' ),
            'value'         => array(
                esc_html__( 'None', 'wp-metrics' ) => 'none',
                esc_html__( 'Left', 'wp-metrics' ) => 'left',
                esc_html__( 'Top', 'wp-metrics' ) => 'top',
                esc_html__( 'Right', 'wp-metrics' ) => 'right',
                esc_html__( 'Bottom', 'wp-metrics' ) => 'bottom',
            )
        )
    ),
    $cta_icon,
    array(
        array(
            'type'          => 'dropdown',
            'param_name'    => 'add_button',
            'heading'       => esc_html__( 'Add Button', 'wp-metrics' ),
            'value'         => array(
                esc_html__( 'None', 'wp-metrics' ) => 'none',
                esc_html__( 'Left', 'wp-metrics' ) => 'left',
                esc_html__( 'Top', 'wp-metrics' ) => 'top',
                esc_html__( 'Right', 'wp-metrics' ) => 'right',
                esc_html__( 'Bottom', 'wp-metrics' ) => 'bottom',
            )
        ),
        array(
            'type'          => 'checkbox',
            'param_name'    => 'add_extra_button',
            'heading'       => esc_html__( 'Add Extra Button', 'wp-metrics' ),
            'dependency'    => array(
                'element'   => 'add_button',
                'value_not_equal_to' => 'none'
            )
        )
    ),
    $cta_btn1,
    $cta_btn2,
    array(
        array(
            'type'          => 'colorpicker',
            'param_name'    => 'color_title',
            'heading'       => esc_html__( 'Title Color', 'wp-metrics' ),
            'edit_field_class' => 'vc_col-sm-6 vc_column'
        ),
        array(
            'type'          => 'colorpicker',
            'param_name'    => 'color_subtitle',
            'heading'       => esc_html__( 'Sub Title Color', 'wp-metrics' ),
            'edit_field_class' => 'vc_col-sm-6 vc_column'
        ),
        array(
            'type'          => 'colorpicker',
            'param_name'    => 'color_text',
            'heading'       => esc_html__( 'Text Color', 'wp-metrics' ),
            'edit_field_class' => 'vc_col-sm-6 vc_column'
        ),
        array(
            'type'          => 'colorpicker',
            'param_name'    => 'color_icon',
            'heading'       => esc_html__( 'Icon Color', 'wp-metrics' ),
            'edit_field_class' => 'vc_col-sm-6 vc_column'
        ),
    ),
    array(
        vc_map_add_css_animation( true ),
        array(
            'type'          => 'textfield',
            'param_name'    => 'el_class',
            'heading'       => esc_html__( 'Extra class name', 'wp-metrics' ),
            'description'   => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'wp-metrics' ),
        ),
        array(
            'type' => 'cms_template',
            'param_name' => 'cms_template',
            'shortcode' => 'cms_cta',
            'value' => 'cms_cta.php',
            'admin_label' => true,
            'heading' => esc_html__( 'Template','wp-metrics' ),
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
    'name' => esc_html__( 'CMS Call To Action', 'wp-metrics' ),
    'base' => 'cms_cta',
    'icon' => 'icon-wpb-call-to-action',
    'description' => esc_html__( 'Call to Action Box', 'wp-metrics' ),
    'show_settings_on_create'   => true,
    'category' => esc_html__( 'CmsSuperheroes Shortcodes', 'wp-metrics' ),
    'params' => $params,
    'js_view' => 'VcCallToActionView3',
) );

class WPBakeryShortCode_CMS_Cta extends CmsShortCode {
    protected function content( $atts, $content = null ) {
        return parent::content( $atts, $content );
    }
}