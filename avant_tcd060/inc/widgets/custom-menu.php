<?php
/**
 * Navigation menu (tcd ver)
 */
class tcdw_menu_widget extends WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {

		$widget_ops = array(
			'classname' => 'tcdw_menu_widget',
			'description' => __( 'Displays two navigation menus.', 'tcd-w' )
		);

		parent::__construct(
			'tcdw_menu_widget', // ID
			__( 'Navigation menu (tcd ver)', 'tcd-w' ), // Name
			$widget_ops
		);

	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
  public function widget( $args, $instance ) {

    $title = apply_filters( 'widget_title', $instance['title'] );
    // Get menu
    $nav_menu1 = ! empty( $instance['nav_menu1'] ) ? wp_get_nav_menu_object( $instance['nav_menu1'] ) : false;
    $nav_menu2 = ! empty( $instance['nav_menu2'] ) ? wp_get_nav_menu_object( $instance['nav_menu2'] ) : false;

    if ( ! $nav_menu1 && ! $nav_menu2 ) {
      return;
    }

    echo $args['before_widget'];

    if ( $title ) {
      echo $args['before_title'] . $title . $args['after_title'];
    }

    $nav_menu_args1 = array(
      'fallback_cb' => '',
      'container' => '',
      'menu' => $nav_menu1,
      'menu_class' => 'p-footer-nav__item',
      'depth' => 1
		);

    $nav_menu_args2 = array(
      'fallback_cb' => '',
      'container' => '',
      'menu_class' => 'p-footer-nav__item',
      'menu' => $nav_menu2,
      'depth' => 1
		);
    ?>
    <div class="p-footer-nav">
      <?php
      if ( $nav_menu1 ) {
        wp_nav_menu( apply_filters( 'widget_nav_menu_args', $nav_menu_args1, $nav_menu1, $args, $instance ) );
      }
      if ( $nav_menu2 ) {
        wp_nav_menu( apply_filters( 'widget_nav_menu_args', $nav_menu_args2, $nav_menu2, $args, $instance ) );
      }
      ?>
    </div>
    <?php
    echo $args['after_widget'];
  }

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
  public function form( $instance ) {
    global $wp_customize;
		$title = isset( $instance['title'] ) ? $instance['title'] : '';
    $nav_menu1 = isset( $instance['nav_menu1'] ) ? $instance['nav_menu1'] : '';
    $nav_menu2 = isset( $instance['nav_menu2'] ) ? $instance['nav_menu2'] : '';

    // Get menus
    $menus = wp_get_nav_menus();

    // If no menus exists, direct the user to go and create some.
    ?>
		<p class="nav-menu-widget-no-menus-message" <?php if ( ! empty( $menus ) ) { echo ' style="display:none" '; } ?>>
			<?php
			if ( $wp_customize instanceof WP_Customize_Manager ) {
				$url = 'javascript: wp.customize.panel( "nav_menus" ).focus();';
			} else {
				$url = admin_url( 'nav-menus.php' );
			}
			?>
			<?php echo sprintf( __( 'No menus have been created yet. <a href="%s">Create some</a>.' ), esc_attr( $url ) ); ?>
		</p>
		<div class="nav-menu-widget-form-controls" <?php if ( empty( $menus ) ) { echo ' style="display:none" '; } ?>>
		  <p>
		  	<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'tcd-w' ); ?></label>
		  	<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>'" type="text" value="<?php echo esc_attr( $title ); ?>">
  	  </p>
		  <p>
		  	<label for="<?php echo $this->get_field_id( 'nav_menu1' ); ?>"><?php _e( 'Navigation menu', 'tcd-w' ); ?>1:</label>
      	<select class="widefat" id="<?php echo $this->get_field_id( 'nav_menu1' ); ?>" name="<?php echo $this->get_field_name( 'nav_menu1' ); ?>">
        	<option value="0"><?php _e( '— Select —', 'tcd-w' ); ?></option>
        	<?php foreach ( $menus as $menu ) : ?>
        	<option value="<?php echo esc_attr( $menu->term_id ); ?>" <?php selected( $nav_menu1, $menu->term_id ); ?>><?php echo esc_html( $menu->name ); ?></option>
        	<?php endforeach; ?>
      	</select>
  	  </p>
		  <p>
		  	<label for="<?php echo $this->get_field_id( 'nav_menu2' ); ?>"><?php _e( 'Navigation menu', 'tcd-w' ); ?>2:</label>
      	<select class="widefat" id="<?php echo $this->get_field_id( 'nav_menu2' ); ?>" name="<?php echo $this->get_field_name( 'nav_menu2' ); ?>">
        	<option value="0"><?php _e( '— Select —', 'tcd-w' ); ?></option>
        	<?php foreach ( $menus as $menu ) : ?>
        	<option value="<?php echo esc_attr( $menu->term_id ); ?>" <?php selected( $nav_menu2, $menu->term_id ); ?>><?php echo esc_html( $menu->name ); ?></option>
        	<?php endforeach; ?>
      	</select>
  	  </p>
    </div>
    <?php
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
  public function update( $new_instance, $old_instance ) {

    $instance = array();
    $instance['title'] = strip_tags( $new_instance['title'] );
    $instance['nav_menu1'] = absint( $new_instance['nav_menu1'] );
    $instance['nav_menu2'] = absint( $new_instance['nav_menu2'] );
    return $instance;
  }

} // end class

add_action('widgets_init', function(){register_widget('tcdw_menu_widget');});
