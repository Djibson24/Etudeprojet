<?php defined( 'ABSPATH' ) or exit();
/**
 * Additional Icon Element for Visual Composer
 *
 * @package CMSSuperHeroes
 * @subpackage WPMetrics
 */

$params = array(
    array(
        'type' => 'textfield',
        'heading' => esc_html__( 'Title', 'wp-metrics' ),
        'description' => esc_html__( 'Title for icon box', 'wp-metrics' ),
        'param_name' => 'title',
        'admin_label' => true
    ),
    array(
        'type' => 'dropdown',
        'heading' => esc_html__( 'Icon library', 'wp-metrics' ),
        'value' => array(
            esc_html__( 'Font Awesome', 'wp-metrics' ) => 'fontawesome',
            esc_html__( 'Open Iconic', 'wp-metrics' ) => 'openiconic',
            esc_html__( 'Typicons', 'wp-metrics' ) => 'typicons',
            esc_html__( 'Entypo', 'wp-metrics' ) => 'entypo',
            esc_html__( 'Linecons', 'wp-metrics' ) => 'linecons',
            esc_html__( 'Stroke Gap Icons', 'wp-metrics' ) => 'strokegapicons',
        ),
        'admin_label' => true,
        'param_name' => 'type',
        'description' => esc_html__( 'Select icon library.', 'wp-metrics' ),
    ),
    array(
        'type' => 'iconpicker',
        'heading' => esc_html__( 'Icon', 'wp-metrics' ),
        'param_name' => 'icon_fontawesome',
        'value' => 'fa fa-adjust', // default value to backend editor admin_label
        'settings' => array(
            'emptyIcon' => false,
            // default true, display an "EMPTY" icon?
            'iconsPerPage' => 4000,
            // default 100, how many icons per/page to display, we use (big number) to display all icons in single page
        ),
        'dependency' => array(
            'element' => 'type',
            'value' => 'fontawesome',
        ),
        'description' => esc_html__( 'Select icon from library.', 'wp-metrics' ),
    ),
    array(
        'type' => 'iconpicker',
        'heading' => esc_html__( 'Icon', 'wp-metrics' ),
        'param_name' => 'icon_openiconic',
        'value' => 'vc-oi vc-oi-dial', // default value to backend editor admin_label
        'settings' => array(
            'emptyIcon' => false, // default true, display an "EMPTY" icon?
            'type' => 'openiconic',
            'iconsPerPage' => 4000, // default 100, how many icons per/page to display
        ),
        'dependency' => array(
            'element' => 'type',
            'value' => 'openiconic',
        ),
        'description' => esc_html__( 'Select icon from library.', 'wp-metrics' ),
    ),
    array(
        'type' => 'iconpicker',
        'heading' => esc_html__( 'Icon', 'wp-metrics' ),
        'param_name' => 'icon_typicons',
        'value' => 'typcn typcn-adjust-brightness', // default value to backend editor admin_label
        'settings' => array(
            'emptyIcon' => false, // default true, display an "EMPTY" icon?
            'type' => 'typicons',
            'iconsPerPage' => 4000, // default 100, how many icons per/page to display
        ),
        'dependency' => array(
            'element' => 'type',
            'value' => 'typicons',
        ),
        'description' => esc_html__( 'Select icon from library.', 'wp-metrics' ),
    ),
    array(
        'type' => 'iconpicker',
        'heading' => esc_html__( 'Icon', 'wp-metrics' ),
        'param_name' => 'icon_entypo',
        'value' => 'entypo-icon entypo-icon-note', // default value to backend editor admin_label
        'settings' => array(
            'emptyIcon' => false, // default true, display an "EMPTY" icon?
            'type' => 'entypo',
            'iconsPerPage' => 4000, // default 100, how many icons per/page to display
        ),
        'dependency' => array(
            'element' => 'type',
            'value' => 'entypo',
        ),
    ),
    array(
        'type' => 'iconpicker',
        'heading' => esc_html__( 'Icon', 'wp-metrics' ),
        'param_name' => 'icon_linecons',
        'value' => 'vc_li vc_li-heart', // default value to backend editor admin_label
        'settings' => array(
            'emptyIcon' => false, // default true, display an "EMPTY" icon?
            'type' => 'linecons',
            'iconsPerPage' => 4000, // default 100, how many icons per/page to display
        ),
        'dependency' => array(
            'element' => 'type',
            'value' => 'linecons',
        ),
        'description' => esc_html__( 'Select icon from library.', 'wp-metrics' ),
    ),
    array(
        'type' => 'iconpicker',
        'heading' => esc_html__( 'Icon', 'wp-metrics' ),
        'param_name' => 'icon_strokegapicons',
        'value' => 'sgicon sgicon-WorldWide', // default value to backend editor admin_label
        'settings' => array(
            'emptyIcon' => false, // default true, display an "EMPTY" icon?
            'type' => 'strokegapicons',
            'iconsPerPage' => 4000, // default 100, how many icons per/page to display
        ),
        'dependency' => array(
            'element' => 'type',
            'value' => 'strokegapicons',
        ),
        'description' => esc_html__( 'Select icon from library.', 'wp-metrics' ),
    ),
    array(
        'type' => 'vc_link',
        'heading' => esc_html__( 'URL (Link)', 'wp-metrics' ),
        'param_name' => 'link',
        'description' => esc_html__( 'Add link to icon.', 'wp-metrics' ),
    ),
    array(
        'type' => 'checkbox',
        'heading' => esc_html__( 'Show link seperately?', 'wp-metrics' ),
        'param_name' => 'link_alone',
        'description' => esc_html__( 'By default, if link is set, icon will contain link but if you enable this, the link will appear bellow icon.', 'wp-metrics' ),
        'admin_label' => true
    ),
    array(
        'type' => 'dropdown',
        'heading' => esc_html__( 'Icon alignment', 'wp-metrics' ),
        'group' => esc_html__( 'Styling', 'wp-metrics' ),
        'param_name' => 'align',
        'admin_label' => true,
        'value' => array(
            esc_html__( 'Default', 'wp-metrics' ) => '',
            esc_html__( 'Left', 'wp-metrics' ) => 'text-left',
            esc_html__( 'Right', 'wp-metrics' ) => 'text-right',
            esc_html__( 'Center', 'wp-metrics' ) => 'text-center',
        ),
        'description' => esc_html__( 'Select icon alignment.', 'wp-metrics' ),
    ),
    array(
        'type' => 'colorpicker',
        'heading' => esc_html__( 'Title color', 'wp-metrics' ),
        'param_name' => 'color_title',
        'edit_field_class' => 'vc_col-sm-6 vc_column',
        'group' => esc_html__( 'Styling', 'wp-metrics' )
    ),
    array(
        'type' => 'colorpicker',
        'heading' => esc_html__( 'Icon color', 'wp-metrics' ),
        'param_name' => 'color_icon',
        'edit_field_class' => 'vc_col-sm-6 vc_column',
        'group' => esc_html__( 'Styling', 'wp-metrics' )
    ),
    array(
        'type' => 'colorpicker',
        'heading' => esc_html__( 'Link color', 'wp-metrics' ),
        'param_name' => 'color_link',
        'group' => esc_html__( 'Styling', 'wp-metrics' )
    ),
    array(
        'type' => 'textfield',
        'heading' => esc_html__( 'Title font size', 'wp-metrics' ),
        'description' => esc_html__( 'Set custom title font-size in px.', 'wp-metrics' ),
        'group' => esc_html__( 'Styling', 'wp-metrics' ),
        'param_name' => 'size_title'
    ),
    array(
        'type' => 'textfield',
        'heading' => esc_html__( 'Icon font size', 'wp-metrics' ),
        'description' => esc_html__( 'Set custom icon font-size in px.', 'wp-metrics' ),
        'group' => esc_html__( 'Styling', 'wp-metrics' ),
        'param_name' => 'size_icon'
    ),
    vc_map_add_css_animation( true ),
    array(
        'type' => 'textfield',
        'heading' => esc_html__( 'Extra class name', 'wp-metrics' ),
        'param_name' => 'el_class',
        'description'   => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS. If button container is enabled, these class names will be applied to the container.', 'wp-metrics' )
    ),
    array(
        'type' => 'css_editor',
        'heading' => esc_html__( 'CSS box', 'wp-metrics' ),
        'param_name' => 'css',
        'group' => esc_html__( 'Design Options', 'wp-metrics' ),
    )
);

if ( shortcode_exists( 'cms_icon' ) ) {
    vc_map_update( 'cms_icon', array(
        'params' => $params
    ) );
}
else {
    vc_map( array(
        'name' => esc_html__( 'CMS Icon Box', 'wp-metrics' ),
        'base' => 'cms_icon',
        'icon' => 'icon-wpb-vc_icon',
        'description' => esc_html__( 'Fancy Icon Box', 'wp-metrics' ),
        'show_settings_on_create'   => true,
        'category' => esc_html__( 'CmsSuperheroes Shortcodes', 'wp-metrics' ),
        'params' => $params,
        'js_view' => 'VcIconElementView_Backend',
    ) );
    class WPBakeryShortCode_CMS_Icon extends WPBakeryShortCode {}
}
