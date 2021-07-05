<?php defined( 'ABSPATH' ) or exit();
/**
 * Template part for displaying posts in minimal layout.
 *
 * @package WPMetrics
 */
$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
?>
<article <?php post_class( esc_attr( "post-" . get_the_ID() ) . " entry-posts-grid entry-posts-search" ); ?>>
    <header class="entry-header">
        <?php if ( 1 == $paged && is_sticky() ) : ?>
        <span class="post-sticky-icon"><i class="fa fa-thumb-tack"></i></span>
        <?php endif; ?>
        <?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
    </header><!-- .entry-header -->
    <div class="entry-content"><?php
        wpmetrics_get_the_excerpt( get_the_ID() ); 
    ?></div><!-- .entry-content -->
</article><!-- #post-## -->