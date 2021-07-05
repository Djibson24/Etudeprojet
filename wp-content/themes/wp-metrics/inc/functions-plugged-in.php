<?php defined( 'ABSPATH' ) or exit();
/**
 * [Function set]
 * - Additional plugins support and miscellaneous theme features.
 * - Additional hooks
 * 
 * @package CMSSuperHeroes
 * @subpackage WPMetrics
 */


/**
 * Favicon
 * @since 1.0.0
 */
function wpmetrics_theme_favicon()
{
    if ( function_exists( 'has_site_icon' ) && has_site_icon() )
        return;
    $favicon = wpmetrics_get_theme_option( 'favicon' );
    if ( empty( $favicon ) || empty( $favicon['url'] ) ) return;
    echo '<link rel="icon" type="image/png" href="' . esc_url( $favicon['url'] ) . '"/>';
}
add_action( 'wp_head', 'wpmetrics_theme_favicon' );


/**
 * We don't want the blog menu item active if post type is not default "post"
 * @param  array  $classes Menu item classes
 * @param  object $item    Menu item
 * @param  array $args
 * @return array           Filtered menu item classes
 * @since 1.0.0
 */
function wpmetrics_fix_blog_link_on_cpt( $classes, $item, $args )
{
    global $post;
    $posttype = get_post_type( $post );

    if ( ( $posttype !== 'post' ) || ! ( is_home() || is_single() || is_archive() || is_category() || is_tag() || is_author() ) )
    {
        $blog_page_id = intval( get_option('page_for_posts') );

        if ( $blog_page_id != 0 && $item->object_id == $blog_page_id )
        {
            unset ($classes[array_search( 'current_page_parent', $classes )] );
        }
    }
    return $classes;
}
add_filter( 'nav_menu_css_class', 'wpmetrics_fix_blog_link_on_cpt', 10, 3 );


/**
 * Display icons in social links menu.
 *
 * @since WPMetrics 2.0
 *
 * @param  string  $item_output The menu item output.
 * @param  WP_Post $item        Menu item object.
 * @param  int     $depth       Depth of the menu.
 * @param  array   $args        wp_nav_menu() arguments.
 * @return string  $item_output The menu item output with social icon.
 */
function wpmetrics_nav_menu_social_icons( $item_output, $item, $depth, $args )
{
    // Get supported social icons.
    $social_icons = wpmetrics_social_links_icons();

    // Change SVG icon inside social links menu if there is supported URL.
    if ( 'social' === $args->theme_location )
    {
        foreach ( $social_icons as $attr => $value )
        {
            if ( false !== strpos( $item_output, $attr ) )
            {
                $replace = sprintf(
                    '<span class="menu-icon"><i class="%s"></i></span><span class="screen-reader-text">',
                    esc_attr( $value )
                );
                $item_output = str_replace( $args->link_before, $replace, $item_output );
            }
        }
    }

    return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'wpmetrics_nav_menu_social_icons', 10, 4 );


/**
 * Update options if the theme is beeing used
 * @since 1.0.0
 */
function wpmetrics_after_switch_theme()
{
    update_option( 'thumbnail_size_w', 140 );
    update_option( 'thumbnail_size_h', 140 );
    update_option( 'thumbnail_crop', 1 );
    update_option( 'medium_size_w', 640 );
    update_option( 'medium_size_h', 480 );
    update_option( 'medium_crop', 1 );
    update_option( 'large_size_w', 870 ); 
    update_option( 'large_size_h', 640 );
    update_option( 'large_crop', 1 );
    update_option( 'date_format', 'M j, Y' );

    if ( class_exists( 'WooCommerce' ) )
    {
        $catalog = array(
            'width'     => '206',   // px
            'height'    => '255',   // px
            'crop'      => 1        // true
        );
        $single = array(
            'width'     => '770',   // px
            'height'    => '450',   // px
            'crop'      => 1        // true
        );
        $thumbnail = array(
            'width'     => '140',   // px
            'height'    => '140',   // px
            'crop'      => 0        // false
        );
        update_option( 'shop_catalog_image_size', $catalog );       // Product category thumbs
        update_option( 'shop_single_image_size', $single );         // Single product image
        update_option( 'shop_thumbnail_image_size', $thumbnail ); 
    }
}

add_action( 'after_switch_theme', 'wpmetrics_after_switch_theme' );


function wpmetrics_backend_enqueue()
{
    wp_enqueue_style( 'wpmetrics-admin', get_template_directory_uri() . '/inc/assets/css/admin.css' );
}
add_action( 'admin_enqueue_scripts', 'wpmetrics_backend_enqueue' );


/**
 * Comment callback function
 * @param  object $comment
 * @param  array  $args
 * @param  int    $depth
 */
function wpmetrics_theme_comment_template( $comment, $args, $depth ) {
    $GLOBALS['comment'] = $comment;
    $comment_before = $comment_after = '';
    extract( $args, EXTR_SKIP );

    if ( 'div' == $args['style'] ) {
        $tag = 'div';
        $add_below = 'comment';
    } else {
        $tag = 'li';
        $add_below = 'div-comment';
    }

    echo '<' . esc_attr( $tag ) . ' ';
    comment_class( empty( $args['has_children'] ) ? '' : 'parent' );
    echo ' id="comment-';
    comment_ID();
    echo '">';
    
    if ( 'div' != $args['style'] ) {
        $comment_before = '<div id="div-comment-' . esc_attr( get_comment_ID() ) . '" class="comment-body clearfix">';
        $comment_after = '</div>';
    }

    echo wp_kses_post( $comment_before );
    echo '<div class="comment-author-image vcard">' . get_avatar( $comment ) . '</div>';
    echo '<div class="comment-main">';
    echo    '<header class="comment-header">';
    echo        '<h6 class="comment-author">' . get_comment_author_link() . '</h6>';
    echo        '<div class="comment-meta commentmetadata">';
    echo             '<span class="comment-date">';
    echo                 get_the_date( get_option( 'date_format', 'Y/m/d' ) ) . ' - ' . get_the_time( get_option( 'time_format' ) );
    echo             '</span>';
    if ( $comment->comment_approved == '0' ) {
        echo            '<em class="comment-awaiting-moderation">' . esc_html__( 'Your comment is awaiting moderation.' , 'wp-metrics' ) . '</em>';
    }
    echo        '</div>';
    echo    '</header>';
    echo    '<div class="comment-content">' . get_comment_text() . '</div>';
    echo    '<footer class="comment-footer">';
    echo        '<div class="reply">';
    echo            get_comment_reply_link(
                        array_merge(
                            $args,
                            array(
                                'add_below' => $add_below,
                                'depth' => $depth,
                                'max_depth' => $args['max_depth'],
                                'reply_text' => esc_html__( 'Leave a reply', 'wp-metrics' )
                            )
                        )
                    );
    echo        '</div>';
    echo    '</footer>';
    echo '</div>';
    echo wp_kses_post( $comment_after );
}


/**
 * Filter to output a html wrapper for embed
 */
add_filter( 'embed_oembed_html', 'wpmetrics_filter_embed_oembed_html', 10, 4 ) ;
function wpmetrics_filter_embed_oembed_html( $html, $url, $attr, $post_ID ) {
    return '<div class="cms-video-container">' . $html . '</div>';
}



/**
 * VC stuffs before it has been initialized
 */
add_action( 'vc_before_init', 'wpmetrics_vc_before_init' );
function wpmetrics_vc_before_init()
{
    if ( ! class_exists( 'CmsShortCode' ) )
        return;
    require get_template_directory() . '/inc/elements/vc-base-params.php';
    require get_template_directory() . '/inc/elements/googlemap/cms_googlemap.php';
}


/**
 * VC stuffs after it has been initialized
 */
add_action( 'vc_after_init', 'wpmetrics_vc_after_init' );
function wpmetrics_vc_after_init()
{
    if ( ! class_exists( 'CmsShortCode' ) )
        return;

    vc_remove_element( 'cms_carousel' );
    vc_remove_element( 'cms_counter' );
    vc_remove_element( 'cms_counter_single' );
    vc_remove_element( 'cms_fancybox' );
    vc_remove_element( 'cms_fancybox_single' );
    vc_remove_element( 'cms_grid' );
    vc_remove_element( 'cms_progressbar' );

    require get_template_directory() . '/inc/elements/vc-extends.php';
    require get_template_directory() . '/inc/elements/vc-extras.php';

    require get_template_directory() . '/inc/elements/cms_icon/cms_icon.php';
    require get_template_directory() . '/inc/elements/cms_btn/cms_btn.php';
    require get_template_directory() . '/inc/elements/cms_heading/cms_heading.php';
    require get_template_directory() . '/inc/elements/cms_countup/cms_countup.php';
    require get_template_directory() . '/inc/elements/cms_cta/cms_cta.php';
    require get_template_directory() . '/inc/elements/cms_progress_bar/cms_progress_bar.php';

    require get_template_directory() . '/vc_params/vc_params.php';

    require get_template_directory() . '/inc/elements/cms_counters/cms_counters.php';
    require get_template_directory() . '/inc/elements/cms_fancy_box/cms_fancy_box.php';
    require get_template_directory() . '/inc/elements/cms_work_process/cms_work_process.php';
    require get_template_directory() . '/inc/elements/cms_casestudy/cms_casestudy.php';
    require get_template_directory() . '/inc/elements/cms_testimonial/cms_testimonial.php';
    
    require get_template_directory() . '/inc/elements/cms_icon_group/cms_icon_group.php';
    require get_template_directory() . '/inc/elements/cms_fancy_box_carousel/cms_fancy_box_carousel.php';
    require get_template_directory() . '/inc/elements/cms_works_process/cms_works_process.php';
    require get_template_directory() . '/inc/elements/cms_casestudy_slider/cms_casestudy_slider.php';
    require get_template_directory() . '/inc/elements/cms_testimonial_carousel/cms_testimonial_carousel.php';
    require get_template_directory() . '/inc/elements/cms_image_carousel/cms_image_carousel.php';

    require get_template_directory() . '/inc/elements/cms_xgrid/cms_xgrid.php';
    require get_template_directory() . '/inc/elements/cms_pie/cms_pie.php';

    require get_template_directory() . '/inc/elements/cms_countdown/cms_countdown.php';
    
    require get_template_directory() . '/inc/elements/vc-extra-widgets.php';
}


/**
 * After import sample data, we do set home page based on title.
 * @return void.
  */
function wpmetrics_set_home_page()
{
    $home_page = get_page_by_title( 'Home' );
    if ( isset( $home_page->ID ) && ! empty( $home_page->ID ) ) {
        update_option( 'show_on_front', 'page' );
        update_option( 'page_on_front', $home_page->ID );
    }
    $posts_page = get_page_by_title( 'Blog' );
    if ( isset( $posts_page->ID ) && ! empty( $posts_page->ID ) ) {
        update_option( 'page_for_posts', $posts_page->ID );
    }
}
add_action( 'cms_import_finish', 'wpmetrics_set_home_page' );


/**
 * Set menu locations.
 * get locations and menu name and update options.
 * 
 * @return string[]
 * @author FOX
 */
function wpmetrics_set_menu_location(){
    $setting = array(
        esc_html__( 'Primary menu', 'wp-metrics' ) => 'primary',
        esc_html__( 'Side menu', 'wp-metrics' ) => 'side'
    );

    $navs = wp_get_nav_menus();
    $new_setting = array();

    foreach ( $navs as $nav ) {
        if ( ! isset( $setting[$nav->name] ) )
            continue;
        
        $id = $nav->term_id;
        $location = $setting[$nav->name];
        $new_setting[$location] = $id;
    }
    set_theme_mod( 'nav_menu_locations', $new_setting );
}
add_action( 'cms_import_finish', 'wpmetrics_set_menu_location' );