<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 * 
 * @package WPMetrics
 */
get_template_part( 'template-parts/helper', 'footer' );

$totop_btn = wpmetrics_get_theme_option( 'back_to_top_on', '1' );

if ( $totop_btn )
{
    printf(
        '<a id="backtotop" class="back-to-top" href="javascript:void(0);"><span class="screen-reader-text">%s</span><i class="fa fa-angle-up"></i></a>',
        esc_html__( 'Back to top', 'wp-metrics' )
    );
}
?>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
