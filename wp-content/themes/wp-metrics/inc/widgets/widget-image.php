<?php defined( 'ABSPATH' ) or exit();
/**
 * Simple Image Widget
 * This widget allows you to pick image and show at the front-end with some options
 *
 * @author Stev Ngo <http://stevngodesign.com/>
 * @version 1.0
 */

class WPMetrics_Image_Widget extends WP_Widget {
    /**
     * Constructor
     *
     * @return void
     **/
    function __construct() {
        parent::__construct(
            'cms_image', // Base ID
            esc_html__( 'CMS Image', 'wp-metrics' ), // Name
            array(
                'description' => esc_html__( 'Add image with some options and optional link.', 'wp-metrics' ),
                'customize_selective_refresh' => true
            ) // Args
        );
        add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts') );
    }

    /**
     * Enqueue admin scripts and styles
     *
     * @return void
     */
    function admin_scripts() {
        wp_enqueue_style( 'wp-metrics-widgets', get_template_directory_uri() . '/inc/assets/css/widgets.css' );
        wp_enqueue_media();
        wp_enqueue_script( 'wp-metrics-widgets', get_template_directory_uri() . '/inc/assets/js/widgets.js', array( 'jquery', 'media-upload' ), '', true );
    }

    /**
     * Outputs the HTML for this widget.
     *
     * @param array  An array of standard parameters for widgets in this theme
     * @param array  An array of settings for this widget instance
     * @return void Echoes it's output
     **/
    function widget( $args, $instance )
    {
        extract( $args, EXTR_SKIP );
        
        $instance = wp_parse_args(
            (array) $instance,
            array(
                'title' => '',
                'image' => '',
                'link' => '',
                'align' => '',
                'target' => '',
                'size' => 'thumbnail',
                'desc' => ''
            )
        );

        if ( ! empty( $instance['title'] ) ) {
            $title = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );
        }
        else {
            $title = '';
        }

        echo $before_widget;

        if ( ! empty( $title ) )
        {
            echo $before_title . $title . $after_title;
        }
        $size = empty( $instance['size'] ) ? 'thumbnail' : strval( $instance['size'] );

        if ( ! empty( $instance['image'] ) ) {
            $image = ( is_numeric( $instance['image'] ) && $instance['image'] > 0 ) ? intval( $instance['image'] ) : 0;
            if ( $image > 0 ) {
                echo '<div class="image';
                if ( ! empty( $instance['align'] ) ) {
                    echo ' text-' . esc_attr( $instance['align'] );
                }
                echo '">';
                if ( ! empty( $instance['link'] ) ) {
                    $target = ( '' === $instance['target'] ) ? '_self' : '_blank';
                    echo '<a href="' . esc_url( $instance['link'] ) . '" target="' . esc_attr( $target ) . '">';
                }
                $alt = get_post_meta( $image, '_wp_attachment_image_alt', true );
                $alt = empty( $alt ) ? '' : strval( $alt );
                $image_src = wp_get_attachment_image_src( $image, $size );
                
                if ( $image_src ) {
                    echo '<img src="' . esc_url( $image_src[0] ) . '" alt="' . esc_attr( $alt ) . '"/>';
                }
                if ( ! empty( $instance['link'] ) ) {
                    echo '</a>';
                }
                echo '</div>';
            }
        }
        if ( ! empty( $instance['desc'] ) ) {
            printf(
                '<div class="image-description %1$s">%2$s</div>',
                ( empty( $instance['align'] ) ? '' : 'text-' . esc_attr( $instance['align'] ) ),
                wpautop( $instance['desc'] )
            );
        }
        echo $after_widget;
    }

    /**
     * Deals with the settings when they are saved by the admin. Here is
     * where any validation should be dealt with.
     *
     * @param array  An array of new settings as submitted by the admin
     * @param array  An array of the previous settings
     * @return array The validated and (if necessary) amended settings
     **/
    function update( $new_instance, $old_instance ) {

        $instance = $old_instance;
        $instance['title'] = strip_tags( $new_instance['title'] );
        $instance['image'] = strip_tags( $new_instance['image'] );
        $instance['link'] = esc_url( strip_tags( $new_instance['link'] ) );
        $instance['align'] = strip_tags( $new_instance['align'] );
        $instance['size'] = strip_tags( $new_instance['size'] );
        $instance['target'] = strip_tags( $new_instance['target'] );
        $instance['desc'] = esc_textarea( $new_instance['desc'] );

        return $instance;
    }

    /**
     * Displays the form for this widget on the Widgets page of the WP Admin area.
     *
     * @param array  An array of the current settings for this widget
     * @return void Echoes it's output
     **/
    function form( $instance ) {
        $instance = wp_parse_args(
            (array) $instance,
            array(
                'title' => '',
                'image' => 0,
                'link' => '',
                'align' => '',
                'target' => '',
                'size' => 'thumbnail',
                'desc' => ''
            )
        );

        $this_id    = $this->get_field_id( '' );
        $title      = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
        $image      = intval( $instance['image'] );
        ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'wp-metrics' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'align' ) ); ?>"><?php esc_html_e( 'Align:', 'wp-metrics' ); ?></label>
            <select class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'align' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'align' ) ); ?>">
                <option value=""><?php esc_html_e( 'Default', 'wp-metrics' ); ?></option>
                <option value="left" <?php selected( "left", $instance['align'] ); ?>><?php esc_html_e( 'Left', 'wp-metrics' ); ?></option>
                <option value="center" <?php selected( "center", $instance['align'] ); ?>><?php esc_html_e( 'Center', 'wp-metrics' ); ?></option>
                <option value="right" <?php selected( "right", $instance['align'] ); ?>><?php esc_html_e( 'Right', 'wp-metrics' ); ?></option>
            </select>
        </p>
        <div class="wp-metrics-widget-image" id="<?php echo esc_attr( $this_id ); ?>">
            <label><?php esc_html_e( 'Image', 'wp-metrics' ); ?></label>
            <ul class="image"><?php
                $attachment_image = wp_get_attachment_image_src( $image, 'thumbnail' );
                if ( ! empty( $attachment_image ) ) {
                    echo '<li data-id="' . esc_attr( $image ) . '"'. 
                        ' style="background-image:url(' . esc_url( $attachment_image[0] ) . ');">';
                    echo '<a class="image-edit" href="#" onclick="WPMetricsImageWidget.edit_image(event,\'' . esc_attr( $this_id ) . '\',' . esc_attr( $image ) . ')">' .
                            '<i class="dashicons dashicons-edit"></i>' .
                        '</a>';
                    echo '<a class="image-delete" href="#" onclick="WPMetricsImageWidget.remove_image(event,\'' . esc_attr( $this_id ) . '\',' . esc_attr( $image ) . ');return false;">' .
                            '<i class="dashicons dashicons-trash"></i>' .
                        '</a>';
                    echo '</li>';
                }
            echo '<li data-id="0">';
            echo '<a class="image-add" href="#" onclick="WPMetricsImageWidget.add_image(event,\'' . esc_attr( $this_id ) . '\');">' .
                    '<i class="dashicons dashicons-plus-alt"></i>' .
                '</a>';
            echo '</li>';
            ?></ul>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'size' ) ); ?>"><?php esc_html_e( 'Image Size:', 'wp-metrics' ); ?></label>
                <select class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'size' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'size' ) ); ?>">
                    <?php
                        $image_sizes = apply_filters( 'image_size_names_choose', array(
                            'thumbnail' => esc_html__( 'Thumbnail', 'wp-metrics' ),
                            'medium'    => esc_html__( 'Medium', 'wp-metrics' ),
                            'large'     => esc_html__( 'Large', 'wp-metrics' ),
                            'full'      => esc_html__( 'Full Size', 'wp-metrics' )
                        ) );
                        foreach ( $image_sizes as $size => $text )
                        {
                            printf(
                                '<option value="%1$s" %2$s">%3$s</option>',
                                esc_attr( $size ),
                                selected( $size, $instance['size'], false ),
                                esc_html( $text )
                            );
                        }
                    ?>
                </select>
            </p>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'link' ) ); ?>"><?php echo esc_html__( 'Link', 'wp-metrics' ); ?></label>
                <input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link' ) ); ?>" value="<?php echo esc_url( $instance['link'] ); ?>" />

            <p class="howto"><?php echo esc_html__( 'Add link for image', 'wp-metrics' ); ?></p>
            <input type="hidden" name="<?php echo $this->get_field_name( 'image' ); ?>" id="<?php echo $this->get_field_id( 'image' ); ?>" value="<?php echo esc_attr( $instance['image'] ); ?>"/>
        </div>
        <p>
            <input id="<?php echo esc_attr( $this->get_field_id( 'target' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'target' ) ); ?>" type="checkbox" value="1" <?php checked( "1", $instance['target'] );  ?>/><label for="<?php echo esc_attr( $this->get_field_id( 'target' ) ); ?>"><?php esc_html_e( 'Open link in new tab?', 'wp-metrics' ); ?></label>
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'desc' ) ); ?>"><?php echo esc_html__( 'Description', 'wp-metrics' ); ?></label>
            <textarea class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'desc' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'desc' ) ); ?>" rows="4"><?php echo esc_textarea( $instance['desc'] ); ?></textarea>
        </p>
        <?php
    }
}

add_action( 'widgets_init', create_function( '', "register_widget( 'WPMetrics_Image_Widget' );" ) );