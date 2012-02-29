<?php
/**
 * The template for displaying content slats
 *
 * @package WordPress
 * @subpackage RVB
 */
?>

  <article id="post-<?php the_ID(); ?>" <?php post_class('slat'); ?>>
    <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'synack' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
      <header class="entry-header">
        <h1 class="entry-title"><?php the_title(); ?></h1>
        <?php if ( 'post' == get_post_type() ) : ?>
        <p class="pub-info">
          <?php synack_posted_on(); ?>
        </p>
        <?php endif; // End if 'post' == get_post_type() ?>
      </header><!-- .entry-header -->

      <div class="entry-content">
        <?php the_excerpt(); ?>
      </div><!-- .entry-content -->
    </a>
  </article><!-- #post-<?php the_ID(); ?> -->