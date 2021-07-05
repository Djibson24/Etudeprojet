<?php defined( 'ABSPATH' ) or exit();

$team_socials = get_post_meta( $post->ID, '_cms_team_social_profiles', true );
$predefined_networks = array( 'facebook', 'twitter', 'google', 'linkedin', 'behance', 'dribbble', 'flickr', 'github', 'instagram', 'pinterest', 'skype', 'tumblr', 'vimeo', 'yahoo' );

if ( ! $team_socials || ! is_array( $team_socials ) ) {
    $team_socials = array();
} ?>
<div class="cms-metabox">
    <p class="howto"><?php esc_html_e( 'Enter social network profile urls for member.', 'wp-metrics' ); ?></p>
    <?php foreach ( $predefined_networks  as $key => $network ) : ?>
    <div class="cms-field-wrapper field-text-wrapper">
        <div class="cms-field-title">
            <p class="cms-field-title-text"><?php echo esc_html( ucfirst( $network ) ); ?></p>
        </div>
        <div class="cms-field-content">
            <input type="text" class="widefat" name="_cms_team_social_profiles[<?php echo esc_attr( $network ); ?>]" value="<?php echo ( isset( $team_socials[$network] ) && ! empty( $team_socials[$network] ) ? esc_url( $team_socials[$network] ) : '' ) ; ?>"/>
        </div>
    </div>
    <?php endforeach; ?>
</div>