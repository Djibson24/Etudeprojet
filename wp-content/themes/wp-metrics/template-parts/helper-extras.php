<?php defined( 'ABSPATH' ) or exit();

$nav_search = wpmetrics_get_post_meta( get_the_ID(), '_cms_show_search' );
$nav_side = wpmetrics_get_post_meta( get_the_ID(), '_cms_show_side_panel' );

if ( ! $nav_search ) {
    $nav_search = wpmetrics_get_theme_option( 'show_search' );
} else {
    $nav_search = ( 'on' === $nav_search ) ? true : false;
}

if ( ! $nav_side ) {
    $nav_side = wpmetrics_get_theme_option( 'show_side_panel' );
} else {
    $nav_side = ( 'on' === $nav_side ) ? true : false;
}
?>

<?php if ( $nav_search ) : ?>
<div id="site_search_popup" class="site-search-popup cms-page-overlay">
    <div class="cms-page-overlay-inner">
        <div class="cms-search-popup">
            <div class="container">
                <div class="site-search-popup-inner text-center">
                    <?php get_search_form(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<?php if ( $nav_side && ( has_nav_menu( 'side' ) || is_active_sidebar( 'side-nav' ) ) ) : ?>
<div id="site_side_panel_popup" class="site-side-panel-popup cms-page-overlay">
    <div class="side-panel">
        <a href="#" class="side-panel-toggle"></a>
        <div class="side-panel-inner">
            <?php
            $side_logo = wpmetrics_get_theme_option( 'side_panel_logo', array() );
            if ( ! empty( $side_logo ) && isset( $side_logo['url'] ) && '' != $side_logo['url'] ) {
                echo '<div class="side-panel-logo side-panel-block">';
                echo    '<div class="side-panel-block-content"><a href="' . esc_url( home_url( '/' ) ) . '">';
                echo        '<img src="' . esc_url( $side_logo['url'] ) . '" alt=""/>';
                echo    '</a></div>';
                echo '</div>';
            }
            if ( has_nav_menu( 'side' ) ) {
                echo '<div class="side-panel-menu side-panel-block">';
                $nav_menu_args = array(
                    'theme_location'    => 'side',
                    'menu_id'           => 'side_menu',
                    'menu_class'        => 'cms-menu-side',
                    'container_class'   => 'side-menu-container side-panel-block-content',
                    'link_before'       => '<span class="menu-title">',
                    'link_after'        => '</span>'
                );
                wp_nav_menu( $nav_menu_args );
                echo '</div>';
            }
            if ( is_active_sidebar( 'side-nav' ) ) {
                echo '<div class="side-panel-widget-area side-panel-block">';
                echo    '<div class="side-panel-widgets side-panel-block-content">';
                            dynamic_sidebar( 'side-nav' );
                echo    '</div>';
                echo '</div>';
            } ?>
        </div>
    </div>
</div>
<?php endif; ?>