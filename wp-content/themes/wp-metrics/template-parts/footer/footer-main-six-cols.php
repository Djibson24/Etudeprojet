<?php defined( 'ABSPATH' ) or exit();
/**
 * Footer main 6 cols layout
 * Col widths are: 1, 2, 2, 2, 2, 3
 */
?>
<?php if ( is_active_sidebar( 'footer-main-1' ) || is_active_sidebar( 'footer-main-2' ) || is_active_sidebar( 'footer-main-3' ) || 
            is_active_sidebar( 'footer-main-4' ) || is_active_sidebar( 'footer-main-5' ) || is_active_sidebar( 'footer-main-6' ) ) : ?>
<div class="row">
    <?php if ( is_active_sidebar( 'footer-main-1' ) ) : ?>
    <div class="footer-main-col col-sm-4 col-md-1">
        <?php dynamic_sidebar( 'footer-main-1' ); ?>
    </div>
    <?php endif; ?>
    <?php if ( is_active_sidebar( 'footer-main-2' ) ) : ?>
    <div class="footer-main-col col-sm-4 col-md-2">
        <?php dynamic_sidebar( 'footer-main-2' ); ?>
    </div>
    <?php endif; ?>
    <?php if ( is_active_sidebar( 'footer-main-3' ) ) : ?>
    <div class="footer-main-col col-sm-4 col-md-2">
        <?php dynamic_sidebar( 'footer-main-3' ); ?>
    </div>
    <?php endif; ?>
    <?php if ( is_active_sidebar( 'footer-main-4' ) ) : ?>
    <div class="footer-main-col col-sm-4 col-md-2">
        <?php dynamic_sidebar( 'footer-main-4' ); ?>
    </div>
    <?php endif; ?>
    <?php if ( is_active_sidebar( 'footer-main-5' ) ) : ?>
    <div class="footer-main-col col-sm-4 col-md-2">
        <?php dynamic_sidebar( 'footer-main-5' ); ?>
    </div>
    <?php endif; ?>
    <?php if ( is_active_sidebar( 'footer-main-6' ) ) : ?>
    <div class="footer-main-col col-sm-4 col-md-3">
        <?php dynamic_sidebar( 'footer-main-6' ); ?>
    </div>
    <?php endif; ?>
</div>
<?php endif; ?>