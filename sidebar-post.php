<?php
/**
 * The Page widget areas.
 *
 * @package WordPress
 * @subpackage RVB
 */
?>

<?php
  // If the sidebar has no widgets, then let's bail early.
  if ( ! is_active_sidebar( 'sidebar-post'  ) )
    return;
  // If we get this far, we have widgets. Let do this.
?>
<div id="sidebar-post" class="sidebar" role="complementary">
  <div class="widget-area">
    <?php dynamic_sidebar( 'sidebar-post' ); ?>
  </div>
</div><!-- #sidebar-post -->