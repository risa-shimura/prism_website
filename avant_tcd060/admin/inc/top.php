<?php
/*
 * Manage front page tab
 */

// Add default values
add_filter( 'before_getting_design_plus_option', 'add_top_dp_default_options' );

// Add label of front page tab
add_action( 'tcd_tab_labels', 'add_top_tab_label' );

// Add HTML of front page tab
add_action( 'tcd_tab_panel', 'add_top_tab_panel' );

// Register sanitize function
add_filter( 'theme_options_validate', 'add_top_theme_options_validate' );

global $header_content_type_options;
$header_content_type_options = array(
  'type1' => array( 'value' => 'type1', 'label' => __( 'Posts slider', 'tcd-w' ) ),
  'type2' => array( 'value' => 'type2', 'label' => __( 'Image slider', 'tcd-w' ) ),
  'type3' => array( 'value' => 'type3', 'label' => __( 'Video', 'tcd-w' ) ),
  'type4' => array( 'value' => 'type4', 'label' => __( 'YouTube', 'tcd-w' ) )
);

global $header_posts_layout_options;
$header_posts_layout_options = array(
  'type1' => array( 'value' => 'type1', 'label' => __( 'type1', 'tcd-w' ) ),
  'type2' => array( 'value' => 'type2', 'label' => __( 'type2', 'tcd-w' ) ),
  'type3' => array( 'value' => 'type3', 'label' => __( 'type3', 'tcd-w' ) ),
  'type4' => array( 'value' => 'type4', 'label' => __( 'type4', 'tcd-w' ) )
);

global $header_posts_post_type_options;
$header_posts_post_type_options = array(
  'post' => array( 'value' => 'post', 'label' => __( 'Blog', 'tcd-w' ) ),
  'event' => array( 'value' => 'event', 'label' => __( 'Event', 'tcd-w' ) ),
  'special' => array( 'value' => 'special', 'label' => __( 'Special', 'tcd-w' ) )
);

global $header_slider_animation_time_options;
$header_slider_animation_time_options = array();
for ( $i = 5; $i <= 10; $i++ ) {
  $header_slider_animation_time_options[$i] = array(
    'value' => $i,
    'label' => sprintf( __( '%d seconds', 'tcd-w' ), $i )
  );
}

global $index_special_layout_options;
$index_special_layout_options = array(
  'type1' => array(
    'value' => 'type1',
    'label' => __( 'type1 (Eight specials)', 'tcd-w' ),
    'img' => ''
  ),
  'type2' => array(
    'value' => 'type2',
    'label' => __( 'type2 (Four specials and one recommended special)', 'tcd-w' ),
    'img' => ''
  ),
  'type3' => array(
    'value' => 'type3',
    'label' => __( 'type3 (Four specials and one recommended special)', 'tcd-w' ),
    'img' => ''
  ),
);

global $index_blog_type_options;
$index_blog_type_options = array(
  'recent' => array( 'value' => 'recent', 'label' => __( 'Recent post', 'tcd-w' ) ),
  'recommend_post1' => array( 'value' => 'recommend_post1', 'label' => __( 'Recommended post1', 'tcd-w' ) ),
  'recommend_post2' => array( 'value' => 'recommend_post2', 'label' => __( 'Recommended post2', 'tcd-w' ) ),
  'recommend_post3' => array( 'value' => 'recommend_post3', 'label' => __( 'Recommended post3', 'tcd-w' ) )
);

global $index_blog_order_options;
$index_blog_order_options = array(
  'DESC' => array( 'value' => 'DESC', 'label' => __( 'DESC', 'tcd-w' ) ),
  'ASC' => array( 'value' => 'ASC', 'label' => __( 'ASC', 'tcd-w' ) ),
  'random' => array( 'value' => 'random', 'label' => __( 'Random', 'tcd-w' ) )
);

function add_top_dp_default_options( $dp_default_options ) {

  // Header contents
  $dp_default_options['header_content_type'] = 'type1';

  // Posts slider
  $dp_default_options['header_posts_layout'] = 'type2';
  $dp_default_options['header_posts_layout1_post_type'] = 'post';
  $dp_default_options['header_posts_layout1_animation_time'] = 5;
  $dp_default_options['header_posts_layout1_display_native_ad'] = 0;
  $dp_default_options['header_posts_layout1_native_ad_position'] = 4;
  $dp_default_options['header_posts_layout2_1_post_type'] = 'event';
  $dp_default_options['header_posts_layout2_animation_time'] = 5;
  $dp_default_options['header_posts_layout2_1_display_native_ad'] = 0;
  $dp_default_options['header_posts_layout2_1_native_ad_position'] = 4;
  $dp_default_options['header_posts_layout2_2_post_type'] = 'post';
  $dp_default_options['header_posts_layout2_2_display_native_ad'] = 0;
  $dp_default_options['header_posts_layout2_2_native_ad_position'] = 4;
  $dp_default_options['header_posts_layout3_1_post_type'] = 'post';
  $dp_default_options['header_posts_layout3_animation_time'] = 5;
  $dp_default_options['header_posts_layout3_1_display_native_ad'] = 0;
  $dp_default_options['header_posts_layout3_1_native_ad_position'] = 4;
  $dp_default_options['header_posts_layout3_2_post_type'] = 'post';
  $dp_default_options['header_posts_layout3_2_display_native_ad'] = 0;
  $dp_default_options['header_posts_layout3_2_native_ad_position'] = 4;
  $dp_default_options['header_posts_layout4_post_type'] = 'post';
  $dp_default_options['header_posts_layout4_display_native_ad'] = 0;
  $dp_default_options['header_posts_layout4_native_ad_position'] = 4;

  // Image slider
  for ( $i = 1; $i <= 5; $i++ ) {
    $dp_default_options['header_slider_img' . $i] = '';
    $dp_default_options['header_slider_img_sp' . $i] = '';
    $dp_default_options['header_slider_catch' . $i] = sprintf( __( 'Slider %d catchphrase', 'tcd-w' ), $i );
    $dp_default_options['header_slider_catch_font_size' . $i] = 52;
    $dp_default_options['header_slider_catch_color' . $i] = '#ffffff';
    $dp_default_options['header_slider_btn_label' . $i] = '';
    $dp_default_options['header_slider_btn_url' . $i] = '';
    $dp_default_options['header_slider_btn_target' . $i] = '';
    $dp_default_options['header_slider_btn_color' . $i] = '#ffffff';
    $dp_default_options['header_slider_btn_bg' . $i] = '#000000';
    $dp_default_options['header_slider_btn_color_hover' . $i] = '#ffffff';
    $dp_default_options['header_slider_btn_bg_hover' . $i] = '#333333';
  }
  $dp_default_options['header_slider_animation'] = 'type1';
  $dp_default_options['header_slider_animation_time'] = 5;

  // Video
  $dp_default_options['header_video'] = '';
  $dp_default_options['header_video_img'] = '';
  $dp_default_options['header_video_catch'] = '';
  $dp_default_options['header_video_catch_font_size'] = 52;
  $dp_default_options['header_video_catch_color'] = '#ffffff';
  $dp_default_options['header_video_btn_label'] = '';
  $dp_default_options['header_video_btn_url'] = '';
  $dp_default_options['header_video_btn_target'] = '';
  $dp_default_options['header_video_btn_color'] = '#ffffff';
  $dp_default_options['header_video_btn_bg'] = '#000000';
  $dp_default_options['header_video_btn_color_hover'] = '#ffffff';
  $dp_default_options['header_video_btn_bg_hover'] = '#333333';

  // YouTube
  $dp_default_options['header_youtube_url'] = '';
  $dp_default_options['header_youtube_img'] = '';
  $dp_default_options['header_youtube_catch'] = '';
  $dp_default_options['header_youtube_catch_font_size'] = 52;
  $dp_default_options['header_youtube_catch_color'] = '#ffffff';
  $dp_default_options['header_youtube_btn_label'] = '';
  $dp_default_options['header_youtube_btn_url'] = '';
  $dp_default_options['header_youtube_btn_target'] = '';
  $dp_default_options['header_youtube_btn_color'] = '#ffffff';
  $dp_default_options['header_youtube_btn_bg'] = '#000000';
  $dp_default_options['header_youtube_btn_color_hover'] = '#ffffff';
  $dp_default_options['header_youtube_btn_bg_hover'] = '#333333';

  // contents
  $dp_default_options['index_contents_order'] = array( 'special', 'news', 'event', 'blog', 'wysiwyg1', 'wysiwyg2', 'wysiwyg3' );

  // Special contents
  $dp_default_options['display_index_special'] = 1;
  $dp_default_options['index_special_title'] = 'SPECIAL';
  $dp_default_options['index_special_title_font_size'] = 50;
  $dp_default_options['index_special_title_color'] = '#000000';
  $dp_default_options['index_special_sub'] = __( 'special', 'tcd-w' );
  $dp_default_options['index_special_layout'] = 'type1';
  $dp_default_options['index_special_link_text'] = __( 'Special archive', 'tcd-w' );
  $dp_default_options['index_special_display_native_ad'] = 0;
  $dp_default_options['index_special_native_ad_position'] = 4;

  // News contents
  $dp_default_options['display_index_news'] = 1;
  $dp_default_options['index_news_title'] = 'NEWS';
  $dp_default_options['index_news_title_font_size'] = 50;
  $dp_default_options['index_news_title_color'] = '#000000';
  $dp_default_options['index_news_sub'] = __( 'News', 'tcd-w' );
  $dp_default_options['index_news_num'] = 3;
  $dp_default_options['index_news_link_text'] = __( 'News archive', 'tcd-w' );

  // Event contents
  $dp_default_options['display_index_event'] = 1;
  $dp_default_options['index_event_title'] = 'EVENT';
  $dp_default_options['index_event_title_font_size'] = 50;
  $dp_default_options['index_event_title_color'] = '#000000';
  $dp_default_options['index_event_sub'] = __( 'Event informations', 'tcd-w' );
  $dp_default_options['index_event_num'] = 9;
  $dp_default_options['index_event_read_more'] = __( 'Read more', 'tcd-w' );
  $dp_default_options['index_event_link_text'] = __( 'Event archive', 'tcd-w' );

  // Blog contents
  $dp_default_options['display_index_blog'] = 1;
  $dp_default_options['index_blog_title'] = 'BLOG';
  $dp_default_options['index_blog_title_font_size'] = 50;
  $dp_default_options['index_blog_title_color'] = '#000000';
  $dp_default_options['index_blog_sub'] = __( 'Blog', 'tcd-w' );
  $dp_default_options['index_blog_num'] = 8;
  $dp_default_options['index_blog_type'] = 'recent';
  $dp_default_options['index_blog_order'] = 'desc';
  $dp_default_options['index_blog_link_text'] = __( 'Blog archive', 'tcd-w' );
  $dp_default_options['index_blog_display_native_ad'] = 0;
  $dp_default_options['index_blog_native_ad_position'] = 4;

  // Wysiwyg
  for( $i = 1; $i <= 3; $i++ ) {
    $dp_default_options['display_index_wysiwyg' . $i] = 0;
    $dp_default_options['index_wysiwyg_editor' . $i] = '';
  }

	return $dp_default_options;
}

function add_top_tab_label( $tab_labels ) {
	$tab_labels['top'] = __( 'Front page', 'tcd-w' );
	return $tab_labels;
}

function add_top_tab_panel( $dp_options ) {
  global $dp_default_options, $header_content_type_options, $header_posts_layout_options, $header_posts_post_type_options, $header_slider_animation_time_options, $index_special_layout_options, $index_blog_type_options, $index_blog_order_options;
?>
<div id="tab-content-top">
	<?php // Header content ?>
	<div class="theme_option_field cf">
  	<h3 class="theme_option_headline"><?php _e( 'Header content settings', 'tcd-w' ); ?></h3>
    <h4 class="theme_option_headline2"><?php _e( 'Header content type', 'tcd-w' ); ?></h4>
    <?php foreach ( $header_content_type_options as $option ) : ?>
    <p><label><input type="radio" name="dp_options[header_content_type]" value="<?php echo esc_attr( $option['value'] ); ?>" <?php checked( $option['value'], $dp_options['header_content_type'] ); ?>><?php echo esc_html_e( $option['label'] ); ?></label></p>
    <?php endforeach; ?>
		<input type="submit" class="button-ml ajax_button" value="<?php _e( 'Save Changes', 'tcd-w' ); ?>">
	</div>
  <?php // Posts slider ?>
  <div id="header_content_type_type1"<?php if ( 'type1' !== $dp_options['header_content_type'] ) { echo ' style="display: none;"'; } ?>>
	  <div class="theme_option_field cf">
  	  <h3 class="theme_option_headline"><?php _e( 'Posts slider settings', 'tcd-w' ); ?></h3>
      <h4 class="theme_option_headline2"><?php _e( 'Layout', 'tcd-w' ); ?></h4>
      <ul class="layout-type-list">
      <?php foreach ( $header_posts_layout_options as $option ) : ?>
      <li>
        <figure><img src="<?php echo get_template_directory_uri(); ?>/admin/assets/images/header_<?php echo esc_attr( $option['value'] ); ?>.png" alt=""></figure>
        <label><input type="radio" name="dp_options[header_posts_layout]" value="<?php echo esc_attr( $option['value'] ); ?>" <?php checked( $option['value'], $dp_options['header_posts_layout'] ); ?>> <?php echo esc_html( $option['label'] ); ?></label>
      </li>
      <?php endforeach; ?>
      </ul>
      <div id="header_posts_layout_type1" class="<?php if ( 'type1' !== $dp_options['header_posts_layout'] ) { echo 'hidden'; } ?>">
        <h4 class="theme_option_headline2"><?php _e( 'Post type to display', 'tcd-w' ); ?></h4>
        <select name="dp_options[header_posts_layout1_post_type]">
        <?php foreach ( $header_posts_post_type_options as $option ) : ?>
        <option value="<?php echo esc_attr( $option['value'] ); ?>" <?php selected( $option['value'], $dp_options['header_posts_layout1_post_type'] ); ?>><?php echo esc_html( $option['label'] ); ?></option>
        <?php endforeach; ?>
        </select>
        <h4 class="theme_option_headline2"><?php _e( 'Autoplay speed', 'tcd-w' ); ?></h4>
        <select name="dp_options[header_posts_layout1_animation_time]">
        <?php foreach ( $header_slider_animation_time_options as $option ) : ?>
        <option value="<?php echo esc_attr( $option['value'] ); ?>" <?php selected( $option['value'], $dp_options['header_posts_layout1_animation_time'] ); ?>><?php echo esc_html( $option['label'] ); ?></option>
        <?php endforeach; ?>
        </select>
      	<h4 class="theme_option_headline2"><?php _e( 'Native advertisement settings', 'tcd-w' ); ?></h4>
				<p><label><input name="dp_options[header_posts_layout1_display_native_ad]" type="checkbox" value="1" <?php checked( $dp_options['header_posts_layout1_display_native_ad'], 1 ); ?>><?php _e( 'Display native advertisements', 'tcd-w' ); ?></label></p>
				<p><label><?php _e( 'Position of native advertisement', 'tcd-w' ); ?> <input class="tiny-text" name="dp_options[header_posts_layout1_native_ad_position]" type="number" value="<?php echo esc_attr( $dp_options['header_posts_layout1_native_ad_position'] ); ?>" min="1"></label></p>
				<div class="theme_option_message">
					<p><?php _e( 'Registered native advertisements 1 to 6 will be displayed at random each time after the number of articles set in here.', 'tcd-w' ); ?></p>
				</div>
      </div>
      <div id="header_posts_layout_type2" class="<?php if ( 'type2' !== $dp_options['header_posts_layout'] ) { echo 'hidden'; } ?>">
        <h4 class="theme_option_headline2"><?php _e( 'Post type of #1', 'tcd-w' ); ?></h4>
        <select name="dp_options[header_posts_layout2_1_post_type]">
        <?php foreach ( $header_posts_post_type_options as $option ) : ?>
        <option value="<?php echo esc_attr( $option['value'] ); ?>" <?php selected( $option['value'], $dp_options['header_posts_layout2_1_post_type'] ); ?>><?php echo esc_html( $option['label'] ); ?></option>
        <?php endforeach; ?>
        </select>
        <h4 class="theme_option_headline2"><?php _e( 'Autoplay speed', 'tcd-w' ); ?></h4>
        <select name="dp_options[header_posts_layout2_animation_time]">
        <?php foreach ( $header_slider_animation_time_options as $option ) : ?>
        <option value="<?php echo esc_attr( $option['value'] ); ?>" <?php selected( $option['value'], $dp_options['header_posts_layout2_animation_time'] ); ?>><?php echo esc_html( $option['label'] ); ?></option>
        <?php endforeach; ?>
        </select>
      	<h4 class="theme_option_headline2"><?php _e( 'Native advertisement settings of #1', 'tcd-w' ); ?></h4>
				<p><label><input name="dp_options[header_posts_layout2_1_display_native_ad]" type="checkbox" value="1" <?php checked( $dp_options['header_posts_layout2_1_display_native_ad'], 1 ); ?>><?php _e( 'Display native advertisements', 'tcd-w' ); ?></label></p>
				<p><label><?php _e( 'Position of native advertisement', 'tcd-w' ); ?> <input class="tiny-text" name="dp_options[header_posts_layout2_1_native_ad_position]" type="number" value="<?php echo esc_attr( $dp_options['header_posts_layout2_1_native_ad_position'] ); ?>" min="1"></label></p>
				<div class="theme_option_message">
					<p><?php _e( 'Registered native advertisements 1 to 6 will be displayed at random each time after the number of articles set in here.', 'tcd-w' ); ?></p>
				</div>
        <h4 class="theme_option_headline2"><?php _e( 'Post type of #2', 'tcd-w' ); ?></h4>
        <select name="dp_options[header_posts_layout2_2_post_type]">
        <?php foreach ( $header_posts_post_type_options as $option ) : ?>
        <option value="<?php echo esc_attr( $option['value'] ); ?>" <?php selected( $option['value'], $dp_options['header_posts_layout2_2_post_type'] ); ?>><?php echo esc_html( $option['label'] ); ?></option>
        <?php endforeach; ?>
        </select>
      	<h4 class="theme_option_headline2"><?php _e( 'Native advertisement settings of #2', 'tcd-w' ); ?></h4>
				<p><label><input name="dp_options[header_posts_layout2_2_display_native_ad]" type="checkbox" value="1" <?php checked( $dp_options['header_posts_layout2_2_display_native_ad'], 1 ); ?>><?php _e( 'Display native advertisements', 'tcd-w' ); ?></label></p>
				<p><label><?php _e( 'Position of native advertisement', 'tcd-w' ); ?> <input class="tiny-text" name="dp_options[header_posts_layout2_2_native_ad_position]" type="number" value="<?php echo esc_attr( $dp_options['header_posts_layout2_2_native_ad_position'] ); ?>" min="1"></label></p>
				<div class="theme_option_message">
					<p><?php _e( 'Registered native advertisements 1 to 6 will be displayed at random each time after the number of articles set in here.', 'tcd-w' ); ?></p>
				</div>
      </div>
      <div id="header_posts_layout_type3" class="<?php if ( 'type3' !== $dp_options['header_posts_layout'] ) { echo 'hidden'; } ?>">
        <h4 class="theme_option_headline2"><?php _e( 'Post type of #1', 'tcd-w' ); ?></h4>
        <select name="dp_options[header_posts_layout3_1_post_type]">
        <?php foreach ( $header_posts_post_type_options as $option ) : ?>
        <option value="<?php echo esc_attr( $option['value'] ); ?>" <?php selected( $option['value'], $dp_options['header_posts_layout3_1_post_type'] ); ?>><?php echo esc_html( $option['label'] ); ?></option>
        <?php endforeach; ?>
        </select>
        <h4 class="theme_option_headline2"><?php _e( 'Autoplay speed', 'tcd-w' ); ?></h4>
        <select name="dp_options[header_posts_layout3_animation_time]">
        <?php foreach ( $header_slider_animation_time_options as $option ) : ?>
        <option value="<?php echo esc_attr( $option['value'] ); ?>" <?php selected( $option['value'], $dp_options['header_posts_layout3_animation_time'] ); ?>><?php echo esc_html( $option['label'] ); ?></option>
        <?php endforeach; ?>
        </select>
      	<h4 class="theme_option_headline2"><?php _e( 'Native advertisement settings of #1', 'tcd-w' ); ?></h4>
				<p><label><input name="dp_options[header_posts_layout3_1_display_native_ad]" type="checkbox" value="1" <?php checked( $dp_options['header_posts_layout3_1_display_native_ad'], 1 ); ?>><?php _e( 'Display native advertisements', 'tcd-w' ); ?></label></p>
				<p><label><?php _e( 'Position of native advertisement', 'tcd-w' ); ?> <input class="tiny-text" name="dp_options[header_posts_layout3_1_native_ad_position]" type="number" value="<?php echo esc_attr( $dp_options['header_posts_layout3_1_native_ad_position'] ); ?>" min="1"></label></p>
				<div class="theme_option_message">
					<p><?php _e( 'Registered native advertisements 1 to 6 will be displayed at random each time after the number of articles set in here.', 'tcd-w' ); ?></p>
				</div>
        <h4 class="theme_option_headline2"><?php _e( 'Post type of #2', 'tcd-w' ); ?></h4>
        <select name="dp_options[header_posts_layout3_2_post_type]">
        <?php foreach ( $header_posts_post_type_options as $option ) : ?>
        <option value="<?php echo esc_attr( $option['value'] ); ?>" <?php selected( $option['value'], $dp_options['header_posts_layout3_2_post_type'] ); ?>><?php echo esc_html( $option['label'] ); ?></option>
        <?php endforeach; ?>
        </select>
      	<h4 class="theme_option_headline2"><?php _e( 'Native advertisement settings of #2', 'tcd-w' ); ?></h4>
				<p><label><input name="dp_options[header_posts_layout3_2_display_native_ad]" type="checkbox" value="1" <?php checked( $dp_options['header_posts_layout3_2_display_native_ad'], 1 ); ?>><?php _e( 'Display native advertisements', 'tcd-w' ); ?></label></p>
				<p><label><?php _e( 'Position of native advertisement', 'tcd-w' ); ?> <input class="tiny-text" name="dp_options[header_posts_layout3_2_native_ad_position]" type="number" value="<?php echo esc_attr( $dp_options['header_posts_layout3_2_native_ad_position'] ); ?>" min="1"></label></p>
				<div class="theme_option_message">
					<p><?php _e( 'Registered native advertisements 1 to 6 will be displayed at random each time after the number of articles set in here.', 'tcd-w' ); ?></p>
				</div>
      </div>
      <div id="header_posts_layout_type4" class="<?php if ( 'type4' !== $dp_options['header_posts_layout'] ) { echo 'hidden'; } ?>">
        <h4 class="theme_option_headline2"><?php _e( 'Post type to display', 'tcd-w' ); ?></h4>
        <select name="dp_options[header_posts_layout4_post_type]">
        <?php foreach ( $header_posts_post_type_options as $option ) : ?>
        <option value="<?php echo esc_attr( $option['value'] ); ?>" <?php selected( $option['value'], $dp_options['header_posts_layout4_post_type'] ); ?>><?php echo esc_html( $option['label'] ); ?></option>
        <?php endforeach; ?>
        </select>
      	<h4 class="theme_option_headline2"><?php _e( 'Native advertisement settings', 'tcd-w' ); ?></h4>
				<p><label><input name="dp_options[header_posts_layout4_display_native_ad]" type="checkbox" value="1" <?php checked( $dp_options['header_posts_layout4_display_native_ad'], 1 ); ?>><?php _e( 'Display native advertisements', 'tcd-w' ); ?></label></p>
				<p><label><?php _e( 'Position of native advertisement', 'tcd-w' ); ?> <input class="tiny-text" name="dp_options[header_posts_layout4_native_ad_position]" type="number" value="<?php echo esc_attr( $dp_options['header_posts_layout4_native_ad_position'] ); ?>" min="1"></label></p>
				<div class="theme_option_message">
					<p><?php _e( 'Registered native advertisements 1 to 6 will be displayed at random each time after the number of articles set in here.', 'tcd-w' ); ?></p>
				</div>
      </div>
		  <input type="submit" class="button-ml ajax_button" value="<?php _e( 'Save Changes', 'tcd-w' ); ?>">
    </div>
  </div>
  <?php // Image slider ?>
  <div id="header_content_type_type2"<?php if ( 'type2' !== $dp_options['header_content_type'] ) { echo ' style="display: none;"'; } ?>>
	  <div class="theme_option_field cf">
  	  <h3 class="theme_option_headline"><?php _e( 'Image slider settings', 'tcd-w' ); ?></h3>
		  <?php for ( $i = 1; $i <= 5; $i++ ) : ?>
		  <div class="sub_box cf">
      	<h3 class="theme_option_subbox_headline"><?php _e( 'Item', 'tcd-w' ); ?><?php echo $i; ?></h3>
      	<div class="sub_box_content">
      		<h4 class="theme_option_headline2"><?php _e( 'Image', 'tcd-w' ); ?></h4>
          <p><?php _e( 'Recommended size: width:1450px, height:725px', 'tcd-w' ); ?></p>
      		<div class="image_box cf">
      			<div class="cf cf_media_field hide-if-no-js">
      				<input type="hidden" value="<?php echo esc_attr( $dp_options['header_slider_img' . $i] ); ?>" id="header_slider_img<?php echo $i; ?>" name="dp_options[header_slider_img<?php echo $i; ?>]" class="cf_media_id">
      				<div class="preview_field"><?php if ( $dp_options['header_slider_img' . $i] ) { echo wp_get_attachment_image( $dp_options['header_slider_img' . $i], 'medium' ); } ?></div>
      				<div class="button_area">
      					<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
      					<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $dp_options['header_slider_img' . $i] ) { echo 'hidden'; } ?>">
      				</div>
      			</div>
      		</div>
      		<h4 class="theme_option_headline2"><?php _e( 'Image for mobile', 'tcd-w' ); ?></h4>
          <p><?php _e( 'Recommended size: width:980px, height:760px', 'tcd-w' ); ?></p>
      		<div class="image_box cf">
      			<div class="cf cf_media_field hide-if-no-js">
      				<input type="hidden" value="<?php echo esc_attr( $dp_options['header_slider_img_sp' . $i] ); ?>" id="header_slider_img_sp<?php echo $i; ?>" name="dp_options[header_slider_img_sp<?php echo $i; ?>]" class="cf_media_id">
      				<div class="preview_field"><?php if ( $dp_options['header_slider_img_sp' . $i] ) { echo wp_get_attachment_image( $dp_options['header_slider_img_sp' . $i], 'medium' ); } ?></div>
      				<div class="button_area">
      					<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
      					<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $dp_options['header_slider_img_sp' . $i] ) { echo 'hidden'; } ?>">
      				</div>
      			</div>
      		</div>
      		<h4 class="theme_option_headline2"><?php _e( 'Catchphrase', 'tcd-w' ); ?></h4>
          <input type="text" class="regular-text" name="dp_options[header_slider_catch<?php echo $i; ?>]" value="<?php echo esc_attr( $dp_options['header_slider_catch' . $i] ); ?>">
          <p><label><?php _e( 'Font size', 'tcd-w' ); ?> <input type="number" min="1" step="1" class="tiny-text" name="dp_options[header_slider_catch_font_size<?php echo $i; ?>]" value="<?php echo esc_attr( $dp_options['header_slider_catch_font_size' . $i] ); ?>"> px</label></p>
          <p><label for="header_slider_catch_color<?php echo $i; ?>"><?php _e( 'Font color', 'tcd-w' ); ?> </label><input type="text" class="c-color-picker" id="header_slider_catch_color<?php echo $i; ?>" name="dp_options[header_slider_catch_color<?php echo $i; ?>]" value="<?php echo esc_attr( $dp_options['header_slider_catch_color' . $i] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['header_slider_catch_color' . $i] ); ?>"></p>
      		<h4 class="theme_option_headline2"><?php _e( 'Button', 'tcd-w' ); ?></h4>
          <p><label><?php _e( 'Button label', 'tcd-w' ); ?> <input type="text" name="dp_options[header_slider_btn_label<?php echo $i; ?>]" value="<?php echo esc_attr( $dp_options['header_slider_btn_label' . $i] ); ?>" class="regular-text"></label></p>
          <p><label><?php _e( 'Link URL', 'tcd-w' ); ?> <input type="text" name="dp_options[header_slider_btn_url<?php echo $i; ?>]" value="<?php echo esc_attr( $dp_options['header_slider_btn_url' . $i] ); ?>" class="regular-text"></label></p>
          <p><label><input type="checkbox" name="dp_options[header_slider_btn_target<?php echo $i; ?>]" value="1" <?php checked( 1, $dp_options['header_slider_btn_target' . $i] ); ?>> <?php _e( 'Open link in new window', 'tcd-w' ); ?></label></p>
          <p><label for="header_slider_btn_color<?php echo $i; ?>"><?php _e( 'Font color', 'tcd-w' ); ?> </label><input type="text" id="header_slider_btn_color<?php echo $i; ?>" class="c-color-picker" name="dp_options[header_slider_btn_color<?php echo $i; ?>]" value="<?php echo esc_attr( $dp_options['header_slider_btn_color' . $i] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['header_slider_btn_color' . $i] ); ?>"></p>
          <p><label for="header_slider_btn_bg<?php echo $i; ?>"><?php _e( 'Background color', 'tcd-w' ); ?> </label><input type="text" id="header_slider_btn_bg<?php echo $i; ?>" class="c-color-picker" name="dp_options[header_slider_btn_bg<?php echo $i; ?>]" value="<?php echo esc_attr( $dp_options['header_slider_btn_bg' . $i] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['header_slider_btn_bg' . $i] ); ?>"></p>
          <p><label for="header_slider_btn_color_hover<?php echo $i; ?>"><?php _e( 'Font color on hover', 'tcd-w' ); ?> </label><input type="text" id="header_slider_btn_color_hover<?php echo $i; ?>" class="c-color-picker" name="dp_options[header_slider_btn_color_hover<?php echo $i; ?>]" value="<?php echo esc_attr( $dp_options['header_slider_btn_color_hover' . $i] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['header_slider_btn_color_hover' . $i] ); ?>"></p>
          <p><label for="header_slider_btn_bg_hover<?php echo $i; ?>"><?php _e( 'Background color on hover', 'tcd-w' ); ?> </label><input type="text" id="header_slider_btn_bg_hover<?php echo $i; ?>" class="c-color-picker" name="dp_options[header_slider_btn_bg_hover<?php echo $i; ?>]" value="<?php echo esc_attr( $dp_options['header_slider_btn_bg_hover' . $i] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['header_slider_btn_bg_hover' . $i] ); ?>"></p>
		  		<input type="submit" class="button-ml ajax_button" value="<?php _e( 'Save Changes', 'tcd-w' ); ?>">
		  	</div>
		  </div><!-- .sub_box END -->
		  <?php endfor; ?>
      <h4 class="theme_option_headline2"><?php _e( 'Image slider animation time', 'tcd-w' ); ?></h4>
      <select name="dp_options[header_slider_animation_time]">
        <?php foreach ( $header_slider_animation_time_options as $option ) : ?>
        <option value="<?php echo esc_attr( $option['value'] ); ?>" <?php selected( $option['value'], $dp_options['header_slider_animation_time'] ); ?>><?php echo esc_attr_e( $option['label'] ); ?></option>
        <?php endforeach; ?>
      </select>
		  <input type="submit" class="button-ml ajax_button" value="<?php _e( 'Save Changes', 'tcd-w' ); ?>">
    </div>
  </div>
  <?php // Video ?>
  <div id="header_content_type_type3"<?php if ( 'type3' !== $dp_options['header_content_type'] ) { echo ' style="display: none;"'; } ?>>
	  <div class="theme_option_field cf">
  	  <h3 class="theme_option_headline"><?php _e( 'Video settings', 'tcd-w' ); ?></h3>
      <h4 class="theme_option_headline2"><?php _e( 'Video file', 'tcd-w' ); ?></h4>
      <p><?php _e( 'Please upload MP4 format file.', 'tcd-w' ); ?></p>
      <div class="image_box cf">
		    <div class="cf cf_media_field hide-if-no-js header_video">
		    	<input type="hidden" value="<?php echo esc_attr( $dp_options['header_video'] ); ?>" id="header_video" name="dp_options[header_video]" class="cf_media_id">
		    	<div class="preview_field preview_field_video">
		    		<?php if ( $dp_options['header_video'] ) : ?>
		    		<h5><?php _e( 'Uploaded MP4 file', 'tcd-w' ); ?></h5>
        		<p><?php echo esc_html( wp_get_attachment_url( $dp_options['header_video'] ) ); ?></p>
		    		<?php endif; ?>
        	</div>
        	<div class="button_area">
        		<input type="button" value="<?php _e( 'Select MP4 file', 'tcd-w' ); ?>" class="cfmf-select-video button">
        		<input type="button" value="<?php _e( 'Remove MP4 file', 'tcd-w' ); ?>" class="cfmf-delete-video button <?php if ( ! $dp_options['header_video'] ) { echo 'hidden'; }; ?>">
        	</div>
        </div>
      </div>
      <h4 class="theme_option_headline2"><?php _e( 'Substitute image', 'tcd-w' ); ?></h4>
      <p><?php _e( 'Substitute image is displayed on tablet and mobile devices. Recommended size: width:1450px, height:725px', 'tcd-w' ); ?></p>
      <div class="image_box cf">
      	<div class="cf cf_media_field hide-if-no-js">
      		<input type="hidden" value="<?php echo esc_attr( $dp_options['header_video_img'] ); ?>" id="header_video_img" name="dp_options[header_video_img]" class="cf_media_id">
      		<div class="preview_field"><?php if ( $dp_options['header_video_img'] ) { echo wp_get_attachment_image( $dp_options['header_video_img'], 'medium' ); } ?></div>
      		<div class="button_area">
      			<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
      			<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $dp_options['header_video_img'] ) { echo 'hidden'; } ?>">
      		</div>
      	</div>
      </div>
      <h4 class="theme_option_headline2"><?php _e( 'Catchphrase', 'tcd-w' ); ?></h4>
      <input type="text" class="regular-text" name="dp_options[header_video_catch]" value="<?php echo esc_attr( $dp_options['header_video_catch'] ); ?>">
      <p><label><?php _e( 'Font size', 'tcd-w' ); ?> <input type="number" min="1" step="1" name="dp_options[header_video_catch_font_size]" value="<?php echo esc_attr( $dp_options['header_video_catch_font_size'] ); ?>" class="tiny-text"> px</label></p>
      <p><label for="header_video_catch_color"><?php _e( 'Font color', 'tcd-w' ); ?></label> <input type="text" class="c-color-picker" name="dp_options[header_video_catch_color]" value="<?php echo esc_attr( $dp_options['header_video_catch_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['header_video_catch_color'] ); ?>"></p>
      <h4 class="theme_option_headline2"><?php _e( 'Button', 'tcd-w' ); ?></h4>
      <p><label><?php _e( 'Button label', 'tcd-w' ); ?> <input type="text" name="dp_options[header_video_btn_label]" value="<?php echo esc_attr( $dp_options['header_video_btn_label'] ); ?>" class="regular-text"></label></p>
      <p><label><?php _e( 'Link URL', 'tcd-w' ); ?> <input type="text" name="dp_options[header_video_btn_url]" value="<?php echo esc_attr( $dp_options['header_video_btn_url'] ); ?>" class="regular-text"></label></p>
      <p><label><input type="checkbox" name="dp_options[header_video_btn_target]" value="1" <?php checked( 1, $dp_options['header_video_btn_target'] ); ?>> <?php _e( 'Open link in new window', 'tcd-w' ); ?></label></p>
      <p><label for="header_video_btn_color"><?php _e( 'Font color', 'tcd-w' ); ?> </label><input type="text" id="header_video_btn_color" class="c-color-picker" name="dp_options[header_video_btn_color]" value="<?php echo esc_attr( $dp_options['header_video_btn_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['header_video_btn_color'] ); ?>"></p>
      <p><label for="header_video_btn_bg"><?php _e( 'Background color', 'tcd-w' ); ?> </label><input type="text" id="header_video_btn_bg" class="c-color-picker" name="dp_options[header_video_btn_bg]" value="<?php echo esc_attr( $dp_options['header_video_btn_bg'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['header_video_btn_bg'] ); ?>"></p>
      <p><label for="header_video_btn_color_hover"><?php _e( 'Font color on hover', 'tcd-w' ); ?> </label><input type="text" id="header_video_btn_color_hover" class="c-color-picker" name="dp_options[header_video_btn_color_hover]" value="<?php echo esc_attr( $dp_options['header_video_btn_color_hover'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['header_video_btn_color_hover'] ); ?>"></p>
      <p><label for="header_video_btn_bg_hover"><?php _e( 'Background color on hover', 'tcd-w' ); ?> </label><input type="text" id="header_video_btn_bg_hover" class="c-color-picker" name="dp_options[header_video_btn_bg_hover]" value="<?php echo esc_attr( $dp_options['header_video_btn_bg_hover'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['header_video_btn_bg_hover'] ); ?>"></p>
		<input type="submit" class="button-ml ajax_button" value="<?php _e( 'Save Changes', 'tcd-w' ); ?>">
    </div>
  </div>
  <?php // YouTube ?>
  <div id="header_content_type_type4"<?php if ( 'type4' !== $dp_options['header_content_type'] ) { echo ' style="display: none;"'; } ?>>
	  <div class="theme_option_field cf">
  	  <h3 class="theme_option_headline"><?php _e( 'YouTube settings', 'tcd-w' ); ?></h3>
      <h4 class="theme_option_headline2"><?php _e( 'YouTube URL', 'tcd-w' ); ?></h4>
      <input type="text" class="regular-text" name="dp_options[header_youtube_url]" value="<?php echo esc_attr( $dp_options['header_youtube_url'] ); ?>">
      <h4 class="theme_option_headline2"><?php _e( 'Substitute image', 'tcd-w' ); ?></h4>
      <p><?php _e( 'Substitute image is displayed on tablet and mobile devices. Recommended size: width:1450px, height:725px', 'tcd-w' ); ?></p>
      <div class="image_box cf">
      	<div class="cf cf_media_field hide-if-no-js">
      		<input type="hidden" value="<?php echo esc_attr( $dp_options['header_youtube_img'] ); ?>" id="header_youtube_img" name="dp_options[header_youtube_img]" class="cf_media_id">
      		<div class="preview_field"><?php if ( $dp_options['header_youtube_img'] ) { echo wp_get_attachment_image( $dp_options['header_youtube_img'], 'medium' ); } ?></div>
      		<div class="button_area">
      			<input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
      			<input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $dp_options['header_youtube_img'] ) { echo 'hidden'; } ?>">
      		</div>
      	</div>
      </div>
      <h4 class="theme_option_headline2"><?php _e( 'Catchphrase', 'tcd-w' ); ?></h4>
      <input type="text" class="regular-text" name="dp_options[header_youtube_catch]" value="<?php echo esc_attr( $dp_options['header_youtube_catch'] ); ?>">
      <p><label><?php _e( 'Font size', 'tcd-w' ); ?> <input type="number" min="1" step="1" name="dp_options[header_youtube_catch_font_size]" value="<?php echo esc_attr( $dp_options['header_youtube_catch_font_size'] ); ?>" class="tiny-text"> px</label></p>
      <p><label for="header_youtube_catch_color"><?php _e( 'Font color', 'tcd-w' ); ?></label> <input type="text" class="c-color-picker" name="dp_options[header_youtube_catch_color]" value="<?php echo esc_attr( $dp_options['header_youtube_catch_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['header_youtube_catch_color'] ); ?>"></p>
      <h4 class="theme_option_headline2"><?php _e( 'Button', 'tcd-w' ); ?></h4>
      <p><label><?php _e( 'Button label', 'tcd-w' ); ?> <input type="text" name="dp_options[header_youtube_btn_label]" value="<?php echo esc_attr( $dp_options['header_youtube_btn_label'] ); ?>" class="regular-text"></label></p>
      <p><label><?php _e( 'Link URL', 'tcd-w' ); ?> <input type="text" name="dp_options[header_youtube_btn_url]" value="<?php echo esc_attr( $dp_options['header_youtube_btn_url'] ); ?>" class="regular-text"></label></p>
      <p><label><input type="checkbox" name="dp_options[header_youtube_btn_target]" value="1" <?php checked( 1, $dp_options['header_youtube_btn_target'] ); ?>> <?php _e( 'Open link in new window', 'tcd-w' ); ?></label></p>
      <p><label for="header_youtube_btn_color"><?php _e( 'Font color', 'tcd-w' ); ?> </label><input type="text" id="header_youtube_btn_color" class="c-color-picker" name="dp_options[header_youtube_btn_color]" value="<?php echo esc_attr( $dp_options['header_youtube_btn_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['header_youtube_btn_color'] ); ?>"></p>
      <p><label for="header_youtube_btn_bg"><?php _e( 'Background color', 'tcd-w' ); ?> </label><input type="text" id="header_youtube_btn_bg" class="c-color-picker" name="dp_options[header_youtube_btn_bg]" value="<?php echo esc_attr( $dp_options['header_youtube_btn_bg'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['header_youtube_btn_bg'] ); ?>"></p>
      <p><label for="header_youtube_btn_color_hover"><?php _e( 'Font color on hover', 'tcd-w' ); ?> </label><input type="text" id="header_youtube_btn_color_hover" class="c-color-picker" name="dp_options[header_youtube_btn_color_hover]" value="<?php echo esc_attr( $dp_options['header_youtube_btn_color_hover'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['header_youtube_btn_color_hover'] ); ?>"></p>
      <p><label for="header_youtube_btn_bg_hover"><?php _e( 'Background color on hover', 'tcd-w' ); ?> </label><input type="text" id="header_youtube_btn_bg_hover" class="c-color-picker" name="dp_options[header_youtube_btn_bg_hover]" value="<?php echo esc_attr( $dp_options['header_youtube_btn_bg_hover'] ); ?>" data-default-color="<?php echo esc_attr( $dp_default_options['header_youtube_btn_bg_hover'] ); ?>"></p>
		  <input type="submit" class="button-ml ajax_button" value="<?php _e( 'Save Changes', 'tcd-w' ); ?>">
    </div>
  </div>
	<div class="theme_option_field cf">
  	<h3 class="theme_option_headline"><?php _e( 'Main content', 'tcd-w' ); ?></h3>
    <p><?php _e( 'You can change order by dragging each headline of option field.', 'tcd-w' ); ?></p>
    <div class="sortable">
      <?php
      foreach ( $dp_options['index_contents_order'] as $order ) :
        if ( 'special' === $order ) :
      ?>
		  <div class="sub_box cf">
      	<h3 class="theme_option_subbox_headline"><?php _e( 'Special contents', 'tcd-w' ); ?></h3>
      	<div class="sub_box_content">
          <input type="hidden" name="dp_options[index_contents_order][]" value="special">
          <p><label><input type="checkbox" name="dp_options[display_index_special]" value="1" <?php checked( 1, $dp_options['display_index_special'] ); ?>> <?php _e( 'Display this contents', 'tcd-w' ); ?></label></p>
      		<h4 class="theme_option_headline2"><?php _e( 'Title', 'tcd-w' ); ?></h4>
          <input type="text" name="dp_options[index_special_title]" value="<?php echo esc_attr( $dp_options['index_special_title'] ); ?>" class="regular-text">
          <p><label><?php _e( 'Font size', 'tcd-w' ); ?> <input type="number" min="1" step="1" name="dp_options[index_special_title_font_size]" value="<?php echo esc_attr( $dp_options['index_special_title_font_size'] ); ?>" class="tiny-text"> px</label></p>
          <p><label for="index_special_title_color"><?php _e( 'Font color', 'tcd-w' ); ?></label> <input type="text" class="c-color-picker" name="dp_options[index_special_title_color]" id="index_special_title_color" value="<?php echo esc_attr( $dp_options['index_special_title_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_options['index_special_title_color'] ); ?>"></p>
      		<h4 class="theme_option_headline2"><?php _e( 'Sub title', 'tcd-w' ); ?></h4>
          <input type="text" name="dp_options[index_special_sub]" value="<?php echo esc_attr( $dp_options['index_special_sub'] ); ?>" class="regular-text">
      		<h4 class="theme_option_headline2"><?php _e( 'Layout', 'tcd-w' ); ?></h4>
          <ul class="layout-type-list">
            <?php foreach ( $index_special_layout_options as $option ) : ?>
            <li>
              <figure><img src="<?php echo get_template_directory_uri(); ?>/admin/assets/images/special_<?php echo esc_attr( $option['value'] ); ?>.png" alt=""></figure>
              <label><input type="radio" name="dp_options[index_special_layout]" value="<?php echo esc_attr( $option['value'] ); ?>" <?php checked( $option['value'], $dp_options['index_special_layout'] ); ?>> <?php echo esc_html( $option['label'] ); ?></label>
            </li>
            <?php endforeach; ?>
          </ul>
      		<h4 class="theme_option_headline2"><?php _e( 'Archive link', 'tcd-w' ); ?></h4>
          <p><label><?php _e( 'Link text', 'tcd-w' ); ?> <input type="text" class="regular-text" name="dp_options[index_special_link_text]" value="<?php echo esc_attr( $dp_options['index_special_link_text'] ); ?>"></label></p>
      		<h4 class="theme_option_headline2"><?php _e( 'Native advertisement settings', 'tcd-w' ); ?></h4>
					<p><label><input name="dp_options[index_special_display_native_ad]" type="checkbox" value="1" <?php checked( $dp_options['index_special_display_native_ad'], 1 ); ?>><?php _e( 'Display native advertisements', 'tcd-w' ); ?></label></p>
					<p><label><?php _e( 'Position of native advertisement', 'tcd-w' ); ?> <input class="tiny-text" name="dp_options[index_special_native_ad_position]" type="number" value="<?php echo esc_attr( $dp_options['index_special_native_ad_position'] ); ?>" min="1"></label></p>
					<div class="theme_option_message">
						<p><?php _e( 'Registered native advertisements 1 to 6 will be displayed at random each time after the number of articles set in here.', 'tcd-w' ); ?></p>
					</div>
		  		<input type="submit" class="button-ml ajax_button" value="<?php _e( 'Save Changes', 'tcd-w' ); ?>">
		  	</div>
		  </div><!-- .sub_box END -->
      <?php
        elseif ( 'news' === $order ) :
      ?>
		  <div class="sub_box cf">
      	<h3 class="theme_option_subbox_headline"><?php _e( 'News contents', 'tcd-w' ); ?></h3>
      	<div class="sub_box_content">
          <input type="hidden" name="dp_options[index_contents_order][]" value="news">
          <p><label><input type="checkbox" name="dp_options[display_index_news]" value="1" <?php checked( 1, $dp_options['display_index_news'] ); ?>> <?php _e( 'Display this contents', 'tcd-w' ); ?></label></p>
      		<h4 class="theme_option_headline2"><?php _e( 'Title', 'tcd-w' ); ?></h4>
          <input type="text" name="dp_options[index_news_title]" value="<?php echo esc_attr( $dp_options['index_news_title'] ); ?>" class="regular-text">
          <p><label><?php _e( 'Font size', 'tcd-w' ); ?> <input type="number" min="1" step="1" name="dp_options[index_news_title_font_size]" value="<?php echo esc_attr( $dp_options['index_news_title_font_size'] ); ?>" class="tiny-text"> px</label></p>
          <p><label for="index_news_title_color"><?php _e( 'Font color', 'tcd-w' ); ?></label> <input type="text" class="c-color-picker" name="dp_options[index_news_title_color]" id="index_news_title_color" value="<?php echo esc_attr( $dp_options['index_news_title_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_options['index_news_title_color'] ); ?>"></p>
      		<h4 class="theme_option_headline2"><?php _e( 'Sub title', 'tcd-w' ); ?></h4>
          <input type="text" name="dp_options[index_news_sub]" value="<?php echo esc_attr( $dp_options['index_news_sub'] ); ?>" class="regular-text">
      		<h4 class="theme_option_headline2"><?php _e( 'Display number', 'tcd-w' ); ?></h4>
          <input class="tiny-text" type="number" min="1" step="1" name="dp_options[index_news_num]" value="<?php echo esc_attr( $dp_options['index_news_num'] ); ?>"><?php _e( ' posts', 'tcd-w' ); ?>
      		<h4 class="theme_option_headline2"><?php _e( 'Archive link', 'tcd-w' ); ?></h4>
          <p><label><?php _e( 'Link text', 'tcd-w' ); ?> <input type="text" class="regular-text" name="dp_options[index_news_link_text]" value="<?php echo esc_attr( $dp_options['index_news_link_text'] ); ?>"></label></p>
		  		<input type="submit" class="button-ml ajax_button" value="<?php _e( 'Save Changes', 'tcd-w' ); ?>">
		  	</div>
		  </div><!-- .sub_box END -->
      <?php
        elseif ( 'event' === $order ) :
      ?>
		  <div class="sub_box cf">
      	<h3 class="theme_option_subbox_headline"><?php _e( 'Event contents', 'tcd-w' ); ?></h3>
      	<div class="sub_box_content">
          <input type="hidden" name="dp_options[index_contents_order][]" value="event">
          <p><label><input type="checkbox" name="dp_options[display_index_event]" value="1" <?php checked( 1, $dp_options['display_index_event'] ); ?>> <?php _e( 'Display this contents', 'tcd-w' ); ?></label></p>
      		<h4 class="theme_option_headline2"><?php _e( 'Title', 'tcd-w' ); ?></h4>
          <input type="text" name="dp_options[index_event_title]" value="<?php echo esc_attr( $dp_options['index_event_title'] ); ?>" class="regular-text">
          <p><label><?php _e( 'Font size', 'tcd-w' ); ?> <input type="number" min="1" step="1" name="dp_options[index_event_title_font_size]" value="<?php echo esc_attr( $dp_options['index_event_title_font_size'] ); ?>" class="tiny-text"> px</label></p>
          <p><label for="index_event_title_color"><?php _e( 'Font color', 'tcd-w' ); ?></label> <input type="text" class="c-color-picker" name="dp_options[index_event_title_color]" id="index_event_title_color" value="<?php echo esc_attr( $dp_options['index_event_title_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_options['index_event_title_color'] ); ?>"></p>
      		<h4 class="theme_option_headline2"><?php _e( 'Sub title', 'tcd-w' ); ?></h4>
          <input type="text" name="dp_options[index_event_sub]" value="<?php echo esc_attr( $dp_options['index_event_sub'] ); ?>" class="regular-text">
      		<h4 class="theme_option_headline2"><?php _e( 'Display number', 'tcd-w' ); ?></h4>
          <input class="tiny-text" type="number" min="1" step="1" name="dp_options[index_event_num]" value="<?php echo esc_attr( $dp_options['index_event_num'] ); ?>"><?php _e( ' posts', 'tcd-w' ); ?>
          <h4 class="theme_option_headline2"><?php _e( 'Readmore button', 'tcd-w' ); ?></h4>
          <p><label><?php _e( 'Link text', 'tcd-w' ); ?> <input type="text" class="regular-text" name="dp_options[index_event_read_more]" value="<?php echo esc_attr( $dp_options['index_event_read_more'] ); ?>"></label></p>
      		<h4 class="theme_option_headline2"><?php _e( 'Archive link', 'tcd-w' ); ?></h4>
          <p><label><?php _e( 'Link text', 'tcd-w' ); ?> <input type="text" class="regular-text" name="dp_options[index_event_link_text]" value="<?php echo esc_attr( $dp_options['index_event_link_text'] ); ?>"></label></p>
		  		<input type="submit" class="button-ml ajax_button" value="<?php _e( 'Save Changes', 'tcd-w' ); ?>">
		  	</div>
		  </div><!-- .sub_box END -->
      <?php
        elseif ( 'blog' === $order ) :
      ?>
		  <div class="sub_box cf">
      	<h3 class="theme_option_subbox_headline"><?php _e( 'Blog contents', 'tcd-w' ); ?></h3>
      	<div class="sub_box_content">
          <input type="hidden" name="dp_options[index_contents_order][]" value="blog">
          <p><label><input type="checkbox" name="dp_options[display_index_blog]" value="1" <?php checked( 1, $dp_options['display_index_blog'] ); ?>> <?php _e( 'Display this contents', 'tcd-w' ); ?></label></p>
      		<h4 class="theme_option_headline2"><?php _e( 'Title', 'tcd-w' ); ?></h4>
          <input type="text" name="dp_options[index_blog_title]" value="<?php echo esc_attr( $dp_options['index_blog_title'] ); ?>" class="regular-text">
          <p><label><?php _e( 'Font size', 'tcd-w' ); ?> <input type="number" min="1" step="1" name="dp_options[index_blog_title_font_size]" value="<?php echo esc_attr( $dp_options['index_blog_title_font_size'] ); ?>" class="tiny-text"> px</label></p>
          <p><label for="index_blog_title_color"><?php _e( 'Font color', 'tcd-w' ); ?></label> <input type="text" class="c-color-picker" name="dp_options[index_blog_title_color]" id="index_blog_title_color" value="<?php echo esc_attr( $dp_options['index_blog_title_color'] ); ?>" data-default-color="<?php echo esc_attr( $dp_options['index_blog_title_color'] ); ?>"></p>
      		<h4 class="theme_option_headline2"><?php _e( 'Sub title', 'tcd-w' ); ?></h4>
          <input type="text" name="dp_options[index_blog_sub]" value="<?php echo esc_attr( $dp_options['index_blog_sub'] ); ?>" class="regular-text">
      		<h4 class="theme_option_headline2"><?php _e( 'Display number', 'tcd-w' ); ?></h4>
          <input class="tiny-text" type="number" min="1" step="1" name="dp_options[index_blog_num]" value="<?php echo esc_attr( $dp_options['index_blog_num'] ); ?>"><?php _e( ' posts', 'tcd-w' ); ?>
      		<h4 class="theme_option_headline2"><?php _e( 'Post type', 'tcd-w' ); ?></h4>
          <select name="dp_options[index_blog_type]">
          <?php foreach ( $index_blog_type_options as $option ) : ?>
          <option value="<?php echo esc_attr( $option['value'] ); ?>" <?php selected( $option['value'], $dp_options['index_blog_type'] ); ?>> <?php echo esc_html( $option['label'] ); ?></option>
          <?php endforeach; ?>
          </select>
      		<h4 class="theme_option_headline2"><?php _e( 'Post order', 'tcd-w' ); ?></h4>
          <select name="dp_options[index_blog_order]">
          <?php foreach ( $index_blog_order_options as $option ) : ?>
          <option value="<?php echo esc_attr( $option['value'] ); ?>" <?php selected( $option['value'], $dp_options['index_blog_order'] ); ?>> <?php echo esc_html( $option['label'] ); ?></option>
          <?php endforeach; ?>
          </select>
      		<h4 class="theme_option_headline2"><?php _e( 'Archive link', 'tcd-w' ); ?></h4>
          <p><label><?php _e( 'Link text', 'tcd-w' ); ?> <input type="text" class="regular-text" name="dp_options[index_blog_link_text]" value="<?php echo esc_attr( $dp_options['index_blog_link_text'] ); ?>"></label></p>
      		<h4 class="theme_option_headline2"><?php _e( 'Native advertisement settings', 'tcd-w' ); ?></h4>
					<p><label><input name="dp_options[index_blog_display_native_ad]" type="checkbox" value="1" <?php checked( $dp_options['index_blog_display_native_ad'], 1 ); ?>><?php _e( 'Display native advertisements', 'tcd-w' ); ?></label></p>
					<p><label><?php _e( 'Position of native advertisement', 'tcd-w' ); ?> <input class="tiny-text" name="dp_options[index_blog_native_ad_position]" type="number" value="<?php echo esc_attr( $dp_options['index_blog_native_ad_position'] ); ?>" min="1"></label></p>
					<div class="theme_option_message">
						<p><?php _e( 'Registered native advertisements 1 to 6 will be displayed at random each time after the number of articles set in here.', 'tcd-w' ); ?></p>
					</div>
		  		<input type="submit" class="button-ml ajax_button" value="<?php _e( 'Save Changes', 'tcd-w' ); ?>">
		  	</div>
		  </div><!-- .sub_box END -->
      <?php
      elseif ( 'wysiwyg1' === $order || 'wysiwyg2' === $order || 'wysiwyg3' === $order ) :
        $key = mb_substr( $order, -1 );
      ?>
		  <div class="sub_box cf">
      	<h3 class="theme_option_subbox_headline"><?php _e( 'Wysiwyg contents', 'tcd-w' ); ?><?php echo esc_html( $key ); ?></h3>
      	<div class="sub_box_content">
          <input type="hidden" name="dp_options[index_contents_order][]" value="wysiwyg<?php echo esc_attr( $key ); ?>">
          <p><label><input type="checkbox" name="dp_options[display_index_wysiwyg<?php echo esc_attr( $key ); ?>]" value="1" <?php checked( 1, $dp_options['display_index_wysiwyg' . $key] ); ?>> <?php _e( 'Display this contents', 'tcd-w' ); ?></label></p>
			    <?php
          wp_editor(
            $dp_options['index_wysiwyg_editor' . $key],
            'index_wysiwyg_editor' . $key,
            array(
              'textarea_name' => 'dp_options[index_wysiwyg_editor' . $key . ']',
              'textarea_rows' => 10
            )
          );
          ?>
		  		<input type="submit" class="button-ml ajax_button" value="<?php _e( 'Save Changes', 'tcd-w' ); ?>">
		  	</div>
		  </div><!-- .sub_box END -->
      <?php endif; endforeach; ?>
		  <input type="submit" class="button-ml ajax_button" value="<?php _e( 'Save Changes', 'tcd-w' ); ?>">
    </div>
  </div>
</div><!-- END #tab-content3 -->
<?php
}

function add_top_theme_options_validate( $input ) {

  global $dp_default_options, $header_content_type_options, $header_posts_layout_options, $header_posts_post_type_options, $header_slider_animation_options, $recent_post_num_options, $style_list_num_options, $staff_list_num_options, $header_slider_animation_time_options, $index_special_layout_options, $index_blog_type_options, $index_blog_order_options;

  // Header contents
  if ( ! isset( $input['header_content_type'] ) ) $input['header_content_type'] = null;
  if ( ! array_key_exists( $input['header_content_type'], $header_content_type_options ) ) $input['header_content_type'] = null;

  // Posts slider
  if ( ! isset( $input['header_posts_layout'] ) ) $input['header_posts_layout'] = null;
  if ( ! array_key_exists( $input['header_posts_layout'], $header_posts_layout_options ) ) $input['header_posts_layout'] = null;
  if ( ! isset( $input['header_posts_layout1_post_type'] ) ) $input['header_posts_layout1_post_type'] = null;
  if ( ! array_key_exists( $input['header_posts_layout1_post_type'], $header_posts_post_type_options ) ) $input['header_posts_layout1_post_type'] = null;
  if ( ! isset( $input['header_posts_layout1_animation_time'] ) ) $input['header_posts_layout1_animation_time'] = null;
	if ( ! isset( $input['header_posts_layout1_display_native_ad'] ) ) $input['header_posts_layout1_display_native_ad'] = null;
	$input['header_posts_layout1_display_native_ad'] = $input['header_posts_layout1_display_native_ad'] == 1 ? 1 : 0;
	$input['header_posts_layout1_native_ad_position'] = absint( $input['header_posts_layout1_native_ad_position'] );
  if ( ! array_key_exists( $input['header_posts_layout1_animation_time'], $header_slider_animation_time_options ) ) $input['header_posts_layout1_animation_time'] = null;
  for ( $i = 2; $i <= 3; $i++ ) {
    if ( ! isset( $input['header_posts_layout' . $i . '_1_post_type'] ) ) $input['header_posts_layout' . $i . '_1_post_type'] = null;
    if ( ! array_key_exists( $input['header_posts_layout' . $i . '_1_post_type'], $header_posts_post_type_options ) ) $input['header_posts_layout' . $i . '_1_post_type'] = null;
    if ( ! isset( $input['header_posts_layout' . $i . '_animation_time'] ) ) $input['header_posts_layout' . $i . '_animation_time'] = null;
    if ( ! array_key_exists( $input['header_posts_layout' . $i . '_animation_time'], $header_slider_animation_time_options ) ) $input['header_posts_layout' . $i . '_animation_time'] = null;
		if ( ! isset( $input['header_posts_layout' . $i . '_1_display_native_ad'] ) ) $input['header_posts_layout' . $i . '_1_display_native_ad'] = null;
		$input['header_posts_layout' . $i . '_1_display_native_ad'] = $input['header_posts_layout' . $i . '_1_display_native_ad'] == 1 ? 1 : 0;
		$input['header_posts_layout' . $i . '_1_native_ad_position'] = absint( $input['header_posts_layout' . $i . '_1_native_ad_position'] );

    if ( ! isset( $input['header_posts_layout' . $i . '_2_post_type'] ) ) $input['header_posts_layout' . $i . '_2_post_type'] = null;
    if ( ! array_key_exists( $input['header_posts_layout' . $i . '_2_post_type'], $header_posts_post_type_options ) ) $input['header_posts_layout' . $i . '_2_post_type'] = null;
		if ( ! isset( $input['header_posts_layout' . $i . '_2_display_native_ad'] ) ) $input['header_posts_layout' . $i . '_2_display_native_ad'] = null;
		$input['header_posts_layout' . $i . '_2_display_native_ad'] = $input['header_posts_layout' . $i . '_2_display_native_ad'] == 1 ? 1 : 0;
		$input['header_posts_layout' . $i . '_2_native_ad_position'] = absint( $input['header_posts_layout' . $i . '_2_native_ad_position'] );
  }
  if ( ! isset( $input['header_posts_layout4_post_type'] ) ) $input['header_posts_layout4_post_type'] = null;
  if ( ! array_key_exists( $input['header_posts_layout4_post_type'], $header_posts_post_type_options ) ) $input['header_posts_layout4_post_type'] = null;

	if ( ! isset( $input['header_posts_layout4_display_native_ad'] ) ) $input['header_posts_layout4_display_native_ad'] = null;
	$input['header_posts_layout4_display_native_ad'] = $input['header_posts_layout4_display_native_ad'] == 1 ? 1 : 0;
	$input['header_posts_layout4_native_ad_position'] = absint( $input['header_posts_layout4_native_ad_position'] );

  // Image slider
  for ( $i = 1; $i <= 5; $i++ ) {
	  $input['header_slider_img' . $i] = absint( $input['header_slider_img' . $i] );
	  $input['header_slider_img_sp' . $i] = absint( $input['header_slider_img_sp' . $i] );
	  $input['header_slider_catch' . $i] = $input['header_slider_catch' . $i]; // Not apply sanitization
	  $input['header_slider_catch_font_size' . $i] = absint( $input['header_slider_catch_font_size' . $i] );
	  $input['header_slider_catch_color' . $i] = sanitize_hex_color( $input['header_slider_catch_color' . $i] );
	  $input['header_slider_btn_label' . $i] = sanitize_text_field( $input['header_slider_btn_label' . $i] );
	  $input['header_slider_btn_url' . $i] = esc_url_raw( $input['header_slider_btn_url' . $i] );
    if ( ! isset( $input['header_slider_btn_target' . $i] ) ) $input['header_slider_btn_target' . $i] = null;
    $input['header_slider_btn_target' . $i] = ( $input['header_slider_btn_target' . $i] == 1 ? 1 : 0 );
	  $input['header_slider_btn_color' . $i] = sanitize_hex_color( $input['header_slider_btn_color' . $i] );
	  $input['header_slider_btn_color_hover' . $i] = sanitize_hex_color( $input['header_slider_btn_color_hover' . $i] );
	  $input['header_slider_btn_bg' . $i] = sanitize_hex_color( $input['header_slider_btn_bg' . $i] );
	  $input['header_slider_btn_bg_hover' . $i] = sanitize_hex_color( $input['header_slider_btn_bg_hover' . $i] );
  }
  if ( ! isset( $input['header_slider_animation_time'] ) ) $input['header_slider_animation_time'] = null;
  if ( ! array_key_exists( $input['header_slider_animation_time'], $header_slider_animation_time_options ) ) $input['header_slider_animation_time'] = null;

  // Video
	$input['header_video'] = absint( $input['header_video'] );
	$input['header_video_img'] = absint( $input['header_video_img'] );
	$input['header_video_catch'] = sanitize_text_field( $input['header_video_catch'] );
	$input['header_video_catch_font_size'] = absint( $input['header_video_catch_font_size'] );
	$input['header_video_catch_color'] = sanitize_hex_color( $input['header_video_catch_color'] );
	$input['header_video_btn_label'] = sanitize_text_field( $input['header_video_btn_label'] );
	$input['header_video_btn_url'] = esc_url_raw( $input['header_video_btn_url'] );
  if ( ! isset( $input['header_video_btn_target'] ) ) $input['header_video_btn_target'] = null;
  $input['header_video_btn_target'] = ( $input['header_video_btn_target'] == 1 ? 1 : 0 );
	$input['header_video_btn_color'] = sanitize_hex_color( $input['header_video_btn_color'] );
	$input['header_video_btn_bg'] = sanitize_hex_color( $input['header_video_btn_bg'] );
	$input['header_video_btn_color_hover'] = sanitize_hex_color( $input['header_video_btn_color_hover'] );
	$input['header_video_btn_bg_hover'] = sanitize_hex_color( $input['header_video_btn_bg_hover'] );

  // YouTube
	$input['header_youtube_url'] = esc_url_raw( $input['header_youtube_url'] );
	$input['header_youtube_img'] = absint( $input['header_youtube_img'] );
	$input['header_youtube_catch'] = sanitize_text_field( $input['header_youtube_catch'] );
	$input['header_youtube_catch_font_size'] = absint( $input['header_youtube_catch_font_size'] );
	$input['header_youtube_catch_color'] = sanitize_hex_color( $input['header_youtube_catch_color'] );
	$input['header_youtube_btn_label'] = sanitize_text_field( $input['header_youtube_btn_label'] );
	$input['header_youtube_btn_url'] = esc_url_raw( $input['header_youtube_btn_url'] );
  if ( ! isset( $input['header_youtube_btn_target'] ) ) $input['header_youtube_btn_target'] = null;
  $input['header_youtube_btn_target'] = ( $input['header_youtube_btn_target'] == 1 ? 1 : 0 );
	$input['header_youtube_btn_color'] = sanitize_hex_color( $input['header_youtube_btn_color'] );
	$input['header_youtube_btn_bg'] = sanitize_hex_color( $input['header_youtube_btn_bg'] );
	$input['header_youtube_btn_color_hover'] = sanitize_hex_color( $input['header_youtube_btn_color_hover'] );
	$input['header_youtube_btn_bg_hover'] = sanitize_hex_color( $input['header_youtube_btn_bg_hover'] );

  // contents
  if ( ! isset( $input['index_contents_order'] ) ) {
    $input['index_contents_order'] = $dp_default_options['index_contents_order'];
  }
  foreach ( $input['index_contents_order'] as $order ) {
    if ( ! in_array( $order, $dp_default_options['index_contents_order'] ) ) {
      $input['index_contents_order'] = $dp_default_options['index_contents_order'];
      break;
    }
  }

  // Special contents
	if ( ! isset( $input['display_index_special'] ) ) $input['display_index_special'] = null;
	$input['display_index_special'] = ( $input['display_index_special'] == 1 ? 1 : 0 );
	$input['index_special_title'] = sanitize_text_field( $input['index_special_title'] );
	$input['index_special_title_font_size'] = absint( $input['index_special_title_font_size'] );
  $input['index_special_title_color'] = sanitize_hex_color( $input['index_special_title_color'] );
	$input['index_special_sub'] = sanitize_text_field( $input['index_special_sub'] );
	if ( ! isset( $input['index_special_layout'] ) ) $input['index_special_layout'] = null;
  if ( ! array_key_exists( $input['index_special_layout'], $index_special_layout_options ) ) $input['index_special_layout'] = null;
	$input['index_special_link_text'] = sanitize_text_field( $input['index_special_link_text'] );
	if ( ! isset( $input['index_special_display_native_ad'] ) ) $input['index_special_display_native_ad'] = null;
	$input['index_special_display_native_ad'] = ( $input['index_special_display_native_ad'] == 1 ? 1 : 0 );
	$input['index_special_native_ad_position'] = absint( $input['index_special_native_ad_position'] );

  // News contents
	if ( ! isset( $input['display_index_news'] ) ) $input['display_index_news'] = null;
	$input['display_index_news'] = ( $input['display_index_news'] == 1 ? 1 : 0 );
	$input['index_news_title'] = sanitize_text_field( $input['index_news_title'] );
	$input['index_news_title_font_size'] = absint( $input['index_news_title_font_size'] );
  $input['index_news_title_color'] = sanitize_hex_color( $input['index_news_title_color'] );
	$input['index_news_sub'] = sanitize_text_field( $input['index_news_sub'] );
	$input['index_news_num'] = absint( $input['index_news_num'] );
	$input['index_news_link_text'] = sanitize_text_field( $input['index_news_link_text'] );

  // Event contents
	if ( ! isset( $input['display_index_event'] ) ) $input['display_index_event'] = null;
	$input['display_index_event'] = ( $input['display_index_event'] == 1 ? 1 : 0 );
	$input['index_event_title'] = sanitize_text_field( $input['index_event_title'] );
	$input['index_event_title_font_size'] = absint( $input['index_event_title_font_size'] );
  $input['index_event_title_color'] = sanitize_hex_color( $input['index_event_title_color'] );
	$input['index_event_sub'] = sanitize_text_field( $input['index_event_sub'] );
	$input['index_event_num'] = absint( $input['index_event_num'] );
	$input['index_event_read_more'] = sanitize_text_field( $input['index_event_read_more'] );
	$input['index_event_link_text'] = sanitize_text_field( $input['index_event_link_text'] );

  // Blog contents
	if ( ! isset( $input['display_index_blog'] ) ) $input['display_index_blog'] = null;
	$input['display_index_blog'] = ( $input['display_index_blog'] == 1 ? 1 : 0 );
	$input['index_blog_title'] = sanitize_text_field( $input['index_blog_title'] );
	$input['index_blog_title_font_size'] = absint( $input['index_blog_title_font_size'] );
  $input['index_blog_title_color'] = sanitize_hex_color( $input['index_blog_title_color'] );
	$input['index_blog_sub'] = sanitize_text_field( $input['index_blog_sub'] );
	$input['index_blog_num'] = absint( $input['index_blog_num'] );
  if ( ! isset( $input['index_blog_type'] ) ) $input['index_blog_type'] = null;
  if ( ! array_key_exists( $input['index_blog_type'], $index_blog_type_options ) ) $input['index_blog_type'] = null;
  if ( ! isset( $input['index_blog_order'] ) ) $input['index_blog_order'] = null;
  if ( ! array_key_exists( $input['index_blog_order'], $index_blog_order_options ) ) $input['index_blog_order'] = null;
	$input['index_blog_link_text'] = sanitize_text_field( $input['index_blog_link_text'] );
	if ( ! isset( $input['index_blog_display_native_ad'] ) ) $input['index_blog_display_native_ad'] = null;
	$input['index_blog_display_native_ad'] = ( $input['index_blog_display_native_ad'] == 1 ? 1 : 0 );
	$input['index_blog_native_ad_position'] = absint( $input['index_blog_native_ad_position'] );

  // Wysiwyg
  for ( $i = 1; $i <= 3; $i++ ) {
 	  if ( ! isset( $input['display_index_wysiwyg' . $i] ) ) $input['display_index_wysiwyg' . $i] = null;
    $input['display_index_wysiwyg' . $i] = ( $input['display_index_wysiwyg' . $i] == 1 ? 1 : 0 );
  }

	return $input;
}
