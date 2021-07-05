<?php defined( 'ABSPATH' ) or exit();
/**
 * Template Name: Left Sidebar
 * @package WPMetrics
 */
get_header();

$sidebar = wpmetrics_get_post_meta( get_the_ID(), '_cms_page_sidebar' );
$sidebar_layout = wpmetrics_get_post_meta( get_the_ID(), '_cms_page_sidebar_layout' );

if ( ! $sidebar_layout ) {
    $sidebar_layout = wpmetrics_get_theme_option( 'page_sidebar_layout', 'standard' );
}

$page_container_classes = 'content-area content-area-with-sidebar';
$sidebar_container_classes = 'widget-area page-widget-area';

switch ( $sidebar_layout ) {
    case 'boxed':
        $sidebar_container_classes .= ' widget-area-boxed col-md-4';
        $page_container_classes .= ' col-md-8';
        break;
    
    default:
        $sidebar_container_classes .= ' col-md-4 col-lg-3';
        $page_container_classes .= ' col-md-8 col-lg-9';
        break;
}
?>
<div id="content" class="site-content">
    <div class="container">
        <div class="row">
            <?php
            wpmetrics_get_sidebar( $sidebar, array(
                'container_class' => $sidebar_container_classes
            ) );
            ?>
            <div id="primary" class="<?php echo esc_attr( $page_container_classes ); ?>">
                <main id="main" class="site-main" role="main">
                <?php
                while ( have_posts() ) : the_post();

                    get_template_part( 'template-parts/content', 'page' );

                    // If comments are open or we have at least one comment, load up the comment template.
                    if ( comments_open() || get_comments_number() ) :
                        comments_template();
                    endif;

                endwhile; // End of the loop.
                ?>
                </main><!-- #main -->
            </div><!-- #primary -->
        </div>
    </div>
</div>
<?php
get_footer();