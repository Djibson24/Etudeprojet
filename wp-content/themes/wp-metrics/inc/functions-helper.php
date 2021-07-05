<?php defined( 'ABSPATH' ) or exit();
/**
 * [Function set]
 * - Helper functions.
 * 
 * @package CMSSuperHeroes
 * @subpackage WPMetrics
 */

/**
 * Validate color string for hex and rgba;
 * @param  string $color_string
 * @return boolean
 * @since 1.0.0
 */
function wpmetrics_validate_color( $color_string = "" )
{
    $color_string = preg_replace( "/\s+/m", '', $color_string );

    if ( '' == $color_string ) return false;

    if ( preg_match( "/(?:^#[a-fA-F0-9]{6}$)|(?:^#[a-fA-F0-9]{3}$)/", $color_string ) ) return true;

    if ( preg_match( "/(?:^rgba\(\d+\,\d+\,\d+\,(?:\d*(?:\.\d+)?)\)$)|(?:^rgb\(\d+\,\d+\,\d+\)$)/", $color_string ) )
    {
        preg_match_all( "/\d+\.*\d*/", $color_string, $matches );
        if ( empty( $matches ) || empty( $matches[0] ) ) return false;

        $red = empty( $matches[0][0] ) ? $matches[0][0] : 0;
        $green = empty( $matches[0][1] ) ? $matches[0][1] : 0;
        $blue = empty( $matches[0][2] ) ? $matches[0][2] : 0;
        $alpha = empty( $matches[0][3] ) ? $matches[0][3] : 1;

        if ( $red < 0 || $red > 255 || $green < 0 || $green > 255 || $blue < 0 || $blue > 255 || $alpha < 0 || $alpha > 1.0 ) return false;
    }
    else {
        return false;
    }
    return true;
}



/**
 * Validate CSS unit string ( px, em, cm, mm, in etc. )
 * @param  string $str
 * @return string|boolean
 * @since 1.0.0
 */
function wpmetrics_validate_css_unit( $str )
{
    $pattern = '/^(\d*(?:\.\d+)?)\s*(px|\%|in|cm|mm|em|rem|ex|pt|pc|vw|vh|vmin|vmax)?$/';
    // allowed metrics: http://www.w3schools.com/cssref/css_units.asp
    $regexr = preg_match( $pattern, $str, $matches );
    $str = isset( $matches[1] ) ? (float) $matches[1] : (float) $str;
    $unit = isset( $matches[2] ) ? $matches[2] : 'px';
    $str = $str . $unit;
    return ! empty( $str ) ? $str : false;
}



/**
 * This function minify css
 * @param  string $css
 * @return string
 * @since 1.0.0
 */
function wpmetrics_css_minifier( $css )
{
    // Normalize whitespace
    $css = preg_replace( '/\s+/', ' ', $css );
    // Remove spaces before and after comment
    $css = preg_replace( '/(\s+)(\/\*(.*?)\*\/)(\s+)/', '$2', $css );
    // Remove comment blocks, everything between /* and */, unless
    // preserved with /*! ... */ or /** ... */
    $css = preg_replace( '~/\*(?![\!|\*])(.*?)\*/~', '', $css );
    // Remove ; before }
    $css = preg_replace( '/;(?=\s*})/', '', $css );
    // Remove space after , : ; { } */ >
    $css = preg_replace( '/(,|:|;|\{|}|\*\/|>) /', '$1', $css );
    // Remove space before , ; { } ( ) >
    $css = preg_replace( '/ (,|;|\{|}|\(|\)|>)/', '$1', $css );
    // Strips leading 0 on decimal values (converts 0.5px into .5px)
    $css = preg_replace( '/(:| )0\.([0-9]+)(%|em|ex|px|in|cm|mm|pt|pc)/i', '${1}.${2}${3}', $css );
    // Strips units if value is 0 (converts 0px to 0)
    $css = preg_replace( '/(:| )(\.?)0(%|em|ex|px|in|cm|mm|pt|pc)/i', '${1}0', $css );
    // Converts all zeros value into short-hand
    $css = preg_replace( '/0 0 0 0/', '0', $css );
    // Shortern 6-character hex color codes to 3-character where possible
    $css = preg_replace( '/#([a-f0-9])\\1([a-f0-9])\\2([a-f0-9])\\3/i', '#\1\2\3', $css );
    return trim( $css );
}



/**
 * Get post format icon
 * @param  string  $post_format
 * @param  boolean $echo
 * @since 1.0.0
 */
function wpmetrics_post_format_icon( $post_format, $echo = true )
{
    $icon = 'fa ';
    switch ( $post_format ) {
        case 'aside':
            $icon .= 'fa-sticky-note-o';
            break;

        case 'gallery':
            $icon .= 'fa-clone';
            break;

        case 'link':
            $icon .= 'fa-link';
            break;

        case 'image':
            $icon .= 'fa-picture-o';
            break;

        case 'quote':
            $icon .= 'fa-quote-left';
            break;

        case 'status':
            $icon .= 'fa-commenting-o';
            break;

        case 'video':
            $icon .= 'fa-film';
            break;

        case 'audio':
            $icon .= 'fa-microphone';
            break;

        case 'chat':
            $icon .= 'fa-comments-o';
            break;
        
        default:
            $icon .= 'fa-newspaper-o';
            break;
    }
    if ( $echo ) {
        echo sprintf( '<i class="%s"></i>', esc_attr( $icon ) );
    } else {
        return $icon;
    }
}


/**
 * Returns an array of supported social links (URL and icon name).
 *
 * @return array $social_links_icons
 */
function wpmetrics_social_links_icons()
{
    // Supported social links icons.
    $social_links_icons = array(
        'behance.net'     => 'fa fa-behance',
        'codepen.io'      => 'fa fa-codepen',
        'deviantart.com'  => 'fa fa-deviantart',
        'digg.com'        => 'fa fa-digg',
        'dribbble.com'    => 'fa fa-dribbble',
        'dropbox.com'     => 'fa fa-dropbox',
        'facebook.com'    => 'fa fa-facebook',
        'flickr.com'      => 'fa fa-flickr',
        'foursquare.com'  => 'fa fa-foursquare',
        'plus.google.com' => 'fa fa-google-plus',
        'github.com'      => 'fa fa-github',
        'instagram.com'   => 'fa fa-instagram',
        'linkedin.com'    => 'fa fa-linkedin',
        'mailto:'         => 'fa fa-envelope-o',
        'medium.com'      => 'fa fa-medium',
        'pinterest.com'   => 'fa fa-pinterest-p',
        'getpocket.com'   => 'fa fa-get-pocket',
        'reddit.com'      => 'fa fa-reddit-alien',
        '/rss'            => 'fa fa-rss',
        'skype.com'       => 'fa fa-skype',
        'skype:'          => 'fa fa-skype',
        'slideshare.net'  => 'fa fa-slideshare',
        'snapchat.com'    => 'fa fa-snapchat-ghost',
        'soundcloud.com'  => 'fa fa-soundcloud',
        'spotify.com'     => 'fa fa-spotify',
        'stumbleupon.com' => 'fa fa-stumbleupon',
        'tumblr.com'      => 'fa fa-tumblr',
        'twitch.tv'       => 'fa fa-twitch',
        'twitter.com'     => 'fa fa-twitter',
        'vimeo.com'       => 'fa fa-vimeo',
        'vine.co'         => 'fa fa-vine',
        'vk.com'          => 'fa fa-vk',
        'wordpress.org'   => 'fa fa-wordpress',
        'wordpress.com'   => 'fa fa-wordpress',
        'yelp.com'        => 'fa fa-yelp',
        'youtube.com'     => 'fa fa-youtube',
    );

    /**
     * Filter social links icons.
     *
     * @since WPMetrics 2.0
     *
     * @param array $social_links_icons
     */
    return apply_filters( 'wpmetrics_social_links_icons', $social_links_icons );
}



/**
 * Get theme options
 * @param  string       $option_id      The option id to be retrieve
 * @param  mixed        $callback_value Callback value if option is not found
 * @return mixed|bool   Option value or callback value
 * @since 1.0.0
 */
function wpmetrics_get_theme_option( $option_id, $callback_value = false )
{
    global $smof_data;

    if ( ! isset( $smof_data[$option_id] ) )
    {
        return $callback_value;
    }

    if ( empty( $smof_data[$option_id] ) )
    {
        if ( is_array( $smof_data[$option_id] ) )
        {
            return $callback_value;
        }
    }
    return $smof_data[$option_id];
}



/**
 * Temporary set theme option variable for various purposes
 * @param  string $option_id    The option id to be set
 * @param  mixed  $value        The value
 * @return void
 * @since 1.0.0
 */
function wpmetrics_set_theme_option( $option_id, $value = '' )
{
    global $smof_data;
    $smof_data[$option_id] = $value;
}



/**
 * This function retrieves the custom field values for a given post.
 *
 * @param  int|WP_Post  $post       Required. Post ID or WP_Post object. Default is global $post.
 * @param  string       $meta_key   The meta key to retrieve.
 * @param  boolean      $single     Optional. Whether to return a single value. Default true.
 * @return mixed        Will be an array if $single is false. Will be value of meta data field if $single is true.
 * @since 1.0.0
 */
function wpmetrics_get_post_meta( $post, $meta_key, $single = true )
{
    if ( ! is_string( $meta_key ) || empty( $meta_key ) ) return false;
    if ( ! isset( $post ) ) {
        global $post;
    }
    $post_obj = get_post( $post );
    if ( empty( $post_obj ) ) return false;
    $meta_data = get_post_meta( $post_obj->ID, $meta_key, $single );
    
    if ( empty( $meta_data ) ) return false;
    
    return $meta_data;
}



/**
 * Get Shortcode From Content
 * 
 * @param   string $shortcode_tag
 * @param   string $content
 * @return  string|false Shortcode string or false on fail
 * @since 1.0.0
 */
function wpmetrics_get_shortcode_from_content( $shortcode_tag = '', $content = '', $first_entry = true )
{
    // This pattern is taken from default wordpress pattern for do_shortcode() function
    $pattern = '/\[(\[?)('. 
        $shortcode_tag . 
        ')(?![\w-])([^\]\/]*(?:\/(?!\])[^\]\/]*)*?)(?:(\/)\]|\](?:([^\[]*+(?:\[(?!\/\2\])[^\[]*+)*+)\[\/\2\])?)(\]?)/';
    preg_match_all( $pattern, $content, $matches );

    if ( empty( $matches[0] ) || ! is_array( $matches[0] ) ) {
        return '';
    }
    if ( $first_entry ) {
        return $matches[0][0];
    }

    return $matches[0];
}



/**
 * Print sidebar markup, similar to get_sidebar() but use function instead.
 * @param  string $sidebar Sidebar id
 * @param  array  $args    Agruments for markup
 * @since 1.0.0
 */
function wpmetrics_get_sidebar( $sidebar = 'sidebar-1', $args = array() )
{
    if ( ! is_active_sidebar( $sidebar ) ) return;
    $args = wp_parse_args( $args, array(
        'container_id' => 'secondary',
        'container_class' => 'widget-area',
        'inner_container' => true,
        'inner_container_class' => 'widget-area-inner',
        'inner_container_id' => ''
    ) );
    echo '<aside' . ( '' != $args['container_id'] ? ' id="' . esc_attr( $args['container_id'] ) . '"' : '' ) .
            ( '' != $args['container_class'] ? ' class="' . esc_attr( $args['container_class'] ) . '"' : '' ) .
        '>';
    if ( $args['inner_container'] ) {
        echo '<div' . ( '' != $args['inner_container_id'] ? ' id="' . esc_attr( $args['inner_container_id'] ) . '"': '' ) .
                ( '' != $args['inner_container_class'] ? ' class="' . esc_attr( $args['inner_container_class'] ) . '"': '' ) .
            '>';
    }
    dynamic_sidebar( $sidebar );
    if ( $args['inner_container'] ) {
        echo '</div>';
    }
    echo '</aside>';
}
