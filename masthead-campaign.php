<?php
/**
 * Campaign masthead
 *
 * @package WordPress
 * @subpackage RVB
 */

if ( is_home() ):
  $query_args = array( 'post_type' => 'campaign', 'posts_per_page' => 3 );
else:
  $query_args = array( 'post_type' => 'campaign', 'p' => $post->ID );
endif;

$results = new WP_Query( $query_args );

if ( $results->have_posts() ) :
  echo '<aside id="campaign" role="banner">';

  while ( $results->have_posts() ) : $results->the_post();
  ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

      <?php if ( ! is_singular() ) : // do not make the title and thumbnail a link if post is sticky or displayed singularly ?>
      <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'synack' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
      <?php endif; ?>

        <?php if ( has_post_thumbnail() ) : // check if the post has a Post Thumbnail assigned to it. ?>
        <figure class="entry-thumbnail">
          <?php the_post_thumbnail('full');?>
        </figure>
        <?php endif; // has_post_thumbnail() ?>

        <header class="entry-header">
          <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
          <h2 class="entry-excerpt"><?php the_excerpt(); ?></h2>
        </header><!-- .entry-header -->

        <?php if ( ! is_singular() ) : // close title and thumbnail link ?>
        </a>
        <?php endif; ?>

    </article><!-- #post-<?php the_ID(); ?> -->
  <?
  endwhile;

  echo '</aside><!-- #campaign -->';
endif; // $results->have_posts()