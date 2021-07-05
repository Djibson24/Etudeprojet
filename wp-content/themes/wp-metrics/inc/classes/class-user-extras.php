<?php defined( 'ABSPATH' ) or exit();

/**
 * Adds Extra fields into user edit screen
 * @package CMSSuperHeroes
 * @subpackage WPMetrics
 */

if ( ! is_admin() || ! ( $GLOBALS['pagenow'] == 'user-edit.php' || $GLOBALS['pagenow'] == 'profile.php' ) ) return;

class WPMetrics_User_Extras {
    protected $usr_socials;

    /**
     * Constructor
     */
    function __construct() {
        $this->usr_socials = array(
            'facebook'      => '',
            'twitter'       => '',
            'vimeo'         => '',
            'linkedin'      => '',
            'rss'           => '',
            'behance'       => '',
            'dribbble'      => '',
            'flickr'        => '',
            'github'        => '',
            'google'        => '',
            'instagram'     => '',
            'pinterest'     => '',
            'reddit'        => '',
            'tumblr'        => '',
            'vk'            => '',
            'yahoo'         => ''
        );

        add_action( 'show_user_profile', array( $this, 'user_extra_fields' ) );
        add_action( 'edit_user_profile', array( $this, 'user_extra_fields' ) );

        add_action( 'personal_options_update', array( $this, 'user_extra_fields_update' ) );
        add_action( 'edit_user_profile_update', array( $this, 'user_extra_fields_update' ) );
    }

    /**
     * Print out additional fields
     * @param  object $user User object
     */
    function user_extra_fields( $user ) {
        $usr_socials_meta = get_the_author_meta( '_cms_user_socials', $user->ID );

        $this->usr_socials = wp_parse_args( $usr_socials_meta, $this->usr_socials );

        ob_start(); ?>
        <h3><?php esc_html_e( 'Social profiles', 'wp-metrics' ); ?></h3>
        <table class="form-table">
            <tbody>
            <?php foreach ( $this->usr_socials as $key => $usr_social ) : ?>
                <tr class="cms-usr-social-profile-field-wrap">
                    <th><label for="cms-usr-<?php echo esc_attr( $key ); ?>"><?php echo esc_html( ucfirst( $key ) ); ?></label></th>
                    <td><input type="cms-usr-<?php echo esc_attr( $key ); ?>" name="cms-usr-<?php echo esc_attr( $key ); ?>" id="cms-usr-<?php echo esc_attr( $key ); ?>" value="<?php echo esc_url( $usr_social ); ?>" class="regular-text code"></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table><?php
        echo ob_get_clean();
    }

    /**
     * Update user fields
     * @param  sring | int $user_id
     */
    function user_extra_fields_update( $user_id ) {
        if ( ! current_user_can( 'edit_user', $user_id ) ) return false;

        $usr_socials_for_save = array(
            'facebook' => empty( $_POST['cms-usr-facebook'] ) ? '' : esc_url( $_POST['cms-usr-facebook'] ),
            'twitter' => empty( $_POST['cms-usr-twitter'] ) ? '' : esc_url( $_POST['cms-usr-twitter'] ),
            'vimeo' => empty( $_POST['cms-usr-vimeo'] ) ? '' : esc_url( $_POST['cms-usr-vimeo'] ),
            'linkedin' => empty( $_POST['cms-usr-linkedin'] ) ? '' : esc_url( $_POST['cms-usr-linkedin'] ),
            'rss' => empty( $_POST['cms-usr-rss'] ) ? '' : esc_url( $_POST['cms-usr-rss'] ),
            'behance' => empty( $_POST['cms-usr-behance'] ) ? '' : esc_url( $_POST['cms-usr-behance'] ),
            'dribbble' => empty( $_POST['cms-usr-dribbble'] ) ? '' : esc_url( $_POST['cms-usr-dribbble'] ),
            'flickr' => empty( $_POST['cms-usr-flickr'] ) ? '' : esc_url( $_POST['cms-usr-flickr'] ),
            'github' => empty( $_POST['cms-usr-github'] ) ? '' : esc_url( $_POST['cms-usr-github'] ),
            'google' => empty( $_POST['cms-usr-google'] ) ? '' : esc_url( $_POST['cms-usr-google'] ),
            'instagram' => empty( $_POST['cms-usr-instagram'] ) ? '' : esc_url( $_POST['cms-usr-instagram'] ),
            'pinterest' => empty( $_POST['cms-usr-pinterest'] ) ? '' : esc_url( $_POST['cms-usr-pinterest'] ),
            'reddit' => empty( $_POST['cms-usr-reddit'] ) ? '' : esc_url( $_POST['cms-usr-reddit'] ),
            'tumblr' => empty( $_POST['cms-usr-tumblr'] ) ? '' : esc_url( $_POST['cms-usr-tumblr'] ),
            'vk' => empty( $_POST['cms-usr-vk'] ) ? '' : esc_url( $_POST['cms-usr-vk'] ),
            'yahoo' => empty( $_POST['cms-usr-yahoo'] ) ? '' : esc_url( $_POST['cms-usr-yahoo'] )
        );

        update_user_meta( $user_id, '_cms_user_socials' , $usr_socials_for_save );
    }
}

new WPMetrics_User_Extras();