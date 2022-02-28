<?php
/*
 * Manage header tab
 */

// Add default values
add_filter( 'before_getting_design_plus_option', 'add_header_dp_default_options' );

// Add label of header tab
add_action( 'tcd_tab_labels', 'add_header_tab_label' );

// Add HTML of header tab
add_action( 'tcd_tab_panel', 'add_header_tab_panel' );

// Register sanitize function
add_filter( 'theme_options_validate', 'add_header_theme_options_validate' );

global $header_fix_options;
$header_fix_options = array(
	'type1' => array(
		'value' => 'type1',
		'label' => __( 'Normal header', 'tcd-w' )
	),
 	'type2' => array(
		'value' => 'type2',
		'label' => __( 'Fix at top after page scroll', 'tcd-w' )
	),
);

global $header_search_type_options;
$header_search_type_options = array(
	'type1' => array(
		'value' => 'type1',
		'label' => __( 'Normal', 'tcd-w' )
	),
 	'type2' => array(
		'value' => 'type2',
		'label' => __( 'Google Custom Search', 'tcd-w' )
	),
 	'type3' => array(
		'value' => 'type3',
		'label' => __( 'Hidden', 'tcd-w' )
	),
);

global $gnav_item_icon_type_options;
$gnav_item_icon_type_options = array(
  'type1' => array(
    'value' => 'type1',
    'label' => __( 'Use an icon font', 'tcd-w' )
  ),
  'type2' => array(
    'value' => 'type2',
    'label' => __( 'Use an icon image', 'tcd-w' )
  ),
  'type3' => array(
    'value' => 'type3',
    'label' => __( 'Hidden', 'tcd-w' )
  )
);

global $gnav_item_font_icon_options;
$gnav_item_font_icon_options = array(
  'blog' => array( 'value' => 'blog' ),
  'art' => array( 'value' => 'art' ),
  'concept' => array( 'value' => 'concept' ),
  'date' => array( 'value' => 'date' ),
  'home' => array( 'value' => 'home' ),
  'live' => array( 'value' => 'live' ),
  'pin' => array( 'value' => 'pin' ),
  'seminar' => array( 'value' => 'seminar' ),
  'special' => array( 'value' => 'special' ),
  'quill' => array( 'value' => 'quill' ),
  'headphones' => array( 'value' => 'headphones' ),
  'leaf' => array( 'value' => 'leaf' ),
  'signal' => array( 'value' => 'signal' ),
  'favorite' => array( 'value' => 'favorite' ),
  'star2' => array( 'value' => 'star2' ),
  'cube' => array( 'value' => 'cube' ),
  'book' => array( 'value' => 'book' ),
  'apps2' => array( 'value' => 'apps2' ),
  'restaurant' => array( 'value' => 'restaurant' ),
  'smile' => array( 'value' => 'smile' ),
  'work' => array( 'value' => 'work' )
);

function add_header_dp_default_options( $dp_default_options ) {

  // Header
	$dp_default_options['header_fix'] = 'type1';
	$dp_default_options['sp_header_fix'] = 'type1';
	$dp_default_options['header_bg'] = '#ffffff';

  // Header search
	$dp_default_options['header_search_type'] = 'type1';
	$dp_default_options['google_search_id'] = '';

  // Global navigation
	$dp_default_options['gnav_color'] = '#000000';
	$dp_default_options['gnav_sub_color'] = '#ffffff';
	$dp_default_options['gnav_sub_bg'] = '#000000';
	$dp_default_options['gnav_sub_color_hover'] = '#ffffff';
	$dp_default_options['gnav_sub_bg_hover'] = '#333333';
	$dp_default_options['gnav_color_sp'] = '#ffffff';
	$dp_default_options['gnav_bg_sp'] = '#000000';
	$dp_default_options['gnav_bg_opacity_sp'] = 1;
	$dp_default_options['gnav_items'] = array();

	return $dp_default_options;
}

function add_header_tab_label( $tab_labels ) {
	$tab_labels['header'] = __( 'Header', 'tcd-w' );
	return $tab_labels;
}

function add_header_tab_panel( $dp_options ) {

	global $dp_default_options, $header_fix_options, $header_search_type_options, $gnav_item_icon_type_options, $gnav_item_font_icon_options;
?>
<div id="tab-content-header">
  <?php // Header ?>
  <div class="theme_option_field cf">
    <h3 class="theme_option_headline"><?php _e( 'Header settings', 'tcd-w' ); ?></h3>
  	<h4 class="theme_option_headline2"><?php _e( 'Header position', 'tcd-w' ); ?></h4>
   	<fieldset class="cf select_type2">
			<?php foreach ( $header_fix_options as $option ) : ?>
     	<label class="description"><input type="radio" name="dp_options[header_fix]" value="<?php esc_attr_e( $option['value'] ); ?>" <?php checked( $option['value'], $dp_options['header_fix'] ); ?>><?php _e( $option['label'], 'tcd-w' ); ?></label>
			<?php endforeach; ?>
    </fieldset>
  	<h4 class="theme_option_headline2"><?php _e( 'Header position (mobile)', 'tcd-w' ); ?></h4>
  	<fieldset class="cf select_type2">
			<?php foreach ( $header_fix_options as $option ) : ?>
			<label class="description"><input type="radio" name="dp_options[sp_header_fix]" value="<?php echo esc_attr( $option['value'] ); ?>" <?php checked( $option['value'], $dp_options['sp_header_fix'] ); ?>><?php esc_html_e( $option['label'], 'tcd-w' ); ?></label>
			<?php endforeach; ?>
		</fieldset>
  	<h4 class="theme_option_headline2"><?php _e( 'Background color', 'tcd-w' ); ?></h4>
		<input type="text" name="dp_options[header_bg]" value="<?php echo esc_attr( $dp_options['header_bg'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['header_bg'] ); ?>" class="c-color-picker">
  	<input type="submit" class="button-ml ajax_button" value="<?php _e( 'Save Changes', 'tcd-w' ); ?>">
  </div>
  <?php // Header ?>
  <div class="theme_option_field cf">
    <h3 class="theme_option_headline"><?php _e( 'Search settings', 'tcd-w' ); ?></h3>
  	<h4 class="theme_option_headline2"><?php _e( 'Search type', 'tcd-w' ); ?></h4>
   	<fieldset class="cf select_type2">
			<?php foreach ( $header_search_type_options as $option ) : ?>
     	<label class="description"><input type="radio" name="dp_options[header_search_type]" value="<?php esc_attr_e( $option['value'] ); ?>" <?php checked( $option['value'], $dp_options['header_search_type'] ); ?>><?php _e( $option['label'], 'tcd-w' ); ?></label>
			<?php endforeach; ?>
    </fieldset>
    <div id="header_search_type_type2" <?php if ( 'type2' !== $dp_options['header_search_type'] ) { echo 'style="display: none;"'; } ?>>
  	  <h4 class="theme_option_headline2"><?php _e( 'Google Custom Search ID', 'tcd-w' ); ?></h4>
      <input type="text" class="regular-text" name="dp_options[google_search_id]" value="<?php echo esc_attr( $dp_options['google_search_id'] ); ?>">
    </div>
  	<input type="submit" class="button-ml ajax_button" value="<?php _e( 'Save Changes', 'tcd-w' ); ?>">
  </div>
  <?php // Global navigation ?>
  <div class="theme_option_field cf">
    <h3 class="theme_option_headline"><?php _e( 'Global navigation settings', 'tcd-w' ); ?></h3>
    <p><label for="gnav_color"><?php _e( 'Font color', 'tcd-w' ); ?> </label><input type="text" id="gnav_color" class="c-color-picker" name="dp_options[gnav_color]" value="<?php echo esc_attr( $dp_options['gnav_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['gnav_color'] ); ?>"></p>
  	<h4 class="theme_option_headline2"><?php _e( 'Submenu settings', 'tcd-w' ); ?></h4>
    <p><label for="gnav_sub_color"><?php _e( 'Font color', 'tcd-w' ); ?> </label><input type="text" id="gnav_sub_color" class="c-color-picker" name="dp_options[gnav_sub_color]" value="<?php echo esc_attr( $dp_options['gnav_sub_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['gnav_sub_color'] ); ?>"></p>
    <p><label for="gnav_sub_bg"><?php _e( 'Background color', 'tcd-w' ); ?> </label><input type="text" id="gnav_sub_bg" class="c-color-picker" name="dp_options[gnav_sub_bg]" value="<?php echo esc_attr( $dp_options['gnav_sub_bg'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['gnav_sub_bg'] ); ?>"></p>
    <p><label for="gnav_sub_color_hover"><?php _e( 'Font color on hover', 'tcd-w' ); ?> </label><input type="text" id="gnav_sub_color_hover" class="c-color-picker" name="dp_options[gnav_sub_color_hover]" value="<?php echo esc_attr( $dp_options['gnav_sub_color_hover'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['gnav_sub_color_hover'] ); ?>"></p>
    <p><label for="gnav_sub_bg_hover"><?php _e( 'Background color on hover', 'tcd-w' ); ?> </label><input type="text" class="c-color-picker" name="dp_options[gnav_sub_bg_hover]" value="<?php echo esc_attr( $dp_options['gnav_sub_bg_hover'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['gnav_sub_bg_hover'] ); ?>"></p>
  	<h4 class="theme_option_headline2"><?php _e( 'Menu setting for mobile', 'tcd-w' ); ?></h4>
    <p><label for="gnav_color_sp"><?php _e( 'Font color', 'tcd-w' ); ?> </label><input type="text" class="c-color-picker" name="dp_options[gnav_color_sp]" value="<?php echo esc_attr( $dp_options['gnav_color_sp'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['gnav_color_sp'] ); ?>"></p>
    <p><label for="gnav_bg_sp"><?php _e( 'Background color', 'tcd-w' ); ?> </label><input type="text" class="c-color-picker" name="dp_options[gnav_bg_sp]" value="<?php echo esc_attr( $dp_options['gnav_bg_sp'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['gnav_bg_sp'] ); ?>"></p>
    <p><label><?php _e( 'Opacity of background color', 'tcd-w' ); ?> <input type="number" class="tiny-text" min="0" max="1" step="0.1" name="dp_options[gnav_bg_opacity_sp]" value="<?php echo esc_attr( $dp_options['gnav_bg_opacity_sp'] ); ?>"></label></p>
  	<h4 class="theme_option_headline2"><?php _e( 'Menu item settings', 'tcd-w' ); ?></h4>
    <?php

    // Get the name of the menu assigned to the global navigation
    $menu_name = wp_get_nav_menu_name( 'global' );

    if ( $menu_items = wp_get_nav_menu_items( $menu_name ) ) :

      foreach( (array) $menu_items as $item ) :

        // Display only top-level menus
        if ( $item->menu_item_parent ) continue;

        $item_id = $item->ID;
        $gnav_item_color = isset( $dp_options['gnav_items'][$item_id]['color'] ) ? $dp_options['gnav_items'][$item_id]['color'] : '#000000';
        $gnav_item_icon_type = isset( $dp_options['gnav_items'][$item_id]['icon_type'] ) ? $dp_options['gnav_items'][$item_id]['icon_type'] : 'type1';
        $gnav_item_font_icon = isset( $dp_options['gnav_items'][$item_id]['font_icon'] ) ? $dp_options['gnav_items'][$item_id]['font_icon'] : 'blog';
        $gnav_item_icon_img = isset( $dp_options['gnav_items'][$item_id]['icon_img'] ) ? $dp_options['gnav_items'][$item_id]['icon_img'] : '';
      ?>
  	  <div class="sub_box cf">
  	  	<h3 class="theme_option_subbox_headline"><?php echo esc_html( $item->title ); ?></h3>
		  	<div class="sub_box_content">
  	      <h4 class="theme_option_headline2"><?php _e( 'Color on hover', 'tcd-w' ); ?></h4>
          <input type="text" class="c-color-picker" name="dp_options[gnav_items][<?php echo esc_attr( $item_id ); ?>][color]" value="<?php echo esc_attr( $gnav_item_color ); ?>" data-default-color="#000000">
  	      <h4 class="theme_option_headline2"><?php _e( 'Icon type', 'tcd-w' ); ?></h4>
          <?php foreach ( $gnav_item_icon_type_options as $option ) : ?>
          <p><label><input type="radio" name="dp_options[gnav_items][<?php echo esc_attr( $item_id ); ?>][icon_type]" value="<?php echo esc_attr( $option['value'] ); ?>" <?php checked( $option['value'], $gnav_item_icon_type ); ?>> <?php echo esc_html( $option['label'] ); ?></label></p>
          <?php endforeach; ?>
  	      <h4 class="theme_option_headline2"><?php _e( 'Icon font', 'tcd-w' ); ?></h4>
          <ul class="a-gnav-icons">
            <?php foreach ( $gnav_item_font_icon_options as $option ) : ?>
            <label class="a-gnav-icons__item">
            <span class="a-gnav-icons__item-icon a-gnav-icons__item-icon--<?php echo esc_attr( $option['value'] ); ?>"></span>
              <input type="radio" name="dp_options[gnav_items][<?php echo esc_attr( $item_id ); ?>][font_icon]" value="<?php echo esc_attr( $option['value'] ); ?>" <?php checked( $option['value'], $gnav_item_font_icon ); ?>>
            </label>
            <?php endforeach; ?>
          </ul>
  	      <h4 class="theme_option_headline2"><?php _e( 'Icon image', 'tcd-w' ); ?></h4>
		      <div class="image_box cf">
		      	<div class="cf cf_media_field hide-if-no-js">
		      		<input type="hidden" value="<?php echo esc_attr( $gnav_item_icon_img ); ?>" id="gnav_items_<?php echo esc_attr( $item_id ); ?>_icon_img" name="dp_options[gnav_items][<?php echo esc_attr( $item_id ); ?>][icon_img]" class="cf_media_id">
		      		<div class="preview_field"><?php if ( $gnav_item_icon_img ) { echo wp_get_attachment_image( $gnav_item_icon_img, 'medium' ); } ?></div>
		      		<div class="button_area">
		      			<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
		      			<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $gnav_item_icon_img ) { echo 'hidden'; } ?>">
		      		</div>
		      	</div>
		      </div>
  	      <input type="submit" class="button-ml ajax_button" value="<?php _e( 'Save Changes', 'tcd-w' ); ?>">
  	  	</div><!-- END .sub_box -->
		  </div>
      <?php
      endforeach;
    else :
    endif;
    ?>
  	<input type="submit" class="button-ml ajax_button" value="<?php _e( 'Save Changes', 'tcd-w' ); ?>">
  </div>
</div><!-- END #tab-content7 -->
<?php
}

function add_header_theme_options_validate( $input ) {

  global $header_fix_options, $header_search_type_options, $gnav_item_icon_type_options, $gnav_item_font_icon_options;

  // Header
 	if ( ! isset( $input['header_fix'] ) ) $input['header_fix'] = null;
 	if ( ! array_key_exists( $input['header_fix'], $header_fix_options ) ) $input['header_fix'] = null;
 	if ( ! isset( $input['sp_header_fix'] ) ) $input['sp_header_fix'] = null;
 	if ( ! array_key_exists( $input['sp_header_fix'], $header_fix_options ) ) $input['sp_header_fix'] = null;
	$input['header_bg'] = sanitize_hex_color( $input['header_bg'] );

  // Header search
 	if ( ! isset( $input['header_search_type'] ) ) $input['header_search_type'] = null;
 	if ( ! array_key_exists( $input['header_search_type'], $header_search_type_options ) ) $input['header_search_type'] = null;
	$input['google_search_id'] = sanitize_text_field( $input['google_search_id'] );

  // Global navigation
	$input['gnav_color'] = sanitize_hex_color( $input['gnav_color'] );
	$input['gnav_sub_color'] = sanitize_hex_color( $input['gnav_sub_color'] );
	$input['gnav_sub_bg'] = sanitize_hex_color( $input['gnav_sub_bg'] );
	$input['gnav_sub_color_hover'] = sanitize_hex_color( $input['gnav_sub_color_hover'] );
	$input['gnav_sub_bg_hover'] = sanitize_hex_color( $input['gnav_sub_bg_hover'] );
	$input['gnav_color_sp'] = sanitize_hex_color( $input['gnav_color_sp'] );
	$input['gnav_bg_sp'] = sanitize_hex_color( $input['gnav_bg_sp'] );
	$input['gnav_bg_opacity_sp'] = sanitize_text_field( $input['gnav_bg_opacity_sp'] );


  foreach ( array_keys( $input['gnav_items'] ) as $key ) {
    $input['gnav_items'][$key]['color'] = sanitize_hex_color( $input['gnav_items'][$key]['color'] );
    if ( ! isset( $input['gnav_items'][$key]['icon_type'] ) ) $input['gnav_items'][$key]['icon_type'] = null;
    if ( ! array_key_exists( $input['gnav_items'][$key]['icon_type'], $gnav_item_icon_type_options ) ) $input['gnav_items'][$key]['icon_type'] = null;
    if ( ! isset( $input['gnav_items'][$key]['font_icon'] ) ) $input['gnav_items'][$key]['font_icon'] = null;
    if ( ! array_key_exists( $input['gnav_items'][$key]['font_icon'], $gnav_item_font_icon_options ) ) $input['gnav_items'][$key]['font_icon'] = null;
    $input['gnav_items'][$key]['icon_img'] = absint( $input['gnav_items'][$key]['icon_img'] );
  }

	return $input;
}
