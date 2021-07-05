<?php defined( 'ABSPATH' ) or exit();

class WPMetrics_Recent_Posts_Widget extends WP_Widget {

    /**
     * Cunstruct
     */
    function __construct() {
        parent::__construct(
             'cms_recent_posts', // Base ID
            esc_html__( 'CMS Recent Posts', 'wp-metrics' ), // Name
            array( 'description' => esc_html__( 'Attractive recent posts widget.', 'wp-metrics' ) ) // Args
        );
    }

    /**
     * Outputs the HTML for this widget.
     *
     * @param   array   An array of standard parameters for widgets in this theme
     * @param   array   An array of settings for this widget instance
     * @return  void    Echoes it's output
     **/
    function widget( $args, $instance ) {
        extract( $args );

        if ( ! empty( $instance['title'] ) ) {
            $title = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );
        }

        $query_args = array(
            'posts_per_page'    => (int)$instance['number'],
            'post_type'         => 'post',
            'post_status'       => 'publish',
            'orderby'           => 'date',
            'order'             => 'DESC',
            'paged'             => 1
        );

        if ( '1' != $instance['show_sticky'] ) {
            $query_args['post__not_in'] = get_option( 'sticky_posts' );
        }

        $wp_query = new WP_Query( $query_args );

        echo wp_kses_post( $before_widget );

        if ( isset( $title ) ) {
            echo wp_kses_post( $before_title . $title . $after_title );
        }
        
        if ( $wp_query->have_posts() ) : ?>
            <ul class="cms-recent-posts-list">
            <?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
                <?php $ext_class = has_post_thumbnail() ? "has-thumbnail" : ''; ?>
                <li<?php echo( empty( $ext_class ) ? '' : ' class="' . esc_attr( $ext_class ) . '"' ); ?>>
                    <?php if ( ! empty( $ext_class ) ) : ?>
                    <div class="entry-thumbnail"><?php the_post_thumbnail( 'thumbnail' ); ?></div>
                    <?php endif; ?>
                    <div class="entry-content<?php echo( empty( $ext_class ) ? '' : ' ' . esc_attr( $ext_class ) . '' ); ?>">
                        <?php if ( '1' == $instance['show_date'] || '1' == $instance['show_category'] ) : ?>
                        <div class="entry-meta">
                            <ul class="entry-meta"><?php
                                if ( '1' == $instance['show_date'] ) :
                                    printf( '<li class="entry-date"><time datetime="%1$s">%2$s</time></li>', get_the_date( 'c' ), get_the_date( 'M d, Y' ) );
                                endif;
                                if ( '1' == $instance['show_category'] ) :
                                    $categories_list = get_the_category_list( ', ' );
                                    if ( $categories_list ) {
                                        printf( '<li class="cat-links">%1$s</li>', $categories_list ); // WPCS: XSS OK.
                                    }
                                endif;
                            ?></ul>
                        </div>
                        <?php endif; ?>
                        <h5 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                        <?php if ( '1' == $instance['show_author'] ) : ?>
                            <div class="entry-footer"><?php
                                printf( '<div class="entry-byline">%1$s<a href="%2$s">%3$s</a></div>',
                                    esc_html( 'By: ', 'wp-metrics' ),
                                    esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
                                    esc_html( get_the_author() )
                                );
                            ?></div>
                        <?php endif; ?>
                    </div>
                </li>
            <?php endwhile; ?>
            </ul>
            <?php
        else :
            esc_html_e( 'No posts found', 'wp-metrics' );
        endif;

        echo wp_kses_post( $after_widget );
        wp_reset_postdata();
    }


    /**
     * Deals with the settings when they are saved by the admin. Here is
     * where any validation should be dealt with.
     *
     * @param   array   An array of new settings as submitted by the admin
     * @param   array   An array of the previous settings
     * @return  array   The validated and (if necessary) amended settings
     **/
    function update( $new_instance, $old_instance ) {

        $instance = $old_instance;

        $instance['title']          = strip_tags( $new_instance['title'] );
        $instance['show_date']      = $new_instance['show_date'];
        $instance['show_category']  = $new_instance['show_category'];
        $instance['show_sticky']    = $new_instance['show_sticky'];
        $instance['show_author']    = $new_instance['show_author'];
        $instance['number']         = ( is_numeric( $new_instance['number'] ) && $new_instance['number'] > 0 ) ? $new_instance['number'] : '5';

        return $instance;
    }


    /**
     * Displays the form for this widget on the Widgets page of the WP Admin area.
     *
     * @param   array   An array of the current settings for this widget
     * @return  void    Echoes it's output
     */
    function form( $instance ) {
        $title          = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
        $show_date      = isset( $instance['show_date'] ) ? esc_attr( $instance['show_date'] ) : '';
        $show_category  = isset( $instance['show_category'] ) ? esc_attr( $instance['show_category'] ) : '';
        $show_author    = isset( $instance['show_author'] ) ? esc_attr( $instance['show_author'] ) : '';
        $show_sticky    = isset( $instance['show_sticky'] ) ? esc_attr( $instance['show_sticky'] ) : '';
        $number         = ( isset( $instance['number'] ) && is_numeric( $instance['number'] ) && (int)$instance['number'] > 0 ) ? $instance['number'] : '5';
        ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'wp-metrics' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <p>
            <input type="checkbox" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'show_date' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_date' ) ); ?>" <?php checked( '1', $show_date ); ?> value='1'/>
            <label for="<?php echo esc_attr( $this->get_field_id( 'show_date' ) ); ?>"><?php esc_html_e( 'Show date', 'wp-metrics' ); ?></label>
        </p>
        <p>
            <input type="checkbox" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'show_category' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_category' ) ); ?>" <?php checked( '1', $show_category ); ?> value='1'/>
            <label for="<?php echo esc_attr( $this->get_field_id( 'show_category' ) ); ?>"><?php esc_html_e( 'Show categories', 'wp-metrics' ); ?></label>
        </p>
        <p>
            <input type="checkbox" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'show_author' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_author' ) ); ?>" <?php checked( '1', $show_author ); ?> value='1'/>
            <label for="<?php echo esc_attr( $this->get_field_id( 'show_author' ) ); ?>"><?php esc_html_e( 'Show author', 'wp-metrics' ); ?></label>
        </p>
        <p>
            <input type="checkbox" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'show_sticky' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_sticky' ) ); ?>" <?php checked( '1', $show_sticky ); ?> value='1'/>
            <label for="<?php echo esc_attr( $this->get_field_id( 'show_sticky' ) ); ?>"><?php esc_html_e( 'Show sticky', 'wp-metrics' ); ?></label>
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php esc_html_e( 'Number of posts to show:', 'wp-metrics' ); ?></label>
            <input id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" size="3" />
        </p>
        <?php
    }
}


add_action( 'widgets_init', create_function( '', "register_widget( 'WPMetrics_Recent_Posts_Widget' );" ) );