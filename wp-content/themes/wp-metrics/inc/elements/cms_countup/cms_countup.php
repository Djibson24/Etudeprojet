<?php defined( 'ABSPATH' ) or exit();

$counter_icon = vc_map_integrate_shortcode( 'cms_icon', 'i_', esc_html__( 'Icon', 'wp-metrics' ),
    array(
        'include_only_regex' => '/^(type|icon_\w*)/',
        // we need only type, icon_fontawesome, icon_blabla..., NOT color and etc
    ), array(
        'element' => 'add_icon',
        'not_empty' => true,
    )
);

if ( is_array( $counter_icon ) && ! empty( $counter_icon ) ) {
    foreach ( $counter_icon as $key => $param ) {
        if ( is_array( $param ) && ! empty( $param ) ) {
            if ( isset( $param['admin_label'] ) ) {
                // remove admin label
                unset( $counter_icon[ $key ]['admin_label'] );
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
            'admin_label' => true
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Type', 'wp-metrics' ),
            'param_name' => 'type',
            'value' => array(
                esc_html__( 'From Zero', 'wp-metrics' ) => 'zero',
                esc_html__( 'Random', 'wp-metrics' ) => 'random'
            )
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Start Number', 'wp-metrics' ),
            'edit_field_class' => 'vc_col-sm-6 vc_column',
            'param_name' => 'start',
            'std' => '0',
            'dependency' => array(
                'element' => 'type',
                'value' => 'zero'
            )
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'End Number', 'wp-metrics' ),
            'edit_field_class' => 'vc_col-sm-6 vc_column',
            'param_name' => 'end',
            'std' => '1000'
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Decimals', 'wp-metrics' ),
            'param_name' => 'decimals',
            'value' => array(
                esc_html__( 'No decimals', 'wp-metrics' ) => '',
                '1' => '1',
                '2' => '2',
                '3' => '3',
                '4' => '4',
                '5' => '5',
                '6' => '6',
                '7' => '7',
                '8' => '8',
                '9' => '9',
            )
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Decimal Mark', 'wp-metrics' ),
            'param_name' => 'decimal',
            'value' => '',
            'std' => '.',
            'dependency' => array(
                'element' => 'decimals',
                'not_empty' => true
            )
        ),
        array(
            'type' => 'checkbox',
            'heading' => esc_html__( 'Grouping number', 'wp-metrics' ),
            'param_name' => 'use_grouping',
            'value' => array( esc_html__( 'Yes', 'wp-metrics' ) => 'yes' )
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Grouping seperator', 'wp-metrics' ),
            'param_name' => 'seperator',
            'value' => '',
            'std' => ',',
            'dependency' => array(
                'element' => 'use_grouping',
                'value' => 'yes'
            )
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Before Number', 'wp-metrics' ),
            'edit_field_class' => 'vc_col-sm-6 vc_column',
            'param_name' => 'prefix',
            'description' => esc_html__( 'Set custom text before the number', 'wp-metrics' )
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'After Number', 'wp-metrics' ),
            'edit_field_class' => 'vc_col-sm-6 vc_column',
            'param_name' => 'suffix',
            'description' => esc_html__( 'Set custom text after the number', 'wp-metrics' )
        ),
        array(
            'type' => 'checkbox',
            'heading' => esc_html__( 'Use Easing', 'wp-metrics' ),
            'param_name' => 'use_easing',
            'description' => esc_html__( 'Use simple easing animation', 'wp-metrics' )
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Duration', 'wp-metrics' ),
            'param_name' => 'duration',
            'description' => esc_html__( 'Set animation duration, in seconds', 'wp-metrics' ),
            'std' => '2.5'
        ),
        array(
            'type' => 'checkbox',
            'heading' => esc_html__( 'Add icon to counter', 'wp-metrics' ),
            'param_name' => 'add_icon'
        )
    ),
    $counter_icon,
    array(
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Color scheme', 'wp-metrics' ),
            'param_name' => 'color',
            'value' => array(
                esc_html__( 'Default', 'wp-metrics' ) => '',
                esc_html__( 'Dark', 'wp-metrics' ) => 'dark',
                esc_html__( 'Light', 'wp-metrics' ) => 'light',
                esc_html__( 'Custom', 'wp-metrics' ) => 'custom',
            )
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__( 'Icon Color', 'wp-metrics' ),
            'param_name' => 'color_icon',
            'edit_field_class' => 'vc_col-sm-4 vc_column',
            'dependency' => array(
                'element' => 'color',
                'value' => 'custom'
            )
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__( 'Title Color', 'wp-metrics' ),
            'param_name' => 'color_title',
            'edit_field_class' => 'vc_col-sm-4 vc_column',
            'dependency' => array(
                'element' => 'color',
                'value' => 'custom'
            )
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__( 'Number Color', 'wp-metrics' ),
            'param_name' => 'color_number',
            'edit_field_class' => 'vc_col-sm-4 vc_column',
            'dependency' => array(
                'element' => 'color',
                'value' => 'custom'
            )
        ),
        array(
            'type'          => 'textfield',
            'param_name'    => 'el_class',
            'heading'       => esc_html__( 'Extra class name', 'wp-metrics' ),
            'description'   => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'wp-metrics' ),
        ),
        array(
            'type' => 'cms_template_img',
            'param_name' => 'cms_template',
            'shortcode' => 'cms_countup',
            'value' => 'cms_countup.php',
            'admin_label' => true,
            'heading' => esc_html__( 'Template','wp-metrics' ),
            'group' => esc_html__( 'Template', 'wp-metrics' )
        ),
    )
);

vc_map( array(
    'name' => esc_html__( 'CMS Count Up', 'wp-metrics' ),
    'base' => 'cms_countup',
    'description' => esc_html__( 'Animated number counter', 'wp-metrics' ),
    'category' => esc_html__( 'CmsSuperheroes Shortcodes', 'wp-metrics' ),
    'icon' => 'cms-vc-icon cms-vc-icon-counter',
    'as_child' => array( 'only' => 'cms_countups' ),
    'params' => $params
) );

class WPBakeryShortCode_CMS_CountUp extends CmsShortCode {
    protected static $counter_index = 1;
    public function __construct( $settings ) {
        parent::__construct( $settings );
        $this->jsCssScripts();
    }

    protected function content( $atts, $content = null ) {
        return parent::content( $atts, $content );
    }

    public function jsCssScripts() {
        if ( ! wp_script_is( 'count-up', 'registered' ) ) {
            wp_register_script( 'count-up', get_template_directory_uri() . '/assets/js/countUp.js', array( 'jquery' ), '', true );
        }
    }

    public function getCounterIndex() {
        return self::$counter_index ++ . '-' . time();
    }

    public function getCounterOptions( $atts ) {
        $data_attr = array();

        $data_attr[] = isset( $atts['use_easing'] ) && 'yes' == $atts['use_easing'] ? esc_html( '"useEasing":true' ) : esc_html( '"useEasing":false' );

        if ( isset( $atts['use_grouping'] ) && 'yes' == $atts['use_grouping'] ) {
            $data_attr[] = esc_html( '"useGrouping":true' );
            $data_attr[] = isset( $atts['seperator'] ) && '' != $atts['seperator'] ? esc_html( '"separator":"' . $atts['seperator'] . '"' ) : esc_html( '"separator":""' );
        }
        else {
            $data_attr[] = esc_html( '"useGrouping":false' );
            $data_attr[] = esc_html( '"separator":""' );
        }

        $data_attr[] = isset( $atts['decimal'] ) && '' != $atts['decimal'] ? esc_html( '"decimal":"' . $atts['decimal'] . '"' ) : esc_html( '"decimal":""' );
        
        $data_attr[] = isset( $atts['prefix'] ) && '' != $atts['prefix'] ? esc_html( '"prefix":"' . $atts['prefix'] . '"' ) : esc_html( '"prefix":""' );
        $data_attr[] = isset( $atts['suffix'] ) && '' != $atts['suffix'] ? esc_html( '"suffix":"' . $atts['suffix'] . '"' ) : esc_html( '"suffix":""' );

        return $data_attr;
    }

    public function getCounterCustomizations( $atts ) {
        $custom_attr = array();
        if ( isset( $atts['type'] ) ) {
            switch ( $atts['type'] ) {
                case 'random':
                    $custom_attr[] = esc_html( '"start":"random"' );
                    break;
                
                default:
                    if ( isset( $atts['start'] ) && is_numeric( $atts['start'] ) ) {
                        $custom_attr[] = esc_html( '"start":' . $atts['start'] );
                    }
                    else {
                        $custom_attr[] = esc_html( '"start":0' );
                    }
                    break;
            }
        }

        if ( isset( $atts['end'] ) && is_numeric( $atts['end'] ) ) {
            $custom_attr[] = esc_html( '"end":' . $atts['end'] );
        }
        else {
            $custom_attr[] = esc_html( '"end":1' );
        }

        if ( isset( $atts['decimals'] ) && is_numeric( $atts['decimals'] ) ) {
            $custom_attr[] = esc_html( '"decimals":' . $atts['decimals'] );
        }
        else {
            $custom_attr[] = esc_html( '"decimals":0' );
        }

        if ( isset( $atts['duration'] ) && is_numeric( $atts['duration'] ) ) {
            $custom_attr[] = esc_html( '"duration":' . $atts['duration'] );
        }
        else {
            $custom_attr[] = esc_html( '"duration":2.5' );
        }

        return $custom_attr;
    }
}