<?php
/**
 * DesireWidget class
 * @package desire-page-widget
 */
class DesireWidget extends WP_Widget {
	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'desire_page_widget', // Base ID
			__( 'Desire page widget', 'desire-page-widget' ), // Name
			array( 'description' => __( 'Display page content', 'desire-page-widget' ), ) // Args
		);
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$title       = ! empty( $instance['title'] ) ? $instance['title'] : "";
		$custom_page = ! empty( $instance['custom_page'] ) ? $instance['custom_page'] : "";
		$pages       = get_pages();
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'custom_page' ); ?>"><?php _e( 'Select a page :' ); ?></label>
			<select name="<?php echo $this->get_field_name( 'custom_page' ); ?>"
			        id="<?php echo $this->get_field_id( 'custom_page' ); ?>">
				<option></option>
				<?php foreach ( $pages as $page ):
					if ( $page->post_name == $custom_page ): ?>
						<option value="<?php echo $page->post_name; ?>"
						        selected="selected"><?php echo $page->post_title; ?></option>
					<?php else: ?>
						<option value="<?php echo $page->post_name; ?>"><?php echo $page->post_title; ?></option>
					<?php endif;
				endforeach; ?>
			</select>
			<br/>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Page title :' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>"
			       name="<?php echo $this->get_field_name( 'title' ); ?>" type="text"
			       value="<?php echo esc_attr( $title ); ?>">
		</p>
	<?php
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
		global $post;
		$custom_page = apply_filters( 'widget_slug', $instance['custom_page'] );
		$content     = new WP_Query( 'pagename=' . $custom_page );
		echo $args['before_widget'];
		if ( $content->post->ID == $post->ID && current_user_can( 'edit_pages' ) ) {
			print( __( "You're trying to include a content in itself. Errors may occure. Action cancelled." ) );
		} else {
			while ( $content->have_posts() ): $content->the_post(); ?>
				<?php the_content(); ?>
			<?php
			endwhile;
		}
		echo $args['after_widget'];
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
		$instance                = array();
		$instance['custom_page'] = ( ! empty( $new_instance['custom_page'] ) ) ? strip_tags( $new_instance['custom_page'] ) : '';
		$instance['title']       = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

		return $instance;
	}
}