<?php
$dp_options = get_design_plus_options();
get_header();
?>
<main class="l-main">
  <?php get_template_part( 'template-parts/page-header' ); ?>
  <div class="l-contents l-inner<?php if ( $dp_options['left_sidebar'] ) { echo ' l-contents--rev'; } ?>">
    <div class="l-primary">
      <?php
      if ( have_posts() ) :
        while ( have_posts() ) :
          the_post();
      ?>
			<article class="p-entry">
				<?php if ( $dp_options['show_thumbnail'] ) : ?>
				<div class="p-entry__img"><?php the_post_thumbnail( 'full' ); ?></div>
				<?php endif; ?>
				<div class="p-entry__body">
					<?php
          the_content();
          wp_link_pages( array(
            'before' => '<div class="p-page-links">',
            'after' => '</div>',
            'link_before' => '<span>',
            'link_after' => '</span>'
          ) );
          ?>
        </div>
      </article>
      <?php
        endwhile;
      endif;
      ?>
    </div><!-- /.l-primary -->
    <?php get_sidebar(); ?>
  </div><!-- /.l-contents -->
</main>
<?php get_footer(); ?>
