<?php

/**
 * Plugin Name: Mindfulink Activity Post Type
 * Description: A plugin to register the activity post type and taxonomies
 * Version: 1.0
 * Author: Mindfulink
 */

function mindfulink_enqueue_post_editor_assets()
{
    wp_enqueue_script(
        'mindfulink-activity-post-type',
        plugins_url('plugin.js', __FILE__),
        array('wp-blocks', 'wp-dom-ready', 'wp-edit-post'),
        filemtime(plugin_dir_path(__FILE__) . '/plugin.js')
    );
}
add_action('enqueue_block_editor_assets', 'mindfulink_enqueue_post_editor_assets', 2);


function activity_post_type()
{
    $labels = array(
        'name' => 'Activities',
        'singular_name' => 'Activity',
        'add_new' => 'Add New',
        'add_new_item' => 'Add New Activity',
        'edit_item' => 'Edit Activity',
        'new_item' => 'New Activity',
        'all_items' => 'All Activities',
        'view_item' => 'View Activity',
        'search_items' => 'Search Activities',
        'not_found' => 'No Activities Found',
        'not_found_in_trash' => 'No Activities Found in Trash',
        'parent_item_colon' => 'Parent Activity'
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'publicly_queryable' => true,
        'menu_icon' => 'dashicons-buddicons-activity',
        'query_var' => true,
        'show_ui' => true,
        'show_in_rest' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'thumbnail',
            'page-attributes',
            'revisions',
            'post-formats', // post formats
        ),
        'taxonomies' => array(
            'category',
            'post_tag',
            'activity_materials',
            'activity_types',
            'activity_effort_levels'

        ),
        'menu_position' => 5,
        'exclude_from_search' => false
    );

    register_post_type('activity', $args);
}
add_action('init', 'activity_post_type');


function activity_taxonomies()
{
    register_taxonomy(
        'activity_materials',
        ['activity'],
        [
            'labels' => [
                'name' => 'Activity Materials',
                'singular_name' => 'Activity Material',
                'search_items' => 'Search Activity Materials',
                'all_items' => 'All Activity Materials',
                'parent_item' => 'Parent Activity Material',
                'parent_item_colon' => 'Parent Activity Material:',
                'edit_item' => 'Edit Activity Material',
                'update_item' => 'Update Activity Material',
                'add_new_item' => 'Add New Activity Material',
                'new_item_name' => 'New Activity Material Name',
                'menu_name' => 'Materials'
            ],
            'hierarchical' => false,
            'show_admin_column' => true,
            'show_in_rest' => true,
        ]
    );
    register_taxonomy(
        'activity_effort_levels',
        ['activity'],
        [
            'labels' => [
                'name' => 'Activity Effort Levels',
                'singular_name' => 'Activity Effort Level',
                'search_items' => 'Search Effort Levels',
                'all_items' => 'All Activity Effort Levels',
                'parent_item' => 'Parent Activity Type',
                'parent_item_colon' => 'Parent Activity Effort Level:',
                'edit_item' => 'Edit Activity Effort Level',
                'update_item' => 'Update Activity Effort Level',
                'add_new_item' => 'Add New Activity Effort Level',
                'new_item_name' => 'New Activity Effort Level Name',
                'menu_name' => 'Effort Levels'
            ],
            'hierarchical' => false,
            'show_admin_column' => true,
            'show_in_rest' => true,
        ]
    );
    register_taxonomy(
        'activity_types',
        ['activity'],
        [
            'labels' => [
                'name' => 'Activity Types',
                'singular_name' => 'Activity Type',
                'search_items' => 'Search Activity Types',
                'all_items' => 'All Activity Types',
                'parent_item' => 'Parent Activity Type',
                'parent_item_colon' => 'Parent Activity Type:',
                'edit_item' => 'Edit Activity Type',
                'update_item' => 'Update Activity Type',
                'add_new_item' => 'Add New Activity Type',
                'new_item_name' => 'New Activity Type Name',
                'menu_name' => 'Types'
            ],
            'hierarchical' => false,
            'show_admin_column' => true,
            'show_in_rest' => true,
        ]
    );
}

add_action('init', 'activity_taxonomies', 0);

function mindfulink_wp_enqueue_style2()
{
    $plugin_url = plugin_dir_url(__FILE__);

    wp_enqueue_style('activity',  $plugin_url . "/css/activity.css");
}

add_action('wp_enqueue_scripts', 'mindfulink_wp_enqueue_style2');
