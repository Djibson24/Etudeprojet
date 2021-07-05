<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $css_animation
 * @var $css
 * @var $content - shortcode content
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Column_text
 * @var $theme_font - Additional Parameter
 * @var $font_container - Additional Parameter
 */
$el_class = $css = $css_animation = $theme_font = $font_container = '';
$styles = array();

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$font_container_data = empty( $font_container ) ? array() : explode( '|', $font_container );
foreach ( $font_container_data as $property_pair ) {
    $font_container_attr = explode( ':', $property_pair );
    $property = isset( $font_container_attr[0] ) ? $font_container_attr[0] : '';
    $value = isset( $font_container_attr[1] ) ? $font_container_attr[1] : '';

    if ( ! empty( $property ) && ! empty( $value ) ) {
        if ( 'font_size' === $property || 'line_height' === $property ) {
            $pattern = '/^(\d*(?:\.\d+)?)\s*(px|\%|in|cm|mm|em|rem|ex|pt|pc|vw|vh|vmin|vmax)?$/';
            // allowed metrics: http://www.w3schools.com/cssref/css_units.asp
            $regexr = preg_match( $pattern, $value, $matches );
            $value = isset( $matches[1] ) ? (float) $matches[1] : (float) $value;
            $unit = isset( $matches[2] ) ? $matches[2] : 'px';
            $value = $value . $unit;
            $styles[] = str_replace( '_', '-', $property ) . ':' . $value;
        }
    }
}

$styles = empty( $styles ) ? '' : ' style="' . esc_attr( implode( ';', $styles ) ) . '"';

$class_to_filter = 'wpb_text_column wpb_content_element ' . $this->getCSSAnimation( $css_animation );
$class_to_filter .= vc_shortcode_custom_css_class( $css, ' ' ) . $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );

$output = '
	<div class="' . esc_attr( $css_class ) . '">
		<div class="wpb_wrapper' . ( empty( $theme_font ) ? '' : ' ' . esc_attr( $theme_font ) ) . '"' . $styles . '>
			' . wpb_js_remove_wpautop( $content, true ) . '
		</div>
	</div>
';

echo $output;
