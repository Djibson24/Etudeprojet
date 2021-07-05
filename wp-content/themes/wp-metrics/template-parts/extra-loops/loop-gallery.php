<?php defined( 'ABSPATH' ) or exit();

$tags = get_the_terms( get_the_ID(), 'gallery_tag' );
?>
<article <?php post_class( 'entry-cms-gallery-item' ); ?>>
    <?php if ( has_post_thumbnail() ) :
    $img = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' ); 
    $thumbnail_img = wp_get_attachment_image_src( get_post_thumbnail_id(), 'post-thumbnail' );
    echo '<img src="' . esc_url( isset( $thumbnail_img[0] ) && is_string( $thumbnail_img[0] ) ? $thumbnail_img[0] : '#' ) . '" alt="' . esc_attr( get_the_title() ) 
    . '" rel="prettyPhoto[' . esc_attr( $atts['html_id'] ) . ']"/>'; ?>
    <?php endif; ?>
    <div class="gallery-overlay">
        <div class="gallery-overlay-content"><?php $tags_text = ''; ?>
            <p class="gallery-tags"><?php
            foreach ( $tags as $key => $tag ) {
                $tags_text .= $tag->name . ', ';
            }
            echo substr( $tags_text, 0, -2 ); ?></p>
            <h3 class="gallery-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            <a class="gallery-lightbox-link" href="<?php echo esc_url( isset( $img[0] ) && is_string( $img[0] ) ? $img[0] : '#' ); ?>" rel="prettyPhoto[<?php echo esc_attr( $atts['html_id'] );?>]"><?php esc_html_e( 'Quick view', 'wp-metrics' ); ?></a>
        </div>
    </div>
</article>