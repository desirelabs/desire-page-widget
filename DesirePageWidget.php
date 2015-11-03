<?php
/**
 * Plugin Name: Desire Page Widget
 * Plugin URI: http://wordpress.org/plugins/desire-page-widget/
 * Description: Allow creating pages made of widgets && displaying pages through widgets
 * Author: Franck LEBAS
 * Version: 1.0
 * Author URI: http://desirelabs.fr
 * Text Domain: desire-page-widget
 */

define( 'DESIRE_WIDGET_PAGE_PLUGIN_DIR', __DIR__ );

require_once( "DesireAutoload.php" );

class DesirePageWidget {


	static function init() {

		// Hooks and actions init
		add_action( 'widgets_init', array( 'DesireSidebar', 'desire_register_sidebar' ) );
		add_action( 'widgets_init', create_function( '', 'register_widget( "DesireWidget" );' ) );

		// Shortcodes init
		add_shortcode( 'desire_widget_sidebar', array( 'DesireSidebar', 'desire_sidebar_shortcode' ), 10 );
	}
}

DesirePageWidget::init();

