<?php
/**
 * The loop that displays posts.
 *
 * The loop displays the posts and the post content.  See
 * http://codex.wordpress.org/The_Loop to understand it and
 * http://codex.wordpress.org/Template_Tags to understand
 * the tags used in it.
 *
 * This can be overridden in child themes with loop.php or
 * loop-template.php, where 'template' is the loop context
 * requested by a template. For example, loop-index.php would
 * be used if it exists and we ask for the loop with:
 * <code>get_template_part( 'loop', 'index' );</code>
 *
 * @package WordPress
 * @subpackage RVB
 */

$site_options = get_option('rvb_site_options');

$featured_count = ( $site_options['general_homefeaturedcount'] ) ? $site_options['general_homefeaturedcount'] : 2;
$summary_count = ( $site_options['general_homesummarycount'] ) ? $site_options['general_homesummarycount'] : 5;
$page_count = ( is_home() ) ? $featured_count + $summary_count : get_option('posts_per_page');
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;


$wp_query = new WP_Query( array(
  'tax_query' => array(
    array(
      'taxonomy' => 'post_format',
      'field' => 'slug',
      'terms' => array('post-format-status'),
      'operator' => 'NOT IN'
    )
  ),
  'posts_per_page' => $page_count,
  'paged' => $paged
) );


if ( $wp_query->have_posts() ) :

  $key = 0;

  while ( $wp_query->have_posts() ) : $wp_query->the_post();

    if ( is_home() && $key < $featured_count ):
      get_template_part( 'content', 'featured' );
    else :
      get_template_part( 'content', 'summary' );
    endif; // $key < $featured_count

    $key++;

  endwhile;

  echo '<a class="archives-link" href="'.get_permalink(get_page_by_path('arkiv')).'" title="'.__('More in the archives', 'rvb').'">'.__('More in the archives', 'rvb').'</a>';

else : ?>

  <article id="post-0" class="post no-results not-found">
    <header class="entry-header">
      <h1 class="entry-title"><?php _e( 'Uh oh!', 'synack' ); ?></h1>
    </header><!-- .entry-header -->

    <div class="entry-content">
      <p><?php _e( 'We could not find what you were looking for. Try performing a search.', 'synack' ); ?></p>
      <?php get_search_form(); ?>
    </div><!-- .entry-content -->
  </article><!-- #post-0 -->

<?php endif; ?>

<?php if ( is_home() ) : ?>
<aside id="social" role="complementary">
  <?php get_sidebar('home2'); ?>
</aside><!-- #social -->
<?php endif; ?>

