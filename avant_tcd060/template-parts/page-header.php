<?php
$dp_options = get_design_plus_options();
$tag = 'h1';


if ( is_404() ) {
  $ph_1_title = $dp_options['404_ph_1_title'];
  $ph_1_sub = $dp_options['404_ph_1_sub'];
  $ph_2_title = $dp_options['404_ph_2_title'];
  $ph_2_desc = $dp_options['404_ph_2_desc'];
} elseif ( is_page() ) {
  $ph_1_title = $post->ph_1_title;
  $ph_1_sub = $post->ph_1_sub;
  $ph_2_title = $post->ph_2_title;
  $ph_2_desc = $post->ph_2_desc;
} elseif ( is_post_type_archive( 'news' ) ) {
  $ph_1_title = $dp_options['news_ph_1_title'];
  $ph_1_sub = $dp_options['news_ph_1_sub'];
  $ph_2_title = $dp_options['news_ph_2_title'];
  $ph_2_desc = $dp_options['news_ph_2_desc'];
} elseif ( is_post_type_archive( 'event' ) ) {
  $ph_1_title = $dp_options['event_ph_1_title'];
  $ph_1_sub = $dp_options['event_ph_1_sub'];
  $ph_2_title = $dp_options['event_ph_2_title'];
  $ph_2_desc = $dp_options['event_ph_2_desc'];
} elseif ( is_tax( 'event_tag' ) ) {
  $term_id = get_queried_object_id();
  $ph_1_title = get_term_meta( $term_id, 'ph_1_title', true );
  $ph_1_sub = get_term_meta( $term_id, 'ph_1_sub', true );
  $ph_2_title = get_term_meta( $term_id, 'ph_2_title', true );
  $ph_2_desc = get_term_meta( $term_id, 'ph_2_desc', true );
} elseif ( is_post_type_archive( 'special' ) ) {
  $ph_1_title = $dp_options['special_ph_1_title'];
  $ph_1_sub = $dp_options['special_ph_1_sub'];
  $ph_2_title = $dp_options['special_ph_2_title'];
  $ph_2_desc = $dp_options['special_ph_2_desc'];
} elseif ( is_search() ) {
  $ph_1_title = __('Search result', 'tcd-w');
  $ph_1_sub = '';
  $ph_2_title = sprintf(__('Search results for - %s', 'tcd-w'), get_search_query());
  $ph_2_desc = '';
} elseif ( is_category() ) {
  $ph_1_title = $dp_options['ph_1_title'];
  $ph_1_sub = $dp_options['ph_1_sub'];
  $ph_2_title = sprintf(__('Archive for - %s', 'tcd-w'), single_cat_title('', false));
  $ph_2_desc = '';
} else {
  $ph_1_title = $dp_options['ph_1_title'];
  $ph_1_sub = $dp_options['ph_1_sub'];
  $ph_2_title = $dp_options['ph_2_title'];
  $ph_2_desc = $dp_options['ph_2_desc'];

  //if ( ! is_home() ) {
  //  $tag = 'div';
  //}
}
?>
  <header class="p-page-header">
    <div class="p-page-header__inner">
      <div class="p-page-header__upper">
        <h1 class="p-page-header__upper-title"><?php echo esc_html( $ph_1_title ); ?></h1>
        <p class="p-page-header__upper-sub"><?php echo esc_html( $ph_1_sub ); ?></p>
      </div>
      <div class="p-page-header__lower">
        <h2 class="p-page-header__lower-title"><?php echo esc_html( $ph_2_title ); ?></h2>
        <p class="p-page-header__lower-desc"><?php echo nl2br( esc_html( $ph_2_desc ) ); ?></p>
      </div>
    </div>
  </header>
