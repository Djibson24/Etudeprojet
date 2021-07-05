<?php defined( 'ABSPATH' ) or exit();

/**
 * Theme Options Declaration.
 * For full documentation, please visit: http://docs.reduxframework.com/
 * require ReduxFramework
 *
 * @package CMSSuperHeroes
 * @subpackage WPMetrics
 */

if ( ! class_exists( 'ReduxFramework' ) )
{
    return;
}

class WPMetrics_Theme_Options {

    protected $args = array();
    protected $sections = array();
    protected $ReduxFramework;


    function __construct() {
        if ( ! class_exists( 'ReduxFramework' ) ) {
            return;
        }

        // This is needed. Bah WordPress bugs.  ;)
        if ( true == Redux_Helpers::isTheme( __FILE__ ) ) {
            $this->initialize();
        } else {
            add_action( 'plugins_loaded', array( $this, 'initialize' ), 10 );
        }
    }


    function initialize() {

        // Set the default arguments
        $this->set_args();

        // Set a few help tabs so you can see how it's done
        $this->set_help_tabs();

        // Create the sections and fields
        $this->set_sections();

        if ( ! isset( $this->args['opt_name'] ) ) { // No errors please
            return;
        }

        $this->ReduxFramework = new ReduxFramework( $this->sections, $this->args );
    }

    
    function set_help_tabs() {

        // Custom page help tabs, displayed using the help API. Tabs are shown in order of definition.
        $this->args['help_tabs'][] = array(
            'id'      => 'redux-help-tab-1',
            'title'   => esc_html__( 'Theme Information 1', 'wp-metrics' ),
            'content' => esc_html__( 'This is the tab content, HTML is allowed.', 'wp-metrics' )
        );

        $this->args['help_tabs'][] = array(
            'id'      => 'redux-help-tab-2',
            'title'   => esc_html__( 'Theme Information 2', 'wp-metrics' ),
            'content' => esc_html__( 'This is the tab content, HTML is allowed.', 'wp-metrics' )
        );

        // Set the help sidebar
        $this->args['help_sidebar'] = esc_html__( 'This is the sidebar content, HTML is allowed.', 'wp-metrics' );
    }


    /**
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
     * */
    function set_args() {

        $theme = wp_get_theme(); // For use with some settings. Not necessary.

        $this->args = array(
            // TYPICAL -> Change these values as you need/desire
            'opt_name'           => 'smof_data',
            // This is where your data is stored in the database and also becomes your global variable name.
            'display_name'       => $theme->get('Name'),
            // Name that appears at the top of your panel
            'display_version'    => 'V' . $theme->get( 'Version' ),
            // Version that appears at the top of your panel
            'menu_type'          => 'submenu',
            //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
            'allow_sub_menu'     => true,
            // Show the sections below the admin menu item or not
            'menu_title'         => esc_html__( 'Theme Options', 'wp-metrics' ),
            'page_title'         => esc_html__( 'Theme Options', 'wp-metrics' ),
            // You will need to generate a Google API key to use this feature.
            // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
            'google_api_key'     => '',
            // Must be defined to add google fonts to the typography module

            'async_typography'   => false,
            // Use a asynchronous font on the front end or font string
            'admin_bar'          => true,
            // Show the panel pages on the admin bar
            'global_variable'    => '',
            // Set a different name for your global variable other than the opt_name
            'dev_mode'           => false,
            // Show the time the page took to load, etc
            'customizer'         => true,
            // Enable basic customizer support

            // OPTIONAL -> Give you extra features
            'page_priority'      => null,
            // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
            'page_parent'        => 'themes.php',
            // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
            'page_permissions'   => 'manage_options',
            // Permissions needed to access the options panel.
            'menu_icon'          => 'dashicons-art',
            // Specify a custom URL to an icon
            'last_tab'           => '',
            // Force your panel to always open to a specific tab (by id)
            'page_icon'          => 'icon-themes',
            // Icon displayed in the admin panel next to your menu_title
            'page_slug'          => 'wp-metrics-options',
            // Page slug used to denote the panel
            'save_defaults'      => true,
            // On load save the defaults to DB before user clicks save or not
            'default_show'       => false,
            // If true, shows the default value next to each field that is not the default value.
            'default_mark'       => '',
            // What to print by the field's title if the value shown is default. Suggested: *
            'show_import_export' => true,
            // Shows the Import/Export panel when not used as a field.

            // CAREFUL -> These options are for advanced use only
            'transient_time'     => 60 * MINUTE_IN_SECONDS,
            'output'             => true,
            // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
            'output_tag'         => true,
            // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
            // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

            // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
            'database'           => '',
            // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
            'system_info'        => false,
            // REMOVE

            // HINTS
            'hints'              => array(
                'icon'          => 'icon-question-sign',
                'icon_position' => 'right',
                'icon_color'    => 'lightgray',
                'icon_size'     => 'normal',
                'tip_style'     => array(
                    'color'   => 'light',
                    'shadow'  => true,
                    'rounded' => false,
                    'style'   => '',
                ),
                'tip_position'  => array(
                    'my' => 'top left',
                    'at' => 'bottom right',
                ),
                'tip_effect'    => array(
                    'show' => array(
                        'effect'   => 'slide',
                        'duration' => '500',
                        'event'    => 'mouseover',
                    ),
                    'hide' => array(
                        'effect'   => 'slide',
                        'duration' => '500',
                        'event'    => 'click mouseleave',
                    ),
                ),
            )
        );


        // Panel Intro text -> before the form
        if ( ! isset( $this->args['global_variable'] ) || $this->args['global_variable'] !== false ) {
            if ( ! empty( $this->args['global_variable'] ) ) {
                $v = $this->args['global_variable'];
            } else {
                $v = str_replace( '-', '_', $this->args['opt_name'] );
            }
            $this->args['intro_text'] = "";
        } else {
            $this->args['intro_text'] = "";
        }

        // Add content after the form.
        $this->args['footer_text'] = "";
    }

    /**
     * Setup option sections
     */
    function set_sections() {
        require_once get_template_directory() . '/inc/generated/options-sections.php';
    }

    /**
     * Setup customizer support
     */
    function set_customizer() {

    }
}

new WPMetrics_Theme_Options();
