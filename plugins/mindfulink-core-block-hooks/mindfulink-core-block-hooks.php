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
add_action('enqueue_block_editor_assets', 'mindfulink_enqueue_block_editor_assets');

?>