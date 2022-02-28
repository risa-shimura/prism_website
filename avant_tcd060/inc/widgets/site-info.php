<?php
/**
 * Site info (tcd ver)
 */
class Site_Info_Widget extends WP_Widget {

	/**
	 * Default values
	 */
	protected $defaults = array(
		'title' => '',
		'image' => '',
		'image_retina' => 0,
		'desc' => '',
		'btn_label' => '',
		'btn_color' => '#ffffff',
		'btn_bg' => '#000000',
		'btn_color_hover' => '#ffffff',
		'btn_bg_hover' => '#333333',
		'btn_url' => '',
		'btn_target' => 0
	);

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {

		$widget_ops = array(
			'classname' => 'site-info-widget',
			'description' => __( 'Displays site info.', 'tcd-w' )
		);
		parent::__construct(
			'site-info-widget', // ID
			__( 'Site info (tcd ver)', 'tcd-w' ), // Name
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

		$title = apply_filters( 'widget_title', $instance['title'] );
		$instance = array_merge( $this->defaults, $instance );

		echo $args['before_widget'];
    ?>
    <div class="p-info">
      <?php if ( $instance['image'] ) : ?>
      <div class="p-info__logo c-logo<?php if ( $instance['image_retina'] ) { echo ' c-logo--retina'; } ?>">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
          <img src="<?php echo esc_attr( wp_get_attachment_url( $instance['image'] ) ); ?>" alt="<?php bloginfo( 'name' ); ?>">
        </a>
      </div>
      <?php endif; ?>
      <?php if ( $instance['desc'] ) : ?>
      <div class="p-info__text"><?php echo nl2br( $instance['desc'] ); // No escape ?></div>
      <?php endif; ?>
      <?php if ( $instance['btn_label'] ) : ?>
      <a class="p-info__btn p-btn" href="<?php echo esc_url( $instance['btn_url'] ); ?>"<?php if ( $instance['btn_target'] ) { echo ' target="_blank"'; } ?>><?php echo esc_html( $instance['btn_label'] ); ?></a>
      <?php endif; ?>
    </div>
    <?php

		echo $args['after_widget'];
	}

	function form( $instance ) {
		$instance = array_merge( $this->defaults, $instance );
?>
  <p>
	  <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'tcd-w' ); ?></label>
			<input class="large-text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>">
	</p>
	<p>
	  <label for="<?php echo $this->get_field_id( 'image' ); ?>"><?php _e( 'Logo image', 'tcd-w' ); ?>:</label>
	  <div class="widget_media_upload cf cf_media_field hide-if-no-js">
		  <input type="hidden" id="<?php echo $this->get_field_id( 'image' ); ?>" class="cf_media_id" name="<?php echo $this->get_field_name( 'image' ); ?>" value="<?php echo esc_attr( $instance['image'] ); ?>">
			<div class="preview_field">
			<?php
				if ( $instance['image'] ) {
					echo wp_get_attachment_image( $instance['image'], 'medium' );
				}
			?>
		  </div>
			<div class="button_area">
				<input type="button" class="cfmf-select-img button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>">
				<input type="button" class="cfmf-delete-img button <?php if ( ! $instance['image'] ) { echo 'hidden'; } ?>" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>">
			</div>
		</div>
  </p>
	<p>
		<label for="<?php echo $this->get_field_id( 'image_retina' ); ?>">
			<input id="<?php echo $this->get_field_id( 'image_retina' ); ?>" name="<?php echo $this->get_field_name( 'image_retina' ); ?>" type="checkbox" value="1" <?php checked( $instance['image_retina'], '1' ); ?>><?php _e( 'Use retina display logo image', 'tcd-w' ); ?>
		</label>
	</p>
	<p>
		<label for="<?php echo $this->get_field_id( 'desc' ); ?>"><?php _e( 'Description', 'tcd-w' ); ?>:</label>
		<textarea class="large-text" id="<?php echo $this->get_field_id( 'desc' ); ?>" name="<?php echo $this->get_field_name( 'desc' ); ?>" rows="8"><?php echo esc_textarea( $instance['desc'] ); ?></textarea>
	</p>
  <p>
		<label for="<?php echo $this->get_field_id( 'btn_label' ); ?>"><?php _e( 'Button label', 'tcd-w' ); ?>:</label>
		<input class="large-text" id="<?php echo $this->get_field_id( 'btn_label' ); ?>" name="<?php echo $this->get_field_name( 'btn_label' ); ?>" type="text" value="<?php echo esc_attr( $instance['btn_label'] ); ?>">
  </p>
  <p>
		<label for="<?php echo $this->get_field_id( 'btn_color' ); ?>"><?php _e( 'Font color of button', 'tcd-w' ); ?>:</label> <input class="w-color-picker" id="<?php echo $this->get_field_id( 'btn_color' ); ?>" name="<?php echo $this->get_field_name( 'btn_color' ); ?>" type="text" value="<?php echo esc_attr( $instance['btn_color'] ); ?>" data-default-color="<?php echo esc_attr( $this->defaults['btn_color'] ); ?>">
  </p>
  <p>
		<label for="<?php echo $this->get_field_id( 'btn_bg' ); ?>"><?php _e( 'Background color of button', 'tcd-w' ); ?>:</label> <input class="w-color-picker" id="<?php echo $this->get_field_id( 'btn_bg' ); ?>" name="<?php echo $this->get_field_name( 'btn_bg' ); ?>" type="text" value="<?php echo esc_attr( $instance['btn_bg'] ); ?>" data-default-color="<?php echo esc_attr( $this->defaults['btn_bg'] ); ?>">
  </p>
  <p>
		<label for="<?php echo $this->get_field_id( 'btn_color_hover' ); ?>"><?php _e( 'Font color of button on hover', 'tcd-w' ); ?>:</label> <input class="w-color-picker" id="<?php echo $this->get_field_id( 'btn_color_hover' ); ?>" name="<?php echo $this->get_field_name( 'btn_color_hover' ); ?>" type="text" value="<?php echo esc_attr( $instance['btn_color_hover'] ); ?>" data-default-color="<?php echo esc_attr( $this->defaults['btn_color_hover'] ); ?>">
  </p>
  <p>
    <label for="<?php echo $this->get_field_id( 'btn_bg_hover' ); ?>"><?php _e( 'Background color of button on hover', 'tcd-w' ); ?>:</label> <input class="w-color-picker" id="<?php echo $this->get_field_id( 'btn_bg_hover' ); ?>" name="<?php echo $this->get_field_name( 'btn_bg_hover' ); ?>" type="text" value="<?php echo esc_attr( $instance['btn_bg_hover'] ); ?>" data-default-color="<?php echo esc_attr( $this->defaults['btn_bg_hover'] ); ?>">
  </p>
	<p>
		<label for="<?php echo $this->get_field_id( 'btn_url' ); ?>"><?php _e( 'Link URL of button', 'tcd-w' ); ?>:</label>
		<input class="large-text" id="<?php echo $this->get_field_id( 'btn_url' ); ?>" name="<?php echo $this->get_field_name( 'btn_url' ); ?>" type="text" value="<?php echo esc_attr( $instance['btn_url'] ); ?>">
  </p>
  <p>
		<label for="<?php echo $this->get_field_id( 'btn_target' ); ?>">
			<input id="<?php echo $this->get_field_id( 'btn_target' ); ?>" name="<?php echo $this->get_field_name( 'btn_target' ); ?>" type="checkbox" value="1" <?php checked( $instance['btn_target'], '1' ); ?>><?php _e( 'Open link in new window', 'tcd-w' ); ?>
		</label>
	</p>
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
	function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['image'] = strip_tags( $new_instance['image'] );
		$instance['image_retina'] = ! empty( $new_instance['image_retina'] ) ? 1 : 0;
		$instance['desc'] = $new_instance['desc']; // No validation
		$instance['btn_label'] = strip_tags( $new_instance['btn_label'] );
		$instance['btn_color'] = sanitize_hex_color( $new_instance['btn_color'] );
		$instance['btn_bg'] = sanitize_hex_color( $new_instance['btn_bg'] );
		$instance['btn_color_hover'] = sanitize_hex_color( $new_instance['btn_color_hover'] );
		$instance['btn_bg_hover'] = sanitize_hex_color( $new_instance['btn_bg_hover'] );
		$instance['btn_url'] = esc_url_raw( $new_instance['btn_url'] );
		$instance['btn_target'] = ! empty( $new_instance['btn_target'] ) ? 1 : 0;
		return $instance;
	}
}

// Register Site_Info_Widget
function register_Site_Info_Widget() {
	register_widget( 'Site_Info_Widget' );
}
add_action( 'widgets_init', 'register_Site_Info_Widget' );
