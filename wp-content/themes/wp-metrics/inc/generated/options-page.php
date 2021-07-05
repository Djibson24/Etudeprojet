<?php defined( 'ABSPATH' ) or exit();
/**
 * @see  Metrics_Meta_Options::page_options()
 */
?>
<div id="cms_page_options" class="cms-metabox">
    <ul class="cms-metabox-tabs">
        <li><a href="#cms_page_options_tab_header"><?php esc_html_e( 'Header', 'wp-metrics' ); ?></a></li>
        <li><a href="#cms_page_options_tab_page_title"><?php esc_html_e( 'Page Title', 'wp-metrics' ); ?></a></li>
        <li><a href="#cms_page_options_tab_footer"><?php esc_html_e( 'Footer', 'wp-metrics' ); ?></a></li>
        <li><a href="#cms_page_options_tab_others"><?php esc_html_e( 'Others', 'wp-metrics' ); ?></a></li>
    </ul>
    <div id="cms_page_options_tab_header" class="cms-metabox-tab-content"><?php
        $menu_objs = wp_get_nav_menus();
        $menu_select_arr = array(
            '' => esc_html__( 'Default', 'wp-metrics' )
        );
        foreach ( $menu_objs as $key => $menu_obj ) {
            $menu_select_arr[$menu_obj->term_id] = $menu_obj->name;
        }

        $this->render_field( array(
            'id' => 'primary_menu',
            'type' => 'select',
            'title' => esc_html__( 'Primary menu', 'wp-metrics' ),
            'options' => $menu_select_arr
        ), $post->ID );

        $this->render_field( array(
            'id' => 'sticky_header',
            'type' => 'button_group',
            'title' => esc_html__( 'Sticky header', 'wp-metrics' ),
            'options' => array(
                '' => esc_html__( 'Default', 'wp-metrics' ),
                'on' => esc_html__( 'On', 'wp-metrics' ),
                'off' => esc_html__( 'Off', 'wp-metrics' ),
            )
        ), $post->ID );

        $this->render_field( array(
            'id' => 'show_search',
            'type' => 'button_group',
            'title' => esc_html__( 'Show Search', 'wp-metrics' ),
            'options' => array(
                '' => esc_html__( 'Default', 'wp-metrics' ),
                'on' => esc_html__( 'On', 'wp-metrics' ),
                'off' => esc_html__( 'Off', 'wp-metrics' ),
            )
        ), $post->ID );

        $this->render_field( array(
            'id' => 'show_side_panel',
            'type' => 'button_group',
            'title' => esc_html__( 'Show Side Panel', 'wp-metrics' ),
            'options' => array(
                '' => esc_html__( 'Default', 'wp-metrics' ),
                'on' => esc_html__( 'On', 'wp-metrics' ),
                'off' => esc_html__( 'Off', 'wp-metrics' ),
            )
        ), $post->ID );

        if ( class_exists( 'WooCommerce') ) {
            $this->render_field( array(
                'id' => 'show_cart',
                'type' => 'button_group',
                'title' => esc_html__( 'Show Cart', 'wp-metrics' ),
                'options' => array(
                    '' => esc_html__( 'Default', 'wp-metrics' ),
                    'on' => esc_html__( 'On', 'wp-metrics' ),
                    'off' => esc_html__( 'Off', 'wp-metrics' ),
                )
            ), $post->ID );
        }

        $this->render_field( array(
            'id' => 'custom_header',
            'type' => 'switcher',
            'title' => esc_html__( 'Custom Header Layout', 'wp-metrics' ),
            'open_fields' => array(
                '1' => array( '#cms_page_options_header_layout' ),
            )
        ), $post->ID );

        echo '<div id="cms_page_options_header_layout">';

        $this->render_field( array(
            'id' => 'header_layout',
            'type' => 'image_select',
            'title' => esc_html__( 'Header Layout', 'wp-metrics' ),
            'options'           => array(
                '1'     => get_template_directory_uri() . '/inc/assets/images/headers/header_layout_01.png',
                '2'     => get_template_directory_uri() . '/inc/assets/images/headers/header_layout_02.png',
                '3'     => get_template_directory_uri() . '/inc/assets/images/headers/header_layout_03.png',
                '4'     => get_template_directory_uri() . '/inc/assets/images/headers/header_layout_04.png',
                '5'     => get_template_directory_uri() . '/inc/assets/images/headers/header_layout_05.png',
                '6'     => get_template_directory_uri() . '/inc/assets/images/headers/header_layout_06.png',
                '7'     => get_template_directory_uri() . '/inc/assets/images/headers/header_layout_07.png',
                '8'     => get_template_directory_uri() . '/inc/assets/images/headers/header_layout_08.png',
                '9'     => get_template_directory_uri() . '/inc/assets/images/headers/header_layout_09.png',
                '10'    => get_template_directory_uri() . '/inc/assets/images/headers/header_layout_10.png',
                '11'    => get_template_directory_uri() . '/inc/assets/images/headers/header_layout_11.png',
                '12'    => get_template_directory_uri() . '/inc/assets/images/headers/header_layout_12.png',
                '13'    => get_template_directory_uri() . '/inc/assets/images/headers/header_layout_13.png',
                '14'    => get_template_directory_uri() . '/inc/assets/images/headers/header_layout_14.png',
                '15'    => get_template_directory_uri() . '/inc/assets/images/headers/header_layout_15.png',
                '16'    => get_template_directory_uri() . '/inc/assets/images/headers/header_layout_16.png',
                '17'    => get_template_directory_uri() . '/inc/assets/images/headers/header_layout_17.png'
            ),
            'value' => '1'
        ), $post->ID );

        echo '</div>'; // #cms_page_options_header_layout
    ?>
    </div><!-- #cms_page_options_tab_header -->

    <div id="cms_page_options_tab_page_title" class="cms-metabox-tab-content"><?php
        $this->render_field( array(
            'id' => 'custom_page_title',
            'type' => 'button_group',
            'title' => esc_html__( 'Custom Page Title', 'wp-metrics' ),
            'options' => array(
                'default' => esc_html__( 'Default', 'wp-metrics' ),
                'custom' => esc_html__( 'Custom', 'wp-metrics' ),
                'hidden' => esc_html__( 'Hidden', 'wp-metrics' )
            ),
            'open_fields' => array(
                'custom' => array(
                    '#cms_page_options_custom_page_title',
                )
            ),
            'value' => 'default'
        ), $post->ID );

        echo '<div id="cms_page_options_custom_page_title">';

        $this->render_field( array(
            'id' => 'page_title',
            'type' => 'textfield',
            'title' => esc_html__( 'Page Title', 'wp-metrics' ),
            'placeholder' => esc_html__( 'Custom title for this page.', 'wp-metrics' )
        ), $post->ID );

        $this->render_field( array(
            'id' => 'page_subtitle',
            'type' => 'textfield',
            'title' => esc_html__( 'Page Sub-Title', 'wp-metrics' ),
            'placeholder' => esc_html__( 'Custom subtitle for this page.', 'wp-metrics' )
        ), $post->ID );

        $this->render_field( array(
            'id' => 'custom_pagetitle_bg',
            'type' => 'switcher',
            'title' => esc_html__( 'Custom Background', 'wp-metrics' ),
            'open_fields' => array(
                '1' => array(
                    '#cms_page_options_custom_pagetitle_bg'
                )
            )
        ), $post->ID );

        echo '<div id="cms_page_options_custom_pagetitle_bg">';

        $this->render_field( array(
            'id' => 'pagetitle_bg_color',
            'type' => 'color',
            'title' => esc_html__( 'Background Color', 'wp-metrics' )
        ), $post->ID );

        $this->render_field( array(
            'id' => 'pagetitle_bg_image',
            'type' => 'image',
            'title' => esc_html__( 'Background Image', 'wp-metrics' )
        ), $post->ID );

        $this->render_field( array(
            'id' => 'pagetitle_bg_repeat',
            'type' => 'select',
            'title' => esc_html__( 'Background Repeat', 'wp-metrics' ),
            'options' => array(
                'repeat' => esc_html__( 'Repeat', 'wp-metrics' ),
                'repeat-x' => esc_html__( 'Repeat X', 'wp-metrics' ),
                'repeat-y' => esc_html__( 'Repeat Y', 'wp-metrics' ),
                'no-repeat' => esc_html__( 'No Repeat', 'wp-metrics' ),
            )
        ), $post->ID );

        $this->render_field( array(
            'id' => 'pagetitle_bg_size',
            'type' => 'select',
            'title' => esc_html__( 'Background Size', 'wp-metrics' ),
            'options' => array(
                '' => esc_html__( 'Keep original', 'wp-metrics' ),
                '100% auto' => esc_html__( 'Stretch to width', 'wp-metrics' ),
                'auto 100%' => esc_html__( 'Stretch to height', 'wp-metrics' ),
                'cover' => esc_html__( 'Cover', 'wp-metrics' ),
                'contain' => esc_html__( 'Contain', 'wp-metrics' ),
            )
        ), $post->ID );

        $this->render_field( array(
            'id' => 'pagetitle_bg_attachment',
            'type' => 'select',
            'title' => esc_html__( 'Background Attachment', 'wp-metrics' ),
            'options' => array(
                'scroll' => esc_html__( 'Scroll', 'wp-metrics' ),
                'fixed' => esc_html__( 'Fixed', 'wp-metrics' )
            )
        ), $post->ID );

        $this->render_field( array(
            'id' => 'pagetitle_bg_position',
            'type' => 'select',
            'title' => esc_html__( 'Background Position', 'wp-metrics' ),
            'options' => array(
                'center center' => esc_html__( 'Center', 'wp-metrics' ),
                'center left' => esc_html__( 'Center Left', 'wp-metrics' ),
                'center right' => esc_html__( 'Center Right', 'wp-metrics' ),
                'top left' => esc_html__( 'Top Left', 'wp-metrics' ),
                'top center' => esc_html__( 'Top Center', 'wp-metrics' ),
                'top right' => esc_html__( 'Top Right', 'wp-metrics' ),
                'bottom left' => esc_html__( 'Bottom Left', 'wp-metrics' ),
                'bottom center' => esc_html__( 'Bottom Center', 'wp-metrics' ),
                'bottom right' => esc_html__( 'Bottom Right', 'wp-metrics' )
            )
        ), $post->ID );

        echo '</div>'; // #cms_page_options_custom_pagetitle_bg

        $this->render_field( array(
            'id' => 'custom_pagetitle_layout',
            'type' => 'switcher',
            'title' => esc_html__( 'Custom Layout', 'wp-metrics' ),
            'open_fields' => array(
                '1' => array(
                    '#cms_page_options_custom_pagetitle_layout'
                )
            )
        ), $post->ID );

        echo '<div id="cms_page_options_custom_pagetitle_layout">';

        $this->render_field( array(
            'id' => 'pagetitle_layout',
            'type' => 'image_select',
            'title' => esc_html__( 'Page Title Layout', 'wp-metrics' ),
            'options'   => array(
                '1'     => get_template_directory_uri() . '/inc/assets/images/pagetitles/pagetitle_layout_01.png',
                '2'     => get_template_directory_uri() . '/inc/assets/images/pagetitles/pagetitle_layout_02.png',
                '3'     => get_template_directory_uri() . '/inc/assets/images/pagetitles/pagetitle_layout_03.png',
                '4'     => get_template_directory_uri() . '/inc/assets/images/pagetitles/pagetitle_layout_04.png',
                '5'     => get_template_directory_uri() . '/inc/assets/images/pagetitles/pagetitle_layout_05.png',
                '6'     => get_template_directory_uri() . '/inc/assets/images/pagetitles/pagetitle_layout_06.png',
                '7'     => get_template_directory_uri() . '/inc/assets/images/pagetitles/pagetitle_layout_07.png',
                '8'     => get_template_directory_uri() . '/inc/assets/images/pagetitles/pagetitle_layout_08.png',
                '9'     => get_template_directory_uri() . '/inc/assets/images/pagetitles/pagetitle_layout_09.png',
                '10'    => get_template_directory_uri() . '/inc/assets/images/pagetitles/pagetitle_layout_10.png',
                '11'    => get_template_directory_uri() . '/inc/assets/images/pagetitles/pagetitle_layout_11.png'
            ),
            'value' => '1'
        ), $post->ID );

        echo '</div>'; // #cms_page_options_custom_pagetitle_layout

        echo '</div>'; // #cms_page_options_custom_page_title
    ?>
    </div><!-- #cms_page_options_tab_page_title -->

    <div id="cms_page_options_tab_footer" class="cms-metabox-tab-content"><?php
        $this->render_field( array(
            'id' => 'custom_footer',
            'type' => 'switcher',
            'title' => esc_html__( 'Custom Footer Layout', 'wp-metrics' ),
            'open_fields' => array(
                '1' => array( '#cms_page_options_footer_layout' ),
            )
        ), $post->ID );

        echo '<div id="cms_page_options_footer_layout">';

        $this->render_field( array(
            'id' => 'footer_layout',
            'type' => 'image_select',
            'title' => esc_html__( 'Footer Layout', 'wp-metrics' ),
            'options'   => array(
                '1'     => get_template_directory_uri() . '/inc/assets/images/footers/footer_layout_01.png',
                '2'     => get_template_directory_uri() . '/inc/assets/images/footers/footer_layout_02.png',
                '3'     => get_template_directory_uri() . '/inc/assets/images/footers/footer_layout_03.png',
                '4'     => get_template_directory_uri() . '/inc/assets/images/footers/footer_layout_04.png',
                '5'     => get_template_directory_uri() . '/inc/assets/images/footers/footer_layout_05.png',
                '6'     => get_template_directory_uri() . '/inc/assets/images/footers/footer_layout_06.png',
                '7'     => get_template_directory_uri() . '/inc/assets/images/footers/footer_layout_07.png',
                '8'     => get_template_directory_uri() . '/inc/assets/images/footers/footer_layout_08.png',
                '9'     => get_template_directory_uri() . '/inc/assets/images/footers/footer_layout_09.png',
                '10'    => get_template_directory_uri() . '/inc/assets/images/footers/footer_layout_10.png',
                '11'    => get_template_directory_uri() . '/inc/assets/images/footers/footer_layout_11.png'
            ),
            'value' => '1'
        ), $post->ID );

        echo '</div>'; // #cms_page_options_footer_layout
    ?>
    </div><!-- #cms_page_options_tab_footer -->

    <div id="cms_page_options_tab_others" class="cms-metabox-tab-content"><?php
        global $wp_registered_sidebars;
        $sidebar_arr = array();
        foreach ( $wp_registered_sidebars as $sidebar ) {
            $sidebar_arr[$sidebar['id']] = $sidebar['name'];
        }
        $this->render_field( array(
            'id' => 'page_sidebar',
            'type' => 'select',
            'title' => esc_html__( 'Sidebar', 'wp-metrics' ),
            'desc' => esc_html( 'Show sidebar if page template supports.', 'wp-metrics' ),
            'options' => $sidebar_arr
        ), $post->ID );
        $this->render_field( array(
            'id' => 'page_sidebar_layout',
            'type' => 'button_group',
            'title' => esc_html__( 'Sidebar Layout', 'wp-metrics' ),
            'options' => array(
                '' => esc_html__( 'Default', 'wp-metrics' ),
                'standard' => esc_html__( 'Standard', 'wp-metrics' ),
                'boxed' => esc_html__( 'Boxed', 'wp-metrics' ),
            )
        ), $post->ID );
    ?>
    </div><!-- #cms_page_options_tab_others -->
</div><!-- #cms_page_options -->
