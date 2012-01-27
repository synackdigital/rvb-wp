<?php
/**
 * The Newslist widget areas.
 *
 * @package WordPress
 * @subpackage RVB
 */
?>

<?php
  // If the sidebar has no widgets, then let's bail early.
  if ( ! is_active_sidebar( 'sidebar-newslist'  ) )
    return;
  // If we get this far, we have widgets. Let do this.
?>
<div id="sidebar-newslist" class="sidebar">
  <div class="widget-area" role="complementary">
    <?php dynamic_sidebar( 'sidebar-newslist' ); ?>
  </div><!-- .widget-area -->
</div><!-- #sidebar-newslist -->