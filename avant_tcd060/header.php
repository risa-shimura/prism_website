<?php
$dp_options = get_design_plus_options();

$header_logo_tag = is_front_page() ? 'h1' : 'div';

if ( is_mobile() ) {
  $header_type = $dp_options['sp_header_fix'];
  $logo_type = $dp_options['sp_header_use_logo_image'];
  $logo_image = $dp_options['sp_header_logo_image'] ? wp_get_attachment_image_src( $dp_options['sp_header_logo_image'], 'full' ) : '';
  $use_retina_logo = $dp_options['sp_header_logo_image_retina'];
} else {
  $header_type = $dp_options['header_fix'];
  $logo_type = $dp_options['header_use_logo_image'];
  $logo_image = $dp_options['header_logo_image'] ? wp_get_attachment_image_src( $dp_options['header_logo_image'], 'full' ) : '';
  $use_retina_logo = $dp_options['header_logo_image_retina'];
}
$logo_width = $logo_image && $use_retina_logo ? ( $logo_image[1] / 2 ) : 'auto';
$logo_height = $logo_image && $use_retina_logo ? ( $logo_image[2] / 2 ) : 'auto';

$args = array(
  'container' => false,
  'items_wrap' => '%3$s',
  'link_after' => '<span class="p-global-nav__toggle"></span>',
  'theme_location' => 'global'
);
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> prefix="og: http://ogp.me/ns#">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width">
<meta name="format-detection" content="telephone=no">
<meta name="description" content="<?php seo_description(); ?>">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php do_action( 'tcd_before_header', $dp_options ); ?>
<header id="js-header" class="l-header<?php if ( 'type2' === $header_type ) { echo ' l-header--fixed'; } ?>">
  <div class="l-header__upper">
    <div class="l-inner">
      <p class="l-header__desc"><?php bloginfo( 'description' ); ?></p>
      <?php if ( 'type3' != $dp_options['header_search_type'] ) : ?>
      <button id="js-header__search" class="l-header__search"></button>
      <?php endif; ?>
      <?php if ( 'type1' === $dp_options['header_search_type'] ) : ?>
			<form role="search" method="get" id="js-header__form" class="l-header__form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		    <input class="l-header__form-input" type="text" value="" name="s">
			</form>
      <?php elseif ( 'type2' === $dp_options['header_search_type'] ) : ?>
			<form method="get" id="js-header__form" class="l-header__form" action="https://cse.google.com/cse">
  	  	<input class="p-widget-search__input" type="text" value="" name="q">
  	  	<input type="hidden" name="cx" value="<?php echo esc_attr( $dp_options['google_search_id'] ); ?>">
  	  	<input type="hidden" name="ie" value="UTF-8">
  	 	</form>
      <?php endif; ?>
    </div>
  </div>
  <div class="l-header__lower l-inner">
    <<?php echo $header_logo_tag; ?> class="l-header__logo c-logo">
			<?php if ( 'type1' === $logo_type ) : // Use text ?>
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
      <?php else : ?>
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
        <img src="<?php echo esc_attr( $logo_image[0] ); ?>" alt="<?php bloginfo( 'name' ); ?>" width="<?php echo esc_attr( $logo_width ); ?>" height="<?php echo esc_attr( $logo_height ); ?>">
      </a>
      <?php endif; ?>
    </<?php echo $header_logo_tag; ?>>
    <a href="#" id="js-menu-btn" class="p-menu-btn c-menu-btn"></a>
    <nav id="js-global-nav" class="p-global-nav">
      <ul>
        <li class="p-global-nav__form-wrapper">
          <?php if ( 'type1' === $dp_options['header_search_type'] ) : ?>
					<form class="p-global-nav__form" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
            <input class="p-global-nav__form-input" type="text" value="" name="s">
            <input type="submit" value="&#xe915;" class="p-global-nav__form-submit">
          </form>
          <?php elseif ( 'type2' === $dp_options['header_search_type'] ) : ?>
					<form class="p-global-nav__form" action="https://cse.google.com/cse" method="get">
            <input class="p-global-nav__form-input" type="text" value="" name="q">
  	  	    <input type="hidden" name="cx" value="<?php echo esc_attr( $dp_options['google_search_id'] ); ?>">
  	  	    <input type="hidden" name="ie" value="UTF-8">
            <input type="submit" value="&#xe915;" class="p-global-nav__form-submit">
          </form>
          <?php endif; ?>
        </li>
        <?php wp_nav_menu( $args ); ?>
      </ul>
    </nav>
  </div>
</header>
