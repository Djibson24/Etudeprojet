<?php defined( 'ABSPATH' ) or exit();

$nav_left_icon = vc_map_integrate_shortcode( 'cms_icon', 'left_i_', esc_html__( 'Previous Icon', 'wp-metrics' ),
    array(
        'include_only_regex' => '/^(type|icon_\w*)/',
        // we need only type, icon_fontawesome, icon_blabla..., NOT color and etc
    ),
    array(
        'element' => 'custom_nav_icons',
        'value' => 'yes'
    )
);

if ( is_array( $nav_left_icon ) && ! empty( $nav_left_icon ) ) {
    foreach ( $nav_left_icon as $key => $param ) {
        if ( is_array( $param ) && ! empty( $param ) ) {
            if ( isset( $param['admin_label'] ) ) {
                // remove admin label
                unset( $nav_left_icon[ $key ]['admin_label'] );
            }
        }
    }
}


$nav_right_icon = vc_map_integrate_shortcode( 'cms_icon', 'right_i_', esc_html__( 'Next Icon', 'wp-metrics' ),
    array(
        'include_only_regex' => '/^(type|icon_\w*)/',
        // we need only type, icon_fontawesome, icon_blabla..., NOT color and etc
    ),
    array(
        'element' => 'custom_nav_icons',
        'value' => 'yes'
    )
);
if ( is_array( $nav_right_icon ) && ! empty( $nav_right_icon ) ) {
    foreach ( $nav_right_icon as $key => $param ) {
        if ( is_array( $param ) && ! empty( $param ) ) {
            if ( isset( $param['admin_label'] ) ) {
                // remove admin label
                unset( $nav_right_icon[ $key ]['admin_label'] );
            }
        }
    }
}


$params = array_merge( 
    wpmetrics_vc_cms_carousel_base_param(),
    array(
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Navigation color style', 'wp-metrics' ),
            'param_name' => 'nav_color',
            'value' => array(
                esc_html__( 'Default', 'wp-metrics' ) => '',
                esc_html__( 'Light color with colored active', 'wp-metrics' ) => 'nav-light-colored-active',
                esc_html__( 'Light color with dark colored active', 'wp-metrics' ) => 'nav-light-dark-active'
            ),
            'description' => esc_html__( 'Set carousel navigation color scheme.', 'wp-metrics' ),
        ),
        array(
            'type' => 'attach_images',
            'heading' => esc_html__( 'Images', 'wp-metrics' ),
            'param_name' => 'images',
            'value' => '',
            'description' => esc_html__( 'Select images from media library.', 'wp-metrics' ),
            'group' => esc_html__( 'Source', 'wp-metrics' )
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Image size', 'wp-metrics' ),
            'param_name' => 'img_size',
            'value' => 'thumbnail',
            'description' => esc_html__( 'Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "thumbnail" size. If used slides per view, this will be used to define carousel wrapper size.', 'wp-metrics' ),
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'On click action', 'wp-metrics' ),
            'param_name' => 'onclick',
            'value' => array(
                esc_html__( 'None', 'wp-metrics' ) => 'link_no',
                esc_html__( 'Open prettyPhoto', 'wp-metrics' ) => 'link_image',
                esc_html__( 'Open custom links', 'wp-metrics' ) => 'custom_link',
            ),
            'description' => esc_html__( 'Select action for click event.', 'wp-metrics' ),
            'group' => esc_html__( 'Source', 'wp-metrics' )
        ),
        array(
            'type' => 'exploded_textarea',
            'heading' => esc_html__( 'Custom links', 'wp-metrics' ),
            'param_name' => 'custom_links',
            'description' => esc_html__( 'Enter links for each slide (Note: divide links with linebreaks (Enter)).', 'wp-metrics' ),
            'dependency' => array(
                'element' => 'onclick',
                'value' => array( 'custom_link' ),
            ),
            'group' => esc_html__( 'Source', 'wp-metrics' )
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Custom link target', 'wp-metrics' ),
            'param_name' => 'custom_links_target',
            'description' => esc_html__( 'Select how to open custom links.', 'wp-metrics' ),
            'dependency' => array(
                'element' => 'onclick',
                'value' => array( 'custom_link' ),
            ),
            'value' => array(
                esc_html__( 'Same window', 'wp-metrics' ) => '_self',
                esc_html__( 'New window', 'wp-metrics' ) => '_blank',
            ),
            'group' => esc_html__( 'Source', 'wp-metrics' )
        ),
    ),
    $nav_left_icon,
    $nav_right_icon,
    array(
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Built-in CSS', 'wp-metrics' ),
            'param_name' => 'built_in_class',
            'value' => array(
                esc_html__( 'None', 'wp-metrics' ) => '',
                esc_html__( 'Seperate items by border', 'wp-metrics' ) => 'carousel-seperator'
            ),
            'description' => esc_html__( 'Built-in css support for particular testimonial layout.', 'wp-metrics' ),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Extra class name', 'wp-metrics' ),
            'param_name' => 'el_class',
            'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'wp-metrics' ),
        ),
        array(
            'type' => 'cms_template',
            'param_name' => 'cms_template',
            'shortcode' => 'cms_image_carousel',
            'value' => 'cms_image_carousel.php',
            'admin_label' => true,
            'heading' => esc_html__( 'Template', 'wp-metrics' )
        ),
        array(
            'type' => 'css_editor',
            'heading' => esc_html__( 'CSS box', 'wp-metrics' ),
            'param_name' => 'css',
            'group' => esc_html__( 'Design Options', 'wp-metrics' ),
        )
    )
);


vc_map( array(
    'name' => esc_html__( 'CMS Images Carousel', 'wp-metrics' ),
    'base' => 'cms_image_carousel',
    'icon' => 'icon-wpb-ui-pageable',
    'description' => esc_html__( 'Carousel for Images', 'wp-metrics' ),
    'category' => esc_html__( 'CmsSuperheroes Shortcodes', 'wp-metrics' ),
    'params' => $params
) );

class WPBakeryShortCode_CMS_Image_Carousel extends CmsShortCode {
    protected static $carousel_index = 1;
    public function __construct( $settings ) {
        parent::__construct( $settings );
        $this->jsCssScripts();
    }

    protected function content( $atts, $content = null ) {
        return parent::content( $atts, $content );
    }

    public function jsCssScripts() {
        if ( ! wp_script_is( 'owl-carousel', 'registered' ) ) {
            wp_register_script( 'owl-carousel', get_template_directory_uri() . '/js/owl.carousel.min.js', array( 'jquery' ), '', true );
        }
    }

    public function getCarouselIndex() {
        return self::$carousel_index ++ . '-' . time();
    }

    public function getCarouselOptions( $atts ) {
        $data_attr = array();

        $items = isset( $atts['items'] ) ? (int)$atts['items'] : 0;
        $items = $items > 0 ? $items : 4;

        $data_attr[] = esc_html( '"items":' . $items );

        $items_mobile = isset( $atts['items_mobile'] ) ? (int)$atts['items_mobile'] : 0;
        $items_tablet = isset( $atts['items_tablet'] ) ? (int)$atts['items_tablet'] : 0;
        $items_desktop_small = isset( $atts['items_desktop_small'] ) ? (int)$atts['items_desktop_small'] : 0;
        $items_desktop = isset( $atts['items_desktop'] ) ? (int)$atts['items_desktop'] : 0;

        if ( $items_desktop > 0 ) {
            $data_attr[] = esc_html( '"itemsDesktop":[1199,' . $items_desktop . ']' );
        } else {
            $data_attr[] = esc_html( '"itemsDesktop":false' );
        }
        if ( $items_desktop_small > 0 ) {
            $data_attr[] = esc_html( '"itemsDesktopSmall":[979,' . $items_desktop_small . ']' );
        } else {
            $data_attr[] = esc_html( '"itemsDesktopSmall":false' );
        }
        if ( $items_tablet > 0 ) {
            $data_attr[] = esc_html( '"itemsTablet":[767,' . $items_tablet . ']' );
        } else {
            $data_attr[] = esc_html( '"itemsTablet":false' );
        }
        if ( $items_mobile > 0 ) {
            $data_attr[] = esc_html( '"itemsMobile":[480,' . $items_mobile . ']' );
        } else {
            $data_attr[] = esc_html( '"itemsMobile":false' );
        }

        $autoplay = isset( $atts['autoplay'] ) && 'yes' == $atts['autoplay'] ? true : false;
        if ( $autoplay ) {
            if ( isset( $atts['autoplay_timeout'] ) ) {
                $autoplay_timeout = (int)$atts['autoplay_timeout'];
                $data_attr[] = $autoplay_timeout > 0 ? esc_html( '"autoPlay":' . $autoplay_timeout ) : esc_html( '"autoPlay":true' );
            }
            $stop_on_hover = isset( $atts['stop_on_hover'] ) && 'yes' == $atts['stop_on_hover'] ? true : false;
            $data_attr[] = $stop_on_hover ? esc_html( '"stopOnHover":true' ) : esc_html( '"stopOnHover":false' );
        } else {
            $data_attr[] = esc_html( '"autoPlay":false' );
        }
        
        $touch_drag = isset( $atts['touch_drag'] ) && 'yes' == $atts['touch_drag'] ? true : false;
        $data_attr[] = $touch_drag ? esc_html( '"touchDrag":true' ) : esc_html( '"touchDrag":false' );

        $mouse_drag = isset( $atts['mouse_drag'] ) && 'yes' == $atts['mouse_drag'] ? true : false;
        $data_attr[] = $mouse_drag ? esc_html( '"mouseDrag":true' ) : esc_html( '"mouseDrag":false' );

        $pagination = isset( $atts['pagination'] ) && 'yes' == $atts['pagination'] ? true : false;
        $data_attr[] = $pagination ? esc_html( '"pagination":true' ) : esc_html( '"pagination":false' );

        if ( $pagination ) {
            if ( isset( $atts['pagination_speed'] ) ) {
                $pagination_speed = (int)$atts['pagination_speed'];
                $data_attr[] = $pagination_speed > 0 ? esc_html( '"paginationSpeed":' . $pagination_speed ) : esc_html( '"paginationSpeed":800' );
            }
        }

        $rewind_nav = isset( $atts['rewind_nav'] ) && 'yes' == $atts['rewind_nav'] ? true : false;
        $data_attr[] = $rewind_nav ? esc_html( '"rewindNav":true' ) : esc_html( '"rewindNav":false' );

        if ( $rewind_nav ) {
            if ( isset( $atts['rewind_speed'] ) ) {
                $rewind_speed = (int)$atts['rewind_speed'];
                $data_attr[] = $rewind_speed > 0 ? esc_html( '"rewindSpeed":' . $rewind_speed ) : esc_html( '"rewindSpeed":1000' );
            }
        }

        if ( isset( $atts['slide_speed'] ) ) {
            $slide_speed = (int)$atts['slide_speed'];
            $data_attr[] = $slide_speed > 0 ? esc_html( '"slideSpeed":' . $slide_speed ) : esc_html( '"slideSpeed":200' );
        }

        return $data_attr;
    }
}
