<?php
/*
 * Manage special tab
 */

// Add default values
add_filter( 'before_getting_design_plus_option', 'add_special_dp_default_options' );

//  Add label of special tab
add_action( 'tcd_tab_labels', 'add_special_tab_label' );

// Add HTML of special tab
add_action( 'tcd_tab_panel', 'add_special_tab_panel' );

// Register sanitize function
add_filter( 'theme_options_validate', 'add_special_theme_options_validate' );

function add_special_dp_default_options( $dp_default_options ) {

  // Page header
	$dp_default_options['special_ph_key_color'] = '#ff5959';
	$dp_default_options['special_ph_1_title'] = 'SPECIAL';
	$dp_default_options['special_ph_1_title_font_size'] = 50;
	$dp_default_options['special_ph_1_sub'] = __( 'Special', 'tcd-w' );
	$dp_default_options['special_ph_2_title'] = __( 'Title here. Title here.', 'tcd-w' );
	$dp_default_options['special_ph_2_title_font_size'] = 32;
	$dp_default_options['special_ph_2_desc'] = __( "Description here. Description here. Description here. \nDescription here. Description here. Description here. Description here. Description here.", 'tcd-w' );
	$dp_default_options['special_ph_2_img'] = '';

  // Archive page
	$dp_default_options['special_archive_num'] = 8;

  // Single page
	$dp_default_options['special_title_font_size'] = 32;
	$dp_default_options['special_title_font_size_sp'] = 22;
	$dp_default_options['special_content_font_size'] = 14;
	$dp_default_options['special_content_font_size_sp'] = 14;

	// Display
	$dp_default_options['special_show_date'] = 1;
	$dp_default_options['special_show_sns'] = 1;
	$dp_default_options['special_show_next_post'] = 1;
	$dp_default_options['display_latest_special'] = 1;
  $dp_default_options['latest_special_title'] = '';
  $dp_default_options['latest_special_sub'] = '';
  $dp_default_options['special_breadcrumb'] = __( 'Special', 'tcd-w' );
  $dp_default_options['special_slug'] = 'special';

	return $dp_default_options;
}

function add_special_tab_label( $tab_labels ) {
	$tab_labels['special'] = __( 'Special', 'tcd-w' );
	return $tab_labels;
}

function add_special_tab_panel( $dp_options ) {

	global $dp_default_options;
?>
<div id="tab-content-special">
	<?php // Special page ?>
	<div class="theme_option_field cf">
  	<h3 class="theme_option_headline"><?php _e( 'Special page settings', 'tcd-w' ); ?></h3>
		<h4 class="theme_option_headline2"><?php _e( 'Breadcrumb settings', 'tcd-w' ); ?></h4>
		<p><?php _e( 'It is used in the breadcrumb navigation. If it is not registerd, "Special" is displayed instead.', 'tcd-w' ); ?></p>
		<p><input type="text" name="dp_options[special_breadcrumb]" value="<?php echo esc_attr( $dp_options['special_breadcrumb'] ); ?>"></p>
    <h4 class="theme_option_headline2"><?php _e( 'Slug settings', 'tcd-w' ); ?></h4>
		<p><?php _e( 'It is used in URL. You can use only alphanumeric. If it is not registerd, "special" is used instead.', 'tcd-w' ); ?></p>
		<p><?php _e( 'Note: if you want to change the slug, change permalinks from "Plain".', 'tcd-w' ); ?></p>
		<p><?php _e( 'Note: after changing the slug, you need to go to "Permalink Settings" and click "Save Changes".', 'tcd-w' ); ?></p>
		<p><input type="text" name="dp_options[special_slug]" value="<?php echo esc_attr( $dp_options['special_slug'] ); ?>"></p>
    <input type="submit" class="button-ml ajax_button" value="<?php echo _e( 'Save Changes', 'tcd-w' ); ?>">
	</div>
	<?php // Page header ?>
	<div class="theme_option_field cf">
  	<h3 class="theme_option_headline"><?php _e( 'Page header settings', 'tcd-w' ); ?></h3>
    <p class="u-center"><img src="<?php echo get_template_directory_uri(); ?>/admin/assets/images/page_header.png" alt=""></p>
    <h4 class="theme_option_headline2"><?php _e( 'Key color', 'tcd-w' ); ?></h4>
    <input type="text" class="c-color-picker" name="dp_options[special_ph_key_color]" value="<?php echo esc_attr( $dp_options['special_ph_key_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['special_ph_key_color'] ); ?>">
    <h4 class="theme_option_headline2"><?php _e( 'Title of #1', 'tcd-w' ); ?></h4>
    <input type="text" class="regular-text" name="dp_options[special_ph_1_title]" value="<?php echo esc_attr( $dp_options['special_ph_1_title'] ); ?>">
    <p><?php _e( 'Font size', 'tcd-w' ); ?> <input type="number" class="tiny-text" min="1" step="1" name="dp_options[special_ph_1_title_font_size]" value="<?php echo esc_attr( $dp_options['special_ph_1_title_font_size'] ); ?>"> px</p>
    <h4 class="theme_option_headline2"><?php _e( 'Sub title of #1', 'tcd-w' ); ?></h4>
    <input type="text" class="regular-text" name="dp_options[special_ph_1_sub]" value="<?php echo esc_attr( $dp_options['special_ph_1_sub'] ); ?>">
    <h4 class="theme_option_headline2"><?php _e( 'Title of #2', 'tcd-w' ); ?></h4>
    <input type="text" class="regular-text" name="dp_options[special_ph_2_title]" value="<?php echo esc_attr( $dp_options['special_ph_2_title'] ); ?>">
    <p><?php _e( 'Font size', 'tcd-w' ); ?> <input type="number" class="tiny-text" min="1" step="1" name="dp_options[special_ph_2_title_font_size]" value="<?php echo esc_attr( $dp_options['special_ph_2_title_font_size'] ); ?>"> px</p>
    <h4 class="theme_option_headline2"><?php _e( 'Description of #2', 'tcd-w' ); ?></h4>
    <textarea class="large-text" name="dp_options[special_ph_2_desc]"><?php echo esc_textarea( $dp_options['special_ph_2_desc'] ); ?></textarea>
    <h4 class="theme_option_headline2"><?php _e( 'Background image of #2', 'tcd-w' ); ?></h4>
    <p><?php _e( 'Recommended image size. Width: 1450px, Height: 480px', 'tcd-w' ); ?></p>
  	<div class="image_box cf">
  		<div class="cf cf_media_field hide-if-no-js special_ph_2_img">
  			<input type="hidden" value="<?php echo esc_attr( $dp_options['special_ph_2_img'] ); ?>" id="special_ph_2_img" name="dp_options[special_ph_2_img]" class="cf_media_id">
  			<div class="preview_field"><?php if ( $dp_options['special_ph_2_img'] ) { echo wp_get_attachment_image( $dp_options['special_ph_2_img'], 'medium' ); } ?></div>
  			<div class="button_area">
  				<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
  				<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $dp_options['special_ph_2_img'] ) { echo 'hidden'; } ?>">
  			</div>
  		</div>
  	</div>
    <input type="submit" class="button-ml ajax_button" value="<?php echo _e( 'Save Changes', 'tcd-w' ); ?>">
	</div>
	<?php // Archive page ?>
  <div class="theme_option_field cf">
  	<h3 class="theme_option_headline"><?php _e( 'Archive Page Settings', 'tcd-w' ); ?></h3>
  	<h4 class="theme_option_headline2"><?php _e( 'The number of posts to display', 'tcd-w' ); ?></h4>
    <input class="hankaku tiny-text" type="number" min="1" step="1" name="dp_options[special_archive_num]" value="<?php echo esc_attr( $dp_options['special_archive_num'] ); ?>"><?php _e( ' posts', 'tcd-w' ); ?>
  	<input type="submit" class="button-ml ajax_button" value="<?php _e( 'Save Changes', 'tcd-w' ); ?>">
	</div>
	<?php // Single page ?>
  <div class="theme_option_field cf">
  	<h3 class="theme_option_headline"><?php _e( 'Single Page Settings', 'tcd-w' ); ?></h3>
  	<h4 class="theme_option_headline2"><?php _e( 'Font size of post title', 'tcd-w' ); ?></h4>
  	<input class="hankaku tiny-text" type="number" min="1" step="1" name="dp_options[special_title_font_size]" value="<?php echo esc_attr( $dp_options['special_title_font_size'] ); ?>"> <span>px</span>
  	<h4 class="theme_option_headline2"><?php _e( 'Font size of post title (mobile)', 'tcd-w' ); ?></h4>
  	<input class="hankaku tiny-text" type="number" min="1" step="1" name="dp_options[special_title_font_size_sp]" value="<?php echo esc_attr( $dp_options['special_title_font_size_sp'] ); ?>"> <span>px</span>
  	<h4 class="theme_option_headline2"><?php _e( 'Font size of post contents', 'tcd-w' ); ?></h4>
  	<input class="hankaku tiny-text" type="number" min="1" step="1" name="dp_options[special_content_font_size]" value="<?php echo esc_attr( $dp_options['special_content_font_size'] ); ?>"> <span>px</span>
  	<h4 class="theme_option_headline2"><?php _e( 'Font size of post contents (mobile)', 'tcd-w' ); ?></h4>
  	<input class="hankaku tiny-text" type="number" min="1" step="1" name="dp_options[special_content_font_size_sp]" value="<?php echo esc_attr( $dp_options['special_content_font_size_sp'] ); ?>"> <span>px</span>
  	<input type="submit" class="button-ml ajax_button" value="<?php _e( 'Save Changes', 'tcd-w' ); ?>">
	</div>
	<?php // Display ?>
  <div class="theme_option_field cf">
  	<h3 class="theme_option_headline"><?php _e( 'Display settings', 'tcd-w' ); ?></h3>
    <ul>
    	<li><label><input name="dp_options[special_show_date]" type="checkbox" value="1" <?php checked( '1', $dp_options['special_show_date'] ); ?>><?php _e( 'Display date', 'tcd-w' ); ?></label></li>
    	<li><label><input name="dp_options[special_show_sns]" type="checkbox" value="1" <?php checked( '1', $dp_options['special_show_sns'] ); ?>><?php _e( 'Display share buttons after the article', 'tcd-w' ); ?></label></li>
    	<li><label><input name="dp_options[special_show_next_post]" type="checkbox" value="1" <?php checked( '1', $dp_options['special_show_next_post'] ); ?>><?php _e( 'Display next previous post link', 'tcd-w' ); ?></label></li>
    	<li><label><input name="dp_options[display_latest_special]" type="checkbox" value="1" <?php checked( '1', $dp_options['display_latest_special'] ); ?>><?php _e( 'Display latest special', 'tcd-w' ); ?></label></li>
    </ul>
    <h4 class="theme_option_headline2"><?php _e( 'Title of latest special', 'tcd-w' ); ?></h4>
		<p><input type="text" class="regular-text" name="dp_options[latest_special_title]" value="<?php echo esc_attr( $dp_options['latest_special_title'] ); ?>"></p>
    <h4 class="theme_option_headline2"><?php _e( 'Sub title of latest special', 'tcd-w' ); ?></h4>
		<p><input type="text" class="regular-text" name="dp_options[latest_special_sub]" value="<?php echo esc_attr( $dp_options['latest_special_sub'] ); ?>"></p>
    <input type="submit" class="button-ml ajax_button" value="<?php _e( 'Save Changes', 'tcd-w' ); ?>">
	</div>
</div><!-- END #tab-content4 -->
<?php
}

function add_special_theme_options_validate( $input ) {

  // Special page
 	$input['special_breadcrumb'] = sanitize_text_field( $input['special_breadcrumb'] );
 	$input['special_slug'] = sanitize_text_field( $input['special_slug'] );

  // Page header
 	$input['special_ph_key_color'] = sanitize_hex_color( $input['special_ph_key_color'] );
 	$input['special_ph_1_title'] = sanitize_textarea_field( $input['special_ph_1_title'] );
 	$input['special_ph_1_title_font_size'] = absint( $input['special_ph_1_title_font_size'] );
 	$input['special_ph_1_sub'] = sanitize_textarea_field( $input['special_ph_1_sub'] );
 	$input['special_ph_2_title'] = sanitize_textarea_field( $input['special_ph_2_title'] );
 	$input['special_ph_2_title_font_size'] = absint( $input['special_ph_2_title_font_size'] );
 	$input['special_ph_2_desc'] = sanitize_textarea_field( $input['special_ph_2_desc'] );
 	$input['special_ph_2_img'] = absint( $input['special_ph_2_img'] );

  // Archive page
 	$input['special_archive_num'] = absint( $input['special_archive_num'] );

  // Single page
 	$input['special_title_font_size'] = absint( $input['special_title_font_size'] );
 	$input['special_title_font_size_sp'] = absint( $input['special_title_font_size_sp'] );
 	$input['special_content_font_size'] = absint( $input['special_content_font_size'] );
 	$input['special_content_font_size_sp'] = absint( $input['special_content_font_size_sp'] );

 	// Display
 	if ( ! isset( $input['special_show_date'] ) ) $input['special_show_date'] = null;
  $input['special_show_date'] = ( $input['special_show_date'] == 1 ? 1 : 0 );
 	if ( ! isset( $input['special_show_sns'] ) ) $input['special_show_sns'] = null;
  $input['special_show_sns'] = ( $input['special_show_sns'] == 1 ? 1 : 0 );
 	if ( ! isset( $input['special_show_next_post'] ) ) $input['special_show_next_post'] = null;
  $input['special_show_next_post'] = ( $input['special_show_next_post'] == 1 ? 1 : 0 );
 	if ( ! isset( $input['display_latest_special'] ) ) $input['display_latest_special'] = null;
  $input['display_latest_special'] = ( $input['display_latest_special'] == 1 ? 1 : 0 );
 	$input['latest_special_title'] = sanitize_text_field( $input['latest_special_title'] );
 	$input['latest_special_sub'] = sanitize_text_field( $input['latest_special_sub'] );

	return $input;
}
