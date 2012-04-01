<?php
/* Template Name: Alarms */

/**
 * The template for displaying the alarms custom post type archive.
 *
 * @package WordPress
 * @subpackage RVB
 */

get_header(); ?>

    <div id="main" role="main">

<?php

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;


$wp_query = new WP_Query( array(
  'post_type' => 'alarm',
  'posts_per_page' => get_option('posts_per_page'),
  'paged' => $paged
) );


if ( $wp_query->have_posts() ) : ?>

  <article <?php post_class(); ?>>
    <ul class="alarms-list">
      <?php while ( $wp_query->have_posts() ) : $wp_query->the_post();

        $id = get_the_ID();
        $link = get_permalink();
        $title = get_the_title();
        $type = get_post_meta(get_the_ID(), 'type', TRUE);
        $datetime = get_post_meta(get_the_ID(), 'datetime', TRUE);
        $object = get_post_meta(get_the_ID(), 'object', TRUE);
        $municipality = get_post_meta(get_the_ID(), 'municipality', TRUE);
        $address = get_post_meta(get_the_ID(), 'address', TRUE);
        $information = get_post_meta(get_the_ID(), 'information', TRUE);

        $return = '<li id="alarm-'.$id.'" class="alarm"><div class="alarm-title"><a class="alarm-link" href="'.$link.'">';

        if ( !empty($title) )
          $return .= '<span class="alarm-number">'.$title.'</span>';

        if ( !empty($title) && !empty($type) )
          $return .= '<span class="sep">&rsaquo;</span>';

        if ( !empty($type) )
          $return .= '<span class="alarm-type">'.$type.'</span>';

        $return .= '</a></div><div class="alarm-meta">';

        if ( !empty($datetime) )
          $return .= '<span class="alarm-datetime">'.$datetime.'</span> ';

        if ( !empty($object) || !empty($address) || !empty($municipality) )
          $return .= '<a class="alarm-maplink" href="http://maps.google.com/maps?q='.urlencode($object.' '.$address.' '.$municipality).'" target="_blank">';

        if ( !empty($object) ) :
          $return .= '<span class="alarm-object">'.$object.'</span>';

          if ( !empty($address) || !empty($municipality) )
            $return .= ', ';
        endif;


        if ( !empty($address) )
          $return .= '<span class="alarm-address">'.$address.'</span>';

        if ( !empty($address) && !empty($municipality) )
          $return .= ' ';

        if ( !empty($municipality) )
          $return .= '<span class="alarm-municipality">'.$municipality.'</span>';

        if ( !empty($object) || !empty($address) || !empty($municipality) )
          $return .= '</a>';

        $return .= '</div>';

        if ( !empty($information) )
          $return .= '<div class="alarm-information">'.$information.'</div>';

        $return .= '</li><!-- #alarm-'.$id.' -->';

        echo $return;

      endwhile; ?>
    </ul>
  </article><!-- #post-<?php the_ID(); ?> -->

<?php

  $previous_page_link = (get_previous_posts_link()) ? '<span class="nav-prev">'.get_previous_posts_link(__('Newer posts', 'rvb')).'</span>' : '';
  $next_page_link = (get_next_posts_link()) ? '<span class="nav-next">'.get_next_posts_link(__('Older posts', 'rvb')).'</span>' : '';

  echo '<nav class="nav-pagination">'.$previous_page_link.$next_page_link.'</nav>';

endif; ?>

    </div><!-- #main -->

    <aside id="complementary" role="complementary">
      <?php get_sidebar(); ?>
    </aside><!-- #complementary -->

<?php get_footer(); ?>