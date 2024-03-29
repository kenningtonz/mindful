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
        'slug' => 'activities',
        'has_archive' => true,
        'publicly_queryable' => true,
        'menu_icon' => 'dashicons-buddicons-activity',
        'query_var' => true,
        'show_ui' => true,
        'show_in_rest' => true,
        'capability_type' => 'post',
        'rewrite' => array('slug' => 'activities', 'with_front' => false),
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
            'material',
            'type',
            'effort_level'
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
        'material',
        ['activity'],
        [
            'labels' => [
                'name' => 'Materials',
                'singular_name' => 'Material',
                'search_items' => 'Search Materials',
                'all_items' => 'All Materials',
                'edit_item' => 'Edit Material',
                'update_item' => 'Update Material',
                'add_new_item' => 'Add New Material',
                'new_item_name' => 'New Material Name',
                'menu_name' => 'Materials'
            ],
            'hierarchical' => false,
            // 'rewrite' => array('slug' => 'activities?material=', 'with_front' => false),
            'show_admin_column' => true,
            'show_in_rest' => true,
        ]
    );
    register_taxonomy(
        'effort',
        ['activity'],
        [
            'labels' => [
                'name' => 'Effort',
                'singular_name' => 'Effort',
                'search_items' => 'Search Effort',
                'all_items' => 'All Effort',
                'edit_item' => 'Edit Effort',
                'update_item' => 'Update Effort',
                'add_new_item' => 'Add New Effort',
                'new_item_name' => 'New Effort Name',
                'menu_name' => 'Effort'
            ],
            // 'rewrite' => array('slug' => 'activities?effort=', 'with_front' => false),
            'hierarchical' => false,
            'show_admin_column' => true,
            'show_in_rest' => true,
        ]
    );
    register_taxonomy(
        'a-type',
        ['activity'],
        [
            'labels' => [
                'name' => 'Type',
                'singular_name' => 'Type',
                'search_items' => 'Search Types',
                'all_items' => 'All Types',
                'edit_item' => 'Edit Type',
                'update_item' => 'Update Type',
                'add_new_item' => 'Add New Type',
                'new_item_name' => 'New Type Name',
                'menu_name' => 'Types'
            ],
            // 'rewrite' => array('slug' => 'activities?type=', 'with_front' => false),
            'hierarchical' => true,
            'show_admin_column' => true,
            'show_in_rest' => true,
        ]
    );
    // add_rewrite_rule('^recipes-with-(.*)/page/([0-9]+)?$','index.php?ingredient=$matches[1]&paged=$matches[2]','top');
    add_rewrite_rule('^effort(.*)/?', 'index.php?effort=$matches[1]', 'top');
    add_rewrite_rule('^material(.*)/?', 'index.php?material=$matches[1]', 'top');
    add_rewrite_rule('^a-type(.*)/?', 'index.php?type=$matches[1]', 'top');
}

add_action('init', 'activity_taxonomies', 0);

add_filter('term_link', 'change_permalinks', 10, 2);

function change_permalinks($permalink, $term)
{
    if ($term->taxonomy == 'effort') {
        $permalink = str_replace('effort/', 'activities?effort=', $permalink);
    } else if ($term->taxonomy == 'material') {
        $permalink = str_replace('material/', 'activities?material=', $permalink);
    } else if ($term->taxonomy == 'a-type') {
        $permalink = str_replace('a-type/', 'activities?type=', $permalink);
    }
    return $permalink;
}

function mindfulink_wp_enqueue_style2()
{
    $plugin_url = plugin_dir_url(__FILE__);

    wp_enqueue_style('activity',  $plugin_url . "/css/activity.css");
}

add_action('wp_enqueue_scripts', 'mindfulink_wp_enqueue_style2');
