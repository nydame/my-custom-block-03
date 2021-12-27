<?php

/**
 * Plugin Name: My First Gutenberg Block
 * Plugin URI: https://pineapplesodasoftware.com/blocks
 * Description: This plugin demonstrates how to register a static block for the Gutenberg editor.
 * Version: 1.0.2
 * Author: Felicia Betancourt
 *
 * @package pss-blocks
 */

defined( 'ABSPATH' ) || exit;

/**
 * Load all translations for our plugin from the MO file.
*/
add_action( 'init', 'my_dynamic_gutenberg_block_load_textdomain' );

function my_dynamic_gutenberg_block_load_textdomain() {
	load_plugin_textdomain( 'pss-blocks', false, basename( __DIR__ ) . '/languages' );
}

/**
 * Registers all block assets so that they can be enqueued through Gutenberg in
 * the corresponding context.
 *
 * Passes translations to JavaScript.
 */
function my_dynamic_gutenberg_block_register_block() {

	if ( ! function_exists( 'register_block_type' ) ) {
		// Gutenberg is not active.
		return;
	}

	$asset_file = include( plugin_dir_path( __FILE__ ) . 'build/index.asset.php' );

	wp_register_script(
		'my-dynamic-gutenberg-block',
		plugins_url( 'build/index.js', __FILE__ ),
		$asset_file['dependencies'],
		$asset_file['version'],
	);

	wp_register_style(
		'my-dynamic-gutenberg-block-editor',
		plugins_url( 'build/index.css', __FILE__ ),
		array( 'wp-edit-blocks' ),
		filemtime( plugin_dir_path( __FILE__ ) . 'build/index.css' )
	);

	wp_register_style(
		'my-dynamic-gutenberg-block-styles',
		plugins_url( 'build/style-index.css', __FILE__ ),
		array( ),
		filemtime( plugin_dir_path( __FILE__ ) . 'build/style-index.css' )
	);

	register_block_type( 'pss-blocks/my-dynamic-gutenberg-block', array(
		'api_version' => 2,
		'editor_script' => 'my-dynamic-gutenberg-block',
		'editor_style' => 'my-dynamic-gutenberg-block-editor',
		'style' => 'my-dynamic-gutenberg-block-styles',
	) );

	// Allow inlining of small styelsheets in content served to users.
	wp_style_add_data( 'my-dynamic-gutenberg-block-styles', 'path', dirname( __FILE__ ) . 'build/style.css' );

  if ( function_exists( 'wp_set_script_translations' ) ) {
    /**
     * May be extended to wp_set_script_translations( 'my-handle', 'my-domain',
     * plugin_dir_path( MY_PLUGIN ) . 'languages' ) ). For details see
     * https://make.wordpress.org/core/2018/11/09/new-javascript-i18n-support-in-wordpress/
     */
    wp_set_script_translations( 'my-dynamic-gutenberg-block', 'pss-blocks' );
  }

}
add_action( 'init', 'my_dynamic_gutenberg_block_register_block' );