<?php
/**
 * Styled post list3 (tcd ver)
 */
class Styled_Post_List_Widget3 extends WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {

		$widget_ops = array(
			'classname' => 'styled_post_list_widget3',
			'description' => __( 'Displays styled post list3.', 'tcd-w' )
		);

		parent::__construct(
			'styled_post_list_widget3', // ID
			__( 'Styled post list3 (tcd ver)', 'tcd-w' ), // Name
			$widget_ops
		);

	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	function widget( $args, $instance ) {

    $dp_options = get_design_plus_options();

		$title = apply_filters( 'widget_title', $instance['title'] );

   	echo $args['before_widget'];

		if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}

    // Choose which item to display
    $random = '';

		for ( $i = 3; $i >= 1; $i-- ) {
			if ( $instance['image' . $i] ) {
				$random = mt_rand( 1, $i );
				break;
			}
		}
		if ( ! is_int( $random ) ) return;
    ?>
    <div class="p-card">
      <a class="p-hover-effect--<?php echo esc_attr( $dp_options['hover_type'] ); ?>" href="<?php echo esc_url( $instance['url' . $random] ); ?>"<?php if ( $instance['target' . $random] ) { echo ' target="_blank"'; } ?>>
        <div class="p-card__img">
          <?php echo wp_get_attachment_image( $instance['image' . $random], 'size4' ); ?>
        </div>
        <h3 class="p-card__title"><?php echo esc_html( $instance['title' . $random] ); ?></h3>
      </a>
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
  function form( $instance ) {

    $defaults['title'] = '';
    for ( $i = 1; $i <= 3; $i++ ) {
		  $defaults['title' . $i] = '';
		  $defaults['url' . $i] = '';
		  $defaults['target' . $i] = '';
		  $defaults['image' . $i] = '';
    }
    $instance = wp_parse_args( $instance, $defaults );
  ?>
  <p>
    <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', 'tcd-w' ); ?>: </label>
    <input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat">
  </p>
  <?php for ( $i = 1; $i <= 3; $i++ ) : ?>
  <div class="a-widget-box">
    <h4 class="a-widget-box__headline"><?php _e( 'Item','tcd-w' ); ?><?php echo $i; ?></h4>
    <div class="a-widget-box__content">
      <p>
        <label for="<?php echo $this->get_field_id( 'title' . $i ); ?>"><?php _e( 'Title', 'tcd-w' ); ?>: </label>
        <input type="text" id="<?php echo $this->get_field_id( 'title' . $i ); ?>" name="<?php echo $this->get_field_name( 'title' . $i ); ?>" value="<?php echo $instance['title' . $i]; ?>" class="widefat">
      </p>
      <p>
        <label for="<?php echo $this->get_field_id( 'url' . $i ); ?>"><?php _e( 'URL', 'tcd-w' ); ?>: </label>
        <input type="text" id="<?php echo $this->get_field_id( 'url' . $i ); ?>" name="<?php echo $this->get_field_name( 'url' . $i ); ?>" value="<?php echo $instance['url' . $i]; ?>" class="widefat">
      </p>
      <p>
        <label><input id="<?php echo $this->get_field_id( 'target' . $i ); ?>" name="<?php echo $this->get_field_name( 'target' . $i ); ?>" type="checkbox" value="1" <?php checked( '1', $instance['target' . $i] ); ?>> <?php _e( 'Open with new window', 'tcd-w' ); ?></label>
      </p>
      <p>
      	<div class="a-widget-box__upload cf cf_media_field hide-if-no-js <?php echo $this->get_field_id( 'image' . $i ); ?>">
       		<input type="hidden" id="<?php echo $this->get_field_id( 'image' . $i ); ?>" class="cf_media_id" name="<?php echo $this->get_field_name( 'image' . $i ); ?>" value="<?php echo esc_attr( $instance['image' . $i] ); ?>">
       		<div class="preview_field"><?php if ( $instance['image' . $i] ) { echo wp_get_attachment_image( $instance['image' . $i], 'medium' ); } ?></div>
					<div class="button_area">
        		<input type="button" class="cfmf-select-img button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>">
        		<input type="button" class="cfmf-delete-img button <?php if ( ! $instance['image' . $i] ) { echo 'hidden'; } ?>" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>">
       		</div>
     		</div>
        <?php _e( 'Recommended image size. Width: 600px, Height: 420px', 'tcd-w' ); ?>
      </p>
    </div>
  </div>
  <?php
  endfor;
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
	function update( $new_instance, $old_instance ) {
    $new_instance['title'] = strip_tags( $new_instance['title'] );
    for ( $i = 1; $i <= 3; $i++ ) {
      $new_instance['title' . $i] = strip_tags( $new_instance['title' . $i] );
      $new_instance['url' . $i] = strip_tags( $new_instance['url' . $i] );
      if ( ! isset( $new_instance['target' . $i] ) ) $new_instance['target' . $i] = null;
      $new_instance['target' . $i] = '1' === $new_instance['target' . $i] ? '1' : null;
      $new_instance['image' . $i] = strip_tags( $new_instance['image' . $i] );
    }
		return $new_instance;
	}
}

/**
 * Register Styled_Post_List_Widget widget
 */
function register_styled_post_list_widget3() {
	register_widget( 'Styled_Post_List_Widget3' );
}
add_action( 'widgets_init', 'register_styled_post_list_widget3' );
