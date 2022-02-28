<?php
$dp_options = get_design_plus_options();

$meta_query = array(
  'relation' => 'AND',
  array(
    'key' => 'header_content',
    'value' => 'on'
  ),
  array(
    'key' => 'event_date',
    'value' => date_i18n( 'Y-m-d' ),
    'type' => 'DATE',
    'compare' => '>='
  )
);

if ( 'type1' === $dp_options['header_content_type'] ) : // Posts slider
?>
<div class="p-hero p-hero--<?php echo esc_attr( $dp_options['header_posts_layout'] ); ?><?php if ( 'type3' === $dp_options['header_posts_layout'] ) { echo ' p-hero--rev'; } ?>">
  <?php
  if ( 'type1' === $dp_options['header_posts_layout'] ) :
    $args = array(
      'post_type' => $dp_options['header_posts_layout1_post_type'],
      'post_status' => 'publish',
      'posts_per_page' => 5
    );

    if ( 'event' === $dp_options['header_posts_layout1_post_type'] ) {
      $args['meta_query'] = $meta_query;
      $args['meta_key'] = 'event_date';
      $args['meta_type'] = 'DATETIME';
      $args['orderby'] = 'event_date';
      $args['order'] = 'ASC';
    } else {
      $args['meta_key'] = 'header_content';
      $args['meta_value'] = 'on';
    }

    $the_query = new WP_Query( $args );
  ?>
  <div class="p-hero__item">
    <?php if ( $the_query->have_posts() ) : ?>
    <div id="js-hero__slider" class="p-hero__slider">
      <?php
      while ( $the_query->have_posts() ) :
        $the_query->the_post();
        if ( ! has_post_thumbnail() ) continue;
      ?>
      <article class="p-hero__slider-item p-article12">
        <a class="p-article12__img" href="<?php the_permalink(); ?>">
          <?php the_post_thumbnail( 'full' ); ?>
        </a>
        <div class="p-article12__content u-clearfix">
          <?php
          if ( 'event' === $dp_options['header_posts_layout1_post_type'] ) :
            $event_tags = get_the_terms( $post->ID, 'event_tag' );
            $timestamp = strtotime( $post->event_date );
          ?>
          <div class="p-article12__meta">
          <time class="p-article12__date p-date" datetime="<?php echo esc_attr( $post->event_date ); ?>"><?php echo strtoupper( date_i18n( 'M', $timestamp ) ); ?><span class="p-date__day"><?php echo date_i18n( 'd', $timestamp ); ?></span><?php echo date_i18n( 'Y', $timestamp ); ?></time>
            <a class="p-article12__cat p-event-cat p-event-cat--<?php echo esc_attr( $event_tags[0]->term_id ); ?>" href="<?php echo get_term_link( $event_tags[0]->term_id, 'event_tag' ); ?>"><?php echo esc_html( $event_tags[0]->name ); ?></a>
          </div>
          <?php endif; ?>
          <div>
            <h2 class="p-article12__title">
              <a href="<?php the_permalink(); ?>"><?php echo wp_trim_words( get_the_title(), 40, '...' ); ?></a>
            </h2>
            <p class="p-article12__excerpt"><?php echo wp_trim_words( get_the_excerpt(), 65, '...' ); ?></p>
          </div>
        </div>
      </article>
      <?php
        if ( $dp_options['header_posts_layout1_display_native_ad'] && 0 === ( $the_query->current_post + 1 ) % $dp_options['header_posts_layout1_native_ad_position'] ) :
          $native_ad = get_native_ad();
      ?>
      <article class="p-hero__slider-item p-article12">
      <a class="p-article12__img" href="<?php echo esc_url( $native_ad['url'] ); ?>"<?php if ( $native_ad['target'] ) { echo ' target="_blank"'; } ?>>
          <?php echo wp_get_attachment_image( $native_ad['image'], 'full' ); ?>
        </a>
        <div class="p-article12__content u-clearfix">
          <div>
            <h2 class="p-article12__title">
              <a href="<?php echo esc_url( $native_ad['url'] ); ?>"<?php if ( $native_ad['target'] ) { echo ' target="_blank"'; } ?> title="<?php echo esc_attr( $native_ad['title'] ); ?>"><?php echo wp_trim_words( $native_ad['title'], 40, '...' ); ?></a>
            </h2>
            <?php if ( $native_ad['desc'] ) : ?>
            <p class="p-article12__excerpt"><?php echo wp_trim_words( $native_ad['desc'], 65, '...' ); ?></p>
            <?php endif; ?>
            <p class="p-ad-info">
              <span class="p-ad-info__sponsor"><?php echo esc_html( $native_ad['sponsor'] ); ?></span>
              <span class="p-ad-info__label"><?php echo esc_html( $native_ad['label'] ); ?></span>
            </p>
          </div>
        </div>
      </article>
      <?php
        endif; // END of displaying a native ad
      endwhile;
      wp_reset_postdata();
    ?>
    </div><!-- /.p-hero__slider -->
    <?php endif; ?>
  </div><!-- /.p-hero__item -->
  <?php
  elseif ( 'type2' === $dp_options['header_posts_layout'] || 'type3' === $dp_options['header_posts_layout'] ) :


    if ( 'type2' === $dp_options['header_posts_layout'] ) {
      $post_type1 = $dp_options['header_posts_layout2_1_post_type'];
      $post_type2 = $dp_options['header_posts_layout2_2_post_type'];
      $display_native_ad1 = $dp_options['header_posts_layout2_1_display_native_ad'];
      $display_native_ad2 = $dp_options['header_posts_layout2_2_display_native_ad'];
      $native_ad_position1 = $dp_options['header_posts_layout2_1_native_ad_position'];
      $native_ad_position2 = $dp_options['header_posts_layout2_2_native_ad_position'];
    } else {
      $post_type1 = $dp_options['header_posts_layout3_1_post_type'];
      $post_type2 = $dp_options['header_posts_layout3_2_post_type'];
      $display_native_ad1 = $dp_options['header_posts_layout3_1_display_native_ad'];
      $display_native_ad2 = $dp_options['header_posts_layout3_2_display_native_ad'];
      $native_ad_position1 = $dp_options['header_posts_layout3_1_native_ad_position'];
      $native_ad_position2 = $dp_options['header_posts_layout3_2_native_ad_position'];
    }

    $args1 = array(
      'post_type' => $post_type1,
      'post_status' => 'publish',
      'posts_per_page' => 5
    );

    if ( 'event' === $post_type1 ) {
      $args1['meta_query'] = $meta_query;
      $args1['meta_key'] = 'event_date';
      $args1['meta_type'] = 'DATETIME';
      $args1['orderby'] = 'event_date';
      $args1['order'] = 'ASC';
    } else {
      $args1['meta_key'] = 'header_content';
      $args1['meta_value'] = 'on';
    }

    $args2 = array(
      'post_type' => $post_type2,
      'post_status' => 'publish',
      'posts_per_page' => 4
    );

    if ( 'event' === $post_type2 ) {
      $args2['meta_query'] = $meta_query;
      $args2['meta_key'] = 'event_date';
      $args2['meta_type'] = 'DATETIME';
      $args2['orderby'] = 'event_date';
      $args2['order'] = 'ASC';
    } else {
      $args2['meta_key'] = 'header_content';
      $args2['meta_value'] = 'on';
    }

    $the_query1 = new WP_Query( $args1 );
    $the_query2 = new WP_Query( $args2 );

  ?>
  <div class="p-hero__item">
    <?php if ( $the_query1->have_posts() ) : ?>
    <div id="js-hero__slider" class="p-hero__slider">
      <?php
      while ( $the_query1->have_posts() ) :
        $the_query1->the_post();
        if ( ! has_post_thumbnail() ) continue;
      ?>
      <article class="p-hero__slider-item p-article12">
        <a class="p-article12__img" href="<?php the_permalink(); ?>">
          <?php the_post_thumbnail( 'full' ); ?>
        </a>
        <div class="p-article12__content u-clearfix">
          <?php
          if ( 'event' === $post_type1 ) :
            $event_tags = get_the_terms( $post->ID, 'event_tag' );
            $timestamp = strtotime( $post->event_date );
          ?>
          <div class="p-article12__meta">
          <time class="p-article12__date p-date" datetime="<?php echo esc_attr( $post->event_date ); ?>"><?php echo strtoupper( date_i18n( 'M', $timestamp ) ); ?><span class="p-date__day"><?php echo date_i18n( 'd', $timestamp ); ?></span><?php echo date_i18n( 'Y', $timestamp ); ?></time>
            <a class="p-article12__cat p-event-cat p-event-cat--<?php echo esc_attr( $event_tags[0]->term_id ); ?>" href="<?php echo get_term_link( $event_tags[0]->term_id, 'event_tag' ); ?>"><?php echo esc_html( $event_tags[0]->name ); ?></a>
          </div>
          <?php endif; ?>
          <div>
            <h2 class="p-article12__title">
              <a href="<?php the_permalink(); ?>"><?php echo is_mobile() ? wp_trim_words( get_the_title(), 33, '...' ) : wp_trim_words( get_the_title(), 40, '...' ); ?></a>
            </h2>
            <p class="p-article12__excerpt"><?php echo is_mobile() ? wp_trim_words( get_the_excerpt(), 54, '...' ) : wp_trim_words( get_the_excerpt(), 65, '...' ); ?></p>
          </div>
        </div>
      </article>
      <?php
        if ( $display_native_ad1 && 0 === ( $the_query1->current_post + 1 ) % $native_ad_position1 ) :
          $native_ad = get_native_ad();
      ?>
      <article class="p-hero__slider-item p-article12">
        <a class="p-article12__img" href="<?php echo esc_url( $native_ad['url'] ); ?>"<?php if ( $native_ad['target'] ) { echo ' target="_blank"'; } ?>>
          <?php echo wp_get_attachment_image( $native_ad['image'], 'full' ); ?>
        </a>
        <div class="p-article12__content u-clearfix">
          <div>
            <h2 class="p-article12__title">
              <a href="<?php echo esc_url( $native_ad['url'] ); ?>"<?php if ( $native_ad['target'] ) { echo ' target="_blank"'; } ?>><?php echo wp_trim_words( $native_ad['title'], 40, '...' ); ?></a>
            </h2>
            <?php if ( $native_ad['desc'] ) : ?>
            <p class="p-article12__excerpt"><?php echo wp_trim_words( $native_ad['desc'], 65, '...' ); ?></p>
            <?php endif; ?>
            <p class="p-ad-info">
              <span class="p-ad-info__sponsor"><?php echo esc_html( $native_ad['sponsor'] ); ?></span>
              <span class="p-ad-info__label"><?php echo esc_html( $native_ad['label'] ); ?></span>
            </p>
          </div>
        </div>
      </article>
      <?php
        endif; // END of displaying a native ad
      endwhile;
      wp_reset_postdata();
    ?>
    </div><!-- /.p-hero__slider -->
    <?php endif; ?>
  </div><!-- /.p-hero__item -->
  <div class="p-hero__item">
    <?php if ( $the_query2->have_posts() ) : ?>
    <div class="p-hero__post-list">
      <?php
      $post_count_with_ad = 0;
      while ( $the_query2->have_posts() ) :
        $the_query2->the_post();
        if ( ++$post_count_with_ad >= 5 ) break;
      ?>
      <article class="p-hero__post-list-item p-article13">
        <div class="p-article13__upper">
          <a class="p-article13__img p-hover-effect--<?php echo esc_attr( $dp_options['hover_type'] ); ?>" href="<?php the_permalink(); ?>">
            <?php
            if ( has_post_thumbnail() ) {
              the_post_thumbnail( 'size8' );
            } else {
              echo '<img src="' . get_template_directory_uri() . '/assets/images/730x500.gif" alt="">' . "\n";
            }
            ?>
          </a>
          <?php
          if ( 'event' === $post_type2 ) :
            $event_tags = get_the_terms( $post->ID, 'event_tag' );
            $timestamp = strtotime( $post->event_date );
          ?>
          <div class="p-article13__meta">
            <time class="p-article13__upper-date p-date" datetime="<?php echo esc_attr( $post->event_date ); ?>"><?php echo strtoupper( date_i18n( 'M', $timestamp ) ); ?><span class="p-date__day"><?php echo date_i18n( 'd', $timestamp ); ?></span><?php echo date_i18n( 'Y', $timestamp ); ?></time>
            <a class="p-article13__cat p-event-cat p-event-cat--<?php echo esc_attr( $event_tags[0]->term_id ); ?>" href="<?php echo get_term_link( $event_tags[0]->term_id, 'event_tag' ); ?>"><?php echo esc_html( $event_tags[0]->name ); ?></a>
          </div>
          <?php endif; ?>
        </div>
        <div class="p-article13__lower">
          <h2 class="p-article13__title">
            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php echo is_mobile() ? wp_trim_words( get_the_title(), 25, '...' ) : wp_trim_words( get_the_title(), 37, '...' ); ?></a>
          </h2>
          <?php if ( ( 'post' === $post_type2 && $dp_options['show_date'] ) || ( 'special' === $post_type2 && $dp_options['special_show_date'] ) ) : ?>
          <time class="p-article13__lower-date" datetime="<?php the_time( 'Y-m-d' ); ?>"><?php the_time( 'Y.m.d' ); ?></time>
          <?php endif; ?>
        </div>
      </article>
      <?php
        if ( $display_native_ad2 && 0 === ( $the_query2->current_post + 1 ) % $native_ad_position2 ) :
          if ( ++$post_count_with_ad >= 5 ) break;
          $native_ad = get_native_ad();
      ?>
      <article class="p-hero__post-list-item p-article13">
        <div class="p-article13__upper">
        <a class="p-article13__img p-hover-effect--<?php echo esc_attr( $dp_options['hover_type'] ); ?>" href="<?php echo esc_url( $native_ad['url'] ); ?>"<?php if ( $native_ad['target'] ) { echo ' target="_blank"'; } ?>>
            <?php
            if ( $native_ad['image'] ) {
              echo wp_get_attachment_image( $native_ad['image'], 'size8' );
            } else {
              echo '<img src="' . get_template_directory_uri() . '/assets/images/730x500.gif" alt="">' . "\n";
            }
            ?>
          </a>
        </div>
        <div class="p-article13__lower">
          <h2 class="p-article13__title">
            <a href="<?php echo esc_url( $native_ad['url'] ); ?>" title="<?php echo esc_attr( $native_ad['title'] ); ?>"<?php if ( $native_ad['target'] ) { echo ' target="_blank"'; } ?>><?php echo is_mobile() ? wp_trim_words( $native_ad['title'], 25, '...' ) : wp_trim_words( $native_ad['title'], 37, '...' ); ?></a>
          </h2>
          <p class="p-ad-info">
            <span class="p-ad-info__sponsor"><?php echo esc_html( $native_ad['sponsor'] ); ?></span>
            <span class="p-ad-info__label"><?php echo esc_html( $native_ad['label'] ); ?></span>
          </p>
        </div>
      </article>
      <?php
        endif; // END of displaying a native ad
      endwhile;
      wp_reset_postdata();
      ?>
    </div>
    <?php endif; ?>
  </div><!-- /.p-hero__item -->
  <?php
  else : // type4

    $post_type = $dp_options['header_posts_layout4_post_type'];

    $args = array(
      'post_type' => $post_type,
      'post_status' => 'publish',
      'posts_per_page' => 8
    );

    if ( 'event' === $post_type ) {
      $args['meta_query'] = $meta_query;
      $args['meta_key'] = 'event_date';
      $args['meta_type'] = 'DATETIME';
      $args['orderby'] = 'event_date';
      $args['order'] = 'ASC';
    } else {
      $args['meta_key'] = 'header_content';
      $args['meta_value'] = 'on';
    }

    $the_query = new WP_Query( $args );
  ?>
  <div class="p-hero__item">
    <?php if ( $the_query->have_posts() ) : ?>
    <div class="p-hero__post-list">
      <?php
      $post_count_with_ad = 0;
      while ( $the_query->have_posts() ) :
        $the_query->the_post();
        if ( ++$post_count_with_ad >= 9 ) break;
      ?>
      <article class="p-hero__post-list-item p-article13">
        <div class="p-article13__upper">
          <a class="p-article13__img p-hover-effect--<?php echo esc_attr( $dp_options['hover_type'] ); ?>" href="<?php the_permalink(); ?>">
            <?php
            if ( has_post_thumbnail() ) {
              the_post_thumbnail( 'size8' );
            } else {
              echo '<img src="' . get_template_directory_uri() . '/assets/images/730x500.gif" alt="">' . "\n";
            }
            ?>
          </a>
          <?php
          if ( 'event' === $post_type ) :
            $event_tags = get_the_terms( $post->ID, 'event_tag' );
            $timestamp = strtotime( $post->event_date );
          ?>
          <div class="p-article13__meta">
            <time class="p-article13__upper-date p-date" datetime="<?php echo esc_attr( $post->event_date ); ?>"><?php echo strtoupper( date_i18n( 'M', $timestamp ) ); ?><span class="p-date__day"><?php echo date_i18n( 'd', $timestamp ); ?></span><?php echo date_i18n( 'Y', $timestamp ); ?></time>
            <a class="p-article13__cat p-event-cat p-event-cat--<?php echo esc_attr( $event_tags[0]->term_id ); ?>" href="<?php echo get_term_link( $event_tags[0]->term_id, 'event_tag' ); ?>"><?php echo esc_html( $event_tags[0]->name ); ?></a>
          </div>
          <?php endif; ?>
        </div>
        <div class="p-article13__lower">
          <h2 class="p-article13__title">
            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php echo is_mobile() ? wp_trim_words( get_the_title(), 25, '...' ) : wp_trim_words( get_the_title(), 37, '...' ); ?></a>
          </h2>
          <?php if ( ( 'post' === $post_type && $dp_options['show_date'] ) || ( 'special' === $post_type && $dp_options['special_show_date'] ) ) : ?>
          <time class="p-article13__lower-date" datetime="<?php the_time( 'Y-m-d' ); ?>"><?php the_time( 'Y.m.d' ); ?></time>
          <?php endif; ?>
        </div>
      </article>
      <?php
        if ( $dp_options['header_posts_layout4_display_native_ad'] && 0 === ( $the_query->current_post + 1 ) % $dp_options['header_posts_layout4_native_ad_position'] ) :
          if ( ++$post_count_with_ad >= 9 ) break;
            $native_ad = get_native_ad();
        ?>
        <article class="p-hero__post-list-item p-article13">
          <div class="p-article13__upper">
          <a class="p-article13__img p-hover-effect--<?php echo esc_attr( $dp_options['hover_type'] ); ?>" href="<?php echo esc_url( $native_ad['url'] ); ?>"<?php if ( $native_ad['target'] ) { echo ' target="_blank"'; } ?>>
              <?php
              if ( false&& $native_ad['image'] ) {
                echo wp_get_attachment_image( $native_ad['image'], 'size8' );
              } else {
                echo '<img src="' . get_template_directory_uri() . '/assets/images/730x500.gif" alt="">' . "\n";
              }
              ?>
            </a>
          </div>
          <div class="p-article13__lower">
            <h2 class="p-article13__title">
              <a href="<?php echo esc_url( $native_ad['url'] ); ?>" title="<?php echo esc_attr( $native_ad['title'] ); ?>"><?php echo is_mobile() ? wp_trim_words( $native_ad['title'], 25, '...' ) : wp_trim_words( $native_ad['title'], 37, '...' ); ?></a>
            </h2>
            <p class="p-ad-info">
              <span class="p-ad-info__sponsor"><?php echo esc_html( $native_ad['sponsor'] ); ?></span>
              <span class="p-ad-info__label"><?php echo esc_html( $native_ad['label'] ); ?></span>
            </p>
          </div>
        </article>
        <?php
        endif;
      endwhile;
      wp_reset_postdata();
      ?>
    </div>
    <?php endif; ?>
  </div><!-- /.p-hero__item -->
  <?php endif; ?>
</div>
<?php elseif ( 'type2' === $dp_options['header_content_type'] ) : // Image slider ?>
<div id="js-header-slider" class="p-header-slider p-header-content">
  <?php
  for ( $i = 1; $i <= 5; $i++ ) :
    if ( ! $image = $dp_options['header_slider_img' . $i] ) continue;

    $catch = $dp_options['header_slider_catch' . $i];
    $label = $dp_options['header_slider_btn_label' . $i];
    $url = $dp_options['header_slider_btn_url' . $i];
    $target = $dp_options['header_slider_btn_target' . $i];
  ?>
  <div class="p-header-slider__item p-header-slider__item--<?php echo $i; ?>">
    <div class="p-header-content__inner">
      <?php if ( $catch ) : ?>
      <h2 class="p-header-content__title"><?php echo esc_html( $catch ); ?></h2>
      <?php endif; ?>
      <?php if ( $label ) : ?>
      <a class="p-header-content__btn p-btn" href="<?php echo esc_url( $url ); ?>"<?php if ( $target ) { echo ' target="_blank"'; } ?>><?php echo esc_html( $label ); ?></a>
      <?php endif; ?>
    </div>
  </div>
  <?php endfor; ?>
</div>
<?php elseif ( 'type3' === $dp_options['header_content_type'] ) : // Video ?>
<div id="js-header-video" class="p-header-video p-header-content">
  <?php if ( ! wp_is_mobile() ) : ?>
  <video autoplay loop>
    <source src="<?php echo esc_attr( wp_get_attachment_url( $dp_options['header_video'] ) ); ?>">
  </video>
  <?php endif; ?>
  <div class="p-header-content__inner">
    <?php if ( $dp_options['header_video_catch'] ) : ?>
    <h2 class="p-header-content__title"><?php echo esc_html( $dp_options['header_video_catch'] ); ?></h2>
    <?php endif; ?>
    <?php if ( $dp_options['header_video_btn_label'] ) : ?>
    <a class="p-header-content__btn p-btn" href="<?php echo esc_url( $dp_options['header_video_btn_url'] ); ?>"<?php if ( $dp_options['header_video_btn_target'] ) { echo ' target="_blank"'; } ?>><?php echo esc_html( $dp_options['header_video_btn_label'] ); ?></a>
    <?php endif; ?>
  </div>
</div>
<?php else : // YouTube ?>
<div id="js-header-youtube" class="p-header-youtube p-header-content">
  <?php if ( ! wp_is_mobile() ) : ?>
  <div id="js-header-youtube__player" class="p-header-youtube__player" data-property="{videoURL:'<?php echo esc_attr( $dp_options['header_youtube_url'] ); ?>',containment:'#js-header-youtube',startAt:0,mute:true,autoPlay:true,loop:false,opacity:1,showControls:false}"></div>
  <?php endif; ?>
  <div class="p-header-content__inner">
    <?php if ( $dp_options['header_youtube_catch'] ) : ?>
    <h2 class="p-header-content__title"><?php echo esc_html( $dp_options['header_youtube_catch'] ); ?></h2>
    <?php endif; ?>
    <?php if ( $dp_options['header_youtube_btn_label'] ) : ?>
    <a class="p-header-content__btn p-btn" href="<?php echo esc_url( $dp_options['header_youtube_btn_url'] ); ?>"<?php if ( $dp_options['header_youtube_btn_target'] ) { echo ' target="_blank"'; } ?>><?php echo esc_html( $dp_options['header_youtube_btn_label'] ); ?></a>
    <?php endif; ?>
  </div>
</div>
<?php endif; ?>
