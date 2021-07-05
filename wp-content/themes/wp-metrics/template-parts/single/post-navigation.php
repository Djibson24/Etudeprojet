<?php defined( 'ABSPATH' ) or exit();
/**
 * Template part for displaying prev/next links on single post
 * @package WPMetrics
 */
$previous = get_previous_post();
$next = get_next_post();

if ( $previous || $next ) {
?>
<nav class="cms-post-navigation">
    <h2 class="screen-reader-text"><?php esc_html_e( 'Post navigation', 'wp-metrics' ); ?></h2>
    <div class="post-navigation-inner">
    <?php
    if ( $next ) : ?>
        <div class="nav-previous<?php echo esc_attr( has_post_thumbnail( $next->ID ) ? ' has-post-thumbnail' : '' ); ?>">
            <div class="nav-inner"><?php
                if ( has_post_thumbnail( $next->ID ) ) : ?>
                <div class="post-thumbnail"><?php echo get_the_post_thumbnail( $next->ID, 'thumbnail' );?></div><?php
                endif; ?>
                <div class="post-summary">
                    <h6><?php esc_html_e( 'Previous Post', 'wp-metrics' ); ?></h6>
                    <h4 class="entry-title"><a href="<?php echo get_permalink( $next->ID ); ?>"><?php echo esc_html( $next->post_title ); ?></a></h4>
                </div>
            </div>
        </div><?php
    endif;

    if ( $previous ) : ?>
        <div class="nav-next<?php echo esc_attr( has_post_thumbnail( $previous->ID ) ? ' has-post-thumbnail' : '' ); ?>">
            <div class="nav-inner">
                <div class="post-summary">
                    <h6><?php esc_html_e( 'Next Post', 'wp-metrics' ); ?></h6>
                    <h4 class="entry-title"><a href="<?php echo get_permalink( $previous->ID ); ?>"><?php echo esc_html( $previous->post_title ); ?></a></h4>
                </div><?php
                if ( has_post_thumbnail( $previous->ID ) ) : ?>
                <div class="post-thumbnail"><?php echo get_the_post_thumbnail( $previous->ID, 'thumbnail' );?></div><?php
                endif; ?>
            </div>
        </div><?php
    endif;
    ?>
    </div>
</nav><?php
}
