<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WPMetrics
 */

?>

<article <?php post_class( esc_attr( "post-" . get_the_ID() ) ); ?>>
    <div class="entry-content"><?php
        the_content();
        wp_link_pages( array(
            'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'wp-metrics' ),
            'after'  => '</div>',
        ) );
    ?></div><!-- .entry-content --><?php
    edit_post_link(
        sprintf(
            /* translators: %s: Name of current post */
            esc_html__( 'Edit %s', 'wp-metrics' ),
            the_title( '<span class="screen-reader-text">"', '"</span>', false )
        ),
        '<span class="edit-link">',
        '</span>'
    );
?></article><!-- #post-## -->
