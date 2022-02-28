<?php
/*
 * Add a meta box of header content
 */
$header_content_fields = array(
	array(
		'id' => 'header_content',
		'title' => '',
		'type' => 'checkbox',
		'options' => array(
			array(
				'value' => 'on',
				'label' => __( 'Display at the posts slider in front page', 'tcd-w' )
			)
		),
	)
);

$header_content_args = array(
	'id' => 'header_content_meta_box',
	'title' => __( 'Header content settings', 'tcd-w' ),
	'context' => 'side',
  'screen' => array( 'post', 'event', 'special' ),
	'fields' => $header_content_fields
);

$header_content_meta_box = new TCD_Meta_Box( $header_content_args );
