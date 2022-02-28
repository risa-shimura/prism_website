<?php
$dp_options = get_design_plus_options();

if ( is_mobile() ) {
  $sidebar = 'footer_widget_sp';
} else {
  $sidebar = 'footer_widget';
}
?>
<footer class="l-footer">
  <?php if ( $dp_options['display_footer_links'] ) : ?>
  <div class="p-footer-links">
    <div class="l-inner">
      <div class="p-footer-links__header p-headline02">
        <h2 class="p-headline02__title"><?php echo esc_html( $dp_options['footer_links_title'] ); ?></h2>
        <p class="p-headline02__sub"><?php echo esc_html( $dp_options['footer_links_sub'] ); ?></p>
      </div>
      <ul class="p-footer-links__list">
        <?php
        for ( $i = 1; $i <= 6; $i++ ) :
          if ( ! $dp_options['footer_links_banner_img' . $i] ) continue;
        ?>
        <li class="p-footer-links__list-item p-article02">
          <a class="p-hover-effect--<?php echo esc_attr( $dp_options['hover_type'] ); ?>" href="<?php echo esc_url( $dp_options['footer_links_banner_url' . $i] ); ?>"<?php if ( $dp_options['footer_links_banner_target' . $i] ) { echo ' target="_blank"'; } ?>>
            <div class="p-article02__img">
              <img src="<?php echo esc_attr( wp_get_attachment_url( $dp_options['footer_links_banner_img' . $i] ) ); ?>" alt="">
            </div>
            <h3 class="p-article02__title"><?php echo nl2br( esc_html( $dp_options['footer_links_banner_title' . $i] ) ); ?></h3>
          </a>
        </li>
        <?php endfor; ?>
      </ul>
    </div>
  </div><!-- / .p-footer-links -->
  <?php endif; ?>
  <?php if ( is_active_sidebar( $sidebar ) ) : ?>
  <div class="p-footer-widgets">
    <div class="p-footer-widgets__inner l-inner">
      <?php dynamic_sidebar( $sidebar ); ?>
    </div><!-- /.p-footer-widgets__inner -->
  </div><!-- /.p-footer-widgets -->
  <?php endif; ?>
	<ul class="p-social-nav l-inner">
    <?php if ( $dp_options['facebook_url'] ) : ?>
	  <li class="p-social-nav__item p-social-nav__item--facebook"><a href="<?php echo esc_attr( $dp_options['facebook_url'] ); ?>" target="_blank"></a></li>
    <?php endif; ?>
    <?php if ( $dp_options['twitter_url'] ) : ?>
	  <li class="p-social-nav__item p-social-nav__item--twitter"><a href="<?php echo esc_attr( $dp_options['twitter_url'] ); ?>" target="_blank"></a></li>
    <?php endif; ?>
    <?php if ( $dp_options['insta_url'] ) : ?>
    <li class="p-social-nav__item p-social-nav__item--instagram"><a href="<?php echo esc_attr( $dp_options['insta_url'] ); ?>" target="_blank"></a></li>
    <?php endif; ?>
    <?php if ( $dp_options['pinterest_url'] ) : ?>
    <li class="p-social-nav__item p-social-nav__item--pinterest"><a href="#" target="_blank"></a></li>
    <?php endif; ?>
    <?php if ( $dp_options['mail_url'] ) : ?>
	  <li class="p-social-nav__item p-social-nav__item--mail"><a href="mailto:<?php echo sanitize_email( $dp_options['mail_url'] ); ?>" target="_blank"></a></li>
    <?php endif; ?>
    <?php if ( $dp_options['show_rss'] ) : ?>
	  <li class="p-social-nav__item p-social-nav__item--rss"><a href="<?php bloginfo( 'rss2_url' ); ?>" target="_blank"></a></li>
    <?php endif; ?>
	</ul>
  <p class="p-copyright">
    <small>Copyright &copy; <?php bloginfo( 'name' ); ?> All Rights Reserved.</small>
  </p>
  <div id="js-pagetop" class="p-pagetop"><a href="#"></a></div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
