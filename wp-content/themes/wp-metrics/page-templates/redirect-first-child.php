<?php defined( 'ABSPATH' ) or exit();
/**
 * Template Name: Go to first child
 */

$pagekids = get_pages( array(
    'child_of' => get_the_ID(),
    'sort_column' => 'menu_order'
) );
if ( $pagekids ) {
    $firstchild = $pagekids[0];
    wp_redirect( get_permalink( $firstchild->ID ) );
} else {
    // If no child found then we render a normal page.
    get_template_part( 'page' );
}
