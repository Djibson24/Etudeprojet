<?php defined( 'ABSPATH' ) or exit();
/**
 * Grid/Mansonry Layout for Visual Composer
 *
 * @package CMSSuperHeroes
 * @subpackage WPMetrics
 */
$params = array_merge(
    array(
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Layout Type','wp-metrics' ),
            'param_name' => 'layout',
            'value' => array(
                'Basic' => 'basic',
                'Masonry' => 'masonry',
            )
        ),
        array(
            'type' => 'checkbox',
            'heading' => esc_html__( 'Show filter','wp-metrics'),
            'param_name' => 'filter',
            'dependency' => array(
                'element' => 'layout',
                'value' => 'masonry'
            )
        )
    ),
    wpmetrics_vc_cms_grid_base_param(),
    array(
        array(
            'type' => 'loop',
            'heading' => esc_html__( 'Source', 'wp-metrics' ),
            'param_name' => 'source',
            'settings' => array(
                'size' => array( 'hidden' => false, 'value' => 10 ),
                'order_by' => array( 'value' => 'date' )
            ),
            'group' => esc_html__( 'Source Settings', 'wp-metrics' )
        ),
        array(
            'type' => 'checkbox',
            'heading' => esc_html__( 'Exclude Sticky Posts?', 'wp-metrics' ),
            'param_name' => 'exclude_sticky',
            'group' => esc_html__( 'Source Settings', 'wp-metrics' )
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Navigation Type', 'wp-metrics' ),
            'param_name' => 'nav_type',
            'group' => esc_html__( 'Source Settings', 'wp-metrics' ),
            'value' => array(
                esc_html__( 'None', 'wp-metrics' ) => '',
                esc_html__( 'Paging buttons', 'wp-metrics' ) => 'page_links',
                esc_html__( 'Load more button', 'wp-metrics' ) => 'more'
            )
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Button text', 'wp-metrics' ),
            'param_name' => 'button_text',
            'group' => esc_html__( 'Source Settings', 'wp-metrics' ),
            'std' => esc_html__( 'Load more...', 'wp-metrics' ),
            'dependency' => array(
                'element' => 'nav_type',
                'value' => 'more'
            )
        ),
        array(
            'type' => 'cms_template_img',
            'param_name' => 'cms_template',
            'shortcode' => 'cms_xgrid',
            'group' => esc_html__( 'Template', 'wp-metrics' ),
            'value' => 'cms_xgrid.php',
            'admin_label' => true,
            'heading' => esc_html__( 'Template','wp-metrics' ),
        ),
        vc_map_add_css_animation( true ),
        array(
            'type'          => 'textfield',
            'param_name'    => 'el_class',
            'heading'       => esc_html__( 'Extra class name', 'wp-metrics' ),
            'description'   => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'wp-metrics' ),
        ),
        array(
            'type' => 'css_editor',
            'heading' => esc_html__( 'CSS box', 'wp-metrics' ),
            'param_name' => 'css',
            'group' => esc_html__( 'Design Options', 'wp-metrics' )
        )
    )
);
vc_map( array(
    'name' => esc_html__( 'CMS XGrid', 'wp-metrics'),
    'base' => 'cms_xgrid',
    'description' => esc_html__( 'Grid/Masonry Layout for Posts', 'wp-metrics' ),
    'icon' => 'icon-wpb-application-icon-large',
    'category' => esc_html__( 'CmsSuperheroes Shortcodes', 'wp-metrics'),
    'params' => $params
) );



class WPBakeryShortCode_CMS_XGrid extends CmsShortCode {
    protected static $grid_index = 1;

    public function __construct( $settings ) {
        parent::__construct( $settings );
        $this->jsCssScripts();
    }

    public function jsCssScripts() {
        wp_enqueue_style( 'wp-mediaelement' );
        wp_enqueue_script( 'wp-mediaelement' );

        if ( ! wp_script_is( 'images-loaded', 'registered' ) && ! wp_script_is( 'images-loaded', 'enqueued' ) ) {
            wp_register_script( 'images-loaded', get_template_directory_uri() . '/assets/js/imagesloaded.pkgd.min.js', array( 'jquery' ), '', true );
        }
        if ( ! wp_script_is( 'magnific-popup', 'registered' ) && ! wp_script_is( 'magnific-popup', 'enqueued' ) ) {
            wp_register_script( 'magnific-popup', get_template_directory_uri() . '/assets/js/jquery.magnific-popup.min.js', array( 'jquery' ), '', true );
        }
        if ( ! wp_script_is( 'jquery-shuffle', 'registered' ) && ! wp_script_is( 'jquery-shuffle', 'enqueued' ) ) {
            wp_register_script( 'jquery-shuffle', get_template_directory_uri() . '/assets/js/jquery.shuffle.min.js', array( 'jquery', 'modernizr' ), '', true );
        }
    }

    public function getGridIndex() {
        return self::$grid_index ++;
    }

    public static function parseData( $value ) {
        $data = array();
        $values_pairs = preg_split( '/\|/', $value );
        foreach ( $values_pairs as $pair ) {
            if ( ! empty( $pair ) ) {
                list( $key, $value ) = preg_split( '/\:/', $pair );
                $data[ $key ] = $value;
            }
        }
        return $data;
    }

    public function getGridItemClass( $atts ) {
        $item_class = array();
        if ( '' != $atts['col_xs'] ) {
            $item_class[] = esc_html( $atts['col_xs'] );
        }
        if ( '' != $atts['col_sm'] ) {
            $item_class[] = esc_html( $atts['col_sm'] );
        }
        if ( '' != $atts['col_md'] ) {
            $item_class[] = esc_html( $atts['col_md'] );
        }
        if ( '' != $atts['col_lg'] ) {
            $item_class[] = esc_html( $atts['col_lg'] );
        }
        if ( ! empty( $item_class ) ) {
            return implode( ' ', $item_class );
        }
        return '';
    }

    /**
     * Convert string to array, string seperated by ","
     * @param  string $value input
     * @return array
     */
    protected function stringToArray( $value ) {
        $valid_values = array();
        $list = preg_split( '/\,[\s]*/', $value );
        foreach ( $list as $v ) {
            if ( strlen( $v ) > 0 ) {
                $valid_values[] = $v;
            }
        }

        return $valid_values;
    }

    protected function content( $atts, $content = null ) {
        $atts = vc_map_get_attributes( $this->getShortcode(), $atts );
        $size = 10;

        $source = $atts['source'];
        $source_arr = $this->parseData( $source );

        if ( get_query_var( 'paged' ) ) { 
            $paged = get_query_var( 'paged' ); 
        }
        elseif ( get_query_var( 'page' ) ) { 
            $paged = get_query_var( 'page' ); 
        }
        else { 
            $paged = 1; 
        }

        if ( array_key_exists( 'size', $source_arr ) ) {
            $size = (int)$source_arr['size'];
        }

        if ( array_key_exists( 'post_type', $source_arr ) ) {
            $post_types = $source_arr['post_type'];
            if ( '' != $post_types ) {
                $post_types = $this->stringToArray( $post_types );
                $atts['post_types'] = $post_types;
            }
        }

        if ( class_exists( 'WPMetrics_VcLoopQueryBuilder' ) && $paged > 1 ) {
            $loop_builder = new WPMetrics_VcLoopQueryBuilder( $source_arr );
            $loop_builder->parse_per_page( $size );
            $loop_builder->parse_paged( $paged );
            $posts = new WP_Query( $loop_builder->getArgs() );
        }
        else {
            list( $args, $posts ) = vc_build_loop_query( $source, get_the_id() );
        }
 
        $atts['posts'] = $posts;
        $atts['paged'] = $paged;
        $atts['template'] = ' template- ' . str_replace( '.php', '', $atts['cms_template'] );
        
        return parent::content( $atts, $content );
    }
}
