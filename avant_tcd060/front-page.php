<?php
$dp_options = get_design_plus_options();

get_header();
?>
<main class="l-main">
  <?php get_template_part( 'template-parts/hero' ); ?>
  <div class="l-contents l-inner">
    <div class="l-primary">
      <div class="p-cb">
        <?php foreach ( $dp_options['index_contents_order'] as $order ) :

          if ( 'special' === $order ) :

            if ( ! $dp_options['display_index_special'] ) continue;

            $special_args = array(
              'post_type' => 'special',
              'post_status' => 'publish',
              'posts_per_page' => 8
            );

            $recommended_special_args = array(
              'post_type' => 'special',
              'post_status' => 'publish',
              'posts_per_page' => 1,
              'meta_key' => 'recommended_special',
              'meta_value' => 'on'
            );

            if ( 'type1' !== $dp_options['index_special_layout'] ) {

              $recommended_special_query = new WP_Query( $recommended_special_args );


              if ( $recommended_special_query->post_count ) {
                $special_args['posts_per_page'] = 4;
                $special_args['post__not_in'] = array( $recommended_special_query->post->ID );
              }
            }

            $special_query = new WP_Query( $special_args );

        ?>
        <section class="p-cb__item">
          <div class="p-headline02">
            <h2 class="p-headline02__title"><?php echo esc_html( $dp_options['index_special_title'] ); ?></h2>
            <p class="p-headline02__sub"><?php echo esc_html( $dp_options['index_special_sub'] ); ?></p>
          </div>
          <div class="p-index-special p-index-special--<?php echo esc_attr( $dp_options['index_special_layout'] ); ?>">
            <div class="p-index-special__col">
              <?php
              $post_count_with_ad = 0;
              if ( $special_query->have_posts() ) :
                while ( $special_query->have_posts() ) :
                  $special_query->the_post();
                  if ( $special_query->query['posts_per_page'] < ++$post_count_with_ad ) break;
              ?>
              <article class="p-index-special__item p-article06">
                <a class="p-hover-effect--<?php echo esc_attr( $dp_options['hover_type'] ); ?>" href="<?php the_permalink(); ?>">
                  <div class="p-article06__img">
                    <?php
                    if ( has_post_thumbnail() ) {
                      the_post_thumbnail( 'size1' );
                    } else {
                      echo '<img src="' . get_template_directory_uri() . '/assets/images/600x600.gif" alt="">' . "\n";
                    }
                    ?>
                  </div>
                  <h3 class="p-article06__title"><?php echo is_mobile() ? wp_trim_words( get_the_title(), 23, '...' ) : wp_trim_words( get_the_title(), 43, '...' ); ?></h3>
                </a>
              </article>
              <?php

                  if ( $dp_options['index_special_display_native_ad'] && 0 === ( $special_query->current_post + 1 ) % $dp_options['index_special_native_ad_position'] ) :

                    if ( $special_query->query['posts_per_page'] < ++$post_count_with_ad ) break;

                    $native_ad = get_native_ad();
              ?>
              <article class="p-index-special__item p-article06">
              <a class="p-hover-effect--<?php echo esc_attr( $dp_options['hover_type'] ); ?>" href="<?php echo esc_url( $native_ad['url'] ); ?>"<?php if ( $native_ad['target'] ) { echo ' target="_blank"'; } ?>>
                  <div class="p-article06__img">
                    <?php
                    if ( $native_ad['image'] ) {
                      echo wp_get_attachment_image( $native_ad['image'], 'size1' );
                    } else {
                      echo '<img src="' . get_template_directory_uri() . '/assets/images/600x600.gif" alt="">' . "\n";
                    }
                    ?>
                  </div>
                  <div class="p-article06__content">
                    <h3 class="p-article06__title"><?php echo is_mobile() ? wp_trim_words( $native_ad['title'], 28, '...' ) : wp_trim_words( $native_ad['title'], 38, '...' ); ?></h3>
                    <p class="p-article06__meta p-ad-info">
                      <span class="p-ad-info__sponsor"><?php echo esc_html( $native_ad['sponsor'] ); ?></span>
                      <span class="p-ad-info__label"><?php echo esc_html( $native_ad['label'] ); ?></span>
                    </p>
                  </div>
                </a>
              </article>
              <?php
                    //endif;
                  endif; // END of displaying a native ad
                endwhile;
                wp_reset_postdata();
              endif;
              ?>
            </div>
            <?php
            if ( 'type1' !== $dp_options['index_special_layout'] && $recommended_special_query->have_posts() ) :
              while ( $recommended_special_query->have_posts() ) :
                $recommended_special_query->the_post();
            ?>
						<article class="p-index-special__col p-article09">
            	<a class="p-hover-effect--<?php echo esc_attr( $dp_options['hover_type'] ); ?>" href="<?php the_permalink(); ?>">
              	<div class="p-article09__img">
                  <?php
                  if ( has_post_thumbnail() ) {
                    the_post_thumbnail( 'size5' );
                  } else {
              	    echo '<img src="' . get_template_directory_uri() . '/assets/images/900x615.gif" alt="">' . "\n";
                  }
                  ?>
              	</div>
              	<div class="p-article09__content">
              	  <h3 class="p-article09__title"><?php echo is_mobile() ? wp_trim_words( get_the_title(), 40, '...' ) : wp_trim_words( get_the_title(), 44, '...' ); ?></h3>
              	  <p class="p-article09__excerpt"><?php echo is_mobile() ? wp_trim_words( get_the_excerpt(), 34, '...' ) : wp_trim_words( get_the_excerpt(), 75, '...' ); ?></p>
              	</div>
            	</a>
            </article>
            <?php
              endwhile;
              wp_reset_postdata();
            endif;
            ?>
          </div>
          <p class="p-cb__item-btn">
            <a class="p-btn" href="<?php echo get_post_type_archive_link( 'special' ); ?>"><?php echo esc_html( $dp_options['index_special_link_text'] ); ?></a>
          </p>
        </section>
        <?php
          elseif ( 'news' === $order ) :
            if ( ! $dp_options['display_index_news'] ) continue;
            $news_args = array(
              'post_type' => 'news',
              'post_status' => 'publish',
              'posts_per_page' => $dp_options['index_news_num']
            );
            $news_query = new WP_Query( $news_args );
        ?>
        <section class="p-latest-news p-cb__item">
          <div class="p-headline02">
            <h2 class="p-headline02__title"><?php echo esc_html( $dp_options['index_news_title'] ); ?></h2>
            <p class="p-headline02__sub"><?php echo esc_html( $dp_options['index_news_sub'] ); ?></p>
          </div>
          <ul class="p-latest-news">
            <?php
            if ( $news_query->have_posts() ) :
              while ( $news_query->have_posts() ) :
                $news_query->the_post();
            ?>
            <li class="p-latest-news__list-item p-article11">
              <a href="<?php the_permalink(); ?>">
                <?php if ( $dp_options['news_show_date'] ) : ?>
                <time class="p-article11__date" datetime="<?php the_time( 'Y-m-d' ); ?>"><?php the_time( 'Y.m.d' ); ?></time>
                <?php endif; ?>
                <h3 class="p-article11__title"><?php echo is_mobile() ? wp_trim_words( get_the_title(), 55, '...' ) : wp_trim_words( get_the_title(), 70, '...' ); ?></h3>
              </a>
            </li>
            <?php
              endwhile;
              wp_reset_postdata();
            endif;
            ?>
          </ul>
          <p class="p-cb__item-btn">
            <a class="p-btn" href="<?php echo get_post_type_archive_link( 'news' ); ?>"><?php echo esc_html( $dp_options['index_news_link_text'] ); ?></a>
          </p>
        </section>
        <?php
          elseif ( 'event' === $order ) :

            if ( ! $dp_options['display_index_event'] ) continue;

            $event_args = array(
              'post_type' => 'event',
              'post_status' => 'publish',
              'posts_per_page' => $dp_options['index_event_num'],
              'orderby' => 'meta_value',
              'order' => 'ASC',
              'meta_query' => array(
                array(
                  'key' => 'event_date',
                  'value' => date_i18n( 'Y-m-d' ),
                  'type' => 'DATE',
                  'compare' => '>='
                )
              )
            );
            $event_query = new WP_Query( $event_args );
        ?>
        <section class="p-index-event p-cb__item">
          <div class="p-headline02">
            <h2 class="p-headline02__title"><?php echo esc_html( $dp_options['index_event_title'] ); ?></h2>
            <p class="p-headline02__sub"><?php echo esc_html( $dp_options['index_event_sub'] ); ?></p>
          </div>
          <?php if ( $calendar_items = get_event_calendar( date_i18n( 'Y-m-d' ) ) ) :
            $year = date_i18n( 'Y' );
          ?>
          <div id="js-calendar" class="p-calendar">
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
            if ( $event_query->have_posts() ) :
              while ( $event_query->have_posts() ) :
                $event_query->the_post();
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
          <?php if ( $dp_options['index_event_read_more'] ) : ?>
          <p id="js-index-event__btn" class="p-index-event__btn is-active">
            <a class="p-btn" href="<?php echo get_post_type_archive_link( 'event' ); ?>"><?php echo esc_html( $dp_options['index_event_read_more'] ); ?></a>
          </p>
          <?php endif; ?>
          <?php if ( ! is_mobile() ) : ?>
          <p class="p-cb__item-btn">
            <a class="p-btn" href="<?php echo get_post_type_archive_link( 'event' ); ?>"><?php echo esc_html( $dp_options['index_event_link_text'] ); ?></a>
          </p>
          <?php endif; ?>
        </section>
        <?php
          elseif ( 'blog' === $order ) :

            if ( ! $dp_options['display_index_blog'] ) continue;

            $blog_args = array(
              'post_type' => 'post',
              'post_status' => 'publish',
              'posts_per_page' => $dp_options['index_blog_num']
            );

            if ( 'recent' !== $dp_options['index_blog_type'] ) {
              $blog_args['meta_key'] = $dp_options['index_blog_type'];
              $blog_args['meta_value'] = 'on';
            }

            if ( 'random' === $dp_options['index_blog_order'] ) {
              $blog_args['orderby'] = 'rand';
            } else {
              $blog_args['orderby'] = 'date';
              $blog_args['order'] = $dp_options['index_blog_order'];
            }

            $blog_query = new WP_Query( $blog_args );
        ?>
        <section class="p-cb__item">
          <div class="p-headline02">
            <h2 class="p-headline02__title"><?php echo esc_html( $dp_options['index_blog_title'] ); ?></h2>
            <p class="p-headline02__sub"><?php echo esc_html( $dp_options['index_blog_sub'] ); ?></p>
          </div>
          <div class="p-blog-list">
            <?php
            $post_count_with_ad = 0;
            if ( $blog_query->have_posts() ) :
              while( $blog_query->have_posts() ) :
                $blog_query->the_post();
                if ( $dp_options['index_blog_num']+1 <= ++$post_count_with_ad ) break;
            ?>
            <article class="p-blog-list__item p-article01">
              <a class="p-article01__img p-hover-effect--<?php echo esc_attr( $dp_options['hover_type'] ); ?>" href="<?php the_permalink(); ?>">
                <?php
                if ( has_post_thumbnail() ) {
                  the_post_thumbnail( 'size1' );
                } else {
                  echo '<img src="' . get_template_directory_uri() . '/assets/images/600x600.gif" alt="">' . "\n";
                }
                ?>
              </a>
              <div class="p-article01__content">
                <h3 class="p-article01__title">
                  <a href="<?php the_permalink(); ?>"><?php echo is_mobile() ? wp_trim_words( get_the_title(), 25, '...' ) : wp_trim_words( get_the_title(), 28, '...' ); ?></a>
                </h3>
                <?php if ( $dp_options['show_date'] || $dp_options['show_category'] ) : ?>
                <p class="p-article01__meta">
                  <?php if ( $dp_options['show_date'] ) : ?><time class="p-article01__date" datetime="<?php the_time( 'Y-m-d' ); ?>"><?php the_time( 'Y.m.d' ); ?></time><?php endif; ?><?php if ( $dp_options['show_category'] ) : ?><span class="p-article01__cat"><?php the_category( ', ' ); ?></span><?php endif; ?>
                </p>
                <?php endif; ?>
              </div>
            </article>
            <?php
              if ( $dp_options['index_blog_display_native_ad'] && 0 === ( $blog_query->current_post + 1 ) % $dp_options['index_blog_native_ad_position'] ) :
                $native_ad = get_native_ad();
            ?>
            <article class="p-blog-list__item p-article01">
              <a class="p-article01__img p-hover-effect--<?php echo esc_attr( $dp_options['hover_type'] ); ?>" href="<?php echo esc_url( $native_ad['url'] ); ?>"<?php if ( $native_ad['target'] ) { echo ' target="_blank"'; } ?>>
                <?php
                if ( $native_ad['image'] ) {
                  echo wp_get_attachment_image( $native_ad['image'], 'size1' );
                } else {
                  echo '<img src="' . get_template_directory_uri() . '/assets/images/600x600.gif" alt="">' . "\n";
                }
                ?>
              </a>
              <div class="p-article01__content">
                <h3 class="p-article01__title">
                  <a href="<?php echo esc_url( $native_ad['url'] ); ?>"<?php if ( $native_ad['target'] ) { echo ' target="_blank"'; } ?>><?php echo wp_trim_words( $native_ad['title'], 28, '...' ); ?></a>
                </h3>
                <p class="p-article01__meta p-ad-info">
                <span class="p-ad-info__sponsor"><?php echo esc_html( $native_ad['sponsor'] ); ?></span>
                <span class="p-ad-info__label"><?php echo esc_html( $native_ad['label'] ); ?></span>
                </p>
              </div>
            </article>
              <?php
              endif; // END of displaying a native ad
              endwhile;
              wp_reset_postdata();
            endif;
            ?>
          </div><!-- /.p-blog-list -->
          <p class="p-cb__item-btn">
            <a class="p-btn" href="<?php echo get_post_type_archive_link( 'post' ); ?>"><?php echo esc_html( $dp_options['index_blog_link_text'] ); ?></a>
          </p>
        </section>
        <?php
          elseif ( 'wysiwyg1' === $order || 'wysiwyg2' === $order || 'wysiwyg3' === $order ) :
            $key = mb_substr( $order, -1 );
            if ( ! $dp_options['display_index_wysiwyg' . $key] ) continue;
        ?>
        <section class="p-cb__item">
          <?php echo apply_filters( 'the_content', $dp_options['index_wysiwyg_editor' . $key] ); ?>
        </section>
        <?php
          endif;
        endforeach;
        ?>
      </div><!-- /.p-cb -->
    </div><!-- /.l-primary -->
  </div><!-- /.l-contents -->
</main>
<?php get_footer(); ?>
