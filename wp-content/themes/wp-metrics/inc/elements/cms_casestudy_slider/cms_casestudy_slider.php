<?php defined( 'ABSPATH' ) or exit();

$params = array(
    array(
        'type' => 'textfield',
        'heading' => esc_html__( 'Extra class name', 'wp-metrics' ),
        'param_name' => 'el_class',
        'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'wp-metrics' ),
    ),
    array(
        'type' => 'checkbox',
        'heading' => esc_html__( 'Auto Play','wp-metrics' ),
        'param_name' => 'auto',
        'edit_field_class' => 'vc_col-sm-6 vc_column',
        'value' => array( esc_html__( 'Yes', 'wp-metrics' ) => 'yes' )
    ),
    array(
        'type' => 'checkbox',
        'heading' => esc_html__( 'Stop On Hover', 'wp-metrics' ),
        'param_name' => 'auto_hover',
        'edit_field_class' => 'vc_col-sm-6 vc_column',
        'value' => array( esc_html__( 'Yes', 'wp-metrics' ) => 'yes' ),
        'dependency' => array(
            'element' => 'autoplay',
            'value' => 'yes'
        )
    ),
    array(
        'type' => 'checkbox',
        'heading' => esc_html__( 'Touch Drag', 'wp-metrics' ),
        'param_name' => 'touch_enabled',
        'edit_field_class' => 'vc_col-sm-6 vc_column',
        'value' => array( esc_html__( 'Yes', 'wp-metrics' ) => 'yes' ),
        'std' => 'yes'
    ),
    array(
        'type' => 'checkbox',
        'heading' => esc_html__( 'Show Pagination', 'wp-metrics' ),
        'param_name' => 'pager',
        'edit_field_class' => 'vc_col-sm-6 vc_column',
        'value' => array( esc_html__( 'Yes', 'wp-metrics' ) => 'yes' )
    ),
    array(
        'type' => 'checkbox',
        'heading' => esc_html__( 'Show Navigation', 'wp-metrics' ),
        'param_name' => 'controls',
        'edit_field_class' => 'vc_col-sm-6 vc_column',
        'value' => array( esc_html__( 'Yes', 'wp-metrics' ) => 'yes' ),
        'std' => 'yes'
    ),
    array(
        'type' => 'checkbox',
        'heading' => esc_html__( 'Rewind Navigation', 'wp-metrics' ),
        'param_name' => 'infinite_loop',
        'edit_field_class' => 'vc_col-sm-6 vc_column',
        'value' => array( esc_html__( 'Yes', 'wp-metrics' ) => 'yes' ),
        'std' => 'yes',
        'dependency' => array(
            'element' => 'controls',
            'value' => 'yes'
        )
    ),
    array(
        'type' => 'checkbox',
        'heading' => esc_html__( 'Hide Navigation on End', 'wp-metrics' ),
        'param_name' => 'hide_control_on_end',
        'edit_field_class' => 'vc_col-sm-6 vc_column',
        'value' => array( esc_html__( 'Yes', 'wp-metrics' ) => 'yes' ),
        'dependency' => array(
            'element' => 'infinite_loop',
            'value_not_equal_to' => 'yes'
        )
    ),
    array(
        'type' => 'checkbox',
        'heading' => esc_html__( 'Custom next/prev icon', 'wp-metrics' ),
        'param_name' => 'custom_nav_icons',
        'edit_field_class' => 'vc_col-sm-6 vc_column',
        'value' => array( esc_html__( 'Yes', 'wp-metrics' ) => 'yes' ),
        'dependency' => array(
            'element' => 'controls',
            'value' => 'yes'
        )
    ),
    array(
        'type' => 'textfield',
        'heading' => esc_html__( 'Slide Speed', 'wp-metrics' ),
        'param_name' => 'speed',
        'value' => '500',
        'description' => esc_html__( 'Slide speed in milliseconds', 'wp-metrics' )
    ),
    array(
        'type' => 'textfield',
        'heading' => esc_html__( 'Auto Play Time Out', 'wp-metrics' ),
        'param_name' => 'pause',
        'value' => '5000',
        'description' => esc_html__( 'Autoplay time out in milliseconds', 'wp-metrics' ),
        'dependency' => array(
            'element' =>'auto',
            'value' => 'yes'
        )
    ),
    array(
        'type' => 'css_editor',
        'heading' => esc_html__( 'CSS box', 'wp-metrics' ),
        'param_name' => 'css',
        'group' => esc_html__( 'Design Options', 'wp-metrics' ),
    )
);

vc_map( array(
    'name' => esc_html__( 'CMS Case Study Slider', 'wp-metrics' ),
    'base' => 'cms_casestudy_slider',
    'as_parent' => array( 'only' => 'cms_casestudy' ),
    'content_element' => true,
    'show_settings_on_create' => true,
    'is_container' => true,
    'params' => $params,
    'icon' => 'icon-wpb-ui-pageable',
    'category' => esc_html__( 'CmsSuperheroes Shortcodes', 'wp-metrics' ),
    'description' => esc_html__( 'Eye catching vertical slider', 'wp-metrics' ),
    'js_view' => 'VcColumnView'
) );


class WPBakeryShortCode_CMS_CaseStudy_Slider extends WPBakeryShortCodesContainer {
    protected static $carousel_index = 1;
    public function __construct( $settings ) {
        parent::__construct( $settings );
        $this->jsCssScripts();
    }

    public function jsCssScripts() {
        wp_register_script( 'bx-slider', get_template_directory_uri() . '/assets/js/jquery.bxslider.min.js', array( 'jquery' ), '', true );
        wp_register_style( 'bx-slider', get_template_directory_uri() . '/assets/css/jquery.bxslider.css' );
    }

    public function getCarouselIndex() {
        return self::$carousel_index ++ . '-' . time();
    }

    public function getCarouselOptions( $atts ) {
        $data_attr = array();

        $data_attr[] = esc_html( '"minSlides":1' );
        $data_attr[] = esc_html( '"mode":"vertical"' );
        $data_attr[] = esc_html( '"useCSS":false' );
        $data_attr[] = esc_html( '"preventDefaultSwipeX":true' );

        if ( isset( $atts['auto'] ) && 'yes' == $atts['auto'] ) {
            $data_attr[] = esc_html( '"auto":true' );
            $data_attr[] = isset( $atts['auto_hover'] ) && 'yes' == $atts['auto_hover'] ? esc_html( '"autoHover":true' ) : esc_html( '"autoHover":false' );
            if ( isset( $atts['pause'] ) ) {
                $pause = (int)$atts['pause'];
                $data_attr[] = $pause > 0 ? esc_html( '"pause":' . $pause ) : esc_html( '"pause":4000' );
            }
        }
        else {
            $data_attr[] = esc_html( '"auto":false' );
        }

        if ( isset( $atts['speed'] ) ) {
            $speed = (int)$atts['speed'];
            $data_attr[] = $speed > 0 ? esc_html( '"speed":' . $speed ) : esc_html( '"speed":500' );
        }
        else {
             $data_attr[] = esc_html( '"speed":500' );
        }

        if ( isset( $atts['controls'] ) && 'yes' == $atts['controls'] ) {
            $data_attr[] = esc_html( '"controls":true' );
            if ( isset( $atts['infinite_loop'] ) && 'yes' == $atts['infinite_loop'] ) {
                $data_attr[] = esc_html( '"infiniteLoop":true');
            }
            else {
                $data_attr[] = esc_html( '"infiniteLoop":false');
            }
        }
        else {
            $data_attr[] = esc_html( '"controls":false' );
        }
        if ( isset( $atts['pager'] ) && 'yes' == $atts['pager'] ) {
            $data_attr[] = esc_html( '"pager":true' );
        }
        else {
            $data_attr[] = esc_html( '"pager":false' );
        }
        return $data_attr;
    }
}