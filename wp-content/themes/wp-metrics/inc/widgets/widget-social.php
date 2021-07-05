<?php
/**
 * Social network widget
 *
 * @package WPMetrics
 * @since   WPMetrics 2.0
 */
class WPMetrics_Social_Widget extends WP_Widget
{
    /**
     * Constructor
     *
     * @return void
     **/
    function __construct()
    {
        parent::__construct(
            'cms_social', // Base ID
            esc_html__( 'CMS Social', 'wp-metrics' ), // Name
            array(
                'description' => esc_html__( 'Show icons with social profile urls. Go to Appearance/Menus create a menu and add to "social" location.', 'wp-metrics' ),
                'customize_selective_refresh' => true
            ) // Args
        );
    }

    /**
     * Outputs the HTML for this widget.
     *
     * @param array $args An array of standard parameters for widgets in this theme
     * @param array $instance An array of settings for this widget instance
     * @return void Echoes it's output
     **/
    function widget( $args, $instance )
    {
        $instance = wp_parse_args(
            (array) $instance,
            array(
                'title'     => '',
                'alignment' => 'text-inline',
                'spacing'   => 'spacing-default',
                'size'      => 'size-default'
            )
        );

        $title = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );

        $alignment = empty( $instance['alignment'] ) ? 'text-inline' : $instance['alignment'];
        $spacing = empty( $instance['spacing'] ) ? 'spacing-default' : $instance['spacing'];
        $size = empty( $instance['size'] ) ? 'size-default' : $instance['size'];

        $menu_classes = 'cms-social ' . $alignment . ' ' . $spacing . ' ' . $size;

        echo $args['before_widget'];

        if ( ! empty( $title ) )
        {
            echo $args['before_title'] . $title . $args['after_title'];
        }
        
        if ( has_nav_menu( 'social' ) )
        {
            $nav_menu_args = array(
                'theme_location' => 'social',
                'menu_class'     => $menu_classes,
                'container'      => '',
                'depth'          => 1,
                'link_before'    => '<span class="menu-icon"><i class="fa fa-link"></i></span><span class="screen-reader-text">',
                'link_after'     => '</span>',
            );

            wp_nav_menu( $nav_menu_args );
        }
        else
        {
            if ( is_user_logged_in() && current_user_can( 'edit_theme_options' ) )
            {
                printf(
                    '<div style="font-size:12px;">' . esc_html__( 'Social menu is not set, please %s and assign to "social" location.', 'wp-metrics' ) . '</div>',
                    '<a style="display:inline;" href="' . esc_url( admin_url( 'nav-menus.php' ) ) . '">' . esc_html__( 'Create Menu', 'wp-metrics' ) . '</a>'
                );
            }
        }

        echo $args['after_widget'];
    }

    /**
     * Deals with the settings when they are saved by the admin. Here is
     * where any validation should be dealt with.
     *
     * @param array $new_instance An array of new settings as submitted by the admin
     * @param array $old_instance An array of the previous settings
     * @return array The validated and (if necessary) amended settings
     **/
    function update( $new_instance, $old_instance )
    {
        $instance = $old_instance;
        $instance['title'] = strip_tags( $new_instance['title'] );
        $instance['alignment'] = strip_tags( $new_instance['alignment'] );
        $instance['spacing'] = strip_tags( $new_instance['spacing'] );
        $instance['size'] = strip_tags( $new_instance['size'] );

        return $instance;
    }

    /**
     * Displays the form for this widget on the Widgets page of the WP Admin area.
     *
     * @param array $instance An array of the current settings for this widget
     * @return void Echoes it's output
     **/
    function form( $instance )
    {
        $title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
        $alignment = isset( $instance['alignment'] ) ? esc_attr( $instance['alignment'] ) : '';
        $spacing = isset( $instance['spacing'] ) ? esc_attr( $instance['spacing'] ) : '';
        $size = isset( $instance['size'] ) ? esc_attr( $instance['size'] ) : '';
        ?>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'wp-metrics' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>

        <p><label for="<?php echo esc_attr( $this->get_field_id( 'alignment' ) ); ?>"><?php esc_html_e( 'Content Align:', 'wp-metrics' ); ?></label>
            <select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'alignment' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'alignment' ) ); ?>">
                <option value="text-left"   <?php selected( $alignment, 'text-left' ); ?>><?php esc_html_e( 'Left', 'wp-metrics' ); ?></option>
                <option value="text-center" <?php selected( $alignment, 'text-center' ); ?>><?php esc_html_e( 'Center', 'wp-metrics' ); ?></option>
                <option value="text-right"  <?php selected( $alignment, 'text-right' ); ?>><?php esc_html_e( 'Right', 'wp-metrics' ); ?></option>
            </select>
        </p>
        <p><label for="<?php echo esc_attr( $this->get_field_id( 'spacing' ) ); ?>"><?php esc_html_e( 'Spacing:', 'wp-metrics' ); ?></label>
            <select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'spacing' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'spacing' ) ); ?>">
                <option value="spacing-default"   <?php selected( $spacing, 'spacing-default' ); ?>><?php esc_html_e( 'Default', 'wp-metrics' ); ?></option>
                <option value="spacing-wide" <?php selected( $spacing, 'spacing-wide' ); ?>><?php esc_html_e( 'Wide', 'wp-metrics' ); ?></option>
                <option value="spacing-wider"  <?php selected( $spacing, 'spacing-wider' ); ?>><?php esc_html_e( 'Wider', 'wp-metrics' ); ?></option>
            </select>
        </p>
        <p><label for="<?php echo esc_attr( $this->get_field_id( 'size' ) ); ?>"><?php esc_html_e( 'Size:', 'wp-metrics' ); ?></label>
            <select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'size' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'size' ) ); ?>">
                <option value="size-default"   <?php selected( $size, 'size-default' ); ?>><?php esc_html_e( 'Default', 'wp-metrics' ); ?></option>
                <option value="size-medium" <?php selected( $size, 'size-medium' ); ?>><?php esc_html_e( 'Medium', 'wp-metrics' ); ?></option>
                <option value="size-big"  <?php selected( $size, 'size-big' ); ?>><?php esc_html_e( 'Big', 'wp-metrics' ); ?></option>
            </select>
        </p>
        <?php
    }
}

add_action( 'widgets_init', create_function( '', "register_widget( 'WPMetrics_Social_Widget' );" ) );