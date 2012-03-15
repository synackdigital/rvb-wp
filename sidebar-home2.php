<?php
/**
 * The Social widget areas.
 *
 * @package WordPress
 * @subpackage RVB
 */
?>

<?php
  // If the sidebar has no widgets, then let's bail early.
  if ( ! is_active_sidebar( 'sidebar-home2'  ) )
    return;
  // If we get this far, we have widgets. Let do this.
?>
<div id="sidebar-home2" class="sidebar" role="complementary">
  <div class="widget-area">
    <?php dynamic_sidebar( 'sidebar-home2' ); ?>
  </div><!-- .widget-area -->
</div><!-- #sidebar-home2 -->