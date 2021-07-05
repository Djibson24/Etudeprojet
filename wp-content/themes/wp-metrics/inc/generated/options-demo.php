<?php defined( 'ABSPATH' ) or exit();
/**
 * @see  Metrics_Meta_Options::post_options()
 */
?>
<div id="cms_demo_options" class="cms-metabox"><?php
    // Post sidebar field
    $this->render_field( array(
        'id' => 'demo_url',
        'type' => 'textfield',
        'title' => esc_html__( 'URL', 'wp-metrics' )
    ), $post->ID );
?></div>