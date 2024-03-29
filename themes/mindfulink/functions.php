<?php

/**
 * Functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package mindfulink
 * @since 1.0.0
 */

/**
 * Enqueue the CSS files.
 *
 * @since 1.0.0
 *
 * @return void
 */
function mindfulink_wp_enqueue_scripts()
{
	wp_enqueue_style('contact-form',  get_template_directory_uri() . '/css/contact-form.css', [], 	wp_get_theme()->get('Version'));
	wp_enqueue_style('woocommerce',  get_template_directory_uri() . '/css/woocommerce.css', [], 	wp_get_theme()->get('Version'));
	wp_enqueue_style('header',  get_template_directory_uri() . '/css/header.css', [], 	wp_get_theme()->get('Version'));

	wp_enqueue_style(
		'style',
		get_stylesheet_uri(),
		[],
		wp_get_theme()->get('Version')
	);
}
add_action('wp_enqueue_scripts', 'mindfulink_wp_enqueue_scripts');

// Allow SVG
add_filter('wp_check_filetype_and_ext', function ($data, $file, $filename, $mimes) {

	global $wp_version;
	if ($wp_version !== '4.7.1') {
		return $data;
	}

	$filetype = wp_check_filetype($filename, $mimes);

	return [
		'ext' => $filetype['ext'],
		'type' => $filetype['type'],
		'proper_filename' => $data['proper_filename']
	];
}, 10, 4);

function cc_mime_types($mimes)
{
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

function fix_svg()
{
	echo '<style type="text/css">
		  .attachment-266x266, .thumbnail img {
			   width: 100% !important;
			   height: auto !important;
		  }
		  </style>';
}
add_action('admin_head', 'fix_svg');


//https://developer.wordpress.org/plugins/shortcodes/shortcodes-with-parameters/
//https://generatepress.com/forums/topic/using-custom-fields-in-html-block/
function custom_post_subtitle($atts = [])
{

	// Setup our HTML output
	$html = '';

	// normalize attribute keys, lowercase
	$atts = array_change_key_case((array) $atts, CASE_LOWER);

	// override default attributes with user attributes
	$code_atts = shortcode_atts(
		array(
			'tag' => 'h2',
		),
		$atts,
		'show_post_subtitle'
	);

	// Get the custom field titled: subtitle
	$id = get_post_meta(get_the_id(), 'subtitle', true);
	if (!empty($id)) {
		$html = sprintf('<%2$s class="alignfull is-style-%2$s">%1$s</%2$s>', $id, $code_atts['tag']);
	}

	return $html;
}
add_shortcode('show_post_subtitle', 'custom_post_subtitle');
