<?php
/**
 * Content wrappers
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/wrapper-start.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     20.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$woo_sidebar_pos = wpmetrics_get_theme_option( 'woo_sidebar', 'right' );
$woo_sidebar_layout = wpmetrics_get_theme_option( 'woo_sidebar_layout', 'standard' );

$woo_container_classes = 'content-area';
$woo_sidebar_container_classes = 'widget-area shop-widget-area';

if ( 'no' != $woo_sidebar_pos ) {
    $woo_container_classes .= ' content-area-with-sidebar';
    switch ( $woo_sidebar_layout ) {
        case 'boxed':
            $woo_sidebar_container_classes .= ' widget-area-boxed col-md-4';
            $woo_container_classes .= ' col-md-8';
            break;
        
        default:
            $woo_sidebar_container_classes .= ' col-md-4 col-lg-3';
            $woo_container_classes .= ' col-md-8 col-lg-9';
            break;
    }
}
else {
    $woo_container_classes .= ' content-area-no-sidebar';
}
?>
<div id="content" class="site-content site-content-shop">
    <div class="container">
        <?php
        if ( 'left' == $woo_sidebar_pos || 'right' == $woo_sidebar_pos ) {
            echo '<div class="row">';
            if ( 'left' == $woo_sidebar_pos ) {
                wpmetrics_get_sidebar( 'shop', array( 'container_class' => $woo_sidebar_container_classes ) );
            }
        }
        ?>
        <div id="primary" class="<?php echo esc_attr( $woo_container_classes ); ?>">
            <main id="main" class="site-main">
