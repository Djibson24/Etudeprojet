<?php defined( 'ABSPATH' ) or exit();
/**
 * Heading element for Visual Composer
 *
 * @package CMSSuperHeroes
 * @subpackage WPMetrics
 */
$params = array(
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
        'type' => 'textarea',
        'heading' => esc_html__( 'Description', 'wp-metrics' ),
        'param_name' => 'desc'
    ),
    array(
        'type' => 'checkbox',
        'heading' => esc_html__( 'Disable title shadow', 'wp-metrics' ),
        'param_name' => 'no_shadow'
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
        'heading' => esc_html__( 'Seperator Type', 'wp-metrics' ),
        'edit_field_class' => 'vc_col-sm-6 vc_column',
        'param_name' => 'sep_type',
        'value' => array(
            esc_html__( 'Vertical', 'wp-metrics' ) => 'vertical',
            esc_html__( 'Horizontal', 'wp-metrics' ) => 'horizontal',
            esc_html__( 'Border', 'wp-metrics' ) => 'border',
            esc_html__( 'None', 'wp-metrics' ) => 'none'
        )
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
        'type' => 'colorpicker',
        'heading' => esc_html__( 'Seperator Color', 'wp-metrics' ),
        'edit_field_class' => 'vc_col-sm-6 vc_column',
        'param_name' => 'color_sep'
    ),
    array(
        'type' => 'cms_template_img',
        'param_name' => 'cms_template',
        'shortcode' => 'cms_heading',
        'group' => esc_html__( 'Template', 'wp-metrics' ),
        'value' => 'cms_heading.php',
        'admin_label' => true,
        'heading' => esc_html__( 'Template','wp-metrics' ),
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
);

vc_map( array(
    'name' => esc_html__( 'CMS Heading', 'wp-metrics'),
    'base' => 'cms_heading',
    'description' => esc_html__( 'Eye-catching headings', 'wp-metrics' ),
    'icon' => 'icon-wpb-ui-custom_heading',
    'category' => esc_html__( 'CmsSuperheroes Shortcodes', 'wp-metrics'),
    'params' => $params
) );

class WPBakeryShortCode_CMS_Heading extends CmsShortCode {
    protected function content( $atts, $content = null ) {
        return parent::content( $atts, $content );
    }
}