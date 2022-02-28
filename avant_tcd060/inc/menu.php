<?php
/**
 * Add icons to global navigation items
 */
function add_icons_to_nav_menu( $item_output, $item, $depth, $args ) {

  $dp_options = get_design_plus_options();

  if ( isset( $dp_options['gnav_items'][$item->ID] ) ) {

    switch ( $dp_options['gnav_items'][$item->ID]['icon_type'] ) {

      case 'type1' : // Use an icon font
        if($item->target!=''){
        $item_output =  sprintf(
          '<a href="%s" target="_blank"><span class="p-global-nav__item-icon p-icon p-icon--%s"></span>%s<span class="p-global-nav__toggle"></span></a>',
          esc_url( $item->url ),
          esc_attr( $dp_options['gnav_items'][$item->ID]['font_icon'] ),
          esc_html( $item->title )
        );
        }else{
        $item_output =  sprintf(
          '<a href="%s"><span class="p-global-nav__item-icon p-icon p-icon--%s"></span>%s<span class="p-global-nav__toggle"></span></a>',
          esc_url( $item->url ),
          esc_attr( $dp_options['gnav_items'][$item->ID]['font_icon'] ),
          esc_html( $item->title )
        );
        }
        break;

      case 'type2' : // Use an icon image
        if($item->target!=''){
        $item_output =  sprintf(
          '<a href="%s" target="_blank"><span class="p-global-nav__item-icon p-icon p-icon--img">%s</span>%s<span class="p-global-nav__toggle"></span></a>',
          esc_url( $item->url ),
          wp_get_attachment_image( $dp_options['gnav_items'][$item->ID]['icon_img'] ),
          esc_html( $item->title )
        );
        }else{
        $item_output =  sprintf(
          '<a href="%s"><span class="p-global-nav__item-icon p-icon p-icon--img">%s</span>%s<span class="p-global-nav__toggle"></span></a>',
          esc_url( $item->url ),
          wp_get_attachment_image( $dp_options['gnav_items'][$item->ID]['icon_img'] ),
          esc_html( $item->title )
        );
        }
        break;

    }

  }

  return $item_output;

}
add_filter( 'walker_nav_menu_start_el', 'add_icons_to_nav_menu', 10, 4 );
