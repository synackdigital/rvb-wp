<?php
/**
* The default template for displaying content
*
* @package WordPress
* @subpackage RVB
*/
?>

  <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

  <?php if ( is_single() ) : // Single posts ?>
    <header class="entry-header">
      <h1 class="entry-title"><?php the_title(); ?></h1>
    </header><!-- .entry-header -->
    <div class="entry-content">
      <?php the_content(); ?>
    </div><!-- .entry-content -->
    <footer class="entry-meta">
      <?php synack_posted_on(); ?>
    </footer><!-- .entry-meta -->

  <?php else : // ?>
    <header class="entry-header">
      <h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'synack' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
      <div class="entry-meta">
        <?php synack_posted_on(); ?>
      </div><!-- .entry-meta -->
    </header><!-- .entry-header -->
    <div class="entry-content">
      <?php the_content(); ?>
    </div><!-- .entry-content -->

  <?php endif; ?>

  </article><!-- #post-<?php the_ID(); ?> -->