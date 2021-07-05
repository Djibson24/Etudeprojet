<?php defined( 'ABSPATH' ) or exit();
$class_to_filter = 'cms-grid-wrapper';
$class_to_filter .= vc_shortcode_custom_css_class( $atts['css'], ' ' ) . $this->getExtraClass( $atts['el_class'] ) . $this->getCSSAnimation( $atts['css_animation'] );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );

$item_class = $this->getGridItemClass( $atts );
$wrapper_id = 'cms_grid_' . $this->getGridIndex();
$paged = $atts['paged'];
$posts = $atts['posts'];
$exlude_sticky = isset( $atts['exclude_sticky'] ) && 'true' == $atts['exclude_sticky'] ? true : false;
$items_data_attr = array();
$filterable = false;

if ( 'masonry' == $atts['layout'] ) {
    $items_data_attr[] = 'data-shuffle="true"';
    if ( 'true' == $atts['filter'] ) {
        $filterable = true;
    }

    if ( ! wp_script_is( 'images-loaded', 'enqueued' ) ) {
        wp_enqueue_script( 'images-loaded' );
    }
    if ( ! wp_script_is( 'jquery-shuffle', 'enqueued' ) ) {
        wp_enqueue_script( 'jquery-shuffle' );
    }
}

$post_types = isset( $atts['post_types'] ) ? $atts['post_types'] : null;
if ( ! empty( $post_types ) ) {
    if ( in_array( 'gallery', $post_types ) ) {
        if ( wp_script_is( 'magnific-popup', 'registered' ) ) {
            wp_enqueue_script( 'magnific-popup' );
        }
        else if ( ! wp_script_is( 'magnific-popup', 'enqueued' ) ) {
            wp_enqueue_script( 'magnific-popup', get_template_directory_uri() . '/assets/js/jquery.magnific-popup.min.js', array( 'jquery' ), '', true );
        }

        if ( wp_style_is( 'magnific-popup', 'registered' ) ) {
            wp_enqueue_style( 'magnific-popup' );
        }
        else if ( ! wp_style_is( 'magnific-popup', 'enqueued' ) ) {
            wp_enqueue_style( 'magnific-popup', get_template_directory_uri() . '/assets/css/magnific-popup.css' );
        }
        $items_data_attr[] = 'data-gallery-id="' . esc_attr( $wrapper_id ) . '"';
    }
}

if ( ! empty( $items_data_attr ) ) {
    $items_data_attr = ' ' . implode( ' ', $items_data_attr );
}
else {
    $items_data_attr = '';
}

$next_posts_link = '';
if ( $posts->have_posts() && $paged < $posts->max_num_pages ) {
    $next_posts_link = get_pagenum_link( $paged + 1, true );
}

$filter_html = $grid_html = '';
$terms_arr = array();

if ( $posts->have_posts() ) : ?>
<div class="<?php echo esc_attr( $css_class ); ?>" id="<?php echo esc_attr( $wrapper_id ); ?>">
    <div class="cms-grid content-area-full-width list-posts-standard"<?php echo $items_data_attr; ?>>
        <?php ob_start(); ?>
        <div class="row grid-items-wrapper">
            <div class="grid-items">
            <?php
            while ( $posts->have_posts() ) {
                $posts->the_post();
                $item_data_attr = $tax = '';

                switch ( get_post_type() ) {
                    case 'gallery':
                        $tax = 'gallery_tag';
                        break;
                    
                    default:
                        $tax = 'category';
                        break;
                }

                if ( $filterable ) {
                    $post_terms = get_the_terms( get_the_ID(), $tax );

                    if ( $post_terms && ! is_wp_error( $post_terms ) ) {
                        $item_data_attr = array();
                        foreach ( $post_terms as $key => $post_term ) {
                            $item_data_attr[] = esc_html( '"' . $post_term->slug . '"' );
                            if ( ! array_key_exists( $post_term->slug, $terms_arr ) ) {
                                $terms_arr[$post_term->slug] = $post_term->name;
                            }
                        }
                        if ( ! empty( $item_data_attr ) ) {
                            $item_data_attr = ' data-groups="' . esc_attr( '[' . implode( ',', $item_data_attr ) . ']' ) . '"';
                        }
                        else {
                            $item_data_attr = '';
                        }
                    }
                }

                if ( $atts['exclude_sticky'] && is_sticky() ) continue;
                ?>
                <div class="grid-item <?php echo esc_attr( $item_class );?>"<?php echo $item_data_attr; ?>>
                    <?php
                    switch( get_post_type() ) :
                        case 'gallery': $tags = get_the_terms( get_the_ID(), 'gallery_tag' ); ?>
                            <article class="cms-gallery-item">
                                <?php if ( has_post_thumbnail() ) :
                                $img = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' ); 
                                $thumbnail_img = wp_get_attachment_image_src( get_post_thumbnail_id(), 'wpmetrics-gallery-thumbnail' );
                                echo '<img src="' . esc_url( isset( $thumbnail_img[0] ) && is_string( $thumbnail_img[0] ) ? $thumbnail_img[0] : '#' ) . '" alt="' . esc_attr( get_the_title() ) 
                                . '" />'; ?>
                                <?php endif; ?>
                                <div class="gallery-overlay">
                                    <div class="gallery-overlay-content"><?php $tags_text = ''; ?>
                                        <p class="gallery-tags"><?php
                                        foreach ( $tags as $key => $tag ) {
                                            $tags_text .= $tag->name . ', ';
                                        }
                                        echo substr( $tags_text, 0, -2 ); ?></p>
                                        <h3 class="gallery-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                        <a class="btn btn-primary btn-hover-white gallery-lightbox-link" href="<?php echo esc_url( isset( $img[0] ) && is_string( $img[0] ) ? $img[0] : '#' ); ?>" data-gallery="gallery-lightbox[<?php echo esc_attr( $wrapper_id ); ?>]"><?php esc_html_e( 'Quick view', 'wp-metrics' ); ?></a>
                                    </div>
                                </div>
                            </article><?php
                            break; // <-- case 'gallery'
    
                        case 'post':
                            get_template_part( 'template-parts/loops/loop-post', 'standard' );
                            break;

                        default:
                            get_template_part( 'template-parts/extra-loops/loop', get_post_type() );
                            break;
                    endswitch; ?>
                </div>
                <?php
            } // <-- while
            ?>
            </div>
        </div>
        <?php
        if ( isset( $atts['nav_type'] ) ) {
            switch ( $atts['nav_type']) {
                case 'more':
                    if ( $paged < $posts->max_num_pages && '' != $next_posts_link ) {
                        $btn_text = ( isset( $atts['button_text'] ) && ! empty( $atts['button_text'] ) ) ? esc_html( $atts['button_text'] ) : esc_html__( 'Load more...', 'wp-metrics' );
                        echo '<nav class="navigation cms-posts-navigation clearfix">';
                        echo '<a class="btn btn-default btn-grid-loadmore" href="' . esc_url( $next_posts_link ) . '">' . $btn_text . '</a>';
                        echo '</nav>';
                    }
                    break;
                case 'page_links':
                    wpmetrics_posts_navigation( array(
                        'total'     => $posts->max_num_pages,
                        'current'   => $paged
                    ) );
                default:
                    break;
            }
            
        } ?>
        <?php $grid_html = ob_get_clean(); ?>
        <?php if ( $filterable && ! empty( $terms_arr ) && ksort( $terms_arr ) ) : ob_start(); ?>
        <div class="grid-filter-wrapper">
            <ul class="grid-filter"><?php
                echo '<li class="active"><a href="#" data-group="all">' . esc_html__( 'All', 'wp-metrics' ) . '</a></li>';
                foreach ( $terms_arr as $key => $term ) {
                    echo '<li><a href="#" data-group="' . esc_attr( $key ) . '">' . esc_html( $term ) . '</a></li>';
                }
            ?></ul>
        </div>
        <?php $filter_html = ob_get_clean(); ?>
        <?php endif; ?>
        <?php echo $filter_html; echo $grid_html; ?>
    </div>
</div><?php
else : get_template_part( 'template-parts/content', 'none' );
endif;
wp_reset_query();
wp_reset_postdata();
