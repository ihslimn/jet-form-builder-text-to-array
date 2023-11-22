<?php
/**
 * Plugin Name: JetFormBuilder - Text to array
 * Plugin URI:  
 * Description: 
 * Version:     1.0.0
 * Author:      ihslimn
 * Author URI:  https://github.com/ihslimn
 * Text Domain: jfb-send-password-reset
 * License:     GPL-3.0+
 * License URI: http://www.gnu.org/licenses/gpl-3.0.txt
 * Domain Path: /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die();
}

add_action( 'plugins_loaded', function() {

	if ( ! function_exists( 'jet_form_builder' ) ) {

		add_action( 'admin_notices', function() {
			$class = 'notice notice-error';
			$message = '<b>WARNING!</b> <b>JetFormBuilder - Text to array</b> plugin requires <b>JetFormBuilder</b> plugin to be installed and activated.';
			printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), wp_kses_post( $message ) );
		} );

		return;

	}

	require trailingslashit( plugin_dir_path( __FILE__ ) ) . 'includes/plugin.php';

	\JFB_Text_To_Array\Plugin::instance()->set_path( trailingslashit( plugin_dir_path( __FILE__ ) ) );
	\JFB_Text_To_Array\Plugin::instance()->set_url( trailingslashit( plugins_url( '', __FILE__ ) ) );
	\JFB_Text_To_Array\Plugin::instance()->init_components();

}, 100 );
