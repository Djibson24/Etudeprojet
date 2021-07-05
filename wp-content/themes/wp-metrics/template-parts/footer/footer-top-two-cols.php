<?php defined( 'ABSPATH' ) or exit();
/**
 * Footer top 2 cols layout
 */
?>
<?php if ( is_active_sidebar( 'footer-top-1' ) || is_active_sidebar( 'footer-top-2' ) ) : ?>
<div class="row">
    <?php if ( is_active_sidebar( 'footer-top-1' ) ) : ?>
    <div class="col-sm-6 col-md-5 col-lg-4">
        <?php dynamic_sidebar( 'footer-top-1' ); ?>
    </div>
    <?php endif; ?>
    <?php if ( is_active_sidebar( 'footer-top-2' ) ) : ?>
    <div class="col-sm-6 col-md-7 col-lg-8">
        <?php dynamic_sidebar( 'footer-top-2' ); ?>
    </div>
    <?php endif; ?>
</div>
<?php endif; ?>