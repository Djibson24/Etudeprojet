<?php defined( 'ABSPATH' ) or exit();
/**
 * Template part for displaying single post author.
 * @package  WPMetrics
 */
if ( ! wpmetrics_get_theme_option( 'show_single_post_author', false ) ) return;
if ( 'post' !== get_post_type() ) return;

$author_id = get_the_author_meta( 'ID' );
$author_socials = get_the_author_meta( '_cms_user_socials', $author_id );
?>
<div class="cms-post-author">
    <h4 class="post-section-title"><?php printf( esc_html__( 'About %s', 'wp-metrics' ), get_the_author_meta( 'display_name' ) ); ?><span class="cms-divider divider-horizontal"><span class="divider-line-1">-</span><span class="divider-line-2">-</span><span class="divider-line-3">-</span></span></h4>
    <div class="post-author-body">
        <div class="post-author-avatar">
            <?php echo get_avatar( $author_id ); ?>
        </div>
        <div class="post-author-desc">
            <div class="post-author-desc-text">
            <?php echo get_the_author_meta( 'description' ); ?> 
            </div>
            <?php if ( is_array( $author_socials ) && '' != implode( '', $author_socials ) ) : ?>
            <ul class="author-social-links cms-social icon-style-rounded">
                <?php foreach ( $author_socials  as $key => $link ) : ?>
                <?php if ( '' != $link ) : ?>
                <li class="<?php echo esc_attr( $key ); ?>">
                    <a href="<?php echo esc_url( $link ); ?>" target="_blank"><i class="fa fa-<?php echo esc_attr( $key ); ?>"></i></a>
                </li>
                <?php endif; ?>
                <?php endforeach; ?>
            </ul>
            <?php endif; ?>
        </div>
    </div>
</div>
