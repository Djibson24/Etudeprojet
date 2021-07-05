<?php defined( 'ABSPATH' ) or exit();

// Hide the page title
add_filter( 'woocommerce_show_page_title', create_function( '', 'return false;' ) );

// Remove default sidebar call
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

// Remove link on the product image
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );

// We use our function for this hook so remove default action on printing thumbnail
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );

// Remove default add to cart button
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );

// We use our function for this hook so remove default action on printing propduct title
remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );

// We already supported WooCommerce breadcrumbs, so we don't need it anymore.
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );

// We use custom product filter, so remove the default filters.
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

// Remove default WooCommerce style
// add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );



/**
 * Get filter var based on $_GET
 * @param  string  $var_name      Var name
 * @param  mixed $callback_value  Callback value if var name is not found or is not set
 * @return mixed
 */
function wpmetrics_woocommerce_get_product_filter_var( $var_name, $callback_value = false ) {
    return ( isset( $_GET[$var_name] ) && ! empty( $_GET[$var_name] ) ) ? esc_html( $_GET[$var_name] ) : $callback_value;
}



/**
 * Fetch list of avaliable per_page options on product showcase
 * @return array
 */
function wpmetrics_woocommerce_get_products_per_page_options(){
    $options = apply_filters( 'wpmetrics_products_per_page', array(
        3 => esc_html__('3 items / page', 'wp-metrics'),
        6 => esc_html__('6 items / page', 'wp-metrics'),
        9 => esc_html__('9 items / page', 'wp-metrics'),
        12 => esc_html__('12 items / page', 'wp-metrics'),
        15 => esc_html__('15 items / page', 'wp-metrics'),
    ));

    return $options;
}



/**
 * Get current users preference
 * 
 * Hooked into loop_shop_per_page
 * @return int
 */
function wpmetrics_woocommerce_get_products_per_page(){
    global $woocommerce;

    $default = 12;
    if ( is_shop() ) {
        return $default;   
    }
    $count = $default;
    $options = wpmetrics_woocommerce_get_products_per_page_options();

    // capture form data and store in session
    if ( isset( $_GET['per_page'] ) ) {

        // set products per page from dropdown
        $products_max = intval( $_GET['per_page'] );
        if ( $products_max != 0 && $products_max >= -1 ) {
            if ( is_user_logged_in() ) {

                $user_id = get_current_user_id();
                $limit = get_user_meta( $user_id, '_product_per_page', true );

                if ( ! $limit ) {
                    add_user_meta( $user_id, '_product_per_page', $products_max );
                } else {
                    update_user_meta( $user_id, '_product_per_page', $products_max, $limit );
                }
            }

            $woocommerce->session->cms_product_per_page = $products_max;
            return $products_max;
        }    
    }

    // load product limit from user meta
    if ( is_user_logged_in() && ! isset( $woocommerce->session->cms_product_per_page ) ) {

        $user_id = get_current_user_id();
        $limit = get_user_meta( $user_id, '_product_per_page', true );

        if ( array_key_exists( $limit, $options ) ) {
            $woocommerce->session->cms_product_per_page = $limit;
            return $limit;  
        }       
    }

    // load product limit from session
    if ( isset( $woocommerce->session->cms_product_per_page ) ) {

        // set products per page from woo session
        $products_max = intval( $woocommerce->session->cms_product_per_page );
        if ( $products_max != 0 && $products_max >= -1 ) {
            return $products_max;
        }
    }   

    return $count;
}
add_filter( 'loop_shop_per_page', 'wpmetrics_woocommerce_get_products_per_page' );



/**
 * Custom filters for main product showcase page
 * @see woocommerce_catalog_ordering()
 * @return void
 */
function wpmetrics_woocommerce_before_shop_loop() {
    global $wp_query;

    if ( 1 === $wp_query->found_posts || ! woocommerce_products_will_display() ) {
        return;
    }

    $orderby                 = isset( $_GET['orderby'] ) ? wc_clean( $_GET['orderby'] ) : apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby' ) );
    $show_default_orderby    = 'menu_order' === apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby' ) );
    $catalog_orderby_options = apply_filters( 'woocommerce_catalog_orderby', array(
        'menu_order' => esc_html__( 'Default sorting', 'wp-metrics' ),
        'popularity' => esc_html__( 'Sort by popularity', 'wp-metrics' ),
        'rating'     => esc_html__( 'Sort by average rating', 'wp-metrics' ),
        'date'       => esc_html__( 'Sort by newness', 'wp-metrics' ),
        'price'      => esc_html__( 'Sort by price: low to high', 'wp-metrics' ),
        'price-desc' => esc_html__( 'Sort by price: high to low', 'wp-metrics' )
    ) );

    $filter_area_classes = is_product_category() ? 'shop-category-filter-wrapper' : 'shop-front-filter-wrapper';

    $view_per_page_options = apply_filters( 'wpmetrics_woocommerce_catalog_items_per_page', array(
        'paged' => max( 1, $wp_query->get( 'paged' ) ),
        'total' => $wp_query->found_posts,
        'options' => wpmetrics_woocommerce_get_products_per_page_options(),
        'current' => wpmetrics_woocommerce_get_products_per_page()
    ) );

    if ( ! $show_default_orderby ) {
        unset( $catalog_orderby_options['menu_order'] );
    }

    if ( 'no' === get_option( 'woocommerce_enable_review_rating' ) ) {
        unset( $catalog_orderby_options['rating'] );
    }

    ?><div class="shop-main-filter <?php echo esc_attr( $filter_area_classes ); ?>"><?php
        wc_get_template( 'loop/orderby.php', array(
            'catalog_orderby_options' => $catalog_orderby_options,
            'orderby' => $orderby,
            'show_default_orderby' => $show_default_orderby,
            'view_per_page_options' => $view_per_page_options
        ) );
    ?></div><?php
}
add_action( 'woocommerce_before_shop_loop', 'wpmetrics_woocommerce_before_shop_loop' );



/**
 * HTML markup for main shop content area filter
 */
function wpmetrics_woocommerce_per_page_filter( $options, $current_value, $total, $paged ) {
    ob_start();
    ?><select name="per_page" class="filter-products-per-page" onchange="this.form.submit()">
    <?php foreach( $options as $value => $name ) : ?>
        <?php if ( ceil( $total/$value ) >= $paged ): ?>
            <option value="<?php echo $value; ?>" <?php selected( $value, $current_value ); ?>><?php echo $name; ?></option>
        <?php endif; ?>
    <?php endforeach; ?>        
    </select><?php
    echo ob_get_clean();
}

function wpmetrics_woocommerce_ordering_filter( $catalog_orderby_options, $orderby ) {
    ob_start();
    ?><select name="orderby" class="orderby">
        <?php foreach ( $catalog_orderby_options as $id => $name ) : ?>
            <option value="<?php echo esc_attr( $id ); ?>" <?php selected( $orderby, $id ); ?>><?php echo esc_html( $name ); ?></option>
        <?php endforeach; ?>
    </select>
    <?php
    // Keep query string vars intact
    foreach ( $_GET as $key => $val ) {
        if ( 'orderby' === $key || 'submit' === $key || 'per_page' === $key || 'view' === $key ) {
            continue;
        }
        if ( is_array( $val ) ) {
            foreach( $val as $innerVal ) {
                echo '<input type="hidden" name="' . esc_attr( $key ) . '[]" value="' . esc_attr( $innerVal ) . '" />';
            }
        } else {
            echo '<input type="hidden" name="' . esc_attr( $key ) . '" value="' . esc_attr( $val ) . '" />';
        }
    }
    echo ob_get_clean();
}



/**
 * Product showcase columns
 * @return int Columns
 */
function wpmetrics_woocommerce_loop_shop_columns() {
    $cols = (int)wpmetrics_get_theme_option( 'woo_shop_cols', '3' );
    if ( $cols < 1 || $cols > 6 ) $cols = 3;
    return $cols;
}
add_filter( 'loop_shop_columns', 'wpmetrics_woocommerce_loop_shop_columns' );



/**
 * HTML Markup before and after item
 *
 * Hook: woocommerce_before_shop_loop_item
 * Hook: woocommerce_after_shop_loop_item
 * @return void
 */
function wpmetrics_woocommerce_before_shop_loop_item() {
    $layout = wpmetrics_woocommerce_get_product_filter_var( 'view', 'grid' );
    echo '<div class="products-item products-item-view-' . esc_attr( $layout ) . '">';
}

function wpmetrics_woocommerce_after_shop_loop_item() {
    echo '</div>';
}
add_action( 'woocommerce_before_shop_loop_item', 'wpmetrics_woocommerce_before_shop_loop_item' );
add_action( 'woocommerce_after_shop_loop_item', 'wpmetrics_woocommerce_after_shop_loop_item' );



/**
 * Add to cart and thumbnail before item title
 *
 * Hook: woocommerce_before_shop_loop_item_title
 * @return void
 */
function wpmetrics_woocommerce_before_shop_loop_item_title( $args ) {
    global $product;
    $view = wpmetrics_woocommerce_get_product_filter_var( 'view', 'grid' );
    echo '<div class="product-thumbnail">';
    echo woocommerce_get_product_thumbnail();
    if ( 'grid' === $view ) {
        echo    '<div class="product-thumbnail-action">';
        echo        '<div class="product-thumbnail-action-inner">';
        if ( $product ) {
            $defaults = array(
                'quantity' => 1,
                'class'    => implode( ' ', array_filter( array(
                        'button',
                        'product_type_' . $product->product_type,
                        $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
                        $product->supports( 'ajax_add_to_cart' ) ? 'ajax_add_to_cart' : ''
                ) ) )
            );

            $args = apply_filters( 'woocommerce_loop_add_to_cart_args', wp_parse_args( $args, $defaults ), $product );
            wc_get_template( 'loop/add-to-cart.php', $args );
        }
        echo        '</div>';
        echo    '</div>';
    }
    echo '</div>';
}
add_action( 'woocommerce_before_shop_loop_item_title', 'wpmetrics_woocommerce_before_shop_loop_item_title' );


/**
 * Add permalink to item title
 *
 * Hook: woocommerce_shop_loop_item_title
 * @return void
 */
function wpmetrics_woocommerce_template_loop_product_title() {
    $view = wpmetrics_woocommerce_get_product_filter_var( 'view', 'grid' );
    if ( 'list' === $view ) {
        echo '<div class="product-brief">';
    }
    echo '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '">' . get_the_title() . '</a></h3>';
}
add_action( 'woocommerce_shop_loop_item_title', 'wpmetrics_woocommerce_template_loop_product_title' );



function wpmetrics_woocommerce_after_shop_loop_item_title() {
    global $product;
    $view = wpmetrics_woocommerce_get_product_filter_var( 'view', 'grid' );
    if ( 'list' === $view ) {
        echo '<div class="product-brief-text">';
        wpmetrics_get_the_excerpt( get_the_ID(), array( 'length' => 92 ) );
        echo '</div>';
        
        if ( $product ) {
            echo '<div class="product-actions">';
            $defaults = array(
                'quantity' => 1,
                'class'    => implode( ' ', array_filter( array(
                        'button',
                        'product_type_' . $product->get_type(),
                        $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
                        $product->supports( 'ajax_add_to_cart' ) ? 'ajax_add_to_cart' : ''
                ) ) )
            );
            $args = apply_filters( 'woocommerce_loop_add_to_cart_grid_view_args', $defaults, $product );
            wc_get_template( 'loop/add-to-cart.php', $args );
            echo '</div>';
        }
        echo '</div>'; // <-- .product-brief
    }
}
add_action( 'woocommerce_after_shop_loop_item_title', 'wpmetrics_woocommerce_after_shop_loop_item_title' );


// Related
function wpmetrics_woocommerce_output_related_products_args( $args ) {
    $args = array(
        'posts_per_page'    => 3,
        'columns'           => 3
    );
    return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'wpmetrics_woocommerce_output_related_products_args' );


/**
 * Sharing options
 * Hook: woocommerce_share
 */
function wpmetrics_woocommerce_share() {
    // Sharing buttons
    if ( ! wpmetrics_get_theme_option( 'product_sharing_enable', false ) || ! class_exists( 'WPMetrics_Social_Share' ) ) return;
    $args = array();

    $args['facebook']   = wpmetrics_get_theme_option( 'product_sharing_facebook', false );
    $args['twitter']    = wpmetrics_get_theme_option( 'product_sharing_twitter', false );
    $args['googleplus'] = wpmetrics_get_theme_option( 'product_sharing_googleplus', false );
    $args['pinterest']  = wpmetrics_get_theme_option( 'product_sharing_pinterest', false );
    $args['linkedin']   = wpmetrics_get_theme_option( 'product_sharing_linkedin', false );
    $args['tumblr']     = wpmetrics_get_theme_option( 'product_sharing_tumblr', false );
    $args['vk']         = wpmetrics_get_theme_option( 'product_sharing_vk', false );
    $args['reddit']     = wpmetrics_get_theme_option( 'product_sharing_reddit', false );
    $args['email']      = wpmetrics_get_theme_option( 'product_sharing_email', false );

    $links_obj = new WPMetrics_Social_Share( $args );

    if ( empty( $links_obj->links ) ) return;

    echo '<div class="product-share">';
    echo '<h5 class="product-share-title">' . esc_html__( 'Share Product:', 'wp-metrics' ) . '</h5>';
    echo '<ul class="product-share-links cms-social">';

    foreach ( $links_obj->links as $key => $link ) {

        switch ( $key ) {

            case 'facebook':
                echo '<li class="' . $key . '">';
                echo '<a href="' . $link['url'] . '" title="' . esc_html__( 'Share this.', 'wp-metrics' ) . '" target="_blank"><i class="fa fa-facebook"></i></a>';
                echo '</li>';
                break;
            
            case 'twitter':
                echo '<li class="' . $key . '">';
                echo '<a href="' . $link['url'] . '" title="' . esc_html__( 'Tweet this.', 'wp-metrics' ) . '" target="_blank"><i class="fa fa-twitter"></i></a>';
                echo '</li>';
                break;

            case 'googleplus':
                echo '<li class="google">';
                echo '<a href="' . $link['url'] . '" title="' . esc_html__( 'Share this.', 'wp-metrics' ) . '" target="_blank"><i class="fa fa-google-plus"></i></a>';
                echo '</li>';
                break;

            case 'pinterest':
                echo '<li class="' . $key . '">';
                echo '<a href="' . $link['url'] . '" title="' . esc_html__( 'Share this.', 'wp-metrics' ) . '" target="_blank"><i class="fa fa-pinterest"></i></a>';
                echo '</li>';
                break;

            case 'linkedin':
                echo '<li class="' . $key . '">';
                echo '<a href="' . $link['url'] . '" title="' . esc_html__( 'Share this.', 'wp-metrics' ) . '" target="_blank"><i class="fa fa-linkedin"></i></a>';
                echo '</li>';
                break;

            case 'tumblr':
                echo '<li class="' . $key . '">';
                echo '<a href="' . $link['url'] . '" title="' . esc_html__( 'Share this.', 'wp-metrics' ) . '" target="_blank"><i class="fa fa-tumblr"></i></a>';
                echo '</li>';
                break;

            case 'vk':
                echo '<li class="' . $key . '">';
                echo '<a href="' . $link['url'] . '" title="' . esc_html__( 'Share this.', 'wp-metrics' ) . '" target="_blank"><i class="fa fa-vk"></i></a>';
                echo '</li>';
                break;

            case 'reddit':
                echo '<li class="' . $key . '">';
                echo '<a href="' . $link['url'] . '" title="' . esc_html__( 'Share this.', 'wp-metrics' ) . '" target="_blank"><i class="fa fa-reddit"></i></a>';
                echo '</li>';
                break;

            case 'email':
                echo '<li class="' . $key . '">';
                echo '<a href="' . $link['url'] . '" title="' . esc_html__( 'Email this.', 'wp-metrics' ) . '" target="_blank"><i class="fa fa-envelope-o"></i></a>';
                echo '</li>';
                break;

            default:
                break;
        }
    }
    echo '</ul>';
    echo '</div>';
}
add_action( 'woocommerce_share', 'wpmetrics_woocommerce_share' );