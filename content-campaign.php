<?php
/**
 * The template for displaying campaigns
 *
 * @package WordPress
 * @subpackage RVB
 */
?>

  <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">

      <?php if ( ! is_sticky() && ! is_singular() ) : // do not make the title a link if post is sticky or displayed singularly ?>
      <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'synack' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
      <?php endif; ?>

        <?php the_title('<h1 class="entry-title">', '</h1>'); ?>

      <?php if ( !is_sticky() || !is_singular() ) : // close title and thumbnail link ?>
      </a>
      <?php endif; ?>

      <?php if ( 'post' == get_post_type() && !is_sticky() ) : // print publish info for non-sticky posts ?>
      <p class="pub-info">
        <?php synack_posted_on(); ?>
      </p>
      <?php endif; // 'post' == get_post_type() && !is_sticky() ?>

    </header><!-- .entry-header -->

    <div class="entry-content">
      <?php
        if ( is_singular() ) :
          the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'synack' ) );
        else :
          echo preg_replace('/<(img|iframe|video)[^>]+./', '', get_the_content() );
        endif;
      ?>
    </div><!-- .entry-content -->

    <?php if ( 'post' == get_post_type() && is_singular() ) : ?>
    <footer class="entry-footer">
      <?php
        $categories_list = get_the_category_list( '</li><li>' );
        if ( $categories_list ):
      ?>
      <ul class="inline-list cat-links">
        <h2 class="assistive-text"><?php _e('Categories', 'synack'); ?></h2>
        <li><?php echo $categories_list; ?></li>
      </ul>
      <?php endif; // End if categories ?>

      <?php
        $tags_list = get_the_tag_list( '', '</li><li>' );
        if ( $tags_list ):
      ?>
      <ul class="inline-list tag-links">
        <h2 class="assistive-text"><?php _e('Tags', 'synack'); ?></h2>
      <li><?php echo $tags_list; ?></li>
      </ul>
      <?php endif; // End if $tags_list ?>
    </footer><!-- #entry-footer -->
  <?php endif; // End if 'post' == get_post_type() && is_singular() ?>

  </article><!-- #post-<?php the_ID(); ?> -->
