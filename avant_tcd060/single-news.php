<?php
$dp_options = get_design_plus_options();
$news_label = $dp_options['news_breadcrumb'] ? $dp_options['news_breadcrumb'] : __( 'News', 'tcd-w' );
get_header();
?>
<main class="l-main">
  <?php get_template_part( 'template-parts/breadcrumb' ); ?>
  <div class="l-contents l-inner<?php if ( $dp_options['left_sidebar'] ) { echo ' l-contents--rev'; } ?>">
    <div class="l-primary">
      <?php
      if ( have_posts() ) :
        while ( have_posts() ) :
          the_post();
					$previous_post = get_previous_post();
					$next_post = get_next_post();
					$args = array(
            'post_type' => 'news',
            'post_status' => 'publish',
            'posts_per_page' => 10,
            'orderby' => 'date',
            'order' => 'DESC'
          );
          $the_query = new WP_Query( $args );
      ?>
			<article class="p-entry">
			  <header class="p-entry__header">
					<h1 class="p-entry__title"><?php the_title(); ?></h1>
					<?php if ( $dp_options['news_show_date'] ) : ?>
					<div class="p-entry__meta">
						<?php if ( $dp_options['news_show_date'] ) : ?><time class="p-entry__date" datetime="<?php the_time( 'Y-m-d' ); ?>"><?php the_time( 'Y.m.d' ); ?></time><?php endif; ?>
					</div>
					<?php endif; ?>
				</header>
        <?php if ( $dp_options['news_show_sns_top'] ) { get_template_part( 'template-parts/sns-btn-top' ); } ?>
				<?php if ( $dp_options['news_show_thumbnail'] ) : ?>
				<div class="p-entry__img"><?php the_post_thumbnail( 'full' ); ?></div>
				<?php endif; ?>
				<?php if ( ! is_mobile() ) { get_template_part( 'template-parts/ad-top' ); } ?>
				<div class="p-entry__body">
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
        <?php if ( $dp_options['news_show_sns_btm'] ) { get_template_part( 'template-parts/sns-btn-btm' ); } ?>
      </article>
      <?php
        endwhile;
      endif;
      ?>
			<?php if ( $options['news_show_next_post'] && ( $previous_post || $next_post ) ) : ?>
			<ul class="p-nav01 c-nav01 u-clearfix">
				<li class="p-nav01__item--prev p-nav01__item c-nav01__item c-nav01__item--prev"><?php if ( $previous_post ) : ?><a href="<?php echo esc_url( get_permalink( $previous_post->ID ) ); ?>" data-prev="<?php _e( 'Previous post', 'tcd-w' ); ?>"><span><?php echo esc_html( wp_trim_words( $previous_post->post_title, 30, '...' ) ); ?></span></a><?php endif; ?></li>
				<li class="p-nav01__item--next p-nav01__item c-nav01__item c-nav01__item--next"><?php if ( $next_post ) : ?><a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>" data-next="<?php _e( 'Next post', 'tcd-w' ); ?>"><span><?php echo esc_html( wp_trim_words( $next_post->post_title, 30, '...' ) ); ?></span></a><?php endif; ?></li>
			</ul>
      <?php endif; ?>
			<?php get_template_part( 'template-parts/ad-btm' ); ?>
			<?php if ( $options['news_show_latest_post'] ) : ?>
			<section class="p-latest-news">
			 	<div class="p-headline">
          <h2><?php echo esc_html( $news_label ); ?></h2>
          <a class="p-headline__link" href="<?php echo get_post_type_archive_link( 'news' ); ?>"><?php printf( __( 'Archive %s', 'tcd-w' ), esc_html( $news_label ) ); ?></a>
        </div>
        <ul class="p-latest-news__list">
				<?php
          if ( $the_query->have_posts() ) :
            while ( $the_query->have_posts() ) :
              $the_query->the_post();
          ?>
          <li class="p-latest-news__list-item p-article11">
            <a href="<?php the_permalink(); ?>">
              <?php if ( $dp_options['news_show_date'] ) : ?>
              <time datetime="<?php the_time( 'Y-m-d' ); ?>" class="p-article11__date"><?php the_time( 'Y.m.d' ); ?></time>
              <?php endif; ?>
              <h3 class="p-article11__title"><?php echo wp_trim_words( get_the_title(), 45, '...' ); ?></h3>
            </a>
          </li>
          <?php
            endwhile;
            wp_reset_postdata();
          else :
            echo '<li class="p-latest-news__item--no-post">' . __( 'There is no registered post.', 'tcd-w' ) . '</li>' . "\n";
          endif;
          ?>
        </ul>
			 </section>
			<?php endif; ?>
    </div><!-- /.l-primary -->
    <?php get_sidebar(); ?>
  </div><!-- /.l-contents -->
</main>
<?php get_footer(); ?>
