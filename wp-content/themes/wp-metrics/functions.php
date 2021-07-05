<?php defined( 'ABSPATH' ) or exit();
/**
 * Metrics theme functions and definitions.
 * @package WPMetrics
 */


/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function wpmetrics_theme_setup() {
    // Make theme available for translation.
    load_theme_textdomain( 'wp-metrics', get_template_directory() . '/languages' );

    // Add default posts and comments RSS feed links to head.
    add_theme_support( 'automatic-feed-links' );

    // Let WordPress manage the document title.
    add_theme_support( 'title-tag' );

    // Enable support for Post Thumbnails on posts and pages.
    add_theme_support( 'post-thumbnails' );

    // Adds custom header
    add_theme_support( 'custom-header' );

    // WooCommerce support
    add_theme_support( 'woocommerce' );

    // This theme uses wp_nav_menu() in two locations.
    register_nav_menus( array(
        'primary' => esc_html__( 'Primary menu', 'wp-metrics' ),
        'side'    => esc_html__( 'Side menu', 'wp-metrics' ),
        'social'  => esc_html__( 'Social menu', 'wp-metrics' )
    ) );

    // Switch default core markup for various modules to output valid HTML5.
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ) );

    // Enable support for Post Formats.
    add_theme_support( 'post-formats', array(
        'image',
        'gallery',
        'audio',
        'video',
        'quote',
        'link',
    ) );

    add_editor_style( array( 'css/editor-style.css' ) );

    // Set up the WordPress core custom background feature.
    add_theme_support( 'custom-background', apply_filters( 'wpmetrics_theme_custom_background_args', array(
        'default-color' => 'ffffff'
    ) ) );
    //add_image_size( 'small', 520, 350, true );
    add_image_size( 'wpmetrics-gallery-thumbnail', 600, 600, true );
}
add_action( 'after_setup_theme', 'wpmetrics_theme_setup' );


/**
 * Additional image size chooses
 * @param  array $sizes
 * @return array
 */
function wpmetrics_additional_image_sizes( $sizes ) {
    return array_merge( $sizes, array(
        'wpmetrics-gallery-thumbnail' => esc_html__( 'WPMetrics Gallery Thumbnail', 'wp-metrics' )
    ) );
}
add_filter( 'image_size_names_choose', 'wpmetrics_additional_image_sizes' );


/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 */
function wpmetrics_theme_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'wpmetrics_theme_content_width', 640 );
}
add_action( 'after_setup_theme', 'wpmetrics_theme_content_width', 0 );


/**
 * Register widget area.
 */
function wpmetrics_theme_widgets_init() {
    register_sidebar( array(
        'name'          => esc_html__( 'Sidebar', 'wp-metrics' ),
        'id'            => 'sidebar-1',
        'description' => esc_html__( 'Appears on posts and pages except the optional Page templates, which has its own widgets', 'wp-metrics' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '<span class="cms-divider divider-horizontal"><span class="divider-line-1">-</span><span class="divider-line-2">-</span><span class="divider-line-3">-</span></span></h4>',
    ) );
    if ( class_exists( 'WooCommerce') ) {
        register_sidebar( array(
            'name' => esc_html__( 'Shopping Cart', 'wp-metrics' ),
            'id' => 'shopping-cart',
            'description' => esc_html__( 'Appears on header main menu, set in theme options or page settings', 'wp-metrics' ),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget' => '</aside>',
            'before_title'  => '<h4 class="widget-title">',
            'after_title'   => '</h4>',
        ) );
        register_sidebar( array(
            'name' => esc_html__( 'Shop', 'wp-metrics' ),
            'id' => 'shop',
            'description' => esc_html__( 'Appears on shop pages, set in theme options or page settings', 'wp-metrics' ),
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget' => '</aside>',
            'before_title'  => '<h4 class="widget-title">',
            'after_title'   => '<span class="cms-divider divider-horizontal"><span class="divider-line-1">-</span><span class="divider-line-2">-</span><span class="divider-line-3">-</span></span></h4>',
        ) );
    }
    register_sidebar( array(
        'name' => esc_html__( 'Header Extra', 'wp-metrics' ),
        'id' => 'header-extras',
        'description' => esc_html__( 'Appears above header main menu, set in theme options or page settings', 'wp-metrics' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );
    register_sidebar( array(
        'name' => esc_html__( 'Header Top Left', 'wp-metrics' ),
        'id' => 'header-top-left',
        'description' => esc_html__( 'Appears at top left area of header, enable this in theme options or page settings', 'wp-metrics' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );
    register_sidebar( array(
        'name' => esc_html__( 'Header Top Right', 'wp-metrics' ),
        'id' => 'header-top-right',
        'description' => esc_html__( 'Appears at top right area of header, enable this in theme options or page settings', 'wp-metrics' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );
    register_sidebar( array(
        'name' => esc_html__( 'Side Panel', 'wp-metrics' ),
        'id' => 'side-nav',
        'description' => esc_html__( 'Appears at side area bellow side navigation, set in theme options or page settings', 'wp-metrics' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '<span class="cms-divider divider-horizontal divider-light"><span class="divider-line-1">-</span><span class="divider-line-2">-</span><span class="divider-line-3">-</span></span></h3>',
    ) );
    
    register_sidebar( array(
        'name' => esc_html__( 'Footer Top', 'wp-metrics' ),
        'id' => 'footer-top',
        'description' => esc_html__( 'Appears when using any footer layout that supports Footer Top, set in theme options or page settings', 'wp-metrics' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );
    
    register_sidebar( array(
        'name' => esc_html__( 'Footer Top Smaller', 'wp-metrics' ),
        'id' => 'footer-top-smaller',
        'description' => esc_html__( 'Appears when using any footer layout that supports Footer Top Smaller, set in theme options or page settings', 'wp-metrics' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );
    register_sidebar( array(
        'name' => esc_html__( 'Footer Top - Column 1', 'wp-metrics' ),
        'id' => 'footer-top-1',
        'description' => esc_html__( 'Appears when using any footer layout that supports Footer Top - Column 1, set in theme options or page settings', 'wp-metrics' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );
    register_sidebar( array(
        'name' => esc_html__( 'Footer Top - Column 2', 'wp-metrics' ),
        'id' => 'footer-top-2',
        'description' => esc_html__( 'Appears when using any footer layout that supports Footer Top - Column 2, set in theme options or page settings', 'wp-metrics' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );
    register_sidebar( array(
        'name' => esc_html__( 'Footer Main - Column 1', 'wp-metrics' ),
        'id' => 'footer-main-1',
        'description' => esc_html__( 'Appears when using any footer layout that supports Footer Main - Column 1, set in theme options or page settings', 'wp-metrics' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );
    register_sidebar( array(
        'name' => esc_html__( 'Footer Main - Column 2', 'wp-metrics' ),
        'id' => 'footer-main-2',
        'description' => esc_html__( 'Appears when using any footer layout that supports Footer Main - Column 2, set in theme options or page settings', 'wp-metrics' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );
    register_sidebar( array(
        'name' => esc_html__( 'Footer Main - Column 1+2', 'wp-metrics' ),
        'id' => 'footer-main-1-2',
        'description' => esc_html__( 'Appears when using any footer layout that supports Footer Main - Column 1+2, set in theme options or page settings', 'wp-metrics' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );
    register_sidebar( array(
        'name' => esc_html__( 'Footer Main - Column 3', 'wp-metrics' ),
        'id' => 'footer-main-3',
        'description' => esc_html__( 'Appears when using any footer layout that supports Footer Main - Column 3, set in theme options or page settings', 'wp-metrics' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );
    register_sidebar( array(
        'name' => esc_html__( 'Footer Main - Column 4', 'wp-metrics' ),
        'id' => 'footer-main-4',
        'description' => esc_html__( 'Appears when using any footer layout that supports Footer Main - Column 4, set in theme options or page settings', 'wp-metrics' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );
    register_sidebar( array(
        'name' => esc_html__( 'Footer Main - Column 5', 'wp-metrics' ),
        'id' => 'footer-main-5',
        'description' => esc_html__( 'Appears when using any footer layout that supports Footer Main - Column 5, set in theme options or page settings', 'wp-metrics' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );
    register_sidebar( array(
        'name' => esc_html__( 'Footer Main - Column 6', 'wp-metrics' ),
        'id' => 'footer-main-6',
        'description' => esc_html__( 'Appears when using any footer layout that supports Footer Main - Column 6, set in theme options or page settings', 'wp-metrics' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );
    register_sidebar( array(
        'name' => esc_html__( 'Footer Bottom Left', 'wp-metrics' ),
        'id' => 'footer-bottom-left',
        'description' => esc_html__( 'Appears when using any footer layout that supports Footer Bottom Left, set in theme options or page settings', 'wp-metrics' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );
    register_sidebar( array(
        'name' => esc_html__( 'Footer Bottom Right', 'wp-metrics' ),
        'id' => 'footer-bottom-right',
        'description' => esc_html__( 'Appears when using any footer layout that supports Footer Bottom Right, set in theme options or page settings', 'wp-metrics' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );
    register_sidebar( array(
        'name' => esc_html__( 'Footer Bottom 1 Column', 'wp-metrics' ),
        'id' => 'footer-bottom',
        'description' => esc_html__( 'Appears when using any footer layout that supports Footer Bottom 1 Column, set in theme options or page settings', 'wp-metrics' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );
}
add_action( 'widgets_init', 'wpmetrics_theme_widgets_init' );


/**
 * Enqueue scripts and styles.
 */
function wpmetrics_theme_frontend_scripts() {
    $elegant_icon = apply_filters( 'wpmetrics_elegant_icons_enqueue', true );
    // These styles need to be directy enqueue
    wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), '3.3.4' );
    wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css', array(), '4.5.0', 'screen' );

    if ( $elegant_icon ) {
        wp_enqueue_style( 'elegant-icons', get_template_directory_uri() . '/assets/css/ElegantIcons.min.css', array(), '', 'screen' );
    }
    wp_enqueue_style( 'wpmetrics-theme', get_template_directory_uri() . '/assets/css/theme.css', array(), '1.0.0' );
    // Register additional style for later use
    wp_register_style( 'magnific-popup', get_template_directory_uri() . '/assets/css/magnific-popup.css' );
    wp_register_style( 'owl-carousel', get_template_directory_uri() . '/assets/css/owl.carousel.min.css' );

    wp_register_script( 'modernizr', get_template_directory_uri() . '/assets/js/modernizr.min.js', array(), '', true );
    wp_register_script( 'bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array( 'jquery' ), '', true );
    wp_register_script( 'jquery-waypoints', get_template_directory_uri() . '/assets/js/jquery.waypoints.min.js', array( 'jquery' ), '', true );
    wp_register_script( 'images-loaded', get_template_directory_uri() . '/assets/js/imagesloaded.pkgd.min.js', array( 'jquery' ), '', true );
    wp_register_script( 'magnific-popup', get_template_directory_uri() . '/assets/js/jquery.magnific-popup.min.js', array( 'jquery' ), '', true );
    wp_register_script( 'jquery-shuffle', get_template_directory_uri() . '/assets/js/jquery.shuffle.min.js', array( 'jquery', 'modernizr' ), '', true );
    wp_register_script( 'owl-carousel', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', array( 'jquery' ), '', true );
    wp_register_script( 'wpmetrics-plugins', get_template_directory_uri() . '/assets/js/theme.plugins.js', array( 'jquery' ), '', true );

    wp_enqueue_script( 'wpmetrics-theme', get_template_directory_uri() . '/assets/js/theme.js', array( 'modernizr', 'jquery', 'bootstrap', 'images-loaded', 'jquery-waypoints', 'wpmetrics-plugins' ), '', true );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'wpmetrics_theme_frontend_scripts', 10 );


/**
 * Add Theme options
 */
require get_template_directory() . '/inc/classes/class-theme-options.php';

/**
 * Helper functions set
 */
require get_template_directory() . '/inc/functions-helper.php';

/**
 * Template tags functions set
 */
require get_template_directory() . '/inc/functions-template-tags.php';

/**
 * Plugged in functions set
 */
require get_template_directory() . '/inc/functions-plugged-in.php';

/**
 * Social widget
 */
require get_template_directory() . '/inc/widgets/widget-social.php';

/**
 * Recent Posts widget
 */
require get_template_directory() . '/inc/widgets/widget-recent-posts.php';

/**
 * Image widget
 * @since  1.1
 */
require get_template_directory() . '/inc/widgets/widget-image.php';

/**
 * Icon library and additional Media settings
 */
if ( is_admin() )
{
    require get_template_directory() . '/inc/classes/class-admin-media.php';
    require get_template_directory() . '/inc/classes/class-icons.php';
}
/**
 * Meta options
 */
require( get_template_directory() . '/inc/classes/class-meta-options.php' );

/**
 * Setup required plugins
 */
require( get_template_directory() . '/inc/options-required-plugins.php' );

/**
 * User extra information
 */
require get_template_directory() . '/inc/classes/class-user-extras.php';


if ( wpmetrics_get_theme_option( 'mega_menu' ) && ! class_exists( 'WPMetrics_Mega_Menu' ) ) {
    /**
     * Mega menu system
     */
    require get_template_directory() . '/inc/classes/class-mega-menu.php';
}

/**
 * Extending widgets
 * @since 2.0
 */
require get_template_directory() . '/inc/classes/class-widget-extends.php';
// require get_template_directory() . '/inc/classes/class-widget-css-class.php';

/**
 * Social share system for later use
 */
require get_template_directory() . '/inc/classes/class-social-share.php';

/**
 * CSS Generator class
 */
require get_template_directory() . '/inc/classes/class-css-generator.php';

/**
 * WooCommerce extras
 */
if ( class_exists( 'WooCommerce' ) ) {
    get_template_part( 'woocommerce/functions-woocommerce' );
}



/**
 * demo data.
 *
 * config.
 */
add_filter( 'ef3-theme-options-opt-name', 'wpmetrics_set_demo_opt_name' );

function wpmetrics_set_demo_opt_name()
{
    return 'smof_data';
}

add_filter( 'ef3-replace-content', 'wpmetrics_replace_content', 10 , 2 );

function wpmetrics_replace_content( $replaces, $attachment )
{
    return array(
        '/tax_query:/' => 'remove_query:',
        '/categories:/' => 'remove_query:',
    );
}

add_filter( 'ef3-replace-theme-options', 'wpmetrics_replace_theme_options' );

function wpmetrics_replace_theme_options(){
    return array(
        'dev_mode' => 0,
    );
}
