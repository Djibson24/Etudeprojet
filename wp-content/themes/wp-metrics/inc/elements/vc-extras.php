<?php

/**
 * Filter some vc shortcodes css classes
 * @param  string $classes
 * @param  array  $settings_base
 * @param  array $atts          [description]
 * @return string
 */
function wpmetrics_vc_shortcode_css_class( $classes, $settings_base, $atts )
{
    $classes_arr = explode( ' ', $classes );

    if ( 'vc_tta_accordion' == $settings_base )
    {
        $classes_to_replace = array(
            'vc_tta-style-classic',
            'vc_tta-style-modern',
            'vc_tta-style-flat',
            'vc_tta-style-outline'
        );

        $classes_arr[] = 'cms-vc-tta cms-vc-tta-accordion';

        foreach ( $classes_to_replace as $class_to_replace )
        {
            $key = array_search( $class_to_replace, $classes_arr );

            if ( false !== $key )
            {
                unset( $classes_arr[ $key ] );
            }
        }
    }

    if ( 'vc_tta_tabs' == $settings_base )
    {
        $classes_to_replace = array(
            'vc_tta-style-classic',
            'vc_tta-style-modern',
            'vc_tta-style-flat',
            'vc_tta-style-outline'
        );

        $classes_arr[] = 'cms-vc-tta cms-vc-tta-tabs';

        foreach ( $classes_to_replace as $class_to_replace )
        {
            $key = array_search( $class_to_replace, $classes_arr );

            if ( false !== $key )
            {
                unset( $classes_arr[ $key ] );
            }
        }
    }

    if ( 'vc_tta_tour' == $settings_base )
    {
        $classes_to_replace = array(
            'vc_tta-style-classic',
            'vc_tta-style-modern',
            'vc_tta-style-flat',
            'vc_tta-style-outline'
        );

        $classes_arr[] = 'cms-vc-tta cms-vc-tta-tour';

        foreach ( $classes_to_replace as $class_to_replace )
        {
            $key = array_search( $class_to_replace, $classes_arr );

            if ( false !== $key )
            {
                unset( $classes_arr[ $key ] );
            }
        }
    }

    if ( 'vc_section' == $settings_base )
    {
        if ( $atts['overlay'] )
        {
            $classes_arr[] = 'section-has-overlay';
        }
    }

    if ( 'vc_row' == $settings_base || 'vc_row_inner' == $settings_base )
    {
        if ( $atts['overlay'] )
        {
            $classes_arr[] = 'row-has-overlay';
        }
    }

    if ( 'vc_column' == $settings_base || 'vc_column_inner' == $settings_base )
    {
        if ( $atts['fill_place'] )
        {
            $classes_arr[] = 'column-fill-place';
        }
    }

    return implode( ' ', $classes_arr );
}
add_filter( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpmetrics_vc_shortcode_css_class', 10, 3 );

