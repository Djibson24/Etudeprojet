<?php defined( 'ABSPATH' ) or exit();

$flayout = false;
$ftop_html = $fmain_html = $fbot_html = $ftop_part = $fmain_part = $fbot_part = '';
$fclasses = "site-footer";
$ftop_classes = 'site-footer-top';
$fmain_classes = 'site-footer-main';
$fbot_classes = 'site-footer-bottom';

if ( is_singular() && wpmetrics_get_post_meta( get_the_ID(), '_cms_custom_footer' ) ) {
    $flayout = wpmetrics_get_post_meta( get_the_ID(), '_cms_footer_layout' );
}

$flayout = $flayout ? $flayout : wpmetrics_get_theme_option( 'footer_layout', '1' );

switch ( $flayout ) {
    case '2':
        $fclasses .= ' footer-with-top-full';
        $fmain_classes .= ' footer-main-5-cols';
        $ftop_part = 'one-col';
        $fmain_part = 'five-cols';
        $fbot_part = 'two-cols';
        break;

    case '3':
        $fclasses .= ' footer-without-top';
        $fmain_classes .= ' footer-main-6-cols';
        $fmain_part = 'six-cols';
        $fbot_part = 'two-cols';
        break;

    case '4':
        $fclasses .= ' footer-without-top';
        $fmain_classes .= ' footer-main-5-cols';
        $fmain_part = 'five-cols';
        $fbot_part = 'two-cols';
        break;

    case '5':
        $fclasses .= ' footer-with-top-2-cols';
        $ftop_part = 'two-cols';
        $fbot_part = 'two-cols';
        break;

    case '6':
        $fclasses .= ' footer-with-top-1-col';
        $ftop_part = 'one-col';
        $fbot_part = 'two-cols';
        break;

    case '7':
        $fclasses .= ' footer-with-top-1-col';
        $ftop_part = 'one-col';
        $fbot_part = 'two-cols';
        break;

    case '8':
        $fbot_part = 'two-cols';
        break;

    case '9':
        $fclasses .= ' footer-with-top-full';
        $fmain_classes .= ' footer-main-5-cols';
        $ftop_part = 'one-col';
        $fmain_part = 'five-cols';
        $fbot_part = 'two-cols';
        break;

    case '10':
        $fclasses .= ' footer-with-bot-col-1 footer-with-bot-center';
        $fbot_classes .= ' footer-bot-center';
        $fbot_part = 'one-col';
        break;

    case '11':
        $fclasses .= ' footer-with-bot-col-1 footer-with-bot-center';
        $fbot_classes .= ' footer-bot-center';
        $fbot_part = 'one-col';
        break;

    // Default to 1
    default:
        $fclasses .= ' footer-with-top-full';
        $fmain_classes .= ' footer-main-6-cols';
        $ftop_part = 'one-col';
        $fmain_part = 'six-cols';
        $fbot_part = 'two-cols';
        break;
}

$fclasses .= ' footer-layout-' . $flayout;
?>
<footer id="colophon" class="<?php echo esc_attr( $fclasses ); ?>">
    <?php if ( ! empty( $ftop_part ) ) : ?>
    <div class="<?php echo esc_attr( $ftop_classes ); ?>">
        <div class="container">
            <div class="footer-top-inner">
            <?php get_template_part( 'template-parts/footer/footer-top', $ftop_part ); ?>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <?php if( '' != $fmain_part ) : ?>
    <div class="<?php echo esc_attr( $fmain_classes ); ?>">
        <div class="container">
            <div class="footer-main-inner">
            <?php get_template_part( 'template-parts/footer/footer-main', $fmain_part ); ?>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <?php if( '' != $fbot_part ) : ?>
    <div class="<?php echo esc_attr( $fbot_classes ); ?>">
        <div class="container">
            <div class="footer-bot-inner">
            <?php get_template_part( 'template-parts/footer/footer-bottom', $fbot_part ); ?>
            </div>
        </div>
    </div>
    <?php endif; ?>
</footer><!-- #colophon -->