<?php
/**
 * Plugin Name:     Editor Templates
 * Plugin URI:      https://github.com/alleyinteractive/editor-templates
 * Description:     Adds the TinyMCE Templates plugin to the editor in WordPress.
 * Author:          Matthew Boynes
 * Author URI:      https://www.alleyinteractive.com
 * Text Domain:     editor-templates
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         Editor_Templates
 */

namespace Editor_Templates;

define( __NAMESPACE__ . '\URL', trailingslashit( plugins_url( '', __FILE__ ) ) );

/**
 * Register this TinyMCE plugin.
 *
 * @param  array $plugin_array Array of plugins
 * @return array
 */
function tinymce_plugins( $plugin_array ) {
	$plugin_array['template'] = URL . '/static/template.min.js';
	return $plugin_array;
}
add_filter( 'mce_external_plugins', __NAMESPACE__ . '\tinymce_plugins' );

/**
 * Add the icon to the toolbar.
 *
 * @param array $buttons Toolbar buttons.
 */
function add_buttons( $buttons ) {
	if ( false !== ( $insert_point = array_search( 'unlink', $buttons ) ) ) {
		array_splice( $buttons, $insert_point + 1, 0, 'template' );
	} else {
		$buttons[] = 'template';
	}
	return $buttons;
}
add_filter( 'mce_buttons', __NAMESPACE__ . '\add_buttons' );

/**
 * Add templates to the TinyMCE config.
 *
 * @param array  $mce_init  An array with TinyMCE config.
 * @param string $editor_id Unique editor identifier, e.g. 'content'.
 */
function tinymce_config( $mce_init, $editor_id ) {
	if ( empty( $mce_init['templates'] ) ) {
		/**
		 * Filter the templates to be used in TinyMCE.
		 *
		 * @param array  $templates {
		 *     Array of templates to add to the editor. The below array params
		 *     document the inner array values required.
		 *
		 *     @type string $title       The template title.
		 *     @type string $description Optional. The template description
		 *     @type string $content     The template content.
		 * }
		 * @param string $editor_id Unique editor identifier, e.g. 'content'.
		 */
		$templates = apply_filters( 'tinymce_editor_templates', [], $editor_id );
		$mce_init['templates'] = wp_json_encode( $templates );
	}
	return $mce_init;
}
add_filter( 'tiny_mce_before_init', __NAMESPACE__ . '\tinymce_config', 10, 2 );
