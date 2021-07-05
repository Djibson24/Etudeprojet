<?php

function ef3_clear_tmp(){
    ef3_crop_images();
    $upload_dir = wp_upload_dir();

    ef3_delete_directory($upload_dir['basedir'] . '/attachment-tmp');
    ef3_delete_directory($upload_dir['basedir'] . '/ef3_demo');
}

function ef3_delete_directory($dir)
{
    if (!file_exists($dir)) {
        return true;
    }
    if (!is_dir($dir) || is_link($dir)) {
        return unlink($dir);
    }
    foreach (scandir($dir) as $item) {
        if ($item == '.' || $item == '..') {
            continue;
        }
        if (!ef3_delete_directory($dir . "/" . $item, false)) {
            chmod($dir . "/" . $item, 0777);
            if (!ef3_delete_directory($dir . "/" . $item, false)) return false;
        };
    }
    return rmdir($dir);
}
function ef3_crop_images() {

    /**
     * Crop image
     */
    $query = array(
        'post_type'      => 'attachment',
        'posts_per_page' => - 1,
        'post_status'    => 'inherit',
    );

    $media = new WP_Query( $query );
    if ( $media->have_posts() ) {
        foreach ( $media->posts as $image ) {
            if ( strpos( $image->post_mime_type, 'image/' ) !== false ) {
                $image_path = get_attached_file( $image->ID );
                $metadata   = wp_generate_attachment_metadata( $image->ID, $image_path );
                wp_update_attachment_metadata( $image->ID, $metadata );
            }
        }
    }
}