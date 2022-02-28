<?php
/*
 * Manage 404 tab
 */

// Add default values
add_filter( 'before_getting_design_plus_option', 'add_404_dp_default_options' );

// Add label of 404 tab
add_action( 'tcd_tab_labels', 'add_404_tab_label' );

// Add HTML of 404 tab
add_action( 'tcd_tab_panel', 'add_404_tab_panel' );

// Register sanitize function
add_filter( 'theme_options_validate', 'add_404_theme_options_validate' );

function add_404_dp_default_options( $dp_default_options ) {

	$dp_default_options['404_ph_key_color'] = '#b2b200';
	$dp_default_options['404_ph_1_title'] = '404';
	$dp_default_options['404_ph_1_title_font_size'] = 50;
	$dp_default_options['404_ph_1_sub'] = '';
	$dp_default_options['404_ph_2_title'] = __( '404 Not Found', 'tcd-w' );
	$dp_default_options['404_ph_2_title_font_size'] = 32;
	$dp_default_options['404_ph_2_desc'] = '';
	$dp_default_options['404_ph_2_img'] = '';

	return $dp_default_options;
}

function add_404_tab_label( $tab_labels ) {
	$tab_labels['404'] = __( '404 page', 'tcd-w' );
	return $tab_labels;
}

function add_404_tab_panel( $dp_options ) {
	global $dp_default_options;
?>
<div id="tab-content-404">
	<div class="theme_option_field cf">
  	<h3 class="theme_option_headline"><?php _e( 'Page header settings', 'tcd-w' ); ?></h3>
    <p class="u-center"><img src="<?php echo get_template_directory_uri(); ?>/admin/assets/images/page_header.png" alt=""></p>
    <h4 class="theme_option_headline2"><?php _e( 'Key color', 'tcd-w' ); ?></h4>
    <input type="text" class="c-color-picker" name="dp_options[404_ph_key_color]" value="<?php echo esc_attr( $dp_options['404_ph_key_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['404_ph_key_color'] ); ?>">
    <h4 class="theme_option_headline2"><?php _e( 'Title of #1', 'tcd-w' ); ?></h4>
    <input type="text" class="regular-text" name="dp_options[404_ph_1_title]" value="<?php echo esc_attr( $dp_options['404_ph_1_title'] ); ?>">
    <p><?php _e( 'Font size', 'tcd-w' ); ?> <input type="number" class="tiny-text" min="1" step="1" name="dp_options[404_ph_1_title_font_size]" value="<?php echo esc_attr( $dp_options['404_ph_1_title_font_size'] ); ?>"> px</p>
    <h4 class="theme_option_headline2"><?php _e( 'Sub title of #1', 'tcd-w' ); ?></h4>
    <input type="text" class="regular-text" name="dp_options[404_ph_1_sub]" value="<?php echo esc_attr( $dp_options['404_ph_1_sub'] ); ?>">
    <h4 class="theme_option_headline2"><?php _e( 'Title of #2', 'tcd-w' ); ?></h4>
    <input type="text" class="regular-text" name="dp_options[404_ph_2_title]" value="<?php echo esc_attr( $dp_options['404_ph_2_title'] ); ?>">
    <p><?php _e( 'Font size', 'tcd-w' ); ?> <input type="number" class="tiny-text" min="1" step="1" name="dp_options[404_ph_2_title_font_size]" value="<?php echo esc_attr( $dp_options['404_ph_2_title_font_size'] ); ?>"> px</p>
    <h4 class="theme_option_headline2"><?php _e( 'Description of #2', 'tcd-w' ); ?></h4>
    <textarea class="large-text" name="dp_options[404_ph_2_desc]"><?php echo esc_textarea( $dp_options['404_ph_2_desc'] ); ?></textarea>
    <h4 class="theme_option_headline2"><?php _e( 'Background image of #2', 'tcd-w' ); ?></h4>
    <p><?php _e( 'Recommended image size. Width: 1450px, Height: 480px', 'tcd-w' ); ?></p>
  	<div class="image_box cf">
  		<div class="cf cf_media_field hide-if-no-js 404_ph_2_img">
  			<input type="hidden" value="<?php echo esc_attr( $dp_options['404_ph_2_img'] ); ?>" id="404_ph_2_img" name="dp_options[404_ph_2_img]" class="cf_media_id">
  			<div class="preview_field"><?php if ( $dp_options['404_ph_2_img'] ) { echo wp_get_attachment_image( $dp_options['404_ph_2_img'], 'medium' ); } ?></div>
  			<div class="button_area">
  				<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
  				<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $dp_options['404_ph_2_img'] ) { echo 'hidden'; } ?>">
  			</div>
  		</div>
  	</div>
    <input type="submit" class="button-ml ajax_button" value="<?php echo _e( 'Save Changes', 'tcd-w' ); ?>">
	</div>
</div><!-- END #tab-content4 -->
<?php
}

function add_404_theme_options_validate( $input ) {

 	$input['404_ph_key_color'] = sanitize_hex_color( $input['404_ph_key_color'] );
 	$input['404_ph_1_title'] = sanitize_textarea_field( $input['404_ph_1_title'] );
 	$input['404_ph_1_title_font_size'] = absint( $input['404_ph_1_title_font_size'] );
 	$input['404_ph_1_sub'] = sanitize_textarea_field( $input['404_ph_1_sub'] );
 	$input['404_ph_2_title'] = sanitize_textarea_field( $input['404_ph_2_title'] );
 	$input['404_ph_2_title_font_size'] = absint( $input['404_ph_2_title_font_size'] );
 	$input['404_ph_2_desc'] = sanitize_textarea_field( $input['404_ph_2_desc'] );
 	$input['404_ph_2_img'] = absint( $input['404_ph_2_img'] );

	return $input;
}
