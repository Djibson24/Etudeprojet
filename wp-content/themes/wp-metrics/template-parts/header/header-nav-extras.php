<?php defined( 'ABSPATH' ) or exit();
/**
 * Extra buttons on the main navigation bar
 *
 * @package WPMetrics
 */
$nav_search = $nav_side = $nav_cart = false;

if ( is_singular() ) {
    $nav_search = wpmetrics_get_post_meta( get_the_ID(), '_cms_show_search' );
    $nav_side = wpmetrics_get_post_meta( get_the_ID(), '_cms_show_side_panel' );
    $nav_cart = wpmetrics_get_post_meta( get_the_ID(), '_cms_show_cart' );
}

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

if ( ! $nav_cart ) {
    $nav_cart = wpmetrics_get_theme_option( 'show_cart' );
} else {
    $nav_cart = ( 'on' === $nav_cart ) ? true : false;
}

$menu_extras_items_count = $nav_search ? 1 : 0;
$menu_extras_items_count = ( $nav_side && ( has_nav_menu( 'side' ) || is_active_sidebar( 'side-nav' ) ) ) ? $menu_extras_items_count + 1 : $menu_extras_items_count;
$menu_extras_items_count = ( $nav_cart && is_active_sidebar( 'shopping-cart' ) ) ? $menu_extras_items_count + 1 : $menu_extras_items_count;

if ( 0 < $menu_extras_items_count ) {
    echo '<div class="menu-extras-container">';
    echo    '<ul class="cms-menu-extras menu-extras-' . ( 1 < $menu_extras_items_count ? esc_attr( $menu_extras_items_count ) . '-items' : esc_attr( $menu_extras_items_count ) . '-item' ) . '">';
    if ( $nav_search ) {
        echo    '<li><a class="search-toggle" href="#" title="' . esc_attr__( 'Toggle Search', 'wp-metrics' ) . '"><i class="fa fa-search"></i></a></li>';
    }
    if ( $nav_side && ( has_nav_menu( 'side' ) || is_active_sidebar( 'side-nav' ) ) ) {
        echo    '<li><a class="side-nav-toggle" href="#" title="' . esc_attr__( 'Toggle Side Navigation', 'wp-metrics' ) .'"><i class="fa fa-bars"></i></a></li>';
    }
    if ( $nav_cart && is_active_sidebar( 'shopping-cart' ) ) {
        echo    '<li><a class="cart-toggle" href="#" title="' . esc_attr__( 'Toggle Shopping Cart', 'wp-metrics' ) . '"><i class="fa fa-shopping-cart"></i></a>';
        echo        '<div class="sub-menu-cart">';
                        dynamic_sidebar( 'shopping-cart' );
        echo        '</div>'; 
        echo    '</li>';
    }
    echo    '</ul>';
    echo '</div>';
}