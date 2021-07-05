<?php defined( 'ABSPATH' ) or exit();
/**
 * Footer bottom 1 col layout
 */
?>
<?php if ( is_active_sidebar( 'footer-bottom' ) ) : ?>
<div class="row">
    <div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3">
        <?php dynamic_sidebar( 'footer-bottom' ); ?>
    </div>
</div>
<?php endif; ?>