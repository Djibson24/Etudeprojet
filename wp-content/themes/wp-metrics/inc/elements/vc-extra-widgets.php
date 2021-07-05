<?php defined( 'ABSPATH' ) or exit();

/**
 * Newsletter plugin support
 */
if ( class_exists( 'Newsletter' ) ) :
vc_map( array(
    'name' => 'Widget ' . esc_html__( 'Newsletter', 'wp-metrics' ),
    'base' => 'vc_wp_newsletter',
    'icon' => 'icon-wpb-wp',
    'category' => esc_html__( 'Extra Widgets', 'wp-metrics' ),
    'class' => 'wpb_vc_wp_widget',
    'weight' => - 50,
    'description' => esc_html__( 'Newsletter widget to add subscription forms on sidebars', 'wp-metrics' ),
    'params' => array(
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Widget title', 'wp-metrics' ),
            'param_name' => 'title',
            'description' => esc_html__( 'What text use as a widget title. Leave blank to use default widget title.', 'wp-metrics' ),
        ),
        array(
            'type' => 'textarea',
            'heading' => esc_html__( 'Text', 'wp-metrics' ),
            'param_name' => 'text',
            'description' => esc_html__( 'Use the tag {subscription_form} to place the subscription form within your personal text.', 'wp-metrics' )
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Extra class name', 'wp-metrics' ),
            'param_name' => 'el_class',
            'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'wp-metrics' ),
        ),
        array(
            'type' => 'css_editor',
            'heading' => esc_html__( 'CSS box', 'wp-metrics' ),
            'param_name' => 'css',
            'group' => esc_html__( 'Design Options', 'wp-metrics' ),
        )
    ),
) );
class WPBakeryShortCode_VC_Wp_Newsletter extends WPBakeryShortCode{}
endif;


/**
 * Recent Posts widget
 */
if ( class_exists( 'WPMetrics_Recent_Posts_Widget' ) ) :

vc_map( array(
    'name' => 'CMS ' . esc_html__( 'Recent Posts', 'wp-metrics' ),
    'base' => 'cms_recent_posts',
    'icon' => 'icon-wpb-wp',
    'category' => esc_html__( 'Extra Widgets', 'wp-metrics' ),
    'class' => 'wpb_vc_wp_widget',
    'weight' => - 50,
    'description' => esc_html__( 'Your site\'s most recent Posts.', 'wp-metrics' ),
    'params' => array(
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Widget title', 'wp-metrics' ),
            'param_name' => 'title',
            'description' => esc_html__( 'What text use as a widget title. Leave blank to use default widget title.', 'wp-metrics' ),
            'admin_label' => true
        ),
        array(
            'type' => 'checkbox',
            'param_name' => 'show_date',
            'value' => array( esc_html__( 'Show date', 'wp-metrics' ) => '1' )
        ),
        array(
            'type' => 'checkbox',
            'param_name' => 'show_category',
            'value' => array( esc_html__( 'Show categories', 'wp-metrics' ) => '1' )
        ),
        array(
            'type' => 'checkbox',
            'param_name' => 'show_author',
            'value' => array( esc_html__( 'Show author', 'wp-metrics' ) => '1' )
        ),
        array(
            'type' => 'checkbox',
            'param_name' => 'show_sticky',
            'value' => array( esc_html__( 'Show sticky', 'wp-metrics' ) => '1' )
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Number of posts', 'wp-metrics' ),
            'param_name' => 'number',
            'std' => 5
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Extra class name', 'wp-metrics' ),
            'param_name' => 'el_class',
            'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'wp-metrics' ),
        ),
        array(
            'type' => 'css_editor',
            'heading' => esc_html__( 'CSS box', 'wp-metrics' ),
            'param_name' => 'css',
            'group' => esc_html__( 'Design Options', 'wp-metrics' ),
        )
    ),
) );
class WPBakeryShortCode_CMS_Recent_Posts extends WPBakeryShortCode{}

endif;


/**
 * Social Support
 */
if ( class_exists( 'WPMetrics_Social_Widget' ) ):

$social_icon_choice = array(
    esc_html__( '-- Select --', 'wp-metrics' ) => "",
    esc_html__( 'Behance', 'wp-metrics' ) => "behance",
    esc_html__( 'Dribbble', 'wp-metrics' ) => "dribbble",
    esc_html__( 'Facebook', 'wp-metrics' ) => "facebook",
    esc_html__( 'Flickr', 'wp-metrics' ) => "flickr",
    esc_html__( 'Github', 'wp-metrics' ) => "github",
    esc_html__( 'Google', 'wp-metrics' ) => "google",
    esc_html__( 'Instagram', 'wp-metrics' ) => "instagram",
    esc_html__( 'LinkedIn', 'wp-metrics' ) => "linkedin",
    esc_html__( 'Pinterest', 'wp-metrics' ) => "pinterest",
    esc_html__( 'Rss', 'wp-metrics' ) => "rss",
    esc_html__( 'Skype', 'wp-metrics' ) => "skype",
    esc_html__( 'Tumblr', 'wp-metrics' ) => "tumblr",
    esc_html__( 'Twitter', 'wp-metrics' ) => "twitter",
    esc_html__( 'Vimeo', 'wp-metrics' ) => "vimeo",
    esc_html__( 'Yahoo', 'wp-metrics' ) => "yahoo"
);
vc_map( array(
    'name' => 'CMS ' . esc_html__( ' Social', 'wp-metrics' ),
    'base' => 'cms_social',
    'icon' => 'icon-wpb-wp',
    'category' => esc_html__( 'Extra Widgets', 'wp-metrics' ),
    'class' => 'wpb_vc_wp_widget',
    'weight' => - 50,
    'description' => esc_html__( 'Social icons and links..', 'wp-metrics' ),
    'params' => array(
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Widget title', 'wp-metrics' ),
            'param_name' => 'title',
            'description' => esc_html__( 'What text use as a widget title. Leave blank to use default widget title.', 'wp-metrics' ),
            'admin_label' => true
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Icon Style', 'wp-metrics' ),
            'param_name' => 'icon_style',
            'value' => array(
                esc_html__( 'Default', 'wp-metrics' ) => 'icon-style-default',
                esc_html__( 'Squared', 'wp-metrics' ) => 'icon-style-squared',
                esc_html__( 'Rounded', 'wp-metrics' ) => 'icon-style-rounded',
                esc_html__( 'Circle', 'wp-metrics' ) => 'icon-style-circle'
            )
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Alignment', 'wp-metrics' ),
            'param_name' => 'alignment',
            'value' => array(
                esc_html__( 'Left', 'wp-metrics' ) => 'text-left',
                esc_html__( 'Center', 'wp-metrics' ) => 'text-center',
                esc_html__( 'Right', 'wp-metrics' ) => 'text-right'
            )
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Icon 1', 'wp-metrics' ),
            'param_name' => 'icon_1',
            'value' => $social_icon_choice,
            'group' => esc_html__( 'Icon Settings', 'wp-metrics' )
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Icon 1 Link', 'wp-metrics' ),
            'param_name' => 'icon_1_link',
            'group' => esc_html__( 'Icon Settings', 'wp-metrics' )
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Icon 2', 'wp-metrics' ),
            'param_name' => 'icon_2',
            'value' => $social_icon_choice,
            'group' => esc_html__( 'Icon Settings', 'wp-metrics' )
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Icon 2 Link', 'wp-metrics' ),
            'param_name' => 'icon_2_link',
            'group' => esc_html__( 'Icon Settings', 'wp-metrics' )
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Icon 3', 'wp-metrics' ),
            'param_name' => 'icon_3',
            'value' => $social_icon_choice,
            'group' => esc_html__( 'Icon Settings', 'wp-metrics' )
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Icon 3 Link', 'wp-metrics' ),
            'param_name' => 'icon_3_link',
            'group' => esc_html__( 'Icon Settings', 'wp-metrics' )
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Icon 4', 'wp-metrics' ),
            'param_name' => 'icon_4',
            'value' => $social_icon_choice,
            'group' => esc_html__( 'Icon Settings', 'wp-metrics' )
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Icon 4 Link', 'wp-metrics' ),
            'param_name' => 'icon_4_link',
            'group' => esc_html__( 'Icon Settings', 'wp-metrics' )
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Icon 5', 'wp-metrics' ),
            'param_name' => 'icon_5',
            'value' => $social_icon_choice,
            'group' => esc_html__( 'Icon Settings', 'wp-metrics' )
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Icon 5 Link', 'wp-metrics' ),
            'param_name' => 'icon_5_link',
            'group' => esc_html__( 'Icon Settings', 'wp-metrics' )
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Icon 6', 'wp-metrics' ),
            'param_name' => 'icon_6',
            'value' => $social_icon_choice,
            'group' => esc_html__( 'Icon Settings', 'wp-metrics' )
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Icon 6 Link', 'wp-metrics' ),
            'param_name' => 'icon_6_link',
            'group' => esc_html__( 'Icon Settings', 'wp-metrics' )
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Icon 7', 'wp-metrics' ),
            'param_name' => 'icon_7',
            'value' => $social_icon_choice,
            'group' => esc_html__( 'Icon Settings', 'wp-metrics' )
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Icon 7 Link', 'wp-metrics' ),
            'param_name' => 'icon_7_link',
            'group' => esc_html__( 'Icon Settings', 'wp-metrics' )
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Icon 8', 'wp-metrics' ),
            'param_name' => 'icon_8',
            'value' => $social_icon_choice,
            'group' => esc_html__( 'Icon Settings', 'wp-metrics' )
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Icon 8 Link', 'wp-metrics' ),
            'param_name' => 'icon_8_link',
            'group' => esc_html__( 'Icon Settings', 'wp-metrics' )
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Icon 9', 'wp-metrics' ),
            'param_name' => 'icon_9',
            'value' => $social_icon_choice,
            'group' => esc_html__( 'Icon Settings', 'wp-metrics' )
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Icon 9 Link', 'wp-metrics' ),
            'param_name' => 'icon_9_link',
            'group' => esc_html__( 'Icon Settings', 'wp-metrics' )
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Icon 10', 'wp-metrics' ),
            'param_name' => 'icon_10',
            'value' => $social_icon_choice,
            'group' => esc_html__( 'Icon Settings', 'wp-metrics' )
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Icon 10 Link', 'wp-metrics' ),
            'param_name' => 'icon_10_link',
            'group' => esc_html__( 'Icon Settings', 'wp-metrics' )
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Icon 11', 'wp-metrics' ),
            'param_name' => 'icon_11',
            'value' => $social_icon_choice,
            'group' => esc_html__( 'Icon Settings', 'wp-metrics' )
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Icon 11 Link', 'wp-metrics' ),
            'param_name' => 'icon_11_link',
            'group' => esc_html__( 'Icon Settings', 'wp-metrics' )
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Icon 12', 'wp-metrics' ),
            'param_name' => 'icon_12',
            'value' => $social_icon_choice,
            'group' => esc_html__( 'Icon Settings', 'wp-metrics' )
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Icon 12 Link', 'wp-metrics' ),
            'param_name' => 'icon_12_link',
            'group' => esc_html__( 'Icon Settings', 'wp-metrics' )
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Icon 13', 'wp-metrics' ),
            'param_name' => 'icon_13',
            'value' => $social_icon_choice,
            'group' => esc_html__( 'Icon Settings', 'wp-metrics' )
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Icon 13 Link', 'wp-metrics' ),
            'param_name' => 'icon_13_link',
            'group' => esc_html__( 'Icon Settings', 'wp-metrics' )
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Icon 14', 'wp-metrics' ),
            'param_name' => 'icon_14',
            'value' => $social_icon_choice,
            'group' => esc_html__( 'Icon Settings', 'wp-metrics' )
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Icon 14 Link', 'wp-metrics' ),
            'param_name' => 'icon_14_link',
            'group' => esc_html__( 'Icon Settings', 'wp-metrics' )
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Icon 15', 'wp-metrics' ),
            'param_name' => 'icon_15',
            'value' => $social_icon_choice,
            'group' => esc_html__( 'Icon Settings', 'wp-metrics' )
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Icon 15 Link', 'wp-metrics' ),
            'param_name' => 'icon_15_link',
            'group' => esc_html__( 'Icon Settings', 'wp-metrics' )
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Extra class name', 'wp-metrics' ),
            'param_name' => 'el_class',
            'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'wp-metrics' ),
        ),
        array(
            'type' => 'css_editor',
            'heading' => esc_html__( 'CSS box', 'wp-metrics' ),
            'param_name' => 'css',
            'group' => esc_html__( 'Design Options', 'wp-metrics' ),
        )
    ),
) );
class WPBakeryShortCode_CMS_Social extends WPBakeryShortCode{
    function get_icons( &$atts )
    {
        $icons = array();
        for ( $i = 1; $i <=16; $i++ )
        {
            $icons[] = array(
                'icon_link' => isset( $atts["icon_{$i}_link"] ) ? esc_url( $atts["icon_{$i}_link"] ) : '',
                'icon_class' => isset( $atts["icon_{$i}"] ) ? esc_attr( $atts["icon_{$i}"] ) : ''
            );
            unset( $atts["icon_{$i}_link"] );
            unset( $atts["icon_{$i}"] );
        }
        return $icons;
    }
}

endif;