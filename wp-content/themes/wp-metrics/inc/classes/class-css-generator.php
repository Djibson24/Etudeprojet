<?php defined( 'ABSPATH' ) or exit();

/**
 * Auto create .css file from Theme Options
 * @package CMSSuperHeroes
 * @subpackage WPMetrics
 * @since WPMetrics 1.0.0
 */

if ( ! class_exists( 'scssc' ) ) {
    require_once get_template_directory() . '/inc/libs/scss.inc.php';
}

class WPMetrics_CSS_Generator
{

    public $scss;
    
    function __construct()
    {
        if ( ! function_exists( 'WP_Filesystem' ) ) {
            return;
        }
        
        if ( ! isset( $GLOBALS['wp_filesystem'] ) ) {
            WP_Filesystem();
        }

        /* scss */
        $this->scss = new scssc();
        
        /* set paths scss */
        $this->scss->setImportPaths( get_template_directory() . '/scss/' );
             
        /* generate css over time */
        add_action( 'init', array( $this, 'generate_over_time' ) );
        
        /* save option generate css */
        add_action( "redux/options/smof_data/saved", array( $this, 'generate_file' ) );
        
        add_action( 'wp_head', array( $this, 'generate_option_custom_css' ) );

    }
    
    /**
     * Generate File over time
     *
     * @since 1.0.0
     * @return void
     */
    public function generate_over_time()
    {
        global $smof_data;
        
        if ( ! wpmetrics_get_theme_option( 'dev_mode', false ) ) return;
            
        $this->generate_file();
    }

    /**
     * generate css file.
     *
     * @since 1.0.0
     */
    public function generate_file()
    {
        global $smof_data, $wp_filesystem;
        
        if ( ! empty( $smof_data ) && ! empty( $wp_filesystem ) ) {
            
            $options_scss = get_template_directory() . '/scss/_options.scss';
            $theme_scss = get_template_directory() . '/scss/theme.scss';
            
            /* delete files options.scss */
            $wp_filesystem->delete( $options_scss );
            
            /* write options to scss file */
            $wp_filesystem->put_contents( $options_scss, $this->option_scss_render(), FS_CHMOD_FILE ); // Save it
            
            /* minimize CSS styles */
            if ( ! wpmetrics_get_theme_option( 'dev_mode', false ) ) {
                $this->scss->setFormatter( 'scss_formatter_compressed' );
            }
            
            /* compile scss to css */
            $css = $this->css_render();
            
            /* fix new line output */
            $css = str_replace( "\r", "", $css );
            
            $theme_css = get_template_directory() . '/assets/css/theme.css';
            
            /* delete files static.css */
            $wp_filesystem->delete( $theme_css );
            
            /* write static.css file */
            $wp_filesystem->put_contents( $theme_css, $css, FS_CHMOD_FILE ); // Save it
        }
    }

    /**
     * Generate custom CSS from theme options
     * 
     * @since 1.0.0
     * @return void
     */
    function generate_option_custom_css()
    {
        $css = wpmetrics_get_theme_option( 'custom_css' );

        $font_css_selector_1 = wpmetrics_get_theme_option( 'font_alt_1_selectors', '' );
        $font_css_selector_2 = wpmetrics_get_theme_option( 'font_alt_2_selectors', '' );
        $font_css_selector_3 = wpmetrics_get_theme_option( 'font_alt_3_selectors', '' );

        $css = $css ? $css : '';
        $css = trim( $css );

        if ( ! empty( $font_css_selector_1 ) ) {
            $font = $this->esc_redux_font( wpmetrics_get_theme_option( 'font_alt_1', false ) );
            $font_alt_1 = $font['font-family'] ? $font['font-family'] : '';
            if ( ! empty( $font_alt_1 ) ) {
                $css .= $font_css_selector_1 . '{font-family:' . $font_alt_1 . '}';
            }
        }

        if ( ! empty( $font_css_selector_2 ) ) {
            $font = $this->esc_redux_font( wpmetrics_get_theme_option( 'font_alt_2', false ) );
            $font_alt_2 = $font['font-family'] ? $font['font-family'] : '';
            if ( ! empty( $font_alt_2 ) ) {
                $css .= $font_css_selector_2 . '{font-family:' . $font_alt_2 . '}';
            }
        }

        if ( ! empty( $font_css_selector_3 ) ) {
            $font = $this->esc_redux_font( wpmetrics_get_theme_option( 'font_alt_3', false ) );
            $font_alt_3 = $font['font-family'] ? $font['font-family'] : '';
            if ( ! empty( $font_alt_2 ) ) {
                $css .= $font_css_selector_3 . '{font-family:' . $font_alt_3 . '}';
            }
        }

        if ( ! empty( $css ) ) {
            $css = wpmetrics_css_minifier( $css );
            echo '<style type="text/css" data-type="metrics-options-css">';
            echo str_replace( '&gt;', '>', wp_kses_post( $css ) );
            echo '</style>';
        }
    }
    
    /**
     * scss compile
     * 
     * @since 1.0.0
     * @return string
     */
    public function css_render(){
        /* compile scss to css */
        return $this->scss->compile( '@import "theme.scss"' );
    }
    
    /**
     * main css
     *
     * @since 1.0.0
     * @return string
     */
    public function option_scss_render()
    {
        ob_start();
        require_once get_template_directory() . '/inc/generated/options-scss.php';
        return ob_get_clean();
    }

    /**
     * Escape redux font format
     * 
     * @since 1.0.0
     * @param  array  $font Redux font array
     * @return array        Valid property values ready to be printed
     */
    function esc_redux_font( $font = array() ) {
        if ( empty( $font ) || ! $font ) return array();
        // Escape color
        if ( ! isset( $font['color'] ) || empty( $font['color'] ) ) {
            $font['color'] = false;
        }
        else {
            if ( ! wpmetrics_validate_color( $font['color'] ) ) {
                $font['color'] = false;
            }
        }
        // Escape direction - This property is currently not available
        if ( ! isset( $font['direction'] ) || empty( $font['direction'] ) ) {
            $font['direction'] = false;
        }
        // Escape letter-spacing
        if ( ! isset( $font['letter-spacing'] ) || empty( $font['letter-spacing'] ) ) {
            $font['letter-spacing'] = false;
        }
        // Escape line-height
        if ( ! isset( $font['line-height'] ) || empty( $font['line-height'] ) ) {
            $font['line-height'] = false;
        }
        // Escape text-decoration - This property is currently not available
        if ( ! isset( $font['text-decoration'] ) || empty( $font['text-decoration'] ) ) {
            $font['text-decoration'] = false;
        }
        // Escape text-indent - This property is currently not available
        if ( ! isset( $font['text-indent'] ) || empty( $font['text-indent'] ) ) {
            $font['text-indent'] = false;
        }
        // Escape line-height - This property is currently not avaiable
        if ( ! isset( $font['text-shadow'] ) || empty( $font['text-shadow'] ) ) {
            $font['text-shadow'] = false;
        }
        // Escape text-transform
        if ( ! isset( $font['text-transform'] ) || empty( $font['text-transform'] ) ) {
            $font['text-transform'] = false;
        }
        // Escape word-spacing
        if ( ! isset( $font['word-spacing'] ) || empty( $font['word-spacing'] ) ) {
            $font['word-spacing'] = false;
        }
        // Escape font-family
        if ( ! isset( $font['font-family'] ) || empty( $font['font-family'] ) ) {
            $font['font-family'] = false;
        } else {
            if ( isset( $font['google'] ) || ! empty( $font['google'] ) ) {
                if ( filter_var( $font['google'], FILTER_VALIDATE_BOOLEAN ) ) {
                    if ( strpos( $font['font-family'], ' ' ) && ! strpos( $font['font-family'], ',' ) ) {
                        $font['font-family'] = '"' . $font['font-family'] . '"';
                    }
                    if ( isset( $font['font-backup'] ) && ! empty( $font['font-backup'] ) ) {
                        $font['font-family'] .= ',' . $font['font-backup'];
                    }
                }
                $font['font-family'] = str_replace( ', ', ',', $font['font-family'] );
            }
        }
        // Escape font-size
        if ( ! isset( $font['font-size'] ) || empty( $font['font-size'] ) ) {
            $font['font-size'] = false;
        }
        // Escape font-style
        if ( ! isset( $font['font-style'] ) || empty( $font['font-style'] ) ) {
            $font['font-style'] = false;
        }
        // Escape word-spacing
        if ( ! isset( $font['font-variant'] ) || empty( $font['font-variant'] ) ) {
            $font['font-variant'] = false;
        }
        // Escape font-weight
        if ( ! isset( $font['font-weight'] ) || empty( $font['font-weight'] ) ) {
            $font['font-weight'] = false;
        }
        return $font;
    }

    /**
     * Print css properties based on font.
     * This function will ignore common properties like font-family, font-size, line-height.
     *
     * @since 1.0.0
     * @param  array   $font Redux front array
     * @param  boolean $echo False if return, default true
     * @return array
     */
    protected function css_font_properties( $font = array(), $defaults = array(), $echo = true ) {
        if ( empty( $font ) || ! $font ) return array();

        $font = wp_parse_args( $font, $defaults );

        $font = $this->esc_redux_font( $font );
        $font_size = ( $font['font-size'] ? $font['font-size'] : '' );
        $line_height = ( $font['line-height'] ? $font['line-height'] : '' );

        echo( $font['font-family'] ? "\tfont-family: " . $font['font-family'] . ";\n" : '' );

        if ( ! empty( $font_size ) ) {
            echo "\tfont-size: " . $font_size . ";\n";
            if ( ! empty( $line_height ) && false !== strpos( $line_height, 'px' ) && false !== strpos( $font_size, 'px' ) ) {
                $line_height = $line_height / $font_size;
            }
        }
        
        echo( $line_height ? "\tline-height: " . $line_height . ";\n" : '' );
        echo( $font['font-weight'] ? "\tfont-weight: " . $font['font-weight'] . ";\n" : '' );
        echo( $font['font-style'] ? "\tfont-style: " . $font['font-style'] . ";\n" : '' );
        echo( $font['font-variant'] ? "\tfont-variant: " . $font['font-variant'] . ";\n" : '' );
        echo( $font['direction'] ? "\tdirection: " . $font['direction'] . ";\n" : '' );
        echo( $font['letter-spacing'] ? "\tletter-spacing: " . $font['letter-spacing'] . ";\n" : '' );
        echo( $font['text-decoration'] ? "\ttext-decoration: " . $font['text-decoration'] . ";\n" : '' );
        echo( $font['text-indent'] ? "\ttext-indent: " . $font['text-indent'] . ";\n" : '' );
        echo( $font['text-transform'] ? "\ttext-transform: " . $font['text-transform'] . ";\n" : '' );
        echo( $font['word-spacing'] ? "\tword-spacing: " . $font['word-spacing'] . ";" : '' );
        echo( $font['color'] ? "\tcolor: " . $font['color'] . ";\n" : '' );
    }
}

new WPMetrics_CSS_Generator();