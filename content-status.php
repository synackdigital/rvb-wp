<?php
/**
 * The template for displaying post of the status format
 *
 * @package WordPress
 * @subpackage RVB
 */
?>

  <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
    <div class="entry-content">
      <?php the_pretty_excerpt(512, '<a>'); ?>
      <?php edit_post_link(__('Edit', 'rvb')); ?>
    </div><!-- .entry-content -->
  </article><!-- #post-<?php the_ID(); ?> -->