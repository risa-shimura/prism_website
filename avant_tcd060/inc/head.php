<?php
function avant_inline_styles() {

	global $post;
	$dp_options = get_design_plus_options();

	$primary_color = $dp_options['primary_color'];
	$secondary_color = $dp_options['secondary_color'];

  $meiryo = 'Verdana, "Hiragino Kaku Gothic ProN", "ヒラギノ角ゴ ProN W3", "メイリオ", Meiryo, sans-serif';
  $yu_gothic = '"Segoe UI", Verdana, "游ゴシック", YuGothic, "Hiragino Kaku Gothic ProN", Meiryo, sans-serif';
  $yu_mincho = '"Times New Roman", "游明朝", "Yu Mincho", "游明朝体", "YuMincho", "ヒラギノ明朝 Pro W3", "Hiragino Mincho Pro", "HiraMinProN-W3", "HGS明朝E", "ＭＳ Ｐ明朝", "MS PMincho", serif; font-weight: 500';

  $font_families = array(
    'type1' => $meiryo,
    'type2' => $yu_gothic,
    'type3' => $yu_mincho
  );

  if ( is_mobile() ) {
    $header_logo_type = $dp_options['sp_header_use_logo_image'];
    $header_logo_color = $dp_options['sp_header_logo_color'];
    $header_logo_font_size = $dp_options['sp_header_logo_font_size'];
  } else {
    $header_logo_type = $dp_options['header_use_logo_image'];
    $header_logo_color = $dp_options['header_logo_color'];
    $header_logo_font_size = $dp_options['header_logo_font_size'];
  }

  $inline_styles = array();
  $responsive_styles = array();

  // Primary color
  $inline_styles[] = array(
    'selectors' => array(
      '.c-comment__form-submit:hover',
      '.c-pw__btn:hover',
      '.p-cb__item-btn a',
      '.p-headline',
      '.p-index-event__btn a',
      '.p-nav02__item a',
      '.p-readmore__btn',
      '.p-pager__item span',
      '.p-page-links a'
    ),
    'properties' => sprintf( 'background: %s', esc_html( $primary_color ) )
  );

  // Secondary color
  $inline_styles[] = array(
    'selectors' => array(
      '.c-pw__btn',
      '.p-cb__item-btn a:hover',
      '.p-index-event__btn a:hover',
      '.p-pagetop a:hover',
      '.p-nav02__item a:hover',
      '.p-readmore__btn:hover',
      '.p-page-links > span',
      '.p-page-links a:hover'
    ),
    'properties' => sprintf( 'background: %s', esc_html( $secondary_color ) )
  );

  // Content link color
  $inline_styles[] = array(
    'selectors' => '.p-entry__body a',
    'properties' => sprintf( 'color: %s', esc_html( $dp_options['content_link_color'] ) )
  );

  // Font type
  $inline_styles[] = array(
    'selectors' => array( 'body' ),
    'properties' => sprintf( 'font-family: %s', $font_families[$dp_options['font_type']] )
  );

  // Headline font type
  $inline_styles[] = array(
    'selectors' => array(
      '.c-logo',
      '.p-entry__header02-title',
      '.p-entry__header02-upper-title',
      '.p-entry__title',
      '.p-footer-widgets__item-title',
      '.p-headline h2',
      '.p-headline02__title',
      '.p-page-header__lower-title',
      '.p-page-header__upper-title',
      '.p-widget__title'
    ),
    'properties' => sprintf( 'font-family: %s', $font_families[$dp_options['headline_font_type']] )
  );

  // Load icon
  if ( $dp_options['use_load_icon'] ) {

    $inline_styles[] = array(
      'selectors' => '.p-page-header__title',
      'properties' => sprintf( 'transition-delay: %ds', intval( $dp_options['load_time'] ) )
    );

  }

  // Hover effect
  if ( 'type1' === $dp_options['hover_type'] ) {

    $inline_styles[] = array(
      'selectors' => '.p-hover-effect--type1:hover img',
      'properties' => array(
        sprintf( '-webkit-transform: scale(%s)', esc_html( $dp_options['hover1_zoom'] ) ),
        sprintf( 'transform: scale(%s)', esc_html( $dp_options['hover1_zoom'] ) )
      )
    );

  } elseif ( 'type2' === $dp_options['hover_type'] ) {

    $inline_styles[] = array(
      'selectors' => '.p-hover-effect--type2:hover img',
      'properties' => sprintf( 'opacity:%s', esc_html( $dp_options['hover2_opacity'] ) )
    );

    if ( 'type1' === $dp_options['hover2_direct'] ) {

      $inline_styles[] = array(
        'selectors' => '.p-hover-effect--type2 img',
        'properties' => array(
          'margin-left: 15px',
          '-webkit-transform: scale(1.3) translate3d(-15px, 0, 0)',
          'transform: scale(1.3) translate3d(-15px, 0, 0)'
        )
      );
      $inline_styles[] = array(
        'selectors' => '.p-author__img.p-hover-effect--type2 img',
        'properties' => array(
          'margin-left: 5px',
          '-webkit-transform: scale(1.3) translate3d(-5px, 0, 0)',
          'transform: scale(1.3) translate3d(-5px, 0, 0)'
        )
      );

    } else {

      $inline_styles[] = array(
        'selectors' => '.p-hover-effect--type2 img',
        'properties' => array(
          'margin-left: -15px',
          '-webkit-transform: scale(1.3) translate3d(15px, 0, 0)',
          'transform: scale(1.3) translate3d(15px, 0, 0)'
        )
      );
      $inline_styles[] = array(
        'selectors' => '.p-author__img.p-hover-effect--type2 img',
        'properties' => array(
          'margin-left: -5px',
          '-webkit-transform: scale(1.3) translate3d(5px, 0, 0)',
          'transform: scale(1.3) translate3d(5px, 0, 0)'
        )
      );

    }

  } else { // Hover type3

    $inline_styles[] = array(
      'selectors' => array(
        '.p-hover-effect--type3'
      ),
      'properties' => sprintf( 'background: %s', esc_html( $dp_options['hover3_bgcolor'] ) )
    );
    $inline_styles[] = array(
      'selectors' => '.p-hover-effect--type3:hover img',
      'properties' => sprintf( 'opacity: %s', esc_html( $dp_options['hover3_opacity'] ) )
    );

  }

  // Logo
  if ( 'type1' === $header_logo_type ) {
    $inline_styles[] = array(
      'selectors' => '.l-header__logo a',
      'properties' => array(
        sprintf( 'color: %s', esc_html( $header_logo_color ) ),
        sprintf( 'font-size: %dpx', esc_html( $header_logo_font_size ) )
      )
    );
  }

  // Header
  $inline_styles[] = array(
    'selectors' => '.l-header',
    'properties' => sprintf( 'background: %s', esc_html( $dp_options['header_bg'] ) )
  );
  $inline_styles[] = array(
    'selectors' => '.p-global-nav > ul > li > a',
    'properties' => sprintf( 'color: %s', esc_html( $dp_options['gnav_color'] ) )
  );
  $inline_styles[] = array(
    'selectors' => '.p-global-nav .sub-menu a',
    'properties' => array(
      sprintf( 'background: %s', esc_html( $dp_options['gnav_sub_bg'] ) ),
      sprintf( 'color: %s', esc_html( $dp_options['gnav_sub_color'] ) )
    )
  );
  $inline_styles[] = array(
    'selectors' => '.p-global-nav .sub-menu a:hover',
    'properties' => array(
      sprintf( 'background: %s', esc_html( $dp_options['gnav_sub_bg_hover'] ) ),
      sprintf( 'color: %s', esc_html( $dp_options['gnav_sub_color_hover'] ) )
    )
  );

  // Add hover colors to global navigation items
  $menu_name = wp_get_nav_menu_name( 'global' );

  if ( $menu_items = wp_get_nav_menu_items( $menu_name ) ) {

    foreach( (array) $menu_items as $item ) {

      if ( $item->menu_item_parent ) continue;

      if ( isset( $dp_options['gnav_items'][$item->ID]['color'] ) ) {
        $menu_color = $dp_options['gnav_items'][$item->ID]['color'];
      } else {
        $menu_color = '#000000';
      }

      $inline_styles[] = array(
        'selectors' => array(
          sprintf( '.p-global-nav .menu-item-%d.current-menu-item > a', $item->ID ),
          sprintf( '.p-global-nav .menu-item-%d > a:hover', $item->ID )
        ),
        'properties' => sprintf( 'color: %s', esc_html( $menu_color ) )
      );

      $inline_styles[] = array(
        'selectors' => array(
          sprintf( '.p-global-nav .menu-item-%d.current-menu-item > a::before', $item->ID ),
          sprintf( '.p-global-nav .menu-item-%d > a:hover::before', $item->ID )
        ),
        'properties' => sprintf( 'background: %s', esc_html( $menu_color ) )
      );

    }
  }

  // Footer
  $inline_styles[] = array(
    'selectors' => '.p-footer-links',
    'properties' => sprintf( 'background: %s', esc_html( $dp_options['footer_links_bg'] ) )
  );
  $inline_styles[] = array(
    'selectors' => '.p-footer-widgets',
    'properties' => sprintf( 'background: %s', esc_html( $dp_options['footer_widgets_bg'] ) )
  );
  $inline_styles[] = array(
    'selectors' => '.p-copyright',
    'properties' => sprintf( 'background: %s', esc_html( $dp_options['copyright_bg'] ) )
  );
  $responsive_styles['max-width: 767px'][] = array(
    'selectors' => array(
      '.p-footer-widgets',
      '.p-social-nav'
    ),
    'properties' => sprintf( 'background: %s', esc_html( $dp_options['footer_widgets_bg'] ) )
  );

  // Native ads
  $inline_styles[] = array(
    'selectors' => '.p-ad-info__label',
    'properties' => array(
      sprintf( 'background: %s', esc_html( $dp_options['native_ad_label_bg_color'] ) ),
      sprintf( 'color: %s', esc_html( $dp_options['native_ad_label_text_color'] ) ),
      sprintf( 'font-size: %dpx', esc_html( $dp_options['native_ad_label_font_size'] ) )
    )
  );

	// Widgets
	foreach( get_option( 'widget_site-info-widget', array() ) as $key => $value ) {
		if ( is_int( $key ) && ! empty( $value['btn_color'] ) ) {
      $inline_styles[] = array(
        'selectors' => '#site-info-widget-' . $key . ' .p-info__btn',
        'properties' => array(
          sprintf( 'background: %s', esc_html( $value['btn_bg'] ) ),
          sprintf( 'color: %s', esc_html( $value['btn_color'] ) )
        )
      );
      $inline_styles[] = array(
        'selectors' => '#site-info-widget-' . $key . ' .p-info__btn:hover',
        'properties' => array(
          sprintf( 'background: %s', esc_html( $value['btn_bg_hover'] ) ),
          sprintf( 'color: %s', esc_html( $value['btn_color_hover'] ) )
        )
      );
		}
	}

  // Page header
  if ( is_post_type_archive( 'news' ) ) {
    $ph_key_color = $dp_options['news_ph_key_color'];
    $ph_1_title_font_size = $dp_options['news_ph_1_title_font_size'];
    $ph_2_title_font_size = $dp_options['news_ph_2_title_font_size'];
    $ph_2_img = $dp_options['news_ph_2_img'];
  } elseif ( is_post_type_archive( 'event' ) ) {
    $ph_key_color = $dp_options['event_ph_key_color'];
    $ph_1_title_font_size = $dp_options['event_ph_1_title_font_size'];
    $ph_2_title_font_size = $dp_options['event_ph_2_title_font_size'];
    $ph_2_img = $dp_options['event_ph_2_img'];
  } elseif ( is_tax( 'event_tag' ) ) {
    $term_id = get_queried_object_id();
    $ph_key_color = get_term_meta( $term_id, 'ph_key_color', true );
    $ph_1_title_font_size = get_term_meta( $term_id, 'ph_1_title_font_size', true );
    $ph_2_title_font_size = get_term_meta( $term_id, 'ph_2_title_font_size', true );
    $ph_2_img = get_term_meta( $term_id, 'ph_2_img', true );
  } elseif ( is_post_type_archive( 'special' ) ) {
    $ph_key_color = $dp_options['special_ph_key_color'];
    $ph_1_title_font_size = $dp_options['special_ph_1_title_font_size'];
    $ph_2_title_font_size = $dp_options['special_ph_2_title_font_size'];
    $ph_2_img = $dp_options['special_ph_2_img'];
  } elseif ( is_page() ) {
    $ph_key_color = $post->ph_key_color;
    $ph_1_title_font_size = $post->ph_1_title_font_size;
    $ph_2_title_font_size = $post->ph_2_title_font_size;
    $ph_2_img = $post->ph_2_img;
  } elseif ( is_404() ) {
    $ph_key_color = $dp_options['404_ph_key_color'];
    $ph_1_title_font_size = $dp_options['404_ph_1_title_font_size'];
    $ph_2_title_font_size = $dp_options['404_ph_2_title_font_size'];
    $ph_2_img = $dp_options['404_ph_2_img'];
  } else {
    $ph_key_color = $dp_options['ph_key_color'];
    $ph_1_title_font_size = $dp_options['ph_1_title_font_size'];
    $ph_2_title_font_size = $dp_options['ph_2_title_font_size'];
    $ph_2_img = $dp_options['ph_2_img'];
  }

  $inline_styles[] = array(
    'selectors' => '.p-page-header',
    'properties' => sprintf( 'background-image: url(%s)', esc_html( wp_get_attachment_url( $ph_2_img ) ) )
  );
  $inline_styles[] = array(
    'selectors' => '.p-page-header::before',
    'properties' => sprintf( 'background-color: %s', esc_html( $ph_key_color ) )
  );
  $inline_styles[] = array(
    'selectors' => '.p-page-header__upper-title',
    'properties' => sprintf( 'font-size: %dpx', absint( $ph_1_title_font_size ) )
  );
  $inline_styles[] = array(
    'selectors' => '.p-page-header__lower-title',
    'properties' => sprintf( 'font-size: %dpx', absint( $ph_2_title_font_size ) )
  );

  // Event
  if ( $dp_options['event_round'] ) {
    $inline_styles[] = array(
      'selectors' => '.p-article07 a[class^="p-hover-effect--"]',
      'properties' => 'border-radius: 10px'
    );
  }

  $event_tags = get_terms( 'event_tag' );

  foreach ( $event_tags as $tag ) {
    $inline_styles[] = array(
      'selectors' => is_singular( 'event' )
        ? sprintf( '.p-slider .p-event-cat--%s', $tag->term_id )
        : sprintf( '.p-event-cat--%s', $tag->term_id ),
      'properties' => array(
        sprintf( 'background: %s', esc_html( get_term_meta( $tag->term_id, 'bg', true ) ) ),
        sprintf( 'color: %s', esc_html( get_term_meta( $tag->term_id, 'color', true ) ) )
      )
    );
    $inline_styles[] = array(
      'selectors' => sprintf( '.p-event-cat--%s:hover', $tag->term_id ),
      'properties' => array(
        sprintf( 'background: %s', esc_html( get_term_meta( $tag->term_id, 'bg_hover', true ) ) ),
        sprintf( 'color: %s', esc_html( get_term_meta( $tag->term_id, 'color_hover', true ) ) )
      )
    );
  }

  if ( is_front_page() ) {

    if ( 'type2' === $dp_options['header_content_type'] ) {

      for ( $i = 1; $i <= 5; $i++ ) {

        if ( ! $image = $dp_options['header_slider_img' . $i] ) continue;
        $image = is_mobile() && $dp_options['header_slider_img_sp' . $i]
          ? $dp_options['header_slider_img_sp' . $i]
          : $image;

        $inline_styles[] = array(
          'selectors' => ".p-header-slider__item--$i",
          'properties' => sprintf( 'background-image: url(%s)', esc_html( wp_get_attachment_url( $image ) ) )
        );

        $inline_styles[] = array(
          'selectors' => ".p-header-slider__item--$i .p-header-content__title",
          'properties' => array(
            sprintf( 'color: %s', esc_html( $dp_options['header_slider_catch_color' . $i] ) ),
            sprintf( 'font-size: %dpx', esc_html( $dp_options['header_slider_catch_font_size' . $i] ) )
          )
        );
        $inline_styles[] = array(
          'selectors' => ".p-header-slider__item--$i .p-header-content__btn",
          'properties' => array(
            sprintf( 'background: %s', esc_html( $dp_options['header_slider_btn_bg' . $i] ) ),
            sprintf( 'color: %s', esc_html( $dp_options['header_slider_btn_color' . $i] ) )
          )
        );
        $inline_styles[] = array(
          'selectors' => ".p-header-slider__item--$i .p-header-content__btn:hover",
          'properties' => array(
            sprintf( 'background: %s', esc_html( $dp_options['header_slider_btn_bg_hover' . $i] ) ),
            sprintf( 'color: %s', esc_html( $dp_options['header_slider_btn_color_hover' . $i] ) )
          )
        );

      }

    } elseif ( 'type3' === $dp_options['header_content_type'] ) {

      if ( wp_is_mobile() ) {
        $inline_styles[] = array(
          'selectors' => '.p-header-video',
          'properties' => sprintf( 'background-image: url(%s)', esc_html( wp_get_attachment_url( $dp_options['header_video_img'] ) ) )
        );
      }

      $inline_styles[] = array(
        'selectors' => '.p-header-content__title',
        'properties' => array(
          sprintf( 'color: %s', esc_html( $dp_options['header_video_catch_color'] ) ),
          sprintf( 'font-size: %dpx', esc_html( $dp_options['header_video_catch_font_size'] ) )
        )
      );
      $inline_styles[] = array(
        'selectors' => '.p-header-content__btn',
        'properties' => array(
          sprintf( 'background: %s', esc_html( $dp_options['header_video_btn_bg'] ) ),
          sprintf( 'color: %s', esc_html( $dp_options['header_video_btn_color'] ) )
        )
      );
      $inline_styles[] = array(
        'selectors' => '.p-header-content__btn:hover',
        'properties' => array(
          sprintf( 'background: %s', esc_html( $dp_options['header_video_btn_bg_hover'] ) ),
          sprintf( 'color: %s', esc_html( $dp_options['header_video_btn_color_hover'] ) )
        )
      );

    } elseif ( 'type4' === $dp_options['header_content_type'] ) {

      if ( wp_is_mobile() ) {
        $inline_styles[] = array(
          'selectors' => '.p-header-youtube',
          'properties' => sprintf( 'background-image: url(%s)', esc_html( wp_get_attachment_url( $dp_options['header_youtube_img'] ) ) )
        );
      }

      $inline_styles[] = array(
        'selectors' => '.p-header-content__title',
        'properties' => array(
          sprintf( 'color: %s', esc_html( $dp_options['header_youtube_catch_color'] ) ),
          sprintf( 'font-size: %dpx', esc_html( $dp_options['header_youtube_catch_font_size'] ) )
        )
      );
      $inline_styles[] = array(
        'selectors' => '.p-header-content__btn',
        'properties' => array(
          sprintf( 'background: %s', esc_html( $dp_options['header_youtube_btn_bg'] ) ),
          sprintf( 'color: %s', esc_html( $dp_options['header_youtube_btn_color'] ) )
        )
      );
      $inline_styles[] = array(
        'selectors' => '.p-header-content__btn:hover',
        'properties' => array(
          sprintf( 'background: %s', esc_html( $dp_options['header_youtube_btn_bg_hover'] ) ),
          sprintf( 'color: %s', esc_html( $dp_options['header_youtube_btn_color_hover'] ) )
        )
      );

    }

    // Contents builder
    $count = 0;
    foreach ( $dp_options['index_contents_order'] as $index => $order )  {
    if(
      ($order=='special' && $dp_options['display_index_special']) ||
      ($order=='news' && $dp_options['display_index_news']) ||
      ($order=='event' && $dp_options['display_index_event']) ||
      ($order=='blog' && $dp_options['display_index_blog']) ||
      ($order=='wysiwyg1' && $dp_options['display_index_wysiwyg1']) ||
      ($order=='wysiwyg2' && $dp_options['display_index_wysiwyg2']) ||
      ($order=='wysiwyg3' && $dp_options['display_index_wysiwyg3'])
    ){ $count++; }
      if ( 0 !== strpos( $order, 'wysiwyg' ) ) {
        $inline_styles[] = array(
          'selectors' => sprintf( '.p-cb__item:nth-child(%d) .p-headline02__title', $count ),
          'properties' => array(
            sprintf( 'color: %s', esc_html( $dp_options['index_' . $order . '_title_color'] ) ),
            sprintf( 'font-size: %dpx', esc_html( $dp_options['index_' . $order . '_title_font_size'] ) )
          )
        );
      }
    }

  } elseif ( is_singular( 'post' ) || is_page() ) {

    $inline_styles[] = array(
      'selectors' => '.p-entry__title',
      'properties' => sprintf( 'font-size: %dpx', esc_html( $dp_options['title_font_size'] ) )
    );
    $inline_styles[] = array(
      'selectors' => '.p-entry__body',
      'properties' => sprintf( 'font-size: %dpx', esc_html( $dp_options['content_font_size'] ) )
    );
    $responsive_styles['max-width: 767px'][] = array(
      'selectors' => '.p-entry__title',
      'properties' => sprintf( 'font-size: %dpx', esc_html( $dp_options['title_font_size_sp'] ) )
    );
    $responsive_styles['max-width: 767px'][] = array(
      'selectors' => '.p-entry__body',
      'properties' => sprintf( 'font-size: %dpx', esc_html( $dp_options['content_font_size_sp'] ) )
    );

  } elseif ( is_singular( 'news' ) ) {

    $inline_styles[] = array(
      'selectors' => '.p-entry__title',
      'properties' => sprintf( 'font-size: %dpx', esc_html( $dp_options['news_title_font_size'] ) )
    );
    $inline_styles[] = array(
      'selectors' => '.p-entry__body',
      'properties' => sprintf( 'font-size: %dpx', esc_html( $dp_options['news_content_font_size'] ) )
    );
    $responsive_styles['max-width: 767px'][] = array(
      'selectors' => '.p-entry__title',
      'properties' => sprintf( 'font-size: %dpx', esc_html( $dp_options['news_title_font_size_sp'] ) )
    );
    $responsive_styles['max-width: 767px'][] = array(
      'selectors' => '.p-entry__body',
      'properties' => sprintf( 'font-size: %dpx', esc_html( $dp_options['news_content_font_size_sp'] ) )
    );

  } elseif ( is_singular( 'event' ) ) {

    if ( have_posts() ) {
      while ( have_posts() ) {
        the_post();
        $event_tags = get_the_terms( $post->ID, 'event_tag' );

        $inline_styles[] = array(
          'selectors' => array(
            '.p-entry__header02-upper',
            '.p-slider .slick-dots li.slick-active button::before',
            '.p-slider .slick-dots button:hover::before',
          ),
          'properties' => sprintf( 'background: %s', esc_html( get_term_meta( $event_tags[0]->term_id, 'ph_key_color', true ) ) )
        );

      }
    }
    rewind_posts();

    $inline_styles[] = array(
      'selectors' => '.p-entry__header02-title',
      'properties' => sprintf( 'font-size: %dpx', esc_html( $dp_options['event_title_font_size'] ) )
    );
    $inline_styles[] = array(
      'selectors' => '.p-entry__body',
      'properties' => sprintf( 'font-size: %dpx', esc_html( $dp_options['event_content_font_size'] ) )
    );
    $responsive_styles['max-width: 767px'][] = array(
      'selectors' => '.p-entry__header02-title',
      'properties' => sprintf( 'font-size: %dpx', esc_html( $dp_options['event_title_font_size_sp'] ) )
    );
    $responsive_styles['max-width: 767px'][] = array(
      'selectors' => '.p-entry__body',
      'properties' => sprintf( 'font-size: %dpx', esc_html( $dp_options['event_content_font_size_sp'] ) )
    );

  } elseif ( is_singular( 'special' ) ) {

    $inline_styles[] = array(
      'selectors' => array(
        '.p-entry__header02-upper',
        '.p-slider .slick-dots li.slick-active button::before',
        '.p-slider .slick-dots button:hover::before',
      ),
      'properties' => sprintf( 'background: %s', esc_html( $dp_options['special_ph_key_color'] ) )
    );

    $inline_styles[] = array(
      'selectors' => '.p-entry__header02-title',
      'properties' => sprintf( 'font-size: %dpx', esc_html( $dp_options['special_title_font_size'] ) )
    );
    $inline_styles[] = array(
      'selectors' => '.p-entry__body',
      'properties' => sprintf( 'font-size: %dpx', esc_html( $dp_options['special_content_font_size'] ) )
    );
    $responsive_styles['max-width: 767px'][] = array(
      'selectors' => '.p-entry__header02-title',
      'properties' => sprintf( 'font-size: %dpx', esc_html( $dp_options['special_title_font_size_sp'] ) )
    );
    $responsive_styles['max-width: 767px'][] = array(
      'selectors' => '.p-entry__body',
      'properties' => sprintf( 'font-size: %dpx', esc_html( $dp_options['special_content_font_size_sp'] ) )
    );

  }

  // You can add styles with 'tcd_inline_styles' filter
  $inline_styles = apply_filters( 'tcd_inline_styles', $inline_styles, $dp_options );

  // Global navigation (max-width: 1199px)
  $responsive_styles['max-width: 1199px'][] = array(
    'selectors' => '.p-global-nav',
    'properties' => sprintf( 'background: rgba(%s, %s)', esc_html( implode( ',', hex2rgb( $dp_options['gnav_bg_sp'] ) ) ), esc_html( $dp_options['gnav_bg_opacity_sp'] ) )
  );
  $responsive_styles['max-width: 1199px'][] = array(
    'selectors' => array(
      '.p-global-nav > ul > li > a',
      '.p-global-nav a',
      '.p-global-nav a:hover',
      '.p-global-nav .sub-menu a',
      '.p-global-nav .sub-menu a:hover',
    ),
    'properties' => sprintf( 'color: %s!important', esc_html( $dp_options['gnav_color_sp'] ) )
  );
  $responsive_styles['max-width: 1199px'][] = array(
    'selectors' => '.p-global-nav .menu-item-has-children > a > .sub-menu-toggle::before',
    'properties' => sprintf( 'border-color: %s', esc_html( $dp_options['gnav_color_sp'] ) )
  );

  // Page header (max-width: 991px)
  $responsive_styles['max-width: 991px'][] = array(
    'selectors' => '.p-page-header__upper',
    'properties' => sprintf( 'background: %s', esc_html( $ph_key_color ) )
  );
  $responsive_styles['max-width: 991px'][] = array(
    'selectors' => '.p-page-header__lower',
    'properties' => sprintf( 'background-image: url(%s)', esc_html( wp_get_attachment_url( $ph_2_img ) ) )
  );

  // You can add responsive styles with 'tcd_responsive_styles' filter
  $responsive_styles = apply_filters( 'tcd_responsive_styles', $responsive_styles, $dp_options );

  echo '<style>' . "\n";

  $output = '';

  // Add $inline_styles to $output
  foreach ( $inline_styles as $style ) {
    $selectors = is_array( $style['selectors'] ) ? implode( ',', $style['selectors'] ) : $style['selectors'];
    $properties = is_array( $style['properties'] ) ? implode( ';', $style['properties'] ) : $style['properties'];
    $output .= sprintf( '%s{%s}', $selectors, $properties );
  }

  // Add $responsive_styles to $output
  foreach ( $responsive_styles as $media_query => $styles ) {

    $output .= sprintf( '@media screen and (%s) {', $media_query );

    foreach ( $styles as $style ) {
      $selectors = is_array( $style['selectors'] ) ? implode( ',', $style['selectors'] ) : $style['selectors'];
      $properties = is_array( $style['properties'] ) ? implode( ';', $style['properties'] ) : $style['properties'];
      $output .= sprintf( '%s{%s}', $selectors, $properties );
    }

    $output .= '}';
  }

  if ( $output ) { echo $output; }

  do_action( 'tcd_head', $dp_options );

  // Custom CSS
  if ( $dp_options['css_code'] ) { echo $dp_options['css_code']; }

  echo '</style>' . "\n";

}
add_action( 'wp_head', 'avant_inline_styles' );

// Custom head/script
function tcd_custom_head() {
  $options = get_design_plus_option();

  if ( $options['custom_head'] ) {
    echo $options['custom_head'] . "\n";
  }
}
add_action( 'wp_head', 'tcd_custom_head', 9999 );
