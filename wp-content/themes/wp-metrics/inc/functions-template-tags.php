<?php defined( 'ABSPATH' ) or exit();
/**
 * [Function Set]
 * - Template tags for the theme
 * @package CMS
 * @subpackage WPMetrics
 */


/**
 * Prints out theme breadcrumbs
 * @return void
 */
function wpmetrics_breadcrumb( $args = array() )
{
    // If WooCommerce is used then we use its breadcrumb
    if ( class_exists( 'WooCommerce' ) && is_woocommerce() ) {
        woocommerce_breadcrumb( array(
            'wrap_before' => '<nav class="cms-breadcrumb cms-shop-breadcrumb">',
            'wrap_after' => '</nav>',
            'before' => '',
            'after' => '',
            'delimiter'   => '<span class="breadcrumb-sep">&#47;</span>',
        ) );
        return;
    }

    // The theme breadcrumb
    if ( ! class_exists( 'WPMetrics_Breadcrumb') ) {
        require get_template_directory() . '/inc/classes/class-breadcrumb.php';
    }

    $args = wp_parse_args( $args, array(
        'prefix'            => esc_html__( 'You are here: ', 'wp-metrics' ),
        'show_home'         => esc_html__( 'Home', 'wp-metrics' ),
        'show_posts_page'   => true,
        'seperator'         => '<span class="breadcrumb-sep">&#47;</span>',
        'before'            => '<nav class="cms-breadcrumb">',
        'after'             => '</nav>',
        'item_before'       => '',
        'item_after'        => '',
    ) );

    $bcrumb_obj = new WPMetrics_Breadcrumb();

    if ( ! empty( $args['show_home'] ) && ! is_front_page() ) $bcrumb_obj->add_entry( $args['show_home'], esc_url( home_url( '/' ) ) );

    if ( ! is_front_page() && ! is_page() && ! is_search() && ! is_post_type_archive() && get_option( 'page_for_posts' ) ) {
        $pid = get_option( 'page_for_posts' );
        if ( ! is_single() ) {
            $bcrumb_obj->add_entry( get_the_title( $pid ), get_permalink( $pid ) );
        } else {
            $post_type_obj = get_post_type_object( get_post_type() );

            if ( ( $post_type_obj->rewrite && $post_type_obj->rewrite['with_front'] && $args['show_posts_page'] ) || 'post' == get_post_type() ) {
                $bcrumb_obj->add_entry( get_the_title( $pid ), get_permalink( $pid ) );
            }
        }
    }

    $breadcrumb = $bcrumb_obj->generate();

    $num_items = count( $breadcrumb );

    if ( ! $num_items ) return;

    $index = 0;

    echo wp_kses_post( $args['before'] );

    foreach ( $breadcrumb  as $key => $entry ) {
        if ( '' != $entry['text'] ) {
            $words = explode( ' ', $entry['text'], 4 );
            if ( count( $words ) > 3 ) {
                array_pop( $words );
                $words = implode( ' ', $words ) . '...';
            } else {
                $words = $entry['text'];
            }
        } else {
            $words = '';
        }
        echo wp_kses_post( $args['item_before'] );

        if ( ! empty( $entry['link'] ) ) {
            echo '<a href="' . esc_url( $entry['link'] ) . '">' . $entry['text'] . '</a>';
        } else {
            echo '<span class="current">' . $words . '</span>';
        }
        if ( ++$index < $num_items ) {
            echo wp_kses_post( $args['seperator'] );
        }

        echo wp_kses_post( $args['item_after'] );
    }
    echo wp_kses_post( $args['after'] );
}



/**
 * Get the title of current page view
 * @param  boolean $echo Echo or return, default echo
 * @return string        Title of current page view
 */
function wpmetrics_get_the_title() {
    $title = '';

    if ( ! is_archive() ) {
        //-- Posts page view
        if ( is_home() ) $title = is_front_page() ? '' : single_post_title( '', false );
        //-- Single page view
        elseif ( is_single() || is_page() ) $title = get_the_title();
        //-- 404
        elseif ( is_404() ) $title = apply_filters( 'metrics_page_title_404', esc_html( '404', 'wp-metrics' ) );
        //-- Search result
        elseif ( is_search() ) $title = apply_filters( 'metrics_page_title_searcg', sprintf( esc_html( 'Search results for: "%s"', 'wp-metrics'), get_search_query() ) );
    }
    elseif ( class_exists( 'WooCommerce') && is_woocommerce() ) $title = woocommerce_page_title( false );
    else {
        $title = get_the_archive_title();
    }

    //-- Return nothing if none of conditions above works.
    return ( '' !== $title ? $title : false );
}



/**
 * Prints title block markup
 * @param  string|int   $pagetitle_layout
 * @param  string       $pagetitle_classes
 * @param  array        $pagetitle_style_attr
 * @param  string       $title
 * @param  string       $subtitle
 * @return void
 */
function wpmetrics_page_title( $pagetitle_layout = '1', $pagetitle_classes = 'bottom', $pagetitle_style_attr = array(), $title = '', $subtitle = '' )
{
    $title_allowed_html = array(
        'strong' => array(),
        'em' => array(),
        'b' => array(),
        'i' => array(),
        'u' => array(),
        'span' => array()
    );

    $title = empty( $title ) ? '' : '<h1 class="title">' . $title . '</h1>';

    if ( false === $subtitle || '' == $subtitle ) {
        if ( is_category() ) {
            $subtitle = category_description();
        }
        if ( class_exists( 'WooCommerce' ) && is_woocommerce() && is_tax( 'product_cat' ) ) {
            $subtitle = strip_tags( term_description( get_queried_object()->term_id, 'product_cat' ) );
        }
    }
    if ( '' != $subtitle ) {
        $subtitle = '<div class="subtitle">' . $subtitle . '</div>';
    }

    ob_start();
    echo '<div id="page_title" class="' . esc_attr( $pagetitle_classes ) . '"' . ( empty( $pagetitle_style_attr ) ? '' : ' style="' . esc_attr( implode( ';', $pagetitle_style_attr ) ) . '"' ) . '>';
    echo    '<div class="page-title-inner">';
    echo        '<div class="container">';
    switch ( $pagetitle_layout ) {
        case '2':
            echo '<div class="page-title-text">';
            if ( ! empty( $title ) ) {
                echo '<h1 class="title">' . wp_kses( $title, $title_allowed_html ) . '</h1>';
            }
            if ( ! empty( $subtitle ) ) {
                echo '<div class="subtitle">' . wp_kses( $subtitle, $title_allowed_html ) . '</div>';
            }
            echo '</div>';
            break;

        case '3':
            echo '<div class="page-title-text">';
            if ( ! empty( $title ) ) {
                echo '<h1 class="title">' . wp_kses( $title, $title_allowed_html ) . '</h1>';
            }
            echo '</div>';
            break;

        case '4':
            echo '<div class="page-title-text">';
            if ( ! empty( $title ) ) {
                echo '<h1 class="title">' . wp_kses( $title, $title_allowed_html ) . '</h1>';
            }
            if ( ! empty( $subtitle ) ) {
                echo '<div class="subtitle">' . wp_kses( $subtitle, $title_allowed_html ) . '</div>';
            }
            echo    '<div class="page-title-breadcrumb">';
                        wpmetrics_breadcrumb();
            echo    '</div>';
            echo '</div>';
            break;

        case '5':
            echo '<div class="page-title-text">';
            if ( ! empty( $title ) ) {
                echo '<h1 class="title">' . wp_kses( $title, $title_allowed_html ) . '</h1>';
            }
            if ( ! empty( $subtitle ) ) {
                echo '<div class="subtitle">' . wp_kses( $subtitle, $title_allowed_html ) . '</div>';
            }
            echo    '<div class="page-title-breadcrumb">';
                        wpmetrics_breadcrumb();
            echo    '</div>';
            echo '</div>';
            break;

        case '6':
            echo '<div class="page-title-text">';
            if ( ! empty( $title ) ) {
                echo '<h1 class="title">' . wp_kses( $title, $title_allowed_html ) . '</h1>';
            }
            if ( ! empty( $subtitle ) ) {
                echo '<div class="subtitle">' . wp_kses( $subtitle, $title_allowed_html ) . '</div>';
            }
            echo    '<div class="page-title-breadcrumb">';
                        wpmetrics_breadcrumb();
            echo    '</div>';
            echo '</div>';
            break;

        case '7':
            echo '<div class="page-title-text">';
            if ( ! empty( $title ) ) {
                echo '<h1 class="title">' . wp_kses( $title, $title_allowed_html ) . '</h1>';
            }
            echo    '<div class="page-title-breadcrumb">';
                        wpmetrics_breadcrumb();
            echo    '</div>';
            echo '</div>';
            break;

        case '8':
            echo '<div class="page-title-text">';
            if ( ! empty( $title ) ) {
                echo '<h1 class="title">' . wp_kses( $title, $title_allowed_html ) . '</h1>';
            }
            echo    '<div class="page-title-breadcrumb">';
                        wpmetrics_breadcrumb();
            echo    '</div>';
            echo '</div>';
            break;

        case '9':
            echo '<div class="page-title-elements">';
            echo    '<div class="page-title-text">';
            if ( ! empty( $title ) ) {
                echo '<h1 class="title">' . wp_kses( $title, $title_allowed_html ) . '</h1>';
            }
            if ( ! empty( $subtitle ) ) {
                echo '<div class="subtitle">' . wp_kses( $subtitle, $title_allowed_html ) . '</div>';
            }
            echo    '</div>';
            echo    '<div class="page-title-breadcrumb">';
                        wpmetrics_breadcrumb();
            echo    '</div>';
            echo '</div>';
            break;

        case '10':
            echo '<div class="page-title-elements">';
            echo    '<div class="page-title-text">';
            if ( ! empty( $title ) ) {
                echo '<h1 class="title">' . wp_kses( $title, $title_allowed_html ) . '</h1>';
            }
            echo    '</div>';
            echo    '<div class="page-title-breadcrumb">';
                        wpmetrics_breadcrumb();
            echo    '</div>';
            echo '</div>';
            break;

        case '11':
            echo '<div class="page-title-elements">';
            echo    '<div class="page-title-text">';
            if ( ! empty( $title ) ) {
                echo '<h1 class="title">' . wp_kses( $title, $title_allowed_html ) . '</h1>';
            }
            echo    '</div>';
            echo    '<div class="page-title-breadcrumb">';
                        wpmetrics_breadcrumb();
            echo    '</div>';
            echo '</div>';
            break;
        
        default:
            echo '<div class="page-title-text">';
            if ( ! empty( $title ) ) {
                echo '<h1 class="title">' . wp_kses( $title, $title_allowed_html ) . '</h1>';
            }
            if ( ! empty( $subtitle ) ) {
                echo '<div class="subtitle">' . wp_kses( $subtitle, $title_allowed_html ) . '</div>';
            }
            echo '</div>';
            echo '<div class="page-title-breadcrumb">';
                    wpmetrics_breadcrumb();
            echo '</div>';
            break;
    }
    echo        '</div>';
    echo    '</div>';
    echo '</div>';
    echo ob_get_clean();
}




/**
 * Prints excerpt with custom limited words from content
 * @param  integer $post_id
 * @param  array   $args 
 * @return void
 */
function wpmetrics_get_the_excerpt( $post_id = 0, $args = array() ) {
    $args = wp_parse_args( $args, array(
        'length' => 55,
        'more' => ' ...',
        'read_more' => false,
        'read_more_class' => 'read-more-link',
        'read_more_text' => '',
        'read_more_container' => 'div',
        'read_more_container_class' => 'cms-read-more'
    ) );

    if ( is_numeric( $post_id ) && $post_id > 0 ) {
        $post_obj = get_post( $post_id );
        $excerpt = $post_obj->post_excerpt;
        if ( empty( $excerpt ) ) {
            $content = wp_strip_all_tags( do_shortcode( $post_obj->post_content ), true );
        }
        else {
            $content = $excerpt;
        }
        $permalink = get_permalink( $post_obj );
    } else {
        $excerpt = get_the_excerpt();
        if ( empty( $excerpt ) ) {
            $content = wp_strip_all_tags( do_shortcode( get_the_content() ), true );
        }
        else {
            $content = $excerpt;
        }
        $permalink = get_permalink();
    }
    $content = str_replace( "&nbsp;", " ", $content );
    $content = trim( preg_replace( '/\s+/', ' ', $content ) );
    $read_more = '';
    $excerpt_more = false;

    if ( $args['read_more'] ) {
        $read_more = '<a class="' . esc_attr( $args['read_more_class'] ) . '" href="' . esc_url( $permalink ) . '">' . $args['read_more_text'] . '</a>';
        if ( ! empty ( $args['read_more_container'] ) ) {
            if ( ! empty ( $args['read_more_container_class'] ) ) {
                $read_more = '<' . esc_html( $args['read_more_container'] ) . ' class="' . esc_attr( $args['read_more_container_class'] ) . '">' . $read_more . '</' . esc_html( $args['read_more_container'] ) . '>';
            }
            else {
                $read_more = '<' . esc_html( $args['read_more_container'] ) . '>' . $read_more . '</' . esc_html( $args['read_more_container'] ) . '>';
            }
        }
    }
    
    $words = explode( ' ', $content, $args['length'] + 1 );
    if ( count( $words ) > $args['length'] ) {
        array_pop( $words );
        $last_word = $words[count($words) - 1];
        if ( false !== strrpos( $last_word, '.' ) || false !== strrpos( $last_word, ',' ) ) {
            $last_word = substr( $last_word, 0, -1 );
        }
        $words[count($words) - 1] = $last_word;
        $excerpt_more = true;
    }
    echo implode( ' ', $words ) . ( $excerpt_more ? $args['more'] . $read_more : '' );
}



/**
 * Prints meta info of a post
 * 
 * @param array $args {
 *   Agruments
 *   @var bool show_date
 *   @var bool show_comments
 *   @var bool show_author
 *   @var bool show_categories
 *   @var bool show_tags
 * }
 */
function wpmetrics_post_entry_meta( $args = array() )
{
    $args = wp_parse_args( $args, array(
        'show_date'         => true,
        'show_comments'     => true,
        'show_author'       => true,
        'show_categories'   => true,
        'show_tags'         => true
    ) );

    echo '<ul>';

    if ( $args['show_date'] ) {
        echo sprintf(
            '<li class="entry-posted-on"><a href="%1s" rel="bookmark"><time class="entry-date" datetime="%2$s">%3$s</time></a></li>',
            esc_url( get_permalink() ),
            get_the_date( 'c' ),
            get_the_date( get_option( 'date_format' ) )
        );
    }

    if ( $args['show_categories'] && 'post' === get_post_type() ) {
        $categories_list = get_the_category_list( esc_html__( ', ', 'wp-metrics' ) );
        if ( $categories_list ) {
            echo '<li class="entry-cat-links">' . $categories_list . '</li>';
        }
    }

    if ( $args['show_comments'] && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
        echo '<li class="entry-comments">';
        echo _n( 'Comment:', 'Comments:', get_comments_number(), 'wp-metrics' ) . ' ',
        comments_popup_link( '0', '1', '%' );
        echo '</li>';
    }

    if ( $args['show_author'] ) {
        echo sprintf(
            '<li class="entry-byline">%1$s<span class="author vcard"><a class="url fn n" href="%2$s">%3$s</a></li>',
            esc_html( 'By: ', 'wp-metrics' ),
            esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
            esc_html( get_the_author() )
        );
    }

    edit_post_link(
        sprintf(
            '<i class="fa fa-pencil"></i><span class="screen-reader-text"> %1$s %2$s</span>',
            esc_html( 'Edit', 'wp-metrics' ),
            the_title( ' <span class="screen-reader-text">"', '"</span>', false )
        ),
        '<li class="entry-edit-link">',
        '</li>'
    );

    echo '</ul>';
}



/**
 * Get featured elements based on post_format and its content
 * @param  integer $post_id
 * @param  string $thumbnail_size Fallback thumbnail size if feature element can not be found.
 * @return void
 */
function wpmetrics_post_format_featured( $post_id, $thumbnail_size = 'medium' )
{
    $post_obj = get_post( $post_id );
    if ( empty( $post_obj ) ) return;

    $post_content = $post_obj->post_content;
    $post_format = get_post_format( $post_id );

    ob_start();
    switch ( $post_format )
    {
        // Video
        case 'video' :
            global $wp_embed;

            $local_video = wpmetrics_get_shortcode_from_content( 'video', $post_content );
            $remote_video = wpmetrics_get_shortcode_from_content( 'embed', $post_content );

            if ( $local_video || $remote_video ) {
                echo '<div class="entry-featured entry-featured-video">';
                if ( $local_video ) {
                    echo do_shortcode( $local_video );
                }
                else {
                    echo do_shortcode( $wp_embed->run_shortcode( $remote_video ) );
                }
                echo '</div>';
            }
            else {
                if ( has_post_thumbnail() ) {
                    echo '<div class="entry-featured entry-featured-image">';
                    the_post_thumbnail( $thumbnail_size );
                    echo '</div>';
                }
            }
            break;
        
        // Audio
        case 'audio' :
            $audio = wpmetrics_get_shortcode_from_content( 'audio', $post_content );
            if ( $audio ) {
                echo '<div class="entry-featured entry-featured-audio">';
                echo do_shortcode( $audio );
                echo '</div>';
            } else {
                if ( has_post_thumbnail() ) {
                    echo '<div class="entry-featured entry-featured-image">';
                    the_post_thumbnail( $thumbnail_size );
                    echo '</div>';
                }
            }
            break;

        // Gallery
        case 'gallery' :
            $gallery = wpmetrics_get_shortcode_from_content( 'gallery', $post_content );
            if ( $gallery ) {
                preg_match( '/\[gallery.*ids=.(.*).\]/', $gallery, $gallery_ids );
                if ( empty( $gallery_ids ) || count( $gallery_ids ) < 1 ) {
                    break;
                }
                $gallery_ids_arr = explode( ",", $gallery_ids[1] );
                $gallery_carousel_indicator = '<ol class="carousel-indicators">';
                echo '<div class="entry-featured entry-featured-gallery">';
                echo    '<div id="cms_post_gallery_' . esc_attr( $post_obj->ID ) . '" class="carousel slide" data-ride="carousel">';
                echo        '<div class="carousel-inner">';
                $index = 0;
                foreach ( $gallery_ids_arr as $gallery_img_id ) {
                    $gallery_img = wp_get_attachment_image_src( $gallery_img_id, $thumbnail_size, false );
                    if ( $gallery_img[0] != '' ) {
                        echo '<div class="item' . ( $index == 0 ? ' active' : '' ) . '">';
                        echo    '<img style="width:100%;" src="' . esc_url( $gallery_img[0] ) . '" alt="" />';
                        echo '</div>';
                        $gallery_carousel_indicator .= '<li data-target="#cms_post_gallery_' . esc_attr( $post_obj->ID ) . '" data-slide-to="' . esc_attr( $index ) . '"' . ( $index == 0 ? ' class="active"' : '' ) . '>';
                        $index ++;
                    }
                }
                echo        '</div>';
                echo        '<a class="left carousel-control" href="#cms_post_gallery_' . esc_attr( $post_obj->ID ) . '" role="button" data-slide="prev"><span class="fa fa-angle-left"></span></a>';
                echo        '<a class="right carousel-control" href="#cms_post_gallery_' . esc_attr( $post_obj->ID ) . '" role="button" data-slide="next"><span class="fa fa-angle-right"></span></a>';
                echo        $gallery_carousel_indicator . '</ol>';
                echo    '</div>';
                echo '</div>';
            }
            else {
                if ( has_post_thumbnail() ) {
                    echo '<div class="entry-featured entry-featured-image">';
                    the_post_thumbnail( $thumbnail_size );
                    echo '</div>';
                }
            }
            break;

        // Blockquote
        case 'quote' :
            preg_match( '/<blockquote>(.*?)<\/blockquote>/s', $post_content, $blockquote );
            if ( ! empty($blockquote[0] ) ) {
                echo '<div class="entry-featured entry-featured-blockquote">' . $blockquote[0] . '</div>';
            } else {
                if ( has_post_thumbnail() ) {
                    echo '<div class="entry-featured entry-featured-image">';
                    the_post_thumbnail( $thumbnail_size );
                    echo '</div>';
                }
            }
            break;

        // Link
        case 'link' :
            preg_match( '/<a.*?\>(.*?)<\/a>/m', $post_content, $link );
            if ( ! empty($link[0] ) ) {
                echo '<div class="entry-featured entry-featured-link">' . $link[0] . '</div>';
            } else {
                if ( has_post_thumbnail() ) {
                    echo '<div class="entry-featured entry-featured-image">';
                    the_post_thumbnail( $thumbnail_size );
                    echo '</div>';
                }
            }
            break;

        // Image
        case 'image' :
            if ( has_post_thumbnail() ) {
                echo '<div class="entry-featured entry-featured-image">';
                the_post_thumbnail( $thumbnail_size );
                echo '</div>';
            }
            else {
                preg_match( '/<img[^>]+\/>/m', $post_content, $img );
                if ( ! empty($img[0] ) ) {
                    echo '<div class="entry-featured entry-featured-image">' . $img[0] . '</div>';
                }
            }
            break;

        // Default to standard
        default:
            if ( has_post_thumbnail() ) {
                echo '<div class="entry-featured entry-featured-image">';
                the_post_thumbnail( $thumbnail_size );
                echo '</div>';
            }
            break;
    }
    echo ob_get_clean();
}


/**
 * Prints HTML markup about author at the end of a post.
 */
function wpmetrics_posts_entry_footer() {
    printf( '<div class="entry-byline"><span class="author-image vcard">%1$s</span>%2$s<a href="%3$s">%4$s</a></div>',
        get_avatar( get_the_author_meta( 'ID' ) ),
        esc_html( 'By: ', 'wp-metrics' ),
        esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
        esc_html( get_the_author() )
    );
}


/**
 * Print paging navigation based on current query
 * @param  array  $args Agruments
 */
function wpmetrics_posts_navigation( $args = array() )
{
    global $wp_query;
    $args = wp_parse_args( $args, array(
        'before'    => '<nav class="navigation cms-posts-navigation paging-navigation"><div class="pagination loop-pagination">',
        'after'     => '</div></nav>',
        'mid_size'  => 1,
        'prev_text' => '<i class="fa fa-angle-left"></i>',
        'next_text' => '<i class="fa fa-angle-right"></i>',
        'total'     => $wp_query->max_num_pages,
        'current'   => get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1
    ) );

    // Don't print empty markup if there's only one page.
    if ( ! is_numeric( $args['total'] ) || $args['total'] < 2 || ! is_numeric( $args['current'] ) || $args['current'] < 0 ) {
        return;
    }

    $pagenum_link = html_entity_decode( get_pagenum_link() );
    $query_args   = array();
    $url_parts    = explode( '?', $pagenum_link );

    if ( isset( $url_parts[1] ) ) {
        wp_parse_str( $url_parts[1], $query_args );
    }

    $pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
    $pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

    $format  = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
    $format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';

    // Set up paginated links.
    $links = paginate_links( array(
            'base'     => $pagenum_link,
            'format'   => $format,
            'total'    => $args['total'],
            'current'  => $args['current'],
            'mid_size' => $args['mid_size'],
            'add_args' => array_map( 'urlencode', $query_args ),
            'prev_text' => $args['prev_text'],
            'next_text' => $args['next_text'],
    ) );

    echo ( $links ? $args['before'] . $links . $args['after'] : '' );
}


/**
 * Print next/previous post link on single view
 * @return void
 */
function wpmetrics_post_navigation()
{
    $previous = get_previous_post();
    $next = get_next_post();

    if ( $previous || $next ) {
        ob_start();
        echo '<nav class="cms-post-navigation">';
        echo    '<h2 class="screen-reader-text">' . esc_html__( 'Post navigation', 'wp-metrics' ) . '</h2>';
        echo    '<div class="post-navigation-inner">';

        if ( $next ) {
            echo    '<a class="nav-previous' . ( has_post_thumbnail( $next->ID ) ? ' has-post-thumbnail' : '' ) . '" href="' . esc_url( get_permalink( $next->ID ) ) . '">';
            echo        '<div class="nav-inner">';
            if ( has_post_thumbnail( $next->ID ) ) {
                echo        '<div class="post-thumbnail">' . get_the_post_thumbnail( $next->ID, 'thumbnail' ) . '</div>';
            }
            echo            '<div class="post-summary">';
            echo                '<h6>' . esc_html__( 'Previous Post', 'wp-metrics' ) . '</h6>';
            echo                '<h4 class="entry-title">' . esc_html( $next->post_title ) . '</h4>';
            echo            '</div>';
            echo        '</div>';
            echo    '</a>';
        }

        if ( $previous ) {
            echo    '<a class="nav-next' . ( has_post_thumbnail( $previous->ID ) ? ' has-post-thumbnail' : '' ) . '" href="' . esc_url( get_permalink( $previous->ID ) ) . '">';
            echo        '<div class="nav-inner">';
            if ( has_post_thumbnail( $previous->ID ) ) {
                echo        '<div class="post-thumbnail">' . get_the_post_thumbnail( $previous->ID, 'thumbnail' ) . '</div>';
            }
            echo            '<div class="post-summary">';
            echo                '<h6>' . esc_html__( 'Next Post', 'wp-metrics' ) . '</h6>';
            echo                '<h4>' . esc_html( $previous->post_title ) . '</h4>';
            echo            '</div>';
            echo        '</div>';
            echo    '</a>';
        }

        echo    '</div>';
        echo '</nav>';
    }
    echo ob_get_clean();
}
