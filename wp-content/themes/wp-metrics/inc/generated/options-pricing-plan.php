<?php defined( 'ABSPATH' ) or exit();
/**
 * @see  Metrics_Meta_Options::page_options()
 */
?>
<div id="cms_pricing_plan_options" class="cms-metabox">
<?php
    $this->render_field( array(
        'id' => 'title',
        'type' => 'textfield',
        'title' => esc_html__( 'Title', 'wp-metrics' ),
        'desc' => esc_html__( 'For easy management for plans, this title will be used as plan title, and you can make unique default title to seperate with other plans. ( eg: Starter Plan - Year, Starter Plan - Month, while those two plans have same plan title, just time is different', 'wp-metrics' )
    ), $post->ID );
    $this->render_field( array(
        'id' => 'description',
        'type' => 'textarea',
        'title' => esc_html__( 'Description', 'wp-metrics' ),
        'desc' => sprintf( esc_html__( 'Allowed html tags: %s', 'wp-metrics' ), 'a, b, i, u, em, strong, br, span' ),
        'allowed_html' => array(
            'a' => array(
                'href' => array(),
                'class' => array(),
                'title' => array(),
                'target' => array()
            ),
            'b' => array(),
            'i' => array(),
            'u' => array(),
            'em' => array(),
            'br' => array(),
            'strong' => array(),
            'span' => array(
                'class' => array()
            ),
        ),
    ), $post->ID );

    $this->render_field( array(
        'id' => 'price',
        'type' => 'textfield',
        'title' => esc_html__( 'Price', 'wp-metrics' )
    ), $post->ID );

    $this->render_field( array(
        'id' => 'currency',
        'type' => 'textfield',
        'title' => esc_html__( 'Currency', 'wp-metrics' )
    ), $post->ID );

    $this->render_field( array(
        'id' => 'time',
        'type' => 'textfield',
        'title' => esc_html__( 'Time Period', 'wp-metrics' ),
        'placeholder' => esc_html__( 'Daily, Monthly, Yearly, etc.', 'wp-metrics' )
    ), $post->ID );

    $this->render_field( array(
        'id' => 'button_text',
        'type' => 'textfield',
        'title' => esc_html__( 'Button Text', 'wp-metrics' )
    ), $post->ID );

    $this->render_field( array(
        'id' => 'button_link',
        'type' => 'textfield',
        'title' => esc_html__( 'Button Link', 'wp-metrics' )
    ), $post->ID );

    $this->render_field( array(
        'id' => 'button_style',
        'type' => 'select',
        'title' => esc_html__( 'Button Style', 'wp-metrics' ),
        'options'   => array(
            '' => esc_html( 'Default', 'wp-metrics' ),
            'btn-filled' => esc_html( 'Filled', 'wp-metrics' ),
            'btn-primary' => esc_html( 'Primary', 'wp-metrics' ),
            'btn-primary btn-filled' => esc_html( 'Primary Filled', 'wp-metrics' )
        )
    ), $post->ID );

    $this->render_field( array(
        'id' => 'button_hover',
        'type' => 'select',
        'title' => esc_html( 'Button hover style', 'wp-metrics' ),
        'options' => array(
            '' => esc_html( 'Default', 'wp-metrics' ),
            'btn-hover-primary' => esc_html( 'Primary', 'wp-metrics' ),
            'btn-hover-dark' => esc_html( 'Dark', 'wp-metrics' ),
            'btn-hover-white' => esc_html( 'White', 'wp-metrics' )
        )
    ), $post->ID ); 
    ?>
</div><!-- #cms_page_options -->
