<?php defined( 'ABSPATH' ) or exit(); ?>
<article <?php post_class( 'entry-cms-case-study' ); ?>>
    <div class="entry-featured case-study-featured">
    <?php if ( has_post_thumbnail() ) : the_post_thumbnail( 'case-study-thumbnail' ); endif; ?>
        <div class="case-study-link-block">
            <a class="link-underline" href="<?php the_permalink(); ?>"><strong><?php esc_html_e( 'See Full Case Study', 'wp-metrics' ); ?></strong>&nbsp;&nbsp;<i class="fa fa-long-arrow-right"></i></a>
        </div>
    </div>
    <div class="case-study-content">
        <h3 class="entry-title case-study-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
        <div class="entry-content case-study-desc"><?php wpmetrics_get_the_excerpt( get_the_ID(), array( 'length' => 22 ) ); ?></div>
    </div>
</article>