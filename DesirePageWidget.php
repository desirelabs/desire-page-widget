<?php
/**
 * Plugin Name: Desire Page Widget
 * Plugin URI: http://wordpress.org/plugins/desire-page-widget/
 * Description: Brings an easy way to display widgets into your content, and displaying pages content in a widgt.
 * Author: Franck LEBAS
 * Author URI: http://desirelabs.fr
 * Version: 1.0.1
 * Licence: GPLv3
 * http://www.gnu.org/licenses/gpl-3.0.en.html
 * Text Domain: desire-page-widget
 * Domaine Path: /lang
 */

define( 'DESIRE_WIDGET_PAGE_PLUGIN_DIR', __DIR__ );

require_once( "DesireAutoload.php" );

class DesirePageWidget {


	static function init() {

		// Language
		load_theme_textdomain( 'desire-page-widget', DESIRE_WIDGET_PAGE_PLUGIN_DIR . '/lang' );

		// Hooks and actions init
		add_action( 'widgets_init', array( 'DesireSidebar', 'desire_register_sidebar' ) );
		add_action( 'widgets_init', create_function( '', 'register_widget( "DesireWidget" );' ) );

		// Shortcodes init
		add_shortcode( 'desire_widget_sidebar', array( 'DesireSidebar', 'desire_sidebar_shortcode' ), 10 );
	}
}

DesirePageWidget::init();

