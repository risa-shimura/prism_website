<?php
/*
 * Manage blog tab
 */

// Add default values
add_filter( 'before_getting_design_plus_option', 'add_blog_dp_default_options' );

//  Add label of blog tab
add_action( 'tcd_tab_labels', 'add_blog_tab_label' );

// Add HTML of blog tab
add_action( 'tcd_tab_panel', 'add_blog_tab_panel' );

// Register sanitize function
add_filter( 'theme_options_validate', 'add_blog_theme_options_validate' );

$pagenation_type_options = array(
  'type1' => array( 'value' => 'type1', 'label' => __( 'Page numbers', 'tcd-w' ) ),
  'type2' => array( 'value' => 'type2', 'label' => __( 'Read more button', 'tcd-w' ) )
);

function add_blog_dp_default_options( $dp_default_options ) {

  // Page header
	$dp_default_options['ph_key_color'] = '#b2b200';
	$dp_default_options['ph_1_title'] = 'BLOG';
	$dp_default_options['ph_1_title_font_size'] = 50;
	$dp_default_options['ph_1_sub'] = __( 'Blog', 'tcd-w' );
	$dp_default_options['ph_2_title'] = __( 'Title here. Title here.', 'tcd-w' );
	$dp_default_options['ph_2_title_font_size'] = 32;
	$dp_default_options['ph_2_desc'] = __( "Description here. Description here. Description here. \nDescription here. Description here. Description here. Description here. Description here.", 'tcd-w' );
	$dp_default_options['ph_2_img'] = '';

	// Native advertisement
  $dp_default_options['display_native_ad'] = 0;
  $dp_default_options['native_ad_position'] = 4;

  // Single page
	$dp_default_options['title_font_size'] = 32;
	$dp_default_options['title_font_size_sp'] = 22;
	$dp_default_options['content_font_size'] = 16;
	$dp_default_options['content_font_size_sp'] = 14;
	$dp_default_options['pagenation_type'] = 'type1';

	// Display
	$dp_default_options['show_date'] = 1;
	$dp_default_options['show_category'] = 1;
	$dp_default_options['show_tag'] = 1;
	$dp_default_options['show_author'] = 1;
	$dp_default_options['show_thumbnail'] = 1;
	$dp_default_options['show_sns_top'] = 1;
	$dp_default_options['show_sns_btm'] = 1;
	$dp_default_options['show_next_post'] = 1;
	$dp_default_options['show_related_post'] = 1;
	$dp_default_options['show_comment'] = 1;
	$dp_default_options['show_trackback'] = 1;

  // Single page banner
  for ( $i = 1; $i <= 6; $i++ ) {
	  $dp_default_options['single_ad_code' . $i] = '';
	  $dp_default_options['single_ad_image' . $i] = false;
	  $dp_default_options['single_ad_url' . $i] = '';
  }

  // Single page banner (mobile)
	$dp_default_options['single_mobile_ad_code1'] = '';
	$dp_default_options['single_mobile_ad_image1'] = false;
	$dp_default_options['single_mobile_ad_url1'] = '';

	return $dp_default_options;

}

function add_blog_tab_label( $tab_labels ) {
	$tab_labels['blog'] = __( 'Blog', 'tcd-w' );
	return $tab_labels;
}

function add_blog_tab_panel( $dp_options ) {

	global $dp_default_options, $pagenation_type_options;
?>
<div id="tab-content-blog">
	<?php // Page header ?>
	<div class="theme_option_field cf">
  	<h3 class="theme_option_headline"><?php _e( 'Page header settings', 'tcd-w' ); ?></h3>
    <p class="u-center"><img src="<?php echo get_template_directory_uri(); ?>/admin/assets/images/page_header.png" alt=""></p>
    <h4 class="theme_option_headline2"><?php _e( 'Key color', 'tcd-w' ); ?></h4>
    <input type="text" class="c-color-picker" name="dp_options[ph_key_color]" value="<?php echo esc_attr( $dp_options['ph_key_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['ph_key_color'] ); ?>">
    <h4 class="theme_option_headline2"><?php _e( 'Title of #1', 'tcd-w' ); ?></h4>
    <input type="text" class="regular-text" name="dp_options[ph_1_title]" value="<?php echo esc_attr( $dp_options['ph_1_title'] ); ?>">
    <p><?php _e( 'Font size', 'tcd-w' ); ?> <input type="number" class="tiny-text" min="1" step="1" name="dp_options[ph_1_title_font_size]" value="<?php echo esc_attr( $dp_options['ph_1_title_font_size'] ); ?>"> px</p>
    <h4 class="theme_option_headline2"><?php _e( 'Sub title of #1', 'tcd-w' ); ?></h4>
    <input type="text" class="regular-text" name="dp_options[ph_1_sub]" value="<?php echo esc_attr( $dp_options['ph_1_sub'] ); ?>">
    <h4 class="theme_option_headline2"><?php _e( 'Title of #2', 'tcd-w' ); ?></h4>
    <input type="text" class="regular-text" name="dp_options[ph_2_title]" value="<?php echo esc_attr( $dp_options['ph_2_title'] ); ?>">
    <p><?php _e( 'Font size', 'tcd-w' ); ?> <input type="number" class="tiny-text" min="1" step="1" name="dp_options[ph_2_title_font_size]" value="<?php echo esc_attr( $dp_options['ph_2_title_font_size'] ); ?>"> px</p>
    <h4 class="theme_option_headline2"><?php _e( 'Description of #2', 'tcd-w' ); ?></h4>
    <textarea class="large-text" name="dp_options[ph_2_desc]"><?php echo esc_textarea( $dp_options['ph_2_desc'] ); ?></textarea>
    <h4 class="theme_option_headline2"><?php _e( 'Background image of #2', 'tcd-w' ); ?></h4>
    <p><?php _e( 'Recommended image size. Width: 1450px, Height: 480px', 'tcd-w' ); ?></p>
  	<div class="image_box cf">
  		<div class="cf cf_media_field hide-if-no-js ph_2_img">
  			<input type="hidden" value="<?php echo esc_attr( $dp_options['ph_2_img'] ); ?>" id="ph_2_img" name="dp_options[ph_2_img]" class="cf_media_id">
  			<div class="preview_field"><?php if ( $dp_options['ph_2_img'] ) { echo wp_get_attachment_image( $dp_options['ph_2_img'], 'medium' ); } ?></div>
  			<div class="button_area">
  				<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
  				<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $dp_options['ph_2_img'] ) { echo 'hidden'; } ?>">
  			</div>
  		</div>
  	</div>
    <input type="submit" class="button-ml ajax_button" value="<?php echo _e( 'Save Changes', 'tcd-w' ); ?>">
	</div>
	<?php // Native advertisement ?>
	<div class="theme_option_field cf">
		<h3 class="theme_option_headline"><?php _e( 'Native advertisement settings', 'tcd-w' ); ?></h3>
		<p><label><input name="dp_options[display_native_ad]" type="checkbox" value="1" <?php checked( $dp_options['display_native_ad'], 1 ); ?>><?php _e( 'Display native advertisements in archives', 'tcd-w' ); ?></label></p>
		<h4 class="theme_option_headline2"><?php _e( 'Position of native advertisement', 'tcd-w' ); ?></h4>
		<div class="theme_option_message">
			<p><?php _e( 'Registered native advertisements 1 to 6 will be displayed at random each time after the number of articles set in here.', 'tcd-w' ); ?></p>
		</div>
		<input class="tiny-text" name="dp_options[native_ad_position]" type="number" value="<?php echo esc_attr( $dp_options['native_ad_position'] ); ?>" min="1">
		<input type="submit" class="button-ml" value="<?php echo _e( 'Save Changes', 'tcd-w' ); ?>">
	</div>
		<?php // Single page ?>
  <div class="theme_option_field cf">
  	<h3 class="theme_option_headline"><?php _e( 'Single Page Settings', 'tcd-w' ); ?></h3>
  	<h4 class="theme_option_headline2"><?php _e( 'Font size of post title', 'tcd-w' ); ?></h4>
  	<input class="hankaku tiny-text" type="number" min="1" step="1" name="dp_options[title_font_size]" value="<?php echo esc_attr( $dp_options['title_font_size'] ); ?>"> <span>px</span>
  	<h4 class="theme_option_headline2"><?php _e( 'Font size of post title (mobile)', 'tcd-w' ); ?></h4>
  	<input class="hankaku tiny-text" type="number" min="1" step="1" name="dp_options[title_font_size_sp]" value="<?php echo esc_attr( $dp_options['title_font_size_sp'] ); ?>"> <span>px</span>
  	<h4 class="theme_option_headline2"><?php _e( 'Font size of post contents', 'tcd-w' ); ?></h4>
  	<input class="hankaku tiny-text" type="number" min="1" step="1" name="dp_options[content_font_size]" value="<?php echo esc_attr( $dp_options['content_font_size'] ); ?>"> <span>px</span>
  	<h4 class="theme_option_headline2"><?php _e( 'Font size of post contents (mobile)', 'tcd-w' ); ?></h4>
  	<input class="hankaku tiny-text" type="number" min="1" step="1" name="dp_options[content_font_size_sp]" value="<?php echo esc_attr( $dp_options['content_font_size_sp'] ); ?>"> <span>px</span>
  	<h4 class="theme_option_headline2"><?php _e( 'Pagenation settings', 'tcd-w' ); ?></h4>
    <?php foreach ( $pagenation_type_options as $option ) : ?>
    <p><label><input type="radio" name="dp_options[pagenation_type]" value="<?php echo esc_attr( $option['value'] ); ?>" <?php checked( $option['value'], $dp_options['pagenation_type'] ); ?>><?php echo esc_html_e( $option['label'] ); ?></label></p>
    <?php endforeach; ?>
  	<input type="submit" class="button-ml ajax_button" value="<?php _e( 'Save Changes', 'tcd-w' ); ?>">
	</div>
	<?php // Display ?>
  <div class="theme_option_field cf">
  	<h3 class="theme_option_headline"><?php _e( 'Display settings', 'tcd-w' ); ?></h3>
    <ul>
    	<li><label><input name="dp_options[show_date]" type="checkbox" value="1" <?php checked( '1', $dp_options['show_date'] ); ?>><?php _e( 'Display date', 'tcd-w' ); ?></label></li>
    	<li><label><input name="dp_options[show_category]" type="checkbox" value="1" <?php checked( '1', $dp_options['show_category'] ); ?>><?php _e( 'Display category', 'tcd-w' ); ?></label></li>
    	<li><label><input name="dp_options[show_tag]" type="checkbox" value="1" <?php checked( '1', $dp_options['show_tag'] ); ?>><?php _e( 'Display tags', 'tcd-w' ); ?></label></li>
    	<li><label><input name="dp_options[show_author]" type="checkbox" value="1" <?php checked( '1', $dp_options['show_author'] ); ?>><?php _e( 'Display author', 'tcd-w' ); ?></label></li>
    	<li><label><input name="dp_options[show_thumbnail]" type="checkbox" value="1" <?php checked( '1', $dp_options['show_thumbnail'] ); ?>><?php _e( 'Display thumbnail', 'tcd-w' ); ?></label></li>
    	<li><label><input name="dp_options[show_sns_top]" type="checkbox" value="1" <?php checked( '1', $dp_options['show_sns_top'] ); ?>><?php _e( 'Display share buttons before the article', 'tcd-w' ); ?></label></li>
    	<li><label><input name="dp_options[show_sns_btm]" type="checkbox" value="1" <?php checked( '1', $dp_options['show_sns_btm'] ); ?>><?php _e( 'Display share buttons after the article', 'tcd-w' ); ?></label></li>
    	<li><label><input name="dp_options[show_next_post]" type="checkbox" value="1" <?php checked( '1', $dp_options['show_next_post'] ); ?>><?php _e( 'Display next previous post link', 'tcd-w' ); ?></label></li>
    	<li><label><input name="dp_options[show_related_post]" type="checkbox" value="1" <?php checked( '1', $dp_options['show_related_post'] ); ?>><?php _e( 'Display related post', 'tcd-w' ); ?></label></li>
    	<li><label><input name="dp_options[show_comment]" type="checkbox" value="1" <?php checked( '1', $dp_options['show_comment'] ); ?>><?php _e( 'Display comment', 'tcd-w' ); ?></label></li>
    	<li><label><input id="dp_options[show_trackback]" name="dp_options[show_trackback]" type="checkbox" value="1" <?php checked( '1', $dp_options['show_trackback'] ); ?>><?php _e( 'Display trackbacks', 'tcd-w' ); ?></label></li>
    </ul>
    <input type="submit" class="button-ml ajax_button" value="<?php _e( 'Save Changes', 'tcd-w' ); ?>">
	</div>
	<?php // Single page banner ?>
	<div class="theme_option_field cf">
  	<h3 class="theme_option_headline"><?php _e( 'Single page banner settings', 'tcd-w' ); ?>1</h3>
  	<p><?php _e( 'This banner will be displayed before contents.', 'tcd-w' ); ?></p>
  	<div class="sub_box cf">
  		<h3 class="theme_option_subbox_headline"><?php _e( 'Left banner', 'tcd-w' ); ?></h3>
			<div class="sub_box_content">
  			<div class="theme_option_content">
  				<h4 class="theme_option_headline2"><?php _e( 'Banner code', 'tcd-w' ); ?></h4>
  				<p><?php _e( 'If you are using google adsense, enter all code below.', 'tcd-w' ); ?></p>
  				<textarea class="large-text" rows="10" name="dp_options[single_ad_code1]"><?php echo esc_textarea( $dp_options['single_ad_code1'] ); ?></textarea>
  			</div>
  			<p><?php _e( 'If you are not using google adsense, you can register your banner image and affiliate code individually.', 'tcd-w' ); ?></p>
  			<div class="theme_option_content">
  				<h4 class="theme_option_headline2"><?php _e( 'Register banner image.', 'tcd-w' ); _e( 'Recommend size. Width:300px Height:250px', 'tcd-w' ); ?></h4>
  				<div class="image_box cf">
  					<div class="cf cf_media_field hide-if-no-js single_ad_image1">
  						<input type="hidden" value="<?php echo esc_attr( $dp_options['single_ad_image1'] ); ?>" id="single_ad_image1" name="dp_options[single_ad_image1]" class="cf_media_id">
  						<div class="preview_field"><?php if ( $dp_options['single_ad_image1'] ) { echo wp_get_attachment_image( $dp_options['single_ad_image1'], 'medium' ); } ?></div>
  						<div class="button_area">
  							<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
  							<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $dp_options['single_ad_image1'] ) { echo 'hidden'; } ?>">
  						</div>
  					</div>
  				</div>
  			</div>
  			<div class="theme_option_content">
  				<h4 class="theme_option_headline2"><?php _e( 'Register affiliate code', 'tcd-w' ); ?></h4>
  				<input class="regular-text" type="text" name="dp_options[single_ad_url1]" value="<?php echo esc_attr( $dp_options['single_ad_url1'] ); ?>">
  				<input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>">
  			</div>
			</div>
  	</div><!-- END .sub_box -->
  	<div class="sub_box cf">
  		<h3 class="theme_option_subbox_headline"><?php _e( 'Right banner', 'tcd-w' ); ?></h3>
			<div class="sub_box_content">
  			<div class="theme_option_content">
  				<h4 class="theme_option_headline2"><?php _e( 'Banner code', 'tcd-w' ); ?></h4>
  				<p><?php _e( 'If you are using google adsense, enter all code below.', 'tcd-w' ); ?></p>
  				<textarea class="large-text" rows="10" name="dp_options[single_ad_code2]"><?php echo esc_textarea( $dp_options['single_ad_code2'] ); ?></textarea>
  			</div>
  			<p><?php _e( 'If you are not using google adsense, you can register your banner image and affiliate code individually.', 'tcd-w' );  ?></p>
  			<div class="theme_option_content">
  				<h4 class="theme_option_headline2"><?php _e( 'Register banner image.', 'tcd-w' ); _e( 'Recommend size. Width:300px Height:250px', 'tcd-w' ); ?></h4>
  				<div class="image_box cf">
  					<div class="cf cf_media_field hide-if-no-js single_ad_image2">
  						<input type="hidden" value="<?php echo esc_attr( $dp_options['single_ad_image2'] ); ?>" id="single_ad_image2" name="dp_options[single_ad_image2]" class="cf_media_id">
  						<div class="preview_field"><?php if ( $dp_options['single_ad_image2'] ) { echo wp_get_attachment_image($dp_options['single_ad_image2'], 'medium' ); } ?></div>
  						<div class="button_area">
  							<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
  							<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $dp_options['single_ad_image2'] ) { echo 'hidden'; } ?>">
  						</div>
  					</div>
  				</div>
  			</div>
  			<div class="theme_option_content">
  				<h4 class="theme_option_headline2"><?php _e( 'Register affiliate code', 'tcd-w' );  ?></h4>
  				<input class="regular-text" type="text" name="dp_options[single_ad_url2]" value="<?php echo esc_attr( $dp_options['single_ad_url2'] ); ?>">
  				<input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>">
  			</div>
  		</div><!-- END .sub_box -->
		</div>
    <input type="submit" class="button-ml ajax_button" value="<?php echo _e( 'Save Changes', 'tcd-w' ); ?>">
  </div><!-- END .theme_option_field -->
	<div class="theme_option_field cf">
  	<h3 class="theme_option_headline"><?php _e( 'Single page banner settings', 'tcd-w' ); ?>2</h3>
  	<p><?php _e( 'This banner will be displayed after contents.', 'tcd-w' ); ?></p>
  	<div class="sub_box cf">
  		<h3 class="theme_option_subbox_headline"><?php _e( 'Left banner', 'tcd-w' ); ?></h3>
			<div class="sub_box_content">
  			<div class="theme_option_content">
  				<h4 class="theme_option_headline2"><?php _e( 'Banner code', 'tcd-w' ); ?></h4>
  				<p><?php _e( 'If you are using google adsense, enter all code below.', 'tcd-w' ); ?></p>
  				<textarea class="large-text" rows="10" name="dp_options[single_ad_code3]"><?php echo esc_textarea( $dp_options['single_ad_code3'] ); ?></textarea>
  			</div>
  			<p><?php _e( 'If you are not using google adsense, you can register your banner image and affiliate code individually.', 'tcd-w' ); ?></p>
  			<div class="theme_option_content">
  				<h4 class="theme_option_headline2"><?php _e( 'Register banner image.', 'tcd-w' ); _e( 'Recommend size. Width:300px Height:250px', 'tcd-w' ); ?></h4>
  				<div class="image_box cf">
  					<div class="cf cf_media_field hide-if-no-js single_ad_image3">
  						<input type="hidden" value="<?php echo esc_attr( $dp_options['single_ad_image3'] ); ?>" id="single_ad_image3" name="dp_options[single_ad_image3]" class="cf_media_id">
  						<div class="preview_field"><?php if ( $dp_options['single_ad_image3'] ) { echo wp_get_attachment_image( $dp_options['single_ad_image3'], 'medium' ); } ?></div>
  						<div class="button_area">
  							<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
  							<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $dp_options['single_ad_image3'] ) { echo 'hidden'; } ?>">
  						</div>
  					</div>
  				</div>
  			</div>
  			<div class="theme_option_content">
  				<h4 class="theme_option_headline2"><?php _e( 'Register affiliate code', 'tcd-w' ); ?></h4>
  				<input class="regular-text" type="text" name="dp_options[single_ad_url3]" value="<?php echo esc_attr( $dp_options['single_ad_url3'] ); ?>">
  				<input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>">
  			</div>
			</div>
  	</div><!-- END .sub_box -->
  	<div class="sub_box cf">
  		<h3 class="theme_option_subbox_headline"><?php _e( 'Right banner', 'tcd-w' ); ?></h3>
			<div class="sub_box_content">
  			<div class="theme_option_content">
  				<h4 class="theme_option_headline2"><?php _e( 'Banner code', 'tcd-w' ); ?></h4>
  				<p><?php _e( 'If you are using google adsense, enter all code below.', 'tcd-w' ); ?></p>
  				<textarea class="large-text" rows="10" name="dp_options[single_ad_code4]"><?php echo esc_textarea( $dp_options['single_ad_code4'] ); ?></textarea>
  			</div>
  			<p><?php _e( 'If you are not using google adsense, you can register your banner image and affiliate code individually.', 'tcd-w' );  ?></p>
  			<div class="theme_option_content">
  				<h4 class="theme_option_headline2"><?php _e( 'Register banner image.', 'tcd-w' ); _e( 'Recommend size. Width:300px Height:250px', 'tcd-w' ); ?></h4>
  				<div class="image_box cf">
  					<div class="cf cf_media_field hide-if-no-js single_ad_image4">
  						<input type="hidden" value="<?php echo esc_attr( $dp_options['single_ad_image4'] ); ?>" id="single_ad_image4" name="dp_options[single_ad_image4]" class="cf_media_id">
  						<div class="preview_field"><?php if ( $dp_options['single_ad_image4'] ) { echo wp_get_attachment_image($dp_options['single_ad_image4'], 'medium' ); } ?></div>
  						<div class="button_area">
  							<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
  							<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $dp_options['single_ad_image4'] ) { echo 'hidden'; } ?>">
  						</div>
  					</div>
  				</div>
  			</div>
  			<div class="theme_option_content">
  				<h4 class="theme_option_headline2"><?php _e( 'Register affiliate code', 'tcd-w' );  ?></h4>
  				<input class="regular-text" type="text" name="dp_options[single_ad_url4]" value="<?php echo esc_attr( $dp_options['single_ad_url4'] ); ?>">
  				<input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>">
  			</div>
  		</div><!-- END .sub_box -->
		</div>
    <input type="submit" class="button-ml ajax_button" value="<?php echo _e( 'Save Changes', 'tcd-w' ); ?>">
  </div><!-- END .theme_option_field -->
	<div class="theme_option_field cf">
  	<h3 class="theme_option_headline"><?php _e( 'Single page banner settings', 'tcd-w' ); ?>3</h3>
  	<p><?php _e( 'Please copy and paste the short code inside the content to show this banner.', 'tcd-w' ); ?></p>
  	<p><?php _e( 'Short code', 'tcd-w' );  ?> : <input type="text" readonly="readonly" value="[s_ad]"></p>
  	<div class="sub_box cf">
  		<h3 class="theme_option_subbox_headline"><?php _e( 'Left banner', 'tcd-w' ); ?></h3>
			<div class="sub_box_content">
  			<div class="theme_option_content">
  				<h4 class="theme_option_headline2"><?php _e( 'Banner code', 'tcd-w' ); ?></h4>
  				<p><?php _e( 'If you are using google adsense, enter all code below.', 'tcd-w' ); ?></p>
  				<textarea class="large-text" rows="10" name="dp_options[single_ad_code5]"><?php echo esc_textarea( $dp_options['single_ad_code5'] ); ?></textarea>
  			</div>
  			<p><?php _e( 'If you are not using google adsense, you can register your banner image and affiliate code individually.', 'tcd-w' ); ?></p>
  			<div class="theme_option_content">
  				<h4 class="theme_option_headline2"><?php _e( 'Register banner image.', 'tcd-w' ); _e( 'Recommend size. Width:300px Height:250px', 'tcd-w' ); ?></h4>
  				<div class="image_box cf">
  					<div class="cf cf_media_field hide-if-no-js single_ad_image5">
  						<input type="hidden" value="<?php echo esc_attr( $dp_options['single_ad_image5'] ); ?>" id="single_ad_image5" name="dp_options[single_ad_image5]" class="cf_media_id">
  						<div class="preview_field"><?php if ( $dp_options['single_ad_image5'] ) { echo wp_get_attachment_image( $dp_options['single_ad_image5'], 'medium' ); } ?></div>
  						<div class="button_area">
  							<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
  							<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $dp_options['single_ad_image5'] ) { echo 'hidden'; } ?>">
  						</div>
  					</div>
  				</div>
  			</div>
  			<div class="theme_option_content">
  				<h4 class="theme_option_headline2"><?php _e( 'Register affiliate code', 'tcd-w' ); ?></h4>
  				<input class="regular-text" type="text" name="dp_options[single_ad_url5]" value="<?php echo esc_attr( $dp_options['single_ad_url5'] ); ?>">
  				<input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>">
  			</div>
			</div>
  	</div><!-- END .sub_box -->
  	<div class="sub_box cf">
  		<h3 class="theme_option_subbox_headline"><?php _e( 'Right banner', 'tcd-w' ); ?></h3>
			<div class="sub_box_content">
  			<div class="theme_option_content">
  				<h4 class="theme_option_headline2"><?php _e( 'Banner code', 'tcd-w' ); ?></h4>
  				<p><?php _e( 'If you are using google adsense, enter all code below.', 'tcd-w' ); ?></p>
  				<textarea class="large-text" rows="10" name="dp_options[single_ad_code6]"><?php echo esc_textarea( $dp_options['single_ad_code6'] ); ?></textarea>
  			</div>
  			<p><?php _e( 'If you are not using google adsense, you can register your banner image and affiliate code individually.', 'tcd-w' ); ?></p>
  			<div class="theme_option_content">
  				<h4 class="theme_option_headline2"><?php _e( 'Register banner image.', 'tcd-w' ); _e( 'Recommend size. Width:300px Height:250px', 'tcd-w' ); ?></h4>
  				<div class="image_box cf">
  					<div class="cf cf_media_field hide-if-no-js single_ad_image6">
  						<input type="hidden" value="<?php echo esc_attr( $dp_options['single_ad_image6'] ); ?>" id="single_ad_image6" name="dp_options[single_ad_image6]" class="cf_media_id">
  						<div class="preview_field"><?php if ( $dp_options['single_ad_image6'] ) { echo wp_get_attachment_image( $dp_options['single_ad_image6'], 'medium' ); } ?></div>
  						<div class="button_area">
  							<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
  							<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if( ! $dp_options['single_ad_image6'] ) { echo 'hidden'; } ?>">
  						</div>
  					</div>
  				</div>
  			</div>
  			<div class="theme_option_content">
  				<h4 class="theme_option_headline2"><?php _e( 'Register affiliate code', 'tcd-w' ); ?></h4>
  				<input class="regular-text" type="text" name="dp_options[single_ad_url6]" value="<?php echo esc_attr( $dp_options['single_ad_url6'] ); ?>">
  				<input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>">
  			</div>
  		</div>
  	</div><!-- END .sub_box -->
    <input type="submit" class="button-ml ajax_button" value="<?php echo _e( 'Save Changes', 'tcd-w' ); ?>">
  </div><!-- END .theme_option_field -->
 	<?php // Single page banner ?>
	<div class="theme_option_field cf">
		<h3 class="theme_option_headline"><?php _e( 'Single page banner settings (mobile)', 'tcd-w' ); ?></h3>
		<p><?php _e( 'This banner will be displayed on mobile device.', 'tcd-w' ); ?></p>
 	 	<div class="theme_option_content">
 	 		<h4 class="theme_option_headline2"><?php _e( 'Banner code', 'tcd-w' ); ?></h4>
 	    <p><?php _e( 'If you are using google adsense, enter all code below.', 'tcd-w' ); ?></p>
 	    <textarea class="large-text" rows="10" name="dp_options[single_mobile_ad_code1]"><?php echo esc_textarea( $dp_options['single_mobile_ad_code1'] ); ?></textarea>
 	  </div>
 	  <p><?php _e( 'If you are not using google adsense, you can register your banner image and affiliate code individually.', 'tcd-w' );  ?></p>
 	  <div class="theme_option_content">
 	  	<h4 class="theme_option_headline2"><?php _e( 'Register banner image.', 'tcd-w' ); ?></h4>
 	  	<div class="image_box cf">
 	    	<div class="cf cf_media_field hide-if-no-js single_mobile_ad_image1">
 	      	<input type="hidden" value="<?php echo esc_attr( $dp_options['single_mobile_ad_image1'] ); ?>" id="single_mobile_ad_image" name="dp_options[single_mobile_ad_image1]" class="cf_media_id">
 	      	<div class="preview_field"><?php if($dp_options['single_mobile_ad_image1']){ echo wp_get_attachment_image($dp_options['single_mobile_ad_image1'], 'medium' ); }; ?></div>
 	      	<div class="buttton_area">
 	       		<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
 	       		<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if(!$dp_options['single_mobile_ad_image1']){ echo 'hidden'; }; ?>">
 	     		</div>
 	    	</div>
			</div>
 	  </div>
 	 	<div class="theme_option_content">
 	    <h4 class="theme_option_headline2"><?php _e( 'Register affiliate code', 'tcd-w' ); ?></h4>
 	    <input id="dp_options[single_mobile_ad_url1]" class="regular-text" type="text" name="dp_options[single_mobile_ad_url1]" value="<?php echo esc_attr( $dp_options['single_mobile_ad_url1'] ); ?>">
 	  	<input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>">
		</div>
	</div><!-- END .theme_option_field -->
</div><!-- END #tab-content4 -->
<?php
}

function add_blog_theme_options_validate( $input ) {

  global $pagenation_type_options;

  // Page header
 	$input['ph_key_color'] = sanitize_hex_color( $input['ph_key_color'] );
 	$input['ph_1_title'] = sanitize_textarea_field( $input['ph_1_title'] );
 	$input['ph_1_title_font_size'] = absint( $input['ph_1_title_font_size'] );
 	$input['ph_1_sub'] = sanitize_textarea_field( $input['ph_1_sub'] );
 	$input['ph_2_title'] = sanitize_textarea_field( $input['ph_2_title'] );
 	$input['ph_2_title_font_size'] = absint( $input['ph_2_title_font_size'] );
 	$input['ph_2_desc'] = sanitize_textarea_field( $input['ph_2_desc'] );
 	$input['ph_2_img'] = absint( $input['ph_2_img'] );

  // Native advertisement
  if ( ! isset( $input['display_native_ad'] ) ) $input['display_native_ad'] = null;
  $input['display_native_ad'] = $input['display_native_ad'] === '1' ? 1 : 0;
  $input['native_ad_position'] = absint( $input['native_ad_position'] );

  // Single page
 	$input['title_font_size'] = absint( $input['title_font_size'] );
 	$input['title_font_size_sp'] = absint( $input['title_font_size_sp'] );
 	$input['content_font_size'] = absint( $input['content_font_size'] );
 	$input['content_font_size_sp'] = absint( $input['content_font_size_sp'] );
  if ( ! isset( $input['pagenation_type'] ) ) $input['pagenation_type'] = null;
  if ( ! array_key_exists( $input['pagenation_type'], $pagenation_type_options ) ) $input['pagenation_type'] = null;

 	// Display
 	if ( ! isset( $input['show_date'] ) ) $input['show_date'] = null;
  $input['show_date'] = ( $input['show_date'] == 1 ? 1 : 0 );
 	if ( ! isset( $input['show_category'] ) ) $input['show_category'] = null;
  $input['show_category'] = ( $input['show_category'] == 1 ? 1 : 0 );
 	if ( ! isset( $input['show_tag'] ) ) $input['show_tag'] = null;
  $input['show_tag'] = ( $input['show_tag'] == 1 ? 1 : 0 );
 	if ( ! isset( $input['show_author'] ) ) $input['show_author'] = null;
  $input['show_author'] = ( $input['show_author'] == 1 ? 1 : 0 );
 	if ( ! isset( $input['show_thumbnail'] ) ) $input['show_thumbnail'] = null;
  $input['show_thumbnail'] = ( $input['show_thumbnail'] == 1 ? 1 : 0 );
 	if ( ! isset( $input['show_sns_top'] ) ) $input['show_sns_top'] = null;
  $input['show_sns_top'] = ( $input['show_sns_top'] == 1 ? 1 : 0 );
 	if ( ! isset( $input['show_sns_btm'] ) ) $input['show_sns_btm'] = null;
  $input['show_sns_btm'] = ( $input['show_sns_btm'] == 1 ? 1 : 0 );
 	if ( ! isset( $input['show_next_post'] ) ) $input['show_next_post'] = null;
  $input['show_next_post'] = ( $input['show_next_post'] == 1 ? 1 : 0 );
 	if ( ! isset( $input['show_related_post'] ) ) $input['show_related_post'] = null;
  $input['show_related_post'] = ( $input['show_related_post'] == 1 ? 1 : 0 );
 	if ( ! isset( $input['show_comment'] ) ) $input['show_comment'] = null;
  $input['show_comment'] = ( $input['show_comment'] == 1 ? 1 : 0 );
 	if ( ! isset( $input['show_trackback'] ) ) $input['show_trackback'] = null;
  $input['show_trackback'] = ( $input['show_trackback'] == 1 ? 1 : 0 );

  // Single page banner
	for ( $i = 1; $i <= 6; $i++ ) {
 		$input['single_ad_code' . $i] = $input['single_ad_code' . $i];
 		$input['single_ad_image' . $i] = absint( $input['single_ad_image' . $i] );
 		$input['single_ad_url' . $i] = esc_url_raw( $input['single_ad_url' . $i] );
	}

  // Single page banner (mobile)
	$input['single_mobile_ad_code1'] = $input['single_mobile_ad_code1'];
 	$input['single_mobile_ad_image1'] = absint( $input['single_mobile_ad_image1'] );
 	$input['single_mobile_ad_url1'] = esc_url_raw( $input['single_mobile_ad_url1'] );

	return $input;
}
