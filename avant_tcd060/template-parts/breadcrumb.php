<?php
$dp_options = get_design_plus_options();

$news_label = $dp_options['news_breadcrumb'] ? $dp_options['news_breadcrumb'] : __( 'News', 'tcd-w' );
$event_label = $dp_options['event_breadcrumb'] ? $dp_options['event_breadcrumb'] : __( 'Event', 'tcd-w' );
$special_label = $dp_options['special_breadcrumb'] ? $dp_options['special_breadcrumb'] : __( 'Special', 'tcd-w' );

$breadcrumb_items = array(
  array(
    'name' => 'HOME',
    'url' => get_home_url( null, '/' )
  )
);

if ( is_singular( 'post' ) ) {

  $breadcrumb_items[] = array(
    'name' => __( 'Blog', 'tcd-w' ),
    'url' => get_post_type_archive_link( 'post' )
  );

} elseif ( is_singular( 'news' ) ) {

  $breadcrumb_items[] = array(
    'name' => $news_label,
    'url' => get_post_type_archive_link( 'news' )
  );

} elseif ( is_singular( 'event' ) ) {

  $breadcrumb_items[] = array(
    'name' => $event_label,
    'url' => get_post_type_archive_link( 'event' )
  );

  if ( have_posts() ) {
    while ( have_posts() ) {
      the_post();

      $event_tags = get_the_terms( $post->ID, 'event_tag' );

      $breadcrumb_items[] = array(
        'name' => $event_tags[0]->name,
        'url' => get_term_link( $event_tags[0]->term_id )
      );

    }
  }
  rewind_posts();

} elseif ( is_singular( 'special' ) ) {

  $breadcrumb_items[] = array(
    'name' => $special_label,
    'url' => get_post_type_archive_link( 'special' )
  );

}

$breadcrumb_items[] = array( 'name' => strip_tags( get_the_title() ) );

// Render
echo '<div class="p-breadcrumb c-breadcrumb">' . "\n";
echo '<ol class="p-breadcrumb__inner l-inner" itemscope itemtype="http://schema.org/BreadcrumbList">' . "\n";
for ( $i = 0, $len = count( $breadcrumb_items ); $i < $len; $i++ ) {

  // Add tags
  if ( $len - 1 !== $i ) {

    if ( 0 === $i ) {
      echo '<li class="p-breadcrumb__item c-breadcrumb__item c-breadcrumb__item--home" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">' . "\n";
    } else {
      echo '<li class="p-breadcrumb__item c-breadcrumb__item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">' . "\n";
    }
    echo '<a href="' . esc_url( $breadcrumb_items[$i]['url'] ) . '" itemprop="item">' . "\n";
    echo '<span itemprop="name">' . esc_html( $breadcrumb_items[$i]['name'] ) . '</span>' . "\n";
    echo '</a>' . "\n";
    echo '<meta itemprop="position" content="' . ( $i + 1 ) .  '">' . "\n";
    echo '</li>' . "\n";

  } else {
    echo '<li class="p-breadcrumb__item c-breadcrumb__item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="name">' . esc_html( $breadcrumb_items[$i]['name'] ) . '</span><meta itemprop="position" content="' . ( $i + 1 ) .  '"></li>' . "\n";
  }
}
echo '</ol>' . "\n";
echo '</div>' . "\n";
