<?php defined( 'ABSPATH' ) or exit();

$roles = get_the_terms( get_the_ID(), 'team_role' );
$roles_text = array();
if ( is_wp_error( $roles ) || ! $roles || ! is_array( $roles ) ) {
    $roles = false;
} else {
    foreach ( $roles as $key => $role ) {
        $roles_text[] = $role->name;
    }
} ?>
<article class="entry-team-2">
    <div class="team-member">
        <?php
        if ( has_post_thumbnail() ) {
            echo '<div class="team-member-featured">';
            the_post_thumbnail( 'large' );
        } else {
            echo '<div class="team-member-featured team-member-no-thumbnail">';
        }

        $team_social_profiles = wpmetrics_get_post_meta( get_the_ID(), '_cms_team_social_profiles' );

        if ( $team_social_profiles && is_array( $team_social_profiles ) ) {
            $team_social_profiles = array_filter( $team_social_profiles );
        }

        if ( ! empty( $team_social_profiles ) ) {
            echo '<ul class="cms-social">';
            $icon_class = '';
            foreach ( $team_social_profiles  as $key => $social_link ) {
                switch ( $key ) {
                    case 'behance':
                        $icon_class = 'fa fa-behance';
                        break;

                    case 'dribbble':
                        $icon_class = 'fa fa-dribbble';
                        break;

                    case 'facebook':
                        $icon_class = 'fa fa-facebook';
                        break;

                    case 'flickr':
                        $icon_class = 'fa fa-flickr';
                        break;

                    case 'github':
                        $icon_class = 'fa fa-github';
                        break;

                    case 'google':
                        $icon_class = 'fa fa-google-plus';
                        break;

                    case 'instagram':
                        $icon_class = 'fa fa-instagram';
                        break;

                    case 'linkedin':
                        $icon_class = 'fa fa-linkedin';
                        break;

                    case 'pinterest':
                        $icon_class = 'fa fa-pinterest';
                        break;

                    case 'skype':
                        $icon_class = 'fa fa-skype';
                        break;

                    case 'tumblr':
                        $icon_class = 'fa fa-tumblr';
                        break;

                    case 'twitter':
                        $icon_class = 'fa fa-twitter';
                        break;

                    case 'vimeo':
                        $icon_class = 'fa fa-vimeo';
                        break;

                    case 'yahoo':
                        $icon_class = 'fa fa-yahoo';
                        break;
                    
                    default:
                        break;
                }
                if ( ! empty( $icon_class ) ) {
                    echo '<li class="' . esc_attr( $key ) . '"><a href="' . esc_url( $social_link ) . '"><i class="' . esc_attr( $icon_class ) . '"></i></a></li>';
                }
            }
            echo '</ul>';
        }
        echo '</div>'; // image ?>
        <div class="team-member-main">
            <div class="team-member-info">
                <div class="team-member-header">
                    <?php
                    echo sprintf( '<h3 class="team-member-title"><a href="%1$s" title="%2$s">%3$s</a></h3>',
                        esc_url( get_permalink() ),
                        get_the_title(),
                        get_the_title()
                    ); ?>
                    <?php if ( ! empty ( $roles_text ) ) : ?>
                        <p class="team-member-roles"><em><?php echo esc_html( implode(', ', $roles_text ) ); ?></em></p>
                    <?php endif; ?>
                </div>
                <div class="team-member-content"><?php
                    echo wpmetrics_get_the_excerpt( get_the_ID(), array( 'length' => 15 ) );
                ?></div>
            </div>
        </div>
    </div>
</article>
