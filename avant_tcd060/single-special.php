<?php
$dp_options = get_design_plus_options();

get_header();
?>
<main class="l-main">
  <?php get_template_part( 'template-parts/breadcrumb' ); ?>
  <?php
  if ( have_posts() ) :
    while ( have_posts() ) :
      the_post();
			$previous_post = get_previous_post();
			$next_post = get_next_post();
			$args = array(
        'post_type' => 'special',
        'post_status' => 'publish',
        'posts_per_page' => 8,
        'orderby' => 'date',
        'order' => 'DESC'
      );
      $the_query = new WP_Query( $args );
  ?>
  <article class="p-entry">
    <header class="p-entry__header02">
      <div class="p-entry__header02-inner l-inner">
        <div class="p-entry__header02-upper">
          <p class="p-entry__header02-upper-title"><?php echo esc_html( $dp_options['special_ph_1_title'] ); ?></p>
          <p class="p-entry__header02-upper-sub"><?php echo esc_html( $dp_options['special_ph_1_sub'] ); ?></p>
        </div>
        <div class="p-entry__header02-lower">
          <h1 class="p-entry__header02-title"><?php the_title(); ?></h1>
          <?php if ( $dp_options['special_show_date'] ) : ?>
          <time class="p-entry__header02-date" datetime="<?php the_time( 'Y-m-d' ); ?>"><?php the_time( 'Y.m.d' ); ?></time>
          <?php endif; ?>
        </div>
      </div>
    </header>
    <div class="p-entry__body p-entry__body--sm l-inner">
      <?php if ( $post->slider_img1 ) : ?>
      <div class="js-slider p-slider">
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
    <?php if ( $dp_options['special_show_sns'] ) { get_template_part( 'template-parts/sns-btn-btm' ); } ?>
  </div>
  <div class="l-inner">
	  <?php if ( $options['special_show_next_post'] && ( $previous_post || $next_post ) ) : ?>
    <ul class="p-nav02">
      <?php if ( $previous_post ) : ?>
      <li class="p-nav02__item">
        <a href="<?php echo esc_url( get_permalink( $previous_post->ID ) ); ?>"><?php _e( 'Previous post', 'tcd-w' ); ?></a>
      </li>
      <?php endif; ?>
      <?php if ( $next_post ) : ?>
      <li class="p-nav02__item">
        <a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>"><?php _e( 'Next post', 'tcd-w' ); ?></a>
      </li>
      <?php endif; ?>
    </ul>
    <?php endif; ?>
    <?php if ( $dp_options['display_latest_special'] ) : ?>
    <section class="p-latest-special-list">
      <div class="p-headline02">
        <h2 class="p-headline02__title"><?php echo esc_html( $dp_options['latest_special_title'] ); ?></h2>
        <p class="p-headline02__sub"><?php echo esc_html( $dp_options['latest_special_sub'] ); ?></p>
      </div>
      <div class="p-special-list">
        <?php
        if ( $the_query->have_posts() ) :
          while ( $the_query->have_posts() ) :
            $the_query->the_post();
        ?>
        <article class="p-special-list__item p-article06">
          <a class="p-hover-effect--<?php echo esc_attr( $dp_options['hover_type'] ); ?>" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
            <div class="p-article06__img">
              <?php
              if ( has_post_thumbnail() ) {
                the_post_thumbnail( 'size1' );
              } else {
                echo '<img src="' . get_template_directory_uri() . '/assets/images/600x600.gif" alt="">' . "\n";
              }
              ?>
            </div>
            <h3 class="p-article06__title"><?php echo is_mobile() ? wp_trim_words( get_the_title(), 23, '...' ) : wp_trim_words( get_the_title(), 38, '...' ); ?></h3>
          </a>
        </article>
        <?php
          endwhile;
          wp_reset_postdata();
        endif;
        ?>
      </div>
    </section>
    <?php endif; ?>
  </div>
</main>
<?php get_footer(); ?>
