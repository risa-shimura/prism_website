<?php
$dp_options = get_design_plus_options();

/**
 * postで使用するオプション
 *   pc: single_ad_code, single_ad_image, single_ad_url
 * 	 sp: single_mobile_ad_code, single_mobile_ad_image, single_mobile_ad_url
 *
 * newsで使用するオプション
 *   pc: news_ad_code, news_ad_image, news_ad_url
 * 	 sp: news_mobile_ad_code, news_mobile_ad_image, news_mobile_ad_url
 */

$slug = is_singular( 'news' ) ? 'news' : 'single';

$code1 = $dp_options[$slug . '_ad_code1'];
$image1 = $dp_options[$slug . '_ad_image1'];
$url1 = $dp_options[$slug . '_ad_url1'];
$code2 = $dp_options[$slug . '_ad_code2'];
$image2 = $dp_options[$slug . '_ad_image2'];
$url2 = $dp_options[$slug . '_ad_url2'];

if ( $code1 || $image1 || $code2 || $image2 ) {

	echo '<div class="p-entry__ad p-entry__ad--upper">';

	if ( $code1 ) {

    printf(
      '<div class="p-entry__ad-item">%s</div>',
      $code1
    );

	} elseif ( $image1 ) {

		$image1 = wp_get_attachment_image_src( $image1, 'full' );

    printf(
      '<div class="p-entry__ad-item"><a href="%s"><img src="%s" alt=""></a></div>',
      esc_url( $url1 ),
      esc_attr( $image1[0] )
    );

	}

	if ( $code2 ) {

    printf(
      '<div class="p-entry__ad-item">%s</div>',
      $code2
    );

	} elseif ( $image2 ) {

    $image2 = wp_get_attachment_image_src( $image2, 'full' );

    printf(
      '<div class="p-entry__ad-item"><a href="%s"><img src="%s" alt=""></a></div>',
      esc_url( $url2 ),
      esc_attr( $image2[0] )
    );

  }

	echo '</div>' . "\n";
}
