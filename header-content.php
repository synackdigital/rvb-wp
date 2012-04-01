<?php
/**
 * The template used for displaying header content in header.php
 *
 * @package WordPress
 * @subpackage RVB
 */
?>

<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>

<?php

get_search_form();

get_template_part( 'nav', 'primary' );

if ( post_type_exists('campaign') )
  get_template_part( 'masthead', 'campaign' );

if ( is_home() )
  get_template_part( 'loop', 'status' );