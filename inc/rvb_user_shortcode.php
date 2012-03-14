<?php
/**
 * Shortcode for generating a user
 */

function rvb_user_shortcode( $atts ) {

  $return = '';

  $user = get_userdata( $atts['id'] );

  if ( isset($user) ) :
    $return .= '<div class="user">';

    $return .= get_avatar( $user->ID, 400 );

    $return .= '<span class="name">';

    if ( $user->roles[0] =! 'board_member' )
      $return .= '<span class="id">'.$user->ID.'</span> ';

    $return .= '<span class="display_name">'.$user->display_name.'</span> ';

    $return .= '</span>';

    if ( isset($user->position) )
      $return .= '<span class="position">'.$user->position.'</span> ';

    if ( isset($user->municipality) && $user->roles[0] == 'board_member' )
      $return .= '<span class="municipality">'.$user->municipality.'</span> ';

    if ( isset($user->party) && $user->roles[0] == 'board_member' )
      $return .= '<span class="party">'.$user->party.'</span> ';

    if ( isset($user->email_is_public) && $user->email_is_public === 'true' )
      $return .= '<a class="email" href="mailto:'.$user->user_email.'">'.$user->user_email.'</a> ';

    $return .= '</div><!-- .user -->';
  endif; // isset($user)

  return $return;
}
add_shortcode( 'user', 'rvb_user_shortcode' );
