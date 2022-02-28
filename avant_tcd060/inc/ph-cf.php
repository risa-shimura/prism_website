<?php
/*
 * Add a meta box of page header
 */
$ph_fields = array(
	array(
		'id' => 'ph_key_color',
		'title' => __( 'Key color', 'tcd-w' ),
		'type' => 'color',
    'default' => '#85b200',
		'before_field' => '<dl class="ml_custom_fields">',
		'after_field' => '</dd></dl>',
		'before_title' => '<dt class="label">',
		'after_title' => '</dt><dd class="content">'
	),
	array(
		'id' => 'ph_1_title',
		'title' => __( 'Title of #1', 'tcd-w' ),
		'type' => 'text',
		'before_field' => '<dl class="ml_custom_fields">',
		'after_field' => '</dd></dl>',
		'before_title' => '<dt class="label">',
		'after_title' => '</dt><dd class="content">'
	),
	array(
		'id' => 'ph_1_title_font_size',
		'title' => __( 'Title font size of #1', 'tcd-w' ),
		'type' => 'number',
    'unit' => 'px',
    'default' => 50,
		'before_field' => '<dl class="ml_custom_fields">',
		'after_field' => '</dd></dl>',
		'before_title' => '<dt class="label">',
		'after_title' => '</dt><dd class="content">'
	),
	array(
		'id' => 'ph_1_sub',
		'title' => __( 'Sub title of #1', 'tcd-w' ),
		'type' => 'text',
		'before_field' => '<dl class="ml_custom_fields">',
		'after_field' => '</dd></dl>',
		'before_title' => '<dt class="label">',
		'after_title' => '</dt><dd class="content">'
	),
	array(
		'id' => 'ph_2_title',
		'title' => __( 'Title of #2', 'tcd-w' ),
		'type' => 'text',
		'before_field' => '<dl class="ml_custom_fields">',
		'after_field' => '</dd></dl>',
		'before_title' => '<dt class="label">',
		'after_title' => '</dt><dd class="content">'
	),
	array(
		'id' => 'ph_2_title_font_size',
		'title' => __( 'Title font size of #2', 'tcd-w' ),
		'type' => 'number',
    'unit' => 'px',
    'default' => 32,
		'before_field' => '<dl class="ml_custom_fields">',
		'after_field' => '</dd></dl>',
		'before_title' => '<dt class="label">',
		'after_title' => '</dt><dd class="content">'
	),
	array(
		'id' => 'ph_2_desc',
		'title' => __( 'Description of #2', 'tcd-w' ),
		'type' => 'textarea',
		'before_field' => '<dl class="ml_custom_fields">',
		'after_field' => '</dd></dl>',
		'before_title' => '<dt class="label">',
		'after_title' => '</dt><dd class="content">'
	),
	array(
		'id' => 'ph_2_img',
		'title' => __( 'Background image of #2', 'tcd-w' ),
    'description' => __( 'Recommended image size. Width: 1450px, Height: 480px', 'tcd-w' ),
		'type' => 'image',
		'before_field' => '<dl class="ml_custom_fields">',
		'after_field' => '</dd></dl>',
		'before_title' => '<dt class="label">',
		'after_title' => '</dt><dd class="content">'
	)
);
$ph_args = array(
	'id' => 'ph_meta_box',
	'title' => __( 'Page header settings', 'tcd-w' ),
	'screen' => array( 'page' ),
	'context' => 'normal',
	'fields' => $ph_fields
);
$ph_meta_box = new TCD_Meta_Box( $ph_args );
