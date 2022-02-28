<?php
/*
Template Name: Past event list
*/
__( 'Past event list', 'tcd-w' );

$paged = max( 1, get_query_var( 'paged' ) );

$dp_options = get_design_plus_options();

$args = array(
  'post_type' => 'event',
  'post_status' => 'publish',
  'posts_per_page' => 9,
  'orderby' => 'meta_value',
  'meta_type' => 'DATE',
  'order' => 'ASC',
  'meta_key' => 'event_date',
  'meta_value' => date_i18n( 'Y-m-d' ),
  'meta_compare' =>'<',
  'paged' => $paged
);
$the_query = new WP_Query( $args );

$pager_args = array(
  'prev_next' => false,
  'type' => 'array',
  'current' => $paged,
  'total' => $the_query->max_num_pages
);

get_header();
?>
<main class="l-main">
  <?php get_template_part( 'template-parts/breadcrumb' ); ?>
  <div class="l-contents l-inner">
    <div class="l-primary">
      <section class="p-past-event">
        <div class="p-headline02">
          <h1 class="p-headline02__title"><?php echo esc_html( $dp_options['past_event_title'] ); ?></h1>
          <p class="p-headline02__sub"><?php echo esc_html( $dp_options['past_event_sub'] ); ?></p>
        </div>
        <div id="js-event-list" class="p-event-list">
          <?php
          if ( $the_query->have_posts() ) :
            while ( $the_query->have_posts() ) :
              $the_query->the_post();
              $event_tags = get_the_terms( $post->ID, 'event_tag' );
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
            <a class="p-article07__cat p-event-cat p-event-cat--<?php echo esc_attr( $event_tags[0]->term_id ); ?>" href="<?php echo get_term_link( $event_tags[0] ); ?>"><?php echo esc_html( $event_tags[0]->name ); ?></a>
            <h3 class="p-article07__title">
              <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php echo is_mobile() ? wp_trim_words( get_the_title(), 33, '...' ) : wp_trim_words( get_the_title(), 38, '...' ); ?></a>
            </h3>
          </article>
          <?php
            endwhile;
            wp_reset_postdata();
          endif;
          ?>
        </div>
        <ul id="js-pager" class="p-pager">
          <?php foreach ( (array) paginate_links( $pager_args ) as $link ) : ?>
          <li class="p-pager__item"><?php echo $link; ?></li>
          <?php endforeach; ?>
        </ul>
      </section>
    </div><!-- /.l-primary -->
  </div><!-- /.l-contents -->
</main>
<?php get_footer(); ?>
