<?php defined( 'ABSPATH' ) or exit();
/**
 * Footer bottom 2 cols layout
 */
?>
<?php if ( is_active_sidebar( 'footer-bottom-left' ) || is_active_sidebar( 'footer-bottom-right' ) ) : ?>
<div class="row">
    <?php if ( is_active_sidebar( 'footer-bottom-left' ) ) : ?>
    <div class="col-md-6 footer-bot-left">
        <?php dynamic_sidebar( 'footer-bottom-left' ); ?>
    </div>
    <?php endif; ?>
    <?php if ( is_active_sidebar( 'footer-bottom-right' ) ) : ?>
    <div class="col-md-6 footer-bot-right">
        <?php dynamic_sidebar( 'footer-bottom-right' ); ?>
    </div>
    <?php endif; ?>
</div>
<?php endif; ?>