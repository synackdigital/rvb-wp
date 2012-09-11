<?php
/**
 * Shortcode for generating a user
 */

function rvb_user_shortcode( $atts ) {

  $return = '';

  $user = get_userdata( $atts['id'] );

  $style = ($atts['clear']) ? 'clear:'.$atts['clear'].';' : '';

  if ( isset($user) ) :
    $return .= '<div class="user" style="'.$style.'">';

    $return .= get_avatar( $user->ID, 400 );

    $return .= '<span class="name">';

    if ( $user->roles[0] == 'operational_staff' )
      $return .= '<span class="user_login">'.$user->user_login.'</span> ';

    $return .= '<span class="display_name">'.$user->display_name.'</span> ';

    $return .= '</span>';

    if ( isset($user->position) )
      $return .= '<span class="position">'.$user->position.'</span> ';

    if ( isset($user->municipality) && $user->roles[0] == 'board_member' )
      $return .= '<span class="municipality">'.$user->municipality.'</span> ';

    if ( isset($user->party) && $user->roles[0] == 'board_member' )
      $return .= '<span class="party">'.$user->party.'</span> ';

    if ( isset($user->phone) && ( $user->roles[0] == 'staff' || ($user->roles[0] == 'administrator' && $user->admin_extra_role == 'staff') || ($user->roles[0] == 'editor' && $user->admin_extra_role == 'staff') ) )
      $return .= '<span class="phone">'.$user->phone.'</span> ';

    if ( isset($user->email_is_public) && $user->email_is_public === 'true' )
      $return .= '<a class="email" href="mailto:'.$user->user_email.'">'.$user->user_email.'</a> ';

    $return .= '</div><!-- .user -->';
  endif; // isset($user)

  return $return;
}
add_shortcode( 'user', 'rvb_user_shortcode' );
