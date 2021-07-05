<?php defined( 'ABSPATH' ) or exit();

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );

$author_img = '';
$img_data = vc_map_integrate_parse_atts( $this->shortcode, 'vc_single_image', $atts, 'img_' );
if ( $img_data ) {
    $fancybox_image = visual_composer()->getShortCode( 'vc_single_image' );
    if ( is_object( $fancybox_image ) ) {
        $fancybox_image = $fancybox_image->render( array_filter( $img_data ) );
    }
}
if ( '' !== $fancybox_image ) {
    $author_img = $fancybox_image;
}
$css_class = 'cms-testimonial cms-testimonial-img-left-big';
$color_title = $color_icon = $color_text = $color_role = $color_bg = '';

$color_title = ( ! empty( $atts['color_title'] ) && wpmetrics_validate_color( $atts['color_title'] ) ) ? ' style="color:' . esc_attr( $atts['color_title'] ) . '"' : '';
$color_icon = ( ! empty( $atts['color_icon'] ) && wpmetrics_validate_color( $atts['color_icon'] ) ) ? ' style="color:' . esc_attr( $atts['color_icon'] ) . '"' : '';
$color_text = ( ! empty( $atts['color_text'] ) && wpmetrics_validate_color( $atts['color_text'] ) ) ? ' style="color:' . esc_attr( $atts['color_text'] ) . '"' : '';
$color_role = ( ! empty( $atts['color_role'] ) && wpmetrics_validate_color( $atts['color_role'] ) ) ? ' style="color:' . esc_attr( $atts['color_role'] ) . '"' : '';
$color_bg = ( ! empty( $atts['color_bg'] ) && wpmetrics_validate_color( $atts['color_bg'] ) ) ? ' style="color:' . esc_attr( $atts['color_bg'] ) . '"' : '';
?>
<div class="<?php echo esc_attr( $css_class ); ?>">
    <div class="testimonial-main"<?php echo $color_bg; ?>>
        <div class="testimonial-content">
            <div class="testimonial-icon testimonial-icon-before"<?php echo $color_icon; ?>><i class="fa fa-quote-left"></i></div>
            <div class="testimonial-text"<?php echo $color_text; ?>><?php echo $atts['testimonial']; ?></div>
            <div class="testimonial-icon testimonial-icon-after" <?php echo $color_icon; ?>><i class="fa fa-quote-right"></i></div>
        </div>
        <div class="testimonial-author-img<?php echo esc_attr( '' != $author_img ? ' has-thumbnail' : ' no-thumbnail' ); ?>">
            <?php echo $author_img; ?>
        </div>
    </div>
    <?php if ( ! empty( $atts['title'] ) || ! empty( $atts['role'] ) ) : ?>
    <div class="testimonial-info">
        <?php if ( ! empty( $atts['title'] ) ) : ?>
        <h5 class="testimonial-author"<?php echo $color_title; ?>><?php echo $atts['title']; ?></h5>
        <?php endif; ?>
        <?php if ( ! empty( $atts['role'] ) ) : ?>
        <div class="testimonial-roles"<?php echo $color_role; ?>><?php echo $atts['role']; ?></div>
        <?php endif; ?>
    </div>
    <?php endif; ?>
</div>
