<?php
/**
 * Add a recommended image size
 */
function add_recommended_image_size( $content, $post_id ) {

  $post_type = get_post_type( $post_id );

  if ( 'post' === $post_type ) {
    $content .= '<p>' . __( 'Recommend image size. Width: 840px or more, Height: 570px or more.<br>If you want to use the image in the posts slider, width: 1450px and height: 725px or more is recommended.', 'tcd-w' ) . '</p>' . "\n";
  } elseif ( 'event' === $post_type  || 'special' === $post_type ) {
    $content .= '<p>' . __( 'Recommend image size. Width: 900px or more, Height: 615px or more.<br>If you want to use the image in the posts slider, width: 1450px and height: 725px or more is recommended.', 'tcd-w' ) . '</p>' . "\n";
  }

  return $content;

}

add_filter( 'admin_post_thumbnail_html', 'add_recommended_image_size', 10, 2 );
