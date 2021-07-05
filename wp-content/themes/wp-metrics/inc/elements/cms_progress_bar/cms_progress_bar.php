<?php defined( 'ABSPATH' ) or exit();

$params = array(
    array(
        'type' => 'textfield',
        'heading' => esc_html__( 'Title', 'wp-metrics' ),
        'param_name' => 'title',
        'holder' => 'div'
    ),
    array(
        'type' => 'colorpicker',
        'heading' => esc_html__( 'Bar color', 'wp-metrics' ),
        'param_name' => 'color',
        'edit_field_class' => 'vc_col-sm-6 vc_column',
        'description' => esc_html__( 'Leave blank to use default theme color', 'wp-metrics' )
    ),
    array(
        'type' => 'colorpicker',
        'heading' => esc_html__( 'Bar background color', 'wp-metrics' ),
        'param_name' => 'bar_bg',
        'edit_field_class' => 'vc_col-sm-6 vc_column',
        'description' => esc_html__( 'Leave blank to use default theme color', 'wp-metrics' )

    ),
    array(
        'type' => 'colorpicker',
        'heading' => esc_html__( 'Text color', 'wp-metrics' ),
        'param_name' => 'text_color',
        'edit_field_class' => 'vc_col-sm-6 vc_column',
        'description' => esc_html__( 'Leave blank to use default theme color', 'wp-metrics' )
    ),
    array(
        'type' => 'colorpicker',
        'heading' => esc_html__( 'Text value color', 'wp-metrics' ),
        'param_name' => 'value_color',
        'edit_field_class' => 'vc_col-sm-6 vc_column',
        'description' => esc_html__( 'Leave blank to use default theme color', 'wp-metrics' )

    ),
    array(
        'type' => 'textfield',
        'heading' => esc_html__( 'Bar value', 'wp-metrics' ),
        'param_name' => 'value',
        'description' => esc_html__( 'Set bar value in percent (%)', 'wp-metrics' ),
        'std' => '60'
    ),
    array(
        'type' => 'cms_template',
        'param_name' => 'cms_template',
        'shortcode' => 'cms_progress_bar',
        'value' => 'cms_progress_bar.php',
        'admin_label' => true,
        'heading' => esc_html__( 'Template','wp-metrics' ),
    ),
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
    'name'          => esc_html__( 'CMS Progress Bar', 'wp-metrics' ),
    'base'          => 'cms_progress_bar',
    'description'   => esc_html__( 'Fancy progress bar', 'wp-metrics' ),
    'category'      => esc_html__( 'CmsSuperheroes Shortcodes', 'wp-metrics'),
    'params'        => $params
) );

class WPBakeryShortCode_CMS_Progress_Bar extends CmsShortCode {
    protected static $shortcode_index = 1;

    public function __construct( $settings ) {
        parent::__construct( $settings );
        $this->progressBarScripts();
    }

    protected function content( $atts, $content = null ) {
        return parent::content( $atts, $content );
    }

    public function progressBarScripts() {
        wp_register_script( 'bootstrap-progressbar', get_template_directory_uri() . '/assets/js/bootstrap-progressbar.min.js', array( 'jquery' ), '', true );
    }



    public function getProgressBarIndex() {
        return self::$shortcode_index ++;
    }
}