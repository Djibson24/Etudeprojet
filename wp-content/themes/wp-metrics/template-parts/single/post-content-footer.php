
<?php defined( 'ABSPATH' ) or exit();
/**
 * Template part for displaying single post sharing buttons.
 * @package  WPMetrics
 */


// Tags
if ( 'post' == get_post_type() ) {
    $tags_list = get_the_tag_list( '', esc_html__( ', ', 'wp-metrics' ) );
    if ( $tags_list ) {
        echo '<div class="entry-footer-block entry-tags">';
        echo '<h5 class="entry-tags-title">' . esc_html__( 'Tagged in:', 'wp-metrics' ) . '</h5>';
        echo wp_kses_post( $tags_list );
        echo '</div>';
    }
}

// Sharing buttons
if ( ! wpmetrics_get_theme_option( 'post_sharing_enable', false ) || ! class_exists( 'WPMetrics_Social_Share' ) ) return;
$args = array();

$args['facebook']   = wpmetrics_get_theme_option( 'post_sharing_facebook', false );
$args['twitter']    = wpmetrics_get_theme_option( 'post_sharing_twitter', false );
$args['googleplus'] = wpmetrics_get_theme_option( 'post_sharing_googleplus', false );
$args['pinterest']  = wpmetrics_get_theme_option( 'post_sharing_pinterest', false );
$args['linkedin']   = wpmetrics_get_theme_option( 'post_sharing_linkedin', false );
$args['tumblr']     = wpmetrics_get_theme_option( 'post_sharing_tumblr', false );
$args['vk']         = wpmetrics_get_theme_option( 'post_sharing_vk', false );
$args['reddit']     = wpmetrics_get_theme_option( 'post_sharing_reddit', false );
$args['email']      = wpmetrics_get_theme_option( 'post_sharing_email', false );

$links_obj = new WPMetrics_Social_Share( $args );

if ( empty( $links_obj->links ) ) return;

echo '<div class="entry-footer-block entry-share">';
echo '<h5 class="entry-share-title">' . esc_html__( 'Share This Article:', 'wp-metrics' ) . '</h5>';
echo '<ul class="entry-share-links cms-social">';

foreach ( $links_obj->links as $key => $link ) {

    switch ( $key ) {

        case 'facebook':
            echo '<li class="' . $key . '">';
            echo '<a href="' . $link['url'] . '" title="' . esc_html__( 'Share this.', 'wp-metrics' ) . '" target="_blank"><i class="fa fa-facebook"></i></a>';
            echo '</li>';
            break;
        
        case 'twitter':
            echo '<li class="' . $key . '">';
            echo '<a href="' . $link['url'] . '" title="' . esc_html__( 'Tweet this.', 'wp-metrics' ) . '" target="_blank"><i class="fa fa-twitter"></i></a>';
            echo '</li>';
            break;

        case 'googleplus':
            echo '<li class="google">';
            echo '<a href="' . $link['url'] . '" title="' . esc_html__( 'Share this.', 'wp-metrics' ) . '" target="_blank"><i class="fa fa-google-plus"></i></a>';
            echo '</li>';
            break;

        case 'pinterest':
            echo '<li class="' . $key . '">';
            echo '<a href="' . $link['url'] . '" title="' . esc_html__( 'Share this.', 'wp-metrics' ) . '" target="_blank"><i class="fa fa-pinterest"></i></a>';
            echo '</li>';
            break;

        case 'linkedin':
            echo '<li class="' . $key . '">';
            echo '<a href="' . $link['url'] . '" title="' . esc_html__( 'Share this.', 'wp-metrics' ) . '" target="_blank"><i class="fa fa-linkedin"></i></a>';
            echo '</li>';
            break;

        case 'tumblr':
            echo '<li class="' . $key . '">';
            echo '<a href="' . $link['url'] . '" title="' . esc_html__( 'Share this.', 'wp-metrics' ) . '" target="_blank"><i class="fa fa-tumblr"></i></a>';
            echo '</li>';
            break;

        case 'vk':
            echo '<li class="' . $key . '">';
            echo '<a href="' . $link['url'] . '" title="' . esc_html__( 'Share this.', 'wp-metrics' ) . '" target="_blank"><i class="fa fa-vk"></i></a>';
            echo '</li>';
            break;

        case 'reddit':
            echo '<li class="' . $key . '">';
            echo '<a href="' . $link['url'] . '" title="' . esc_html__( 'Share this.', 'wp-metrics' ) . '" target="_blank"><i class="fa fa-reddit"></i></a>';
            echo '</li>';
            break;

        case 'email':
            echo '<li class="' . $key . '">';
            echo '<a href="' . $link['url'] . '" title="' . esc_html__( 'Email this.', 'wp-metrics' ) . '" target="_blank"><i class="fa fa-envelope-o"></i></a>';
            echo '</li>';
            break;

        default:
            break;
    }
}
echo '</ul>';
echo '</div>';