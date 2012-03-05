<?php
/**
 * The Page widget areas.
 *
 * @package WordPress
 * @subpackage RVB
 */
?>

<div id="sidebar-page" class="sidebar">
  <?php
    // Get the secondary nav
    get_template_part( 'nav', 'secondary' );

    // If the sidebar has no widgets, then let's bail early.
    if ( ! is_active_sidebar( 'sidebar-page'  ) )
      return;
    // If we get this far, we have widgets. Let do this.
  ?>
  <div class="widget-area" role="complementary">
    <?php dynamic_sidebar( 'sidebar-page' ); ?>
  </div>
</div><!-- #sidebar-page -->