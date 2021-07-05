<?php
/**
 * The header for landing page.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 * 
 * @package WPMetrics
 */
?><!DOCTYPE html>
<!--[if lte IE 9]><html <?php language_attributes(); ?> class="lte-ie-9"><![endif]-->
<!--[if gt IE 9]><html <?php language_attributes(); ?>><![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
<?php
if ( wpmetrics_get_theme_option( 'preloader' ) ) {
    echo '<div id="cms_page_loader" class="loading"><div class="cms-page-loader-spinner"></div></div>';
}
