<?php defined( 'ABSPATH' ) or exit();
/**
 * Template part for displaying posts in grid layout.
 *
 * @package WPMetrics
 */
$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
?>
<article <?php post_class( esc_attr( "post-" . get_the_ID() ) . " entry-posts-grid" ); ?>>
    <?php
    $post_format = get_post_format();
    $post_format = $post_format ? $post_format : 'standard';

    $post_featured = wpmetrics_post_format_featured( get_the_ID(), 'medium' );
    if ( $post_featured ) {
        echo '<div class="entry-featured entry-featured-' . esc_attr( $post_format ) . '">';
        echo wp_kses_post( $post_featured );
        echo '</div>';
    }
    ?>
    <header class="entry-header">
        <?php if ( 1 == $paged && is_sticky() ) : ?>
        <span class="post-sticky-icon"><i class="fa fa-thumb-tack"></i></span>
        <?php endif; ?>
        <?php if ( 'post' === get_post_type() ) : ?>
        <div class="entry-meta">
            <?php wpmetrics_post_entry_meta( array( 'show_author' => false, 'show_comments' => false ) ); ?>
        </div><!-- .entry-meta -->
        <?php endif; ?>
        <?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
    </header><!-- .entry-header -->
    <div class="entry-content"><?php
        wpmetrics_get_the_excerpt( get_the_ID(), array( 'length' => 30 ) ); 
    ?></div><!-- .entry-content -->

    <footer class="entry-footer">
        <?php wpmetrics_posts_entry_footer(); ?>
    </footer><!-- .entry-footer -->
</article><!-- #post-## -->