<?php defined( 'ABSPATH' ) or exit();
/**
 * Base params for some elements of the theme
 * 
 */

/**
 * Base params for carousels
 */
function wpmetrics_vc_cms_carousel_base_param() {
    return array(
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Initial Items', 'wp-metrics' ),
            'param_name' => 'items',
            'description' => esc_html__( 'Set initial number of items to show.', 'wp-metrics' ),
            'value' => '4'
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Mobiles', 'wp-metrics' ),
            'param_name' => 'items_mobile',
            'description' => esc_html__( 'Phones (<480px)', 'wp-metrics' ),
            'edit_field_class' => 'vc_col-sm-6 vc_column',
            'value' => array(
                esc_html__( 'Inherit from bigger', 'wp-metrics' ) => '',
                esc_html__( '1 Item', 'wp-metrics' ) => '1',
                esc_html__( '2 Items', 'wp-metrics' ) => '2',
                esc_html__( '3 Items', 'wp-metrics' ) => '3',
                esc_html__( '4 Items', 'wp-metrics' ) => '4',
                esc_html__( '5 Items', 'wp-metrics' ) => '5',
                esc_html__( '6 Items', 'wp-metrics' ) => '6'
            ),
            'std' => '1'
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Tablets', 'wp-metrics' ),
            'param_name' => 'items_tablet',
            'description' => esc_html__( 'Phones and small tablets (<767px)', 'wp-metrics' ),
            'edit_field_class' => 'vc_col-sm-6 vc_column',
            'value' => array(
                esc_html__( 'Inherit from bigger', 'wp-metrics' ) => '',
                esc_html__( '1 Item', 'wp-metrics' ) => '1',
                esc_html__( '2 Items', 'wp-metrics' ) => '2',
                esc_html__( '3 Items', 'wp-metrics' ) => '3',
                esc_html__( '4 Items', 'wp-metrics' ) => '4',
                esc_html__( '5 Items', 'wp-metrics' ) => '5',
                esc_html__( '6 Items', 'wp-metrics' ) => '6'
            ),
            'std' => '2'
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Small Desktops', 'wp-metrics' ),
            'param_name' => 'items_desktop_small',
            'description' => esc_html__( 'Tablets and small desktops (<992px)', 'wp-metrics' ),
            'edit_field_class' => 'vc_col-sm-6 vc_column',
            'value' => array(
                esc_html__( 'Inherit from bigger', 'wp-metrics' ) => '',
                esc_html__( '1 Item', 'wp-metrics' ) => '1',
                esc_html__( '2 Items', 'wp-metrics' ) => '2',
                esc_html__( '3 Items', 'wp-metrics' ) => '3',
                esc_html__( '4 Items', 'wp-metrics' ) => '4',
                esc_html__( '5 Items', 'wp-metrics' ) => '5',
                esc_html__( '6 Items', 'wp-metrics' ) => '6'
            ),
            'std' => '3'
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Desktops', 'wp-metrics' ),
            'param_name' => 'items_desktop',
            'description' => esc_html__( 'Desktops (<1200px)', 'wp-metrics' ),
            'edit_field_class' => 'vc_col-sm-6 vc_column',
            'value' => array(
                esc_html__( 'Inherit from initial', 'wp-metrics' ) => '',
                esc_html__( '1 Item', 'wp-metrics' ) => '1',
                esc_html__( '2 Items', 'wp-metrics' ) => '2',
                esc_html__( '3 Items', 'wp-metrics' ) => '3',
                esc_html__( '4 Items', 'wp-metrics' ) => '4',
                esc_html__( '5 Items', 'wp-metrics' ) => '5',
                esc_html__( '6 Items', 'wp-metrics' ) => '6'
            )
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Item spaces', 'wp-metrics' ),
            'param_name' => 'space',
            'value' => '30',
            'description' => esc_html__( 'Space between items in px', 'wp-metrics')
        ),
        array(
            'type' => 'checkbox',
            'heading' => esc_html__( 'Auto Play','wp-metrics' ),
            'param_name' => 'autoplay',
            'edit_field_class' => 'vc_col-sm-6 vc_column',
            'value' => array( esc_html__( 'Yes', 'wp-metrics' ) => 'yes' ),
            'std' => 'yes'
        ),
        array(
            'type' => 'checkbox',
            'heading' => esc_html__( 'Stop On Hover', 'wp-metrics' ),
            'param_name' => 'stop_on_hover',
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
            'param_name' => 'touch_drag',
            'edit_field_class' => 'vc_col-sm-6 vc_column',
            'value' => array( esc_html__( 'Yes', 'wp-metrics' ) => 'yes' ),
            'std' => 'yes'
        ),
        array(
            'type' => 'checkbox',
            'heading' => esc_html__( 'Mouse Drag', 'wp-metrics' ),
            'param_name' => 'mouse_drag',
            'edit_field_class' => 'vc_col-sm-6 vc_column',
            'value' => array( esc_html__( 'Yes', 'wp-metrics' ) => 'yes' ),
            'std' => 'yes'
        ),
        array(
            'type' => 'checkbox',
            'heading' => esc_html__( 'Show Navigation', 'wp-metrics' ),
            'param_name' => 'navigation',
            'edit_field_class' => 'vc_col-sm-6 vc_column',
            'value' => array( esc_html__( 'Yes', 'wp-metrics' ) => 'yes' ),
        ),
        array(
            'type' => 'checkbox',
            'heading' => esc_html__( 'Show Pagination', 'wp-metrics' ),
            'param_name' => 'pagination',
            'edit_field_class' => 'vc_col-sm-6 vc_column',
            'value' => array( esc_html__( 'Yes', 'wp-metrics' ) => 'yes' ),
            'std' => 'yes'
        ),
        array(
            'type' => 'checkbox',
            'heading' => esc_html__( 'Custom next/prev icon', 'wp-metrics' ),
            'param_name' => 'custom_nav_icons',
            'edit_field_class' => 'vc_col-sm-6 vc_column',
            'value' => array( esc_html__( 'Yes', 'wp-metrics' ) => 'yes' ),
            'dependency' => array(
                'element' => 'navigation',
                'value' => 'yes'
            )
        ),
        array(
            'type' => 'checkbox',
            'heading' => esc_html__( 'Rewind Navigation', 'wp-metrics' ),
            'param_name' => 'rewind_nav',
            'edit_field_class' => 'vc_col-sm-6 vc_column',
            'value' => array( esc_html__( 'Yes', 'wp-metrics' ) => 'yes' ),
            'std' => 'yes',
            'dependency' => array(
                'element' => 'navigation',
                'value' => 'yes'
            )
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Slide Speed', 'wp-metrics' ),
            'param_name' => 'slide_speed',
            'value' => '200',
            'description' => esc_html__( 'Slide speed in milliseconds', 'wp-metrics' )
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Pagination Speed', 'wp-metrics' ),
            'param_name' => 'pagination_speed',
            'value' => '800',
            'description' => esc_html__( 'Pagination speed in milliseconds', 'wp-metrics' ),
            'dependency' => array(
                'element' => 'pagination',
                'value' => 'yes'
            )
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Rewind Speed', 'wp-metrics' ),
            'param_name' => 'rewind_speed',
            'value' => '800',
            'description' => esc_html__( 'Rewind speed in milliseconds', 'wp-metrics' ),
            'dependency' => array(
                'element' => 'rewind_nav',
                'value' => 'yes'
            )
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Auto Play Time Out', 'wp-metrics' ),
            'param_name' => 'autoplay_timeout',
            'edit_field_class' => 'vc_col-sm-6 vc_column',
            'value' => '5000',
            'description' => esc_html__( 'Autoplay time out in milliseconds', 'wp-metrics' ),
            'dependency' => array(
                'element' =>'autoplay',
                'value' => 'true'
            )
        )
    );
}


/**
 * Base param for grid elements
 */
function wpmetrics_vc_cms_grid_base_param() {
    return array(
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Extra small devices','wp-metrics' ),
            'param_name' => 'col_xs',
            'description' => esc_html__( 'Phones (<768px)', 'wp-metrics' ),
            'edit_field_class' => 'vc_col-sm-6 vc_column',
            'value' => array(
                esc_html__( '1 Column', 'wp-metrics' ) => 'col-xs-12',
                esc_html__( '2 Columns', 'wp-metrics' ) => 'col-xs-6',
                esc_html__( '3 Columns', 'wp-metrics' ) => 'col-xs-4',
                esc_html__( '4 Columns', 'wp-metrics' ) => 'col-xs-3',
                esc_html__( '6 Columns', 'wp-metrics' ) => 'col-xs-2'
            ),
            'std' => 'col-xs-12'
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Small devices','wp-metrics'),
            'param_name' => 'col_sm',
            'description' => esc_html__( 'Tablets (768px)', 'wp-metrics' ),
            'edit_field_class' => 'vc_col-sm-6 vc_column',
            'value' => array(
                esc_html__( '1 Column', 'wp-metrics' ) => 'col-sm-12',
                esc_html__( '2 Columns', 'wp-metrics' ) => 'col-sm-6',
                esc_html__( '3 Columns', 'wp-metrics' ) => 'col-sm-4',
                esc_html__( '4 Columns', 'wp-metrics' ) => 'col-sm-3',
                esc_html__( '6 Columns', 'wp-metrics' ) => 'col-sm-2'
            ),
            'std' => 'col-sm-6'
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Medium devices','wp-metrics' ),
            'param_name' => 'col_md',
            'description' => esc_html__( 'Desktops (992px)', 'wp-metrics' ),
            'edit_field_class' => 'vc_col-sm-6 vc_column',
            'value' => array(
                esc_html__( '1 Column', 'wp-metrics' ) => 'col-md-12',
                esc_html__( '2 Columns', 'wp-metrics' ) => 'col-md-6',
                esc_html__( '3 Columns', 'wp-metrics' ) => 'col-md-4',
                esc_html__( '4 Columns', 'wp-metrics' ) => 'col-md-3',
                esc_html__( '6 Columns', 'wp-metrics' ) => 'col-md-2'
            ),
            'std' => 'col-md-4'
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Large devices','wp-metrics'),
            'param_name' => 'col_lg',
            'description' => esc_html__( 'Desktops (1200px)', 'wp-metrics' ),
            'edit_field_class' => 'vc_col-sm-6 vc_column',
            'value' => array(
                esc_html__( '1 Column', 'wp-metrics' ) => 'col-lg-12',
                esc_html__( '2 Columns', 'wp-metrics' ) => 'col-lg-6',
                esc_html__( '3 Columns', 'wp-metrics' ) => 'col-lg-4',
                esc_html__( '4 Columns', 'wp-metrics' ) => 'col-lg-3',
                esc_html__( '6 Columns', 'wp-metrics' ) => 'col-lg-2'
            ),
            'std' => 'col-lg-3'
        )
    );
}

/**
 * 
 */
function wpmetrics_vc_inline_group_base_param() {
    return array(
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Extra small devices','wp-metrics' ),
            'param_name' => 'col_xs',
            'description' => esc_html__( 'Phones (<768px)', 'wp-metrics' ),
            'edit_field_class' => 'vc_col-sm-6 vc_column',
            'value' => array(
                esc_html__( '1 Column', 'wp-metrics' ) => 'cms-inline-block-xs-12',
                esc_html__( '2 Columns', 'wp-metrics' ) => 'cms-inline-block-xs-6',
                esc_html__( '3 Columns', 'wp-metrics' ) => 'cms-inline-block-xs-4',
                esc_html__( '4 Columns', 'wp-metrics' ) => 'cms-inline-block-xs-3',
                esc_html__( '6 Columns', 'wp-metrics' ) => 'cms-inline-block-xs-2'
            ),
            'std' => 'cms-inline-block-xs-12'
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Small devices','wp-metrics'),
            'param_name' => 'col_sm',
            'description' => esc_html__( 'Tablets (768px)', 'wp-metrics' ),
            'edit_field_class' => 'vc_col-sm-6 vc_column',
            'value' => array(
                esc_html__( '1 Column', 'wp-metrics' ) => 'cms-inline-block-sm-12',
                esc_html__( '2 Columns', 'wp-metrics' ) => 'cms-inline-block-sm-6',
                esc_html__( '3 Columns', 'wp-metrics' ) => 'cms-inline-block-sm-4',
                esc_html__( '4 Columns', 'wp-metrics' ) => 'cms-inline-block-sm-3',
                esc_html__( '6 Columns', 'wp-metrics' ) => 'cms-inline-block-sm-2'
            ),
            'std' => 'cms-inline-block-sm-6'
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Medium devices','wp-metrics' ),
            'param_name' => 'col_md',
            'description' => esc_html__( 'Desktops (992px)', 'wp-metrics' ),
            'edit_field_class' => 'vc_col-sm-6 vc_column',
            'value' => array(
                esc_html__( '1 Column', 'wp-metrics' ) => 'cms-inline-block-md-12',
                esc_html__( '2 Columns', 'wp-metrics' ) => 'cms-inline-block-md-6',
                esc_html__( '3 Columns', 'wp-metrics' ) => 'cms-inline-block-md-4',
                esc_html__( '4 Columns', 'wp-metrics' ) => 'cms-inline-block-md-3',
                esc_html__( '6 Columns', 'wp-metrics' ) => 'cms-inline-block-md-2'
            ),
            'std' => 'cms-inline-block-md-4'
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Large devices','wp-metrics'),
            'param_name' => 'col_lg',
            'description' => esc_html__( 'Desktops (1200px)', 'wp-metrics' ),
            'edit_field_class' => 'vc_col-sm-6 vc_column',
            'value' => array(
                esc_html__( '1 Column', 'wp-metrics' ) => 'cms-inline-block-lg-12',
                esc_html__( '2 Columns', 'wp-metrics' ) => 'cms-inline-block-lg-6',
                esc_html__( '3 Columns', 'wp-metrics' ) => 'cms-inline-block-lg-4',
                esc_html__( '4 Columns', 'wp-metrics' ) => 'cms-inline-block-lg-3',
                esc_html__( '6 Columns', 'wp-metrics' ) => 'cms-inline-block-lg-2'
            ),
            'std' => 'cms-inline-block-lg-3'
        ),
    );
}