<?php defined( 'ABSPATH' ) or exit();
/**
 * Additional params for Visual Composer Components
 *
 * @package CMSSuperHeroes
 * @subpackage WPMetrics
 */

// vc_tta_accordion
//--------------------------------------------------
vc_remove_param( 'vc_tta_accordion', 'style' );
$param = WPBMap::getParam( 'vc_tta_accordion', 'color' );
$param['value'] = array(
    esc_html__( 'Default', 'wp-metrics' ) => 'default',
    esc_html__( 'Dark', 'wp-metrics' ) => 'dark',
    esc_html__( 'Light', 'wp-metrics' ) => 'light'
);
$param['std'] = 'default';
vc_update_shortcode_param( 'vc_tta_accordion', $param );


// vc_tta_tabs
//--------------------------------------------------
vc_remove_param( 'vc_tta_tabs', 'style' );

$param = WPBMap::getParam( 'vc_tta_tabs', 'color' );
$param['value'] = array(
    esc_html__( 'Default', 'wp-metrics' ) => 'default',
    esc_html__( 'Dark', 'wp-metrics' ) => 'dark',
    esc_html__( 'Light', 'wp-metrics' ) => 'light'
);
$param['std'] = 'default';
vc_update_shortcode_param( 'vc_tta_tabs', $param );

// vc_tta_tour
//--------------------------------------------------
vc_remove_param( 'vc_tta_tour', 'style' );

$param = WPBMap::getParam( 'vc_tta_tour', 'color' );
$param['value'] = array(
    esc_html__( 'Default', 'wp-metrics' ) => 'default',
    esc_html__( 'Dark', 'wp-metrics' ) => 'dark',
    esc_html__( 'Light', 'wp-metrics' ) => 'light'
);
$param['std'] = 'default';
vc_update_shortcode_param( 'vc_tta_tour', $param );

// vc_section
//--------------------------------------------------
vc_add_param( 'vc_section', array(
    'type' => 'checkbox',
    'param_name' => 'overlay',
    'heading' => esc_html__( 'Enable Overlay', 'wp-metrics' ),
    'description' => esc_html__( 'Set background color / image and the color will show up above image. Recomended Color with alpha lower than 100%', 'wp-metrics' )
) );

// vc_row, vc_row_inner
//--------------------------------------------------
vc_add_param( 'vc_row', array(
    'type' => 'checkbox',
    'param_name' => 'overlay',
    'heading' => esc_html__( 'Enable Overlay', 'wp-metrics' ),
    'description' => esc_html__( 'Set background color / image and the color will show up above image. Recomended Color with alpha lower than 100%', 'wp-metrics' )
) );

vc_add_param( 'vc_row_inner', array(
    'type' => 'checkbox',
    'param_name' => 'overlay',
    'heading' => esc_html__( 'Enable Overlay', 'wp-metrics' ),
    'description' => esc_html__( 'Set background color / image and the color will show up above image. Recomended Color with alpha lower than 100%', 'wp-metrics' )
) );

// vc_column, vc_column_inner
//--------------------------------------------------
vc_add_param( 'vc_column', array(
    'type' => 'checkbox',
    'param_name' => 'fill_place',
    'heading' => esc_html__( 'Fill remaining space', 'wp-metrics' ),
    'description' => esc_html__( 'Set parent row to stretch, and this option will make your column to fill all remaining space.', 'wp-metrics' )
) );


vc_add_param( 'vc_column_inner', array(
    'type' => 'checkbox',
    'param_name' => 'fill_place',
    'heading' => esc_html__( 'Fill remaining space', 'wp-metrics' ),
    'description' => esc_html__( 'Set parent row to stretch, and this option will make your column to fill all remaining space.', 'wp-metrics' )
) );

// vc_column_text
//--------------------------------------------------
$theme_fonts = array();
$font = wpmetrics_get_theme_option( 'font_alt_1', false );
if ( isset( $font ) && ! empty( $font ) ) {
    if ( isset( $font['font-family'] ) && ! empty( $font['font-family'] ) ) {
        $theme_fonts[ strval( $font['font-family'] ) ] = 'font-alt-1';
    }
}

$font = null; $font = wpmetrics_get_theme_option( 'font_alt_2', false );
if ( isset( $font ) && ! empty( $font ) ) {
    if ( isset( $font['font-family'] ) && ! empty( $font['font-family'] ) ) {
        $theme_fonts[ strval( $font['font-family'] ) ] = 'font-alt-2';
    }
}

$font = wpmetrics_get_theme_option( 'font_alt_3', false );
if ( isset( $font ) && ! empty( $font ) ) {
    if ( isset( $font['font-family'] ) && ! empty( $font['font-family'] ) ) {
        $theme_fonts[ strval( $font['font-family'] ) ] = 'font-alt-3';
    }
}
vc_add_param( 'vc_column_text', array(
    'type' => 'dropdown',
    'param_name' => 'theme_font',
    'heading' => esc_html__( 'Built-in theme fonts', 'wp-metrics' ),
    'description' => esc_html__( 'Select font for the text, you can set these fonts at Appearance/Theme Options', 'wp-metrics' ),
    'value' => array_merge(
        array(
            esc_html__( 'Default', 'wp-metrics' ) => ''
        ),
        $theme_fonts
    ),
    'std' => 'font-alt-3'
) );
vc_add_param( 'vc_column_text', array(
    'type' => 'font_container',
    'param_name' => 'font_container',
    'settings' => array(
        'fields' => array(
            'font_size',
            'line_height',
            'font_size_description' => esc_html__( 'Enter font size.', 'wp-metrics' ),
            'line_height_description' => esc_html__( 'Enter line height.', 'wp-metrics' ),
        ),
    )
) );

// vc_custom_heading
//--------------------------------------------------
vc_add_param( 'vc_custom_heading', array(
    'type' => 'textfield',
    'param_name' => 'letter_spacing',
    'heading' => esc_html__( 'Letter spacing', 'wp-metrics' ),
    'description' => esc_html__( 'Enter letter spacing', 'wp-metrics' )
) );
vc_add_param( 'vc_custom_heading', vc_map_add_css_animation( true ) );


// vc_pie
//--------------------------------------------------

$pie_icons = vc_map_integrate_shortcode( 'cms_icon', 'i_', esc_html__( 'Extras', 'wp-metrics' ),
    array(
        'include_only_regex' => '/^(type|icon_\w*)/',
        // we need only type, icon_fontawesome, icon_blabla..., NOT color and etc
    ), array(
        'element' => 'add_icon',
        'not_empty' => true,
    )
);

if ( is_array( $pie_icons ) && ! empty( $pie_icons ) ) {
    foreach ( $pie_icons as $key => $param ) {
        if ( is_array( $param ) && ! empty( $param ) ) {
            if ( isset( $param['admin_label'] ) ) {
                // remove admin label
                unset( $pie_icons[ $key ]['admin_label'] );
            }
        }
    }
}

vc_add_param( 'vc_pie', array(
    'type' => 'dropdown',
    'param_name' => 'cms_style',
    'heading' => esc_html__( 'Custom styles', 'wp-metrics' ),
    'value' => array(
        esc_html__( 'Default', 'wp-metrics' ) => 'default',
        esc_html__( 'Thick border', 'wp-metrics' ) => 'thick'
    ),
    'group' => esc_html__( 'Extras', 'wp-metrics' )
) );

vc_add_param( 'vc_pie', array(
    'type' => 'colorpicker',
    'param_name' => 'cms_border_color',
    'heading' => esc_html__( 'Back border color', 'wp-metrics' ),
    'group' => esc_html__( 'Extras', 'wp-metrics' )
) );

vc_add_param( 'vc_pie', array(
    'type' => 'checkbox',
    'param_name' => 'add_icon',
    'heading' => esc_html__( 'Show icon instead of value', 'wp-metrics' ),
    'group' => esc_html__( 'Extras', 'wp-metrics' )
) );

foreach ( $pie_icons as $key => $icon )
{
    vc_add_param( 'vc_pie', $icon );
}