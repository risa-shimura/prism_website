<?php
/*
 * Add a meta box of slider images
 */
$slider_fields = array();

for ( $i = 1; $i <= 3; $i++ ) {
  $slider_fields[] = array(
		'id' => 'slider_img' . $i,
		'title' => __( 'Item', 'tcd-w' ) . $i,
    'description' => __( 'Recommended image size. Width: 1400px, Height: 945px', 'tcd-w' ),
		'type' => 'image',
		'before_field' => '<dl class="ml_custom_fields">',
		'after_field' => '</dd></dl>',
		'before_title' => '<dt class="label">',
		'after_title' => '</dt><dd class="content">'
  );
}

$slider_args = array(
	'id' => 'slider_meta_box',
	'title' => __( 'Slider settings', 'tcd-w' ),
	'screen' => array( 'event', 'special' ),
	'context' => 'normal',
	'fields' => $slider_fields
);

$slider_meta_box = new TCD_Meta_Box( $slider_args );
