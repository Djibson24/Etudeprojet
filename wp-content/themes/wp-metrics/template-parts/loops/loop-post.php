<?php defined( 'ABSPATH' ) or exit();
/**
 * Template part for displaying posts in standard layout.
 *
 * @package WPMetrics
 */
$thumbnail_size = 'full';
if ( 'large' == wpmetrics_get_theme_option( 'posts_layout', 'large' ) ) {
    $thumbnail_size = 'large';
}
$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
?>
<article <?php post_class( esc_attr( "post-" . get_the_ID() ) . " entry-posts-standard" ); ?>>
    <header class="entry-header">
        <div class="entry-indicator"><?php
            if ( 1 == $paged && is_sticky() ) {
                echo '<span class="post-sticky-icon"><i class="fa fa-thumb-tack"></i></span>';
            }
            echo '<a href="' . esc_url( get_permalink() ) . '">';
            echo '<span class="post-format-icon">';
            wpmetrics_post_format_icon( get_post_format() );
            echo '</span>';
            echo '</a>';
        ?></div>
        <?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
        <?php if ( 'post' === get_post_type() ) : ?>
        <div class="entry-meta">
            <?php wpmetrics_post_entry_meta( array( 'show_author' => false ) ); ?>
        </div><!-- .entry-meta -->
        <?php endif; ?>
    </header><!-- .entry-header -->
    <?php
    $post_format = 'standard';
    if ( get_post_format() ) {
        $post_format = get_post_format();
    }

    $post_featured = wpmetrics_post_format_featured( get_the_ID(), $thumbnail_size );
    if ( $post_featured ) {
        echo '<div class="entry-featured entry-featured-' . esc_attr( $post_format ) . '">';
        echo wp_kses_post( $post_featured );
        echo '</div>';
    }
    ?>
    <div class="entry-content"><?php
        wpmetrics_get_the_excerpt();
    ?></div><!-- .entry-content -->

    <footer class="entry-footer">
        <?php wpmetrics_posts_entry_footer(); ?>
    </footer><!-- .entry-footer -->
</article><!-- #post-## -->