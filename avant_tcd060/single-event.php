<?php
$dp_options = get_design_plus_options();

$event_label = $dp_options['event_slug'] ? $dp_options['event_breadcrumb'] : __( 'Event', 'tcd-w' );

get_header();
?>
<main class="l-main">
  <?php get_template_part( 'template-parts/breadcrumb' ); ?>
  <?php
  if ( have_posts() ) :
    while ( have_posts() ) :
      the_post();
      $timestamp = strtotime( $post->event_date );
      $event_tags = get_the_terms( $post->ID, 'event_tag' );
			$previous_post = get_previous_post( true, '', 'event_tag' );
			$next_post = get_next_post( true, '', 'event_tag' );
			$args = array(
        'post_type' => 'event',
        'post_status' => 'publish',
        'posts_per_page' => 9,
        'orderby' => 'meta_value',
        'meta_type' => 'DATE',
        'order' => 'ASC',
        'meta_key' => 'event_date',
        'meta_value' => date_i18n( 'Y-m-d' ),
        'meta_compare' =>'>=',
				'tax_query' => array(
			    array(
            'taxonomy' => 'event_tag',
            'field' => 'term_id',
            'terms' => $event_tags[0]->term_id,
          )
				)
      );
      $the_query = new WP_Query( $args );
  ?>
  <article class="p-entry">
    <header class="p-entry__header02">
      <div class="p-entry__header02-inner l-inner">
        <div class="p-entry__header02-upper p-entry__header02-upper--square">
          <time class="p-date" datetime="<?php echo esc_attr( $post->event_date ); ?>"><?php echo strtoupper( date_i18n( 'M', $timestamp ) ); ?><span class="p-date__day"><?php echo date_i18n( 'd', $timestamp ); ?></span><?php echo date_i18n( 'Y', $timestamp ); ?></time>
        </div>
        <div class="p-entry__header02-lower">
          <h1 class="p-entry__header02-title"><?php the_title(); ?></h1>
        </div>
      </div>
    </header>
    <div class="p-entry__body p-entry__body--sm l-inner">
      <?php if ( $post->slider_img1 ) : ?>
      <div class="js-slider p-slider">
        <a class="p-slider__cat p-event-cat p-event-cat--<?php echo esc_attr( $event_tags[0]->term_id ); ?>" href="<?php echo get_term_link( $event_tags[0] ); ?>"><?php echo esc_html( $event_tags[0]->name ); ?></a>
        <?php
        for ( $i = 1; $i <= 3; $i++ ) :
          if ( ! get_post_meta( $post->ID, 'slider_img' . $i, true ) ) break;
        ?>
        <div class="p-slider__item">
          <?php echo wp_get_attachment_image( get_post_meta( $post->ID, 'slider_img' . $i, true ), 'full' ); ?>
        </div>
        <?php endfor; ?>
      </div>
      <?php endif; ?>
			<?php
      the_content();
			if ( ! post_password_required() ) {
        wp_link_pages( array(
          'before' => '<div class="p-page-links">',
          'after' => '</div>',
          'link_before' => '<span>',
          'link_after' => '</span>'
        ) );
      }
      ?>
    </div>
  </article>
  <?php
    endwhile;
  endif;
  ?>
  <div class="l-inner u-center">
    <?php if ( $dp_options['event_show_sns'] ) { get_template_part( 'template-parts/sns-btn-btm' ); } ?>
  </div>
  <div class="l-inner">
	  <?php if ( $options['event_show_next_post'] && ( $previous_post || $next_post ) ) : ?>
    <ul class="p-nav02">
      <?php if ( $previous_post ) : ?>
      <li class="p-nav02__item">
        <a href="<?php echo esc_url( get_permalink( $previous_post->ID ) ); ?>"><?php _e( 'Previous event', 'tcd-w' ); ?></a>
      </li>
      <?php endif; ?>
      <?php if ( $next_post ) : ?>
      <li class="p-nav02__item">
        <a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>"><?php _e( 'Next event', 'tcd-w' ); ?></a>
      </li>
      <?php endif; ?>
    </ul>
    <?php endif; ?>
    <?php if ( $dp_options['display_upcoming_event'] ) : ?>
    <section class="p-upcoming-event">
      <div class="p-headline02">
        <h2 class="p-headline02__title"><?php echo esc_html( $dp_options['upcoming_event_title'] ); ?></h2>
        <p class="p-headline02__sub"><?php echo esc_html( $dp_options['upcoming_event_sub'] ); ?><?php if ( $event_tags[0] ) { echo ' | ' . esc_html( $event_tags[0]->name ); } ?></p>
      </div>
      <div class="p-event-list">
        <?php
        if ( $the_query->have_posts() ) :
          while ( $the_query->have_posts() ) :
            $the_query->the_post();
            $timestamp = strtotime( $post->event_date );
        ?>
        <article class="p-event-list__item p-article07 is-active">
          <a class="p-hover-effect--<?php echo esc_attr( $dp_options['hover_type'] ); ?> p-article07__round" href="<?php the_permalink(); ?>">
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
            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php echo is_mobile() ? wp_trim_words( get_the_title(), 35, '...' ) : wp_trim_words( get_the_title(), 38, '...' ); ?></a>
          </h3>
        </article>
        <?php
          endwhile;
          wp_reset_postdata();
        else :
          echo '<p>' . sprintf( __( 'There is no upcoming %s.', 'tcd-w' ), esc_html( $event_label ) ) . '</p>' . "\n";
        endif;
        ?>
      </div>
    </section>
    <?php endif; ?>
  </div>
</main>
<?php get_footer(); ?>
