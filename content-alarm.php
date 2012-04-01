<?php
/**
 * The template for displaying campaigns
 *
 * @package WordPress
 * @subpackage RVB
 */

$id = $id;
$link = get_permalink();
$title = get_the_title();
$type = get_post_meta($id, 'type', TRUE);
$datetime = get_post_meta($id, 'datetime', TRUE);
$object = get_post_meta($id, 'object', TRUE);
$municipality = get_post_meta($id, 'municipality', TRUE);
$address = get_post_meta($id, 'address', TRUE);
$information = get_post_meta($id, 'information', TRUE);

?>

  <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
      <?php the_title('<h1 class="alarm-number">', '</h1>'); ?>
      <?php if ( !empty($type) ) echo '<h2 class="alarm-type">'.$type.'</h2>'; ?>
      <p class="pub-info">
      <?php
        if ( !empty($datetime) )
          echo '<span class="alarm-datetime">'.$datetime.'</span> ';

        if ( !empty($object) || !empty($address) || !empty($municipality) )
          echo '<a class="alarm-maplink" href="http://maps.google.com/maps?q='.urlencode($object.' '.$address.' '.$municipality).'" target="_blank">';

        if ( !empty($object) ) :
          echo '<span class="alarm-object">'.$object.'</span>';

          if ( !empty($address) || !empty($municipality) )
            echo ', ';
        endif;


        if ( !empty($address) )
          echo '<span class="alarm-address">'.$address.'</span>';

        if ( !empty($address) && !empty($municipality) )
          echo ' ';

        if ( !empty($municipality) )
          echo '<span class="alarm-municipality">'.$municipality.'</span>';

        if ( !empty($object) || !empty($address) || !empty($municipality) )
          echo '</a>';
      ?>
      </p>
    </header><!-- .entry-header -->

    <div class="entry-content">
      <?php if ( !empty($information) ) echo '<div class="alarm-information">'.$information.'</div>'; ?>
    </div><!-- .entry-content -->

  </article><!-- #post-<?php the_ID(); ?> -->
