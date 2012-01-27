<?php
/**
* The template for displaying content summaries
*
* @package WordPress
* @subpackage RVB
*/
?>

  <article id="post-<?php the_ID(); ?>" <?php post_class( 'post-summary' ); ?>>

    <header class="entry-header">
      <h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'synack' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
      <div class="entry-meta">
        <?php synack_posted_on(); ?>
      </div><!-- .entry-meta -->
    </header><!-- .entry-header -->
    <div class="entry-excerpt">
      <?php the_excerpt(); ?>
    </div><!-- .entry-excerpt -->

  </article><!-- #post-<?php the_ID(); ?> -->