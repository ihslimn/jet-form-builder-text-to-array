<?php

namespace JFB_Text_To_Array;

if ( ! defined( 'WPINC' ) ) {
	die();
}

class Plugin {
	/**
	 * Instance.
	 *
	 * Holds the plugin instance.
	 *
	 * @since 1.0.0
	 * @access public
	 * @static
	 *
	 * @var Plugin
	 */
	public static $instance = null;

	private string $path = '';

	private string $url = '';

	public $slug = 'jfb-text-to-array';

	public function set_path( $path ) {
		if ( ! $this->path ) {
			$this->path = $path;
		}
	}

	public function set_url( $url ) {
		if ( ! $this->url ) {
			$this->url = $url;
		}
	}

	public function plugin_path( $path = '' ) {
		return $this->path . $path;
	}

	public function plugin_url( $url = '' ) {
		return $this->url . $url;
	}

	public function init_components() {

		require $this->plugin_path( 'includes/jet-form-builder/actions/text-to-array.php' );
		new Jet_Form_Builder\Actions\Text_To_Array();

	}

	public function get_version() {
		return '1.0.0';
	}

	/**
	 * Instance.
	 *
	 * Ensures only one instance of the plugin class is loaded or can be loaded.
	 *
	 * @return Plugin An instance of the class.
	 * @since 1.0.0
	 * @access public
	 * @static
	 *
	 */
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

}

Plugin::instance();
