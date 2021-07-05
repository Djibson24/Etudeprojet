<?php
/**
 * The template for displaying search results pages.
 *
 * @package WPMetrics
 */
get_header();
$sidebar_pos = wpmetrics_get_theme_option( 'posts_sidebar', 'left' );
$sidebar_layout = wpmetrics_get_theme_option( 'posts_sidebar_layout', 'standard' );

$posts_container_classes = 'content-area';
$sidebar_container_classes = 'widget-area';

// We have sidebar or maybe no sidebar at all
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
?>
<div id="content" class="site-content site-content-blog">
    <div class="container">
        <?php if ( 'left' === $sidebar_pos || 'right' === $sidebar_pos ) : ?><div class="row"><?php endif; ?>
        <?php if ( 'left' === $sidebar_pos ) : wpmetrics_get_sidebar( 'sidebar-1', array( 'container_class' => $sidebar_container_classes ) ); endif; ?>
        <div id="primary" class="<?php echo esc_attr( $posts_container_classes ); ?>">
            <main id="main" class="site-main">
                <?php
                    if ( have_posts() ) {
                        while ( have_posts() ) {
                            the_post();
                            get_template_part( 'template-parts/content', 'search' );
                        }
                        wpmetrics_posts_navigation();
                    }
                    else {
                        get_template_part( 'template-parts/content', 'none' );
                    }
                ?>
            </main>
        </div>
        <?php if ( 'right' === $sidebar_pos ) : wpmetrics_get_sidebar( 'sidebar-1', array( 'container_class' => $sidebar_container_classes ) ); endif; ?>
        <?php if ( 'left' === $sidebar_pos || 'right' === $sidebar_pos ) : ?></div><?php endif; ?>
    </div>
</div>
<?php get_footer(); ?>
