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
    // Determine the root ancestor of the current page
    if ( $post->post_parent ) {
      $post_ancestors = get_post_ancestors( $post->ID );
      $root_ancestor = $post_ancestors[ count( $post_ancestors ) - 1 ];
    } else {
      $root_ancestor = $post->ID;
    }
  ?>
  <nav id="secondary-nav-container">
    <h1 class="assistive-text"><?php _e( 'Secondary menu', 'rvb' ); ?></h1>
    <ul id="secondary-nav" role="navigation">
    <?php
      // Print secondary menu for the current page
      wp_list_pages( array(
        'title_li' => '',
        'child_of' => $root_ancestor,
        'walker' => new Razorback_Walker_Page_Selective_Children()
      ) );
    ?>
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