<?php defined( 'ABSPATH' ) or exit();
/**
 * Footer top 1 col layout with offset
 */
?>
<?php if ( is_active_sidebar( 'footer-top-smaller' ) ) : ?>
<div class="row">
    <div class="col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">
        <?php dynamic_sidebar( 'footer-top-smaller' ); ?>
    </div>
</div>
<?php endif; ?>
