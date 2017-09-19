=== Editor Templates ===
Contributors: mboynes, alleyinteractive
Tags: editor, templates, layouts, tinymce
Requires at least: 4.4
Tested up to: 4.8.1
Stable tag: 0.1.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Adds the TinyMCE Templates plugin to the visual editor in WordPress.

== Description ==

This plugin adds the [TinyMCE Templates plugin](https://www.tinymce.com/docs/plugins/template/) and adds a WordPress filter (`tinymce_editor_templates`) to make adding templates very simple.

Here's an example:

```
add_filter( 'tinymce_editor_templates', function( $templates ) {
	$templates[] = [
		'title' => 'Jumbotron',
		'description' => 'Bootstrap jumbotron component',
		'content' => '<div class="jumbotron">
			<h1 class="display-3">Hello, world!</h1>
			<p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
			<hr class="my-4">
			<p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
			<p class="lead"><a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a></p>
		</div>',
	];
	return $templates;
} );
```

Most likely, you'll want to make sure you're using [custom editor styles](https://codex.wordpress.org/Editor_Style) so your template markup renders nicely in the editor.

Keep in mind that the editor may strip out some HTML tags and attributes that aren't whitelisted, so you may need to add to that list if any parts of your content get stripped. See [`wp_kses_allowed_html`](https://codex.wordpress.org/Function_Reference/wp_kses_allowed_html) for more information.

== Installation ==

1. Add and activate the plugin through the 'Plugins' menu in WordPress
2. Add your custom templates using the `tinymce_editor_templates` filter (see Description section).
