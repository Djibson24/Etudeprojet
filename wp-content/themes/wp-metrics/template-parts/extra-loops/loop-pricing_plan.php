<?php defined( 'ABSPATH' ) or exit();
$pricing_plan_data = array();
$pricing_plan_data['title'] = wpmetrics_get_post_meta( get_the_ID(), '_cms_title' );
$pricing_plan_data['description'] = wpmetrics_get_post_meta( get_the_ID(), '_cms_description' );
$pricing_plan_data['price'] = wpmetrics_get_post_meta( get_the_ID(), '_cms_price' );
$pricing_plan_data['currency'] = wpmetrics_get_post_meta( get_the_ID(), '_cms_currency' );
$pricing_plan_data['time'] = wpmetrics_get_post_meta( get_the_ID(), '_cms_time' );
$pricing_plan_data['button_text'] = wpmetrics_get_post_meta( get_the_ID(), '_cms_button_text' );
$pricing_plan_data['button_link'] = wpmetrics_get_post_meta( get_the_ID(), '_cms_button_link' );

$button_class = array();

$pricing_plan_data['button_style'] = get_post_meta( get_the_ID(), '_cms_button_style', true );
$button_class[] = $pricing_plan_data['button_style'] ? $pricing_plan_data['button_style'] : 'btn-default';

$pricing_plan_data['button_hover'] = get_post_meta( get_the_ID(), '_cms_button_hover', true );
if ( $pricing_plan_data['button_hover'] ) {
    $button_class[] = $pricing_plan_data['button_hover'];
}

$button_class = implode( ' ', $button_class );
?>
<article <?php post_class( 'entry-pricing-plans' ); ?>>
    <header class="entry-header"><?php
        if ( $pricing_plan_data['title'] ) : ?>
        <h3 class="entry-title"><span><?php echo esc_html( $pricing_plan_data['title'] ); ?></span></h3><?php
        else : the_title( '<h3 class="entry-title"><span>', '</span></h3>' );
        endif;

        if ( $pricing_plan_data['price'] || $pricing_plan_data['currency'] || $pricing_plan_data['time'] ) :
        ?><h2 class="entry-pricing">
            <?php if ( $pricing_plan_data['currency'] ) : ?>
            <span class="entry-currency"><?php echo esc_html( $pricing_plan_data['currency'] ); ?></span>
            <?php endif; ?>
            <?php if ( $pricing_plan_data['price'] ) : ?>
            <span class="entry-price"><?php echo esc_html( $pricing_plan_data['price'] ); ?></span>
            <?php endif; ?>
            <?php if ( $pricing_plan_data['time'] ) : ?>
            <span class="entry-time"><?php echo esc_html( $pricing_plan_data['time'] ); ?></span>
            <?php endif;
        ?></h2><?php
        endif;
    ?></header><!-- .entry-header -->
    <?php if ( $pricing_plan_data['description'] || ( '' != get_the_content() ) ) : ?>
    <div class="entry-content">
        <?php if ( $pricing_plan_data['description'] ) : ?>
            <div class="entry-description font-alt-1">
                <span class="entry-desc-before"></span>
                <div class="entry-desc-content"><?php echo wpautop( urldecode( $pricing_plan_data['description'] ) ); ?></div>
                <span class="entry-desc-after"></span>
            </div>
        <?php endif; ?>
        <?php if ( '' != get_the_content() ) : ?>
        <div class="entry-features">
            <?php the_content(); ?>
        </div>
        <?php endif; ?>
    </div><!-- .entry-content -->
    <?php endif; ?>
    <?php if ( $pricing_plan_data['button_text'] && $pricing_plan_data['button_link'] ) : ?>
    <footer class="entry-footer">
        <div class="entry-footer-inner">
            <a class="btn <?php echo esc_attr( $button_class ); ?> btn-block"
                href="<?php echo esc_url( $pricing_plan_data['button_link'] ) ?>"><?php
                echo esc_html( $pricing_plan_data['button_text'] );
                echo '<i class="pricing-action-icon fa fa-long-arrow-right"></i>';
            ?></a>
        </div>
    </footer><!-- .entry-footer -->
    <?php endif; ?>
</article><!-- #post-## -->