<?php defined( 'ABSPATH' ) or exit();
/**
 * The template for displaying page title.
 *
 * @package WPMetrics
 */

$title                = '';
$subtitle             = '';
$hlayout              = '';
$page_id              = 0;
$pagetitle_layout     = '';
$pagetitle_classes    = 'cms-page-title';
$pagetitle_style_attr = array();

if ( ! is_archive() )
{
    if ( is_home() )
    {
        $page_id = get_option( 'page_for_posts', '0' );

        if ( is_front_page() || ! $page_id )
        {
            $title = esc_html__( 'Blog', 'wp-metrics' );
        }
        else
        {
            $custom_pt        = wpmetrics_get_post_meta( $page_id, '_cms_custom_page_title' );
            $custom_pt_layout = wpmetrics_get_post_meta( $page_id, '_cms_custom_pagetitle_layout' );

            if ( 'hidden' === $custom_pt )
            {
                return;
            }

            if ( 'custom' === $custom_pt )
            {
                $title    = wpmetrics_get_post_meta( $page_id, '_cms_page_title' );
                $subtitle = wpmetrics_get_post_meta( $page_id, '_cms_page_subtitle' );
            }
            else
            {
                $title = get_the_title( $page_id );
            }
        }
    }
    elseif ( is_single() || is_page() )
    {
        $page_id          = get_the_ID();
        $custom_pt        = wpmetrics_get_post_meta( $page_id, '_cms_custom_page_title' );
        $custom_pt_layout = wpmetrics_get_post_meta( $page_id, '_cms_custom_pagetitle_layout' );

        if ( wpmetrics_get_post_meta( $page_id, '_cms_custom_header' ) )
        {
            $hlayout = wpmetrics_get_post_meta( get_the_ID(), '_cms_header_layout' );
        }

        if ( 'hidden' === $custom_pt )
        {
            return;
        }

        if ( 'custom' === $custom_pt )
        {
            $title    = wpmetrics_get_post_meta( $page_id, '_cms_page_title' );
            $subtitle = wpmetrics_get_post_meta( $page_id, '_cms_page_subtitle' );

            if ( wpmetrics_get_post_meta( $page_id, '_cms_custom_pagetitle_layout' ) )
            {
                $pagetitle_layout = wpmetrics_get_post_meta( $page_id, '_cms_pagetitle_layout' );
            }

            if ( wpmetrics_get_post_meta( $page_id, '_cms_custom_pagetitle_bg' ) )
            {
                $option_arr = array(
                    'background-color'      => wpmetrics_get_post_meta( $page_id, '_cms_pagetitle_bg_color' ),
                    'background-image'      => wpmetrics_get_post_meta( $page_id, '_cms_pagetitle_bg_image' ),
                    'background-repeat'     => wpmetrics_get_post_meta( $page_id, '_cms_pagetitle_bg_repeat' ),
                    'background-size'       => wpmetrics_get_post_meta( $page_id, '_cms_pagetitle_bg_size' ),
                    'background-attachment' => wpmetrics_get_post_meta( $page_id, '_cms_pagetitle_bg_attachment' ),
                    'background-position'   => wpmetrics_get_post_meta( $page_id, '_cms_pagetitle_bg_position' )
                );

                if ( $option_arr['background-color'] && wpmetrics_validate_color( $option_arr['background-color'] ) )
                {
                    $pagetitle_style_attr[] = 'background-color:' . $option_arr['background-color'];
                }

                if ( $option_arr['background-image'] )
                {
                    $image = wp_get_attachment_image_src( $option_arr['background-image'], 'full' );

                    if ( $image )
                    {
                        $pagetitle_style_attr[] = 'background-image:url(' . esc_url( $image[0] ) . ')';
                    }
                }
                else
                {
                    $pagetitle_style_attr[] = 'background-image:none;';
                }

                if ( $option_arr['background-repeat'] )
                {
                    $pagetitle_style_attr[] = 'background-repeat: ' . $option_arr['background-repeat'];
                }

                if ( $option_arr['background-size'] )
                {
                    $pagetitle_style_attr[] = 'background-size: ' . $option_arr['background-size'];
                }

                if ( $option_arr['background-attachment'] )
                {
                    $pagetitle_style_attr[] = 'background-attachment: ' . $option_arr['background-attachment'];
                }

                if ( $option_arr['background-position'] )
                {
                    $pagetitle_style_attr[] = 'background-position: ' . $option_arr['background-position'];
                }
            }
        }

        if ( empty( $title ) )
        {
            $title = get_the_title();
        }
    }
    elseif ( is_404() )
    {
        $title = apply_filters( 'metrics_page_title_404', esc_html( '404', 'wp-metrics' ) );
    }
    elseif ( is_search() )
    {
        $title = apply_filters( 'metrics_page_title_search', esc_html( 'Search results', 'wp-metrics' ) );
        $subtitle = apply_filters( 'metrics_page_subtitle_search', sprintf( esc_html( 'Your keywords: "%s"', 'wp-metrics'), get_search_query() ) );
    }
    else
    {
        $title = get_the_title();
    }
}
elseif ( class_exists( 'WooCommerce') && is_woocommerce() )
{
    $title = woocommerce_page_title( false );

    // -->
    ob_start();
    do_action( 'woocommerce_archive_description' );
    // <--
    $subtitle = ob_get_clean();
}
else
{
    $title    = get_the_archive_title();
    $subtitle = get_the_archive_description();
}

$pagetitle_layout = $pagetitle_layout ? $pagetitle_layout : wpmetrics_get_theme_option( 'page_title_layout', '1' );
$pagetitle_classes .= ' page-title-layout-' . $pagetitle_layout;

switch ( $pagetitle_layout ) {
    case '2':
        $pagetitle_classes .= ' page-title-layout-large page-title-with-sub text-center';
        break;

    case '3':
        $pagetitle_classes .= ' page-title-layout-large text-center';
        break;

    case '4':
        $pagetitle_classes .= ' page-title-layout-large page-title-with-sub page-title-with-breadcrumb text-center';
        break;

    case '5':
        $pagetitle_classes .= ' page-title-layout-medium page-title-with-sub page-title-with-breadcrumb text-center';
        break;

    case '6':
        $pagetitle_classes .= ' page-title-layout-medium page-title-with-sub text-center';
        break;

    case '7':
        $pagetitle_classes .= ' page-title-layout-medium page-title-with-breadcrumb text-center';
        break;

    case '8':
        $pagetitle_classes .= ' page-title-layout-medium ptbg-dark text-center';
        break;

    case '9':
        $pagetitle_classes .= ' page-title-layout-medium page-title-layout-2cols';
        break;

    case '10':
        $pagetitle_classes .= ' page-title-layout-small page-title-layout-2cols';
        break;

    case '11':
        $pagetitle_classes .= ' page-title-layout-small page-title-layout-2cols ptbg-dark';
        break;
    
    default:
        $pagetitle_classes .= ' page-title-layout-large page-title-with-sub page-title-with-breadcrumb text-center';
        break;
}

if ( ! $hlayout )
{
    $hlayout = wpmetrics_get_theme_option( 'header_layout', '10' );
}

$pagetitle_classes .= ' page-title-with-header-' . $hlayout;

wpmetrics_page_title( $pagetitle_layout, $pagetitle_classes, $pagetitle_style_attr, $title, $subtitle );
