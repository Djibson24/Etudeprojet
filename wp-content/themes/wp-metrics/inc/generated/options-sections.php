<?php defined( 'ABSPATH' ) or exit();
/**
 * Set options for the theme.
 *
 * @package CMSSuperHeroes
 * @subpackage WPMetrics
 * @see WPMetrics_Theme_Options::set_sections()
 */


/**
 * Basic settings
 */
$this->sections[] = array(
    'title' => esc_html__( 'Basic', 'wp-metrics' ),
    'icon' => 'el-icon-cog',
    'fields' => array(
        array(
            'id' => 'logo',
            'type' => 'media',
            'title' => esc_html__( 'Logo', 'wp-metrics' ),
            'subtitle' => esc_html__( 'Select an image file for your logo.', 'wp-metrics' ),
            'default' => array(
                'url' => get_template_directory_uri() . '/assets/images/logo.png'
            )
        ),
        array(
            'id' => 'favicon',
            'type' => 'media',
            'title' => esc_html__( 'Favicon', 'wp-metrics' ),
            'subtitle' => esc_html__( 'Specify a favicon for your site. Accepted formats: .ico, .png, .gif.', 'wp-metrics' ),
            'default' => array(
                'url' => get_template_directory_uri() . '/assets/images/favicon.png'
            )
        ),
        array(
            'id' => 'preloader',
            'type' => 'switch',
            'title' => esc_html__( 'Preloader', 'wp-metrics' ),
            'subtitle' => esc_html__( 'Use built-in pre-loading page animation.', 'wp-metrics' ),
            'default' => false
        )
    )
); // <-- Basic settings


/**
 * Header
 */
$this->sections[] = array(
    'title' => esc_html__( 'Header', 'wp-metrics' ),
    'icon' => 'el-icon-view-mode',
    'fields' => array(
        array(
            'id' => 'header_layout',
            'type' => 'image_select',
            'title' => esc_html__( 'Header layout', 'wp-metrics' ),
            'subtitle' => esc_html__( 'Select a layout for header.', 'wp-metrics' ),
            'options' => array(
                '1' => get_template_directory_uri() . '/inc/assets/images/headers/header_layout_01.png',
                '2' => get_template_directory_uri() . '/inc/assets/images/headers/header_layout_02.png',
                '3' => get_template_directory_uri() . '/inc/assets/images/headers/header_layout_03.png',
                '4' => get_template_directory_uri() . '/inc/assets/images/headers/header_layout_04.png',
                '5' => get_template_directory_uri() . '/inc/assets/images/headers/header_layout_05.png',
                '6' => get_template_directory_uri() . '/inc/assets/images/headers/header_layout_06.png',
                '7' => get_template_directory_uri() . '/inc/assets/images/headers/header_layout_07.png',
                '8' => get_template_directory_uri() . '/inc/assets/images/headers/header_layout_08.png',
                '9' => get_template_directory_uri() . '/inc/assets/images/headers/header_layout_09.png',
                '10' => get_template_directory_uri() . '/inc/assets/images/headers/header_layout_10.png',
                '11' => get_template_directory_uri() . '/inc/assets/images/headers/header_layout_11.png',
                '12' => get_template_directory_uri() . '/inc/assets/images/headers/header_layout_12.png',
                '13' => get_template_directory_uri() . '/inc/assets/images/headers/header_layout_13.png',
                '14' => get_template_directory_uri() . '/inc/assets/images/headers/header_layout_14.png',
                '15' => get_template_directory_uri() . '/inc/assets/images/headers/header_layout_15.png',
                '16' => get_template_directory_uri() . '/inc/assets/images/headers/header_layout_16.png',
                '17' => get_template_directory_uri() . '/inc/assets/images/headers/header_layout_17.png'
            ),
            'default' => '10',
        ),
        array(
            'id' => 'sticky_header',
            'type' => 'switch',
            'title' => esc_html__( 'Sticky header', 'wp-metrics' ),
            'subtitle' => esc_html__( 'Enable sticky mode for header.', 'wp-metrics' ),
            'default' => true,
        ),
        array(
            'id' => 'sticky_header_height',
            'type' => 'dimensions',
            'title' => esc_html__( 'Sticky header height', 'wp-metrics' ),
            'subtitle' => esc_html__( 'Set height for sticky header, min-height recommended is 80px.', 'wp-metrics' ),
            'width' => false,
            'units' => 'px',
            'default' => array(
                'height' => '80'
            )
        ),
        array(
            'id' => 'font_header_main_menu',
            'type' => 'typography',
            'title' => esc_html__( 'Header main menus', 'wp-metrics' ),
            'subtitle' => esc_html__( 'Font size for primary menu.', 'wp-metrics' ),
            'google' => false,
            'line-height' => false,
            'font-style' => false,
            'font-weight' => false,
            'font-family' => false,
            'text-align' => false,
            'color' => false,
            'units' => 'px',
            'default' => array(
                'font-size' => '13px',
            ),
        ),
        array(
            'id' => 'font_header_extras',
            'type' => 'typography',
            'title' => esc_html__( 'Header main widgets', 'wp-metrics' ),
            'subtitle' => esc_html__( 'Font size for main header widgets.', 'wp-metrics' ),
            'google' => false,
            'line-height' => false,
            'font-style' => false,
            'font-weight' => false,
            'font-family' => false,
            'text-align' => false,
            'color' => false,
            'units' => 'px',
            'default' => array(
                'font-size' => '12px',
            ),
        ),
        array(
            'id' => 'font_header_top',
            'type' => 'typography',
            'title' => esc_html__( 'Header top widgets', 'wp-metrics' ),
            'subtitle' => esc_html__( 'Font size for header top widgets.', 'wp-metrics' ),
            'google' => false,
            'line-height' => false,
            'font-style' => false,
            'font-weight' => false,
            'font-family' => false,
            'text-align' => false,
            'color' => false,
            'units' => 'px',
            'default' => array(
                'font-size' => '12px',
            ),
        )
    )
);


/**
 * navigation
 */
$this->sections[] = array(
    'title' => esc_html__( 'Navigation', 'wp-metrics' ),
    'icon' => 'el-icon-align-justify',
    'fields' => array(
        array(
            'id' => 'mega_menu',
            'type' => 'switch',
            'title' => esc_html__( 'Built-in Mega Menu', 'wp-metrics' ),
            'subtitle' => esc_html__( 'If you want to use mega menu plugin then disable this.', 'wp-metrics' ),
            'default' => false,
        ),
        array(
            'id' => 'show_search',
            'type' => 'switch',
            'title' => esc_html__( 'Show search', 'wp-metrics' ),
            'subtitle' => esc_html__( 'Show search button beside primary menu.', 'wp-metrics' ),
            'default' => true,
        ),
        array(
            'id' => 'show_side_panel',
            'type' => 'switch',
            'title' => esc_html__( 'Show side panel', 'wp-metrics' ),
            'subtitle' => esc_html__( 'Show side panel toggle button beside primary menu.', 'wp-metrics' ),
            'description' => esc_html__( 'Please note that you must put some widgets into "Extra Header Navigation" ( Appearance/Widgets ) or set a menu to show on Side menu ( Appearance/Menus
             ) in order to make it works', 'wp-metrics' ),
            'default' => true,
        ),
        array(
            'id' => 'side_panel_logo',
            'type' => 'media',
            'title' => esc_html__( 'Side Panel Logo', 'wp-metrics' ),
            'subtitle' => esc_html__( 'Add custom logo to the side panel.', 'wp-metrics' ),
            'default' => array(
                'url' => get_template_directory_uri() . '/assets/images/side-panel-logo.png'
            ),
            'required' => array( 'show_side_panel', '=', true )
        ),
        array(
            'id' => 'side_panel_background',
            'type' => 'background',
            'title' => esc_html__( 'Side Panel Background', 'wp-metrics' ),
            'subtitle' => esc_html__( 'Side Panel Background with image, color, etc.', 'wp-metrics' ),
            'output' => array( '.site-side-panel-popup .side-panel' ),
            'default' => array(
                'background-color' => '#222',
                'background-image' => get_template_directory_uri() . '/assets/images/default-sidepanel.png',
                'background-repeat' => 'no-repeat',
                'background-size' => 'inherit',
                'background-position' => 'right bottom',
                'background-attachment' => 'scroll'
            ),
            'required' => array( 'show_side_panel', '=', true )
        ),
        array(
            'id' => 'back_to_top_on',
            'type' => 'switch',
            'title' => esc_html__( 'Back to top button', 'wp-metrics' ),
            'subtitle' => esc_html__( 'Show the button when scrolling down.', 'wp-metrics' ),
            'default' => true,
        ),
        array(
            'id' => 'show_cart',
            'type' => 'switch',
            'title' => esc_html__( 'Show Cart', 'wp-metrics' ),
            'subtitle' => esc_html__( 'Show cart button beside primary menu.', 'wp-metrics' ),
            'description' => esc_html__( 'Please note that you must have WooCommerce installed/activated and put shopping cart widget into "Shopping Cart" ( Appearance/Widgets ) in order to make it works', 'wp-metrics' ),
            'default' => true,
        )
    )
);


/**
 * Page Title
 */
$this->sections[] = array(
    'title' => esc_html__( 'Page title', 'wp-metrics' ),
    'icon' => 'el-icon-credit-card',
    'fields' => array(
        array(
            'id' => 'page_title_background',
            'type' => 'background',
            'title' => esc_html__( 'Page Title Background', 'wp-metrics' ),
            'subtitle' => esc_html__( 'page title background with image, color, etc.', 'wp-metrics' ),
            'output' => array( '.cms-page-title' ),
            'default' => array(
                'background-color' => '#222',
                'background-image' => get_template_directory_uri() . '/assets/images/default-page-title.png',
                'background-repeat' => 'no-repeat',
                'background-size' => 'cover',
                'background-position' => 'top center',
                'background-attachment' => 'scroll'
            )
        ),
        array(
            'id' => 'page_title_layout',
            'type' => 'image_select',
            'title' => esc_html__( 'Page title layout', 'wp-metrics' ),
            'subtitle' => esc_html__( 'Select a layout for page title.', 'wp-metrics' ),
            'options' => array(
                '1' => get_template_directory_uri() . '/inc/assets/images/pagetitles/pagetitle_layout_01.png',
                '2' => get_template_directory_uri() . '/inc/assets/images/pagetitles/pagetitle_layout_02.png',
                '3' => get_template_directory_uri() . '/inc/assets/images/pagetitles/pagetitle_layout_03.png',
                '4' => get_template_directory_uri() . '/inc/assets/images/pagetitles/pagetitle_layout_04.png',
                '5' => get_template_directory_uri() . '/inc/assets/images/pagetitles/pagetitle_layout_05.png',
                '6' => get_template_directory_uri() . '/inc/assets/images/pagetitles/pagetitle_layout_06.png',
                '7' => get_template_directory_uri() . '/inc/assets/images/pagetitles/pagetitle_layout_07.png',
                '8' => get_template_directory_uri() . '/inc/assets/images/pagetitles/pagetitle_layout_08.png',
                '9' => get_template_directory_uri() . '/inc/assets/images/pagetitles/pagetitle_layout_09.png',
                '10' => get_template_directory_uri() . '/inc/assets/images/pagetitles/pagetitle_layout_10.png',
                '11' => get_template_directory_uri() . '/inc/assets/images/pagetitles/pagetitle_layout_11.png',
            ),
            'default' => '1',
        )
    )
);


/**
 * Footer
 */
$this->sections[] = array(
    'title' => esc_html__( 'Footer', 'wp-metrics' ),
    'icon' => 'el-icon-view-mode',
    'fields' => array(
        array(
            'id' => 'footer_layout',
            'type' => 'image_select',
            'title' => esc_html__( 'Footer Layout', 'wp-metrics' ),
            'options' => array(
                '1' => get_template_directory_uri() . '/inc/assets/images/footers/footer_layout_01.png',
                '2' => get_template_directory_uri() . '/inc/assets/images/footers/footer_layout_02.png',
                '3' => get_template_directory_uri() . '/inc/assets/images/footers/footer_layout_03.png',
                '4' => get_template_directory_uri() . '/inc/assets/images/footers/footer_layout_04.png',
                '5' => get_template_directory_uri() . '/inc/assets/images/footers/footer_layout_05.png',
                '6' => get_template_directory_uri() . '/inc/assets/images/footers/footer_layout_06.png',
                '7' => get_template_directory_uri() . '/inc/assets/images/footers/footer_layout_07.png',
                '8' => get_template_directory_uri() . '/inc/assets/images/footers/footer_layout_08.png',
                '9' => get_template_directory_uri() . '/inc/assets/images/footers/footer_layout_09.png',
                '10' => get_template_directory_uri() . '/inc/assets/images/footers/footer_layout_10.png',
                '11' => get_template_directory_uri() . '/inc/assets/images/footers/footer_layout_11.png',
            ),
            'default' => '1'
        ),
        array(
            'id' => 'font_footer_widget_title',
            'type' => 'typography',
            'title' => esc_html__( 'Footer Widget Titles', 'wp-metrics' ),
            'subtitle' => esc_html__( 'Font size for footer widget title.', 'wp-metrics' ),
            'google' => false,
            'line-height' => false,
            'font-style' => false,
            'font-weight' => false,
            'font-family' => false,
            'text-align' => false,
            'color' => false,
            'units' => 'px',
            'output' => array( '.site-footer .widget-title' ),
            'default' => array(
                'font-size' => '16px',
            ),
        ),
        array(
            'id' => 'font_footer_main',
            'type' => 'typography',
            'title' => esc_html__( 'Footer main widgets', 'wp-metrics' ),
            'subtitle' => esc_html__( 'Font size for footer main widgets.', 'wp-metrics' ),
            'google' => false,
            'line-height' => false,
            'font-style' => false,
            'font-weight' => false,
            'font-family' => false,
            'text-align' => false,
            'color' => false,
            'units' => 'px',
            'default' => array(
                'font-size' => '12px',
            ),
        ),
        array(
            'id' => 'font_footer_top',
            'type' => 'typography',
            'title' => esc_html__( 'Footer top widgets', 'wp-metrics' ),
            'subtitle' => esc_html__( 'Font size for footer top widgets.', 'wp-metrics' ),
            'google' => false,
            'line-height' => false,
            'font-style' => false,
            'font-weight' => false,
            'font-family' => false,
            'text-align' => false,
            'color' => false,
            'units' => 'px',
            'default' => array(
                'font-size' => '13px',
            ),
        ),
        array(
            'id' => 'font_footer_bottom',
            'type' => 'typography',
            'title' => esc_html__( 'Footer bottom widgets', 'wp-metrics' ),
            'subtitle' => esc_html__( 'Font size for footer bottom widgets.', 'wp-metrics' ),
            'google' => false,
            'line-height' => false,
            'font-style' => false,
            'font-weight' => false,
            'font-family' => false,
            'text-align' => false,
            'color' => false,
            'units' => 'px',
            'default' => array(
                'font-size' => '13px',
            ),
        )
    )
);

/**
 * Styling
 */
$this->sections[] = array(
    'title' => esc_html__( 'Styling', 'wp-metrics' ),
    'icon' => 'el-icon-magic',
    'fields' => array(
        array(
            'id' => 'color_primary',
            'type' => 'color',
            'title' => esc_html__( 'Primary color', 'wp-metrics' ),
            'description' => esc_html__( 'Set primary color for the theme.', 'wp-metrics' ),
            'transparent' => false,
            'default' => '#43B4AE'
        ),
        array(
            'id' => 'color_link',
            'type' => 'link_color',
            'title' => esc_html__( 'Link color', 'wp-metrics' ),
            'description' => esc_html__( 'Set link color for the theme.', 'wp-metrics' ),
            'output' => array( 'a' ),
            'visited' => false,
            'default' => array(
                'regular'  => '#43b4ae',
                'hover'    => '#43b4ae',
                'active'   => '#43b4ae'
            )
        ),
        array(
            'id' => 'primary_menu_color_link',
            'type' => 'link_color',
            'title' => esc_html__( 'Primary Menu link color', 'wp-metrics' ),
            'desc' => esc_html__( 'Customize link color for primary menu.', 'wp-metrics' ),
            'visited' => false,
            'default' => array(
                'regular'  => '#222222',
                'hover'    => '#222222',
                'active'   => '#222222'
            )
        ),
        array(
            'id' => 'primary_menu_submenu_color_link',
            'type' => 'link_color',
            'title' => esc_html__( 'Sub Menu link color', 'wp-metrics' ),
            'desc' => esc_html__( 'Customize link color for sub-menu of primary menu.', 'wp-metrics' ),
            'visited' => false,
            'default' => array(
                'regular'  => '#7f7f7f',
                'hover'    => '#ffffff',
                'active'   => '#ffffff'
            )
        ),
        array(
            'id' => 'widget_color_link',
            'type' => 'link_color',
            'title' => esc_html__( 'Widgets link color', 'wp-metrics' ),
            'desc' => esc_html__( 'Customize link color for widget area.', 'wp-metrics' ),
            'visited' => false,
            'default' => array(
                'regular'  => '#7f7f7f',
                'hover'    => '#43b4ae',
                'active'   => '#43b4ae'
            )
        )
    )
);

/**
 * Typography
 */
$this->sections[] = array(
    'title' => esc_html__( 'Typography', 'wp-metrics' ),
    'icon' => 'el-icon-text-width',
    'fields' => array(
        array(
            'id' => 'font_body',
            'type' => 'typography',
            'title' => esc_html__( 'Body font', 'wp-metrics' ),
            'subtitle' => esc_html__( 'Set font for the main body. The font is used in most parts of the theme.', 'wp-metrics' ),
            'font-backup' => true,
            'google' => true,
            'all_styles' => true,
            'text-align' => false,
            'font_family_clear' => false,
            'font-weight' => false,
            'font-style' => false,
            'units' => 'px',
            'default' => array(
                'font-backup' => "'Times New Roman', Times,serif",
                'google' => true,
                'font-size' => '14px',
                'line-height' => '23px',
                'font-family' => 'Droid Serif',
                'color' => '#9B9B9B'
            ),
        ),
        array(
            'id' => 'font_h1',
            'type' => 'typography',
            'title' => sprintf( esc_html__( 'Heading 1 (%s)', 'wp-metrics' ), '<code>&lt;h1&gt;</code>' ),
            'font-backup' => true,
            'google' => true,
            'text-align' => false,
            'font-weight' => false,
            'font-style' => false,
            'units' => 'px',
            'output' => array( 'h1' ),
            'default' => array(
                'font-family' => 'Raleway',
                'font-backup' => 'Arial, Helvetica, sans-serif',
                'font-size' => '32px',
                'line-height' => '40px',
                'color' => '#222222'
            )
        ),
        array(
            'id' => 'font_h2',
            'type' => 'typography',
            'title' => sprintf( esc_html__( 'Heading 2 (%s)', 'wp-metrics' ), '<code>&lt;h2&gt;</code>' ),
            'font-backup' => true,
            'google' => true,
            'all_styles' => true,
            'text-align' => false,
            'font-weight' => false,
            'font-style' => false,
            'units' => 'px',
            'output' => array( 'h2' ),
            'default' => array(
                'font-family' => 'Raleway',
                'font-backup' => 'Arial, Helvetica, sans-serif',
                'font-size' => '28px',
                'line-height' => '35px',
                'color' => '#222222'
            )
        ),
        array(
            'id' => 'font_h3',
            'type' => 'typography',
            'title' => sprintf( esc_html__( 'Heading 3 (%s)', 'wp-metrics' ), '<code>&lt;h3&gt;</code>' ),
            'font-backup' => true,
            'google' => true,
            'all_styles' => true,
            'text-align' => false,
            'font-weight' => false,
            'font-style' => false,
            'units' => 'px',
            'output' => array( 'h3' ),
            'default' => array(
                'font-family' => 'Raleway',
                'font-backup' => 'Arial, Helvetica, sans-serif',
                'font-size' => '25px',
                'line-height' => '31.25px',
                'color' => '#222222'
            )
        ),
        array(
            'id' => 'font_h4',
            'type' => 'typography',
            'title' => sprintf( esc_html__( 'Heading 4 (%s)', 'wp-metrics' ), '<code>&lt;h4&gt;</code>' ),
            'font-backup' => true,
            'google' => true,
            'all_styles' => true,
            'text-align' => false,
            'font-weight' => false,
            'font-style' => false,
            'units' => 'px',
            'output' => array( 'h4' ),
            'default' => array(
                'font-family' => 'Raleway',
                'font-backup' => 'Arial, Helvetica, sans-serif',
                'font-size' => '22px',
                'line-height' => '27.5px',
                'color' => '#222222'
            )
        ),
        array(
            'id' => 'font_h5',
            'type' => 'typography',
            'title' => sprintf( esc_html__( 'Heading 5 (%s)', 'wp-metrics' ), '<code>&lt;h5&gt;</code>' ),
            'font-backup' => true,
            'google' => true,
            'all_styles' => true,
            'text-align' => false,
            'font-weight' => false,
            'font-style' => false,
            'units' => 'px',
            'output' => array( 'h5' ),
            'default' => array(
                'font-family' => 'Raleway',
                'font-backup' => 'Arial, Helvetica, sans-serif',
                'font-size' => '18px',
                'line-height' => '22.5px',
                'color' => '#222222'
            )
        ),
        array(
            'id' => 'font_h6',
            'type' => 'typography',
            'title' => sprintf( esc_html__( 'Heading 6 (%s)', 'wp-metrics' ), '<code>&lt;h6&gt;</code>' ),
            'font-backup' => true,
            'google' => true,
            'all_styles' => true,
            'text-align' => false,
            'font-weight' => false,
            'font-style' => false,
            'units' => 'px',
            'output' => array( 'h6' ),
            'default' => array(
                'font-family' => 'Raleway',
                'font-backup' => 'Arial, Helvetica, sans-serif',
                'font-size' => '14px',
                'line-height' => '17.5px',
                'color' => '#222222'
            )
        )
    )
);


/**
 * Additional Font settings
 */
$this->sections[] = array(
    'title' => esc_html__( 'Alternate Fonts', 'wp-metrics' ),
    'icon' => 'el el-fontsize',
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'font_alt_1',
            'type' => 'typography',
            'title' => esc_html__( 'Alternate Font 1', 'wp-metrics' ),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'color' => false,
            'text-align' => false,
            'line-height' => false,
            'font-size' => false,
            'font-weight' => false,
            'font-style' => false,
            'subsets' => false,
            'default' => array(
                'font-family' => "Open Sans",
                'font-backup' => "Arial, Helvetica, sans-serif"
            ),
        ),
        array(
            'id' => 'font_alt_1_selectors',
            'type' => 'textarea',
            'title' => esc_html__( 'Applies additional font 1 to selectors', 'wp-metrics' ),
            'subtitle' => esc_html__( 'Add css selectors seperated by comma (",").', 'wp-metrics' ),
            'validate' => 'no_html',
            'default' => "blockquote cite,\nbutton,\n.btn,\n.button,\n.woocommerce .added_to_cart,\n.sub-menu-cart .button,\ninput,\nselect,\ntextarea,\n.comment-reply-link,\n.vc_tta-tab,\nul.cms-menu-main,\ndiv.cms-menu-main > ul,\n.cms-menu-side,\nul.cms-menu-extras,\n.cms-breadcrumb,\n.comment-meta,\n.widget,\n.entry-meta,\n.entry-footer,\n.entry-pricing-plans .entry-content,\n.fancybox-link,\n.cms-casestudy-slider .item-action > a,\n.cms-icon-box .icon-link,\n.entry-cms-case-study .case-study-link-block,\n.cms-progress-bar .progress-title-text,\n.cms-grid .grid-filter,\n.cms-gallery-item .gallery-tags,\n.metrics-contact-info-text,\n.woocommerce .woocommerce-error,\n.woocommerce .woocommerce-info,\n.woocommerce .woocommerce-message,\n.woocommerce div.product"
        ),
        array(
            'id' => 'font_alt_2',
            'type' => 'typography',
            'title' => esc_html__( 'Additional Font 2', 'wp-metrics' ),
            'desc' => esc_html__( 'This font family is used for various elements of the theme (eg: sub-heading, blockquote...). You can also apply additional selectors to use this font-family bellow.', 'wp-metrics' ),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'color' => false,
            'text-align' => false,
            'line-height' => false,
            'font-size' => false,
            'font-weight' => false,
            'font-style' => false,
            'subsets' => false,
            'default' => array(
                'font-family' => "Lora",
                'font-backup' => "'Times New Roman', Times,serif"
            ),
        ),
        array(
            'id' => 'font_alt_2_selectors',
            'type' => 'textarea',
            'title' => esc_html__( 'Applies additional font 2 to selectors', 'wp-metrics' ),
            'subtitle' => esc_html__( 'Add css selectors seperated by comma (",").', 'wp-metrics' ),
            'validate' => 'no_html',
            'default' => "blockquote,\n.page-title-text .subtitle,\n.cms-heading .subtitle,\n.cms-fancybox-texticon .fancybox-icon,\n.entry-pricing-plans .entry-description,\n.entry-team .team-member-roles,\n.entry-team .team-member-content,\n.cms-testimonial .testimonial-roles,\n.cms-testimonial .testimonial-content,\n.cms-fancybox-imgicon .fancybox-subtitle,\n.vc_cta3-content,\n.cms-casestudy-slider .item-header .subtitle,\n.cms-cta-box .cta-box-content,\n.work-process-step,\n.woocommerce .price,\n.sub-menu-cart .quantity,\n.woocommerce .widget-area ul.cart_list li .amount,\n.woocommerce .widget-area ul.product_list_widget li .amount,\n.woocommerce table.shop_table .amount"
        ),
        array(
            'id' => 'font_alt_3',
            'type' => 'typography',
            'title' => esc_html__( 'Alternate Font 3', 'wp-metrics' ),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'color' => false,
            'text-align' => false,
            'line-height' => false,
            'font-size' => false,
            'font-weight' => false,
            'font-style' => false,
            'subsets' => false,
            'default' => array(
                'font-family' => "Raleway",
                'font-backup' => "Arial, Helvetica, sans-serif"
            ),
        ),
        array(
            'id' => 'font_alt_3_selectors',
            'type' => 'textarea',
            'title' => esc_html__( 'Applies additional font 3 to selectors', 'wp-metrics' ),
            'subtitle' => esc_html__( 'Add css selectors seperated by comma (",").', 'wp-metrics' ),
            'validate' => 'no_html',
            'default' => ".cms-heading .desc-block,\n.cms-fancybox-left-icon-box-alt .fancybox-content,\n.woocommerce .woocommerce-result-count,\n.shop-main-filter .filter-label,\n.woocommerce table.shop_table,\n.woocommerce div.product .woocommerce-tabs ul.tabs li,\n.woocommerce ul.cart_list li a,\n.woocommerce ul.product_list_widget a"
        ),
    )
);


/**
 * Primary site font sizes
 */
$this->sections[] = array(
    'title' => esc_html__( 'Font Sizes', 'wp-metrics' ),
    'icon' => 'el el-fontsize',
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'font_size_info',
            'type' => 'info',
            'style' => 'info',
            'title' => esc_html__( 'Information', 'wp-metrics' ),
            'desc' => esc_html__( 'This section sets font sizes for main content area, for header/footer/widget, please refer to invidual settings on other sections.', 'wp-metrics' )
        ),
        array(
            'id' => 'font_xlarge',
            'type' => 'typography',
            'title' => esc_html__( 'Extra Large font size', 'wp-metrics' ),
            'subtitle' => esc_html__( 'Font size for various elements of the theme.', 'wp-metrics' ),
            'google' => false,
            'line-height' => false,
            'font-style' => false,
            'font-weight' => false,
            'font-family' => false,
            'text-align' => false,
            'color' => false,
            'units' => 'px',
            'default' => array(
                'font-size' => '17px',
            ),
        ),
        array(
            'id' => 'font_large',
            'type' => 'typography',
            'title' => esc_html__( 'Large font size', 'wp-metrics' ),
            'subtitle' => esc_html__( 'Font size for various elements of the theme.', 'wp-metrics' ),
            'google' => false,
            'line-height' => false,
            'font-style' => false,
            'font-weight' => false,
            'font-family' => false,
            'text-align' => false,
            'color' => false,
            'units' => 'px',
            'default' => array(
                'font-size' => '15px',
            ),
        ),
        array(
            'id' => 'font_small',
            'type' => 'typography',
            'title' => esc_html__( 'Small font size', 'wp-metrics' ),
            'subtitle' => esc_html__( 'Font size for various elements of the theme.', 'wp-metrics' ),
            'google' => false,
            'line-height' => false,
            'font-style' => false,
            'font-weight' => false,
            'font-family' => false,
            'text-align' => false,
            'color' => false,
            'units' => 'px',
            'default' => array(
                'font-size' => '13px',
            ),
        ),
        array(
            'id' => 'font_xsmall',
            'type' => 'typography',
            'title' => esc_html__( 'Extra Small font size', 'wp-metrics' ),
            'subtitle' => esc_html__( 'Font size for various elements of the theme.', 'wp-metrics' ),
            'google' => false,
            'line-height' => false,
            'font-style' => false,
            'font-weight' => false,
            'font-family' => false,
            'text-align' => false,
            'color' => false,
            'units' => 'px',
            'default' => array(
                'font-size' => '12px',
            ),
        )
    )
);

/**
 * Blog settings
 */
$this->sections[] = array(
    'title' => esc_html__( 'Blog', 'wp-metrics' ),
    'icon' => 'el-icon-file-edit',
    'fields' => array(
        array(
            'id' => 'posts_layout',
            'type' => 'button_set',
            'title' => esc_html__( 'Posts Layout', 'wp-metrics' ),
            'subtitle' => esc_html__( 'Set layout for posts listing in blog home, archive... pages', 'wp-metrics' ),
            'desc' => esc_html( 'The "Full With" will disables sidebar', 'wp-metrics' ),
            'options' => array(
                'standard' => esc_html__( 'Standard', 'wp-metrics' ),
                'grid' => esc_html__( 'Grid', 'wp-metrics' ),
                'minimal' => esc_html__( 'Minimal', 'wp-metrics' ),
                'full' => esc_html__( 'Full With', 'wp-metrics' )
            ),
            'default' => 'standard'
        ),
        array(
            'id' => 'posts_grid_columns',
            'type' => 'button_set',
            'title' => esc_html__( 'Posts Columns', 'wp-metrics' ),
            'subtitle' => esc_html__( 'Set columns layout for posts in blog home, archive... pages', 'wp-metrics' ),
            'options' => array(
                '2' => esc_html__( '2 Columns', 'wp-metrics' ),
                '3' => esc_html__( '3 Columns', 'wp-metrics' ),
            ),
            'default' => '2',
            'required' => array(
                array( 'posts_layout', '!=', 'standard' ),
                array( 'posts_layout', '!=', 'full' )
            )
        ),
        array(
            'id' => 'posts_sidebar',
            'type' => 'button_set',
            'title' => esc_html__( 'Posts Sidebar', 'wp-metrics' ),
            'subtitle' => esc_html__( 'Set sidebar position in blog home, archive... pages.', 'wp-metrics' ),
            'options' => array(
                'no' => esc_html__( 'None', 'wp-metrics' ),
                'left' => esc_html__( 'Left Sidebar', 'wp-metrics' ),
                'right' => esc_html__( 'Right Sidebar', 'wp-metrics' )
            ),
            'default' => 'right',
            'required' => array( 'posts_layout', '!=', 'full' )
        ),
        array(
            'id' => 'posts_sidebar_layout',
            'type' => 'button_set',
            'title' => esc_html__( 'Posts Sidebar Layout', 'wp-metrics' ),
            'subtitle' => esc_html__( 'Set layout for sidebar in blog home, archive... pages.', 'wp-metrics' ),
            'options' => array(
                'standard' => esc_html__( 'Standard', 'wp-metrics' ),
                'boxed' => esc_html__( 'Boxed', 'wp-metrics' )
            ),
            'default' => 'standard',
            'required' => array(
                array( 'posts_layout', '!=', 'full' ),
                array( 'posts_sidebar', '!=', 'no' )
            )
        ),
        array(
            'id' => 'post_archive_divider',
            'type' => 'divide'
        ),
        array(
            'id' => 'post_single_sidebar',
            'type' => 'button_set',
            'title' => esc_html__( 'Single Post Sidebar', 'wp-metrics' ),
            'subtitle' => esc_html__( 'Set sidebar position in single post.', 'wp-metrics' ),
            'options' => array(
                'no' => esc_html__( 'None', 'wp-metrics' ),
                'left' => esc_html__( 'Left Sidebar', 'wp-metrics' ),
                'right' => esc_html__( 'Right Sidebar', 'wp-metrics' )
            ),
            'default' => 'right'
        ),
        array(
            'id' => 'post_single_sidebar_layout',
            'type' => 'button_set',
            'title' => esc_html__( 'Single Post Sidebar Layout', 'wp-metrics' ),
            'subtitle' => esc_html__( 'Set layout for sidebar in single post view.', 'wp-metrics' ),
            'options' => array(
                'standard' => esc_html__( 'Standard', 'wp-metrics' ),
                'boxed' => esc_html__( 'Boxed', 'wp-metrics' )
            ),
            'default' => 'standard',
            'required' => array(
                array( 'post_single_sidebar', '!=', 'no' )
            )
        ),
        array(
            'id' => 'related_posts_enable',
            'type' => 'switch',
            'title' => esc_html__( 'Built-in related posts', 'wp-metrics' ),
            'subtitle' => esc_html__( 'Enable or disable built-in related posts module for every posts.', 'wp-metrics' ),
            'default' => true
        ),
        array(
            'id' => 'show_single_post_author',
            'type' => 'switch',
            'title' => esc_html__( 'Show author info', 'wp-metrics' ),
            'subtitle' => esc_html__( 'Show author information in every posts.', 'wp-metrics' ),
            'default' => true
        ),
        array(
            'id' => 'post_single_divider',
            'type' => 'divide'
        ),
        array(
            'id' => 'post_single_font',
            'type' => 'typography',
            'title' => esc_html__( 'Single post font size', 'wp-metrics' ),
            'subtitle' => esc_html__( 'Font size for single post view.', 'wp-metrics' ),
            'google' => false,
            'line-height' => false,
            'font-style' => false,
            'font-weight' => false,
            'font-family' => false,
            'text-align' => false,
            'color' => false,
            'units' => 'px',
            'default' => array(
                'font-size' => '15px',
            ),
        ),
        array(
            'id' => 'widget_font',
            'type' => 'typography',
            'title' => esc_html__( 'Widget font size', 'wp-metrics' ),
            'subtitle' => esc_html__( 'Font size for widget area.', 'wp-metrics' ),
            'google' => false,
            'line-height' => false,
            'font-style' => false,
            'font-weight' => false,
            'font-family' => false,
            'text-align' => false,
            'color' => false,
            'units' => 'px',
            'default' => array(
                'font-size' => '13px',
            ),
        ),
        array(
            'id' => 'widget_title_font',
            'type' => 'typography',
            'title' => esc_html__( 'Widget title font size', 'wp-metrics' ),
            'subtitle' => esc_html__( 'Font size for widget title at widget area.', 'wp-metrics' ),
            'google' => false,
            'line-height' => false,
            'font-style' => false,
            'font-weight' => false,
            'font-family' => false,
            'text-align' => false,
            'color' => false,
            'units' => 'px',
            'output' => array( '.widget-title' ),
            'default' => array(
                'font-size' => '16px',
            ),
        )
    )
);



/**
 * Sharing option
 */
$this->sections[] = array(
    'title' => esc_html__( 'Sharing Options', 'wp-metrics' ),
    'icon' => 'el-icon-share',
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'post_sharing_enable',
            'type' => 'switch',
            'title' => esc_html__( 'Post Sharing Feature', 'wp-metrics' ),
            'subtitle' => esc_html__( 'Show social network share buttons in every posts.', 'wp-metrics' ),
            'default' => true
        ),
        array(
            'id' => 'post_sharing_facebook',
            'type' => 'switch',
            'title' => esc_html__( 'Facebook', 'wp-metrics' ),
            'subtitle' => esc_html__( 'Include Facebook share button in every posts.', 'wp-metrics' ),
            'default' => true,
            'required' => array( 'post_sharing_enable', '=', true )
        ),
        array(
            'id' => 'post_sharing_twitter',
            'type' => 'switch',
            'title' => esc_html__( 'Twitter', 'wp-metrics' ),
            'subtitle' => esc_html__( 'Include Twitter share button in every posts.', 'wp-metrics' ),
            'default' => true,
            'required' => array( 'post_sharing_enable', '=', true )
        ),
        array(
            'id' => 'post_sharing_googleplus',
            'type' => 'switch',
            'title' => esc_html__( 'Googleplus', 'wp-metrics' ),
            'subtitle' => esc_html__( 'Include Googleplus share button in every posts.', 'wp-metrics' ),
            'default' => true,
            'required' => array( 'post_sharing_enable', '=', true )
        ),
        array(
            'id' => 'post_sharing_pinterest',
            'type' => 'switch',
            'title' => esc_html__( 'Pinterest', 'wp-metrics' ),
            'subtitle' => esc_html__( 'Include Pinterest share button in every posts.', 'wp-metrics' ),
            'default' => true,
            'required' => array( 'post_sharing_enable', '=', true )
        ),
        array(
            'id' => 'post_sharing_linkedin',
            'type' => 'switch',
            'title' => esc_html__( 'Linkedin', 'wp-metrics' ),
            'subtitle' => esc_html__( 'Include Linkedin share button in every posts.', 'wp-metrics' ),
            'default' => false,
            'required' => array( 'post_sharing_enable', '=', true )
        ),
        array(
            'id' => 'post_sharing_tumblr',
            'type' => 'switch',
            'title' => esc_html__( 'Tumblr', 'wp-metrics' ),
            'subtitle' => esc_html__( 'Include Tumblr share button in every posts.', 'wp-metrics' ),
            'default' => false,
            'required' => array( 'post_sharing_enable', '=', true )
        ),
        array(
            'id' => 'post_sharing_vk',
            'type' => 'switch',
            'title' => esc_html__( 'Vk', 'wp-metrics' ),
            'subtitle' => esc_html__( 'Include Vk share button in every posts.', 'wp-metrics' ),
            'default' => false,
            'required' => array( 'post_sharing_enable', '=', true )
        ),
        array(
            'id' => 'post_sharing_reddit',
            'type' => 'switch',
            'title' => esc_html__( 'Reddit', 'wp-metrics' ),
            'subtitle' => esc_html__( 'Include Reddit share button in every posts.', 'wp-metrics' ),
            'default' => false,
            'required' => array( 'post_sharing_enable', '=', true )
        ),
        array(
            'id' => 'post_sharing_email',
            'type' => 'switch',
            'title' => esc_html__( 'Email', 'wp-metrics' ),
            'subtitle' => esc_html__( 'Include email share button in every posts.', 'wp-metrics' ),
            'default' => false,
            'required' => array( 'post_sharing_enable', '=', true )
        ),
    )
);


if ( class_exists( 'WooCommerce' ) ) :

/**
 * Shop settings
 */
$this->sections[] = array(
    'title' => esc_html__( 'Shop', 'wp-metrics' ),
    'icon' => 'el-icon-shopping-cart',
    'fields' => array(
        array(
            'id' => 'woo_sidebar',
            'type' => 'button_set',
            'title' => esc_html__( 'Shop Sidebar', 'wp-metrics' ),
            'subtitle' => esc_html__( 'Set sidebar position for shop pages.', 'wp-metrics' ),
            'options' => array(
                'no' => esc_html__( 'None', 'wp-metrics' ),
                'left' => esc_html__( 'Left Sidebar', 'wp-metrics' ),
                'right' => esc_html__( 'Right Sidebar', 'wp-metrics' )
            ),
            'default' => 'right'
        ),
        array(
            'id' => 'woo_sidebar_layout',
            'type' => 'button_set',
            'title' => esc_html__( 'Shop Sidebar Layout', 'wp-metrics' ),
            'subtitle' => esc_html__( 'Set layout for sidebar in shop pages.', 'wp-metrics' ),
            'options' => array(
                'standard' => esc_html__( 'Standard', 'wp-metrics' ),
                'boxed' => esc_html__( 'Boxed', 'wp-metrics' )
            ),
            'default' => 'standard',
            'required' => array(
                array( 'woo_sidebar', '!=', 'no' )
            )
        ),
        array(
            'id' => 'woo_shop_cols',
            'type' => 'select',
            'title' => esc_html__( 'Products columns', 'wp-metrics' ),
            'subtitle' => esc_html__( 'Set columns for products showcase', 'wp-metrics' ),
            'select2' => array(
                'allowClear' => false
            ),
            'options' => array(
                '2' => esc_html__( '2 Columns', 'wp-metrics' ),
                '3' => esc_html__( '3 Columns', 'wp-metrics' ),
                '4' => esc_html__( '4 Columns', 'wp-metrics' ),
                '6' => esc_html__( '6 Columns', 'wp-metrics' ),
            ),
            'default' => '3'
        )
    )
);

/**
 * Product Sharing option
 */
$this->sections[] = array(
    'title' => esc_html__( 'Product Sharing Options', 'wp-metrics' ),
    'icon' => 'el-icon-share',
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'product_sharing_enable',
            'type' => 'switch',
            'title' => esc_html__( 'Product Sharing Feature', 'wp-metrics' ),
            'subtitle' => esc_html__( 'Show social network share buttons in every product.', 'wp-metrics' ),
            'default' => true
        ),
        array(
            'id' => 'product_sharing_facebook',
            'type' => 'switch',
            'title' => esc_html__( 'Facebook', 'wp-metrics' ),
            'subtitle' => esc_html__( 'Include Facebook share button in every product.', 'wp-metrics' ),
            'default' => true,
            'required' => array( 'product_sharing_enable', '=', true )
        ),
        array(
            'id' => 'product_sharing_twitter',
            'type' => 'switch',
            'title' => esc_html__( 'Twitter', 'wp-metrics' ),
            'subtitle' => esc_html__( 'Include Twitter share button in every product.', 'wp-metrics' ),
            'default' => true,
            'required' => array( 'product_sharing_enable', '=', true )
        ),
        array(
            'id' => 'product_sharing_googleplus',
            'type' => 'switch',
            'title' => esc_html__( 'Googleplus', 'wp-metrics' ),
            'subtitle' => esc_html__( 'Include Googleplus share button in every product.', 'wp-metrics' ),
            'default' => true,
            'required' => array( 'product_sharing_enable', '=', true )
        ),
        array(
            'id' => 'product_sharing_pinterest',
            'type' => 'switch',
            'title' => esc_html__( 'Pinterest', 'wp-metrics' ),
            'subtitle' => esc_html__( 'Include Pinterest share button in every product.', 'wp-metrics' ),
            'default' => false,
            'required' => array( 'product_sharing_enable', '=', true )
        ),
        array(
            'id' => 'product_sharing_linkedin',
            'type' => 'switch',
            'title' => esc_html__( 'Linkedin', 'wp-metrics' ),
            'subtitle' => esc_html__( 'Include Linkedin share button in every product.', 'wp-metrics' ),
            'default' => true,
            'required' => array( 'product_sharing_enable', '=', true )
        ),
        array(
            'id' => 'product_sharing_tumblr',
            'type' => 'switch',
            'title' => esc_html__( 'Tumblr', 'wp-metrics' ),
            'subtitle' => esc_html__( 'Include Tumblr share button in every product.', 'wp-metrics' ),
            'default' => false,
            'required' => array( 'product_sharing_enable', '=', true )
        ),
        array(
            'id' => 'product_sharing_vk',
            'type' => 'switch',
            'title' => esc_html__( 'Vk', 'wp-metrics' ),
            'subtitle' => esc_html__( 'Include Vk share button in every product.', 'wp-metrics' ),
            'default' => false,
            'required' => array( 'product_sharing_enable', '=', true )
        ),
        array(
            'id' => 'product_sharing_reddit',
            'type' => 'switch',
            'title' => esc_html__( 'Reddit', 'wp-metrics' ),
            'subtitle' => esc_html__( 'Include Reddit share button in every product.', 'wp-metrics' ),
            'default' => false,
            'required' => array( 'product_sharing_enable', '=', true )
        ),
        array(
            'id' => 'product_sharing_email',
            'type' => 'switch',
            'title' => esc_html__( 'Email', 'wp-metrics' ),
            'subtitle' => esc_html__( 'Include email share button in every product.', 'wp-metrics' ),
            'default' => false,
            'required' => array( 'product_sharing_enable', '=', true )
        ),
    )
);
endif; // <-- WooCommerce


/**
 * Additional custom CSS
 */
$this->sections[] = array(
    'title' => esc_html__( 'Custom CSS', 'wp-metrics' ),
    'icon' => 'el-icon-bulb',
    'fields' => array(
        array(
            'id' => 'custom_css',
            'type' => 'ace_editor',
            'title' => esc_html__( 'CSS Code', 'wp-metrics' ),
            'subtitle' => esc_html__( 'Create your own custom css here.', 'wp-metrics' ),
            'mode' => 'css',
            'theme' => 'monokai'
        )
    )
);


/**
 * Advanced
 */
$this->sections[] = array(
    'title'             => esc_html__( 'Advanced', 'wp-metrics' ),
    'icon'              => 'el-icon-warning-sign',
    'fields'            => array(
        array(
            'id'                => 'dev_mode',
            'type'              => 'switch',
            'title'             => esc_html__( 'Dev Mode (not recommended)', 'wp-metrics' ),
            'subtitle'          => esc_html__( 'css generating over time and not compressed', 'wp-metrics' ),
            'default'           => false
        )
    )
);