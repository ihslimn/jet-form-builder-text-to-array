<?php

namespace JFB_Text_To_Array\Jet_Form_Builder\Actions;

use JFB_Text_To_Array\Plugin;
use Jet_Form_Builder\Actions\Manager;
use Jet_Form_Builder\Actions\Types\Base as ActionBase;
use Jet_Form_Builder\Actions\Action_Handler;
use Jet_Engine\Query_Builder\Manager as Queries;
use Jet_Form_Builder\Exceptions\Action_Exception as Error;

class Text_To_Array extends ActionBase {

	public function __construct() {

		add_action(
			'jet-form-builder/actions/register',
			array( $this, 'register_action' )
		);
		add_action(
			'jet-form-builder/editor-assets/before',
			array( $this, 'editor_assets' )
		);

	}

	public function register_action( Manager $manager ) {
		$manager->register_action_type( $this );
	}

	public function get_id() {
		return 'jfbc_text_to_array';
	}

	public function get_name() {
		return 'Text to Array';
	}

	public function self_script_name() {
		return 'JFBTextToArray';
	}

	public function editor_labels() {
		return array(
			'text_field'       => 'Text field',
			'lines_per_item'   => 'Lines per item',
			'keys'             => 'Keys',
			'array_field'      => 'Save to',
			'array_field_desc' => 'Form field to save resulting array to',
		);
	}

	public function visible_attributes_for_gateway_editor() {
		return array();
	}

	public function do_action( array $request, Action_Handler $handler ) {

		$text_field = $this->settings['text_field'] ?? '';

		if ( empty( $text_field ) ) {
			throw new Error( 'Set text field to get values from' );
		}

		$array_field = $this->settings['array_field'] ?? '';

		if ( empty( $array_field ) ) {
			throw new Error( 'Set field to store array to' );
		}

		$text = $request[ $text_field ];

		if ( empty( $text ) ) {
			return;
		}

		$array = preg_split( '/\r\n|\r|\n/', $text );

		$lines_per_item = ( int ) $this->settings['lines_per_item'] ?? 1;

		if ( ! $lines_per_item ) {
			$lines_per_item = 1;
		}

		$keys = $this->settings['keys'] ?? '';

		if ( empty( $keys ) ) {
			$keys = array();
			for ( $i = 1; $i <= $lines_per_item; $i++ ) {
				$keys[] = 'key-' . $i;
			}
		} else {
			$keys = preg_split( '/\r\n|\r|\n/', $keys );
		}

		$store = array();
		$index = 0;

		$result = array();

		foreach ( $array as $value ) {

			$store[ $keys[ $index ] ] = $value;
			$index++;

			if ( $index >= $lines_per_item ) {
				$index = 0;
				$result[] = $store;
				$store = array();
			}

		}

		if ( $index ) {
			//throw new Error( 'Incorrect input' );
		}

		jet_fb_context()->update_request( $result, $array_field );

		//var_dump( $result,$index );exit;

	}

	public function editor_assets() {
		wp_enqueue_script(
			Plugin::instance()->slug . '-editor',
			Plugin::instance()->plugin_url( 'assets/js/builder.editor.js' ),
			array(),
			Plugin::instance()->get_version(),
			true
		);
	}

}