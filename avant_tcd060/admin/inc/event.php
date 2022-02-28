<?php
/*
 * Manage event tab
 */

// Add default values
add_filter( 'before_getting_design_plus_option', 'add_event_dp_default_options' );

//  Add label of event tab
add_action( 'tcd_tab_labels', 'add_event_tab_label' );

// Add HTML of event tab
add_action( 'tcd_tab_panel', 'add_event_tab_panel' );

// Register sanitize function
add_filter( 'theme_options_validate', 'add_event_theme_options_validate' );

// Calendar type
global $event_calendar_type_options;
$event_calendar_type_options = array(
  'type1' => array( 'value' => 'type1', 'label' => __( 'Japanese', 'tcd-w' ) ),
  'type2' => array( 'value' => 'type2', 'label' => __( 'English', 'tcd-w' ) )
);

function add_event_dp_default_options( $dp_default_options ) {

  // Event page
  $dp_default_options['event_breadcrumb'] = __( 'Event', 'tcd-w' );
  $dp_default_options['event_slug'] = 'event';

  // Event tag
	$dp_default_options['event_tag_slug'] = 'event_tag';

  // Archive page
	$dp_default_options['event_ph_key_color'] = '#ff8000';
	$dp_default_options['event_ph_1_title'] = 'EVENT';
	$dp_default_options['event_ph_1_title_font_size'] = 50;
	$dp_default_options['event_ph_1_sub'] = __( 'Event', 'tcd-w' );
	$dp_default_options['event_ph_2_title'] = __( 'Title here. Title here.', 'tcd-w' );
	$dp_default_options['event_ph_2_title_font_size'] = 32;
	$dp_default_options['event_ph_2_desc'] = __( "Description here. Description here. Description here. \nDescription here. Description here.", 'tcd-w' );
	$dp_default_options['event_ph_2_img'] = '';

  // Archive page
	$dp_default_options['event_archive_title'] = '';
	$dp_default_options['event_archive_sub'] = '';

  // Past event page
	$dp_default_options['past_event_url'] = '';
	$dp_default_options['past_event_title'] = '';
	$dp_default_options['past_event_sub'] = '';

  // Single page
	$dp_default_options['event_title_font_size'] = 32;
	$dp_default_options['event_title_font_size_sp'] = 22;
	$dp_default_options['event_content_font_size'] = 14;
	$dp_default_options['event_content_font_size_sp'] = 14;
	$dp_default_options['display_upcoming_event'] = 1;
  $dp_default_options['upcoming_event_title'] = '';
  $dp_default_options['upcoming_event_sub'] = '';

	// Display
	$dp_default_options['event_round'] = 1;
	$dp_default_options['event_show_sns'] = 1;
	$dp_default_options['event_show_next_post'] = 1;
	$dp_default_options['event_calendar_type'] = 'type1';

	return $dp_default_options;
}

function add_event_tab_label( $tab_labels ) {
	$tab_labels['event'] = __( 'Event', 'tcd-w' );
	return $tab_labels;
}

function add_event_tab_panel( $dp_options ) {

	global $dp_default_options, $event_calendar_type_options;
?>
<div id="tab-content-event">
	<?php // Event page ?>
	<div class="theme_option_field cf">
  	<h3 class="theme_option_headline"><?php _e( 'Event page settings', 'tcd-w' ); ?></h3>
		<h4 class="theme_option_headline2"><?php _e( 'Breadcrumb settings', 'tcd-w' ); ?></h4>
		<p><?php _e( 'It is used in the breadcrumb navigation. If it is not registerd, "Event" is displayed instead.', 'tcd-w' ); ?></p>
		<p><input type="text" name="dp_options[event_breadcrumb]" value="<?php echo esc_attr( $dp_options['event_breadcrumb'] ); ?>"></p>
    <h4 class="theme_option_headline2"><?php _e( 'Slug settings', 'tcd-w' ); ?></h4>
		<p><?php _e( 'It is used in URL. You can use only alphanumeric. If it is not registerd, "event" is used instead.', 'tcd-w' ); ?></p>
		<p><?php _e( 'Note: if you want to change the slug, change permalinks from "Plain".', 'tcd-w' ); ?></p>
		<p><?php _e( 'Note: after changing the slug, you need to go to "Permalink Settings" and click "Save Changes".', 'tcd-w' ); ?></p>
		<p><input type="text" name="dp_options[event_slug]" value="<?php echo esc_attr( $dp_options['event_slug'] ); ?>"></p>
    <input type="submit" class="button-ml ajax_button" value="<?php echo _e( 'Save Changes', 'tcd-w' ); ?>">
	</div>
	<?php // Event tag ?>
	<div class="theme_option_field cf">
  	<h3 class="theme_option_headline"><?php _e( 'Event tag settings', 'tcd-w' ); ?></h3>
    <h4 class="theme_option_headline2"><?php _e( 'Slug settings', 'tcd-w' ); ?></h4>
		<p><?php _e( 'It is used in URL. You can use only alphanumeric. If it is not registerd, "event_tag" is used instead.', 'tcd-w' ); ?></p>
		<p><?php _e( 'Note: if you want to change the slug, change permalinks from "Plain".', 'tcd-w' ); ?></p>
		<p><?php _e( 'Note: after changing the slug, you need to go to "Permalink Settings" and click "Save Changes".', 'tcd-w' ); ?></p>
		<p><input type="text" name="dp_options[event_tag_slug]" value="<?php echo esc_attr( $dp_options['event_tag_slug'] ); ?>"></p>
    <input type="submit" class="button-ml ajax_button" value="<?php echo _e( 'Save Changes', 'tcd-w' ); ?>">
	</div>
	<?php // Page header ?>
	<div class="theme_option_field cf">
  	<h3 class="theme_option_headline"><?php _e( 'Page header settings', 'tcd-w' ); ?></h3>
    <p class="u-center"><img src="<?php echo get_template_directory_uri(); ?>/admin/assets/images/page_header.png" alt=""></p>
    <h4 class="theme_option_headline2"><?php _e( 'Key color', 'tcd-w' ); ?></h4>
    <input type="text" class="c-color-picker" name="dp_options[event_ph_key_color]" value="<?php echo esc_attr( $dp_options['event_ph_key_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['event_ph_key_color'] ); ?>">
    <h4 class="theme_option_headline2"><?php _e( 'Title of #1', 'tcd-w' ); ?></h4>
    <input type="text" class="regular-text" name="dp_options[event_ph_1_title]" value="<?php echo esc_attr( $dp_options['event_ph_1_title'] ); ?>">
    <p><?php _e( 'Font size', 'tcd-w' ); ?> <input type="number" class="tiny-text" min="1" step="1" name="dp_options[event_ph_1_title_font_size]" value="<?php echo esc_attr( $dp_options['event_ph_1_title_font_size'] ); ?>"> px</p>
    <h4 class="theme_option_headline2"><?php _e( 'Sub title of #1', 'tcd-w' ); ?></h4>
    <input type="text" class="regular-text" name="dp_options[event_ph_1_sub]" value="<?php echo esc_attr( $dp_options['event_ph_1_sub'] ); ?>">
    <h4 class="theme_option_headline2"><?php _e( 'Title of #2', 'tcd-w' ); ?></h4>
    <input type="text" class="regular-text" name="dp_options[event_ph_2_title]" value="<?php echo esc_attr( $dp_options['event_ph_2_title'] ); ?>">
    <p><?php _e( 'Font size', 'tcd-w' ); ?> <input type="number" class="tiny-text" min="1" step="1" name="dp_options[event_ph_2_title_font_size]" value="<?php echo esc_attr( $dp_options['event_ph_2_title_font_size'] ); ?>"> px</p>
    <h4 class="theme_option_headline2"><?php _e( 'Description of #2', 'tcd-w' ); ?></h4>
    <textarea class="large-text" name="dp_options[event_ph_2_desc]"><?php echo esc_textarea( $dp_options['event_ph_2_desc'] ); ?></textarea>
    <h4 class="theme_option_headline2"><?php _e( 'Background image of #2', 'tcd-w' ); ?></h4>
    <p><?php _e( 'Recommended image size. Width: 1450px, Height: 480px', 'tcd-w' ); ?></p>
  	<div class="image_box cf">
  		<div class="cf cf_media_field hide-if-no-js event_ph_2_img">
  			<input type="hidden" value="<?php echo esc_attr( $dp_options['event_ph_2_img'] ); ?>" id="event_ph_2_img" name="dp_options[event_ph_2_img]" class="cf_media_id">
  			<div class="preview_field"><?php if ( $dp_options['event_ph_2_img'] ) { echo wp_get_attachment_image( $dp_options['event_ph_2_img'], 'medium' ); } ?></div>
  			<div class="button_area">
  				<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
  				<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $dp_options['event_ph_2_img'] ) { echo 'hidden'; } ?>">
  			</div>
  		</div>
  	</div>
    <input type="submit" class="button-ml ajax_button" value="<?php echo _e( 'Save Changes', 'tcd-w' ); ?>">
	</div>
	<?php // Archive page ?>
	<div class="theme_option_field cf">
  	<h3 class="theme_option_headline"><?php _e( 'Archive page settings', 'tcd-w' ); ?></h3>
    <h4 class="theme_option_headline2"><?php _e( 'Title of event list', 'tcd-w' ); ?></h4>
    <input type="text" class="regular-text" name="dp_options[event_archive_title]" value="<?php echo esc_attr( $dp_options['event_archive_title'] ); ?>">
    <h4 class="theme_option_headline2"><?php _e( 'Sub title of event list', 'tcd-w' ); ?></h4>
    <input type="text" class="regular-text" name="dp_options[event_archive_sub]" value="<?php echo esc_attr( $dp_options['event_archive_sub'] ); ?>">
    <input type="submit" class="button-ml ajax_button" value="<?php echo _e( 'Save Changes', 'tcd-w' ); ?>">
	</div>
	<?php // Past event page ?>
	<div class="theme_option_field cf">
  	<h3 class="theme_option_headline"><?php _e( 'Past event page settings', 'tcd-w' ); ?></h3>
    <p><?php _e( 'A post which event date is the past date is displayed in the past event page.', 'tcd-w' ); ?></p>
    <p><?php _e( 'Please create a page to display past events with template "Past event list".', 'tcd-w' ); ?></p>
    <h4 class="theme_option_headline2"><?php _e( 'The URL of the past event page', 'tcd-w' ); ?></h4>
    <p><?php _e( 'Please input the URL of the page below. The URL is used in event archives and event tag archives.', 'tcd-w' ); ?></p>
    <input class="regular-text" type="text" name="dp_options[past_event_url]" value="<?php echo esc_attr( $dp_options['past_event_url'] ); ?>">
    <h4 class="theme_option_headline2"><?php _e( 'Title of event list', 'tcd-w' ); ?></h4>
    <input type="text" class="regular-text" name="dp_options[past_event_title]" value="<?php echo esc_attr( $dp_options['past_event_title'] ); ?>">
    <h4 class="theme_option_headline2"><?php _e( 'Sub title of event list', 'tcd-w' ); ?></h4>
    <input type="text" class="regular-text" name="dp_options[past_event_sub]" value="<?php echo esc_attr( $dp_options['past_event_sub'] ); ?>">
    <input type="submit" class="button-ml ajax_button" value="<?php echo _e( 'Save Changes', 'tcd-w' ); ?>">
	</div>
	<?php // Single page ?>
  <div class="theme_option_field cf">
  	<h3 class="theme_option_headline"><?php _e( 'Single Page Settings', 'tcd-w' ); ?></h3>
  	<h4 class="theme_option_headline2"><?php _e( 'Font size settings', 'tcd-w' ); ?></h4>
  	<p><label><?php _e( 'Post title', 'tcd-w' ); ?> <input class="hankaku tiny-text" type="number" min="1" step="1" name="dp_options[event_title_font_size]" value="<?php echo esc_attr( $dp_options['event_title_font_size'] ); ?>"> <span>px</span></label></p>
  	<p><label><?php _e( 'Post title (mobile)', 'tcd-w' ); ?> <input class="hankaku tiny-text" type="number" min="1" step="1" name="dp_options[event_title_font_size_sp]" value="<?php echo esc_attr( $dp_options['event_title_font_size_sp'] ); ?>"> <span>px</span></label></p>
  	<p><label><?php _e( 'Post contents', 'tcd-w' ); ?> <input class="hankaku tiny-text" type="number" min="1" step="1" name="dp_options[event_content_font_size]" value="<?php echo esc_attr( $dp_options['event_content_font_size'] ); ?>"> <span>px</span></label></p>
  	<p><label><?php _e( 'Post contents (mobile)', 'tcd-w' ); ?> <input class="hankaku tiny-text" type="number" min="1" step="1" name="dp_options[event_content_font_size_sp]" value="<?php echo esc_attr( $dp_options['event_content_font_size_sp'] ); ?>"> <span>px</span></label></p>
    <h4 class="theme_option_headline2"><?php _e( 'Upcoming event settings', 'tcd-w' ); ?></h4>
    <p><label><input name="dp_options[display_upcoming_event]" type="checkbox" value="1" <?php checked( '1', $dp_options['display_upcoming_event'] ); ?>><?php _e( 'Display upcoming event', 'tcd-w' ); ?></label></p>
		<p><?php _e( 'Title', 'tcd-w' ); ?> <input type="text" class="regular-text" name="dp_options[upcoming_event_title]" value="<?php echo esc_attr( $dp_options['upcoming_event_title'] ); ?>"></p>
		<p><?php _e( 'Sub title', 'tcd-w' ); ?> <input type="text" class="regular-text" name="dp_options[upcoming_event_sub]" value="<?php echo esc_attr( $dp_options['upcoming_event_sub'] ); ?>"></p>
  	<input type="submit" class="button-ml ajax_button" value="<?php _e( 'Save Changes', 'tcd-w' ); ?>">
	</div>
	<?php // Display ?>
  <div class="theme_option_field cf">
  	<h3 class="theme_option_headline"><?php _e( 'Display settings', 'tcd-w' ); ?></h3>
    <ul>
    	<li><label><input name="dp_options[event_round]" type="checkbox" value="1" <?php checked( '1', $dp_options['event_round'] ); ?>><?php _e( 'Apply rounded corners to event archives', 'tcd-w' ); ?></label></li>
    	<li><label><input name="dp_options[event_show_sns]" type="checkbox" value="1" <?php checked( '1', $dp_options['event_show_sns'] ); ?>><?php _e( 'Display share buttons after the article', 'tcd-w' ); ?></label></li>
    	<li><label><input name="dp_options[event_show_next_post]" type="checkbox" value="1" <?php checked( '1', $dp_options['event_show_next_post'] ); ?>><?php _e( 'Display next previous post link', 'tcd-w' ); ?></label></li>
    </ul>
    <h4 class="theme_option_headline2"><?php _e( 'Event calendar type', 'tcd-w' ); ?></h4>
    <p><?php _e( 'Please select which language to use to display months.', 'tcd-w' ); ?></p>
    <?php foreach ( $event_calendar_type_options as $option ) : ?>
    <p><label><input type="radio" name="dp_options[event_calendar_type]" value="<?php echo esc_attr( $option['value'] ); ?>" <?php checked( $option['value'], $dp_options['event_calendar_type'] ); ?>> <?php echo esc_html( $option['label'] ); ?> </label></p>
    <?php endforeach; ?>
    <input type="submit" class="button-ml ajax_button" value="<?php _e( 'Save Changes', 'tcd-w' ); ?>">
	</div>
</div><!-- END #tab-content4 -->
<?php
}

function add_event_theme_options_validate( $input ) {

  global $event_calendar_type_options;

  // Event page
 	$input['event_breadcrumb'] = sanitize_text_field( $input['event_breadcrumb'] );
 	$input['event_slug'] = sanitize_text_field( $input['event_slug'] );

  // Event tag
 	$input['event_tag_slug'] = sanitize_text_field( $input['event_tag_slug'] );

  // Archive page
 	$input['event_ph_key_color'] = sanitize_hex_color( $input['event_ph_key_color'] );
 	$input['event_ph_1_title'] = sanitize_textarea_field( $input['event_ph_1_title'] );
 	$input['event_ph_1_title_font_size'] = absint( $input['event_ph_1_title_font_size'] );
 	$input['event_ph_1_sub'] = sanitize_textarea_field( $input['event_ph_1_sub'] );
 	$input['event_ph_2_title'] = sanitize_textarea_field( $input['event_ph_2_title'] );
 	$input['event_ph_2_title_font_size'] = absint( $input['event_ph_2_title_font_size'] );
 	$input['event_ph_2_desc'] = sanitize_textarea_field( $input['event_ph_2_desc'] );
 	$input['event_ph_2_img'] = absint( $input['event_ph_2_img'] );

  // Archive page
 	$input['event_archive_title'] = sanitize_text_field( $input['event_archive_title'] );
 	$input['event_archive_sub'] = sanitize_text_field( $input['event_archive_sub'] );

  // Past event page
 	$input['past_event_url'] = esc_url_raw( $input['past_event_url'] );
 	$input['past_event_title'] = sanitize_text_field( $input['past_event_title'] );
 	$input['past_event_sub'] = sanitize_text_field( $input['past_event_sub'] );

  // Single page
 	$input['event_title_font_size'] = absint( $input['event_title_font_size'] );
 	$input['event_title_font_size_sp'] = absint( $input['event_title_font_size_sp'] );
 	$input['event_content_font_size'] = absint( $input['event_content_font_size'] );
 	$input['event_content_font_size_sp'] = absint( $input['event_content_font_size_sp'] );
 	if ( ! isset( $input['display_upcoming_event'] ) ) $input['display_upcoming_event'] = null;
  $input['display_upcoming_event'] = ( $input['display_upcoming_event'] == 1 ? 1 : 0 );
 	$input['upcoming_event_title'] = sanitize_text_field( $input['upcoming_event_title'] );
 	$input['upcoming_event_sub'] = sanitize_text_field( $input['upcoming_event_sub'] );

 	// Display
 	if ( ! isset( $input['event_round'] ) ) $input['event_round'] = null;
  $input['event_round'] = ( $input['event_round'] == 1 ? 1 : 0 );
 	if ( ! isset( $input['event_show_sns'] ) ) $input['event_show_sns'] = null;
  $input['event_show_sns'] = ( $input['event_show_sns'] == 1 ? 1 : 0 );
 	if ( ! isset( $input['event_show_next_post'] ) ) $input['event_show_next_post'] = null;
  $input['event_show_next_post'] = ( $input['event_show_next_post'] == 1 ? 1 : 0 );
 	if ( ! isset( $input['event_calendar_type'] ) ) $input['event_calendar_type'] = null;
 	if ( ! array_key_exists( $input['event_calendar_type'], $event_calendar_type_options ) ) $input['event_calendar_type'] = null;

	return $input;
}
