<?php
/**
 * The template for displaying 404 pages (not found).
 * 
 * @package WPMetrics
 */

get_header();
?>
<div id="content" class="site-content">
	<div class="container">
		<div id="primary" class="content-area">
			<main id="main" class="site-main">
				<section class="error-404 not-found">
					<div class="page-content text-center">
						<h2 class="error-404-text"><?php esc_html_e( '404', 'wp-metrics' ); ?><span class="shadow"><?php esc_html_e( '404', 'wp-metrics' ); ?></span></h2>
						<p class="error-404-desc"><strong><?php esc_html_e( 'We are sorry, the page you want isn\'t here anymore. May be one of the links below can help !', 'wp-metrics' ); ?></strong></p>
						<div class="error-404-actions"><a class="btn btn-filled" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Homepage', 'wp-metrics' );?></a><a class="btn" href="#"><?php esc_html_e( 'Site map', 'wp-metrics' );?></a></div>
					</div><!-- .page-content -->
				</section><!-- .error-404 -->

			</main><!-- #main -->
		</div><!-- #primary -->
	</div>
</div>
<?php
get_footer();
