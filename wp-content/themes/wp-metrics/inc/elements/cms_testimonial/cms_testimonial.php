<?php defined( 'ABSPATH' ) or exit();
$params = array_merge(
    array(
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Title', 'wp-metrics' ),
            'param_name' => 'title',
            'description' => esc_html__( 'Title will be used as testimonial author.', 'wp-metrics' ),
            'std' => esc_html__( 'Author name', 'wp-metrics' ),
            'admin_label' => true
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Role', 'wp-metrics' ),
            'param_name' => 'role',
            'description' => esc_html__( 'Author role.', 'wp-metrics' ),
            'std' => esc_html__( 'Designer', 'wp-metrics' )
        ),
        array(
            'type' => 'textarea',
            'heading' => esc_html__( 'Testimonial', 'wp-metrics' ),
            'param_name' => 'testimonial',
            'description' => esc_html__( 'Testimonial content.', 'wp-metrics' ),
            'std' => esc_html__( 'Metrics theme is the best theme ever.', 'wp-metrics' )
        ),
        array(
            'type'          => 'vc_link',
            'param_name'    => 'link',
            'heading'       => esc_html__( 'URL (Link)', 'wp-metrics' ),
            'description'   => esc_html__( 'Add link to author name, invidual post link or external link.', 'wp-metrics' )
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__( 'Title Color', 'wp-metrics' ),
            'param_name' => 'color_title',
            'edit_field_class' => 'vc_col-sm-4 vc_column'
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__( 'Icon Color', 'wp-metrics' ),
            'param_name' => 'color_icon',
            'edit_field_class' => 'vc_col-sm-4 vc_column'
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__( 'Text Color', 'wp-metrics' ),
            'param_name' => 'color_text',
            'edit_field_class' => 'vc_col-sm-4 vc_column'
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__( 'Author Role Color', 'wp-metrics' ),
            'param_name' => 'color_role',
            'edit_field_class' => 'vc_col-sm-4 vc_column'
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__( 'Background Color', 'wp-metrics' ),
            'param_name' => 'color_bg',
            'edit_field_class' => 'vc_col-sm-8 vc_column'
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Extra class name', 'wp-metrics' ),
            'param_name' => 'el_class',
            'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'wp-metrics' ),
        ),
        array(
            'type' => 'cms_template_img',
            'param_name' => 'cms_template',
            'value' => 'cms_testimonial.php',
            'shortcode' => 'cms_testimonial',
            'admin_label' => true,
            'heading' => esc_html__( 'Template','wp-metrics' ),
            'group' => esc_html__( 'Template','wp-metrics' )
        ),
    ),
    vc_map_integrate_shortcode( 'vc_single_image', 'img_', esc_html__( 'Image', 'wp-metrics' ),
        array(
            'exclude'   => array( 'title', 'caption', 'add_caption', 'style' ,'external_style', 'border_color', 'external_border_color', 'alignment', 'onclick', 'link', 'img_link_target', 'el_class', 'css_animation', 'css' )
        )
    )
);

vc_map( array(
    'name'          => esc_html__( 'CMS Testimonial', 'wp-metrics' ),
    'base'          => 'cms_testimonial',
    'icon'          => 'icon-wpb-layer-shape-text',
    'description'   => esc_html__( 'Client testimonial', 'wp-metrics' ),
    'params'        => $params,
    'category'      => esc_html__( 'CmsSuperheroes Shortcodes', 'wp-metrics' ),
) );

class WPBakeryShortCode_CMS_Testimonial extends CmsShortCode {
    protected function content( $atts, $content = null ) {
        return parent::content( $atts, $content );
    }
}