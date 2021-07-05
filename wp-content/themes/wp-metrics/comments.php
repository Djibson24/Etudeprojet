<?php
/**
 * The template for displaying Comments.
 *
 * @package WPMetrics
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
    return;
}
?>

<div id="comments" class="comments-area">
    <?php if ( have_comments() ) : ?>
        <div class="cms-comments-wrap clearfix">
            <h4 class="comments-title post-section-title"><span><?php
                comments_number( esc_html__( 'Comments', 'wp-metrics' ),
                    esc_html__( '1 Comments','wp-metrics' ),
                    esc_html__( '% Comments','wp-metrics' )
                );
                ?></span>
                <span class="cms-divider divider-horizontal"><span class="divider-line-1">-</span><span class="divider-line-2">-</span><span class="divider-line-3">-</span></span>
            </h4>
            <ol class="comment-list">
                <?php wp_list_comments( 'type=comment&max_depth=3&callback=wpmetrics_theme_comment_template' ); ?>
            </ol>
            <?php // Are there comments to navigate through?
		    if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
		    <nav class="navigation comment-navigation" role="navigation">
		        <h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'wp-metrics' ); ?></h2>
		        <div class="nav-links">
		            <?php
		                if ( $prev_link = get_previous_comments_link( esc_html__( 'Older Comments', 'wp-metrics' ) ) ) :
		                    printf( '<div class="nav-previous">%s</div>', $prev_link );
		                endif;

		                if ( $next_link = get_next_comments_link( esc_html__( 'Newer Comments', 'wp-metrics' ) ) ) :
		                    printf( '<div class="nav-next">%s</div>', $next_link );
		                endif;
		            ?>
		        </div><!-- .nav-links -->
		    </nav><!-- .comment-navigation -->
		    <?php
		    endif; ?>
        </div>
    <?php endif; // have_comments() ?>

    <?php
    $commenter = wp_get_current_commenter();
    $req = get_option( 'require_name__mail' );
    $aria_req = ( $req ? " aria-required='true'" : '' );
    $args = array(
        'id_form'           => 'commentform',
        'id_submit'         => 'submit',
        'class_submit'		=> 'btn-filled',
        'title_reply'       => esc_html__( 'Leave A Reply','wp-metrics') . '<span class="cms-divider divider-horizontal"><span class="divider-line-1">-</span><span class="divider-line-2">-</span><span class="divider-line-3">-</span></span>',
        'title_reply_to'    => esc_html__( 'Leave A Reply To %s','wp-metrics'),
        'cancel_reply_link' => esc_html__( 'Cancel Reply','wp-metrics'),
        'label_submit'      => esc_html__( 'Post your comment','wp-metrics'),
        'submit_button'     => '<button name="%1$s" type="submit" id="%2$s" class="%3$s">%4$s</button>',
        'comment_notes_before' => '',
        'fields' => apply_filters( 'comment_form_default_fields', array(
                'author' =>
                '<p class="comment-form-author">' .
                '<input class="comment-form-field-input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
                '" size="30"' . $aria_req . ' placeholder="' . esc_html__( 'Your Name *', 'wp-metrics' ) . '"/></p>',

                'email' =>
                '<p class="comment-form-email">'.
                '<input class="comment-form-field-input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
                '" size="30"' . $aria_req . ' placeholder="' . esc_html__( 'Your Email *', 'wp-metrics' ) . '"/></p>',

                'url' =>
                '<p class="comment-form-url">' .
                '<input class="comment-form-field-input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
                '" size="30" placeholder="' . esc_html__( 'Website', 'wp-metrics' ) . '"/></p>',
        	)
        ),
        'comment_field' =>  '<p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="8" placeholder="' . 
        esc_html__( 'Comment', 'wp-metrics' ) . '" aria-required="true">' .
        '</textarea></p>',
    );
    comment_form($args);
    ?>

</div><!-- #comments -->
