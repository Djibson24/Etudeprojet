<?php defined( 'ABSPATH' ) or exit();

$hlayout = $top = $top_alone = $header_extras = $hsticky = $hsticky_height = $mega_menu = false;
$main_menu = '';

$hclasses = "site-header";
$topclasses = "site-header-top";
$top_color = 'light';

if ( is_singular() ) {
    $main_menu = wpmetrics_get_post_meta( get_the_ID(), '_cms_primary_menu' );
    $mega_menu = wpmetrics_get_theme_option( 'mega_menu' );

    $hsticky = wpmetrics_get_post_meta( get_the_ID(), '_cms_sticky_header' );

    $main_menu = $main_menu ? $main_menu : '';

    if ( wpmetrics_get_post_meta( get_the_ID(), '_cms_custom_header' ) ) {
        $hlayout = wpmetrics_get_post_meta( get_the_ID(), '_cms_header_layout' );
    }
}

if ( ! $hlayout ) {
    $hlayout = wpmetrics_get_theme_option( 'header_layout', '10' );
}

if ( ! $hsticky ) {
    $hsticky = wpmetrics_get_theme_option( 'sticky_header' );
} else {
    $hsticky = ( 'on' === $hsticky ) ? true : false;
}

switch ( $hlayout ) {
    case '2':
        $header_extras = true;
        $hclasses .= ' header-with-bg';
        break;

    case '3':
        $hclasses .= ' header-with-bg';
        break;

    case '4':
        $top = true;
        $hclasses .= ' header-with-bg';
        break;

    case '5':
        $top = true;
        $hclasses .= ' header-with-bg';
        $top_color = 'dark';
        break;

    case '6':
        $hclasses .= ' header-with-bg';
        break;

    case '7':
        $top = true;
        $hclasses .= ' header-with-bg';
        break;
    
    case '8':
        $hclasses .= ' header-with-bg';
        break;

    case '9':
        $header_extras = true;
        $hclasses .= ' header-with-bg';
        break;

    case '10':
        break;

    case '11':
        $hclasses .= ' header-with-border';
        break;

    case '12':
        $header_extras = true;
        $hclasses .= ' header-layout-boxed';
        break;

    case '13':
        $header_extras = true;
        $hclasses .= ' header-layout-boxed header-layout-float';
        break;

    case '14':
        $hclasses .= ' header-layout-boxed header-layout-float';
        break;

    case '15':
        $top = true;
        $top_alone = true;
        $top_color = 'dark';
        $hclasses .= ' header-layout-boxed';
        break;

    case '16':
        $top = true;
        $top_alone = true;
        $top_color = 'dark';
        $hclasses .= ' header-layout-boxed';
        break;

    case '17':
        $top = true;
        $top_alone = true;
        $top_color = 'dark';
        break;

    // Default to 1
    default:
        $header_extras = true;
        break;
}

$hclasses .= ' header-layout-' . $hlayout;
$hclasses .= $top ? ' header-with-top' : '';
$hclasses .= $header_extras ? ' header-with-nav-extras' : '';
$hclasses .= $hsticky ? ' header-sticky' : '';
$topclasses .= ' header-top-' . $top_color;

$logo = wpmetrics_get_theme_option( 'logo' );
$logo_url = '';
if ( is_array( $logo ) && isset( $logo['url'] ) ) {
    $logo_url = $logo['url'];
}

if ( wpmetrics_get_theme_option( 'preloader' ) ) {
    echo '<div id="cms_page_loader" class="loading"><div class="cms-page-loader-spinner"></div></div>';
}
$hsticky_height = wpmetrics_get_theme_option( 'sticky_header_height', false );
$hsticky_height = empty( $hsticky_height['height'] ) ? false : $hsticky_height['height'];
$hsticky_height = wpmetrics_validate_css_unit( $hsticky_height );
$hsticky_height = $hsticky_height ? (float)$hsticky_height : '80';

?><div id="masthead_placeholder" class="header-placeholder header-placeholder-layout-<?php echo esc_attr( $hlayout ); ?>"></div>
<header id="masthead" class="<?php echo esc_attr( $hclasses ); ?>"<?php echo ( false !== $hsticky_height ? ' data-sticky-height="' . esc_attr( $hsticky_height ) . '"' : '' ); ?>>
    <?php if ( $top && $top_alone && ( is_active_sidebar( 'header-top-left' ) || is_active_sidebar( 'header-top-right' ) ) ) : ?>
        <div id="header_top" class="<?php echo esc_attr( $topclasses ); ?>">
            <div class="container">
                <div class="row">
                    <div class="header-top-left">
                        <?php dynamic_sidebar( 'header-top-left' ); ?>
                    </div>
                    <div class="header-top-right">
                        <?php dynamic_sidebar( 'header-top-right' ); ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <div class="site-header-inner">
        <?php if ( $top && ! $top_alone && ( is_active_sidebar( 'header-top-left' ) || is_active_sidebar( 'header-top-right' ) ) ) : ?>
        <div id="header_top" class="<?php echo esc_attr( $topclasses ); ?>">
            <div class="container">
                <div class="row">
                    <div class="header-top-left">
                        <?php dynamic_sidebar( 'header-top-left' ); ?>
                    </div>
                    <div class="header-top-right">
                        <?php dynamic_sidebar( 'header-top-right' ); ?>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <div id="header_main" class="site-header-main">
            <div class="container">
                <div class="row">
                    <div class="site-branding">
                        <h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php
                                if ( ! empty( $logo_url ) ) {
                                    echo '<img src="' . esc_url( $logo_url ) . '" alt="logo" title="' . esc_attr( get_bloginfo( 'name' ) ) . '"/>';
                                }
                                else {
                                    echo '<span>' . esc_html( get_bloginfo( 'name' ) ) . '</span>';
                                }
                            ?></a></h1>
                    </div>
                    <div class="site-mobile-menu-tools">
                        <div class="mobile-menu-tools-inner">
                            <button type="button" class="btn-default btn-small mobile-menu-toggle" aria-controls="site_nav_main"><i class="fa fa-th-list"></i></button>
                        </div>
                    </div>
                    <div class="site-navs">
                        <div class="site-navs-inner">
                            <?php
                            if ( '9' != $hlayout ) {
                                if ( $header_extras && is_active_sidebar( 'header-extras' ) ) {
                                    echo '<div class="site-nav-extras">';
                                    dynamic_sidebar( 'header-extras' );
                                    echo '</div>';
                                }
                            } ?>
                            <nav id="site_nav_main" class="site-nav-main">
                                <?php get_template_part( 'template-parts/header/header-nav', 'extras' ); ?>
                                <?php
                                    $nav_menu_args = array(
                                        'theme_location'    => '',
                                        'menu'              => $main_menu,
                                        'menu_id'           => 'primary_menu',
                                        'menu_class'        => 'cms-menu-main',
                                        'container_class'   => 'menu-main-container',
                                        'link_before'       => '<span class="menu-title">',
                                        'link_after'        => '</span>'
                                    );
                                    if ( has_nav_menu( 'primary' ) ) {
                                        $nav_menu_args['theme_location'] = 'primary';
                                    }
                                    if ( class_exists( 'Metrics_Walker_Nav_Menu' ) ) {
                                        $nav_menu_args['walker'] = new Metrics_Walker_Nav_Menu();
                                    }
                                    wp_nav_menu( $nav_menu_args );
                                ?>
                            </nav><!-- #site-navigation -->
                            <?php
                            if ( '9' == $hlayout ) {
                                if ( $header_extras && is_active_sidebar( 'header-extras' ) ) {
                                    echo '<div class="site-nav-extras">';
                                    dynamic_sidebar( 'header-extras' );
                                    echo '</div>';
                                }
                            } ?>
                        </div>
                    </div><!-- .site-navs -->
                </div>
            </div>
        </div><!-- .site-header-main -->
    </div><!-- .site-header-inner -->
</header>
<?php
    if ( ! is_404() )
    {
        get_template_part( 'template-parts/helper', 'pagetitle' );
    }
    get_template_part( 'template-parts/helper', 'extras' );
?>