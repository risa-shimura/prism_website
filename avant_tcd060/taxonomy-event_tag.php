<?php
$dp_options = get_design_plus_options();
$event_label = $dp_options['event_slug'] ? $dp_options['event_breadcrumb'] : __( 'Event', 'tcd-w' );
$event_tag = get_queried_object();

$args = array(
  'prev_next' => false,
  'type' => 'array'
);

get_header();
?>
<main class="l-main">
  <?php get_template_part( 'template-parts/page-header' ); ?>
  <div class="l-contents l-inner">
    <div class="l-primary">
      <section class="p-upcoming-event">
        <div class="p-headline02">
          <h2 class="p-headline02__title"><?php echo esc_html( $dp_options['event_archive_title'] ); ?></h2>
          <p class="p-headline02__sub"><?php echo esc_html( $dp_options['event_archive_sub'] ); ?> | <?php echo esc_html( $event_tag->name ); ?></p>
        </div>
        <?php
        if ( $calendar_items = get_event_tag_calendar( date_i18n( 'Y-m-d' ) ) ) :
          $year = date_i18n( 'Y' );
        ?>
        <div id="js-calendar" class="p-calendar" data-term="<?php echo get_queried_object_id(); ?>">
          <?php
          foreach ( $calendar_items as $key => $value ) :
            if ( $year < absint( $value->year ) ) {
              $year = absint( $value->year );
              echo '<div class="p-calendar__item">';
              echo 'type1' === $dp_options['event_calendar_type'] ? "<span>${year}年</span>" : "<span>${year}</span>";
              echo '</div>' . "\n";
            }
          ?>
          <div class="p-calendar__item">
            <button class="js-calendar__item-btn" data-date="<?php echo esc_attr( $value->year ); ?>-<?php echo esc_attr( sprintf( '%02d', $value->month ) ); ?>"><?php echo esc_html( get_month_name( $value->month ) ); ?></button>
          </div>
          <?php endforeach; ?>
        </div>
        <?php endif; ?>
        <div id="js-event-list" class="p-event-list">
          <?php
          if ( have_posts() ) :
            while ( have_posts() ) :
              the_post();
              $timestamp = strtotime( $post->event_date );
          ?>
          <article class="p-event-list__item p-article07 is-active">
            <a class="p-hover-effect--<?php echo esc_attr( $dp_options['hover_type'] ); ?>" href="<?php the_permalink(); ?>">
              <div class="p-article07__img">
                <?php
                if ( has_post_thumbnail() ) {
                  the_post_thumbnail( 'size6' );
                } else {
                  echo '<img src="' . get_template_directory_uri() . '/assets/images/740x500.gif" alt="">' . "\n";
                }
                ?>
              </div>
              <time class="p-article07__date p-date" datetime="<?php echo esc_attr( $post->event_date ); ?>"><?php echo strtoupper( date_i18n( 'M', $timestamp ) ); ?><span class="p-date__day"><?php echo date_i18n( 'd', $timestamp ); ?></span><?php echo date_i18n( 'Y', $timestamp ); ?></time>
            </a>
            <h3 class="p-article07__title">
              <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php echo is_mobile() ? wp_trim_words( get_the_title(), 33, '...' ) : wp_trim_words( get_the_title(), 38, '...' ); ?></a>
            </h3>
          </article>
          <?php
            endwhile;
          endif;
          ?>
        </div>
        <ul id="js-pager" class="p-pager">
          <?php foreach ( (array) paginate_links( $args ) as $link ) : ?>
          <li class="p-pager__item"><?php echo $link; ?></li>
          <?php endforeach; ?>
        </ul>
        <?php if ( $dp_options['past_event_url'] ) : ?>
        <p class="p-upcoming-event__link">
          <a href="<?php echo esc_url( $dp_options['past_event_url'] ); ?>"><?php printf( __( 'Past %s list', 'tcd-w' ), esc_html( $event_label ) ); ?></a>
        </p>
        <?php endif; ?>
      </section>
    </div><!-- /.l-primary -->
  </div><!-- /.l-contents -->
</main>
<?php get_footer(); ?>
