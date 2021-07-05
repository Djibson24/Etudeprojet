<?php defined( 'ABSPATH' ) or exit();

$color_variables = "// Colors\n";
$font_family_variables = "// Font Families\n";
$font_size_variables = "// Font Sizes\n";
$line_height_variables = "// Line heights\n";
$misc_variables = "// Misc\n";

// Temporary variable for getting option and print them out
$options = null;

/**
 * Color Variables
 */

// Primary color
$options = wpmetrics_get_theme_option( 'color_primary', '#43B4AE' );
if ( wpmetrics_validate_color( $options ) ) {
    $color_variables .= "\$color_primary: " . esc_attr( $options ) . ";\n";
}
else {
    $color_variables .= "\$color_primary: #43B4AE;\n";
}

$options = wpmetrics_get_theme_option( 'primary_menu_color_link', array( 'regular' => '#222222', 'hover' => '#222222', 'active' => '#222222' ) );
$color_variables .= "\$color_link_primary_menu: " . esc_attr( $options['regular'] ) . ";\n";
$color_variables .= "\$color_link_primary_menu_hover: " . esc_attr( $options['hover'] ) . ";\n";
$color_variables .= "\$color_link_primary_menu_active: " . esc_attr( $options['active'] ) . ";\n";

$options = wpmetrics_get_theme_option( 'primary_menu_submenu_color_link', array( 'regular' => '#7f7f7f', 'hover' => '#ffffff', 'active' => '#ffffff' ) );
$color_variables .= "\$color_link_sub_menu: " . esc_attr( $options['regular'] ) . ";\n";
$color_variables .= "\$color_link_sub_menu_hover: " . esc_attr( $options['hover'] ) . ";\n";
$color_variables .= "\$color_link_sub_menu_active: " . esc_attr( $options['active'] ) . ";\n";

$options = wpmetrics_get_theme_option( 'widget_color_link', array( 'regular' => '#7f7f7f', 'hover' => '#43B4AE', 'active' => '#43B4AE' ) );
$color_variables .= "\$color_link_widget: " . esc_attr( $options['regular'] ) . ";\n";
$color_variables .= "\$color_link_widget_hover: " . esc_attr( $options['hover'] ) . ";\n";
$color_variables .= "\$color_link_widget_active: " . esc_attr( $options['active'] ) . ";\n";

// Other colors
$color_variables .= "\$color_link: \$color_primary;\n";

$color_variables .= "\$color_dark_1: #646464;\n";
$color_variables .= "\$color_dark_2: #474747;\n";
$color_variables .= "\$color_dark_3: #222222;\n";

$color_variables .= "\$color_gray_1: #7F7F7F;\n";
$color_variables .= "\$color_gray_2: #9B9B9B;\n";

/**
 * Font Variables. Althoug font color will be push into colors.
 * Body font is important, so we declare it here
 * H1 - H6 are directly enqueued so we don't need them here.
 * For other fonts, we only need font-size options as it has been defined in theme options.
 */

// Primary Body Font
$font = $this->esc_redux_font( wpmetrics_get_theme_option( 'font_body', false ) );
$font_family_variables .= "\$font_body: " . ( $font['font-family'] ? $font['font-family'] : "'Times New Roman',Times,serif'" ) . ";\n";
$font_size_variables .= "\$font_size_body: " . ( $font['font-size'] ? $font['font-size'] : '14px' ) . ";\n";
$line_height_variables .= "\$line_height_body: " . ( $font['line-height'] ? $font['line-height'] . '/$font_size_body' : '1.6' ) . ";\n";
$color_variables .= "\$color_body: " . ( $font['color'] ? $font['color'] : '#9B9B9B' ) . ";\n";

// Alternate fonts
$font = $this->esc_redux_font( wpmetrics_get_theme_option( 'font_alt_1', false ) );
$font_family_variables .= "\$font_alt_1:" . ( $font['font-family'] ? $font['font-family'] : 'inherit' ) . ";\n";

$font = $this->esc_redux_font( wpmetrics_get_theme_option( 'font_alt_2', false ) );
$font_family_variables .= "\$font_alt_2:" . ( $font['font-family'] ? $font['font-family'] : 'inherit' ) . ";\n";

$font = $this->esc_redux_font( wpmetrics_get_theme_option( 'font_alt_3', false ) );
$font_family_variables .= "\$font_alt_3:" . ( $font['font-family'] ? $font['font-family'] : 'inherit' ) . ";\n";

// Primary font-sizes
$font = $this->esc_redux_font( wpmetrics_get_theme_option( 'font_xlarge', false ) );
$font_size_variables .= "\$font_size_xlarge:" . ( $font['font-size'] ? $font['font-size'] : '17px' ) . ";\n";

$font = $this->esc_redux_font( wpmetrics_get_theme_option( 'font_large', false ) );
$font_size_variables .= "\$font_size_large:" . ( $font['font-size'] ? $font['font-size'] : '15px' ) . ";\n";

$font = $this->esc_redux_font( wpmetrics_get_theme_option( 'font_small', false ) );
$font_size_variables .= "\$font_size_small:" . ( $font['font-size'] ? $font['font-size'] : '13px' ) . ";\n";

$font = $this->esc_redux_font( wpmetrics_get_theme_option( 'font_xsmall', false ) );
$font_size_variables .= "\$font_size_xsmall:" . ( $font['font-size'] ? $font['font-size'] : '12px' ) . ";\n";

// Header font sizes
$font = $this->esc_redux_font( wpmetrics_get_theme_option( 'font_header_main_menu', false ) );
$font_size_variables .= "\$font_size_header_main_menu:" . ( $font['font-size'] ? $font['font-size'] : '13px' ) . ";\n";

$font = $this->esc_redux_font( wpmetrics_get_theme_option( 'font_header_extras', false ) );
$font_size_variables .= "\$font_size_header_extras:" . ( $font['font-size'] ? $font['font-size'] : '12px' ) . ";\n";

$font = $this->esc_redux_font( wpmetrics_get_theme_option( 'font_header_top', false ) );
$font_size_variables .= "\$font_size_header_top:" . ( $font['font-size'] ? $font['font-size'] : '12px' ) . ";\n";

// Footer font sizes
$font = $this->esc_redux_font( wpmetrics_get_theme_option( 'font_footer_widget_title', false ) );
$font_size_variables .= "\$font_size_footer_widget_title:" . ( $font['font-size'] ? $font['font-size'] : '16px' ) . ";\n";

$font = $this->esc_redux_font( wpmetrics_get_theme_option( 'font_footer_main', false ) );
$font_size_variables .= "\$font_size_footer_main:" . ( $font['font-size'] ? $font['font-size'] : '12px' ) . ";\n";

$font = $this->esc_redux_font( wpmetrics_get_theme_option( 'font_footer_top', false ) );
$font_size_variables .= "\$font_size_footer_top:" . ( $font['font-size'] ? $font['font-size'] : '13px' ) . ";\n";

$font = $this->esc_redux_font( wpmetrics_get_theme_option( 'font_footer_bottom', false ) );
$font_size_variables .= "\$font_size_footer_bottom:" . ( $font['font-size'] ? $font['font-size'] : '13px' ) . ";\n";

// Single post
$font = $this->esc_redux_font( wpmetrics_get_theme_option( 'post_single_font', false ) );
$font_size_variables .= "\$font_size_post_single:" . ( $font['font-size'] ? $font['font-size'] : '15px' ) . ";\n";

// Widget
$font = $this->esc_redux_font( wpmetrics_get_theme_option( 'widget_font', false ) );
$font_size_variables .= "\$font_size_widget:" . ( $font['font-size'] ? $font['font-size'] : '13px' ) . ";\n";

$font = $this->esc_redux_font( wpmetrics_get_theme_option( 'widget_title_font', false ) );
$font_size_variables .= "\$font_size_widget_title:" . ( $font['font-size'] ? $font['font-size'] : '16px' ) . ";\n";

// Okay, prints all out
echo str_replace( array( "&quot;", "&#039;" ), "\"", esc_attr( $color_variables ) );
echo "\n";
echo str_replace( array( "&quot;", "&#039;" ), "\"", esc_attr( $font_family_variables ) );
echo "\n";
echo str_replace( array( "&quot;", "&#039;" ), "\"", esc_attr( $font_size_variables ) );
echo "\n";
echo str_replace( array( "&quot;", "&#039;" ), "\"", esc_attr( $line_height_variables ) );
echo "\n";
echo str_replace( array( "&quot;", "&#039;" ), "\"", esc_attr( $misc_variables ) );