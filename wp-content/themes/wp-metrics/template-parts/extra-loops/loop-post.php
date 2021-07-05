<article <?php post_class( 'entry-posts' ); ?>>
    <header class="entry-header">
        <?php if ( 'post' === get_post_type() ) : ?>
        <div class="entry-meta">
            <?php echo wpmetrics_post_entry_meta( array(
                    'show_tags'     => false,
                    'show_author'   => false,
                    'show_comments' => false
                ) ); ?>
        </div><!-- .entry-meta -->
        <?php endif; ?>
        <?php the_title( sprintf( '<h3 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
    </header><!-- .entry-header -->
    <div class="entry-content"><?php
        wpmetrics_get_the_excerpt( get_the_ID(), array( 'read_more' => '', 'length' => 28 ) ); 
    ?></div><!-- .entry-content -->

    <footer class="entry-footer">
        <?php //cshero_posts_entry_footer(); ?>
    </footer><!-- .entry-footer -->
</article><!-- #post-## -->