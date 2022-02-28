<?php
global $wp_query;

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
      <div class="p-blog-list">
        <?php
        if ( have_posts() ) :
          while ( have_posts() ) :
            the_post();
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
              <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php echo is_mobile() ? wp_trim_words( get_the_title(), 25, '...' ) : wp_trim_words( get_the_title(), 29, '...' ); ?></a>
            </h3>
            <?php if ( $dp_options['show_date'] || $dp_options['show_category'] ) : ?>
            <p class="p-article01__meta">
              <?php if ( $dp_options['show_date'] ) : ?><time class="p-article01__date" datetime="<?php the_time( 'Y-m-d' ); ?>"><?php the_time( 'Y.m.d' ); ?></time><?php endif; ?><?php if ( $dp_options['show_category'] ) : ?><span class="p-article01__cat"><?php the_category( ', ' ); ?></span><?php endif; ?>
            </p>
            <?php endif; ?>
          </div>
        </article>
        <?php
            if ( $dp_options['display_native_ad'] && 0 === ( $wp_query->current_post + 1 ) % $dp_options['native_ad_position'] ) :
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
              <a href="<?php echo esc_url( $native_ad['url'] ); ?>" title="<?php echo esc_attr( $native_ad['title'] ); ?>"><?php echo wp_trim_words( $native_ad['title'], 29, '...' ); ?></a>
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
        endif;
        ?>
      </div><!-- /.p-blog-list -->
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
