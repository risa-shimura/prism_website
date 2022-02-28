<?php
/**
 * Manage the custom post type "Event"
 */

/**
 * Make the event category required
 */

add_action( 'admin_footer-post-new.php', 'post_edit_required' );
add_action( 'admin_footer-post.php', 'post_edit_required' );

function post_edit_required() {
?>
<script type="text/javascript">
(function() {
if ( 'event' === document.getElementById('post_type').value ) {

  document.getElementById('post').addEventListener('submit', function(e) {

    var alertMessages = [];

    if (!document.querySelector('#tagsdiv-event_tag .tagchecklist span')) {
      alertMessages.push('<?php _e( 'An event tag is required.', 'tcd-w' ); ?>');
    }

    if (!document.querySelector('#event_date_meta_box [name="event_date"]').value) {
      alertMessages.push('<?php _e( 'An event date is required.', 'tcd-w' ); ?>');
    }

    if (alertMessages.length) {
      e.preventDefault();
      alert(alertMessages.join('\n'));
      document.querySelector('.spinner').style.visibility = 'hidden';
      document.getElementById('publish').classList.remove('button-primary-disabled');
      document.getElementById('new-tag-event_tag').focus();
    }

  });

}
})();
</script>
<?php
}

/**
 * Modify the post order of events in admin panel
 */
function event_admin_pre_get_posts( $query ) {

  global $pagenow;

  if ( ! is_admin() ) return;

	if ( 'edit.php' !== $pagenow ) return;

  if ( ! isset( $_GET['post_type'] ) || 'event' !== $_GET['post_type'] ) return;

  if ( ! isset( $_GET['orderby'] ) ) {
    $query->set( 'meta_key', 'event_date' );
    $query->set( 'orderby', 'meta_value' );
    $query->set( 'order', 'ASC' );
  }

}
add_action( 'pre_get_posts', 'event_admin_pre_get_posts' );

/**
 * Modify the main query of archive-event.php and taxonomy-event_tag.php
 */
function event_pre_get_posts( $query ) {

  if ( is_admin() || ! $query->is_main_query() || ! ( $query->is_post_type_archive( 'event' ) || $query->is_tax( 'event_tag' ) ) ) {
    return;
  }

  if ( isset( $_GET['event_date'] ) && preg_match( '/\d{4}-\d{2}/', $_GET['event_date'], $matches ) ) {
    $event_date = $_GET['event_date'];
  } else {
    $event_date = '';
  }

  if ( $event_date ) {

    $start_date = date_i18n( 'Y-m' ) === $event_date ? date_i18n( 'Y-m-d' ) : $event_date . '-01';
    $first_day_of_next_month = date_i18n( 'Y-m-d', strtotime( 'first day of next month', strtotime( $start_date ) ) );

    $meta_query = array(
      'relation' => 'AND',
      array(
        'key' => 'event_date',
        'value' => $start_date,
        'type' => 'DATE',
        'compare' => '>='
      ),
      array(
        'key' => 'event_date',
        'value' => $first_day_of_next_month,
        'type' => 'DATE',
        'compare' => '<'
      )
    );

  } else {

    $meta_query = array(
      array(
        'key' => 'event_date',
        'value' => date_i18n( 'Y-m-d' ),
        'type' => 'DATE',
        'compare' => '>='
      )
    );
  }

  // Add tax query in taxonomy-event_tag.php
  if ( $query->is_tax( 'event_tag' ) ) {

    // Get the term id of this event category
    $term_id = get_queried_object_id();

		$tax_query = array(
		  array(
        'taxonomy' => 'event_tag',
        'field' => 'term_id',
        'terms' => $term_id,
      )
		);
    $query->set( 'tax_query', $tax_query );
  }

  // Display only upcoming events
  $query->set( 'posts_per_page', 9 );
  $query->set( 'meta_query', $meta_query );
  $query->set( 'orderby', 'meta_value' );
  $query->set( 'order', 'ASC' );

}

add_action( 'pre_get_posts', 'event_pre_get_posts' );

/**
 * Get data needed for rendering a calendar carousel
 *
 * @param  String $today The current date in format 'Y-m-d'.
 * @return array|false Database query results
 */
function get_event_calendar( $today ) {

  global $wpdb;

  $key = 'get_event_calendar';

  $query = "
    SELECT YEAR(meta_value) AS `year`, MONTH(meta_value) AS `month`, count(ID) as posts
    FROM $wpdb->posts AS p
    INNER JOIN $wpdb->postmeta AS pm
    ON p.ID = pm.post_id
    WHERE p.post_type = 'event'
    AND p.post_status = 'publish'
    AND pm.meta_key = 'event_date'
    AND pm.meta_value >= %s
    GROUP BY YEAR(meta_value), MONTH(meta_value)
    ORDER BY meta_value ASC
  ";

  if ( ! $results = wp_cache_get( $key, 'event' ) ) {
    $results = $wpdb->get_results( $wpdb->prepare( $query, $today ) );
    wp_cache_set( $key, $results, 'event' );
  }

  if ( $results ) {
    return $results;
  } else {
    return false;
  }

}

/**
 * Get data needed for rendering an event tag calendar carousel
 *
 * @param  String $today The current date in format 'Y-m-d'.
 * @return array|false Database query results
 */
function get_event_tag_calendar( $today ) {

  global $wpdb;

  $key = 'get_event_tag_calendar';

  $term_id = get_queried_object_id();

  $query = "
    SELECT YEAR(meta_value) AS `year`, MONTH(meta_value) AS `month`, count(ID) as posts
    FROM $wpdb->posts as p
    INNER JOIN $wpdb->term_relationships as tr
    ON p.ID = tr.object_id
    INNER JOIN $wpdb->postmeta AS pm
    ON p.ID = pm.post_id
    WHERE p.post_type = 'event'
    AND p.post_status = 'publish'
    AND tr.term_taxonomy_id = %d
    AND pm.meta_key = 'event_date'
    AND pm.meta_value >= %s
    GROUP BY YEAR(meta_value), MONTH(meta_value)
    ORDER BY meta_value ASC
  ";

  if ( ! $results = wp_cache_get( $key, 'event' ) ) {
    $results = $wpdb->get_results( $wpdb->prepare( $query, $term_id, $today ) );
    wp_cache_set( $key, $results, 'event' );
  }

  if ( $results ) {
    return $results;
  } else {
    return false;
  }

}

/**
 * Switch events to display by Ajax
 */
function switch_event_list() {

  global $post;

  $dp_options = get_design_plus_options();

  // Check nonce
  check_ajax_referer( 'event-list-nonce', 'security' );

  $date = $_POST['date'];
  $term_id = intval( $_POST['term_id'] );
  $is_tax = $term_id ? true : false;
  $is_front_page = $_POST['is_front_page'];

  // Get the first day of the selected month
  // If the selected month is this month, change $start_date to today
  $start_date = date_i18n( 'Y-m' ) === $date ? date_i18n( 'Y-m-d' ) : $date . '-01';

  // Get the first day of next month of the selected month
  $end_date = date_i18n( 'Y-m-d', strtotime( 'first day of next month', strtotime( $start_date ) ) );

  $args = array(
    'post_type' => 'event',
    'post_status' => 'publish',
    'posts_per_page' => $is_front_page ? $dp_options['index_event_num'] : -1,
    'orderby' => 'meta_value',
    'order' => 'ASC',
    //'nopaging' => true,
    'meta_query' => array(
      'relation' => 'AND',
      array(
        'key' => 'event_date',
        'value' => $start_date,
        'type' => 'DATE',
        'compare' => '>='
      ),
      array(
        'key' => 'event_date',
        'value' => $end_date,
        'type' => 'DATE',
        'compare' => '<'
      )
    )
  );

  // Add tax_query in taxonomy-event_tag.php
  if ( $is_tax ) {
    $args['tax_query'] = array(
      array(
        'taxonomy' => 'event_tag',
        'field' => 'term_id',
        'terms' => $term_id
      )
    );
  }

  $the_query = new WP_Query( $args );

  $output = '';

  if ( $the_query->have_posts() ) {
    while ( $the_query->have_posts() ) {
      $the_query->the_post();

      $timestamp = strtotime( $post->event_date );
      $event_tags = get_the_terms( $post->ID, 'event_tag' );

      $output .= '<article class="p-event-list__item p-article07">';

      $output .= '<a class="p-hover-effect--' . esc_attr( $dp_options['hover_type'] ) . '" href="' . get_the_permalink() . '">';

      $output .= '<div class="p-article07__img">';

      if ( has_post_thumbnail() ) {
        $output .= get_the_post_thumbnail( $post->ID, 'size6' );
      } else {
        $output .= '<img src="' . get_template_directory_uri() . '/assets/images/740x500.gif" alt="">';
      }

      $output .= '</div>';

      $output .= '<time class="p-article07__date p-date" datetime="' . esc_attr( $post->event_date ) . '">' . strtoupper( date_i18n( 'M', $timestamp ) ) . '<span class="p-date__day">' . date_i18n( 'd', $timestamp ) . '</span>' . date_i18n( 'Y', $timestamp ) . '</time>';

      $output .= '</a>';

      if ( ! $is_tax ) {
        $output .= sprintf(
          '<a class="p-article07__cat p-event-cat p-event-cat--%d" href="%s">%s</a>',
          esc_attr( $event_tags[0]->term_id ),
          get_term_link( $event_tags[0] ),
          esc_html( $event_tags[0]->name )
        );
      }

      $output .= '<h3 class="p-article07__title">';

      $output .= '<a href="' . get_the_permalink() . '" title="' . get_the_title() . '">';

      if ( is_mobile() ) {
        $output .= wp_trim_words( get_the_title(), 35, '...' );
      } else {
        $output .= wp_trim_words( get_the_title(), 38, '...' );
      }

      $output .= '</a>';

      $output .= '</h3>';

      $output .= '</article>';

    }
    wp_reset_postdata();

  } else {

    $output .= '<p>' . __( 'No events found.', 'tcd-w' ) . '</p>' . "\n";

  }

  // Pass moreURL only when the number of found posts are greater than posts_per_page
  if ( intval( $the_query->found_posts ) > $the_query->query['posts_per_page'] ) {
    $more_url = add_query_arg( array( 'event_date' => $date ), get_post_type_archive_link( 'event' ) );
  } else {
    $more_url = null;
  }

  $json_data = array(
    'html' => $output,
    'moreURL' => $more_url
  );

  $json_data = json_encode( $json_data );

  header('Content-type:application/json;charset=utf-8');
  echo $json_data;

  die();

}

add_action( 'wp_ajax_switch_event_list', 'switch_event_list' );
add_action( 'wp_ajax_nopriv_switch_event_list', 'switch_event_list' );

/**
 * Get a month name from a month number
 *
 * @param Number $num Month number
 * @return String Month name
 */
function get_month_name( $num ) {

  $dp_options = get_design_plus_options();

  $months = array(
    1 => 'JAN',
    2 => 'FEB',
    3 => 'MAR',
    4 => 'APR',
    5 => 'MAY',
    6 => 'JUN',
    7 => 'JUL',
    8 => 'AUG',
    9 => 'SEP',
    10 => 'OCT',
    11 => 'NOV',
    12 => 'DEC'
  );

  if ( 'type1' === $dp_options['event_calendar_type'] ) {
    return $num . '月';
  } else {
    return $months[$num];
  }

}
