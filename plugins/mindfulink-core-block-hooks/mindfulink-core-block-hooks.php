<?php

/**
 * Plugin Name: Mindfulink Core Block Hooks
 * Description: A plugin to add hooks to core blocks
 * Version: 1.0
 * Author: Mindfulink
 */

function mindfulink_enqueue_block_editor_assets()
{
    wp_enqueue_script(
        'mindfulink-core-block-hooks',
        plugins_url('plugin.js', __FILE__),
        array('wp-blocks', 'wp-dom-ready', 'wp-edit-post'),
        filemtime(plugin_dir_path(__FILE__) . '/plugin.js')
    );
}
add_action('enqueue_block_editor_assets', 'mindfulink_enqueue_block_editor_assets', 2);

function mindfulink_wp_enqueue_style() {
    $plugin_url = plugin_dir_url( __FILE__ );

    wp_enqueue_style( 'code',  $plugin_url . "/css/code.css");
    wp_enqueue_style( 'card',  $plugin_url . "/css/card.css");
    wp_enqueue_style( 'details',  $plugin_url . "/css/details.css");
    wp_enqueue_style( 'featured-image',  $plugin_url . "/css/featured-image.css");
    wp_enqueue_style( 'footnotes',  $plugin_url . "/css/footnotes.css");
    wp_enqueue_style( 'heading',  $plugin_url . "/css/heading.css");
    wp_enqueue_style( 'list',  $plugin_url . "/css/list.css");
    wp_enqueue_style( 'paragraph',  $plugin_url . "/css/paragraph.css");
    wp_enqueue_style( 'post',  $plugin_url . "/css/post.css");
    wp_enqueue_style( 'preformatted',  $plugin_url . "/css/preformatted.css");
    wp_enqueue_style( 'product',  $plugin_url . "/css/product.css");
    wp_enqueue_style( 'pullquote',  $plugin_url . "/css/pullquote.css");
    wp_enqueue_style( 'quote',  $plugin_url . "/css/quote.css");
    wp_enqueue_style( 'table',  $plugin_url . "/css/table.css");
    wp_enqueue_style( 'verse',  $plugin_url . "/css/verse.css");

}

add_action( 'wp_enqueue_scripts', 'mindfulink_wp_enqueue_style' );


?>