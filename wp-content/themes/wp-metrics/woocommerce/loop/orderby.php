<?php
/**
 * Show options for ordering
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/orderby.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see         http://docs.woothemes.com/document/template-structure/
 * @author         WooThemes
 * @package     WooCommerce/Templates
 * @version     20.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

$options = isset( $view_per_page_options['options'] ) && is_array( $view_per_page_options['options'] ) ? $view_per_page_options['options'] : array();
$total = isset( $view_per_page_options['total'] ) ? $view_per_page_options['total'] : 1;
$paged = isset( $view_per_page_options['paged'] ) ? $view_per_page_options['paged'] : 1;
$current_value = isset( $view_per_page_options['current'] ) ? $view_per_page_options['current'] : 12;
$current_view = isset( $_GET['view'] ) ? esc_html( $_GET['view'] ) : 'grid';

?>
<form class="woocommerce-ordering" method="get">
    <div class="shop-main-filter-left">
        <?php if ( is_product_category() ) : ?>
        <div class="shop-main-filter-block"><span class="filter-label"><?php esc_html_e( 'Sort By:', 'wp-metrics' ); ?></span><?php
            wpmetrics_woocommerce_ordering_filter( $catalog_orderby_options, $orderby );
        ?></div>
        <div class="shop-main-filter-block"><span class="filter-label"><?php esc_html_e( 'Show:', 'wp-metrics' ); ?></span><?php
            wpmetrics_woocommerce_per_page_filter( $options, $current_value, $total, $paged );
        ?></div><?php
        else :
            wc_get_template( 'loop/result-count.php' );
        endif;
        ?>
    </div>
    <div class="shop-main-filter-right"><?php
    if ( is_product_category() ) : ?>
        <div class="shop-main-filter-view"><?php
            echo '<label class="filter-view">';
            echo '<input type="radio" name="view" value="grid" onchange="this.form.submit()" ' . checked( 'grid', $current_view, false ) . '/>';
            echo '<i class="fa fa-th-large"></i>';
            echo '</label>';
            echo '<label class="filter-view">';
            echo '<input type="radio" name="view" value="list" onchange="this.form.submit()" ' . checked( 'list', $current_view, false ) . '/>';
            echo '<i class="fa fa-th-list"></i>';
            echo '</label>';

        ?></div><?php
    else :
        wpmetrics_woocommerce_ordering_filter( $catalog_orderby_options, $orderby );
    endif;
    ?></div>
</form>
