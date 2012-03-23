<?php
/**
 * The loop that displays campaigns.
 *
 * @package WordPress
 * @subpackage RVB
 */


$loop = new WP_Query( array( 'post_type' => 'alarm' ) );

if ( $loop->have_posts() ) :
  echo '<article id="alarms"><ul class="alarms-list">';

  while ( $loop->have_posts() ) : $loop->the_post();
    echo '<li id="alarm-" class="alarm">';
    echo '<a href="#">Foo</a>';
    echo '</li>';
  endwhile;

  echo '</ul></article><!-- #alarms -->';

  echo '<!--';
  print_r($loop);
  echo '-->';
endif; // $loop->have_posts()

?>