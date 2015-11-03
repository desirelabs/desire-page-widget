<?php
/**
 * DesireSidebar class
 * @package desire-page-widget
 */

class DesireSidebar {

	/**
	 * Register a new sidebar to put widgets in
	 */
	public static function desire_register_sidebar() {
		// Register sidebar
		register_sidebar( array(
			'name'          => __( 'Desire widget sidebar', 'desire_page_widget' ),
			'id'            => 'desire-widget-sidebar',
			'description'   => '',
			'class'         => '',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="desire-widget-sidebar">',
			'after_title'   => '</h2>'
		) );
	}

	/**
	 * Sidebar shortcode
	 * @return desire-widget-sidebar dynamic sidebar
	 */
	public static function desire_sidebar_shortcode() {
		dynamic_sidebar( 'desire-widget-sidebar' );
	}
}