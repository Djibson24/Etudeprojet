<?php defined( 'ABSPATH' ) or exit();

/**
 * Breadcrumb class for the theme
 * @package CMSSuperHeroes
 * @subpackage WPMetrics
 */

class WPMetrics_Breadcrumb {

    private $breadcrumbs;

    function __construct() {
        $this->breadcrumbs = array();
    }

    /**
     * Add an entry to breadcrumbs array
     * @param string $text Breadcrumb entry text.
     * @param string $link Breadcrumb entry link.
     */
    public function add_entry( $text, $link = '' ) {
        $this->breadcrumbs[] = array( 'text' => $text, 'link' => $link );
    }

    /**
     * Generate breadcrumbs array
     * @return array
     */
    public function generate() {

        $conditions = array(
            'is_home',
            'is_404',
            'is_attachment',
            'is_single',
            'is_page',
            'is_post_type_archive',
            'is_category',
            'is_tag',
            'is_author',
            'is_date',
            'is_tax',
            'is_search'
        );

        //-- Front Page
        if ( is_front_page() ) return array();

        if ( '0' !== get_option( 'page_on_front' ) && '0' !== get_option( 'page_for_posts' ) ) {
            if ( 'post' == get_query_var( 'post_type' ) ) {
                $post_id = get_option( 'page_for_posts' );
                $this->add_entry( get_the_title( $post_id ), get_permalink( $post_id ) );
            }
        }

        foreach ( $conditions as $condition ) {
            if ( call_user_func( $condition ) ) {
                call_user_func( array( $this, 'add' . substr( $condition, 2 ) . '_entry' ) );
                break;
            }
        }

        //-- Last entry
        $breadcrumbs_entry_count = count( $this->breadcrumbs );
        if ( $breadcrumbs_entry_count >= 1 ) {
            $this->breadcrumbs[$breadcrumbs_entry_count - 1]['link'] = '';
        }

        return $this->breadcrumbs;
    }

    /**
     * Post index
     */
    private function add_home_entry() {
        
    }

    /**
     * 404
     */
    private function add_404_entry() {
        $this->add_entry( apply_filters( 'cms_breadcrumbs_404', esc_html__( 'Error 404', 'wp-metrics' ) ) );
    }

    /**
     * Attachment
     */
    private function add_attachment_entry() {
        global $post;
        $this->add_single_ancestor_entry( get_the_title( $post->post_parent ), get_permalink( $post->post_parent ) );
        $this->add_entry( get_the_title() );
    }

    /**
     * Single
     */
    private function add_single_entry() {
        global $post;
        $this->add_single_ancestor_entry( get_the_title( $post->post_parent ), get_permalink( $post->post_parent ) );
    }

    /**
     * Page
     */
    private function add_page_entry() {
        $page_ancestors_trail = array();
        $page_parent = $GLOBALS['post']->post_parent;

        $page_as_front = get_option( 'page_on_front' );

        while ( $page_parent ) {

            if ( $page_as_front != $page_parent ) {
                $page_obj = get_post( $page_parent );
                $page_ancestors_trail[] = array( 'text' => get_the_title( $page_obj->ID ), 'link' => get_permalink( $page_obj->ID ) );
            }

            $page_parent = $page_obj->post_parent;
        }

        $page_ancestors_trail = array_reverse( $page_ancestors_trail );
        foreach ( $page_ancestors_trail as $key => $page_ancestor ) {
            $this->add_entry( $page_ancestor['text'], $page_ancestor['link'] );
        }
        $this->add_entry( get_the_title(), get_permalink() );
    }

    /**
     * Post type archive
     */
    private function add_post_type_archive_entry() {
        $post_type = get_post_type_object( get_post_type() );

        if ( $post_type ) {
            $this->add_entry( $post_type->labels->name, get_post_type_archive_link( get_post_type() ) );
        }
    }

    /**
     * Category
     */
    private function add_category_entry() {
        $this->add_category_ancestor_entry();
    }

    /**
     * Tag
     */
    private function add_tag_entry() {
        $queried_object = $GLOBALS['wp_query']->get_queried_object();
        $this->add_entry(
            sprintf( esc_html__( 'Tag: &#8220;%s&#8221;', 'wp-metrics' ),
                single_tag_title( '', false ) ), get_tag_link( $queried_object->term_id )
        );
    }

    /**
     * Author
     */
    private function add_author_entry() {
        global $author;
        $userdata = get_userdata( $author );
        $this->add_entry(
            sprintf( esc_html__( 'Author: %s', 'wp-metrics' ),
                $userdata->display_name )
        );
    }

    /**
     * Date
     */
    private function add_date_entry() {
        if ( is_year() || is_month() || is_day() ) {
            $this->add_entry(
                get_the_time( 'Y' ),
                get_year_link( get_the_time( 'Y' ) )
            );
        }
        if ( is_month() || is_day() ) {
            $this->add_entry(
                get_the_time( 'F' ),
                get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) )
            );
        }
        if ( is_day() ) {
            $this->add_entry(
                get_the_time( 'd' )
            );
        }
    }

    /**
     * Taxonomy
     */
    private function add_tax_entry() {
        $this_term = $GLOBALS['wp_query']->get_queried_object();
        $taxonomy = get_taxonomy( $this_term->taxonomy );

        if ( is_taxonomy_hierarchical( $this_term->taxonomy ) ) {
            $term_ancestors = array_reverse( get_ancestors( $this_term->term_id, $this_term->taxonomy ) );

            foreach ( $term_ancestors as $key => $term_parent ) {
                $term_parent = get_term( $term_parent, $this_term->taxonomy );
                $this->add_entry( $term_parent->name, get_term_link( $term_parent ) );
            }
        }
        else {
            $this->add_entry(
                $taxonomy->labels->name
            );
        }

        $this->add_entry( $this_term->name, get_term_link( $this_term ) );
    }

    /**
     * Paged
     */
    private function add_paged_entry() {
        $this->breadcrumbs[] = array(
            'text' => apply_filters( 'cs_breadcrumbs_paged', sprintf( 'Page %s', get_query_var( 'paged' ) ) ),
            'link' => '',
        );
    }

    /**
     * Search
     */
    private function add_search_entry() {
        $this->breadcrumbs[] = array(
            'text' => sprintf( esc_html__( 'Search results', 'wp-metrics' ), get_search_query() ),
            'link' => remove_query_arg( 'paged' ),
        );
    }
        
    /**
     * Produce category hierarchical and add to breadcumbs
     * @param integer $cat_obj Current category object. Blank means we are viewing category, and the last breadcrumb entry should not have link.
     */
    protected function add_category_ancestor_entry( $cat_obj = null ) {
 
        if ( is_null( $cat_obj ) ) {
            $cat_obj = get_category( $GLOBALS['wp_query']->get_queried_object() );
        }
        $cat_ancestors = array_reverse( get_ancestors( $cat_obj->term_id, 'category' ) );
        foreach ( $cat_ancestors as $key => $cat_parent ) {
            $this->add_entry( get_cat_name( $cat_parent ), get_category_link( $cat_parent ) );
        }

        $this->add_entry( get_cat_name( $cat_obj->term_id ), get_category_link( $cat_obj->term_id ) );
    }

    /**
     * Breadcrumb for single post
     * @param  integer $post_id   Post id, default empty (inside loop)
     * @param  string  $permalink Permalink
     */
    protected function add_single_ancestor_entry( $post_id = 0 ) {
        $post = ( $post_id != 0 ? get_post( $post_id ) : get_post() );

        if ( 'post' === get_post_type( $post ) ) {
            $cat_obj = current( get_the_category( $post ) );

            if ( $cat_obj ) {
                $this->add_category_ancestor_entry( $cat_obj );
            }
        }
        else {
            $post_type = get_post_type_object( get_post_type( $post ) );

            if ( $post_type ) {
                $post_type_archive_link = $post_type->has_archive ? get_post_type_archive_link( get_post_type() ) : '';
                $this->add_entry(
                    $post_type->labels->name,
                    $post_type_archive_link
                );
            }
        }

        $this->add_entry( get_the_title( $post ), get_permalink( $post->ID ) );
    }
}
