<?php
$options = get_design_plus_options();

$event_label = $dp_options['event_breadcrumb'] ? $dp_options['event_breadcrumb'] : __( 'Event', 'tcd-w' );

/**
 * Add custom fields to custom taxonomy "Event category"
 */

// Add form fields to edit-tags.php (Add New Category)
function event_cat_add_form_fields() {
?>
<h3><?php _e( 'Color settings', 'tcd-w' ); ?></h3>
<div class="form-field term-color">
  <label for="color"><?php _e( 'Font color of the event tag', 'tcd-w' ); ?></label>
  <input name="color" id="color" class="c-color-picker" type="text" value="#ffffff" data-default-color="#ffffff">
</div>
<div class="form-field term-bg">
  <label for="bg"><?php _e( 'Background color of the event tag', 'tcd-w' ); ?></label>
  <input name="bg" id="bg" class="c-color-picker" type="text" value="#ff8000" data-default-color="#ff8000">
</div>
<div class="form-field term-color_hover">
  <label for="color_hover"><?php _e( 'Font color of the event tag on hover', 'tcd-w' ); ?></label>
  <input name="color_hover" id="color_hover" class="c-color-picker" type="text" value="#ffffff" data-default-color="#ffffff">
</div>
<div class="form-field term-bg_hover">
  <label for="bg_hover"><?php _e( 'Background color of the event tag on hover', 'tcd-w' ); ?></label>
  <input name="bg_hover" id="bg_hover" class="c-color-picker" type="text" value="#ff8000" data-default-color="#ff8000">
</div>
<h3><?php _e( 'Page header settings', 'tcd-w' ); ?></h3>
<div class="form-field">
  <label for="ph_key_color"><?php _e( 'Key color', 'tcd-w' ); ?></label>
  <input name="ph_key_color" id="ph_key_color" class="c-color-picker" type="text" value="#ff8000" data-default-color="#ff8000">
</div>
<div class="form-field">
  <label for="ph_1_title"><?php _e( 'Title of #1', 'tcd-w' ); ?></label>
  <input name="ph_1_title" id="ph_1_title" type="text" value="">
</div>
<div>
  <label><?php _e( 'Font size', 'tcd-w' ); ?> <input type="number" min="0" step="1" class="tiny-text" name="ph_1_title_font_size" value="50"> px</label>
</div>
<div class="form-field">
  <label for="ph_1_sub"><?php _e( 'Sub title of #1', 'tcd-w' ); ?></label>
  <input name="ph_1_sub" id="ph_1_sub" type="text" value="">
</div>
<div class="form-field">
  <label for="ph_2_title"><?php _e( 'Title of #2', 'tcd-w' ); ?></label>
  <input name="ph_2_title" id="ph_2_title" type="text" value="">
</div>
<div>
  <label><?php _e( 'Font size', 'tcd-w' ); ?>
  <input type="number" min="0" step="1" class="tiny-text" name="ph_2_title_font_size" value="32"> px</label>
</div>
<div class="form-field">
  <label for="ph_2_desc"><?php _e( 'Description of #2', 'tcd-w' ); ?></label>
  <textarea name="ph_2_desc" id="ph_2_desc"></textarea>
</div>
<div class="form-field">
  <p class="description"><?php _e( 'Recommended image size. Width: 1450px, Height: 480px', 'tcd-w' ); ?></p>
  <div class="image_box cf">
  	<div class="cf cf_media_field hide-if-no-js">
  		<input type="hidden" value="" id="ph_2_img" name="ph_2_img" class="cf_media_id">
  		<div class="preview_field"></div>
  		<div class="button_area">
  			<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
  			<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button hidden">
  		</div>
  	</div>
  </div>
</div>
<?php
}

// Add form fields to term.php (Edit Category)
function event_cat_edit_form_fields( $tag ) {
  $ph_2_img = get_term_meta( $tag->term_id, 'ph_2_img', true );
?>
</table>
<h2><?php _e( 'Color settings', 'tcd-w' ); ?></h2>
<table class="form-table">
  <tr class="form-field term-color-wrap">
  	<th scope="row"><label for="color"><?php _e( 'Font color of the event tag', 'tcd-w' ); ?></label></th>
    <td>
      <input name="color" id="color" class="c-color-picker" type="text" value="<?php echo esc_attr( get_term_meta( $tag->term_id, 'color', true ) ); ?>" data-default-color="#ffffff">
    </td>
  </tr>
  <tr class="form-field term-bg-wrap">
  	<th scope="row"><label for="bg"><?php _e( 'Background color of the event tag', 'tcd-w' ); ?></label></th>
    <td>
      <input name="bg" id="bg" class="c-color-picker" type="text" value="<?php echo esc_attr( get_term_meta( $tag->term_id, 'bg', true ) ); ?>" data-default-color="#ff8000">
    </td>
  </tr>
  <tr class="form-field term-color_hover-wrap">
  	<th scope="row"><label for="color_hover"><?php _e( 'Font color of the event tag on hover', 'tcd-w' ); ?></label></th>
    <td>
      <input name="color_hover" id="color_hover" class="c-color-picker" type="text" value="<?php echo esc_attr( get_term_meta( $tag->term_id, 'color_hover', true ) ); ?>" data-default-color="#ffffff">
    </td>
  </tr>
  <tr class="form-field term-bg_hover-wrap">
  	<th scope="row"><label for="bg_hover"><?php _e( 'Background color of the event tag on hover', 'tcd-w' ); ?></label></th>
    <td>
      <input name="bg_hover" id="bg_hover" class="c-color-picker" type="text" value="<?php echo esc_attr( get_term_meta( $tag->term_id, 'bg_hover', true ) ); ?>" data-default-color="#ff8000">
    </td>
  </tr>
</table>
<h2><?php _e( 'Page header settings', 'tcd-w' ); ?></h2>
<table class="form-table">
  <tr>
  	<th scope="row"><label for="ph_key_color"><?php _e( 'Key color', 'tcd-w' ); ?></label></th>
    <td>
      <input name="ph_key_color" id="ph_key_color" class="c-color-picker" type="text" value="<?php echo esc_attr( get_term_meta( $tag->term_id, 'ph_key_color', true ) ); ?>" data-default-color="#ff8000">
    </td>
  </tr>
  <tr>
  	<th scope="row"><label for="ph_1_title"><?php _e( 'Title of #1', 'tcd-w' ); ?></label></th>
    <td>
      <input name="ph_1_title" id="ph_1_title" class="large-text" type="text" value="<?php echo esc_attr( get_term_meta( $tag->term_id, 'ph_1_title', true ) ); ?>">
      <p><label><?php _e( 'Font size', 'tcd-w' ); ?> <input type="number" min="0" step="1" name="ph_1_title_font_size" id="ph_1_title_font_size" class="tiny-text" value="<?php echo esc_attr( get_term_meta( $tag->term_id, 'ph_1_title_font_size', true ) ); ?>"> px</label></p>
    </td>
  </tr>
  <tr>
  	<th scope="row"><label for="ph_1_sub"><?php _e( 'Sub title of #1', 'tcd-w' ); ?></label></th>
    <td>
      <input name="ph_1_sub" id="ph_1_sub" class="large-text" type="text" value="<?php echo esc_attr( get_term_meta( $tag->term_id, 'ph_1_sub', true ) ); ?>">
    </td>
  </tr>
  <tr>
  	<th scope="row"><label for="ph_2_title"><?php _e( 'Title of #2', 'tcd-w' ); ?></label></th>
    <td>
      <input name="ph_2_title" id="ph_2_title" class="large-text" type="text" value="<?php echo esc_attr( get_term_meta( $tag->term_id, 'ph_2_title', true ) ); ?>">
      <p><label><?php _e( 'Font size', 'tcd-w' ); ?> <input type="number" min="0" step="1" name="ph_2_title_font_size" id="ph_2_title_font_size" class="tiny-text" value="<?php echo esc_attr( get_term_meta( $tag->term_id, 'ph_2_title_font_size', true ) ); ?>"> px</label></p>
    </td>
  </tr>
  <tr>
  	<th scope="row"><label for="ph_2_desc"><?php _e( 'Description of #2', 'tcd-w' ); ?></label></th>
    <td>
      <textarea name="ph_2_desc" id="ph_2_desc" class="large-text"><?php echo esc_textarea( get_term_meta( $tag->term_id, 'ph_2_desc', true ) ); ?></textarea>
    </td>
  </tr>
  <tr class="form-field">
  	<th scope="row"><label for="ph_2_img"><?php _e( 'Background image of #2', 'tcd-w' ); ?></label></th>
    <td>
			<p class="description"><?php _e( 'Recommended image size. Width: 1450px, Height: 480px', 'tcd-w' ); ?></p>
			<div class="image_box cf">
				<div class="cf cf_media_field hide-if-no-js">
					<input type="hidden" value="<?php if ( isset( $ph_2_img ) ) { echo esc_attr( $ph_2_img ); } ?>" id="ph_2_img" name="ph_2_img" class="cf_media_id">
					<div class="preview_field"><?php if ( isset( $ph_2_img ) ) { echo wp_get_attachment_image( $ph_2_img, 'medium' ); } ?></div>
					<div class="button_area">
						<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
						<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! isset( $ph_2_img ) ) { echo 'hidden'; } ?>">
					</div>
				</div>
			</div>
    </td>
  </tr>
</table>
<?php
}

// Save
function event_cat_update_term_meta( $term_id ) {

  $meta_keys = array(
		'color',
		'bg',
    'color_hover',
    'bg_hover',
    'ph_key_color',
    'ph_1_title',
    'ph_1_title_font_size',
    'ph_1_sub',
    'ph_2_title',
    'ph_2_title_font_size',
    'ph_2_desc',
    'ph_2_img'
  );

  foreach ( $meta_keys as $meta_key ) {

    $old = get_term_meta( $term_id, $meta_key, true );
    $new = isset( $_POST[$meta_key] ) ? $_POST[$meta_key] : '';

    if ( $new && $new !== $old ) {
      update_term_meta( $term_id, $meta_key, $new );
    } elseif ( '' === $new && $old ) {
      delete_term_meta( $term_id, $meta_key, $old );
    }

  }
}

add_action( 'event_tag_add_form_fields', 'event_cat_add_form_fields' );
add_action( 'event_tag_edit_form_fields', 'event_cat_edit_form_fields' );
add_action( 'created_event_tag', 'event_cat_update_term_meta' );
add_action( 'edited_event_tag', 'event_cat_update_term_meta' );

/*
 * Add a meta box of event date
 */
$event_date_fields = array(
	array(
		'id' => 'event_date',
		'title' => '',
    'description' => sprintf( __( 'Please set the date of this %s. If you use Safari or IE11, please input the date in YYYY-MM-DD format. e.g. 2018-06-01', 'tcd-w' ), $event_label ),
		'type' => 'date',
	),
);
$event_date_args = array(
	'id' => 'event_date_meta_box',
	'title' => __( 'Event date settings', 'tcd-w' ),
	'screen' => array( 'event' ),
	'context' => 'side',
	'fields' => $event_date_fields
);
$event_date_meta_box = new TCD_Meta_Box( $event_date_args );
