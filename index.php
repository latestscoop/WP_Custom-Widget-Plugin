<?php
/*
Plugin Name: Custom Widget
Plugin URI: http://www.latestscoop.co.uk
Description: Custom Widget
Author: Sami Cooper
Version: 0.9
Author URI: http://www.latestscoop.co.uk
*/
// Block direct requests
if ( !defined('ABSPATH') )
die('-1');
add_action( 'widgets_init', function(){
register_widget( 'Custom_Widget' );
});
/**
* Adds Custom_Widget widget.
*/
class Custom_Widget extends WP_Widget {
/**
* Register widget with WordPress.
*/
function __construct() {
parent::__construct(
'Custom_Widget', // Base ID
__('Custom Widget', 'text_domain'), // Name
array( 'description' => __( 'Custom widget', 'text_domain' ), ) // Args
);
}
/**
* Front-end display of widget.
*
* @see WP_Widget::widget()
*
* @param array $args Widget arguments.
* @param array $instance Saved values from database.
*/
public function widget( $args, $instance ) {
	echo $args['before_widget'];
	if ( ! empty( $instance['title'] ) ) {
		echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
	}
	// echo __( 'Hello, World!', 'text_domain' );
	echo '<p>Your Widget goes here</p>';
	
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
if ( isset( $instance[ 'title' ] ) ) {
$title = $instance[ 'title' ];
}
else {
$title = __( 'New title', 'text_domain' );
}
?>
<p>
<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
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
public function update( $new_instance, $old_instance ) {
$instance = array();
$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
return $instance;
}
} // class Custom_Widget
