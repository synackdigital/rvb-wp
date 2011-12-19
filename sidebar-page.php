<?php
/**
 * The Page widget areas.
 *
 * @package WordPress
 * @subpackage RVB
 */

  global $id;

?>

<div id="sidebar-page" class="sidebar">
  <nav class="nav">
    <ul id="menu-childpages" class="menu">
      <?php wp_list_pages("title_li=&child_of=$id"); ?>
    </ul>
  </nav>

<?php
  // If the sidebar has no widgets, then let's bail early.
  if ( ! is_active_sidebar( 'sidebar-page'  ) )
    return;
  // If we get this far, we have widgets. Let do this.
?>
  <div class="widget-area" role="complementary">
    <?php dynamic_sidebar( 'sidebar-page' ); ?>
  </div>
</div><!-- #sidebar-page -->