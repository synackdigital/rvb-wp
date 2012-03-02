<?php
/**
 * The loop that displays campaigns.
 *
 * @package WordPress
 * @subpackage RVB
 */


$loop = new WP_Query( array( 'post_type' => 'campaign', 'posts_per_page' => 3 ) );

while ( $loop->have_posts() ) : $loop->the_post();
  echo '<aside id="campaign" role="banner">';
  get_template_part( 'content', 'campaign' );
  echo '</aside><!-- #campaign -->';
endwhile;

?>