<?php defined( 'ABSPATH' ) or exit(); ?>
<form method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <label>
        <span class="screen-reader-text"><?php esc_html_e( 'Search for:', 'wp-metrics'); ?></span>
        <input type="search" class="search-field" placeholder="<?php esc_attr_e( 'Type and hit enter...', 'wp-metrics' ); ?>" value="" name="s" title="<?php esc_attr_e( 'Search for:', 'wp-metrics'); ?>">
    </label>
    <button type="submit" class="search-submit"><i class="fa fa-search"></i></button>
</form>