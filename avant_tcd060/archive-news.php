<?php
$dp_options = get_design_plus_options();

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
      <div class="p-news-list">
        <?php
        if ( have_posts() ) :
          while ( have_posts() ) :
            the_post();
        ?>
        <article class="p-news-list__item p-article04">
          <a href="<?php the_permalink(); ?>">
            <div class="p-article04__img p-hover-effect--<?php echo esc_attr( $dp_options['hover_type'] ); ?>">
              <?php
              if ( has_post_thumbnail() ) {
                the_post_thumbnail( 'size3' );
              } else {
                echo '<img src="' . get_template_directory_uri() . '/assets/images/440x440.gif" alt="">';
              }
              ?>
            </div>
            <div class="p-article04__content">
              <?php if ( $dp_options['news_show_date'] ) : ?>
              <time class="p-article04__date" datetime="<?php the_time( 'Y-m-d' ); ?>"><?php the_time( 'Y.m.d' ); ?></time>
              <?php endif; ?>
              <h3 class="p-article04__title"><?php echo is_mobile() ? wp_trim_words( get_the_title(), 22, '...' ) : wp_trim_words( get_the_title(), 46, '...' ); ?></h3>
            </div>
          </a>
        </article>
        <?php
          endwhile;
        endif;
        ?>
      </div><!-- /.p-news-list -->
      <?php if ( paginate_links( $args ) ) : ?>
      <ul class="p-pager">
        <?php foreach ( paginate_links( $args ) as $link ) : ?>
        <li class="p-pager__item"><?php echo $link; ?></li>
        <?php endforeach; ?>
      </ul>
      <?php endif; ?>
    </div><!-- /.l-primary -->
  </div><!-- /.l-contents -->
</main>
<?php get_footer(); ?>
