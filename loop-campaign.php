<?php
/**
 * The loop that displays campaigns.
 *
 * @package WordPress
 * @subpackage RVB
 */


$loop = new WP_Query( array( 'post_type' => 'campaign', 'posts_per_page' => 3 ) );

if ( $loop->have_posts() ) :
  echo '<aside id="campaign" role="banner">';

  while ( $loop->have_posts() ) : $loop->the_post();
    get_template_part( 'content', 'campaign' );
  endwhile;

  echo '</aside><!-- #campaign -->';
endif; // $loop->have_posts()

?>