<?php
/**
 * The template for displaying the secondary nav
 *
 * @package WordPress
 * @subpackage RVB
 */

// Determine the root ancestor of the current page
if ( $post->post_parent ) {
  $post_ancestors = get_post_ancestors( $post->ID );
  $root_ancestor = $post_ancestors[ count( $post_ancestors ) - 1 ];
} else {
  $root_ancestor = $post->ID;
}

?>
<nav id="nav-secondary" role="navigation">
  <h1 class="assistive-text"><?php _e( 'Secondary menu', 'rvb' ); ?></h1>
  <ul>
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
