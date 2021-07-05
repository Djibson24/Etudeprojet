<?php defined( 'ABSPATH' ) or exit();
/**
 * Meta options for the theme
 *
 * @package CMSSuperHeroes
 * @subpackage WPMetrics
 */

if ( ! is_admin() || ! ( 'post.php' == $GLOBALS['pagenow'] || 'post-new.php' == $GLOBALS['pagenow'] ) ) return;
if ( ! class_exists( 'WPMetrics_Meta_Framework' ) ) {
    require get_template_directory() . '/inc/classes/class-meta-framework.php';
}

class WPMetrics_Meta_Options extends WPMetrics_Meta_Framework
{
    function __construct()
    {
        global $pagenow;
        if ( $pagenow == 'post.php' || $pagenow == 'post-new.php' ) {
            parent::__construct();

            add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
            add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
            add_action( 'save_post', array( $this, 'page_options_save' ) );
            add_action( 'save_post', array( $this, 'post_options_save' ) );
            add_action( 'save_post', array( $this, 'pricing_plan_options_save' ) );
            add_action( 'save_post', array( $this, 'team_options_save' ) );
            add_action( 'save_post', array( $this, 'demo_options_save' ) );
        }
        else {
            return;
        }
    }

    /**
     * Add Metaboxes
     */
    function add_meta_boxes()
    {
        add_meta_box(
            '_cms_page_options',
            esc_html__( 'Settings', 'wp-metrics' ),
            array( $this, 'page_options' ),
            array( 'page', 'case_study' ),
            'advanced'
        );
        add_meta_box(
            '_cms_post_options',
            esc_html__( 'Post Options', 'wp-metrics' ),
            array( $this, 'post_options' ),
            'post',
            'advanced'
        );
        if ( post_type_exists( 'pricing_plan' ) ) {
            add_meta_box(
                '_cms_pricing_plan_options',
                esc_html__( 'Additional Information', 'wp-metrics' ),
                array( $this, 'pricing_plan_options' ),
                'pricing_plan'
            );
        }
        if ( post_type_exists( 'team' ) ) {
            add_meta_box(
                '_cms_team_options',
                esc_html__( 'Additional Information', 'wp-metrics' ),
                array( $this, 'team_options' ),
                'team'
            );
        }
        if ( post_type_exists( 'home_demo' ) ) {
            add_meta_box(
                '_cms_demo_options',
                esc_html__( 'Demo Link', 'wp-metrics' ),
                array( $this, 'demo_options' ),
                'home_demo'
            );
        }
    }

    /**
     * Enqueue scripts and styles
     */
    function enqueue_scripts()
    {
        parent::enqueue_scripts();
    }

    /**
     * Metabox options for pages
     * @param  object $post
     */
    function page_options( $post )
    {
        wp_nonce_field( 'cms_page_options_data_nonce', 'cms_page_options_nonce' );
        require get_template_directory() . '/inc/generated/options-page.php';
    }

    /**
     * Save the metabox
     * @param  integer $post_id
     * @return void
     */
    function page_options_save( $post_id )
    {
        // If this is an autosave, our form has not been submitted, so we don't want to do anything.
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return;
        }
        // Nonce field hasn't comfirmed
        if ( ! isset( $_POST['cms_page_options_nonce'] ) || ! wp_verify_nonce( $_POST['cms_page_options_nonce'], 'cms_page_options_data_nonce' ) ) {
            return;
        }

        // Check the user's permissions.
        if ( isset( $_POST['post_type'] ) && ( 'page' == $_POST['post_type'] || 'case_study' == $_POST['post_type'] ) ) {
            if ( ! current_user_can( 'edit_page', $post_id ) ) {
                return;
            }
        }
        else {
            return;
        }

        foreach ( $_POST as $key => $value ) {
            if ( 0 === strpos( $key, '_cms_' ) ) {
                // Sanitize user input and Update the meta field in the database.
                if ( ! empty( $value ) ) {
                    if ( ! is_array( $value ) ) {
                        $value = sanitize_text_field( $value );
                    }
                    else {
                        $value = array_map( "esc_attr", $value );
                    }
                }
                else {
                    $value = '';
                }
                update_post_meta( $post_id, $key, $value );
            }
        }
    }

    /**
     * Options for related posts
     * @param  object $post
     */
    function post_options( $post )
    {
        wp_nonce_field( 'cms_post_options_data_nonce', 'cms_post_options_nonce' );
        require get_template_directory() . '/inc/generated/options-post.php';
    }

    /**
     * Save post options
     * @param  int $post_id
     * @return void
     */
    function post_options_save( $post_id )
    {
        // If this is an autosave, our form has not been submitted, so we don't want to do anything.
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return;
        }
        // Nonce field hasn't comfirmed
        if ( ! isset( $_POST['cms_post_options_nonce'] ) || ! wp_verify_nonce( $_POST['cms_post_options_nonce'], 'cms_post_options_data_nonce' ) ) {
            return;
        }
        // Check the user's permissions.
        if ( isset( $_POST['post_type'] ) && 'post' == $_POST['post_type'] ) {
            if ( ! current_user_can( 'edit_post', $post_id ) ) {
                return;
            }
        }
        else {
            return;
        }

        foreach ( $_POST as $key => $value ) {
            if ( 0 === strpos( $key, '_cms_' ) ) {
                // Sanitize user input and Update the meta field in the database.
                if ( ! empty( $value ) ) {
                    if ( ! is_array( $value ) ) {
                        $value = sanitize_text_field( $value );
                    }
                    else {
                        $value = array_map( "esc_attr", $value );
                    }
                } else {
                    $value = '';
                }
                update_post_meta( $post_id, $key, $value );
            }
        }
    }

    /**
     * Options for pricing_plan
     * @param  oject $post
     */
    function pricing_plan_options( $post )
    {
        wp_nonce_field( 'cms_pricing_plan_options_data_nonce', 'cms_pricing_plan_options_nonce' );
        require get_template_directory() . '/inc/generated/options-pricing-plan.php';
    }

    /**
     * Save pricing_plan options
     * @param  int $post_id
     * @return void
     */
    function pricing_plan_options_save( $post_id )
    {
        // If this is an autosave, our form has not been submitted, so we don't want to do anything.
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return;
        }
        // Nonce field hasn't comfirmed
        if ( ! isset( $_POST['cms_pricing_plan_options_nonce'] ) || ! wp_verify_nonce( $_POST['cms_pricing_plan_options_nonce'], 'cms_pricing_plan_options_data_nonce' ) ) {
            return;
        }
        // Check the user's permissions.
        if ( isset( $_POST['post_type'] ) && 'pricing_plan' == $_POST['post_type'] ) {
            if ( ! current_user_can( 'edit_post', $post_id ) ) {
                return;
            }
        } else {
            return;
        }

        foreach ( $_POST as $key => $value ) {
            if ( 0 === strpos( $key, '_cms_' ) ) {
                 // Sanitize user input and Update the meta field in the database.
                if ( ! empty( $value ) ) {
                    if ( ! is_array( $value ) ) {
                        if ( '_cms_description' != $key ) {
                            $value = sanitize_text_field( $value );
                        }
                        else {
                            $value = wp_kses_post( $value );
                        }
                    }
                    else {
                        $value = array_map( "esc_attr", $value );
                    }
                } else {
                    $value = '';
                }
                update_post_meta( $post_id, $key, $value );
            }
        }
    }

    /**
     * Options for team_member
     * @param  oject $post
     */
    function team_options( $post )
    {
        wp_nonce_field( 'cms_team_options_data_nonce', 'cms_team_options_nonce' );
        require get_template_directory() . '/inc/generated/options-team.php';
    }

    /**
     * Save team_member options
     * @param  int $post_id
     * @return void
     */
    function team_options_save( $post_id )
    {
        // If this is an autosave, our form has not been submitted, so we don't want to do anything.
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return;
        }
        // Nonce field hasn't comfirmed
        if ( ! isset( $_POST['cms_team_options_nonce'] ) || ! wp_verify_nonce( $_POST['cms_team_options_nonce'], 'cms_team_options_data_nonce' ) ) {
            return;
        }
        // Check the user's permissions.
        if ( isset( $_POST['post_type'] ) && 'team' == $_POST['post_type'] ) {
            if ( ! current_user_can( 'edit_post', $post_id ) ) {
                return;
            }
        } else {
            return;
        }

        foreach ( $_POST as $key => $value ) {
            if ( 0 === strpos( $key, '_cms_' ) ) {
                // Sanitize user input and Update the meta field in the database.
                if ( ! empty( $value ) ) {
                    if ( ! is_array( $value ) ) {
                        $value = sanitize_text_field( $value );
                    }
                    else {
                        $value = array_map( "esc_url", $value );
                    }
                } else {
                    $value = '';
                }
                update_post_meta( $post_id, $key, $value );
            }
        }
    }

    /**
     * Options for home_demo
     * @param  oject $post
     */
    function demo_options( $post )
    {
        wp_nonce_field( 'cms_demo_options_data_nonce', 'cms_demo_options_nonce' );
        require get_template_directory() . '/inc/generated/options-demo.php';
    }
    
    /**
     * Save home_demo options
     * @param  int $post_id
     * @return void
     */
    function demo_options_save( $post_id )
    {
        // If this is an autosave, our form has not been submitted, so we don't want to do anything.
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return;
        }
        // Nonce field hasn't comfirmed
        if ( ! isset( $_POST['cms_demo_options_nonce'] ) || ! wp_verify_nonce( $_POST['cms_demo_options_nonce'], 'cms_demo_options_data_nonce' ) ) {
            return;
        }
        // Check the user's permissions.
        if ( isset( $_POST['post_type'] ) && 'home_demo' == $_POST['post_type'] ) {
            if ( ! current_user_can( 'edit_post', $post_id ) ) {
                return;
            }
        } else {
            return;
        }

        foreach ( $_POST as $key => $value ) {
            if ( 0 === strpos( $key, '_cms_' ) ) {
                // Sanitize user input and Update the meta field in the database.
                if ( ! empty( $value ) ) {
                    if ( ! is_array( $value ) ) {
                        $value = sanitize_text_field( $value );
                    }
                    else {
                        $value = array_map( "esc_url", $value );
                    }
                } else {
                    $value = '';
                }
                update_post_meta( $post_id, $key, $value );
            }
        }
    }
}

new WPMetrics_Meta_Options();
