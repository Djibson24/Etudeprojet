<?php defined( 'ABSPATH' ) or exit();
/**
 * Template part for displaying single post content.
 * @package  WPMetrics
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'entry-post-single' ); ?>>
    <header class="entry-header text-center">
        <div class="entry-indicator"><?php
            if ( is_sticky() ) {
                echo '<span class="post-sticky-icon"><i class="fa fa-thumb-tack"></i></span>';
            }
            echo '<span class="post-format-icon">';
            wpmetrics_post_format_icon( get_post_format() );
            echo '</span>';
        ?></div>
        <?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
        <?php if ( 'post' === get_post_type() ) : ?>
        <div class="entry-meta">
            <?php wpmetrics_post_entry_meta(); ?>
        </div><!-- .entry-meta -->
        <?php endif; ?>
    </header><!-- .entry-header -->
    <?php if ( has_post_thumbnail() ) : ?>
    <div class="entry-featured entry-featured-image">
        <?php the_post_thumbnail( 'full' ); ?>
    </div>
    <?php endif; ?>
    <div class="entry-content"><?php
        the_content();
        wp_link_pages( array(
            'before' => '<div class="cms-page-links">' .
                            '<div class="cms-page-links-inner">',
            'after'  => '</div></div>',
            'link_before' => '<span class="page-link-text">',
            'link_after' => '</span>'
        ) );
    ?></div><!-- .entry-content -->

    <footer class="entry-footer">
        <?php get_template_part( 'template-parts/single/post-content', 'footer' ); ?>
    </footer><!-- .entry-footer -->
</article><!-- #post-## -->
