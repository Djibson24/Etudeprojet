<?php defined( 'ABSPATH' ) or exit();
/**
 * The template part to display default archive layout.
 * This template part is used for default index, category, archive page.
 */


$sidebar_pos = wpmetrics_get_theme_option( 'posts_sidebar', 'left' );
$sidebar_layout = wpmetrics_get_theme_option( 'posts_sidebar_layout', 'standard' );
$posts_layout = wpmetrics_get_theme_option( 'posts_layout', 'standard' );

$posts_container_classes = 'content-area';
$sidebar_container_classes = 'widget-area';

// Full with offset means no sidebar
if ( 'full' === $posts_layout ) {
    $posts_container_classes .= ' content-area-full-width';
}
// We have sidebar or maybe no sidebar at all
else {
    if ( 'no' != $sidebar_pos ) {
        $posts_container_classes .= ' content-area-with-sidebar';
        switch ( $sidebar_layout ) {
            case 'boxed':
                $sidebar_container_classes .= ' widget-area-boxed col-md-4';
                $posts_container_classes .= ' col-md-8';
                break;
            
            default:
                $sidebar_container_classes .= ' col-md-4 col-lg-3';
                $posts_container_classes .= ' col-md-8 col-lg-9';
                break;
        }
    }
    else {
        $posts_container_classes .= ' content-area-no-sidebar';
    }

    switch ( $posts_layout ) {
        case 'standard':
            break;

        case 'grid':
        default:
            $post_columns = wpmetrics_get_theme_option( 'posts_grid_columns', '2' );

            switch ( $post_columns ) {
                case '3':
                    if ( 'no' != $sidebar_pos ) {
                        $post_container_class = 'col-sm-6 col-md-4 col-lg-4 column-post';
                    }
                    else {
                        $post_container_class = 'col-sm-6 col-md-6 col-lg-4 column-post';
                    }
                    break;

                // Default to 2
                default:
                    $post_container_class = 'col-sm-6 col-md-6 col-lg-6 column-post';
                    break;
            }
            $posts_container_classes .= ' content-area-grid-' . $post_columns;
            break;
    }
}

?>
<div id="content" class="site-content site-content-blog">
    <div class="container">
        <?php
        if ( 'full' != $posts_layout ) {
            if ( 'left' === $sidebar_pos || 'right' === $sidebar_pos ) {
                echo '<div class="row">';
                if ( 'left' === $sidebar_pos ) {
                    wpmetrics_get_sidebar( 'sidebar-1', array( 'container_class' => $sidebar_container_classes ) );
                }
            }
        }
        ?>
        <div id="primary" class="<?php echo esc_attr( $posts_container_classes ); ?>">
            <main id="main" class="site-main">
                <?php
                if ( have_posts() ) {
                    if ( 'standard' !== $posts_layout && 1 < $post_columns ) {
                        echo '<div class="row">';
                    }
                    while ( have_posts() ) {
                        the_post();
                        if ( ! empty( $post_container_class ) ) {
                            echo '<div class="' . esc_attr( $post_container_class ) . '">';
                        }
                        get_template_part( 'template-parts/loops/loop-post', $posts_layout );
                        if ( ! empty( $post_container_class ) ) {
                            echo '</div>';
                        }
                    }
                    if ( 'standard' !== $posts_layout && 1 < $post_columns ) {
                        echo '</div>';
                    }
                    wpmetrics_posts_navigation();
                }
                else {
                    get_template_part( 'template-parts/content', 'none' );
                }
                ?>
            </main>
        </div>
        <?php
            if ( 'full' != $posts_layout ) {
                if ( 'left' === $sidebar_pos || 'right' === $sidebar_pos ) {
                    if ( 'right' === $sidebar_pos ) {
                        wpmetrics_get_sidebar( 'sidebar-1', array( 'container_class' => $sidebar_container_classes ) );
                    }
                    echo '</div>'; // <-- .row
                }
            }
        ?>
    </div>
</div>
