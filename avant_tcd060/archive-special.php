<?php
get_header();

$recommended_special_args = array(
  'post_type' => 'special',
  'post_status' => 'publish',
  'posts_per_page' => -1,
  'meta_key' => 'recommended_special',
  'meta_value' => 'on'
);
$recommended_special = new WP_Query( $recommended_special_args );

$pager_args = array(
  'prev_next' => false,
  'type' => 'array'
);
?>
<main class="l-main">
  <?php get_template_part( 'template-parts/page-header' ); ?>
  <div class="l-contents l-inner">
    <div class="l-primary">
      <?php if ( $recommended_special->have_posts() ) : ?>
      <div class="p-recommended-special-list">
        <?php
        while ( $recommended_special->have_posts() ) :
          $recommended_special->the_post();
        ?>
        <article class="p-recommended-special-list__item p-article05">
          <a class="" href="<?php the_permalink(); ?>">
            <div class="p-article05__img p-hover-effect--<?php echo esc_attr( $dp_options['hover_type'] ); ?>">
              <?php
              if ( has_post_thumbnail() ) {
                the_post_thumbnail( 'size5' );
              } else {
                echo '<img src="' . get_template_directory_uri() . '/assets/images/900x615.gif" alt="">' . "\n";
              }
              ?>
            </div>
            <div class="p-article05__content">
              <h3 class="p-article05__title"><?php echo wp_trim_words( get_the_title(), 45, '...' ); ?></h3>
              <p class="p-article05__excerpt"><?php echo is_mobile() ? wp_trim_words( get_the_excerpt(), 54, '...' ) : wp_trim_words( get_the_excerpt(), 75, '...' ); ?></p>
            </div>
          </a>
        </article>
        <?php
        endwhile;
        wp_reset_postdata();
        ?>
      </div>
      <?php endif; ?>
      <div class="p-special-list">
        <?php
        if ( have_posts() ) :
          while ( have_posts() ) :
            the_post();
        ?>
        <article class="p-special-list__item p-article06">
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
            <h3 class="p-article06__title"><?php echo is_mobile() ? wp_trim_words( get_the_title(), 23, '...' ) : wp_trim_words( get_the_title(), 38, '...' ); ?></h3>
          </a>
        </article>
        <?php
          endwhile;
        endif;
        ?>
      </div>
      <?php if ( paginate_links( $pager_args ) ) : ?>
      <ul class="p-pager">
        <?php foreach ( paginate_links( $pager_args ) as $link ) : ?>
        <li class="p-pager__item"><?php echo $link; ?></li>
        <?php endforeach; ?>
      </ul>
      <?php endif; ?>
    </div><!-- /.l-primary -->
  </div><!-- /.l-contents -->
</main>
<?php get_footer(); ?>
