<?php defined( 'ABSPATH' ) or exit();
$params = array_merge(
    array(
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Title', 'wp-metrics' ),
            'param_name' => 'title',
            'admin_label' => true
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Sub Title', 'wp-metrics' ),
            'param_name' => 'subtitle'
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Sub Title Position', 'wp-metrics' ),
            'edit_field_class' => 'vc_col-sm-6 vc_column',
            'param_name' => 'subtitle_pos',
            'value' => array(
                esc_html__( 'Bottom', 'wp-metrics' ) => 'bottom',
                esc_html__( 'Top', 'wp-metrics' ) => 'top'
            )
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Collapsing', 'wp-metrics' ),
            'edit_field_class' => 'vc_col-sm-6 vc_column',
            'param_name' => 'collapse',
            'value' => array(
                '1200px' => 'vc_col-lg-6',
                '992px' => 'vc_col-md-6',
                '768px' => 'vc_col-sm-6',
            ),
            'std' => 'vc_col-lg-6 vc_col-fill-spaces'
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__( 'Title Color', 'wp-metrics' ),
            'edit_field_class' => 'vc_col-sm-6 vc_column',
            'param_name' => 'color_title'
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__( 'Sub Title Color', 'wp-metrics' ),
            'edit_field_class' => 'vc_col-sm-6 vc_column',
            'param_name' => 'color_subtitle'
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__( 'Description Color', 'wp-metrics' ),
            'edit_field_class' => 'vc_col-sm-6 vc_column',
            'param_name' => 'color_desc'
        ),
        array(
            'type' => 'textarea_html',
            'holder' => 'div',
            'heading' => esc_html__( 'Text', 'wp-metrics' ),
            'param_name' => 'content',
            'value' => esc_html__( 'I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'wp-metrics' ),
        ),
        array(
            'type' => 'attach_images',
            'heading' => esc_html__( 'Images', 'wp-metrics' ),
            'param_name' => 'images',
            'value' => '',
            'description' => esc_html__( 'Select images from media library.', 'wp-metrics' )
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Image size', 'wp-metrics' ),
            'param_name' => 'img_size',
            'value' => 'thumbnail',
            'description' => esc_html__( 'Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "thumbnail" size.', 'wp-metrics' ),
        ),
    ),
    vc_map_integrate_shortcode( 'vc_single_image', 'featuredimg_', esc_html__( 'Featured Image', 'wp-metrics' ),
        array(
            'exclude' => array( 'title', 'external_img_size', 'caption', 'add_caption', 'alignment', 'style', 'external_style', 'border_color', 'external_border_color', 'el_class', 'css_animation', 'css'  )
        )
    ),
    array(
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Add button/link', 'wp-metrics' ),
            'group' => esc_html__( 'Button Link', 'wp-metrics' ),
            'param_name' => 'add_link',
            'value' => array(
                esc_html__( 'None', 'wp-metrics') => '',
                esc_html__( 'Link', 'wp-metrics') => 'link',
                esc_html__( 'Button', 'wp-metrics') => 'button'
            ),
            'std' => 'link'
        ),
        array(
            'type' => 'vc_link',
            'heading' => esc_html__( 'Link URL', 'wp-metrics' ),
            'group' => esc_html__( 'Button Link', 'wp-metrics' ),
            'param_name' => 'link',
            'dependency' => array(
                'element' => 'add_link',
                'value' => 'link'
            )
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__( 'Link Color', 'wp-metrics' ),
            'group' => esc_html__( 'Button Link', 'wp-metrics' ),
            'edit_field_class' => 'vc_col-sm-6 vc_column',
            'param_name' => 'color_link',
            'dependency' => array(
                'element' => 'add_link',
                'value' => 'link'
            )
        ),
    ),
    vc_map_integrate_shortcode( 'cms_btn', 'btn_', esc_html__( 'Button Link', 'wp-metrics' ),
        array(
            'exclude' => array( 'container', 'align', 'css_animation', 'el_class', 'css' )
        ),
        array(
            'element' => 'add_link',
            'value' => 'button'
        )
    ),
    array(
        array(
            'type' => 'cms_template',
            'param_name' => 'cms_template',
            'shortcode' => 'cms_casestudy',
            'value' => 'cms_casestudy.php',
            'admin_label' => true,
            'heading' => esc_html__( 'Template','wp-metrics' ),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Extra class name', 'wp-metrics' ),
            'param_name' => 'el_class',
            'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'wp-metrics' ),
        )
    )
);

vc_map( array(
    'name'          => esc_html__( 'CMS Case Study', 'wp-metrics' ),
    'base'          => 'cms_casestudy',
    'icon'          => 'icon-wpb-layer-shape-text',
    'description'   => esc_html__( 'Case study intro', 'wp-metrics' ),
    'params'        => $params,
    'as_child'      => array( 'only' => 'cms_casestudy_slider' )
) );

class WPBakeryShortCode_CMS_CaseStudy extends CmsShortCode {
    protected function content( $atts, $content = null ) {
        return parent::content( $atts, $content );
    }
}