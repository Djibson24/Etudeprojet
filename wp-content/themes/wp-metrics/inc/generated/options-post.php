<?php defined( 'ABSPATH' ) or exit();
/**
 * @see  Metrics_Meta_Options::post_options()
 */
?>
<div id="cms_post_options" class="cms-metabox"><?php
    // Post sidebar field
    $this->render_field( array(
        'id' => 'post_single_sidebar',
        'type' => 'button_group',
        'title' => esc_html__( 'Sidebar position', 'wp-metrics' ),
        'options' => array(
            '' => esc_html__( 'Default', 'wp-metrics' ),
            'left' => esc_html__( 'Left', 'wp-metrics' ),
            'right' => esc_html__( 'Right', 'wp-metrics' ),
            'no' => esc_html__( 'Disable', 'wp-metrics' )
        )
    ), $post->ID );
?></div>