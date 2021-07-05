<?php defined( 'ABSPATH' ) or exit();
/**
 * Template for displaying related posts in single post view.
 * @package WPMetrics
 */
if ( ! wpmetrics_get_theme_option( 'related_posts_enable', false ) ) return;
if ( 'post' !== get_post_type() ) return;

$post_temp = $post;
$categories = $tags = array();
$post_categories = get_the_category( get_the_ID() );
if ( $post_categories ) {
    foreach ( $post_categories as $key => $cat_obj ) {
        $categories[] = $cat_obj->cat_ID;
    }
}

$post_tags = wp_get_post_tags( get_the_ID() );
if ( $post_tags ) {
    foreach ( $post_tags as $tag ) {
        $tags[] = $tag->term_id;
    }
}

$args = array(
    'post__not_in' => array( get_the_ID() ),
    'tax_query' => array(
        'relation'  => 'OR',
        array(
            'taxonomy'         => 'category',
            'field'            => 'id',
            'terms'            => $categories,
            'include_children' => true,
            'operator'         => 'IN'
        ),
        array(
            'taxonomy'         => 'post_tag',
            'field'            => 'id',
            'terms'            => $tags,
            'include_children' => false,
            'operator'         => 'IN'
        )
    ),
    'posts_per_page'         => 3,
);
$query = new WP_Query( $args );

if ( $query->have_posts() ) : ?>
<div class="cms-post-related">
    <h4 class="post-section-title"><?php esc_html_e( 'Related Posts', 'wp-metrics' ); ?><span class="cms-divider divider-horizontal"><span class="divider-line-1">-</span><span class="divider-line-2">-</span><span class="divider-line-3">-</span></span></h4>
    <div class="row">
        <?php while ( $query->have_posts() ) : $query->the_post(); ?>
        <div class="col-sm-4">
            <article <?php post_class( 'entry-posts-related' ); ?>>
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
                    <?php if ( 'post' === get_post_type() ) : ?>
                    <div class="entry-meta">
                        <?php wpmetrics_post_entry_meta( array( 'show_comments' => false, 'show_author' => false ) ); ?>
                    </div><!-- .entry-meta -->
                    <?php endif; ?>
                    <?php echo '<h6 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . get_the_title() . '</a></h6>'; ?>
                </header><!-- .entry-header -->
            </article><!-- #post-## -->
        </div>
        <?php endwhile; ?>
    </div>
</div><?php
endif;
$post = $post_temp;
wp_reset_postdata();
    