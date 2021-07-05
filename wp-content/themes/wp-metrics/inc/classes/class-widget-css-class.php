<?php defined( 'ABSPATH' ) or exit();

/**
 * This class simply add a field to widgets that allows you to add additional css class to it for further styling
 *
 * @author  Stev Ngo
 * @version 1.0
 * @package WPMetrics
 */
class WPMetrics_Widget_CSS_Class {

    /**
     * Construction
     */
    function __construct() {
        global $pagenow;
        if ( is_admin() ) {
            add_action( 'in_widget_form', array( $this, 'extend_widget_form' ), 10, 3 );
            add_filter( 'widget_update_callback', array( $this, 'extend_widget_update' ), 10, 2 );
        }
        add_filter( 'dynamic_sidebar_params', array( $this, 'extend_widget_params'), 10, 2 );
    }

    /**
     * Adds form fields to the end of Widget form
     * 
     * @param   $widget     object  WP_Widget | The widget instance, passed by reference.
     * @param   $return     null    Return null if new fields are added.
     * @param   $instance   array   An array of the widget's settings.
     * @return  array               An array of the new widget's settings.
     */
    function extend_widget_form( $widget, $return, $instance ) {
        if ( ! isset( $instance['el_class'] ) ) $instance['el_class'] = ''; ?>
        <p>
            <label for="widget-<?php echo esc_attr( $widget->id_base . '-' . $widget->number ); ?>-el_class"><?php esc_html_e( 'CSS Class', 'wp-metrics' ); ?></label>
            <input type="text" class="widefat" 
                name="widget-<?php echo esc_attr( $widget->id_base . '[' . $widget->number . '][el_class]' ); ?>" 
                id="widget-<?php echo esc_attr( $widget->id_base . '-' . $widget->number ); ?>-el_class" 
                value="<?php echo esc_attr( $instance['el_class'] ); ?>"/>
        </p>
        <?php
        return $instance;
    }

    /**
     * Add css class param to the widget before saving
     * 
     * @param   $instance       array   The current widget instance's settings.
     * @param   $new_instance   array   Array of new widget settings.
     * @return  array                   An array of the new widget's settings.
     */
    function extend_widget_update( $instance, $new_instance ) {
        $instance['el_class'] = $new_instance['el_class'];
        return $instance;
    }

    /**
     * Add css class to widget front-end display by filtering widget params
     * @param   $params array
     * @return  array   Extended widget parameters
     */
    function extend_widget_params( $params ) {
        global $wp_registered_widgets;
        
        $widget_obj = $wp_registered_widgets[$params[0]['widget_id']];
        $widget_num = $widget_obj['params'][0]['number'];
        
        $instances = get_option( $widget_obj['callback'][0]->option_name );

        if ( $widget_num === -1 )
        {
            return $params;
        }
        
        $instance = $instances[$widget_num];

        if ( isset( $instance['el_class'] ) ) {
            $params[0]['before_widget'] = preg_replace( '/class="/', "class=\"{$instance['el_class']} ", $params[0]['before_widget'], 1 );
        }

        return $params;
    }
}

new WPMetrics_Widget_CSS_Class();