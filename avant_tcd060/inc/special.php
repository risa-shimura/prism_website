<?php
/**
 * Add a meta box of recommended special
 */
$recommended_special_fields = array(
	array(
		'id' => 'recommended_special',
		'title' => '',
		'type' => 'checkbox',
		'options' => array(
			array(
				'value' => 'on',
				'label' => __( 'Recommended special', 'tcd-w' )
			)
		),
	)
);

$recommended_special_args = array(
	'id' => 'recommend_meta_box',
	'title' => __( 'Recommended special', 'tcd-w' ),
	'context' => 'side',
  'screen' => array( 'special' ),
	'fields' => $recommended_special_fields
);

$recommended_special_meta_box = new TCD_Meta_Box( $recommended_special_args );

/**
 * Modify the main query of archive-special.php
 */
function special_pre_get_posts( $query ) {

  $dp_options = get_design_plus_options();

  if ( is_admin() || ! $query->is_main_query() || ! $query->is_post_type_archive( 'special' ) ) {
    return;
  }

  $query->set( 'posts_per_page', $dp_options['special_archive_num'] );

}

add_action( 'pre_get_posts', 'special_pre_get_posts' );
