<?php
/**
 * Image Widget template
 */

// Block direct requests
if ( !defined('ABSPATH') )
	die('-1');

echo $before_widget;
if ( !empty( $title ) ) { echo $before_title . esc_attr($title) . $after_title; }
if ( !empty( $image ) ) {
	if ( $link ) {
		echo '<a class="'.$this->widget_options['classname'].'-image-link" href="'.esc_url($link).'" target="'.esc_attr($linktarget).'">';
	}
	if ( $imageurl ) {
    echo '<figure>';
		echo '<img src="'.esc_url($imageurl).'" alt=\"{$title}\">';
    if ( !empty( $description ) ) {
      $text = apply_filters( 'widget_text', $description );
      echo '<figcaption class="'.$this->widget_options['classname'].'-description" >';
      echo wpautop( $text );      
      echo "</figcaption>";
    }
    echo '</figure>';
	}
	if ( $link ) {
    echo '</a>';
  }
}
echo $after_widget;
?>